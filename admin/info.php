<?php
session_start(); //后台登陆验证
//ini_set('display_errors','yes ');
include_once("login_check.php");

if(isset($_SESSION["adminid"])){
	include_once("../include/mysqlio.php");
	$sql	=	"select uid from sys_admin where is_login=1 and uid=".$_SESSION["adminid"]." limit 1";
	$query	=	$mysqlio->query($sql);
	$rs		=	$query->fetch_array();
	if($rs['uid'] > 0){
		//会员在线，不做任何操作
	}else{
		unset($_SESSION["adminid"]);
		unset($_SESSION["quanxian"]);
		echo "<script>window.open('/','_top');</script>";
		exit();
	}
}else{
	unset($_SESSION["adminid"]);
	unset($_SESSION["quanxian"]);
	echo "<script>window.open('/','_top');</script>";  
	exit();
}

include_once("../include/mysqli.php");

$bet_count  =	0; 
$count_zd	=	array();
$hyzs		=	$jrhy	=	0; //会员总数
$ymd		=	date("Y-m-d");

$sql		=	"select count(*) as s from k_user";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$hyzs		=	$rs['s'];

$sql		=	"select count(*) as s from k_user where reg_date like ('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$jrhy		=	$rs['s'];

$sql		=	"select count(*) as s from k_bet"; //单式注单
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$bet_count	=	$rs['s'];

$sql		=	"select count(*) as s from k_bet where bet_time like ('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$jr_bet_count		=	$rs['s'];

$sql		=	"select count(*) as s from k_bet_cg_group"; //串关注单
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$bet_count +=	$rs['s'];

$sql		=	"select count(*) as s from k_bet_cg_group where bet_time like ('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$jr_bet_count		+=	$rs['s'];


$sql		=	"select count(*) as s from c_bet"; //重庆时时彩注单
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$bet_count +=	$rs['s'];

$sql		=	"select count(*) as s from c_bet where addtime like ('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$jr_bet_count		+=	$rs['s'];

$sql		=	"select count(*) as s from c_bet"; //高频彩种注单
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$bet_count +=	$rs['s'];

$sql		=	"select count(*) as s from c_bet where addtime like ('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$jr_bet_count		+=	$rs['s'];

$tixian_today=	$cunkuan_today	=	0;
$sql		=	"select m_value,type from k_money where `status`=1 and `type` in (1,2) and m_make_time like('".$ymd."%')";
$query		=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	if($rows['type']==2) $tixian_today++;
	if($rows['type']==1) $cunkuan_today++;
}

$sql		=	"select count(*) as s from huikuan where status=1 and `adddate` like('".$ymd."%')";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$huikuan_today	=	$rs['s'];//今日汇款笔数
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>系统信息查看</TITLE>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="Images/CssAdmin.css">
<style type="text/css">
body {
	margin:0 0 0 0;
}
.STYLE3 {color:#FF3300;}
</STYLE>
</HEAD>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td height="24" nowrap background="images/06.gif"><font ><img src="Images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;系统运行信息查看</font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td height="24" nowrap><table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct idth="100%">
      <tr>
        <td width="17%" height="24" align="right">会员总数量：</td>
        <td width="83%"><?=$hyzs?></td>
      </tr>
      <tr>
        <td height="24" align="right">今日新增会员数量：</td>
        <td style="color:#0000FF;"><?=$jrhy?></td>
      </tr>
      <tr>
        <td height="24" align="right">注单总数量：</td>
        <td style="color:#0000FF;"><?=$bet_count?></td>
      </tr>
      <tr>
        <td height="24" align="right">今日新增注单数量：</td>
        <td style="color:#0000FF;"><?=$jr_bet_count?></td>
      </tr>
      <tr>
        <td height="24" align="right">今日提现笔数：</td>
        <td><?=$tixian_today?></td>
      </tr>
      <tr>
        <td height="24" align="right">今日存款笔数：</td>
        <td><?=$cunkuan_today?></td>
      </tr>
      <tr>
        <td height="24" align="right">今日汇款笔数：</td>
        <td><?=$huikuan_today?></td>
      </tr>
      <tr>
        <td colspan="2" align="left"><iframe src="zdfx.php" name="zdfxFrame" id="zdfxFrame" title="zdfxFrame" frameborder=0 width="49%" scrolling=no height=300 ></iframe>&nbsp;<iframe src="login_user.php" name="luFrame" id="luFrame" title="luFrame" frameborder=0 width="49%" scrolling=no height=300 ></iframe></td>
        </tr>
	    <tr>
        <td height="24" colspan="2" align="right">&nbsp;</td>
        </tr>
	    <tr>
        <td height="24" align="right">操作：</td>
        <td ><a style="color:#FF0000" href="?<?=rand()?>">刷新监控</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>