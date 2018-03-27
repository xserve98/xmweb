<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     	= 	$_SESSION['uid'];
$loginid 	= 	$_SESSION['user_login_id'];
$username	=	$_SESSION["username"];
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

$atype=$_GET["atype"];
$atype=$atype==""?"1":$atype;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>高频时时彩</title>
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
			include_once("recordmenu.php");
			?>
			<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr bgcolor="#950D0D" style="color:#FFF">
						<th align="center">彩种/投注时间</th>
						<th align="center">注单号/期数</th>
						<th align="center">投注详细信息</th>
						<th align="center">下注金额</th>
						<th align="center">可赢</th>
						<th align="center">派彩</th>
						<th align="center">状态</th>
					</tr>
					<?php
					include ("../Lottery/include/order_info.php");
					$atypename	=get_gameName($atype);
					$table	=	"c_bet";
					$sql	=	"select id from $table where money>0 and username='$username' and type='香港六合彩' order by id desc";
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
							$id .=	$row['id'].',';
						}
						if($i > $end) break;
						$i++;
					}
					if($id){
						$id		=	rtrim($id,',');
						$sql	=	"select * from $table where id in($id) order by id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						
						$paicai	=	0;
						$status	=	"";
						$sum_tz	=	0;
						$sum_pc	=	0;
						while($rows = $query->fetch_array()){
							if($rows['js']==1){
								if($rows['win']==0){
									$paicai	=	$rows['money'];
									$status	=	"和局";
								}else if($rows['win']<0){
									$paicai	=	0;
									$status	=	"<span style='color:#00CC00;'>输</span>";
								}else{
									$paicai	=	$rows['win'];
									$status	=	"<span style='color:#FF0000;'>赢</span>";
								}
							}else{
								$paicai	=	0;
								$status	=	"未结算";
							}
							$sum_tz	+=	$rows["money"];
							$sum_pc	+=	$paicai;
					?>
					<tr bgcolor="<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>'" >
						<td align="center"><?=$rows["type"]?><br><?=date("Y-m-d H:i:s",strtotime($rows["addtime"])+12*3600)?></td>
						<td align="center"><?=$rows["id"]?><br />第 <?=$rows["qishu"]?> 期</td>
						<td align="center"><?=$rows["mingxi_1"]?>【<font color="#FF0000"><?=$rows["mingxi_2"]?></font>】</td>
						<td align="center"><?=sprintf("%.2f",$rows["money"])?></td>
						<td align="center"><?=sprintf("%.2f",$rows["money"]*$rows["odds"])?></td>
						<td align="center"><?=sprintf("%.2f",$paicai)?></td>
						<td align="center"><?=$status?></td>
					</tr>
					<?php
							$i++;
						}
					}
					?>
					<tr>
						<th colspan="8" align="center">
							<div class="Pagination">
								本页下注总金额：<font color="#ff0000"><?=sprintf("%.2f",$sum_tz)?></font> RMB&nbsp;&nbsp;派彩总金额：<font color="#ff0000"><?=sprintf("%.2f",$sum_pc)?></font> RMB
								<?=$page->get_htmlPage("record_ss.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i."&atype=".$atype);?>
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