<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");

if($_GET["action"]=="add"){
	include_once("../../include/mysqlis.php");
	
	$table				=	trim($_POST["type"]);
	$match_name			=	trim($_POST["match_name"]);
	$match_master		=	trim($_POST["match_master"]);
	$match_guest		=	trim($_POST["match_guest"]);
	$match_id			=	trim($_POST["match_id"]);
	$match_date			=	trim($_POST["match_date"]);
    $match_time			=	trim($_POST["match_time"]);
	$match_coverdate	=	trim($_POST["match_coverdate"]);
 
	$sql				=	"insert into $table (match_name,match_master,match_guest,match_id,match_date,match_time,match_coverdate) values ('$match_name','$match_master','$match_guest',$match_id,'$match_date','$match_time','$match_coverdate')";
	$mysqlis->query($sql);
    if($mysqlis->affected_rows == 1){
		$id 			=	$mysqlis->insert_id;
		include_once("../../class/admin.php");
    	admin::insert_log($_SESSION["adminid"]," 新增了赛事 $table $id");
		
		message('添加成功','ss_list.php?type='.$table);
    }else{
		message('添加失败');
    }	
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>添加赛事</TITLE>
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
	var match_name = document.getElementById("match_name").value;
	if(match_name.length < 1){
		alert("请您输入要新增的赛事名称");
		document.getElementById("match_name").focus();
		return false;
	}
	var match_master = document.getElementById("match_master").value;
	if(match_master.length < 1){
		alert("请您输入要新增的主队名称");
		document.getElementById("match_master").focus();
		return false;
	}
	var match_guest = document.getElementById("match_guest").value;
	if(match_guest.length < 1){
		alert("请您输入要新增的客队名称");
		document.getElementById("match_guest").focus();
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
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">赛事管理：添加赛事</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<form action="addss.php?action=add" method="post" name="form1" onSubmit="return check();">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">赛事名称</td>
    <td><input type="text" class="inputguanjun"  name="match_name" id="match_name" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">客队名称</td>
    <td><input type="text" class="inputguanjun"  name="match_master" id="match_master" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">客队名称</td>
    <td><input type="text" class="inputguanjun"  name="match_guest" id="match_guest" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">正网编号</td>
    <td><input type="text"  name="match_id" id="match_id" /> 
      格式为：2278</td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">结束日期</td>
    <td width="473"><input type="text"  name="match_date" id="match_date" />
      格式为：<?=date('m-d')?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">结束时间</td>
    <td><input type="text"  name="match_time" id="match_time" /> 
      格式为：11:00a 或 02:30p </td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">封盘时间</td>
    <td><input type="text"  name="match_coverdate" id="match_coverdate" value="<?=date("Y-m-d H:i:s")?>" /> 
      格式为：2009-08-30 23:00:00</td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input type="submit" value="添加"/>
      <input name="type" type="hidden" id="type" value="<?=$_GET['type']?>"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>