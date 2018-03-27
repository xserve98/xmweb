<?php
include_once("../common/login_check.php"); 
check_quanxian("ssgl");

if(@$_GET['action']){
	$msg	=	$_POST['ta_msg'];
	$arr	=	array();
	$arr	=	explode("\r\n",$msg);
	if(count($arr)>0){
		$msg	=	'';
		foreach($arr as $k=>$v){
			$msg.= "'".trim($v)."',";
		}
		$msg	 =	rtrim($msg,',');
		$gp_db	 =	"<?php\r\nunset(\$gp_db);\r\n";
		$gp_db	.=	"\$gp_db=array(".$msg.");\r\n";
		
		if(!write_file("../../cache/gp_db.php",$gp_db.'?>')){ //写入缓存失败
			message("缓存文件写入失败！请先设/cache/gp_db.php文件权限为：0777");
		}
        message("设置成功!");
	}
}

include_once("../../cache/gp_db.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
</head>

<body>
<form id="form1" name="form1" method="post" action="?action=1">
  <table width="100%" border="0">
    <tr>
      <td width="6%">&nbsp;</td>
      <td>请输入您要关盘的联赛编号：</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php
	  $msg	=	'';
	  if(count($gp_db)>0){
	  	foreach($gp_db as $k){
			$msg	.=	$k."\r\n";
		}
		$msg = rtrim($msg,"\r\n");
	  }
	  ?><textarea name="ta_msg" cols="50" rows="20" id="ta_msg"><?=$msg?></textarea>
      不同联赛用换行区分，想要开盘，删除即可。</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="保存设置" /></td>
    </tr>
  </table>
</form>
</body>
</html>