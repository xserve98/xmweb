<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include ("../../cache/website.php");
$pankou = $_SESSION['pankou'];

if($pankou=='A'){
	$sql		= "select * from c_odds_12 order by id asc";	
	//$sql		= "select * from c_odds_12_".strtolower($pankou)."order by id asc";	
	////echo $sql;
}else{
	
	$sql		= "select * from c_odds_12_".strtolower($pankou)." order by id asc";	
}
//开始读取赔率

$query = $mysqli->query($sql);
$list = array();
$s = 1;
while ($odds = $query->fetch_array()) {
    for ($i = 1; $i < 29; $i++) {
        $list['ball'][$s][$i] = $odds['h' . $i];
    }
    $s++;
}

//开始读取期数
$sql = "select * from c_opentime_1 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";


$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$fixno = $web_site['kl8_knum'];
$daynum = floor(($lottery_time-strtotime($web_site['kl8_ktime']." 00:00:00"))/3600/24);
$lastno = ($daynum-1)*179 + $fixno;

if($qs) {
    $qishu      = $lastno + $qs['qishu'];
    $fengpan	= strtotime(date("Y-m-d", $lottery_time) . ' ' . $qs['fengpan']) - $lottery_time;
    $kaijiang	= strtotime(date("Y-m-d", $lottery_time) . ' ' . $qs['kaijiang']) - $lottery_time;
} else {
    $qishu		= -1;
    $fengpan	= -1;
    $kaijiang	= -1;
}

$arr = array(
    'number' => $qishu,
    'endtime' => $fengpan,
    'opentime' => $kaijiang,
    'oddslist' => $list,
);
$json_string = json_encode($arr);
echo $json_string;