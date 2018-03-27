<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link type="text/css" rel="stylesheet" href="css/6hc.css"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="layer/layer.min.js" type="text/javascript"></script>
<? include "menu.php";?>
</head>
<body>
<div class="place">
    <span></span>
    <div class="bfglinfo">
    <ul class="bfglnav">
    <li><a href="Six_7_3.php" target="_self" title="特码"  class="selected">特 码</a></li>
    <li><a href="Six_8_3.php" target="_self" title="正码"  class="jj1">正 码</a></li>
    <li><a href="Six_10.php" target="_self" title="一肖/尾数">一肖/尾数</a></li>
    <li><a href="Six_11.php" target="_self" title="连码" class="jj1">连 码</a></li>
    <li><a href="Six_12.php" target="_self" title="合肖" class="jj1">合 肖</a></li>
    <li><a href="Six_13.php" target="_self" title="生肖连" class="jj2"> 生肖连</a></li>
    <li><a href="Six_14.php" target="_self" title="尾数连" class="jj2"> 尾数连</a></li>
    <li><a href="Six_15.php" target="_self" title="全不中" class="jj2"> 全不中</a></li>
    </ul>
    <ul class="bfglnav2">
    <li><a href="Auto.php" target="_self" title="开奖历史">开奖历史</a></li>
    <li><a href="6rules.php" target="_self" title="玩法规则">玩法规则</a></li>
    </ul>
    </div>
</div>
<div class="lotto_main">  
<div class="content">
<form name="orders" action="order/order.php?type=0" method="post" target="OrderFrame">
<div class="top">&nbsp;&nbsp;正码特 => 两面盘 &amp; 波色</div>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="numberinfo">
  <tr>
    <td>&nbsp;&nbsp;第 <span id="open_qihao">0000000</span> 期
  </td>
    <td><div class="time-item">距离封盘：<span id="hour_show">0 时</span><span id="minute_show">0 分</span><span id="second_show">0 秒</span></div></td>
    <td align="right"><div id="openNumber">开奖号码载入中...</div></td>
  </tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="1" class="bian" style="margin-top:10px;">
  <tr>
    <th>正一</th>
    <th>赔率</th>
    <th>金额</th>
    <th>正二</th>
    <th>赔率</th>
    <th>金额</th>
    <th>正三</th>
    <th>赔率</th>
    <th>金额</th>
    <th>正四</th>
    <th>赔率</th>
    <th>金额</th>
    <th>正五</th>
    <th>赔率</th>
    <th>金额</th>
    <th>正六</th>
    <th>赔率</th>
    <th>金额</th>
  </tr>
  <tr>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_1_o50">-</td>
    <td class="bian_td_inp" id="ball_1_m50">&nbsp;</td>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_2_o50">-</td>
    <td class="bian_td_inp" id="ball_2_m50">&nbsp;</td>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_3_o50">-</td>
    <td class="bian_td_inp" id="ball_3_m50">&nbsp;</td>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_4_o50">-</td>
    <td class="bian_td_inp" id="ball_4_m50">&nbsp;</td>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_5_o50">-</td>
    <td class="bian_td_inp" id="ball_5_m50">&nbsp;</td>
    <td class="ball_txt">大码</td>
    <td class="bian_td_odds" id="ball_6_o50">-</td>
    <td class="bian_td_inp" id="ball_6_m50">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_1_o51">-</td>
    <td class="bian_td_inp" id="ball_1_m51">&nbsp;</td>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_2_o51">-</td>
    <td class="bian_td_inp" id="ball_2_m51">&nbsp;</td>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_3_o51">-</td>
    <td class="bian_td_inp" id="ball_3_m51">&nbsp;</td>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_4_o51">-</td>
    <td class="bian_td_inp" id="ball_4_m51">&nbsp;</td>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_5_o51">-</td>
    <td class="bian_td_inp" id="ball_5_m51">&nbsp;</td>
    <td class="ball_txt">小码</td>
    <td class="bian_td_odds" id="ball_6_o51">-</td>
    <td class="bian_td_inp" id="ball_6_m51">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_1_o52">-</td>
    <td class="bian_td_inp" id="ball_1_m52">&nbsp;</td>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_2_o52">-</td>
    <td class="bian_td_inp" id="ball_2_m52">&nbsp;</td>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_3_o52">-</td>
    <td class="bian_td_inp" id="ball_3_m52">&nbsp;</td>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_4_o52">-</td>
    <td class="bian_td_inp" id="ball_4_m52">&nbsp;</td>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_5_o52">-</td>
    <td class="bian_td_inp" id="ball_5_m52">&nbsp;</td>
    <td class="ball_txt">单码</td>
    <td class="bian_td_odds" id="ball_6_o52">-</td>
    <td class="bian_td_inp" id="ball_6_m52">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_1_o53">-</td>
    <td class="bian_td_inp" id="ball_1_m53">&nbsp;</td>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_2_o53">-</td>
    <td class="bian_td_inp" id="ball_2_m53">&nbsp;</td>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_3_o53">-</td>
    <td class="bian_td_inp" id="ball_3_m53">&nbsp;</td>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_4_o53">-</td>
    <td class="bian_td_inp" id="ball_4_m53">&nbsp;</td>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_5_o53">-</td>
    <td class="bian_td_inp" id="ball_5_m53">&nbsp;</td>
    <td class="ball_txt">双码</td>
    <td class="bian_td_odds" id="ball_6_o53">-</td>
    <td class="bian_td_inp" id="ball_6_m53">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_1_o54">-</td>
    <td class="bian_td_inp" id="ball_1_m54">&nbsp;</td>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_2_o54">-</td>
    <td class="bian_td_inp" id="ball_2_m54">&nbsp;</td>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_3_o54">-</td>
    <td class="bian_td_inp" id="ball_3_m54">&nbsp;</td>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_4_o54">-</td>
    <td class="bian_td_inp" id="ball_4_m54">&nbsp;</td>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_5_o54">-</td>
    <td class="bian_td_inp" id="ball_5_m54">&nbsp;</td>
    <td class="ball_txt">合大</td>
    <td class="bian_td_odds" id="ball_6_o54">-</td>
    <td class="bian_td_inp" id="ball_6_m54">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_1_o55">-</td>
    <td class="bian_td_inp" id="ball_1_m55">&nbsp;</td>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_2_o55">-</td>
    <td class="bian_td_inp" id="ball_2_m55">&nbsp;</td>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_3_o55">-</td>
    <td class="bian_td_inp" id="ball_3_m55">&nbsp;</td>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_4_o55">-</td>
    <td class="bian_td_inp" id="ball_4_m55">&nbsp;</td>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_5_o55">-</td>
    <td class="bian_td_inp" id="ball_5_m55">&nbsp;</td>
    <td class="ball_txt">合小</td>
    <td class="bian_td_odds" id="ball_6_o55">-</td>
    <td class="bian_td_inp" id="ball_6_m55">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_1_o56">-</td>
    <td class="bian_td_inp" id="ball_1_m56">&nbsp;</td>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_2_o56">-</td>
    <td class="bian_td_inp" id="ball_2_m56">&nbsp;</td>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_3_o56">-</td>
    <td class="bian_td_inp" id="ball_3_m56">&nbsp;</td>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_4_o56">-</td>
    <td class="bian_td_inp" id="ball_4_m56">&nbsp;</td>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_5_o56">-</td>
    <td class="bian_td_inp" id="ball_5_m56">&nbsp;</td>
    <td class="ball_txt">合单</td>
    <td class="bian_td_odds" id="ball_6_o56">-</td>
    <td class="bian_td_inp" id="ball_6_m56">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_1_o57">-</td>
    <td class="bian_td_inp" id="ball_1_m57">&nbsp;</td>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_2_o57">-</td>
    <td class="bian_td_inp" id="ball_2_m57">&nbsp;</td>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_3_o57">-</td>
    <td class="bian_td_inp" id="ball_3_m57">&nbsp;</td>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_4_o57">-</td>
    <td class="bian_td_inp" id="ball_4_m57">&nbsp;</td>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_5_o57">-</td>
    <td class="bian_td_inp" id="ball_5_m57">&nbsp;</td>
    <td class="ball_txt">合双</td>
    <td class="bian_td_odds" id="ball_6_o57">-</td>
    <td class="bian_td_inp" id="ball_6_m57">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_1_o58">-</td>
    <td class="bian_td_inp" id="ball_1_m58">&nbsp;</td>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_2_o58">-</td>
    <td class="bian_td_inp" id="ball_2_m58">&nbsp;</td>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_3_o58">-</td>
    <td class="bian_td_inp" id="ball_3_m58">&nbsp;</td>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_4_o58">-</td>
    <td class="bian_td_inp" id="ball_4_m58">&nbsp;</td>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_5_o58">-</td>
    <td class="bian_td_inp" id="ball_5_m58">&nbsp;</td>
    <td class="ball_txt">尾大</td>
    <td class="bian_td_odds" id="ball_6_o58">-</td>
    <td class="bian_td_inp" id="ball_6_m58">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_1_o59">-</td>
    <td class="bian_td_inp" id="ball_1_m59">&nbsp;</td>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_2_o59">-</td>
    <td class="bian_td_inp" id="ball_2_m59">&nbsp;</td>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_3_o59">-</td>
    <td class="bian_td_inp" id="ball_3_m59">&nbsp;</td>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_4_o59">-</td>
    <td class="bian_td_inp" id="ball_4_m59">&nbsp;</td>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_5_o59">-</td>
    <td class="bian_td_inp" id="ball_5_m59">&nbsp;</td>
    <td class="ball_txt">尾小</td>
    <td class="bian_td_odds" id="ball_6_o59">-</td>
    <td class="bian_td_inp" id="ball_6_m59">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_1_o62">-</td>
    <td class="bian_td_inp" id="ball_1_m62">&nbsp;</td>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_2_o62">-</td>
    <td class="bian_td_inp" id="ball_2_m62">&nbsp;</td>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_3_o62">-</td>
    <td class="bian_td_inp" id="ball_3_m62">&nbsp;</td>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_4_o62">-</td>
    <td class="bian_td_inp" id="ball_4_m62">&nbsp;</td>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_5_o62">-</td>
    <td class="bian_td_inp" id="ball_5_m62">&nbsp;</td>
    <td class="ball_txt">红波</td>
    <td class="bian_td_odds" id="ball_6_o62">-</td>
    <td class="bian_td_inp" id="ball_6_m62">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_1_o63">-</td>
    <td class="bian_td_inp" id="ball_1_m63">&nbsp;</td>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_2_o63">-</td>
    <td class="bian_td_inp" id="ball_2_m63">&nbsp;</td>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_3_o63">-</td>
    <td class="bian_td_inp" id="ball_3_m63">&nbsp;</td>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_4_o63">-</td>
    <td class="bian_td_inp" id="ball_4_m63">&nbsp;</td>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_5_o63">-</td>
    <td class="bian_td_inp" id="ball_5_m63">&nbsp;</td>
    <td class="ball_txt">蓝波</td>
    <td class="bian_td_odds" id="ball_6_o63">-</td>
    <td class="bian_td_inp" id="ball_6_m63">&nbsp;</td>
  </tr>
  <tr>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_1_o64">-</td>
    <td class="bian_td_inp" id="ball_1_m64">&nbsp;</td>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_2_o64">-</td>
    <td class="bian_td_inp" id="ball_2_m64">&nbsp;</td>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_3_o64">-</td>
    <td class="bian_td_inp" id="ball_3_m64">&nbsp;</td>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_4_o64">-</td>
    <td class="bian_td_inp" id="ball_4_m64">&nbsp;</td>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_5_o64">-</td>
    <td class="bian_td_inp" id="ball_5_m64">&nbsp;</td>
    <td class="ball_txt">绿波</td>
    <td class="bian_td_odds" id="ball_6_o64">-</td>
    <td class="bian_td_inp" id="ball_6_m64">&nbsp;</td>
  </tr>
  </table>
<div class="button_body"></div>
      <div class="login_panel"  isLogin="">
	<div class="panel_center">
		<p class="tips"></p>
		<p class="connectBox1">
			<a href="javascript:void(0);" title="重置金额" onclick="formReset()" value="Reset" class="button again"><img alt="重置金额" src="images/Lottery_but4.png"></a>
			<a href="javascript:void(0);" title="提交下注" onclick="order();" class="button submit"><img alt="提交下注" src="images/Lottery_but3.png"></a>
		</p>
		
	</div>
</div>
</form>
</div>
</div>
<script src="js/class_1.js" type="text/javascript"></script>
<script type="text/javascript">$(function(){loadInfo('sm');});</script>
<IFRAME id="OrderFrame" name="OrderFrame" style="display:none"></IFRAME>
</body>
</html>