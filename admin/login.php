<?php
session_start();
include_once("../include/config.php");

$username	=	@$_POST["LoginName"];
$password	=	@$_POST["LoginPassword"];
$yzm		=	@$_POST["CheckCode"];

function message($value,$url=""){ //默认返回上一页
	header("Content-type: text/html; charset=utf-8");
	
	$js  = "<script type=\"text/javascript\">\r\n";
	$js .= "alert(\"".$value."\");\r\n";
	if($url) $js .= "window.location.href=\"$url\";\r\n";
	else $js .= "window.history.go(-1);\r\n";
	$js .= "</script>\r\n";
	echo $js;
	exit;
}

/*
//验证口令卡
require 'DataAccess.php';
require 'SecurityCard.php';
$inputscode = @$_POST["inputscode"];
$inputscode = trim($inputscode);

if($inputscode=="" || strlen($inputscode)<4)
{
	message('请输入正确的4位密保口令');
}

$_SESSION["inputscode"] = $inputscode;
$scode = new SecurityCard;
$notes = $scode->verifyscode('admin', $_SESSION['slocation'], $inputscode);
if(!$notes){
	message('口令卡错误',"index.html");
}

if($yzm	!=	$_SESSION["randcode"]){
	message('验证码错误');
}
*/
include_once("../include/mysqlio.php");
include_once("../class/admin.php");

$arr	=	array();
$temp	=	admin::login($username,$password);
$arr	=	explode(',',$temp);
if($arr[0] > 0){
	admin::insert_log($arr[1],$_SERVER['REMOTE_ADDR']."登陆成功");
		$_SESSION['superadmin']= $username;
		$_SESSION['flag'] = ",01,02,03,04,05,06,07,08,09,10,11,12,13";
		$_SESSION['adminstats']='1';
	header('Content-Type: text/html; charset=utf-8');
	echo "<script>location.href='main.php';</script>";
	exit();
}else{
	if($arr[1] == 1){
		message('用户名或密码错误');
	}elseif($arr[1] == 2){
		message('登陆地址错误，您当前的登陆地址为：'.$arr[2]);
	}elseif($arr[1] == 3){
		message('登陆IP错误，您当前的登陆IP为：'.$arr[2]);
	}else{
		message('验证失败');
	}
}
?>