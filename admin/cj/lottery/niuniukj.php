<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");

$uid = $_SESSION['uid'];

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
$sql = "select qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5 from c_auto_25 where ok=1  order by id desc limit 1";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

$code =$kj_list[0]['ball_1'].';'.$kj_list[0]['ball_2'].';'.$kj_list[0]['ball_3'].';'.$kj_list[0]['ball_4'].';'.$kj_list[0]['ball_5'];
//返回数据
$result = array(
    'issue' =>$kj_list[0]['qishu'],
    'open' => $kj_list[0]['datetime'],
	'code' => $code,
	'sum'=> 0,
	'zjnums'=> 0,
	'money'=> 0,
	"status"=>"ok",
);
echo json_encode($result);