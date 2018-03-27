<?php
/* *
 * 功能：查询处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");
	
	// 请求数据赋值
	$data = "";
	// 商户APINMAE，商户订单信息查询
	$data['apiName'] = $mobaopay_apiname_query;
	// 商户API版本
	$data['apiVersion'] = $mobaopay_api_version;
	// 商户在Mo宝支付的平台号
	$data['platformID'] = $platform_id;
	// Mo宝支付分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	
	//商户订单号
	$data['orderNo']=$_POST["orderNo"];
	// 商户订单日期
	$data['tradeDate']=$_POST["tradeDate"];
	// 商户交易金额
	$data['amt']=$_POST["amt"];
	

	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	// 准备请求数据
	$to_requset = $cMbPay->prepareRequest($str_to_sign, $sign);
	// 请求数据
	$resultData = $cMbPay->request($to_requset);
	#echo "查询回复：".$resultData.'<br>';
	// 准备验签数据
	$to_verify = $cMbPay->prepareVerify($resultData);
	// 签名验证
	$resultVerify = $cMbPay->verify($to_verify[0], $to_verify[1]);
	if ($resultVerify) {
		// 响应吗
		preg_match('{<respCode>(.*?)</respCode>}', $resultData, $match);
		$respCode = $match[1];
		// 响应信息
		preg_match('{<respDesc>(.*?)</respDesc>}', $resultData, $match);
		$respDesc = $match[1];
	
		if ($respCode == '00')
		{
			// 查询成功
			// 支付平台订单日期
			preg_match('{<accDate>(.*?)</accDate>}', $resultData, $match);
			$accDate = $match[1];
			echo "订单日期 ".$accDate.'<br>';
			// 商户订单号
			preg_match('{<orderNo>(.*?)</orderNo>}', $resultData, $match);
			$orderNo = $match[1];
			echo "订单号 ".$orderNo.'<br>';
			// 商户订单状态
			preg_match('{<Status>(.*?)</Status>}', $resultData, $match);
			$Status = $match[1];
			echo "订单状态 ";
			if ($Status == '0')
				echo "未处理[".$Status."]";
			else if ($Status == '1')// 需更新商户系统订单状态
				echo "成功[".$Status."]";
			else if ($Status == '2')// 需更新商户系统订单状态
				echo "失败[".$Status."]";
			else if ($Status == '4')// 需更新商户系统订单状态
				echo "部分退货[".$Status."]";
			else if ($Status == '5')// 需更新商户系统订单状态
				echo "全部退货[".$Status."]";
			else if ($Status == '9')// 需更新商户系统订单状态
				echo "退款处理中[".$Status."]";
			else if ($Status == '11')
				echo "订单过期[".$Status."]";
			else
				echo "其他[".$Status."]";
				
			/* 此处添加代码根据订单状态做后续业务处理 */
		}
		else{
			// 响应错误信息
			echo "查询失败".'<br>';
			echo "响应码 ".$respCode.'<br>';
			echo "响应信息 ".$respDesc.'<br>';
		}

	} else {
		echo "验证签名失败";
		return false;
	}	
	
	//$cMbPay->mobaopayTranQuery($data);
?>
