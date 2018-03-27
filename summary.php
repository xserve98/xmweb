<?php
include_once("./include/config.php");
include_once("./common/login_check.php");
include_once("./common/logintu.php");
include_once("./include/mysqli.php");
include_once("./include/newpage.php");
include_once("./class/user.php");
include_once("./common/function.php");
$uid = $_SESSION['uid'];
$sql = "select SUM(money) as a from c_bet where uid=$uid and js=0";
$query	=	$mysqli->query($sql);
if($result = $query->fetch_array()){
	$summary = $result['a'];
}else{
	$summary = 0;
}
echo number_format($summary,2,'.','');