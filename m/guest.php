<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");

$name='guest_'.rand(100000,999999);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>试玩帐号登录中...</title>
    <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
document.form1.submit();
	});
</script>
</head>
<body>
  <form id="form1" action="guestreg.php" method="post" name="form1" class="login-form">
               
     <input id="zcname" name="zcname" type="hidden" value='<?=$name?>' placeholder="" size="40" class="textbox1" maxlength="15">
			        <input id="passwd1" name="passwd1" value='123456' type="hidden" class="textbox1"  size="40" maxlength="20">
                    <input id="passwdse" name="passwdse" value='123456' type="hidden" class="textbox1" placeholder="" size="40" maxlength="20">	
					<input type="hidden" id="mobile" name="mobile" value='13888888888' class="textbox1" >
					<input type="hidden"  id="wechat" name="wechat" value='13888888888' class="textbox1">
					<input type="hidden"  id="qq" name="qq" value='888888888'class="textbox1">
		            <input id="realname" name="realname" value='试玩账号' type="hidden"  class="textbox1" maxlength="10" size="40">                
                    <input id="paypasswd" name="paypasswd" type="hidden" value='123456' class="textbox1" maxlength="6" size="40">
                     <input type="submit" value='试玩'  >

			</form>

</body>
</html>