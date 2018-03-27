$(function() {
    var b = null,
    c = function() {
        LIBS.ajax({
            url: "notice",
            cache: !1,
            success: function(a) {
                $("#notices").html(a);
                a && 0 <= a.indexOf('<span class="notice_new">') && (null != b && b != a && $("#footer .more").click(), b = a)
            }
        })
    };
    c();
    setInterval(c, 3E4)
});