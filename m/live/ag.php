<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];
include_once("config.php");
if(!$username){
	echo "<script>alert('请登录后再试！');window.close();</script>";exit;
}
if(!$isAG){
	echo "<script>alert('未开通AG!');window.close();</script>";exit;
}

$sign = md5($plantform."_".$merID."_".$key."_".$username);

$url = $fenjieHost."/ag!login.do?target=ag&plantform=".$plantform."&username=".$username."&password=".$password."&sign=".$sign;
//echo $url;
$url = curl_file_get_contents($url);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>    
        <title>真人娱乐</title>
     <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
	     </head>
    <frameset rows="*" cols="100%">
        <frame noresize="noresize" src="<?=$url ?>" scrolling="auto" name="top">
        <noframes>
        </noframes>
    </frameset>

</html>