<?php
session_start();
include_once("../common/login_check.php"); 
header('Content-type: text/json; charset=utf-8');
$type	=	0;
if(strpos($_SESSION["quanxian"],'xtgl')){
	$dirfile	=	'../../'.$_POST['dirfile'];
	if(file_exists($dirfile)) $type = unlink($dirfile) ? 1 : 0; //删除文件
}
echo $type;
exit;
?>