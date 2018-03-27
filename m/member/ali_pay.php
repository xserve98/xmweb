<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/lottery.inc.php");
include_once("../class/user.php");
include_once("../common/function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$sub = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css"/>
	<script type="text/javascript">
        //数字验证 过滤非法字符
        function clearNoNum(obj){
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != ''){
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value)) {
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		function SubInfo() {
			if($('#v_Name').val()=='') {
				alert('请输入支付宝昵称！');
				$('#v_Name').focus();
                return false;
			}
			var hk = $('#v_amount').val();
            if(hk==''){
                alert('请输入付款金额！');
                $('#v_amount').focus();
                return false;
            }else{
				hk = hk*1;
				if(hk<10){
					alert('充值金额最低为：10元！');
					$('#v_amount').select();
					return false;
				}
			}
			if($('#cn_date').val()==''){
                alert('请选择付款日期！');
                $('#cn_date').focus();
                return false;
            }
			$('#form1').submit();
		}
	</script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var isRecord = 0 ;
		if(isRecord ==1){
			$("#OKpaymentMethod").html(l_bankPaymentMethod['']);
		}else{
				jQuery("#onLineBankForm").validationEngine({
				showOneMessage : true,
				maxErrorsperField : 1,
				onValidationComplete : onLineBankYinBaoFormSubmit
				});
		}
		
		 $("#maskDiv").height(document.body.scrollHeight);
		 $("#maskDiv").width(document.body.scrollWidth);
	});
</script>

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
	<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>支付宝扫码
	<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
</div>
<div style="height: 44px;"></div>

	 
	
		<div class="inputThree">
		
	<table width="100%" border="0" cellpadding="0" cellspacing="1">
		<tr>
			<td colspan="2" class="pay_ma">
				<span>　　　　 <img src="/member/images/zfb.jpg" width="200" /></span>

		<form id="form1" method="post" action="hk_money.php?into=true" name="form1">
			<tr>
				<td class="bg" width="22%" align="right"><br>账号：</td>
				<td><br><?=$_SESSION['username'];?></td>
			</tr>
			<tr>
				<td class="bg" align="right">昵称：</td>
				<td><input name="v_Name" type="text" class="input_bg inputClass" id="v_Name" onfocus="javascript:this.select();" /></td>
			</tr>
			<tr>
				<td class="bg" align="right">金额：</td>
				<td><input name="v_amount" type="text" class="input_bg inputClass" id="v_amount" onkeyup="clearNoNum(this);" maxlength="10" /></td>
			</tr>
			<tr>
				<td class="bg" align="right">日期：</td>
				<td>
					<input name="cn_date" type="text" id="cn_date" class="input_bg inputClass" maxlength="10" readonly="readonly" value="<?=date("Y-m-d h:i:s",$lottery_time)?>" />
				</td>
			</tr>
			<tr>
				<td class="bg" align="right"></td>
				<td height="50">
					<input type="hidden" name="IntoBank" value="支付宝扫码" />
					<input type="hidden" name="InType" value="支付宝扫码" />
					<input type="hidden" name="v_site" value="" />
					<br>
					<button name="SubTran" type="button" class="bd_dl" id="SubTran" onclick="SubInfo();">提交信息</button>
				</td>
			</tr>
		</form>
	</table>
</div>
				<span>
					1、最低入款金额为10元！<br/><br/>
					2、在金额转出之后请务必填写该页下方的付款信息表格<br/><br/>
					3、填写完毕后，再次确认信息，并提交，财务会在尽快为您处理！<br/><br/>
					<font color="red">4、如长时间未到帐，请联系在线客服！</font><br/>
				</span>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>