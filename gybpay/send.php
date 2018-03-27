<?php
include_once("config.php");

$order['ordernNo'] =date("YmdHis").rand(100,999);

$order['bankCode'] = $_POST['payId']; //银行代码
$order['remark'] = $_POST['username'];//
$order['orderAmount'] = $_POST['amount'];  //金额
if($order['orderAmount']<9){
	echo "您好，最低充值金额10元";
	exit;
}
$order['notifyUrl']=$notify_url;//服务器异步通知页面路径
$order['returnUrl']=$return_url;  //页面跳转同步 返回页面路径 可空
$order['goodsName'] = ''; //商品名称

$pay = new gybpay($payment);
$pay->debug = 0;
$pay->submit($order);