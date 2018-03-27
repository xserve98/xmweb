<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

if(@$_GET["save"]=="ok"){
	
	$agname=strtoupper($userinfo['zr_username']);

	//if($userinfo['is_sunbet']==0 && $userinfo['is_ag']==0){
		//message("未开通业务，不能转账");
		//exit;
	//}
	$zz_type=intval($_POST["zz_type"]);
    $zz_money=intval($_POST["zz_money"]);
	$old_type=$zz_type;
	switch ($zz_type) {
		case 1: $zz_type="tsun"; break;
		case 2: $zz_type="tag"; break;
		case 4: $zz_type="sunt"; break;
		case 5: $zz_type="sunag"; break;
		case 7: $zz_type="agt"; break;
		case 8: $zz_type="agsun"; break;
		
		//新增
		case 11: $zz_type="mainToGame"; break;
		case 21: $zz_type="gameToMain"; break;
		
	}
    if($zz_money<$web_site['zh_low'])
    {
        message("转账金额最低为：".$web_site['zh_low']."元，请重新输入");
    }else if($zz_money>$web_site['zh_high']){
        message("转账金额最高为：".$web_site['zh_high']."元，请重新输入");
	}
    else
    {
		$accountNow = accountNow();
		if($old_type==1||$old_type==2){
			if($accountNow<$zz_money){
				message("余额不足，请充值后再转帐！");
			}
		}
    }
}
$sub = 4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>额度转换</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript">
		//数字验证 过滤非法字符
        function clearNoNum(obj) {
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != '') {
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value)) {
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		
		function SubInfo() {
            var zz = $("#zz_money");
			var hk = zz.val();
			var fs = $('input[name="zz_type"]:checked').val();
			if(fs == '' || fs == null) {
				alert('请选择转帐方式！');
				return false;
			}
			if(hk == '') {
				alert('请输入转账金额');
				zz.focus();
				return false;
			} else {
				hk = hk * 1;
				if(hk < <?=$web_site['zh_low']?>) {
					alert('转账金额最低为：<?=$web_site['zh_low']?>元');
					zz.select();
					return false;
				} else if(hk > <?=$web_site['zh_high']?>) {
					alert('转账金额最高为：<?=$web_site['zh_high']?>元');
					zz.select();
					return false;
				}
			}
			$("#SubTran").val("转账提交中..");
			$('#form1').submit(); 
		}
	</script>
</head>
<body>
<div class="wrap">
    <?php include_once("moneymenu.php"); ?>
    <form id="form1" name="form1" action="/live/ed.php" method="post">
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td class="tit c_red" colspan="2">账户内部额度转账</td>
            </tr>
            <tr>
                <td class="bg" width="22%" align="right">用户账号：</td>
                <td class="c_red"><?=$userinfo['username']?></td>
            </tr>
            <tr>
                <td class="bg" align="right">余额：</td>
                <td class="c_red">
                    <span>[系统] <?=sprintf("%.2f",$userinfo["money"])?></span>
                    <?php
                    include_once("../live/config.php");
                    $sign = md5($plantform."_".$merID."_".$key."_".$_SESSION["username"]);
                    ?>
                    <?php
                    $yy = curl_file_get_contents($fenjieHost."/bb!balance.do?plantform=".$plantform."&username=".$_SESSION["username"]."&sign=".$sign);
                    $json = json_decode($yy);
                    ?>
                    <span style="margin-left: 15px">[BB真人] <?=sprintf("%.2f",$json->value)?></span>
                    <?php
                    $yy = curl_file_get_contents($fenjieHost."/ag!balance.do?plantform=".$plantform."&username=".$_SESSION["username"]."&password=".$password."&sign=".$sign);
                    $json = json_decode($yy);
                    ?>
                    <span style="margin-left: 15px">[AG] <?=sprintf("%.2f", $json->value)?></span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">转入：</td>
                <td>
                    <input type="radio" name="zz_type" value="11"/> 转入BB
                    <input type="radio" name="zz_type" value="12" style="margin-left: 15px"/> 转入AG
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">转出：</td>
                <td>
                    <input type="radio" name="zz_type" value="21"/> BB转出
                    <input type="radio" name="zz_type" value="22" style="margin-left: 15px"/> AG转出
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">转账金额：</td>
                <td><input name="zz_money" type="text" class="input_150" id="zz_money" onkeyup="clearNoNum(this);" maxlength="10"/></td>
            </tr>
            <tr>
                <td class="bg" align="right"></td>
                <td height="50">
                    <button name="SubTran" type="button" class="submit_108" id="SubTran" onclick="SubInfo();">确认转账</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="f_b">提示：</span><br/>
                    1、主帐额度无需转换即可玩体育、彩票。<br/>
                    2、电子转出请先退出所有电子游戏房间在进行转出操作，否则无法转出。
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