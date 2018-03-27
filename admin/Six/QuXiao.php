<?
header("Content-type: text/html; charset=utf-8");
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
$id = $_REQUEST['id'];
$sql	=	"select * from c_bet where id=".$id." limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
$money	=	$rows['money'];
$uid	=	$rows['uid'];
$sql_1	=	"update c_bet set win=0,js=2 where id=".$id." and js=0";
$mysqli->query($sql_1);
$q1		=	$mysqli->affected_rows;
$sql_2	=	"update k_user set money=money+".$money." where uid=".$uid;
$mysqli->query($sql_2);
$q2		=	$mysqli->affected_rows;
$sql_3	=	"Insert Into k_user_msg (msg_from,uid,msg_title,msg_info,msg_time) values ('结算中心',".$uid.",'彩票注单".$id."取消','您下注的彩票注单".$id."，已被取消，投注金额已经退还到您的账户！','".date("Y-m-d H:i:s")."')";
$mysqli->query($sql_3);
$q3		=	$mysqli->affected_rows;
if($q1=1 && $q2=1 && $q3=1){
	$msg = '操作成功';
}else{
	$msg = '操作失败';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>取消注单</title>
<script language="javascript">
function refash()
{
var win = top.window;
 try{// 刷新.
  	if(win.opener)  win.opener.location.reload();
 }catch(ex){
  // 防止opener被关闭时代码异常。
 }
  window.close();
}
</script>
</head>
<body>
<?php
echo "<script>alert('".$msg."'),refash();</script>";
?>
</body>
</html>