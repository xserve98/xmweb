<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");
include_once("../../include/mysqli.php");

$ok			=	$_GET["ok"];
$m_id		=	$_GET["id"];
$msg		=	'操作失败';
if($ok==1){ //充值成功
	$sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单手工操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 == 2){
			$mysqli->commit(); //事务提交
			$msg	=	'操作成功';
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"审核了编号为".$m_id."充值成功");
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}else{
	$sql	=	"update k_money set status=0,about='该订单手工操作失败',balance=assets where k_money.m_id=$m_id and k_money.`status`=2";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit(); //事务提交
			$msg	=	'操作成功';
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"审核了编号为".$m_id."充值失败");
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}

message($msg,$_SERVER['HTTP_REFERER']);
?>