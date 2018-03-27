<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$lm='ag2';
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="images/member.css"/>
    <script type="text/javascript" src="../skin/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/userinfo.css">
	<!--[if IE 6]><script type="text/javascript" src="images/DD_belatedPNG.js"></script><![endif]-->
	<script language="javascript">
		function check_form(){
			if($("#about").val().length<=20){
				alert("请填写合适的申请理由，至少要输入20个字！");
				$("#about").select();
				return false;
			}
			
			if(!$("#fuhe").is(':checked')){
				alert("请确认您已年满18岁！");
				$("#fuhe").select();
				return false;
			}
		}
	</script>
</head>
<body>
<?php 
include_once("mainmenu.php");
include_once("agentsubmenu.php");?>
<div class="content">
<div id="waikuan4">

  <div class="shuoming4">
  
  
         <p>您有朋友对在线体育博彩感兴趣吗？如果您拥有这么一个强大的网络资源，加入“
           乐博国际           交易所合作伙伴计划”是您的最佳选择。 “
           乐博国际          交易所合作伙伴计划”申请程序简便，而且不收取任何费用。在第一个月您便能获得收入，且您的回报没有任何限额。 </p>
         <p><strong>如何运作？</strong></p>
         <p>
           乐博国际           交易所提供业界最高的合作回报率。加入“
           乐博国际           交易所合作伙伴计划”无需任何费用，不需承担任何风险。只要您介绍会员到
           乐博国际           交易所，您就可以获得我们净赢利的回报。</p>
         <p><strong>为何会员选择？</strong></p>
         <p>
           乐博国际           交易所 提供198高水位，让会员享受最有价值的投注。</p>
         <p>
           乐博国际           交易所 提供全世界的75个联赛，4000多个賽事。 </p>
         <p>
           乐博国际           交易所 提供1500场现场走地赛事给会员尽情享受。</p>
         <p>
           乐博国际           交易所 提供优质的客户服务，24小时在线为会员答疑解惑。</p>
         <p><strong>为何合作伙伴/代理选择？</strong></p>
         <p>
           乐博国际           交易所 有专业的客户服务团队，24小时在线提供服务。</p>
         <p>
           乐博国际           交易所 有专业的宣传部门及有效的宣传策略，给予合作伙伴最大的回报。</p>
         <p>
           乐博国际           交易所 只需一个推荐代码，或者一个网址，就可以介绍您的朋友加入我们</p>
         <p>
           乐博国际           交易所 提供多种支付方式以供会员选择。 </p>
         <p>
           乐博国际           交易所 提供下级会员查询功能，让合作伙伴便于查询下级会员。</p>
         <p><strong>合作伙伴可赚得什么？</strong></p>
         <p>
           乐博国际           交易所为您创造一个获利的计划：</p>
         <p class="hongse">• 高达30％ --50％的回报</p>
         <p>如果您参加“
           乐博国际           交易所合作伙伴计划”，在体育博彩中，每月您将得到30%--50%的高额回报，根据赢额的不同，您得到的回报也有所不同，具体如下：</p>
         <p>每月的纯赢额 　　&nbsp;&nbsp;　回报（百分比）</p>
         <p class="hongse">1元 - 50,000元 　　　&nbsp;&nbsp;&nbsp; 30%</p>
         <p class="hongse">50,001元 - 500,000元 　　&nbsp; 35%</p>
         <p class="hongse">500,001元- 1,000,000元　&nbsp;&nbsp;40%</p>
         <p class="hongse">大于1,000,000元 　　　　　　50%</p>
         <p>例如：
           8月份
           乐博国际           交易所从您介绍的会员处获得纯利润100,000元，您将获得100,000元中的30%作为您"合作伙伴计划"的回报，如果9月份
           乐博国际           交易所获得纯利润达到500,000元，您在10月份的回报会增加到35%。</p>
         <p><strong>立刻开始 - 五个简单步骤</strong></p>
         <p class="huise">1、详细阅读合约书;</p>
         <p class="huise">2、与24小时在线客服联系, 填写合作伙伴/代理注册表格, 提交;</p>
         <p class="huise">3、您将在24小时内收到是否接受您加入“合作伙伴计划”的确认邮件,如果您的申请被接受,邮件内会包含您的代理ID;</p>
         <p class="huise">4、开始推荐您的会员; </p>
         <p class="huise">5、收到您第一个月的利润！</p>
         <p>加入“
           乐博国际           交易所合作伙伴计划”,成功不在遥远。
           若有任何疑问，请联系在线客服</p>
  </div>
</div>
</div>
</body>
</html>