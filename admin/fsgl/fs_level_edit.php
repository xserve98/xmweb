<?php
include_once("../common/login_check.php"); 
check_quanxian("cwgl");
include_once("../../include/mysqli.php");

$id = '0';
if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	$sql = "select * from `fs_level` where id='$id' limit 1";
	$query = $mysqli->query($sql);
	$rs = $query->fetch_array();
}

if(isset($_REQUEST["save"])){
	$oid = intval(trim($_POST["oid"]));
	$name = trim($_POST["name"]);
	$dml = intval(trim($_POST["dml"]));
	$win = intval(trim($_POST["win"]));
	$ty_rate = floatval(trim($_POST["ty_rate"]));
	$cp_rate = floatval(trim($_POST["cp_rate"]));
	$zr_rate = floatval(trim($_POST["zr_rate"]));
	$dz_rate = floatval(trim($_POST["dz_rate"]));
	
	if($name==""){
		message("请您输入返水等级名称!");
	}
	
	if($oid>0){
		$sql = "select id from `fs_level` where name='$name' and id<>'$oid' limit 1";
		$query = $mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("返水等级名称不能重复!");
			exit;
		}
		
		$sql = "select id from `fs_level` where dml='$dml' and id<>'$oid' limit 1";
		$query = $mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("有效投注范围不能重复!");
			exit;
		}
		
		$sql = "select id from `fs_level` where win='$win' and id<>'$oid' limit 1";
		$query = $mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("实际输赢范围不能重复!");
			exit;
		}
	
		$sql = "update `fs_level` set name='$name',dml='$dml',win='$win',ty_rate='$ty_rate',cp_rate='$cp_rate',zr_rate='$zr_rate',dz_rate='$dz_rate' where id='$oid'";
		$mysqli->query($sql);
		message("更新成功!","fs_level.php");
		exit;
	}else{
		$sql = "select id from `fs_level` where name='$name' limit 1";
		$query = $mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("返水等级名称不能重复!");
			exit;
		}
		
		$sql = "select id from `fs_level` where dml='$dml' limit 1";
		$mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("有效投注范围不能重复!");
			exit;
		}
		
		$sql = "select id from `fs_level` where win='$win' limit 1";
		$mysqli->query($sql);
		$count = $mysqli->affected_rows;
		if($count==1){
			message("实际输赢范围不能重复!");
			exit;
		}
		
		$sql = "insert into `fs_level` (name,dml,win,ty_rate,cp_rate,zr_rate,dz_rate) value ('$name','$dml','$win','$ty_rate','$cp_rate','$zr_rate','$dz_rate')";
		$mysqli->query($sql);
		message("新增成功!","fs_level.php");
		exit;
	}
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>会员等级编辑页面</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
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
<body>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
    function check(obj) {
	    if (obj.name.value == "") {
		    alert("请您输入返水等级名称");
			obj.name.focus();
			return false;
		}
		
		var dml = $.trim(obj.dml.value);
		var win = $.trim(obj.win.value);
		var ty_rate = $.trim(obj.ty_rate.value);
		var cp_rate = $.trim(obj.cp_rate.value);
		var zr_rate = $.trim(obj.zr_rate.value);
		var dz_rate = $.trim(obj.dz_rate.value);
		
		if (isNaN(dml) || dml == "") {
			alert("有效投注必须为整数");
			obj.dml.focus();
			return false;
		}
		
		if (isNaN(win) || win == "") {
			alert("实际输赢必须为整数");
			obj.win.focus();
			return false;
		}
		
		if (isNaN(ty_rate) || ty_rate == "") {
			alert("体育投注必须为数字");
			obj.ty_rate.focus();
			return false;
		}
		
		if (isNaN(cp_rate) || cp_rate == "") {
			alert("彩票游戏必须为数字");
			obj.cp_rate.focus();
			return false;
		}
		
		if (isNaN(zr_rate) || zr_rate == "") {
			alert("真人娱乐必须为数字");
			obj.zr_rate.focus();
			return false;
		}
		
		if (isNaN(dz_rate) || dz_rate == "") {
			alert("电子游艺必须为数字");
			obj.dz_rate.focus();
			return false;
		}
		
		return true;
	}
</script>
<form name="form1" id="form1" method="post" action="?save=1" onSubmit="return check(this);">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">返水等级管理：编辑返水等级信息</span></font></td>
	</tr>
	<tr>
		<td height="24" align="left" nowrap bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="fs_level.php">&lt;&lt;返回返水等级</a></td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td height="24" valign="top" nowrap bgcolor="#FFFFFF">
			<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse:collapse;color:#225d9c;">
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td width="25%" align="right">返水等级名称：</td>
					<td align="left"><input name="name" type="text" id="name" value="<?=@$rs['name']?>" size="20" maxlength="20">
						<input name="oid" type="hidden" id="oid" value="<?=@$rs['id']?>"></td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">有效投注：</td>
					<td align="left"><input name="dml" type="text" id="dml" value="<?=@$rs['dml']?>" size="20" maxlength="10">
						当按有效投注进行返水时有效</td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">实际输赢：</td>
					<td align="left"><input name="win" type="text" id="win" value="<?=@$rs['win']?>" size="20" maxlength="10">
						当按实际输赢进行返水时有效</td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">体育投注：</td>
					<td align="left"><input name="ty_rate" type="text" id="ty_rate" value="<?=@$rs['ty_rate']?>" size="10" maxlength="10"> %</td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">彩票游戏：</td>
					<td align="left"><input name="cp_rate" type="text" id="cp_rate" value="<?=@$rs['cp_rate']?>" size="10" maxlength="10"> %</td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">真人娱乐：</td>
					<td align="left"><input name="zr_rate" type="text" id="zr_rate" value="<?=@$rs['zr_rate']?>" size="10" maxlength="10"> %</td>
				</tr>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td align="right">电子游艺：</td>
					<td align="left"><input name="dz_rate" type="text" id="dz_rate" value="<?=@$rs['dz_rate']?>" size="10" maxlength="10"> %</td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center">
						<input name="tj" type="submit" id="tj" value="提 交">
						&nbsp;&nbsp;&nbsp;&nbsp;　
						<input type="button" name="cx" value="取 消" onClick="reset()">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>