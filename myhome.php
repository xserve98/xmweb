<?php 
include_once("myhead.php"); 

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 1";

$query = $mysqli->query($sql);
			
$rs = $query->fetch_array() ;

$msg=$rs['msg'];
?>
	<!--客服代码部分begin-->	
<div class="socialnavi">
<div class="qqqr" style="display: none;"><p>点击联系在线客服<br>QQ：<?=$web_site['web_kfqq']?></p></div>
<div class="wechatqr" style="display: none;"><img src="/newdsn/images/wechatqr.png"></div>
<div class="phonebackqr" style="display: none;"><p><?=$web_site['web_name']?>，欢迎您！<br>点击联系在线客服　</p></div>
<div class="downloadqr" style="display: none;"><img src="/newdsn/images/downloadqr.png"></div>
<div class="qq" onclick="javascript:window.open('tencent://message/?uin=<?=$web_site['web_kfqq']?>&Menu=yes','_blank')" ></div>
<div class="wechat"></div>
<div class="livechat" onclick="javascript:window.open('<?=$web_site["web_kf"]?>','_blank')" ></div>
<div><a href="javascript:;" onclick="scrolltop();" class="scrolltop btn_top" style="display: none;"><img src="/xmindex/img/support_top.png" width="50" height="50"></a></div>
	</div>
	<script>
		$(".qq").hover(function(){
			$(".qqqr").fadeIn(500);
			$(".qqqr").css("display","block");
		},function(){
			$(".qqqr").fadeOut(0);
			$(".qqqr").css("display","none");
		});
	</script>
	<script>
		$(".wechat").hover(function(){
			$(".wechatqr").fadeIn(500);
			$(".wechatqr").css("display","block");
		},function(){
			$(".wechatqr").fadeOut(0);
			$(".wechatqr").css("display","none");
		});
	</script>
	<script>
		$(".download").hover(function(){
			$(".downloadqr").fadeIn(200);
			$(".downloadqr").css("display","block");
		},function(){
			$(".downloadqr").fadeOut(0);
			$(".downloadqr").css("display","none");
		});
	</script>
	<script>
		$(".livechat").hover(function(){
			$(".phonebackqr").fadeIn(200);
			$(".phonebackqr").css("display","block");
		},function(){
			$(".phonebackqr").fadeOut(0);
			$(".phonebackqr").css("display","none");
		});
	</script>
	<!--客服代码部分end-->
    <div class="banner">
        	<div class="bx-wrapper" style="max-width: 100%;">
			<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 419px;">
			<div class="bx-wrapper" style="max-width: 100%;">
			<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 419px;">
			<ul class="bxslider" style="width: 715%; position: relative; transition-duration: 0.5s; transform: translate3d(-7100px, 0px, 0px);">
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(/xmindex/images/homebanner.jpg) 50% 50% no-repeat;"></li>
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(/xmindex/images/homebanner2.jpg) 50% 50% no-repeat;"></li>
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(/xmindex/images/homebanner3.jpg) 50% 50% no-repeat;"></li>
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(/xmindex/images/homebanner4.jpg) 50% 50% no-repeat;"></li>

<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(/xmindex/images/homebanner6.jpg) 50% 50% no-repeat;"></li>
</ul></div>
</div>
</div>
</div>
</div>
		<div class="gamelist">
			<div class="gameitms g_w1 bxslider5">
			<?php
			if(!$uid){
				?>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="bjpk10bjl"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="pcegg"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="sscjsc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="pk10jsc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="aulucky5"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="aulucky8"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="aulucky10"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="aulucky20"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="bjpk10"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="cqssc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="hk6"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="xync"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="gxk3"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="gd11x5"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="cqssc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="xjssc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="tjssc"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="gdklsf"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="gxklsf"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="f3d"></a>
				<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" class="pl3"></a>
			<?php
			} else {
				?>
				<a href="/member/index/?pk10" class="bjpk10bjl"></a>
				<a href="/member/index" class="pcegg"></a>
				<a href="/member/index" class="sscjsc"></a>
				<a href="/member/index" class="pk10jsc"></a>
				<a href="/member/index" class="aulucky5"></a>
				<a href="/member/index" class="aulucky8"></a>
				<a href="/member/index" class="aulucky10"></a>
				<a href="/member/index" class="aulucky20"></a>
				<a href="/member/index" class="bjpk10"></a>
				<a href="/member/index" class="cqssc"></a>
				<a href="/member/index" class="hk6"></a>
				<a href="/member/index" class="xync"></a>
				<a href="/member/index" class="gxk3"></a>
				<a href="/member/index" class="gd11x5"></a>
				<a href="/member/index" class="cqssc"></a>
				<a href="/member/index" class="xjssc"></a>
				<a href="/member/index" class="tjssc"></a>
				<a href="/member/index" class="gdklsf"></a>
				<a href="/member/index" class="gxklsf"></a>
				<a href="/member/index" class="f3d"></a>
				<a href="/member/index" class="pl3"></a>
			<?php
               }
                ?>
            </div>
        </div>

    <div class="prodcontainer">
        <div class="g_w1">
            <div class="col1">
                <div class="spechd clearfix">
                    <div class="specicon"><img src="/xmIndex/img/icon_service.jpg" ondragstart="return false;"alt="" width="46" height="51"> </div>
                    <div class="spectxt">
                        <h1>服务优势</h1>
                        <p>Service advantages</p>
                    </div>
                </div>
                <div class="specdetail">
                    <div class="specleft">
                        <div class="cci_title">存款到账</div>
                        <p>平均时间</p>
                    </div>
                    <div class="specright">
                        <div class="number1" id="count1">25</div>
                        <div class="number1txt">秒</div>
                    </div>
                </div>
                <div class="specgraph">
                    <div class="stats1">
                        <div class="stats2" id="bar1" style="right: 100px;"></div>
                    </div>
                </div>
                <div class="specdetail">
                    <div class="specleft">
                        <div class="cci_title">取款到账</div>
                        <p>平均时间</p>
                    </div>
                    <div class="specright">
                        <div class="number1" id="count2">2‘00</div>
                        <div class="number1txt">分</div>
                    </div>
                </div>
                <div class="specgraph">
                    <div class="stats1">
                        <div class="stats2" id="bar2" style="right: -60px;"></div>
                    </div>
                </div>
                <div class="specdetail">
                    <div class="specleft2">
                        <div class="cci_title">便捷的银行服务</div>
                        <p><img src="/xmIndex/img/creditcard.jpg" ondragstart="return false;" alt="" width="118" height="26"></p>
                        <p class="card_count">目前我们支付机构有：</p>
                    </div>
                    <div class="specright">
                        <div class="number1 bank_number" id="count3">34</div>
                        <div class="number1txt bank_numbertxt">家</div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="col2">
                <div class="spechd clearfix">
                    <div class="specicon2">
                        <img src="/xmIndex/img/icon_advantage.jpg" ondragstart="return false;" alt="" width="49" height="49"> </div>
                    <div class="spectxt">
                        <h1>产品优势</h1>
                        <p>Product advantages</p>
                    </div>
                </div>
                <div class="specdetail2">
                    <div class="cci_title">电脑客户端</div>
                    <p>独家提供Win/Mac客户端，您可以通过客户端畅玩所有彩票游戏。</p>
                </div><br>
				<div class="specdetail2">
                    <div class="cci_title">手机客户端</div>
                    <p>独家提供苹果/安卓客户端，您可以通过客户端畅玩所有彩票游戏。</p>
                </div><br>
                <div class="specdetail2">
                    <div class="cci_title">手机触屏版</div>
                    <p>独家提供手机触屏网页版，无需下载，打开网页即可下注畅玩。</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="col3">
                <div class="spechd clearfix">
                    <div class="specicon2">
                        <img src="/xmIndex/img/icon_lion.jpg" ondragstart="return false;" alt="" width="49" height="49"> </div>
                    <div class="spectxt">
                        <h1>关于我们</h1>
                        <p>About us</p>
                    </div>
                </div>
                <div class="specdetail2">
				<div class="cci_title"><?=$web_site['web_name']?></div>
                    <p>主营极速赛车(PK10)、极速分分彩、幸运2分彩、极速六合彩、北京赛车(PK10)、幸运飞艇、重庆时时彩、新疆时时彩、天津时时彩、广东快乐十分、重庆幸运农场 、北京快乐8、福彩3D、体彩排列三、PC蛋蛋、加拿大28、新加坡28、香港六合彩等。<br>我们拥有稳定的平台，成熟的玩法，简单的下注流程、以及优质的客户服务。<?=$web_site['web_name']?>为彩票博彩爱好者提供最优惠的赔率和最优质的博彩服务。<?=$web_site['web_name']?>一直深受会员好评 一直以来以良好的信誉和服务得到许多会员的支持和肯定。</p>

                </div>
            </div>
        </div>
    </div>

    <div class="blueline">
    </div>
    <div class="prodcontainer prodcontainer2">
        <div class="g_w1">
            <div class="col1">
                <div class="spechd clearfix">
                    <div class="specicon">
                        <img src="/xmIndex/img/icon_innovative.jpg" ondragstart="return false;" alt=""> </div>
                    <div class="spectxt">
                        	<h1>颠覆性创新设计</h1>
                            <p>Innovative Design</p>
                        </div>
                    </div>
                  	<div class="specfull">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 246px;">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 266px;">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 266px;">
						<ul class="bxslider4" style="width: auto; position: relative;">
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 0; display: none;">
						  <img src="/xmindex/img/innovative1.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">极速赛车, 极速时时彩, 上线啦！</div>
                                    <p>极速赛车和极速时时彩是引进欧洲博彩公司开奖设备，由菲律宾博彩执照公司审核监控，联合开发的彩票游戏，保证公平公正。</p>
                    			</div>
                          </li>
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 50; display: list-item;"><img src="/xmindex/img/innovative2.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">接地气本土服务</div>
                                    <p>青春洋溢的<?=$web_site['web_name']?>团队在最贴近生活的方式下设计出一款款高端大气的产品，为各国用户带来最为接地气的个性化本土定制服务。</p>
                    			</div>
                          </li>
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 0; display: none;"><img src="/xmindex/img/innovative3.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">颠覆性产品</div>
                                    <p>每款全新上线的<?=$web_site['web_name']?>产品都是经过大量测试后证实最符合亚洲人的产品，这是一个对既定现状做出强势挑战的创新团队。</p>
                    			</div>
                          </li>
                       </ul></div>

					   </div>
					   </div>
					   </div>
					   </div>
					   </div>
					   </div>
                  	</div>
              </div>
        <div class="divider"></div>
        <div class="col2">
            <div class="spechd clearfix">
                <div class="specicon2">
                    <img src="/xmIndex/img/icon_partner.jpg" ondragstart="return false;" alt="" width="49" height="49"> </div>
                <div class="spectxt">
                    <h1>合作伙伴</h1>
                    <p>Cooperative partner</p>
                </div>
            </div>
            <div class="specdetail2">
                <img src="/xmIndex/img/payment.jpg" ondragstart="return false;" alt="" width="190" height="192"> </div>
        </div>
        <div class="divider"></div>
        <div class="col3">
            <div class="spechd clearfix">
                <div class="clearfix">
                    <div class="specicon2">
                        <img src="/xmIndex/img/icon_guide.jpg" ondragstart="return false;" alt="" width="49" height="49"> </div>
                    <div class="spectxt clearfix">
                        <h1>使用帮助</h1>
                        <p>Use help</p>
                    </div>
                </div>
                <div class="specdetail2 mt10">
                    <div class="col1">
                        <p><a href="javascript:void(0)" target="_top">如何存款</a>
                       <br><a href="javascript:void(0)" target="_top">如何提款</a></p>
                    </div>
                    <div class="col2">
					    <p><a href="javascript:void(0)" target="_top">隐私及政策</a>
						<br><a href="javascript:void(0)" target="_top">关于我们</a></p>
                    </div>
                    <div class="col3">
                        <p><a href="javascript:void(0)" target="_top">联系我们</a>
                        <br><a href="javascript:void(0)" target="_top">常见问题</a></p>
                    </div>
                </div>
                <div class="greyline"></div>
                <div class="specdetail2">
                    <div class="cci_title">推荐浏览器</div>
                    <p><a href="http://www.firefox.com.cn/" target="_blank">火狐浏览器</a>
                        <br><a href="http://rj.baidu.com/soft/detail/14744.html?ald" target="_blank">谷歌浏览器</a>
                        <br><a href="http://rj.baidu.com/soft/detail/23356.html?ald" target="_blank">IE 9 以上浏览器</a></p>
                </div>
            </div>
        </div>
		<!--div class="float" style="position: fixed;z-index: 1000;bottom: 200px;right: 1300px;width: 127px;height: 178px;">
			<a href="/url" target="_blank"><img src="/xmindex/img/MQ2.png" alt=""></a>
    </div-->
</div>
﻿<div class="footerindex2">Copyright © <?=$web_site['web_name']?>  All Rights Reserved.</div>
<script src="/xmindex/js/jquery.bxslider.min.js"></script>
<script src="/xmindex/js/plugins.js"></script>
<script src="/xmindex/js/main.js"></script>    
</body>
</html>