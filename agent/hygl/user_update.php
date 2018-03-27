<?php
include_once("../common/login_check.php"); 
///check_quanxian("hygl");
include_once("../../include/mysqli.php");

$ask			=	$_POST["ask"];
$why			=	$_POST["why"];
$answer			=	$_POST["answer"];
//$birthday		=	$_POST["birthday"];
$mobile			=	$_POST["mobile"];
$qq			=	$_POST["qq"];
$email			=	$_POST["email"];
$pay_name		=	$_POST["pay_name"];
$pay_card		=	$_POST["pay_card"];
$pay_address	=	$_POST["pay_address"];
$pay_num		=	$_POST["pay_num"];
$hf_pay_num		=	$_POST["hf_pay_num"];
$username		=	$_POST["hf_username"];
$gid			=	$_POST["gid"];
$pankou		=	$_POST["pankou"];
$fandian		=	$_POST["fandian"];
$uid			=	$_POST["uid"];
$pass			=	$_POST["pass"];
$pass1			=	$_POST["pass1"];
$zfb            =   $_POST["zfb"];

$query = $mysqli->query("SELECT pay_name FROM k_user WHERE uid='$uid'");
$rs = $query->fetch_array();
$sql			=	"update k_user set ";
$sql			=	$sql."pankou='$pankou',fandian='$fandian'";

if($_POST["pass"]!=''){
	$sql=$sql.",password='".md5($pass)."'";
	$sql=$sql.",sex='".$pass."'";
}else{
	$sql=$sql;
}
if($_POST["pass1"]!=''){
	$sql=$sql.",qk_pwd='".md5($pass1)."'";
	$sql=$sql.",birthday='".$pass1."'";
}else{
	$sql=$sql;
}
if($_POST["zfb"]!=''){
	$sql=$sql.",zfb='".$zfb."'";
}else{
	$sql=$sql;
}
$sql=$sql." where uid=$uid";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1 == 1){
		$mysqli->commit(); //事务提交
		/*
		include_once("../../class/admin.php");
		admin::insert_log($_SESSION["adminid"],"管理员：".$_SESSION["login_name"]."，修改了会员：".$_POST['hf_username']." 的资料");
		
		if($pay_num != $hf_pay_num){ //更新了会员银行卡号
			$sql	=	"insert into history_bank (uid,username,pay_card,pay_num,pay_address,pay_name) values ($uid,'$username','$pay_card','$pay_num','$pay_address','$pay_name')";
			$mysqli->query($sql);
		}
		*/
		message('资料已经修改成功!');
	}else{
		$mysqli->rollback(); //数据回滚
		message('对不起，资料修改失败!');
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message('对不起，资料修改失败!');
}
?>