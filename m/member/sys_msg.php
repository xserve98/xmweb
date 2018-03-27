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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=$web_site['web_title']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="/member/images/member.css"/>
	<script type="text/javascript" src="/member/images/member.js"></script>
<link href="/cscpLoginWeb/images/CN/caiShenCP/pc/yzc_favicon.ico" rel="shortcut icon"/>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-ui-1.10.4.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="/cscpLoginWeb/css/custom-theme/jquery-ui-1.10.4Red.custom.css"/>
<script type="text/javascript" src="/cscpLoginWeb/js/datepicker/jquery.ui.datepicker-zh-CN.js"></script>
</head>
<body class="bodyColorW">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/language/CN/main.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/patrn.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/login.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/util.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/account.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/conversion.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/register.js"></script>

<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css" />

<script type="text/javascript" src="/cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>  
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script> 
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/artDialog/skins/black.css"/>

<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>

<script type="text/javascript" src="/cscpLoginWeb/scripts/personalMsg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/report.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLotto.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportM8Sport.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLive.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportDsLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportOg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportBBIN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportYY.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportGG.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportPt.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportSg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAllBet.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportIg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/dialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/soltsPage.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/other-caiShenCP.js"></script>

<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a> 消息中心
			<a href="../app/home?l=CN" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>

		
				
				
	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a> 信息中心
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>

		<div style="height: 44px;"></div>
		<div id="personalMsgAll" class="wrap_div bg2">
			<div id="message_tit" class="message_tit">
				<!-- <p>
					<i id="currMemberNum">（0）</i>条未读信息
				</p> -->
				<span>
					<a class="mes_bt del_bt bs" href="javascript:void(0);" onclick="if(confirm('您真的要删除该条消息吗？')){Go('sys_msg_del.php?id=<?=$rows["msg_id"]?>');}return false">删除全部 </a>
				</span>
			</div>
			
			<div id="personalMsg" class="account_wrap wrap bb">
				
				<table class="table_list" id="table_personalMsg" width="90%" >
				<thead >
				    <tr style="border-bottom: 1px solid #2061b3;">
					    <th colspan=5>
					        <div class="tab_bg_3"></div>
				            &nbsp;&nbsp;&nbsp;<input id="reverse" type="checkbox"/>全选/全不选
				            <input id="readmsg" type="checkbox"/>已读
				            <input id="noread" type="checkbox"/>未读
				            <input type="button" onclick="deleteMoreMsg();" value="删除"/>
					    </th>
					</tr>
					<tr >
<?php include_once("../modules/foots.php"); ?>
			<div class="content" style="color:#fff">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr bgcolor="#2061b3">
						<th width="40" align="center">状态</th>
						<th align="center">短信标题</th>
						<th width="100" align="center">发布时间</th>
					</tr>
					<?php
					$sql		=	"select msg_id from k_user_msg where uid=".$_SESSION["uid"]." order by islook asc,msg_id desc";
					$query		=	$mysqli->query($sql);
					$sum		=	$mysqli->affected_rows; //总页数
					$thisPage	=	1;
					if(@$_GET['page']){
						$thisPage	=	$_GET['page'];
					}
					$page		=	new newPage();
					$perpage	= 20;
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
					<tr bgcolor="<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$i%2==0?'#FFFFFF':'#F5F5F5'?>'" >
						<td align="center"><font color="#FF0000"><?=$rows["islook"]==1?'已读':'未读'?></font></td>
						<td align="left"><a href="javascript:void(0);" onclick="Go('sys_msg_show.php?id=<?=$rows["msg_id"]?>');return false"><?=strlen(trim($rows["msg_title"]))?$rows["msg_title"]:'无标题信息'?></a></td>
						<td align="center" style="color:#333"><?=date("Y-m-d",strtotime($rows["msg_time"]))?></td>
						<!--td align="center"><a href="javascript:void(0);" onclick="if(confirm('您真的要删除该条消息吗？')){Go('sys_msg_del.php?id=<?=$rows["msg_id"]?>');}return false" style="color:#00F">点击删除</a></td-->
					</tr>
					<?php
							$i++;
						}
					}
					?>
					<tr>
						<th colspan="4" align="center">
							<div class="Pagination">
								<!--?=$page->get_htmlPage("sys_msg.php?1=1");?-->
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
