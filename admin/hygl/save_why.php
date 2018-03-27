<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");

if($_GET['action'] == 'save'){
	include_once("../../include/mysqli.php");
	$why	=	$_POST["why"];
	$uid	=	$_POST["hf_uid"];
	$sql	=	"update k_user set why='$why' where uid='$uid'";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit(); //事务提交
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"管理员：".$_SESSION["login_name"]."，修改了会员：".$_POST['hf_username']." 的备注信息");
			message('资料已经修改成功!','check_user.php?action=1&username='.$_POST['hf_username']);
		}else{
			$mysqli->rollback(); //数据回滚
			message('对不起，资料修改失败!','check_user.php?action=1&username='.$_POST['hf_username']);
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('对不起，资料修改失败!','check_user.php?action=1&username='.$_POST['hf_username']);
	}
}
?>