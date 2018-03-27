<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");      
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("../include/config.php");
include_once("../include/mysqli.php");
$username=$_POST['username'];
$uid=intval($_POST['uid']);
$sql="select uid,username,mobile,money from k_user where username='$username' and uid='$uid'";
$query	=	$mysqli->query($sql);
$cou	=	$query->num_rows;
if($cou<=0){
	echo "<script>alert(\"请登录后再进行存款和提款操作\");location.href='http://".$conf_www."/zhuce.php';</script>";
	exit();
}
$rows	=	$query->fetch_array();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>History</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/css_1.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	.dv{ line-height:25px;}
	.body2{
		width: 737px;
		height: auto;
		padding: 10px 0 0 12px;
		margin-left:10px;
		margin-right:10px;
		float:left;
		font-size:12px;
	}
	.tds {
		line-height:25px;
	}
	.STYLE1 {font-weight: bold}
    .STYLE2 {color: #0000FF}
	.STYLE12{ color:#F00}
    </style>
<script language="JAVAScript">
		var $ = function(Id){
            return document.getElementById(Id);
        }
    
       
        //数字验证 过滤非法字符
        function clearNoNum(obj){
	        //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/[^\d.]/g,"");
	        //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/^\./g,"");
	        //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(/\.{2,}/g,".");
	        //保证.只出现一次，而不能出现两次以上
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	        if(obj.value != ''){
	        var re=/^\d+\.{0,1}\d{0,2}$/;
                  if(!re.test(obj.value))   
                  {   
			          obj.value = obj.value.substring(0,obj.value.length-1);
			          return false;
                  } 
	        }
        }
<!--
//去掉空格
function check_null(string) { 
var i=string.length;
var j = 0; 
var k = 0; 
var flag = true;
while (k<i){ 
if (string.charAt(k)!= " ") 
j = j+1; 
k = k+1; 
} 
if (j==0){ 
flag = false;
} 
return flag; 
}
function VerifyData() {
if (document.form1.p3_Amt.value == "") {
			alert("请输入存款金额！")
			document.form1.p3_Amt.focus();
			return false;
}
if (document.form1.p3_Amt.value <99) {
			alert("请至少存入100元！")
			document.form1.p3_Amt.focus();
			return false;
}
}
-->
</script>
</HEAD>
<body id="zhuce_body">
<div class="body2">
<div style="margin-top:10px;margin:10px 0 10px 0;"><span class="STYLE1"><strong>在线冲值</strong></span>&nbsp;&nbsp;&nbsp;<a href="/user/cha_ckonline.php?s_time=<?=date("Y-m-d",time()-1123200)?>&amp;e_time=<?=date("Y-m-d",time())?>" class="len"   style="color:#00F;text-decoration: underline;">冲值记录查看</a></div>

<form id="form1" name="form1" action="PaySubmit.php" method="post" onsubmit="return VerifyData();" target="_blank">
    <table width="720" style="border-collapse:collapse;border:1px solid #CCC;" border="0" cellpadding="1" cellspacing="1" >
                    <tr>
                        <td height="30" align="right"> 用户帐号:</td>
                        <td align="left"><span class="STYLE5">
                        &nbsp;&nbsp;&nbsp;<?=$username;?>
                        </span></td>
                    </tr>
                  <tr>
                    <td height="30" align="right"> 手机号码:</td>
                    <td align="left"><span class="STYLE5">&nbsp;&nbsp;&nbsp;<?=$rows['mobile']?></span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right"> 目前额度:</td>
                    <td align="left"><span class="STYLE5">&nbsp;&nbsp;&nbsp;<?=$rows['money']?></span></td>
                  </tr>                    
                    <tr>
                        <td height="30" align="right"><span class="STYLE12">*</span> 充值金额:</td>
                        <td align="left">&nbsp;&nbsp;&nbsp;<input name="p3_Amt" type="text" id="p3_Amt" style="border:1px solid #CCCCCC;height:18px;line-height:20px; width:118px;" onkeyup="clearNoNum(this);" size="15"/></td>
                    </tr>
                    <tr>
                    <td align="right" height="60"><span class="STYLE12">*</span> 选择银行:</td>
                    <td align="left"><div style="padding-left:20px;">
                     <table width="629" border="0" align="left"  cellpadding="2" cellspacing="0" id="banklist" >
                     
                                <tr>
                                  <td valign="middle"><input name="pd_FrpId" type="radio" value="ICBC" checked="checked" />
                                      <img src="images/gongshang.gif" title="工商银行" alt="工商银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td valign="middle"><input name="pd_FrpId" type="radio" value="ABC" />
                                      <img src="images/nongye.gif" title="中国农业银行"  alt="中国农业银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td valign="middle"><input name="pd_FrpId" type="radio" value="CCB" />
                                      <img src="images/jianshe.gif" title="建设银行" alt="建设银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                          </tr>
                                <tr>
                                  <td><input name="pd_FrpId" type="radio" value="BOCSH" />
                                      <img src="images/zhongguo.gif" title="中国银行" alt="中国银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="BOCOM" />
                                      <img src="images/jiaotong.gif" title="交通银行" alt="交通银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="CEB" />
                                      <img src="images/guangda.gif" title="光大银行" alt="光大银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                </tr>
                                <tr>
                                  <td><input name="pd_FrpId" type="radio" value="CMB">
                                      <img src="images/zhaohang.gif" title="招商银行" alt="招商银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="CMBC" />
                                      <img src="images/minsheng.gif" title="中国民生银行" alt="中国民生银行"  border="0" style="border:1px solid #CCCCCC;" /></td>
                                  <td><input name="pd_FrpId" type="radio" value="GDB" />
                                      <img src="images/guangfa.gif" title="广发银行" alt="广发银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                </tr>
                                <tr>
                                  <td><input name="pd_FrpId" type="radio" value="CIB" />
                                    <img src="images/xingye.gif" title="兴业银行" alt="兴业银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="CNCB" />
                                    <img src="images/zhongxin.gif" title="中信银行" alt="中信银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="PAB" />
                                      <img src="images/pingan.gif" title="平安银行" alt="平安银行"  border="0" style="border:1px solid #CCCCCC;" /></td>
                                </tr>
                                <tr>
                                  <td><input name="pd_FrpId" type="radio" value="BCCB" />
                                    <img src="images/beijing.gif" title="北京银行" alt="北京银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="BOCSH" />
                                    <img src="images/zhongguoda.gif" title="中国银行" alt="中国银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="PSBC" />
                                    <img src="images/youzheng.gif" title="中国邮政" alt="中国邮政"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                </tr>
                              
                                <tr>
                                  <td><input name="pd_FrpId" type="radio" value="SPDB" />
                                    <img src="images/shangpufa.gif"  title="上海浦东发展银行" alt="上海浦东发展银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="BOS" />
                                    <img src="images/shanghaibank.gif"  title="上海银行" alt="上海银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                  <td><input name="pd_FrpId" type="radio" value="HXB" />
                                    <img src="images/huaxia.gif" title="华夏银行" alt="华夏银行"  border="0" style="border:1px solid #CCCCCC;" /> </td>
                                </tr>
                          <tr></tr> 

	      </table>

                     </div>
                    </td>
                    </tr>                  
					<tr><td height="35" align="right">&nbsp;</td>
					<td height="40" align="left" valign="middle">
                      &nbsp;&nbsp; <input name="SubTran"   id="SubTran"  type="submit" value="马上冲值" />					</td>
					</tr>
    </table>
				<input type="hidden" name="pa_MP" id="pa_MP" value="<?=$rows['username']?>" />
		  		<input size="50" type="hidden" name="pr_NeedResponse" id="pr_NeedResponse" value="1" />                 
  </form>
<table width="96%" border="0" cellpadding="0" cellspacing="5">
                <tr >
                  <td align="left" style="padding-top:10px;"><strong class="STYLE1">在线冲值说明：</strong></td>
                </tr>
                <tr>

                  <td align="left">
                  <span class="font-hblack"><span >
                  <div style=" line-height:22px; font-size:12px;">
                  (1).请按表格填写准确的在线冲值信息,确认提交后会进入选择的银行进行在线付款!                  </div>
                  <div style=" line-height:22px;font-size:12px;">
                  (2).交易成功后请点击返回支付网站可以查看您的订单信息!                  </div>
                  <div style=" line-height:22px;font-size:12px;">
                  (3).如有任何疑问,您可以联系 在线客服,金钻国际为您提供365天×24小时不间断的友善和专业客户咨询服务!                 </div>
                  </span>                   </span>                  </td>
   
                </tr>
  </table>              
</div>              
</BODY>
</HTML>
