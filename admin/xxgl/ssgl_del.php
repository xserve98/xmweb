<?php
include_once("../common/login_check.php"); 
check_quanxian("xxgl");
include_once("../../include/mysqli.php");
$arr	=	$_POST["id"];
$id		=	'';
foreach($arr as $k=>$v){
	$id	.=	$v.',';
}
if($id){
	$id	=	rtrim($id,',');
	$mysqli->query("update ban_ip set is_jz=0 where id in ($id)");
}
header("location:ssgl.php");
exit;
?>