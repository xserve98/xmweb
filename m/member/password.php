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


if($_SESSION["username"] == 'guest') {
    message('试玩账户不能修改密码！');
    exit;
}

//设置登录密码
if($_GET["action"]=="pass"){
	$oldpass=trim($_POST["oldpass"]);
	$newpass=trim($_POST["newpass"]);
	
    if($oldpass==""){
		message("请输入您的原登录密码");
	}
	if(strlen($newpass)<6 || strlen($newpass)>20){
		message("新登录密码只能是6-20位");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldpass,$newpass,'password')){
		message('登陆密码修改成功','password.php');
	}else{
		message('登陆密码修改失败，请检查您的输入','password.php');
	}
}

//设置取款密码
if($_GET["action"]=="moneypass"){
	$oldmoneypass=trim($_POST["oldmoneypass"]);
    $newmoneypass=trim($_POST["newmoneypass"]);

    if($oldmoneypass==""){
		message("请输入您的原取款密码");
	}
	if(strlen($newmoneypass)!=6){
		message("请输入6位新取款密码");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldmoneypass,$newmoneypass,'qk_pwd')){
		message('取款密码修改成功','password.php');
	}else{
		message('取款密码修改失败，请检查您的输入','password.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>财神彩票</title>
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
			更改密码<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 44px;"></div>
		<form id="userPassWordForm" action="?">
			<div class="inputThree">
<?php include_once("../modules/foots.php"); ?>
        <div class="wrap">
            <form action="?action=pass" method="post" name="form1" onsubmit="return check_submit_login();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                      <td width="85">原登录密码：</td>
                        <td>
                    <input name="oldpass" type="password" class="validate[required,custom[onlyLetterNumber],minSize[6],maxSize[20]] input_bg inputClass" id="oldpass" maxlength="20"/>
                            <div id="oldpass_txt" class="c_red"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>新登录密码：</td>
                        <td>
                    <input name="newpass" type="password" class="validate[required,custom[onlyLetterNumber],minSize[6],maxSize[20],funcCall[callPassword]] input_bg inputClass" id="newpass" maxlength="20"/>
                        </td>
                    </tr>
                    <tr>
                        <td>确认新密码：</td>
                        <td>
                    <input name="newpass2" type="password" class="validate[required,minSize[6],maxSize[20],equals[txtNewPassword]] input_bg inputClass" id="newpass2" maxlength="20"/>
						</tr>
					</tbody>
				</table>
			</div><br><br>
             <button name="submit" type="submit" id="submit" class="bd_dl_a">确 定</button>
		</form>
	</div>
	
            <!--form action="?action=moneypass" method="post" name="form1" onsubmit="return check_submit_money();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td>原取款密码：</td>
                        <td>
                            <input name="oldmoneypass" type="password" class="input_150" id="oldmoneypass"/>
                            <span  class="c_red">*</span>
                            <div id="oldmoneypass_txt" class="c_red"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>新取款密码：</td>
                        <td>
                            <input name="newmoneypass" type="password" class="input_150" id="newmoneypass"/>
                            <span  class="c_red">*</span>
                            <div id="newmoneypass_txt" class="c_red"><em class="c_blue">请输入6位数字的新密码</em></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50"><button name="submit" type="submit" id="submit" class="bd_dl_a">确认修改</button></td>
                    </tr>
                </table>
            </form>
            <div class="info">
                <p><strong>忘记密码？</strong></p>
                <p>如果您忘记了密码，请与客服联系。</p>
                <p>为了保证会员的资金安全，请您谅解要扫描身份证件验证您的身份。</p>
                <p>也请您放心，您的资料绝对保密，谢谢您对腾飛娱乐城的支持！</p>
            </div-->
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>