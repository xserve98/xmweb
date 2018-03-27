<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");
if($_POST["act"] == "login") {
    $uid = user::login(htmlEncode($_POST["username"]), htmlEncode($_POST["passwd"]));
    if(!$uid) {
        //echo '2'; //用户名或密码错误
		echo "<script>alert(\"抱歉，登录失败!！\");location.replace('/main');</script>";
        exit;
    }
    //echo '1'; //成功
	echo "<script>location.replace('/member/agreement');</script>";
    exit;
}
$f_class = ' abs';
?>
