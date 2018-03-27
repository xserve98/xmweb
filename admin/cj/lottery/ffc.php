<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

$lottery_time = time();



function getdata(){
	$data1=array(rand(0,9),rand(0,9),rand(0,9),rand(0,9),rand(0,9));
	return $data1;
}

function gettime($qishu1){
global $mysqli;
$sql1		= "select * from c_opentime_21 where qishu=$qishu1  order by id asc";	
$query1		= $mysqli->query($sql1);
$qs1		= $query1->fetch_array();
$time1=$qs1['kaijiang'];

	return $time1;
}

function buling($qishu1){
if($qishu1<10){
	$qishu2='000'.$qishu1;
	}
	else if($qishu1<100){
			$qishu2='00'.$qishu1;
		}
		else if($qishu1<1000){
			$qishu2='0'.$qishu1;
		}
		else{
			$qishu2=$qishu1;
			}
	return $qishu2;
}






//开始读取期数
$sql		= "select * from c_opentime_21 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$qishu1=$qs['qishu']-1;
$qi=$qishu1;
for($i=$qi;$i>$qi-5;$i--){
	if($i>0){
	$qishu=date("Ymd",time()).buling($i);
	$time=date("Y-m-d",time()).' '.gettime($i);	
	}else{
	$qishu=date("Ymd",time()-86400).buling(1440+$i);	
	$time=date("Y-m-d",time()-86400).' '.gettime(1440+$i);		
	}

	$data= getdata();

$data=array(rand(0,9),rand(0,9),rand(0,9),rand(0,9),rand(0,9));
    $num1		= $data[0];
	$num2		= $data[1];
	$num3		= $data[2];
	$num4		= $data[3];
	$num5		= $data[4];

	    $sql="select id from c_auto_21 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
	    $sql 	= "insert into c_auto_21(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5')";	
			$mysqli->query($sql);	
		}
}
	$sql="select * from c_auto_21  order by qishu desc limit 1 ";
	$query = $mysqli->query($sql);
	$ballarr	= $query->fetch_array();
	$ball_1=$ballarr['ball_1'];$ball_2=$ballarr['ball_2'];$ball_3=$ballarr['ball_3'];$ball_4=$ballarr['ball_4'];$ball_5=$ballarr['ball_5'];
$qishu=$ballarr['qishu'];
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
      极速分分彩<br>(<?=$qishu?> 期: <?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_21.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>