<?php
session_start();

$quanxian=$_SESSION["quanxian"];
//echo json_encode($quanxian) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>left</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link href="css/system.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="left">
	<div class="nav1"><img src="images/system_ico.jpg" alt="ico" width="15" height="12" />功能菜单</div>
	<div class="border">
		<div class="bg_01">
			<div class="bg_02">
				<div class="bg_03">
					<div class="system">
						<div class="img"></div>
						<div class="txt10"><span>众盈彩票</span></div>
					</div>
					<?php
					if(strpos($quanxian,'zdgl') || strpos($quanxian,'sgjzd')){
					?>
					<div class="bg_10" style="display:none" id="zdgl" onclick="s_h('zdgl','zdgl_1')">注单管理</div>
					<div class="bg_11" id="zdgl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" height="30" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="zdgl/list.php?status=0" target="mainFrame" >单式注单</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/cg_result.php?status=0" target="mainFrame">串关注单</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/check_zd.php" target="mainFrame" >核查注单</a></td>
							</tr>
							<?php
							if(strpos($quanxian,'sgjzd')){
							?>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/sgjds.php?status=0" target="mainFrame">手工结单式</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/sgjcg.php?status=0" target="mainFrame">手工结串关</a></td>
							</tr>
							<?php
							}
							?>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/bet_lose.php" target="mainFrame">滚球未审核注单</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="zdgl/index.html" target="mainFrame">滚球自动审核</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'bfgl')){
					?>
					<div style="display:none" class="bg_10" id="bfgl" onclick="s_h('bfgl','bfgl_1')">比分管理</div>
					<div class="bg_11" id="bfgl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/zqbf.php" target="mainFrame">足球比分</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/lqbf.php" target="mainFrame">篮球比分</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/wqbf.php" target="mainFrame">网球比分</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/pqbf.php" target="mainFrame">排球比分</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/bqbf.php" target="mainFrame">棒球比分</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bfgl/list.php?type=3" target="mainFrame">足球冠军</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>		
					<?php
					if(strpos($quanxian,'hygl')){
					?>
					<div class="bg_10" id="hygl" onclick="s_h('hygl','hygl_1')">用户管理</div>
					<div class="bg_11" id="hygl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="hygl/list.php?1=1" target="mainFrame"  >直属会员</a></td>
							</tr>
                 <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
							<td align="center" valign="middle"><a href="dlgl/dailist.php?1=1" target="mainFrame">账号管理</a></td>
							</tr>
                         
                                <tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="hygl/group.php" target="mainFrame"  >会员组管理</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="hygl/login_ip.php" target="mainFrame" >ip查询</a></td>
							</tr>
							<tr style='display:none'  onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="hygl/jkhy.php" target="mainFrame" >监控会员</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="hygl/lsyhxx.php" target="mainFrame" >银行信息</a></td>
							</tr>
                            <tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td  align="center" valign="middle"><a href="hygl/check_userfs.php" target="mainFrame" >核查返水</a></td>
                            </tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'cwgl') || strpos($quanxian,'jkkk')){
					?>
					<div class="bg_10" id="cwgl" onclick="s_h('cwgl','cwgl_1')">财务管理</div>
					<div class="bg_11" id="cwgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/chongzhi.php?status=3" target="mainFrame"  >在线充值</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/tixian.php?status=2" target="mainFrame"  >提款管理</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/huikuan.php?status=0" target="mainFrame">转账汇款</a></td>
							</tr>
							<?php
							if(strpos($quanxian,'jkkk')){
							?>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/cksz.php" target="mainFrame" >汇款设置</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/man_money.php" target="mainFrame">加款扣款</a></td>
							</tr>
							<?php
							}
							?>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cwgl/hccw.php?" target="mainFrame">资金变动</a></td>
							</tr>
							<tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td  align="center" valign="middle"><a href="cwgl/zhuanzhang.php?ok=" target="mainFrame">转账记录</a></td>
                            </tr>
							<tr style="display:none" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
                            <td align="center" valign="middle"><a href="cwgl/jifen.php?status=0" target="mainFrame">积分记录</a></td>
                             </tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'cwgl')){
					?>
					<div style="display:none" class="bg_10" id="fsgl" onclick="s_h('fsgl','fsgl_1')">返水管理</div>
					<div class="bg_11" id="fsgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30">
								<td align="center" valign="middle"><a href="hygl/group_edit.php?id=1#fs" target="mainFrame">返水设置</a></td>
							</tr>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'xxgl')){
					?>
					<div class="bg_10" id="xxgl" onclick="s_h('xxgl','xxgl_1')">消息管理</div>
					<div class="bg_11" id="xxgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xxgl/add.php?1=1" target="mainFrame">公告管理</a></td>
							</tr>
							<tr  onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td  align="center" valign="middle"><a href="xxgl/sys_msg.php" target="mainFrame">站内消息</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xxgl/tsjy.php?1=1" target="mainFrame">意见反馈</a></td>
							</tr>
							<tr style="display:none"   onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td  align="center" valign="middle"><a href="xxgl/ssgl.php" target="mainFrame">申诉管理</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'dlgl')){
					?>
						<div style="display:none"  class="bg_10" id="dlgl" onclick="s_h('dlgl','dlgl_1')">代理管理</div>
					<div class="bg_11" id="dlgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                         <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
							<td align="center" valign="middle"><a href="dlgl/dailist.php?1=1" target="mainFrame">代理列表</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/report_daili.php" target="mainFrame">直属代理报表</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'bbgl')){
					?>
					<div class="bg_10" id="bbgl" onclick="s_h('bbgl','bbgl_1')">报表管理</div>
					<div class="bg_11" id="bbgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr style="display:none" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/report_top.php" target="mainFrame" >报表查看</a></td>
							</tr>
							<!--<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/report_day.php" target="mainFrame" >财务报表</a></td>-->
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/allorder.php" target="mainFrame" >投注报表</a></td>
							</tr>
						<tr style="display:none"  onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/hl.php" target="mainFrame" >报表忽略</a></td>
							</tr>
							<tr style="display:none"  onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="bbgl/yecx.php" target="mainFrame" >历史余额</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'ssgl')){
					?>
					<div style="display:none" class="bg_10" id="ssgl" onclick="s_h('ssgl','ssgl_1')">赛事管理</div>
					<div class="bg_11" id="ssgl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/ss_list.php?type=bet_match" target="mainFrame">足球赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/ss_list.php?type=lq_match" target="mainFrame">篮球赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/ss_list.php?type=tennis_match" target="mainFrame">网球赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/ss_list.php?type=volleyball_match" target="mainFrame">排球赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/ss_list.php?type=baseball_match" target="mainFrame">棒球赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/list.php?type=3" target="mainFrame" >冠军赛事</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/zczds.php" target="mainFrame" >早餐转单式</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="ssgl/gpsz.php" target="mainFrame" >关盘设置</a></td>
							</tr>
						</table>
					</div>
					
					<div class="bg_10" id="cqsscgl" onclick="s_h('cqsscgl','cqsscgl_1')">彩票管理</div>
					<div class="bg_11" id="cqsscgl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="Lottery/Order.php?js=0" target="mainFrame" >即时注单</a></td>
							</tr>
                            
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="Lottery/auto_2.php" target="mainFrame" >开奖设置</a></td>
							</tr>
                            	<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="Lottery/zdxy.php" target="mainFrame" >注单校验</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="Lottery/Odds.php" target="mainFrame" >赔率设置</a></td>
							</tr>
						</table>
					</div>
					<div style="display:none" class="bg_10" id="livegl" onclick="s_h('livegl','livegl_1')">真人管理</div>
					<div class="bg_11" id="livegl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="zhenren/BetRecord.php" target="mainFrame" >下注记录</a></td>
                            </tr>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="zhenren/CreditRecord.php" target="mainFrame" >额度记录</a></td>
                            </tr>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="zhenren/MemberReport.php" target="mainFrame" >会员报表</a></td>
                            </tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'lhcgl')){
					?>
					<div class="bg_10" id="lhcgl" onclick="s_h('lhcgl','lhcgl_1')">六合彩管理</div>
					<div class="bg_11" id="lhcgl_1">
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="Six/Six_Auto.php" target="mainFrame">手动开奖结算</a></td>
							</tr>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="Six/Six_Odds.php" target="mainFrame">香港六合赔率</a></td>
							</tr>
                              <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="Six/Six_tj.php" target="mainFrame">香港六合盘面统计</a></td>
							</tr>
                             <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cqSix/Six_Odds.php" target="mainFrame">极速六合赔率</a></td>
							</tr>
                            <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="Six/Six_Order.php" target="mainFrame">注单列表查询</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>

					<?php
					if(strpos($quanxian,'rzgl')){
					?>
					<div class="bg_10" id="rzgl" onclick="s_h('rzgl','rzgl_1')">日志管理</div>
					<div class="bg_11" id="rzgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="rzgl/list.php?show=all" target="mainFrame" >日志管理</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>	
					<?php
					if(strpos($quanxian,'jyqk')){
					?>
					<div style="display:none" class="bg_10" id="jyqk" onclick="s_h('jyqk','jyqk_1')">交易情况</div>
					<div class="bg_11" id="jyqk_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="jyqk/ft_danshi.php" target="mainFrame" >即时交易</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="jyqk/ft_danshi.php?match_type=0" target="mainFrame" >早餐交易</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'sjgl')){
					?>
					<div class="bg_10" id="sjgl" onclick="s_h('sjgl','sjgl_1')">数据管理</div>
					<div class="bg_11" id="sjgl_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="sjgl/qcsj.php" target="mainFrame">清除数据</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="sjgl/sjyh.php" target="mainFrame">数据优化</a></td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'xtgl')){
					?>
					<div class="bg_10" id="xtgl" onclick="s_h('xtgl','xtgl_1')">系统管理</div>
					<div class="bg_11" id="xtgl_1">
						<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/set_site.php" target="mainFrame" >系统设置</a></td>
							</tr>
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/send_back_default.php" target="mainFrame" >系统默认回水设置</a></td>
							</tr>
							<!--tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/lmgl.php" target="mainFrame" >栏目管理</a></td>
							</tr>
							<tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/dqxz.php" target="mainFrame">地区限制</a></td>
							</tr>
							<tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/llfx.php" target="mainFrame">流量分析</a></td>
							</tr>
							<tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/llmx.php" target="mainFrame">流量明细</a></td>
							</tr>
							<tr  style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF; display: none;" height="30" >
								<td align="center" valign="middle"><a href="xtgl/set_uid.php" target="mainFrame">接水账号</a></td>
							</tr>
							<tr style='display:none' onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="cj/reload.php" target="mainFrame">UID</a></td>
							</tr-->
						</table>
					</div>
					<?php
					}
					?>
					<?php
					if(strpos($quanxian,'glygl')){
					?>
					<div class="bg_10" id="glygl" onclick="s_h('glygl','glygl_1')">管理员管理</div>
					<div class="bg_11" id="glygl_1">
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
								<td align="center" valign="middle"><a href="glygl/user.php" target="mainFrame">管理员管理</a></td>    </tr>
                                <tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;" height="30" >
                                <!--td align="center" valign="middle"><a href="glygl/order.php" target="mainFrame">注单监控</a></td-->    
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					<div class="bg_10" id="xgmm" onclick="s_h('xgmm','xgmm_1')">修改密码</div>
					<div class="bg_11" id="xgmm_1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" height="30" style="background-color:#FFFFFF;">
								<td align="center" valign="middle"><a href="set_pwd.php" target="mainFrame" >修改密码</a></td>
							</tr>
						</table>
					</div>
					<div class="bg_12">
						<input name="按钮" type="button" class="button" value="退出" id="out"/>
						<input name="按钮" type="button" class="button" value="监控" id="gg"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/left.js"></script>
</body>
</html>