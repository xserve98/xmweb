<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

if(21==1){
$st_time=strtotime("2014-10-09 00:02:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=120;$i++){
	echo $i."===";
	$sqls="select * from c_opentime_2 where qishu='$i'";
	echo $sqls;
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	if($rs['qishu']){
		if($i<=24 && $i<=97){
			$add_num=4;
			$add_num2=5;
		}else{
			$add_num=9;
			$add_num2=10;
		}
		$actiontime=date("H:i:s",$st_time);
		$fengpan=date("H:i:s", $st_time+$add_num*60);
		$kaijiang=date("H:i:s", $st_time+($add_num+1)*60);
		$strSqls="UPDATE `c_opentime_2` SET `kaipan`='$actiontime',`fengpan`='$fengpan',`kaijiang`='$kaijiang' WHERE (`qishu`='".$rs['qishu']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		//mysql_query($strSqls) or die("写入时间错误！<br>");
		$st_time+=60*$add_num2;
	}
}}

$curl = new Curl_HTTP_Client();
$curl->set_referrer("https://www.agpc28.com/Game/getcodemoney?cid=36");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("https://www.agpc28.com/Game/getcodemoney?cid=36");
echo  $html_data;




?>
