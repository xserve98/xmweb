$(function(){
	var a=function(){
		$.ajax({url:"/member/index",cache:false,success:
		function(i){}})};a();setInterval(a,60000);showLeftTime();
		var h=getQueryString("aff");
		if(h){affId=h;LIBS.cookie("affid",affId)}
		var f=LIBS.getUrlParam("a");
		if(f){LIBS.cookie("affCode",f)
			}else{
				f=LIBS.cookie("affCode")}
				if(f){var e=$("input[name=affKey]").val(f);
				if(e.length>0){
					var b=$(".top .login").removeClass("alogin");b.children(".afflogin").remove();$('<input id="aff-key-login" type="hidden">').val(f).appendTo(b)}}$(".trade").click(
					function(){if(!$(".login").is(":hidden")){
						var i;if(doLogin){i={"游客登录":
						function(){alert('游客盘口只供试玩，与正式会员盘口无关!');window.open('/guest.php', '_top');}}}dialog.error("消息","您还没有登录！",i);
						return false}});
						var g=location.href.split("/");
						var d=g.slice(g.length-1,g.length).toString(String).split(".").slice(0,1).toString(String).toLowerCase();
						if(d=="main"){d=""}d="/"+d;
						var c=$(".menulinks").children("[href='"+d+"']").addClass("menuactive")});
						var wait=60;
						var cce;
						function downtime(a){if(wait==0){a.removeAttr("disabled");a.val("点击获取");wait=60}
						else{a.attr("disabled","disabled");a.val("("+wait+")秒后重新获取验证码");wait--;cce=setTimeout(
						function(){downtime(a)},1000)}}
						function showLeftTime(){
							var c=new Date();
							var b=c.format("yyyy-MM-dd hh:mm:ss");
							$(".showTime").html(b);
							var a=setTimeout(showLeftTime,1000)}
							function getQueryString(a){
								var b=new RegExp("(^|&)"+a+"=([^&]*)(&|$)","i");
								var c=window.location.search.substr(1).match(b);
								if(c!=null){
									return unescape(c[2])}
									return null}
									function goUrl(a){
										var b=$("#popform");
										if(b.length==0){b=$('<form id="popform" method="post" target="_blank"></form>').appendTo("body")}b.attr("action",a).submit()};