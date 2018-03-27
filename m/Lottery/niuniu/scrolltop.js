!function($){
    var $serv=$('#server-wrap'),sao;
    if($serv.length){
        sao=$serv.find('div.weixin').eq(0);
        $serv.find('.weixin').hover(function(){
            sao.stop().animate({width:'136px'},'fast','linear');
            return false;
        },function(){
            sao.stop().animate({width:'0px'},'fast','linear');
            return false;
        });
    }
}(jQuery);
$(document).ready(function() {
    function agScrollToTop(){
        var browser_detect = {
            IE: !!(window.attachEvent && !window.opera),
            Opera: !!window.opera,
            WebKit: navigator.userAgent.indexOf("AppleWebKit/") > -1,
            Gecko: navigator.userAgent.indexOf("Gecko") > -1 && navigator.userAgent.indexOf("KHTML") == -1,
            MobileSafari: !!navigator.userAgent.match(/Apple.*Mobile.*Safari/)
        };
        var mobileSafari = browser_detect.MobileSafari;
        var upAnimate = false;
        var anim_time;
        var _ua=navigator.userAgent.toLowerCase();
        $.browser=$.browser||{
            mozilla:/firefox/.test(_ua),
            webkit:/webkit/.test(_ua),
            opera:/opera/.test(_ua),
            msie:/msie/.test(_ua)
        }
        if ($.browser.msie) {
            anim_time = 0
        } else {
            anim_time = 500
        }
        var anim_time_short = (anim_time == 0) ? 0 : 350;
        var scroll_animate = 0;
        var menuSelected = false;
        var domStart = new Date();

        function culculateDomRedy(a) {
            domStop = new Date();
            loadTime = (domStop.getTime() - domStart.getTime());
        }
        if (mobileSafari) {
            $("#wrapper").css({
                overflow: "hidden"
            });
            $("#wrapper").css({
                "min-height": "1000px"
            })
        }

        function getNewSrc(b, a) {
            preNewSrc = b.split("/");
            preNewSrc = preNewSrc[preNewSrc.length - 1].split(".");
            newSrc = preNewSrc[0] + a;
            return newSrc
        }

        function setImgSrc(a) {
            a = "#" + a;
            $(a)[0].src = project_path + getNewSrc($(a)[0].src, ".svg")
        }

        function getScrollY() {
            var b = 0,
                a = 0;
            if (typeof(window.pageYOffset) == "number") {
                a = window.pageYOffset;
                b = window.pageXOffset
            } else {
                if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                    a = document.body.scrollTop;
                    b = document.body.scrollLeft
                } else {
                    if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                        a = document.documentElement.scrollTop;
                        b = document.documentElement.scrollLeft
                    }
                }
            }
            return a
        }

        function scrollTo(a) {
            NewDocumentHeight = 0;
            switch (a) {
                case "top":
                    NewDocumentHeight = 0;
                    break
            }
            op = $.browser.opera ? $("html") : $("html, body");
            op.animate({
                scrollTop: NewDocumentHeight
            }, "slow")
        }
        var rocketFireTimer = false;
        var rocketFireState = [0, 0, 0, 1];
        var rocketFireFrameLength = 60;
        var rocketFireFrameStart = 120;
        var rocketFireAnimateTime = 100;
        var toLeftFireAnimation = false;

        function rocketFireAnimate() {
            for (i = 0; i < rocketFireState.length; i++) {
                if (rocketFireState[i] == 1) {
                    rocketFireState[i] = 0;
                    if (!toLeftFireAnimation) {
                        if ((i + 2) < rocketFireState.length) {
                            rocketFireState[i + 1] = 1
                        } else {
                            rocketFireState[0] = 1;
                            toLeftFireAnimation = true
                        }
                    } else {
                        if ((i - 1) < 0) {
                            rocketFireState[1] = 1
                        } else {
                            rocketFireState[i - 1] = 1;
                            toLeftFireAnimation = false
                        }
                    }
                    break
                }
            }
            $("#scrollTop .level-2").css({
                "background-position": "-" + (rocketFireFrameStart + (i * rocketFireFrameLength)) + "px 0px",
                display: "block"
            });
            rocketFireTimer = setTimeout(rocketFireAnimate, rocketFireAnimateTime)
        }

        function initScrollTop() {
            if (!mobileSafari) {
                $("#scrollTop div.level-3").hover(function() {
                    if ($.browser.msie) {
                        this.parentNode.children[0].style.display = "block"
                    } else {
                        $(this.parentNode.children[0]).stop().fadeTo(500, 1)
                    }
                }, function() {
                    if (upAnimate || scroll_animate) {
                        return
                    }
                    if ($.browser.msie) {
                        this.parentNode.children[0].style.display = "none"
                    } else {
                        $(this.parentNode.children[0]).stop().fadeTo(500, 0)
                    }
                });
                $("#scrollTop div.level-3").click(function() {
                    scroll_animate = 256;
                    $("#scrollTop .level-2").css({
                        "background-position": "-120px 0",
                        display: "block"
                    });
                    op = $.browser.opera ? $("html") : $("html, body");
                    rocketFireTimer = setTimeout(rocketFireAnimate, rocketFireAnimateTime);
                    op.animate({
                        scrollTop: 0
                    }, "slow", function() {
                        scroll_animate = 0;
                        if (!upAnimate) {
                            upAnimate = true;
                            thisTop = $("#scrollTop")[0].offsetTop + 250;
                            $("#scrollTop").animate({
                                "margin-bottom": "+=" + thisTop + "px"
                            }, 300, function() {
                                resetScrollUpBtn()
                            })
                        }
                    })
                });
                var _oldscrollfn=window.onscroll;
                window.onscroll = function() {
                    if(_oldscrollfn){
                        _oldscrollfn();
                    }
                    var n_scrollpos,_oldtype,scrollBtn = $("#scrollTop").eq(0),_oldtype=scrollBtn.data('laststa')||-1;
                    if(scroll_animate===256||!scrollBtn||upAnimate){return;}
                    if (window.innerHeight) {
                        n_scrollpos = window.scrollY
                    } else {
                        n_scrollpos = getScrollY()
                    }
                    if(n_scrollpos>150){
                        _newtype=1;
                    }else{
                        _newtype=-1;
                    }
                    if(_newtype==_oldtype){
                        return;
                    }
                    scrollBtn.data('laststa',_newtype);
                    scroll_animate = _newtype;
                    if(_newtype==1){
                        scrollBtn.stop().css('opacity',1).fadeIn(anim_time, function() {
                            scroll_animate = 0;
                            scrollBtn.css('margin-bottom','0px');
                        })
                    }else{
                        scrollBtn.stop().css('opacity',1).fadeOut(anim_time, function() {
                            scroll_animate = 0;
                            scrollBtn.css('margin-bottom','0px');
                        })
                    }
                }
            } else {
                setTimeout(function() {
                    window.scrollTo(0, 1)
                }, 100)
            }
        }

        function resetScrollUpBtn() {
            $("#scrollTop .level-2").css({
                "background-position": "-60px 0px",
                display: "none"
            });
            $("#scrollTop").css({
                'display': "none",
                'margin-bottom':'0px'
            }).data('laststa','-1');
            upAnimate = false;
            clearTimeout(rocketFireTimer)
        };
        
        /* !important*/
        function agScrollTop() {
            initScrollTop();
        }
        agScrollTop();

    }
    agScrollToTop();
});



