<?php
session_start();
include_once("../common/login_check.php"); 
check_quanxian("xxgl");
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除短消息 ********************/
$kid	=	0;
if($_GET['kid'] > 0){
	$kid	=	$_GET['kid'];
}
if ($_GET["action"] == "del" && $kid > 0) {
    $sql		=	"delete from k_user_msg where msg_id=$kid";
	$mysqli->query($sql);
}
/******************** 删除短消息 ********************/

$sql		=	"select m.msg_id from k_user_msg m,k_user u where m.uid=u.uid";
if(isset($_GET['username'])) $sql	.=	" and u.username like ('%".$_GET['username']."%')";
if(isset($_GET['title'])) $sql		.=	" and m.msg_title like ('%".$_GET['title']."%')";
$sql		.=	" order by msg_time desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
  $thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$id		=	'';
$i		=	1; //记录 uid 数
$start	=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['msg_id'].',';
  }
  if($i > $end) break;
  $i++;
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>短消息列表</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<style type="text/css">
.STYLE2 {font-size: 12px}
body { margin:0 0 0 0;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">查看系统发送的短消息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" bgcolor="#FFFFFF" ><table width="701" border="0"><form name="form1" method="get" action="msg_list.php">
        <tr>
          <td width="61">会员名：</td>
          <td width="170"><input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="20" maxlength="20">          </td>
          <td width="61">标题：</td>
          <td width="267"><input name="title" type="text" id="title" size="30" maxlength="30" value="<?=$_GET['title']?>"></td>
          <td width="120"><input type="submit" name="Submit" value="搜索"></td>
        </tr>
          </form>
    </table></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#FFFFFF" ><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="15%"  height="20"><strong>用户名</strong></td>
        <td width="53%" ><strong><a href="list.php?order=money"></a></strong><strong>标题</strong></td>
        <td width="16%" ><strong>发送时间</strong></td>
        <td width="8%" ><strong>状态</strong></td>
        <td width="8%" ><strong>删除</strong></td>
        </tr>
      <?php
if($id){
	$id		=	rtrim($id,',');
	$sql	=	"SELECT k.msg_title,k.msg_time,k.islook,k.uid,k.msg_id,u.username FROM k_user_msg k,k_user u where k.uid=u.uid and k.msg_id in($id) order by msg_time desc";
    $query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
?> 	
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td  height="20" align="center"><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a></td>
    <td ><a href="msg_look.php?id=<?=$rows["msg_id"]?>"><?=$rows["msg_title"]?></a></td>
    <td align="center" ><?=$rows["msg_time"]?></td>
    <td align="center" ><?=$rows["islook"] ? '已查看' : '<span style="color: #FF0000;">未查看<span>'?></td>
    <td align="center"><a href="msg_list.php?kid=<?=$rows["msg_id"]?>&action=del" onClick="return confirm('您确定要删除这条短消息吗？');">删除</a></td>
    </tr>
<?php
	}
}
?>
    </table>
    </td>
  </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table></td>
  </tr>
</table>
</body>
</html>