<?php
header('Content-Type:text/html; charset=utf-8');
//date_default_timezone_set("America/New_York");
require_once("../mysqli.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cache/sixsetting.php");
require_once("curl_http.php");

//exit;
$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://kj.1680api.com/MarkSix");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://kj.1680api.com/Open/CurrentOpenOne?code=4001");
$a=array('(',')');
$b=array('[',']');
$msg='';
//$msg = str_replace($a,$b,$html_data);

	$arr= json_decode($html_data,true);
//echo $datetime;
$i=1;
//print_r($arr);
if($arr['c_t']){

	$qishu		= '2017'.$arr['c_t'];
	$num1		= $arr['c_r'][0]['no'];
	$num2		= $arr['c_r'][1]['no'];
	$num3		= $arr['c_r'][2]['no'];
	$num4		= $arr['c_r'][3]['no'];
	$num5		= $arr['c_r'][4]['no'];
	$num6		= $arr['c_r'][5]['no'];
	$num7		= $arr['c_r'][6]['no'];
	$time 		=  $arr['l_d'];
	$time =date('Y-m-d H:i:s',strtotime($time));
	//echo $qishu."<br>";
	if(strlen($qishu)>0 && $num1>0 && $num7>0){
		if($i==1){
			$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;$ball_4=$num4;$ball_5=$num5;$ball_6=$num6;$ball_7=$num7;
		}
		$sql="select id from c_auto_0 where qishu='".$qishu."' and ok=0 and ball_1='0' and ball_7='0'";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou){
			$sql="UPDATE `c_auto_0` SET `ball_1`='$num1', `ball_2`='$num2', `ball_3`='$num3', `ball_4`='$num4', `ball_5`='$num5', `ball_6`='$num6', `ball_7`='$num7' WHERE qishu='".$qishu."' and ok=0";
			$mysqli->query($sql);
			
		}
		$m=$m+1;
	}
/*
	//自动开盘
	if($six_set['auto_pan']==1){
		$n_t= '2017'.$arr['n_t'];
		$n_d=$arr['n_d'];
		preg_match_all("|(\d+?)月(\d+?)日(\d+?)时(\d+?)分|", $n_d, $n_d_arr);
		$datetime=substr($qishu,0,4).'-'.$n_d_arr[1][0].'-'.$n_d_arr[2][0].' '.$n_d_arr[3][0].':'.$n_d_arr[4][0].':00';
		$opentime=date('Y-m-d H:i:s',time());
		$endtime=date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($datetime)));
		$sql="select id from c_auto_0 where qishu='".$n_t."'";
		$nquery = $mysqli->query($sql);
		$ncou	= $mysqli->affected_rows;
		if($ncou==0){
			$sql 	= "insert into c_auto_0(qishu,opentime,endtime,datetime,ok,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7) values ('$n_t','$opentime','$endtime','$datetime',0,'0','0','0','0','0','0','0')";
			$mysqli->query($sql);
		}
	}*/
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
#timeinfo{color:#C60}
-->
</style></head>
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
<? $limit= 5;?>
var limit="<?=$limit?>" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      香港六合彩<br>(2017<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7"?>)<?=$msg ? '<br>'.$msg.'<br>' : ''?>
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<? if($six_set['auto_jie']==1){?>
<iframe src="../../Six/Auto/Six.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="100" width="100%"></iframe>
<? }?>
</body>
</html>