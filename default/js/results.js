var $jscomp = {
    scope: {},
    findInternal: function(b, a, g) {
        b instanceof String && (b = String(b));
        for (var e = b.length,
        c = 0; c < e; c++) {
            var d = b[c];
            if (a.call(g, d, c, b)) return {
                i: c,
                v: d
            }
        }
        return {
            i: -1,
            v: void 0
        }
    }
};
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty: function(b, a, g) {
    if (g.get || g.set) throw new TypeError("ES3 does not support getters and setters.");
    b != Array.prototype && b != Object.prototype && (b[a] = g.value)
};
$jscomp.getGlobal = function(b) {
    return "undefined" != typeof window && window === b ? b: "undefined" != typeof global && null != global ? global: b
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(b, a, g, e) {
    if (a) {
        g = $jscomp.global;
        b = b.split(".");
        for (e = 0; e < b.length - 1; e++) {
            var c = b[e];
            c in g || (g[c] = {});
            g = g[c]
        }
        b = b[b.length - 1];
        e = g[b];
        a = a(e);
        a != e && null != a && $jscomp.defineProperty(g, b, {
            configurable: !0,
            writable: !0,
            value: a
        })
    }
};
$jscomp.polyfill("Array.prototype.find",
function(b) {
    return b ? b: function(a, g) {
        return $jscomp.findInternal(this, a, g).v
    }
},
"es6-impl", "es3");
var lottery, Results = function() {
    var b = {
        dx: {
            D: "\u5927",
            X: "\u5c0f",
            T: "\u548c",
            N: "\u901a\u5403",
            LOSE: "\u8f93"
        },
        xwdx: {
            D: "\u5927",
            X: "\u5c0f",
            T: "\u548c",
            N: "\u901a\u5403"
        },
        ds: {
            D: "\u5355",
            S: "\u53cc",
            T: "\u548c",
            LOSE: "\u8f93"
        },
        hds: {
            D: "\u5355",
            S: "\u53cc",
            T: "\u548c"
        },
        lh: {
            L: "\u9f99",
            H: "\u864e",
            T: "\u548c"
        },
        sb: {
            R: "\u7ea2",
            G: "\u7eff",
            B: "\u84dd"
        },
        fw: {
            0 : "\u4e1c",
            1 : "\u5357",
            2 : "\u897f",
            3 : "\u5317"
        },
        zfb: {
            0 : "\u4e2d",
            1 : "\u53d1",
            2 : "\u767d"
        },
        wx: {
            0 : "\u91d1",
            1 : "\u6728",
            2 : "\u6c34",
            3 : "\u706b",
            4 : "\u571f"
        },
        flsx: {
            F: "\u798f",
            L: "\u7984",
            S: "\u5bff",
            X: "\u559c",
            T: "\u548c"
        },
        qh: {
            Q: "\u524d",
            H: "\u5f8c",
            T: "\u548c"
        }
    };
    return {
        inited: !1,
        tabKeys: null,
        maxCols: 25,
        index: null,
        init: function(a, g, e, c, d, k) {
            var f = $("#resultPanel");
            f.length || (f = $('<div id="resultPanel">').appendTo($("#main")));
            null != g && null != e && (this.minBall = g, this.maxBall = e, this.index = d || 1, this.ballTotal = !!k, this.initBallPanel(f, c));
            this.tabs = a;
            this.initTabs(f);
            this.inited = !0
        },
        initBallPanel: function(a, g) {
            for (var e = $("<tr>").appendTo($("<table>").addClass("tabTitle").appendTo(a)), c = this, d = 0; d < g.length; d++) {
                var k = g[d],
                k = $("<a>").data("idx", d + 1).text(k).attr("href", "javascript:void(0)");
                k.appendTo($("<th>").appendTo(e));
                k.click(function() {
                    var a = $(this);
                    a.parent().parent().find("th.selected").removeClass("selected");
                    a.parent().addClass("selected");
                    c.changeBall(a.text(), a.data("idx"))
                })
            }
            e.find("a").eq(this.index - 1).click();
            e = $("<table>").addClass("ballTable").appendTo(a);
            if ("XYNC" == lottery) {
                k = $("<tr>").addClass("head").appendTo(e);
                k.append($("<th>").text("\u7c7b\u578b").addClass("title"));
                for (var f = "\u897f\u74dc \u6930\u5b50 \u69b4\u83b2 \u67da\u5b50 \u83e0\u841d \u8461\u8404 \u8354\u679d \u6a31\u6843 \u8349\u8393 \u756a\u8304 \u68a8\u5b50 \u82f9\u679c \u6843\u5b50 \u67d1\u6a58 \u51ac\u74dc \u841d\u535c \u5357\u74dc \u8304\u5b50 \u5bb6\u72ac \u5976\u725b".split(" "), d = 0; d < f.length; d++) k.append($("<th>").text(f[d]))
            }
            var k = $("<tr>").addClass("head").appendTo(e),
            f = $("<tr>").appendTo(e),
            h = !1;
            this.ballTotal && (h = $("<tr>").appendTo(e), k.append($("<th>").text("\u53f7\u7801").addClass("title")), f.append($("<th>").text("\u51fa \u7403 \u7387")), h.append($("<th>").text("\u65e0\u51fa\u671f\u6570")));
            for (d = this.minBall; d <= this.maxBall; d++) {
                var b = d;
                10 < this.maxBall && 10 > d && (b = "0" + d);
                k.append($("<th>").addClass("b" + d).text(b));
                f.append($("<td>").addClass("b" + d).text("0"));
                h && h.append($("<td>").addClass("b" + d).text("0"))
            }
            this.ballTable = e;
            this.ballLine = f;
            this.ballTotalLine = h
        },
        initTabs: function(a) {
            var g = this,
            e = this.tabs,
            c = $("<tr>").appendTo($("<table>").addClass("tabTitle").appendTo(a));
            this.tabTitles = c;
            var d = [],
            k = {},
            f;
            for (f in e) {
                var h = $("<th>").appendTo(c),
                b = e[f],
                l = $("<a>").data("option", b).text(f).attr("href", "javascript:void(0)");
                2 < b.length ? (k[b[0] + "_" + b[2][0]] = $("<span>").appendTo(h), l.appendTo(h), k[b[0] + "_" + b[2][1]] = $("<span>").appendTo(h), d.push(b[0])) : l.appendTo(h);
                "" == f && (l.addClass("ball"), this.ballText && l.text(this.ballText));
                l.click(function() {
                    var a = $(this);
                    a.parent().parent().find("th.selected").removeClass("selected");
                    a.parent().addClass("selected");
                    g.changeTab(a.data("option"))
                })
            }
            this.totalKeys = d;
            this.totalItems = k;
            this.tabPanel = $("<tr>").appendTo($("<table>").addClass("tabContents").appendTo(a));
            this.changeIndex(0)
        },
        changeBall: function(a, g) {
            this.ballText = a;
            this.inited && (this.tabTitles.find("a.ball").text(a), this.index = g, this.showResults())
        },
        changeIndex: function(a) {
            this.tabTitles.find("a:eq(" + a + ")").click()
        },
        changeTab: function(a) {
            this.tabKeys = a;
            this.showResults()
        },
        getKey: function(a) {
            return null != this.index ? a.format(this.index) : a
        },
        showBalls: function(a) {
            if (this.ballLine) {
                for (var g = this.getKey("B{0}"), e = {},
                c = 0; c < a.length; c++) {
                    var d = Number(a[c].detail[g]),
                    b = e[d];
                    b || (b = 0);
                    b += 1;
                    e[d] = b
                }
                for (d in e) this.ballLine.children(".b" + d).text(e[d]);
                if (this.ballTotal) {
                    for (var g = {},
                    b = this.maxBall - this.minBall + 1,
                    f, c = 0; c < a.length; c++) for (var e = a[c].result.split(","), h = 0; h < e.length; h++) if (d = Number(e[h]), void 0 === g[d] && (g[d] = c, --b, 0 >= b)) {
                        f = c;
                        break
                    }
                    0 < b && (f = a.length);
                    this.ballTotalLine.children(".max").removeClass("max");
                    for (c = this.minBall; c <= this.maxBall; c++) a = g[c],
                    void 0 === a && (a = f),
                    d = this.ballTotalLine.children(".b" + c).text(a),
                    a == f && d.addClass("max")
                }
            }
        },
        showTotal: function(a) {
            var b = this.totalKeys,
            e = this.totalItems;
            if (0 != b.length) {
                for (var c = {},
                d = 0; d < a.length; d++) for (var k = a[d], f = 0; f < b.length; f++) {
                    var h = b[f],
                    m = k.detail[this.getKey(h)];
                    "*" != m[0] && (h = h + "_" + m, c[h] = (c[h] || 0) + 1)
                }
                for (var l in e) e[l].text(c[l] || 0)
            }
        },
        showTabs: function(a) {
            var g = this.tabPanel;
            g.empty();
            for (var e = [], c = null, d = 0, k = this.getKey(this.tabKeys[0]), f = 0; f < a.length; f++) {
                var h = a[f].detail[k];
                if (!h) return;
                "*" == h[0] && (h = "T");
                if (h == c) d++;
                else {
                    if (c && d && (e.push([c, d]), e.length >= this.maxCols)) {
                        c = null;
                        break
                    }
                    c = h;
                    d = 1
                }
            }
            c && e.push([c, d]);
            e.reverse();
            h = this.maxCols - e.length;
            for (f = 0; f < h; f++) g.append($("<td>").html("&nbsp;"));
            a = b[this.tabKeys[1]];
            for (f = 0; f < e.length; f++) {
                h = e[f];
                d = c = a ? a[h[0]] : h[0];
                k = 0;
                for (h = h[1] - 1; k < h; k++) d += "<br/>" + c;
                g.append($("<td>").html(d))
            }
            g.children(":even").addClass("even")
        },
        load: function() {
            if (this.inited) {
                var a = this;
                LIBS.ajax({
                    url: "dayResult.w",
                    data: {
                        lottery: lottery
                    },
                    cache: !1,
                    success: function(b) {
                        a.showResults(b)
                    }
                })
            }
        },
        showResults: function(a) {
            if (this.inited) {
                if (a) for (var b = 0; b < a.length; b++) {
                    var e = a[b],
                    c = e.detail;
                    if (c && !$.isPlainObject(c)) {
                        for (var d = c.split(";"), c = {},
                        k = 0; k < d.length; k++) {
                            var f = d[k];
                            f && (f = f.split("="), c[f[0]] = f[1].split(",")[0])
                        }
                        e.detail = c
                    }
                } else a = this.results;
                a && (this.showBalls(a), this.showTotal(a), "undefined" == typeof window.IS_MOBILE && this.showTabs(a), this.results = a)
            }
        }
    }
} ();