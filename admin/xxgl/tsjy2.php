<?php
include_once("../common/login_check.php");
check_quanxian("xxgl");
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$id	=	0;
if($_GET['id'] > 0){
	$id	=	$_GET['id'];
}
if($_GET["action"]=="add" && $id==0){ 
	  message('未选择消息', "tsjy2.php");
	  exit;
}elseif($_GET["action"]=="edit" && $id>0){
	$remsg		=	strip_tags($_POST["remsg"]);
	$end_time	=	$_POST["end_time"];
	$is_show	=	$_POST["is_show"];
	$sort		=	$_POST["sort"];
	$sql		=	"update message set remsg='$remsg',hftime='$end_time',is_jz=1  where id=$id";
	$mysqli->query($sql);
	  message('回复成功', "tsjy2.php");
} elseif ($_GET["action"] == "del" && $id > 0) {
    $sql		=	"delete from message where nid=$nid";
	$mysqli->query($sql);
}
?>
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>公告管理</TITLE>
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript">
function check_submit(){
	if($("#remsg").val()==""){
		alert("请填回复内容");
		$("#msg").focus();
		return false;
	}
	if($("#end_time").val()==""){
		alert("请填写有效时间");
		$("#end_time").focus();
		return false;
	}
	if($("#sort").val()==""){
		alert("请填写排序值");
		$("#sort").focus();
		return false;
	}
	return true;
}
</script>
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
a{color:#FFA93E;text-decoration: none;}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE3 {color: #339900}
.STYLE4 {color: #FF0000}
</STYLE>
</HEAD>

<body>
<table width="100%" align="center"  id=editProduct   idth="100%" >
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">意见回复：管理网站公告信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
    <form name="form1" onSubmit="return check_submit();" method="post" action="tsjy2.php?id=<?=$id?>&action=<?=$id>0 ? 'edit' : 'add'?>">
<?php
if($id>0 && !isset($_GET['action'])){
	$sql	=	"select * from message where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
   <tr>
    <td  align="left">反馈内容：</td>
    <td colspan="5"  align="left"><textarea  id="msg" name="msg" rows="4" cols="100"><?=@$rs['msg']?></textarea></td>
  </tr>
     <tr>
    <td  align="left">回复内容：</td>
    <td colspan="5"  align="left"><textarea  id="remsg" name="remsg" rows="4" cols="100"><?=@$rs['remsg']?></textarea></td>
  </tr>
  <tr>
    <td width="10%" align="left">回复时间：</td>
    <td width="20%" align="left"><input name="end_time" id="end_time" type="text" value="<?=isset($rs['hftime']) ? $rs['hftime'] : date("Y-m-d H:i:s",time())?>" size="20" maxlength="19"/></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td colspan="5" align="left"><input name="submit" type="submit" value="回复"/></td>
  </tr>
</table>  
    </form>
</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"><tr><td ><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >   
            <tr style="background-color: #EFE">
              <td width="150" align="center"><strong>发布时间</strong></td>
        <td width="150" height="20" align="center"><strong>有效时间</strong></td>
        <td width="400" align="center"><strong>内容</strong></td>
        <td width="400" align="center"><strong>回复内容</strong></td>
        <td width="46" align="center"><strong>状态</strong></td>
        <td width="46" align="center"><strong>编辑</strong></td>
        <td width="46" align="center"><strong>删除</strong></td>
      </tr>
<?php
$sql		=	"select id from message order by id desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$nid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}

if($id){
	$id	=	rtrim($id,',');
	$sql	=	"select * from message where id in($id) order by id desc";
	$query	=	$mysqli->query($sql);
	$time	=	time();
	
	while($rows = $query->fetch_array()){
		$endtime	=	strtotime($rows['hftime']);
?>
      <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
        <td align="center" valign="middle"><?=$rows["addtime"]?></td>
        <td height="20" align="center" valign="middle"><?=$rows["hftime"]?></td>
        <td><?=$rows["msg"]?></td>
           <td><?=$rows["remsg"]?></td>
        <td align="center"><?=$rows['is_jz']==0 ? '<span class="STYLE4">未回复</span>' : '<span class="STYLE3">已回复</span>'?></td>
        <td align="center"><a href="tsjy2.php?id=<?=$rows["id"]?>">回复</a></td>
        <td align="center"><a href="tsjy2.php?id=<?=$rows["id"]?>&action=del" onClick="return confirm('您确定要删除这条公告吗？');">删除</a></td>
      </tr>
<?php
	}
}
?>
    </table></td>
  </tr>
  <tr>
    <td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td>
  </tr>
</table></td></tr>
</table>
</body>
</html>
 