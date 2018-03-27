<?php
session_start();
include_once("../common/login_check.php");

function getstatus($status,$time=1){ 
	$str	=	'<span style="color:#0000FF;">未处理</span>';
	switch ($status){
		case '0':
			$str	=	'<span style="color:#000000;">失败</span>';
			break;
		case 1: 
			$str	=	'<span style="color:#FF0000;">成功</span>';
			break;
		case 2: 
			$str = time()-$time >= 200 ? '<span style="color:#0000FF;">系统审核中</span>' : '<span style="color:#0000FF;">未处理</span>';
			break;
		default:break;
	}
	return $str;
}

$stime	=	$_GET["s_time"] ? $_GET["s_time"] : date("Y-m-d",time());
$etime	=	$_GET["e_time"] ? $_GET["e_time"] : date("Y-m-d",time());
$s_time	=	$stime." 00:00:00";
$e_time	=	$etime." 23:59:59";

if($_GET["type"]=="1"){
	$lable	=	"存款";
	$sql	=	" and m_value>=0 ";
}else{
	$lable	=	"取款";
    $sql	=	" and m_value<0 ";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>存款取款</title>
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
  <div class="waikuang00"><table border="0" width="100%" cellpadding="0" cellspacing="1" class="waikuang">
    <tr class="sekuai_01" align="center" height="20">
	  <td><?=$lable?>号</td>
	  <td><?=$lable?>时间</td>
	  <td><?=$lable?>流水号</td>
	  <td><?=$lable?>金额</td>
	  <td><?=$lable?>备注</td>
	  <td><?=$lable?>状态</td>
	</tr>
<?php
include_once("../include/mysqli.php");
include_once("../include/newpage.php");

$sql		=	"select m_id from k_money where uid=".$_SESSION["uid"]." and m_make_time>='$s_time' and m_make_time<'$e_time'".$sql." order by m_id desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,15);

$mid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*15+1;
$end		=	$thisPage*15;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$mid .=	$row['m_id'].',';
  }
  if($i > $end) break;
  $i++;
}
$sum		=	0;
if(!$mid){
?>	
	<tr bgcolor="#FFFFFF">
    	<td height="30" colspan="6" align="center" class="red STYLE1">暂无记录</td>
    </tr>
<?php
}else{
	$mid	=	rtrim($mid,',');
	$sql	=	"select * from `k_money` where m_id in ($mid) order by m_id desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		if(($i%2)==0) $bgcolor="#FFFFFF";
		else $bgcolor="#F5F5F5";
		$i++;
		if($rows["status"] == 1) $sum += abs($rows["m_value"]);
?>
	<tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" >
	  <td height="26"><?=$rows["m_id"]?></td>
	  <td><?=$rows["m_make_time"]?></td>
	  <td><?=$rows["m_order"]?></td>
	  <td><?=abs($rows["m_value"])?></td>
	  <td><?=str_replace("[管理员结算]","",$rows['about']) ?></td>
	  <td><?=getstatus($rows["status"],strtotime($rows['m_make_time']))?></td>
	</tr>
<?php  
	}
}
?>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="waikuang">
	<tr class="sekuai_03">
	  <td colspan="6" class="fanye" style="width:100%"><span style="float:left;">本页<?=$lable?>成功总金额：<font color="#FFFFFF"><?=$sum?></font> RMB</span><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?>&nbsp;&nbsp;</td>
	</tr>
</table>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>