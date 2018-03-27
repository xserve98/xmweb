<script language="javaScript">
		
				$(function() {
				//设置当前页菜单默认值
				var curLocation = location.href.split("/");
				var curPageName = curLocation.slice(curLocation.length-1, curLocation.length).toString(String).split(".").slice(0, 1).toString(String).toLowerCase().split("?")[0];
				//alert(curPageName);
				var webMenu = $(".subnavigation2 div");
					
				switch(curPageName){
					case "":webMenu.eq(0).addClass("subitmactive");webMenu.eq(3).addClass("arrow1a");break;
				
					case "report_day":		webMenu.eq(0).addClass("subitmactive");webMenu.eq(3).addClass("arrow3a");break;
					case "report":	webMenu.eq(1).addClass("subitmactive");webMenu.eq(3).addClass("arrow4a");break;
					case "xjcw2":	webMenu.eq(2).addClass("subitmactive");webMenu.eq(3).addClass("arrow5a");break;
				}
				})
			</script>


<div class="bannercontainer"  style="margin-bottom: 10px;">
	<div class="banner" style="height: 64px;">
		<div class="avatar" style=" top: 2px !important;"></div>
		<div class="text1">报表中心<span class="blue"></span></div>
        <div class="subnavigation2" style="top: 15px;left: 400px;">
			<div class="subitm2" onclick="location.href='report_day.php'">会员报表</div>
             <div class="subitm2 " onclick="location.href='report.php'">投注报表</div>
           <div class="subitm2 " onclick="location.href='xjcw2.php'">资金变动</div>
			
			
		</div>
	</div>
</div>	