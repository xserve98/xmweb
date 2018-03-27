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
<link rel="shortcuticon" href="/favicon.ico" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-status-bar-style" content="yes" />
<link href="/css/main.pack.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/xmindex/css/main.css"/>
<link href="/xmindex/css/bootstrap.min.css" rel="stylesheet">
<link href="/xmindex/css/style.css" rel="stylesheet">
<script src="/xmindex/js/jquery-1.11.3.min.js"></script>
<script src="/xmindex/js/layer.js"></script>
<style type="text/css">
.container {
    text-align: center;
}
input::-ms-input-placeholder{padding-left: 10px;}
input::-webkit-input-placeholder{padding-left: 10px;}
.logo {
    margin-top: 30px;
}
.toptextfield {
    margin-top: 30px;
}
.btmtextfield {
    margin-top: 0px;
}
.capchatextfield {
    margin-top: 15px;
    position: relative;
    height: 50px;
    margin-left: auto;
    margin-right: auto;
}
.cn {
    font-family: Tahoma, Helvetica, Arial, "Microsoft Yahei","微软雅黑", STXihei, "华文细黑", sans-serif;
    font-size: 16px;
    color: #000;
}
.textfieldtop {
    width: 100%;
    height: 50px;
    padding:0;
    border: 1px solid #e7e7e7;
    -webkit-border-top-left-radius: 12px;
    -webkit-border-top-right-radius: 12px;
    -moz-border-radius-topleft: 12px;
    -moz-border-radius-topright: 12px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    border-bottom: none;
}
.textfieldbtm {
    width: 100%;
    height: 50px;
    padding: 0;
    border: 1px solid #e7e7e7;
    -webkit-border-bottom-right-radius: 12px;
    -webkit-border-bottom-left-radius: 12px;
    -moz-border-radius-bottomright: 12px;
    -moz-border-radius-bottomleft: 12px;
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px;
    margin-top: -2px;
}
.textfieldcapcha {
    width: 100%;
    height: 50px;
    padding: 0;
    border: 1px solid #e7e7e7;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
}
.capchaposition {
    position: absolute;
    right: 3px;
    top: 3px;
}
.submitgap {
    margin-top: 30px;
    text-align: center;
}
.registergap {
    margin-top: 20px;
    text-align: center;
}
.registergap a {
    line-height: 52px;
    text-decoration: none;
}
.registergap a:hover, .registergap a:visited {
    color: white;
    text-decoration: none;
}
.submitbtn {
    width: 100%;
    height: 52px;
    font-size: 16px !important;
    background-color: #0772df;
    font-weight: bold;
    text-shadow: 1px 1px #0772df;
    color: #ffffff;
    border-radius: 12px;
    -moz-border-radius: 12px;
    -webkit-border-radius: 12px;
    border: 2px solid #0772df;
    cursor: pointer;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    background: #0772df;
    background: -moz-linear-gradient(top, #0772df 0%, #102a6e 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0772df), color-stop(100%,#102a6e));
    background: -webkit-linear-gradient(top, #0772df 0%,#102a6e 100%);
    background: -o-linear-gradient(top, #0772df 0%,#102a6e 100%);
    background: -ms-linear-gradient(top, #0772df 0%,#102a6e 100%);
    background: linear-gradient(to bottom, #0772df 0%,#102a6e 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0772df', endColorstr='#102a6e',GradientType=0 );
    padding-top: 0px;
    display: inline-block;
}
.registerbtn {
    width: 45%;
    height: 52px;
    font-size: 16px !important;
    background-color: #4392c3;
    font-weight: bold;
    text-shadow: 1px 1px #4392c3;
    color: #ffffff;
    border-radius: 12px;
    -moz-border-radius: 12px;
    -webkit-border-radius: 12px;
    border: 2px solid #76e8e7;
    cursor: pointer;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    background: #76e8e7;
    background: -moz-linear-gradient(top, #76e8e7 0%, #4392c3 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#76e8e7), color-stop(100%,#4392c3));
    background: -webkit-linear-gradient(top, #76e8e7 0%,#4392c3 100%);
    background: -o-linear-gradient(top, #76e8e7 0%,#4392c3 100%);
    background: -ms-linear-gradient(top, #76e8e7 0%,#4392c3 100%);
    background: linear-gradient(to bottom, #76e8e7 0%,#4392c3 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#76e8e7', endColorstr='#4392c3',GradientType=0 );
    padding-top: 0px;
    display: inline-block;
	float: left;
}
.guestbtn {
    width: 49%;
    height: 52px;
    font-size: 16px !important;
    background-color: #faca68;
    font-weight: bold;
    text-shadow: 1px 1px #faca68;
    color: #ffffff;
    border-radius: 12px;
    -moz-border-radius: 12px;
    -webkit-border-radius: 12px;
    border: 2px solid #faca68;
    cursor: pointer;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    background: #faca68;
    background: -moz-linear-gradient(top, #faca68 0%, #f59831 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fce3bc), color-stop(100%,#f59831));
    background: -webkit-linear-gradient(top, #faca68 0%,#f59831 100%);
    background: -o-linear-gradient(top, #faca68 0%,#f59831 100%);
    background: -ms-linear-gradient(top, #faca68 0%,#f59831 100%);
    background: linear-gradient(to bottom, #faca68 0%,#f59831 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#faca68	', endColorstr='#7f0803',GradientType=0 );
    padding-top: 0px;
    display: inline-block;
	float: right;	
}
</style>
<body>
<?php include_once("modules/header.php"); ?>
<div id="slideWrap">
    <div class="hd">
        <ul></ul>
    </div>

    <div class="bd">
        <ul><!--轮播图片-->
            <li><img src="xmindex/images/index/1.jpg" /></a></li>
            <li><img src="xmindex/images/index/2.jpg" /></a></li>
            <li><img src="xmindex/images/index/3.jpg" /></a></li>
			<li><img src="xmindex/images/index/4.jpg" /></a></li>
			<li><img src="xmindex/images/index/5.jpg" /></a></li>
        </ul>
    </div>
</div>
<div class="notice-default clearfix row">
    <div class="col-xs-1"><img src="xmindex/images/icon-notice.png" width="20" style="position:absolute;top:6px;margin-left:8px;"/></div>
    <div class="col-xs-11"><marquee behavior="scroll" scrollamount="2" direction="left" style="height: 100%;" onMouseOut="this.start()" onMouseOver="this.stop()"><?=$list?></marquee>
    </div>
</div>
<?php include_once("games.php"); ?>
<?php include_once("modules/foot.php"); ?>
<?php include_once("modules/foots.php"); ?>
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
    <script src="xmindex/js/jquery-1.11.2.min.js"></script>
    <script src="xmindex/js/bootstrap.min.js"></script>
    <script src="xmindex/js/TouchSlide.1.1.js"></script>
    <script type="text/javascript">
        TouchSlide({
            slideCell: "#slideWrap",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "leftLoop",
            autoPlay: true,//自动播放
            autoPage: true //自动分页
        });
    </script>
</body>
</html>