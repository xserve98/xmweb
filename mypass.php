<?php
session_start();
include_once("../include/config.php"); 
include_once("../include/mysqli.php");
include_once("../common/function.php");
include_once("../class/user.php");
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=”renderer” content=”webkit” />
<title>找回密码</title>
<?
include_once("myhead.php"); 
?>
<link rel="stylesheet" href="/newdsn/css/cash/login.css">
    <div style="clear: both;"></div>
	<div class="bannerpromo">
		<div class="g_w1">
			<img src="/xmIndex/img/banner_faq.jpg" ondragstart="return false;" alt="" width="1000" height="221">
			<div class="headertxt" style="margin-left:-180px; margin-top: -30px;" >找回密码</div>
			<div class="headersubtxt">请输入你要找回登录密码的用户名,之后会向你的手机发送验证码！</div>
		</div>
	</div>


	<div class="loginpanel" style="min-height: 630px;">
		<div class="g_w1 clearfix body_bg">
<div class="stepitm stepactive" style="z-index: 3;">
				<div class="stepno">01</div>
				<div class="stepnotxt">输入用户名/取款密码</div>
				<div class="hlfcircle hlfcircleactive"></div>
			</div>
			<div class="stepitm" style="z-index: 2;">
				<div class="stepno ml90">02</div>
				<div class="stepnotxt">输入新密码</div>
				<div class="hlfcircle"></div>
			</div>
			<div class="stepitm" style="z-index: 1;">
				<div class="stepno ml90">03</div>
				<div class="stepnotxt">登录网站</div>
			</div>

		</div>
     <form action="../mypass.php?action=pass" method="post" name="form1" onsubmit="return check_submit_login();">
		<div class="g_w1 clearfix body_bg">
			<div class="row mt35 clearfix">
				<div class="col1">登录账号：</div>
				<div class="col2">
					<input type="text" id="username" name="username" maxlength="15" class="textbox1">
				</div>
				<div id="nameTips" class="col3">＊请输入登陆账号以确保输入无误</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">手机号码：</div>
				<div class="col2">
					<input type="text" id="mobile" name="mobile" class="textbox1">
				</div>
				<div class="col3">＊请输入您绑定的手机号码</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">新登录密码：</div>
				<div class="col2">
					<input name="newpass" type="password" class="textbox1" id="newpass" maxlength="20"/>
				</div>
				<div class="col3">＊请输入6-20位新密码</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">确认新登录密码：</div>
				<div class="col2">
					<input name="newpass" type="password" class="textbox1" id="newpass" maxlength="20"/>
				</div>
				<div class="col3">＊重复输入一次新密码</div>
			</div>
			
			<div class="row  clearfix">
				<div class="col1">验证码:</div>
				<div class="col2">
				   <input name="vlcodes" id="vlcodes"  type="text"  style="width: 90px" class="textbox1" maxlength="4" onfocus="next_checkNum_img()" /> <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="cursor:pointer; position:relative; top:3px;" onclick="next_checkNum_img()" />

				</div>
				<div class="col3">＊请输入验证码</div>
			</div>
			<div class="row" style="margin-bottom: 50px;">
				<div class="col1"></div>
				<div class="col2">
					<button name="submit" type="submit" id="submit" class="submitbtn">下一步</button>
				</div>
				 </form>
			</div>
		</div>
	</div>


﻿<div class="footerindex2">Copyright © <?=$web_site['web_name']?>  All Rights Reserved.</div>
    
<div class="remodal-overlay remodal-is-closed" style="display: none;"></div><div class="remodal-wrapper remodal-is-closed" style="display: none;"><div class="remodal remodal-is-initialized remodal-is-closed" data-remodal-id="modal" role="dialog" aria-describedby="modal1Desc" data-remodal-options="hashTracking: false" style="width: 250px;" tabindex="-1">
<div>
<p id="modal1Desc" style="color: rgb(0, 0, 0);"></p>
</div>
</div>
</div>
</body>
</html>