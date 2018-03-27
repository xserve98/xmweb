<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");

$sql	=	"select x_result from t_guanjun where x_id=".$_GET["xid"]." limit 1"; //先取出原来的结果
$query	=	$mysqlis->query($sql);
$rows	=	$query->fetch_array();
$result	=	$rows["x_result"];

$sql	=	"select team_name from t_guanjun_team where tid=".$_GET["tid"]." limit 1"; //取出要添加上去的结果
$query	=	$mysqlis->query($sql);
$rows	=	$query->fetch_array();
if($result) $result .= '<br>'.$rows['team_name']; //两个以上的结果
else $result = $rows['team_name']; //未设置结果

$sql	=	"update t_guanjun set x_result='$result' where x_id=".$_GET["xid"];
$mysqlis->query($sql);
if($mysqlis->affected_rows == 1){
	include_once("../../class/admin.php");
	admin::insert_log($_SESSION["adminid"],"设置了金融冠军赛事结果，金融冠军项目ID,".$_GET["xid"]);
}
header("location:".$_SERVER['HTTP_REFERER']);
?>