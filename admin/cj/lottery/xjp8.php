<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");
function ob2ar($obj) {
    if(is_object($obj)) {
        $obj = (array)$obj;
        $obj = ob2ar($obj);
    } elseif(is_array($obj)) {
        foreach($obj as $key => $value) {
            $obj[$key] = ob2ar($value);
        }
    }
    return $obj;
}
$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://api.zao28.com/News?name=xjp28&type=json");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://api.zao28.com/News?name=xjp28&type=json");
$a=array('(',')');
$b=array('[',']');

$msg = str_replace($a,$b,$html_data);
$msg2 = preg_replace('/("l_t":)(\d{9,})/i', '${1}"${2}"', $msg);
//echo $msg;
	$arr= json_decode($msg,true);
		
	$data=$arr['datas'][0];
//var_dump($arr);json_encode($arr['data'])."


//echo $datetime;
$m=0;
$i=1;
	///$tempNum=explode(",",$data['opencode']);
	
	
if($data['srccode']) {

		$v=explode(",",$data['srccode']);
		sort($v);
		
		array_splice($v,1,1);
		sort($v);
	////	$addtime 		= date('Y-m-d H:i:s');
	$addtime =  $data['time'];
		$qihao		= $data['issue'];
		
		$hm1		= $v[0];
		$hm2		= $v[1];
		$hm3		= $v[2];
		$hm4		= $v[3];
		$hm5		= $v[4];
		$hm6		= $v[5];
		$hm7		= $v[6];
		$hm8		= $v[7];
		$hm9		= $v[8];
		$hm10		= $v[9];
		$hm11		= $v[10];
		$hm12		= $v[11];
		$hm13		= $v[12];
		$hm14		= $v[13];
		$hm15		= $v[14];
		$hm16		= $v[15];
		$hm17		= $v[16];
		$hm18		= $v[17];
		$hm19		= $v[18];
		$hm20		= $v[19];
	
		if(strlen($qihao)>0){
			$sql="select id from c_auto_18 where qishu='".$qihao."' ";
			$tquery = $mysqli->query($sql);
			$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$time   = $addtime;
			$sql 	= "insert into c_auto_18(qishu,datetime,ok,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10,ball_11,ball_12,ball_13,ball_14,ball_15,ball_16,ball_17,ball_18,ball_19,ball_20) values ('$qihao','$time','0','$hm1','$hm2','$hm3','$hm4','$hm5','$hm6','$hm7','$hm8','$hm9','$hm10','$hm11','$hm12','$hm13','$hm14','$hm15','$hm16','$hm17','$hm18','$hm19','$hm20')";
		$mysqli->query($sql);
	}
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
      新加坡快乐8<br>(<?=$qihao?>期:<?="$hm1,$hm2,$hm3,$hm4,$hm5,$hm6,$hm7,$hm8,$hm9,$hm10,$hm11,$hm12,$hm13,$hm14,$hm15,$hm16,$hm17,$hm18,$hm19,$hm20"?>)<br>
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="Js_18.php?qi=<?=$dqihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>