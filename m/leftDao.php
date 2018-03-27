<?php
session_start();

header('Content-type: text/json; charset=utf-8');
include_once("include/config.php");
$uid		= @$_SESSION["uid"];
$callback	= $_GET['callback'];

	include_once("include/mysqli.php");

	include_once("common/logintu.php");
	
	$md		=	date("m-d");

	
	//投注金额 
	if($uid && $uid>0){ //已登陆
	
		
	
		

		
		$sql		=	"select money as s,jifen from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
		$jifen	=	$rs['jifen'];
	}

	

	$json['tz_money']		= $tz_money." 元";
	$json['user_money']		= $user_money." 元";
	$json['jifen']		= $jifen;
	$json['user_num']		= $user_num;

echo $callback."(".json_encode($json).");";
exit;
?>