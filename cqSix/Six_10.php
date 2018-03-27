<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
include("class/number_sx.php");
$uid = $_SESSION['uid'];
if (intval($web_site['six']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$kj = $_COOKIE['six_money'];
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
    <script type="text/javascript" src="js/class_1.js"></script>
    <link type="text/css" rel="stylesheet" href="../Lottery/css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/newdsn/css/bet.css" />
</head>
<body class="skin_blue">
    <!--内容开始-->
    <?php
        $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 5";
        $query = $mysqli->query($sql);
        $list = '';
        while($rs = $query->fetch_array()) {
            $list .= $rs['msg'] . ' | ';
        }
    ?>
    <div style="display:none;" class="gonggao">
        <div class="list" onclick="gonggao()">
            <div id="gg"><?=$list?></div>
        </div>
        <div class="more"><a title="查看更多" href="javascript:gonggao();"></a></div>
    </div>
    <div class="news">
        <ul>
            <?php
                $query->data_seek(0);
                $i = 1;
                while($rs = $query->fetch_array()) {
                    ?>
                    <li>[<?=$i?>] <?=$rs['msg']?></li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    </div>
    

    
    <div id="header">
<div class="lottery_info">
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">极速六合彩</span> — <span class="gameName" id="gameName"> 一肖/尾数</span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

 <input id="gm_mode" type="hidden" value="cqssc" />
 <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
 <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
 <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;距离开奖：<span class="color_lv bold"><span id="kj_time">00:00</span></span>

</div>
<?php include_once('../Lottery/ls.php') ?>
<div class="clearfloat"></div>
</div>
<div class="control n_anniu">
<div class="buttons">
<input id="showResultList" class="button2" value="结果走势" onclick="showResultList();" style="float:right" type="button">
<label class="checkdefault"><input type="checkbox" class="checkbox"><span class="color_lv bold">预设</span></label>&nbsp;&nbsp;<label class="quickAmount"><span class="color_lv bold">金额</span> <input id="kj_money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" /></label>
<input type="button"  onclick="kjNum('s');"   value="确定" class="button">
<input type="button"  value="重置" onclick="kjNum('d');" class="button">
 
</div>
</div>
</div>

    
<div class="subbutton mt10">
   
    
</div>
    <div class="touzhu">
        <form name="orders" id="orders" action="/cqSix/order/order.php?type=22" method="post" target="OrderFrame" onkeydown="if(event.keyCode==13)return false;">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six bg">
                <tr class="tit">
                    <td width="50">生肖</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td width="225">所属号码</td>
                    <td width="50">生肖</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鼠</td>
                    <td class="bian_td_odds" id="ball_10_o1">-</td>
                    <td class="bian_td_inp" id="ball_10_m1">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_01 ?></td>
                    <td class="bian_td_qiu">牛</td>
                    <td class="bian_td_odds" id="ball_10_o2">-</td>
                    <td class="bian_td_inp" id="ball_10_m2">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_02 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_odds" id="ball_10_o3">-</td>
                    <td class="bian_td_inp" id="ball_10_m3">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_03 ?></td>
                    <td class="bian_td_qiu">兔</td>
                    <td class="bian_td_odds" id="ball_10_o4">-</td>
                    <td class="bian_td_inp" id="ball_10_m4">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_04 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_odds" id="ball_10_o5">-</td>
                    <td class="bian_td_inp" id="ball_10_m5">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_05 ?></td>
                    <td class="bian_td_qiu">蛇</td>
                    <td class="bian_td_odds" id="ball_10_o6">-</td>
                    <td class="bian_td_inp" id="ball_10_m6">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_06 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">马</td>
                    <td class="bian_td_odds" id="ball_10_o7">-</td>
                    <td class="bian_td_inp" id="ball_10_m7">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_07 ?></td>
                    <td class="bian_td_qiu">羊</td>
                    <td class="bian_td_odds" id="ball_10_o8">-</td>
                    <td class="bian_td_inp" id="ball_10_m8">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_08 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猴</td>
                    <td class="bian_td_odds" id="ball_10_o9">-</td>
                    <td class="bian_td_inp" id="ball_10_m9">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_09 ?></td>
                    <td class="bian_td_qiu">鸡</td>
                    <td class="bian_td_odds" id="ball_10_o10">-</td>
                    <td class="bian_td_inp" id="ball_10_m10">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_10 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">狗</td>
                    <td class="bian_td_odds" id="ball_10_o11">-</td>
                    <td class="bian_td_inp" id="ball_10_m11">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_11 ?></td>
                    <td class="bian_td_qiu">猪</td>
                    <td class="bian_td_odds" id="ball_10_o12">-</td>
                    <td class="bian_td_inp" id="ball_10_m12">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_12 ?></td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg">
                <tr class="tit">
                    <td width="50">尾数</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                    <td width="50">尾数</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">0尾</td>
                    <td class="bian_td_odds" id="ball_10_o13">-</td>
                    <td class="bian_td_inp" id="ball_10_m13">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_10"></em>
                        <em class="n_20"></em>
                        <em class="n_30"></em>
                        <em class="n_40"></em>
                    </td>
                    <td class="bian_td_qiu">1尾</td>
                    <td class="bian_td_odds" id="ball_10_o14">-</td>
                    <td class="bian_td_inp" id="ball_10_m14">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_1"></em>
                        <em class="n_11"></em>
                        <em class="n_21"></em>
                        <em class="n_31"></em>
                        <em class="n_41"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">2尾</td>
                    <td class="bian_td_odds" id="ball_10_o15">-</td>
                    <td class="bian_td_inp" id="ball_10_m15">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_2"></em>
                        <em class="n_12"></em>
                        <em class="n_22"></em>
                        <em class="n_32"></em>
                        <em class="n_42"></em>
                    </td>
                    <td class="bian_td_qiu">3尾</td>
                    <td class="bian_td_odds" id="ball_10_o16">-</td>
                    <td class="bian_td_inp" id="ball_10_m16">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_3"></em>
                        <em class="n_13"></em>
                        <em class="n_23"></em>
                        <em class="n_33"></em>
                        <em class="n_43"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">4尾</td>
                    <td class="bian_td_odds" id="ball_10_o17">-</td>
                    <td class="bian_td_inp" id="ball_10_m17">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_4"></em>
                        <em class="n_14"></em>
                        <em class="n_24"></em>
                        <em class="n_34"></em>
                        <em class="n_44"></em>
                    </td>
                    <td class="bian_td_qiu">5尾</td>
                    <td class="bian_td_odds" id="ball_10_o18">-</td>
                    <td class="bian_td_inp" id="ball_10_m18">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_5"></em>
                        <em class="n_15"></em>
                        <em class="n_25"></em>
                        <em class="n_35"></em>
                        <em class="n_45"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">6尾</td>
                    <td class="bian_td_odds" id="ball_10_o19">-</td>
                    <td class="bian_td_inp" id="ball_10_m19">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_6"></em>
                        <em class="n_16"></em>
                        <em class="n_26"></em>
                        <em class="n_36"></em>
                        <em class="n_46"></em>
                    </td>
                    <td class="bian_td_qiu">7尾</td>
                    <td class="bian_td_odds" id="ball_10_o20">-</td>
                    <td class="bian_td_inp" id="ball_10_m20">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_7"></em>
                        <em class="n_17"></em>
                        <em class="n_27"></em>
                        <em class="n_37"></em>
                        <em class="n_47"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">8尾</td>
                    <td class="bian_td_odds" id="ball_10_o21">-</td>
                    <td class="bian_td_inp" id="ball_10_m21">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_8"></em>
                        <em class="n_18"></em>
                        <em class="n_28"></em>
                        <em class="n_38"></em>
                        <em class="n_48"></em>
                    </td>
                    <td class="bian_td_qiu">9尾</td>
                    <td class="bian_td_odds" id="ball_10_o22">-</td>
                    <td class="bian_td_inp" id="ball_10_m22">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_9"></em>
                        <em class="n_19"></em>
                        <em class="n_29"></em>
                        <em class="n_39"></em>
                        <em class="n_49"></em>
                    </td>
                </tr>
            </table>
         
         <div class="control bcontrol">
<div class="lefts" style="display:none">已经选中 <span id="betcount"></span> 注</div>
<div class="buttons">
<input type="button" class="button2" value="快选金额" onclick="parent.showsetting()">
<input type="button" class="button" id="xiazhu" value="下注"  onclick="order();"><input type="button" class="button" value="重置" onclick="formReset();">
</div>
</div>
         
        </form>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript">
        loadInfo(10);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
         <script type="text/javascript" src="/js/libs.js"></script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>