<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];

//用户输赢
$sql = "select round(SUM(money), 2) as yk from c_bet where type='香港六合彩' and uid='$uid'";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(win), 2) as yk from c_bet where type='香港六合彩' and uid='$uid' and win >= 0";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk'];
$sy = round($z_win - $z_money, 2);

//开始读取期数
$sql = "select * from c_auto_0 where opentime<='".date("Y-m-d H:i:s", $lottery_time)."' and endtime>='".date("Y-m-d H:i:s", $lottery_time)."' order by id asc limit 1";
$query = $mysqli->query($sql);
$qs = $query->fetch_array();
if($qs) {
	$qishu = $qs['qishu'];
	$close = strtotime($qs['endtime']) - $lottery_time;
    $kj_time = $qs['datetime'];
} else {
	$qishu = -1;
	$close = -1;
    $kj_time = -1;
}

//上期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7 from c_auto_0 where ok=1 order by id desc limit 1";
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