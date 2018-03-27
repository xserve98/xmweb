<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include ("../../cache/website.php");

if(21==1){
$st_time=strtotime("2014-10-09 13:04:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=180;$i++){
	echo $i."===";
	$sqls="select * from c_opentime_24 where qishu='$i'";
	echo $sqls;
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	if($rs['qishu']){
		$actiontime=date("H:i:s",$st_time);
		$fengpan=date("H:i:s", $st_time+4*60);
		$kaijiang=date("H:i:s", $st_time+5*60);
		$strSqls="UPDATE `c_opentime_24` SET `kaipan`='$actiontime',`fengpan`='$fengpan',`kaijiang`='$kaijiang' WHERE (`qishu`='".$rs['qishu']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		$st_time+=60*5;
	}
}}

//开始读取赔率
$pankou = $_SESSION['pankou'];

if($pankou=='A'){
	$sql		= "select * from c_odds_24 order by id asc";	
	//$sql		= "select * from c_odds_24_".strtolower($pankou)."order by id asc";	
	////echo $sql;
}else{
	
	$sql		= "select * from c_odds_24_".strtolower($pankou)." order by id asc";	
}
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
////echo $sql;exit;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<27; $i++){
			$list['ball'][$s][$i] = $odds['h'.$i];
		}
	$s++;
}
//开始读取期数
$sql		= "select * from c_opentime_24 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
//var_dump($sql);
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$fixno = $web_site['jssc_knum']; //2013-06-30最后一期
$daynum = floor(($lottery_time-strtotime($web_site['jssc_ktime']." 00:00:00"))/3600/24);
$lastno = ($daynum-1)*1440 + $fixno;

if($qs){
	$qishu		= $lastno + $qs['qishu'];
	$fengpan	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
}else{
	$sql		= "select * from c_opentime_24 where qishu=1";
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
    'number' => $qishu, 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,
	'oddslist' => $list,    
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