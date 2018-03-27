<?php
session_start();
include_once("../include/mysqli.php");
include_once("../class/user.php");

if($_SESSION["uid"] && user::is_daili($_SESSION["uid"])){ //已登陆
}else{ //未登陆
	echo "<script>window.location.href='../lm/daili.html';</script>";
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>加盟代理</title> 
<link href="../css/tikuan.css" rel="stylesheet" type="text/css"> 
<style type="text/css">
p{ font-size:12px;}
</style>
 <script language="javascript">
  function copyToClipBoard(){
            var url = document.getElementById('txtUrl').value;
            window.clipboardData.setData("Text",url);
			document.getElementById('txtUrl').select();
            alert("地址已经复制到粘贴板!");
        }
 </script>
</head> 
<body class="tuiguang_body"> 
<div class="lefttop_bg">
<table width="780" border="0" cellspacing="0" cellpadding="0">
  
   
  <tr>
    <td align="center" valign="top"><table width="628" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="121" class="red_1" scope="col">代理推广地址： </th>
          <th width="422" align="left" scope="col"><input name="txtUrl" id="txtUrl" value="http://www.ez114.com/?f=<?=$_SESSION["uid"]?>" type="text"  size="50" class="tuiguang" /></th>
          <th width="85" scope="col"><input name="button" type="button" class="subcla1" onclick="copyToClipBoard();" value="复制代码"/></th>
        </tr>
        <tr>
          <th colspan="3" class="red_1" scope="col">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#007100">
                <tr>
                  <td bgcolor="#FFFFFF" class="dldl"><a href="../lm/daili.html" style="color:#0076BD;" >关于代理</a></td>
                  <td bgcolor="#FFFFFF" class="dldl"><a href="../lm/wenti.html" style="color:#0076BD;" >常见问题</a></td>
                  <td bgcolor="#FFFFFF" class="dldl"><a href="../lm/guize.html" style="color:#0076BD;" >合作规则</a></td>
                </tr>
              </table></th>
          </tr>
      </table></td>
  </tr>
  <!---->
  <tr>
    <td valign="top">
	<div id="right_2">
         <p>您有朋友对在线体育博彩感兴趣吗？如果您拥有这么一个强大的网络资源，加入“万丰国际交易所合作伙伴计划”是您的最佳选择。 “万丰国际交易所合作伙伴计划”申请程序简便，而且不收取任何费用。在第一个月您便能获得收入，且您的回报没有任何限额。 </p>
 
    <h1>如何运作？</h1> 
 
          <p>万丰国际交易所提供业界最高的合作回报率。加入“万丰国际交易所合作伙伴计划”无需任何费用，不需承担任何风险。只要您介绍会员到万丰国际交易所，您就可以获得我们净赢利的回报。</p> 
 
    <h1>为何会员选择？</h1> 
 
   
        <p>万丰国际交易所 提供198高水位，让会员享受最有价值的投注。</p> 
        <p>万丰国际交易所 提供全世界的75个联赛，4000多个賽事。 </p>
        <p>万丰国际交易所 提供1500场现场走地赛事给会员尽情享受。</p> 
        <p>万丰国际交易所 提供优质的客户服务，24小时在线为会员答疑解惑。</p>
 
 
    <h1>为何合作伙伴/代理选择？</h1> 
 
  
        <p>万丰国际交易所 有专业的客户服务团队，24小时在线提供服务。</p> 
        <p>万丰国际交易所 有专业的宣传部门及有效的宣传策略，给予合作伙伴最大的回报。</p> 
        <p>万丰国际交易所 只需一个推荐代码，或者一个网址，就可以介绍您的朋友加入我们</p>
        <p>万丰国际交易所 提供多种支付方式以供会员选择。 </p>
        <p>万丰国际交易所 提供下级会员查询功能，让合作伙伴便于查询下级会员。</p>
 
 
    <h1>合作伙伴可赚得什么？</h1> 
 
          <p>万丰国际交易所为您创造一个获利的计划：</p>  

        <p class="hongse">• 高达30％ --50％的回报</p> 

        <p>如果您参加“万丰国际交易所合作伙伴计划”，在体育博彩中，每月您将得到30%--40%的高额回报，根据赢额的不同，您得到的回报也有所不同，具体如下：</p>    
<p>当月盈利 　　&nbsp;&nbsp; 有效会员 &nbsp;&nbsp;　反佣比例</p> 
<p class="hongse">1元以上   &nbsp;&nbsp;  5人以上   &nbsp;&nbsp;    35%-40%（有效会员5-10人按35%结算）</p>
<p class="hongse">250000以上  &nbsp;&nbsp; 25人以上    &nbsp;&nbsp;  45% </p>
<p class="hongse">5000000以上 &nbsp;&nbsp;  50人以上 &nbsp;&nbsp;     50% </p> 

        
<p>例如：
8月份万丰国际交易所从您介绍的会员处获得纯利润100,000元，您将获得100,000元中的35%-40%作为您“合作伙伴计划”的回报，如果9月份万丰国际交易所获得纯利润达到250,001元，您在10月份的回报会增加到45%。</p>
 
    <h1>立刻开始 - 五个简单步骤</h1> 
 
              
<p class="huise">1、详细阅读合约书;</p> 
<p class="huise">2、与24小时在线客服联系, 填写合作伙伴/代理注册表格, 提交;</p> 
<p class="huise">3、您将在3日内收到是否接受您加入“合作伙伴计划”的确认邮件,如果您的申请被接受,邮件内会包含您的代理ID;</p>
<p class="huise">4、开始推荐您的会员; </p>
<p class="huise">5、收到您第一个月的利润！</p> 

    <p>加入“万丰国际交易所合作伙伴计划”,成功不在遥远。
若有任何疑问，请发电子邮件到 <a href="mailto:daili@ez114.com
" title="点击发送邮件" >daili@ez114.com
</a></p> 
	</div>
	
	</td>
  </tr>
 
</table>

</div>

<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body> 
</html>