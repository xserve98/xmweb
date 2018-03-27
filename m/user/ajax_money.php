<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
include_once("../class/user.php");
ini_set('display_errors','yes');
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$username = $_SESSION['username'];
$callback	= $_GET['callback'];
renovate($uid,$loginid); //验证是否登陆
include_once("../class/agapi.php");
$userinfo=user::getinfo($uid);
$agapi = new agapi();

$json['user_money']		= $userinfo['money']." RMB";
$json['jifen']		= $userinfo['jifen'];
$user_livemoney='0';

if(!$userinfo['ag_zr_is']){
	$reg_result = $agapi->register($username);
	if($reg_result['result'] == true){
		$agbalance = $agapi->balance_one($username);
		if(isset($agbalance['code']) && $agbalance['code']){
			$user_livemoney='获取余额失败，ERR:'.$agbalance['code'];
		}else{
		  $user_livemoney = number_format($agbalance['amount'],2);
		}

	}else{
		$user_livemoney='获取余额失败，ERR:101';
	}
}else{
	$agbalance = $agapi->balance_one($username);
	if(isset($agbalance['code']) && $agbalance['code']){
		$user_livemoney='获取余额失败，ERR:'.$agbalance['code'];
	}else{
	  $user_livemoney = number_format($agbalance['amount'],2);
	}
}
$json['user_livemoney']		= $user_livemoney;
echo $callback."(".json_encode($json).");";
exit;