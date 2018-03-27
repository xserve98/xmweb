<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");

$_SESSION["uid"] = intval($_SESSION["uid"]);

$uid = $_SESSION["uid"];

$name='guest_'.rand(100000,999999);

?>

<?php
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);
			
while ($rs = $query->fetch_array()) {
    $msg = $rs['msg'];
	$msg2 = '<span class="listpart"><a href="javascript:void(0);" class="ShowNewsMore" article_id="">'.$rs['msg'].'</a></span><span class="time">'.$rs["add_time"].'</span>　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　';
}
?>

<?php
$sql = "select title from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);		
while ($rs = $query->fetch_array()) {
	$title = $rs['title'];
	$title1 = '<li id="notice_infoa_30"><span class="listpart"><a href="javascript:void(0);" class="ShowNews" notice_id="30">'.$rs['title'].'</a></span><span class="time"><font color="red"></font></span>';
}
?>

<?php
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);
			
while ($rs = $query->fetch_array()) {
    $msg = $rs['msg'];
	$msg22 = '<p>'.$rs['msg'].'</p>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title><?=$web_site['web_title']?></title>
    <meta name="Description" content="">
    <link href="login_files/login2.css" rel="stylesheet" type="text/css">
    <link href="login_files/style2.css" rel="stylesheet" type="text/css">
    <!--<script async="" src="login_files/analytics.js"></script>-->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="login_files/libs.js"></script>
    <script type="text/javascript" src="login_files/aff.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.login .code img').click(function(){
                $(this).attr('src','code?_='+(new Date()).getTime());
            });
            $('.fr.user_f').click(function(){
                $('.info.facode').slideToggle();
            })
        })
        function guestLogin() {
            $('.login input[name=account],.login input[name=password]').val('!guest!');
            $('.login form').submit();
        }
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-93117741-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body style="">
<div class="header">
    <a href="/"><img src="newdsn/images/small_logo.jpg" alt="">
    </a>
</div>
<div class="main">
    <div class="panel_2018">
        <div class="login">
            <form action="/login.php" method="post" onsubmit="check_login();">
                <div class="form_t">
                    <span class="fl user_t">用户登录</span>

                    <a  href="#" onclick="alert('暂未开放')" class="support"></a>
                </div>

                <input type="hidden" name="type" value="1">

                <div class="info username">
                    <label>账号：</label><input type="text" name="username" placeholder="请输入您的账号">
                </div>
                <div class="info password">
                    <label>密码：</label><input type="password" name="passwd" placeholder="您的密码">
                </div>

                <div class="info facode"><label>验证码</label><input type="text" name="facode" autocomplete="off" placeholder="二次验证码" maxlength="10"></div>
                <div class="login_bu">
                    <input type="submit" class="enter" value="登录"> <input type="button" class="reg" value="注册" onclick="location.href=&#39;register&#39;">
                    <input type="button" class="test" onclick="javaScript:alert('游客盘口只供试玩，与正式会员盘口无关!');top.location.href='/guest.php';" >
                </div>
            </form>
        </div>
        <div class="c_logo">

        </div>
    </div>
</div>
<script type="text/javascript">
    function check_login() {
        var frm = $("#loginForm");
        var opt = {
            beforeSubmit: function() {
                if($("#username").val() == "") {
                    layer.alert('请输入您的账号！', function(i) {
                        $("#username").focus();
                        layer.close(i);
                    });
                    return false;
                }
                if($("#passwd").val() == "") {
                    layer.alert('请输入您的密码！', function(i) {
                        $("#passwd").focus();
                        layer.close(i);
                    });
                    return false;
                }
                $("#loginBtn").attr("disabled", true);
            },
            success: function(data) {
                if(data.indexOf("3") >= 0) {
                    layer.alert('帐号异常无法登陆，如有疑问请联系在线客服！', function(i) {
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                        layer.close(i);
                    });
                } else if(data.indexOf("2") >= 0) {
                    layer.alert('账号或密码错误，请重新输入！', function(i) {
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                        layer.close(i);
                    });
                } else if(data.indexOf("1") >= 0) {
                    top.location.href = "/member/agreement";
                }
            }
        };
        frm.ajaxSubmit(opt);
        return false;
    }
</script>
