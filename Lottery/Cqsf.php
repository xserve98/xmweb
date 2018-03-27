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
if (intval($web_site['xync']) == 1) {
    include('close_cp.php');
    exit();
}
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
    case '第六球':
        $g_i = 6;
        break;
    case '第七球':
        $g_i = 7;
        break;
    case '第八球':
        $g_i = 8;
        break;
    default:
        $g_i = 0;
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

 </div>
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
    <script type="text/javascript" src="js/cq_sf.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/newdsn/css/bet.css" />
    <script type="text/javascript">
        if (self == top) {
            //top.location = '/main.php';
        }
        var islg =1;
    </script>
</head>
<body class="skin_blue">

<div id="header">
<div class="lottery_info">
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">重庆幸运农场</span> — <span class="gameName" id="gameName"> <?=$type?></span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

                <input id="gm_mode" type="hidden" value="cqssc" />
                <input id="u_name" type="hidden"  value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden"  value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden"  value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;距离开奖：<span class="color_lv bold"><span id="kj_time">00:00</span></span>
<span id="rf_time" style="float:right;width: 50px;">0秒</span>
</div>
<div class="clearfloat"></div>
</div>
<?php include_once('kj.php') ?>
</div>
    <div class="touzhu">
        <form name="orders" id="orders" action="/Lottery/order/order3.php?type=11" method="post" target="OrderFrame">
            <?php if($type == '两面盘') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="tit" colspan="12">总和、龙虎</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和大</td>
                        <td class="bian_td_odds" id="ball_9_h1"></td>
                        <td class="bian_td_inp" id="ball_9_t1"></td>
                        <td class="bian_td_qiu"><b>总和单</td>
                        <td class="bian_td_odds" id="ball_9_h3"></td>
                        <td class="bian_td_inp" id="ball_9_t3"></td>
                        <td class="bian_td_qiu"><b>总和尾大</td>
                        <td class="bian_td_odds" id="ball_9_h5"></td>
                        <td class="bian_td_inp" id="ball_9_t5"></td>
                        <td class="bian_td_qiu"><b>龙</td>
                        <td class="bian_td_odds" id="ball_9_h7"></td>
                        <td class="bian_td_inp" id="ball_9_t7"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和小</td>
                        <td class="bian_td_odds" id="ball_9_h2"></td>
                        <td class="bian_td_inp" id="ball_9_t2"></td>
                        <td class="bian_td_qiu"><b>总和双</td>
                        <td class="bian_td_odds" id="ball_9_h4"></td>
                        <td class="bian_td_inp" id="ball_9_t4"></td>
                        <td class="bian_td_qiu"><b>总和尾小</td>
                        <td class="bian_td_odds" id="ball_9_h6"></td>
                        <td class="bian_td_inp" id="ball_9_t6"></td>
                        <td class="bian_td_qiu"><b>虎</td>
                        <td class="bian_td_odds" id="ball_9_h8"></td>
                        <td class="bian_td_inp" id="ball_9_t8"></td>
                    </tr>
                </table>
                <div class="t_box mt10">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第一球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_1_h21"></td>
                            <td class="bian_td_inp" id="ball_1_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_1_h22"></td>
                            <td class="bian_td_inp" id="ball_1_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_1_h23"></td>
                            <td class="bian_td_inp" id="ball_1_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_1_h24"></td>
                            <td class="bian_td_inp" id="ball_1_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_1_h25"></td>
                            <td class="bian_td_inp" id="ball_1_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_1_h26"></td>
                            <td class="bian_td_inp" id="ball_1_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_1_h27"></td>
                            <td class="bian_td_inp" id="ball_1_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_1_h28"></td>
                            <td class="bian_td_inp" id="ball_1_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第二球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_2_h21"></td>
                            <td class="bian_td_inp" id="ball_2_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_2_h22"></td>
                            <td class="bian_td_inp" id="ball_2_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_2_h23"></td>
                            <td class="bian_td_inp" id="ball_2_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_2_h24"></td>
                            <td class="bian_td_inp" id="ball_2_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_2_h25"></td>
                            <td class="bian_td_inp" id="ball_2_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_2_h26"></td>
                            <td class="bian_td_inp" id="ball_2_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_2_h27"></td>
                            <td class="bian_td_inp" id="ball_2_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_2_h28"></td>
                            <td class="bian_td_inp" id="ball_2_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第三球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_3_h21"></td>
                            <td class="bian_td_inp" id="ball_3_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_3_h22"></td>
                            <td class="bian_td_inp" id="ball_3_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_3_h23"></td>
                            <td class="bian_td_inp" id="ball_3_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_3_h24"></td>
                            <td class="bian_td_inp" id="ball_3_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_3_h25"></td>
                            <td class="bian_td_inp" id="ball_3_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_3_h26"></td>
                            <td class="bian_td_inp" id="ball_3_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_3_h27"></td>
                            <td class="bian_td_inp" id="ball_3_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_3_h28"></td>
                            <td class="bian_td_inp" id="ball_3_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第四球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_4_h21"></td>
                            <td class="bian_td_inp" id="ball_4_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_4_h22"></td>
                            <td class="bian_td_inp" id="ball_4_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_4_h23"></td>
                            <td class="bian_td_inp" id="ball_4_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_4_h24"></td>
                            <td class="bian_td_inp" id="ball_4_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_4_h25"></td>
                            <td class="bian_td_inp" id="ball_4_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_4_h26"></td>
                            <td class="bian_td_inp" id="ball_4_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_4_h27"></td>
                            <td class="bian_td_inp" id="ball_4_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_4_h28"></td>
                            <td class="bian_td_inp" id="ball_4_t28"></td>
                        </tr>
                    </table>
                </div>
                <div class="t_box mt10">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第五球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_5_h21"></td>
                            <td class="bian_td_inp" id="ball_5_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_5_h22"></td>
                            <td class="bian_td_inp" id="ball_5_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_5_h23"></td>
                            <td class="bian_td_inp" id="ball_5_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_5_h24"></td>
                            <td class="bian_td_inp" id="ball_5_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_5_h25"></td>
                            <td class="bian_td_inp" id="ball_5_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_5_h26"></td>
                            <td class="bian_td_inp" id="ball_5_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_5_h27"></td>
                            <td class="bian_td_inp" id="ball_5_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_5_h28"></td>
                            <td class="bian_td_inp" id="ball_5_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第六球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_6_h21"></td>
                            <td class="bian_td_inp" id="ball_6_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_6_h22"></td>
                            <td class="bian_td_inp" id="ball_6_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_6_h23"></td>
                            <td class="bian_td_inp" id="ball_6_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_6_h24"></td>
                            <td class="bian_td_inp" id="ball_6_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_6_h25"></td>
                            <td class="bian_td_inp" id="ball_6_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_6_h26"></td>
                            <td class="bian_td_inp" id="ball_6_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_6_h27"></td>
                            <td class="bian_td_inp" id="ball_6_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_6_h28"></td>
                            <td class="bian_td_inp" id="ball_6_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第七球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_7_h21"></td>
                            <td class="bian_td_inp" id="ball_7_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_7_h22"></td>
                            <td class="bian_td_inp" id="ball_7_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_7_h23"></td>
                            <td class="bian_td_inp" id="ball_7_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_7_h24"></td>
                            <td class="bian_td_inp" id="ball_7_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_7_h25"></td>
                            <td class="bian_td_inp" id="ball_7_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_7_h26"></td>
                            <td class="bian_td_inp" id="ball_7_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_7_h27"></td>
                            <td class="bian_td_inp" id="ball_7_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_7_h28"></td>
                            <td class="bian_td_inp" id="ball_7_t28"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab3">
                        <tr>
                            <td class="tit" colspan="3">第八球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>大</td>
                            <td class="bian_td_odds" id="ball_8_h21"></td>
                            <td class="bian_td_inp" id="ball_8_t21"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>小</td>
                            <td class="bian_td_odds" id="ball_8_h22"></td>
                            <td class="bian_td_inp" id="ball_8_t22"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>单</td>
                            <td class="bian_td_odds" id="ball_8_h23"></td>
                            <td class="bian_td_inp" id="ball_8_t23"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>双</td>
                            <td class="bian_td_odds" id="ball_8_h24"></td>
                            <td class="bian_td_inp" id="ball_8_t24"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾大</td>
                            <td class="bian_td_odds" id="ball_8_h25"></td>
                            <td class="bian_td_inp" id="ball_8_t25"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>尾小</td>
                            <td class="bian_td_odds" id="ball_8_h26"></td>
                            <td class="bian_td_inp" id="ball_8_t26"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合单</td>
                            <td class="bian_td_odds" id="ball_8_h27"></td>
                            <td class="bian_td_inp" id="ball_8_t27"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><b>合双</td>
                            <td class="bian_td_odds" id="ball_8_h28"></td>
                            <td class="bian_td_inp" id="ball_8_t28"></td>
                        </tr>
                    </table>
                </div>
				
				<?php } elseif($type == '单球1~8') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr class="tit">
        <form name="orders" id="orders" action="/Lottery/order/order3.php?type=3" method="post" target="OrderFrame">
                              
                          <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第一球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_1_h1"></td>
                        <td class="bian_td_inp" id="ball_1_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_1_h6"></td>
                        <td class="bian_td_inp" id="ball_1_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_1_h11"></td>
                        <td class="bian_td_inp" id="ball_1_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_1_h16"></td>
                        <td class="bian_td_inp" id="ball_1_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_1_h2"></td>
                        <td class="bian_td_inp" id="ball_1_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_1_h7"></td>
                        <td class="bian_td_inp" id="ball_1_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_1_h12"></td>
                        <td class="bian_td_inp" id="ball_1_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_1_h17"></td>
                        <td class="bian_td_inp" id="ball_1_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_1_h3"></td>
                        <td class="bian_td_inp" id="ball_1_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_1_h8"></td>
                        <td class="bian_td_inp" id="ball_1_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_1_h13"></td>
                        <td class="bian_td_inp" id="ball_1_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_1_h18"></td>
                        <td class="bian_td_inp" id="ball_1_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_1_h4"></td>
                        <td class="bian_td_inp" id="ball_1_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_1_h9"></td>
                        <td class="bian_td_inp" id="ball_1_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_1_h14"></td>
                        <td class="bian_td_inp" id="ball_1_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_1_h19"></td>
                        <td class="bian_td_inp" id="ball_1_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_1_h5"></td>
                        <td class="bian_td_inp" id="ball_1_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_1_h10"></td>
                        <td class="bian_td_inp" id="ball_1_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_1_h15"></td>
                        <td class="bian_td_inp" id="ball_1_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_1_h20"></td>
                        <td class="bian_td_inp" id="ball_1_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第二球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_2_h1"></td>
                        <td class="bian_td_inp" id="ball_2_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_2_h6"></td>
                        <td class="bian_td_inp" id="ball_2_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_2_h11"></td>
                        <td class="bian_td_inp" id="ball_2_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_2_h16"></td>
                        <td class="bian_td_inp" id="ball_2_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_2_h2"></td>
                        <td class="bian_td_inp" id="ball_2_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_2_h7"></td>
                        <td class="bian_td_inp" id="ball_2_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_2_h12"></td>
                        <td class="bian_td_inp" id="ball_2_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_2_h17"></td>
                        <td class="bian_td_inp" id="ball_2_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_2_h3"></td>
                        <td class="bian_td_inp" id="ball_2_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_2_h8"></td>
                        <td class="bian_td_inp" id="ball_2_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_2_h13"></td>
                        <td class="bian_td_inp" id="ball_2_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_2_h18"></td>
                        <td class="bian_td_inp" id="ball_2_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_2_h4"></td>
                        <td class="bian_td_inp" id="ball_2_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_2_h9"></td>
                        <td class="bian_td_inp" id="ball_2_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_2_h14"></td>
                        <td class="bian_td_inp" id="ball_2_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_2_h19"></td>
                        <td class="bian_td_inp" id="ball_2_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_2_h5"></td>
                        <td class="bian_td_inp" id="ball_2_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_2_h10"></td>
                        <td class="bian_td_inp" id="ball_2_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_2_h15"></td>
                        <td class="bian_td_inp" id="ball_2_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_2_h20"></td>
                        <td class="bian_td_inp" id="ball_2_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第三球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_3_h1"></td>
                        <td class="bian_td_inp" id="ball_3_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_3_h6"></td>
                        <td class="bian_td_inp" id="ball_3_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_3_h11"></td>
                        <td class="bian_td_inp" id="ball_3_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_3_h16"></td>
                        <td class="bian_td_inp" id="ball_3_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_3_h2"></td>
                        <td class="bian_td_inp" id="ball_3_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_3_h7"></td>
                        <td class="bian_td_inp" id="ball_3_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_3_h12"></td>
                        <td class="bian_td_inp" id="ball_3_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_3_h17"></td>
                        <td class="bian_td_inp" id="ball_3_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_3_h3"></td>
                        <td class="bian_td_inp" id="ball_3_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_3_h8"></td>
                        <td class="bian_td_inp" id="ball_3_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_3_h13"></td>
                        <td class="bian_td_inp" id="ball_3_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_3_h18"></td>
                        <td class="bian_td_inp" id="ball_3_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_3_h4"></td>
                        <td class="bian_td_inp" id="ball_3_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_3_h9"></td>
                        <td class="bian_td_inp" id="ball_3_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_3_h14"></td>
                        <td class="bian_td_inp" id="ball_3_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_3_h19"></td>
                        <td class="bian_td_inp" id="ball_3_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_3_h5"></td>
                        <td class="bian_td_inp" id="ball_3_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_3_h10"></td>
                        <td class="bian_td_inp" id="ball_3_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_3_h15"></td>
                        <td class="bian_td_inp" id="ball_3_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_3_h20"></td>
                        <td class="bian_td_inp" id="ball_3_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第四球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_4_h1"></td>
                        <td class="bian_td_inp" id="ball_4_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_4_h6"></td>
                        <td class="bian_td_inp" id="ball_4_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_4_h11"></td>
                        <td class="bian_td_inp" id="ball_4_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_4_h16"></td>
                        <td class="bian_td_inp" id="ball_4_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_4_h2"></td>
                        <td class="bian_td_inp" id="ball_4_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_4_h7"></td>
                        <td class="bian_td_inp" id="ball_4_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_4_h12"></td>
                        <td class="bian_td_inp" id="ball_4_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_4_h17"></td>
                        <td class="bian_td_inp" id="ball_4_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_4_h3"></td>
                        <td class="bian_td_inp" id="ball_4_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_4_h8"></td>
                        <td class="bian_td_inp" id="ball_4_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_4_h13"></td>
                        <td class="bian_td_inp" id="ball_4_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_4_h18"></td>
                        <td class="bian_td_inp" id="ball_4_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_4_h4"></td>
                        <td class="bian_td_inp" id="ball_4_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_4_h9"></td>
                        <td class="bian_td_inp" id="ball_4_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_4_h14"></td>
                        <td class="bian_td_inp" id="ball_4_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_4_h19"></td>
                        <td class="bian_td_inp" id="ball_4_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_4_h5"></td>
                        <td class="bian_td_inp" id="ball_4_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_4_h10"></td>
                        <td class="bian_td_inp" id="ball_4_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_4_h15"></td>
                        <td class="bian_td_inp" id="ball_4_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_4_h20"></td>
                        <td class="bian_td_inp" id="ball_4_t20"></td>
                    </tr>
                </table>
                
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第五球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_5_h1"></td>
                        <td class="bian_td_inp" id="ball_5_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_5_h6"></td>
                        <td class="bian_td_inp" id="ball_5_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_5_h11"></td>
                        <td class="bian_td_inp" id="ball_5_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_5_h16"></td>
                        <td class="bian_td_inp" id="ball_5_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_5_h2"></td>
                        <td class="bian_td_inp" id="ball_5_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_5_h7"></td>
                        <td class="bian_td_inp" id="ball_5_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_5_h12"></td>
                        <td class="bian_td_inp" id="ball_5_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_5_h17"></td>
                        <td class="bian_td_inp" id="ball_5_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_5_h3"></td>
                        <td class="bian_td_inp" id="ball_5_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_5_h8"></td>
                        <td class="bian_td_inp" id="ball_5_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_5_h13"></td>
                        <td class="bian_td_inp" id="ball_5_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_5_h18"></td>
                        <td class="bian_td_inp" id="ball_5_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_5_h4"></td>
                        <td class="bian_td_inp" id="ball_5_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_5_h9"></td>
                        <td class="bian_td_inp" id="ball_5_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_5_h14"></td>
                        <td class="bian_td_inp" id="ball_5_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_5_h19"></td>
                        <td class="bian_td_inp" id="ball_5_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_5_h5"></td>
                        <td class="bian_td_inp" id="ball_5_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_5_h10"></td>
                        <td class="bian_td_inp" id="ball_5_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_5_h15"></td>
                        <td class="bian_td_inp" id="ball_5_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_5_h20"></td>
                        <td class="bian_td_inp" id="ball_5_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第六球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_6_h1"></td>
                        <td class="bian_td_inp" id="ball_6_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_6_h6"></td>
                        <td class="bian_td_inp" id="ball_6_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_6_h11"></td>
                        <td class="bian_td_inp" id="ball_6_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_6_h16"></td>
                        <td class="bian_td_inp" id="ball_6_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_6_h2"></td>
                        <td class="bian_td_inp" id="ball_6_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_6_h7"></td>
                        <td class="bian_td_inp" id="ball_6_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_6_h12"></td>
                        <td class="bian_td_inp" id="ball_6_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_6_h17"></td>
                        <td class="bian_td_inp" id="ball_6_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_6_h3"></td>
                        <td class="bian_td_inp" id="ball_6_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_6_h8"></td>
                        <td class="bian_td_inp" id="ball_6_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_6_h13"></td>
                        <td class="bian_td_inp" id="ball_6_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_6_h18"></td>
                        <td class="bian_td_inp" id="ball_6_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_6_h4"></td>
                        <td class="bian_td_inp" id="ball_6_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_6_h9"></td>
                        <td class="bian_td_inp" id="ball_6_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_6_h14"></td>
                        <td class="bian_td_inp" id="ball_6_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_6_h19"></td>
                        <td class="bian_td_inp" id="ball_6_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_6_h5"></td>
                        <td class="bian_td_inp" id="ball_6_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_6_h10"></td>
                        <td class="bian_td_inp" id="ball_6_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_6_h15"></td>
                        <td class="bian_td_inp" id="ball_6_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_6_h20"></td>
                        <td class="bian_td_inp" id="ball_6_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第七球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_7_h1"></td>
                        <td class="bian_td_inp" id="ball_7_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_7_h6"></td>
                        <td class="bian_td_inp" id="ball_7_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_7_h11"></td>
                        <td class="bian_td_inp" id="ball_7_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_7_h16"></td>
                        <td class="bian_td_inp" id="ball_7_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_7_h2"></td>
                        <td class="bian_td_inp" id="ball_7_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_7_h7"></td>
                        <td class="bian_td_inp" id="ball_7_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_7_h12"></td>
                        <td class="bian_td_inp" id="ball_7_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_7_h17"></td>
                        <td class="bian_td_inp" id="ball_7_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_7_h3"></td>
                        <td class="bian_td_inp" id="ball_7_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_7_h8"></td>
                        <td class="bian_td_inp" id="ball_7_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_7_h13"></td>
                        <td class="bian_td_inp" id="ball_7_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_7_h18"></td>
                        <td class="bian_td_inp" id="ball_7_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_7_h4"></td>
                        <td class="bian_td_inp" id="ball_7_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_7_h9"></td>
                        <td class="bian_td_inp" id="ball_7_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_7_h14"></td>
                        <td class="bian_td_inp" id="ball_7_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_7_h19"></td>
                        <td class="bian_td_inp" id="ball_7_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_7_h5"></td>
                        <td class="bian_td_inp" id="ball_7_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_7_h10"></td>
                        <td class="bian_td_inp" id="ball_7_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_7_h15"></td>
                        <td class="bian_td_inp" id="ball_7_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_7_h20"></td>
                        <td class="bian_td_inp" id="ball_7_t20"></td>
                    </tr>
                </table>
                      <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                      <tr>
                            <td class="tit" colspan="12">第八球</td>
                        </tr>
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_8_h1"></td>
                        <td class="bian_td_inp" id="ball_8_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_8_h6"></td>
                        <td class="bian_td_inp" id="ball_8_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_8_h11"></td>
                        <td class="bian_td_inp" id="ball_8_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_8_h16"></td>
                        <td class="bian_td_inp" id="ball_8_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_8_h2"></td>
                        <td class="bian_td_inp" id="ball_8_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_8_h7"></td>
                        <td class="bian_td_inp" id="ball_8_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_8_h12"></td>
                        <td class="bian_td_inp" id="ball_8_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_8_h17"></td>
                        <td class="bian_td_inp" id="ball_8_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_8_h3"></td>
                        <td class="bian_td_inp" id="ball_8_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_8_h8"></td>
                        <td class="bian_td_inp" id="ball_8_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_8_h13"></td>
                        <td class="bian_td_inp" id="ball_8_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_8_h18"></td>
                        <td class="bian_td_inp" id="ball_8_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_8_h4"></td>
                        <td class="bian_td_inp" id="ball_8_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_8_h9"></td>
                        <td class="bian_td_inp" id="ball_8_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_8_h14"></td>
                        <td class="bian_td_inp" id="ball_8_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_8_h19"></td>
                        <td class="bian_td_inp" id="ball_8_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_8_h5"></td>
                        <td class="bian_td_inp" id="ball_8_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_8_h10"></td>
                        <td class="bian_td_inp" id="ball_8_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_8_h15"></td>
                        <td class="bian_td_inp" id="ball_8_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_8_h20"></td>
                        <td class="bian_td_inp" id="ball_8_t20"></td>
                    </tr>
                </table>
				
            <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球' || $type == '第四球' || $type == '第五球' || $type == '第六球' || $type == '第七球' || $type == '第八球') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 xync">
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h1"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t1"></td>
                        <td class="bian_td_qiu"><b><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h6"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t6"></td>
                        <td class="bian_td_qiu"><b><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h11"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t11"></td>
                        <td class="bian_td_qiu"><b><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h16"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t16"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h2"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t2"></td>
                        <td class="bian_td_qiu"><b><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h7"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t7"></td>
                        <td class="bian_td_qiu"><b><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h12"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t12"></td>
                        <td class="bian_td_qiu"><b><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h17"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t17"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h3"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t3"></td>
                        <td class="bian_td_qiu"><b><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h8"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t8"></td>
                        <td class="bian_td_qiu"><b><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h13"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t13"></td>
                        <td class="bian_td_qiu"><b><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h18"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t18"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h4"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t4"></td>
                        <td class="bian_td_qiu"><b><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h9"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t9"></td>
                        <td class="bian_td_qiu"><b><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h14"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t14"></td>
                        <td class="bian_td_qiu"><b><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h19"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t19"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h5"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t5"></td>
                        <td class="bian_td_qiu"><b><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h10"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t10"></td>
                        <td class="bian_td_qiu"><b><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h15"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t15"></td>
                        <td class="bian_td_qiu"><b><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h20"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t20"></td>
                    </tr>
                </table>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>大</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h21"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t21"></td>
                        <td class="bian_td_qiu"><b>合单</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h27"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t27"></td>
                        <td class="bian_td_qiu"><b>东</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h29"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t29"></td>
                        <td class="bian_td_qiu"><b>中</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h33"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t33"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>小</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h22"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t22"></td>
                        <td class="bian_td_qiu"><b>合双</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h28"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t28"></td>
                        <td class="bian_td_qiu"><b>南</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h30"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t30"></td>
                        <td class="bian_td_qiu"><b>发</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h34"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t34"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>单</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h23"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t23"></td>
                        <td class="bian_td_qiu"><b>尾大</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h25"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t25"></td>
                        <td class="bian_td_qiu"><b>西</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h31"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t31"></td>
                        <td class="bian_td_qiu"><b>白</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h35"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t35"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>双</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h24"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t24"></td>
                        <td class="bian_td_qiu"><b>尾小</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h26"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t26"></td>
                        <td class="bian_td_qiu"><b>北</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h32"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t32"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            <?php } elseif($type == '总和、龙虎') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr class="tit">
                        <td>项目</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>项目</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和大</td>
                        <td class="bian_td_odds" id="ball_9_h1"></td>
                        <td class="bian_td_inp" id="ball_9_t1"></td>
                        <td class="bian_td_qiu"><b>总和单</td>
                        <td class="bian_td_odds" id="ball_9_h3"></td>
                        <td class="bian_td_inp" id="ball_9_t3"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和小</td>
                        <td class="bian_td_odds" id="ball_9_h2"></td>
                        <td class="bian_td_inp" id="ball_9_t2"></td>
                        <td class="bian_td_qiu"><b>总和双</td>
                        <td class="bian_td_odds" id="ball_9_h4"></td>
                        <td class="bian_td_inp" id="ball_9_t4"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和尾大</td>
                        <td class="bian_td_odds" id="ball_9_h5"></td>
                        <td class="bian_td_inp" id="ball_9_t5"></td>
                        <td class="bian_td_qiu"><b>龙</td>
                        <td class="bian_td_odds" id="ball_9_h7"></td>
                        <td class="bian_td_inp" id="ball_9_t7"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><b>总和尾小</td>
                        <td class="bian_td_odds" id="ball_9_h6"></td>
                        <td class="bian_td_inp" id="ball_9_t6"></td>
                        <td class="bian_td_qiu"><b>虎</td>
                        <td class="bian_td_odds" id="ball_9_h8"></td>
                        <td class="bian_td_inp" id="ball_9_t8"></td>
                    </tr>
                </table>
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

    <?php if($g_i > 0) { ?>
        <table cellspacing="1" cellpadding="0" border="0" class="gm_tj">
            <thead>
            <tr>
                <th width="80" class="t1">今天</th>
                <th>01</th>
                <th>02</th>
                <th>03</th>
                <th>04</th>
                <th>05</th>
                <th>06</th>
                <th>07</th>
                <th>08</th>
                <th>09</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th class="red">19</th>
                <th class="red">20</th>
            </tr>
            </thead>
            <tbody id="tongji"></tbody>
        </table>
    <?php } ?>
    <table cellspacing="1" cellpadding="0" border="0" class="gm_lz">
        <thead>
        <tr>
            <?php if($g_i == 0) { ?>
                <th class="cur" colspan="6"><a href="javascript:void(0)">总和大小</a></th>
                <th colspan="6"><a href="javascript:void(0)">总和单双</a></th>
                <th colspan="7"><a href="javascript:void(0)">总和尾数大小</a></th>
                <th colspan="6"><a href="javascript:void(0)">龙虎</a></th>
            <?php } elseif($g_i > 0) { ?>
                <th class="cur" colspan="2"><a href="javascript:void(0)"><?=$type?></a></th>
                <th colspan="2"><a href="javascript:void(0)">大小</a></th>
                <th colspan="2"><a href="javascript:void(0)">单双</a></th>
                <th colspan="2"><a href="javascript:void(0)">尾数大小</a></th>
                <th colspan="2"><a href="javascript:void(0)">合数单双</a></th>
                <th colspan="2"><a href="javascript:void(0)">方位</a></th>
                <th colspan="2"><a href="javascript:void(0)">中发白</a></th>
                <th colspan="2"><a href="javascript:void(0)">总和大小</a></th>
                <th colspan="2"><a href="javascript:void(0)">总和单双</a></th>
                <th colspan="5"><a href="javascript:void(0)">总和尾数大小</a></th>
                <th colspan="2"><a href="javascript:void(0)">龙虎</a></th>
            <?php } ?>
        </tr>
        </thead>
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
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript">
        loadinfo(<?=$g_i?>);
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

