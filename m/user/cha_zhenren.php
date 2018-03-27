<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()):$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?date("Y-m-d",time()):$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>乐博国际</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/styles/ucenter.css">
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<script src="/assets/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
</head> 
<style type='text/css'>
body{font:normal 11px/15px 宋体;}
.panel-zd{padding:5px 0px 10px 0px}
</style>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">财务明细查询</h3>
			  </div>
			  <div class="panel-zd">
			    <div role="tabpanel">
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs nav-tile" role="tablist">
				    <li><a href="cha_ckonline.php?type=4">存款记录</a></li>
				    <li><a href="cha_huikuan.php?type=4">汇款记录</a></li>
				    <li><a href="cha_qukuan.php?type=4">取款记录</a></li>
                    <li class="active"><a href="cha_zhenren.php?type=4">娱乐场记录</a></li>
                    <li><a href="cha_jifen.php?type=4">积分记录</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
                    <div id="top_lishi">
                      <div class="waikuang00">
                        <table class="table table-bordered">
    <tr class="sekuai_01" align="center" height="20">
	  <td>时间</td>
	  <td>流水号</td>
	  <td>金额</td>
      <td>类型</td>
	  <td>状态</td>
	</tr>
    <?php
					if($zz_type!=""){
						$sqlwhere=" and zz_type='".$zz_type."'";
					}
					$sql	=	"select id from `ag_zhenren_zz` where `uid`=$uid and live_type='AG' ".$sqlwhere."  order by `id` desc";
					$query	=	$mysqli->query($sql);
					$sum		=	$mysqli->affected_rows; //总页数
					$thisPage	=	1;
					if($_GET['page']){
						$thisPage	=	$_GET['page'];
					}
					$page		=	new newPage();
					$thisPage	=	$page->check_Page($thisPage,$sum,15);
					
					$id		=	'';
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

					if(!$id){
					?>
					<tr bgcolor="#FFFFFF">
    	<td height="30" colspan="5" align="center" class=" STYLE1">暂无记录</td>
    </tr>
					<?
					}else{
						$id		=	rtrim($id,',');
						$sql	=	"select * from `ag_zhenren_zz` where id in($id) order by id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						$inmoney	=	0;
						$outmoney	=	0;
						while($rows = $query->fetch_array()){
							if(($i%2)==0) $bgcolor="#FFFFFF";
							else $bgcolor="#F5F5F5";
							$i++;
							if($rows["zz_type"]=='w')
							$inmoney +=$rows["zz_money"];
							elseif($rows["zz_type"]=='d')
							$outmoney +=$rows["zz_money"];
					?>
                    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" >
	  <td><?=$rows["zz_time"]?></td>
	  <td><?=$rows["billno"]?></td>
	  <td><?=sprintf("%.2f",abs($rows["zz_money"]))?></td>
	  <td><?=zzTypeName($rows["zz_type"])?></td>
      <td><?=$rows["ok"]==1?"成功":"<font color='red'>失败</font>"?></td>
	</tr>
                    <? }}?>
  </table>
	 <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">本页网站转娱乐场总金额：<font color="#D7524E"><?=sprintf("%.2f",$inmoney)?></font>，本页娱乐场转网站总金额：<font color="#D7524E"><?=sprintf("%.2f",$outmoney)?></font></a></li></ul>
  </div>
						</div>
				    </div>
				  </div>

				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>

</body>
</html>