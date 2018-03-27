<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
//开始读取赔率
$sql		= "select * from c_odds_0 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<87; $i++){
			$list['ball'][$s][$i] = $odds['h'.$i];
		}
	$s++;
}
$arr = array(   
	'oddslist' => $list,    
);  
$json_string = json_encode($arr);   
echo $json_string; 
$james=fopen("../Odds/6hc.html","w");
fwrite($james,$json_string);
fclose($james);
?> 