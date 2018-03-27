<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
$page	=	$_GET["page"];
$go		=	$_GET["go"];
$arr	=	$_POST['uid'];
$uid	=	'';
$i		=	0; //会员个数
foreach($arr as $k=>$v){
	$uid .= $v.',';
	$i++;
}
$uid	=	rtrim($uid,',');
if($uid==''){

$sql = "delete from k_user where username LIKE 'guest%'";
}else{
	
$sql = "delete from k_user where uid in ($uid)";	
	}

$msg	=	'操作成功！';
$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1==$i){
		$mysqli->commit(); //事务提交
		$msg	=	'操作成功！';
	}else{
		$mysqli->rollback(); //数据回滚
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
}

message($msg,'listguest.php?page='.$page);
?>