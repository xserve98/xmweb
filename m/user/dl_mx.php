<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/function_dled.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>万丰国际</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE1 {color: #000000}
-->
</style>
</head>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<body>
<div id="top_lishi">
	<div class="waikuang00">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
    <tr class="sekuai_01">
	  <td width="258">月份/日期</td>
	  <td width="240">额度</td>
	  <td width="275">说明</td>
	  </tr>	
<?php
$uid	=	$_SESSION["uid"];
$yk		=	getDLED($uid,date("Y-m",time()).'-1 00:00:00',date("Y-m-d H:i:s",time())); //取本月代理盈亏额度
$bl		=	get_point($yk);
$color	=	round($yk*$bl,2)>0 ? '#FF0000' : '#000000';
?>
	<tr align="center" bgcolor="#FFFFCC" >
    <td height="30" valign="middle" ><?=date("Y-m",time())?></td>
    <td height="30" valign="middle" style="color:<?=$color?>;" ><?=round($yk*$bl,2)?></td>
    <td height="30" valign="middle" >本月代理额度</td>
    </tr>
<?php
$arr		=	array();
$i			=	0;
$bool		=	true; //默认未进行上个月的代理月结算
$upMonth	=	date('Y-m',strtotime("-1 month")); //上个月
$sql		=	"SELECT result,`month`,`type`,make_date FROM k_user_daili_result where uid=$uid order by `month` desc";
$query		=	$mysqli->query($sql);
while($row	=	$query->fetch_array()){
	$arr[$i]['month']	=	$row['month'];
	$arr[$i]['result']	=	$row['result'];
	$type	=	'';
	if($row['type'] == 1){
		$arr[$i]['type']=	$row['month'].' 代理月提成额度';
		if($row['month']==$upMonth) $bool = false; //进行了上个月的代理月结算
	}else{
		$arr[$i]['type']=	'提款代理额度';
	}
	$i++;
}
$i			=	0;
if($bool){ //未进行
	if(($i%2)==0) $bgcolor="#FFFFFF";
	else $bgcolor="#F5F5F5";
	$i++;
	
	$yk		=	getDLED($uid,$upMonth.'-1 00:00:00',date("Y-m-d H:i:s",strtotime($upMonth."-1 23:59:59"." +1 month")-1)); //取上个月代理盈亏额度
	$bl		=	get_point($yk);
	$result	=	round($yk*$bl,2);
	$color	=	$result>0 ? '#FF0000' : '#000000';
?>
<tr align="center" bgcolor="<?=$bgcolor?>"  onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'">
    <td height="30" valign="middle" ><?=$upMonth?></td>
    <td height="30" valign="middle" style="color:<?=$color?>;" ><?=$result?></td>
    <td height="30" valign="middle" ><?=$upMonth?> 代理月提成额度</td>
    </tr>
<?php
}
foreach($arr as $k=>$row){
	$color	=	$row['result']>0 ? '#FF0000' : '#000000';
	if(($i%2)==0) $bgcolor="#FFFFFF";
	else $bgcolor="#F5F5F5";
	$i++;
?>
	<tr align="center" bgcolor="<?=$bgcolor?>"  onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'">
    <td height="30" valign="middle" ><?=$row['month']?></td>
    <td height="30" valign="middle" style="color:<?=$color?>;" ><?=$row['result']?></td>
    <td height="30" valign="middle" ><?=$row['type']?></td>
    </tr>
<?php
}
?>
    </table>
	</div>
</div>
</body>
</html>