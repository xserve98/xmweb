<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

if(intval($web_site['jsk3'])==1)
{
	message('江苏快三系统维护，暂停下注！');
	exit();
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WelCome</title>
    <script type="text/javascript" src="/js/jquery.js?_=171"></script>  
    <script type="text/javascript" src="/box/jquery.jBox-2.3.min.js"></script>
	<script type="text/javascript" src="/box/jquery.jBox-zh-CN.js"></script>
    <script type="text/javascript" src="js/jsk3.js"></script>
    <script language="javascript" src="/js/mouse.js"></script>
    <link type="text/css" rel="stylesheet" href="../box/Green/jbox.css"/>
    <link type="text/css" rel="stylesheet" href="css/jsk3.css"/>
</head>
<body>
<div class="lottery_main">
<div class="ssc_right" style="display:none">
  <div id="auto_list"></div>
</div>
<div class="ssc_left">
    <div class="flash">
      <div class="f_left">
        <span id='cqc_sound' off='0' class="laba" laba_c><img src='images/on.png' title='关闭/打开声音'/></span>
        <div class="time minute">
          <span><img src='images/time/0.png'></span><span><img src='images/time/0.png'></span>
        </div>
        <div class="colon">
          <img src='images/time/10.png'>
        </div>
        <div class="time second">
          <span><img src='images/time/0.png'></span><span><img src='images/time/0.png'></span>
        </div>
        <div class="qh">第 <span id="open_qihao">00000000-000</span> 期 </div>
      </div>
      <div class="f_right">
        <div class="tops">江苏快三<span>第 <font id='numbers' class="red number">00000000-000</font> 期</span></div>
        <div class="kick hundred"><img src='images/open_6/x.png'></div>
        <div class="kick ten"><img src='images/open_6/x.png'></div>
        <div class="kick individual"><img src='images/open_6/x.png'></div>
        <div class="fot" id="autoinfo">开奖数据获取中...</div>
      </div>
    </div>
    <div class="touzhu">
<form name="orders" action="order/order.php?type=6" method="post" target="OrderFrame">
    <table class="bian" border="0" cellpadding="0" cellspacing="1">
        <tr class="bian_tr_bg">
              <td colspan="15">点数</td>
              </tr>
            <tr class="bian_tr_title">
                <td>点数</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>点数</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>点数</td>
              <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_1/04.png" /></td>
                <td class="bian_td_odds" id="ball_1_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/05.png" /></td>
                <td class="bian_td_odds" id="ball_1_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/06.png" /></td>
                <td class="bian_td_odds" id="ball_1_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/07.png" /></td>
                <td class="bian_td_odds" id="ball_1_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t4"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/08.png" /></td>
                <td class="bian_td_odds" id="ball_1_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t5"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_1/09.png" /></td>
                <td class="bian_td_odds" id="ball_1_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t6"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/10.png" /></td>
                <td class="bian_td_odds" id="ball_1_h7" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t7"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/11.png" /></td>
                <td class="bian_td_odds" id="ball_1_h8" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t8"></td>
                <td class="bian_td_qiu"><img src="images/ball_1/12.png" /></td>
                <td class="bian_td_odds" id="ball_1_h9" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t9"></td>
              <td class="bian_td_qiu"><img src="images/ball_1/13.png" /></td>
              <td class="bian_td_odds" id="ball_1_h10" width="40"></td>
              <td class="bian_td_inp" id="ball_1_t10"></td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu"><img src="images/ball_1/14.png" /></td>
              <td class="bian_td_odds" id="ball_1_h11"></td>
              <td class="bian_td_inp" id="ball_1_t11"></td>
              <td class="bian_td_qiu"><img src="images/ball_1/15.png" /></td>
              <td class="bian_td_odds" id="ball_1_h12"></td>
              <td class="bian_td_inp" id="ball_1_t12"></td>
              <td class="bian_td_qiu"><img src="images/ball_1/16.png" /></td>
              <td class="bian_td_odds" id="ball_1_h13"></td>
              <td class="bian_td_inp" id="ball_1_t13"></td>
              <td class="bian_td_qiu"><img src="images/ball_1/17.png" /></td>
              <td class="bian_td_odds" id="ball_1_h14"></td>
              <td class="bian_td_inp" id="ball_1_t14"></td>
              <td class="bian_td_qiu" colspan="3"></td>
            </tr> 
      </table>
        <table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top:20px;">
        <tr class="bian_tr_bg">
              <td colspan="12">双面</td>
              </tr>
            <tr class="bian_tr_title">
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
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
           </table>
           
        <table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top:20px;">
         <tr class="bian_tr_bg">
              <td colspan="12">三军</td>
              </tr>
            <tr class="bian_tr_title">
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /></td>
                <td class="bian_td_odds" id="ball_3_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /></td>
                <td class="bian_td_odds" id="ball_3_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /></td>
                <td class="bian_td_odds" id="ball_3_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_3_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t4"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_3_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t5"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_3_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_3_t6"></td>
                <td class="bian_td_qiu" colspan="6"></td>
            </tr>
      </table>
      
      <table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top:20px;">
         <tr class="bian_tr_bg">
              <td colspan="12">围骰</td>
              </tr>
            <tr class="bian_tr_title">
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/01.png" /><img src="images/ball_6/01.png" /></td>
                <td class="bian_td_odds" id="ball_4_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/02.png" /><img src="images/ball_6/02.png" /></td>
                <td class="bian_td_odds" id="ball_4_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /><img src="images/ball_6/03.png" /><img src="images/ball_6/03.png" /></td>
                <td class="bian_td_odds" id="ball_4_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/04.png" /><img src="images/ball_6/04.png" /><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_4_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t4"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/05.png" /><img src="images/ball_6/05.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_4_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t5"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/06.png" /><img src="images/ball_6/06.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_4_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_4_t6"></td>
                <td class="bian_td_qiu" colspan="6"></td>
            </tr>
      </table>
      
      <table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top:20px;">
         <tr class="bian_tr_bg">
              <td colspan="12">长牌</td>
              </tr>
            <tr class="bian_tr_title">
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/02.png" /></td>
                <td class="bian_td_odds" id="ball_5_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/03.png" /></td>
                <td class="bian_td_odds" id="ball_5_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_5_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_5_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t4"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_5_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t5"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/03.png" /></td>
                <td class="bian_td_odds" id="ball_5_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t6"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_5_h7" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t7"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_5_h8" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t8"></td>
            </tr>
            
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_5_h9" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t9"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_5_h10" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t10"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_5_h11" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t11"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_5_h12" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t12"></td>
            </tr>
            
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/04.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_5_h13" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t13"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/04.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_5_h14" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t14"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/05.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_5_h15" width="40"></td>
                <td class="bian_td_inp" id="ball_5_t15"></td>
                <td class="bian_td_qiu" colspan="3"></td>
            </tr>
      </table>
      
      <table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top:20px;">
         <tr class="bian_tr_bg">
              <td colspan="12">短牌</td>
              </tr>
            <tr class="bian_tr_title">
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号码</td>
                <td>赔率</td>
                <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/01.png" /><img src="images/ball_6/01.png" /></td>
                <td class="bian_td_odds" id="ball_6_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/02.png" /><img src="images/ball_6/02.png" /></td>
                <td class="bian_td_odds" id="ball_6_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/03.png" /><img src="images/ball_6/03.png" /></td>
                <td class="bian_td_odds" id="ball_6_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/04.png" /><img src="images/ball_6/04.png" /></td>
                <td class="bian_td_odds" id="ball_6_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t4"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_6/05.png" /><img src="images/ball_6/05.png" /></td>
                <td class="bian_td_odds" id="ball_6_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t5"></td>
                <td class="bian_td_qiu"><img src="images/ball_6/06.png" /><img src="images/ball_6/06.png" /></td>
                <td class="bian_td_odds" id="ball_6_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_6_t6"></td>
                <td class="bian_td_qiu" colspan="6"></td>
            </tr> 
      </table>
      
      <div class="button_body"><table boder=0 width=100%><tr><td><font color=red style="font-size:14px"><b>快捷下注：</b></font><input id="autoInput" name="autoInput" onkeyup="digitOnly(this)" size="5"/><font color=red>在此填写下注金额，然后点击需要下注的选项</font></td>
	  <td><a onclick="reset()" class="button again" title="重填"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="button submit" onclick="order();" title="下注"></a></td></tr></table></div>
      </form>
    </div>
    <div class="lottery_clear"></div>
</div>
</div>
<div id="endtime"></div>
<script type="text/javascript">loadinfo();$islg=<? if($uid) echo '1';else echo '0';?>;</script>
<IFRAME id="OrderFrame" name="OrderFrame" border=0 marginWidth=0 frameSpacing=0 src="" frameBorder=0 noResize width=0 scrolling=AUTO height=0 vspale="0" style="display:none"></IFRAME>
<div style="display:none" id="look"></div>
<div style='width:1px;height:1px;overflow:hidden;'>
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
           codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" 
           width="1" height="1" id="swfcontent" align="middle">
      <param name="allowScriptAccess" value="sameDomain" />
      <param name="movie" value="play.swf" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <embed src="play.swf" quality="high" bgcolor="#ffffff" width="550" 
             height="400" name="swfcontent" align="middle" allowScriptAccess="sameDomain" 
             type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
    </object>
  </div>
</body>
</html>