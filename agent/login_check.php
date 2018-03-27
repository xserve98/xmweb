<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if(!isset($_SESSION["suid"]) || !isset($_SESSION["susername"])) {
    echo "<script>alert('请先登录！'); window.open('/', '_top');</script>";
	exit();
}else{
	$_SESSION["suid"] = intval($_SESSION["suid"]);
}
?>