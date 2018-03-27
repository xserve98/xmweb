<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['cqssc']) == 1) {
    include('close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 1;
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
switch($type) {
    case '第一球':
        $g_i = 1;
        break;
    case '第二球':
        $g_i = 2;
        break;
    case '第三球':
        $g_i = 3;
        break;
    case '第四球':
        $g_i = 4;
        break;
    case '第五球':
        $g_i = 5;
        break;
    case '数字盘':
        $g_i = 6;
        break;
    default:
        $g_i = 0;
}
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
    <link type="text/css" rel="stylesheet" href="Css/ssc.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="Js/cq_ssc.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
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
		
			<a href="#u_nav" class="dh" data-ajax="false"></a>重庆时时彩
			<a href="#type"  class="lx" style="position: fixed; left: inherit; right: 0px;"></a>

</font></a>
		</div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered">
                        <tr><td class="tit">游戏菜单</td></tr>
                        <tr><td><a href="Cqssc.php?t=两面盘">两面盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=数字盘">数字盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=第一球">第一球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=第二球">第二球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=第三球">第三球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=第四球">第四球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqssc.php?t=第五球">第五球</a> <i class="icon-angle-right"></i></td></tr>
                    </table>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
		<div style="height: 45px;"></div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期</span>
                <span id="open_num" class="ssc"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                <span><?=$type?></span>
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=2" method="post" target="OrderFrame">
                    <?php if($type == '两面盘') { ?>
                        <?php for($s = 1; $s <= 5; $s++) { ?>
                            <div class="tz_box">
                                <div class="info_con ico2">第<?=ch_num($s)?>球</div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">大</span>
                                                <span class="odds" id="ball_<?=$s?>_h11"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t11"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">小</span>
                                                <span class="odds" id="ball_<?=$s?>_h12"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t12"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">单</span>
                                                <span class="odds" id="ball_<?=$s?>_h13"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t13"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">双</span>
                                                <span class="odds" id="ball_<?=$s?>_h14"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t14"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="tz_box">
                            <div class="info_con ico2">总和两面</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_6_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_6_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_6_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_6_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">龙</span>
                                            <span class="odds" id="ball_6_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">虎</span>
                                            <span class="odds" id="ball_6_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">和</span>
                                            <span class="odds" id="ball_6_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t7"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif($type == '数字盘') { ?>
                        <?php for($s = 1; $s <= 5; $s++) { ?>
                            <div class="tz_box ssc">
                                <div class="info_con ico2">第<?=ch_num($s)?>球</div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_0"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h1"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t1"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_1"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h2"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t2"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_2"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h3"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t3"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_3"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h4"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t4"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_4"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h5"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t5"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_5"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h6"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t6"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_6"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h7"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t7"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_7"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h8"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t8"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_8"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h9"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t9"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_9"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h10"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t10"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <? } ?>
                    <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球' || $type == '第四球' || $type == '第五球') { ?>
                        <div class="tz_box ssc">
                            <div class="info_con ico2"><?=$type?></div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_0"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_1"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_2"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_3"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_4"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_5"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_6"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t7"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_7"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h8"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t8"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_8"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h9"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t9"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_9"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h10"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t10"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tz_box">
                            <div class="info_con ico2">两面</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">大</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h11"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t11"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">小</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h12"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t12"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">单</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h13"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t13"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">双</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h14"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t14"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_6_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_6_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_6_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_6_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">龙</span>
                                            <span class="odds" id="ball_6_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">虎</span>
                                            <span class="odds" id="ball_6_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">和</span>
                                            <span class="odds" id="ball_6_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t7"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php for($s = 7; $s <= 9; $s++) { ?>
                            <div class="tz_box">
                                <div class="info_con ico2"><?php if($s == 7) {echo '前三';} elseif($s == 8) {echo '中三';} else {echo '后三';} ?></div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">豹子</span>
                                                <span class="odds" id="ball_<?=$s?>_h1"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t1"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">顺子</span>
                                                <span class="odds" id="ball_<?=$s?>_h2"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t2"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">对子</span>
                                                <span class="odds" id="ball_<?=$s?>_h3"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t3"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">半顺</span>
                                                <span class="odds" id="ball_<?=$s?>_h4"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t4"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">杂六</span>
                                                <span class="odds" id="ball_<?=$s?>_h5"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t5"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    <?php } ?>
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
        loadinfo(<?=$g_i?>);
        rf_time(90);
    </script>
</body>
</html>