<?php
header('Content-Type:text/html;charset=utf-8');
include_once("include/config.php");    
include_once("include/mysqli.php");
include_once("common/function.php");
$username	=	htmlEncode($_GET["username"]);        
$sql		=	"select uid from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);  		
$rs			=	$query->fetch_array();
if($rs['uid']){
	echo "n";
}else{
	echo "y";
}
exit;
?>