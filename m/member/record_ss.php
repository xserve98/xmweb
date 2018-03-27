<?php
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

$money = 0;
$ky = 0;
$jine = 0;
$sub = 2;
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
<script type="text/javascript">
$(document).ready(function() {
	$("#depositAllTypeForPhone p").removeClass("footer_dw");
	$("#depositAllTypeForPhone p").addClass("footer_dw_on");
	$("#depositAllTypeForPhone span").addClass("chooseColor");
	jQuery("#addBankCardForm").validationEngine({
		showOneMessage : true,
		maxErrorsPerField : 1,
		onValidationComplete : addBankCardForm
	});
	
	jQuery("#withdrawOnLineForm").validationEngine({
		showOneMessage : true,
		maxErrorsPerField : 1,
		onValidationComplete : withdrawOnLineSubmit		});
	
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
<input type="hidden" name="path" id="path" value="/cscpLoginWeb" />
<input type="hidden" name="lottoLink" id="lottoLink" value="https://hk.mhsw.sh.cn/lottoclient/images/speed.gif,https://hk.fshuiquan.com.cn/lottoclient/images/speed.gif,http://hk.cyweb.gd.cn/lottoclient/images/speed.gif" />
<input type="hidden" name="lotteryLink" id="lotteryLink" value="https://ssc.mhsw.sh.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.fshuiquan.com.cn/lotteryweb/siteOne/images/speed.gif,https://ssc.china-at.cn/lotteryweb/siteOne/images/speed.gif" />


	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>未结明细
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 44px;"></div>
		<div class="wrap">
            <div class="content">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr class="tic">
                        <td width="25%">彩种</td>
                        <td width="25%">详情</td>
                        <td width="25%">金额</td>
                        <td width="25%">结果</td>
                    </tr>
                    <?php
                    $sql = "select id from c_bet where uid=$uid and js=0 order by addtime desc";
                    $query	=	$mysqli->query($sql);
                    $sum	=	$mysqli->affected_rows; //总页数
                    $thisPage	=	1;
                    if(@$_GET['page']){
                        $thisPage	=	$_GET['page'];
                    }
                    $page		=	new newPage();
                    $perpage	= 	10;
                    $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                    $id		=	'';
                    $i		=	1;
                    $start	=	($thisPage-1)*$perpage+1;
                    $end	=	$thisPage*$perpage;
                    while($row = $query->fetch_array()){
                        if($i >= $start && $i <= $end){
                            $id .=	$row['id'].',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if(!$id) {
                        ?>
                        <tr align="center">
                            <td colspan="4">暂无记录！</td>
                        </tr>
                        <?php
                    } else {
                        $id = rtrim($id,',');
                        $sql = "select * from c_bet where id in($id) order by id desc";
                        $query	=	$mysqli->query($sql);
                        while($rows = $query->fetch_array()){
                            $money += $rows["money"];
                            $ky += $rows["win"] + $rows["fs"];
                            ?>
                            <tr class="list f_12">
                                <td>
                                    <div><?= $rows['type'] ?></div>
                                    <div><?php echo date('m-d H:i:s', strtotime($rows["addtime"])); ?></div>
                                </td>
                                <td>
                                    <div>第 <?= $rows["qishu"] ?> 期</div>
                                    <hr>
                                    <div>
                                        <? if ($rows['type'] == '香港六合彩') { ?>
                                            <?= $rows["mingxi_1"] ?><?= $rows["sm"] ? '(' . $rows["sm"] . ')' : '' ?><br><span class="c_red"><?= $rows["mingxi_2"] ?></span> @ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } else { ?>
                                            <?= $rows["mingxi_1"] ?>【<span class="c_red"><?= $rows["mingxi_2"] ?></span>】 @ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } ?>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $jine = 0;
                                    $jine = $rows["win"] + $rows["fs"];
                                    ?>
                                    <span class="c_red"><?= $rows["money"] ?></span> @ <span class="c_blue"><?= double_format($jine) ?></span>
                                </td>
                                <td><?= $rows["jieguo"] ? $rows["jieguo"] : '未知' ?></td>
                            </tr>
                        <?php
                        }
                    } ?>
                </table>
                <table cellspacing="0" cellpadding="0" border="0" class="page">
                    <tr>
                        <td align="right"><?=$page->get_htmlPage('record_ss.php?');?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>