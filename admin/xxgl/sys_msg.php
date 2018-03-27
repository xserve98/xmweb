<?php
include_once("../../include/config.php"); 
include_once("../common/login_check.php");
check_quanxian("xxgl");
include_once("../../include/mysqli.php");
	
if(@$_GET["action"]=="add"){
	include_once("../../class/user.php");
	
	$msg_title	=	trim($_POST["msg_title"]);
	$msg_info	=	trim($_POST["msg_info"]);
	$msg_from	=	trim($_POST["msg_from"]);
	if($_POST["type"] || $_POST['group']){
		$sql		=	'';
		if($_POST["type"] == "login"){ //所有在线会员
			$sql	=	"select uid from k_user_login where `is_login`>0";
		}elseif($_POST["type"] == "all"){ //所有会员
			$sql	=	"select uid from k_user";
		}
		if($sql){
			$query	=	$mysqli->query($sql);
			while($rows = $query->fetch_array()){
				user::msg_add($rows["uid"],$msg_from,$msg_title,$msg_info);
			}
		}
		if($_POST['group']){
			$sql	=	"select uid from k_user where gid=".$_POST['group'];
			$query	=	$mysqli->query($sql);
			while($rows = $query->fetch_array()){
				user::msg_add($rows["uid"],$msg_from,$msg_title,$msg_info);
			}
		}
		message('发送成功',$_SERVER['PHP_SELF']);
	}else{
		$arr_un = explode(',',rtrim(trim($_POST["username"]),','));
		$un		= '';
		foreach($arr_un as $k=>$v){
			$un	.= "'".$v."',";
		}
		if($un != ''){
			$un		=	rtrim($un,',');
			$sql	=	"select uid from k_user where username in ($un)";
			$query	=	$mysqli->query($sql);
			while($rows = $query->fetch_array()){
				user::msg_add($rows['uid'],$msg_from,$msg_title,$msg_info);
			}
			message('发送成功',$_SERVER['PHP_SELF']);
		}
		message('没有这个用户名',$_SERVER['PHP_SELF']);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布短消息</title>
</head>
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
<script language="javascript" src="../../js/jquery.js"></script>
<script>
function check(){
	if($("#msg_title").val()==""){
		alert("请输入短消息标题");
		$("#msg_title").select();
		return false;
	}
	if($("#msg_info").val()==""){
		alert("请输入短消息标题");
		$("#msg_info").select();
		return false;
	}
	var len = $(":radio:checked").length; 
	if($("#group").val()=="0" && len==0 && $("#username").val()==""){
		alert("请输入会员名称");
		$("#username").select();
		return false;
	}
	return true;
}
</script>
<body>
 <table width="100%" >
  <tr>
    <td height="24" background="../images/06.gif"><font >&nbsp;给网站会员发布短消息</font></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#FFFFFF">
    <form name="form1"   method="post" action="<?=$_SERVER['PHP_SELF']?>?action=add" onsubmit="return check();">
    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
  <tr>
     <td>消息标题：</td>
     <td align="left"><input name="msg_title" id="msg_title" type="text" style="width:600px;" value="<?=@$_GET['title']?>"/></td>
  </tr>
  <tr>
    <td>消息内容：</td>
    <td  align="left"><textarea name="msg_info" id="msg_info" rows="9" style="width:600px;"></textarea></td>
  </tr>
  <tr>
    <td>用户名：</td>
    <td align="left">
      <textarea name="username" rows="3" id="username" style="width:600px;"><?=@$_GET["username"]?></textarea>
      多个会员用 , 隔开
      <br/>
          <input type="radio" name="type" value="login" />
          在线会员&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="type" value="all" />
          所有会员&nbsp;&nbsp;&nbsp;&nbsp;
		
        </td>
  </tr>
  <tr>
    <td width="12%">发布者：</td>
    <td width="88%" align="left"><input type="text" name="msg_from"  value="<?=$web_site['reg_msg_from']?>" /></td>
    </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left"><input name="submit" type="submit" value="发布"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="msg_list.php?1=1">查看短消息记录</a></td>
  </tr>
</table>  
    </form>
</td>
  </tr>
</table>
</body>
</html>