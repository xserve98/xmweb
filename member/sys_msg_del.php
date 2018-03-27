<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");

$msg_id = intval($_GET["id"]);
if($msg_id<0){
	$mysqli->query("delete from k_user_msg where uid=".intval($_SESSION["uid"]));
}else{	
	$mysqli->query("delete from k_user_msg where msg_id=$msg_id and uid=".intval($_SESSION["uid"]));	
}

echo "<script type='text/javascript' src='images/member.js'></script>"; 
echo "<script>Go('sys_msg.php');</script>"; 
unset($db);
?>