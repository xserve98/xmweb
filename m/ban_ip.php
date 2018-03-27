<?php
session_start();
include_once("include/mysqli.php");
include_once("common/function.php");
$msg	=	'我不是有心的<br>我要申请解禁';
$yzm	=	$_POST["vlcodes"];

function getip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
	   $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	   $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	   $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	   $ip = $_SERVER['REMOTE_ADDR'];
   else
	   $ip = "unknown";
   return $ip;
}

if($yzm != $_SESSION["randcode"]){ 
	message("验证码错误，请重新输入。");
}else{
	$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码

	$ip		=	getip(); //取出当前用户ip
	$sql	=	"select id from ban_ip where ip='$ip' limit 1";
	$query	=	$mysqli->query($sql);  		
	$rs		=	$query->fetch_array();
	if($rs['id']){ //已禁ip，更新
		$sql	=	"update `ban_ip` set message='$msg' where ip='$ip'";
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				message("您的申诉信息已发送，我们将于1个小时内为您核查。\\n谢谢您对万丰国际的支持，禁止访问给您带来不便我们深表歉意。");
			}else{
				$mysqli->rollback(); //数据回滚
				message("由于网络堵塞，本次申请解禁失败。\\n请您稍候再试，或联系在线客服。");
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请解禁失败。\\n请您稍候再试，或联系在线客服。");
		}
	}
}
?>