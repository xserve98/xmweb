<?php
session_start();
header("Content-Type:text/html; charset=utf-8"); 
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");

function output_result($result) {
	echo $result;
	exit;
}

/*if($_COOKIE["red"] != null)
{
    output_result('二个小时内只能注册一次，请稍后再注册!');
}
*/

$yangzhengma	=	htmlEncode(strtolower($_POST["zcyzm"]));
if($yangzhengma!=	$_SESSION["randcode"]){
	output_result('您输入的验证码有误!');
}
$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码

$username	=	htmlEncode($_POST["zcname"]);
$sql		=	"select username from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();

if($rs['username']){
	output_result('用户名已经存在!');
}
$password	=	md5($_POST["zcpwd1"]);
$qkpwd		=	md5($_POST["qkpwd1"]);
$ask		=	htmlEncode($_POST["zcquestion"]);
$answer		=	htmlEncode($_POST["zcanswer"]);
$sex		=	htmlEncode($_POST["zcsex"]);
$birthday	=	htmlEncode($_POST["year"])."-".htmlEncode($_POST["maoth"])."-".htmlEncode($_POST["day"]);
$mobile		=	htmlEncode($_POST["zctel"]);
$email		=	htmlEncode($_POST["zcemail"]);
$jsr		=	htmlEncode($_POST["jsr"]);
$is_stop	=	0;
$pay_name	=	htmlEncode($_POST["zcturename"]);
$sql		=	"select username from k_user where pay_name='".$pay_name."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
if($rs['username']){
	output_result('持卡人姓名已经存在!');
}
$gid		=	1;

$logintime	=	date("Y-m-d H:i:s");
if(!$username || !$password || !$qkpwd || !$ask || !$answer || !$birthday || !$mobile  || !$pay_name){
	output_result('请填写完整表单!');
}
$top_uid	=	0;
$zongdaili_uid = 0;
$is_daili = 0;
$daili_mode = 0;
if(isset($jsr)){ //用户有填写介绍人名称
	$sql	=	"select uid from k_user where username='$jsr' and is_daili=1 limit 1"; //要是代理
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	if(intval($rs["uid"])){ //会员名称正确
		setcookie('f',intval($rs["uid"]));
		$top_uid	=	intval($rs["uid"]);
		if($_POST["type"] == "daili") {
		    $zongdaili_uid = $top_uid;
			$top_uid = 0;
			$is_daili = 1;
			$daili_mode = $_POST["daili_mode"];
		}
	}
}

include_once("ip.php");
$ipValue = $_SERVER["REMOTE_ADDR"];
if($_SERVER['HTTP_X_FORWARDED_FOR']!=null && $_SERVER['HTTP_X_FORWARDED_FOR']!="")
{
	$ipValue = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

$sql	=	"select count(*) as total from k_user where reg_ip ='$ipValue ' and TIMESTAMPDIFF( HOUR , reg_date, now( ) )<24  order by reg_date desc"; //重复ip判断
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if($rs["total"]>=2) {
	output_result('同一ip24小时内只能注册最多两次，请稍后再注册!');
}

$address	=	iconv("GB2312","UTF-8",convertip($ipValue));   //取出客户端IP所在城市

$sql		=	"insert into k_user(username,password,qk_pwd,ask,answer,sex,birthday,mobile,email,reg_ip,login_ip,login_time,pay_name,top_uid,is_stop,gid,lognum,reg_address) values ('$username','$password','$qkpwd','$ask','$answer','$sex','$birthday','$mobile','$email','".$ipValue."','".$ipValue."','$logintime','$pay_name',$top_uid,$is_stop,$gid,1,'$address')";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	//echo $sql;exit;
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id;
	$time	=	time();
	include_once("cache/conf.php");
	$sql	=	"insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time_$id_$username',$id,'$time',1,'$conf_www')";
	$mysqli->query($sql);

	$q2		=	$mysqli->affected_rows;
	$sql	=	"insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES ($id,'$username','".$_SERVER['REMOTE_ADDR']."','$address',now(),'$conf_www')";
	include_once("include/mysqlio.php");

	$mysqlio->query($sql);
	$q3		=	$mysqlio->affected_rows;
	
	if($q1 == 1 && $q2 == 1){
		
		$mysqli->commit(); //事务提交
		
		setcookie("red", "alert", time()+(2+12)*3600);
		
		$_SESSION["uid"]			=	$id;
		$_SESSION["username"]		=	$username;
		$_SESSION["gid"]			=	$gid;
		$_SESSION["denlu"]			=	'one';
		$_SESSION['user_login_id']	=	$time.'_'.$id.'_'.$username;
		$sql="UPDATE `k_user` SET `log_session`='".$_SESSION['user_login_id']."' WHERE (`uid`='$id')";
		$mysqli->query($sql);
		user::msg_add($_SESSION["uid"],$web_site['reg_msg_from'],$web_site['reg_msg_title'],$web_site['reg_msg_msg']);
		echo "OK";
		exit();
	}else{echo $q1.'=='.$q2;exit;
		$mysqli->rollback(); //数据回滚
		output_result("由于网络堵塞，本次注册失败。\\n请您稍候再试，或联系在线客服1。");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	output_result("由于网络堵塞，本次注册失败。\\n请您稍候再试，或联系在线客服2。");
}
?>