<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("../../include/mysqlis.php");

if($_GET["action"]=="add"){
	$sql	=	"insert into t_guanjun_team(team_name,point,xid) values('".$_POST["team_name"]."','".floatval($_POST["point"])."','".$_GET["id"]."')";
	$mysqlis->query($sql);
}

$sql	=	"select * from t_guanjun where x_id=".intval($_GET["id"])." limit 1";
$query	=	$mysqlis->query($sql);
$rows	=	$query->fetch_array();
if(!$rows){
	message('对不起，系统未查找到您指定的项目');
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
	var name = document.getElementById("team_name").value;
	if(name.length < 1){
		alert("请您输入要新增的队伍名称");
		document.getElementById("team_name").focus();
		return false;
	}
	var point = document.getElementById("point").value;
	if(point.length < 1){
		alert("请您输入要新增的队伍赔率");
		document.getElementById("point").focus();
		return false;
	}
	return true;
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">冠军管理：查看冠军项目</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<br>
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">联赛名称</td>
    <td colspan="2"><?=$rows["x_title"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">项目名称</td>
    <td colspan="2"><?=$rows["match_name"]?></td>
  </tr>
  <tr>
    <td width="318" bgcolor="#F0FFFF">结束日期</td>
    <td colspan="2"><?=$rows["match_date"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">结束时间</td>
    <td colspan="2"><?=$rows["match_time"]?></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">封盘时间</td>
    <td colspan="2"><?=$rows["match_coverdate"]?></td>
  </tr>
   <tr>
    <td colspan="3" bgcolor="#F0FFFF">&nbsp; </td>
    </tr>
<?php
$sql	=	"select * from t_guanjun_team where xid=".$_GET["id"];
$query	=	$mysqlis->query($sql);
while($rows	= $query->fetch_array()){
?>
   <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" style="background-color:#FFFFFF;">
    <td align="left" bgcolor="#F0FFFF"><?=$rows["team_name"]?></td>
    <td width="296" align="center"><?=$rows["point"]?></td>
    <td width="394" align="center"><a onClick="return confirm('确定删除上子项 <?=$rows["team_name"]?>');" href="team_del.php?tid=<?=$rows["tid"]?>&type=2">删除子项</a></td>
  </tr>
<?php
}
?>
  <tr> <td colspan="3" bgcolor="#F0FFFF">&nbsp; </td>
  </tr>
  <form action="x_show.php?action=add&id=<?=$_GET["id"]?>" method="post" name="form1" onSubmit="return check();">
     <tr>
    <td bgcolor="#F0FFFF">队伍名称</td>
    <td colspan="2"><input type="text" name="team_name" id="team_name" value=""/>
      例如：中国国奥队</td>
  </tr>
   <tr>
    <td bgcolor="#F0FFFF">队伍赔率</td>
    <td colspan="2"><input type="text" name="point" id="point" value=""/>
    例如：2.50</td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">新增</td>
    <td colspan="2"><input type="submit" value="新增队伍"/></td>
  </tr>
</form>
</table>
</body>
</html>