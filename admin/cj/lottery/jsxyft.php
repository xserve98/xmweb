<?php
header('Content-Type:text/html; charset=utf-8');
require_once("../mysqli.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cache/website.php");
set_time_limit(0);
//date_default_timezone_set('America/New_York');
$lottery_time = time();
$sql		= "select * from c_opentime_17 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();

$tempNum="";
$num1="";
$num2="";
$num3="";
$num4="";
$num5="";
$num6="";
$num7="";
$num8="";
$num9="";
$num10="";

if($qs){
	//开始读取期数
	$sql		= "select * from c_opentime_17 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
	//var_dump($sql);
	$query		= $mysqli->query($sql);
	$qs		= $query->fetch_array();
	$fixno = $web_site['jsxyft_knum']; //2013-06-30最后一期
	$daynum = floor(($lottery_time-strtotime($web_site['jsxyft_ktime']." 00:00:00"))/3600/24);
	$lastno = ($daynum-1)*1440 + $fixno;

	if($qs){
		$qishu		= $lastno + $qs['qishu']-1;
	}else{
		$sql		= "select * from c_opentime_16 where qishu=1";
		$query		= $mysqli->query($sql);
		$qs		= $query->fetch_array();
		if($qs){
			$qishu		= $lastno + $qs['qishu']-1;
		}else{
			$qishu		= -1;
		}
	}
		$sql2="select * from c_auto_17 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql2);
		$tcou	= $mysqli->affected_rows;
		
		if($tcou==0){
			$time   = date('Y-m-d H:i:s',strtotime("-1 minute",strtotime(date('Y-m-d ',$lottery_time).$qs['kaijiang'])));
			
			if($web_site['gailv']<=0){
				getCodes();
			}else{
				$result=false;
				do{
					getCodes();
					$result=preJs($qishu,$tempNum);
				}while($result);
			}
			$tquery = $mysqli->query($sql2);
			$tcou	= $mysqli->affected_rows;
			if($tcou==0){
				$sql3 	= "insert into c_auto_17(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5','$num6','$num7','$num8','$num9','$num10')";
			}
			
			$mysqli->query($sql3);
			
		}else{
			$tqs		= $tquery->fetch_array();
			$num1= $tqs['ball_1'];$num2= $tqs['ball_2'];$num3= $tqs['ball_3'];$num4= $tqs['ball_4'];$num5= $tqs['ball_5'];$num6=$tqs['ball_6'];$num7= $tqs['ball_7'];$num8= $tqs['ball_8'];$num9= $tqs['ball_9'];$num10= $tqs['ball_10'];
		}
		$txt="采集到($qishu 期:$num1,$num2,$num3,$num4,$num5,$num6,$num7,$num8,$num9,$num10)";
	
}

function getCodes(){
	global $tempNum;
	global $num1;
	global $num2;
	global $num3;
	global $num4;
	global $num5;
	global $num6;
	global $num7;
	global $num8;
	global $num9;
	global $num10;
	$tempNum=explode(",",randKeys());
	$num1		= $tempNum[0];
	$num2		= $tempNum[1];
	$num3		= $tempNum[2];
	$num4		= $tempNum[3];
	$num5		= $tempNum[4];
	$num6		= $tempNum[5];
	$num7		= $tempNum[6];
	$num8		= $tempNum[7];
	$num9		= $tempNum[8];
	$num10		= $tempNum[9];
	
}
		
/*function randKeys($len=10){
	$str='638519724';
	$rand='';
	for($x=0;$x<$len;$x++){
		$rand.=($rand!=''?',':'').substr($str,rand(0,strlen($str)-1),1);
	}
	return $rand;
}*/

/* 生成随机数 */
function randKeys(){
    $array=array("01","02","03","04","05","06","07","08","09","10");
	$charsLen = count($array) - 1; 
    shuffle($array);
    $output = ""; 
  //  for ($i=0; $i<$len; $i++){ 
		
    $a= $array[mt_rand(0, $charsLen)];
		$b= $array[mt_rand(0, $charsLen)];
		while($a==$b)
		{
     $b= $array[mt_rand(0, $charsLen)];
		}
		$c=$array[mt_rand(0, $charsLen)];
		while($c==$a||$c==$b)
		{
      $c= $array[mt_rand(0, $charsLen)];
		}

		$d= $array[mt_rand(0, $charsLen)];
		while($d==$a||$d==$b||$d==$c)
		{
			$d= $array[mt_rand(0, $charsLen)];
		}
		$e= $array[mt_rand(0, $charsLen)];
		while($e==$a||$e==$b||$e==$c||$e==$d)
		{
			$e= $array[mt_rand(0, $charsLen)];
		}
				$f= $array[mt_rand(0, $charsLen)];
		while($f==$a||$f==$b||$f==$c||$f==$d||$f==$e)
		{
			$f= $array[mt_rand(0, $charsLen)];
		}
				$g= $array[mt_rand(0, $charsLen)];
		while($g==$a||$g==$b||$g==$c||$g==$d||$g==$e||$g==$f)
		{
			$g= $array[mt_rand(0, $charsLen)];
		}
			  $h= $array[mt_rand(0, $charsLen)];
		while($h==$a||$h==$b||$h==$c||$h==$d||$h==$e||$h==$f||$h==$g)
		{
			$h= $array[mt_rand(0, $charsLen)];
		}
			 $i= $array[mt_rand(0, $charsLen)];
		while($i==$a||$i==$b||$i==$c||$i==$d||$i==$e||$i==$f||$i==$g||$i==$h)
		{
			$i= $array[mt_rand(0, $charsLen)];
		}
					 $j= $array[mt_rand(0, $charsLen)];
		while($j==$a||$j==$b||$j==$c||$j==$d||$j==$e||$j==$f||$j==$g||$j==$h||$j==$i)
		{
			$j= $array[mt_rand(0, $charsLen)];
		}
       //$output .= $array[mt_rand(0, $charsLen)].",";  
  //  }  
	 return $outpuet=$a.','.$b.','.$c.','.$d.','.$e.','.$f.','.$g.','.$h.','.$i.','.$j;
   // return rtrim($output, ',');
}

function BuLings ( $num ) {
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
<script>
window.parent.is_open = 1;
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
	<input type=button name=button value="刷新" onClick="window.location.reload()">
      极速幸运飞艇<br><?=$txt?>&nbsp;
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="./js_17.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>