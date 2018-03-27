//客服链接
function onlineService() {
	var openUrl = "https://messenger2.providesupport.com/messenger/1x5i8zb1mjmcn1p4lov6y8sl1j.html";//弹出窗口的url
	var iWidth=800; //弹出窗口的宽度;
	var iHeight=600; //弹出窗口的高度;
	var iTop = (window.screen.availHeight-30-iHeight)/2; //获得窗口的垂直位置;
	var iLeft = (window.screen.availWidth-10-iWidth)/2; //获得窗口的水平位置;	
	window.open(openUrl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);return false;
}

function openQQ() {
	window.location.href="tencent://message/?uin=2492222222&Site=qq&Menu=yes";
}
/*//qq链接
function openQQ1() {
	window.location.href="tencent://message/?uin=2492222222&Site=qq&Menu=yes";
}*/

//qq链接
function openQQ1() {
	window.location.href="tencent://message/?uin=2495555555&Site=qq&Menu=yes";
}

function chooseLineLotto(){
	layer.open({
		title: [
		        '请选择线路：'
		      ]
		,content: ''
		,btn: ['线路1','线路2','线路3']
		,anim: 'up'
		,shadeClose: true
		,yes: function(index, layero){
			playGameMobile('LOTTO_IG','','1');//按钮【按钮一】的回调
		},btn2: function(index, layero){
			playGameMobile('LOTTO_IG','','2');//按钮【按钮二】的回调
		},btn3: function(index, layero){
			playGameMobile('LOTTO_IG','','3');//按钮【按钮三】的回调
		}
		,cancel: function(){ 
	    //右上角关闭回调
		}
	});
}
function chooseLineLottery(){
	layer.open({
		title: [
		        '请选择线路：'
		      ]
		,content: ''
		,btn: ['线路1','线路2','线路3']
		,anim: 'up'
		,shadeClose: true
		,yes: function(index, layero){
			playGameMobile('LOTTERY_IG','2','1');//按钮【按钮一】的回调
		},btn2: function(index, layero){
			playGameMobile('LOTTERY_IG','2','2');//按钮【按钮二】的回调
		},btn3: function(index, layero){
			playGameMobile('LOTTERY_IG','2','3');//按钮【按钮三】的回调
		}
		,cancel: function(){ 
	    //右上角关闭回调
		}
	});
}

function bindOnclick(isLogin) {
	if (isLogin) {
//		$('#depositAllTypeForPhone').bind("click", function() { javascript:window.location.href='http://juyou1989.com/cscpLoginWeb/index.jsp'});
//		$('#CreditConversionForPhone').bind("click", function() { javascript:window.location.href='http://juyou1989.com/cscpLoginWeb/index.jsp'});
//		$('#totalReportForPhone').bind("click", function() { javascript:window.location.href='http://juyou1989.com/cscpLoginWeb/index.jsp'});
//		$('#personalMsgForPhone').bind("click", function() { javascript:window.location.href='http://juyou1989.com/cscpLoginWeb/index.jsp?rightcornersTotal=0&upperrightsTotal=0&leftcornersTotal=0&rechargesTotal=0&wechataddsTotal=0&upperleftsTotal=0&bannerTotal=6'});
		
		$('#liveLmgGameBind').bind("click", function() { playGame('LIVE_LMG');});
		$('#liveDsGameBind').bind("click", function() { playGame('LIVE_DS');});
		$('#lottoFfcGameBind').bind("click", function() { playGameMobile('LOTTERY_DS');});
		$('#liveCGGameBind').bind("click", function() { playGame('LIVE_CG88');});
		$('#liveIgGameBind').bind("click", function() { playGame('LIVE_IG');});
		$('#liveAgGameBind').bind("click", function() { playGame('LIVE_AG');});
		$('#liveBbinGameBind').bind("click", function() { playGame('LIVE_BBIN');});
		$('#slotsBbinGameBind').bind("click", function() { playGame('SLOTS_BBIN','');});
		$('#slotsYyGameBind').bind("click", function() { javascript:window.location.href='../app/electronicGameYY.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/electronicGameYY*/});
		$('#slotsXbGameBind').bind("click", function() { javascript:window.location.href='../app/electronicGameXB.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/electronicGameXB*/});
		$('#slotsPtGameBind').bind("click", function() { javascript:window.location.href='../app/electronicGamePT.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/electronicGamePT*/});
		$('#slotsIgGameBind').bind("click", function() { javascript:window.location.href='../app/electronicGameIG.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/electronicGameIG*/});
		$('#SportM8GameBind').bind("click", function() { playGameMobile('SPORT');});
		$('#fishGgGameBind').bind("click", function() { playGame('FISH_GG','101');});
		$('#fishAgGameBind').bind("click", function() { playGame('FISH_AG');});
//		$('#fishGgGameBind').bind("click", function() { javascript:window.location.href='../app/gameFishGg.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/gameFishGg*/});
//		$('#fishYyGameBind').bind("click", function() { javascript:window.location.href='../app/gameFishYy.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/gameFishYy*/});
		$('#fishYyGameBind').bind("click", function() { playGame('SLOTS_YY','FishingRoyal');});
		
		$('#LottotSevenGameBind').bind("click", function() { JqueryShowMessageJustClose('手机版游戏即将上线!');});
		$('#slotsAgGameBind').bind("click", function() {  JqueryShowMessageJustClose('手机版游戏即将上线!');});
//		$('#slotsBbinGameBind').bind("click", function() {  JqueryShowMessageJustClose('手机版游戏即将上线!');});
		$('#slotsAgBywGameBind').bind("click", function() {  JqueryShowMessageJustClose('手机版游戏即将上线!');});
		$('#addMortGameBind').bind("click", function() { });
		$('#liveOgGameBind').bind("click", function() { JqueryShowMessageJustClose('手机版游戏即将上线!');});
	} else {
//		$('#depositAllTypeForPhone').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#CreditConversionForPhone').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#totalReportForPhone').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#personalMsgForPhone').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
		
//		$('#liveLmgGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveCGGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveDsGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveIgGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveAgGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveBbinGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#liveOgGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#lotteryGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#lottoFfcGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#lottoGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#LottotSevenGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#SportM8GameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#slotsAgGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#slotsBbinGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#slotsAgBywGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
//		$('#addMortGameBind').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
		
		
		$('.list-item').bind("click", function() { javascript:window.location.href='../app/loginPage.htm'/*tpa=http://juyou1989.com/cscpLoginWeb/app/loginPage*/});
	}
}

function popupDiv(div_id) {
	var div_obj = $("#" + div_id);
	var posLeft = ($(window).width() - div_obj.width()) / 2;
	var posTop = ($(window).height() - div_obj.height()) / 2;
	//添加并显示遮罩层
	$("<div id='mask'></div>").addClass("mask").appendTo("body").fadeIn(200); 
	//fadeIn() 方法使用淡入效果来显示被选元素
	div_obj.css({ "top": posTop+55, "left": posLeft-39}).fadeIn(); 
}

function hideDiv(div_id) {
	$("#mask").remove();
	//fadeOut() 方法使用淡出效果来隐藏被选元素
	$("#" + div_id).fadeOut();
}
/*function time(){
	t_div = document.getElementById('showtime');
	var now=new Date()
	//替换div内容 
	t_div.innerHTML = "当地时间:"+now.getFullYear()
	+"年"+(now.getMonth()+1)+"月"+now.getDate()
	+"日"+now.getHours()+"时"+now.getMinutes()
	+"分"+now.getSeconds()+"秒";
	//等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
	setTimeout(time,1000);
}
*/

function AddFavorite(sURL, sTitle) {
	sURL = encodeURI(sURL);
	try {
		window.external.addFavorite(sURL, sTitle);
	} catch (e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "");
		} catch (e) {
			alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加！");
		}
	}
}
//设为首页
function SetHome(url) {
	if (document.all) {
		document.body.style.behavior = 'url(#default#homepage)';
		document.body.setHomePage(url);
	} else {
		alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
	}
}


function hidSv() {
	$(".forget").hide();
}
function shoSv() {
	$(".forget").show();
}

function munMover(leftPx) {
	function followTopNav(){
        $(".mainnav-back")
            .stop()
            .animate({
                left: leftPx
            }, "normal");
    }
    followTopNav();

    $("ul.mainnav-ul>li").hover(
        function(){
            $(".mainnav-back").stop().animate({
                left: $(this).position().left
            }, "normal");
        },
        function(){
            followTopNav();
        }
    );
}






//JavaScript Document
(function($) {

    $.fn.extend({

        jsCarousel: function(options) {

            var settings = $.extend({

                scrollspeed: 400,

                delay: 3000,

                itemstodisplay: 6,

                autoscroll: false,

                onthumbnailclick: null

            }, options);

            return this.each(function() {

            var slidercontents = $(this).addClass('jscarousal-contents');

                var slider = $('<div/>').addClass('jscarousal');

                var leftbutton = $('<div/>').addClass('jscarousal-left');

                var rightbutton = $('<div/>').addClass('jscarousal-right');

                slidercontents.before(slider);

                slider.append(leftbutton);

                slider.append(slidercontents);

                slider.append(rightbutton);



                var total = $('> div', slidercontents).css('display', 'none').length;

                var index = 0;

                var start = 0;

                var current = $('<div/>');

                var noOfBlocks;

                var interval;

                var left;

                var display = settings.itemstodisplay;

                var speed = settings.scrollspeed;

                var containerWidth;

                var height;

                var direction = "forward";



                function initialize() {

                    index = -1;

                    noOfBlocks = parseInt(total / display);

                    if (total % display > 0) noOfBlocks++;

                    var startIndex = 0;

                    var endIndex = display;

                    var copy = false;

                    var allElements = $('> div', slidercontents);

                    $('> div', slidercontents).remove();

                    allElements.addClass('thumbnail-inactive').hover(function() { $(this).removeClass('thumbnail-inactive').addClass('thumbnail-active'); }, function() { $(this).removeClass('thumbnail-active').addClass('thumbnail-inactive'); })

                    for (var i = 0; i < noOfBlocks; i++) {

                        if (total > display) {

                            startIndex = i * display;

                            endIndex = startIndex + display;

                            if (endIndex > total) {

                                startIndex -= (endIndex - total);

                                endIndex = startIndex + display;

                                copy = true;

                            }

                        }

                        else {

                            startIndex = 0;

                            endIndex = total;

                        }

                        var wrapper = $('<div/>')

                        allElements.slice(startIndex, endIndex).each(function(index, el) {

                            if (!copy)

                                wrapper.append(el);

                            else wrapper.append($(el).clone(true));



                        });

                        wrapper.find("img").click(

                         function() {

                             if (settings.onthumbnailclick != null) settings.onthumbnailclick($(this).attr('src'));

                         });

                        slidercontents.append(wrapper);

                    }

                    $('> div', slidercontents).addClass('hidden');

                    $('> div > div', slidercontents).css('display', '');

                    left = $('> div:eq(' + index + ')', slidercontents).css('left');



                    containerWidth = slidercontents.width();

                    height = slidercontents.get(0).offsetHeight;

                    $('> div', slidercontents).css('left', '-' + containerWidth + 'px');

                    $('> div:eq(0)', slidercontents).addClass('visible').removeClass('hidden');

                    $('> div:eq(0)', slidercontents).stop().animate({ left: 0 }, speed, function() { index += 1; });

                    slider.mouseenter(function() {  if (settings.autoscroll) stopAnimate(); }).mouseleave(function() { if (settings.autoscroll) animate(); });

                    if (settings.autoscroll)

                        animate();



                    rightbutton.click(function() {

                        direction = "forward";

                        showThumbs();

                    });

                    leftbutton.click(function() {

                        direction = "backward";

                        showThumbs();

                    });

                }

                initialize();

                function stopAnimate() {



                    clearTimeout(interval);

                    slider.children().clearQueue();

                    slider.children().stop();

                }

                function animate() {

                    clearTimeout(interval);

                    if (settings.autoscroll)

                        interval = setTimeout(changeSlide, settings.delay);

                }

                function changeSlide() {

                    if (direction == "forward") {

                        if (index >= noOfBlocks - 1) { index = -1; }

                    } else {

                        if (index <= 0) index = noOfBlocks - 1;

                    }

                    showThumbs();

                    interval = setTimeout(changeSlide, settings.delay);

                }

                function getDimensions(value) {

                    return value + 'px';

                }



                function showThumbs() {

                    var current = $('.visible');

                    var scrollSpeed = speed;



                    if (direction == "forward") {

                        index++;

                        if (index < noOfBlocks) {

                            $('>div:eq(' + index + ')', slidercontents).removeClass('hidden').addClass('visible').css({

                                'left': getDimensions(-containerWidth)

                            }).stop().animate({ 'left': '+=' + getDimensions(containerWidth) }, scrollSpeed);



                            current.stop().animate({ 'left': '+=' + getDimensions(containerWidth) }, scrollSpeed,

                            function() {

                                $(this).removeClass('visible').addClass('hidden');

                                $(this).css('left', getDimensions(-containerWidth));

                            });



                        } else index = noOfBlocks - 1;

                    }

                    else if (direction == "backward") {

                        index--;

                        if (index >= 0) {

                            $('>div:eq(' + index + ')', slidercontents).css('left', getDimensions(containerWidth)).removeClass('hidden').addClass('visible').stop().animate({ 'left': '-=' + getDimensions(containerWidth) }, scrollSpeed);

                            current.stop().animate({ 'left': '-=' + getDimensions(containerWidth) }, scrollSpeed, function() {

                                $(this).removeClass('visible').addClass('hidden');

                                $(this).css('left', left);

                            });

                        } else index = 0;

                    }

                }

            });

        }

    });

})(jQuery);