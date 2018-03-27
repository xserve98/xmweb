<?php
session_start();
include_once("../common/login_check.php");
?>
<!DOCTYPE HTML>
<html><head>
<meta charset="utf-8">
<title>汇款查询</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/styles/ucenter.css">
<script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
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
<div class="h10"></div>
<div class="panel panel-default">
<div class="panel-heading">
    <h3>汇款查询</h3>
  </div>
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-bordered">
    <!---->
    <tr class="sekuai_01">
	  <th>汇款流水号</th>
	  <th>汇款时间</th>
	  <th>汇款金额</th>
	  <th>汇款银行</th>
	  <th>汇款方式</th>
	  <th>汇款状态</th>
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
	<tr>
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
	<tr bgcolor="<?=$bgcolor?>" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" >
	  <td><?=$rows["lsh"]?></td>
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
  </table></div></div>
  <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">本页汇款成功总金额：<font color="#FFFFFF"><?=$sum?></font> RMB </a></li></ul>
  </div>  
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>