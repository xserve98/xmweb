<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
if (intval($web_site['azxy10']) == 1) {
    include('close_cp.php');
    exit();
}
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
$kj = $_COOKIE['kj_money'];
$cp_zd = $pk_db['彩票最低'];
$cp_zg = $pk_db['彩票最高'];
if($cp_zd <= 0) {
    $cp_zd = 1;
}
if($cp_zg <= 0) {
    $cp_zg = 1000000;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/marquee.js"></script>
    <script type="text/javascript" src="../js/flash.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="js/az10.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/newdsn/css/bet.css" />
    <script type="text/javascript">
        if (self == top) {
			//top.location = '/main.php';
        }
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body class="skin_blue" style="height: 800px;">
<div id="header">
<div class="lottery_info">
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">澳洲幸运10</span> — <span class="gameName" id="gameName"> <?=$type?></span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

                <input id="gm_mode" type="hidden" value="cqssc" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;距离开奖：<span class="color_lv bold"><span id="kj_time">00:00</span></span>
<span id="rf_time" style="float:right;width: 50px;">0秒</span>
</div>
<div class="clearfloat"></div>
</div>
<?php include_once('kj.php') ?>
</div>
    <div class="touzhu">
        <form name="orders" id="orders" action="/Lottery/order/order4.php?type=29" method="post" target="OrderFrame">
            <?php if($type == '两面盘') { ?>
			<table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="tit" colspan="12">冠亚军和</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">冠亚大</td>
                        <td class="bian_td_odds" id="ball_1_h18"></td>
                        <td class="bian_td_inp" id="ball_1_t18"></td>
                        <td class="bian_td_qiu">冠亚小</td>
                        <td class="bian_td_odds" id="ball_1_h19"></td>
                        <td class="bian_td_inp" id="ball_1_t19"></td>
                        <td class="bian_td_qiu">冠亚单</td>
                        <td class="bian_td_odds" id="ball_1_h20"></td>
                        <td class="bian_td_inp" id="ball_1_t20"></td>
                        <td class="bian_td_qiu">冠亚双</td>
                        <td class="bian_td_odds" id="ball_1_h21"></td>
                        <td class="bian_td_inp" id="ball_1_t21"></td>
                    </tr>
                </table>
                <div class="t_box mt10">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2">
                        <tr>
                            <td class="tit" colspan="3">冠军</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_2_h11"></td>
                            <td class="bian_td_inp"  id="ball_2_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_2_h12"></td>
                            <td class="bian_td_inp" id="ball_2_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_2_h13"></td>
                            <td class="bian_td_inp" id="ball_2_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_2_h14"></td>
                            <td class="bian_td_inp" id="ball_2_t14"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">龙</td>
                            <td class="bian_td_odds" id="ball_12_h1"></td>
                            <td class="bian_td_inp" id="ball_12_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">虎</td>
                            <td class="bian_td_odds" id="ball_12_h2"></td>
                            <td class="bian_td_inp" id="ball_12_t2"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2">
                        <tr>
                            <td class="tit" colspan="3">亚军</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_3_h11"></td>
                            <td class="bian_td_inp" id="ball_3_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_3_h12"></td>
                            <td class="bian_td_inp" id="ball_3_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_3_h13"></td>
                            <td class="bian_td_inp" id="ball_3_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_3_h14"></td>
                            <td class="bian_td_inp" id="ball_3_t14"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">龙</td>
                            <td class="bian_td_odds" id="ball_13_h1"></td>
                            <td class="bian_td_inp" id="ball_13_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">虎</td>
                            <td class="bian_td_odds" id="ball_13_h2"></td>
                            <td class="bian_td_inp" id="ball_13_t2"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2">
                        <tr>
                            <td class="tit" colspan="3">第三名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_4_h11"></td>
                            <td class="bian_td_inp" id="ball_4_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_4_h12"></td>
                            <td class="bian_td_inp" id="ball_4_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_4_h13"></td>
                            <td class="bian_td_inp" id="ball_4_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_4_h14"></td>
                            <td class="bian_td_inp" id="ball_4_t14"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">龙</td>
                            <td class="bian_td_odds" id="ball_14_h1"></td>
                            <td class="bian_td_inp" id="ball_14_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">虎</td>
                            <td class="bian_td_odds" id="ball_14_h2"></td>
                            <td class="bian_td_inp" id="ball_14_t2"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2">
                        <tr>
                            <td class="tit" colspan="3">第四名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_5_h11"></td>
                            <td class="bian_td_inp" id="ball_5_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_5_h12"></td>
                            <td class="bian_td_inp" id="ball_5_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_5_h13"></td>
                            <td class="bian_td_inp" id="ball_5_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_5_h14"></td>
                            <td class="bian_td_inp" id="ball_5_t14"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">龙</td>
                            <td class="bian_td_odds" id="ball_15_h1"></td>
                            <td class="bian_td_inp" id="ball_15_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">虎</td>
                            <td class="bian_td_odds" id="ball_15_h2"></td>
                            <td class="bian_td_inp" id="ball_15_t2"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2">
                        <tr>
                            <td class="tit" colspan="3">第五名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_6_h11"></td>
                            <td class="bian_td_inp" id="ball_6_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_6_h12"></td>
                            <td class="bian_td_inp" id="ball_6_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_6_h13"></td>
                            <td class="bian_td_inp" id="ball_6_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_6_h14"></td>
                            <td class="bian_td_inp" id="ball_6_t14"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">龙</td>
                            <td class="bian_td_odds" id="ball_16_h1"></td>
                            <td class="bian_td_inp" id="ball_16_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">虎</td>
                            <td class="bian_td_odds" id="ball_16_h2"></td>
                            <td class="bian_td_inp" id="ball_16_t2"></td>
                        </tr>
                    </table>
                </div>
                <div class="t_box mt10">
                    <table class="tab2" cellspacing="1" cellpadding="0" border="0">
                        <tr>
                            <td colspan="3" class="tit">第六名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_7_h11"></td>
                            <td class="bian_td_inp" id="ball_7_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_7_h12"></td>
                            <td class="bian_td_inp" id="ball_7_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_7_h13"></td>
                            <td class="bian_td_inp" id="ball_7_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_7_h14"></td>
                            <td class="bian_td_inp" id="ball_7_t14"></td>
                        </tr>
                    </table>
                    <table class="tab2" cellspacing="1" cellpadding="0" border="0">
                        <tr>
                            <td colspan="3" class="tit">第七名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_8_h11"></td>
                            <td class="bian_td_inp" id="ball_8_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_8_h12"></td>
                            <td class="bian_td_inp" id="ball_8_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_8_h13"></td>
                            <td class="bian_td_inp" id="ball_8_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_8_h14"></td>
                            <td class="bian_td_inp" id="ball_8_t14"></td>
                        </tr>
                    </table>
                    <table class="tab2" cellspacing="1" cellpadding="0" border="0">
                        <tr>
                            <td colspan="3" class="tit">第八名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_9_h11"></td>
                            <td class="bian_td_inp" id="ball_9_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_9_h12"></td>
                            <td class="bian_td_inp" id="ball_9_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_9_h13"></td>
                            <td class="bian_td_inp" id="ball_9_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_9_h14"></td>
                            <td class="bian_td_inp" id="ball_9_t14"></td>
                        </tr>
                    </table>
                    <table class="tab2" cellspacing="1" cellpadding="0" border="0">
                        <tr>
                            <td colspan="3" class="tit">第九名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_10_h11"></td>
                            <td class="bian_td_inp" id="ball_10_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_10_h12"></td>
                            <td class="bian_td_inp" id="ball_10_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_10_h13"></td>
                            <td class="bian_td_inp" id="ball_10_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_10_h14"></td>
                            <td class="bian_td_inp" id="ball_10_t14"></td>
                        </tr>
                    </table>
                    <table class="tab2" cellspacing="1" cellpadding="0" border="0">
                        <tr>
                            <td colspan="3" class="tit">第十名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_11_h11"></td>
                            <td class="bian_td_inp" id="ball_11_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_11_h12"></td>
                            <td class="bian_td_inp" id="ball_11_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_11_h13"></td>
                            <td class="bian_td_inp" id="ball_11_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_11_h14"></td>
                            <td class="bian_td_inp" id="ball_11_t14"></td>
                        </tr>
                    </table>
                </div>
				
            <?php } elseif($type == '冠,亚军 组合') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 b_num">
                    <tr>
                        <td colspan="12" class="tit">冠、亚军和（冠军车号+亚军车号=总和）</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">3</td>
                        <td class="bian_td_odds" id="ball_1_h1"></td>
                        <td class="bian_td_inp" id="ball_1_t1"></td>
                        <td class="bian_td_qiu">4</td>
                        <td class="bian_td_odds" id="ball_1_h2"></td>
                        <td class="bian_td_inp" id="ball_1_t2"></td>
                        <td class="bian_td_qiu">5</td>
                        <td class="bian_td_odds" id="ball_1_h3"></td>
                        <td class="bian_td_inp" id="ball_1_t3"></td>
                        <td class="bian_td_qiu">6</td>
                        <td class="bian_td_odds" id="ball_1_h4"></td>
                        <td class="bian_td_inp" id="ball_1_t4"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">7</td>
                        <td class="bian_td_odds" id="ball_1_h5"></td>
                        <td class="bian_td_inp" id="ball_1_t5"></td>
                        <td class="bian_td_qiu">8</td>
                        <td class="bian_td_odds" id="ball_1_h6"></td>
                        <td class="bian_td_inp" id="ball_1_t6"></td>
                        <td class="bian_td_qiu">9</td>
                        <td class="bian_td_odds" id="ball_1_h7"></td>
                        <td class="bian_td_inp" id="ball_1_t7"></td>
                        <td class="bian_td_qiu">10</td>
                        <td class="bian_td_odds" id="ball_1_h8"></td>
                        <td class="bian_td_inp" id="ball_1_t8"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">11</td>
                        <td class="bian_td_odds" id="ball_1_h9"></td>
                        <td class="bian_td_inp" id="ball_1_t9"></td>
                        <td class="bian_td_qiu">12</td>
                        <td class="bian_td_odds" id="ball_1_h10"></td>
                        <td class="bian_td_inp" id="ball_1_t10"></td>
                        <td class="bian_td_qiu">13</td>
                        <td class="bian_td_odds" id="ball_1_h11"></td>
                        <td class="bian_td_inp" id="ball_1_t11"></td>
                        <td class="bian_td_qiu">14</td>
                        <td class="bian_td_odds" id="ball_1_h12"></td>
                        <td class="bian_td_inp" id="ball_1_t12"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">15</td>
                        <td class="bian_td_odds" id="ball_1_h13"></td>
                        <td class="bian_td_inp" id="ball_1_t13"></td>
                        <td class="bian_td_qiu">16</td>
                        <td class="bian_td_odds" id="ball_1_h14"></td>
                        <td class="bian_td_inp" id="ball_1_t14"></td>
                        <td class="bian_td_qiu">17</td>
                        <td class="bian_td_odds" id="ball_1_h15"></td>
                        <td class="bian_td_inp" id="ball_1_t15"></td>
                        <td class="bian_td_qiu">18</td>
                        <td class="bian_td_odds" id="ball_1_h16"></td>
                        <td class="bian_td_inp" id="ball_1_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">19</td>
                        <td class="bian_td_odds" id="ball_1_h17"></td>
                        <td class="bian_td_inp" id="ball_1_t17"></td>
                        <td colspan="9"></td>
                    </tr>
                </table>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">冠亚大</td>
                        <td class="bian_td_odds" id="ball_1_h18"></td>
                        <td class="bian_td_inp" id="ball_1_t18"></td>
                        <td class="bian_td_qiu">冠亚小</td>
                        <td class="bian_td_odds" id="ball_1_h19"></td>
                        <td class="bian_td_inp" id="ball_1_t19"></td>
                        <td class="bian_td_qiu">冠亚单</td>
                        <td class="bian_td_odds" id="ball_1_h20"></td>
                        <td class="bian_td_inp" id="ball_1_t20"></td>
                        <td class="bian_td_qiu">冠亚双</td>
                        <td class="bian_td_odds" id="ball_1_h21"></td>
                        <td class="bian_td_inp" id="ball_1_t21"></td>
                    </tr>
                </table>
            <?php } elseif($type == '1~10定位') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td colspan="3" class="tit">冠军</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_2_h1"></td>
                            <td class="bian_td_inp" id="ball_2_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_2_h2"></td>
                            <td class="bian_td_inp" id="ball_2_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_2_h3"></td>
                            <td class="bian_td_inp" id="ball_2_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_2_h4"></td>
                            <td class="bian_td_inp" id="ball_2_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_2_h5"></td>
                            <td class="bian_td_inp" id="ball_2_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_2_h6"></td>
                            <td class="bian_td_inp" id="ball_2_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_2_h7"></td>
                            <td class="bian_td_inp" id="ball_2_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_2_h8"></td>
                            <td class="bian_td_inp" id="ball_2_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_2_h9"></td>
                            <td class="bian_td_inp" id="ball_2_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_2_h10"></td>
                            <td class="bian_td_inp" id="ball_2_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td colspan="3" class="tit">亚军</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_3_h1"></td>
                            <td class="bian_td_inp" id="ball_3_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_3_h2"></td>
                            <td class="bian_td_inp" id="ball_3_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_3_h3"></td>
                            <td class="bian_td_inp" id="ball_3_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_3_h4"></td>
                            <td class="bian_td_inp" id="ball_3_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_3_h5"></td>
                            <td class="bian_td_inp" id="ball_3_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_3_h6"></td>
                            <td class="bian_td_inp" id="ball_3_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_3_h7"></td>
                            <td class="bian_td_inp" id="ball_3_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_3_h8"></td>
                            <td class="bian_td_inp" id="ball_3_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_3_h9"></td>
                            <td class="bian_td_inp" id="ball_3_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_3_h10"></td>
                            <td class="bian_td_inp" id="ball_3_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td colspan="3" class="tit">第三名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_4_h1"></td>
                            <td class="bian_td_inp" id="ball_4_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_4_h2"></td>
                            <td class="bian_td_inp" id="ball_4_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_4_h3"></td>
                            <td class="bian_td_inp" id="ball_4_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_4_h4"></td>
                            <td class="bian_td_inp" id="ball_4_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_4_h5"></td>
                            <td class="bian_td_inp" id="ball_4_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_4_h6"></td>
                            <td class="bian_td_inp" id="ball_4_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_4_h7"></td>
                            <td class="bian_td_inp" id="ball_4_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_4_h8"></td>
                            <td class="bian_td_inp" id="ball_4_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_4_h9"></td>
                            <td class="bian_td_inp" id="ball_4_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_4_h10"></td>
                            <td class="bian_td_inp" id="ball_4_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td colspan="3" class="tit">第四名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_5_h1"></td>
                            <td class="bian_td_inp" id="ball_5_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_5_h2"></td>
                            <td class="bian_td_inp" id="ball_5_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_5_h3"></td>
                            <td class="bian_td_inp" id="ball_5_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_5_h4"></td>
                            <td class="bian_td_inp" id="ball_5_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_5_h5"></td>
                            <td class="bian_td_inp" id="ball_5_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_5_h6"></td>
                            <td class="bian_td_inp" id="ball_5_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_5_h7"></td>
                            <td class="bian_td_inp" id="ball_5_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_5_h8"></td>
                            <td class="bian_td_inp" id="ball_5_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_5_h9"></td>
                            <td class="bian_td_inp" id="ball_5_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_5_h10"></td>
                            <td class="bian_td_inp" id="ball_5_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td colspan="3" class="tit">第五名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_6_h1"></td>
                            <td class="bian_td_inp" id="ball_6_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_6_h2"></td>
                            <td class="bian_td_inp" id="ball_6_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_6_h3"></td>
                            <td class="bian_td_inp" id="ball_6_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_6_h4"></td>
                            <td class="bian_td_inp" id="ball_6_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_6_h5"></td>
                            <td class="bian_td_inp" id="ball_6_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_6_h6"></td>
                            <td class="bian_td_inp" id="ball_6_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_6_h7"></td>
                            <td class="bian_td_inp" id="ball_6_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_6_h8"></td>
                            <td class="bian_td_inp" id="ball_6_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_6_h9"></td>
                            <td class="bian_td_inp" id="ball_6_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_6_h10"></td>
                            <td class="bian_td_inp" id="ball_6_t10"></td>
                        </tr>
                    </table>
                </div>
                <div class="t_box mt10">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td class="tit" colspan="3">第六名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_7_h1"></td>
                            <td class="bian_td_inp" id="ball_7_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_7_h2"></td>
                            <td class="bian_td_inp" id="ball_7_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_7_h3"></td>
                            <td class="bian_td_inp" id="ball_7_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_7_h4"></td>
                            <td class="bian_td_inp" id="ball_7_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_7_h5"></td>
                            <td class="bian_td_inp" id="ball_7_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_7_h6"></td>
                            <td class="bian_td_inp" id="ball_7_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_7_h7"></td>
                            <td class="bian_td_inp" id="ball_7_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_7_h8"></td>
                            <td class="bian_td_inp" id="ball_7_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_7_h9"></td>
                            <td class="bian_td_inp" id="ball_7_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_7_h10"></td>
                            <td class="bian_td_inp" id="ball_7_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td class="tit" colspan="3">第七名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_8_h1"></td>
                            <td class="bian_td_inp" id="ball_8_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_8_h2"></td>
                            <td class="bian_td_inp" id="ball_8_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_8_h3"></td>
                            <td class="bian_td_inp" id="ball_8_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_8_h4"></td>
                            <td class="bian_td_inp" id="ball_8_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_8_h5"></td>
                            <td class="bian_td_inp" id="ball_8_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_8_h6"></td>
                            <td class="bian_td_inp" id="ball_8_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_8_h7"></td>
                            <td class="bian_td_inp" id="ball_8_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_8_h8"></td>
                            <td class="bian_td_inp" id="ball_8_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_8_h9"></td>
                            <td class="bian_td_inp" id="ball_8_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_8_h10"></td>
                            <td class="bian_td_inp" id="ball_8_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td class="tit" colspan="3">第八名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_9_h1"></td>
                            <td class="bian_td_inp" id="ball_9_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_9_h2"></td>
                            <td class="bian_td_inp" id="ball_9_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_9_h3"></td>
                            <td class="bian_td_inp" id="ball_9_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_9_h4"></td>
                            <td class="bian_td_inp" id="ball_9_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_9_h5"></td>
                            <td class="bian_td_inp" id="ball_9_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_9_h6"></td>
                            <td class="bian_td_inp" id="ball_9_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_9_h7"></td>
                            <td class="bian_td_inp" id="ball_9_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_9_h8"></td>
                            <td class="bian_td_inp" id="ball_9_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_9_h9"></td>
                            <td class="bian_td_inp" id="ball_9_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_9_h10"></td>
                            <td class="bian_td_inp" id="ball_9_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td class="tit" colspan="3">第九名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_10_h1"></td>
                            <td class="bian_td_inp" id="ball_10_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_10_h2"></td>
                            <td class="bian_td_inp" id="ball_10_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_10_h3"></td>
                            <td class="bian_td_inp" id="ball_10_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_10_h4"></td>
                            <td class="bian_td_inp" id="ball_10_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_10_h5"></td>
                            <td class="bian_td_inp" id="ball_10_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_10_h6"></td>
                            <td class="bian_td_inp" id="ball_10_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_10_h7"></td>
                            <td class="bian_td_inp" id="ball_10_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_10_h8"></td>
                            <td class="bian_td_inp" id="ball_10_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_10_h9"></td>
                            <td class="bian_td_inp" id="ball_10_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_10_h10"></td>
                            <td class="bian_td_inp" id="ball_10_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 pk10">
                        <tr>
                            <td class="tit" colspan="3">第十名</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_11_h1"></td>
                            <td class="bian_td_inp" id="ball_11_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_11_h2"></td>
                            <td class="bian_td_inp" id="ball_11_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_11_h3"></td>
                            <td class="bian_td_inp" id="ball_11_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_11_h4"></td>
                            <td class="bian_td_inp" id="ball_11_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_11_h5"></td>
                            <td class="bian_td_inp" id="ball_11_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_11_h6"></td>
                            <td class="bian_td_inp" id="ball_11_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_11_h7"></td>
                            <td class="bian_td_inp" id="ball_11_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_11_h8"></td>
                            <td class="bian_td_inp" id="ball_11_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_11_h9"></td>
                            <td class="bian_td_inp" id="ball_11_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_10"></em></td>
                            <td class="bian_td_odds" id="ball_11_h10"></td>
                            <td class="bian_td_inp" id="ball_11_t10"></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
<div class="control bcontrol">
<div class="lefts" style="display:none">已经选中 <span id="betcount"></span> 注</div>
<div class="buttons">
<input type="button" class="button2" value="快选金额" onclick="parent.showsetting()">
<input type="button" class="button" id="xiazhu" value="下注"  onclick="order();"><input type="button" class="button" value="重置" onclick="formReset();">
</div>
</div>
                  
                  
        </form>
    </div>

    <?php if($type != '1~10定位') { ?>
        <table cellspacing="1" cellpadding="0" border="0" class="gm_lz">
            <thead>
                <tr>
                    <th class="cur" colspan="8"><a href="javascript:void(0)">冠,亚军和</a></th>
                    <th colspan="9"><a href="javascript:void(0)">冠,亚军和 大小</a></th>
                    <th colspan="8"><a href="javascript:void(0)">冠,亚军和 单双</a></th>
                </tr>
            </thead>
    <?php } ?>
       <tbody id="luzhu" class="list"></tbody>
        </table>
        <div class="gm_cl">
        <table cellspacing="1" cellpadding="0" border="0" class="cl_list">
            <thead>
                <tr>
                    <th colspan="2">两面长龙排行</th>
                </tr>
            </thead>
            <tbody id="changlong"></tbody>
        </table>
    </div>
    <div id="play_sound"></div>

    <script type="text/javascript">
        loadinfo();
        rf_time(90);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
	<script type="text/javascript" src="/js/libs.js"></script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>