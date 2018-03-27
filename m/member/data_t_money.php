<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

$subsub = 3;
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
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>

<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-ui-1.10.4.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="/cscpLoginWeb/css/custom-theme/jquery-ui-1.10.4Red.custom.css"/>
<script type="text/javascript" src="/cscpLoginWeb/js/datepicker/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#depositAllTypeForPhone p").removeClass("footer_dw");
		$("#depositAllTypeForPhone p").addClass("footer_dw_on");
		$("#depositAllTypeForPhone span").addClass("chooseColor");
		$("#from_date").datepicker({
			autoSize : true,
			minDate : -7,
			maxDate : "+0D",
			dateFormat : "yy-mm-dd",
			inline : true,
			changeMonth : true,
			changeYear : true
		});
		$("#to_date").datepicker({
			minDate : -7,
			maxDate : "+0D",
			dateFormat : "yy-mm-dd",
			inline : true,
			changeMonth : true,
			changeYear : true
		});
		getHsitory('1');
	});
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
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a> 资金管理
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
	<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/transfer_head_bg.jpg"/>
	<div class="info_user">
		<p><?=$userinfo["username"]?></p>
		<span>余额：<b><?=sprintf("%.2f",$userinfo["money"])?> 元</b></span>
	</div>
</div>
		<div class="info_tit">
			<p><a href="set_money.php" target="_self" data-ajax="false">存款</a></p>
			<p><a href="get_money.php" target="_self" data-ajax="false">取款</a></p>
			<p class="on"><a  href="javascript:void(0);" target="_self" data-ajax="false">记录</a></p>
		</div>

		<div class="wrap_div bg2">
			<div class="account_wrap wrap bb bs">
				<div class="info_con2">
					<div class="info_nav">
						<p><a href="data_money.php">存款记录</a></p>
						<p class="on"><a href="javascript:void(0)">取款记录</a></p>
					</div>
				</div>
<?php include_once("../modules/foots.php"); ?>
				<div class="info_tab02">
        <div class="wrap">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic">
                    <td width="33.333%">取款时间</td>
                    <td width="33.333%">取款金额</td>
                    <td width="33.333%">取款状态</td>
                </tr>
                <?php
                $sql	=	"select m_id from k_money where uid=$uid and type=2 order by m_id desc";
                $query	=	$mysqli->query($sql);
                $sum	=	$mysqli->affected_rows; //总页数
                $thisPage	=	1;
                if(@$_GET['page']){
                    $thisPage	=	$_GET['page'];
                }
                $page		=	new newPage();
                $perpage	= 	15;
                $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                $id		=	'';
                $i		=	1; //记录 uid 数
                $start	=	($thisPage-1)*$perpage+1;
                $end	=	$thisPage*$perpage;
                while($row = $query->fetch_array()){
                    if($i >= $start && $i <= $end){
                        $id .=	$row['m_id'].',';
                    }
                    if($i > $end) break;
                    $i++;
                }
                if($id) {
                    $id		=	rtrim($id,',');
                    $sql	=	"select * from k_money where m_id in($id) order by m_id desc";
                    $query	=	$mysqli->query($sql);
                    $sum_money	=	0;
                    $sum_sxf	=	0;
                    while($rows = $query->fetch_array()) {
                        ?>
                        <tr class="list f_12">
                            <td><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
                            <td><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
                            <td>
                                <?php
                                if($rows["status"] == 1) {
                                    $sum_money += abs($rows["m_value"]);
                                    $sum_sxf += $rows["sxf"];
                                    echo '<span class="c_red">已成功</span>';
                                } else if($rows["status"] == 0) {
                                    echo '<span>已失败</span>';
                                } else {
                                    echo '<span class="c_blue">审核中</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else { ?>
                    <tr align="center">
                        <td colspan="3">暂无提款记录！</td>
                    </tr>
                <?php } ?>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="page">
                <tr>
                    <td align="right"><?=$page->get_htmlPage("data_t_money.php?")?></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>
