<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>众盈彩票管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css" tppabs="css/style.css" />
<style>
body{height:100%;background:#2061b3;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="js/jquery.js"></script>
<script src="js/verificationNumbers.js" tppabs="js/verificationNumbers.js"></script>
<script src="js/Particleground.js" tppabs="js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5c8abd',
    lineColor: '#5c8abd'
  });
  //验证码


});
</script>
</head>
<body>
<dl class="admin_login">
 <dt>
  <strong>众盈彩票管理系统</strong>
  <em>Public surplus lottery management system</em>
 </dt>
 <form id="form1" name="form1" method="post" action="login.php" onsubmit="return check();">
 <dd class="user_icon">
  <input type="text" name="LoginName"  id="LoginName" placeholder="账号" class="login_txtbx"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" name="LoginPassword"  id="LoginPassword"  placeholder="密码" class="login_txtbx"/>
 </dd>
 <dd>
  <input type="submit" name="dl" value="立即登陆"  class="submit_btn"/>
 </dd>
  </form>
 <dd>
 
<script type="text/javascript" language="javascript" src="js/index.js"></script>
 
 
  <p>© 2015-2018 众盈彩票 版权所有</p>

 </dd>
</dl>
</body>
</html>