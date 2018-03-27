<?php
/* *
 * 功能：MO宝支付接口类
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 	
class MbPay {
	private $mbpKey;
	public $serverUrl;


	/**
	 * 签名初始化
	 * @param mbpKey	签名密钥
	 * @param url		请求的URL
	 */

	public function __construct($mbpKey, $url="") {
		$this->mbpKey = $mbpKey;
		$this->serverUrl = $url;
	}

	/**
	 * 创建表单
	 * @data		表单内容
	 * @gateway 支付网关地址
	 */
	function buildForm($data, $gateway) {			
			$sHtml = "<form id='mobaopaysubmit' name='mobaopaysubmit' action='".$gateway."' method='post'>";
			while (list ($key, $val) = each ($data)) {
	            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
			}
			$sHtml.= "</form>";
			$sHtml.= "<script>document.forms['mobaopaysubmit'].submit();</script>";
			
			return $sHtml;
	}

	/**
	 * @name	准备签名/验签字符串
	 * @desc prepare urlencode data
	 * @mobaopay_tran_query
	 * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt
	 * #@mobaopay_tran_return
	 * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt,tradeSummary
	 * #@web_pay_b2c,wap_pay_b2c
	 * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt,merchUrl,merchParam,tradeSummary
	 * #@pay_result_notify
	 * #apiName,notifyTime,tradeAmt,merchNo,merchParam,orderNo,tradeDate,accNo,accDate,orderStatus
	 */
	public function prepareSign($data) {
		if($data['apiName'] == 'MOBO_TRAN_QUERY') {
			$result = sprintf(
				"apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s",
				$data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt']
			);
			return $result;
		#} else if (($data['apiName'] == 'WEB_PAY_B2C') || ($data['apiName'] == 'WAP_PAY_B2C')) {
		} else if ($data['apiName'] == 'WEB_PAY_B2C') {
			$result = sprintf(
				"apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
			$data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
			);
			return $result;
		} else if ($data['apiName'] == 'MOBO_USER_WEB_PAY') {
			$result = sprintf(
				"apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&userNo=%s&accNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
			$data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['userNo'], $data['accNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
			);
			return $result;
		} else if ($data['apiName'] == 'MOBO_TRAN_RETURN') {
			$result = sprintf(
				"apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&tradeSummary=%s",
				$data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['tradeSummary']
			);
			return $result;
		} else if ($data['apiName'] == 'PAY_RESULT_NOTIFY') {
			$result = sprintf(
				"apiName=%s&notifyTime=%s&tradeAmt=%s&merchNo=%s&merchParam=%s&orderNo=%s&tradeDate=%s&accNo=%s&accDate=%s&orderStatus=%s",
				$data['apiName'], $data['notifyTime'], $data['tradeAmt'], $data['merchNo'], $data['merchParam'], $data['orderNo'], $data['tradeDate'], $data['accNo'], $data['accDate'], $data['orderStatus']
			);
			return $result;
		} 
		
		$array = array();
		foreach ($data as $key=>$value) {
			array_push($array, $key.'='.$value);
		}
		return implode($array, '&');
	}

	/**
	 * @name	生成签名
	 * @param	sourceData
	 * @return	签名数据
	 */
	public function sign($data) {
		$signature = MD5($data.$this->mbpKey);
		return $signature;
	}

	/*
	 * @name	准备带有签名的request字符串
	 * @desc	merge signature and request data
	 * @param	request字符串
	 * @param	签名数据
	 * @return	
	 */
	public function prepareRequest($string, $signature) {
		return $string.'&signMsg='.$signature;
	}

	/*
	 * @name	请求接口
	 * @desc	request api
	 * @param	curl,sock
	 */
	public function request($data, $method='curl') {
		# TODO:	当前只有curl方式，以后支持fsocket等方式
		$curl = curl_init();
		$curlData = array();
		$curlData[CURLOPT_POST] = true;
		$curlData[CURLOPT_URL] = $this->serverUrl;
		$curlData[CURLOPT_RETURNTRANSFER] = true;
		$curlData[CURLOPT_TIMEOUT] = 120;
		#CURLOPT_FOLLOWLOCATION
		$curlData[CURLOPT_POSTFIELDS] = $data;
		curl_setopt_array($curl, $curlData);
			
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
		$result = curl_exec($curl);
		
		if (!$result)
		{
			var_dump(curl_error($curl));
		}
		curl_close($curl);
		//echo $result;
		return $result;
	}

	/*
	 * @name	准备获取验签数据
	 * @desc	extract signature and string to verify from response result
	 */
	public function prepareVerify($result) {
		preg_match('{<respData>(.*?)</respData>}', $result, $match);
		$srcData = $match[0];
		preg_match('{<signMsg>(.*?)</signMsg>}', $result, $match);
		$signature = $match[1];
		$signature = str_replace('%2B', '+', $signature);
		return array($srcData, $signature);
	}

	/*
	 * @name	验证签名
	 * @param	signData 签名数据
	 * @param	sourceData 原数据
	 * @return
	 */
	public function verify($data, $signature) {
		$mySign = $this->sign($data);
		if (strcasecmp($mySign, $signature) == 0) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * @name 摩宝查询请求交易
	 * @desc
	 */
	public function mobaopayTranQuery($data) {
		$str_to_sign = $this->prepareSign($data);
		$sign = $this->sign($str_to_sign);
		$to_request = $this->prepareRequest($str_to_sign, $sign);
		$result = $this->request($to_request);

		$to_verify = $this->prepareVerify($result);

		if ($this->verify($to_verify[0], $to_verify[1]) ) {
			return $result;
		} else{
			//echo "verify error";
			return false;
		}
	}

	/*
	 * @name	摩宝退款请求交易
	 * @desc
	 */
	public function mobaopayTranReturn($data) {
		$str_to_sign = $this->prepareSign($data);
		$sign = $this->sign($str_to_sign);
		$to_requset = $this->prepareRequest($str_to_sign, $sign);
		$result = $this->request($to_requset);
		$to_verify = $this->prepareVerify($result);
		if ($this->verify($to_verify[0], $to_verify[1]) ) {
			return $result;
		} else {
			return false;
		}
	}

	/*
	 * @name	组装请求的交易数据
	 * @desc
	 */
	public function getTradeMsg($data) {
		if($data['tradeSummary']){
			$data['tradeSummary'] = urlencode($data['tradeSummary']);
		}
		return $this->prepareSign($data);
	}
	/*
	 * @name	摩宝支付请求交易
	 * @desc
	 */
	public function mobaopayOrder($data) {
		$str_to_sign = $this->prepareSign($data);
		$sign = $this->sign($str_to_sign);
		$sign = urlencode($sign);
		$to_request = $this->prepareRequest($this->getTradeMsg($data), $sign);
		$url = $this->serverUrl . '?' . $to_request;
		if($data['bankCode']){
			$url = $url . '&bankCode='.$data['bankCode'];
		}
		$this->redirect($url);
	}	
}
?>
