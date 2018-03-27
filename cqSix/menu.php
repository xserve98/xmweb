<script type="text/javascript">
$(document).ready(function($) {
	showLoginOnly(false);
	
	$(window).scroll(function(){
		if($.browser.msie && $.browser.version=="6.0")$(".login_panel").css("top",$(window).height()-$(".login_panel").height()+$(document).scrollTop());
	});
	
});

//同一IP 12小时只显示一次
function showLoginOnly(isClose)
{　
	var isLoginS=$('.login_panel').attr("isLogin");
	var cookieString = new String(document.cookie);
	var cookieHeader = 'boxui_com_login_panel='; //更换happy_pop为任意名称
	var beginPosition = cookieString.indexOf(cookieHeader);
	if(isClose)
	{
		if (isClose)
		{
			$(".login_panel").css("display","none");
			var refrushTime = new Date();　　　　
		　 　refrushTime.setTime(refrushTime.getTime() + 12*60*60*1000 ) //同一ip设置过期时间，即多长间隔跳出一次
		　  document.cookie = 'boxui_com_login_panel=yes;expires='+ refrushTime.toGMTString();　 //更换happy_pop和第4行一样的名称
		}
	}
	else if(isLoginS=="" && beginPosition<0)
		$(".login_panel").css("display","block");
}
</script>
<style type="text/css">

.login_panel{width:776px;height:43px;background:url(images/Lottery_but1.png) 0 0 repeat-x;overflow:hidden;display:none;position:fixed;bottom:0;}
*html .login_panel{position:absolute;}
.login_panel .panel_center{margin:2px 0px 0px 0px;background:url(images/Lottery_but2.png) 274px 0 no-repeat;width:806px;height:40px;overflow:hidden;}
/*.login_panel .panel_center{margin:2px 0px 0px 0px;width:806px;height:40px;overflow:hidden;}*/
.login_panel .panel_center p{float:left;line-height:38px;margin-top:4px;}
.login_panel .panel_center p img {border:none;}
.login_panel .panel_center .tips{font-size:14px;font-weight:bold;color:#4ba6e5;width:280px;margin-left:0;text-align:left;text-indent:80px;line-height:40px;}
.login_panel .panel_center .close{font-size:14px;background:url(images/icon_close.png) 0 center no-repeat;margin-left:30px;height:32px;line-height:32px;text-indent:30px;display:block;color:#e54e4b;}
</style>

<style type='text/css'>
body{font-family: '宋体'; margin:0 0 0 3px; background: url(images/lotto_backjp.jpg);}
.line_list{font-size:13px;}
.table{float:left;margin-top:10px;}
.img{padding-top:4px;}
</style>
<script type="text/javascript">
function formReset()
  {
  document.getElementById("orders").reset()
  }
</script>