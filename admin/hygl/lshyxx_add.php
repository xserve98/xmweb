<?php
include_once("../common/login_check.php");
check_quanxian("hygl");

if($_GET["action"]=="add"){
	include_once("../../include/mysqli.php");
	
	$username		=	trim($_POST["username"]);
	$pay_card		=	trim($_POST["pay_card"]);
	$pay_num		=	trim($_POST["pay_num"]);
	$pay_address	=	trim($_POST["pay_address"]);
    $pay_name		=	trim($_POST["pay_name"]);
	
	$sql			=	"select uid from k_user where username='$username' limit 1";
	$query			=	$mysqli->query($sql);
	$row			=	$query->fetch_array();
	if($row['uid'] > 0){
		$sql		=	"insert into history_bank (uid,username,pay_card,pay_num,pay_address,pay_name) values (".$row['uid'].",'$username','$pay_card','$pay_num','$pay_address','$pay_name')";
		$mysqli->query($sql);
		if($mysqli->affected_rows == 1){
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"新增了会员 ".$row['uid']." 历史银行卡信息 ".$mysqli->insert_id);
			
			message('新增历史银行卡信息成功','lsyhxx.php?action=1&username='.$username);
		}else{
			message('新增历史银行卡信息失败');
    	}
    }else{
		message('新增历史银行卡信息失败');
    }	
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>新增会员银行历史信息</TITLE>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE1 {font-size: 10px}
.STYLE2 {font-size: 12px}
body {	margin: 0px;}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;
	text-decoration: none;

}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.inputguanjun { width:300px;}
</STYLE>
<script>
function check(){
	var username = document.getElementById("username").value;
	if(username.length < 1){
		document.getElementById("username").focus();
		return false;
	}
	var pay_name = document.getElementById("pay_name").value;
	if(pay_name.length < 1){
		document.getElementById("pay_name").focus();
		return false;
	}
	var pay_card = document.getElementById("pay_card").value;
	if(pay_card.length < 1){
		document.getElementById("pay_card").focus();
		return false;
	}
	var pay_num = document.getElementById("pay_num").value;
	if(pay_num.length < 1){
		document.getElementById("pay_num").focus();
		return false;
	}
	var pay_address = document.getElementById("pay_address").value;
	if(pay_address.length < 1){
		document.getElementById("pay_address").focus();
		return false;
	}
	return true;
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">新增会员银行历史信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<br>
<form action="lshyxx_add.php?action=add" method="post" name="form1" onSubmit="return check();">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">会员名称</td>
    <td><input  name="username" type="text" id="username" size="40" maxlength="20" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">开户人</td>
    <td><input  name="pay_name" type="text" id="pay_name" size="40" maxlength="20" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">开户行</td>
    <td><select id="pay_card" name="pay_card">
                <option value="中国工商银行" selected="selected">中国工商银行</option>
	              <option value="中国招商银行">中国招商银行</option>
	              <option value="中国农业银行">中国农业银行</option>
	              <option value="中国建设银行">中国建设银行</option>
	              <option value="中国民生银行">中国民生银行</option>
	              <option value="中国交通银行">中国交通银行</option>
	              <option value="深圳发展银行">深圳发展银行</option>
	              <option value="中国银行">中国银行</option>
            </select></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">银行卡号</td>
    <td><input  name="pay_num" type="text" id="pay_num" size="40" maxlength="20" /></td>
  </tr>
  <tr>
    <td width="220" bgcolor="#F0FFFF">开户地址</td>
    <td width="783"><input  name="pay_address" type="text" id="pay_address" size="40" maxlength="20" /></td>
  </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#F0FFFF">操作</td>
      <td><input name="submit" type="submit" value="添加"/></td>
    </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>