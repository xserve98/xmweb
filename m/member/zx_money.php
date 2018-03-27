<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/lottery.inc.php");
include_once("../class/user.php");
include_once("../common/function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆

if($_GET["into"]=="true"){
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	sprintf("%.2f",$rows['money']);
	
	$money	 =	sprintf("%.2f",floatval($_POST["v_amount"]));
	$bank	 =	htmlEncode($_POST["IntoBank"]);
	$date	 =	htmlEncode($_POST["cn_date"]);
	$date1	 =	$date." ".$_POST["s_h"].":".$_POST["s_i"].":".$_POST["s_s"];
	$manner	 =	htmlEncode($_POST["InType"]);
	$address =	htmlEncode($_POST["v_site"]);
	
	if($manner == "网银转账" || $manner == "支付宝转账"){
		$manner .=	"<br />持卡人姓名：".htmlEncode($_POST["v_Name"]);
	}
	if($manner == "0"){
		$manner	=	htmlEncode($_POST["IntoType"]);
	}
	
	$sql	=	"Insert Into huikuan (money,bank,date,manner,address,adddate,status,uid,lsh,assets,balance) values ($money,'$bank','$date1','$manner','$address',now(),0,'".$uid."','".$_SESSION['username'].'_'.date("YmdHis")."',$assets,$assets)";
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit(); //事务提交
			message("恭喜您，汇款信息提交成功。\\n我们将尽快审核，谢谢您对".$web_site['reg_msg_from']."的支持。","data_h_money.php");
		}else{
			$mysqli->rollback(); //数据回滚
			message("对不起，由于网络堵塞原因。\\n您提交的汇款信息失败，请您重新提交。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("对不起，由于网络堵塞原因。\\n您提交的汇款信息失败，请您重新提交。");
	}
}

$sub = 7;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<META http-equiv="pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
</head>
<body>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/language/CN/main.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/patrn.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/login.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/util.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/account.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/conversion.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/register.js"></script>

<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css" />

<script type="text/javascript" src="/cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>  
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script> 
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/artDialog/skins/black.css"/>

<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>

<script type="text/javascript" src="/cscpLoginWeb/scripts/personalMsg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/report.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLotto.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportM8Sport.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLive.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportDsLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportOg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportBBIN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportYY.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportGG.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportPt.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportSg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAllBet.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportIg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/dialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/soltsPage.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/other-caiShenCP.js"></script>
<script type="text/javascript">
        //数字验证 过滤非法字符
        function clearNoNum(obj){
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != ''){
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value)) {
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }

        function showType() {
            var in_type = $("#InType");
            if(in_type.val() == '0') {
                $("#v_type").show().select();
                $("#tr_v").hide();
            } else if(in_type.val() == '网银转账' || in_type.val() == '支付宝转账') {
                $("#tr_v").show();
                $("#v_Name").val('请输入持卡人姓名').select();
                $("#v_type").hide();
                $("#IntoType").val(in_type.val());
            } else {
                $("#v_type").hide();
                $("#IntoType").val(in_type.val());
                $("#tr_v").hide();
            }
        }
        
		function showType1() {
            if($("#IntoBank").val() == "支付宝") {
                $("#InType").val("支付宝转账");
                showType();
            }
        }
		
        function SubInfo() {
			
            var v_amount = $("#amount");
			var hk = v_amount.val();
            if(hk == '') {
                alert('请输入转账金额');
                v_amount.focus();
                return false;
            } else {
				hk = hk * 1;
				if(hk < 100) {
					alert('转账金额最低为：100元');
                    v_amount.select();
					return false;
				}
			}
         
 
          
       $('form').submit(); 
        }
        //是否是中文
		function isChinese(str){
			return /[\u4E00-\u9FA0]/.test(str);
		}
	</script>
<div class="wraper">


	
	
		
			
			
				
					
						<div class="tit">
							<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>在线充值
							<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
						</div>
						<div style="height: 44px;"></div>
		














<script type="text/javascript">
jQuery(document).ready(function() {
	var isLogin = true;
	if (isLogin == true) {
		getBalance("MAIN_WALLET");
	}
});
</script>
<div class="info_head">
<div class="wrap_div bg2">
    <div class="container-fluid gm_main">
        <div class="wrap">
       <form action="http://www.xmcp.bid/mobao/pay.php"  method="post" onSubmit="return SubInfo();">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" class="mt10">
                   		<input name="uid"  value="<?=$_SESSION['uid']?>" type="hidden" class="textbox2">
					<input name="username"  value="<?=$_SESSION['username']?>" type="hidden" class="textbox2">
                    <tr>
                        <td class="bg" align="right">充值金额：</td>
                        <td><input name="amount" type="text" class="input_150" id="amount" onkeyup="clearNoNum(this);" maxlength="10"/></td>
                    </tr>
                 
                  
                    <tr>
                        <td class="bg" align="right">充值方式：</td>
                        <td>
                            <select id="choosePayType" name="choosePayType" onchange="showType();">
                                <option value="">==充值方式==</option>
                                <option value="4">支付宝</option>
                                <option value="5">微信</option>
                                <option value="">网银</option> 
                            </select>
                        
                        </td>
                    </tr>
                  
                   
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50">
                            <button name="SubTran" type="submit" class="submit_108" id="SubTran" >提交信息</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>