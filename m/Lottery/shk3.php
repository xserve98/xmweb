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
if(intval($web_site['jsk3']) == 1) {
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
    case '数字盘':
        $g_i = 4;
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
    <script type="text/javascript" src="js/shk3.js"></script>
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
<div class="lottery_info_left floatleft"><span class="name" id="lotteryName">上海快三</span> — <span class="gameName" 

id="gameName"> <?=$type?></span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>
                <input id="gm_mode" type="hidden" value="jsk3" />
                <input id="u_name" type="hidden"  value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden"  value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden"  value="<?=$cp_zg?>" />
</div>
<div class="lottery_info_right floatright">第<span id="open_qihao"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv 

bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;距离开奖：<span class="color_lv bold"><span 

id="kj_time">00:00</span></span>
<span id="rf_time" style="float:right;width: 50px;">0秒</span>
</div>
<div class="clearfloat"></div>
</div>
<?php include_once('kj.php') ?>
</div>
    <div class="touzhu">
        <form name="orders" id="orders" action="/Lottery/order/order.php?type=34" method="post" target="OrderFrame">
                <?php if($type == '两面盘') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab1">
					<td class="tit" colspan="15">点数</td>
              </tr>
            <tr class="tit">
                <td>点数</td>
                <td>赔率</td>
                <td>金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td>金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td>金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td>金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td>金额</td>
            </tr>
                    <tr class="tr_txt">
                <td class="bian_td_qiu"><b>4点</b></td>
                <td class="bian_td_odds" id="ball_1_h1"></td>
                <td class="bian_td_inp" id="ball_1_t1"></td>
                <td class="bian_td_qiu"><b>5点</b></td>
                <td class="bian_td_odds" id="ball_1_h2"></td>
                <td class="bian_td_inp" id="ball_1_t2"></td>
                <td class="bian_td_qiu"><b>6点</b></td>
                <td class="bian_td_odds" id="ball_1_h3"></td>
                <td class="bian_td_inp" id="ball_1_t3"></td>
                <td class="bian_td_qiu"><b>7点</b></td>
                <td class="bian_td_odds" id="ball_1_h4"></td>
                <td class="bian_td_inp" id="ball_1_t4"></td>
                <td class="bian_td_qiu"><b>8点</b></td>
                <td class="bian_td_odds" id="ball_1_h5"></td>
                <td class="bian_td_inp" id="ball_1_t5"></td>
                    </tr>
                    <tr class="tr_txt">
                <td class="bian_td_qiu"><b>9点</b></td>
                <td class="bian_td_odds" id="ball_1_h6"></td>
                <td class="bian_td_inp" id="ball_1_t6"></td>
                <td class="bian_td_qiu"><b>10点</b></td>
                <td class="bian_td_odds" id="ball_1_h7"></td>
                <td class="bian_td_inp" id="ball_1_t7"></td>
                <td class="bian_td_qiu"><b>11点</b></td>
                <td class="bian_td_odds" id="ball_1_h8"></td>
                <td class="bian_td_inp" id="ball_1_t8"></td>
                <td class="bian_td_qiu"><b>12点</b></td>
                <td class="bian_td_odds" id="ball_1_h9"></td>
                <td class="bian_td_inp" id="ball_1_t9"></td>
                <td class="bian_td_qiu"><b>13点</b></td>
                <td class="bian_td_odds" id="ball_1_h10"></td>
                <td class="bian_td_inp" id="ball_1_t10"></td>
                    </tr>
					<tr class="tr_txt">
			    <td class="bian_td_qiu"><b>14点</b></td>
                <td class="bian_td_odds" id="ball_1_h11"></td>
                <td class="bian_td_inp" id="ball_1_t11"></td>
                <td class="bian_td_qiu"><b>15点</b></td>
                <td class="bian_td_odds" id="ball_1_h12"></td>
                <td class="bian_td_inp" id="ball_1_t12"></td>
                <td class="bian_td_qiu"><b>16点</b></td>
                <td class="bian_td_odds" id="ball_1_h13"></td>
                <td class="bian_td_inp" id="ball_1_t13"></td>
                <td class="bian_td_qiu"><b>17点</b></td>
                <td class="bian_td_odds" id="ball_1_h14"></td>
                <td class="bian_td_inp" id="ball_1_t14"></td>
                <td class="bian_td_qiu" colspan="3"></td>
					</tr>
		<table cellspacing="1" cellpadding="0" border="0" class="tab1 k3">
			<td class="tit" colspan="15">双面</td>
                </tr>
              <tr class="tit">
                <td width="80">选项</td>
                <td>赔率</td>
                <td>金额</td>
                <td width="80">选项</td>
                <td>赔率</td>
                <td>金额</td>
                <td width="80">选项</td>
                <td>赔率</td>
                <td>金额</td>
                <td width="80">选项</td>
                <td>赔率</td>
                <td>金额</td>
            </tr>
			<tr class="tr_txt">
                <td width="50" class="bian_td_qiu">点数大</td>
                <td class="bian_td_odds" id="ball_2_h1"></td>
                <td width="70" class="bian_td_inp" id="ball_2_t1"></td>
                <td width="50" class="bian_td_qiu">点数小</td>
                <td class="bian_td_odds" id="ball_2_h2"></td>
                <td width="70" class="bian_td_inp" id="ball_2_t2"></td>
                <td width="50" class="bian_td_qiu">点数单</td>
                <td class="bian_td_odds" id="ball_2_h3"></td>
                <td width="70" class="bian_td_inp" id="ball_2_t3"></td>
                <td width="50" class="bian_td_qiu">点数双</td>
                <td class="bian_td_odds" id="ball_2_h4"></td>
                <td width="70" class="bian_td_inp" id="ball_2_t4"></td>
              </tr>
			<td class="tit" colspan="15">三军、大小</td>
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
                <td class="bian_td_qiu"><em class="n_1"></em></td>
                <td class="bian_td_odds" id="ball_3_h1"></td>
                <td class="bian_td_inp" id="ball_3_t1"></td>
                <td class="bian_td_qiu"><em class="n_2"></em></td>
                <td class="bian_td_odds" id="ball_3_h2"></td>
                <td class="bian_td_inp" id="ball_3_t2"></td>
                <td class="bian_td_qiu"><em class="n_3"></em></td>
                <td class="bian_td_odds" id="ball_3_h3"></td>
                <td class="bian_td_inp" id="ball_3_t3"></td>
                <td class="bian_td_qiu"><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_3_h4"></td>
                <td class="bian_td_inp" id="ball_3_t4"></td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_3_h5"></td>
                <td class="bian_td_inp" id="ball_3_t5"></td>
                <td class="bian_td_qiu"><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_3_h6"></td>
                <td class="bian_td_inp" id="ball_3_t6"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_3_h7"></td>
                <td class="bian_td_inp" id="ball_3_t7"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_3_h8"></td>
                <td class="bian_td_inp" id="ball_3_t8"></td>
              </tr>
		    <td class="tit" colspan="15">围骰</td>
              </tr>
            <tr class="tit">
                <td width="130">号码</td>
                <td>赔率</td>
                <td>金额</td>
                <td width="130">号码</td>
                <td>赔率</td>
                <td>金额</td>
                <td width="130">号码</td>
                <td>赔率</td>
                <td>金额</td>
				<td width="130">号码</td>
                <td>赔率</td>
                <td>金额</td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_1"></em><em class="n_1"></em></td>
                <td class="bian_td_odds" id="ball_4_h1"></td>
                <td class="bian_td_inp" id="ball_4_t1"></td>
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_2"></em><em class="n_2"></em></td>
                <td class="bian_td_odds" id="ball_4_h2"></td>
                <td class="bian_td_inp" id="ball_4_t2"></td>
                <td class="bian_td_qiu"><em class="n_3"></em><em class="n_3"></em><em class="n_3"></em></td>
                <td class="bian_td_odds" id="ball_4_h3"></td>
                <td class="bian_td_inp" id="ball_4_t3"></td>
                <td class="bian_td_qiu"><em class="n_4"></em><em class="n_4"></em><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_4_h4"></td>
                <td class="bian_td_inp" id="ball_4_t4"></td>	
               </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_5"></em><em class="n_5"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_4_h5"></td>
                <td class="bian_td_inp" id="ball_4_t5"></td>
                <td class="bian_td_qiu"><em class="n_6"></em><em class="n_6"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_4_h6"></td>
                <td class="bian_td_inp" id="ball_4_t6"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_1_h11"></td>
                <td class="bian_td_inp" id="ball_1_t11"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_1_h12"></td>
                <td class="bian_td_inp" id="ball_1_t12"></td>
            </tr>
		    <td class="tit" colspan="15">长牌</td>
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
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_2"></em></td>
                <td class="bian_td_odds" id="ball_5_h1"></td>
                <td class="bian_td_inp" id="ball_5_t1"></td>
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_3"></em></td>
                <td class="bian_td_odds" id="ball_5_h2"></td>
                <td class="bian_td_inp" id="ball_5_t2"></td>
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_5_h3"></td>
                <td class="bian_td_inp" id="ball_5_t3"></td>
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_5_h4"></td>
                <td class="bian_td_inp" id="ball_5_t4"></td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_5_h5"></td>
                <td class="bian_td_inp" id="ball_5_t5"></td>
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_3"></em></td>
                <td class="bian_td_odds" id="ball_5_h6"></td>
                <td class="bian_td_inp" id="ball_5_t6"></td>
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_5_h7"></td>
                <td class="bian_td_inp" id="ball_5_t7"></td>
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_5_h8"></td>
                <td class="bian_td_inp" id="ball_5_t8"></td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_5_h9"></td>
                <td class="bian_td_inp" id="ball_5_t9"></td>
                <td class="bian_td_qiu"><em class="n_3"></em><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_5_h10"></td>
                <td class="bian_td_inp" id="ball_5_t10"></td>
                <td class="bian_td_qiu"><em class="n_3"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_5_h11"></td>
                <td class="bian_td_inp" id="ball_5_t11"></td>
                <td class="bian_td_qiu"><em class="n_3"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_5_h12"></td>
                <td class="bian_td_inp" id="ball_5_t12"></td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_4"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_5_h13"></td>
                <td class="bian_td_inp" id="ball_5_t13"></td>
                <td class="bian_td_qiu"><em class="n_4"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_5_h14"></td>
                <td class="bian_td_inp" id="ball_5_t14"></td>
                <td class="bian_td_qiu"><em class="n_5"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_5_h15"></td>
                <td class="bian_td_inp" id="ball_5_t15"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_5_h15"></td>
                <td class="bian_td_inp" id="ball_5_t15"></td>
                <td class="bian_td_qiu" colspan="3"></td>
            </tr>
			<td class="tit" colspan="15">短牌</td>
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
                <td class="bian_td_qiu"><em class="n_1"></em><em class="n_1"></em></td>
                <td class="bian_td_odds" id="ball_6_h1"></td>
                <td class="bian_td_inp" id="ball_6_t1"></td>
                <td class="bian_td_qiu"><em class="n_2"></em><em class="n_2"></em></td>
                <td class="bian_td_odds" id="ball_6_h2"></td>
                <td class="bian_td_inp" id="ball_6_t2"></td>
                <td class="bian_td_qiu"><em class="n_3"></em><em class="n_3"></em></td>
                <td class="bian_td_odds" id="ball_6_h3"></td>
                <td class="bian_td_inp" id="ball_6_t3"></td>
                <td class="bian_td_qiu"><em class="n_4"></em><em class="n_4"></em></td>
                <td class="bian_td_odds" id="ball_6_h4"></td>
                <td class="bian_td_inp" id="ball_6_t4"></td>
            </tr>
            <tr class="tr_txt">
                <td class="bian_td_qiu"><em class="n_5"></em><em class="n_5"></em></td>
                <td class="bian_td_odds" id="ball_6_h5"></td>
                <td class="bian_td_inp" id="ball_6_t5"></td>
                <td class="bian_td_qiu"><em class="n_6"></em><em class="n_6"></em></td>
                <td class="bian_td_odds" id="ball_6_h6"></td>
                <td class="bian_td_inp" id="ball_6_t6"></td>
				<td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_6_h5"></td>
                <td class="bian_td_inp" id="ball_6_t5"></td>
                <td class="bian_td_qiu"></td>
                <td class="bian_td_odds" id="ball_6_h6"></td>
                <td class="bian_td_inp" id="ball_6_t6"></td>
                <td class="bian_td_qiu" colspan="6"></td>
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
<br><br>
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