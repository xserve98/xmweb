<?php
include_once("myhead.php"); 

$date = date("Y年m月d日",time());
switch(date("n",time())){
  case 1:
  $today = "壹";
  break;
  case 2:
  $today = "贰";
  break;
  case 3:
  $today = "叁";
  break;
  case 4:
  $today = "肆";
  break;
 case 5:
  $today = "伍";
  break;
  case 6:
  $today = "陆";
  break;
  case 7:
  $today = "柒";
  break;
  case 8:
  $today = "捌";
  break;
  case 9:
  $today = "玖";
  break;
  case 10:
  $today = "拾";
  break;
  case 11:
  $today = "拾壹";
  break;
  case 12:
  $today = "拾贰";
  break;
}

?>

<link rel="stylesheet" href="/xmindex/css/promo.css">
<link media="all" href="../xmIndex/css/active.css" type="text/css" rel="stylesheet">
    <div style="clear: both;"></div>
	<div class="bannerpromo">
		<div class="g_w1">
			<div class="headertxt"><?=$today?>月份活动</div>
			<img src="/newdsn/images/cash/banner_promotion.jpg" ondragstart="return false;" width="1000" height="261" alt="" />
			<div class="tabcontainer">
				<div class="tabs">
					<div class="tabbig">全部</div>
				</div>
				<div class="tabs">
					<div class="tabsmall">存提款</div>
				</div>
				<div class="tabs">
					<div class="tabsmall">彩票类</div>
				</div>
				<div class="tabs">
					<div class="tabsmall">其他</div>
				</div>
				
			</div>
			<div class="hline1"></div>
		</div>
	</div>
	<div class="promocontent clearfix">
		<div class="g_w1 overflowhd">
			<div class="hline2"  style="height:1000px;"></div>
			<div class="date">
				<h1>2017</h1>
				<p>01月15</p>
			</div>
			<div class="bullet">
				<img src="/newdsn/images/cash/promo_xsmall.png" ondragstart="return false;" width="26" height="24" alt="" />
			</div>
			<div class="arrow">
				<img src="/newdsn/images/cash/promoarrow.png" ondragstart="return false;" width="18" height="15" alt="" />
			</div>
            <div class="content">
                <div class="promocontenthead">
                    <h4 align="center">金鸡贺新春，疯狂抢红包</h4>
                    <p style="margin-top: 40px">西风徐渐，流年暗偷换。月圆星灿，烟火重弥漫。钟响福现，雪花又飘散。新春问候，祝福永存在，<?=$web_site['web_name']?>感谢有您相伴，祝愿新的一年万事如意！</p>
                    <p style="margin-top: 20px">活动方法：</p>
                    <div style="margin-top: 20px" align="center">
                        <table width="90%" cellspacing="1" cellpadding="0" bordercolor="#999999" border="1">
                            <tbody>
                                <tr>
                                    <th width="50%" height="38" align="center" style="font-size:14px;">活动统计周期</th>
                                    <th align="center" style="font-size:14px;">每天抽奖次数</th>
                                </tr>
                                <tr>
                                    <th width="50%" height="38" align="center" style="font-size:14px;color:#ff0000;">2017年2月2日24点之前</th>
                                    <th align="center" style="font-size:14px;color:#ff0000;">3</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="margin-top: 20px">1、抽奖时间：北京时间2017年1月25日-2017年2月3日</p>
                    <p>2、抽奖时间段：北京时间每天12:00-13:00、18:00-19:00、21:00-22:00</p>
                    <p>3、参与对象：所有2017年2月2日24点前注册之<?=$web_site['web_name']?>会员，均可获得3次抽奖机会，100%中奖</p>
                    <p>4、抽奖完成后，系统会在两个小时内自动为您添加现金筹码，无需申请，即可提款。</p>
                    <p>4、除了参与平台抢红包，所有会员还可以呼朋唤友加入高手交流群疯狂抢红包。</p>
                    <p style="margin-top: 20px">活动规则：</p>
                    <p>1、所有红包均为现金筹码，无流水要求；</p>
                    <p>2、此优惠适合<?=$web_site['web_name']?>所有会员，可与其他活动共享；</p>
                    <p>3、同一会员、同一台计算机、同一IP段、相同支付方式、及共享网络环境，有重复申请账号行为时，取消活动资格；</p>
                    <p>4、<?=$web_site['web_name']?>对此活动拥有最终解释权，拥有提前或延期活动权利。</p>
                </div>
            </div>
        </div>
		<div class="g_w1 overflowhd">
			<div class="hline2"  style="height:310px;"></div>
			<div class="date">
				<h1>2017</h1>
				<p>01月15</p>
				<img src="/newdsn/images/cash/promo_xsmall.png" ondragstart="return false;" width="26" height="24" style="position:absolute;top:675px;"/>
			</div>
			<div class="bullet">
				<img src="/newdsn/images/cash/promo_xsmall.png" ondragstart="return false;" width="26" height="24" alt="" />
			</div>
			<div class="arrow">
				<img src="/newdsn/images/cash/promoarrow.png" ondragstart="return false;" width="18" height="15" alt="" />
			</div>
            <div class="content">
				<div class="promocontenthead">
					敬请期待，更多活动...
				</div><br>
				<img src="/newdsn/images/cash/rebatebanner.png" ondragstart="return false;" width="825" height="200" alt="" class="margintop10 promobanner" />
				<div class="contentbody">
					<p>
	<br />
</p>
				</div>
			</div>
		</div>
		 

	</div>
        <div class="footerindex2">Copyright © <?=$web_site['web_name']?>  All Rights Reserved.</div>
<script src="/js/jquery.bxslider.min.js"></script>
<script src="/newdsn/js/cash/plugins.js"></script>
<script src="/newdsn/js/cash/phoneback.js"></script>
<script src="/newdsn/js/cash/main.js?v=1226"></script></body>
</html>