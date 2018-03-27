<?php
include_once("../common/login_check.php");
check_quanxian("dlgl");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>代理结算</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">

<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{color:#FFA93E;}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理核查</span></font></td>
  </tr>
  <tr>
  <form action="daili_rijiesuan.php" method="get" id="form1" name="form1">
    <td align="center" valign="middle" nowrap bgcolor="#FFFFFF">代理名称：
      <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="20" maxlength="20">&nbsp;<input type="submit" name="Submit" value="提交"></td>
    </form>
  </tr>
<?php
if($_GET['username']){
?>
  <tr>
    <td align="center" valign="middle" nowrap bgcolor="#FFFFFF">
    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" align="center"  >
      <tr style="background-color: #EFE" class="t-title" align="center">
        <td width="18%" align="center"><strong>月份/日期</strong></td>
        <td width="27%" align="center"><strong>金额</strong></td>
        <td width="19%" align="center"><strong>下级明细</strong></td>
        <td width="36%" align="center"><strong>说明</strong></td>
      </tr>
<?php
	include_once("../../include/mysqli.php");
	include_once("../../include/function_dled.php");
	$dled	=	0;
	$sql	=	"select uid from k_user where username='".$_GET['username']."' limit 1";
	$query	=	$mysqli->query($sql);
	if($row	=	$query->fetch_array()){
		$uid	=	$row['uid'];
		$yk		=	getDLED($uid,date("Y-m",time()).'-1 00:00:00',date("Y-m-d H:i:s",time())); //取本月代理盈亏额度
		$bl		=	get_point($yk);
		$dled	+=	round($yk*$bl,2);
		$color	=	round($yk*$bl,2)>0 ? '#FF0000' : '#000000';
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
        <td align="center"><strong><?=date("Y-m",time())?></strong></td>
        <td align="center" style="color:<?=$color?>;"><?=round($yk*$bl,2)?></td>
        <td align="center"><a href="xjmx.php?uid=<?=$uid?>&month=<?=date("Y-m",time())?>" target="_blank">查看明细</a></td>
        <td align="center">本月代理提成额度</td>
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
			$dled				+=	$row['result'];
			$type	=	'';
			if($row['type'] == 1){
				$arr[$i]['type']=	$row['month'].' 代理月提成额度';
				if($row['month']==$upMonth) $bool = false; //进行了上个月的代理月结算
			}else{
				$arr[$i]['type']=	'提款代理额度';
			}
			$i++;
		}
		if($bool){ //未进行
			$yk		=	getDLED($uid,$upMonth.'-1 00:00:00',date("Y-m-d H:i:s",strtotime("$upMonth"."-1 23:59:59"." +1 month")-1)); //取上个月代理盈亏额度
			$bl		=	get_point($yk);
			$result	=	round($yk*$bl,2);
			$dled	+=	$result;
			$color	=	$result>0 ? '#FF0000' : '#000000';
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
        <td align="center"><strong><?=$upMonth?></strong></td>
        <td align="center" style="color:<?=$color?>;"><?=$result?></td>
        <td align="center"><a href="xjmx.php?uid=<?=$uid?>&month=<?=$upMonth?>" target="_blank">查看明细</a></td>
        <td align="center"><?=$upMonth?> 代理月提成额度</td>
      </tr>
<?php
		}
		foreach($arr as $k=>$row){
			$color	=	$row['result']>0 ? '#FF0000' : '#000000';
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
        <td align="center"><strong><?=$row['month']?></strong></td>
        <td align="center" style="color:<?=$color?>;"><?=$row['result']?></td>
        <td align="center"><?=$row['type']=='提款代理额度' ? '/' : '<a href="xjmx.php?uid='.$uid.'&month='.$row['month'].'" target="_blank">查看明细</a>'?></td>
        <td align="center"><?=$row['type']?></td>
      </tr>
<?php
		}
		$color	=	$dled>0 ? '#FF0000' : '#000000';
?>
      <tr>
        <td colspan="4" align="left">当前代理额度：<span style="color:<?=$color?>;"><?=$dled?></span></td>
        </tr>
    </table></td>
  </tr>
<?php
	}
}
?>
</table>
</body>
</html>