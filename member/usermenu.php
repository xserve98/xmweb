<div class="bannercontainer">
	<div class="banner">
		<div class="avatar"></div>
		<div class="text1">
			<script language="javaScript">
				now = new Date(), hour = now.getHours()
				if (hour < 6) {
					document.write("凌晨好")
				} else if (hour < 9) {
					document.write("早上好")
				} else if (hour < 12) {
					document.write("上午好")
				} else if (hour < 14) {
					document.write("中午好")
				} else if (hour < 17) {
					document.write("下午好")
				} else if (hour < 19) {
					document.write("傍晚好")
				} else if (hour < 22) {
					document.write("晚上好")
				} else {
					document.write("夜里好")
				}
				$(function() {
				//设置当前页菜单默认值
				var curLocation = location.href.split("/");
				var curPageName = curLocation.slice(curLocation.length-1, curLocation.length).toString(String).split(".").slice(0, 1).toString(String).toLowerCase().split("?")[0];
				var webMenu = $(".subnavigation2 div");
				switch(curPageName){
					case "":	  		webMenu.eq(0).addClass("subitmactive");webMenu.eq(3).addClass("arrow1a");break;
					case "userinfo":	  	webMenu.eq(0).addClass("subitmactive");webMenu.eq(3).addClass("arrow1a");break;
					case "sys_msg":		webMenu.eq(1).addClass("subitmactive");webMenu.eq(3).addClass("arrow2a");break;
					case "message":		webMenu.eq(2).addClass("subitmactive");webMenu.eq(3).addClass("arrow3a");break;
				
				}
				})
			</script>,<span class="blue"></span>
		</div>
		<div class="text2">
			真实姓名： <span class="blue"> <?php if($rs['pay_name']){echo $rs['pay_name'];}else{echo "马上填写真实姓名？";}?>	</span>  </span>
		</div>
		<div class="text3">欢迎来到<?=$web_site['web_name']?>，我们更专注彩票，博彩乐趣都在这里。</div>
		<div class="subnavigation2">
			<div class="subitm2 " onclick="location.href='userinfo.php'">安全设置</div>
			<div class="subitm2" onclick="location.href='sys_msg.php'">消息中心</div>
			<div class="subitm2 subitmlast2" onclick="location.href='message.php'">意见反馈</div>
			<div class="arrow1a arrow"></div>
		</div>
	</div>
</div>	