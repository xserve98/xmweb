<?php
session_start();
$sql	=	"update sys_admin set is_login=0 where is_login=1 and uid=".intval($_SESSION["adminid"]);
include_once("../include/mysqlio.php");
$mysqlio->query($sql);
session_destroy();
header("location:/");
?>