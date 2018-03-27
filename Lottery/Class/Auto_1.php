<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include("../../include/config.php");
include ("../include/auto_class.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];
$ball = intval($_REQUEST['ball']);
$ball = intval($_REQUEST['ball']);
$stime=date('Y-m-d',time())." 00:00:00";
$etime=date('Y-m-d',time())." 23:59:59";
//用户输赢
$sql = "select round(SUM(win), 2) as yk from c_bet where addtime>= '$stime' and addtime<='$etime' and js=1 and uid='$uid' and win < 0";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(win), 2) as yk  ,round(SUM(money), 2) as yk2 from c_bet where addtime>= '$stime' and addtime<='$etime' and js=1 and uid='$uid' and win >= 0";


$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk']-$rs['yk2'];
$sy = round($z_win + $z_money, 2);

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10,ball_11,ball_12,ball_13,ball_14,ball_15,ball_16,ball_17,ball_18,ball_19,ball_20 from c_auto_1 where ok=1 order by qishu desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list
);
echo json_encode($result);