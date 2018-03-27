<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

if(strpos($_SESSION["username"],'guest_') ===true) {
	
    message(strpos($_SESSION["username"],'guest_'));
    exit;
}

//设置登录密码
if($_GET["action"]=="pass"){
	$oldpass=trim($_POST["oldpass"]);
	$newpass=trim($_POST["newpass"]);
	
    if($oldpass==""){
		message("请输入您的原登录密码");
	}
	if(strlen($newpass)<6 || strlen($newpass)>20){
		message("新登录密码只能是6-20位");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldpass,$newpass,'password')){
		message('登陆密码修改成功','password.php');
	}else{
		message('登陆密码修改失败，请检查您的输入','password.php');
	}
}

//设置取款密码
if($_GET["action"]=="moneypass"){
	$oldmoneypass=trim($_POST["oldmoneypass"]);
	$newmoneypass1=trim($_POST["newmoneypass1"]);
	$newmoneypass2=trim($_POST["newmoneypass2"]);
	$newmoneypass3=trim($_POST["newmoneypass3"]);
	$newmoneypass4=trim($_POST["newmoneypass4"]);
	$newmoneypass5=trim($_POST["newmoneypass5"]);
	$newmoneypass6=trim($_POST["newmoneypass6"]);
	$newmoneypass=$newmoneypass1.$newmoneypass2.$newmoneypass3.$newmoneypass4.$newmoneypass5.$newmoneypass6;
	
    if($oldmoneypass==""){
		message("请输入您的原取款密码");
	}
	if(strlen($newmoneypass)!=6){
		message("请选择6位新取款密码");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldmoneypass,$newmoneypass,'qk_pwd')){
		message('取款密码修改成功','password.php');
	}else{
		message('取款密码修改失败，请检查您的输入','password.php');
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
    <div class="wrap">
        <form action="?action=pass" method="post" name="form1" onsubmit="return check_submit_login();">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr>
                    <td colspan="2" class="tit">修改登录密码</td>
                </tr>
                <tr>
                    <td class="bg" width="22%" align="right">原登录密码：</td>
                    <td>
                        <input name="oldpass" type="password" class="input_150" id="oldpass" maxlength="20"/>
                        <span id="oldpass_txt" class="c_red" style="margin-left: 15px"></span>
                    </td>
                </tr>
                <tr>
                    <td class="bg" align="right">新登录密码：</td>
                    <td>
                        <input name="newpass" type="password" class="input_150" id="newpass" maxlength="20"/>
                        <span id="newpass_txt" class="c_red" style="margin-left: 15px">* <em class="c_blue">请输入6-20位新密码</em></span>
                    </td>
                </tr>
                <tr>
                    <td class="bg" align="right">确认新登录密码：</td>
                    <td>
                        <input name="newpass2" type="password" class="input_150" id="newpass2" maxlength="20"/>
                        <span id="newpass2_txt" class="c_red" style="margin-left: 15px">* <em class="c_blue">重复输入一次新密码</em></span>
                    </td>
                </tr>
                <tr>
                    <td class="bg" align="right"></td>
                    <td height="50"><button name="submit" type="submit" id="submit" class="submit_108">确认修改</button></td>
                </tr>
            </table>
        </form>
        <form action="?action=moneypass" method="post" name="form1" onsubmit="return check_submit_money();">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr>
                    <td colspan="2" class="tit">修改取款密码</td>
                </tr>
                <tr>
                    <td class="bg" width="22%" align="right">原取款密码：</td>
                    <td>
                        <input name="oldmoneypass" type="password" class="input_150" id="oldmoneypass" maxlength=""/>
                        <span id="oldmoneypass_txt" class="c_red" style="margin-left: 15px"></span>
                    </td>
                </tr>
                <tr>
                    <td class="bg" align="right">新取款密码：</td>
                    <td>
                        <select name="newmoneypass1" id="newmoneypass1">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <select name="newmoneypass2" id="newmoneypass2">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <select name="newmoneypass3" id="newmoneypass3">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <select name="newmoneypass4" id="newmoneypass4">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <select name="newmoneypass5" id="newmoneypass5">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <select name="newmoneypass6" id="newmoneypass6">
                            <option value="">--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <span id="newmoneypass_txt" class="c_red" style="margin-left: 15px">* <em class="c_blue">请输入6位新密码</em></span>
                    </td>
                </tr>
                <tr>
                    <td class="bg" align="right"></td>
                    <td height="50"><button name="submit" type="submit" id="submit" class="submit_108">确认修改</button></td>
                </tr>
            </table>
        </form>
        <!--div class="info">
            <p><strong>忘记密码？</strong></p>
            <p>如果您忘记了密码，请与客服联系。</p>
            <p>为了保证会员的资金安全，请您谅解要扫描身份证件验证您的身份。</p>
            <p>也请您放心，您的资料绝对保密，谢谢您对C8国际的支持！</p>
        </div-->
    </div>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>