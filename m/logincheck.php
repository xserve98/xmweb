<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/mysqli.php");
include_once("class/user.php");
include_once("common/function.php");
if($_POST["act"] == "login") {
    $uid = user::login(htmlEncode($_POST["username"]), htmlEncode($_POST["passwd"]), htmlEncode($_POST["code"]));
    if(!$uid) {
        //echo '2'; //用户名或密码错误
		echo "<script>alert(\"用户名或密码错误！\");location.replace('/user/login');</script>";
        exit;
    }
    //echo '1'; //成功
	echo "<script>location.replace('/member/index');</script>";
    exit;
}
$f_class = ' abs';
?>
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