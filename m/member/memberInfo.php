<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("function.php");
include_once("../cache/website.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$web_site['web_title']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#personCenterForPhone p").removeClass("footer_info");
		$("#personCenterForPhone p").addClass("footer_info_on");
/* 		$("#personCenterForPhone span").css("color","#db1902"); */
	});
	
	$(function(){
	    //菜单隐藏展开
	   /*  $("#zhedie .accli").click(function(){
	        $(this).addClass("current").next("div.acc_sub").slideToggle(300).siblings("div.acc_sub").slideUp("slow");
	        $(this).siblings().removeClass("current");
	    });
	    $("#zhedie .accli:eq(0)").click(); */
	})
</script>

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
<script type="text/javascript">
jQuery(document).ready(function() {
	/* var isLogin = true;
	if (isLogin == true) {
		getBalance("MAIN_WALLET");
	} */
});
/* var $horizontal = $('.horizontal_screen') ; //可自定义横屏模式提示样式
var $document = $(document) ;
var preventDefault = function(e) {
    e.preventDefault();
};
var touchstart = function(e) {
    $document.on('touchstart touchmove', preventDefault);
};
var touchend = function(e) {
    $document.off('touchstart touchmove', preventDefault);
};

function listener(type){
    if('add' == type){
        //竖屏模式
        $horizontal.addClass('hide');
        $document.off('touchstart', touchstart);
        $document.off('touchend', touchend);
    }else{
        //横屏模式
        $horizontal.removeClass('hide');
        $document.off('touchstart', touchstart);
        $document.off('touchend', touchend);
    }
}

function orientationChange(){
    switch(window.orientation) {
        //竖屏模式
        case 0:
        case 180:
            listener('add');
            history.go(0);
        break;
        //横屏模式
        case -90:
        case 90:
            listener('remove');
            history.go(0);
        break;
    }
}

$(window).on("onorientationchange" in window ? "orientationchange" : "resize", orientationChange);

$document.ready(function(){
    //以横屏模式进入界面，提示只支持竖屏
    if(window.orientation == 90 || window.orientation == -90){
        listener('remove');
    }
}); */
</script>
<input type="hidden" name="path" id="path" value="/cscpLoginWeb" />
<input type="hidden" name="lottoLink" id="lottoLink" value="https://hk.mhsw.sh.cn/lottoclient/images/speed.gif,https://hk.fshuiquan.com.cn/lottoclient/images/speed.gif,http://hk.cyweb.gd.cn/lottoclient/images/speed.gif" />
<input type="hidden" name="lotteryLink" id="lotteryLink" value="https://ssc.mhsw.sh.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.fshuiquan.com.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.china-at.cn/lotteryweb/siteOne/images/speed.gif" />


	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>
			会员资料  <a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 43px;"></div>
		














<script type="text/javascript">
jQuery(document).ready(function() {
	var isLogin = true;
	if (isLogin == true) {
		getBalance("MAIN_WALLET");
	}
});
</script>
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
			<!-- <div class="acc_top accli current" onclick="javascript:window.location.href='../app/memberInfo'">
				<p>个人资料</p>
				<span class="acc_down"></span>
			</div> -->
			<div class="acc_sub sub_top bb" style="display: block;">
				<div class="acc_tit">账户信息</div>
								<table width="100%" border="0" class="table_a">
					<tbody>
					<tr>
                    <td width="120">会员账户：</td>
                    <td><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?> <!--span class="c_blue">(<?=$userinfo["is_daili"] == 1 ? "代理" : "会员"?>)</span--></td>
                </tr>
                <tr>
                    <td >注册时间：</td>
                    <td><?=$userinfo["reg_date"]?></td>
                </tr>
                <tr>
                    <td >最后登陆：</td>
                    <td><?=$userinfo["login_time"]?></td>
                </tr>
				<tr>
                    <td >所属盘口：</td>
                    <td><?=$userinfo['pankou']?> 盘</td>
                </tr>
                <!--tr>
                    <td >当前积分：</td>
                    <td><span class="c_green"><?=sprintf("%.2f",$userinfo["jifen"])?></span></td>
                </tr-->
                <?php if($userinfo["username"] != 'guest') { ?>
                    <tr>
                        <td >提款银行：</td>
                        <td>
                            <?php if($userinfo["pay_card"] == "") { ?>
                                <a href="/member/set_card.php" class="c_blue">点击设置您的银行资料</a>
                            <?php } else {
                                echo $userinfo["pay_card"];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td >开户姓名：</td>
                        <td><?=$userinfo["pay_name"]?></td>
                    </tr>
                    <tr>
                        <td >银行账号：</td>
                        <td>
                            <?php if($userinfo["pay_card"] == "") { ?>
                                <a href="/member/set_card.php" class="c_blue">点击设置您的银行资料</a>
                            <?php } else {
                                echo $userinfo["pay_num"];
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
						<div class="acc_tit">我的钱包</div>
				<table width="100%" border="0" class="table_a">
					<tbody>
						
							<tr>
								<td width="120">额度：<?=sprintf("%.2f",$userinfo["money"])?></td>
								<td width="*" class="MAIN_WALLET"></td>
							</tr>
						
					</tbody>
				</table>

			</div>
    </div>
	<?php include_once("../modules/foots.php"); ?>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>