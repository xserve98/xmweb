<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("common/logintu.php");
include_once("class/user.php");
if(!user::islogin()){
	echo "<script>alert(\"请登录后再进行存款和提款操作\");location.href='zhuce.php';</script>";
	exit();
}else{
	$sql	=	"select pay_name,pay_card from k_user where uid=".$_SESSION["uid"]." limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	if($rs['pay_card'] == ""){
		header('Refresh: 0; url=user/set_card.php?pay_name='.urlencode($rs["pay_name"]));
		exit();
	}else{
		header('Refresh: 0; url=user/tikuan.php');
		exit();
	}
}
?>