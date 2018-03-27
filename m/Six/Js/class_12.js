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
            $("#odds").html("-");
            $("input[type='checkbox']").attr("checked", false);
            return false;
		}
		var odds = oddslist.ball[12][i];
        $("#odds").html(odds);
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
        $("#odds").html("-");
        $("input[type='checkbox']").attr("checked", false);
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

function sx_click() {
	if ($("input[name='ball[]']:checked").length > 11) {
        lay_msg('您最多可以选择 11 个生肖！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length >= 2){
		var s1 = $("input[name='ball[]']:checked").length;
		oddsInfo(s1 - 1);
	} else {
		$("#odds").html("-");
	}
	return true;
}

$('input[type=checkbox]').click(function(e) {
	if(!sx_click()) {
		$(this).attr("checked", false);
	}
	e.stopPropagation();
});

//投注提交
function order() {
	var balls = '', arr = new Array(), c = true;
    var cou =  0, txt = '', m = 0;
    var tz_money = $("#kj_money");

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        lay_msg('请输入下注金额！', null);
        return false;
    }
	if ($("input[name='ball[]']:checked").length < 2){
        lay_msg('请至少选择 2 个生肖！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length > 11) {
        lay_msg('您最多可以选择 11 个生肖！', null);
        return false;
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	for (var i = 0 ; i < checked.length ; i++) {
		txt = txt + name(checked[i]) + ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));

    var t = '<p>合肖，下注明细如下：</p>' + txt;
    txt = t + '<p style="margin: 10px 0 0; background-color: #000; color: #fff">注金：' + m + '元</p>';
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

function name(type) {
	var r = '';
	switch (type) {
		case '1' : r = '鼠'; break;
		case '2' : r = '牛'; break;
		case '3' : r = '虎'; break;
		case '4' : r = '兔'; break;
		case '5' : r = '龙'; break;
		case '6' : r = '蛇'; break;
		case '7' : r = '马'; break;
		case '8' : r = '羊'; break;
		case '9' : r = '猴'; break;
		case '10' : r = '鸡'; break;
		case '11' : r = '狗'; break;
		case '12' : r = '猪'; break;
	}
	return r;
}