<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/website.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);

$type = intval($_GET['t']);
if ($type < 1) $type = 4;
switch($type) {
    case 1:
        $gmUrl = "Lottery/Cqssc.php";
        break;
    case 2:
        $gmUrl = "Lottery/Jxssc.php";
        break;
    case 3:
        $gmUrl = "Lottery/Xjssc.php";
        break;
    case 4:
        $gmUrl = "Lottery/Pk10.php";
        break;
    case 5:
        $gmUrl = "Lottery/Xyft.php";
        break;
    case 6:
        $gmUrl = "Lottery/Cqsf.php";
        break;
    case 7:
        $gmUrl = "Lottery/gdsf.php";
        break;
    case 8:
        $gmUrl = "Lottery/kl8.php";
        break;
    case 9:
        $gmUrl = "Lottery/3D.php";
        break;
    case 10:
        $gmUrl = "Lottery/pl3.php";
        break;
    case 11:
        $gmUrl = "Six/Six_7_3.php";
        break;
    case 12:
        $gmUrl = "Lottery/xy28.php";
        break;
    case 13:
        $gmUrl = "Lottery/jnd28.php";
        break;
	case 14:
		$gmUrl = "/mysports.php";
		break;
    case 15:
		$gmUrl = "/AgGame/";
		break;
	default:
        $gmUrl = "Lottery/Pk10.php";
}

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$list = $rs['msg'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/main.css">
	<script type="text/javascript" src="js/layer.js"></script>
    <style type="text/css">
        body{background-color: #fff}
		.layui-m-layercont{text-align: left; padding: 20px}
    </style>
</head>
<body>
	<div class="container-fluid route">
		<div class="tit">用户协议</div>
		<div class="main">
			<ul>
				<li>01. 使用本公司网站的客户，请留意阁下所在的国家或居住地的相关法律规定，如有疑问应就相关问题，寻求当地法律意见。</li>
				<li>02. 若发生遭黑客入侵破坏行为或不可抗拒之灾害导致网站故障或资料损坏、资料丢失等情况，我们将以本公司之后备资料为最后处理依据；为确保各方利益，请各会员投注后打印资料。本公司不会接受没有打印资料的投诉。</li>
				<li>03. 为避免纠纷，各会员在投注之后，务必进入下注明细检查及打印资料。若发现任何异常，请立即与代理商联系查证，一切投注将以本公司资料库的资料为准，不得异议。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。</li>
				<li>04. 开奖结果以官方公布的结果为准。</li>
				<li>05. 如遇到官方停止销售或者开奖结果不确定的情况，本公司将对相关注单进行无效处理，并且返还下注本金。</li>
				<li>06. 我们将竭力提供准确而可靠的开奖统计等资料，但并不保证资料绝对无误，统计资料只供参考，并非是对客户行为的指引，本公司也不接受关于统计数据产生错误而引起的相关投诉。</li>
				<li>07. 本公司拥有一切判决及注消任何涉嫌以非正常方式下注之权利，在进行更深入调查期间将停止发放与其有关之任何彩金。客户有责任确保自己的帐户及密码保密，如果客户怀疑自己的资料被盗用，应立即通知本公司，并须更改其个人详细资料。所有被盗用帐号之损失将由客户自行负责。</li>
				<li>以上协议最终解释权归<?=$web_site['web_name']?>所有</li>
			</ul>
		</div>
		<div class="bom">
			<a href="/logout.php">不同意</a>
			<a class="yes" href="<?=$gmUrl?>">同意</a>
		</div>
	</div>
	<script type="text/javascript">
		var t_css = 'margin: 0; background-color: #e9e9e9; border-bottom: 1px solid #ddd';
		layer.open({
			title: ['最新公告', t_css],
			content: '<?=$list?>',
			btn: '知道了'
		});
    </script>
</body>
</html>