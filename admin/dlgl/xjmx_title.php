<?php
include_once("../common/login_check.php");
check_quanxian("dlgl"); 
include_once("../../include/mysqli.php");
include_once("../../include/function_dled.php");

$byyxxj		=	0;
$uid		=	$_GET["uid"];
$thisMonth	=	date('Y-m',time()); //默认为当前月
$month		=	$_GET['month'];

if($month == $thisMonth){ //本月下级盈亏
	$yk			=	getDLED($uid,$thisMonth.'-1 00:00:00',date("Y-m-d H:i:s",time())); //取本月代理盈亏额度
	$bl			=	get_point($yk);

	$sql		=	"select count(*) as s from k_user where money>0 and top_uid=$uid and reg_date like ('$month%')";
	$query		=	$mysqli->query($sql);
	if($row		=	$query->fetch_array()) $byyxxj	=	$row['s'];
}else{ //取上个月下级盈亏
	$sql		=	"select shuying,`point`,yxxj from k_user_daili_result where month='$month' and uid=$uid and type=1"; //查询上个月是否已保存盈亏记录
	$query		=	$mysqli->query($sql);
	if($row		=	$query->fetch_array()){
		$yk		=	$row['shuying'];
		$bl		=	$row['point'];
		$byyxxj	=	$row['yxxj'];
	}else{
		$yk		=	getDLED($uid,$month.'-1 00:00:00',date("Y-m-d H:i:s",strtotime("$month"."-1 23:59:59"." +1 month")-1)); //取上个月代理盈亏额度
		$bl		=	get_point($yk);
		
		$sql	=	"select count(*) as s from k_user where money>0 and top_uid=$uid and reg_date like ('$month%')";
		$query	=	$mysqli->query($sql);
		if($row	=	$query->fetch_array()) $byyxxj	=	$row['s'];
	}
}
$sql			=	"SELECT add_time FROM k_user_daili where uid=$uid and `status`=1";
$query			=	$mysqli->query($sql);
$rows			=	$query->fetch_array();
$regMonth		=	substr($rows['add_time'],0,7);

if($yk > 0) $color = '#FF0000';
else $color = '#000000';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE1 {color: #000000}
-->
</style>
</head>
<script language="javascript">
<!--
if(self==top){
	top.location='/index.php';
}

function goUrl(month){
	window.location.href = 'xjmx_title.php?uid=<?=$uid?>&month='+month;
	window.open('xjmx_list.php?uid=<?=$uid?>&month='+month,"xjmx_listFrame");
}
-->
</script>
<body>
<div id="top_lishi">
<div class="waikuang" style="height:24px; width:777px;"><div style="float:left; line-height:24px;">&nbsp;&nbsp;<?=$month?> 有效下级：<span style="color:#0000FF;"><?=$byyxxj?></span> 个，总盈亏：<?=$yk?>，提成比例：<?=$bl?>，代理总盈亏：<span style='color:<?=$color?>;'><?=round($yk*$bl,2)?></span></div><div style="float:right; line-height:24px;">查询月份：<select name="month" id="month" style="width:80px; z-index:999px;" onchange="goUrl(this.value);">
<?php
while(strtotime($thisMonth) >= strtotime($regMonth)){
?>
    <option value="<?=$thisMonth?>" <?=$thisMonth==$month ? 'selected' : ''?>><?=$thisMonth?></option>
<?php
	$thisMonth	=	date('Y-m',strtotime("$thisMonth -1 month"));
}
?>
  </select>
  </div>
</div>
</div>
<script type="text/javascript" language="javascript" src="../../js/left_mouse.js"></script>
</body>
</html>