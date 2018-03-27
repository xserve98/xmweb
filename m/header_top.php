<?php
	include_once("include/mysqli.php");
	$msg	=	"";
	$sql	=	"select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 0,5";
	$query	=	$mysqli->query($sql); 
	while($rs = $query->fetch_array()){
		$msg	.=	"<li><a title=\"".$rs['msg']."\">".$rs['msg']."</a></li>";
	}		
?>
<iframe id="topFrame" name="topFrame" frameborder="0" scrolling="no" width="0" height="0" src="top.php" style="display:none"></iframe>	
<script type="text/javascript" src="/js/common.js"></script>	
 <div class="topNotice">
       <em>最新公告：</em>
       <div class="list">
       <ul id="msgNews" <?php if(@$_SESSION["uid"] == null) {?>style="width:200px"<?php } else {?>style="width:450px"<?php }?>>
		 <?=$msg ?>
       </ul>
       </div>
    </div>
    <script type="text/javascript">
    jQuery(".topNotice").slide({mainCell:"ul",autoPage:true,effect:"topLoop",autoPlay:true});
    </script>
    <div class="topSearch">
<?php
if(@$_SESSION["uid"] == null) {
?>
<script language="javascript">	
    function login_focus(handler){
		if(handler.value==handler.attributes["ovalue"].nodeValue) {
			handler.value="";
		}
	}
	
	function login_blur(handler){
		if(handler.value=="") {
			handler.value=handler.attributes["ovalue"].nodeValue;
		}
	}
	
</script> 
         <form name="LoginForm" id="LoginForm" onsubmit="topUserLogin();return false">
         <input type="text" name="username" id="username" class="input1" ovalue="用户名" value="用户名" onblur="login_blur(this)" onfocus="login_focus(this)" />
         <input type="password" name="password" id="password" class="input1" />
		 <input type="text" name="vlcodes" id="vlcodes" onfocus="getKey();" class="input1" ovalue="验证码" value="验证码" onblur="login_blur(this)" onfocus="login_focus(this)" />
		 <img id="vPic" class="input1" src="/yzm.php" alt="( 点选此处产生新验证码 )" title="( 点选此处产生新验证码 )" onclick="getKey();" style="width:40px; height:24px">
         <input type="submit" class="btn1" value="" />
         <a href="zhuce.php" class="btn2">注册</a>
         <a href="javascript:Go_forget_pwd();" class="btn3">忘记密码？</a>
         </form>
<?php }else {
include_once("include/mysqli.php");
include_once("common/logintu.php");
$uid		= @$_SESSION["uid"];
$sql		=	"select money as s from k_user where uid=$uid limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_money	=	sprintf("%.2f",$rs['s']);

?>
<strong>请检查您的账户</strong>&nbsp;&nbsp;账号：<?=@$_SESSION["username"]?> &nbsp;&nbsp;&nbsp;&nbsp;账户余额：<span id="user_money"><?=$user_money?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="mainOnclick('user/logout.php')">退出</a>
<script language="javascript">	
    function refresh_money(){
	$.ajax({
		cache: false,
		url: "/get_money.php",
		success:function(data){
			if(data==""){
			}else{
			 $("#user_money").html(data);
			}
		}
	}); 
	window.setTimeout("refresh_money();", 15000); 
	}
	refresh_money();
</script>   
<?php } ?>
    </div>