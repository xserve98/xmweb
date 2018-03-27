<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
if(intval($web_site['xjssc'])==1)
{
	include('close_cp.php');
	exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/top.js"></script>
<script type="text/javascript" src="../box/jquery.jBox-2.3.min.js"></script>
<script type="text/javascript" src="../box/jquery.jBox-zh-CN.js"></script>
<script type="text/javascript" src="js/xj_ssc_old.js"></script>
<link type="text/css" rel="stylesheet" href="../box/GrayCool/jbox.css"/>
<link type="text/css" rel="stylesheet" href="css/ssc_old.css"/>


<script type="text/javascript">
var islg=<?=$uid ? 1 : 0?>;
$(document).ready(function($) {
	showLoginOnly(false);
	
	$(window).scroll(function(){
		if($.browser.msie && $.browser.version=="6.0")$(".login_panel").css("top",$(window).height()-$(".login_panel").height()+$(document).scrollTop());
	});
	
});

//同一IP 12小时只显示一次
function showLoginOnly(isClose)
{　
	var isLoginS=$('.login_panel').attr("isLogin");
	var cookieString = new String(document.cookie);
	var cookieHeader = 'boxui_com_login_panel='; //更换happy_pop为任意名称
	var beginPosition = cookieString.indexOf(cookieHeader);
	if(isClose)
	{
		if (isClose)
		{
			$(".login_panel").css("display","none");
			var refrushTime = new Date();　　　　
		　 　refrushTime.setTime(refrushTime.getTime() + 12*60*60*1000 ) //同一ip设置过期时间，即多长间隔跳出一次
		　  document.cookie = 'boxui_com_login_panel=yes;expires='+ refrushTime.toGMTString();　 //更换happy_pop和第4行一样的名称
		}
	}
	else if(isLoginS=="" && beginPosition<0)
		$(".login_panel").css("display","block");
}
</script>
<style type="text/css">

.login_panel{width:776px;height:43px;background:url(js/images/Lottery_but1.png) 0 0 repeat-x;overflow:hidden;display:none;position:fixed;bottom:0;}
*html .login_panel{position:absolute;}
.login_panel .panel_center{margin:2px 0px 0px 0px;background:url(js/images/Lottery_but2.png) 274px 0 no-repeat;width:806px;height:40px;overflow:hidden;}
/*.login_panel .panel_center{margin:2px 0px 0px 0px;width:806px;height:40px;overflow:hidden;}*/
.login_panel .panel_center p{float:left;line-height:38px;margin-top:4px;}
.login_panel .panel_center p img {border:none;}
.login_panel .panel_center .tips{font-size:14px;font-weight:bold;color:#4ba6e5;width:280px;margin-left:0;text-align:left;text-indent:80px;line-height:40px;}
.login_panel .panel_center .close{font-size:14px;background:url(js/images/icon_close.png) 0 center no-repeat;margin-left:30px;height:32px;line-height:32px;text-indent:30px;display:block;color:#e54e4b;}
</style>
  
<style type="text/css">
body,td,th {
	font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
	.drpbg{width:60px;position:absolute; background:#021e37;text-align:center;top:25px;left:674px; height:42px; border:1px solid white; border-top:none;}
	.drpbg ul{margin:0px; padding:0px; height:42px; width:60px;}
	.drpbg li{margin:0px;text-align:center;width:60px; height:21px; line-height:20px;}
	.drpbg .ca{font-size:12px; color:White;text-decoration:none;}
	.drpbg .ca:hover{color:#ccc;}
</style>
</head>
<script language="JavaScript">

if(self==top){
	top.location='/index.php';
}
</script>

<script type="text/javascript">
function formReset()
  {
  document.getElementById("orders").reset()
  }
</script>


<body>

<!--内容开始-->
<div class="block" style="padding:0px 0px;">
<div class="lottery_main">
<div class="ssc_right">
  <div id="auto_list1"></div>
</div>
<div class="ssc_left">
<div class="jsq">
    <span class="time">第 <font id="open_qihao" color="#fff500">00000000-000</font> 期
        <br><br>剩余<font id="whataction">投注</font>时间</span>
    <span class="ssc">新疆时时彩<br><br>
        第 <font id="numbers"  color="#fff500">00000000-000</font> 期</span>
    <span class="zh" id="autoinfo">
    </span>
    <span class="sj" id="cqc_time">00:00</span>
    <div class="open_number"><img src="images/Open_ssc/x.gif"/><img src="images/Open_ssc/x.gif"/><img src="images/Open_ssc/x.gif"/><img src="images/Open_ssc/x.gif"/><img src="images/Open_ssc/x.gif"/></div>
   
    <span id='cqc_sound' off='0'><img src='images/ssc_on.png' title='关闭/打开声音'/></span>
     <span class="cpsm">每天09:00至23:10|每10分钟一期，共84期</span>
     <span class="bbqh"><a href="xjssc.php" target="_self" title="切换到新版模式">全新模式</a></span>
     <span class="gfwz"><a href="http://www.xjflcp.com/" target="_blank" title="新疆时时彩官方网站">官方网站</a></span>
     <span class="kjjg"><a href="ssc_list.php?type=14" target="_self" title="开奖历史">开奖历史</a></span>
     <span class="wfgz"><a href="rules/xjssc.php" target="_self" title="玩法规则">玩法规则</a></span>
     <span class="kjhm" id="auto_list">
		</span>
</div>



    <div class="touzhu">
<form name="orders" id="orders" action="order/order.php?type=14" method="post" target="OrderFrame">
    	<ul id="menu_hm">
        	<li class="current" onclick="hm_odds(1)">第一球<span>(万位)</span></li>
            <li class="current_n" onclick="hm_odds(2)">第二球<span>(千位)</span></li>
            <li class="current_n" onclick="hm_odds(3)">第三球<span>(百位)</span></li>
            <li class="current_n" onclick="hm_odds(4)">第四球<span>(十位)</span></li>
            <li class="current_n" onclick="hm_odds(5)">第五球<span>(个位)</span></li>
		</ul>
<table class="bian" border="0" cellpadding="0" cellspacing="1">

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
              <td>号码</td>
              <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/bule/0.png" /></td>
                <td class="bian_td_odds" id="ball_1_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t1"></td>
                <td class="bian_td_qiu"><img src="images/bule/1.png" /></td>
                <td class="bian_td_odds" id="ball_1_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t2"></td>
                <td class="bian_td_qiu"><img src="images/bule/2.png" /></td>
                <td class="bian_td_odds" id="ball_1_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t3"></td>
                <td class="bian_td_qiu"><img src="images/bule/3.png" /></td>
                <td class="bian_td_odds" id="ball_1_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t4"></td>
                <td class="bian_td_qiu"><img src="images/bule/4.png" /></td>
                <td class="bian_td_odds" id="ball_1_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t5"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/bule/5.png" /></td>
                <td class="bian_td_odds" id="ball_1_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t6"></td>
                <td class="bian_td_qiu"><img src="images/bule/6.png" /></td>
                <td class="bian_td_odds" id="ball_1_h7" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t7"></td>
                <td class="bian_td_qiu"><img src="images/bule/7.png" /></td>
                <td class="bian_td_odds" id="ball_1_h8" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t8"></td>
                <td class="bian_td_qiu"><img src="images/bule/8.png" /></td>
                <td class="bian_td_odds" id="ball_1_h9" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t9"></td>
              <td class="bian_td_qiu"><img src="images/bule/9.png" /></td>
              <td class="bian_td_odds" id="ball_1_h10" width="40"></td>
              <td class="bian_td_inp" id="ball_1_t10"></td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu">大</td>
              <td class="bian_td_odds" id="ball_1_h11"></td>
              <td class="bian_td_inp" id="ball_1_t11"></td>
              <td class="bian_td_qiu">小</td>
              <td class="bian_td_odds" id="ball_1_h12"></td>
              <td class="bian_td_inp" id="ball_1_t12"></td>
              <td class="bian_td_qiu">单</td>
              <td class="bian_td_odds" id="ball_1_h13"></td>
              <td class="bian_td_inp" id="ball_1_t13"></td>
              <td class="bian_td_qiu">双</td>
              <td class="bian_td_odds" id="ball_1_h14"></td>
              <td class="bian_td_inp" id="ball_1_t14"></td>
              <td colspan="3">&nbsp;</td>
            </tr>
      </table>
	  
	  

 
<ul id="menu_hm2" style="margin-top:5px;">
        	<li class="current" >总和 龙虎和</li>
		</ul>
    	<table class="bian" border="0" cellpadding="0" cellspacing="1" >
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
                    <td width="50" class="bian_td_qiu">总和大</td>
                    <td class="bian_td_odds" id="ball_6_h1"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t1"></td>
                    <td width="50" class="bian_td_qiu">总和小</td>
                    <td class="bian_td_odds" id="ball_6_h2"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t2"></td>
                    <td width="50" class="bian_td_qiu">总和单</td>
                    <td class="bian_td_odds" id="ball_6_h3"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t3"></td>
                    <td width="50" class="bian_td_qiu">总和双</td>
                    <td class="bian_td_odds" id="ball_6_h4"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t4"></td>
              </tr>
              <tr class="bian_tr_txt">
                    <td width="50" class="bian_td_qiu">龙</td>
                    <td class="bian_td_odds" id="ball_6_h5"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t5"></td>
                    <td width="50" class="bian_td_qiu">虎</td>
                    <td class="bian_td_odds" id="ball_6_h6"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t6"></td>
                    <td width="50" class="bian_td_qiu">和</td>
                    <td class="bian_td_odds" id="ball_6_h7"></td>
                    <td width="70" class="bian_td_inp" id="ball_6_t7"></td>
                    <td colspan="3">&nbsp;</td>
              </tr>
           </table>

    	<ul id="menu_hm2" style="margin-top:5px; ">
        	<li class="current" >斗牛</li>
		</ul>
<table class="bian" border="0" cellpadding="0" cellspacing="1">
        <tr class="bian_tr_title">
              <td>选项</td>
			  <td>赔率</td>
			  <td>金额</td>
			  <td>选项</td>
			  <td>赔率</td>
			  <td>金额</td>
			  <td>选项</td>
			  <td>赔率</td>
			  <td>金额</td>
			  <td>选项</td>
			  <td>赔率</td>
			  <td>金额</td>
              <td>选项</td>
			  <td>赔率</td>
			  <td>金额</td>
      </tr>
      <tr class="bian_tr_txt">
        <td width="50" class="bian_td_qiu">没牛</td>
        <td class="bian_td_odds" id="ball_10_h1"></td>
        <td class="bian_td_inp" id="ball_10_t1"></td>
        <td width="50" class="bian_td_qiu">牛1</td>
        <td class="bian_td_odds" id="ball_10_h2"></td>
        <td class="bian_td_inp" id="ball_10_t2"></td>
        <td width="50" class="bian_td_qiu">牛2</td>
        <td class="bian_td_odds" id="ball_10_h3"></td>
        <td class="bian_td_inp" id="ball_10_t3"></td>
        <td width="50" class="bian_td_qiu">牛3</td>
        <td class="bian_td_odds" id="ball_10_h4"></td>
        <td class="bian_td_inp" id="ball_10_t4"></td>
        <td width="50" class="bian_td_qiu">牛4</td>
        <td class="bian_td_odds" id="ball_10_h5"></td>
        <td class="bian_td_inp" id="ball_10_t5"></td>
      </tr>
      <tr class="bian_tr_txt">

        <td width="50" class="bian_td_qiu">牛5</td>
        <td class="bian_td_odds" id="ball_10_h6"></td>
        <td class="bian_td_inp" id="ball_10_t6"></td>
        <td width="50" class="bian_td_qiu">牛6</td>
        <td class="bian_td_odds" id="ball_10_h7"></td>
        <td class="bian_td_inp" id="ball_10_t7"></td>
        <td  width="50" class="bian_td_qiu">牛7</td>
        <td class="bian_td_odds" id="ball_10_h8"></td>
        <td class="bian_td_inp" id="ball_10_t8"></td>
        <td width="50" class="bian_td_qiu">牛8</td>
        <td class="bian_td_odds" id="ball_10_h9"></td>
        <td class="bian_td_inp" id="ball_10_t9"></td>
        <td width="50" class="bian_td_qiu">牛9</td>
        <td class="bian_td_odds" id="ball_10_h10"></td>
        <td class="bian_td_inp" id="ball_10_t10"></td>        
       
        
      </tr>
      <tr class="bian_tr_txt">
        <td width="50" class="bian_td_qiu">牛牛</td>
        <td class="bian_td_odds" id="ball_10_h11"></td>
        <td class="bian_td_inp" id="ball_10_t11"></td> 
        <td width="50" class="bian_td_qiu">牛大</td>
        <td class="bian_td_odds" id="ball_10_h12"></td>
        <td class="bian_td_inp" id="ball_10_t12"></td>
        <td width="50" class="bian_td_qiu">牛小</td>
        <td class="bian_td_odds" id="ball_10_h13"></td>
        <td class="bian_td_inp" id="ball_10_t13"></td>
        <td  width="50" class="bian_td_qiu">牛单</td>
        <td class="bian_td_odds" id="ball_10_h14"></td>
        <td class="bian_td_inp" id="ball_10_t14"></td>
        <td width="50" class="bian_td_qiu">牛双</td>
        <td class="bian_td_odds" id="ball_10_h15"></td>
        <td class="bian_td_inp" id="ball_10_t15"></td>

      </tr>
    </table>

    	<ul id="menu_hm2" style="margin-top:5px;display:none">
        	<li class="current" >梭哈</li>
		</ul>
<table class="bian" border="0" cellpadding="0" cellspacing="1" style="display:none">
        <tr class="bian_tr_title">
              <td width="50">选项</td>
			  <td width="50">赔率</td>
			  <td width="90">金额</td>
			  <td width="50">选项</td>
			  <td width="50">赔率</td>
			  <td width="90">金额</td>
			  <td width="50">选项</td>
			  <td width="50">赔率</td>

			  <td width="90">金额</td>
			  <td width="50">选项</td>
			  <td width="50">赔率</td>
			  <td width="89">金额</td>
      </tr>
     <tr class="bian_tr_txt">
        <td  width="50" class="bian_td_qiu">五条</td>
        <td class="bian_td_odds" id="ball_11_h1"></td>
        <td width="70" class="bian_td_inp" id="ball_11_t1"></td>
        <td width="50" class="bian_td_qiu">四条</td>
        <td class="bian_td_odds" id="ball_11_h2"></td>
        <td width="70" class="bian_td_inp" id="ball_11_t2"></td>
        <td width="50" class="bian_td_qiu">葫芦</td>
        <td class="bian_td_odds" id="ball_11_h3">
        
        </td>
        <td width="70" class="bian_td_inp" id="ball_11_t3"></td>
        <td width="50" class="bian_td_qiu">顺子</td>
        <td class="bian_td_odds" id="ball_11_h4">
        
        </td>
        <td width="70" class="bian_td_inp" id="ball_11_t4"></td>
      </tr>
      <tr class="bian_tr_txt">
        <td width="50" class="bian_td_qiu">三条</td>
        <td class="bian_td_odds" id="ball_11_h5"></td>
        <td width="70" class="bian_td_inp" id="ball_11_t5"></td>
        <td width="50" class="bian_td_qiu">两对</td>
        <td class="bian_td_odds" id="ball_11_h6">
        
        </td>
        <td width="70" class="bian_td_inp" id="ball_11_t6"></td>
        <td width="50" class="bian_td_qiu">一对</td>
        <td class="bian_td_odds" id="ball_11_h7"></td>
        <td  width="70" class="bian_td_inp" id="ball_11_t7"></td>
        <td width="50" class="bian_td_qiu">散号</td>
        <td  class="bian_td_odds" id="ball_11_h8"></td>
        <td width="70" class="bian_td_inp" id="ball_11_t8"></td>
      </tr>
    </table>

   	  <ul id="menu_s" style="margin-top:5px;">
        	<li class="current" onclick="s_odds(7)">组合 前三球</li>
            <li class="current_n" onclick="s_odds(8)">组合 中三球</li>
            <li class="current_n" onclick="s_odds(9)">组合 后三球</li>
		</ul>
    	<table class="bian" border="0" cellpadding="0" cellspacing="1">
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
              <td>选项</td>
              <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu">豹子</td>
                <td class="bian_td_odds" id="ball_7_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_7_t1"></td>
                <td class="bian_td_qiu">顺子</td>
                <td class="bian_td_odds" id="ball_7_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_7_t2"></td>
                <td class="bian_td_qiu">对子</td>
                <td class="bian_td_odds" id="ball_7_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_7_t3"></td>
                <td class="bian_td_qiu">半顺</td>
                <td class="bian_td_odds" id="ball_7_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_7_t4"></td>
                <td class="bian_td_qiu">杂六</td>
                <td class="bian_td_odds" id="ball_7_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_7_t5"></td>
            </tr>
			<tr class="bian_tr_txt">
                <td class="bian_td_qiu">大</td>
                <td class="bian_td_odds" id="ball_7_h6"></td>
                <td class="bian_td_inp" id="ball_7_t6"></td>
                <td class="bian_td_qiu">小</td>
                <td class="bian_td_odds" id="ball_7_h7"></td>
                <td class="bian_td_inp" id="ball_7_t7"></td>
                <td  class="bian_td_qiu">单</td>
                <td class="bian_td_odds" id="ball_7_h8"></td>
                <td class="bian_td_inp" id="ball_7_t8"></td>
                <td class="bian_td_qiu">双</td>
                <td class="bian_td_odds" id="ball_7_h9"></td>
                <td class="bian_td_inp" id="ball_7_t9"></td>
                <td colspan="3">&nbsp;</td>         
          </tr>
      </table>
      <div class="button_body"></div>
      <div class="login_panel"  isLogin="">
	<div class="panel_center">
		<p class="tips"></p>
		<p class="connectBox1">
			<a href="javascript:void(0);" title="重置金额" onclick="formReset()" value="Reset" class="button again"><img alt="重置金额" src="js/images/Lottery_but4.png"></a>
			<a href="javascript:void(0);" title="提交下注" onclick="order();" class="button submit"><img alt="提交下注" src="js/images/Lottery_but3.png"></a>
		</p>
		
	</div>
</div>

	   
      </form>

    </div>
</div>
</div>
<div class="lottery_clear"></div>

</div>



<div id="endtime"></div>
<script type="text/javascript">loadinfo()</script>
<IFRAME id="OrderFrame" name="OrderFrame" border=0 marginWidth=0 frameSpacing=0 src="" frameBorder=0 noResize width=0 scrolling=AUTO height=0 vspale="0" style="display:none"></IFRAME>
<div style="display:none" id="look"></div>
</body>
<!--<script language="javascript" src="js/load_results_cqssc.js"></script>-->
<script>
function cs_table(tag,el,id,element,num){
	var tagsContent = document.getElementById(tag);
	var tagsLi = tagsContent.getElementsByTagName(el);

	var tagContent = document.getElementById(id);
	var tagLi = tagContent.getElementsByTagName(element);
	var len= tagsLi.length;
	var back_img,n_img;
	for(var i=0; i<len; i++){				
		if(i == '0'){
			back_img = 'fiest_bg01.png';
			n_img = 'fiest_bg02.png';
		}else if(i+1 == len){
			back_img = 'wu_bg02.png';
			n_img = 'wu_bg01.png';
		}else{
			back_img = 'top_bg02.png';
			n_img = 'top_bg.png';
		}
		if(i == num){
			tagsLi[i].style.background = 'url(images/'+back_img+') repeat-x';
			tagsLi[i].style.fontWeight = 'bold';
			tagLi[i].style.display="block"; 
		}else{
			tagsLi[i].style.background = 'url(images/'+n_img+') repeat-x';
			tagsLi[i].style.fontWeight = 'normal';
			tagLi[i].style.display="none"; 
		}
	}
	if(tag=='tag4'){
		window.scrollTo(0,document.body.scrollHeight);
	}
}
</script>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
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
    </html>