<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
$uid = $_SESSION['uid'];
if (intval($web_site['six']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$kj = $_COOKIE['six_money'];

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
    <script type="text/javascript" src="js/class_2.js"></script>
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
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">极速六合彩</span> — <span class="gameName" id="gameName">过关</span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

 <input id="gm_mode" type="hidden" value="cqssc" />
 <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
 <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
 <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;开奖时间：<span class="color_lv bold"><span id="kj_time">00:00</span></span>

</div>
<div class="clearfloat"></div>
</div>

</div>
   
   
       <div class="touzhu">
        <form name="orders" id="orders" action="/cqSix/order/order.php?type=22&class=8" method="post" target="OrderFrame" onkeydown="if(event.keyCode==13)return false;">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six_1">
                <tr class="tit">
                    <td>过关</td>
                    <td>大码</td>
                    <td>小码</td>
                    <td>单码</td>
                    <td>双码</td>
                    <td>合大</td>
                    <td>合小</td>
                    <td>合单</td>
                    <td>合双</td>
                    <td>尾大</td>
                    <td>尾小</td>
                    <td>红波</td>
                    <td>蓝波</td>
                    <td>绿波</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正一</td>
                    <td><input name='ball_1' type="radio" value='1_50'/> <span class="bian_td_odds" id="ball_1_o50">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_51'/> <span class="bian_td_odds" id="ball_1_o51">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_52'/> <span class="bian_td_odds" id="ball_1_o52">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_53'/> <span class="bian_td_odds" id="ball_1_o53">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_54'/> <span class="bian_td_odds" id="ball_1_o54">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_55'/> <span class="bian_td_odds" id="ball_1_o55">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_56'/> <span class="bian_td_odds" id="ball_1_o56">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_57'/> <span class="bian_td_odds" id="ball_1_o57">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_58'/> <span class="bian_td_odds" id="ball_1_o58">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_59'/> <span class="bian_td_odds" id="ball_1_o59">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_62'/> <span class="bian_td_odds" id="ball_1_o62">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_63'/> <span class="bian_td_odds" id="ball_1_o63">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_64'/> <span class="bian_td_odds" id="ball_1_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正二</td>
                    <td><input name='ball_2' type="radio" value='2_50'/> <span class="bian_td_odds" id="ball_2_o50">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_51'/> <span class="bian_td_odds" id="ball_2_o51">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_52'/> <span class="bian_td_odds" id="ball_2_o52">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_53'/> <span class="bian_td_odds" id="ball_2_o53">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_54'/> <span class="bian_td_odds" id="ball_2_o54">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_55'/> <span class="bian_td_odds" id="ball_2_o55">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_56'/> <span class="bian_td_odds" id="ball_2_o56">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_57'/> <span class="bian_td_odds" id="ball_2_o57">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_58'/> <span class="bian_td_odds" id="ball_2_o58">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_59'/> <span class="bian_td_odds" id="ball_2_o59">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_62'/> <span class="bian_td_odds" id="ball_2_o62">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_63'/> <span class="bian_td_odds" id="ball_2_o63">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_64'/> <span class="bian_td_odds" id="ball_2_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正三</td>
                    <td><input name='ball_3' type="radio" value='3_50'/> <span class="bian_td_odds" id="ball_3_o50">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_51'/> <span class="bian_td_odds" id="ball_3_o51">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_52'/> <span class="bian_td_odds" id="ball_3_o52">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_53'/> <span class="bian_td_odds" id="ball_3_o53">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_54'/> <span class="bian_td_odds" id="ball_3_o54">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_55'/> <span class="bian_td_odds" id="ball_3_o55">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_56'/> <span class="bian_td_odds" id="ball_3_o56">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_57'/> <span class="bian_td_odds" id="ball_3_o57">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_58'/> <span class="bian_td_odds" id="ball_3_o58">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_59'/> <span class="bian_td_odds" id="ball_3_o59">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_62'/> <span class="bian_td_odds" id="ball_3_o62">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_63'/> <span class="bian_td_odds" id="ball_3_o63">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_64'/> <span class="bian_td_odds" id="ball_3_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正四</td>
                    <td><input name='ball_4' type="radio" value='4_50'/> <span class="bian_td_odds" id="ball_4_o50">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_51'/> <span class="bian_td_odds" id="ball_4_o51">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_52'/> <span class="bian_td_odds" id="ball_4_o52">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_53'/> <span class="bian_td_odds" id="ball_4_o53">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_54'/> <span class="bian_td_odds" id="ball_4_o54">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_55'/> <span class="bian_td_odds" id="ball_4_o55">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_56'/> <span class="bian_td_odds" id="ball_4_o56">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_57'/> <span class="bian_td_odds" id="ball_4_o57">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_58'/> <span class="bian_td_odds" id="ball_4_o58">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_59'/> <span class="bian_td_odds" id="ball_4_o59">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_62'/> <span class="bian_td_odds" id="ball_4_o62">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_63'/> <span class="bian_td_odds" id="ball_4_o63">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_64'/> <span class="bian_td_odds" id="ball_4_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正五</td>
                    <td><input name='ball_5' type="radio" value='5_50'/> <span class="bian_td_odds" id="ball_5_o50">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_51'/> <span class="bian_td_odds" id="ball_5_o51">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_52'/> <span class="bian_td_odds" id="ball_5_o52">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_53'/> <span class="bian_td_odds" id="ball_5_o53">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_54'/> <span class="bian_td_odds" id="ball_5_o54">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_55'/> <span class="bian_td_odds" id="ball_5_o55">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_56'/> <span class="bian_td_odds" id="ball_5_o56">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_57'/> <span class="bian_td_odds" id="ball_5_o57">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_58'/> <span class="bian_td_odds" id="ball_5_o58">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_59'/> <span class="bian_td_odds" id="ball_5_o59">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_62'/> <span class="bian_td_odds" id="ball_5_o62">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_63'/> <span class="bian_td_odds" id="ball_5_o63">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_64'/> <span class="bian_td_odds" id="ball_5_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正六</td>
                    <td><input name='ball_6' type="radio" value='6_50'/> <span class="bian_td_odds" id="ball_6_o50">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_51'/> <span class="bian_td_odds" id="ball_6_o51">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_52'/> <span class="bian_td_odds" id="ball_6_o52">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_53'/> <span class="bian_td_odds" id="ball_6_o53">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_54'/> <span class="bian_td_odds" id="ball_6_o54">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_55'/> <span class="bian_td_odds" id="ball_6_o55">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_56'/> <span class="bian_td_odds" id="ball_6_o56">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_57'/> <span class="bian_td_odds" id="ball_6_o57">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_58'/> <span class="bian_td_odds" id="ball_6_o58">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_59'/> <span class="bian_td_odds" id="ball_6_o59">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_62'/> <span class="bian_td_odds" id="ball_6_o62">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_63'/> <span class="bian_td_odds" id="ball_6_o63">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_64'/> <span class="bian_td_odds" id="ball_6_o64">-</span></td>
                </tr>
            </table>
         
         <div class="control bcontrol">
<div class="lefts" style="display:none">已经选中 <span id="betcount"></span> 注</div>
<div class="buttons">
<label class="checkdefault"><input type="checkbox" class="checkbox"><span class="color_lv bold">预设</span></label>&nbsp;&nbsp;<label class="quickAmount"><span class="color_lv bold">金额</span> <input id="kj_money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" /></label>

<input type="button" class="button" id="xiazhu" value="下注"  onclick="order();"><input type="button" class="button" value="重置" onclick="formReset();">
</div>
</div>
            </div>
        </form>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript">
        loadInfo();
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>