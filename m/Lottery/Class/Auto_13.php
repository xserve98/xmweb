<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");

$uid = $_SESSION['uid'];

//用户输赢
$sql = "select round(SUM(money), 2) as yk from c_bet where type='加拿大28' and uid='$uid'";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(win), 2) as yk from c_bet where type='加拿大28' and uid='$uid' and win >= 0";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk'];
$sy = round($z_win - $z_money, 2);

//上期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4 from c_auto_13 where ok=1 order by id desc limit 1";
$query = $mysqli->query($sql);
$kj_list = $query->fetch_assoc();

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list
);
echo json_encode($result);