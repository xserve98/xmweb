<?php
//获取赔率
function lottery_odds($type,$ball,$h){
	global $mysqli;
	$type = intval($type);
	$h = intval($h);
	$sql	=	"select * from c_odds_".$type." where type='".$ball."' limit 1";
	$query	=	$mysqli->query($sql);
	$t		=	$query->fetch_array();
	return $t["h".$h.""];
}
//获取六合彩尾数连，生肖连赔率
//根据接收过来的数据查询赔率，取得最小的赔率然后返回
function six_odds($class,$type,$number){
	//class:13=生肖连 14=尾数连，type:4=五连 3=四连 2=三连 1=二连，number:数组传递的赔率所在位置
	global $mysqli;
	$sql	=	"select * from c_odds_0 where type='ball_".$class."'";
	$query	=	$mysqli->query($sql);
	$t		=	$query->fetch_array();
	if($class==14){
		$odds = 0;
		switch ($type)
		{
		case 1:
		  $zeng = 0;
		  break;
		case 2:
		  $zeng = 10;
		  break;
		case 3:
		  $zeng = 20;
		  break;
		case 4:
		  $zeng = 30;
		  break;
		default:
		  $zeng = 0;
		}
		for( $i=0; $i<count($number); $i++ ){
			if($t['h'.($number[$i] + $zeng)]>$odds){
				$odds = $t['h'.($number[$i] + $zeng)];
			}
		}

	}
	if($class==13){
		$odds = 10000;
		switch ($type)
		{
		case 1:
		  $zeng = 0;
		  break;
		case 2:
		  $zeng = 12;
		  break;
		case 3:
		  $zeng = 24;
		  break;
		case 4:
		  $zeng = 36;
		  break;
		default:
		  $zeng = 0;
		}
		for( $i=0; $i<count($number); $i++ ){
			if($t['h'.($number[$i] + $zeng)]<$odds){
				$odds = $t['h'.($number[$i] + $zeng)];
			}
		}

	}
	return $odds;
}
//获取彩票期数
function lottery_qishu($type) {
   	$type = intval($type);
	
    global $lottery_time;
	if($type==8 && date('H',$lottery_time)<5){
		$lottery_time=strtotime('-1 day',$lottery_time);
	}
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' limit 1";
	
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		return date("Ymd",$lottery_time).BuLings($qs['qishu']);
	} else {
        $day = $lottery_time;
		if($type == 22) {
			$sql = "select * from c_opentime_".$type." where qishu=25";
		} elseif($type == 7 || $type == 3) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 22) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 9 || $type == 10) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 20) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 8) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=132";
		} elseif($type == 11) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=14";
		} else {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
		}
		$query	=	$mysqli->query($sql);
		$qs		=	$query->fetch_array();
		if($qs) {
			return date("Ymd", $day) . BuLings($qs['qishu']);
		} else {
			return -1;
		}
	}
	
}
//判断会员额度是否大于投注总额
function user_money($username,$money){
	global $mysqli;
	$sql	=	"select money from k_user where username='".$username."' limit 1";
	$query	=	$mysqli->query($sql);
	$user	=	$query->fetch_array();
	if($user['money']-$money>0){
		$sql	=	"update k_user set money=money-$money where username='".$username."' limit 1";
		$query	=	$mysqli->query($sql);
		return $user['money']-$money;
	}else{
		return -1;
	}
	
}
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
	if ( $num>9 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}
/*
数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
*/
function arrdel ($arr1,$arr2){
	$cccc='';
	$arr3=array();
	foreach($arr1 as $s){
		foreach($arr2 as $x){
			if($s==$x){
				$cccc=$s;
			}
		}
	}
	foreach($arr2 as $t){
		if($cccc!=$t){
			$arr3[]=$t;
		}
	}
	return $arr3;
	
}
?>