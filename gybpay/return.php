<?php
include_once("config.php");

$pay = new gybpay($payment);
$pay->debug = 1;
$pay->logPOST = 1;
$pay->logGET = 1;

if($pay->verify()){   
        $orderNo = trim($_POST['orderid']);
	$orderAmount = trim($_POST['ovalue']);
	//$tempArray = explode("_",$orderNo);
	$username =trim($_POST['attach']);
 
   $pay->updateCoinXianJin($orderNo,$orderAmount,$username,'http://juyou1989.com/');
    echo "ok";
}else{
    echo "fail";
}