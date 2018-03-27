<?php header("content-Type: text/html; charset=UTF-8");?>
<?php

//QQ 970308759
ini_set("display_errors", "off");
include_once("gybpay.class.php");
$payment['id'] = '1644';
$payment['key'] = "8ca8f0efbfbc44f2a80a7d0c09c7b72f";

$notify_url = "http://".$_SERVER['SERVER_NAME']."/gybpay/return.php";    // 返回地址不要带参数
$return_url = "http://".$_SERVER['SERVER_NAME']."/gybpay/return.php";  


 include_once("../include/mysqli.php");
 
 