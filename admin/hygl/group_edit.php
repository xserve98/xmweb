<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

$id = '0';
if(isset($_GET["id"])){
	$id		=	$_GET["id"];
	$sql	=	"select * from `k_group` where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户组编辑页面</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
 
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>
<script type="text/javascript">
    var v;
	var num;
    function check(obj){
	    if(obj.name.value==""){
		    alert("请您输入会员组名称..");
			obj.name.focus();
			return false;
		}
		return true;
	}
	
	function isnum(obj){
	    v = obj.value;
		if(v == (parseInt(v)*1)){
		     num = v.indexOf(".");
			 if(num == -1) return true;
			 else{
		        alert("限额只能为正整数..");
			    obj.select();
			    return false;
		     }
		}else{
		    alert("限额只能为正整数..");
			obj.focus();
			return false;
		}
	}
</script>
<body>
<form name="form1" id="form1" method="post" action="group_save.php?id=<?=$id?>" onSubmit="return check(this);">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户组权限管理：编辑用户组信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="left" nowrap bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="group.php">&lt;&lt;返回会员组</a></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" valign="top" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td width="25%" align="right">用户组名称：</td>
              <td colspan="3" align="left"><label>
                <input name="name" type="text" id="name" value="<?=@$rs['name']?>" size="20" maxlength="20">
              </label></td>
          </tr>
          
          	<tr align="center">
			<td colspan="4" align="left" bgcolor="#CCCCCC"><strong>彩票</strong></td>
        </tr>
		<tr align="center">
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
        </tr>
		<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
			<td align="right">彩票最低下注：</td>
			<td align="left"><input name="cp_zd" type="text" id="cp_zd" value="<?=@$rs['cp_zd']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
			<td align="right">彩票最高下注：</td>
			<td align="left"><input name="cp_zg" type="text" id="cp_zg" value="<?=@$rs['cp_zg']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
          
	        <tr align="center">
	          <td colspan="4" align="center">
	            <input name="tj" type="submit" id="tj" value="提 交">
	          &nbsp;&nbsp;&nbsp;&nbsp;　
	          <input type="button" name="cx" value="取 消" onClick="window.location.href='group.php'">
	          </td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="center">&nbsp;</td>
        </tr>   	
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>