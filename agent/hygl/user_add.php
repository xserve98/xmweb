<?php
include_once("../common/login_check.php");
///check_quanxian("hygl");
include_once("../../include/mysqli.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>新增会员</TITLE>
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
a{color:#FFA93E;}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户管理：新增代理</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>
<form action="user_addupdate.php" method="post" name="form1" id="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;"  >
  <tr>
    <td bgcolor="#F0FFFF" width="200">账号</td>
    <td><input name="username" type="text" id="username" value="" maxlength="10" style="width:150px;" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">&nbsp;&nbsp;登录帐户，5-10个英文或数字组成</td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">登录密码</td>
    <td><input name="password" type="password" id="password" value=""  maxlength="20" style="width:150px;">&nbsp;&nbsp;由6-20位任意字符组成</td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">重复登陆密码</td>
    <td><input name="cf_password" type="password" id="cf_password" value=""  maxlength="20" style="width:150px;"></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">姓名</td>
    <td><input name="truename" type="text" id="truename" value=""  maxlength="20" style="width:150px;"></td>
  </tr>
   <!--tr>
    <td bgcolor="#F0FFFF">手机</td>
    <td><input name="mobile" type="text" id="mobile" value=""  maxlength="20" style="width:150px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" /></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">微信</td>
    <td><input name="wechat" type="text" id="wechat" value=""  maxlength="20" style="width:150px;" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">QQ</td>
    <td><input name="qq" type="text" id="qq" value=""  maxlength="20" style="width:150px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" /></td>
  </tr-->
<tr>
    <td bgcolor="#F0FFFF">盘口</td>
    <td><label>
      <select name="pankou" id="pankou">
<?php
		  $arr=array('A','B','C');
for($i=0;$i<count($arr);$i++){
?>
        <option value="<?=$arr[$i]?>" ><?=$arr[$i]?></option>
<?php
}
?>
      </select>
    </label></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" value="确认提交"> 　 
  	  <input type="button" value="取 消" onClick="javascript:javascript:history.go(-1)"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>