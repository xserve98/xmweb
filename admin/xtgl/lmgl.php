<?php
include_once("../common/login_check.php");
check_quanxian("xtgl");

include_once("../../include/mysqli.php");
	
/**
* 过滤html代码
**/
function htmlEncode($string) { 
	$string=trim($string); 
	$string=str_replace("\'","'",$string); 
	$string=str_replace("&amp;","&",$string); 
	$string=str_replace("&quot;","\"",$string); 
	$string=str_replace("&lt;","<",$string); 
	$string=str_replace("&gt;",">",$string); 
	$string=str_replace("&nbsp;"," ",$string); 
	$string=nl2br($string); 
	//$string=mysql_real_escape_string($string);
	return $string;
}

$id =$_GET['id'];
if(!is_numeric($id))
{
  $id=1;
}

if(@$_GET["action"]=="save"){
	$sql = "update webinfo set title='".$_POST["title"]."',code='".$_POST["code"]."',content='".$_POST["content"]."' where id=".$_POST['autoid']."";
    $mysqli->query($sql) or die ("栏目修改失败");
    message("栏目修改成功!");
}

$sql	=	"select * from webinfo where id=".$id."";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<HTML> 
<HEAD> 
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" /> 
<TITLE>网站栏目设置</TITLE> 
<link rel="stylesheet" href="../Images/CssAdmin.css">
<style type="text/css"> 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 12px;
}
</style> 
</HEAD> 
 
<body> 
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <tr> 
    <td height="24" nowrap background="../images/06.gif"><img src="../images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;栏目管理：修改栏目的相关信息</td> 
  </tr> 
  <tr> 
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <form action="lmgl.php?action=save" method="post" name="editForm1" id="editForm1" > 
  <tr> 
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct idth="100%"> 
      <tr>
        <td colspan="2" style="font-size: 12px;">
            <?php
            $sql = "select * from webinfo";
            $query = $mysqli->query($sql);
            while($rs = $query->fetch_array()){
            ?>
            <a href="?id=<?=$rs["id"]?>"><?=$rs["title"]?></a> |
            <?php
            }
            ?>
        </td> 
      </tr> 
      <tr>
        <td colspan="2" height="10"></td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 栏目名称：</td> 
        <td><input name="title" type="text" class="textfield" id="title"  value="<?=$rows["title"]?>" size="40" >&nbsp;*</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 链接代码：</td> 
        <td><input name="code" type="text" class="textfield" id="code"  value="<?=$rows["code"]?>" size="40" >&nbsp;*</td> 
      </tr>
	          <tr> 
        <td height="20" align="right" >  详细内容：</td> 
        <td>
		<textarea name="content" cols="80" rows="20" class="textfield"><?=$rows["content"]?></textarea></td> 
      </tr> 
      <tr> 
        <td height="30" align="right"><input id="autoid" name="autoid" type="hidden" value="<?=$id?>" /></td> 
        <td valign="bottom"><input name="submitSaveEdit" type="submit" class="button"  id="submitSaveEdit" value="保存" style="width: 60;" ></td> 
      </tr> 
      <tr> 
        <td height="20" align="right">&nbsp;</td> 
        <td valign="bottom">&nbsp;</td> 
      </tr> 
    </table></td> 
  </tr> 
  </form> 
</table></td> 
  </tr> 
</table> 
</body> 
</html> 