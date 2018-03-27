<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

$username		=	$_POST["hf_username"];
$uid			=	$_POST["uid"];
$top_uid		=	$_POST["top_uid"];
if ($top_uid=='0'){
	$agents='0';}
	else{
		$query = $mysqli->query("SELECT username FROM k_user WHERE uid='$top_uid'");
		$rs = $query->fetch_array();
		$agents = $rs['username'];
	}

$sql	=	"update k_user set ";
$sql	=	$sql."top_uid='$top_uid',agents='$agents'";
$sql    =   $sql." where uid=$uid";

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1 == 1){
		$mysqli->commit(); //事务提交
		
		include_once("../../class/admin.php");
		admin::insert_log($_SESSION["adminid"],"管理员：".$_SESSION["login_name"]."，修改了会员：".$_POST['hf_username']." 的代理商为".$agents);
		
		message('代理商修改成功!');
	}else{
		$mysqli->rollback(); //数据回滚
		message('对不起，代理商修改失败!');
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message('对不起，代理商修改失败!');
}
?>