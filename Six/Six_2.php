<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
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
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">香港六合彩</span> — <span class="gameName" id="gameName"> 正码2</span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

 <input id="gm_mode" type="hidden" value="cqssc" />
 <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
 <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
 <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;开奖时间：<span class="color_lv bold"><span id="kj_time">00:00</span></span>

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
    <a href="/Six/Six_1.php" >正码1</a>
    <a href="/Six/Six_2.php" class="on" >正码2</a>
    <a href="/Six/Six_3.php" >正码3</a>
    <a href="/Six/Six_4.php" >正码4</a>
    <a href="/Six/Six_5.php" >正码5</a>
    <a href="/Six/Six_6.php" >正码6</a>
    
</div>
    
    
    <div class="touzhu">
        <form name="orders" id="orders" action="/Six/order/order.php?type=0" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six">
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
                    <td class="bian_td_qiu" id="ball_01"><em class="n_1"></em></td>
                    <td class="bian_td_odds" id="ball_2_o1">-</td>
                    <td class="bian_td_inp" id="ball_2_m1">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_11"><em class="n_11"></em></td>
                    <td class="bian_td_odds" id="ball_2_o11">-</td>
                    <td class="bian_td_inp" id="ball_2_m11">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_21"><em class="n_21"></em></td>
                    <td class="bian_td_odds" id="ball_2_o21">-</td>
                    <td class="bian_td_inp" id="ball_2_m21">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_31"><em class="n_31"></em></td>
                    <td class="bian_td_odds" id="ball_2_o31">-</td>
                    <td class="bian_td_inp" id="ball_2_m31">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_41"><em class="n_41"></em></td>
                    <td class="bian_td_odds" id="ball_2_o41">-</td>
                    <td class="bian_td_inp" id="ball_2_m41">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_02"><em class="n_2"></em></td>
                    <td class="bian_td_odds" id="ball_2_o2">-</td>
                    <td class="bian_td_inp" id="ball_2_m2">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_12"><em class="n_12"></em></td>
                    <td class="bian_td_odds" id="ball_2_o12">-</td>
                    <td class="bian_td_inp" id="ball_2_m12">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_22"><em class="n_22"></em></td>
                    <td class="bian_td_odds" id="ball_2_o22">-</td>
                    <td class="bian_td_inp" id="ball_2_m22">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_32"><em class="n_32"></em></td>
                    <td class="bian_td_odds" id="ball_2_o32">-</td>
                    <td class="bian_td_inp" id="ball_2_m32">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_42"><em class="n_42"></em></td>
                    <td class="bian_td_odds" id="ball_2_o42">-</td>
                    <td class="bian_td_inp" id="ball_2_m42">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_03"><em class="n_3"></em></td>
                    <td class="bian_td_odds" id="ball_2_o3">-</td>
                    <td class="bian_td_inp" id="ball_2_m3">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_13"><em class="n_13"></em></td>
                    <td class="bian_td_odds" id="ball_2_o13">-</td>
                    <td class="bian_td_inp" id="ball_2_m13">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_23"><em class="n_23"></em></td>
                    <td class="bian_td_odds" id="ball_2_o23">-</td>
                    <td class="bian_td_inp" id="ball_2_m23">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_33"><em class="n_33"></em></td>
                    <td class="bian_td_odds" id="ball_2_o33">-</td>
                    <td class="bian_td_inp" id="ball_2_m33">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_43"><em class="n_43"></em></td>
                    <td class="bian_td_odds" id="ball_2_o43">-</td>
                    <td class="bian_td_inp" id="ball_2_m43">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_04"><em class="n_4"></em></td>
                    <td class="bian_td_odds" id="ball_2_o4">-</td>
                    <td class="bian_td_inp" id="ball_2_m4">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_14"><em class="n_14"></em></td>
                    <td class="bian_td_odds" id="ball_2_o14">-</td>
                    <td class="bian_td_inp" id="ball_2_m14">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_24"><em class="n_24"></em></td>
                    <td class="bian_td_odds" id="ball_2_o24">-</td>
                    <td class="bian_td_inp" id="ball_2_m24">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_34"><em class="n_34"></em></td>
                    <td class="bian_td_odds" id="ball_2_o34">-</td>
                    <td class="bian_td_inp" id="ball_2_m34">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_44"><em class="n_44"></em></td>
                    <td class="bian_td_odds" id="ball_2_o44">-</td>
                    <td class="bian_td_inp" id="ball_2_m44">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_05"><em class="n_5"></em></td>
                    <td class="bian_td_odds" id="ball_2_o5">-</td>
                    <td class="bian_td_inp" id="ball_2_m5">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_15"><em class="n_15"></em></td>
                    <td class="bian_td_odds" id="ball_2_o15">-</td>
                    <td class="bian_td_inp" id="ball_2_m15">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_25"><em class="n_25"></em></td>
                    <td class="bian_td_odds" id="ball_2_o25">-</td>
                    <td class="bian_td_inp" id="ball_2_m25">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_35"><em class="n_35"></em></td>
                    <td class="bian_td_odds" id="ball_2_o35">-</td>
                    <td class="bian_td_inp" id="ball_2_m35">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_45"><em class="n_45"></em></td>
                    <td class="bian_td_odds" id="ball_2_o45">-</td>
                    <td class="bian_td_inp" id="ball_2_m45">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_06"><em class="n_6"></em></td>
                    <td class="bian_td_odds" id="ball_2_o6">-</td>
                    <td class="bian_td_inp" id="ball_2_m6">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_16"><em class="n_16"></em></td>
                    <td class="bian_td_odds" id="ball_2_o16">-</td>
                    <td class="bian_td_inp" id="ball_2_m16">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_26"><em class="n_26"></em></td>
                    <td class="bian_td_odds" id="ball_2_o26">-</td>
                    <td class="bian_td_inp" id="ball_2_m26">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_36"><em class="n_36"></em></td>
                    <td class="bian_td_odds" id="ball_2_o36">-</td>
                    <td class="bian_td_inp" id="ball_2_m36">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_46"><em class="n_46"></em></td>
                    <td class="bian_td_odds" id="ball_2_o46">-</td>
                    <td class="bian_td_inp" id="ball_2_m46">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_07"><em class="n_7"></em></td>
                    <td class="bian_td_odds" id="ball_2_o7">-</td>
                    <td class="bian_td_inp" id="ball_2_m7">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_17"><em class="n_17"></em></td>
                    <td class="bian_td_odds" id="ball_2_o17">-</td>
                    <td class="bian_td_inp" id="ball_2_m17">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_27"><em class="n_27"></em></td>
                    <td class="bian_td_odds" id="ball_2_o27">-</td>
                    <td class="bian_td_inp" id="ball_2_m27">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_37"><em class="n_37"></em></td>
                    <td class="bian_td_odds" id="ball_2_o37">-</td>
                    <td class="bian_td_inp" id="ball_2_m37">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_47"><em class="n_47"></em></td>
                    <td class="bian_td_odds" id="ball_2_o47">-</td>
                    <td class="bian_td_inp" id="ball_2_m47">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_08"><em class="n_8"></em></td>
                    <td class="bian_td_odds" id="ball_2_o8">-</td>
                    <td class="bian_td_inp" id="ball_2_m8">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_18"><em class="n_18"></em></td>
                    <td class="bian_td_odds" id="ball_2_o18">-</td>
                    <td class="bian_td_inp" id="ball_2_m18">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_28"><em class="n_28"></em></td>
                    <td class="bian_td_odds" id="ball_2_o28">-</td>
                    <td class="bian_td_inp" id="ball_2_m28">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_38"><em class="n_38"></em></td>
                    <td class="bian_td_odds" id="ball_2_o38">-</td>
                    <td class="bian_td_inp" id="ball_2_m38">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_48"><em class="n_48"></em></td>
                    <td class="bian_td_odds" id="ball_2_o48">-</td>
                    <td class="bian_td_inp" id="ball_2_m48">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_09"><em class="n_9"></em></td>
                    <td class="bian_td_odds" id="ball_2_o9">-</td>
                    <td class="bian_td_inp" id="ball_2_m9">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_19"><em class="n_19"></em></td>
                    <td class="bian_td_odds" id="ball_2_o19">-</td>
                    <td class="bian_td_inp" id="ball_2_m19">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_29"><em class="n_29"></em></td>
                    <td class="bian_td_odds" id="ball_2_o29">-</td>
                    <td class="bian_td_inp" id="ball_2_m29">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_39"><em class="n_39"></em></td>
                    <td class="bian_td_odds" id="ball_2_o39">-</td>
                    <td class="bian_td_inp" id="ball_2_m39">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_49"><em class="n_49"></em></td>
                    <td class="bian_td_odds" id="ball_2_o49">-</td>
                    <td class="bian_td_inp" id="ball_2_m49">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu" id="ball_10"><em class="n_10"></em></td>
                    <td class="bian_td_odds" id="ball_2_o10">-</td>
                    <td class="bian_td_inp" id="ball_2_m10">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_20"><em class="n_20"></em></td>
                    <td class="bian_td_odds" id="ball_2_o20">-</td>
                    <td class="bian_td_inp" id="ball_2_m20">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_30"><em class="n_30"></em></td>
                    <td class="bian_td_odds" id="ball_2_o30">-</td>
                    <td class="bian_td_inp" id="ball_2_m30">&nbsp;</td>
                    <td class="bian_td_qiu" id="ball_40"><em class="n_40"></em></td>
                    <td class="bian_td_odds" id="ball_2_o40">-</td>
                    <td class="bian_td_inp" id="ball_2_m40">&nbsp;</td>
                    <td colspan="3"></td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr class="tr_txt">
                    <td class="bian_td_qiu">大码</td>
                    <td class="bian_td_odds" id="ball_2_o50">-</td>
                    <td class="bian_td_inp" id="ball_2_m50">&nbsp;</td>
                    <td class="bian_td_qiu">单码</td>
                    <td class="bian_td_odds" id="ball_2_o52">-</td>
                    <td class="bian_td_inp" id="ball_2_m52">&nbsp;</td>
                    <td class="bian_td_qiu">尾大</td>
                    <td class="bian_td_odds" id="ball_2_o58">-</td>
                    <td class="bian_td_inp" id="ball_2_m58">&nbsp;</td>
                    <td class="bian_td_qiu">合大</td>
                    <td class="bian_td_odds" id="ball_2_o54">-</td>
                    <td class="bian_td_inp" id="ball_2_m54">&nbsp;</td>
                    <td class="bian_td_qiu">合单</td>
                    <td class="bian_td_odds" id="ball_2_o56">-</td>
                    <td class="bian_td_inp" id="ball_2_m56">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">小码</td>
                    <td class="bian_td_odds" id="ball_2_o51">-</td>
                    <td class="bian_td_inp" id="ball_2_m51">&nbsp;</td>
                    <td class="bian_td_qiu">双码</td>
                    <td class="bian_td_odds" id="ball_2_o53">-</td>
                    <td class="bian_td_inp" id="ball_2_m53">&nbsp;</td>
                    <td class="bian_td_qiu">尾小</td>
                    <td class="bian_td_odds" id="ball_2_o59">-</td>
                    <td class="bian_td_inp" id="ball_2_m59">&nbsp;</td>
                    <td class="bian_td_qiu">合小</td>
                    <td class="bian_td_odds" id="ball_2_o55">-</td>
                    <td class="bian_td_inp" id="ball_2_m55">&nbsp;</td>
                    <td class="bian_td_qiu">合双</td>
                    <td class="bian_td_odds" id="ball_2_o57">-</td>
                    <td class="bian_td_inp" id="ball_2_m57">&nbsp;</td>
                </tr>
            </table>
         
         <div class="control bcontrol">
<div class="lefts" style="display:none">已经选中 <span id="betcount"></span> 注</div>
<div class="buttons">
<input type="button" class="button2" value="快选金额" onclick="parent.showsetting()">
<input type="button" class="button" id="xiazhu" value="下注"  onclick="order();"><input type="button" class="button" value="重置" onclick="formReset();">
</div>
</div>
            </div>
        </form>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript">
        loadInfo(2);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
         <script type="text/javascript" src="/js/libs.js"></script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>