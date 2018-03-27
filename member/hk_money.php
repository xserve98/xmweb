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
	
	if($manner == "网银转账"){
		$manner .=	"<br />持卡人姓名：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "微信支付") {
		$manner .=	"<br />微信昵称：".htmlEncode($_POST["v_Name"]);
	} elseif($manner == "支付宝转账") {
		$manner .=	"<br />支付宝昵称：".htmlEncode($_POST["v_Name"]);
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
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
</head>
<body>
<div class="wrap">
    <?php include_once("moneymenu.php"); ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr class="tic c_red f_b">
            <td colspan="7">请选择以下公司账号进行转账汇款</td>
        </tr>
        <?php
        include_once("../cache/bank.php");
        foreach($bank[$_SESSION["gid"]] as $k=>$arr) {
            ?>
            <tr class="list">
                <td><img src="/bank/<?=$arr['card_bankIco']?>" width="107" height="24" /></td>
                <td><?=$arr['card_bankName']?>：</td>
                <td><span class="c_blue"><?=$arr['card_ID']?></span></td>
                <td>开户名：</td>
                <td><span class="c_blue"><?=$arr['card_userName']?></span></td>
                <td>开户行所在城市：</td>
                <td class="c_blue"><?=$arr['card_address']?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="7">
                <p><strong>温馨提示：</strong></p>
                <p>一、在金额转出之后请务必填写该页下方的汇款信息表格，以便财务系统能够及时的为您确认并添加金额到您的会员帐户中。</p>
                <p>二、本公司最低存款金额为100元，公司财务系统将对银行存款的会员按实际存款金额实行返利派送。</p>
                <p>三、跨行转帐请您使用跨行快汇。</p>
            </td>
        </tr>
    </table>
    <form id="form1" name="form1" action="?into=true" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="mt10">
            <tr class="tic c_red f_b">
                <td colspan="2">请认真填写以下汇款单</td>
            </tr>
            <tr>
                <td class="bg" width="22%" align="right">用户账号：</td>
                <td><?=$_SESSION['username'];?></td>
            </tr>
            <tr>
                <td class="bg" align="right">存款金额：</td>
                <td><input name="v_amount" type="text" class="input_150" id="v_amount" onkeyup="clearNoNum(this);" maxlength="10"/></td>
            </tr>
            <tr>
                <td class="bg" align="right">汇款银行：</td>
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
                    <input name="cn_date" type="text" id="cn_date" class="input_100 laydate-icon" maxlength="10" readonly="readonly" value="<?=date("Y-m-d",$lottery_time)?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});"/>
                    时间：
                    <select name="s_h" id="s_h">
                        <option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select>
                    时
                    <select name="s_i" id="s_i">
                        <option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select>
                    分
                    <select name="s_s" id="s_s">
                        <option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select>
                    秒
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
                        <option value="0">其它[手动输入]</option>
                    </select>
                    <input id="v_type" name="v_type" type="text" class="input_120" value="请输入其它汇款方式" maxlength="20" style="display: none" />
                    <input type="hidden" id="IntoType" name="IntoType" value="" />
                </td>
            </tr>
            <tr id="tr_v" style="display: none">
                <td class="bg" align="right">汇款人姓名：</td>
                <td><input name="v_Name" type="text" class="input_150" id="v_Name" maxlength="20" /></td>
            </tr>
            <tr>
                <td class="bg" align="right">汇款地点：</td>
                <td><input name="v_site" type="text" class="input_250" id="v_site" maxlength="50" /></td>
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
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>