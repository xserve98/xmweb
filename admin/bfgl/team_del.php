<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");

$sql	=	'';
if($_GET['type'] == 1){
	$sql	=	"update t_guanjun set x_result=null where x_id=".$_GET["xid"];
}
$mysqlis->query($sql);
if($mysqlis->affected_rows == 1){
	include_once("../../class/admin.php");
	if($_GET['type'] == 1){
		admin::insert_log($_SESSION["adminid"],"清除了金融冠军赛事结果：".$_GET["xid"]);
	}
}
header("location:".$_SERVER['HTTP_REFERER']);
?>