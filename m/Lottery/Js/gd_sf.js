var bool = auto_new = false;
var sound_off = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var g_type = 0;
var p_sound = false;

//限制只能输入1-9纯数字
function digitOnly($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

//盘口信息
function loadinfo(type) {
    g_type = type;
	$.post("class/odds_3.php", function(data) {
        if(data.opentime > 0) {
            $("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            loadodds(data.oddslist);
            endtime(data.opentime);
            auto(type);
        } else {
            var s = '<div class="gm_fp"><img src="../images/dy/fp.png" width="80%"></div>';
            $(".wrap").html(s);
            return false;
        }
	}, "json");
}

//更新赔率
function loadodds(oddslist) {
    var ref = arguments[1] ? arguments[1] : false;
    var odds = '';

	if (oddslist == null || oddslist == "") {
        $(".odds").html("-");
        $(".chk").attr("checked", false);
        $(".inp").html("").hide();
        return false;
	}
	for(var i = 1; i<10; i++) {
		if(i == 9) {
			for(var s = 1; s < 9; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i >= 1 && i <= 8) {
			for(var s = 1; s < 36; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
                if(!ref) {
                    loadinput(i, s);
                }
			}
		}
	}
}

//更新投注框
function loadinput(ball , s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
	if(ball >= 1 && ball <= 9) {
		$("#ball_" + ball + "_t" + s).html(n);
	}
}

function getIS(s) {
    var i = Math.floor(s / 60);
    if(i < 10) i = '0' + i;
    var ss = s % 60;
    if(ss < 10) ss = '0' + ss;
    return i + ":" + ss;
}

//封盘时间
function endtime(iTime) {
    if(iTime <= 60) {
        $(".odds").html("-");
        $(".chk").attr("checked", false);
        $(".inp").html("").hide();
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo(g_type);
    } else {
        iTime--;
        var t = iTime - 60;
        if(t >= 0) {
            $("#fp_time").html(getIS(t));
        } else {
            $("#fp_time").html("开奖中");
        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}

//刷新时间
function rf_time(time) {
    var fp = $("#fp_time");
    if(time < 0) {
        clearTimeout(c_rf);
        if(fp.html() != "开奖中") {
            $.post("class/odds_3.php", function(data) {
                var qihao = $("#open_qihao").html();
                if(qihao == data.number) {
                    loadodds(data.oddslist, true);
                }
                rf_time(90);
            }, "json");
        } else {
            rf_time(90);
        }
    } else {
        time--;
        c_rf = setTimeout("rf_time(" + time + ")", 1000);
    }
}

//更新开奖号码
function auto(ball) {
    var kj_qishu = $("#numbers");
    $.post("class/auto_3.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
        var qihao = kj_qishu.html();
        if(qihao != data.kj_list['qishu']) {
            var new_qh = '';
            var new_hm = '';
            for(var j in data.kj_list) {
                if(j == 'qishu') {
                    new_qh = data.kj_list[j];
                } else {
                    new_hm += '<em class="n_' + data.kj_list[j] + '"></em>';
                }
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
            setTimeout("auto(" + g_type + ")", 10000);
        } else {
            setTimeout("auto(" + g_type + ")", 10000);
        }
    }, "json");
}

//投注提交
function order() {
    if(!islg) {
        lay_msg('您尚未登录或登录已超时，请重新登录！', null);
        return false;
    }

    var cou =  0, txt = '';
    var mix = 5;
    var m = 0;
    var c = true;

	for (var i = 1; i < 10; i++) {
		if(i == 9) {
			for(var s = 1; s < 9; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        lay_msg("最低下注金额：" + mix + "元！", null);
                        return false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).html();
					var q = did(i);
					var w = wan9(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '<br>';
					cou++;
				}
			}
		} else {
			for(var s = 1; s < 36; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        lay_msg("最低下注金额：" + mix + "元！", null);
                        return false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).html();
					var q = did(i);
					var w = wan(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '<br>';
					cou++;
				}
			}
		}
	}
    if (!c) {lay_msg("最低下注金额：" + mix + "元！", null);return false;}
    if (cou <= 0) {lay_msg("请输入下注金额！！！", null);return false;}
    var t = '<p>下注明细如下：</p>' + txt;
    txt = t + '<p style="margin: 10px 0 0; background-color: #000; color: #fff">总计：' + cou + '笔，共' + m + '元</p>';
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

//读取第几球
function did(type) {
	var r = '';
	switch (type) {
		case 1 : r = '第一球'; break;
		case 2 : r = '第二球'; break;
		case 3 : r = '第三球'; break;
		case 4 : r = '第四球'; break;
		case 5 : r = '第五球'; break;
		case 6 : r = '第六球'; break;
		case 7 : r = '第七球'; break;
		case 8 : r = '第八球'; break;
		case 9 : r = '总和、龙虎'; break;
	}
	return r;
}

//读取玩法
function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '01'; break;
		case 2 : r = '02'; break;
		case 3 : r = '03'; break;
		case 4 : r = '04'; break;
		case 5 : r = '05'; break;
		case 6 : r = '06'; break;
		case 7 : r = '07'; break;
		case 8 : r = '08'; break;
		case 9 : r = '09'; break;
		case 10 : r = '10'; break;
		case 11 : r = '11'; break;
		case 12 : r = '12'; break;
		case 13 : r = '13'; break;
		case 14 : r = '14'; break;
		case 15 : r = '15'; break;
		case 16 : r = '16'; break;
		case 17 : r = '17'; break;
		case 18 : r = '18'; break;
		case 19 : r = '19'; break;
		case 20 : r = '20'; break;
		case 21 : r = '大'; break;
		case 22 : r = '小'; break;
		case 23 : r = '单'; break;
		case 24 : r = '双'; break;
		case 25 : r = '尾大'; break;
		case 26 : r = '尾小'; break;
		case 27 : r = '合数单'; break;
		case 28 : r = '合数双'; break;
		case 29 : r = '东'; break;
		case 30 : r = '南'; break;
		case 31 : r = '西'; break;
		case 32 : r = '北'; break;
		case 33 : r = '中'; break;
		case 34 : r = '发'; break;
		case 35 : r = '白'; break;
	}
	return r;
}

//读取玩法
function wan9(type) {
	var r = '';
	switch (type) {
		case 1 : r = '总和大'; break;
		case 2 : r = '总和小'; break;
		case 3 : r = '总和单'; break;
		case 4 : r = '总和双'; break;
		case 5 : r = '总和尾大'; break;
		case 6 : r = '总和尾小'; break;
		case 7 : r = '龙'; break;
		case 8 : r = '虎'; break;
	}
	return r;
}