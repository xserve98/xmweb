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

if(@$_GET["action"]=="save"){
	 
	
	$sqluser	=	"update k_user set fdjishu='".$_POST["fdjishu"]."',fandian='".$_POST["fandian"]."' where is_daili = 1 and dltype = 0 and fxdltype = 0 ";
	 $mysqli->query($sqluser);
	 $sql	=	"update web_config set web_name='".$_POST["web_name"]."',conf_www='".$_POST["conf_www"]."',close='".intval($_POST["close"])."',why='".$_POST["why"]."',reg_msg_title='".$_POST["reg_msg_title"]."',reg_msg_info='".$_POST["reg_msg_info"]."',reg_msg_from='".$_POST["reg_msg_from"]."',ck_limit='".$_POST["ck_limit"]."',qk_limit='".$_POST["qk_limit"]."',fdjishu='".$_POST["fdjishu"]."',fandian='".$_POST["fandian"]."',regoff='".$_POST["regoff"]."',regmoney='".$_POST["regmoney"]."',regsj='".$_POST["regsj"]."',qk_time_begin='".$_POST["qk_time_begin"]."',qk_time_end='".$_POST["qk_time_end"]."'";
	//echo $sql;
    $mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		$q1=1;
		if($q1 == 1){
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"修改了系统参数配置");
	
            //写配置
			$str	 =	"<?php \r\n";
			$str	.=	"unset(\$web_site);\r\n";
			$str	.=	"\$web_site			=	array();\r\n";
			$str	.=	"\$web_site['close']	=	".intval($_POST["close"]).";\r\n";
			$str	.=	"\$web_site['web_name']	=	'".htmlEncode($_POST["web_name"])."';\r\n";
			$str	.=	"\$web_site['why']	=	'".htmlEncode($_POST["why"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_from']	=	'".htmlEncode($_POST["reg_msg_from"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_title']	=	'".htmlEncode($_POST["reg_msg_title"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_msg']	=	'".htmlEncode($_POST["reg_msg_info"])."';\r\n";
			$str	.=	"\$web_site['ck_limit']	=	'".htmlEncode($_POST["ck_limit"])."';\r\n";
			$str	.=	"\$web_site['qk_limit']	=	'".htmlEncode($_POST["qk_limit"])."';\r\n";
			$str	.=	"\$web_site['fdjishu']	=	'".htmlEncode($_POST["fdjishu"])."';\r\n";
			$str	.=	"\$web_site['fandian']	=	'".htmlEncode($_POST["fandian"])."';\r\n";
			
			$str	.=	"\$web_site['regoff']	=	'".htmlEncode($_POST["regoff"])."';\r\n";
			$str	.=	"\$web_site['regmoney']	=	'".htmlEncode($_POST["regmoney"])."';\r\n";
				$str	.=	"\$web_site['regsj']	=	'".htmlEncode($_POST["regsj"])."';\r\n";
			$str	.=	"\$web_site['jf_tzjf']	=	".htmlEncode($_POST["jf_tzjf"]).";\r\n";
			$str	.=	"\$web_site['jf_czjf']	=	".htmlEncode($_POST["jf_czjf"]).";\r\n";
			$str	.=	"\$web_site['jf_min']	=	".htmlEncode(is_numeric($_POST["jf_min"]) ? $_POST["jf_min"] : 0).";\r\n";
			$str	.=	"\$web_site['qk_time_begin']	=	'".htmlEncode($_POST["qk_time_begin"])."';\r\n";
			$str	.=	"\$web_site['qk_time_end']	=	'".htmlEncode($_POST["qk_time_end"])."';\r\n";
			
			$str	.=	"\$web_site['cqssc']	=	".intval($_POST["cqssc"]).";\r\n";
			$str	.=	"\$web_site['jxssc']	=	".intval($_POST["jxssc"]).";\r\n";
			$str	.=	"\$web_site['xjssc']	=	".intval($_POST["xjssc"]).";\r\n";
			$str	.=	"\$web_site['shssl']	=	".intval($_POST["shssl"]).";\r\n";
			$str	.=	"\$web_site['gdklsf']	=	".intval($_POST["gdklsf"]).";\r\n";
			$str	.=	"\$web_site['xync']	=	".intval($_POST["xync"]).";\r\n";
			$str	.=	"\$web_site['pk10']	=	".intval($_POST["pk10"]).";\r\n";
		    $str	.=	"\$web_site['jssc']	=	".intval($_POST["jssc"]).";\r\n";
			$str	.=	"\$web_site['xyft']	=	".intval($_POST["xyft"]).";\r\n";
			$str	.=	"\$web_site['jsxyft']	=	".intval($_POST["jsxyft"]).";\r\n";
			$str	.=	"\$web_site['brnn']	=	".intval($_POST["brnn"]).";\r\n";
			$str	.=	"\$web_site['kl8']	=	".intval($_POST["kl8"]).";\r\n";
			$str	.=	"\$web_site['six']	=	".intval($_POST["six"]).";\r\n";
			$str	.=	"\$web_site['3d']	=	".intval($_POST["3d"]).";\r\n";
			$str	.=	"\$web_site['pl3']	=	".intval($_POST["pl3"]).";\r\n";
			$str	.=	"\$web_site['wfssc']	=	".intval($_POST["wfssc"]).";\r\n";
			$str	.=	"\$web_site['lfssc']	=	".intval($_POST["lfssc"]).";\r\n";
			$str	.=	"\$web_site['ffssc']	=	".intval($_POST["ffssc"]).";\r\n";
			$str	.=	"\$web_site['gd11x5']	=	".intval($_POST["gd11x5"]).";\r\n";
			$str	.=	"\$web_site['jspcdd']	=	".intval($_POST["jspcdd"]).";\r\n";
			$str	.=	"\$web_site['jnd28']	=	".intval($_POST["jnd28"]).";\r\n";
			$str	.=	"\$web_site['xy28']	=	".intval($_POST["xy28"]).";\r\n";
			$str	.=	"\$web_site['cqsix']	=	".intval($_POST["cqsix"]).";\r\n";
	        $str	.=	"\$web_site['xjp28']	=	".intval($_POST["xjp28"]).";\r\n";
			$str	.=	"\$web_site['xjp8']	=	".intval($_POST["xjp8"]).";\r\n";
			$str	.=	"\$web_site['azsf']	=	".intval($_POST["azsf"]).";\r\n";
			$str	.=	"\$web_site['azxy5']	=	".intval($_POST["azxy5"]).";\r\n";
			$str	.=	"\$web_site['azxy8']	=	".intval($_POST["azxy8"]).";\r\n";
			$str	.=	"\$web_site['azxy10']	=	".intval($_POST["azxy10"]).";\r\n";
			$str	.=	"\$web_site['azxy20']	=	".intval($_POST["azxy20"]).";\r\n";
			
			$str	.=	"\$web_site['web_title']	=	'".htmlEncode($_POST["web_title"])."';\r\n";
			$str	.=	"\$web_site['zr_url']	=	'".htmlEncode($_POST["zr_url"])."';\r\n";
			$str	.=	"\$web_site['zh_low']	=	'".intval($_POST["zh_low"])."';\r\n";
			$str	.=	"\$web_site['zh_high']	=	'".intval($_POST["zh_high"])."';\r\n";
			$str	.=	"\$web_site['pk10_ktime']	=	'".$_POST["des_pk10time"]."';\r\n";
			$str	.=	"\$web_site['pk10_knum']	=	'".intval($_POST["des_pk10num"])."';\r\n";
			$str	.=	"\$web_site['kl8_ktime']	=	'".$_POST["des_kl8time"]."';\r\n";
			$str	.=	"\$web_site['kl8_knum']	=	'".intval($_POST["des_kl8num"])."';\r\n";
			$str	.=	"\$web_site['jssc_ktime']	=	'".$_POST["des_jssctime"]."';\r\n";
			$str	.=	"\$web_site['jssc_knum']	=	'".intval($_POST["des_jsscnum"])."';\r\n";
			$str	.=	"\$web_site['jsxyft_ktime']	=	'".$_POST["des_jsxyfttime"]."';\r\n";
			$str	.=	"\$web_site['jsxyft_knum']	=	'".intval($_POST["des_jsxyftnum"])."';\r\n";
			$str	.=	"\$web_site['xjp28_ktime']	=	'".$_POST["des_xjp28time"]."';\r\n";
			$str	.=	"\$web_site['xjp28_knum']	=	'".intval($_POST["des_xjp28num"])."';\r\n";
			$str	.=	"\$web_site['jsscyl']	=	'".$_POST["des_jsscyl"]."';\r\n";
			$str	.=	"\$web_site['jsscylbl']	=	'".$_POST["des_jsscylbl"]."';\r\n";
			$str	.=	"\$web_site['jspcddyl']	=	'".$_POST["des_jspcddyl"]."';\r\n";
			$str	.=	"\$web_site['jspcddylbl']	=	'".$_POST["des_jspcddylbl"]."';\r\n";
			$str	.=	"\$web_site['wfcyl']	=	'".$_POST["des_wfcyl"]."';\r\n";
			$str	.=	"\$web_site['wfcylbl']	=	'".$_POST["des_wfcylbl"]."';\r\n";
			$str	.=	"\$web_site['2fcyl']	=	'".$_POST["des_2fcyl"]."';\r\n";
			$str	.=	"\$web_site['2fcylbl']	=	'".$_POST["des_2fcylbl"]."';\r\n";
	        $str	.=	"\$web_site['ffcyl']	=	'".$_POST["des_ffcyl"]."';\r\n";
			$str	.=	"\$web_site['ffcylbl']	=	'".$_POST["des_ffcylbl"]."';\r\n";
			$str	.=	"\$web_site['cqsixyl']	=	'".$_POST["des_cqsixyl"]."';\r\n";
			$str	.=	"\$web_site['cqsixylbl']	=	'".$_POST["des_cqsixylbl"]."';\r\n";
			$str	.=	"\$web_site['refresh']	=	'".$_POST["des_refresh"]."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou1']	=	'".intval($_POST["zrwh_zhou1"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou2']	=	'".intval($_POST["zrwh_zhou2"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou3']	=	'".intval($_POST["zrwh_zhou3"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou4']	=	'".intval($_POST["zrwh_zhou4"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou5']	=	'".intval($_POST["zrwh_zhou5"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou6']	=	'".intval($_POST["zrwh_zhou6"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou7']	=	'".intval($_POST["zrwh_zhou7"])."';\r\n";
			$str	.=	"\$web_site['zrwh_begin']	=	'".htmlEncode($_POST["zrwh_begin"])."';\r\n";
			$str	.=	"\$web_site['zrwh_end']	=	'".htmlEncode($_POST["zrwh_end"])."';\r\n";
			$str	.=	"\$web_site['web_kfqq']	    =	'".htmlEncode($_POST["web_kfqq"])."';\r\n";
			$str	.=	"\$web_site['web_dlqq']	    =	'".htmlEncode($_POST["web_dlqq"])."';\r\n";
			$str	.=	"\$web_site['web_kfmail']	    =	'".htmlEncode($_POST["web_kfmail"])."';\r\n";
			$str	.=	"\$web_site['web_kf']	    =	'".htmlEncode($_POST["web_kf"])."';\r\n";
			$str	.=	"\$web_site['web_weixin']	    =	'".htmlEncode($_POST["web_weixin"])."';\r\n";
			$str	.=	"\$web_site['web_www']	    =	'".htmlEncode($_POST["web_www"])."';\r\n";
			$str	.=	"\$web_site['web_wap']	    =	'".htmlEncode($_POST["web_wap"])."';\r\n";
			$str	.=	"\$web_site['web_ggtp']	    =	'".htmlEncode($_POST["web_ggtp"])."';\r\n";

			if(!write_file("../../cache/website.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设/website.php文件权限为：0777");
			}
            
            $str2     =    "<?php \r\n";
            $str2    .=    "unset(\$conf_www);\r\n";
            $str2    .=    "\$conf_www            =    '".htmlEncode($_POST["conf_www"])."';\r\n";
              
            
            if(!write_file("../../cache/conf.php",$str2.'?>')){ //写入缓存失败
                message("缓存文件写入失败！请先设/conf.php文件权限为：0777");
            }
			//手机缓存
			if(!write_file("../../m/cache/website.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设/website.php文件权限为：0777");
			}
            if(!write_file("../../m/cache/conf.php",$str2.'?>')){ //写入缓存失败
              message("缓存文件写入失败！请先设/conf.php文件权限为：0777");
            }
		
		include_once("../../cache/website.php");
		$array=array_keys($web_site);
		for($i=0;$i<count($web_site);$i++){
			$content =$web_site[$array[$i]];
			//$sql="INSERT INTO `webinfo` (`code`,`content`) VALUES ('$array[$i]',$web_site[$array[$i]])";
			//$sql	=	"insert into `webinfo` (`code`,`content`) VALUES ('$array[$i]','$content')";
			$sql	=	"update webinfo set content='$content' where code='$array[$i]' ";
			
			$mysqli->query($sql);
			
			
			
		}
		
		
			$mysqli->commit(); //事务提交
            message("网站设置成功!");
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}

$sql	=	"select * from web_config limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
include_once("../../cache/website.php");
///echo 'sdfusygfisaudf---'.$web_site['cqsix'];
?>
<HTML> 
<HEAD> 
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" /> 
<TITLE>网站信息设置</TITLE> 
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
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</HEAD> 
 
<body> 
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <tr> 
    <td height="24" nowrap background="../images/06.gif"><img src="../images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;系统管理：添加，修改站点的相关信息</td> 
  </tr> 
  <tr> 
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <form action="set_site.php?action=save" method="post" name="editForm1" id="editForm1" > 
  <tr> 
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct idth="100%"> 
      <tr> 
        <td width="160" height="30" align="right">&nbsp;</td> 
        <td width="816"><input name="close" type="checkbox" id="close" style='HEIGHT: 13px;width: 13px;' value="1"  <?=$rows["close"]==1 ? 'checked' : ''?> >
          网站关闭&nbsp;（出现攻击时请先关闭再排查）</td> 
      </tr>  
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 网站标题：</td> 
        <td><input name="web_title" type="text" class="textfield" id="web_title"  value="<?=$web_site["web_title"]?>" size="40" >&nbsp;*</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 网站名称：</td> 
        <td><input name="web_name" type="text" class="textfield" id="web_name"  value="<?=$rows["web_name"]?>" size="40" >&nbsp;*</td> 
      </tr>
        <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 客服微信：</td> 
        <td><input name="web_weixin" type="text" class="textfield" id="web_weixin"  value="<?=$web_site["web_weixin"]?>" size="40" >&nbsp;*</td> 
      </tr>	  
     <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 客服Q Q ：</td> 
        <td><input name="web_kfqq" type="text" class="textfield" id="web_kfqq"  value="<?=$web_site["web_kfqq"]?>" size="40" >&nbsp;*</td> 
      </tr>
	  <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 代理Q Q ：</td> 
        <td><input name="web_dlqq" type="text" class="textfield" id="web_dlqq"  value="<?=$web_site["web_dlqq"]?>" size="40" >&nbsp;*</td> 
      </tr>
	  <tr>
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 客服链接：</td> 
        <td><input name="web_kf" type="text" class="textfield" id="web_kf"  value="<?=$web_site["web_kf"]?>" size="40" >&nbsp;*</td> 
      </tr>
	  	  <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 客服邮箱：</td> 
        <td><input name="web_kfmail" type="text" class="textfield" id="web_kfmail"  value="<?=$web_site["web_kfmail"]?>" size="40" >&nbsp;*</td> 
      </tr>
      <tr>
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 电脑域名：</td> 
        <td><input name="web_www" type="text" class="textfield" id="web_www"  value="<?=$web_site["web_www"]?>" size="40" >&nbsp;*&nbsp;不要加http://</td> 
      </tr>
	  <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 手机域名：</td> 
        <td><input name="web_wap" type="text" class="textfield" id="web_wap"  value="<?=$web_site["web_wap"]?>" size="40" >&nbsp;*&nbsp;不要加http://</td> 
      </tr>
	  <tr> 
	    <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 公告图片：</td> 
        <td><input name="web_ggtp" type="text" class="textfield" id="web_ggtp"  value="<?=$web_site["web_ggtp"]?>" size="40" >&nbsp;*&nbsp;不要加http://</td> 
      </tr>
	          <tr> 
        <td height="30" align="right" >  注册消息标题：</td> 
        <td><input name="reg_msg_title" type="text" class="textfield" id="reg_msg_title" value="<?=$rows["reg_msg_title"]?>" size="40"></td> 
      </tr> 
	          <tr> 
        <td height="20" align="right" >  注册消息内容：</td> 
        <td>
		<textarea name="reg_msg_info" cols="80" rows="10" class="textfield"><?=$rows["reg_msg_info"]?></textarea></td> 
      </tr> 
	          <tr> 
        <td height="30" align="right" >  注册消息发送者：</td> 
        <td><input name="reg_msg_from" type="text" class="textfield" id="reg_msg_from" value="<?=$rows["reg_msg_from"]?>" size="40"></td> 
      </tr> 
	          <tr> 
        <td height="20" align="right" >  网站关闭原因：</td> 
        <td>
		<textarea name="why" cols="80" class="textfield" rows="2" id="why" ><?=$rows["why"]?></textarea></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  可取款时间：</td> 
        <td>
            <input name="qk_time_begin" type="text" class="textfield" maxlength="5" id="qk_time_begin" value="<?=$rows["qk_time_begin"]?>" size="4">
            ~
            <input name="qk_time_end" type="text" class="textfield" maxlength="5" id="qk_time_end" value="<?=$rows["qk_time_end"]?>" size="4">
        </td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  在线支付最低存款：</td> 
        <td><input name="ck_limit" type="text" class="textfield" maxlength="10" id="ck_limit" value="<?=$rows["ck_limit"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  最低取款：</td> 
        <td><input name="qk_limit" type="text" class="textfield" maxlength="10" id="qk_limit" value="<?=$rows["qk_limit"]?>" size="10"></td> 
      </tr>
	   <!--tr> 
        <td height="30" align="right" >分享反水层数：</td> 
        <td><input name="fdjishu" type="text" class="textfield" maxlength="10" id="fdjishu" value="<?=$rows["fdjishu"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >单层反水比例：</td> 
        <td><input name="fandian" type="text" class="textfield" maxlength="10" id="fandian" value="<?=$rows["fandian"]?>" size="10">%</td> 
      </tr-->
      <tr> 
        <td height="30" align="right" >注册送金设置：</td> 
        <td>  <label>
      <select name="regoff" id="regoff">
     <option value="<?=$rows["regoff"]?>" ><? if($rows["regoff"]==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
      <option value="<? if($rows["regoff"]==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" ><? if($rows["regoff"]==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
    
  
      </select>
    </label></td>
      </tr>
      
      <tr> 
        <td height="30" align="right" >注册送金金额：</td> 
        <td><input name="regmoney" type="text" class="textfield" maxlength="10" id="regmoney" value="<?=$rows["regmoney"]?>" size="10"></td> 
      </tr>
             <tr style="display:none"> 
        <td height="30" align="right" >新用户默认上级ID：</td> 
        <td><input name="regsj" type="text" class="textfield" maxlength="10" id="regsj" value="<?=$web_site["regsj"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  投注积分：</td> 
        <td>投注<strong style="color:#F00">1元</strong>赠送 <input name="jf_tzjf" type="text" class="textfield" maxlength="10" id="jf_tzjf" value="<?=$web_site["jf_tzjf"]?>" size="5">积分</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  充值积分：</td> 
        <td>充值<strong style="color:#F00">1元</strong>赠送 
          <input name="jf_czjf" type="text" class="textfield" maxlength="10" id="jf_czjf" value="<?=$web_site["jf_czjf"]?>" size="5">积分</td> 
      </tr>
      <tr style="display:none"> 
        <td height="30" align="right" >  最低兑换积分：</td> 
        <td> <input name="jf_min" type="text" class="textfield" maxlength="10" id="jf_min" value="<?=$web_site["jf_min"]?>" size="5"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  采种关闭：</td> 
        <td>
<input name="pk10" type="checkbox" <?=$web_site['pk10']==1 ? 'checked' : ''?> id="pk10" value="1" />北京赛车(PK10)
<input name="jssc" type="checkbox" <?=$web_site['jssc']==1 ? 'checked' : ''?> id="jssc" value="1" />极速赛车(PK10)
<input name="wfssc" type="checkbox" <?=$web_site['wfssc']==1 ? 'checked' : ''?> id="wfssc" value="1" />澳洲五分彩
<input name="lfssc" type="checkbox" <?=$web_site['lfssc']==1 ? 'checked' : ''?> id="lfssc" value="1" />幸运2分彩
<input name="ffssc" type="checkbox" <?=$web_site['ffssc']==1 ? 'checked' : ''?> id="ffssc" value="1" />极速分分彩 
<input name="cqssc" type="checkbox" <?=$web_site['cqssc']==1 ? 'checked' : ''?> id="cqssc" value="1" />重庆时时彩
<input name="jxssc" type="checkbox" <?=$web_site['jxssc']==1 ? 'checked' : ''?> id="jxssc" value="1" />天津时时彩
<input name="xjssc" type="checkbox" <?=$web_site['xjssc']==1 ? 'checked' : ''?> id="xjssc" value="1" />新疆时时彩
<input name="shssl" type="checkbox" <?=$web_site['shssl']==1 ? 'checked' : ''?> id="shssl" value="1" />上海时时乐<br>
<input name="xyft" type="checkbox" <?=$web_site['xyft']==1 ? 'checked' : ''?> id="xyft" value="1" />幸运飞艇
<input name="jsxyft" type="checkbox" <?=$web_site['jsxyft']==1 ? 'checked' : ''?> id="jsxyft" value="1" />极速幸运飞艇
<input name="gdklsf" type="checkbox" <?=$web_site['gdklsf']==1 ? 'checked' : ''?> id="gdklsf" value="1" />广东快乐十分
<input name="xync" type="checkbox" <?=$web_site['xync']==1 ? 'checked' : ''?> id="xync" value="1" />重庆幸运农场
<input name="kl8" type="checkbox" <?=$web_site['kl8']==1 ? 'checked' : ''?> id="kl8" value="1" />北京快乐8
<input name="3d" type="checkbox" <?=$web_site['3d']==1 ? 'checked' : ''?> id="3d" value="1" />福彩3D
<input name="pl3" type="checkbox" <?=$web_site['pl3']==1 ? 'checked' : ''?> id="pl3" value="1" />排列三
<input name="xy28" type="checkbox" <?=$web_site['xy28']==1 ? 'checked' : ''?> id="xy28" value="1" />PC蛋蛋
<input name="jnd28" type="checkbox" <?=$web_site['jnd28']==1 ? 'checked' : ''?> id="jnd28" value="1" />加拿大28
<input name="xjp28" type="checkbox" <?=$web_site['xjp28']==1 ? 'checked' : ''?> id="xjp28" value="1" />新加坡28
<input name="jspcdd" type="checkbox" <?=$web_site['jspcdd']==1 ? 'checked' : ''?> id="jspcdd" value="1" />极速PC蛋蛋<br>
<input name="gd11x5" type="checkbox" <?=$web_site['gd11x5']==1 ? 'checked' : ''?> id="gd11x5" value="1" />广东11选5
<input name="brnn" type="checkbox" <?=$web_site['brnn']==1 ? 'checked' : ''?> id="brnn" value="1" />百人牛牛
<input name="six" type="checkbox" <?=$web_site['six']==1 ? 'checked' : ''?> id="six" value="1" />香港六合彩
<input name="cqsix" type="checkbox" <?=$web_site['cqsix']==1 ? 'checked' : ''?> id="cqsix" value="1" />极速六合彩
<input name="xjp8" type="checkbox" <?=$web_site['xjp8']==1 ? 'checked' : ''?> id="xjp8" value="1" />新加坡快乐8
<input name="azsf" type="checkbox" <?=$web_site['azsf']==1 ? 'checked' : ''?> id="azsf" value="1" />澳洲快乐十分
<input name="azxy5" type="checkbox" <?=$web_site['azxy5']==1 ? 'checked' : ''?> id="azxy5" value="1" />澳洲幸运5
<input name="azxy8" type="checkbox" <?=$web_site['azxy8']==1 ? 'checked' : ''?> id="azxy8" value="1" />澳洲幸运8
<input name="azxy10" type="checkbox" <?=$web_site['azxy10']==1 ? 'checked' : ''?> id="azxy10" value="1" />澳洲幸运10
<input name="azxy20" type="checkbox" <?=$web_site['azxy20']==1 ? 'checked' : ''?> id="azxy20" value="1" />澳洲幸运20</td>
      </tr>
      <tr> 
        <td height="30" align="right" >  北京赛车期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['pk10_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_pk10time" id="des_pk10time" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['pk10_knum']?>" size="10" name="des_pk10num" id="des_pk10num" />(例如:2013-06-30开的最后一期是369979)</td> 
      </tr>
	        <tr> 
        <td height="30" align="right" >  极速赛车期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['jssc_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_jssctime" id="des_jssctime" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['jssc_knum']?>" size="10" name="des_jsscnum" id="des_jsscnum" />(例如:2013-06-30开的最后一期是369979)</td> 
      </tr>
      <tr>
         <tr> 
        <td height="30" align="right" >  极速幸运飞艇期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['jsxyft_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_jsxyfttime" id="des_jsxyfttime" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['jsxyft_knum']?>" size="10" name="des_jsxyftnum" id="des_jsxyftnum" />(例如:2013-06-30开的最后一期是369979)</td> 
      </tr>
      <tr>	  
        <td height="30" align="right" >  北京快乐8期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['kl8_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_kl8time" id="des_kl8time" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['kl8_knum']?>" size="10" name="des_kl8num" id="des_kl8num" />(例如:2013-05-30开的最后一期是569859)</td> 
      </tr>
        <tr style="display:none"> 
        <td height="30" align="right" > 新加坡28期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['xjp28_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_xjp28time" id="des_xjp28time" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['xjp28_knum']?>" size="10" name="des_xjp28num" id="des_xjp28num" />(例如:2013-05-30开的最后一期是569859)</td> 
      </tr>
        <tr> 
        <td height="30" align="right" >注单页面刷新频率：</td> 
          <td> <input name="des_refresh" type="text" class="textfield" maxlength="10" id="des_refresh" value="<?=$web_site["refresh"]?>" size="5">秒</td> 
      </tr>
	  
	              <tr> 
        <td height="30" align="right" >极速赛车盈利控制：</td> 
        <td>  <label>
      <select name="des_jsscyl" id="des_jsscyl">
     <option value="<?=$web_site['jsscyl']?>"><? if($web_site['jsscyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['jsscyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['jsscyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['jsscylbl']?>" size="10" maxlength="10" name="des_jsscylbl" id="des_jsscylbl" />%</td>
      </tr>
      
       <tr> 
        <td height="30" align="right" >极速PC蛋蛋盈利控制：</td> 
        <td>  <label>
      <select name="des_jspcddyl" id="des_jspcddyl">
     <option value="<?=$web_site['jspcddyl']?>"><? if($web_site['jspcddyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['jspcddyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['jspcddyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['jspcddylbl']?>" size="10" maxlength="10" name="des_jspcddylbl" id="des_jspcddylbl" />%</td>
      </tr>
	  
	  <tr> 
        <td height="30" align="right" >澳洲五分彩盈利控制：</td> 
        <td>  <label>
      <select name="des_wfcyl" id="des_wfcyl">
     <option value="<?=$web_site['wfcyl']?>"><? if($web_site['wfcyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['wfcyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['wfcyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['wfcylbl']?>" size="10" maxlength="10" name="des_wfcylbl" id="des_wfcylbl" />%</td>
      </tr>
	  
       <tr> 
        <td height="30" align="right" >幸运2分彩盈利控制：</td> 
        <td>  <label>
      <select name="des_2fcyl" id="des_2fcyl">
     <option value="<?=$web_site['2fcyl']?>"><? if($web_site['2fcyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['2fcyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['2fcyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['2fcylbl']?>" size="10" maxlength="10" name="des_2fcylbl" id="des_2fcylbl" />%</td>
      </tr>
      
       <tr> 
        <td height="30" align="right" >极速分分彩盈利控制：</td> 
        <td>  <label>
      <select name="des_ffcyl" id="des_ffcyl">
     <option value="<?=$web_site['ffcyl']?>"><? if($web_site['ffcyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['ffcyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['ffcyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['ffcylbl']?>" size="10" maxlength="10" name="des_ffcylbl" id="des_ffcylbl" />%</td>
      </tr>
      
       <tr> 
        <td height="30" align="right" >极速六合彩盈利控制：</td> 
        <td>  <label>
      <select name="des_cqsixyl" id="des_cqsixyl">
     <option value="<?=$web_site['cqsixyl']?>"><? if($web_site['cqsixyl']==0){
		 echo '关闭';
		 }else{
			  echo '开启';
			 }?></option>
             
      <option value="<? if($web_site['cqsixyl']==0){
		 echo 1;
		 }else{
			  echo 0;
			 }?>" >
			 
			 <? if($web_site['cqsixyl']==0){
		 echo '开启';
		 }else{
			  echo '关闭';
			 }?></option>
      </select>
    </label><input type="text" class="textfield" value="<?=$web_site['cqsixylbl']?>" size="10" maxlength="10" name="des_cqsixylbl" id="des_cqsixylbl" />%</td>
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