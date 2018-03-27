<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");



$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://www.agpc28.com/Game/getresult?cid=36");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://www.agpc28.com/Game/getresult?cid=36");
$a=array('(',')');
$b=array('[',']');

$msg = str_replace($a,$b,$html_data);
$msg2 = preg_replace('/("l_t":)(\d{9,})/i', '${1}"${2}"', $msg);
//echo $msg;
	$arr= json_decode($msg,true);
//var_dump($arr);json_encode($arr['data'])."

$i=1;
if($arr['code']){

	$qishu		= $arr['issue'];
	$Y 			= substr($qishu,0,4);
	$M 			= substr($qishu,4,2);
	$D 			= substr($qishu,6,2);
	$ymd 			= substr($qishu,0,8);
	$qishunum 	= substr($qishu,-3);
	$qishu2 =$ymd.$qishunum;
	$tempNum=explode(";",$arr['code']);
	$num1		= $tempNum[0];
	$num2		= $tempNum[1];
	$num3		= $tempNum[2];
	$num4		= $tempNum[3];
	$num5		= $tempNum[4];
	/*
	//echo $qishu."<br>";
	$num1		= '1,12,16,28,2';
	$num2		= '0,13,17,8,20';
	$num3		= '41,42,50,51,47';
	$num4		= '3,4,5,6,7';
	$num5		= '38,39,43,32,33';
*/
	
	if(strlen($qishu)>0){
		if($i==1){
			$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;$ball_4=$num4;$ball_5=$num5;
		}
		$sql="select id from c_auto_25 where qishu='".$qishu2."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql 	= "select kaijiang from `c_opentime_25` where qishu='".intval($qishunum)."'";
			//echo $sql;
			$query 	= $mysqli->query($sql);
			$rs		= $query->fetch_array();
			$time   = "$Y-$M-$D ".$rs['kaijiang'];
			$sql 	= "insert into c_auto_25(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu2','$time','$num1','$num2','$num3','$num4','$num5')";
			
			$mysqli->query($sql);
			
		}
		$m=$m+1;
	}
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
      百人牛牛<br>(<?=$qishu2?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_25.php?qi=<?=$qishu2?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>