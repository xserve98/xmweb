<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$username = $_SESSION['username'];
renovate($uid,$loginid);
include_once("../class/agapi.php");
$userinfo=user::getinfo($uid);
$agapi = new agapi();
if(!$userinfo['ag_zr_is']){
	$reg_result = $agapi->register($username);
	if($reg_result['result'] == true){
		$res = $agapi->login($username);
	}else{
		msg('真人开户失败，请联系管理员');
	}
}else{
	$res = $agapi->login($username);
}



if(isset($res['result']) && $res['result']){

			$url =  $res['url'].'?params='.$res['params'].'&key='.$res['key'];
			agenter($url);
	//header('location:'.$url);exit();
	//$bbinurl = $res['url'];

}else if(isset($res['code']) && $res['code']){
	//echo $res['code'];
	msg($agapi->geterrorcode($res['code']));
}else{
	msg('未知错误，请稍后重试');
}



function msg($msg){
echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>提示</title>
<body>'.$msg.'</body>
</html>';
exit;
}

function agenter($url){
header('location:'.$url);exit();
	echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>打造东方最具公信力的第一线上娱乐城</title>
<frameset rows="*,0,0" frameborder="NO" border="0" framespacing="0"> 
<frame name="index" src="'.$url.'">
<frame name="func" scrolling="NO" noresize src="ok.html">
<frame src="UntitledFrame-5"></frameset>
<noframes><body>
</body>
</noframes></html>';
}