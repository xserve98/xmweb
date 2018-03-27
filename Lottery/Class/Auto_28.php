<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/auto_fun.php");
include ("../include/auto_class3.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];
$ball = intval($_REQUEST['ball']);
$gdsf = array('单', '双', '大', '小', '尾大', '尾小', '合数单', '合数双');
$gdsf_a = array('龙', '虎', '总和大', '总和小', '总和单', '总和双', '总和尾大', '总和尾小');

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

$startDate =date('Y-m-d H:i:s',strtotime("-1 day"));
$endDate = date('Y-m-d H:i:s',time());
$date = "datetime > '$startDate' and datetime < '$endDate'";
$sql = "select ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8 from c_auto_28 where $date and ok=1 order by id asc";
$query = $mysqli->query($sql);
$history = array();
while($row = $query->fetch_row()) {
    $history[] = $row;
}
$tj = null;
//路珠
if($ball >= 1 && $ball <= 8) {
    $qiu = $ball - 1;
    $tj = sum_ball_count($history, $qiu); //统计
    $luzhu[] = sum_str_s($history, $qiu); //第1-8号球-号码
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 3); //第1-8号球-大小
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 1); //第1-8号球-单双
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 5, NULL, 0); //第1-8号球-尾数大小
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 7, NULL, 0); //第1-8号球-合数单双
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 8); //第1-8号球-方位
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 9); //第1-8号球-中发白
}
$luzhu[] = sum_str_s($history, null, 25, false, false, 2, 0); //总和大小
$luzhu[] = sum_str_s($history, null, 25, false, false, 4, 0); //总和单双
$luzhu[] = sum_str_s($history, null, 25, false, false, 6, 0); //总和尾数大小
$luzhu[] = sum_str_s($history, null, 25, true); //龙虎
//长龙
$cl_arr = sum_ball_count_1($gdsf, $gdsf_a, $history, 2);

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8 from c_auto_28 where ok=1 order by qishu desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list,
    'tongji' => $tj,
    'luzhu' => $luzhu,
    'cl_list' => $cl_arr
);
echo json_encode($result);