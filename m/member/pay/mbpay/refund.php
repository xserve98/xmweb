<?php
/* *
 * 功能：退款处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */

	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

	// 请求数据赋值
	$data = "";
	// 商户APINAME，Mo宝支付退款申请
	$data['apiName'] = $mobaopay_apiname_refund;
	// 商户API版本
	$data['apiVersion'] = $mobaopay_api_version;
	// 商户在Mo宝支付的平台号
	$data['platformID'] = $platform_id;
	// Mo宝支付分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	
	// 商户订单号
	$data['orderNo']=$_POST["orderNo"];
	// 商户订单日期
	$data['tradeDate']=$_POST["tradeDate"];
	// 商户交易金额
	$data['amt']=$_POST["amt"];
	// 商户交易摘要
	$data['tradeSummary']=$_POST["tradeSummary"];
	
	// 将中文转换为UTF-8
	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['tradeSummary']))
	{
  		$data['tradeSummary'] = iconv("GBK","UTF-8", $data['tradeSummary']);
	}
	
	// 调用退款交易
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	// 准备请求数据
	$to_requset = $cMbPay->prepareRequest($str_to_sign, $sign);
	// 请求数据
	$resultData = $cMbPay->request($to_requset);
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
			echo "响应码 ".$respCode.'<br>';
			echo "响应信息 ".$respDesc.'<br>';
		}
		else{
			// 响应错误信息
			echo "退款申请失败".'<br>';
			echo "响应码 ".$respCode.'<br>';
			echo "响应信息 ".$respDesc.'<br>';
		}

	} else {
		echo "验证签名失败";
		return false;
	}	
		
	//$resultData = $cMbPay->mobaopayTranReturn($data);
?> 