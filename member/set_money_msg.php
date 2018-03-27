<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("pay/moneyconfig.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$sub = 1;
$amount=$_GET['amount'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>订单信息</title>
<link rel="stylesheet" href="/newdsn/css/cash/master.css">
<link rel="stylesheet" href="/newdsn/css/cash/style.css">
<link rel="stylesheet" href="/newdsn/css/cash/popup.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
    </head>
<body>            
  <div class="popup">
    <div class="popupinternal order-submit">
      <div class="loading-container">
        <h4>支付信息</h4>
        <p>支付方式：在线支付</p>
		<p>支付金额：￥ <?=$amount?> 元</p>
		<p>
          1. 成功付款后将会自动到帐，并弹出到帐提示。<br>
          2. 长时间无反应，请点击下方联系在线客服。
        </p>
      </div>

      <div class="button-container">
        <a target="frame" href="/member/data_h_money.php" class="btn-blue button">查看交易</a>
        <a target="_blank" href="<?=$web_site['web_kf']?>" class="btn-blue button">联系客服</a>
      </div>

    </div>
  </div>
               
<script type="text/javascript" src="/newdsn/js/cash/deposit.js"></script>
</body>
</html>