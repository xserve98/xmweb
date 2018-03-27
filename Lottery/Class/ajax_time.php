<?php
header('Content-Type:text/html; charset=utf-8');
//ini_set('display_errors','yes');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include_once("../../include/config.php");
//开始读取期数
$arr=array();
$game_arr=array('six','kl8','cqssc','gdklsf','pk10','xy28','jsk3','jxssc','xyft','3d','pl3','xync','xy28','jnd28','xjssc');
$k_time=date("H:i:s",$lottery_time);
$m=0;
for($i=0;$i<=14;$i++){
	if(intval($web_site[$game_arr[$i]])==1)
	{
		$arr[$m]['game']=$game_arr[$i];
		$arr[$m]['opentime']=-2; 
		$m++;
		continue;
	}
	if($i==5 || $i==6) continue;
	if($i==0){
		$sql		= "select datetime as kaijiang from c_auto_".$i." where opentime<='".date("Y-m-d H:i:s",$lottery_time)."' and datetime>='".date("Y-m-d H:i:s",$lottery_time)."' and ok=0 order by id desc";
		//echo $sql;
		$query		= $mysqli->query($sql);
		$qs		= $query->fetch_array();
		if($qs){$kaijiang	= strtotime($qs['kaijiang'])-$lottery_time;}else{$kaijiang	= -1;}
	}else{
		$sql		= "select kaijiang from c_opentime_".$i." where kaipan<='".$k_time."' and kaijiang>='".$k_time."' order by id asc";	
		$query		= $mysqli->query($sql);
		$qs		= $query->fetch_array();
		if($qs){
			$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
		}else{
			if($i==2){
				$sql		= "select kaijiang from c_opentime_".$i." where qishu=25";
				$day=$lottery_time;
			}elseif($i==7 || $i==3){
				$sql		= "select kaijiang from c_opentime_".$i." where qishu=1";
				if(date('H',$lottery_time)>=22){$day=strtotime('+1 day',$lottery_time);}
				else $day=$lottery_time;
			}elseif($i==9 || $i==10){
				$sql		= "select kaijiang from c_opentime_".$i." where qishu=1";
				if(date('H',$lottery_time)>20){$day=strtotime('+1 day',$lottery_time);}
				else $day=$lottery_time;
			}elseif($i==11){
				$sql		= "select kaijiang from c_opentime_".$i." where qishu=14";
				$day=$lottery_time;
			}else{
				$sql		= "select kaijiang from c_opentime_".$i." where qishu=1";
				$day=$lottery_time;
			}
			$query		= $mysqli->query($sql);
			$qs		= $query->fetch_array();
			if($qs){
				$kaijiang	= strtotime(date("Y-m-d",$day).' '.$qs['kaijiang'])-$lottery_time;
			}else{
				$kaijiang	= -1;
			}
		}
	}
	$arr[$m]['game']=$game_arr[$i];
	$arr[$m]['opentime']=$kaijiang; 
	$m++;
}

$json_string = json_encode($arr);   
echo $json_string; 
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
/*
数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
*/
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}
?> 