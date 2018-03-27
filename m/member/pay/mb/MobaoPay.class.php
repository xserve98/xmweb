<?php
/**
 * @name	Mo宝支付接口类
 * @desc	
 */
 	
class MbPay {
	private $privateKey;
	private $publicKey;	
	public $serverUrl;


	/**
	 * 签名初始化
	 * @param pfxFile	签名私钥文件的绝对路径
	 * @param certFile	验证签名文件的绝对路径
	 * @param pfxPwd	私钥文件的密码
	 * @param url		请求的URL
	 */

	public function __construct($pfxFile, $pubFile, $pfxPwd, $url="") {
		$pfxContent = file_get_contents($pfxFile);
		$cerContent = file_get_contents($pubFile);
		$status = openssl_pkcs12_read($pfxContent, $privateCert, $pfxPwd);
		if( $status ) {
			$this->privateKey = $privateCert['pkey'];
			// 处理pem证书:$this->publicKey = openssl_pkey_get_public($cerContent);
			/*---处理cer证书*/
			$pem = $this->der2pem($cerContent);
			$this->publicKey = openssl_pkey_get_public($pem);	
		}
		$this->serverUrl = $url;
	}
	
	/**
	 * 将der证书转换为pem
	 * @der_data		der证书内容
	 */
	function der2pem($der_data) {  
		$pem = chunk_split(base64_encode($der_data), 64, "\n");  
		$pem = "-----BEGIN CERTIFICATE-----\n".$pem."-----END CERTIFICATE-----\n";
		//print_r($pem);
		return $pem;  
	} 

	/**
	 * 重定向URL
	 * @url			url地址
	 */
	public function redirect($url, $type = 2) {
		switch ($type) {
			case 1 :
				header('Location:'.$url);
				break;
			case 2 :
				echo '<script>location.href=\''.$url.'\'</script>';
				break;
			default :
				echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
				break;
		}
		exit();//结束后面的程序
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
	 * @return	base64后的签名数据
	 */
	public function sign($data) {
		$status = openssl_sign($data, $signature, $this->privateKey, OPENSSL_ALGO_MD5);
        if($status) {
			$signature = base64_encode($signature);
			#$signature = strtr($signature, '+', '\r');
			#$signature = strtr($signature, '+', '\n');
		    return $signature;
        } else {
            return false;
        }
	}

	/*
	 * @name	准备带有签名的request字符串
	 * @desc	merge signature and request data
	 * @param	request字符串
	 * @param	签名数据
	 * @return	
	 */
	public function prepareRequest($string, $signature) {
		if(strpos($string, 'MOBO_USER_REGEDIT')) {
			$string = str_replace('+', '%2B', $string);
		}
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
		return array($srcData, $signature);
	}

	/*
	 * @name	验证签名
	 * @param	signData 签名数据
	 * @param	sourceData 原数据
	 * @return
	 */
	public function verify($data, $signature) {
		$designature = base64_decode($signature);
		$status = openssl_verify($data, $designature, $this->publicKey, OPENSSL_ALGO_MD5);
		//var_dump($status = openssl_verify($data, $designature, $this->publicKey));
		return $status;
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
