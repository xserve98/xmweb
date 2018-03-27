<?php
session_start();
//if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])){
    //echo "<script type=\"text/javascript\" language=\"javascript\">window.open('/','_top');</script>";
    //exit();
//}
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

if(intval($web_site['pk10'])==1)
{
	message('北京赛车(PK10)系统维护，暂停下注！');
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
    <script type="text/javascript" src="js/bjs_pk10.js?t=<?=time()?>"></script>
    <script language="javascript" src="/js/mouse.js"></script>
    <link type="text/css" rel="stylesheet" href="../box/Green/jbox.css"/>
    <link type="text/css" rel="stylesheet" href="css/bjscs.css"/>
</head>

<body>
<div class="lottery_main">
<div class="ssc_right">
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
        <div class="top">北京赛车(PK10)倒计时<span id="downtime" style="color: #F9E101;">00:00:00</span><span>第 <font id='numbers' class="red number">00000000-000</font> 期</span></div>
        <div class="kick "><img src='images/Ball_5/x1.png'></div>
        <div class="kick er"><img src='images/Ball_5/x2.png'></div>
        <div class="kick san"><img src='images/Ball_5/x3.png'></div>
        <div class="kick si"><img src='images/Ball_5/x4.png'></div>
        <div class="kick wu"><img src='images/Ball_5/x5.png'></div>
        <div class="kick liu"><img src='images/Ball_5/x6.png'></div>
        <div class="kick qi"><img src='images/Ball_5/x7.png'></div>
        <div class="kick ba"><img src='images/Ball_5/x8.png'></div>
        <div class="kick jiu"><img src='images/Ball_5/x9.png'></div>
        <div class="kick shi"><img src='images/Ball_5/x10.png'></div>
        <div class="fot" id="autoinfo">开奖数据获取中...</div>
      </div>
    </div>
    <div class="touzhu">
<form id="orders" name="orders" action="order/order4.php?type=4&class=1" method="post" target="OrderFrame">
    <table class="bian" border="0" cellpadding="0" cellspacing="1">
        <tr class="bian_tr_title">
            <td colspan=3>冠 军</td>
            <td colspan=3>亚 军</td>
            <td colspan=3>第三名</td>
            <td colspan=3>第四名</td>
            <td colspan=3>第五名</td>
        </tr>
		<tr class="bian_tr_title">
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
			<td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_1" width="30"></td>
            <td class="bian_td_odds" id="ball_2_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t1"></td>
            <td class="bian_td_qiu" id="No_1" width="30"></td>
            <td class="bian_td_odds" id="ball_3_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t1"></td>
            <td class="bian_td_qiu" id="No_1" width="30"></td>
            <td class="bian_td_odds" id="ball_4_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t1"></td>
            <td class="bian_td_qiu" id="No_1" width="30"></td>
            <td class="bian_td_odds" id="ball_5_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t1"></td>
			<td class="bian_td_qiu" id="No_1" width="30"></td>
            <td class="bian_td_odds" id="ball_6_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t1"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_2_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_3_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_4_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_5_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t2"></td>
			<td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_6_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t2"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_2_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t3"></td>
            <td class="bian_td_qiu"id="No_3"></td>
            <td class="bian_td_odds" id="ball_3_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t3"></td>
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_4_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t3"></td>
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_5_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t3"></td>
			<td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_6_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t3"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_2_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_3_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_4_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_5_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t4"></td>
			<td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_6_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t4"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_2_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_3_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_4_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_5_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t5"></td>
			<td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_6_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t5"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_2_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_3_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_4_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_5_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t6"></td>
			<td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_6_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t6"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_2_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_3_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_4_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_5_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t7"></td>
			<td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_6_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t7"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_2_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_3_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_4_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_5_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t8"></td>
			<td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_6_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t8"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_2_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_3_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_4_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_5_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t9"></td>
			<td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_6_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t9"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_2_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_2_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_3_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_3_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_4_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_4_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_5_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_5_t10"></td>
			<td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_6_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_6_t10"></td>
        </tr>
		<tr class="bian_tr_title">
            <td colspan=3>第六名</td>
            <td colspan=3>第七名</td>
            <td colspan=3>第八名</td>
            <td colspan=3>第九名</td>
            <td colspan=3>第十名</td>
        </tr>
		<tr class="bian_tr_title">
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
            <td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
			<td>号</td>
            <td>赔率</td>
            <td width="70">金额</td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_1"></td>
            <td class="bian_td_odds" id="ball_7_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t1"></td>
            <td class="bian_td_qiu" id="No_1"></td>
            <td class="bian_td_odds" id="ball_8_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t1"></td>
            <td class="bian_td_qiu" id="No_1"></td>
            <td class="bian_td_odds" id="ball_9_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t1"></td>
            <td class="bian_td_qiu" id="No_1"></td>
            <td class="bian_td_odds" id="ball_10_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t1"></td>
			<td class="bian_td_qiu" id="No_1"></td>
            <td class="bian_td_odds" id="ball_11_h1"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t1"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_7_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_8_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_9_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t2"></td>
            <td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_10_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t2"></td>
			<td class="bian_td_qiu" id="No_2"></td>
            <td class="bian_td_odds" id="ball_11_h2"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t2"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_7_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t3"></td>
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_8_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t3"></td>
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_9_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t3"></td>
            <td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_10_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t3"></td>
			<td class="bian_td_qiu" id="No_3"></td>
            <td class="bian_td_odds" id="ball_11_h3"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t3"></td>
        </tr>
        <tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_7_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_8_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_9_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t4"></td>
            <td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_10_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t4"></td>
			<td class="bian_td_qiu" id="No_4"></td>
            <td class="bian_td_odds" id="ball_11_h4"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t4"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_7_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_8_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_9_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t5"></td>
            <td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_10_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t5"></td>
			<td class="bian_td_qiu" id="No_5"></td>
            <td class="bian_td_odds" id="ball_11_h5"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t5"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_7_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_8_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_9_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t6"></td>
            <td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_10_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t6"></td>
			<td class="bian_td_qiu" id="No_6"></td>
            <td class="bian_td_odds" id="ball_11_h6"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t6"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_7_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_8_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_9_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t7"></td>
            <td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_10_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t7"></td>
			<td class="bian_td_qiu" id="No_7"></td>
            <td class="bian_td_odds" id="ball_11_h7"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t7"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_7_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_8_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_9_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t8"></td>
            <td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_10_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t8"></td>
			<td class="bian_td_qiu" id="No_8"></td>
            <td class="bian_td_odds" id="ball_11_h8"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t8"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_7_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_8_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_9_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t9"></td>
            <td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_10_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t9"></td>
			<td class="bian_td_qiu" id="No_9"></td>
            <td class="bian_td_odds" id="ball_11_h9"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t9"></td>
        </tr>
		<tr class="bian_tr_txt">
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_7_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_7_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_8_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_8_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_9_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_9_t10"></td>
            <td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_10_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_10_t10"></td>
			<td class="bian_td_qiu" id="No_10"></td>
            <td class="bian_td_odds" id="ball_11_h10"></td>
            <td width="70" class="bian_td_inp" id="ball_11_t10"></td>
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
<script type="text/javascript">loadinfo()</script>
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