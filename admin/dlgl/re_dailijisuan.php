<?php
include_once("../common/login_check.php");
check_quanxian("dlgl");
include_once("../../include/mysqli.php");

$num	=	0;
$r_id	=	'';
$arr	=	$_POST["r_id"];
foreach($arr as $k=>$v){
	$r_id	.=	$v.',';
	$num++;
}
$msg	=	'操作失败';
if($r_id){
	$r_id	=	rtrim($r_id,',');
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql	=	"delete from k_user_daili_result where r_id in($r_id)";
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		
		if($q1 == $num){
			$mysqli->commit(); //事务提交
			$msg	=	'操作成功';
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}

message($msg,$_SERVER['HTTP_REFERER']);
?>