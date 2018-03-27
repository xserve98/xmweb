<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
header("Content-Type:text/html; charset=utf-8"); 
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("../../../cache/website.php");

$uid = $_SESSION['uid'];

$lottery_time = time();
//开始读取期数
$sql		= "select * from c_opentime_23 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();


$fixno = $web_site['xjp28_knum']; //2013-06-30最后一期
$daynum = floor(($lottery_time-strtotime($web_site['xjp28_ktime']." 00:00:00"))/3600/24);
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
	$sql		= "select * from c_opentime_23 where qishu=1";
	$query		= $mysqli->query($sql);
	$qs		= $query->fetch_array();
	if($qs){
		$qishu		= $lastno + $qs['qishu'];
		$fengpan1	= $lottery_time - strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan']);
		$kaijiang	= $lottery_time - strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang']);
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

$dqkj=$qishu-1;


//十期开奖结果
$sql = "select qishu,datetime,ball_1,ball_2,ball_3,ball_4 from c_auto_23 where qishu='$dqkj' order by id desc limit 1";

$query = $mysqli->query($sql);
$sum		= $mysqli->affected_rows;
if($sum>0){
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}
$code =$kj_list[0]['ball_1'].','.$kj_list[0]['ball_2'].','.$kj_list[0]['ball_3'];


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
}