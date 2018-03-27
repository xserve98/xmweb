<?php
include_once("../common/login_check.php");
check_quanxian("hygl");
include_once("../../include/mysqli.php");
$save=$_GET["save"];
$uid=$_REQUEST["uid"];
$username=$_REQUEST["username"];
$sql = "select * from k_user where uid=$uid";
$query	=	$mysqli->query($sql);
$row = $query->fetch_array();
if($save=='ok'){
    
    $uid=$_REQUEST["uid"];
   $username  =  $_REQUEST["username"];
   $pay_name	=	$_POST["truename"];
   $dltype		=	$_POST["dltype"];
   $zhancheng		=	$_POST["zhancheng"];
	
	/////////////判断是是否有上级////
	if($row['top_uid']>0&&$dltype!=$row['dltype']){
		
		message('此代理商已有上下级，不允许修改代理级别','edit_daili.php?uid='.$uid.'&username='.$username);
		
	}
	if($row['top_uid']>0){	
$sql = "select * from k_user where uid='".$row['top_uid']."'";
$query	=	$mysqli->query($sql);
$row1 = $query->fetch_array();
	if($zhancheng>=$row1['zhancheng']){///////////////////
	message('代理商占成比例不可以比上级高','edit_daili.php?uid='.$uid.'&username='.$username);
	}
	
	}
		$sql="update k_user set pay_name='".$pay_name."',zhancheng='".$zhancheng."',dltype='".$dltype."' where uid=". $uid;
		$mysqli->query($sql);

        message('设置成功','edit_daili.php?uid='.$uid.'&username='.$username);
}



?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>新增代理</TITLE>
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
.t-title{height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap ><font >&nbsp;<span class="STYLE2">代理管理：修改代理</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>
<form action="edit_daili.php?save=ok" method="post" name="form1" id="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;"  >
  <tr>
  <input name="uid" type="hidden" id="uid" value="<?=$row['uid']?>"  maxlength="20" style="width:150px;">
  <input name="username" type="hidden" id="username" value="<?=$row['username']?>"  maxlength="20" style="width:150px;">
    <td bgcolor="#F0FFFF" width="200">账号</td>
    <td><?=$row['username']?></td>
  </tr> 
  <tr>
    <td bgcolor="#F0FFFF">姓名</td>
    <td><input name="truename" type="text" id="truename" value="<?=$row['pay_name']?>"  maxlength="20" style="width:150px;"></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">占成</td>
    <td><input name="zhancheng" type="text" id="zhancheng" value="<?=$row['zhancheng']?>"  maxlength="20" style="width:150px;"></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">代理类型</td>
    <td><label>
      <select name="dltype" id="dltype">
<?php
		  $arr=array('大股东','股东','总代理','代理');
for($i=0;$i<count($arr);$i++){
?>
        <option value="<?=$i+1?>" <?=$i+1==$row["dltype"] ? 'selected' : ''?>><?=$arr[$i]?></option>
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