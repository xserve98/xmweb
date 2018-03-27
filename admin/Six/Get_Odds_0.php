<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include ("../../include/mysqli.php");
$type 		= $_REQUEST['type'];
//开始读取赔率
$sql		= "select * from c_odds_0 where type='ball_".$type."' order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<77; $i++){
			$list[$i] = $odds['h'.$i];
		}
}
$arr = array(   
	'oddslist' => $list,    
);
if($type==16){
	$sql		= "select * from c_odds_0 where type='ball_18'";
	$query		= $mysqli->query($sql);
	$fs = $query->fetch_array();
	$arr['fs']=$fs['h1'];
}
if($type==17){
	$sql		= "select * from c_odds_0 where type='ball_18'";
	$query		= $mysqli->query($sql);
	$fs = $query->fetch_array();
	$arr['fs']=$fs['h2'];
}
$json_string = json_encode($arr);   
echo $json_string; 
?> 