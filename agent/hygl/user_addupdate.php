<?php
include_once("../common/login_check.php"); 
///check_quanxian("dlgl"); 
include_once("../../include/mysqli.php");
session_start();
$top_uid = $_SESSION["suid"];
$sql		=	"select parents from k_user where uid='$top_uid' limit 1";
$query		=	$mysqli->query($sql);
$rstop			=	$query->fetch_array();
$parents=$rstop['parents'];
$username	=	$_POST["username"];
$sql		=	"select username from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
if($rs['username']){
	message('用户名已经存在!');
}
$password	=	md5($_POST["password"]);

$cf_password	=	md5($_POST["cf_password"]);
if($password!=$cf_password){
	message('密码输入错误，请重新输入!');
}
$qkpwd		=	'';
$ask		=	'';
$answer		=	'';
$sex		=	$_POST["password"];
$birthday	=	'';
$mobile		=	'';
$email		=	'';
//2014-12-31 add
$zfb		=	'';

$jsr		=	'';
$is_daili   =   1;
$is_stop	=	0;
$pay_name	=	$_POST["truename"];
$gid		=	$_POST["gid"];
$dltype		=	$_POST["dltype"];
$mobile		=	$_POST["mobile"];
$qq		=	$_POST["qq"];
$wechat		=	$_POST["wechat"];
$logintime	=	date("Y-m-d H:i:s");
$pankou=$_POST["pankou"];

/* 正则表达式验证输入 2014.01.14 BEGIN */
if(!preg_match("/^[0-9a-zA-Z]{5,16}$/",$username)){
	message('您在网站的登录帐户，5-16个英文或数字组成');
}

include_once("../../ip.php");
$address	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市

$sql		=	"insert into k_user(username,password,ask,answer,sex,birthday,mobile,email,qq,pankou,parents,reg_ip,login_ip,login_time,pay_name,top_uid,agents,is_stop,gid,dltype,zhancheng,lognum,reg_address,zfb,ag_zr_is,is_daili) values ('$username','$password','$ask','$answer','$sex','$birthday','$mobile','$wechat','$qq','$pankou','".$parents."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."','$logintime','$pay_name',$top_uid,'$jsr',$is_stop,1,'$dltype','$zhancheng',1,'$address','$zfb',0,0)";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id; 
	$time	=	time();
	include_once("../../cache/conf.php");
	$sql	=	"insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time_$id_$username',$id,'$time',1,'$conf_www')";
	$mysqli->query($sql);
	$q2		=	$mysqli->affected_rows;
	////更新pasents///

	
	///
	$sql	=	"insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES ($id,'$username','".$_SERVER['REMOTE_ADDR']."','$address',now(),'$conf_www')";
	include_once("../../include/mysqlio.php");
	$mysqlio->query($sql);
	$q3		=	$mysqlio->affected_rows;
	
	if($q1 == 1 && $q2 == 1){
			$mysqli->commit(); //事务提交
			include_once("../../class/admin.php");			
			include_once("../../class/user.php");

			$sql = "insert into k_user_daili (uid,about,status,add_time) values ($id,'代理".$_SESSION['username']."从后台添加',1,'$logintime')";
			$mysqli->query($sql);
		
		if(strlen($parents)<1){
		$sql="UPDATE `k_user` SET parents=$id WHERE (`uid`='$id')";
			}else{
			$sql="UPDATE `k_user` SET  parents=concat(parents, ',', $id) WHERE (`uid`='$id')";
				}
			$mysqli->query($sql);
		
			//////////增加回水设置///
	  $sql='select * from k_send_back_default';
	  $query	=	$mysqli->query($sql);
      while ($rows = $query->fetch_array()) {	 
	$sql	=	"insert into `k_send_back` (`k_type`,`uid`,`k_typename`,`k_wftype`,`k_a_limit`,`k_b_limit`,`k_c_limit`,`k_d_limit`,`k_e_limit`) VALUES ('".$rows['k_type']."',$id,'".$rows['k_typename']."','".$rows['k_wftype']."','0','0','0','".$rows['k_d_limit']."','".$rows['k_e_limit']."')";
	$mysqli->query($sql);
	  
	  }	
		
		///////////////////////////////
	
			echo "<script>alert(\"会员添加成功!\");window.open('list.php?1=1','_self');</script>";
			exit();
	}else{
		
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次注册失败1。\\n请您稍候再试，或联系在线客服。");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message("由于网络堵塞，本次注册失败2。\\n请您稍候再试，或联系在线客服。");
}
?>