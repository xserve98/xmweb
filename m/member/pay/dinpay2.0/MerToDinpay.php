<?php
include_once("../moneyconfig.php");

// 公共函数定义
function StrToHex($string)
{
	$hex="";
	for ($i=0;$i<strlen($string);$i++)
		$hex.=dechex(ord($string[$i]));
	$hex=strtoupper($hex);
	return $hex;
}

$m_id		=	$pay_mid;	
$s_name		=	$_POST['S_Name'];
$m_orderid	=	$s_name."_".getOrderId();
$m_oamount	=	$_POST['MOAmount'];
$m_ocurrency=	'1';
$m_url		=	$return_url;
$m_language	=	'1';

$s_addr		=	'hongkong';
$s_postcode	=	'518000';
$s_tel		=	'0755-88833166';
$s_eml		=	'service@dinpay.com';
$r_name		=	'zhangsan';
$r_addr		=	'chinahongkong';
$r_postcode	=	'100080';
$r_tel		=	'0755-82384511';
$r_eml		=	'service@dinpay.com';
$m_ocomment	=	'username';
$modate		=	date("Y-m-d H:i:s",time());
$m_status	= 	0;
$pBank      =   $_POST['P_Bank'];

//组织订单信息
$m_info = $m_id."|".$m_orderid."|".$m_oamount."|".$m_ocurrency."|".$m_url."|".$m_language;
$s_info = $s_name."|".$s_addr."|".$s_postcode."|".$s_tel."|".$s_eml;
$r_info = $r_name."|".$r_addr."|".$r_postcode."|".$r_tel."|".$r_eml."|".$m_ocomment."|".$m_status."|".$modate;

$OrderInfo = $m_info."|".$s_info."|".$r_info;

//echo $OrderInfo;

//订单信息先转换成HEX，然后再加密
$key = $pay_mkey;     //<--支付密钥--> 注:此处密钥必须与商家后台里的密钥一致

$OrderInfo = StrToHex($OrderInfo);
$digest = strtoupper(md5($OrderInfo.$key));
function getOrderId()
{
	return rand(100000,999999)."".date("YmdHis");
}
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
</head>
<body onload='document.FORM.submit();'>
<form name='FORM' method='post' action='https://payment.dinpay.com/PHPReceiveMerchantAction.do'>
	<input type='hidden' name='OrderMessage' value='<?echo $OrderInfo?>'>
	<input type='hidden' name='digest' value='<?echo $digest?>'>
	<input type='hidden' name='M_ID' value='<?echo $m_id?>'>
	<input type='hidden' name='P_Bank' value='<?echo $pBank?>'/>
	<input type="hidden" name="s" value="submit">
</form>
</body>
</html>