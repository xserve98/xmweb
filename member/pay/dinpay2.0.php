<?
session_start();
include_once("config.php");
include_once("moneyconfig.php");
include_once("../../include/mysqli.php");
include_once("../function.php");

$main_url=$_REQUEST['hosturl'];
$uid=intval($_REQUEST['uid']);
$username=$_REQUEST['username'];
$sql="select uid,username,mobile,money from k_user where username='$username' and uid='$uid'";
$query=$mysqli->query($sql);
$cou=$query->num_rows;
if($cou<=0){
	message('请登录后再进行存款操作');
	exit();
}
$rows=$query->fetch_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>会员中心</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="../images/member.css"/>
	<script type="text/javascript" src="../images/member.js"></script>
	<!--[if IE 6]><script type="text/javascript" src="../images/DD_belatedPNG.js"></script><![endif]-->
	<link href="skin/thickbox.css" rel="stylesheet" type="text/css" />
	<script language="JAVAScript">
        //数字验证 过滤非法字符
        function clearNoNum(obj){
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != ''){
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value))   
				{   
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		
		function VerifyData() {
			var paymoney = document.form1.MOAmount.value;
			var limitmoney = document.form1.ck_limit.value;
			if (document.form1.MOAmount.value == "") {
				alert("请输入存款金额！")
				document.form1.MOAmount.focus();
				return false;
			}

			if (eval(paymoney) < eval(limitmoney)) {
				alert("最低冲值"+limitmoney+"元！");
				document.form1.MOAmount.focus();
				return false;
			}
			
			tb_show("在线存款","#TB_inline?width=480&height=200&inlineId=info",false);
			return true;
		}
	</script>
	<script type="text/javascript" src="skin/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="skin/thickbox.js"></script>
	<script type="text/javascript"> 
		$(function(){
			//付款完成，返回付款历史页面
			$('#btnOKpay').click(function(){
				tb_remove();
				self.location.href="<?=$main_url?>member/data_money.php";
			});
			$('#btnFail').click(function(){
				tb_remove();
				self.location.href='<?=$input_url?>?username=<?=$username?>&uid=<?=$uid?>&hosturl=<?=$main_url?>';
			});
			$('#back').click(function(){
				tb_remove();
				self.location.href='<?=$input_url?>?username=<?=$username?>&uid=<?=$uid?>&hosturl=<?=$main_url?>';
			});	
		})
	</script>
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px #FFF solid;">
	<?php 
	include_once("../mainmenu.php");
	?>
	<tr>
		<td colspan="2" align="center" valign="middle">
			<?php 
			include_once("../moneymenu.php");
			?>
			<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td align="left" bgcolor="#FFFFFF" style="line-height:22px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="5">
								<form id="form1" name="form1" action="<?=$post_url?>" method="post" onsubmit="return VerifyData();" target="_blank">
								<tr>
									<td align="right" bgcolor="#FAFAFA">用户账号：</td>
									<td align="left"><?=$username;?><input type="hidden" Name="S_Name" value="<?=$rows['username']?>">
										&nbsp;&nbsp;<span class="lan">目前额度：<?=sprintf("%.2f",$rows['money'])?></span></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#FAFAFA">存款金额：</td>
									<td align="left"><input name="MOAmount" type="text" class="input_150" id="MOAmount" onkeyup="clearNoNum(this);" maxlength="10" size="15"/>
										&nbsp;&nbsp;<span class="lan">最少冲值<?=$web_site['ck_limit']?>元</span>
										<input id="ck_limit" type="hidden" value="<?=$web_site['ck_limit']?>" /></td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<table border="0" cellspacing="0" cellpadding="0">
											<tr height="60">
												<td width="20"><input type="radio" name="P_Bank" value="CCB" checked="checked" /></td>
												<td width="150"><img src="skin/bank/bank_2.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="ABC" /></td>
												<td width="150"><img src="skin/bank/bank_4.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="ICBC" /></td>
												<td width="150"><img src="skin/bank/bank_3.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="CMB" /></td>
												<td width="150"><img src="skin/bank/bank_5.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="BCOM" /></td>
												<td width="150"><img src="skin/bank/bank_12_02.gif" /></td>
											</tr>
											<tr height="60">
												<td width="20"><input type="radio" name="P_Bank" value="CMBC" /></td>
												<td width="150"><img src="skin/bank/bank_11.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="ECITIC" /></td>
												<td width="150"><img src="skin/bank/bank_12_01.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="CEBB" /></td>
												<td width="150"><img src="skin/bank/bank_7.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="BEA" /></td>
												<td width="150"><img src="skin/bank/bank_12_06.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="SPABANK" /></td>
												<td width="150"><img src="skin/bank/pab.png" /></td>
											</tr>
											<tr height="60">
												<td width="20"><input type="radio" name="P_Bank" value="BOC" /></td>
												<td width="150"><img src="skin/bank/bank_1.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="PSBC" /></td>
												<td width="150"><img src="skin/bank/bank_12_09.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="CIB" /></td>
												<td width="150"><img src="skin/bank/bank_8.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="GDB" /></td>
												<td width="150"><img src="skin/bank/bank_6.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="HXB" /></td>
												<td width="150"><img src="skin/bank/bank_10.gif" /></td>
											</tr>
											<tr height="60">
												<td width="20"><input type="radio" name="P_Bank" value="SPDB" /></td>
												<td width="150"><img src="skin/bank/shpf.png" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="ECITIC" /></td>
												<td width="150"><img src="skin/bank/bank_11_02.gif" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="CMPAY" /></td>
												<td width="150"><img src="skin/bank/chinaMobile.jpg" /></td>
												<td width="20"><input type="radio" name="P_Bank" value="ZYC" /></td>
												<td width="150"><img src="skin/bank/zhiyoucard.png" /></td>
												<td width="20">&nbsp;</td>
												<td width="150">&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#FAFAFA">&nbsp;</td>
									<td align="left"><input name="SubTran" type="submit" class="submit_108" id="SubTran" value="马上冲值" /></td>
								</tr>
								</form>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>      
<div id="info" style="display:none;">
	<p><img src="skin/i.gif" border="0" align="absmiddle" />&nbsp;存款完成前请不要关闭此窗口。完成存款后请根据你的情况点击下面的按钮：</p>
	<p><b>请在新开页面完成付款后再选择。</b></p>
	<p>&nbsp;</p>
	<p align="center"><input type="button" id="btnOKpay" name="btnOKpay" value="已完成付款">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="btnFail" name="btnFail" value="付款遇到问题，重新输入" /></p>
	<p style="height:35px; line-height:35px;"><a href="javascript:void(0);" id="back" style="color:#0077FF;">返回重新输入付款金额</a></p>
</div>       
</body>
</html>