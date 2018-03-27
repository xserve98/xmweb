<?php
include_once("../common/login_check.php");
///check_quanxian("hygl");
include_once("../../include/mysqli.php");
include_once("../../cache/website.php");
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
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>
<?php
		session_start();
$suid=$_SESSION["suid"];
$sql	=	"select * from k_user where uid=".intval($suid)." limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
		
		
$sql="select count(*) as num from k_user where concat(',',parents,',') like '%,".intval($suid).",%'";		
$query	=	$mysqli->query($sql);
$rows2	=	$query->fetch_array();	
$sql="select count(*) as num from k_user where top_uid='$suid'";		
$query	=	$mysqli->query($sql);
$rows3	=	$query->fetch_array();	
		
?>
<form action="user_update.php" method="post" name="form1" id="form1">
<table width="600px" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="float: left;border-collapse: collapse; color: #225d9c;"  >
  <tr>
    <td bgcolor="#F0FFFF">用户名</td>
	<input name="uid" type="hidden" value="<?=$suid?>"  >
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
      
      
		)</span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">登录密码</td>
    <td><input name="pass"  >
    <font color="#FF0000">*不修改请留空</font></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">登陆密码</td>
    <td><?=$rows["sex"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">取款密码</td>
    <td><input name="pass1" >
    <font color="#FF0000">*不修改请留空</font></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">取款密码</td>
    <td><?=$rows["birthday"]?></td>
  </tr>
  <tr style='display:none'>
    <td bgcolor="#F0FFFF">支付宝</td>
    <td><input name="zfb" >
    <font color="#FF0000">*不修改请留空</font></td>
  </tr>
  <tr style='display:none'>
    <td bgcolor="#F0FFFF">支付宝</td>
    <td><?=$rows["zfb"]?></td>
  </tr>
  <tr>
    <td width="72" bgcolor="#F0FFFF">账户余额</td>
    <td width="473"><?=$rows["money"]?></td>
  </tr>
    <tr>
    <td width="72" bgcolor="#F0FFFF">下级账号</td>
		<td width="473">下级总数量：<a href="../dlgl/dailist.php?1=1"><?=$rows2["num"]?></a>直属下级：<a href="../dlgl/dailist.php?top_uid2=<?=$suid?>"><?=$rows3["num"]?><a></td>
  </tr>
   <tr>
    <td width="72" bgcolor="#F0FFFF">推广连接</td>
   
    <td width="473">http://<?=$web_site["web_www"]?>?f=<?=$_SESSION["suid"]+100000?></td>
  </tr>

  <tr>
    <td width="72" bgcolor="#F0FFFF">彩种回水</td>
	  <td width="473"><a href="send_back2.php?uid=<?=$suid?>&username=<?=$rows["username"]?>">点击查看</a></td>
  </tr>

 
  
  <tr>
    <td bgcolor="#F0FFFF">姓名</td>
  
    <td><?=$rows["pay_name"]?></td>
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
  <tr style="display: none">
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