<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/website.php");

$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myreg';

include_once("myhead.php"); 
?>
<link rel="stylesheet" href="/newdsn/css/cash/login.css">
	<div class="bannerpromo">
		<div class="g_w1">
			<img src="/xmIndex/img/banner_login.jpg" alt="" width="1000" height="221">
			<div class="headertxt">注册</div>
			<div class="headersubtxt">欢迎来到<?=$web_site['web_name']?>，我们更专注彩票，博彩乐趣都在这里。</div>
		</div>
	</div>

	<div class="loginpanel" style="min-height: 630px;">
		<div class="g_w1 clearfix body_bg">
<div class="stepitm stepactive" style="z-index: 3;">
				<div class="stepno">01</div>
				<div class="stepnotxt">设置账户及登录密码</div>
				<div class="hlfcircle hlfcircleactive"></div>
			</div>
			<div class="stepitm" style="z-index: 2;">
				<div class="stepno ml90">02</div>
				<div class="stepnotxt">注册成功</div>
				<div class="hlfcircle"></div>
			</div>
			<div class="stepitm" style="z-index: 1;">
				<div class="stepno ml90">03</div>
				<div class="stepnotxt">登录网站</div>
			</div>

		</div>
<form id="form1" onsubmit="return regcheck();" action="../reg.php" method="post" name="form1">
	<div class="g_w1 clearfix body_bg">
			<div class="row mt35 clearfix">
				<div class="col1">登录账号:</div>
				<div class="col2">
				
                   <input id="zcname" name="zcname" type="text" placeholder="" size="40" class="textbox1" maxlength="15">
				</div>
				<div id="nameTips" class="col3">＊账号为3-20位的字母数字下划线组合</div>
			</div>
		
			<div class="row clearfix">
				<div class="col1">登录密码:</div>
				<div class="col2">
			  <input id="passwd1" name="passwd1" type="password" class="textbox1"  size="40" maxlength="20">
				</div>
				<div class="col3">＊6-20个字母、数字或组合组成，区分大小写</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">确认密码:</div>
				<div class="col2">
				
                     <input id="passwdse" name="passwdse" type="password" class="textbox1" placeholder="" size="40" maxlength="20">
				</div>
				<div class="col3">＊请再次输入密码以确保输入无误</div>
			</div>
            
            	<!--div class="row  clearfix">
				<div class="col1">手机号码:</div>
				<div class="col2">
					<input type="text" id="mobile" name="mobile" class="textbox1" ōnkeyup="this.value=this.value.replace(/\D/g,'''')" ōnafterpaste="this.value=this.value.replace(/\D/g,'''')">
				</div>
				<div class="col3">＊请输入真实手机号码，验证身份渠道，否则无法修改资料</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">微信号码:</div>
				<div class="col2">
					<input type="text" id="wechat" name="wechat" class="textbox1">
				</div>
				<div class="col3">＊输入微信号必须真实，验证身份渠道，否则无法修改资料</div>
			</div>
            	<div class="row  clearfix">
				<div class="col1">QQ号码:</div>
				<div class="col2">
					<input type="text" id="qq" name="qq" class="textbox1" ōnkeyup="this.value=this.value.replace(/\D/g,'''')" ōnafterpaste="this.value=this.value.replace(/\D/g,'''')">
				</div>
				<div class="col3">＊输入QQ号码必须真实，验证身份渠道，否则无法修改资料</div>
			</div-->
            
            	<div class="row  clearfix">
				<div class="col1">真实姓名:</div>
				<div class="col2">
			 <input id="realname" name="realname" type="text" class="textbox1" maxlength="10" size="40">
				</div>
				<div class="col3">＊真实姓名必须与您用于提款银行账户名称一致</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">取款密码:</div>
				<div class="col2">
			   <input id="paypasswd" name="paypasswd" type="password" class="textbox1" maxlength="6" size="40">
				</div>
				<div class="col3">＊请输入6位的数字组合密码</div>
			</div>
			<!--div class="row  clearfix">
				<div class="col1">验证码:</div>
				<div class="col2">
					<input name="vcode" id="vcode" class="textbox1" style="width: 160px;" value="" type="text">
					<img src="/yzm.php" onclick="this.src='/yzm.php/'+(new Date()).getTime()" 
					style="position:absolute;left:338px;">
				</div>
				<div class="col3">＊请输入验证码</div>
			</div-->
			<div class="row" style="margin-bottom: 50px;">
				<div class="col1"></div>
				<div class="col2">
                <input name="regBtn" type="submit" class="submitbtn" value="创建帐号">
				</div>
			</div>
		</div>
           </form>
	</div>
	﻿<div class="footerindex2">Copyright © <?=$web_site['web_name']?>  All Rights Reserved.</div>
  
<div class="remodal-overlay remodal-is-closed" style="display: none;"></div><div class="remodal-wrapper remodal-is-closed" style="display: none;"><div class="remodal remodal-is-initialized remodal-is-closed" data-remodal-id="modal" role="dialog" aria-describedby="modal1Desc" data-remodal-options="hashTracking: false" style="width: 250px;" tabindex="-1">
  <div>
    <p id="modal1Desc" style="color: rgb(0, 0, 0);"></p>
  </div>
</div></div>
<script type="text/javascript">
    function change_zc_yzm(id) {
        $("#" + id).attr("src", "/yzm.php?" + Math.random());
        $("#vcode").val("").focus();
        return false;
    }
    function regcheck() {
        var name = $("#zcname");
			/////console.log(name.val());
        if(name.val() == "") {
            layer.tips('请输入用户名！', name, {tips: [2, 'red']});
            name.focus();
            return false;
        }

		var n_reg = /^[a-zA-Z0-9_]{3,20}$/;
		if(!n_reg.test(name.val())) {
			layer.tips('用户名只能为3-20位的字母数字下划线组合！', name, {tips: [2, 'red']});
            name.focus();
            return false;
		}
        var o_pd = $("#passwd1");
				
        if(o_pd.val() == "") {
            layer.tips('请设置密码！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        if(o_pd.val().length < 6) {
            layer.tips('密码至少需要6个字符！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        var n_pd = $("#passwdse");
        if(n_pd.val() != o_pd.val()) {
            layer.tips('两次密码输入不一样！', n_pd, {tips: [2, 'red']});
            n_pd.focus();
            return false;
        }
        var r_name = $("#realname");
        if(r_name.val() == "") {
            layer.tips('请输入您的真实姓名，需要与银行卡开户人一样！', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            layer.tips('请输入正确姓名，需要和银行开户人一样', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var p_pd = $("#paypasswd");
        var p_reg = /^\d{6}$/;
        if(p_pd.val() == "") {
            layer.tips('请设置取款密码！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
        if(!p_reg.test(p_pd.val())) {
            layer.tips('取款密码只能为6个数字！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
	/*	
	  var p_qq = $("#qq");

        if(p_qq.val() == "") {
            layer.tips('请输入QQ号码！', p_qq, {tips: [2, 'red']});
            p_qq.focus();
            return false;
        }
     if(p_qq.val().length>10){
		 
		    layer.tips('QQ号码11位以下数字！', p_qq, {tips: [2, 'red']});
            p_qq.focus();
            return false;
		 
		 }
		
		var p_mobile = $("#mobile");

        if(p_mobile.val() == "") {
            layer.tips('请输入手机号码！', p_mobile, {tips: [2, 'red']});
            p_mobile.focus();
            return false;
        }
     if(p_mobile.val().length != 11){
		 
		    layer.tips('手机号码是11位数字！', p_mobile, {tips: [2, 'red']});
            p_mobile.focus();
            return false;
		 
		 }
		
		
		
		  var p_wechat = $("#wechat");

        if(p_wechat.val() == "") {
            layer.tips('请输入微信号码！', p_wechat, {tips: [2, 'red']});
            p_wechat.focus();
            return false;
        }

		
		
        var code = $("#vcode");
        if(code.val() == "") {
            layer.tips('请输入验证码！', code, {tips: [2, 'red']});
            code.focus();
            return false;
        }*/
        return true;
    }
</script>
</body>
</html>