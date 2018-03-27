<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

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

$m_type=$_GET["m_type"];
$m_type=$m_type==""?"3,4,5,6":$m_type;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>其他加/减款记录</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript" src="images/member.js"></script>
	<!--[if IE 6]><script type="text/javascript" src="images/DD_belatedPNG.js"></script><![endif]-->
	<script type="text/javascript" src="../js/calendar.js"></script>
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px #FFF solid;">
	<?php 
	include_once("mainmenu.php");
	?>
	<tr>
		<td colspan="2" align="center" valign="middle">
			<?php 
			include_once("moneymenu.php");
			?>
			<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td height="25" colspan="7" align="center" bgcolor="#3C3C3C" style="color:#FFF">
							<?php 
							include_once("moneysubmenu.php");
							?>
						</td>
					</tr>
					<tr bgcolor="#950D0D" style="color:#FFF">
						<th align="center">美东时间</th>
						<th align="center">北京时间</th>
						<th align="center">流水号</th>
						<th align="center">金额(+/-)</th>
						<th align="center">类型</th>
						<th align="center">备注说明</th>
						<th align="center">状态</th>
					</tr>
					<?php
					$sql	=	"select m_id from `k_money` where `uid`=$uid and type in($m_type) order by `m_id` desc";
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
						$sql	=	"select * from `k_money` where m_id in($id) order by m_id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						$addmoney	=	0;
						$submoney	=	0;
						while($rows = $query->fetch_array()){
					?>
					<tr bgcolor="<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>'" >
						<td align="center"><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
						<td align="center"><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
						<td align="center"><?=$rows["m_order"]?></td>
						<td align="center"><?=sprintf("%.2f",$rows["m_value"])?></td>
						<td align="center"><?=mtypeName($rows["type"])?></td>
						<td align="center"><?=$rows["about"]?></td>
						<td align="center">
							<?php
							if($rows["status"]==1){
								if($rows["m_value"]>0){
									$addmoney += abs($rows["m_value"]);
								}else{
									$submoney += abs($rows["m_value"]);
								}
								echo '<span style="color:#FF0000;">成功</span>';
							}else if($rows["status"]==0){
								echo '<span style="color:#000000;">失败</span>';
							}else{
								echo '<span style="color:#0000FF;">系统审核中</span>';
							}
							?>
						</td>
					</tr>
					<?php
							$i++;
						}
					}
					?>
					<tr>
						<th colspan="7" align="center">
							<div class="Pagination">
								本页加款成功总金额：<font color="#ff0000"><?=sprintf("%.2f",$addmoney)?></font> RMB&nbsp;&nbsp;减款成功总金额：<font color="#ff0000"><?=sprintf("%.2f",$submoney)?></font> RMB&nbsp;&nbsp;
								<?=$page->get_htmlPage("data_o_money.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i."&m_type=".$m_type);?>
							</div>
						</th>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
</body>
</html>
