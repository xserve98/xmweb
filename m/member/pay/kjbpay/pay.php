<?php
session_start();
include 'proterties.php';
include_once("../moneyconfig.php");

#	商家设置用户购买商品的支付信息.
##快捷宝支付平台统一使用UTF-8编码方式,参数如用到中文，请注意转码

#快捷宝支付请求正式地址
$reqURL_onLine = "http://www.kjb88.com/bankinterface/pay";

$p0_Cmd = 'Buy';

$p1_MerId = $pay_mid;
$key = $pay_mkey;
	
#	用户订单号,选填.
##若不为""，提交的订单号必须在自身账户交易中唯一;为""时，快捷宝支付会自动生成随机的用户订单号.
$p2_Order					= date("YmdHis").substr(microtime(),2,5).rand(1000, 2000);

#	支付金额,必填.
##单位:元，精确到分.
$p3_Amt						= $_REQUEST['MOAmount'];

#	交易币种,固定值"CNY".
$p4_Cur						= "CNY";

#	商品名称
##用于支付时显示在易宝支付网关左侧的订单产品信息.
$p5_Pid						= $_REQUEST['S_Name'];

#	商品种类
$p6_Pcat					= $_REQUEST['S_Name'];

#	商品描述
$p7_Pdesc					= $_REQUEST['S_Name'];

#	用户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知.
$p8_Url						= $return_url;

$p9_SAF                     = '0';

#	用户扩展信息
##用户可以任意填写1K 的字符串,支付成功时将原样返回.
$pa_MP						= $_REQUEST['S_Name'];

#	支付通道编码
##默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.
$pd_FrpId					= $_REQUEST['Bankco'];

#	应答机制
##默认为"1": 需要应答机制;
$pr_NeedResponse	= "1";

#调用签名函数生成签名串
$hmac = strtoupper (md5( "p0_Cmd$p0_Cmd" . "p1_MerId$p1_MerId" . "p2_Order$p2_Order" . "p3_Amt$p3_Amt" . "p4_Cur$p4_Cur" . "p5_Pid$p5_Pid" . "p6_Pcat$p6_Pcat" . "p7_Pdesc$p7_Pdesc" . "p8_Url$p8_Url" . "p9_SAF$p9_SAF" . "pa_MP$pa_MP" . "pd_FrpId$pd_FrpId" . "pr_NeedResponse$pr_NeedResponse" . $key ));


echo "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title></title>
</head>
<body onLoad=\"document.kuaiyin.submit();\">
<form name='kuaiyin' action='$reqURL_onLine' method='post'>
<input type='hidden' name='p0_Cmd'					value='$p0_Cmd'>
<input type='hidden' name='p1_MerId'				value='$p1_MerId'>
<input type='hidden' name='p2_Order'				value='$p2_Order'>
<input type='hidden' name='p3_Amt'					value='$p3_Amt'>
<input type='hidden' name='p4_Cur'					value='$p4_Cur'>
<input type='hidden' name='p5_Pid'					value='$p5_Pid'>
<input type='hidden' name='p6_Pcat'					value='$p6_Pcat'>
<input type='hidden' name='p7_Pdesc'				value='$p7_Pdesc'>
<input type='hidden' name='p8_Url'					value='$p8_Url'>
<input type='hidden' name='p9_SAF'					value='$p9_SAF'>
<input type='hidden' name='pa_MP'						value='$pa_MP'>
<input type='hidden' name='pd_FrpId'				value='$pd_FrpId'>
<input type='hidden' name='pr_NeedResponse'	value='$pr_NeedResponse'>
<input type='hidden' name='hmac'						value='$hmac'>
</form>
</body>
</html>";
?>