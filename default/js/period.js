var $jscomp = {
    scope: {},
    findInternal: function(a, b, c) {
        a instanceof String && (a = String(a));
        for (var d = a.length,
        e = 0; e < d; e++) {
            var f = a[e];
            if (b.call(c, f, e, a)) return {
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
var PeriodPanel, lottery, pageMap, tableId;
if (!PeriodPanel) {
    var clearChanglongTitle = function(a) {
        if (0 == a.indexOf("\u51a0\u4e9a") && -1 == a.indexOf("-")) a = a.replace("\u51a0\u4e9a", "\u51a0\u4e9a\u519b\u548c - ");
        else {
            a = a.replace("-", " - ");
            for (var b = 0; b < NUM_CONV.length; b++) a = a.replace(NUM_CONV[b], b + 1)
        }
        return a
    },
    bindComplete = function(a, b) {
        var c = b.complete;
        b.complete = function() {
            0 >= a.refreshRemain && (a.refreshRemain = a.interval, a.showRefreshRemain());
            c && c.apply(this, arguments)
        };
        return b
    },
    checkEmpty = function(a, b) {
        for (var c = 0; c < b.length; c++) {
            var d = b[c];
            a[d] && 0 === a[d].length && (a[d] = null)
        }
    },
    fillCDPanel = function(a, b) {
        var c = b + "Panel";
        null == a[b] && null != a[c] ? a[b] = a[c].children("span") : null == a[c] && null != a[b] && (a[c] = a[b].parent())
    },
    showTime = function(a, b) {
        a && 0 < a.length && a.text(LIBS.timeToString(b))
    };
    $.ajaxSetup({
        cache: !1
    });
    var NUM_CONV = "\u4e00\u4e8c\u4e09\u56db\u4e94\u516d\u4e03\u516b\u4e5d\u5341".split("");
    PeriodPanel = function() {
        return {
            timeOffset: 0,
            timer: null,
            interval: 90,
            refreshRemain: -1,
            titleConverter: clearChanglongTitle,
            loadOptions: null,
            loadingState: null,
            changlong: null,
            drawPanel: null,
            lastResult: null,
            resultTimer: null,
            resultInterval: 6E3,
            accountTimer: null,
            accountInterval: 3E4,
            countdownText: "{0}\u79d2",
            countdownPanel: null,
            drawNumberText: null,
            drawNumberPanel: null,
            showLoading: null,
            cdOpenPanel: null,
            cdClosePanel: null,
            cdDrawPanel: null,
            cdOpen: null,
            cdClose: null,
            cdDraw: null,
            periodShowType: 0,
            refreshFlag: -1E3,
            onResultChange: null,
            onPeriodChange: null,
            onLoadData: null,
            onAccountUpdated: null,
            onChangLongClick: null,
            now: function(a) {
                return a ? (new Date).getTime() : (new Date).getTime() - this.timeOffset
            },
            settingTime: function(a) {
                a = Number(a);
                isNaN(a) || (this.timeOffset = this.now(!0) - a)
            },
            init: function(a, b) {
                tableId = LIBS.getUrlParam("tableId");
                LIBS.clone(this, a);
                fillCDPanel(this, "cdOpen");
                fillCDPanel(this, "cdClose");
                fillCDPanel(this, "cdDraw");
                this.drawPanel || (this.drawPanel = $("#drawInfo"));
                this.countdownPanel || (this.countdownPanel = $("#cdRefresh"));
                this.drawNumberPanel || (this.drawNumberPanel = $("#drawNumber"));
                b && $("#gameName").text(b);
                checkEmpty(this, "cdOpen cdOpenPanel cdClose cdClosePanel cdDraw cdRefresh cdDrawPanel drawPanel countdownPanel drawNumberPanel changlong".split(" "));
                var c = this;
                LIBS.get("../time.php",
                function(a) {
                    c.settingTime(a)
                });
                this.timer = setInterval(function() {
                    c.period && c.showPeriod();
                    c.doInterval()
                },
                1E3);
                var d = $("#refreshInteval");
                0 < d.length && (d.change(function() {
                    c.changeInterval($(this).val())
                }), this.changeInterval(d.val()));
                this.loadOptions && !$.isFunction(this.loadOptions) && bindComplete(this, this.loadOptions);
                this.reload()
            },
            reload: function(a) {
                if (!this.loadingState) {
                    a && ($.isFunction(this.showLoading) ? this.showLoading() : this.showRefreshRemain(0));
                    var b = this;
                    this.loadingState = $.ajax({
                        url: "period.php",
                        data: {
                            lottery: lottery,
                            tableId: tableId
                        },
                        success: function(a) {
                            b.loadingState = null;
                            try {
                                b.changePeriod(a)
                            } catch(d) {
                                alert("loading period:" + d.message)
                            }
                        },
                        complete: function() {
                            0 >= b.refreshRemain && (b.refreshRemain = b.interval, b.showRefreshRemain())
                        }
                    })
                }
            },
            changePeriod: function(a) {
                a && 65E3 < a.openTime - this.now() && (a = null);
                if (a) {
                    var b = this.now(),
                    c = a.status;
                    a.rstatus = c;
                    a.openTime <= b && 1 > c && (a.status = 1);
                    a.closeTime <= b && 2 > c && (a.status = 2)
                }
                b = this.period;
                this.period = a;
                if (void 0 === b || !!b != !!a || a && (a.drawNumber != b.drawNumber || a.status != b.status)) {
                    if ($.isFunction(this.onPeriodChange) && !1 === this.onPeriodChange(a, b)) return;
                    this.loadResult()
                }
                a && this.reloadData();
                this.showPeriod()
            },
            reloadData: function() {
                if (!this.loadingState) {
                    if (this.loadOptions) {
                        var a = this.loadOptions;
                        $.isFunction(a) && (a = a());
                        a && LIBS.ajax(a)
                    }
                    if ($.isFunction(this.onLoadData)) this.onLoadData(this)
                }
            },
            reloadDataDelay: function(a) {
                a || (a = 3E3);
                var b = this;
                setTimeout(function() {
                    b.reloadData()
                },
                a)
            },
            changeInterval: function(a) {
                this.refreshRemain = this.interval = a;
                0 < a && this.showRefreshRemain()
            },
            showRefreshRemain: function(a) {
                void 0 === a && (a = this.refreshRemain);
                0 <= a && ($.isFunction(this.countdownText) ? this.countdownText(a) : this.countdownPanel && (0 == a ? this.countdownPanel.html("<span>\u8f7d\u5165\u4e2d\u2026</span>") : (this.countdownText && (a = this.countdownText.format(a)), this.countdownPanel.text(a))))
            },
            doInterval: function() {
                0 >= this.refreshRemain || (--this.refreshRemain, this.showRefreshRemain(), 0 >= this.refreshRemain && this.reload(!0))
            },
            showPeriod: function() {
                var a = this.period;
                if (a) {
                    if (this.drawNumberPanel) {
                        var b = a.drawNumber;
                        this.drawNumberText && (b = this.drawNumberText.format(b));
                        this.drawNumberPanel.text(b)
                    }
                    var c = this.now(),
                    b = a.openTime - c,
                    d = a.closeTime - c,
                    c = a.drawTime - c;
                    showTime(this.cdOpen, b);
                    showTime(this.cdClose, d);
                    showTime(this.cdDraw, c);
                    0 == this.periodShowType && this.cdOpenPanel ? 0 < b ? (this.cdOpenPanel.show(), this.cdClosePanel.hide()) : (this.cdOpenPanel.hide(), this.cdClosePanel.show()) : 1 == this.periodShowType && (0 < b ? (this.cdOpenPanel.show(), this.cdClosePanel.hide(), this.cdDrawPanel.hide()) : 0 < d ? (this.cdOpenPanel.hide(), this.cdClosePanel.show(), this.cdDrawPanel.hide()) : (this.cdOpenPanel.hide(), this.cdClosePanel.hide(), this.cdDrawPanel.show()));
                    a = a.status; (b <= this.refreshFlag && 1 > a || d <= this.refreshFlag && 2 > a || c <= this.refreshFlag) && this.reload()
                } else this.drawNumberPanel && this.drawNumberPanel.text(""),
                showTime(this.cdOpen, 0),
                showTime(this.cdClose, 0),
                showTime(this.cdDraw, 0)
            },
            loadResult: function() {
                var a = this;
                LIBS.ajax({
                    url: "lastResult.php",
                    data: {
                        lottery: lottery,
                        table: tableId
                    },
                    success: function(b) {
                        if (b) {
                            a.showResult(b);
                            var c = a.period;
                            b = b.drawNumber;
                            c && b != c.drawNumber && b != c.pnumber && (clearTimeout(a.resultTimer), a.resultTimer = setTimeout(function() {
                                a.loadResult()
                            },
                            a.resultInterval))
                        }
                    }
                })
            },
            showResult: function(a) {
                var b = this.lastResult;
                if (null == b || b.drawNumber != a.drawNumber || b.result != a.result) if (this.loadAccounts(), $.isFunction(this.onResultChange)) this.onResultChange(a);
                this.lastResult = a;
                if (this.drawPanel) {
                    this.drawPanel.find(".draw_number").html(a.drawNumber + "<span>\u671f\u5f00\u5956</span>");
                    var c = this.drawPanel.find(".balls");
                    c.empty();
                    var d = a.result.split(","),
                    e;
                    "HK6" == template ? e = get_animal_by_ball: "3D" == template && (e = function(a, b) {
                        return ["\u4f70", "\u62fe", "\u4e2a"][b]
                    });
                    for (b = 0; b < d.length; b++) {
                        var f = d[b],
                        g = $("<li>").appendTo(c);
                        g.append($("<b>").addClass("b" + f).text(f));
                        e && g.append($("<i>").text(e(f, b)));
                        "HK6" == template && 5 == b && $("<li>").addClass("plus").text("+").appendTo(c)
                    }
                } else parent && parent.showResult && parent.showResult(a);
                if (e = this.changlong) if (e.empty(), a.detail && e.length) {
                    c = function(a) {
                        if (pageMap) {
                            var b = pageMap[template];
                            if (b) {
                                for (var c in b) if ("" != c && 0 === a.indexOf(c)) return b[c];
                                return b[""]
                            }
                        }
                    };
                    f = a.detail.split(";");
                    a = [];
                    for (b = 0; b < f.length; b++) if (d = f[b]) d = d.split(","),
                    /\d$/.test(d[0]) || a.push([d[1], this.titleConverter ? this.titleConverter(d[2]) : d[2], d[0].replace("=", "_")]);
                    a.sort(function(a, b) {
                        var c = b[0] - a[0];
                        return 0 != c ? c: a[1].localeCompare(b[1])
                    });
                    for (var h = this,
                    b = 0; b < a.length; b++) d = a[b],
                    f = c(d[1]),
                    g = $("<th>"),
                    f ? $("<a>").text(d[1]).attr("href", "load?lottery=" + lottery + "&page=" + f + "#" + d[2]).click(function() {
                        if (h.onChangLongClick) {
                            var a = $(this).attr("href"),
                            b = a.lastIndexOf("#");
                            return h.onChangLongClick(a.substr(b + 1), a.substr(0, b))
                        }
                    }).appendTo(g) : g.text(d[1]),
                    $("<tr>").append(g).append($("<td>").text(d[0] + " \u671f")).appendTo(e)
                }
            },
            loadAccounts: function() {
                var a = this;
                clearTimeout(this.accountTimer);
                LIBS.ajax({
                    url: "account",
                    success: function(b) {
                        b && a.showAccount(b)
                    }
                });
                this.accountTimer = setTimeout(function() {
                    a.loadAccounts()
                },
                this.accountInterval)
            },
            showAccount: function(a) {
                $("#bresult").text(LIBS.round(a.result || 0, 1));
                if ($.isFunction(this.onAccountUpdated)) this.onAccountUpdated(a)
            }
        }
    } ();
    "undefined" != typeof window.IS_MOBILE && (PeriodPanel.showPeriod = function() {
        var a = this.period;
        this.cdOpenPanel = $(".openPanel");
        this.cdClosePanel = $(".closePanel");
        if (a) {
            if (this.drawNumberPanel) {
                var b = a.drawNumber;
                this.drawNumberText && (b = this.drawNumberText.format(b));
                this.drawNumberPanel.text(b)
            }
            var c = this.now(),
            b = a.openTime - c,
            d = a.closeTime - c,
            c = a.drawTime - c;
            showTime(this.cdOpen, b);
            showTime(this.cdClose, d);
            showTime(this.cdDraw, c);
            "00:00" == LIBS.timeToString(d) ? (this.cdOpenPanel.hide(), this.cdClosePanel.show()) : (this.cdOpenPanel.show(), this.cdClosePanel.hide());
            a = a.status; (b <= this.refreshFlag && 1 > a || d <= this.refreshFlag && 2 > a || c <= this.refreshFlag) && this.reload()
        } else this.drawNumberPanel && this.drawNumberPanel.text(""),
        showTime(this.cdOpen, 0),
        showTime(this.cdClose, 0),
        showTime(this.cdDraw, 0)
    },
    PeriodPanel.showRefreshRemain = function(a) {
        void 0 === a && (a = this.refreshRemain);
        0 <= a && ($.isFunction(this.countdownText) ? this.countdownText(a) : this.countdownPanel && (0 == a ? this.countdownPanel.html("<span>\u8f7d\u5165</span>") : (this.countdownText && (a = this.countdownText.format(a)), this.countdownPanel.text(a))))
    })
};