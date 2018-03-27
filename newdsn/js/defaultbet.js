var $jscomp = {
    scope: {},
    findInternal: function(a, c, b) {
        a instanceof String && (a = String(a));
        for (var d = a.length,
        e = 0; e < d; e++) {
            var f = a[e];
            if (c.call(b, f, e, a)) return {
                i: e,
                v: f
            }
        }
        return {
            i: -1,
            v: void 0
        }
    }
};
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty: function(a, c, b) {
    if (b.get || b.set) throw new TypeError("ES3 does not support getters and setters.");
    a != Array.prototype && a != Object.prototype && (a[c] = b.value)
};
$jscomp.getGlobal = function(a) {
    return "undefined" != typeof window && window === a ? a: "undefined" != typeof global && null != global ? global: a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(a, c, b, d) {
    if (c) {
        b = $jscomp.global;
        a = a.split(".");
        for (d = 0; d < a.length - 1; d++) {
            var e = a[d];
            e in b || (b[e] = {});
            b = b[e]
        }
        a = a[a.length - 1];
        d = b[a];
        c = c(d);
        c != d && null != c && $jscomp.defineProperty(b, a, {
            configurable: !0,
            writable: !0,
            value: c
        })
    }
};
$jscomp.polyfill("Array.prototype.find",
function(a) {
    return a ? a: function(a, b) {
        return $jscomp.findInternal(this, a, b).v
    }
},
"es6-impl", "es3");
$(function() {
    $(".ba").click(function() {
        var a = LIBS.cookie("settingChecked");
        $(".arrow_box").remove();
        if (1 == a && (a = LIBS.cookie("defaultSetting"))) {
            var a = a.split(","),
            c = "<div class='arrow_box'>";
            for (i = 0; i < a.length; i++) c += "<button class='db' rel='" + a[i] + "'>\u4e0b\u6ce8" + a[i] + "\u5143</button>";
            c += "<button class='dbclose'>\u5173\u95ed</button></div>";
            0 < a.length && $(this).parent().append(c)
        }
    });
    $(".ba").keyup(function() {
        $(".arrow_box").remove();
        $("td").removeClass("hover");
        $("th").removeClass("hover")
    });
    $(".showbet input").click(function() {
        var a = "";
        $(".showbet input:checked").each(function() {
            a += $(this).attr("title");
            $(".betdetails").html(a)
        })
    });
    $(".showbetchip input").click(function() {
        var a = "";
        $(".betdetails").html(a);
        $(".showbetchip input:checked").each(function() {
            a += "<div class='b" + $(this).val() + "'>" + $(this).val() + "</div>";
            $(".betdetails").html(a)
        })
    })
});
$(document).on("click", ".db",
function() {
    var a = $(this).attr("rel");
    $(this).parent().parent().find(".ba").val(a);
    $(".arrow_box").remove();
    $("td").removeClass("hover");
    $("th").removeClass("hover")
});
$(document).on("click", ".dbclose",
function() {
    $(".arrow_box").remove();
    $("td").removeClass("hover");
    $("th").removeClass("hover")
});