var $jscomp = {
    scope: {},
    findInternal: function(a, d, b) {
        a instanceof String && (a = String(a));
        for (var c = a.length,
        e = 0; e < c; e++) {
            var f = a[e];
            if (d.call(b, f, e, a)) return {
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
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty: function(a, d, b) {
    if (b.get || b.set) throw new TypeError("ES3 does not support getters and setters.");
    a != Array.prototype && a != Object.prototype && (a[d] = b.value)
};
$jscomp.getGlobal = function(a) {
    return "undefined" != typeof window && window === a ? a: "undefined" != typeof global && null != global ? global: a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(a, d, b, c) {
    if (d) {
        b = $jscomp.global;
        a = a.split(".");
        for (c = 0; c < a.length - 1; c++) {
            var e = a[c];
            e in b || (b[e] = {});
            b = b[e]
        }
        a = a[a.length - 1];
        c = b[a];
        d = d(c);
        d != c && null != d && $jscomp.defineProperty(b, a, {
            configurable: !0,
            writable: !0,
            value: d
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
var SP_NAMES, MULTIPLE, TEXT_PREFIX, TEXT_POSTFIX, lottery, bettingStatus, Results, ResultPanel, gameName, games, PAGE, oldOdds = null;
$(function() {
    "HK6" == template && $("#changlong").width("170px");
    SP_NAMES && $("#bet_panel th.tsname,.bet_content .tsname").each(function() {
        var a = $(this),
        b = a.text();
        a.empty();
        for (var a = $("<div>").appendTo(a), g = 0, d = b.length; g < d; g++) {
            var c = b.charAt(g);
            a.append($("<span>").addClass("b" + c).text(c))
        }
    });
    if (MULTIPLE) {
        $("#header .control").hide();
        $("#btnReset").attr("disabled", !0).addClass("button_disabled");
        $("#btnBet").attr("disabled", !0).addClass("button_disabled");
        var a, d, b = MULTIPLE[0];
        0 == b ? $("input[name=game]").click(function() {
            a = $(this).val().split(",");
            resetBets()
        }).attr("checked", !1) : 1 == b ? (a = MULTIPLE[3], d = function(b, d) {
            $(".bet_panel .odds:visible").hide();
            b >= a[0] && b <= a[1] ? $("#o_" + MULTIPLE[1] + "_" + b).show() : $("#empOdds").show()
        }) : 2 == b ? a = MULTIPLE[3] : 3 == b && (d = function(a, b, d) {
            var c = !0;
            $(".status_panel table").each(function() {
                if (0 == $(this).find("input:checked").length) return c = !1
            });
            $(".bcontrol input:text").prop("disabled", !c);
            MULTIPLE[3] && $(".status_panel input[value=" + d.val() + "]").not(d).prop("disabled", b)
        });
        $(".status_panel .check").click(function(b) {
            if (!bettingStatus) return ! 1;
            var c = $(this).find("input");
            if (c.prop("disabled")) return ! 1;
            var g = c.prop("checked"),
            e = $(".status_panel input:checked").length;
            b.target == this && (g = !g) && (e += 1);
            g || --e;
            c.prop("checked", g);
            d && d(e, g, c);
            $(this).toggleClass("selected", g);
            a && ($(".bcontrol input:text").prop("disabled", e < a[0] || e > a[1]), e >= a[1] ? $(".status_panel input:not(:checked)").prop("disabled", !0) : $(".status_panel input:disabled").prop("disabled", !1))
        })
    } else {
        $("#bet_panel tr:not(.head)").each(function() {
            $(this).find("input.ba").each(function() {
                var a = $(this).attr("name"),
                b = $("#bet_panel .G" + a);
                b.hover(function() {
                    b.addClass("hover")
                },
                function() {
                    b.removeClass("hover")
                });
                $(this).hasClass("empty") || b.click(function(a) {
                    if (bettingStatus) if (a = $(a.target), a.filter("input").length) a.val($("label.quickAmount input").val());
                    else {
                        b.toggleClass("selected");
                        a = $("#bet_panel th.selected").length;
                        var c = $("#betcount").text(a);
                        0 == a ? c.parent().hide() : c.parent().show();
                        $(this).hasClass("selected") ? b.find("input").val($("label.quickAmount input").val()) : b.find("input").val("")
                    }
                })
            })
        });
        $("#bet_panel .panel_yxx a").click(function() {
            var a = $(this).attr("id").substr(2);
            var b = PeriodPanel.period;
            b && 1 == b.status && (a = getBet(a)) && parent.showBets({
                lottery: lottery,
                drawNumber: b.drawNumber,
                bets: [a]
            })
        });
        var c = $("label.quickAmount input");
        c.keyup(function() {
            c.not(this).val($(this).val());
            parent && (parent.QuickAmount = $(this).val());
            $("#bet_panel tr:not(.head)").each(function() {
                $(this).children("th").each(function() {
                    var a = $(this).attr("id").substr(2),
                    a = $("#bet_panel .G" + a);
                    $(this).hasClass("selected") && a.find("input").val(c.val())
                })
            })
        });
        var e = $("label.checkdefault input");
        e.click(function() {
            var a = $(this).prop("checked");
            e.not(this).prop("checked", a);
            parent && (parent.QuickAmountEnalbed = a, parent.QuickAmount = c.val())
        });
        parent && parent.QuickAmountEnalbed && (e.prop("checked", !0), c.val(parent.QuickAmount))
    }
    var f = {
        titleConverter: function(a) {
            return a = 0 == a.indexOf("\u51a0\u4e9a") && -1 == a.indexOf("-") ? a.replace("\u51a0\u4e9a", "\u51a0\u4e9a - ") : a.replace("-", " - ")
        },
        interval: 10,
        changlong: $("#changlong tbody"),
        onChangLongClick: function(a) {
            var b = PeriodPanel.period;
            null != b && 1 == b.status && $(".G" + a).addClass("selected").find("input").focus()
        },
        onPeriodChange: function(a, b) {
            var c = null != a && 1 == a.status;
            toggleBet(c);
            c && !b && location.hash && "undefined" == typeof window.IS_MOBILE && $(".G" + location.hash.substr(1)).addClass("selected").find("input").focus()
        },
        onResultChange: function() {
            Results && Results.load();
            ResultPanel && ResultPanel.load()
        },
        onAccountUpdated: function(a) {
            parent && parent.showAccount && parent.showAccount(a)
        },
			 
		    loadOptions: {
            url: "http://www.dsn05.co/member/odds",
            data: {
                lottery: lottery,
                games: games
            },
            success: function(a) {
                showOdds(a)
            }
        }
    };
	///console.log(games);	
    $.each(["cdOpen", "cdClose", "cdDraw"],
    function(a, b) {
        f[b] = $("#" + b)
    });
    PeriodPanel.init(f, gameName);
    if (window.parent && window.parent != window) {
        var h = PAGE || LIBS.getUrlParam("page"),
        l = LIBS.getUrlParam("index");
        window.parent.$(".sub div:visible a").removeClass("selected").each(function() {
            var a = $(this),
            b = a.attr("href"),
            c = LIBS.getUrlParam("page", b),
            b = LIBS.getUrlParam("index", b);
            if (! (c != h || l && b && b != l)) return gameName || $("#gameName").text(a.text()),
            a.addClass("selected"),
            !1
        })
    }
    $("#quickControl").click(function() {
        $("#quickPanel").toggle($(this).prop("checked"))
    });
    $("input:text").keypress(function(a) {
        if (13 == a.keyCode) return bet(),
        !1
    }).onlyNumber();
    toggleBet(!1)
});
function showOdds(a) {
    var d = PeriodPanel.period;
    if (a && null != d && 1 == d.status) {
        toggleBet(!0);
        for (var b in a) if (d = a[b]) {
            var c = $("#o_" + b).text(d);
            oldOdds && d != oldOdds[b] && c.delayClass("uptodate", 3E3)
        } else $("#o_" + b).text("--");
        oldOdds = a
    } else oldOdds = null,
    toggleBet(!1)
}
function showBetting(a) {
    a ? ($("#bettingStatus").show(), $("#betControl").hide()) : ($("#bettingStatus").hide(), $("#betControl").show())
}
function sortBets(a) {
    a.sort(function(a, b) {
        if (a.title != b.title) return 0;
        var c = Number(a.contents) == a.contents,
        d = Number(b.contents) == b.contents;
        return c && !d ? -1 : d && !c ? 1 : c && d ? a.contents - b.contents: 0
    });
    return a
}
function toggleBet(a) {
    if (null == bettingStatus || bettingStatus !== a)(bettingStatus = a) ? ($("#bet_panel").removeClass("bet_closed"), MULTIPLE ? $(".status_panel input").prop("disabled", !1) : $("#bet_panel .amount input").prop("disabled", !1)) : ($("#bet_panel").addClass("bet_closed"), $("#bet_panel .odds:not(.empty)").text("--"), MULTIPLE ? $(".status_panel input").prop("disabled", !0) : $("#bet_panel .amount input").prop("disabled", !0), resetBets())
}
function resetBets() {
    "undefined" !== typeof window.IS_MOBILE && resetMobileAll();
    MULTIPLE ? ($(".status_panel .check").removeClass("selected"), $(".status_panel input:checked").prop("checked", !1), $(".bcontrol input:text").prop("disabled", !0), bettingStatus && $(".status_panel input:disabled").prop("disabled", !1), 1 == MULTIPLE[0] ? ($(".bet_panel .odds:visible").hide(), $("#empOdds").show()) : 3 == MULTIPLE[0] && $("#fs_odds").text("--")) : ($("#betcount").parent().hide(), $("#bet_panel .selected").removeClass("selected"), $("#bet_panel input.ba").val(""));
    $("label.checkdefault input").is(":checked") || $("label.quickAmount input").val("")
}
function getBet(a, d) {
    d || (d = $("#t_" + a));
    var b = $("#o_" + a),
    c = Number(b.text());
    if (! (isNaN(c) || 0 >= c)) {
        var e = d.attr("title"),
        e = e.split(" ", 2),
        f = e[1],
        e = 1 < e.length ? e[0] : "",
        h = a.split("_"),
        c = {
            title: e,
            text: f,
            game: h[0],
            contents: h[1],
            odds: c
        },
        b = Number(b.attr("lang"));
        if (0 < b) {
            e = [];
            for (f = 1; f < b; f++) e[f - 1] = $("#o_" + a + "_" + f).text();
            c.oddsDetail = e
        }
        return c
    }
}
function getMultipleBets() {
    function a(a, b, c, f, g) {
        m.push({
            multiple: c,
            title: e,
            text: a,
            game: n[0],
            contents: b,
            odds: g || l,
            state: n[1] || 0,
            mcount: f,
            amount: d
        })
    }
    var d = Math.floor(Number($(".bcontrol .quickAmount input").val()));
    if (0 >= d || isNaN(d)) return ! 1;
    var b = MULTIPLE[0],
    c = MULTIPLE[1],
    e = MULTIPLE[2],
    f = MULTIPLE[3],
    h;
    if (0 == b) {
        f = $("input[name=game]:checked");
        if (0 == f.length) return ! 1;
        e = f.attr("title");
        c = f.attr("id").substr(2);
        f = f.val().split(",")
    } else 1 == b && (h = $(".status_panel input:checked"), c += "_" + h.length);
    var l = Number($("#o_" + c).text()),
    m = [],
    n = c.split("_");
    if (3 == b) {
        var g = [];
        $(".status_panel table").each(function() {
            var a = [];
            $(this).find("input:checked").each(function() {
                a.push($(this).val())
            });
            a.sort();
            g.push(a)
        });
        g = LIBS.comboList(g);
        for (b = 0; b < g.length; b++) h = g[b],
        a(h, h.join(","), 1)
    } else if (2 == b) {
        h = $(".status_panel input:checked");
        var g = [],
        k = {},
        p = {};
        h.each(function() {
            var a = $(this).val();
            g.push(a);
            k[a] = $(this).attr("title");
            p[a] = Number($("#o_" + c + "_" + a).text())
        });
        g = g.sort();
        g = LIBS.comboArray(g, f[0]);
        for (b = 0; b < g.length; b++) h = g[b],
        a(LIBS.replaceArray(h, k), h.join(","), 1, f[0], LIBS.replaceArray(h, p).sort(function(a, b) {
            return MULTIPLE[4] ? a - b: b - a
        }).shift())
    } else h || (h = $(".status_panel input:checked")),
    g = [],
    k = {},
    h.each(function() {
        var a = $(this).val();
        g.push(a);
        k[a] = $(this).attr("title")
    }),
    g = g.sort(),
    f = f[0],
    1 == b && (f = h.length),
    a(LIBS.replaceArray(g, k), g.join(","), LIBS.combination(h.length, f), f);
    return m
}
function getBets() {
    var a = [];
    $("#bet_panel input.ba").each(function() {
        var d = Number($(this).val());
        if (! (0 >= d || isNaN(d))) {
            var b = $(this).attr("name");
            if (b = getBet(b)) b.amount = d,
            a.push(b)
        }
    });
    return a
}
function bet() {
    var a = PeriodPanel.period;
    if (a && 1 == a.status) {
        var d;
        d = MULTIPLE ? getMultipleBets() : getBets();
        if (!1 !== d) if (0 == d.length) parent.showMsg("\u60a8\u9009\u62e9\u7684\u9879\u76ee\u5df2\u5c01\u76d8\u6216\u8f93\u5165\u7684\u91d1\u989d\u4e0d\u6b63\u786e\uff0c\u8bf7\u91cd\u65b0\u9009\u62e9\u3002");
        else {
            resetBets();
            for (var b = 0; b < d.length; b++) {
                var c = d[b],
                e = parent.getUserParam(lottery, $("#k_" + c.game + "_" + c.contents).val());
                if (e) {
                    var f = !1,
                    c = c.amount;
                    c < e.minAmount ? f = "\u4f60\u8f93\u5165\u7684\u91d1\u989d\u4f4e\u4e8e\u5355\u6ce8\u6700\u4f4e(" + e.minAmount + ")\u7684\u9650\u5236\uff01": c > e.maxAmount && (f = "\u4f60\u8f93\u5165\u7684\u91d1\u989d\u8d85\u51fa\u5355\u6ce8\u6700\u9ad8(" + e.maxAmount + ")\u7684\u9650\u5236\uff01");
                    if (f) {
                        parent.showMsg(f);
                        return
                    }
                }
            }
            parent.showBets({
                lottery: lottery,
                drawNumber: a.drawNumber,
                bets: d
            })
        }
    } else parent.showMsg("\u540e\u53f0\u672a\u5f00\u76d8\uff0c\u8bf7\u7b49\u5f85\u5f00\u76d8\u518d\u8bd5\u3002")
	///console.log(d);///console.log(a);
};