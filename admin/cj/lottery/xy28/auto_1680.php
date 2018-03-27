<?php
header('Content-Type:text/html; charset=utf-8');
include_once("./common_1680.php");
$code=10014;//目标采集网站1680210彩种id
getData($code);
$jstime=substr($time,0,10);
$d1=0;
$d2=0;
$d3=0;
$sum=0;
$hmss = array();
if(strlen($qishu)>0){
	$sql="select id from c_auto_12 where qishu='".$qishu."'";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	$hms=explode(',',$hm);
	array_pop($hms);
	sort($hms,SORT_NUMERIC);
   
	$hmss[0]=($hms[0]+$hms[1]+$hms[2]+$hms[3]+$hms[4]+$hms[5])%10;
	$hmss[1]=($hms[6]+$hms[7]+$hms[8]+$hms[9]+$hms[10]+$hms[11])%10;
	$hmss[2]=($hms[12]+$hms[13]+$hms[14]+$hms[15]+$hms[16]+$hms[17])%10;
	
	
	$nums=str_split($hmss[0]);
	
	for($i=0;$i<count($nums);$i++){
		$d1=($nums[0]+$nums[1]+$nums[2])%10;
	}
	
	$nums=str_split($hmss[1]);
	for($i=0;$i<count($nums);$i++){
		$d2=($nums[0]+$nums[1]+$nums[2])%10;
	}
	
	$nums=str_split($hmss[2]);
	for($i=0;$i<count($nums);$i++){
		$d3=($nums[0]+$nums[1]+$nums[2])%10;
	}
	
	$sum = $d1 + $d2 + $d3;
	
	if($tcou==0){
		$sql = "insert into c_auto_12(qishu,datetime,ok,ball_1,ball_2,ball_3,ball_4) values('".$qishu."','".$time."','0','".$d1."','".$d2."','".$d3."','".$sum."')";
		
		$mysqli->query($sql);
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
<table width="100%"border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      PC蛋蛋<br>(<?=$qishu?>期:<?=$d1.'+'.$d2.'+'.$d3 .'='.$sum?>)<br>
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="./js_12.php?qi=<?=$dqihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>