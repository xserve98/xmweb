<?php
session_start();
header("Content-Type:text/html; charset=utf-8"); 
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");
/*
$yzm	=	htmlEncode(strtolower($_POST["vcode"]));
if($yzm != $_SESSION["randcode"]) {
	message('您输入的验证码有误!');
}*/
    $sql2	=	"select * from web_config "; //要是代理
	$query2	=	$mysqli->query($sql2);
	$rs2		=	$query2->fetch_array();
    $fdjishu    =   $rs2["fdjishu"];
	$fandian    =   $rs2["fandian"];
	if($rs2["regoff"]==1){
		$money =$rs2["regmoney"];
	
		}else{
		$money =0;	
			
		}



//$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码

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
$mobile		=	htmlEncode($_POST["mobile"]);
$email		=	htmlEncode($_POST["wechat"]);
$qq		=	htmlEncode($_POST["qq"]);

$zfb		=	htmlEncode($_POST["zfb"]);

$jsr		=	htmlEncode($_POST["jsr"]);
$is_stop	=	0;
$gid		=	1;
$pankou='A';
$logintime	=	date("Y-m-d H:i:s");
if(!$username || !$password || !$pay_name || !$qkpwd) {
	//exit("if(!$username || !$password || !$qkpwd || !$ask || !$answer || !$birthday || !$mobile || !$pay_name){");
	message('请填写完整表单!');
}

if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/",$username)){
	message('用户名只能为3-20位的字母数字下划线组合！');
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
	$sql	=	"select * from k_user where uid=$top_uid and is_daili=1 limit 1"; //要是代理
	$query	=	$mysqli->query($sql);
	$q5		=	$mysqli->affected_rows;
	$rs		=	$query->fetch_array();
    $parents    =   $rs["parents"];
}

include_once("ip.php");
$address	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市


$sql		=	"insert into k_user(username,password,qk_pwd,money,ask,answer,sex,birthday,mobile,qq,email,reg_ip,login_ip,login_time,pay_name,is_daili,fandian,fdjishu,top_uid,parents,agents,is_stop,gid,lognum,reg_address,zfb,ag_zr_is,dltype) values ('$username','$password','$qkpwd','$money','$ask','$answer','$sex','$birthday','$mobile','$qq','$email','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."','$logintime','$pay_name',0,$fandian,$fdjishu,'$top_uid','$parents','$jsr',$is_stop,$gid,1,'$address','$zfb',0,'$dltype')";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id; 
	$time	=	time();
	include_once("cache/conf.php");
if($rs2["regoff"]==1){	
	////////////添加资金开奖记录////////
	$uid =$id;	
	$about   = '注册派送彩金 '.$money.' 元';
	$order = date("Ymdhis",time());
	$assets2  =	$money;
    $money_type =400;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money.",1,'$order','$about',0,'$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////	
		}
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
			$_SESSION["pankou"]			=	$pankou;
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

	  if($q5>0){
		 $a=0;
		 $b=0;
		 $c=0;
		  
	  }else{
		  
		 $a=$rows['k_a_limit'];
		  $b=$rows['k_b_limit'];
		  $c=$rows['k_c_limit'];  
		  
	  }
	  


	  
	$sql	=	"insert into `k_send_back` (`k_type`,`uid`,`k_typename`,`k_wftype`,`k_a_limit`,`k_b_limit`,`k_c_limit`,`k_d_limit`,`k_e_limit`) VALUES ('".$rows['k_type']."','".$_SESSION["uid"]."','".$rows['k_typename']."','".$rows['k_wftype']."','$a','$b','$c','".$rows['k_d_limit']."','".$rows['k_e_limit']."')";
	
	
	$mysqli->query($sql);
	  
	  }	
	  
	  
	  
	  
	  
		
		///////////////////////////////
			echo "<script>alert(\"注册成功！\");top.location.href='/member/agreement';</script>";
			exit();
	}else{
		
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次注册失败。\\n请您稍候再试，或联系在线客服。");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message("由于网络堵塞，本次注册失败。\\n请您稍候再试，或联系在线客服。");
}
?>