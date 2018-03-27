<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];

// echo '<pre>';print_r($_SESSION);echo '</pre>';

include_once("config.php");
if(!$username){
	echo "<script>alert('请登录后再试！');window.close();</script>";exit;
}
if(!$isBB){
	echo "<script>alert('未开通BB!');window.close();</script>";exit;
}

$sign = md5($plantform."_".$merID."_".$key."_".$username);

$page_site = $_REQUEST["site"];
if(!$page_site){
	$page_site = "live";
}


$url = $fenjieHost."/bb!login.do?plantform=".$plantform."&username=".$username."&page_site=".$page_site."&sign=".$sign;
// echo $url;

$url = curl_file_get_contents($url);

if(strpos($url, "alert") > 0){
	//echo "<script>alert('您的登陆过于频繁，请1分钟后在试！');window.close();</script>";exit;
	echo "";exit;
}
//header("Location:{$url}");
echo $url;
?>