function noticePopup(b, a) {
    getSkinColor();
    $(function() {
        var c = $("<div>").appendTo($(".Notice"));
        c.attr("id", "notice" + b);
        $("<div>").addClass("back_body").appendTo(c);
        c.append('<div class="notice_div ' + skinColor + '_back"><a href="#"><div id="notClose' + b + '" class="close_icon"></div></a><div class="notice_icon"><div class="nicon_icon1"></div></div><div class="notice_font">' + a + '</div><div id="notice_button' + b + '" class="notice_button"><a href="#" class="yellow animate">\u77e5\u9053</a></div></div>');
        $("#notice_button" + b + " , #notClose" + b).click(function() {
            $("#notice" + b).hide();
            $(".details").hide()
        });
        $(".close_icon , .notice_button").click(function() {
            $(".noticeChild").hide();
            $(".details").hide()
        });
        $(".nicon_button").click(function() {
            $(".noticeChild").hide();
            $(".details").show()
        })
    })
}




function noticePopupWithMore(b, a, c, f) {
    $(function() {
        getSkinColor();
        var d = $("<div>").appendTo($(".Notice")),
        e = 1;
        d.attr("id", "notice" + a);
        $("<div>").addClass("back_body").appendTo(d);
        $("<div>").addClass("back_body").appendTo(d);
        d.append('<div class="notice_div"><a href="javascript:void(0)"><div id="notClose' + a + '" class="close_icon"></div></a><div class="notice_page"><a href="#" id="btnPrev' + a + '" class="notice_prev" ><<</a>' + a + "/" + b + '<a href="#" class="notice_next" id="btnNext' + a + '">>></a></div><div class="notice_icon"><div class="nicon_icon1"></div><div class="nicon_button"><a href="#" class="white animate">\u66f4\u591a</a></div></div><div class="notice_font">' + c + '</div><div id="notice_button' + a + '" class="notice_button"><a href="javascript:void(0)" class="yellow animate">\u77e5\u9053</a></div></div>');
        1 < a && $("#notice" + a).hide();
        e = a == b ? 3 : 1 == a ? 1 : 2;
        $("#dtlColor").attr("class", "details_div");
        $("#dtlFont").append('<div class="df' + e + '"><div class="df_data">' + f + "</div><div>" + c + "</div></div>");
        $("#notice_button" + a + " , #notClose" + a).click(function() {
            a < b && $("#notice" + (a + 1)).show();
            $("#notice" + a).hide();
            $(".details").hide()
        });
        $("#btnNext" + a).click(function() {
            a < b && $("#notice" + (a + 1)).show();
            $("#notice" + a).hide();
            $(".details").hide()
        });
        $("#btnPrev" + a).click(function() {
            1 < a && ($("#notice" + (a - 1)).show(), $("#notice" + a).hide(), $(".details").hide())
        });
        $(".nicon_button").click(function() {
            $(".Notice").hide();
            $(".details").show()
        })
    })
}
function redPackPopup() {
    $(function() {
        $.getJSON("payment/getbonusinfo",
        function(b) {
            0 < b.data.length && $.ajax({
                url: "payment/drawbonus",
                type: "GET",
                contentType: "application/json",
                data: {
                    transId: b.data[0].id,
                    amount: b.data[0].amount
                },
                success: function(a) {
                    1 == b.success ? ($("#redPack .redpack_amount").text(b.data[0].amount), $("#redPack .redpack_remark").text(b.data[0].remark), loadBonus(), $("#redPack").show(), loadAccount()) : alert(b.message)
                },
                error: function(a) {
                    alert("\u5931\u8d25\uff1a" + a.code + ",\u8bf7\u68c0\u67e5\u72b6\u51b5\u5f8c\u91cd\u8bd5\u3002")
                },
                complete: function() {
                    $("#redPackIcon").hide()
                }
            })
        })
    })
};