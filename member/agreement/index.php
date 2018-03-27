
<?php
session_start();
include_once("../../include/mysqli.php");
include_once("../../include/config.php");
include_once("../../common/login_check.php");
include_once("../../common/logintu.php");
include_once("../../common/function.php");
include_once("../../cache/website.php");

$lm      = 'route';
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
?>
<!DOCTYPE html>
<html>
<head>
<meta name=”viewport” content=”width=device-width, initial-scale=1″ />
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<title>Welcome</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/libs.js"></script>
<script type="text/javascript" src="js/skin.js"></script>
<link rel="stylesheet" type="text/css" href="css/agreement.css" />
<script type="text/javascript"></script>
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
<body class="skin_blue">
<div class="user_win">
	<div class="agree_win"> 
        <div class="user_logo"></div>
        <ul>
        	<li class="user_wintitle">用户协议</li>
            <li class="user_winmain">
            	<div class="win_info">
                	<ul>
                		<li>● 01. 为避免出现争议，请您务必在下注之后查看「最新注单」。</li>
                        <li>● 02. 任何投诉必须在开奖之前，本系统不接受任何开奖之后的投诉。</li>
                        <li>● 03. 公布赔率时出现的任何打字错误或非故意人为失误，所有（相关）注单一律不算。</li>
                        <li>● 04. 公布之所有赔率为浮动赔率，下注时请确认当前赔率及金额，下注确认后一律不能修改。</li>
                        <li>● 05. 开奖后接受的投注，一律视为投机漏洞，[本局注单一律不返还本金及盈利]，敬请会员遵守游戏规则。</li>
                        <li>● 06. 若本后台发现客户以不正当的手法投注或投注注单不正常，后台将有权「取消」相应之注单，客户不得有任何异议。</li>
                        <li>● 07. 如因软件或线路问题导致交易内容或其他与账号设定不符合的情形，请在开奖前立即与本后台联络反映问题，否则本后台将以资料库中的数据为准。</li>
                        <li>● 08. 倘若发生遭黑客入侵破坏行为或不可抗拒之灾害致网站故障或资料损坏、数据丢失等情况，后台将以资料库数据为依据。</li>
                        <li>● 09. 各级管理人员及客户必须对本系统各项功能进行了解及熟悉，任何违反正常使用的操作，后台概不负责。</li>
                        <li>● 10. 请认真了解各款彩票游戏规则。</li>
                        <li class="ftcolor_red">● 11. 如果会员信用额度超额或者为负数引起的争议，一律以公司处理为准。</li>
                        <li>● 12. 客户有责任确保自己的账户及密码保密，如果因客户的账户、密码简单，或因泄露导致被盗用，造成的损失由客户本人承担；同时应立即通知本公司，并更改其个人详细资料。</li>
                        <li>● 13. 若官方福彩中心开奖错误导致本系统采集数据同时出错情况下当期错误的所有注单以福彩中心官方网站更改后的数据为标准重新结算！在此特别声明，客户不得有任何异议。</li>
                        <li>以上协议解释权归本系统所有。</li>
                        <li class="user_winbu">
						<div><span>
						<a class="yes" href="javascript:void(0)" onclick="agree();">同意</a></span>
						<a class="no" href="/logout.php">不同意</a>
						</div>
						</li>
                	</ul>
            	</div>
            </li>
            <li class="user_winfooter"></li>        
        </ul>
    </div>
</div>
<script type="text/javascript">
    function agree() {
        var n = $(".news");
        if(n.find("li").length > 0) {
            layer.open({
                type: 1,
                area: '500px',
				shift: -1,
                btn: '知道了',
                title: '重要公告',
                content: n,
                yes: function(i) {
                    layer.close(i);
                    location.replace("/member/index/");
                }
            });
        } else {
            location.replace("/member/index/");
        }
    }
</script>
<script src="js/core.js" type="text/javascript"></script><script src="js/core.php"></script>
</body></html>