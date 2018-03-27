<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

//设置银行卡信息
if($_GET["action"]=="save"){
	$pay_card=htmlEncode($_POST["pay_card"]);
	$pay_num=htmlEncode($_POST["pay_num"]);
	$pay_address=htmlEncode($_POST["pay_address"]);
	$vlcodes=$_POST["vlcodes"];
	
	if($vlcodes!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入");
	}
	$_SESSION["randcode"]=rand(10000,99999); //更换一下验证码
    if($pay_card==""){
		message("请输入您的收款银行");
	}
	if($pay_num==""){
		message("请输入您正确的银行账号");
	}
	if($pay_address==""){
		message("请输入您的开户行地址");
	}
	
	if(user::update_paycard($_SESSION["uid"],$pay_card,$pay_num,$pay_address,$userinfo["pay_name"],$_SESSION["username"])){
		message('恭喜你，银行绑定成功','/get_money');
		exit();
	}else{
		message('设置出错，请重新设置你的银行卡信息','/set_card');
	}
}
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="/Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>

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
<input type="hidden" name="path" id="path" value="/cscpLoginWeb" />
<input type="hidden" name="lottoLink" id="lottoLink" value="https://hk.mhsw.sh.cn/lottoclient/images/speed.gif,https://hk.fshuiquan.com.cn/lottoclient/images/speed.gif,http://hk.cyweb.gd.cn/lottoclient/images/speed.gif" />
<input type="hidden" name="lotteryLink" id="lotteryLink" value="https://ssc.mhsw.sh.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.fshuiquan.com.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.china-at.cn/lotteryweb/siteOne/images/speed.gif" />


<div class="wraper">


	
	
		
			
			<div class="tit">
				<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>绑定您的账号
				<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
			</div>
			<div style="height: 44px;"></div>
				<div class="wrap_div bg2 wraper">
					<div class="info_tab02">
        <div class="wrap">
            <form action="?action=save" method="post" name="form1" onsubmit="return check_submit_pay();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="bg" align="right">会员账号：</td>
                        <td class="c_red"><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款人姓名：</td>
                        <td class="c_red"><?=$userinfo["pay_name"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款银行：</td>
                        <td>
                            <input name="pay_card" type="text" class="input_150" id="pay_card"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">例如：工商银行</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">银行账号：</td>
                        <td>
                            <input name="pay_num" type="text" class="input_150" id="pay_num"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">请输入您的银行账号</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">开户行地址：</td>
                        <td>
                            <input name="pay_address" type="text" class="input_150" id="pay_address"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">如 "辽宁省沈阳市"</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">验证码：</td>
                        <td>
                            <input name="vlcodes" type="text" class="input_80" id="vlcodes" maxlength="4" style="width: 95px"/>
                            <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="width: 50px; height: 30px; cursor: pointer; position: relative; bottom: 1px" onclick="next_checkNum_img()" />
                            <span class="c_red">*</span>
                            <div class="c_blue">请输入验证码</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50">
                            <button name="submit" type="submit" id="submit" class="submit_108">确认修改</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
									<div class="sp_n">
							    	<h3>友情提示</h3>
									<p><span>1、</span><em>银行账户持有人姓名必须与注册时输入的姓名一致，否则无法申请提款。</em></p>
							        <p><span>2、</span><em>每位客户只可以使用一张银行卡进行提款，如需要更换银行卡请联系<span class="noflont" onclick="onlineService();">在线客服</span>进行咨询，否则提款将被拒绝。</em></p>
							    </div>
							</div>
						</div>

<?php include_once("../modules/foots.php"); ?>

    <script type="text/javascript" src="/js/base.js"></script>
</body>
</html>