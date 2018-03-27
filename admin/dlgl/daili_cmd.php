<?php
include_once("../common/login_check.php"); 
check_quanxian("dlgl"); 
include_once("../../include/mysqli.php");
include_once("../../include/config.php");

$status		=	intval($_GET["status"]);
$did		=	intval($_GET["did"]);
$uid		=	intval($_GET["uid"]);

if($status==1){//同意成为代理
	$sql	=	"update k_user set is_daili=1 where uid=$uid and is_daili=0";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		$sql	=	"update k_user set dl_pwd=qk_pwd where uid=$uid and is_daili=1";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		if($q1==1 && $q2==1){
			$mysqli->commit(); //事务提交
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"用户ID".$uid."获得本网代理资格");
			
			include_once("../../class/user.php");
			user::msg_add($uid,$web_site['reg_msg_from'],'恭喜您成为'.$web_site['web_name'].'代理',"您的代理申请已获得".$web_site['web_name']."的批准！<br><br><span onclick=\"javascript:Go('agent.php');return false;\" style=\"color:#0000FF; cursor:pointer;\">&gt;&gt;请点击这里获取推广代码</span>");
		}else{
			$mysqli->rollback(); //数据回滚
			message('操作失败，该会员原来已经属于本网代理');
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('操作失败，该会员原来已经属于本网代理');
	}
}else{ //不同意成为代理
	include_once("../../class/admin.php");
	admin::insert_log($_SESSION["adminid"],"不批准用户ID".$uid."成为本网代理");
	
	include_once("../../class/user.php");
	user::msg_add($uid,$web_site['reg_msg_from'],'对不起，您的代理申请被驳回了','请检查您的申请信息是否真实，内容是否具有足够的吸引力！');
}

$msg	=	'操作失败';
$sql	=	"update k_user_daili set status=$status where d_id=$did";
$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1 == 1){
		$mysqli->commit(); //事务提交
		$msg	=	'操作成功';
	}else{
		$mysqli->rollback(); //数据回滚
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
}

message($msg,'daili.php?1=1');
?>