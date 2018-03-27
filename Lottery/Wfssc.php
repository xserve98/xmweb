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
if(intval($web_site['wfssc']) == 1) {
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
    case '数字盘':
        $g_i = 6;
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
    <script type="text/javascript" src="js/wf_ssc.js"></script>
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
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">聚友国际五分彩</span> — <span class="gameName" id="gameName"> <?=$type?></span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

                <input id="gm_mode" type="hidden" value="jswfc" />
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
        <form name="orders" id="orders" action="/Lottery/order/order.php?type=15" method="post" target="OrderFrame">
            <?php if($type == '两面盘') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第一球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_1_h11"></td>
                            <td class="bian_td_inp" id="ball_1_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_1_h12"></td>
                            <td class="bian_td_inp" id="ball_1_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_1_h13"></td>
                            <td class="bian_td_inp" id="ball_1_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_1_h14"></td>
                            <td class="bian_td_inp" id="ball_1_t14"></td>
                        </tr>
                          <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_1_h1"></td>
                            <td class="bian_td_inp" id="ball_1_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_1_h2"></td>
                            <td class="bian_td_inp" id="ball_1_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_1_h3"></td>
                            <td class="bian_td_inp" id="ball_1_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_1_h4"></td>
                            <td class="bian_td_inp" id="ball_1_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_1_h5"></td>
                            <td class="bian_td_inp" id="ball_1_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_1_h6"></td>
                            <td class="bian_td_inp" id="ball_1_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_1_h7"></td>
                            <td class="bian_td_inp" id="ball_1_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_1_h8"></td>
                            <td class="bian_td_inp" id="ball_1_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_1_h9"></td>
                            <td class="bian_td_inp" id="ball_1_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_1_h10"></td>
                            <td class="bian_td_inp" id="ball_1_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第二球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_2_h11"></td>
                            <td class="bian_td_inp" id="ball_2_t11"></td>
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
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_2_h1"></td>
                            <td class="bian_td_inp" id="ball_2_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_2_h2"></td>
                            <td class="bian_td_inp" id="ball_2_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_2_h3"></td>
                            <td class="bian_td_inp" id="ball_2_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_2_h4"></td>
                            <td class="bian_td_inp" id="ball_2_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_2_h5"></td>
                            <td class="bian_td_inp" id="ball_2_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_2_h6"></td>
                            <td class="bian_td_inp" id="ball_2_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_2_h7"></td>
                            <td class="bian_td_inp" id="ball_2_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_2_h8"></td>
                            <td class="bian_td_inp" id="ball_2_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_2_h9"></td>
                            <td class="bian_td_inp" id="ball_2_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_2_h10"></td>
                            <td class="bian_td_inp" id="ball_2_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第三球</td>
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
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_3_h1"></td>
                            <td class="bian_td_inp" id="ball_3_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_3_h2"></td>
                            <td class="bian_td_inp" id="ball_3_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_3_h3"></td>
                            <td class="bian_td_inp" id="ball_3_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_3_h4"></td>
                            <td class="bian_td_inp" id="ball_3_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_3_h5"></td>
                            <td class="bian_td_inp" id="ball_3_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_3_h6"></td>
                            <td class="bian_td_inp" id="ball_3_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_3_h7"></td>
                            <td class="bian_td_inp" id="ball_3_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_3_h8"></td>
                            <td class="bian_td_inp" id="ball_3_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_3_h9"></td>
                            <td class="bian_td_inp" id="ball_3_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_3_h10"></td>
                            <td class="bian_td_inp" id="ball_3_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第四球</td>
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
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_4_h1"></td>
                            <td class="bian_td_inp" id="ball_4_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_4_h2"></td>
                            <td class="bian_td_inp" id="ball_4_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_4_h3"></td>
                            <td class="bian_td_inp" id="ball_4_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_4_h4"></td>
                            <td class="bian_td_inp" id="ball_4_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_4_h5"></td>
                            <td class="bian_td_inp" id="ball_4_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_4_h6"></td>
                            <td class="bian_td_inp" id="ball_4_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_4_h7"></td>
                            <td class="bian_td_inp" id="ball_4_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_4_h8"></td>
                            <td class="bian_td_inp" id="ball_4_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_4_h9"></td>
                            <td class="bian_td_inp" id="ball_4_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_4_h10"></td>
                            <td class="bian_td_inp" id="ball_4_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第五球</td>
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
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_5_h1"></td>
                            <td class="bian_td_inp" id="ball_5_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_5_h2"></td>
                            <td class="bian_td_inp" id="ball_5_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_5_h3"></td>
                            <td class="bian_td_inp" id="ball_5_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_5_h4"></td>
                            <td class="bian_td_inp" id="ball_5_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_5_h5"></td>
                            <td class="bian_td_inp" id="ball_5_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_5_h6"></td>
                            <td class="bian_td_inp" id="ball_5_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_5_h7"></td>
                            <td class="bian_td_inp" id="ball_5_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_5_h8"></td>
                            <td class="bian_td_inp" id="ball_5_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_5_h9"></td>
                            <td class="bian_td_inp" id="ball_5_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_5_h10"></td>
                            <td class="bian_td_inp" id="ball_5_t10"></td>
                        </tr>
                    </table>
                </div>
				<?php } elseif($type == '总和 龙虎和') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td class="tit" colspan="15">总和 龙虎和</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和大</td>
                        <td class="bian_td_odds" id="ball_6_h1"></td>
                        <td class="bian_td_inp" id="ball_6_t1"></td>
                        <td class="bian_td_qiu">总和单</td>
                        <td class="bian_td_odds" id="ball_6_h3"></td>
                        <td class="bian_td_inp" id="ball_6_t3"></td>
                        <td class="bian_td_qiu">龙</td>
                        <td class="bian_td_odds" id="ball_6_h5"></td>
                        <td class="bian_td_inp" id="ball_6_t5"></td>
                        <td class="bian_td_qiu">和</td>
                        <td class="bian_td_odds" id="ball_6_h7"></td>
                        <td class="bian_td_inp" id="ball_6_t7"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和小</td>
                        <td class="bian_td_odds" id="ball_6_h2"></td>
                        <td class="bian_td_inp" id="ball_6_t2"></td>
                        <td class="bian_td_qiu">总和双</td>
                        <td class="bian_td_odds" id="ball_6_h4"></td>
                        <td class="bian_td_inp" id="ball_6_t4"></td>
                        <td class="bian_td_qiu">虎</td>
                        <td class="bian_td_odds" id="ball_6_h6"></td>
                        <td class="bian_td_inp" id="ball_6_t6"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
				<?php } elseif($type == '斗牛') { ?>
				<table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td class="tit" colspan="15">斗牛</td>
                    </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">没牛</td>
                                <td class="bian_td_odds" id="ball_10_h1"></td>
                                <td class="bian_td_inp" id="ball_10_t1"></td>
                                <td class="bian_td_qiu">牛四</td>
                                <td class="bian_td_odds" id="ball_10_h5"></td>
                                <td class="bian_td_inp" id="ball_10_t5"></td>
                                <td class="bian_td_qiu">牛八</td>
                                <td class="bian_td_odds" id="ball_10_h9"></td>
                                <td class="bian_td_inp" id="ball_10_t9"></td>
                                <td class="bian_td_qiu">牛大</td>
                                <td class="bian_td_odds" id="ball_10_h12"></td>
                                <td class="bian_td_inp" id="ball_10_t12"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">牛一</td>
                                <td class="bian_td_odds" id="ball_10_h2"></td>
                                <td class="bian_td_inp" id="ball_10_t2"></td>
                                <td class="bian_td_qiu">牛五</td>
                                <td class="bian_td_odds" id="ball_10_h6"></td>
                                <td class="bian_td_inp" id="ball_10_t6"></td>
                                <td class="bian_td_qiu">牛九</td>
                                <td class="bian_td_odds" id="ball_10_h10"></td>
                                <td class="bian_td_inp" id="ball_10_t10"></td>
                                <td class="bian_td_qiu">牛小</td>
                                <td class="bian_td_odds" id="ball_10_h13"></td>
                                <td class="bian_td_inp" id="ball_10_t13"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">牛二</td>
                                <td class="bian_td_odds" id="ball_10_h3"></td>
                                <td class="bian_td_inp" id="ball_10_t3"></td>
                                <td class="bian_td_qiu">牛六</td>
                                <td class="bian_td_odds" id="ball_10_h7"></td>
                                <td class="bian_td_inp" id="ball_10_t7"></td>
                                <td class="bian_td_qiu">牛牛</td>
                                <td class="bian_td_odds" id="ball_10_h11"></td>
                                <td class="bian_td_inp" id="ball_10_t11"></td>
                                <td class="bian_td_qiu">牛单</td>
                                <td class="bian_td_odds" id="ball_10_h14"></td>
                                <td class="bian_td_inp" id="ball_10_t14"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">牛三</td>
                                <td class="bian_td_odds" id="ball_10_h4"></td>
                                <td class="bian_td_inp" id="ball_10_t4"></td>
                                <td class="bian_td_qiu">牛七</td>
                                <td class="bian_td_odds" id="ball_10_h8"></td>
                                <td class="bian_td_inp" id="ball_10_t8"></td>
                                <td colspan="3">&nbsp;</td>
                                <td class="bian_td_qiu">牛双</td>
                                <td class="bian_td_odds" id="ball_10_h15"></td>
                                <td class="bian_td_inp" id="ball_10_t15"></td>
                            </tr>
                        </table>
						<?php } elseif($type == '梭哈') { ?>
                        <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td class="tit" colspan="15">梭哈</td>
                    </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">五条</td>
                                <td class="bian_td_odds" id="ball_11_h1"></td>
                                <td class="bian_td_inp" id="ball_11_t1"></td>
                                <td class="bian_td_qiu">四条</td>
                                <td class="bian_td_odds" id="ball_11_h2"></td>
                                <td class="bian_td_inp" id="ball_11_t2"></td>
                                <td class="bian_td_qiu">葫芦</td>
                                <td class="bian_td_odds" id="ball_11_h3"></td>
                                <td class="bian_td_inp" id="ball_11_t3"></td>
                                <td class="bian_td_qiu">顺子</td>
                                <td class="bian_td_odds" id="ball_11_h4"></td>
                                <td class="bian_td_inp" id="ball_11_t4"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">三条</td>
                                <td class="bian_td_odds" id="ball_11_h5"></td>
                                <td class="bian_td_inp" id="ball_11_t5"></td>
                                <td class="bian_td_qiu">两对</td>
                                <td class="bian_td_odds" id="ball_11_h6"></td>
                                <td class="bian_td_inp" id="ball_11_t6"></td>
                                <td class="bian_td_qiu">一对</td>
                                <td class="bian_td_odds" id="ball_11_h7"></td>
                                <td class="bian_td_inp" id="ball_11_t7"></td>
                                <td class="bian_td_qiu">散号</td>
                                <td class="bian_td_odds" id="ball_11_h8"></td>
                                <td class="bian_td_inp" id="ball_11_t8"></td>
                            </tr>
                        </table>
						<?php } elseif($type == '组合') { ?>
                        <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                            <tr class="tr_tit">
                                <td class="tit" colspan="3">前三球</td>
                                <td class="tit" colspan="3">中三球</td>
                                <td class="tit" colspan="3">后三球</td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">豹子</td>
                                <td class="bian_td_odds" id="ball_7_h1"></td>
                                <td class="bian_td_inp" id="ball_7_t1"></td>
                                <td class="bian_td_qiu">豹子</td>
                                <td class="bian_td_odds" id="ball_8_h1"></td>
                                <td class="bian_td_inp" id="ball_8_t1"></td>
                                <td class="bian_td_qiu">豹子</td>
                                <td class="bian_td_odds" id="ball_9_h1"></td>
                                <td class="bian_td_inp" id="ball_9_t1"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">顺子</td>
                                <td class="bian_td_odds" id="ball_7_h2"></td>
                                <td class="bian_td_inp" id="ball_7_t2"></td>
                                <td class="bian_td_qiu">顺子</td>
                                <td class="bian_td_odds" id="ball_8_h2"></td>
                                <td class="bian_td_inp" id="ball_8_t2"></td>
                                <td class="bian_td_qiu">顺子</td>
                                <td class="bian_td_odds" id="ball_9_h2"></td>
                                <td class="bian_td_inp" id="ball_9_t2"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">对子</td>
                                <td class="bian_td_odds" id="ball_7_h3"></td>
                                <td class="bian_td_inp" id="ball_7_t3"></td>
                                <td class="bian_td_qiu">对子</td>
                                <td class="bian_td_odds" id="ball_8_h3"></td>
                                <td class="bian_td_inp" id="ball_8_t3"></td>
                                <td class="bian_td_qiu">对子</td>
                                <td class="bian_td_odds" id="ball_9_h3"></td>
                                <td class="bian_td_inp" id="ball_9_t3"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">半顺</td>
                                <td class="bian_td_odds" id="ball_7_h4"></td>
                                <td class="bian_td_inp" id="ball_7_t4"></td>
                                <td class="bian_td_qiu">半顺</td>
                                <td class="bian_td_odds" id="ball_8_h4"></td>
                                <td class="bian_td_inp" id="ball_8_t4"></td>
                                <td class="bian_td_qiu">半顺</td>
                                <td class="bian_td_odds" id="ball_9_h4"></td>
                                <td class="bian_td_inp" id="ball_9_t4"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">杂六</td>
                                <td class="bian_td_odds" id="ball_7_h5"></td>
                                <td class="bian_td_inp" id="ball_7_t5"></td>
                                <td class="bian_td_qiu">杂六</td>
                                <td class="bian_td_odds" id="ball_8_h5"></td>
                                <td class="bian_td_inp" id="ball_8_t5"></td>
                                <td class="bian_td_qiu">杂六</td>
                                <td class="bian_td_odds" id="ball_9_h5"></td>
                                <td class="bian_td_inp" id="ball_9_t5"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">大</td>
                                <td class="bian_td_odds" id="ball_7_h6"></td>
                                <td class="bian_td_inp" id="ball_7_t6"></td>
                                <td class="bian_td_qiu">大</td>
                                <td class="bian_td_odds" id="ball_8_h6"></td>
                                <td class="bian_td_inp" id="ball_8_t6"></td>
                                <td class="bian_td_qiu">大</td>
                                <td class="bian_td_odds" id="ball_9_h6"></td>
                                <td class="bian_td_inp" id="ball_9_t6"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">小</td>
                                <td class="bian_td_odds" id="ball_7_h7"></td>
                                <td class="bian_td_inp" id="ball_7_t7"></td>
                                <td class="bian_td_qiu">小</td>
                                <td class="bian_td_odds" id="ball_8_h7"></td>
                                <td class="bian_td_inp" id="ball_8_t7"></td>
                                <td class="bian_td_qiu">小</td>
                                <td class="bian_td_odds" id="ball_9_h7"></td>
                                <td class="bian_td_inp" id="ball_9_t7"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">单</td>
                                <td class="bian_td_odds" id="ball_7_h8"></td>
                                <td class="bian_td_inp" id="ball_7_t8"></td>
                                <td class="bian_td_qiu">单</td>
                                <td class="bian_td_odds" id="ball_8_h8"></td>
                                <td class="bian_td_inp" id="ball_8_t8"></td>
                                <td class="bian_td_qiu">单</td>
                                <td class="bian_td_odds" id="ball_9_h8"></td>
                                <td class="bian_td_inp" id="ball_9_t8"></td>
                            </tr>
                            <tr class="tr_txt">
                                <td class="bian_td_qiu">双</td>
                                <td class="bian_td_odds" id="ball_7_h9"></td>
                                <td class="bian_td_inp" id="ball_7_t9"></td>
                                <td class="bian_td_qiu">双</td>
                                <td class="bian_td_odds" id="ball_8_h9"></td>
                                <td class="bian_td_inp" id="ball_8_t9"></td>
                                <td class="bian_td_qiu">双</td>
                                <td class="bian_td_odds" id="ball_9_h9"></td>
                                <td class="bian_td_inp" id="ball_9_t9"></td>
                            </tr>
                        </table>
            <?php } elseif($type == '数字盘') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第一球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_1_h1"></td>
                            <td class="bian_td_inp" id="ball_1_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_1_h2"></td>
                            <td class="bian_td_inp" id="ball_1_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_1_h3"></td>
                            <td class="bian_td_inp" id="ball_1_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_1_h4"></td>
                            <td class="bian_td_inp" id="ball_1_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_1_h5"></td>
                            <td class="bian_td_inp" id="ball_1_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_1_h6"></td>
                            <td class="bian_td_inp" id="ball_1_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_1_h7"></td>
                            <td class="bian_td_inp" id="ball_1_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_1_h8"></td>
                            <td class="bian_td_inp" id="ball_1_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_1_h9"></td>
                            <td class="bian_td_inp" id="ball_1_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_1_h10"></td>
                            <td class="bian_td_inp" id="ball_1_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第二球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_2_h1"></td>
                            <td class="bian_td_inp" id="ball_2_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_2_h2"></td>
                            <td class="bian_td_inp" id="ball_2_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_2_h3"></td>
                            <td class="bian_td_inp" id="ball_2_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_2_h4"></td>
                            <td class="bian_td_inp" id="ball_2_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_2_h5"></td>
                            <td class="bian_td_inp" id="ball_2_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_2_h6"></td>
                            <td class="bian_td_inp" id="ball_2_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_2_h7"></td>
                            <td class="bian_td_inp" id="ball_2_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_2_h8"></td>
                            <td class="bian_td_inp" id="ball_2_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_2_h9"></td>
                            <td class="bian_td_inp" id="ball_2_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_2_h10"></td>
                            <td class="bian_td_inp" id="ball_2_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第三球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_3_h1"></td>
                            <td class="bian_td_inp" id="ball_3_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_3_h2"></td>
                            <td class="bian_td_inp" id="ball_3_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_3_h3"></td>
                            <td class="bian_td_inp" id="ball_3_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_3_h4"></td>
                            <td class="bian_td_inp" id="ball_3_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_3_h5"></td>
                            <td class="bian_td_inp" id="ball_3_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_3_h6"></td>
                            <td class="bian_td_inp" id="ball_3_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_3_h7"></td>
                            <td class="bian_td_inp" id="ball_3_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_3_h8"></td>
                            <td class="bian_td_inp" id="ball_3_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_3_h9"></td>
                            <td class="bian_td_inp" id="ball_3_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_3_h10"></td>
                            <td class="bian_td_inp" id="ball_3_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第四球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_4_h1"></td>
                            <td class="bian_td_inp" id="ball_4_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_4_h2"></td>
                            <td class="bian_td_inp" id="ball_4_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_4_h3"></td>
                            <td class="bian_td_inp" id="ball_4_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_4_h4"></td>
                            <td class="bian_td_inp" id="ball_4_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_4_h5"></td>
                            <td class="bian_td_inp" id="ball_4_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_4_h6"></td>
                            <td class="bian_td_inp" id="ball_4_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_4_h7"></td>
                            <td class="bian_td_inp" id="ball_4_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_4_h8"></td>
                            <td class="bian_td_inp" id="ball_4_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_4_h9"></td>
                            <td class="bian_td_inp" id="ball_4_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_4_h10"></td>
                            <td class="bian_td_inp" id="ball_4_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab2 ssc">
                        <tr>
                            <td class="tit" colspan="3">第五球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_5_h1"></td>
                            <td class="bian_td_inp" id="ball_5_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_5_h2"></td>
                            <td class="bian_td_inp" id="ball_5_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_5_h3"></td>
                            <td class="bian_td_inp" id="ball_5_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_5_h4"></td>
                            <td class="bian_td_inp" id="ball_5_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_5_h5"></td>
                            <td class="bian_td_inp" id="ball_5_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_5_h6"></td>
                            <td class="bian_td_inp" id="ball_5_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_5_h7"></td>
                            <td class="bian_td_inp" id="ball_5_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_5_h8"></td>
                            <td class="bian_td_inp" id="ball_5_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_5_h9"></td>
                            <td class="bian_td_inp" id="ball_5_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_5_h10"></td>
                            <td class="bian_td_inp" id="ball_5_t10"></td>
                        </tr>
                    </table>
                </div>
            <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球' || $type == '第四球' || $type == '第五球') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 ssc">
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
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_0"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h1"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t1"></td>
                        <td class="bian_td_qiu"><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h2"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t2"></td>
                        <td class="bian_td_qiu"><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h3"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t3"></td>
                        <td class="bian_td_qiu"><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h4"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t4"></td>
                        <td class="bian_td_qiu"><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h5"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t5"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h6"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t6"></td>
                        <td class="bian_td_qiu"><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h7"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t7"></td>
                        <td class="bian_td_qiu"><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h8"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t8"></td>
                        <td class="bian_td_qiu"><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h9"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t9"></td>
                        <td class="bian_td_qiu"><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h10"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t10"></td>
                    </tr>
                </table>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">大</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h11"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t11"></td>
                        <td class="bian_td_qiu">单</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h13"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t13"></td>
                        <td class="bian_td_qiu">总和大</td>
                        <td class="bian_td_odds" id="ball_6_h1"></td>
                        <td class="bian_td_inp" id="ball_6_t1"></td>
                        <td class="bian_td_qiu">总和单</td>
                        <td class="bian_td_odds" id="ball_6_h3"></td>
                        <td class="bian_td_inp" id="ball_6_t3"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">小</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h12"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t12"></td>
                        <td class="bian_td_qiu">双</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h14"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t14"></td>
                        <td class="bian_td_qiu">总和小</td>
                        <td class="bian_td_odds" id="ball_6_h2"></td>
                        <td class="bian_td_inp" id="ball_6_t2"></td>
                        <td class="bian_td_qiu">总和双</td>
                        <td class="bian_td_odds" id="ball_6_h4"></td>
                        <td class="bian_td_inp" id="ball_6_t4"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">龙</td>
                        <td class="bian_td_odds" id="ball_6_h5"></td>
                        <td class="bian_td_inp" id="ball_6_t5"></td>
                        <td class="bian_td_qiu">虎</td>
                        <td class="bian_td_odds" id="ball_6_h6"></td>
                        <td class="bian_td_inp" id="ball_6_t6"></td>
                        <td class="bian_td_qiu">和</td>
                        <td class="bian_td_odds" id="ball_6_h7"></td>
                        <td class="bian_td_inp" id="ball_6_t7"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td class="tit" colspan="15">前三</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">豹子</td>
                        <td class="bian_td_odds" id="ball_7_h1"></td>
                        <td class="bian_td_inp" id="ball_7_t1"></td>
                        <td class="bian_td_qiu">顺子</td>
                        <td class="bian_td_odds" id="ball_7_h2"></td>
                        <td class="bian_td_inp" id="ball_7_t2"></td>
                        <td class="bian_td_qiu">对子</td>
                        <td class="bian_td_odds" id="ball_7_h3"></td>
                        <td class="bian_td_inp" id="ball_7_t3"></td>
                        <td class="bian_td_qiu">半顺</td>
                        <td class="bian_td_odds" id="ball_7_h4"></td>
                        <td class="bian_td_inp" id="ball_7_t4"></td>
                        <td class="bian_td_qiu">杂六</td>
                        <td class="bian_td_odds" id="ball_7_h5"></td>
                        <td class="bian_td_inp" id="ball_7_t5"></td>
                    </tr>
                    <tr>
                        <td class="tit" colspan="15">中三</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">豹子</td>
                        <td class="bian_td_odds" id="ball_8_h1"></td>
                        <td class="bian_td_inp" id="ball_8_t1"></td>
                        <td class="bian_td_qiu">顺子</td>
                        <td class="bian_td_odds" id="ball_8_h2"></td>
                        <td class="bian_td_inp" id="ball_8_t2"></td>
                        <td class="bian_td_qiu">对子</td>
                        <td class="bian_td_odds" id="ball_8_h3"></td>
                        <td class="bian_td_inp" id="ball_8_t3"></td>
                        <td class="bian_td_qiu">半顺</td>
                        <td class="bian_td_odds" id="ball_8_h4"></td>
                        <td class="bian_td_inp" id="ball_8_t4"></td>
                        <td class="bian_td_qiu">杂六</td>
                        <td class="bian_td_odds" id="ball_8_h5"></td>
                        <td class="bian_td_inp" id="ball_8_t5"></td>
                    </tr>
                    <tr>
                        <td class="tit" colspan="15">后三</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">豹子</td>
                        <td class="bian_td_odds" id="ball_9_h1"></td>
                        <td class="bian_td_inp" id="ball_9_t1"></td>
                        <td class="bian_td_qiu">顺子</td>
                        <td class="bian_td_odds" id="ball_9_h2"></td>
                        <td class="bian_td_inp" id="ball_9_t2"></td>
                        <td class="bian_td_qiu">对子</td>
                        <td class="bian_td_odds" id="ball_9_h3"></td>
                        <td class="bian_td_inp" id="ball_9_t3"></td>
                        <td class="bian_td_qiu">半顺</td>
                        <td class="bian_td_odds" id="ball_9_h4"></td>
                        <td class="bian_td_inp" id="ball_9_t4"></td>
                        <td class="bian_td_qiu">杂六</td>
                        <td class="bian_td_odds" id="ball_9_h5"></td>
                        <td class="bian_td_inp" id="ball_9_t5"></td>
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

    <?php if($type != '两面盘' && $type != '数字盘') { ?>
        <table cellspacing="1" cellpadding="0" border="0" class="gm_tj">
            <thead>
                <tr>
                    <th>0</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                </tr>
            </thead>
            <tbody id="tongji"></tbody>
        </table>
    <?php } ?>
    <table cellspacing="1" cellpadding="0" border="0" class="gm_lz">
        <thead>
            <tr>
                <?php if($type == '两面盘') { ?>
                    <th class="cur" colspan="8"><a href="javascript:void(0)">总和大小</a></th>
                    <th colspan="9"><a href="javascript:void(0)">总和单双</a></th>
                    <th colspan="8"><a href="javascript:void(0)">龙虎和</a></th>
                <?php } elseif($type == '数字盘') { ?>
                    <th class="cur" colspan="5"><a href="javascript:void(0)">第一球</a></th>
                    <th colspan="5"><a href="javascript:void(0)">第二球</a></th>
                    <th colspan="5"><a href="javascript:void(0)">第三球</a></th>
                    <th colspan="5"><a href="javascript:void(0)">第四球</a></th>
                    <th colspan="5"><a href="javascript:void(0)">第五球</a></th>
                <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球' || $type == '第四球' || $type == '第五球') { ?>
                    <th class="cur" colspan="5"><a href="javascript:void(0)"><?=$type?></a></th>
                    <th colspan="4"><a href="javascript:void(0)">大小</a></th>
                    <th colspan="4"><a href="javascript:void(0)">单双</a></th>
                    <th colspan="4"><a href="javascript:void(0)">总和大小</a></th>
                    <th colspan="4"><a href="javascript:void(0)">总和单双</a></th>
                    <th colspan="4"><a href="javascript:void(0)">龙虎和</a></th>
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