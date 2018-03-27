$(function() {
    var a = false;
    var c = LIBS.cookie("_skin_");
	
    if (!c) {
        c = "blue";
        if (!c) {
            c = skins[1][0]
        }
    }
    var b = $("div[rel='" + c + "']").index() + 1;
    $("div[rel='" + c + "']").addClass("icon" + b + "active");
    $(".themeicon").click(function() {
        var f = $(this).attr("rel");
        var e = $(this).index() + 1;
        $(".themeicon").removeClass("icon1active");
        $(".themeicon").removeClass("icon2active");
        $(".themeicon").removeClass("icon3active");
        $(this).addClass("icon" + e + "active");
        changeSkin(f)
    });
    $(".lotterys .menumoregame,.lotterys .gamecontainer").hover(function() {
        clearTimeout($(".lotterys .gamecontainer").show().data("timer"));
        $(".lotterys .menumoregame").addClass("selected2")
    },
    function() {
        if (a) {
            return
        }
        var e = $(".lotterys .gamecontainer");
        e.data("timer", setTimeout(function() {
            e.hide();
            if (refreshMenu) {
                refreshMenu()
            }
        },
        200))
    });
    function d() {
        $(".gamebox").css("display", "none");
        $(".menuheaderitm").removeClass("menuitemactive")
    }
    $(".menuheaderitm").click(function() {
        d();
        var e = $(this).index();
        $(this).addClass("menuitemactive");
        $(".gamebox:eq(" + e + ")").fadeIn(200)
    });
    $(".editon .gamebtn1").click(function() {
        $(".editon").css("display", "none");
        $(".editoff").css("display", "block");
        $(".addbtn").css("display", "block");
        $(".removebtn").css("display", "block");
        $("#items").sortable({
            disabled: false
        });
        a = true
    });
    $(".editoff .gamebtn2").click(function() {
        location.reload()
    });
    $(".editoff .gamebtn1").click(function() {
        $("#items").sortable({
            disabled: true
        });
        $(".editon").css("display", "block");
        $(".editoff").css("display", "none");
        $(".addbtn").css("display", "none");
        $(".removebtn").css("display", "none");
        $(".gamecontainer").css("display", "none");
        var n = $(".item").length;
        var j = $(".itemmg").length;
        var e = [];
        var k = [];
        for (var l = 0; l < n; l++) {
            var m = $(".item a").eq(l);
            var f = m.attr("id").substr(2);
            e.push(f)
        }
        for (var l = 0; l < j; l++) {
            var m = $(".itemmg a").eq(l);
            var f = m.attr("id").substr(2);
            k.push(f)
        }
        var h = e.join(",");
        var g = k.join(",");
        LIBS.cookie("_menu_", h);
		
        LIBS.cookie("_menumore_", g);
        a = false;
        if (refreshMenu) {
            refreshMenu()
        }
    });
    $(".spritearrow").click(function() {
        var e = $(this).attr("class");
        if (e == "spritearrow arrowup") {
            $(this).removeClass("arrowup");
            $(this).addClass("arrowdown");
            $(".menu").slideUp(500);
            $(".logo").fadeOut(500);
            $("#header").animate({
                height: "73px"
            },
            500);
            $("#main").animate({
                top: "73px"
            },
            500)
        } else {
            $(this).addClass("arrowup");
            $(this).removeClass("arrowdown");
            $(".menu").slideDown(500);
            $(".logo").fadeIn(500);
            $("#header").animate({
                height: "140px"
            },
            500);
            $("#main").animate({
                top: "140px"
            },
            500)
        }
    });
    $("#settingbet").dialog({
        autoOpen: false,
        modal: true,
        width: 270,
        show: {
            duration: 500
        },
        hide: {
            duration: 500
        }
    });
    $("#section1_status1").dialog({
        autoOpen: false,
        modal: true,
        width: 400,
        draggable: false,
        show: {
            duration: 500
        },
        hide: {
            duration: 500
        }
    })
});
function showsetting() {
    var c = LIBS.cookie("defaultSetting");
    if (c) {
        var a = c.split(",");
        for (i = 0; i < a.length; i++) {
            $(".ds").eq(i).val(a[i])
        }
    }
    var b = LIBS.cookie("settingChecked");
    if (!b) {
        b = 1
    }
    $("input[name='settingbet'][value=" + b + "]").attr("checked", true);
    $("#settingbet").dialog("open")
}
function showmsg(a) {
    $("#" + a).dialog("open")
}
function closemsg() {
    $("#section1_status1").dialog("close");
    $("#section1_status2").dialog("close");
    $("#section1_status3").dialog("close")
}
function submitsetting() {
    var b = new Array();
    for (i = 0; i < 8; i++) {
        var a = $(".ds").eq(i).val();
        if (a) {
            b.push(a)
        }
    }
    var c = $("input[name=settingbet]:checked").val();
    LIBS.cookie("defaultSetting", b);
    LIBS.cookie("settingChecked", c);
    $("#settingbet").dialog("close")
}
function showpopup(a) {
    $.colorbox({
        width: "600px",
        inline: true,
        href: "#" + a,
        opacity: 0.5
    })
}
function showpopup2(a) {
    $.colorbox({
        width: "400px",
        inline: true,
        href: "#" + a,
        opacity: 0.5
    })
}
function closepopup() {
    $.colorbox.close()
};