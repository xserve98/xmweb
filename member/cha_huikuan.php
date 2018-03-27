<?php
session_start();
include_once("../common/login_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>汇款查询</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<style type="text/css">
<!--
.STYLE2 {color: #000000}
-->
</style>
</head>

<body>
<div id="top_lishi">
  <div class="waikuang00">
  <table border="0" width="100%" cellpadding="0" cellspacing="1" class="waikuang">
    <!---->
    <tr class="sekuai_01" height="20">
	  <td width="25%" align="center">汇款流水号</td>
	  <td width="15%" align="center">汇款时间</td>
	  <td width="15%" align="center">汇款金额</td>
	  <td width="15%" align="center">汇款银行</td>
	  <td width="20%" align="center">汇款方式</td>
	  <td width="10%" align="center">汇款状态</td>
	</tr>
<?php
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
	
$sql	=	"select id from `huikuan` where `uid`=".$_SESSION["uid"];

$s_time	=	$_GET["s_time"]." 00:00:00";
$e_time	=	$_GET["e_time"]." 23:59:59";

if(isset($_GET["s_time"])){
	$sql	.=	" and `date`>='$s_time'";
}
if(isset($_GET["e_time"])){
	$sql	.=	" and `date`<='$e_time'";
}
$sql	.=	" order by `id` desc ";

$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,15);

$id			=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*15+1;
$end		=	$thisPage*15;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
$sum		=	0;
if(!$id){
	?>	
	<tr align="center" bgcolor="#FFFFFF"  height="20" onmouseover="this.style.background='#EEEEEE'" onmouseout="this.style.background='#ffffff'">
	  <td height="30" colspan="6"><span class="STYLE2">暂无结果</span></td>
	  </tr>
    <?php
}else{
	$id		=	rtrim($id,',');
	$sql	=	"select * from `huikuan` where id in($id) order by id desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
				if(($i%2)==0) $bgcolor="#FFFFFF";
				else $bgcolor="#F5F5F5";
				$i++;
	?>
	<tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" >
	  <td height="26"><?=$rows["lsh"]?></td>
	  <td><?=$rows["date"]?></td>
	  <td><?=$rows["money"]?></td>
	  <td><?=$rows["bank"]?></td>
	  <td><?=$rows["manner"]?></td>
	  <td><?php
			  if($rows["status"]==1){
			  	$sum += $rows["money"];
			  	echo '<span style="color:#FF0000;">成功</span>';
			  }else if($rows["status"]==2) echo '<span style="color:#000000;">失败</span>';
			  else echo '<span style="color:#0000FF;">系统审核中</span>';
			  ?></td>
	</tr>
<?php  
	}
}
?>
  </table>
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="waikuang">
	<tr class="sekuai_03">
	  <td colspan="6" class="fanye" style="width:100%"><span style="float:left;">本页汇款成功总金额：<font color="#FFFFFF"><?=$sum?></font> RMB</span><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?>&nbsp;&nbsp;</td>
	</tr>
</table>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>