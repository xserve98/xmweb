<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

$msg		=	'';
$table		=	$_GET['table'];

if($table){
	$msg	=	'操作成功！';
	$sql	=	"truncate `$table`";
	$mysqli->query($sql);
}else{
	$msg	=	'参数错误！';
}

message($msg);
?>