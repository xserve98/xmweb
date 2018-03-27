<?php
include_once("../common/login_check.php"); 
check_quanxian("xtgl");

function getWidth($d){
	if($d < 8){
		return 650;
	}elseif($d < 15){
		return 850;
	}else{
		return 1000;
	}
}

$s_date	=	date('Y-m-d',strtotime("-3 day")); //默认开始时间为前三天
$e_date	=	date('Y-m-d'); //默认结束时间为今天
if($_GET['s_date']) $s_date	=	$_GET['s_date'];
if($_GET['e_date']) $e_date	=	$_GET['e_date'];

$sql	=	"SELECT today FROM ip_la where today>='$s_date 00:00:00' and today<='$e_date 23:59:59'";
$query	=	$mysqlio->query($sql);
$ip_la	=	array();
while($row = $query->fetch_array()){
	$ip_la[substr($row['today'],0,10)]++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>流量分析</title>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="javascript">
<!--
if(self==top){
	top.location='/index.php';
}

function goUrl(s,e){
	window.location.href = 'llfx.php?s_date='+s+'&e_date='+e;
}

function look(){
	var s = $("#s_date").val();
	if(s.length < 5){
		alert('请选择开始日期');
		return false;
	}
	var e = $("#e_date").val();
	if(e.length < 5){
		alert('请选择结束日期');
		return false;
	}
	goUrl(s,e);
}
-->
</script>
</head>

<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<div>
<input name="s_date" type="text" id="s_date" value="<?=$s_date?>" onclick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" /> ~ <input name="e_date" type="text" id="e_date" value="<?=$e_date?>" onclick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />&nbsp;&nbsp;<input type="submit" name="Submit" value="查看" onclick="look()" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="查看最近三天" onclick="goUrl('<?=date('Y-m-d',strtotime("-3 day"))?>','<?=date('Y-m-d')?>')" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="查看最近七天" onclick="goUrl('<?=date('Y-m-d',strtotime("-7 day"))?>','<?=date('Y-m-d')?>')" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="查看本周" onclick="goUrl('<?=date('Y-m-d',strtotime("-1 week"))?>','<?=date('Y-m-d')?>')" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="查看本月" onclick="goUrl('<?=date('Y-m-d',strtotime("-1 month"))?>','<?=date('Y-m-d')?>')" /></div><div style="height:24px;">&nbsp;</div>
<?php
$s_date	=	strtotime($s_date);
$e_date	=	strtotime($e_date);
$width	=	getWidth(floor(($e_date-$s_date)/86400));
?>
<div style="text-align:center;"><object width="<?=$width-100?>" height="420" align="middle" id="FCColumn3" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
              <param value="&amp;dataXML=&lt;graph caption='综合访问量统计' shownames='1' showvalues='1' decimalPrecision='0' yaxisminvalue='0' yaxismaxvalue='10' animation='1' outCnvBaseFontSize='12' baseFontSize='12' xaxisname='日期' yaxisname='访问量' &gt;<?php
$i	=	0;
$t	=	$s_date;
while($t <= $e_date){
	if($ip_la[date('Y-m-d',$t)] > 0){
		echo "&lt;set name='".date('m-d',$t)."' value='".$ip_la[date('Y-m-d',$t)]."' color='".substr(getColor($i),1)."' /&gt;";
		$i++;
	}
	$t += 86400;
}
			  ?>&lt;/graph&gt;" name="FlashVars">
              <param value="../images/line.swf?chartWidth=<?=$width?>&amp;chartHeight=400" name="movie">
              <param value="high" name="quality">
              <param value="#FFFFFF" name="bgcolor">
              <param value="opaque" name="wmode">
              <embed width="<?=$width?>" height="400" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="opaque" name="FCColumn2" bgcolor="#FFFFFF" quality="high" flashvars="&amp;dataXML=&lt;graph caption='综合访问量统计' shownames='1' showvalues='1' decimalPrecision='0' yaxisminvalue='0' yaxismaxvalue='10' animation='1' outCnvBaseFontSize='12' baseFontSize='12' xaxisname='日期' yaxisname='访问量' &gt;<?php
$i	=	0;
$t	=	$s_date;
while($t <= $e_date){
	if($ip_la[date('Y-m-d',$t)] > 0){
		echo "&lt;set name='".date('m-d',$t)."' value='".$ip_la[date('Y-m-d',$t)]."' color='".substr(getColor($i),1)."' /&gt;";
		$i++;
	}
	$t += 86400;
}
			  ?>&lt;/graph&gt;" src="../images/line.swf?chartWidth=<?=$width?>&amp;chartHeight=400">
            </object></div>
</body>
</html>