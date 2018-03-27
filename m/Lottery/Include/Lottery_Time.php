<?php
/*********************************彩票時間*********************************************/
$lottery_time = time();
//date_default_timezone_set('PRC');
//$lottery_time = time();
$l_time=date("Y-m-d H:i:s",$lottery_time);
$l_date=date("Y-m-d",$lottery_time);
/*********************************時時彩時間*********************************************/
$lottery_ssc_time = time();
//$lottery_ssc_time = time();
$ssc_time=date("H:i:s",$lottery_ssc_time);
/*********************************彩票美东時間*********************************************/
function mdtime($md_time){
	$meidong_time = strtotime($md_time);
	$md_times=date("Y-m-d H:i:s",$meidong_time);
	return $md_times;
	}
function mdssc($md_ssc){
	$meidong_ssc = strtotime($md_ssc);
	$md_sscs=date("Y-m-d",time())." ".date("H:i:s",$meidong_ssc);
	return $md_sscs;
	}
function bjssc($bj_ssc){
	$beijing_ssc = strtotime($bj_ssc);
	$bj_sscs=date("Y-m-d",time())." ".date("H:i:s",$beijing_ssc);
	return $bj_sscs;
	}
?>