<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

$msg			=	'保存失败';

if($_GET['uid'] && $_GET['username']){
	$un			=	$_GET['username'];
	$uid		=	$_GET['uid'];
	$llje		=	$_POST['hf_llje'];
	$ckje		=	$_POST['hf_ckje'];
	$qkje		=	$_POST['hf_qkje'];
	$hkje		=	$_POST['hf_hkje'];
	$dsxz		=	$_POST['hf_dsxz'];
	$dsyy		=	$_POST['hf_dsyy'];
	$cgxz		=	$_POST['hf_cgxz'];
	$cgyy		=	$_POST['hf_cgyy'];
	$fs			=	$_POST['hf_fs'];
	
	$sql		=	"insert into k_um(uid,llje,ckje,qkje,hkje,dsxz,dsyy,cgxz,cgyy,fs,addtime) values ($uid,$llje,$ckje,$qkje,$hkje,$dsxz,$dsyy,$cgxz,$cgyy,$fs,now())";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$id 	=	$mysqli->insert_id;
		$q1		=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit(); //事务提交
			$msg=	'保存成功';
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"保存了会员".$uid."的核查记录：$id");
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}

message($msg,"check_user.php?action=1&username=$un");
?>