<?php
session_start();
header("Content-Type:text/html; charset=utf-8"); 
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");

function write_file($filename,$data,$method="rb+",$iflock=1){
	@touch($filename);
	$handle=@fopen($filename,$method);
	if($iflock){
		@flock($handle,LOCK_EX);
	}
	@fputs($handle,$data);
	if($method=="rb+") @ftruncate($handle,strlen($data));
	@fclose($handle);
	@chmod($filename,0777);
	if( is_writable($filename) ){
		return true;
	}else{
		return false;
	}
}
/////////////////清理旧的guest账号////
$date=date("Y-m-d").' '."00:00:00";
     $sql="select uid from k_user where guest=1 and reg_date<'$date'";
	  $query	=	$mysqli->query($sql);
      while ($rows = $query->fetch_array()) {	
      $scuid=	 $rows['uid'];  
	 
    $sql="DELETE FROM `k_send_back` WHERE  uid='$scuid'";
	$mysqli->query($sql);
	  
	  }	

$sql="DELETE FROM `k_user` WHERE  guest=1 and reg_date<'$date'";
$mysqli->query($sql);







//////////////////////////////





$username	=	htmlEncode($_POST["zcname"]);
$sql		=	"select username from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
if($rs['username']){
	$username='guest_'.rand(1000000,9999999);
}

$password	=	md5($_POST["passwdse"]);
$pay_name	=	htmlEncode($_POST["realname"]);
$qkpwd		=	md5($_POST["paypasswd"]);

$ask		=	htmlEncode($_POST["zcquestion"]);
$answer		=	htmlEncode($_POST["zcanswer"]);
$sex		=	htmlEncode($_POST["zcsex"]);
$mobile		=	htmlEncode($_POST["mobile"]);
$email		=	htmlEncode($_POST["wechat"]);
$qq		=	htmlEncode($_POST["qq"]);

$zfb		=	htmlEncode($_POST["zfb"]);

$jsr		=	htmlEncode($_POST["jsr"]);
$is_stop	=	0;
$is_daili=1;
$gid		=	1;
   $top_uid	=	0;
   $fandian=0;

$logintime	=	date("Y-m-d H:i:s");
if(!$username || !$password || !$pay_name || !$qkpwd) {
	//exit("if(!$username || !$password || !$qkpwd || !$ask || !$answer || !$birthday || !$mobile || !$pay_name){");
	message('请填写完整表单!');
}

if(!preg_match("/^[a-zA-Z0-9_]{6,15}$/",$username)){
	message('用户名只能为6-15位的字母数字下划线组合！');
}

$top_uid	=	'';
$parents    =   '';

	
///	echo $dltype;
	
/*
if(!$top_uid){
	$top_uid	=	intval($_COOKIE['f']);
	$sql	=	"select * from k_user where uid=$top_uid and is_daili=1 limit 1"; //要是代理
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
    $parents    =   $rs["parents"];
}*/



include_once("ip.php");
$address	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市


$sql		=	"insert into k_user(username,password,qk_pwd,money,ask,answer,sex,birthday,mobile,qq,email,reg_ip,login_ip,login_time,pay_name,is_daili,fandian,fdjishu,top_uid,parents,agents,is_stop,gid,lognum,reg_address,zfb,ag_zr_is,dltype,guest) values ('$username','$password','$qkpwd','2000','$ask','$answer','$sex','$birthday','$mobile','$qq','$email','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."','$logintime','$pay_name',0,0,0,'0','$parents','$jsr',$is_stop,$gid,1,'$address','$zfb',0,0,1)";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql) or die($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id; 
	$time	=	time();
	include_once("cache/conf.php");
	

	////////////添加资金开奖记录////////
	$uid =$id;	
	$about   = '试玩账户注册派金'.$username.$rows['win'];
	$order = date("Ymdhis",time());
	$assets2  =	2000;
    $money_type =400;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$assets2.",1,'$order','$about',0,'$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////	
	$sql	=	"insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time_$id_$username',$id,'$time',1,'$conf_www')";
	$mysqli->query($sql);
	$q2		=	$mysqli->affected_rows;
	
	$sql	=	"insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES ($id,'$username','".$_SERVER['REMOTE_ADDR']."','$address',now(),'$conf_www')";
	include_once("include/mysqlio.php");
	$mysqlio->query($sql);
	$q3		=	$mysqlio->affected_rows;
	if($q1 == 1 && $q2 == 1){
			$mysqli->commit(); //事务提交
		    
			$_SESSION["uid"]			=	$id;
			$_SESSION["pankou"]			=	"A";
			$_SESSION["username"]		=	$username;
			$_SESSION["gid"]			=	$gid;
			$_SESSION["denlu"]			=	'one';
			$_SESSION['user_login_id']	=	$time.'_'.$id.'_'.$username;
			if(strlen($parents)<1){
		$sql="UPDATE `k_user` SET `log_session`='".$_SESSION['user_login_id']."'  , parents=$id WHERE (`uid`='$id')";
			}else{
					$sql="UPDATE `k_user` SET `log_session`='".$_SESSION['user_login_id']."'  , parents=concat(parents, ',', $id) WHERE (`uid`='$id')";

	
				}
			$mysqli->query($sql);
			user::msg_add($_SESSION["uid"],$web_site['reg_msg_from'],$web_site['reg_msg_title'],$web_site['reg_msg_msg']);
		
			//////////增加回水设置///
	  $sql='select * from k_send_back_default';
	  $query	=	$mysqli->query($sql);
      while ($rows = $query->fetch_array()) {	 
	$sql	=	"insert into `k_send_back` (`k_type`,`uid`,`k_typename`,`k_wftype`,`k_a_limit`,`k_b_limit`,`k_c_limit`,`k_d_limit`,`k_e_limit`) VALUES ('".$rows['k_type']."','".$_SESSION["uid"]."','".$rows['k_typename']."','".$rows['k_wftype']."','".$rows['k_a_limit']."','".$rows['k_b_limit']."','".$rows['k_c_limit']."','".$rows['k_d_limit']."','".$rows['k_e_limit']."')";
	$mysqli->query($sql);
	  
	  }	
		
		///////////////////////////////
		
		
		
	
		
			echo "<script>top.location.href='/index.php';</script>";
			exit();
	}else{
		
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次登陆失败。\\n请您稍候再试，或联系在线客服。");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message("由于网络堵塞，本次登陆失败。\\n请您稍候再试，或联系在线客服。");
}
?>