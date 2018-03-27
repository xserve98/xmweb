<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");

$sql	=	"update k_user_msg set islook=1 where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."'";
$mysqli->query($sql);

$sql	=	"select * from k_user_msg where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."' limit 1";
$query	=	$mysqli->query($sql);  		
$rows	=	$query->fetch_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<title><?=$web_site['web_title']?></title> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript" src="images/member.js"></script>
<link href="/cscpLoginWeb/images/CN/caiShenCP/pc/yzc_favicon.ico" rel="shortcut icon"/>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		getPersonalMsgForMobile('1');
	});
</script>
</head>
<body style="background: #fff;">















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
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a> 消息内容
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>

		<div style="height: 44px;"></div>
		<div id="personalMsgAll" class="wrap_div bg2 pbtt">
<br>
			<div class="wraper">
			<div class="content">
				<!--table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<th align="center" bgcolor="#F9F9F9" style=" font-size:14px; color:#900"><?=$rows["msg_title"]?></th>
					</tr>
					<tr>
						<td align="left" style="line-height:22px;"><?=str_replace("\r\n","<br />",$rows["msg_info"])?></td>
					</tr>
					<tr>
						<td align="right" style="line-height:22px;" bgcolor="#F9F9F9"><?=$rows["msg_from"]?><br><?=date("Y-m-d h:i:s",strtotime($rows["msg_time"]))?></td>
					</tr>
				</table-->
				
				<div class="sp_n">
				    	<h3><font color="#FF0000"><?=$rows["msg_title"]?></font></h3><br><br>
			<p><em><font color="#000000"><?=str_replace("\r\n","<br />",$rows["msg_info"])?></font></em></p><br><br><br><br><br>
						<td>　　　　　　　　　　　　　　　　　　<font color="#4D0000"><?=$rows["msg_from"]?></font><br><br>
						　　　　　　　　　　　　　　　　　<font color="#0080FF"><?=date("Y-m-d h:i:s",strtotime($rows["msg_time"]))?></font></td>
				    </div>
				</div>
				<!--input name="submit" type="submit" id="submit" class="submit_108" onclick="Go('sys_msg.php');return false" value="返回上一页"/-->
			</div>
		</td>
	</tr>
</table>
</body> 
</html>