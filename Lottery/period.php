<?php
header('Content-Type:text/html; charset=utf-8');
include ("../include/mysqli.php");
include ("include/lottery_time.php");
include ("../cache/website.php");
$lottery=$_GET['lottery'];
//echo $lottery;
//exit;
//开始读取赔率
if($lottery=='BJPK10'){
$sql		= "select * from c_odds_4 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<27; $i++){
			$list['ball'][$s][$i] = $odds['h'.$i];
		}
	$s++;
}
//开始读取期数
$sql		= "select * from c_opentime_4 where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$fixno = $web_site['pk10_knum']; //2013-06-30最后一期
$daynum = floor(($lottery_time-strtotime($web_site['pk10_ktime']." 00:00:00"))/3600/24);
$lastno = ($daynum-1)*179 + $fixno;
if($qs){
	$qishu		= $lastno + $qs['qishu'];
	$fengpan	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
}else{
	$sql		= "select * from c_opentime_4 where qishu=1";
	$query		= $mysqli->query($sql);
	$qs		= $query->fetch_array();
	if($qs){
		$qishu		= $lastno + $qs['qishu'];
        $fengpan    = $lottery_time - strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan']);
        $kaijiang   = $lottery_time - strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang']);
	}else{
		$qishu		= -1;
		$fengpan	= -1;
		$kaijiang	= -1;
	}
}
$arr = array(   
    'closeTime'=> strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan']),
    'number' => $qishu, 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,

);  
$json_string = json_encode($arr);   
echo $json_string; 
}else{
	
	//开始读取赔率
$sql		= "select * from c_odds_2 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<16; $i++){
		$list['ball'][$s][$i] = $odds['h'.$i];
	}
	$s++;
}
//开始读取期数
$sql		= "select * from c_opentime_2 where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();


if($qs){

	$qishu		= date("Ymd",$lottery_time).BuLings($qs['qishu']);
	$fengpan	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;

}
$arr = array( 
    'closeTime'=> strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])*1000,
	'drawDate' => strtotime(date("Y-m-d",$lottery_time))*1000,
    'drawNumber' => $qishu, 
	'drawTime' => strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])*1000,
	'openTime' => strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaipan'])*1000,
	'pnumber' => $qishu-1,
	"status" => 1
);  
$json_string = json_encode($arr);   
echo $json_string; 
	
	}
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