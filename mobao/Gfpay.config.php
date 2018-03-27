<?php
//=======================卡类支付和网银支付公用配置==================
//国易付商户ID
$mnouvw_merchant_id		= '1644';

//国易付通信密钥
$mnouvw_merchant_key		= '8ca8f0efbfbc44f2a80a7d0c09c7b72f';	//hc6NOTDETVQe9Lgr


//==========================卡类支付配置=============================
//支付的区域 0代表全国通用	
$mnouvw_restrict			= '0';


//接收国易付下行数据的地址, 该地址必须是可以再互联网上访问的网址
$mnouvw_callback_url		= "http://juyou1989.com/mobao/pay_card_callback.php";   
$mnouvw_callback_url_muti  = "http://juyou1989.com/mobao/pay_card_callback_muti.php";

//======================网银支付配置=================================
//接收国易付网银支付接口的地址
$mnouvw_bank_callback_url	= "http://juyou1989.com/mobao/callback.php";  


//网银支付跳转回的页面地址
$mnouvw_bank_hrefbackurl	= '';