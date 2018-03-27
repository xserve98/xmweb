<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>危险手机号码</title>
</head>

<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
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
<body>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
    <td><strong>手机号码</strong></td>
    <td><strong>会员个数</strong></td>
  </tr>
<?php
$sql	=	"SELECT DISTINCT count(*) AS s,mobile FROM k_user GROUP BY mobile";
$query	=	$mysqli->query($sql);
while($row = $query->fetch_array()){
	if($row['s'] > 1){
?>
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td align="center"><a href="list.php?selecttype=mobile&likevalue=<?=$row['mobile']?>"><?=$row['mobile']?></a></td>
    <td align="center"><?=$row['s']?></td>
  </tr>
<?php
	}
}
?>
</table>
</body>
</html>
