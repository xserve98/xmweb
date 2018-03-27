var MAX_DIVIDEND;
var SOUND_URL;
var DEFAULT;
var _LS;
var _LIC = 8;
var _lastResult;
var sideUserTitle;
var resetTimer;
var currentLottery;
var accountTimer;
var userparams;
var betting = false;
var _lastBetsTimer;
var _resultTimer;
$.ajaxSetup({
    cache: false
});






$(function() {
    if (/MSIE (6|7)/.test(navigator.userAgent)) {
        var a = function() {
            var f = $("#footer").position().top - $("#main").position().top;
            $("#main").height(f);
            $("#frame").height($("#main").height());
            $("#main .frame").width($("#main").width() - 232)
        };
        a();
        $(window).resize(a)
    }
    $("#header .menu2 a").click(function() {
        $("#header .menu2 a.selected,#header .sub a.selected").removeClass("selected");
        $(this).addClass("selected");
        var f = $(this).attr("href");
        if (f != null && f.indexOf("{lottery}") != -1) {
            f = f.replace("{lottery}", currentLottery.id);
            $("#" + $(this).attr("target")).attr("src", f);
			
            return false
        }
    });
    var b = $("#lotterys a").click(function() {
        changePage($(this));
        refreshMenu()
    }).not("[target]").eq(0);
    var e = LIBS.cookie("defaultLT");
	///////////////////////设置开奖地址和规则地址////////
	if(e=='BJPK10'){
    $('#yxgz').attr('href','/lottery/rules/pk10.php?name='+e); 
	 $('#kjjg').attr('href','/Lottery/list_Pk10.php?name='+e); 
	}
	else if(e=='AULUCKY10'){
	 $('#kjjg').attr('href','/lottery/list_Pk10.php?type=8&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xyft.php?name='+e); 
	         	}
				else if(e=='JSSC'){
	 $('#kjjg').attr('href','/lottery/list_Pk10.php?type=24&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jssc.php?name='+e); 
	         	}
			else if(e=='CQSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqssc.php?name='+e); 
	         	}
		
		else if(e=='GDKLSF'){
	 $('#kjjg').attr('href','/Lottery/list_gdsf.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/klsf.php?name='+e); 
	         	}
			else if(e=='XYNC'){
	 $('#kjjg').attr('href','/Lottery/list_xync.php?type=11&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqsf.php?name='+e); 
	         	}
			else if(e=='HK6'){
	 $('#kjjg').attr('href','/Six/Auto.php'); 
	 $('#yxgz').attr('href','/lottery/rules/six.php?name='+e); 
	         	}
				else if(e=='CQHK6'){
	 $('#kjjg').attr('href','/cqSix/Auto.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqsix.php?name='+e); 
	         	}
		
			else if(e=='PCEGG'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xy28.php?name='+e); 
	         	}
		else if(e=='JSPCDD'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?type=26&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jspcdd.php?name='+e); 
	         	}
		
			else if(e=='JND28'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?type=13&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jnd28.php?name='+e); 
	         	}
		
			else if(e=='XJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=14&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xjssc.php?name='+e); 
	         	}
				else if(e=='TJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=7&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/tjssc.php?name='+e); 
	         	}
				else if(e=='LFSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=20&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/lfc.php?name='+e); 
	         	}
				else if(e=='FFSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=21&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/ffc.php?name='+e); 
	         	}
				
					else if(e=='F3D'){
	 $('#kjjg').attr('href','/Lottery/list_3D.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/3d.php?name='+e); 
	         	}
					else if(e=='BJKL8'){
	 $('#kjjg').attr('href','/Lottery/list_kl8.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/KL8.php?name='+e); 
	         	}	else if(e=='PL3'){
	 $('#kjjg').attr('href','/Lottery/list_3D.php?type=10&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/pl3.php?name='+e); 
	         	}
					else if(e=='XJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=21&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/ffc.php?name='+e); 
	         	}
		
		else if(e=='DWZP'){
	 $('#kjjg').attr('href','/Lottery/dwzp_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/dwzp.php?name='+e); 
	         	}
		
		else if(e=='BRNN'){
	 $('#kjjg').attr('href','/Lottery/brnn_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/brnn.php?name='+e); 
	         	}
		
	
	
	
	///////////////////////
    if (e) {
        var c = $("#l_" + e);
        if (c.length > 0) {
            b = c
        }
    }
    initMenu();
    $(".header .sub a").click(function() {
        var g = $(this);
        $("#header .menu2 a.selected,#header .sub a.selected").removeClass("selected");
        $(this).addClass("selected");
        var f = g.attr("href");
        $("#frame").attr("src", f).data("a", g);
	     document.getElementById('frame').contentWindow.location.reload(true);
		
		window.frames['frame'].location = f;
        return false
    });
    $(".sidenavibtn").click(function() {
        var g = $(this);
        $(".sidenavibtn").removeClass("sidenaviactive");
        $(g).addClass("sidenaviactive");
        var f = g.attr("rel");
        $("#frame").attr("src", f).data("a", g);
        return false
    });
	    $(".exlinkbtn").click(function() {
        var g1 = $(this); 
        var f1 = g1.attr("rel");
        $("#frame").attr("src", f1).data("a", g1);
        return false
    });
	
	
    $("#frame").on("load",
    function() {
        resetPanel(true);
        var h = LIBS.cookie("_skin_");
		
        if (!h) {
            h = getDefaultSkin();
            if (!h) {
                h = skins[1][0]
            }
        }
        var g = ["blue", "gold", "red"];
        var f = g.indexOf(h);
        $(".themeicon").eq(f).click()
    });
    sideUserTitle = $("#side .user_info .title");
    sideUserTitle.data("text", sideUserTitle.text());
 
    $("#betAmount").keypress(function(f) {
        if (f.keyCode == 13) {
            $("#btnBet").click()
        }
    });
    b.click();
    var d = LIBS.getUrlParam("page");
    if (d) {
        $("#frame").attr("src", d)
    }

});
function initMenu() {
    var e = $(".header .lotterys .show");
    var d = [];
    var f = $("#lotterys");
    f.find("a").each(function() {
        var i = $(this);
        var q = {
            id: i.attr("id").substr(2),
            info: i.attr("lang").split("_", 2),
            name: i.text()
        };
        i.data("info", q);
        d.push(q)
    });
    var c = LIBS.cookie("_menu_");

    var j = LIBS.cookie("_menumore_");
    if (!c) {
        var o = Math.min(_LIC, d.length);
        for (var m = 0; m < o; m++) {
            $(".items").append("<li><div class='item'></div></li>");
            var b = $(".item").eq(m);
            $("#l_" + d[m].id).appendTo(b);
            $(b).append("<div class='removebtn'></div>")
        }
        var n = 0;
        for (var m = _LIC; m < d.length; m++) {
            $(".gamebox").append("<div class='itemmg'></div>");
            var b = $(".itemmg").eq(n);
            $("#l_" + d[m].id).appendTo(b);
            $(b).append("<div class='addbtn'></div>");
            n++
        }
    } else {
        var a = c.split(",");
        var l = j.split(",");
        var p = a.length;
        var h = l.length;
        var k = $(".lotterys a").length;
        for (var m = 0; m < p; m++) {
            var g = a[m];
            $(".items").append("<li><div class='item'></div></li>");
            var b = $(".item").eq(m);
            $("#l_" + g).appendTo(b);
            $(b).append("<div class='removebtn'></div>")
        }
        var n = 0;
        for (var m = p; m < k; m++) {
            var g = l[n];
            $(".gamebox").append("<div class='itemmg'></div>");
            var b = $(".itemmg").eq(n);
            $("#l_" + g).appendTo(b);
            $(b).append("<div class='addbtn'></div>");
            n++
        }
    }
}
function changePage(d, c) {
   if (d.attr("target")) {
        return
    }
    var f = d.data("info");
	
    LIBS.cookie("defaultLT", f.id);
	///////////////设置开奖和规则地址/////////////
	e=LIBS.cookie("defaultLT")
	///alert(e);
	if(e=='BJPK10'){
    $('#yxgz').attr('href','/lottery/rules/pk10.php?name='+e); 
	 $('#kjjg').attr('href','/Lottery/list_Pk10.php?name='+e); 
	}
	else if(e=='AULUCKY10'){
	 $('#kjjg').attr('href','/lottery/list_Pk10.php?type=8&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xyft.php?name='+e); 
	         	}
					else if(e=='JSSC'){
	 $('#kjjg').attr('href','/lottery/list_Pk10.php?type=24&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jssc.php?name='+e); 
	         	}
			else if(e=='CQSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqssc.php?name='+e); 
	         	}
		
		else if(e=='GDKLSF'){
	 $('#kjjg').attr('href','/Lottery/list_gdsf.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/klsf.php?name='+e); 
	         	}
			else if(e=='XYNC'){
	 $('#kjjg').attr('href','/Lottery/list_xync.php?type=11&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqsf.php?name='+e); 
	         	}
			else if(e=='HK6'){
	 $('#kjjg').attr('href','/Six/Auto.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/six.php?name='+e); 
	         	}
				else if(e=='CQHK6'){
	 $('#kjjg').attr('href','/cqSix/Auto.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/cqsix.php?name='+e); 
	         	}
		
			else if(e=='PCEGG'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xy28.php?name='+e); 
	         	}
		
	else if(e=='JSPCDD'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?type=26&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jspcdd.php?name='+e); 
	         	}
			else if(e=='JND28'){
	 $('#kjjg').attr('href','/Lottery/list_xy28.php?type=13&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/jnd28.php?name='+e); 
	         	}
		
			else if(e=='XJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=14&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/xjssc.php?name='+e); 
	         	}
				else if(e=='TJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=7&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/tjssc.php?name='+e); 
	         	}
				else if(e=='LFSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=20&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/lfc.php?name='+e); 
	         	}
				else if(e=='FFSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=21&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/ffc.php?name='+e); 
	         	}
				
					else if(e=='F3D'){
	 $('#kjjg').attr('href','/Lottery/list_3D.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/3d.php?name='+e); 
	         	}
					else if(e=='BJKL8'){
	 $('#kjjg').attr('href','/Lottery/list_kl8.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/KL8.php?name='+e); 
	         	}	else if(e=='PL3'){
	 $('#kjjg').attr('href','/Lottery/list_3D.php?type=10&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/pl3.php?name='+e); 
	         	}
					else if(e=='XJSSC'){
	 $('#kjjg').attr('href','/Lottery/ssc_list.php?type=21&name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/ffc.php?name='+e); 
	         	}
		
		else if(e=='DWZP'){
	 $('#kjjg').attr('href','/Lottery/dwzp_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/dwzp.php?name='+e); 
	         	}
		
		else if(e=='BRNN'){
	 $('#kjjg').attr('href','/Lottery/brnn_list.php?name='+e); 
	 $('#yxgz').attr('href','/lottery/rules/brnn.php?name='+e); 
	         	}
		

		
	///////////////////////
    if (!currentLottery || f.id != currentLottery.id) {
        currentLottery = f;
        
    }
    var e = $("#sub_" + f.id);
    $(".header .sub div:visible").hide();
    e.show();
    var b;
    if (c !== undefined) {
        b = e.find("a:eq(" + c + ")")
    } else {
        b = e.find("a.default");
        if (b.length == 0) {
            b = e.find("a:eq(0)")
        }
    }
    b.click()
}

function playSound() {
    if (!SOUND_URL) {
        return
    }
    var a = $("#SOUND");
    if (a.length == 0) {
        a = $('<audio id="SOUND"><source src="' + SOUND_URL + '" type="audio/mpeg"/></audio>').appendTo($("body"))[0];
        if (a.load) {
            a.load()
        }
    } else {
        a = a[0]
    }
    if (a.play) {
        a.play()
    }
}
function bet(b, d, a, c) {
    postBet({
        lottery: b,
        drawNumber: d,
        bets: a
    },
    c)
}
function postBet(a, b,c) {

    var url = $("#frame").contents().find("#orders").attr("action");
	var data=[];
	var str='';
	c=$("#frame").contents().find("#open_qihao").text();
if(url=='/Six/order/order.php?type=0&class=8'||url=='/cqSix/order/order.php?type=22&class=8'){//////////////六合彩过关投注//////
	var ballarr= a[0].ball.split('|');
	var valuearr= a[0].value.split('|');
	
	for(var i=0; i<ballarr.length;i++){
		str +=ballarr[i]+'='+valuearr[i]+'&';
			}
	  str = str+'money='+a[0].amount+'&';
    }else if(url=='/Six/order/order.php?type=0&class=11'||url=='/cqSix/order/order.php?type=22&class=11'){/////连码投注////
	 var ballarr= a[0].ball.split(',');
	    for(var i=0; i<ballarr.length;i++){
		str += 'ball[]='+ballarr[i]+'&';
			}
	str=str+'ball_11='+a[0].ball_11+'&type=1&money='+parseInt(a[0].amount)+'&';
	
	}
	else if(url=='/Six/order/order.php?type=0&class=13'||url=='/cqSix/order/order.php?type=22&class=13'){/////连码投注////
	 var ballarr= a[0].ball.split(',');
	    for(var i=0; i<ballarr.length;i++){
		str += 'ball[]='+ballarr[i]+'&';
			}
	str=str+'ball_13='+a[0].ball_13+'&money='+parseInt(a[0].amount)+'&';
	
	}
		else if(url=='/Six/order/order.php?type=0&class=14'||url=='/cqSix/order/order.php?type=22&class=14'){/////连码投注////
	 var ballarr= a[0].ball.split(',');
	    for(var i=0; i<ballarr.length;i++){
		str += 'ball[]='+ballarr[i]+'&';
			}
	str=str+'ball_14='+a[0].ball_14+'&money='+parseInt(a[0].amount)+'&';
	
	}
	else if(url=='/Six/order/order.php?type=0&class=15'||url=='/cqSix/order/order.php?type=22&class=15'){/////连码投注////
	 var ballarr= a[0].ball.split(',');
	    for(var i=0; i<ballarr.length;i++){
		str += 'ball[]='+ballarr[i]+'&';
			}
	str=str+'ball_15='+a[0].ball_15+'&money='+parseInt(a[0].amount)+'&';
	
	}
	
	
	
	else if(url=='/Six/order/order.php?type=0&class=12'||url=='/cqSix/order/order.php?type=22&class=12'){
	 var ballarr= a[0].ball.split(',');
	 for(var i=0; i<ballarr.length;i++){
		str += 'ball[]='+ballarr[i]+'&';
			}
			
			str = str+'money='+parseInt(a[0].amount)+'&';
	}else{
	
	///console.log(a);
	if(a[0].ball_xx){
		 var ballarr= a[0].ball.split(',');
			 for(var i=0; i<ballarr.length;i++){
		str += ballarr[i]+"=on&";
			}
			str = str+'ball_xx='+parseInt(a[0].amount)+'&';
			}else{
		
	
	for(var i=0;i<a.length;i++){
		
		str += a[i].ball+'='+parseInt(a[i].amount)+'&';
		}
		
			}
		
	}
	

   str=str+'qi_num='+parseInt(c);


    $.ajax({
        url: url,
         type: 'post',//提交的方法
         async : false,
         data:str, 
		 dataType:'text',
     
	
	 success: function(data) {
		 var data = eval( "(" + data + ")" );
		   //  ///console.log(data);
		     // ///console.log('data.code='+data.code);
                if(data.code == 0) {
                    var html = getOrdersHtml(data);
					 //////console.log(html);
                    $("#info").hide();
                    $("#user_order").html(html).show();
				///	alert(data.balance);
					$('#balance').html(data.balance);
                    formReset();
                } else if(data.code == 1) {
                    layer.msg(data.info);
                } else if(data.code == 2) {
                    layer.msg(data.info);
                 ///   location.replace(location.href);
                } else {
                  //  window.top.location = "/";
                }
          
	
	
        },
		
		
		
        error: function(c) {
            alert("投注失败：" + c.code + ",请检查下注状况後重试。")
        },
        complate: function() {
            toggleBetButton(true)
        }
    })
}

function getUserParam(b, a) {
    if (!userparams) {
        return
    }
    return userparams[b + "-" + a]
}
function toggleBetButton(a) {
    if (a) {
        $(".control input").hide();
        $(".control span").show()
    } else {
        $(".control span").hide();
        $(".control input").show()
    }
}
function getBetTextHtml(b) {
    function c(h, g) {
        return '<span class="text">' + h + '</span>@<span class="odds">' + g + "</span>"
    }
    if (b.multiple) {
        return c(b.title, b.odds)
    }
    var f = b.text;
    var a = f.split("@");
    if (b.title) {
        f = b.title + " " + a[0]
    }
    var e = c(f, b.odds);
    if (a.length > 1) {
        for (var d = 1; d < a.length; d++) {
            e += "<br />" + c(a[d], b.oddsDetail[d - 1])
        }
    }
    return e
}

function reBet(a) {
    var b = $(a).data("last");
    if (b == null) {
        return
    }
    b.ignore = true;
    postBet(b)
}
function showPanel(a, b) {
    resetPanel();
    sideUserTitle.text(b);
    $(".betdone").hide();
    a.show()
}
function resetPanel(a) {
    clearTimeout(resetTimer);
    resetTimer = null;
    sideUserTitle.text(sideUserTitle.data("text"));
    $(".betdone").show();
    $("#betResultPanel").hide();
    if (!a) {
        refreshBets()
    }
}
function showMsg(b, c) {
    var a = $("#messageBox");
    if (a.length == 0) {
        a = $('<div id="messageBox">').appendTo("body").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            icon: true,
            minHeight: 0,
            width: 400,
            title: "用户提示",
            buttons: {
                "确定": function() {
                    $(this).data("ok", true).dialog("close")
                },
                "取消": function() {
                    $(this).dialog("close")
                }
            }
        }).on("dialogclose",
        function(f) {
            var d = $(this).data("cb");
            if ($.isFunction(d)) {
                d($(this).data("ok"))
            }
        })
    }
    a.text(b).dialog("open").data({
        ok: false,
        cb: c
    });
    if (c) {
        a.dialog("widget").find(".ui-dialog-buttonset button:eq(1)").show()
    } else {
        a.dialog("widget").find(".ui-dialog-buttonset button:eq(1)").hide()
    }
}
function getBetText(a) {
    var c = "";
    if (a.title) {
        c += a.title + " "
    }
    c += a.text;
    if (a.multiple && a.multiple > 1) {
        c += '<div class="multiple">复式『 <span>' + a.multiple + ' 组</span> 』 <a>查看明细</a><ol style="display:none">';
        var d = LIBS.comboArray(a.text, a.mcount);
        for (var b = 0; b < d.length; b++) {
            c += "<li><span>" + d[b].join("、") + "<span></li>"
        }
        c += "</ol>"
    }
    return c
}
function showBets(d, k) {
    var g = $("#betsBox");
    if (g.length == 0) {
        g = $('<div id="betsBox"></div>').appendTo("body").dialog({
            closeButton: false,
            autoOpen: false,
            resizable: false,
            icon: true,
            modal: true,
            minHeight: 0,
            width: 400,
            title: "下注明细（请确认注单）",
            buttons: {
                "确定": function() {
                    var b = [];
                    $("#betList tr").each(function() {
                        var n = $(this);
                        if (n.find("input:checked").length != 0) {
                            var m = Number(n.find(".amount input").val());
							  
                            if (m <= 0 || isNaN(m)) {
                                return
                            }
                            var l = n.data("b");
                            l.amount = m;
                            b.push(l)
                        }
                    });
					  ///console.log(b);
                    if (b.length > 0) {
                       // var i = $(this).data("req");
                         //i.bets = b;
					//	///console.log(i);
						/////console.log($(this).data("cb"));
                        postBet(b,d.lottery,d.drawNumber)
                    }
                    $(this).data("sc", true).dialog("close")
                },
                "取消": function() {
                    $(this).dialog("close")
                }
            }
        }).on("dialogclose",
        function() {
            betting = false
        }).on("dialogbeforeclose",
        function() {
            if (!$(this).data("sc")) {
                var b = $(this);
                showMsg("你确定取消下注吗？",
                function(i) {
                    if (i) {
                        b.data("sc", true).dialog("close")
                    }
                });
                return false
            }
        }).html('<div class="betList"><table class="table"><thead><th>号码</th><th>赔率</th><th>金额</th><th>确认</th></thead><tbody id="betList"></tbody></table></div><div class="bottom"><span id="bcount"></span><span id="btotal"></span></div>');
        g.keypress(function(b) {
            if (b.keyCode == 13) {
                $(this).parent().find(".ui-dialog-buttonset button:eq(0)").click()
            }
        })
    }
    betting = true;
    var f = $("#betList");
    f.empty();
   var a = d.bets;
   var xjhs1 ="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}";
     var xjhs2 ="this.value=this.value.replace(/\D/g,'')";
///	style="ime-mode:disabled" onkeypress="return event.keyCode>=48&&event.keyCode<=57" onpaste="return !clipboardData.getData("text').match(/D/)" ondragenter="return false" 	
    for (var e = 0, c = a.length; e < c; e++) {
        var j = a[e];
        $("<tr>").appendTo(f).data("b", j).append($("<td>").addClass("contents").html(j.contents)).append($("<td>").addClass("odds").text(j.odds)).append($("<td>").addClass("amount").append($("<input onkeyup="+xjhs1+"   name='"+j.ball+"'>").val(j.amount))).append($("<td>").addClass("check").append($('<input type="checkbox">').prop("checked", true)))
    }
	
	
    function h() {
        var i = 0;
        var b = 0;
        f.find("tr").each(function() {
            var n = $(this);
            if (n.find("input:checked").length != 0) {
                var m = Number(n.find(".amount input").val());
                if (m <= 0 || isNaN(m)) {
                    return
                }
                var l = n.data("b");
                var o = l.multiple ? l.multiple: 1;
                i += m * o;
                b += o
            }
        });
        $("#bcount").text("组数：" + b);
        $("#btotal").text("总金额：" + i)
    }
    f.find("input").change(h);
    f.find(".multiple a").hover(function() {
        $(this).parent().find("ol").show()
    },
    function() {
        $(this).parent().find("ol").hide()
    });
    h();
    g.dialog("open").data({
        req: d,
        sc: false,
        cb: k
    })
}

function showlhcBets(d, k) {
	
    var g = $("#betsBox");
    if (g.length == 0) {
        g = $('<div id="betsBox"></div>').appendTo("body").dialog({
            closeButton: false,
            autoOpen: false,
            resizable: false,
            icon: true,
            modal: true,
            minHeight: 0,
            width: 400,
            title: "下注明细（请确认注单）",
            buttons: {
                "确定": function() {
                    var b = [];
                    $("#betList tr").each(function() {
                        var n = $(this);
                        if (n.find("input:checked").length != 0) {
                            var m = Number(n.find(".amount input").val());
							  
                            if (m <= 0 || isNaN(m)) {
                                return
                            }
                            var l = n.data("b");
                            l.amount = m;
                            b.push(l)
                        }
                    });
					  ///console.log(b);
                    if (b.length > 0) {
                       // var i = $(this).data("req");
                         //i.bets = b;
					//	///console.log(i);
						/////console.log($(this).data("cb"));
                        postBet(b,d.lottery,d.drawNumber)
                    }
                    $(this).data("sc", true).dialog("close")
                },
                "取消": function() {
                    $(this).dialog("close")
                }
            }
        }).on("dialogclose",
        function() {
            betting = false
        }).on("dialogbeforeclose",
        function() {
            if (!$(this).data("sc")) {
                var b = $(this);
                showMsg("你确定取消下注吗？",
                function(i) {
                    if (i) {
                        b.data("sc", true).dialog("close")
                    }
                });
                return false
            }
        }).html('<div class="betList"><table class="table"><thead><th>号码</th><th>赔率</th><th>金额</th><th>确认</th></thead><tbody id="betList"></tbody></table></div><div class="bottom"><span id="bcount"></span><span id="btotal"></span></div>');
        g.keypress(function(b) {
            if (b.keyCode == 13) {
                $(this).parent().find(".ui-dialog-buttonset button:eq(0)").click()
            }
        })
    }
    betting = true;
    var f = $("#betList");
    f.empty();
   var a = d.bets;
    for (var e = 0, c = a.length; e < c; e++) {
        var j = a[e];
        $("<tr>").appendTo(f).data("b", j).append($("<td>").addClass("contents").html(j.contents)).append($("<td>").addClass("odds").text(j.odds)).append($("<td>").addClass("amount").append($("<input  name='"+j.ball+"'>").val(j.amount))).append($("<td>").addClass("check").append($('<input type="checkbox">').prop("checked", true)))
    }
	
	
    function h() {
        var i = 0;
        var b = 0;
        f.find("tr").each(function() {
            var n = $(this);
            if (n.find("input:checked").length != 0) {
                var m = Number(n.find(".amount input").val());
                if (m <= 0 || isNaN(m)) {
                    return
                }
                var l = n.data("b");
                var o = l.multiple ? l.multiple: 1;
                i += m * a[0].zushu;
                b += o
            }
        });
        $("#bcount").text("组数：" + a[0].zushu);
        $("#btotal").text("总金额：" + i)
    }
    f.find("input").change(h);
    f.find(".multiple a").hover(function() {
        $(this).parent().find("ol").show()
    },
    function() {
        $(this).parent().find("ol").hide()
    });
    h();
    g.dialog("open").data({
        req: d,
        sc: false,
        cb: k
    })
}








function refreshMenu() {
    $(".gamecontainer").hide();
    var b = $("#l_" + currentLottery.id);
    $("#items a.selected").removeClass("selected");
    if (b.parent().hasClass("itemmg")) {
        $("#moregames").text(b.data("info").name);
        $(".lotterys .menumoregame").addClass("selected2")
    } else {
        $("#moregames").text("更多游戏");
        $(".lotterys .menumoregame").removeClass("selected2");
        b.addClass("selected")
    }
}
$(document).on("click", ".removebtn",
function() {
    var b = $(".item").length;
    if (b == 1) {
        showMsg("最少要保留一个游戏！")
    } else {
        var a = $(this).parent().find("a");
        var b = $(".itemmg").length;
        $(".gamebox").append("<div class='itemmg'></div>");
        $(a).appendTo(".itemmg:eq(" + b + ")");
        $(".itemmg:eq(" + b + ")").append("<div class='addbtn'></div>");
        $(this).parent().parent().remove();
        $(".addbtn").css("display", "block");
        $(".removebtn").css("display", "block")
    }
});
$(document).on("click", ".addbtn",
function() {
    var b = $(".item").length;
    if (b == _LIC) {
        showMsg("最多可以添加" + _LIC + "个游戏！")
    } else {
        var a = $(this).parent().find("a");
        $(".items").append("<li class='ui-sortable-handle'><div class='item'></div></div>");
        $(a).appendTo(".item:eq(" + b + ")");
        $(".item:eq(" + b + ")").append("<div class='removebtn'></div>");
        $(this).parent().remove()
    }
    $(".addbtn").css("display", "block");
    $(".removebtn").css("display", "block")
});
function loadAccount() {
    var a = $("#frame")[0].contentWindow.PeriodPanel;
    if (a) {
        a.loadAccounts()
    }
}

$(function() {
    $("#resultList").draggable();
    $("a").click(function() {
        $("#resultList").hide()
    })
});