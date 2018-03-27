<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");

$msg_id = intval($_GET["id"]);
if($msg_id<0){
	$mysqli->query("delete from k_user_msg where uid=".$_SESSION["uid"]);
}else{	
	$mysqli->query("delete from k_user_msg where msg_id=$msg_id and uid=".$_SESSION["uid"]);	
}

header("location:sys_msg.php");
unset($db);
?> 
