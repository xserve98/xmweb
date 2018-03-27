<?php
session_start();
header('Content-Type:text/html; charset=utf-8');

include_once("../../cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
include_once("../../include/mysqli.php");
$q = $_POST['q'];
$w = $_POST['w'];
$t = $_POST['t'];
$flag = $_POST['flag'];
$type = $_POST['type'];
/*$time1 = date("Y-m-d H:i:s",time()-12*60*60);
$date1 = explode(" ",$time1);
$stime = $date1[0]." 00:00:01";
$time2 = date("Y-m-d H:i:s",time()+12*60*60);
$date2 = explode(" ",$time2);
$etime = $date2[0]." 11:59:59";*/
$cp_qz = @$pk_db['号码总额'];
$cp_oz = @$pk_db['其他总额'];
if ($cp_qz > 0) {
	$max1 = $cp_qz;
}
else{
	$max1=5000;
}
if ($cp_oz > 0) {
	$max2 = $cp_oz;
}
else{
	$max2=8000;
}
switch($flag){
	case 0:
		$max = $max1;
		break;
	case 1:
		$max = $max2;
		break;
	default:
		$max = 5000;
}
switch($type){
	case 'pk':
		$data = 'c_bet';
		break;
	case 'ssc':
		$data = 'c_bet';
		break;
	default:
		$data = 'c_bet';
}
$sql   = "select sum(money) as alls from $data where mingxi_1='$q' and mingxi_2='$w' and qishu='$t'";
$query = $mysqli->query($sql);  		
$rs	   = $query->fetch_array();
if ($rs['alls']=='' || $rs['alls']==0) $cp_ze = $max; else $cp_ze = $max-$rs['alls'];
if ($cp_ze < 0) $cp_ze=0;
$arr = array(   
    'cp_ze' => $cp_ze
);
$json_string = json_encode($arr);   
echo $json_string; 
?>