;

$.fn.navFixed = function(setting) { 
	var _o = this,
	    conf = {
			fixedClass: 'fixed',
			fixedTop: 0
	    };
	
	$.extend(conf, setting); 
	
	return this.each(function() {
		var $target = $(_o),
	        targetTop = $target[0].offsetTop,
	        fixedTop = parseInt(conf.fixedTop, 10) || 0,
	        criticalTop = targetTop - fixedTop;
	    $(window).scroll(function () {
	        var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop,
	            scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
	        if (scrollTop > criticalTop) {
	        	if(!$target.hasClass(conf.fixedClass)) {
	        		$target.addClass(conf.fixedClass);
	        	}
	        	$target.children().css({left: -scrollLeft});
	        } else if ($target.hasClass(conf.fixedClass)) {
	        	$target.removeClass(conf.fixedClass);
	        }
	    });
	});
};$(function(){$(".mainnav li>.ele-lsub-group").each(function(){$(this).prev("a").lSubTab()})});
$.fn.lSubTab=function(){var a=$(".mainnav"),d=$(this).next(".ele-lsub-group"),v=a.data("lsub-style")?a.data("lsub-style"):"",w=a.data("lsub-align")?a.data("lsub-align"):"",x="undefined"!=typeof a.data("lsub-in")?a.data("lsub-in"):200,y="undefined"!=typeof a.data("lsub-out")?a.data("lsub-out"):300,C="undefined"!=typeof a.data("lsub-delay")?a.data("lsub-delay"):500,g=a.data("lsub-y")?a.data("lsub-y"):0,q=a.data("lsub-x")?a.data("lsub-x"):0,c=$(this),a=$("<div>").append(d).html(),r=top.mem_index?$("body",
top.mem_index.document):$("body"),m=top.mem_index?$(top.mem_index.document):$(document),b;r.prepend(a);b=top.mem_index?$("#"+d.attr("id"),top.mem_index.document):$("#"+d.attr("id"));d=b.find(".lsub-inner-wrap");d.prepend("<span class='lsub-front-bg'></span>");d.append("<span class='lsub-back-bg'></span>");var h=b.width(),a=b.height();b.css({width:h+1,height:a});d.css({position:"absolute",bottom:0});var k=0,s,z=c.offset().top+c.outerHeight(),l,f,n,t=!1,A=function(a){if(1==k)clearTimeout(s);else{k=
1;c.hasClass("current")&&(t=!0);l=c.offset();var d=c.outerWidth(),e=r.width()-$("body").width();0!=r.width()%2&&(e-=1);e=0<e?e/2:0;n="left"==w?l.left+e+q:"right"==w?l.left+e+q-h+d:l.left+e+q+d/2-h/2;f=l.top+c.outerHeight()+g;m.width()<n+h&&(n=m.width()-h);b.css({top:f,position:"absolute",left:n,"z-index":1E3});"fade"==v?b.fadeIn(x):b.slideDown(x);a.parent().attr("id")&&!t&&(a.addClass("current"),a.parent().addClass("current"))}};m.resize(function(){b.hide();k=0});var u=0;m.scroll(function(){f=c.offset().top+
c.outerHeight();$("#navfixed").hasClass("fixed")?b.css({top:f+g}):b.css({top:z+g});setTimeout(function(){1==u?$("#navfixed").hasClass("fixed")||(f=c.offset().top+c.outerHeight()+g,u=0,b.css({top:z+g})):$("#navfixed").hasClass("fixed")&&(f=c.offset().top+c.outerHeight(),u=1,b.css({top:f+g}))},1)});var B=function(a){1===k&&(b.css({"z-index":999}),s=setTimeout(function(){k=0;"fade"==v?b.fadeOut(y):b.slideUp(y);$("#LS-"+a+" a")&&!t&&$("#LS-"+a+" a, #LS-"+a).removeClass("current")},C))},p="";c.on("mouseenter",
function(){A($(this))}).on("click",function(){A($(this));b.stop(!0,!0).show()}).on("mouseleave",function(){""!==$(this).parent().prop("id")&&(p=$(this).parent().attr("id"));B(p.substr(3))});b.on("mouseenter",function(){clearTimeout(s)}).on("mouseleave",function(){p=$(this).attr("id");B(p.substr(4))})};
;
(function($) {
    $.fn.loginAuth = function(w, chkOpen) {
        "use strict";

        // 只有一個引數時，為設定驗證碼開關
        if(typeof w === 'boolean' && typeof chkOpen === 'undefined') {
            chkOpen = w;
        }
        chkOpen = (typeof chkOpen !== 'undefined' && typeof chkOpen === 'boolean')? chkOpen: true;

        var self = $(this),
            // 帳號、密碼、驗證碼資訊
            inputInfo = {
                username   : $("input[name=username]", self), // 帳號欄位
                passwd     : $("input[name=passwd]", self),   // 密碼欄位
                chkCode    : $("input[name=rmNum]", self),    // 驗證碼欄位
                usernameMin: 4,  // 帳號最小長度
                usernameMax: 15, // 帳號最大長度
                passwdMin  : 6,  // 密碼最小長度
                passwdMax  : 12  // 密碼最大長度
            },
            // 驗證表達式
            reg = {
                acc          : /[a-zA-Z0-9]/g,  // 帳號規則
                accReverse   : /[^a-zA-Z0-9]/g, // 帳號規則(反)
                passwd       : /[a-zA-Z0-9]/g,     // 密碼規則
                passwdReverse: /[^a-zA-Z0-9]/g,    // 密碼規則(反)
                upper        : /[A-Z]/g         // 大寫鎖定
            },
            // 字典檔
            dictionary = {
                'accNull'    : '请输入帐号！',
                'accShort'   : '帐号长度不能少于%s个字元',
                'accLong'    : '帐号长度不能多于%s个字元',
                'accFalse'   : '帐号须符合0~9、a~z及A~Z字元',
                'pwNull'     : '请输入密码！',
                'pwShort'    : '密码长度不能少于%s个字元',
                'pwLong'     : '密码长度不能多于%s个字元',
                'pwFalse'    : '密码须符合0~9、a~z及A~Z字元',
                'pwUpper'    : '提醒：密码须为小写，大写锁定启用中',
                'chkCodeNull': '请输入验证码！'
            },
            // 事件處理
            authEvent = {
                accRealTime: function() {
                    // 輸入格式錯誤
                    if(reg.accReverse.test(this.value)) {
                        alert(dictionary.accFalse);
                        this.value = this.value.replace(reg.accReverse, '');
                    }

                    // 帳號過長
                    if(this.value.length > inputInfo.usernameMax) {
                        alert(dictionary.accLong);
                        this.value = this.value.substring(0, inputInfo.usernameMax);
                    }
                },
                pwRealTime: function() {
                    var isFalse = reg.passwdReverse.test(this.value);

                    // 格式錯誤
                    if(isFalse) {
                        alert(dictionary.pwFalse);
                        this.value = this.value.replace(reg.passwdReverse, '');
                    }

                    // 密碼過長
                    if(this.value.length > inputInfo.passwdMax) {
                        alert(dictionary.pwLong);
                        this.value = this.value.substring(0, inputInfo.passwdMax);
                    }
                },
                formSubmit: function (e) {
                    var userVal = inputInfo.username.val(),
                        pwVal = inputInfo.passwd.val(),
                        chkCodeVal = inputInfo.chkCode.val(),
                        isFalse = false;

                    // 帳號檢查
                    if(userVal === '') {
                        stopSend(dictionary.accNull, inputInfo.username);
                    } else if(userVal.length < inputInfo.usernameMin) {
                        stopSend(dictionary.accShort, inputInfo.username);
                    } else if(reg.accReverse.test(userVal)) {
                        stopSend(dictionary.accFalse, inputInfo.username);
                    }
                    if(isFalse) return;

                    // 密碼檢查
                    if(pwVal === '') {
                        stopSend(dictionary.pwNull, inputInfo.passwd);
                    } else if(pwVal.length < inputInfo.passwdMin) {
                        stopSend(dictionary.pwShort, inputInfo.passwd);
                    } else if(reg.passwdReverse.test(pwVal)) {
                        stopSend(dictionary.pwFalse, inputInfo.passwd);
                    }
                    if(isFalse) return;

                    // 驗證碼檢查
                    if(chkCodeVal === '' && chkOpen === true) {
                        stopSend(dictionary.chkCodeNull, inputInfo.chkCode);
                    }

                    
                    function stopSend(msg, ele) {
                        if(!msg || !ele) {
                            e.preventDefault();
                            return;
                        }
                        isFalse = true;
                        alert(msg);
                        ele.focus();
                        e.preventDefault();
                    }
                }
            };

        // 使用者自訂字典檔
        if(typeof w === 'object') {
            dictionary = $.extend(dictionary, w);
        }

        // 字典檔取代
        dictionary.accShort = dictionary.accShort.replace("%s", inputInfo.usernameMin);
        dictionary.accLong  = dictionary.accLong.replace("%s", inputInfo.usernameMax);
        dictionary.pwShort  = dictionary.pwShort.replace("%s", inputInfo.passwdMin);
        dictionary.pwLong   = dictionary.pwLong.replace("%s", inputInfo.passwdMax);

        // 為配合即時驗證密碼長度，帳號、密碼輸入多一碼
        if(inputInfo.username.attr('maxlength') != inputInfo.usernameMax + 1) inputInfo.username.attr('maxlength', inputInfo.usernameMax + 1);
        if(inputInfo.passwd.attr('maxlength') != inputInfo.passwdMax + 1) inputInfo.passwd.attr('maxlength', inputInfo.passwdMax + 1);

        // 帳號即時驗證
        inputInfo.username.keyup(authEvent.accRealTime);

        // 密碼即時驗證
        inputInfo.passwd.keyup(authEvent.pwRealTime);

        // submit 驗證
        self.submit(authEvent.formSubmit);
    }
}(jQuery));