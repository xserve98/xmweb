<?php

include_once("../include/mysqli.php");
require_once("./Gfpay.config.php");

/*
 * 获取表单数据
 * */

$uid     = $_POST["uid"];
$uername =$_POST["username"];
		$time		= time();
		$orderNo	= date("YmdHis",$time);
		$tradeDate	= date("Ymd",$time); 
$order_id = (string) date("YmdHis"); //您的订单Id号，你必须自己保证订单号的唯一性，国易付不会限制该值的唯一性
$bankType = $_POST["payId"];  //充值方式：bank为网银，card为卡类支付
$account = $_POST['account'];  //充值的账号
$amount = $_POST["amount"];   //充值的金额

//网银支付
    //$bankType = $payType;   //银行类型

	//echo $bankType;
	//exit();
    /*
     * 提交数据
     * */
    include_once("./mnouvw/class.bankpay.php");
    $bankpay = new bankpay();

    $bankpay->parter = $mnouvw_merchant_id;  //商家Id
    $bankpay->key = $mnouvw_merchant_key; //商家密钥
    $bankpay->type = $bankType;   //商家密钥
    $bankpay->value = $amount;    //提交金额
    $bankpay->orderid = $order_id;   //订单Id号
    $bankpay->callbackurl = $mnouvw_callback_url; //下行url地址
    $bankpay->hrefbackurl = $mnouvw_bank_hrefbackurl; //下行url地址
	$bankpay->attach = $uid;
    //发送
    $bankpay->send();


?>