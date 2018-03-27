<?php
include_once("../common/login_check.php"); 
check_quanxian("cwgl");
include_once("../../include/mysqli.php");

if(isset($_REQUEST["del"])){
	if(isset($_REQUEST["id"])){
		$id = intval($_REQUEST["id"]);
		$sql = "Delete from `fs_level` where id='$id'";
		$mysqli->query($sql);
		message("删除成功!","fs_level.php");
		exit;
	}
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户组列表</TITLE>
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
<script type="text/javascript">
	function del(name) {
		return confirm('您确定要删除：'+name+" 吗？") ? true : false;
	}
</script>
</HEAD>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">返水等级管理：查看返水等级信息</span></font></td>
	</tr>
	<tr>
		<td height="24" align="left" nowrap bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="fs_level_edit.php">新增返水等级</a></td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td height="24" nowrap bgcolor="#FFFFFF">
			<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse:collapse;color:#225d9c;">
				<tr style="background-color:#EFE" class="t-title" align="center">
					<td height="20"><strong>编号</strong></td>
					<td><strong>返水等级</strong></td>
					<td><strong>有效投注</strong></td>
					<td><strong>实际输赢</strong></td>
					<td><strong>体育投注</strong></td>
					<td><strong>彩票游戏</strong></td>
					<td><strong>真人娱乐</strong></td>
					<td><strong>电子游艺</strong></td>
					<td><strong>操作</strong></td>
				</tr>
				<?php
				$sql = "select * from fs_level order by name";
				$query = $mysqli->query($sql);
				while($rows = $query->fetch_array()){
				?>
				<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
					<td><?=$rows['id']?></td>
					<td><?=$rows['name']?></td>
					<td><?=$rows['dml']?>元以上</td>
					<td><?=$rows['win']?>元以上</td>
					<td><?=$rows['ty_rate']?>%</td>
					<td><?=$rows['cp_rate']?>%</td>
					<td><?=$rows['zr_rate']?>%</td>
					<td><?=$rows['dz_rate']?>%</td>
					<td><a href="fs_level_edit.php?id=<?=$rows['id']?>">修改</a> | <a href="?del=1&id=<?=$rows['id']?>" onClick="return del('<?=$rows['name']?>')">删除</a></td>
				</tr>   	
				<?php
				}
				?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>