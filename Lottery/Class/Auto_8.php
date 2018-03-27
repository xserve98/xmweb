<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/auto_fun.php");
include ("../include/auto_class4.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];
$ball = $_REQUEST['ball'];
$xyft = array('单','双','大','小','龙','虎');
$xyft_a = array('龙','虎','冠亚和大','冠亚和小','冠亚和单','冠亚和双');

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

//两面长龙
if($l_time > $l_date . ' 04:10:59') {
    $date = str_replace('-', '', $l_date);
} else {
    $date = date('Ymd', $lottery_time - 3600 * 24);
}
$s_qishu = $date . '001';
$e_qishu = $date . '180';
$qishu = "qishu >= '$s_qishu' and qishu <= '$e_qishu'";
$sql = "select ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10 from c_auto_8 where $qishu and ok=1 order by id asc";
$query = $mysqli->query($sql);
$history = array();
while($row = $query->fetch_row()) {
    $history[] = $row;
}
$cl_arr = sum_ball_count_1_pk($xyft, $xyft_a, $history);
arsort($cl_arr);

//路珠
$luzhu[] = sum_str_s_pk($history, 8, 25, false, false, 6, 0); //冠亚和
$luzhu[] = sum_str_s_pk($history, 8, 25, false, false, 2, 0); //冠亚和大小
$luzhu[] = sum_str_s_pk($history, 8, 25, false, false, 4, 0); //冠亚和单双

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10 from c_auto_8 where ok=1 order by qishu desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list,
    'luzhu' => $luzhu,
    'cl_list' => $cl_arr
);
echo json_encode($result);