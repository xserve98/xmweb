var time = hm = zw = 0;
var num  = 1;
var odds = '', closeTime = '';
var zuheinfo = '';

//限制只能输入1-9纯数字 
function digitOnly($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function endFun() {
    var s = '<div class="gm_fp"><img src="../images/dy/fp.png" width="80%"></div>';
    $(".wrap").html(s);
}

function loadInfo() {
	$.post("class/time_0.php", function(data) {
		if(data.close > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            $("#user_sy").html(data.shuying);
			timer(data.close);
            history(data.kj_list);
		} else {
            endFun();
            return false;
		}
	}, "json");
}

function oddsInfo(i) {
	$.post("odds/6hc.php", function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
            $(".odds").html("-");
            $("input[type='radio'], input[type='checkbox']").attr("checked", false);
            return false;
		}
		for(var s = 1; s<11; s++){
			var odds = oddslist.ball[14][s+i];
			$("#ball_14_o"+s).html(odds);
		}
	}, "json");
}

function timer(intDiff) {
    var hour = 0, minute = 0, second = 0; //时间默认值
    if(intDiff > 0) {
        hour = Math.floor(intDiff / 3600);
        minute = Math.floor(intDiff / 60) - (hour * 60);
        second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
    } else {
        clearTimeout(odds);
        $(".odds").html("-");
        $("input[type='radio'], input[type='checkbox']").attr("checked", false);
        clearTimeout(closeTime);
        endFun();
    }
    if (hour <= 9) hour = '0' + hour;
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#hour_show').html(hour);
    $('#minute_show').html(minute);
    $('#second_show').html(second);
    intDiff--;
    closeTime = setTimeout("timer("+intDiff+")",1000);
}

function history(list) {
    if(list != "" && list != null) {
        var new_qh = '';
        var new_hm = '';
        for(var i in list) {
            if(i == 'qishu') {
                new_qh = list[i];
            } else {
                new_hm += '<em class="n_' + list[i] + '"></em>';
            }
        }
        $("#numbers").html(new_qh);
        $("#open_num").html(new_hm);
    }
}

function type_click() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_14"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	odds = o(parseInt(oid));
	oddsInfo(odds);
}

$("div.p1").children("span").click(function() {
	$(this).children(":radio").attr("checked", true);
	type_click();
});

$('input:radio[name="ball_14"]').click(function(e) {
	type_click();
	e.stopPropagation();
});

$('input[type=checkbox]').click(function(e) {
	e.stopPropagation();
});

//投注提交
function order() {
	var balls = '', arr = new Array();
    var cou =  0, txt = '', m = 0, qw = 0;
    var tz_money = $("#kj_money");
	var a =  0, b =  0, c =  0, d =  0, e =  0;

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        lay_msg('请输入下注金额！', null);
        return false;
    }
	if($('input:radio[name="ball_14"]:checked').val()==null){
        lay_msg('请先选择分类，在选择尾数！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length < hm){
        lay_msg('请至少选择 '+ hm +' 个尾数！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length > num) {
        lay_msg('您最多可以选择 '+ num +' 个尾数！', null);
        return false;
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	if (hm == 2) {
		for (a=0;a<checked.length-1;a++){
			for (b=a+1;b<checked.length;b++){
				qw++;
			}
		}
	}
	if (hm == 3) {
		for (a=0;a<checked.length-2;a++){
			for (b=a+1;b<checked.length-1;b++){
				for (c=b+1;c<checked.length;c++){
					qw++;
				}
			}
		}
	}
	if (hm == 4) {
		for (a=0;a<checked.length-3;a++){
			for (b=a+1;b<checked.length-2;b++){
				for (c=b+1;c<checked.length-1;c++){
					for (d=c+1;d<checked.length;d++){
						qw++;
					}
				}
			}
		}
	}
	if (hm == 5) {
		for (a=0;a<checked.length-4;a++){
			for (b=a+1;b<checked.length-3;b++){
				for (c=b+1;c<checked.length-2;c++){
					for (d=c+1;d<checked.length-1;d++){
						for (e=d+1;e<checked.length;e++){
							qw++;
						}
					}
				}
			}
		}
	}
	for (var i = 0 ; i < checked.length ; i++ ){
		txt = txt + name(checked[i]) + ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	var bid = parseInt($('input:radio[name="ball_14"]:checked').val());
	balls = wan(bid);
    var t = '<p>' + balls + '，下注明细如下：</p>' + txt;
    e = '<p style="margin: 10px 0 0; padding: 0 3px; background-color: #000; color: #fff">单组注金：' + m + '元，共' + qw + '组，总注金：' + m * qw + '元</p>';
    txt = t + e;
    var t_css = 'margin: 0; background-color: #e9e9e9; border-bottom: 1px solid #ddd';
    layer.open({
        title: ['确定下注吗？', t_css],
        content: txt,
        style: 'width: auto',
        btn: ['确定', '取消'],
        shadeClose: false,
        success: function(e) {
            var w_h = $(window).height();
            var l_h = $(e).find(".layui-m-layerchild").height();
            var l_c = $(e).find(".layui-m-layercont");
            if(l_h >= w_h) {
                l_c.css({
                    "max-height": w_h - 250 + "px",
                    "overflow-y": "auto"
                });
            }
        },
        yes: function(i) {
            var opt = {
                dataType: 'json',
                success: function(data) {
                    if(data.code == 0) {
                        var html = orders_info(data);
                        layer.open({
                            title: ['下注成功', t_css],
                            content: html,
                            btn: '知道了',
                            shadeClose: false,
                            success: function(e) {
                                var w_h = $(window).height();
                                var l_h = $(e).find(".layui-m-layerchild").height();
                                var l_c = $(e).find(".layui-m-layercont");
                                if(l_h >= w_h) {
                                    l_c.css({
                                        "max-height": w_h - 250 + "px",
                                        "overflow-y": "auto"
                                    });
                                }
                            },
                            yes: function(idx) {
                                layer.close(idx);
                                formReset();
                            }
                        });
                    } else if(data.code == 1) {
                        lay_msg(data.info, null);
                    } else if(data.code == 2) {
                        var e = function() {
                            location.replace(location.href);
                        };
                        lay_msg(data.info, e);
                    } else {
                        window.top.location = "/";
                    }
                }
            };
            $("#orders").ajaxSubmit(opt);
            layer.close(i);
        },
        no: function(i) {
            layer.close(i);
        }
    });
}

function hnum(type) {
	var r = '';
	switch (type) {
		case 1 : r = 2; break;
		case 2 : r = 3; break;
		case 3 : r = 4; break;
		case 4 : r = 5; break;
	}
	return r;
}

function nums(type) {
	var r = '';
	switch (type) {
		case 1 : r = 6; break;
		case 2 : r = 6; break;
		case 3 : r = 6; break;
		case 4 : r = 6; break;
	}
	return r;
}

function o(type) {
	var r = 0;
	switch (type) {
		case 1 : r = 0; break;
		case 2 : r = 10; break;
		case 3 : r = 20; break;
		case 4 : r = 30; break;
	}
	return r;
}

function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '二尾连中'; break;
		case 2 : r = '三尾连中'; break;
		case 3 : r = '四尾连中'; break;
		case 4 : r = '五尾连中'; break;
	}
	return r;
}

function name(type) {
	var r = '';
	switch (type)
	{
		case '1' : r = '0尾'; break;
		case '2' : r = '1尾'; break;
		case '3' : r = '2尾'; break;
		case '4' : r = '3尾'; break;
		case '5' : r = '4尾'; break;
		case '6' : r = '5尾'; break;
		case '7' : r = '6尾'; break;
		case '8' : r = '7尾'; break;
		case '9' : r = '8尾'; break;
		case '10' : r = '9尾'; break;
	}
	return r;
}