(function($){
	$.fn.createModal = function(options,callback) {
		var opts = $.extend({}, $.fn.createModal.defaults, options);
		return this.each(function() {
			$this = $(this);

			var modalContainer = document.createElement("div"),
				modalBg = document.createElement("div"),
				modalContent = document.createElement("div");

			$(modalBg).css({
				"position": "absolute",
				"top": 0,
				"left": 0,
				"width": "100%",
				"height": "100%",
				"background-color": opts.background,
				"opacity": 0.5
			});

			$(modalContent).css({
				"position": "fixed",
				"background": "rgb(230,241,246)",
				"background": "-moz-linear-gradient(top, rgba(230,241,246,1) 0%, rgba(248,251,252,1) 100%)",
				"background": "-webkit-linear-gradient(top, rgba(230,241,246,1) 0%,rgba(248,251,252,1) 100%)",
				"background": "linear-gradient(to bottom, rgba(230,241,246,1) 0%,rgba(248,251,252,1) 100%)",
				"filter": "progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6f1f6', endColorstr='#f8fbfc',GradientType=0 )",
				"width": opts.width,
				"height": opts.height,
				"left": ($(document).width() - parseInt(opts.width))/2,
				"top": ($(window).height() - parseInt(opts.height))/2
			});

			$(modalContainer).css({
				position: "fixed",
				width: "100%",
				height: $(document).height(),
				zIndex: 999,
				left: 0,
				top: 0
			}).append(modalBg).append(modalContent);//确定modalContainer的位置

			var writeModal = function(_$this){
				$(window).resize(function(){
					$(modalContent).css({
						"left": ($(window).width() - parseInt(opts.width))/2,
						"top": ($(window).height() - parseInt(opts.height))/2
					});
					$(modalBg).css({
						"height": $(document).height()
					})
				});//窗口大小变化时,将弹窗移动到屏幕中间位置

				$.ajax({
					url : 'lastResult?lottery=' + lottery,
					type : 'GET',
					contentType : 'application/json',
					data : '',
					success : function(res) {
						$(modalContent).append(
							"<div class='modal-title' control-move><div class='pn_1'>"+ lotteryName +"</div><div class='pn_2'>" + res.drawNumber + " 期开奖</div></div>"
						);
						$(modalContent).append(
							"<div class='modal-close close-pos-r-t'><img src='/newdsn/images/delete.png'></div>"
						);
						var menu1 = $('<p>').addClass('menu1').appendTo($(modalContent));
						var modal = $('<div>').addClass('modal-promot-mess').appendTo(menu1);
						$('<div>').addClass('pk_name').appendTo(modal);
						var balls = $('<div>').attr('id', 'result_balls').addClass('T_' + template + ' L_' + lottery).appendTo(modal);

						if (template == 'HK6' || template == '3D' || template == 'KL8') {
							balls.css("margin-top", "5px");
						} else {
							balls.css("margin-top", "-5px");
						}
						balls.empty();
						var results = res.result.split(',');
						var resultOther = res.resultOther.split(',');
						var speball;
						if (template == 'HK6') {
							speball = get_animal_by_ball;
						} else if (template == '3D') {
							speball = function(b, i) {
								return [ '佰', '拾', '个' ][i];
							}
						}
						for (var i = 0; i < results.length; i++) {
							var ball = results[i];
							var p = $('<span>').appendTo(balls);
							p.append($('<b>').addClass('b' + ball).text(ball));
							if (speball) {
								p.append($('<i>').text(speball(ball, i)));
							}
							if (template == 'HK6') {
								if (i == 5) {
									$('<span>').addClass('plus').text('+').appendTo(balls);
								}
							}
						}
						if (resultOther.length > 0) {
							$('<div>').css("width", "300px").css("float","left").appendTo(balls);
							if (template == 'GXKLSF') {
								div = $('<div>').addClass('result_stat clearfix ml8').appendTo(balls);
							} else if (template != 'PK10') {
								div = $('<div>').addClass('result_stat clearfix ml4').appendTo(balls);
							}else {
								var div = $('<div>').addClass('result_stat clearfix').appendTo(balls);
							}

							for (var i = 0; i < resultOther.length; i++) {
								var text = resultOther[i];
								if (text) {
									div.append($('<div>').addClass('statitm').text(text));
								}
							}
						}
					},
					error : function(e) {
						alert('失败：' + e.code + ",请检查下注状况後重试。");
					},
					complete : function() {
						$(modalContainer).prependTo("body");

						if(opts.bgClose){
							$(modalBg).click(function(){
								$(modalContent).empty();
								$(modalContainer).remove();
							});
						};
						$(".modal-close").click(function(){
							$(modalContent).empty();
							$(modalContainer).remove();
						});

						if(opts.move){
							$(modalContent).find("[control-move]").css("cursor","move").on("mousedown",function(e){
								/*$(this)[0].onselectstart = function(e) { return false; }*///防止拖动窗口时，会有文字被选中的现象(事实证明不加上这段效果会更好)
								$(this)[0].oncontextmenu = function(e) { return false; }//防止右击弹出菜单
								var getStartX = e.pageX,
									getStartY = e.pageY;
								var getPositionX = $(modalContent).offset().left,
									getPositionY = $(modalContent).offset().top;
								$(document).on("mousemove",function(e){
									var getEndX = e.pageX,
										getEndY = e.pageY;
									$(modalContent).css({
										left: getEndX-getStartX+getPositionX,
										top: getEndY-getStartY+getPositionY
									});
								});
								$(document).on("mouseup",function(){
									$(document).unbind("mousemove");
								})
							});
						};
						if(opts.resizable){//设定弹窗是否可以拖动改变大小
							var resizeControl = "<div class='resizable-e'></div>" +
								"<div class='resizable-s'></div>" +
								"<div class='resizable-w'></div>" +
								"<div class='resizable-n'></div>" +
								"<div class='resizable-en'></div>" +
								"<div class='resizable-es'></div>" +
								"<div class='resizable-wn'></div>" +
								"<div class='resizable-ws'></div>";

							var e = "resizable-e",
								s = "resizable-s",
								w = "resizable-w",
								n = "resizable-n",
								en = "resizable-en",
								es = "resizable-es",
								ws = "resizable-ws",
								wn = "resizable-wn";

							$(modalContent).append(resizeControl);

							$("." + e + "," + "." + s + "," + "." + w + "," + "." + n + "," + "." + en + "," + "." + es + "," + "." + ws + "," + "." + wn).mousedown(function(ev){
								var getStartX = ev.pageX,
									getStartY = ev.pageY,
									getWidth = $(modalContent).width(),
									getHeight = $(modalContent).height(),
									getLeft = $(modalContent).offset().left,
									getTop = $(modalContent).offset().top;
								$this = $(this);
								$(document).mousemove(function(ev){
									var getEndX = ev.pageX,
										getEndY = ev.pageY;
									var getOffsetX =getEndX -getStartX,
										getOffsetY =getEndY -getStartY;
									if($this.attr("class") == e){$(modalContent).css("width", getWidth + getOffsetX);}
									else if($this.attr("class") == s){$(modalContent).css("height", getHeight + getOffsetY);}
									else if($this.attr("class") == w){
										$(modalContent).css({
											"width": getWidth - getOffsetX,
											"left": getLeft + getOffsetX
										});
									}else if($this.attr("class") == n){
										$(modalContent).css({
											"height": getHeight - getOffsetY,
											"top": getTop + getOffsetY
										});
									}else if($this.attr("class") == en){
										$(modalContent).css({
											"width": getWidth + getOffsetX,
											"height": getHeight - getOffsetY,
											"top": getTop + getOffsetY
										});
									}else if($this.attr("class") == es){
										$(modalContent).css({
											"width": getWidth + getOffsetX,
											"height": getHeight + getOffsetY
										});
									}else if($this.attr("class") == ws){
										$(modalContent).css({
											"width": getWidth - getOffsetX,
											"height": getHeight + getOffsetY,
											"left": getLeft + getOffsetX
										});
									}else if($this.attr("class") == wn){
										$(modalContent).css({
											"width": getWidth - getOffsetX,
											"height": getHeight - getOffsetY,
											"left": getLeft + getOffsetX,
											"top": getTop + getOffsetY
										});
									}
								});
								$(document).mouseup(function(){
									$(this).unbind("mousemove");
								});
							})
						};
					}
				});
				
				if(callback){
					callback();
				};
				if(opts.addFunction){
					opts.addFunction();
				};
			}
			//注意这个if...else中的内容基本上是一样的，只是为了防止出现奇葩在元素上写的onclick的方法时 出现无限循环
			writeModal($this);
		});
	};
	$.fn.createModal.defaults = {
		background: '#000000',
		width: '600px',
		height: '500px',
		html: "",
		move: true,
		resizable: true,
		bgClose: false,
		addFunction: function(){}
	};
})(jQuery);

function showResult(){
	$("#add-key4").createModal({
		background: "#000",//设定弹窗之后的覆盖层的颜色
		width: "360px",//设定弹窗的宽度
		height: "110px",//设定弹窗的高度
		bgClose: true,//规定点击背景是否可以关闭
		addFunction: function(){//增加的方法
			$(".modal-promot-mess").click(function(){alert("addFunction");})
		}
	},function(){//回调函数的方法
		$(".insure-btn-con").click(function(){alert("callback")});
	});
}

function showResultList(){
	$('#resultListHeader', window.parent.document).text(lotteryName +' - 结果走势');
	$('#resultFrame', window.parent.document).attr('src', 'result_popup?lottery='+lottery);
	$('#resultList', window.parent.document).show();
}