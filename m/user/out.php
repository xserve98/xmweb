<?php
session_start();
header('Content-type: text/html; charset=utf-8');
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
$uid = @$_SESSION["uid"];
if($uid){
	logintu($uid);
	
}
session_destroy();
header("location:/index.php");
?>