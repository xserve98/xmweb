<?php
session_start();
include_once("../../include/config.php"); 
include_once("../../common/login_check.php");
include_once("../../common/logintu.php");
include_once("../../include/mysqli.php");
include_once("../../class/user.php");
include_once("../function.php");
include_once("../../cache/website.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>

<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>
<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>
			个人中心  <a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 43px;"></div>

<div class="info_head">
	<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/info_head_bg.jpg"/>
	<div class="info_user">
		<p><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?>				<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/icon_info2.png" alt="点击查看个人信息" onclick="javascript:window.location.href='/memberInfo'" align="absmiddle" style="width: 22px; height: 22px; display: inline-block;"/>
			</a>
		</p>
		<span>余额：<b id="money"><?=sprintf("%.2f",$userinfo["money"])?> 元</b>
		<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/icon/shuaxin.png"  onclick="javascript:window.location.href=''"></span>
	</div>
</div>

		<div class="account_wrap wrap bb bs" id="zhedie">
			<div class="acc_profile accli current" onclick="javascript:window.location.href='/memberInfo'">
				<p>个人资料</p>
				<span class="acc_right"></span>
			</div>

			<div class="acc_change accli" onclick="javascript:window.location.href='/password'">
				<p>更改密码</p>
				<span class="acc_right"></span>
			</div>
			
			<div class="acc_cqk accli" onclick="javascript:window.location.href='/set_money'">
				<p>在线存款</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_cqk accli" onclick="javascript:window.location.href='/get_money'">
				<p>在线取款</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_edzh accli" onclick="javascript:window.location.href='/ed_money'">
				<p>额度转换</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_report accli" onclick="javascript:window.location.href='/cha_cp/?rad=ygsds&cn_begin=<?=$t_day?>&cn_end=<?=$t_day?>&t=y'">
				<p>今日已结</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_report accli" onclick="javascript:window.location.href='/record_ss'">
				<p>未结明细</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_report accli" onclick="javascript:window.location.href='/data_money'">
				<p>存取记录</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_report accli" onclick="javascript:window.location.href='/data_ed_money'">
				<p>转换记录</p>
				<span class="acc_right"></span>
			</div>
			<div class="acc_xx accli" onclick="javascript:window.location.href='/member/sys_msg.php'">
				<p>消息中心</p>
				<span class="acc_right"></span>
			</div>
			
	</div>
	</div>
<?php include_once("../../modules/foots.php"); ?>
</body>
</html>