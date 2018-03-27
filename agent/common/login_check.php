<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if(!isset($_SESSION["suid"]) || !isset($_SESSION["susername"])) {
   echo "<script>alert('请先登录！'); window.open('/', '_top');</script>";
	exit();
}else{
	$_SESSION["suid"] = intval($_SESSION["suid"]);
}

function message($value,$url=""){ //默认返回上一页
	header("Content-type: text/html; charset=utf-8");
	
	$js  = "<script type=\"text/javascript\" language=\"javascript\">\r\n";
	$js .= "alert(\"".$value."\");\r\n";
	if($url) $js .= "window.location.href=\"$url\";\r\n";
	else $js .= "window.history.go(-1);\r\n";
	$js .= "</script>\r\n";

	echo $js;
	exit;
}


?>