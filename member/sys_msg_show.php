<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");

$sql	=	"update k_user_msg set islook=1 where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."'";
$mysqli->query($sql);

$sql	=	"select * from k_user_msg where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."' limit 1";
$query	=	$mysqli->query($sql);  		
$rows	=	$query->fetch_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 

</head>
<body>

			<?=str_replace("\r\n","<br />",$rows["msg_info"])?>
				
</body> 
</html>