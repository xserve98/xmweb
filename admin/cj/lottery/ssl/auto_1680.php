<?php
header('Content-Type:text/html; charset=utf-8');
include_once("./common_1680.php");
$code=10015;//目标采集网站1680210彩种id
getData($code);
$jstime=substr($time,0,10);
if(strlen($qishu)>0){
	$sql="select id from c_auto_5 where qishu='".$qishu."'";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	$hms=explode(',',$hm);
	if($tcou==0){
		$sql = "insert into c_auto_5(qishu,datetime,ok,ball_1,ball_2,ball_3) values('".$qishu."','".$time."','0','".$hms[0]."','".$hms[1]."','".$hms[2]."')";
		$mysqli->query($sql);
	}
}
?>
<!doctype html>
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
-->
</style></head>
<body>
<script> 
var limit="23" 
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
      上海时时乐<br>(<?=$qishu?>期:<?="$hms[0],$hms[1],$hms[2]"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<iframe runat="server" src="./Js_shssl.php?qi=<?=$qishu?>&jsType=0&s_time=<?=$jstime?>" width="1000" height="1000" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
</body>
</html>