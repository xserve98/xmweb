<?php
include_once("../common/login_check.php"); 
check_quanxian("cwgl");
include_once("../../include/mysqli.php");

$id     = $_GET["id"];
$status = $_GET["status"];
$sql	= "";
$num	= 0;

if($status == "1"){
	$sql	=	"update k_user,huikuan set k_user.money=k_user.money-huikuan.money-huikuan.zsjr,huikuan.status=0,huikuan.balance=k_user.money-huikuan.money-huikuan.zsjr where k_user.uid=huikuan.uid and huikuan.id=$id and huikuan.status=1";
	$num	=	2;
}else{
	$sql	=	"update huikuan set status=0,balance=assets where id=$id and status=2";
	$num	=	1;
}

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1 == $num){
		$mysqli->commit(); //事务提交
		
		include_once("../../class/admin.php");
		admin::insert_log($_SESSION["adminid"],"重新审核了编号为".$id."的汇款单");
		message('操作成功','huikuan.php?status=0');
	}else{
		$mysqli->rollback(); //数据回滚
		message('操作失败');
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message('操作失败');
}
?>