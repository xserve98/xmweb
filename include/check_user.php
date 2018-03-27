<?
if(!isset($_SESSION["uid"],$_SESSION["username"]))
{
	echo "<script>alert(\"请先登录再进行操作\");window.open('/','_top');</script>";
	exit();
}else{
	$_SESSION["uid"]=intval($_SESSION["uid"]);
}
?> 
