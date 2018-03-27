<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];

//用户输赢
$sql = "select round(SUM(money), 2) as yk from c_bet where type='极速六合彩' and uid='$uid'";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(win), 2) as yk from c_bet where type='极速六合彩' and uid='$uid' and win >= 0";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk'];
$sy = round($z_win - $z_money, 2);

//开始读取期数
//$sql = "select * from c_auto_17 where opentime<='".date("Y-m-d H:i:s", $lottery_time)."' and endtime>='".date("Y-m-d H:i:s", $lottery_time)."' order by id asc limit 1";
$sql		= "select * from c_opentime_22 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";

//var_dump($sql);
$query = $mysqli->query($sql);
$qs = $query->fetch_array();
if($qs) {
	$qishu	= date("Ymd",$lottery_time).BuLings($qs['qishu']);
	$close	=   strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
	$kj_time = date("Y-m-d",$lottery_time).' '.$qs['kaijiang'];
} else {
	$qishu = -1;
	$close = -1;
    $kj_time = -1;
}

//上期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7 from c_auto_22 where ok=1 order by id desc limit 1";
$query = $mysqli->query($sql);
$kj_list = $query->fetch_assoc();

//返回数据
$result = array(
    'shuying' => $sy,
    'number' => $qishu,
    'close' => $close,
    'kj_time' => $kj_time,
    'kj_list' => $kj_list
);
echo json_encode($result);

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