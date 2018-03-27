<?php
include_once("../common/login_check.php"); 
check_quanxian("xxgl");
include_once("../../include/mysqli.php");
$sql	=	"select * from ban_ip where id>0 ";   
if(isset($_GET["ip"])) $sql .= " and ip='".$_GET['ip']."'";
$sql	.=	" order by id desc";
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户列表</TITLE>
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
.STYLE3 {color: #FF0000}
</STYLE>
<script>
function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='id[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = document.getElementById("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}
		return true;
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">申述管理：查看用户的申述信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
<form action="ssgl_del.php" id="form1" name="form1" method="post" style="margin:0 0 0 0;" onSubmit="return check();">
  <table width="100%" border="0">
    <tr>
      <td align="right"><span class="STYLE3">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">解禁</option>
  </select>
<input type="submit" name="Submit2" value="执行"/></td>
    </tr>
  </table>
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="20%"  height="20"><strong>ip地址</strong></td>
        <td width="15%" ><strong>时间</strong></td>
        <td width="25%" ><strong>原因</strong></td>
        <td width="25%" ><strong>申诉</strong></td>
        <td width="10%" ><strong>状态</strong></td>
        <td width="5%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
        </tr>
<?php
$query		=	$mysqli->query($sql);
while ($rows=	$query->fetch_array()) {
?>
		<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
		  <td><a href="../hygl/login_ip.php?ip=<?=$rows["ip"]?>" target="_blank" title="查看IP"><?=$rows["ip"]?></a></td>
		  <td><?=strftime("%Y-%m-%d %H:%M:%S",$rows["ban_time"])?></td>
		  <td><?=$rows["why"]?></td>
		  <td><?=$rows["message"] ? $rows["message"] : '无'?></td>
		  <td><?=$rows['is_jz']==1 ? '<span style="color:#FF0000">未解禁</span>' : '<span style="color:#006600">已解禁</span>'?></td>
		  <td><input name="id[]" type="checkbox" id="id[]" value="<?=$rows["id"]?>"></td>
		 </tr> 	
<?php
}
?>
    </table>
</form>
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</body>
</html>