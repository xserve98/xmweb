<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])) {
    echo "<script>alert('请先登录！'); window.open('/', '_top');</script>";
	exit();
}else{
	$_SESSION["uid"] = intval($_SESSION["uid"]);
}
?>