var $jscomp = {
    scope: {},
    findInternal: function(a, b, c) {
        a instanceof String && (a = String(a));
        for (var d = a.length,
        e = 0; e < d; e++) {
            var g = a[e];
            if (b.call(c, g, e, a)) return {
                i: e,
                v: g
            }
        }
        return {
            i: -1,
            v: void 0
        }
    }
};
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty: function(a, b, c) {
    if (c.get || c.set) throw new TypeError("ES3 does not support getters and setters.");
    a != Array.prototype && a != Object.prototype && (a[b] = c.value)
};
$jscomp.getGlobal = function(a) {
    return "undefined" != typeof window && window === a ? a: "undefined" != typeof global && null != global ? global: a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(a, b, c, d) {
    if (b) {
        c = $jscomp.global;
        a = a.split(".");
        for (d = 0; d < a.length - 1; d++) {
            var e = a[d];
            e in c || (c[e] = {});
            c = c[e]
        }
        a = a[a.length - 1];
        d = c[a];
        b = b(d);
        b != d && null != b && $jscomp.defineProperty(c, a, {
            configurable: !0,
            writable: !0,
            value: b
        })
    }
};
$jscomp.polyfill("Array.prototype.find",
function(a) {
    return a ? a: function(a, c) {
        return $jscomp.findInternal(this, a, c).v
    }
},
"es6-impl", "es3");
function getSkinColor() {
    skinColor = LIBS.cookie("_skin_")
}
$(function() {
    var a = [["red", "\u7ea2\u8272", "#dc2f39"], ["blue", "\u84dd\u8272", "#5382bc"], ["gray", "\u7070\u8272", "#cdcdcd"]],
    b = $("#skinPanel"),
    c;
    if (b.length) {
        var d = function() {
            clearTimeout(c);
            b.addClass("skinHover");
            g.show();
            h.text("\u25b2")
        },
        e = function() {
            clearTimeout(c);
            c = setTimeout(function() {
                b.removeClass("skinHover");
                g.hide();
                h.text("\u25bc")
            },
            100)
        },
        g = $("<ul>").hide().appendTo(b),
        h = b.find("a span");
        b.find("a").hover(d, e);
        g.hover(d, e);
        for (d = 0; d < a.length; d++) {
            var f = a[d],
            k = $("<li>").appendTo(g);
            k.append($("<i>").attr("style", "background:" + f[2]));
            $("<a>").attr("href", "javascript:changeSkin('" + f[0] + "')").click(e).text(f[1]).appendTo(k)
        }
    }
    f = LIBS.cookie("_skin_");
    f || (f = getDefaultSkin()) || (f = a[1][0]);
    setSkin(f, $("body"))
});
function getDefaultSkin() {
    var a = _getClass();
    if (a) for (var b = 0; b < a.length; b++) if (a[b] && 0 === a[b].indexOf("skin_")) return a[b].substring(5)
}
function _getClass(a) {
    a || (a = $("body"));
    if (a = a.attr("class")) return a.split(" ")
}
function setSkin(a, b) {
    var c = _getClass(b),
    d = "";
    if (c) for (var e = 0; e < c.length; e++) c[e] && 0 !== c[e].indexOf("skin_") && (d += c[e] + " ");
    b.attr("class", d + "skin_" + a)
}
function changeSkin(a) {

    setSkin(a, $("body"));
    LIBS.cookie("_skin_") != a && LIBS.cookie("_skin_", a);
    $("#frame").each(function() {
        setSkin(a, this.contentWindow.$("body"))
    })
};