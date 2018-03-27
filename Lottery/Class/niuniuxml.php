<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");

//开始读取期数
$sql		= "select * from c_opentime_25 where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();


if($qs['qishu']>1){
     $qishu		= date("Ymd",$lottery_time).BuLings($qs['qishu'])-1;
     $time=date("Y-m-d",$lottery_time).' '.$qs['kaipan'];
}else{
	
	 $qishu		= date("Ymd",strtotime('-1 days')).'720';
	 $time=date("Y-m-d",$lottery_time).' '.'00:00:00';
	
	}

$sz=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51);
shuffle($sz);
     $ball_1=$sz[0].','.$sz[1].','.$sz[2].','.$sz[3].','.$sz[4];
	 $ball_2=$sz[5].','.$sz[6].','.$sz[7].','.$sz[8].','.$sz[9];
	 $ball_3=$sz[10].','.$sz[11].','.$sz[12].','.$sz[13].','.$sz[14];
	 $ball_4=$sz[15].','.$sz[16].','.$sz[17].','.$sz[18].','.$sz[19];
	 $ball_5=$sz[20].','.$sz[21].','.$sz[22].','.$sz[23].','.$sz[24];
$code=$ball_1.";".$ball_2.";".$ball_3.";".$ball_4.";".$ball_5;


header('Content-type: application/xml');
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$qishu.'" opencode="'.$code.'" opentime="'.$time.'"/></xml>';




/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
/*
数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
*/
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}
?> 