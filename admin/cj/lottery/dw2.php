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

////////////////读取wishu//////////////////
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
		if($fengpan1<=0){
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
    'number' => $qs['qishu'], 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,
	'oddslist' => $lastno,    
);  
$json_string = json_encode($arr);   

$data=array();
$data[0]['num']=$qishu;
$data[0]['time']=$kaijiang;
$data[0]['open']=$kaijiang+20;
$data[0]['opendate']=$kaijiangdate1;
$data[1]['num']=$qishu+1;
$data[1]['time']=120;
$data[1]['open']=140;
$data[1]['opendate']=$kaijiang2;
/*[{"num":<?=$qishu?>,"time2":"<?=date('y-m-d h:i:s',$lottery_time)?>","time":<?=$fengpan?>,"open":<?=$kaijiang?>,"opendate":"<?=$kaijiangdate1?>"},{"num":<?=$qishu+1?>,"time2":"<?=date('y-m-d h:i:s',$lottery_time)?>","time":100,"open":120,"opendate":"<?=$kaijiang2?>"}]};*/



//返回数据
$result = array(
   
	"status"=>"ok",
	"data"=>$data,
);
echo json_encode($result);