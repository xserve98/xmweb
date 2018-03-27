<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
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
                    <li><a href="cha_zhenren.php?type=4">娱乐场记录</a></li>
                    <li class="active"><a href="cha_jifen.php?type=4">积分记录</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
                    <div id="top_lishi">
                      <div class="waikuang00">
                        <table class="table table-bordered">
    <tr class="sekuai_01" align="center" height="20">
	  <td>时间</td>
	  <td>兑换积分</td>
	  <td>增加金额</td>
	  <td>状态</td>
	</tr>
<?php
					$sql	=	"select m_id from `k_jifen` where `uid`=$uid and type=3 order by `m_id` desc";
					$query	=	$mysqli->query($sql);
					$sum	=	$mysqli->affected_rows; //总页数
					$thisPage	=	1;
					if(@$_GET['page']){
						$thisPage	=	$_GET['page'];
					}
					$page		=	new newPage();
					$perpage	= 	20;
					$thisPage	=	$page->check_Page($thisPage,$sum,$perpage);

					$id		=	'';
					$i		=	1; //记录 uid 数
					$start	=	($thisPage-1)*$perpage+1;
					$end	=	$thisPage*$perpage;
					while($row = $query->fetch_array()){
						if($i >= $start && $i <= $end){
							$id .=	$row['m_id'].',';
						}
						if($i > $end) break;
						$i++;
					}
					if($id){
						$id		=	rtrim($id,',');
						$sql	=	"select * from `k_jifen` where m_id IN($id) order by m_id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						$inmoney	=	0;
						$outmoney	=	0;
						while($rows = $query->fetch_array()){
					?>
	<tr bgcolor="<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>'" >
		<td align="center"><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
        <td align="center"><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
        <td align="center"><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
		<td align="center"><?php
							if($rows["status"]==1){
								$sum_money += abs($rows["m_value"]);
								echo '<span style="color:#FF0000;">成功</span>';
							}else if($rows["status"]==0){
								echo '<span style="color:#000000;">失败</span>';
							}else{
								echo '<span style="color:#0000FF;">系统审核中</span>';
							}
							?></td>		
	</tr>
	<?php
			$i++;
		}
	}else{
	?>
	<tr align="center" bgcolor="#FFFFFF"  height="20" onmouseover="this.style.background='#EEEEEE'" onmouseout="this.style.background='#ffffff'">
	  <td height="35" colspan="4"><span class="STYLE2">暂无积分兑换记录</span></td>
	  </tr>
     <? }?> 
  </table>
	 <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">本页兑换积分：<font color="#D7524E"><?=sprintf("%.2f",$sum_money)?></font></a></li></ul>
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