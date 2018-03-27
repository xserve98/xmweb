<?php
session_start();
$_SESSION['SitePath'] = dirname(__FILE__);
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("cache/website.php");

$uid = $_SESSION["uid"];

if(isset($_GET['f'])) {
	$sql    =    "select uid from k_user where username='".htmlEncode($_GET['f'])."' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        echo '<script>location.href="/myreg.php";</script>';
		exit;
    }
}

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$list = $rs['msg'];

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
    <ion-nav-bar class="bar-header bar-positive nav-bar-container hide" nav-bar-transition="no">
    <div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-header bar-positive bar" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-header bar-positive bar" align-title="center"><div class="title title-center header-item"></div></ion-header-bar></div></ion-nav-bar>
    <ion-nav-view class="view-container" nav-view-transition="no" nav-view-direction="none" nav-swipe=""><ion-view class="m-login pane" view-title="欢迎登录使用" state="login" nav-view="active" style="transform: translate3d(0%, 0px, 0px); opacity: 1;">
	<ion-nav-bar class="bar-header bar-light nav-bar-container" nav-bar-transition="no" nav-bar-direction="none" nav-swipe="">
		<ion-nav-buttons side="left" class="hide"></ion-nav-buttons>
	  	
	<div class="nav-bar-block" nav-bar="cached"><ion-header-bar class="bar-header bar-light bar" align-title="center"><div class="buttons buttons-left header-item"><span class="left-buttons">
	    	<a class="button button-icon icon-prepage" ng-click="back();"></a>
	  	</span></div><div class="title title-center header-item"></div></ion-header-bar></div><div class="nav-bar-block" nav-bar="active"><ion-header-bar class="bar-header bar-light bar" align-title="center"><div class="buttons buttons-left header-item"><span class="left-buttons">
	    <a class="button button-icon icon-prepage" href="/"></a>
	  	</span></div><div class="title title-center header-item" style="left: 48px; right: 48px;">欢迎登录使用</div></ion-header-bar></div></ion-nav-bar>
	<ion-content class="padding scroll-content ionic-scroll  has-header">
<form id="loginForm" name="form1" action="../../logincheck.php" class="form-horizontal" method="post" onsubmit="return check_login();">
		<div class="list list-inset">
			<div class="item item-input">
				<img src="http://1341.yanshiwang.net/images/icon-user.png">
				<span>帐&nbsp;&nbsp;&nbsp;号&nbsp;:&nbsp;</span>
				<input class="reset-field" type="text"  name="username" id="username" placeholder="帐号">
			</div>
			
			<div class="item item-input">
				<img src="http://1341.yanshiwang.net/images/icon-pwd.png">
				<span>密&nbsp;&nbsp;&nbsp;码&nbsp;:&nbsp;</span>
				<input class="reset-field" type="password" name="passwd" id="passwd" placeholder="密码">
			</div>
			<div class="item item-input">
		        <img src="http://1341.yanshiwang.net/images/icon-pwd.png">
				<span>验证码&nbsp;:&nbsp;</span>
				<input type="text" class="validcode-field" name="code" placeholder="验证码" maxlength="4" pattern="\d*" id="code">
                <span class="verify-text"><img src="../../yzm.php" style="width: 80px;height: 36px;"></span>
			</div>
				<input type="hidden" name="act" value="login">
                <input name="button" type="submit" class="button button-block button-positive" id="loginBtn" value="登录">

		</div>
		<div class="row row-no-padding">
			<div class="col col-33 text-center"><a class="button button-clear button-dark" href="/user/register">马上注册</a></div>
			<div class="col col-33 text-center"><a class="button button-clear button-dark" href="/guest.php">免费试玩</a></div>
			<div class="col col-33 text-center"><a class="button button-clear button-dark" target="_blank" href="http://www.azc888.com">电脑版</a>
		</div>
		</form>
	</ion-content>
</ion-view>
<script type="text/javascript">
    function check_login() {
        var frm = $("#loginForm");
        var opt = {
            beforeSubmit: function() {
                if($("#username").val() == "") {
                    var e = function() {
                        $("#username").focus();
                    };
                    lay_msg('请输入您的账号！', e);
                    return false;
                }
                if($("#passwd").val() == "") {
                    var e = function() {
                        $("#passwd").focus();
                    };
                    lay_msg('请输入您的密码！', e);
                    return false;
                }
				if($("#code").val() == "") {
                    var e = function() {
                        $("#code").focus();
                    };
                    lay_msg('请输入您验证码！', e);
                    return false;
                }
                $("#loginBtn").attr("disabled", true);
            },
            success: function(data) {
                if(data.indexOf("3") >= 0) {
                    var e = function() {
						$("#code").val("");
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                    };
                    lay_msg('账号异常无法登陆，如有疑问请联系在线客服！', e);
                } else if(data.indexOf("2") >= 0) {
                    var e = function() {
						$("#code").val("");
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                    };
                    lay_msg('账号或密码错误，请重新输入！', e);
                } else if(data.indexOf("1") >= 0) {
                    var e = function() {
                        location.replace("/");
                    };
                    lay_msg('登录成功！', e);
                }
            }
        };
        frm.ajaxSubmit(opt);
        return false;
    }
</script>
</body>
</html>