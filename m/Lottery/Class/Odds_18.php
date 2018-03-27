<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../../include/http.class.php");
include ("../include/lottery_time.php");
$pankou = $_SESSION['pankou'];

if($pankou=='A'){
	$sql		= "select * from c_odds_18 order by id asc";	
	//$sql		= "select * from c_odds_1_".strtolower($pankou)."order by id asc";	
	////echo $sql;
}else{
	
	$sql		= "select * from c_odds_18_".strtolower($pankou)." order by id asc";	
}
//开始读取赔率

$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<6; $i++){
			$list['ball'][$s][$i] = $odds['h'.$i];
		}
	$s++;
}
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
	 
$kaijiang = strtotime($datetime) - $lottery_time;
$fengpan  = $kaijiang - 20;
//echo 'kkk...'.$kaijiang;
$arr = array(
    'number' => $qishu,
    'endtime' => $fengpan,
    'opentime' => $kaijiang,
    'oddslist' => $list,
);
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
	if ( $num>10 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}
?> 