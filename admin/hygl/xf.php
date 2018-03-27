<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

if(isset($_GET['uid']) && isset($_GET['money']) && isset($_GET['username'])){
	$un			=	$_GET['username'];
	$uid		=	$_GET['uid'];
	$money		=	$_GET['money'];
	$sql		=	"update `k_user` set money='$money' where uid='$uid'";
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1==1){
			$mysqli->commit(); //事务提交
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
	
	header("location:check_user.php?action=1&username=$un");
}
?>