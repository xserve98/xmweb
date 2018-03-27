<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("pay/moneyconfig.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$sub = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<META http-equiv="pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
</head>
<body>
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
<div class="wraper">


	
	
		
			
			
				
					
						<div class="tit">
							<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>我的钱包
							<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
						</div>
						<div style="height: 44px;"></div>
		














<script type="text/javascript">
jQuery(document).ready(function() {
	var isLogin = true;
	if (isLogin == true) {
		getBalance("MAIN_WALLET");
	}
});
</script>
<div class="info_head">
	<img src="../../cscpLoginWeb/images/CN/caiShenCP/mobile/transfer_head_bg.jpg"/>
		<div class="info_user">
		<p><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?>				<img src="../../cscpLoginWeb/images/CN/caiShenCP/mobile/icon_info2.png" alt="点击查看个人信息" onclick="javascript:window.location.href='/memberInfo'" align="absmiddle" style="width: 22px; height: 22px; display: inline-block;"/>
			</a>
		</p>
		<span>余额：<b id="money"><?=sprintf("%.2f",$userinfo["money"])?> 元</b>
		<img src="../../cscpLoginWeb/images/CN/caiShenCP/mobile/icon/shuaxin.png"  onclick="javascript:window.location.href=''"></span>
	</div>
</div>
		<div class="info_tit">
			<p class="on"><a href="javascript:void(0);" data-ajax="false">存款</a></p>
			<p><a href="/get_money" target="_self" data-ajax="false">取款</a></p>
			<p><a href="/data_money" target="_self" data-ajax="false">记录</a></p>
		</div>
		<div class="wrap_div bg2">
			<!--div class="account_wrap wrap bb bs">
				</div-->
				<div id="weChatPay">
					<div style="height: 20px;">
		          	</div>
					       <div class="wrap_div pa10 bb">
				              	<div class="bd_b bd_d" onclick="self.location.href='/member/mobao.php'"><span class="wechatFont">在线充值</span></div>
				        	</div>
							<div class="wrap_div pa10 bb">
				              	<div class="bd_b bd_d" onclick="self.location.href='/member/wx_pay.php'"><span class="wechatFont">微信扫码</span></div>
				        	</div>
		          	
							<div class="wrap_div pa10 bb">
				              	<div class="bd_b bd_d" onclick="self.location.href='/member/ali_pay.php'"><span class="wechatFont">支付宝扫码</span></div>
				        	</div>
		          	
							<div class="wrap_div pa10 bb">
				              	<div class="bd_b bd_d" onclick="self.location.href='/member/hk_money.php'"><span class="wechatFont">网银汇款</span></div>
				        	</div>
							
		          	<div class="sp_n">
				    	<h3>支付教程(温馨提示)</h3>
						<p><span>1、</span><em><font color="#B02216"></font>将产生的付款二维码截屏或长按二维码并保存图片至相册。</em></p>
				        <p><span>2、</span><em>再使用微信识别相册二维码进行付款，付款成功自动到账。</em></p>
				        <p><span>3、</span><em>为了避免掉单情况的发生，请您在支付完成后，等待"支付成功"提示页面，并返回上一个页面及时刷新查看支付状态。</em></p>
				        <p><span>4、</span><em>支付未到账？无法支付？请联系<span class="noflont" onclick="onlineService();">在线客服</span>进行咨询。</em></p>
				    	 <p><span>5、</span><em>请避免存入个位数为零0金额，便于区别您的入款（例如51，204，3001，10008等等）。谢谢大家的支持与配合！</em></p>
				    </div>
				</div>

<?php include_once("../modules/foots.php"); ?>

</div>
</body>
<script type="text/javascript">
$("#InType").val("");
</script>
</html>