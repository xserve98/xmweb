<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");

$username	=	htmlEncode($_POST["zcname"]);
$sql		=	"select username from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
if($rs['username']){
	message('用户名已经存在!');
}

$password	=	md5($_POST["passwdse"]);
$pay_name	=	htmlEncode($_POST["realname"]);
$qkpwd		=	md5($_POST["paypasswd"]);

$ask		=	htmlEncode($_POST["zcquestion"]);
$answer		=	htmlEncode($_POST["zcanswer"]);
$sex		=	htmlEncode($_POST["zcsex"]);
$mobile		=	htmlEncode($_POST["telphone"]);
$email		=	htmlEncode($_POST["qq"]);

$zfb		=	htmlEncode($_POST["zfb"]);

//$jsr		=	htmlEncode($_POST["jsr"]);
$is_stop	=	0;
$gid		=	1;

$logintime	=	date("Y-m-d H:i:s");
if(!$username || !$password || !$pay_name || !$qkpwd) {
	message('请填写完整表单!');
}

if(!preg_match("/^[a-zA-Z0-9_]{4,15}$/",$username)){
	message('用户名只能为4-15位的字母数字下划线组合！');
}

$top_uid	=	'';
if(isset($jsr)) { //用户有填写介绍人名称
	$sql	=	"select uid from k_user where username='$jsr' and is_daili=1 limit 1"; //要是代理
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	if(intval($rs["uid"])){ //会员名称正确
		setcookie('f',intval($rs["uid"]));
		$top_uid	=	intval($rs["uid"]);
	}else{
		$jsr = '';
	}
}
if(!$top_uid){
	$top_uid	=	intval($_COOKIE['f']);
}

include_once("ip.php");
$address	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市

$sql		=	"insert into k_user(username,password,qk_pwd,ask,answer,sex,birthday,mobile,email,reg_ip,login_ip,login_time,pay_name,top_uid,agents,is_stop,gid,lognum,reg_address,zfb,ag_zr_is) values ('$username','$password','$qkpwd','$ask','$answer','$sex','$birthday','$mobile','$email','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."','$logintime','$pay_name',$top_uid,'$jsr',$is_stop,$gid,1,'$address','$zfb',0)";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id; 
	$time	=	time();
	include_once("cache/conf.php");
	$sql	=	"insert into k_user_login (login_id,uid,login_time,is_login,www) VALUES ('$time_$id_$username',$id,'$time',1,'$conf_www')";
	$mysqli->query($sql);
	$q2		=	$mysqli->affected_rows;
	$sql	=	"insert into history_login (uid,username,ip,ip_address,login_time,www) VALUES ($id,'$username','".$_SERVER['REMOTE_ADDR']."','$address',now(),'$conf_www')";
	include_once("include/mysqlio.php");
	$mysqlio->query($sql);
	$q3		=	$mysqlio->affected_rows;
	
	if($q1 == 1 && $q2 == 1){
			$mysqli->commit(); //事务提交
		
			$_SESSION["uid"]			=	$id;
			$_SESSION["username"]		=	$username;
			$_SESSION["gid"]			=	$gid;
			$_SESSION["denlu"]			=	'one';
			$_SESSION['user_login_id']	=	$time.'_'.$id.'_'.$username;
			$sql="UPDATE k_user SET log_session='".$_SESSION['user_login_id']."' WHERE (uid='$id')";
			$mysqli->query($sql);
			user::msg_add($_SESSION["uid"],$web_site['reg_msg_from'],$web_site['reg_msg_title'],$web_site['reg_msg_msg']);
		
			echo "<script>alert(\"注册成功！\");location.replace('/');</script>";
			exit();
	}else{
		$mysqli->rollback(); //数据回滚
		message("注册失败，请稍候再试！");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message("注册失败，请稍候再试！");
}
?>