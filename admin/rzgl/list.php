<?php
include_once("../common/login_check.php");
check_quanxian("rzgl");
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除 ********************/
if ($_GET["action"] == "del") {
    $sql		=	"delete from sys_log";
	$mysqlio->query($sql);
}
/******************** 删除 ********************/
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>管理员日志管理</TITLE>
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
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">日志管理：查看系统管理员的后台操作情况</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
          <form name="form1" method="get" action="list.php"><table width="849">
      <tr align="center">
        <td width="90" align="left"><a href="list.php?action=del" onClick="return confirm('确认清空全部日志吗？删除后不可恢复，请谨慎操作！');">清空全部日志</a></td>
        <td width="60" align="left"><a href="list.php?1=1">个人日志</a></td>
        <td width="90" align="left"><a href="list.php?show=all">系统全部日志</a></td>
        <td width="90" align="left"><select name="show" id="show" >
          <option value="all">查看用户</option>
<?php
$admin	=	array();
$sql	=	"select uid,login_name from sys_admin order by uid desc";
$query	=	$mysqlio->query($sql);
while($rows = $query->fetch_array()){
	$admin[$rows['uid']]	=	$rows['login_name'];
?>
          <option value="<?=$rows["uid"]?>" <?=$_GET['show']==$rows["uid"] ? 'selected="selected"' : ''?>><?=$rows["login_name"]?></option>
<?php
}
?>
        </select></td>
        <td width="160" align="left">IP：<label><input name="ip" type="text" id="ip" size="15" maxlength="20" value="<?=$_GET['ip']?>"></label></td>
        <td width="200" align="left">内容：<input name="info" type="text" id="info" size="20" maxlength="20"  value="<?=$_GET['info']?>"></td>
        <td width="80" align="left"><input type="submit" name="Submit" value="提交"></td>
      </tr>
    </table>
          </form></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
	
	<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct  >
         <tr  class="t-title" align="center" >
        <td width="9%"   ><strong>编号</strong></td>
        <td width="10%"   ><strong>用户名</strong></td>
        <td width="47%"  ><strong>操作记录</strong></td>
        <td width="18%"   ><strong>操作ip</strong></td>
        <td width="16%"   ><strong>操作时间</strong></td>
        </tr>
<?php
	  $sql	=	"select log_id from sys_log where log_id>0";
	  if($_GET["show"]>0){
	  	  $sql .= " and uid=".$_GET["show"];
	  }elseif($_GET["show"] == 'all'){ //什么都不做
	  }else{
	  	  $sql .= " and uid=".$_SESSION["adminid"];
	  }
	  if($_GET['ip']){
	  	  $sql .= " and log_ip='".$_GET['ip']."'";
	  }
	  if($_GET['info']){
	  	  $sql .= " and log_info like('%".$_GET['info']."%')";
	  }
	  $sql .=	" order by log_id desc";
	 
	  $query	=	$mysqlio->query($sql);
	  $sum		=	$mysqlio->affected_rows; //总页数
	  $thisPage	=	1;
	  if($_GET['page']){
	  	  $thisPage	=	$_GET['page'];
	  }
      $page		=	new newPage();
	  $thisPage	=	$page->check_Page($thisPage,$sum,40,40);
	  
	  $id		=	'';
	  $i		=	1; //记录 uid 数
	  $start	=	($thisPage-1)*40+1;
	  $end		=	$thisPage*40;
	  while($row = $query->fetch_array()){
	  	  if($i >= $start && $i <= $end){
	  	  	$id .=	$row['log_id'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  if($id){
	 	  $id	=	rtrim($id,',');
		  $sql	=	"select * from sys_log where log_id in($id) order by log_id desc";
     	  $query=	$mysqlio->query($sql);
		  while($rows = $query->fetch_array()){
      	?>
	        <tr align="center"  onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td height="40"  ><?=$rows["log_id"]?></td>
              <td><?=$admin[$rows["uid"]]?></td>
              <td><font color="#FF0000"><?=$rows["log_info"]?></font></td>
              <td><?=$rows["bet_info"]?><?=$rows["log_ip"]?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["log_time"]))?></td>
        </tr> 	
      	<?
      		}
	}
      ?>
    </table></td>
  </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table>
</body>
</html>