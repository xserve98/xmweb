<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

if(!user::is_daili($uid)){
    message('你还不是代理，请先申请',"agent_reg.php"); 
}

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()-6*24*3600):$cn_begin;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>代理下级</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<link type="text/css" rel="stylesheet" href="images/member.css">
<script type="text/javascript" src="images/member.js"></script>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.STYLE1 {color: #000000}
body {
	background:#d7d3d3;
	font-size: 12px;
	font-family:"宋体";
	width:100%;
}
</style>
</head>

<body>
<?php 
include_once("mainmenu.php");
include_once("agentmenu.php");?>

			
<div class="content">
  <div class="waikuang00">
  <table border="0" width="100%" cellpadding="0" cellspacing="1" class="waikuang">
					<tr class="sekuai_01">
						<th align="center">会员账号</th>
						<th align="center">真实姓名</th>
						<th align="center">注册时间(美东/北京)</th>
						<th align="center">最近登录(美东/北京)</th>
						<th align="center">当前余额</th>
						<th align="center">在线</th>
						<th align="center">状态</th>
					</tr>
					<?php
					$sql	=	"select uid from `k_user` where `top_uid`=$uid  order by `uid` desc";
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
							$id .=	$row['uid'].',';
						}
						if($i > $end) break;
						$i++;
					}
					if($id){
						$id		=	rtrim($id,',');
						$sql	=	"select u.*,l.is_login from k_user u left outer join k_user_login l on u.uid=l.uid where u.uid in($id) order by u.uid desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						$sum_money	=	0;
						$sum_sxf	=	0;
						while($rows = $query->fetch_array()){
					?>
					<tr bgcolor="<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>'" >
						<td align="center"><?=$rows["username"]?></td>
						<td align="center"><?=$rows["pay_name"]?></td>
						<td align="center"><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"])+1*12*3600)?></td>
						<td align="center"><?=date("Y-m-d H:i:s",strtotime($rows["login_time"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["login_time"])+1*12*3600)?></td>
						<td align="center"><?=sprintf("%.2f",$rows["money"])?></td>
						<td align="center"><?=$rows["is_login"]==1?"<span style='color:#ff0000'>在线</span>":"离线"?></td>
						<td align="center"><?=$rows["is_stop"]==0?"<span style='color:#ff0000'>启用</span>":"停用"?></td>
					</tr>
					<?php
							$i++;
						}
					}
					?>
				</table>
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="waikuang">
	<tr class="sekuai_03">
	  <td colspan="6" class="fanye" style="width:100%"><span style="float:left;">下级会员总数：<font color="#FFFFFF"><?=$sum?></font></span> <?=$page->get_htmlPage("agent_user.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i);?>&nbsp;&nbsp;</td>
	</tr>
</table>
  </div>
</div>

<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>

</body>
</html>
