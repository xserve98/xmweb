<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>Welcome</title>
</head>
<body>
<?php
@session_start();

if (!isset($_SESSION["adminid"])) {
	echo "timeout";
	exit;
}

include_once("../include/config.php"); 
include_once("../include/mysqli.php");
include_once("../class/user.php");

$uid = intval($_GET['uid']);
$userinfo = user::getinfo($uid);

if (!$userinfo) {
	echo "0.00";
	exit;
}

include_once("include/agconfig.php");
include_once("include/curl_http.php");
include_once("include/commfunc.php");
include_once("agfunc.php");

$live_money = 0.00;
$needquery = true;

//检查并创建真人账号
if ($userinfo['ag_zr_is']=="0") {
	$regok = reg_liveuser($userinfo['username'],$uid,"1");
	if ($regok!="0") {
		$live_money = 0.00;
		$needquery = false;
	} else {
		$userinfo = user::getinfo($uid);
	}
}

//获取真人余额
if ($needquery) {
	$retmsg = get_balance($userinfo['ag_zr_username'],$userinfo['ag_zr_pwd'],$uid,"1");
	if ($retmsg[0]=="no") {
		$live_money = "---";
	} else {
		$live_money = sprintf("%.2f",$retmsg[1]);
	}
}

echo "$live_money";
?>
</body>
</html>