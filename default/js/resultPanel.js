var lottery, ResultPanel;
ResultPanel || (ResultPanel = function() {
    function h(b) {
        for (var a = 0,
        c = 0; c < b.length; c++) a += Number(b[c]);
        return a
    }
    var k = {
        period: function(b, a, c) {
            c || (c = "{0}\u671f");
            b = b.drawNumber;
            a && (b = b.substr(a));
            return $("<td>").addClass("period").text(c.format(b))
        },
        ball: function(b, a) {
            var c = b.result.split(",")[a];
            return $("<td>").addClass("name").append($("<span>").addClass("b" + c).text(c))
        },
        total: function(b) {
            return $("<td>").addClass("other").text(h(b.result.split(",")))
        },
        zdx: function(b, a, c, e) {
            b = b.result.split(",");
            if (e) for (var f = b[0], d = 1; d < b.length; d++) if (b[d] != f) {
                e = !1;
                break
            }
            var g;
            e ? (a = "\u901a\u5403", g = "tie") : (e = h(b), e == c ? (a = "\u548c", g = "tie") : e < a ? a = "\u5c0f": (a = "\u5927", g = "D"));
            a = $("<td>").addClass("other").text(a);
            g && a.addClass(g);
            return a
        }
    };
    return {
        inited: !1,
        init: function(b, a) {
            this.panel = b;
            for (var c = [], e = 0; e < a.length; e++) {
                var f = a[e];
                if (f && $.isArray(f) && 0 != f.length) {
                    var d = f[0];
                    if (!$.isFunction(d) && (d = k[d], !d)) continue;
                    f[0] = null;
                    c.push({
                        f: d,
                        a: f
                    })
                }
            }
            this.parsers = c;
            this.inited = this
        },
        showResults: function(b) {
            this.panel.empty();
            for (var a = 0; a < b.length; a++) for (var c = b[a], e = $("<tr>").appendTo(this.panel), f = 0; f < this.parsers.length; f++) {
                var d = this.parsers[f];
                d.a[0] = c;
                e.append(d.f.apply(this, d.a))
            }
        },
        load: function() {
            if (this.inited) {
                var b = this;
                LIBS.get("lastResults", {
                    lottery: lottery
                },
                function(a) {
                    a && $.isArray(a) && b.showResults(a)
                })
            }
        }
    }
} ());