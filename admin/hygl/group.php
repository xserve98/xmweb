<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

if(isset($_REQUEST["del"])){
	if(isset($_REQUEST["id"])){
		$id		=	$_REQUEST["id"];
		$sql	=	"Delete from `k_group` where id=$id";
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				@unlink("../../cache/group_".$id.".php"); //删除缓存文件
			}else{
				$mysqli->rollback(); //数据回滚
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
		header(sprintf("Location: %s", 'group.php')); //重新加载此页面
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
function del(v){
    v=v.split('|')
	if(v[0]>0){
	    alert("该会员组下有会员，请先将该会员组下的会员转移，再来删除该会员组！");
		return false;
	}else{
	    return confirm('您确定要删除：'+v[1]+" 吗？") ? true : false;
	}
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户组权限管理：查看用户组信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="left" nowrap bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="group_edit.php">新增会员组</a> | <a href="list.php">返回会员列表页</a></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="7%"  height="20"><strong>编号</strong></td>
        <td width="47%" ><strong>用户组名称</strong></td>
        <td width="24%" ><strong>会员总数</strong></td>
        <td width="22%" ><strong>操作</strong></td>
      </tr>
      <?php
$sql	=	"select count(u.uid) as uid,g.id,g.name from `k_group` g left join `k_user` u on g.id=u.gid group by g.id order by g.id asc";
$query	=	$mysqli->query($sql);
while($rows = $query->fetch_array()){
      	?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td><?=$rows['id']?></td>
              <td><?=$rows['name']?></td>
	          <td><?=$rows['uid']>0 ? $rows['uid'] : "<span style=\"color:#FF0000;\">".$rows['uid']."</span>" ?></td>
	          <td><a href="group_edit.php?id=<?=$rows['id']?>" >修改</a> | <a href="<?=$rows['uid']>0 ? '#' : '?del=1&id='.$rows['id']?>" onClick="return del('<?=$rows['uid']?>|<?=$rows['name']?>')">删除</a></td>
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