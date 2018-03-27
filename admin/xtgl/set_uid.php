<?php
include_once("../common/login_check.php");
check_quanxian("xtgl");

include_once("../cj/db.php");
	
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

if(@$_GET["action"]=="save"){

			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"修改了接水账号配置");
	
            //写配置
			$str	 =	"<?php \r\n";
			$str	.=	"include('mysqlio.php'); \r\n";
			$str	.=	"unset(\$webdb);\r\n";
			$str	.=	"\$webdb			=	array();\r\n";
			$str	.=	"\$webdb['datesite']	=	\"".htmlEncode($_POST["datesite"])."\";\r\n";
			$str	.=	"\$webdb['user']	=	\"".htmlEncode($_POST["user"])."\";\r\n";
			$str	.=	"\$webdb['pawd']	=	\"".htmlEncode($_POST["pawd"])."\";\r\n";
			$str	.=	"\$webdb['uid']	=	\"1\";\r\n";
			$str	.=	"\$sql=\"select cookie from sys_admin\";\r\n";
			$str	.=	"\$query=\$mysqlio->query(\$sql);\r\n";
			$str	.=	"\$rows	=	\$query->fetch_array();\r\n";
			$str	.=	"\$webdb[\"cookie\"]=\$rows['cookie'];\r\n";
			 
			if(@!chmod("../cj/db.php",0777)){ //设置可写入缓存权限
				message("缓存文件写入失败！请先设 ../cj/db.php 文件权限为：0777");
			}
			$waphtstr="\$webdb['wapht']	=	\"".htmlEncode($_POST["wapht"])."\";\r\n";
			if(!write_file("../cj/db.php",$str.$waphtstr.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设../cj/db.php文件权限为：0777");
			}

			if(@!chmod("../../include/db.php",0777)){ //设置可写入缓存权限
				message("缓存文件写入失败！请先设 ../../include/db.php 文件权限为：0777");
			}
			if(!write_file("../../include/db.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设../../include/db.php文件权限为：0777");
			}

			if(@!chmod("../../cj/db.php",0777)){ //设置可写入缓存权限
				message("缓存文件写入失败！请先设 ../../cj/db.php 文件权限为：0777");
			}
			if(!write_file("../../cj/db.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设../../cj/db.php文件权限为：0777");
			}


$curlPost = array () ;
$curlPost ['datesite'] = $_POST["datesite"] ;
$curlPost ['user'] = $_POST["user"] ;
$curlPost ['pawd'] = $_POST["pawd"] ;



$ch = curl_init();//初始化curl
curl_setopt($ch,CURLOPT_URL,$_POST["wapht"].'/config/set_uid.php?action=save');//抓取指定网页
curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
$data = curl_exec($ch);//运行curl
curl_close($ch);
//print_r($data);//输出结果



			message("成功修改接水配置!");
            
}

?>
<HTML> 
<HEAD> 
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" /> 
<TITLE>接水账号设置</TITLE> 
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
    <td height="24" nowrap background="../images/06.gif"><img src="../images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;系统管理：接水账号设置</td> 
  </tr> 
  <tr> 
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <form action="set_uid.php?action=save" method="post" name="editForm1" id="editForm1" > 
  <tr> 
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct idth="100%"> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 接水网址：</td> 
        <td><input name="datesite" type="text" class="textfield" id="datesite"  value="<?=$webdb["datesite"]?>" size="40" >&nbsp;*</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 接水账号：</td> 
        <td><input name="user" type="text" class="textfield" id="user"  value="<?=$webdb["user"]?>" size="40" >&nbsp;*</td> 
      </tr>
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 接水密码：</td> 
        <td><input name="pawd" type="text" class="textfield" id="pawd"  value="<?=$webdb["pawd"]?>" size="40" >&nbsp;*</td> 
      </tr>
	  <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> wap后台：</td> 
        <td><input name="wapht" type="text" class="textfield" id="wapht"  value="<?=$webdb["wapht"]?>" size="40" >&nbsp;*</td> 
      </tr>
      <tr> 
        <td height="30" align="right">&nbsp;</td> 
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