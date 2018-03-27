<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("expires:0");
include_once("../mysqli.php");
function getData($code){
	global $qishu;
    global $hm;
	global $time;
	$api = 'http://kj.1680api.com/Open/CurrentOpenOne?code='.$code;
	$resource = file_get_contents($api);  
	$data = json_decode( $resource , 1 );
	$qishu = $data['c_t'];
	$hm = $data['c_r'];
	$time = $data['c_d'];
}
?>