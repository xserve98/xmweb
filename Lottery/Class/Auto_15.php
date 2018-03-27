<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/auto_fun.php");
include ("../include/auto_class.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];
$ball = intval($_REQUEST['ball']);
$cqssc = array('单', '双', '大', '小');
$cqssc_a = array('总和单', '总和双', '总和大', '总和小', '龙', '虎', '和');

$stime=date('Y-m-d',time())." 00:00:00";
$etime=date('Y-m-d',time())." 23:59:59";
//用户输赢
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
$date = "datetime >= '$startDate' and datetime <= '$endDate'";
$sql = "select ball_1,ball_2,ball_3,ball_4,ball_5 from c_auto_15 where $date and ok=1  order by id asc";
//echo $sql;
$query = $mysqli->query($sql);
$history = array();
while($row = $query->fetch_row()) {
    $history[] = $row;
}
$tj = null;
//路珠
if($ball == 0) {
    $luzhu[] = OpenNumberLuZhu($history, NULL, 5, 1); //总和大小
    $luzhu[] = OpenNumberLuZhu($history, NULL, 6, 1); //总和单双
    $luzhu[] = OpenNumberLuZhu($history, NULL, 2, 2); //龙虎和
} elseif($ball == 6) {
    $luzhu[] = OpenNumberLuZhu($history, 1, 0, -1);
    $luzhu[] = OpenNumberLuZhu($history, 2, 0, -1);
    $luzhu[] = OpenNumberLuZhu($history, 3, 0, -1);
    $luzhu[] = OpenNumberLuZhu($history, 4, 0, -1);
    $luzhu[] = OpenNumberLuZhu($history, 5, 0, -1);
} elseif($ball > 0 && $ball < 6) {
    $tj = OpenNumberCount($history, $ball); //统计
    $luzhu[] = OpenNumberLuZhu($history, $ball, 0, -1);
    $luzhu[] = OpenNumberLuZhu($history, $ball, 3, 0);
    $luzhu[] = OpenNumberLuZhu($history, $ball, 4, 0);
    $luzhu[] = OpenNumberLuZhu($history, null, 5, 1);
    $luzhu[] = OpenNumberLuZhu($history, null, 6, 1);
    $luzhu[] = OpenNumberLuZhu($history, null, 2, 2);
}
//长龙
$cl_arr = OpenNumberChangLong($cqssc, $cqssc_a, $history);

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5 from c_auto_15 where ok=1 order by qishu desc limit 10";
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