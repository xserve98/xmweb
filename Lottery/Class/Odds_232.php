<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include ("../../cache/website.php");

//开始读取赔率
$sql = "select * from c_odds_23 order by id asc";
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
$sql = "select * from c_opentime_23 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";


$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$fixno = $web_site['xjp28_knum']; //2013-06-30最后一期
$daynum = floor(($lottery_time-strtotime($web_site['xjp28_ktime']." 00:00:00"))/3600/24)-1;
$lastno = $daynum*660 + $fixno;


if($qs){
	$qishu		= $lastno + $qs['qishu'];
	$fengpan1	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
	$kaijiangdate1= date("Y-m-d",$lottery_time).' '.$qs['kaijiang'];
	$kaijiang2	= date('Y-m-d H:i:s', strtotime($qs['kaijiang'])+2*60);
	if($fengpan1<0){
			$fengpan=0;
			}else{
					$fengpan=$fengpan1;	
				}
}else{


$sql= "select * from c_opentime_23 where kaipan>'".date("H:i:s",$lottery_time)."'  order by id asc";

	$query		= $mysqli->query($sql);
	$qs		= $query->fetch_array();
if($qs){
	$qishu		= $lastno + $qs['qishu'];
	$fengpan1	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
	$kaijiangdate1= date("Y-m-d",$lottery_time).' '.$qs['kaijiang'];
	$kaijiang2	= date('Y-m-d H:i:s', strtotime($qs['kaijiang'])+2*60);
	
	if($fengpan1<0){
			$fengpan=0;
			}else{
					$fengpan=$fengpan1;	
				}
	}else{
		$qishu		= -1;
		$fengpan	= -1;
		$kaijiang	= -1;
	}
	
	
}
$arr = array(
    'number' => $qishu,
    'endtime' => $fengpan,
    'opentime' => $kaijiang,
    'oddslist' => $list,
);
$json_string = json_encode($arr);
echo $json_string;