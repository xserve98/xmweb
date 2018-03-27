<?php
@session_start(); //后台登陆验证

if(!isset($_SESSION["adminid"])){
    unset($_SESSION["adminid"]);
    unset($_SESSION["login_pwd"]);
    unset($_SESSION["quanxian"]);
    echo "<script>alert('login!!pass');</script>";
    exit;
}else{
	include_once("../include/mysqlio.php");
	$sql	=	"select * from sys_admin where is_login=1 and uid=".intval($_SESSION["adminid"])." limit 1";
	$query	=	$mysqlio->query($sql);
	$rs		=	$query->fetch_array();
    if($rs['login_pwd']!=$_SESSION["login_pwd"] || $rs['login_name']!=$_SESSION["login_name"])
    {
		unset($_SESSION["adminid"]);
		unset($_SESSION["login_pwd"]);
		unset($_SESSION["quanxian"]);
		echo "<script>alert('login!!pass');</script>";
		exit;
    }
}
/*
//验证口令卡
require 'DataAccess.php';
require 'SecurityCard.php';
$scode = new SecurityCard;
$notes = $scode->verifyscode('admin', $_SESSION['slocation'], $_SESSION["inputscode"]);
if(!$notes){
    echo "<script>alert('login!!code');</script>";
    exit;
}
*/
?>