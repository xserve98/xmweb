<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("../include/newpage.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs	 =	$query->fetch_array();
?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script>
<link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css">
<link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
</head>
<body id="bodyid" class="skin_blue">
<?php include_once("usermenu.php"); ?>
<?php 
 $sql	=	"select msg_id from k_user_msg where uid=".$_SESSION["uid"]." and islook=0 order by islook asc,msg_id desc";
					$query		=	$mysqli->query($sql);
					$sum1		=	$mysqli->affected_rows; //总页数
					?>
	<div class="rightpanel rw">
		<div class="contentcontainer">
			<div class="mailbox clearfix">
				<div class="mt4 emailicon"></div>
				<div style="margin-left: 23px;" class="mt4">未读</div>
				<div style="margin-left: 10px;">
					<input type="text" class="textboxmail" value="<?=$sum1?>">
				</div>
			</div>
			<div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bordergrey">

					<tbody>
						 
                         	<?php
				   
					$sql		=	"select msg_id from k_user_msg where uid=".$_SESSION["uid"]." order by islook asc,msg_id desc";
					$query		=	$mysqli->query($sql);
					$sum		=	$mysqli->affected_rows; //总页数
					$thisPage	=	1;
					if(@$_GET['page']){
						$thisPage	=	$_GET['page'];
					}
					$page		=	new newPage();
					$perpage	= 10;
					$thisPage	=	$page->check_Page($thisPage,$sum,$perpage);

					$id		=	'';
					$i		=	1; //记录 uid 数
					$start	=	($thisPage-1)*$perpage+1;
					$end	=	$thisPage*$perpage;
					while($row = $query->fetch_array()){
						if($i >= $start && $i <= $end){
							$id .=	$row['msg_id'].',';
						}
						if($i > $end) break;
						$i++;
					}
					if($id){
						$id		=	rtrim($id,',');
						$sql	=	"select islook,msg_title,msg_time,msg_id from k_user_msg where msg_id in($id) order by islook asc,msg_id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						while($rows = $query->fetch_array()){
							
					?>
                         
                         
						<tr class="borderbtmgrey">
							<td width="2%">
                            <?php if($rows["islook"]==0){?>
                             <img src="/newdsn/images/new-indicator.png"> 
                             <? }?>
							</td>
							<td width="72%" class="algleft"><?=strlen(trim($rows["msg_title"]))?$rows["msg_title"]:'无标题信息'?></td>
							<td width="23%"><?=date("Y-m-d",strtotime($rows["msg_time"]))?> (<a onClick="dialog.url('<?=strlen(trim($rows["msg_title"]))?$rows["msg_title"]:'无标题信息'?>',620,400,'sys_msg_show.php?id=<?=$rows["msg_id"]?>')" href="javascript:;">详情</a>)
							</td>
						</tr>
						
						<?php
							$i++;
						}
					}
					?>
						 
						<tr>
							<td colspan="3">
<div class="page_info">
<?=$page->get_htmlPage("sys_msg.php?1=1");?>
</div>
							</td>
						</tr>

					</tbody>
				</table>

			</div>

		</div>


	</div>


</body></html>