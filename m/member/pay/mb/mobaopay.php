<?php
	include 'php.config';
	include 'MobaoPay.class.php';

	header('Content-Type:text/html;charset=utf-8');
	//print_r($_POST);
	$s_name		=	$_REQUEST['S_Name'];
	$p2_Order	=	$s_name."_".getOrderId();
	// 请求数据赋值
	$data = "";
	$data['apiName']='WEB_PAY_B2C';
	$data['apiVersion'] = '1.0.0.0';
	$data['platformID'] = 'ymsm123';
	$data['merchNo'] = '210001510003540';
	$data['orderNo'] = $p2_Order;
	$data['tradeDate'] = date('Ymd');;
	$data['amt'] = $_POST["MOAmount"];
	$data['merchUrl'] = "http://mbpay.1688618.com/pay/mb/callback.php";
	$data['merchParam'] = $_REQUEST['S_Name'];
	$data['tradeSummary'] = 'Game ICO';
	$data['bankCode']= $_POST["Bankco"];
	//echo "<br>";print_r($data);exit;
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
	
	// 调用支付交易	
	$cMbPay = new MbPay($pfxFile, $pubFile, $pfxpasswd, $payReqUrl);	
	echo $cMbPay->mobaopayOrder($data);
	function getOrderId() {
		return rand(100000,999999)."".date("YmdHis");
	}
?> 