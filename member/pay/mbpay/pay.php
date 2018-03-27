<?php
/* *
 * 功能：一般支付处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

	
	$s_name		=	$_REQUEST['S_Name'];
	$p2_Order	=	$s_name."_".getOrderId();
	
	// 请求数据赋值
	$data = "";
	// 商户APINMAE，WEB渠道一般支付
	$data['apiName'] = $mobaopay_apiname_pay;
	// 商户API版本
	$data['apiVersion'] = $mobaopay_api_version;
	// 商户在Mo宝支付的平台号
	$data['platformID'] = $platform_id;
	// Mo宝支付分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	// 商户通知地址
	$data['merchUrl'] = $merchant_notify_url;
	// 银行代码，不传输此参数则跳转Mo宝收银台
	$data['bankCode'] =  $_POST["Bankco"];
	
	//商户订单号
	$data['orderNo'] = $p2_Order;
	// 商户订单日期
	$data['tradeDate'] = date('Ymd');
	// 商户交易金额
	$data['amt'] = $_POST["MOAmount"];
	// 商户参数
	$data['merchParam'] =  $_REQUEST['S_Name'];
	// 商户交易摘要
	$data['tradeSummary'] = 'Game ICO';
	
	// 对含有中文的参数进行UTF-8编码
	// 将中文转换为UTF-8
	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['merchUrl']))
	{
  	$data['merchUrl'] = iconv("GBK","UTF-8", $data['merchUrl']);
	}
	
	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['merchParam']))
	{

  	$data['merchParam'] = iconv("GBK","UTF-8", $data['merchParam']);
	}

	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['tradeSummary']))
	{
  	$data['tradeSummary'] = iconv("GBK","UTF-8", $data['tradeSummary']);
	}
	
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	$data['signMsg'] = $sign;
	// 生成表单数据
	echo $cMbPay->buildForm($data, $mobaopay_gateway);
	function getOrderId() {
		return rand(100000,999999)."".date("YmdHis");
	}
	//$cMbPay->mobaopayOrder($data);
?> 