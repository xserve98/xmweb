<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['cqsix']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 11;
$t_day = date('Y-m-d', $lottery_time);
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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="Js/class_1.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<META http-equiv="pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<meta charset="UTF-8">
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
	<div class="wraper">
	<div class="container-fluid gm_main">

		<div class="tit">
		
			<a href="#u_nav" class="dh" data-ajax="false"></a>澳洲六合彩
			<a href="#type"  class="lx" style="position: fixed; left: inherit; right: 0px;"></a>

</font></a>
		</div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <?php include_once('Menu.php') ?>
		<div style="height: 42px;"></div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="six"></span>
            </div>
            <div class="pk s">
                第<span id="open_qihao">000000</span>期
                <span>正码4</span>
                封盘剩：<span><em id="hour_show">0</em>:<em id="minute_show">0</em>:<em id="second_show">0</em></span>
                <select id="gm_type">
                    <option value="six_1.php">正码1</option>
                    <option value="six_2.php">正码2</option>
                    <option value="six_3.php">正码3</option>
                    <option value="six_4.php" selected="selected">正码4</option>
                    <option value="six_5.php">正码5</option>
                    <option value="six_6.php">正码6</option>
                </select>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="/cqsix/order/order.php?type=22" method="post" target="OrderFrame">
                    <div class="tz_box">
                        <div class="info_con ico2">正码4</div>
                        <?php
                        for($s = 1; $s <= 49; $s++) {
                            if($s % 2 == 1) {
                                echo '<ul>';
                            }
                            ?>
                            <li>
                                <div class="wf_box six">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu"><em class="n_<?=$s?>"></em></span>
                                        <span class="odds" id="ball_4_o<?=$s?>"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m<?=$s?>"></div>
                                </div>
                            </li>
                            <?php
                            if($s % 2 == 0 || $s == 49) {
                                echo '</ul>';
                            }
                        }
                        ?>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">大码</span>
                                        <span class="odds" id="ball_4_o50"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m50"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">小码</span>
                                        <span class="odds" id="ball_4_o51"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m51"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">单码</span>
                                        <span class="odds" id="ball_4_o52"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m52"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">双码</span>
                                        <span class="odds" id="ball_4_o53"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m53"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合大</span>
                                        <span class="odds" id="ball_4_o54"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m54"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合小</span>
                                        <span class="odds" id="ball_4_o55"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m55"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合单</span>
                                        <span class="odds" id="ball_4_o56"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m56"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合双</span>
                                        <span class="odds" id="ball_4_o57"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m57"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">尾大</span>
                                        <span class="odds" id="ball_4_o58"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m58"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">尾小</span>
                                        <span class="odds" id="ball_4_o59"></span>
                                    </div>
                                    <div class="inp" id="ball_4_m59"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tool">
                        <div class="kj_box">
                            <div class="kuaisu">
                                <input id="kj_money" class="kj_inp" type="text" placeholder="快速金额" value="" />
                                <input id="qi_num" type="hidden" name="qi_num" value=""/>
                            </div>
                            <button type="button" title="重填" onclick="formReset();" class="btn btn-danger">重填</button>
                            <button type="button" title="下注" onclick="order();" class="btn btn-primary">下注</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
    <script type="text/javascript">
        loadInfo(4);
    </script>
</body>
</html>