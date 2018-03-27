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
$userinfo=user::getinfo($_SESSION["uid"]);

//设置银行卡信息
if($_GET["action"]=="save"){
	$pay_jifen=htmlEncode($_POST["pay_jifen"]);
	$qkpwd=htmlEncode($_POST["qkpwd"]);
	$vlcodes=$_POST["vlcodes"];
	
	if($vlcodes!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入");
	}
	$_SESSION["randcode"]=rand(10000,99999); //更换一下验证码
	 //验证取款密码
    $qk_pwd	=	md5($_POST["qkpwd"]);
    $qk_sql	=	"select uid,money,jifen from k_user where uid=$uid and qk_pwd='$qk_pwd'";
	$qk_query	=	$mysqli->query($qk_sql);  		
	$qk_rs		=	$qk_query->fetch_array();
	if(!$qk_rs){
		message('提款密码错误，请重新输入');
		exit();
	}
	if(!is_numeric($pay_jifen) || $pay_jifen<$web_site['jf_min']){
		message("请输入正确的积分,最低兑换".$web_site['jf_min'].'积分');
	}
	
	$pay_value	=	sprintf("%.2f",floatval($pay_jifen));
	if($pay_value<0){
		message('积分错误，请重新输入');
		exit();
	}
	if($userinfo["jifen"]<$pay_jifen){
		message('您的积分不足'.$pay_jifen.'，请重新输入');
		exit();
	}
	try{
		$order		=	$_SESSION['username']."_".date("YmdHis");
		$about=$pay_value.'积分兑换'.$pay_value.'元';
		$re=user::jifen_add($uid,$order,$about,$pay_value,3,'积分兑换');
		
		if($re){
			$mysqli->commit(); //事务提交
			message('兑换成功','set_jifen.php');
		}else{
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请失败。\\n请您稍候再试，或联系在线客服。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次申请失败。\\n请您稍候再试，或联系在线客服。");
	}
}
$sub = 6;
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
    <?php include_once("moneymenu.php"); ?>
    <form action="?action=save" method="post" name="form1" onsubmit="return check_submit_pay();">
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td class="bg" width="22%" align="right">会员账号：</td>
                <td class="c_red"><?=$_SESSION["username"]?></td>
            </tr>
            <tr>
                <td class="bg" align="right">当前余额：</td>
                <td class="c_red"><?=$userinfo["money"]?></td>
            </tr>
            <tr>
                <td class="bg" align="right">当前积分：</td>
                <td class="c_red"><?=$userinfo["jifen"]?></td>
            </tr>
            <tr>
                <td class="bg" align="right">兑换积分：</td>
                <td>
                    <input name="pay_jifen" type="text" class="input_150" id="pay_jifen"/>
                    <span class="c_red" style="margin-left: 15px">*</span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">取款密码：</td>
                <td>
                    <input name="qkpwd" type="password" class="input_150" id="qkpwd"/>
                    <span class="c_red" style="margin-left: 15px">*</span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">验证码：</td>
                <td>
                    <input name="vlcodes" type="text" class="input_80" id="vlcodes" maxlength="4"/>
                    <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="width:66px;height:22px;cursor:pointer;position:relative;bottom:1px" onclick="next_checkNum_img()" />
                    <span class="c_red" style="margin-left: 15px">*</span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right"></td>
                <td height="50">
                    <button name="submit" type="submit" id="submit" class="submit_108">确认提交</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="f_b">注意事项：</span><br>
                    1、兑换最低为<?=$web_site['jf_min']?>积分，没有上限。<br>
                    2、24小时任意时间，无限次数。<br>
                    3、积分兑换比例为1：1，即100积分兑换100元。<br>
                    4、积分兑换为即时自动到账。
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>