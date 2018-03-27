<?php
session_start();
include_once("../../cache/website.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>自动结算</title>
 <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style>
</head>
<body>
<script> 
<!-- 
var limit="6:00" 
if (document.images){ 
	var parselimit=limit.split(":") 
	parselimit=parselimit[0]*60+parselimit[1]*1 
} 
function beginrefresh(){ 
	if (!document.images) 
		return 
	if (parselimit==1) 
		window.location.reload() 
	else{ 
		parselimit-=1 
		curmin=Math.floor(parselimit/60) 
		cursec=parselimit%60 
		if (curmin!=0) 
			curtime=curmin+"分"+cursec+"秒后自动登陆！" 
		else 
			curtime=cursec+"秒后自动登陆！" 
		//	timeinfo.innerText=curtime 
			setTimeout("beginrefresh()",1500) 
	} 
} 
window.onload=beginrefresh 
//--> 
</script>
<table width="950" height="450"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
<br><br>
    <?php if (intval($web_site['jnd28']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/jnd28.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['xy28']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/xy28.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['xjp28']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/xjp28.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['jspcdd']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/auto_26.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['brnn']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/niuniu.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
  </tr>
  <tr> 
	<?php if (intval($web_site['pk10']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/bjpk.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['xyft']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/xyft.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['jsxyft']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/jsxyft.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['xync']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/xync.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['xjp8']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/xjp8.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['kl8']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/kl8.php'  frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
  </tr>
  <tr> 
	
  </tr>
  <tr>
	<?php if (intval($web_site['jxssc']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/tjssc.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['cqssc']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/cqssc.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['xjssc']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/xjssc.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['shssl']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/shssl.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>

  </tr>
  <tr>
	<?php if (intval($web_site['ffssc']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/ffc.php'  frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['lfssc']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/lfc.php'  frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['wfssc']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/wfc.php'  frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['azsf']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/azsf.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
 </tr>
   <tr>
	<?php if (intval($web_site['cqsix']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/cqsix.php'   frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['six']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/six.php'     frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['jssc']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/auto_24.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
	<?php if (intval($web_site['gd11x5']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/gd11x5.php' frameborder=0 scrolling="no"></iframe></td>
		<?php } ?>
  </tr>
  <tr>
	<?php if (intval($web_site['3d']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/3d.php'   frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['pl3']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/pl3.php'  frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['gdklsf']) == 1) { ?>
	<?php } else { ?>
    <td height="80" valign="top"><iframe width=280 height=80 src='lottery/gdsf.php' frameborder=0 scrolling="no"></iframe></td>
    <?php } ?>
  </tr>
   <!--tr>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/js3.php'     frameborder=0 scrolling="no"></iframe></td>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/jsk3.php' frameborder=0 scrolling="no"></iframe></td>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/gxk3.php' frameborder=0 scrolling="no"></iframe></td>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/shk3.php' frameborder=0 scrolling="no"></iframe></td>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/fjk3.php' frameborder=0 scrolling="no"></iframe></td>
  </tr-->
   <tr>
	<?php if (intval($web_site['azxy5']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/azxy5.php'  frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['azxy8']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/azxy8.php'  frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['azxy10']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/azxy10.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
	<?php if (intval($web_site['azxy20']) == 1) { ?>
	<?php } else { ?>
	<td height="80" valign="top"><iframe width=280 height=80 src='lottery/azxy20.php' frameborder=0 scrolling="no"></iframe></td>
	<?php } ?>
  </tr>
</table>
</body>
</html>