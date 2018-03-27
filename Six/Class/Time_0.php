<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");

//开始读取期数
$sql = "select * from c_auto_0 where opentime<='".date("Y-m-d H:i:s", $lottery_time)."' and endtime>='".date("Y-m-d H:i:s", $lottery_time)."' order by id asc limit 1";

$query = $mysqli->query($sql);
$qs = $query->fetch_array();
///echo json_encode($sql);
if($qs) {
	$qishu = $qs['qishu'];
	$close = strtotime($qs['endtime']) - $lottery_time;
    $kj_time = $qs['datetime'];
} else {
	$qishu = -1;
	$close = -1;
    $kj_time = -1;
}

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7 from c_auto_0 where ok=1 order by qishu desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'number' => $qishu,
    'close' => $close,
    'kj_time' => $kj_time,
    'kj_list' => $kj_list
);
echo json_encode($result);