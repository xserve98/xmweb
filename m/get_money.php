<?php
@session_start();
//print_r($_COOKIE);
$uid		= @$_SESSION["uid"];
	include_once("include/mysqli.php");
	include_once("include/mysqlis.php");

	if($uid && $uid>0){ //已登陆
		$sql		=	"select money as s,jifen from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
		$user_jifen	=	sprintf("%.2f",$rs['jifen']);
		echo $user_money."||$user_jifen";exit;
	}

?>