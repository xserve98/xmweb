<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");

if($_GET["action"]=="add"){
	include_once("../../include/mysqlis.php");
	
	$match_name			=	trim($_POST["match_name"]);
	$x_title			=	trim($_POST["x_title"]);
	$match_id			=	trim($_POST["match_id"]);
	$match_date			=	trim($_POST["match_date"]);
    $match_time			=	trim($_POST["match_time"]);
	$match_coverdate	=	trim($_POST["match_coverdate"]);
 
	$sql				=	"insert into t_guanjun(match_name,x_title,match_date,match_time,match_coverdate,match_id) values('$match_name','$x_title','$match_date','$match_time','$match_coverdate',$match_id)";
	$mysqlis->query($sql);
    if($mysqlis->affected_rows == 1){
		include_once("../../class/admin.php");
    	admin::insert_log($_SESSION["adminid"],"新增了冠军项目 $x_title");
		
		message('冠军项目新增成功','list.php?type=1');
    }else{
		message('冠军项目新增失败');
    }	
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>冠军项目新增</TITLE>
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
	var x_title = document.getElementById("x_title").value;
	if(x_title.length < 1){
		alert("请您输入要新增的联赛名称");
		document.getElementById("x_title").focus();
		return false;
	}
	var match_name = document.getElementById("match_name").value;
	if(match_name.length < 1){
		alert("请您输入要新增的项目名称");
		document.getElementById("match_name").focus();
		return false;
	}
	var match_id = document.getElementById("match_id").value;
	if(match_id.length < 1){
		alert("请您输入要新增的正网编号");
		document.getElementById("match_id").focus();
		return false;
	}
	var match_date = document.getElementById("match_date").value;
	if(match_date.length < 1){
		alert("请您输入要新增的结束日期");
		document.getElementById("match_date").focus();
		return false;
	}
	var match_time = document.getElementById("match_time").value;
	if(match_time.length < 1){
		alert("请您输入要新增的结束时间");
		document.getElementById("match_time").focus();
		return false;
	}
	var match_coverdate = document.getElementById("match_coverdate").value;
	if(match_coverdate.length < 1){
		alert("请您输入要新增的封盘时间");
		document.getElementById("match_coverdate").focus();
		return false;
	}
	return true;
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">冠军管理：新增冠军项目</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<br>
<form action="add.php?action=add" method="post" name="form1" onSubmit="return check();">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">联赛名称</td>
    <td><input type="text" class="inputguanjun"  name="x_title" id="x_title"/></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">项目名称</td>
    <td><input type="text" class="inputguanjun"  name="match_name" id="match_name"/></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">正网编号</td>
    <td><input type="text"  name="match_id" id="match_id" /> 
      格式为：22781</td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">结束日期</td>
    <td width="473"><input type="text"  name="match_date" id="match_date" value="<?=date("m-d")?>" />
      格式为：08-30</td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">结束时间</td>
    <td><input type="text"  name="match_time" id="match_time" value="<?=date("h:i")?>a" /> 
      格式为：11:00a</td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">封盘时间</td>
    <td><input type="text"  name="match_coverdate" id="match_coverdate" value="<?=date("Y-m-d H:i:s")?>" /> 
      格式为：2009-08-30 23:00:00</td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">保存</td>
    <td><input type="submit" value="保存"/></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>