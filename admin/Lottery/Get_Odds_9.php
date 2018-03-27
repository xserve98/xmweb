<?php
include_once("../common/login_check.php"); 
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
$type 		= $_REQUEST['type'];
//开始读取赔率
$sql		= "select * from c_odds_9 where type='ball_".$type."' order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<15; $i++){
			$list[$i] = $odds['h'.$i];
		}
}
$arr['oddslist'] = $list;   

$sql		= "select * from c_odds_9_b where type='ball_".$type."' order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<15; $i++){
			$list[$i] = $odds['h'.$i];
		}
}
$arr['oddslistb'] = $list;   

$sql		= "select * from c_odds_9_c where type='ball_".$type."' order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<15; $i++){
			$list[$i] = $odds['h'.$i];
		}
}
$arr['oddslistc'] = $list;   



$json_string = json_encode($arr);   
echo $json_string; 
?> 