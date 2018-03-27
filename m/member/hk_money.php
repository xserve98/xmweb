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
			message("恭喜您，汇款信息提交成功。\\n我们将尽快审核，谢谢您对".$web_site['reg_msg_from']."的支持。","/hk_money");
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
    <title>会员存款</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
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
            var v_amount = $("#v_amount");
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
            if($("#InType").val() == '网银转账' || $("#InType").val() == '支付宝转账') {
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
            $('form1').submit(); 
        }
        //是否是中文
		function isChinese(str){
			return /[\u4E00-\u9FA0]/.test(str);
		}
	</script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
</head>
<body class="bodyColorW">
















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
	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>公司汇款
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

						<div class="wrap_div bg2">
							<div class="account_wrap wrap bb bs">
								<div class="info_con ico2">01 请选择以下公司账号进行转账汇款</div>
								<div class="info_tab01">
                <?php
                include_once("../../cache/bank.php");
                foreach($bank[$_SESSION["gid"]] as $k=>$arr) {
                    ?>
											<div class="bankKardInfo ScanCode" >
												<label>
													<table width="100%" border="0"  >
														<tbody>
															<tr>
																<td width="20%"><em class="c_blue">开户名：</em></td>
																<td width="*"><em class="c_red"><?=$arr['card_userName']?></em></td>
															</tr>
															<tr>
																<td><em class="c_blue">银　行：</em></td>
																<td><em class="c_red"><?=$arr['card_bankName']?></em></td>
															</tr>
															<tr>
																<td><em class="c_blue">卡　号：</em></td>
																<td><em class="c_red"><?=$arr['card_ID']?></em></td>
															</tr>
															<tr>
																<td><em class="c_blue">开户行：</em></td>
																<td><em class="c_red"><?=$arr['card_address']?></em></td>
															</tr>
														</tbody>
													</table>
												</label>
												</div>
											</div>
											<?php } ?>
											

	<div class="wrap_div pa10 bb info_text">
	<p>温馨提示</p>
	<span>1、在金额转出之后请务必填写该页下方的汇款信息表格，以便财务系统能够及时的为您确认并添加金额到您的会员帐户中。<br/><br/>
	<!-- 2、本公司最低存款金额为10元，公司财务系统将对银行存款的会员按实际存款金额实行返利派送。 <br/><br/>
		 3、跨行转帐请您使用跨行快汇。 --></span>
	<span>2、请避免存入个位数为零0金额，便于区别您的入款（例如51，204，3001，10008等等）。谢谢大家的支持与配合！</span></div>
	
    		<div class="info_con ico2">02 填写汇款单</div>
			<div class="wrap">
            <form id="form1" name="form1" action="?into=true" method="post">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" class="mt10">
                    <tr class="tic c_red f_b">
                        <td colspan="2">请认真填写以下汇款单</td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">用户账号：</td>
                        <td class="c_blue"><?=$_SESSION['username'];?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">存款金额：</td>
                        <td><input name="v_amount" type="text" class="input_150" id="v_amount" onkeyup="clearNoNum(this);" maxlength="10"/></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">存入银行：</td>
                        <td>
                            <select id="IntoBank" name="IntoBank" onchange="showType1();">
                                <option value="" selected="selected">==请选择汇款银行==</option>
                                <?php foreach($bank[$_SESSION["gid"]] as $k=>$arr) { ?>
                                    <option value="<?=$arr['card_bankName']?>"><?=$arr['card_bankName']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">汇款日期：</td>
                        <td>
                            <input name="cn_date" type="text" id="cn_date" class="input_150" maxlength="10" readonly="readonly" value="<?=date("Y-m-d h:i:s",$lottery_time)?>" style="margin-bottom: 5px"/>
                            <div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">汇款方式：</td>
                        <td>
                            <select id="InType" name="InType" onchange="showType();">
                                <option value="">==请选择汇款方式==</option>
                                <option value="银行柜台">银行柜台</option>
                                <option value="ATM现金">ATM现金</option>
                                <option value="ATM卡转">ATM卡转</option>
                                <option value="网银转账">网银转账</option>
                                <option value="支付宝转账">支付宝转账</option>
                                <option value="0">其它[手动输入]</option>
                            </select>
                            <div>
                                <input id="v_type" name="v_type" type="text" class="input_150" value="请输入其它汇款方式" maxlength="20" style="display: none; margin-top: 5px" />
                                <input type="hidden" id="IntoType" name="IntoType" value="" />
                            </div>
                        </td>
                    </tr>
                    <tr id="tr_v" style="display: none">
                        <td class="bg" align="right">汇款人：</td>
                        <td><input name="v_Name" type="text" class="input_150" id="v_Name" maxlength="20" /></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">存款户名：</td>
                        <td><input name="v_site" type="text" class="input_150" id="v_site" maxlength="50" /></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50">
                            <button name="SubTran" type="button" class="submit_108" id="SubTran" onclick="SubInfo();">提交信息</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>