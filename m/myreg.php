<?php
include_once("include/lottery.inc.php");
include_once("cache/website.php");
$f_class = ' abs';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?=$web_site['web_title']?></title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-status-bar-style" content="yes" />
<style type="text/css">
  		body {background-color: #88a6b1}
  		#spinner {

  			height: 100%; 
  			background-color: rgba(0,0,0,.4);
  			opacity: 1;
  			position: absolute; 
  			z-index: 11;

    background-size: cover;
}
  	</style>
<link href="/lib/ionic/css/ionic.min.css" rel="stylesheet" />
<link href="/css/main.pack.min.css" rel="stylesheet" />

<body class="skin_blue grade-a platform-browser platform-ios platform-ios9 platform-ios9_1 platform-ready" ng-app="ionicz" ng-controller="AppCtrl">
    <ion-nav-bar class="bar-light nav-bar-container" nav-bar-transition="no" nav-bar-direction="forward" nav-swipe="">
		<ion-nav-buttons side="left" class="hide"></ion-nav-buttons>
	<div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-light bar bar-header" align-title="center"><div class="buttons buttons-left header-item"><span class="left-buttons">

	  	</span></div><div class="title title-center header-item"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-light bar bar-header" align-title="center"><div class="buttons buttons-left header-item"><span class="left-buttons">
	    		    <a class="button button-icon icon-prepage" href="/"></a>
	  	</span></div><div class="title title-center header-item" style="left: 56px; right: 56px;">注册</div></ion-header-bar></div></ion-nav-bar>
	<ion-content class="padding scroll-content ionic-scroll  has-header" delegate-handle="regScroll"><div class="scroll" style="transform: translate3d(0px, 0px, 0px) scale(1);">
		<form id="form1"  name="form1" action="../../reg.php" class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" method="post"  onsubmit="return regcheck();" >
		<div class="list list-inset list-theme">
			<p>为了您的资金安全，请使用真实资料!</p>
			<div ng-if="step==1" class="">
				<div class="item item-input nopadding border-theme input-images input-name">
					<input class="reset-field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" name="zcname" placeholder="帐号" ng-keyup="resetCheck();" ng-blur="checkUserName(regData.userName)" ng-pattern="/^[A-Za-z0-9]+$/" ng-minlength="6" ng-maxlength="15" required=""><i ng-show="enabled" ng-click="reset();" class="icon icon-close ng-hide"></i>
				</div>
				<p class="item-warn text-light" ng-if="!regForm.userName.$touched">*请使用6-15位英文或数字的组合</p>
				<div class="item item-input nopadding border-theme input-images input-pwd input-icon">
					<input class="password-eye ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="password" name="passwd" ng-model="regData.passwd" placeholder="密码" ng-minlength="6" ng-maxlength="20" required="">
				</div>
				<p class="item-warn text-light" ng-class="(regForm.passwd.$touched &amp;&amp; regForm.passwd.$invalid) ? 'text-assertive' : 'text-light'">*请使用6-20位字符</p>

				<div class="item item-input nopadding border-theme input-images input-pwd input-icon">
					<input class="password-eye ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="password" name="passwdse" ng-model="regData.passwdse" placeholder="确认密码" ng-minlength="6" ng-maxlength="20" required="">
				</div>
				<p class="item-warn text-light" ng-class="(regForm.fullName.$touched &amp;&amp; !fullNameIsOk) ? 'text-assertive' : 'text-light'">*请再次输入密码以确保输入无误</p>
				
				<p class="item-warn text-assertive ng-hide" ng-show="(regForm.passwdse.$touched&amp;&amp;regData.passwdse!=regData.passwd)">*密码不一致</p>
                <div class="item item-input nopadding border-theme input-images input-name">
					<input class="reset-field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" name="realname" placeholder="真实姓名" ng-keyup="resetCheck();" ng-blur="checkUserName(regData.realname)" ng-pattern="/^[A-Za-z0-9]+$/" ng-minlength="6" ng-maxlength="15" required=""><i ng-show="enabled" ng-click="reset();" class="icon icon-close ng-hide"></i>
				</div>
				<p class="item-warn text-light" ng-class="(regForm.fullName.$touched &amp;&amp; !fullNameIsOk) ? 'text-assertive' : 'text-light'">*请输入真实姓名[2~5个汉字]</p>
				
				<div class="item item-input nopadding border-theme input-images input-pwd input-icon">
					<input class="reset-field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" name="paypasswd" placeholder="取款密码" ng-keyup="resetCheck();" ng-blur="checkUserName(regData.paypasswd)" ng-pattern="/^[A-Za-z0-9]+$/" ng-minlength="6" ng-maxlength="15" required=""><i ng-show="enabled" ng-click="reset();" class="icon icon-close ng-hide"></i>
				</div>
                <input name="button" type="submit" class="button button-block button-positive" id="loginBtn" value="注册">
			</div><!-- end ngIf: step==1 -->
			
			<!-- ngIf: step==2 -->
			
			<div class="row">
				<div class="col text-center"><p>已有帐号?<a href="/user/login">马上登录</a></p></div>
			</div>
		</div>  
		
		</form>
	</div><div class="scroll-bar scroll-bar-v"><div class="scroll-bar-indicator scroll-bar-fade-out" style="transform: translate3d(0px, 0px, 0px) scaleY(1); height: 0px;"></div></div></ion-content>
</ion-view></ion-nav-view>
<script type="text/javascript">
    function regcheck() {
        var name = $("#zcname");
        if(name.val() == "") {
            var e = function() {
                name.focus();
            };
            lay_msg('请输入用户名！', e);
            return false;
        }
		var n_reg = /^[a-zA-Z0-9_]{4,15}$/;
		if(!n_reg.test(name.val())) {
			var e = function() {
                name.focus();
            };
            lay_msg('用户名只能为4-15位的字母数字下划线组合！', e);
            return false;
		}
        var o_pd = $("#passwd");
        if(o_pd.val() == "") {
            var e = function() {
                o_pd.focus();
            };
            lay_msg('请设置密码！', e);
            return false;
        }
        if(o_pd.val().length < 6) {
            var e = function() {
                o_pd.focus();
            };
            lay_msg('密码至少需要6个字符！', e);
            return false;
        }
        var n_pd = $("#passwdse");
        if(n_pd.val() != o_pd.val()) {
            var e = function() {
                n_pd.focus();
            };
            lay_msg('两次密码输入不一样！', e);
            return false;
        }
        var r_name = $("#realname");
        if(r_name.val() == "") {
            var e = function() {
                r_name.focus();
            };
            lay_msg('请输入您的真实姓名！', e);
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            var e = function() {
                r_name.focus();
            };
            lay_msg('请输入正确的姓名！', e);
            return false;
        }
        var p_pd = $("#paypasswd");
        var p_reg = /^\d{6}$/;
        if(p_pd.val() == "") {
            var e = function() {
                p_pd.focus();
            };
            lay_msg('请设置提款密码！', e);
            return false;
        }
        if(!p_reg.test(p_pd.val())) {
            var e = function() {
                p_pd.focus();
            };
            lay_msg('提款密码只能为6个数字！', e);
            return false;
        }
        return true;
    }
</script>
</body>
</html>