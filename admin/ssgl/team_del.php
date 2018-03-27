<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("../../include/mysqlis.php");

$sql	=	'';
if($_GET['type'] == 2){
	$sql	=	"delete from t_guanjun_team where tid=".$_GET["tid"];
}
$mysqlis->query($sql);
if($mysqlis->affected_rows == 1){
	include_once("../../include/mysqlio.php");
	include_once("../../class/admin.php");
	if($_GET['type'] == 1){
		admin::insert_log($_SESSION["adminid"],"清除了金融冠军赛事结果：".$_GET["xid"]);
	}
}
header("location:".$_SERVER['HTTP_REFERER']);
?>