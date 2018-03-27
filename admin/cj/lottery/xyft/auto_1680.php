<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../mysqli.php");
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
function trimall($str)//删除空格
{
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian,$hou,$str); 
}
$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.luckyairship.com");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.luckyairship.com/history.html");
preg_match_all('|<div\s+?class=\"historySearch\">([\s\S]+)</table>|', $html_data, $ul_arr);
preg_match_all("|<tr class=\"\w*?\">([\s\S]+?)</tr>|", $ul_arr[1][0], $ul_arr2);
//print_r($ul_arr2);exit;
$i=0;
foreach($ul_arr2[1] as $arr){
	preg_match_all('|<td>([\s\S]+?)</td>|', $arr, $qishu_arr);
	//print_r($qishu_arr);exit;
	$qishu=trimall(strip_tags($qishu_arr[1][1]));
	preg_match_all('|<span class=\"ball1\">([\s\S]+?)</span>|', $qishu_arr[1][2], $number_arr);
	//print_r($number_arr);exit;
	$v=$number_arr[1];
	$time 		=  date('Y-m-d H:i:s');;
	$ball_1		= $v[0];
	$ball_2		= $v[1];
	$ball_3		= $v[2];
	$ball_4		= $v[3];
	$ball_5		= $v[4];
	$ball_6		= $v[5];
	$ball_7		= $v[6];
	$ball_8		= $v[7];
	$ball_9		= $v[8];
	$ball_10	= $v[9];
	if(strlen($qishu)>0){
		if($i==0){
			$sball_1=$ball_1;$sball_2=$ball_2;$sball_3=$ball_3;$sball_4=$ball_4;$sball_5=$ball_5;$sball_6=$ball_6;$sball_7=$ball_7;$sball_8=$ball_8;$sball_9=$ball_9;$sball_10=$ball_10;
			$sqishu=$qishu;
		}
		$is_js=1;
		$sql="select id from c_auto_8 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql	=	"insert into c_auto_8(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5','$ball_6','$ball_7','$ball_8','$ball_9','$ball_10')";
			//echo $sql."<br>";
			$mysqli->query($sql);
			$m=$m+1;
		}else{
			$usql="update c_auto_8 set ball_1=$ball_1,ball_2=$ball_2,ball_3=$ball_3,ball_4=$ball_4,ball_5=$ball_5,ball_6=$ball_6,ball_7=$ball_7,ball_8=$ball_8,ball_9=$ball_9,ball_10=$ball_10 where qishu='".$qishu."'";
			//	echo $usql."<br>";
			$mysqli->query($usql);
		}
	}
	$i++;
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
      幸运飞艇<br>(<?=$sqishu?>期:<?="$sball_1,$sball_2,$sball_3,$sball_4,$sball_5,$sball_6,$sball_7,$sball_8,$sball_9,$sball_10"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<? if($is_js){?>
<iframe src="../js_8.php?qi=<?=$sqishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<? }?>
</body>
</html>