<?php
session_start();

header('Content-type: text/json; charset=utf-8');
include_once("include/mysqli.php");
include_once("include/mysqlis.php");
include_once("common/logintu.php");
include_once("include/config.php");

$uid		= @$_SESSION["uid"];
$callback	= $_GET['callback'];

	$md		=	date("m-d");

	//sessionNum($uid,4,$callback);
	
	//$tz_money=	$user_num	=	$user_money	=	0; //投注
	

	//投注金额 
	if($uid && $uid>0){ //已登陆
		$sql = "select sum(money) as s from c_bet where uid=$uid and js=0"; //获取帐号未结算
		$query = $mysqli->query($sql);
		$rs = $query->fetch_array();
		$tz_money += $rs['s'];

	
		$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_num	=	$rs['s'];
		
		$sql		=	"select money as s,jifen from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
		$jifen	=	$rs['jifen'];
	}
	unset($mysqlis);
	
	$json['tz_money']		= $tz_money;
	$json['user_money']		= $user_money;
	$json['jifen']		    = $jifen;
	$json['user_num']		= $user_num;

echo $callback."(".json_encode($json).");";
exit;
?>