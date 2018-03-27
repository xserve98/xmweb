
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
				var webMenu = $(".subnavigation div");
				switch(curPageName){
					case "":	  		webMenu.eq(0).addClass("subitmactive");webMenu.eq(4).addClass("arrow1");break;
					case "set_money":	  	webMenu.eq(0).addClass("subitmactive");webMenu.eq(4).addClass("arrow1");break;
					case "get_money":		webMenu.eq(1).addClass("subitmactive");webMenu.eq(4).addClass("arrow2");break;
					case "data_t_money":		webMenu.eq(2).addClass("subitmactive");webMenu.eq(4).addClass("arrow3");break;
					case "data_h_money":		webMenu.eq(3).addClass("subitmactive");webMenu.eq(4).addClass("arrow3");break;

				}
				})
			</script>,<span class="blue"><?=$rs["username"]?></span>
		</div>
		<div class="text2">
			最后登录：<br><?=$rs2["login_time"]?> 
		</div>
		<div class="text3">欢迎来到<?=$web_site['web_name']?>，我们更专注彩票，博彩乐趣都在这里。</div>
		<div class="subnavigation" style="width: 575px !important;">
			<div class="subitm  " onclick="location.href='set_money.php'">充值</div>
			<div class="subitm" onclick="location.href='get_money.php'">提款</div>
			<div class="subitm " onclick="location.href='data_t_money.php'">提款记录</div>
			<div class="subitm " onclick="location.href='data_h_money.php'">充值记录</div>
            <div class="arrow1"></div>
		</div>

		<div class="showamount">
			<div class="saitm1 gradientbg">中心钱包</div>
			<div class="saitm2 gradientbg pink"><span class="balanceCount"><?=$rs2["money"]?></span> 元 <!--| span class="freezeCount"><?=$rs1['sum_money']?> 元</span--></div>
			<div class="refresh" onclick="location.reload()"></div>

		</div>
	</div>
</div>