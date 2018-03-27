<?php
//ini_set('display_errors','yes');
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/auto_class.php");
include ("../include/lottery_time.php");
$ball 		= $_REQUEST['ball'];
//开始获取开奖号码，今日输赢
$sql		= "select * from c_auto_6 order by qishu desc limit 0,15";
$query		= $mysqli->query($sql);
$hm 		= $hms 		= $hmlist		= array();
$is=1;
$qishu='';
while ( $rs	= $query->fetch_array() ) {
	//print_r($rs);
	if($is==1){
		$qishu		= $rs['qishu'];
		$hm[]		= BuLing($rs['ball_1']);
		$hm[]		= BuLing($rs['ball_2']);
		$hm[]		= BuLing($rs['ball_3']);
		$hms[]		= Jsk3_Auto($hm,1);
		$hms[]		= Jsk3_Auto($hm,2);
		$hms[]		= Jsk3_Auto($hm,3);
	}
	$hmlist[$rs['qishu']][]	= BuLing($rs['ball_1']).','.BuLing($rs['ball_2']).','.BuLing($rs['ball_3']);
	$is++;
}
$arr = array(   
	'numbers' => $qishu, 
	'hm' => $hm, 
	'hms' => $hms, 
	'hmlist' => $hmlist, 
);
$json_string = json_encode($arr);   
echo $json_string; 
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/


function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
?>