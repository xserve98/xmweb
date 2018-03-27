<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>进入AG真人娱乐场</title>
	<style type="text/css">
		body {
			background-color: #000;
			color:#FFF;
		}
	</style>
</head>
<body>
<?php
session_start();
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo = user::getinfo($uid);

include_once("include/agconfig.php");
include_once("include/curl_http.php");
include_once("include/commfunc.php");
include_once("agfunc.php");

/* 维护通知 */
include_once("../cache/website.php");
$rtnagwh = check_agwh();
if ($rtnagwh!="0") {
	echo "<script>alert(\"".$rtnagwh."\");</script>";
	exit;
}

if ($userinfo['ag_zr_is']=="0") {
	$regok = reg_liveuser($userinfo['username'],$uid,"1");
	if ($regok!="0") {
		echo "<script>alert(\"".$regok."\");</script>";
		exit;
	} else {
		$userinfo = user::getinfo($uid);
	}
}
$params = ForwardGame($userinfo['ag_zr_username'],$userinfo['ag_zr_pwd'],"1");
if ($params=="" || $params=="error") {
	echo "<script>alert('登陆失败，请检查网络线路！');</script>";
	exit;
}
$key = md5($params.$md5key);
$loginurl = $giurl."/".$formfile;
?>
<form name="agform" id="agform" method="post" action="<?=$loginurl?>" style="display:none;"> 
	<input name="params" type="text" value="<?=$params?>"> 
	<input name="key" type="text" value="<?=$key?>">
</form>
<script language="javascript">
	document.getElementById("agform").submit();
</script>
</body>
</html>