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
$user=user::getinfo($_SESSION["uid"]);
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs2	 =	$query->fetch_array();
$sqlb="select sum(money) as sum_money from c_bet where uid = '$uid' and js=0 group by uid ";
$query	 =	$mysqli->query($sqlb);
$rs1	 =	$query->fetch_array();
//设置银行卡信息
if($_GET["action"]=="save"){
	$pay_card=htmlEncode($_POST["pay_card"]);
	$pay_num=htmlEncode($_POST["pay_num"]);
	$pay_address=htmlEncode($_POST["pay_address"]);
	$vlcodes=$_POST["vlcodes"];

    if($pay_card==""){
		message("请输入您的收款银行");
	}
	if($pay_num==""){
		message("请输入您正确的银行账号");
	}
	if($pay_address==""){
		message("请输入您的开户行地址");
	}
	
	if(user::update_paycard($_SESSION["uid"],$pay_card,$pay_num,$pay_address,$user["pay_name"],$_SESSION["username"])){
		message('恭喜你，银行绑定成功','get_money.php');
		exit();
	}else{
		message('设置出错，请重新设置你的银行卡信息','set_card.php');
	}
}
 
?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?=$web_site['web_name']?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.theme.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script><link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css"><link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
<script type="text/javascript">var MIN_AMOUNT=100;</script>
<script type="text/javascript" src="/newdsn/js/cash/draw.js?v=0122"></script>
</head>
<body id="bodyid" class="skin_blue">
 <?php include_once("moneymenu.php"); ?>
	<div class="rightpanel">
		<div class="contentcontainer">
			<div class="row">
				<div class="stepitm stepactive" style="z-index: 3;">
					<div class="stepnotxt">01 提交</div>
					<div class="hlfcircle hlfcircleactive"></div>
				</div>
				<div class="stepitm" style="z-index: 2;">
					<div class="stepnotxt">02 审核</div>
					<div class="hlfcircle"></div>
				</div>
				<div class="stepitm" style="z-index: 1;">
					<div class="stepnotxt">03 出款</div>
					<div class="hlfcircle"></div>
				</div>
				<div class="stepitm" style="z-index: 0;">
					<div class="stepnotxt">04 到账</div>
				</div>

			</div>
			 
			<div class="row mt10">
				<a href="javascript:void(0);" class="tabnavi tabnaviactive">绑定银行卡</a>
			</div>
			<div class="tabbox clearfix" style="display: block;">
				<div id="card_h">
					<div class="margincenter mt15 warningicon"></div>
					<p class="warningtxt">添加一张银行卡开始提款吧</p>
					<div class="warningtxt">
						<img src="/newdsn/images/addbankcard.jpg" width="214" height="112" alt="">
					</div>
				</div>
				<div class="formpanel margintop20" id="card_s" style="display: none;">
                  <form action="?action=save" method="post" name="form1" onSubmit="return check_submit_pay();">
					<div class="middlecontainer mt15">
						<div class="row">
							<div class="col1">选择银行：</div>
							<div class="col2_s"><select name="pay_card"  id="pay_card"  class="select1">
	<option value="" selected="selected">请选择银行</option>
        <option value="支付宝">支付宝</option>
        <option value="财付通">财付通</option>
        <option value="工商银行">工商银行</option>
        <option value="建设银行">建设银行</option>
        <option value="农业银行">农业银行</option>
        <option value="交通银行">交通银行</option>
        <option value="中国银行">中国银行</option>
        <option value="光大银行">光大银行</option>
        <option value="民生银行">民生银行</option>
        <option value="邮政银行">邮政银行</option>
        <option value="招商银行">招商银行</option>
        <option value="兴业银行">兴业银行</option>
        <option value="中信银行">中信银行</option>
        <option value="广发银行">广发银行</option>
        <option value="浦发银行">浦发银行</option>
        <option value="华夏银行">华夏银行</option>
        <option value="平安银行">平安银行</option>
        <option value="上海银行">上海银行</option>
        <option value="北京银行">北京银行</option>
        <option value="郑州银行">郑州银行</option>
        <option value="恒丰银行">恒丰银行</option>
        <option value="渤海银行">渤海银行</option>
		<option value="农村信用社">农村信用社</option>

</select>
<span style="color:red">*提款请选择对应名称</span>
</div>
						</div>
						<div class="row">
							<div class="col1">持卡人姓名：</div>
							<div class="col2">
								<input type="text" class="textbox3 textbox2" value="<?=$rs2['pay_name']?>" readonly><soan style="font-size: 12px;color: red;">*与您注册时留的姓名必须一致，如有疑问联系客服。</span>
							
							</div>
						</div>
						<div class="row">
							<div class="col1">银行卡号：</div>
							<div class="col2">
								<input type="text" name="pay_num"  id="pay_num" class="textbox3 textbox2"><span style="color:red">*支付宝，直接填写手机号或者邮箱号！</span>
							</div>
						</div>
						<div class="row">
							<div class="col1">开户网点：</div>
							<div class="col2">
								<input type="text" name="pay_address"  id="pay_address" class="textbox3 textbox2"><span style="color:red">*支付宝，直接填写支付宝</span>
							</div>
						</div>
						<div class="row">
							<div class="col1">&nbsp;</div>
							<div class="col2">
								<input type="submit" class="btnsubmit"  value="提交">
							</div>
						</div>
					</div>
                      </form>
				</div>
			</div>
			 		</div>
                    
	</div>
</body>
</html>