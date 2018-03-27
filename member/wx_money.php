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
$sub = 1;
$amount=$_GET['amount'];

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
	
	if($manner == "微信转帐") {
	   $manner .= "微信昵称：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "0"){
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
			message("恭喜您，汇款信息提交成功。\\n我们将尽快审核，谢谢您对".$web_site['reg_msg_from']."的支持。");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>订单信息</title>
<link rel="stylesheet" href="/js/jquery-ui/styles/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/cash/master.css">
<link rel="stylesheet" href="/newdsn/css/cash/style.css">
<link rel="stylesheet" href="/newdsn/css/cash/popup.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/cash2/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/deposit.js?v=0210"></script>
<script type="text/javascript" src="/dinpayjs/jquery.qrcode.js"></script>
<script type="text/javascript" src="/dinpayjs/utf.js"></script>
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
		function SubInfo() {
			if($('#v_Name').val()=='') {
				alert('请输入转账的微信昵称！');
				$('#v_Name').focus();
                return false;
			}
			var hk = $('#v_amount').val();
            if(hk==''){
                alert('请输入实际的转账金额！');
                $('#v_amount').focus();
                return false;
            }else{
				hk = hk*1;
				if(hk<10){
					alert('转账金额最低为10元！');
					$('#v_amount').select();
					return false;
				}
			}
			$('#form1').submit();
		}
	</script>
</head>
<body>
	<div class="popup">
		<div class="popupinternal order-submit2">
			<div class="col-left">
				<p>请用微信扫描下面的二维码</p>
				<form id="form1" method="post" action="wx_money.php?into=true" name="form1">
				<div class="bank-info1">
					<div id="showqrcode" style="margin-top:10px;margin-left:42px;"><img src="/xmindex/img/wx.jpg" height="200" width="200"></div>
				</div>
				<br/>
				<div class="three-second">
					<h4>转账信息</h4>
					<p>昵称：<input name="v_Name" type="text" class="input_150" id="v_Name" onkeyup="clearNoNum(this);" maxlength="8" placeholder="填写微信昵称"/></input></p>
					<p>金额：<input name="v_amount" type="text" class="input_150" id="v_amount" onkeyup="clearNoNum(this);" maxlength="10" placeholder="填写付款金额"/></input></p>
					<div class="post-info">
					</div>
					<input type="hidden" id="userName" value="UN"/>
				</div>
			</div>
			<div class="col-right">
				<div class="jc-info" style="position:relative;top:-28px;">
					<h4>如何充值：</h4>
					<p>请用微信扫描左侧二维码，转账给<br>财务号，并且在留言附上您的会员账号<br>例：会员账号：AAA123，充值金额为500元；请转账500元给财务号，并且请<br>留言AAA123，即可帮您充值500元。</p>
				</div><br>
				<img style="position:relative;top:-25px;margin:2 0 0 0;padding:2 0 0 0;height:188px;width:245px" src="/newdsn/images/wxtips.jpg">
			</div>
			<div class="fullwidth" style="position:relative;top:-28px;">
				<div class="container">
				   <input type="hidden" name="IntoBank" value="微信支付" />
					<input type="hidden" name="InType" value="微信支付" />
					<input type="hidden" name="v_site" value="" />
					<button name="SubTran" type="button" class="btn-blue button" id="SubTran" onclick="SubInfo();">提交订单</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/default/js/cash2/deposit.js"></script>
</body>
</html>