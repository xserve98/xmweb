<?php
//获取赔率
function lottery_odds($type,$ball,$h) {
	global $mysqli;
	$type = intval($type);
	$h = intval($h);
	$sql	=	"select * from c_odds_".$type." where type='".$ball."' limit 1";
	$query	=	$mysqli->query($sql);
	$t		=	$query->fetch_array();
	return $t["h".$h.""];
}

function lotteryk8_qishu($type) {
    global $lottery_time;
	$fixno = '757809';  //2016-02-27最后一期
	$web_site['kl8'] = '2016-05-06';
	$daynum = floor(($lottery_time-strtotime($web_site['kl8']." 00:00:00"))/3600/24);
	$lastno = ($daynum-1)*179 + $fixno - 1;
	global $mysqli;
	$l_time = $lottery_time;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$l_time)."' and kaijiang>='".date("H:i:s",$l_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return $qs['qishu']+$lastno;
	}else{
		return -1;
	}
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
		if($type==15){
			//var_dump(date("Ymd",$lottery_time).BuLingss($qs['qishu']));
			return date("Ymd",$lottery_time).BuLingss($qs['qishu']);
		}else{
			return date("Ymd",$lottery_time).BuLings($qs['qishu']);
		}
	} else {
        $day = $lottery_time;
		if($type == 2) {
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

function lottery_qishu9($type) {
	$type = intval($type);
    global $lottery_time;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where qishu=1 order by id asc";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs) {
	  if(date('H',$lottery_time)>20){$day=strtotime('+1 day',$lottery_time);}
	  else $day=$lottery_time;
	  $l_date=date("Y-m-d",$day);
	  $pk10_date = '2016-03-26';
	  $pk10_qi = 79;
	  $pk10_t = (strtotime($l_date)-strtotime($pk10_date))/86400;
	  $pk10_t = $pk10_t+$pk10_qi;
	  $pk10_t = $pk10_t > 100?$pk10_t:"0".$pk10_t;
	  return $type==10 ? date("y",$lottery_time).$pk10_t : date("Y",$lottery_time).$pk10_t;
	}else{
		return -1;
	}
	
}

//获取彩票期数
function lottery_qishu_6($type) {
	$type = intval($type);
    global $lottery_time;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return substr(date("Ymd",$lottery_time), 2,6).BuLings($qs['qishu']);
	}else{
		return -1;
	}
	
}

//获取快乐10分彩票期数
function lottery_qishu_3($type) {
	$type = intval($type);
    global $lottery_time;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return date("Ymd",$lottery_time).BuLing($qs['qishu']);
	}else{
		$nex_qi=($type==11) ? 14 : 1;
		$sql		= "select qishu from c_opentime_".$type." where qishu=$nex_qi";
		$query		= $mysqli->query($sql);
		$qs		= $query->fetch_array();
		if($qs){
			if(date('H',$lottery_time)>=22 && $type==3){$day=strtotime('+1 day',$lottery_time);}
			else $day=$lottery_time;
			return date("Ymd",$day).BuLing($qs['qishu']);
		}else{
			return -1;
		}
	}
}

//获取北京赛车PK拾期数
function lottery_qishu_4($type) {
	$type = intval($type);
	include ("../../cache/website.php");
    global $lottery_time;
    if($type==16){
		$fixno = $web_site['ampk_knum']; //2013-06-30最后一期
		$daynum = floor(($lottery_time-strtotime($web_site['ampk_ktime']." 00:00:00"))/3600/24);
		$lastno = ($daynum-1)*179 + $fixno;
	}else{
	    $fixno = $web_site['pk10_knum']; //2013-06-30最后一期
		$daynum = floor(($lottery_time-strtotime($web_site['pk10_ktime']." 00:00:00"))/3600/24);
		$lastno = ($daynum-1)*179 + $fixno;
	}
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return $lastno + $qs['qishu'];
	}else{
		$sql	=	"select qishu from c_opentime_".$type." where qishu=1 limit 1";
		$query	=	$mysqli->query($sql);
		$qs		=	$query->fetch_array();
		if($qs){
			return $lastno + $qs['qishu'];
		}else{
			return -1;
		}
	}
	
}

//获取幸运28期数
function lottery_qishu_12($type) {
    $type = intval($type);
    include ("../../cache/website.php");
    global $lottery_time;
    $fixno = $web_site['kl8_knum'];
    $daynum = floor(($lottery_time-strtotime($web_site['kl8_ktime']." 00:00:00"))/3600/24);
    $lastno = ($daynum-1)*179 + $fixno-1;
    global $mysqli;
    $sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' limit 1";
    $query	=	$mysqli->query($sql);
    $qs		=	$query->fetch_array();
    if($qs) {
        return $lastno + $qs['qishu'];
    } else {
        return -1;
    }
}

//获取加拿大28期数
function lottery_qishu_13($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://www.1680180.com/lottery/10041.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=10041");
    $arr = json_decode($html_data, true);
    $lastno = $arr['n_t'];
    if(!$lastno) {
        $curl->set_referrer("http://pc1666.com/jnd28/");
        $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
        $html_data = $curl->fetch_url("http://pc1666.com/jnd28/");
        preg_match_all('|GetRTime\(-?\d+?,([\s\S]+?)\)|', $html_data, $html_arr);
        $lastno = $html_arr[1][0];
        if(!$lastno) {
            return -1;
        }
    }
    return $lastno;
}

//判断会员额度是否大于投注总额
function user_money($username,$money) {
	global $mysqli;
	$sql	=	"select money from k_user where username='".$username."' limit 1";
	$query	=	$mysqli->query($sql);
	$user	=	$query->fetch_array();
	if($user['money']-$money>=0){
		$sql	=	"update k_user set money=money-$money where username='".$username."' limit 1";
		$mysqli->query($sql);
		return $user['money']-$money;
	}else{
		return -1;
	}
}

//数字补0函数，当数字小于10的时候在前面自动补0
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}

//数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}

function BuLingss ( $num ) {
	if ( $num<10 ) {
		$num = '000'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '00'.$num;
	}
	if ($num>99 && $num<1000) {
		$num = '0'.$num;
	}
	

function get_gameName($type) {
	$game=0;
	switch($type) {
		case 0 : $game='香港六合彩';break;
		case 1 : $game='北京快乐8';break;
		case 2 : $game='重庆时时彩';break;
		case 3 : $game='广东快乐10分';break;
		case 4 : $game='北京赛车PK拾';break;
		case 5 : $game='幸运28';break;
		case 6 : $game='江苏快3';break;
		case 7 : $game='天津时时彩';break;
		case 8 : $game='幸运飞艇';break;
		case 9 : $game='福彩3D';break;
		case 10 : $game='排列3';break;
		case 11 : $game='幸运农场';break;
		case 12 : $game='幸运28';break;
		case 13 : $game='加拿大28';break;
		case 14 : $game='新疆时时彩';break;
		case 15 : $game='极速时时彩';break;
		case 16 : $game='极速赛车';break;
	}
	return $game;
}

function get_gameType($type) {
	$game=0;
	switch($type) {
		case '香港六合彩' : $game=0;break;
		case '北京快乐8' : $game=1;break;
		case '重庆时时彩' : $game=2;break;
		case '广东快乐10分' : $game=3;break;
		case '北京赛车PK拾' : $game=4;break;
		//case '幸运28' : $game=5;break;
		case '江苏快3' : $game=6;break;
		case '天津时时彩' : $game=7;break;
		case '幸运飞艇' : $game=8;break;
		case '福彩3D' : $game=9;break;
		case '排列3' : $game=10;break;
		case '幸运农场' : $game=11;break;
		case '幸运28' : $game=12;break;
		case '加拿大28' : $game=13;break;
		case '新疆时时彩' : $game=14;break;
	}
	return $game;
}

function get_gamesmName($type) {
	$game=0;
	switch($type) {
		case 0 : $game='six';break;
		case 1 : $game='kl8';break;
		case 2 : $game='cqssc';break;
		case 3 : $game='gdklsf';break;
		case 4 : $game='pk10';break;
		case 5 : $game='xy28';break;
		case 6 : $game='jsk3';break;
		case 7 : $game='jxssc';break;
		case 8 : $game='xyft';break;
		case 9 : $game='3D';break;
		case 10 : $game='pl3';break;
		case 11 : $game='xync';break;
		case 12 : $game='xy28';break;
		case 13 : $game='jnd28';break;
		case 14 : $game='xjssc';break;
	}
	return $game;
}

function get_gameType_self() {
    $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
	$self_arr=explode(".",$php_self);
	$self_ar2r=explode("_",$self_arr[0]);
    return $self_ar2r[1];
}
?>