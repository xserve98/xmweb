<?php
include_once("../common/login_check.php");
///check_quanxian("hygl");
include_once("../../include/mysqli.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户详细信息展示</TITLE>
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

<script language="javascript" src="../js/user_show.js"></script>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户管理：查看用户详细信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>
<?php
$sql	=	"select * from k_user where uid=".intval($_GET["id"])." limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<form action="user_update.php" method="post" name="form1" id="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;"  >
  <tr>
    <td bgcolor="#F0FFFF">用户名</td>
	<input name="uid" type="hidden" value="<?=$rows["uid"]?>"  >
    <td><?=$rows["username"]?>
      <input name="hf_username" type="hidden" id="hf_username" value="<?=$rows["username"]?>"><span style="color:red">(
      <?php if($rows["dltype"]==1){
	$lx='大股东';
	
}else if($rows["dltype"]==2){
	$lx='股东';
	
}else if($rows["dltype"]==3){
	$lx='总代理';
	
}else if($rows["dltype"]==4){
	$lx='代理';
	
}else{
	
	$lx='会员';
}
	echo $lx	
		?>
      
      
		)</span> </td>
  </tr>

  <tr>
    <td width="172" bgcolor="#F0FFFF">账户余额</td>
    <td width="473"><?=$rows["money"]?></td>
  </tr>
  
  <tr>
    <td bgcolor="#F0FFFF">注册所在地</td>
    <td><?=$rows["reg_address"]?></td>
  </tr>
 
  

  <tr>
    <td bgcolor="#F0FFFF">姓名</td>
  
    <td><?=$rows["pay_name"]?></td>
  </tr>

 <tr>
    <td bgcolor="#F0FFFF">分红比例</td>
    <td><input type="text" name="fandian" value="<?=$rows["fandian"]?>" ></td>
  </tr>
  
    <tr>
    <td bgcolor="#F0FFFF">盘口</td>
    <td><label>
      <select name="pankou" id="pankou">
        <option value="A" <?=A==$rows["pankou"] ? 'selected' : ''?>>A盘</option>
         <option value="B" <?=B==$rows["pankou"] ? 'selected' : ''?>>B盘</option>
          <option value="C" <?=C==$rows["pankou"] ? 'selected' : ''?>>C盘</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">注册时间</td>
    <td><?=$rows["reg_date"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">注册IP</td>
    <td><?=$rows["reg_ip"]?></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">最后登录时间</td>
    <td><?=$rows["login_time"]?></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">最后登录IP</td>
    <td><?=$rows["login_ip"]?></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">最后退出时间</td>
    <td><?=$rows["logout_time"]?></td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">总登录次数</td>
    <td><?=$rows["lognum"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">备注：</td>
    <td><textarea name="why" cols="80" rows="5" id="why"><?=$rows["why"]?></textarea></td>
  </tr>
  
  <tr>
  	<td colspan="2" align="center"><input type="submit" value="确认提交"> 　 
  	  <input type="button" value="取 消" onClick="javascript :history.back(-1);"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>