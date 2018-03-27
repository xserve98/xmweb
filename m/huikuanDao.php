<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/config.php");
include_once("common/function.php");
if($_SESSION["uid"]==""){
	message('请登录后再进行存款和提款操作','zhuce.php');
}
include_once("include/mysqli.php");
include_once("class/user.php");

$uid	=	$_SESSION["uid"];

if($_GET["into"]){
	$yzm=	strtolower($_POST["vlcodes"]);
	if($yzm!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入。");
	}else{
		$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
		
		$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
		$query	 =	$mysqli->query($sql);
		$rows	 =	$query->fetch_array();
		$assets	 =	$rows['money'];
		
		$money	 =	htmlEncode($_POST["v_amount"]);
		$bank	 =	htmlEncode($_POST["IntoBank"]);
		$date	 =	htmlEncode($_POST["cn_date"]);
		$date1	 =	$date." ".$_POST["s_h"].":".$_POST["s_i"].":".$_POST["s_s"];
		$manner	 =	htmlEncode($_POST["InType"]);
		$address =	htmlEncode($_POST["v_site"]);
		
		if($manner == "网银转账" || $manner == "支付宝转账"){
			$manner .=	"<br />持卡人姓名：".htmlEncode($_POST["v_Name"]);
		}
		if($manner == "0"){
			$manner	=	htmlEncode($_POST["IntoType"]);
		}
		
		$sql		=	"Insert Into `huikuan` (money,bank,date,manner,address,adddate,status,uid,lsh,assets,balance) values ($money,'$bank','$date1','$manner','$address',now(),0,'".$uid."','".$_SESSION['username'].'_'.date("YmdHis")."',$assets,$assets)";
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				message("恭喜您，汇款信息提交成功。\\n我们将近快审核，谢谢您对".$web_site['reg_msg_from']."的支持。","user/cha_huikuan.php?s_time=".$date."&e_time=".$date);
			}else{
				$mysqli->rollback(); //数据回滚
				message("对不起，由于网络堵塞原因。\\n您提交的汇款信息失败，请您重新提交。");
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message("对不起，由于网络堵塞原因。\\n您提交的汇款信息失败，请您重新提交。");
		}
	}
}
?>