<?php
include_once("../common/login_check.php");
check_quanxian("glygl");

$sql	=	"update sys_admin set is_login=0 where uid=".$_GET["id"];
$mysqlio->query($sql);
message('踢线成功','user.php');
?>