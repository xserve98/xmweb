<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");	

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$user=user::getinfo($_SESSION["uid"]);
$sub = 1;
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs2	 =	$query->fetch_array();
$sqlb="select sum(money) as sum_money from c_bet where uid = '$uid' and js=0 group by uid ";
$query	 =	$mysqli->query($sqlb);
$rs1	 =	$query->fetch_array();

if($_GET["into"]=="true"){
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	sprintf("%.2f",$rows['money']);
	$money	 =	sprintf("%.2f",floatval($_POST["v_amount"]));
	$bank	 =	'银行转账';
	$date	 =	htmlEncode($_POST["cn_date"]);
	$date1	 =	$date." ".$_POST["s_h"].":".$_POST["s_i"].":".$_POST["s_s"];
	$manner	 =	htmlEncode($_POST["InType"]);
	$address =	htmlEncode($_POST["v_site"]);
	
	if($manner == "网银转账"){
		$manner .=	"<br />持卡人姓名：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "微信支付") {
		$manner .=	"<br />微信昵称：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "支付宝转账") {
		$manner .=	"<br />支付宝昵称：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "0"){
		$manner	=	htmlEncode($_POST["IntoType"]);
	}
	$orderid = date('YmdHis',time());
	
	$sql	=	"Insert Into huikuan (orderid,cztype,money,bank,date,manner,address,adddate,status,uid,lsh,assets,balance) values ('$orderid',0,$money,'$bank','$date1','$manner','$address',now(),0,'".$uid."','".$_SESSION['username'].'_'.date("YmdHis")."',$assets,$assets)";
	
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
<html class="no-js" lang=""><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
        <link rel="stylesheet" href="/newdsn/css/admin.css">
        <link type="text/css" rel="stylesheet" href="images/member.css"/>
        <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="/js/laydate/laydate.min.js"></script><link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css"><link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
        <script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
        <script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
		<script type="text/javascript" src="/js/dialog.js"></script>
		<script type="text/javascript" src="/js/libs.js"></script>
		<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
		<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
		<script type="text/javascript">var MIN_AMOUNT=<?=$web_site['ck_limit']?>;</script>
		<script type="text/javascript" src="/newdsn/js/cash/deposit.js"></script>
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
            } else if(in_type.val() == '网银转账') {
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
            var v_amount = $("#v_amount");
			var hk = v_amount.val();
            if(hk == '') {
                alert('请输入转账金额');
                v_amount.focus();
                return false;
            } else {
				hk = hk * 1;
				var webhk=<?= $web_site['ck_limit']?>;
				
		
				if(hk < webhk) {
					alert('转账金额最低为：'+webhk+'元');
                    v_amount.select();
					return false;
				}
			}
            if($("#IntoBank").val() == '') {
                alert('为了更快确认您的转账，请选择汇款银行');
                $("#IntoBank").focus();
                return false;
            }
            if($("#cn_date").val() == '') {
                alert('请选择汇款日期');
                $("#cn_date").focus();
                return false;
            }
            if($("#InType").val() == '') {
                alert('为了更快确认您的转账，请选择汇款方式');
                $("#InType").focus();
	            return false;
            }
            if($("#InType").val() == '0') {
                if($("#v_type").val() != '' && $("#v_type").val() != '请输入其它汇款方式') {
                    $("#IntoType").val($("#v_type").val());
                } else {
                    alert('请输入其它汇款方式');
					$("#v_type").focus();
                    return false;
                }
            }
            if($("#InType").val() == '网银转账') {
                if($("#v_Name").val() != '' && $("#v_Name").val() != '请输入持卡人姓名' && $("#v_Name").val().length > 1 && $("#v_Name").val().length < 20) {
                    var tName = $("#v_Name").val();
                    var yy = tName.length;
                    for(var xx = 0; xx < yy; xx++) {
                        var zz = tName.substring(xx, xx + 1);
                        if(zz != '·') {
                            if(!isChinese(zz)){
                                alert('请输入中文持卡人姓名，如有其他疑问，请联系在线客服');
                                $("#v_Name").focus();
	                            return false;
                            }
                        }
                    }
                } else {
                    alert('为了更快确认您的转账，网银转账请输入持卡人姓名');
                    $("#v_Name").focus();
                    return false;
                }
            }
            if($("#v_site").val() == '') {
                alert('请填写汇款地点');
                $("#v_site").focus();
                return false;
            }
            if($("#v_site").val().length > 50) {
                alert('汇款地点不要超过50个中文字符');
                $("#v_site").focus();
                return false;
            }
            $('#form1').submit(); 
        }
        //是否是中文
		function isChinese(str){
			return /[\u4E00-\u9FA0]/.test(str);
		}
	</script>
    <style type="text/css">
body,li{list-style:none; font-family: "微软雅黑";}
.skl_contens{
	background-color: #FFF;
	width: 820px;
	min-height:500px; 
	height:auto!important; 
	box-shadow: 0px 3px 10px #0070A6;
	margin-right: auto;
	margin-left: auto;
	margin-top: 20px;
	border-radius: 6px;
	margin-bottom: 50px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;	
}
p{ color: #0B48FF; 	margin-top: 6px;	margin-bottom: 6px;}
.buttonStyle {
	border: 2px solid #D7DCFF;
	color: #FFF;
	font-size: 18px;
	cursor: pointer;
	background-attachment: scroll;
	background-color: #6A7DFF;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	padding-top: 5px;
	padding-right: 18px;
	padding-bottom: 5px;
	padding-left: 18px;
	border-radius: 5px;
}

.moneyBox{

	height: auto;
	float: left;
	width: 820px;
	padding-top: 10px;
	padding-bottom: 10px;
}
.moneyBox li{
	font-size: 16px;
	float: left;
	height: auto;
	width: 80px;
	margin-right: 15px;
	border: 1px double #C4DEFF;
	border-radius: 5px;
	text-align: center;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	margin-bottom: 15px;
	cursor: pointer;
	color: #333;
}
.selectli{
	background-image: url(/shoukuanla/images/select.png);
	background-repeat: no-repeat;
	background-position: right bottom;
	background-color: #E1F5FF;
}

.moneyBox2 li{
	font-size: 16px;
	float: left;
	height: auto;
	width: 80px;
	margin-right: 15px;
	border: 1px double #C4DEFF;
	border-radius: 3px;
	text-align: center;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	margin-bottom: 15px;
	margin-top: 3px;
	cursor: pointer;
	color: #333;
}
.selectli2{
	background-image: url(/shoukuanla/images/select.png);
	background-repeat: no-repeat;
	background-position: right bottom;
	background-color: #E1F5FF;
}
.payBox{

	height: auto;
	
	width: 820px;
	padding-top: 10px;
	padding-bottom: 10px;	
}
.payBox li{
	font-size: 16px;
	float: left;
	height: auto;
	width: 80px;
	margin-right: 15px;
	border: 1px double #C4DEFF;
	border-radius: 5px;
	text-align: center;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	margin-bottom: 15px;
	cursor: pointer;
	color: #333;
}
.gediv{
    height:20px;width: 820px;float: left;
}

</style>

    
    </head>
    <body id="bodyid" class="skin_blue" style="height:600px">
 <?php include_once("moneymenu.php"); ?>
                <div class="rightpanel">
                <div class="contentcontainer">
					<div class="row">
                            <div class="stepitm stepactive" style="z-index: 3;">
                              <div class="stepnotxt">01 选择支付模式</div>
                                <div class="hlfcircle hlfcircleactive"></div>
                            </div>
                            <div class="stepitm" style="z-index: 2;">
                              <div class="stepnotxt">02 填写金额</div>
                              <div class="hlfcircle"></div>
                            </div>
                            <div class="stepitm" style="z-index: 1;">
                              <div class="stepnotxt">03 选择银行</div><div class="hlfcircle"></div>
                            </div>
                            <div class="stepitm" style="z-index: 0;">
                              <div class="stepnotxt">04 充值到账</div>
                            </div>
                        
               	  </div>
                  <div class="row mt10">
              		<div class="messagetxt">选择充值模式：</div>
                    <a href="javascript:void(0);" class="tabnavi tabnaviactive">第三方支付宝</a>
                    <a href="javascript:void(0);" class="tabnavi ">第三方微信</a>
                    <a href="javascript:void(0);" class="tabnavi ">第三方网银</a>
					<a href="javascript:void(0);" class="tabnavi ">微信扫码</a>
                    <a href="javascript:void(0);" class="tabnavi ">支付宝扫码</a>
					<a href="javascript:void(0);" class="tabnavi "  style="width: 150px">支付宝/微信转帐</a>
                   
              	  </div>
                  <div class="row" style="overflow: visible;">
                  
                  		<!-- tabbox1 -->
                        
                        <div class="tabbox clearfix subcontent" style="display: block;">
						  <form action="/gybpay/send.php"  target="_blank" method="post" onSubmit="return doDeposit(this,-1);">
						 <input name="uid"  value="<?=$_SESSION['uid']?>" type="hidden" class="textbox2">
					<input name="username"  value="<?=$_SESSION['username']?>" type="hidden" class="textbox2">
                         <input name="choosePayType"  value="4" type="hidden" class="textbox2">
                          <div class="row">
                                    <div class="col1">充值金额：</div>
                                    <div class="col2"><input name="amount" onKeyPress="return isNumber(event)" type="text" class="textbox2">
                                    <img src="/newdsn/images/admin/warningsmallicon.jpg" class="mt4 ml10"> <div class="pink mt4">请输入充值金额，最低金额 <?= $web_site['ck_limit']?> 元</div></div>
                          </div>
                          <div class="row clearfix">
                                    <div class="col1">银行种类：</div>
                            <div class="col2">
                                <div class="selectbox">
                                            <input type="radio" id="NOCARD" name="payId" value="992" class="mt4" checked="checked" >
                                            <div class="sprite ico-zfb"></div>
                                            <div>支付宝</div>
                                </div>
                            </div>
                            
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							<div class="col2"><span style="color: red">* 单笔充值最高5000，手机支付须保存二维码，用支付宝扫一扫选择相册二维码即可支付。</span></div>
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2">
                                <button class="btnsubmit">开始充值</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        <div class="tabbox clearfix subcontent">
							  <form action="/gybpay/send.php"  target="_blank" method="post" onSubmit="return doDeposit(this,-1);">
						<input name="uid"  value="<?=$_SESSION['uid']?>" type="hidden" class="textbox2">
					<input name="username"  value="<?=$_SESSION['username']?>" type="hidden" class="textbox2">
                           <input name="choosePayType"  value="5" type="hidden" class="textbox2">
                          <div class="row">
                                    <div class="col1">充值金额：</div>
                                    <div class="col2"><input name="amount" onKeyPress="return isNumber(event)" type="text" class="textbox2">
                                    <img src="/newdsn/images/admin/warningsmallicon.jpg" class="mt4 ml10"> <div class="pink mt4">请输入充值金额，最低金额 <?= $web_site['ck_limit']?> 元</div></div>
                          </div>
                          <div class="row clearfix">
                                    <div class="col1">银行种类：</div>
                            <div class="col2">
                                <div class="selectbox">
                                            <input type="radio" id="wx" name="payId" value="1004" class="mt4" checked="checked">
                                            <div class="sprite ico-wxzf"></div>
                                            <div>微信支付</div>
                                </div>
                            </div>
                            
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							<div class="col2"><span style="color: red">* 单笔充值最高5000，手机支付须保存二维码，用微信扫一扫选择相册二维码即可支付。</span></div>
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2">
                                <button class="btnsubmit">开始充值</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        <div class="tabbox clearfix subcontent">
							  <form action="/gybpay/send.php" target="_blank" method="post" onSubmit="return doDeposit(this,-1);">
					<input name="uid"  value="<?=$_SESSION['uid']?>" type="hidden" class="textbox2">
					<input name="username"  value="<?=$_SESSION['username']?>" type="hidden" class="textbox2">
			<input name="choosePayType"  value="" type="hidden" class="textbox2">
                          <div class="row">
                                    <div class="col1">充值金额：</div>
                                    <div class="col2"><input name="amount" onKeyPress="return isNumber(event)" type="text" class="textbox2">
                                    <img src="/newdsn/images/admin/warningsmallicon.jpg" class="mt4 ml10"> <div class="pink mt4">请输入充值金额，最低金额 <?= $web_site['ck_limit']?> 元</div></div>
                          </div>
                          <div class="row clearfix">
                                    <div class="col1">银行种类：</div>
                            <div class="col2">
                                <div class="selectbox">
                                            <input type="radio" id="ICBC" name="payId" value="967" class="mt4" checked="checked">
                                           <div class="sprite ico-zjcb"></div>
                                            <div>工商银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CCB" name="payId" value="965" class="mt4">
                                            <div class="sprite ico-ccb"></div>
                                            <div>建设银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="ABC" name="payId" value="964" class="mt4">
                                            <div class="sprite ico-abc"></div>
                                            <div>农业银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="COMM" name="payId" value="981" class="mt4">
                                            <div class="sprite ico-boco"></div>
                                            <div>交通银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="BOC" name="payId" value="963" class="mt4">
                                            <div class="sprite ico-boc"></div>
                                            <div>中国银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CEB" name="payId" value="986" class="mt4">
                                            <div class="sprite ico-cebb"></div>
                                            <div>光大银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CMBC" name="payId" value="980"  class="mt4">
                                            <div class="sprite ico-cmbc"></div>
                                            <div>民生银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="PSBC" name="payId" value="971"  class="mt4">
                                            <div class="sprite ico-post"></div>
                                            <div>邮政银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CMB" name="payId" value="970" class="mt4">
                                            <div class="sprite ico-cmb"></div>
                                            <div>招商银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CIB" name="payId" value="972"  class="mt4">
                                            <div class="sprite ico-cib"></div>
                                            <div>兴业银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="CNCB" name="payId" value="962" class="mt4">
                                            <div class="sprite ico-cccb"></div>
                                            <div>中信银行</div>
                                </div>
                  
                                <div class="selectbox">
                                            <input type="radio" id="HXB" name="payId" value="982" class="mt4">
                                            <div class="sprite ico-hxb"></div>
                                            <div>华夏银行</div>
                                </div>
                                <div class="selectbox">
                                            <input type="radio" id="PAB" name="payId" value="978" class="mt4">
                                            <div class="sprite ico-pab"></div>
                                            <div>平安银行</div>
                                </div>
                            </div>
                            
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2">
                                <button class="btnsubmit">开始充值</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        
                        

                        
                          <div class="tabbox clearfix subcontent">
                          <div class="row" style="display:none">
                                    <div class="col1">充值金额：</div>
                                    <div class="col2"><input name="amount" onkeypress="return isNumber(event)" type="text" class="textbox2">
                                    <img src="/newdsn/images/admin/warningsmallicon.jpg" class="mt4 ml10"> <div class="pink mt4">最低金额 <?= $web_site['ck_limit']?> 元<span style="color:blue">(大额充值请使用公司入款方式)</span></div></div>
                          </div>
                          <div class="row clearfix">
                                    <div class="col1">银行种类：</div>
                            <div class="col2">
                                <div class="selectbox" style="width:130px">
									<input type="radio" id="payId18" name="payId_18" value="<?=$_SESSION['uid']?>" class="mt4" checked="">
									<div class="sprite ico-wxzf"></div>
									<div>微信支付</div>
									
                                </div>
                            </div>
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2"><button onclick="doDeposit(this,1)" class="btnsubmit">开始充值</button></div>
                            </div>
                        </div>
                        
                         <div class="tabbox clearfix subcontent">
                          <div class="row" style="display:none">
                                    <div class="col1">充值金额：</div>
                                    <div class="col2"><input name="amount" onkeypress="return isNumber(event)" type="text" class="textbox2">
                                    <img src="/newdsn/images/admin/warningsmallicon.jpg" class="mt4 ml10"> <div class="pink mt4">最低金额10元，最高金额10000元<span style="color:blue">(大额充值请使用公司入款方式)</span></div></div>
                          </div>
                          <div class="row clearfix">
                                    <div class="col1">银行种类：</div>
                            <div class="col2">
                                <div class="selectbox" style="width:130px">
									<input type="radio" id="payId21" name="payId_21" value="13005" class="mt4" checked="">
									<div class="sprite ico-zfb"></div>
									<div>支付宝</div>
                                </div>
                            </div>
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2"><button onclick="doDeposit(this,0)" class="btnsubmit">开始充值</button></div>
                            </div>
                        </div>
						
						<div class="tabbox clearfix subcontent">
                          <form target="_blank" action="/shoukuanla/index.php?a=insert" method="post">
						  <input type="hidden" name="pid" value="42A9861EB39204AEE0530100007F8047">
			              <input type="hidden" name="oid" value="1ae34dd6d73232024cdb75c287f2662ee8ccdf9e">
                         <input name="uid"  value="<?=$_SESSION['uid']?>" type="hidden" class="textbox2">
                          <div class="row">
<div class="moneyBox">

<li money-type="0" data-value="10" class="">￥10元</li>
<li money-type="0" data-value="50" class="">￥50元</li>
<li money-type="0" data-value="100" class="">￥100元</li>
<li money-type="0" data-value="200" class="">￥200元</li>
<li money-type="0" data-value="500" class="">￥500元</li>
<li money-type="0" data-value="1000" class="">￥1000元</li>
<!--li money-type="0" data-value="2000">￥2000元</li>
<li money-type="0" data-value="5000" class="">￥5000元</li>
<li money-type="0" data-value="10000" class="selectli">￥10000元</li>
<li money-type="0" data-value="15000" class="">￥15000元</li>
<li money-type="0" data-value="20000" class="">￥20000元</li>
<li money-type="0" data-value="30000" class="">￥30000元</li>
<li money-type="0" data-value="45000" class="">￥45000元</li-->
<li money-type="1">
<input money-type="1" style="font-size: 16px;width:75px;height:22px;color: #666;" name="skl_custom_money" type="text" value="其他金额">
</li>
	


	
<input type="hidden" id="skl_money" name="price" value="300">
<input type="hidden" name="skl_money_type" value="0">

</div>
                                    
                                    </div>
                      
                          
                          <div class="row clearfix">
                                    <div class="col1">支付方式：</div>
                    <div class="payBox">

<li data-emailkey="seller_email" data-titlekey="out_trade_no" data-moneykey="price" data-payalias="alipay" class="selectli">支付宝支付</li>
<li data-emailkey="" data-titlekey="out_trade_no" data-moneykey="price" data-payalias="wxpay">微信支付</li>
<!--li data-emailkey="" data-titlekey="out_trade_no" data-moneykey="price" data-payalias="tenpay">财付通</li-->

<input type="hidden" name="payType" value="alipay">

</div>
                            
                          </div>
						  <div class="row smtxt">
							<div class="col1"></div>
							<div class="col2"><span style="color: red">* 请用户充值时：优先按上面固定金额充值，若充值金额不在固定金额范围内,请选择（其它金额），请注意：其它金额 充值方式必须按（指定金额)付款才能自动加余额.出现小数点。只为了识别使用.并不是手续费！！。</span></div>
							</div>
                          <div class="row mt15">
                                <div class="col1"></div>
                                <div class="col2">
                                <button class="btnsubmit">开始充值</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        
                        
                     
                        
                        
                        
                  </div>
                  
              </div>

          </div>
    
    
 <script type="text/javascript">
$(function($) {

 //选择金额
 allMoneyLi=$(".moneyBox li");
 skl_money=$("input[id='skl_money']");
 skl_custom_money=$("input[name='skl_custom_money']");
 skl_otherMoney="其他金额";

 allMoneyLi.click(function(){	  
	  
	//先移除样式
	allMoneyLi.removeClass("selectli");
	
	thisLi=$(this);
	thisLi.addClass("selectli");
	
var jine= skl_money.val(thisLi.attr("data-value"));
if(jine<Math.max(MIN_AMOUNT, 1)){
	  dialog.error("错误", "充值金额最少为" + Math.max(MIN_AMOUNT, 1) + "元")
	
	
	}

	$("input[name='skl_money_type']").val(thisLi.attr("money-type"));
	 
  });
  
  
 //选择支付方式
 allPayLi=$(".payBox li");

 allPayLi.click(function(){	  
	  
	//先移除样式
	allPayLi.removeClass("selectli");
	
	thisPayLi=$(this);
	thisPayLi.addClass("selectli");
	

	$("input[name='payType']").val(thisPayLi.attr("data-payAlias"));
	
	//改变seller_email键
	$("input[id='seller_email']").attr("name",thisPayLi.attr("data-EmailKey"));	
	
	//改变money键	
	skl_money.attr("name",thisPayLi.attr("data-MoneyKey"));
	 
  }); 
 
		//获得焦点
	skl_custom_money.focus(function(){
    if(skl_custom_money.val() == skl_otherMoney){
		  skl_money.val(skl_custom_money.val(""));
		}
		
	});

	//焦点离开
	skl_custom_money.focusout(function(){
		skl_money.val(skl_custom_money.val());
	});	
  
  //显示默认金额
  allMoneyLi.first().click();
  
  //显示默认的支付方式  
  allPayLi.eq(0).click() 
//alert(addds);
 });
</script>
   
</body></html>