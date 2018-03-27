<?php
//获取赔率
function lottery_odds($type,$ball,$h) {
	global $mysqli;
$uid = $_SESSION["uid"];
$sql="select pankou  from k_user where uid='$uid'";			
$query	 =	$mysqli->query($sql);
$prows =	$query->fetch_array();
$pankou = $prows["pankou"];
	$type = intval($type);
	$h = intval($h);
	
 if($pankou=='A'){
	$sql	=	"select * from c_odds_".$type." where type='".$ball."' limit 1";
}else{
	
	 $sql	=	"select * from c_odds_".$type.'_'.strtolower($pankou)." where type='".$ball."' limit 1";
}
	

	$query	=	$mysqli->query($sql);
    $sum		= $mysqli->affected_rows;
	$t		=	$query->fetch_array();
	if($sum<1){
	$sql	=	"select * from c_odds_".$type." where type='".$ball."' limit 1";
	$query	=	$mysqli->query($sql);
	$t		=	$query->fetch_array();	
		}
	
	
	return $t["h".$h.""];
}

function lotteryk8_qishu($type) {
    global $lottery_time;
	$fixno = '815963';  //2016-02-27最后一期
	$web_site['kl8'] = '2017-04-03';
	$daynum = floor(($lottery_time-strtotime($web_site['kl8']." 00:00:00"))/3600/24);
	$lastno = ($daynum-1)*179 + $fixno ;
	global $mysqli;
	$l_time = $lottery_time;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$l_time)."' and fengpan>='".date("H:i:s",$l_time)."' limit 1";
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
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		if($type==14){
				if(date('H',$lottery_time)<10){
					$lottery_time=strtotime('-1 day',$lottery_time);
					}
			
			}
		return date("Ymd",$lottery_time).BuLings($qs['qishu']);
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

//获取彩票期数
function lottery_qishuapp($type) {
	$type = intval($type);
    global $lottery_time;
	if($type==8 && date('H',$lottery_time)<5){
		$lottery_time=strtotime('-1 day',$lottery_time);
	}
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		return date("Ymd",$lottery_time).BuLings($qs['qishu']);
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
function lottery_qishu21($type) {
	$type = intval($type);
    global $lottery_time;
	if($type==8 && date('H',$lottery_time)<5){
		$lottery_time=strtotime('-1 day',$lottery_time);
	}
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		return date("Ymd",$lottery_time).BuLing2s($qs['qishu']);
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
			return date("Ymd", $day) . BuLing2s($qs['qishu']);
		} else {
			return -1;
		}
	}
	
}

function lottery_qishu_24($type) {
	$type = intval($type);
	include ("../../cache/website.php");
    global $lottery_time;
    $fixno = $web_site['jssc_knum']; //2013-06-30最后一期
    $daynum = floor(($lottery_time-strtotime($web_site['jssc_ktime']." 00:00:00"))/3600/24);
    $lastno = ($daynum-1)*1440 + $fixno;
	global $mysqli;
	$sql		= "select * from c_opentime_24 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";

	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return $lastno + $qs['qishu'];
	}else{
	return -1;
	}
	
}

function lottery_qishu_17($type) {
	$type = intval($type);
	include ("../../cache/website.php");
    global $lottery_time;
    $fixno = $web_site['jsxyft_knum']; //2013-06-30最后一期
    $daynum = floor(($lottery_time-strtotime($web_site['jsxyft_ktime']." 00:00:00"))/3600/24);
    $lastno = ($daynum-1)*1440 + $fixno;
	global $mysqli;
	$sql		= "select * from c_opentime_17 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";

	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return $lastno + $qs['qishu'];
	}else{
	return -1;
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
	  $pk10_date = '2017-02-03';
	$pk10_qi = 27;
	  $pk10_t = (strtotime($l_date)-strtotime($pk10_date))/86400;
	  $pk10_t = $pk10_t+$pk10_qi;
	  $pk10_t = $pk10_t > 100?$pk10_t:"0".$pk10_t;
	  return $type==10 ? date("Y",$lottery_time).$pk10_t : date("Y",$lottery_time).$pk10_t;
	}else{
		return -1;
	}
	
}

//获取彩票期数
function lottery_qishu_6($type) {
	$type = intval($type);
    global $lottery_time;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return substr(date("Ymd",$lottery_time), 2,6).BuLings($qs['qishu']);
	}else{
		return -1;
	}
	
}

//获取快乐十分彩票期数
function lottery_qishu_3($type) {
	$type = intval($type);
    global $lottery_time;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
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

//获取北京赛车(PK10)期数
function lottery_qishu_4($type) {
	$type = intval($type);
	include ("../../cache/website.php");
    global $lottery_time;
    $fixno = $web_site['pk10_knum']; //2013-06-30最后一期
    $daynum = floor(($lottery_time-strtotime($web_site['pk10_ktime']." 00:00:00"))/3600/24);
    $lastno = ($daynum-1)*179 + $fixno;
	global $mysqli;
	$sql	=	"select qishu from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";

	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	if($qs){
		return $lastno + $qs['qishu'];
	}else{
	return -1;
	}
	
}


//获取PC蛋蛋期数
function lottery_qishu_12($type) {
    $type = intval($type);
    include ("../../cache/website.php");
    global $lottery_time;
    $fixno = $web_site['kl8_knum'];
    $daynum = floor(($lottery_time-strtotime($web_site['kl8_ktime']." 00:00:00"))/3600/24);
    $lastno = ($daynum-1)*179 + $fixno;
    global $mysqli;
    $sql	=	"select qishu from c_opentime_1 where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
    $query	=	$mysqli->query($sql);
    $qs		=	$query->fetch_array();
	
    if($qs) {
        return $lastno + $qs['qishu'];
    } else {
        return -1;
    }
	
	
}

//获取新加坡快乐8期数
function lottery_qishu_18($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
//开始读取期数
$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://api.zao28.com/News?name=xjp28&type=json");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://api.zao28.com/News?name=xjp28&type=json");
$arr= json_decode($html_data, true);
$data=$arr['datas'][0];
// echo json_encode($data);
   $qishu = intval($data['issue'])+1;
   $time=$data['time'];
   $datetime=date('Y-m-d H:i:s', strtotime($time)+3.5*60);
 if(strtotime(date('Y-m-d H:i:s', $lottery_time))>strtotime($datetime)){
	  $qishu = intval($data['issue'])+2;
	  $datetime=date('Y-m-d H:i:s', strtotime($time)+2*3.5*60);
	 }
	 
    return $qishu;
}

//获取新加坡28期数
function lottery_qishu_23($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
//开始读取期数
$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://api.zao28.com/News?name=xjp28&type=json");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://api.zao28.com/News?name=xjp28&type=json");
$arr= json_decode($html_data, true);
$data=$arr['datas'][0];
// echo json_encode($data);
   $qishu = intval($data['issue'])+1;
   $time=$data['time'];
   $datetime=date('Y-m-d H:i:s', strtotime($time)+3.5*60);
 if(strtotime(date('Y-m-d H:i:s', $lottery_time))>strtotime($datetime)){
	  $qishu = intval($data['issue'])+2;
	  $datetime=date('Y-m-d H:i:s', strtotime($time)+2*3.5*60);
	 }
	 
    return $qishu;
}

//获取加拿大28期数
function lottery_qishu_13($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");

//开始读取期数
$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://api.zao28.com/News?name=jnd28&type=json");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://api.zao28.com/News?name=jnd28&type=json");
$arr= json_decode($html_data, true);
$data=$arr['datas'][0];
// echo json_encode($data);
   $qishu = intval($data['issue'])+1;
   $time=$data['time'];
   $datetime=date('Y-m-d H:i:s', strtotime($time)+3.5*60);
  
  
 if(strtotime(date('Y-m-d H:i:s', time()))>strtotime($datetime)){

	  $qishu = intval($data['issue'])+2;
	  $datetime2=date('Y-m-d H:i:s', strtotime($time)+2*3.5*60);
	 }

    return $qishu;
}

//获取上海时时乐期数
function lottery_qishu_5($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10015.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=10015");
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

//获取福建快三期数
function lottery_qishu_31($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10015.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=1007");
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





//获取广东11选5期数
function lottery_qishu_35($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10015.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=1007");
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

//获取澳洲幸运5期数
function lottery_qishu_27($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10090.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=10090");
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

//获取澳洲幸运8期数
function lottery_qishu_28($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10091.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=10091");
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

//获取澳洲幸运10期数
function lottery_qishu_29($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10092.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=10092");
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

//获取澳洲幸运20期数
function lottery_qishu_30($type) {
    $type = intval($type);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/include/http.class.php");
    $curl = new Curl_HTTP_Client();
    $curl->set_referrer("http://old.1680180.com/lottery/10093.html");
    $curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
    $html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=10093");
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
function user_money2($username,$money) {
	global $mysqli;
	
	$sql	=	"select money from k_user where username='".$username."' limit 1";
	$query	=	$mysqli->query($sql);
	$user	=	$query->fetch_array();
	if($user['money']-7*$money>=0){
		$sql	=	"update k_user set money=money-7*$money where username='".$username."' limit 1";
		$mysqli->query($sql);
		$sql2	=	"update k_user set dbje=dbje+6*$money where username='".$username."' limit 1";
		$mysqli->query($sql2);
		return $user['money']-7*$money;
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

function BuLing2s ( $num ) {
	if ( $num<10 ) {
		$num = '000'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '00'.$num;
	}
	if ( $num>=100 && $num<1000 ) {
		$num = '0'.$num;
	}
	return $num;
}

function get_gameName($type) {
	$game=0;
	switch($type) {
		case 0 : $game='香港六合彩';break;
		case 1 : $game='北京快乐8';break;
		case 2 : $game='重庆时时彩';break;
		case 3 : $game='广东快乐十分';break;
		case 4 : $game='北京赛车(PK10)';break;
		case 5 : $game='上海时时乐';break;
		case 6 : $game='江苏快三';break;
		case 7 : $game='天津时时彩';break;
		case 8 : $game='幸运飞艇';break;
		case 9 : $game='福彩3D';break;
		case 10 : $game='体彩排列三';break;
		case 11 : $game='重庆幸运农场';break;
		case 12 : $game='PC蛋蛋';break;
		case 13 : $game='加拿大28';break;
		case 14 : $game='新疆时时彩';break;
		case 15 : $game='澳洲五分彩';break;
		case 20 : $game='幸运2分彩';break;
		case 21 : $game='极速分分彩';break;
		case 22 : $game='极速六合彩';break;
		case 25 : $game='百人牛牛';break;
		case 24 : $game='极速赛车(PK10)';break;
		case 26 : $game='极速PC蛋蛋';break;
		case 23 : $game='新加坡28';break;
		case 17 : $game='极速幸运飞艇';break;
		case 18 : $game='新加坡快乐8';break;
		case 19 : $game='澳洲快乐十分';break;
		case 27 : $game='澳洲幸运5';break;
		case 28 : $game='澳洲幸运8';break;
		case 29 : $game='澳洲幸运10';break;
		case 30 : $game='澳洲幸运20';break;
		case 31 : $game='福建快三';break;
		case 32 : $game='极速快三';break;
		case 33 : $game='广西快三';break;
		case 34 : $game='上海快三';break;
		case 35 : $game='广东11选5';break;

	}
	return $game;
}

function get_gameType($type) {
	$game=0;
	switch($type) {
		case '香港六合彩' : $game=0;break;
		case '北京快乐8' : $game=1;break;
		case '重庆时时彩' : $game=2;break;
		case '广东快乐十分' : $game=3;break;
		case '北京赛车(PK10)' : $game=4;break;
		case '上海时时乐' : $game=5;break;
		case '江苏快三' : $game=6;break;
		case '天津时时彩' : $game=7;break;
		case '幸运飞艇' : $game=8;break;
		case '福彩3D' : $game=9;break;
		case '体彩排列三' : $game=10;break;
		case '重庆幸运农场' : $game=11;break;
		case 'PC蛋蛋' : $game=12;break;
		case '加拿大28' : $game=13;break;
		case '新疆时时彩' : $game=14;break;
		case '澳洲五分彩' : $game=15;break;
		case '幸运2分彩' : $game=20;break;
		case '极速分分彩' : $game=21;break;
		case '极速六合' : $game=22;break;
		case '新加坡28' : $game=23;break;
	    case '极速赛车(PK10)' : $game=24;break;
		case '极速PC蛋蛋' : $game=26;break;
		case '极速幸运飞艇' : $game=17;break;
		case '新加坡快乐8' : $game=18;break;
		case '澳洲快乐十分' : $game=19;break;
		case '澳洲幸运5' : $game=27;break;
		case '澳洲幸运8' : $game=28;break;
		case '澳洲幸运10' : $game=29;break;
		case '澳洲幸运20' : $game=30;break;
		case '福建快三' : $game=31;break;
		case '极速快三' : $game=32;break;
		case '广西快三' : $game=33;break;
		case '上海快三' : $game=34;break;
		case '广东11选5' : $game=35;break;
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
		case 5 : $game='shssl';break;
		case 6 : $game='jsk3';break;
		case 7 : $game='jxssc';break;
		case 8 : $game='xyft';break;
		case 9 : $game='3D';break;
		case 10 : $game='pl3';break;
		case 11 : $game='xync';break;
		case 12 : $game='xy28';break;
		case 13 : $game='jnd28';break;
		case 14 : $game='xjssc';break;
		case 15 : $game='wfssc';break;
		case 20 : $game='lfssc';break;
		case 21 : $game='ffssc';break;
		case 22 : $game='cqlhc';break;
		case 23 : $game='xjp28';break;
		case 25 : $game='brnn';break;
		case 24 : $game='jssc';break;
		case 26 : $game='jspcdd';break;
		case 17 : $game='jsxyft';break;
		case 18 : $game='xjp8';break;
		case 19 : $game='azsf';break;
		case 27 : $game='azxy5';break;
		case 28 : $game='azxy8';break;
		case 29 : $game='azxy10';break;
		case 30 : $game='azxy20';break;
		case 31 : $game='fjk3';break;
		case 32 : $game='js3';break;
		case 33 : $game='gxk3';break;
		case 34 : $game='fjk3';break;
		case 35 : $game='gd11x5';break;
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