!(function($){
	var Timer = function(fun, ms){
		var timer,
			delay = ms;

		return {
			start: function(){
				timer = setInterval(fun, delay);
			},
			stop: function(){
				timer && clearInterval(timer);
			},
			setDelay: function(ms){
				delay = ms;
			}
		};
	}
	
    var Scroll = function($el, options){
		var opts = $.extend({}, options);
		
		// 延迟
		var delay = opts.delay ? opts.delay : 5000;
		// 速度
		var speed = opts.speed ? opts.speed : 1000;
		// 可见个数
		var vis = opts.vis ? opts.vis : 1;
		// 滚动元素子元素
		var $items = $el.children();
		// 个数
		var sLen = $items.size();
		// 子元素高度
		var oHeight = $items.outerHeight(true);

		var run = function(){
			$el.animate({
				'margin-top': -oHeight
			}, speed, function() {
				$el.css('margin-top', 0);
				$el.append($el.children(":first"));
			});
		}

		var timer = new Timer(run, delay);

		return {
			start: function(){
				timer.stop();
				if (sLen > vis) {
					timer.start();
				}
			},
			stop: function(){
				timer.stop();
			}
		};
	}

	var App = function(){
		var cfg = {
			type: 1,
			area: ["630px", "85%"],
			shade: .5,
			shadeClose: true
		}
		return {
			init: function(){
				new Scroll($("#notice-list")).start();

				$(".open-le").on("click", function(){
					App.latestEvents();
				});

				$(".open-aj").on("click", function(){
					App.agencyJoin();
				});

				$(".open-faq").on("click", function(){
					App.faq();
				});

				$(".open-au").on("click", function(){
					App.aboutus();
				});
			},
			latestEvents: function(){
				layer.open($.extend({}, cfg, {
					title: "最新优惠",
					content: $("#latestEvents")
				}));

				$("#latestEvents").niceScroll({
					cursorwidth: "0",
					cursorborder: "0"
				});
			},
			agencyJoin: function(){
				layer.open($.extend({}, cfg, {
					title: "代理加盟",
					content: $("#agencyJoin")
				}));

				$("#agencyJoin").niceScroll({
					cursorwidth: "0",
					cursorborder: "0"
				});
			},
			faq: function(){
				layer.open($.extend({}, cfg, {
					title: "常见问题",
					content: $("#faq")
				}));

				$("#faq").niceScroll({
					cursorwidth: "0",
					cursorborder: "0"
				});
			},
			aboutus: function(){
				layer.open($.extend({}, cfg, {
					title: "关于我们",
					content: $("#aboutus")
				}));

				$("#aboutus").niceScroll({
					cursorwidth: "0",
					cursorborder: "0"
				});
			}
		};
	}();
	
	$(function(){
		App.init();
	});
}(jQuery));