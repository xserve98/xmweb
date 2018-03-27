<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include("class/number_sx.php");
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
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">极速六合彩</span> — <span class="gameName" id="gameName"> 连码</span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

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
        <form name="orders" id="orders" action="/cqSix/order/order.php?type=22&class=11" method="post" target="OrderFrame" onkeydown="if(event.keyCode==13)return false;">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six_1">
                <tr class="tit">
                    <td colspan="12">连码</td>
                </tr>
                <tr class="tr_txt">
                    <td colspan="2"><input name='ball_11' type="radio" value='1'/> 四全中</td>
                    <td colspan="2"><input name='ball_11' type="radio" value='2'/> 三全中</td>
                    <td colspan="2"><input name='ball_11' type="radio" value='3'/> 三中二</td>
                    <td colspan="2"><input name='ball_11' type="radio" value='4'/> 二全中</td>
                    <td colspan="2"><input name='ball_11' type="radio" value='5'/> 二中特</td>
                    <td colspan="2"><input name='ball_11' type="radio" value='6'/> 特　串</td>
                </tr>
                <tr class="tr_txt">
                    <td rowspan="2" colspan="2" class="bian_td_odds" id="ball_11_o1">-</td>
                    <td rowspan="2" colspan="2" class="bian_td_odds" id="ball_11_o2">-</td>
                    <td>中二</td>
                    <td>中三</td>
                    <td rowspan="2" colspan="2" class="bian_td_odds" id="ball_11_o5">-</td>
                    <td>中特</td>
                    <td>中二</td>
                    <td rowspan="2" colspan="2" class="bian_td_odds" id="ball_11_o8">-</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_odds" id="ball_11_o3">-</td>
                    <td class="bian_td_odds" id="ball_11_o4">-</td>
                    <td class="bian_td_odds" id="ball_11_o6">-</td>
                    <td class="bian_td_odds" id="ball_11_o7">-</td>
                </tr>
                <tr style="display: none" class="tr_txt">
                    <td colspan="12">
                        <span id="type_1"><input name='type' type="radio" checked='checked'   value='1'/> 普通</span>
                      
                    </td>
                </tr>
            </table>
            <table id="ball_1" cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six" >
                <tr class="tit">
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_1"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="1" /></td>
                    <td class="bian_td_qiu"><em class="n_11"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="11" /></td>
                    <td class="bian_td_qiu"><em class="n_21"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="21" /></td>
                    <td class="bian_td_qiu"><em class="n_31"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="31" /></td>
                    <td class="bian_td_qiu"><em class="n_41"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="41" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_2"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="2" /></td>
                    <td class="bian_td_qiu"><em class="n_12"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="12" /></td>
                    <td class="bian_td_qiu"><em class="n_22"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="22" /></td>
                    <td class="bian_td_qiu"><em class="n_32"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="32" /></td>
                    <td class="bian_td_qiu"><em class="n_42"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="42" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_3"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="3" /></td>
                    <td class="bian_td_qiu"><em class="n_13"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="13" /></td>
                    <td class="bian_td_qiu"><em class="n_23"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="23" /></td>
                    <td class="bian_td_qiu"><em class="n_33"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="33" /></td>
                    <td class="bian_td_qiu"><em class="n_43"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="43" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_4"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="4" /></td>
                    <td class="bian_td_qiu"><em class="n_14"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="14" /></td>
                    <td class="bian_td_qiu"><em class="n_24"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="24" /></td>
                    <td class="bian_td_qiu"><em class="n_34"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="34" /></td>
                    <td class="bian_td_qiu"><em class="n_44"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="44" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_5"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="5" /></td>
                    <td class="bian_td_qiu"><em class="n_15"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="15" /></td>
                    <td class="bian_td_qiu"><em class="n_25"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="25" /></td>
                    <td class="bian_td_qiu"><em class="n_35"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="35" /></td>
                    <td class="bian_td_qiu"><em class="n_45"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="45" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_6"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="6" /></td>
                    <td class="bian_td_qiu"><em class="n_16"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="16" /></td>
                    <td class="bian_td_qiu"><em class="n_26"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="26" /></td>
                    <td class="bian_td_qiu"><em class="n_36"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="36" /></td>
                    <td class="bian_td_qiu"><em class="n_46"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="46" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_7"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="7" /></td>
                    <td class="bian_td_qiu"><em class="n_17"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="17" /></td>
                    <td class="bian_td_qiu"><em class="n_27"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="27" /></td>
                    <td class="bian_td_qiu"><em class="n_37"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="37" /></td>
                    <td class="bian_td_qiu"><em class="n_47"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="47" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_8"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="8" /></td>
                    <td class="bian_td_qiu"><em class="n_18"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="18" /></td>
                    <td class="bian_td_qiu"><em class="n_28"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="28" /></td>
                    <td class="bian_td_qiu"><em class="n_38"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="38" /></td>
                    <td class="bian_td_qiu"><em class="n_48"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="48" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_9"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="9" /></td>
                    <td class="bian_td_qiu"><em class="n_19"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="19" /></td>
                    <td class="bian_td_qiu"><em class="n_29"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="29" /></td>
                    <td class="bian_td_qiu"><em class="n_39"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="39" /></td>
                    <td class="bian_td_qiu"><em class="n_49"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="49" /></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_10"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="10" /></td>
                    <td class="bian_td_qiu"><em class="n_20"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="20" /></td>
                    <td class="bian_td_qiu"><em class="n_30"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="30" /></td>
                    <td class="bian_td_qiu"><em class="n_40"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="40" /></td>
                    <td colspan="2" class="bian_td_no"><input type="hidden" name="o_num" value="0"></td>
                </tr>
            </table>
            <table id="ball_2" cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg" style="display: none">
                <tr class="tit">
                    <td>生肖</td>
                    <td>选择</td>
                    <td>所属号码</td>
                    <td>生肖</td>
                    <td>选择</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鼠</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_01a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_01 ?></td>
                    <td class="bian_td_qiu">牛</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_02a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_02 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_03a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_03 ?></td>
                    <td class="bian_td_qiu">兔</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_04a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_04 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_05a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_05 ?></td>
                    <td class="bian_td_qiu">蛇</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_06a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_06 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">马</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_07a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_07 ?></td>
                    <td class="bian_td_qiu">羊</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_08a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_08 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猴</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_09a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_09 ?></td>
                    <td class="bian_td_qiu">鸡</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_10a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_10 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">狗</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_11a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_11 ?></td>
                    <td class="bian_td_qiu">猪</td>
                    <td class="bian_td_no"><input name="ball_sx[]" type="checkbox" value="<?= $sx_12a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_12 ?></td>
                </tr>
            </table>
            <table id="ball_3" cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg" style="display: none">
                <tr class="tit">
                    <td>尾数</td>
                    <td>选择</td>
                    <td>所属号码</td>
                    <td>尾数</td>
                    <td>选择</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">0尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="10,20,30,40"/></td>
                    <td class="bian_td_hms">
                        <em class="n_10"></em>
                        <em class="n_20"></em>
                        <em class="n_30"></em>
                        <em class="n_40"></em>
                    </td>
                    <td class="bian_td_qiu">1尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="1,11,21,31,41"/></td>
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
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="2,12,22,32,42"/></td>
                    <td class="bian_td_hms">
                        <em class="n_2"></em>
                        <em class="n_12"></em>
                        <em class="n_22"></em>
                        <em class="n_32"></em>
                        <em class="n_42"></em>
                    </td>
                    <td class="bian_td_qiu">3尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="3,13,23,33,43"/></td>
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
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="4,14,24,34,44"/></td>
                    <td class="bian_td_hms">
                        <em class="n_4"></em>
                        <em class="n_14"></em>
                        <em class="n_24"></em>
                        <em class="n_34"></em>
                        <em class="n_44"></em>
                    </td>
                    <td class="bian_td_qiu">5尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="5,15,25,35,45"/></td>
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
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="6,16,26,36,46"/></td>
                    <td class="bian_td_hms">
                        <em class="n_6"></em>
                        <em class="n_16"></em>
                        <em class="n_26"></em>
                        <em class="n_36"></em>
                        <em class="n_46"></em>
                    </td>
                    <td class="bian_td_qiu">7尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="7,17,27,37,47"/></td>
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
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="8,18,28,38,48"/></td>
                    <td class="bian_td_hms">
                        <em class="n_8"></em>
                        <em class="n_18"></em>
                        <em class="n_28"></em>
                        <em class="n_38"></em>
                        <em class="n_48"></em>
                    </td>
                    <td class="bian_td_qiu">9尾</td>
                    <td class="bian_td_no"><input name="ball_ws[]" type="checkbox" value="9,19,29,39,49"/></td>
                    <td class="bian_td_hms">
                        <em class="n_9"></em>
                        <em class="n_19"></em>
                        <em class="n_29"></em>
                        <em class="n_39"></em>
                        <em class="n_49"></em>
                    </td>
                </tr>
            </table>
            <table id="ball_4" cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg" style="display: none">
                <tr class="tit">
                    <td colspan="3">主肖</td>
                    <td colspan="3">拖尾数</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鼠</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_01a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_01 ?></td>
                    <td class="bian_td_qiu">0尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="10,20,30,40"/></td>
                    <td class="bian_td_hms">
                        <em class="n_10"></em>
                        <em class="n_20"></em>
                        <em class="n_30"></em>
                        <em class="n_40"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">牛</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_02a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_02 ?></td>
                    <td class="bian_td_qiu">1尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="1,11,21,31,41"/></td>
                    <td class="bian_td_hms">
                        <em class="n_1"></em>
                        <em class="n_11"></em>
                        <em class="n_21"></em>
                        <em class="n_31"></em>
                        <em class="n_41"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_03a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_03 ?></td>
                    <td class="bian_td_qiu">2尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="2,12,22,32,42"/></td>
                    <td class="bian_td_hms">
                        <em class="n_2"></em>
                        <em class="n_12"></em>
                        <em class="n_22"></em>
                        <em class="n_32"></em>
                        <em class="n_42"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">兔</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_04a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_04 ?></td>
                    <td class="bian_td_qiu">3尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="3,13,23,33,43"/></td>
                    <td class="bian_td_hms">
                        <em class="n_3"></em>
                        <em class="n_13"></em>
                        <em class="n_23"></em>
                        <em class="n_33"></em>
                        <em class="n_43"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_05a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_05 ?></td>
                    <td class="bian_td_qiu">4尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="4,14,24,34,44"/></td>
                    <td class="bian_td_hms">
                        <em class="n_4"></em>
                        <em class="n_14"></em>
                        <em class="n_24"></em>
                        <em class="n_34"></em>
                        <em class="n_44"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">蛇</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_06a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_06 ?></td>
                    <td class="bian_td_qiu">5尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="5,15,25,35,45"/></td>
                    <td class="bian_td_hms">
                        <em class="n_5"></em>
                        <em class="n_15"></em>
                        <em class="n_25"></em>
                        <em class="n_35"></em>
                        <em class="n_45"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">马</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_07a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_07 ?></td>
                    <td class="bian_td_qiu">6尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="6,16,26,36,46"/></td>
                    <td class="bian_td_hms">
                        <em class="n_6"></em>
                        <em class="n_16"></em>
                        <em class="n_26"></em>
                        <em class="n_36"></em>
                        <em class="n_46"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">羊</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_08a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_08 ?></td>
                    <td class="bian_td_qiu">7尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="7,17,27,37,47"/></td>
                    <td class="bian_td_hms">
                        <em class="n_7"></em>
                        <em class="n_17"></em>
                        <em class="n_27"></em>
                        <em class="n_37"></em>
                        <em class="n_47"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猴</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_09a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_09 ?></td>
                    <td class="bian_td_qiu">8尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="8,18,28,38,48"/></td>
                    <td class="bian_td_hms">
                        <em class="n_8"></em>
                        <em class="n_18"></em>
                        <em class="n_28"></em>
                        <em class="n_38"></em>
                        <em class="n_48"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鸡</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_10a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_10 ?></td>
                    <td class="bian_td_qiu">9尾</td>
                    <td class="bian_td_no"><input name="ball_ws" type="radio" value="9,19,29,39,49"/></td>
                    <td class="bian_td_hms">
                        <em class="n_9"></em>
                        <em class="n_19"></em>
                        <em class="n_29"></em>
                        <em class="n_39"></em>
                        <em class="n_49"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">狗</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_11a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_11 ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猪</td>
                    <td class="bian_td_no"><input name="ball_sx" type="radio" value="<?= $sx_12a ?>"/></td>
                    <td class="bian_td_hms"><?= $sx_12 ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <table id="ball_5" cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six" style="display: none">
                <tr class="tit">
                    <td colspan="20">胆码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_1"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="1"/></td>
                    <td class="bian_td_qiu"><em class="n_2"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="2"/></td>
                    <td class="bian_td_qiu"><em class="n_3"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="3"/></td>
                    <td class="bian_td_qiu"><em class="n_4"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="4"/></td>
                    <td class="bian_td_qiu"><em class="n_5"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="5"/></td>
                    <td class="bian_td_qiu"><em class="n_6"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="6"/></td>
                    <td class="bian_td_qiu"><em class="n_7"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="7"/></td>
                    <td class="bian_td_qiu"><em class="n_8"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="8"/></td>
                    <td class="bian_td_qiu"><em class="n_9"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="9"/></td>
                    <td class="bian_td_qiu"><em class="n_10"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="10"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_11"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="11"/></td>
                    <td class="bian_td_qiu"><em class="n_12"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="12"/></td>
                    <td class="bian_td_qiu"><em class="n_13"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="13"/></td>
                    <td class="bian_td_qiu"><em class="n_14"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="14"/></td>
                    <td class="bian_td_qiu"><em class="n_15"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="15"/></td>
                    <td class="bian_td_qiu"><em class="n_16"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="16"/></td>
                    <td class="bian_td_qiu"><em class="n_17"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="17"/></td>
                    <td class="bian_td_qiu"><em class="n_18"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="18"/></td>
                    <td class="bian_td_qiu"><em class="n_19"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="19"/></td>
                    <td class="bian_td_qiu"><em class="n_20"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="20"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_21"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="21"/></td>
                    <td class="bian_td_qiu"><em class="n_22"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="22"/></td>
                    <td class="bian_td_qiu"><em class="n_23"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="23"/></td>
                    <td class="bian_td_qiu"><em class="n_24"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="24"/></td>
                    <td class="bian_td_qiu"><em class="n_25"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="25"/></td>
                    <td class="bian_td_qiu"><em class="n_26"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="26"/></td>
                    <td class="bian_td_qiu"><em class="n_27"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="27"/></td>
                    <td class="bian_td_qiu"><em class="n_28"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="28"/></td>
                    <td class="bian_td_qiu"><em class="n_29"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="29"/></td>
                    <td class="bian_td_qiu"><em class="n_30"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="30"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_31"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="31"/></td>
                    <td class="bian_td_qiu"><em class="n_32"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="32"/></td>
                    <td class="bian_td_qiu"><em class="n_33"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="33"/></td>
                    <td class="bian_td_qiu"><em class="n_34"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="34"/></td>
                    <td class="bian_td_qiu"><em class="n_35"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="35"/></td>
                    <td class="bian_td_qiu"><em class="n_36"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="36"/></td>
                    <td class="bian_td_qiu"><em class="n_37"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="37"/></td>
                    <td class="bian_td_qiu"><em class="n_38"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="38"/></td>
                    <td class="bian_td_qiu"><em class="n_39"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="39"/></td>
                    <td class="bian_td_qiu"><em class="n_40"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="40"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_41"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="41"/></td>
                    <td class="bian_td_qiu"><em class="n_42"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="42"/></td>
                    <td class="bian_td_qiu"><em class="n_43"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="43"/></td>
                    <td class="bian_td_qiu"><em class="n_44"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="44"/></td>
                    <td class="bian_td_qiu"><em class="n_45"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="45"/></td>
                    <td class="bian_td_qiu"><em class="n_46"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="46"/></td>
                    <td class="bian_td_qiu"><em class="n_47"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="47"/></td>
                    <td class="bian_td_qiu"><em class="n_48"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="48"/></td>
                    <td class="bian_td_qiu"><em class="n_49"></em></td>
                    <td class="bian_td_no"><input name="ball_dm[]" type="checkbox" value="49"/></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr class="tit">
                    <td colspan="20">拖码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_1"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="1"/></td>
                    <td class="bian_td_qiu"><em class="n_2"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="2"/></td>
                    <td class="bian_td_qiu"><em class="n_3"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="3"/></td>
                    <td class="bian_td_qiu"><em class="n_4"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="4"/></td>
                    <td class="bian_td_qiu"><em class="n_5"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="5"/></td>
                    <td class="bian_td_qiu"><em class="n_6"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="6"/></td>
                    <td class="bian_td_qiu"><em class="n_7"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="7"/></td>
                    <td class="bian_td_qiu"><em class="n_8"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="8"/></td>
                    <td class="bian_td_qiu"><em class="n_9"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="9"/></td>
                    <td class="bian_td_qiu"><em class="n_10"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="10"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_11"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="11"/></td>
                    <td class="bian_td_qiu"><em class="n_12"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="12"/></td>
                    <td class="bian_td_qiu"><em class="n_13"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="13"/></td>
                    <td class="bian_td_qiu"><em class="n_14"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="14"/></td>
                    <td class="bian_td_qiu"><em class="n_15"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="15"/></td>
                    <td class="bian_td_qiu"><em class="n_16"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="16"/></td>
                    <td class="bian_td_qiu"><em class="n_17"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="17"/></td>
                    <td class="bian_td_qiu"><em class="n_18"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="18"/></td>
                    <td class="bian_td_qiu"><em class="n_19"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="19"/></td>
                    <td class="bian_td_qiu"><em class="n_20"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="20"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_21"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="21"/></td>
                    <td class="bian_td_qiu"><em class="n_22"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="22"/></td>
                    <td class="bian_td_qiu"><em class="n_23"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="23"/></td>
                    <td class="bian_td_qiu"><em class="n_24"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="24"/></td>
                    <td class="bian_td_qiu"><em class="n_25"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="25"/></td>
                    <td class="bian_td_qiu"><em class="n_26"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="26"/></td>
                    <td class="bian_td_qiu"><em class="n_27"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="27"/></td>
                    <td class="bian_td_qiu"><em class="n_28"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="28"/></td>
                    <td class="bian_td_qiu"><em class="n_29"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="29"/></td>
                    <td class="bian_td_qiu"><em class="n_30"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="30"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_31"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="31"/></td>
                    <td class="bian_td_qiu"><em class="n_32"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="32"/></td>
                    <td class="bian_td_qiu"><em class="n_33"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="33"/></td>
                    <td class="bian_td_qiu"><em class="n_34"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="34"/></td>
                    <td class="bian_td_qiu"><em class="n_35"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="35"/></td>
                    <td class="bian_td_qiu"><em class="n_36"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="36"/></td>
                    <td class="bian_td_qiu"><em class="n_37"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="37"/></td>
                    <td class="bian_td_qiu"><em class="n_38"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="38"/></td>
                    <td class="bian_td_qiu"><em class="n_39"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="39"/></td>
                    <td class="bian_td_qiu"><em class="n_40"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="40"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_41"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="41"/></td>
                    <td class="bian_td_qiu"><em class="n_42"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="42"/></td>
                    <td class="bian_td_qiu"><em class="n_43"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="43"/></td>
                    <td class="bian_td_qiu"><em class="n_44"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="44"/></td>
                    <td class="bian_td_qiu"><em class="n_45"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="45"/></td>
                    <td class="bian_td_qiu"><em class="n_46"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="46"/></td>
                    <td class="bian_td_qiu"><em class="n_47"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="47"/></td>
                    <td class="bian_td_qiu"><em class="n_48"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="48"/></td>
                    <td class="bian_td_qiu"><em class="n_49"></em></td>
                    <td class="bian_td_no"><input name="ball_tm[]" type="checkbox" value="49"/></td>
                    <td colspan="2">&nbsp;</td>
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
    <script type="text/javascript" src="js/class_11.js"></script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
    <script type="text/javascript">
        loadInfo();
        $("#gg").liMarquee({
			circular: false
		});
    </script>
</body>
</html>