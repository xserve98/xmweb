var time = num = hm = zw = 0;
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
			oddsInfo();
            history(data.kj_list);
		} else {
            endFun();
            return false;
		}
	}, "json");
}

function oddsInfo() {
	$.post("odds/6hc.php", function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
            $(".odds").html("-");
            $("input[type='checkbox'], input[type='radio']").attr("checked", false);
		    return false;
		}
		for(var s = 1; s < 9; s++) {
			var odds = oddslist.ball[11][s];
			$("#ball_11_o"+s).html(odds);
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
        $("input[type='checkbox'], input[type='radio']").attr("checked", false);
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

function opt_click() {
	$("input[name='ball[]']").attr("checked", false);
	$("input[name='ball_sx']").attr("checked", false);
	$("input[name='ball_ws']").attr("checked", false);
	$("input[name='ball_sx[]']").attr("checked", false);
	$("input[name='ball_ws[]']").attr("checked", false);
	$("input[name='ball_dm[]']").attr("checked", false);
	$("input[name='ball_tm[]']").attr("checked", false);
	$("#money").val('');
	$("input[name='type']:first").attr("checked", true);
	var oid = $('input:radio[name="ball_11"]:checked').val();
	var sid = $('input:radio[name="type"]:checked').val();
	if(oid < 4) {
		$("#type_2").hide();
		$("#type_3").hide();
	} else {
		$("#type_2").show();
		$("#type_3").show();
	}
	for(var i = 1; i < 6; i++) {
		$("#ball_"+i).hide();
	}
	$("#ball_"+sid).show();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
}

$("div.opt:not('.p1')").click(function() {
	$(this).children(":radio").attr("checked", true);
	opt_click();
});

$('input:radio[name="ball_11"]').click(function(e) {
	opt_click();
	e.stopPropagation();
});

function type_click() {
	if($('input:radio[name="ball_11"]:checked').val() == null) {
        lay_msg('请先选择分类，在选择玩法！', null);
		$("input:radio[name='type']").attr("checked", false);
        return false;
	}
	$("input[name='ball[]']").attr("checked", false);
	$("input[name='ball_sx']").attr("checked", false);
	$("input[name='ball_ws']").attr("checked", false);
	$("input[name='ball_sx[]']").attr("checked", false);
	$("input[name='ball_ws[]']").attr("checked", false);
	$("input[name='ball_dm[]']").attr("checked", false);
	$("input[name='ball_tm[]']").attr("checked", false);
	$("#money").val('');
	var sid = $('input:radio[name="type"]:checked').val();
	for(var i = 1; i < 6; i++) {
		$("#ball_"+i).hide();
	}
	$("#ball_"+sid).show();
}

$("div.p1").children("span").click(function() {
	$(this).children(":radio").attr("checked", true);
	type_click();
});

$('input:radio[name="type"]').click(function(e) {
	type_click();
	e.stopPropagation();
});

$('input[type=checkbox]').click(function(e) {
	e.stopPropagation();
});

$('input[type=radio]').click(function(e) {
	e.stopPropagation();
});

//投注提交
function order() {
	var cou = 0, m = 0, qw = 0, txt = '', balls = '', arr = new Array(), c = true;
    var tz_money = $("#kj_money");

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        lay_msg("请输入下注金额！！！", null);
        return false;
    }
	if($('input:radio[name="ball_11"]:checked').val() == null) {
        lay_msg('请先选择分类，在选择号码！', null);
        return false;
	}
	if($('input:radio[name="type"]:checked').val() == null) {
        lay_msg('请先选择玩法，在选择号码！', null);
        return false;
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein == '1') {
		if ($("input[name='ball[]']:checked").length < hm) {
            lay_msg('请至少选择 '+ hm +' 个号码！', null);
            return false;
		}
		if ($("input[name='ball[]']:checked").length > num) {
            lay_msg('您最多可以选择' + num + '个号码！', null);
            return false;
		}
		var checked = [];
		$("input[name='ball[]']:checked").each(function() {
			checked.push($(this).val());
		});
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
		if (hm == 3) {
			for (a=0;a<checked.length-2;a++){
				for (b=a+1;b<checked.length-1;b++){
					for (c=b+1;c<checked.length;c++){
						qw++;
					}
				}
			}
		}
		if (hm==2) {
			for (a=0;a<checked.length-1;a++){
				for (b=a+1;b<checked.length;b++){
					qw++;
				}
			}
		}
		for (var i = 0 ; i < checked.length ; i++) {
			txt = txt + checked[i] + ',';
		}
		txt = txt.substring(0,txt.lastIndexOf(','));
	} else if(typein == '2') {
		if ($("input[name='ball_sx[]']:checked").length < 2){
            lay_msg('请至少选择 2 组生肖！', null);
            return false;
		}
		if ($("input[name='ball_sx[]']:checked").length > 2) {
            lay_msg('您最多可以选 2 组生肖！', null);
            return false;
		}
		var checked = [];
		$("input[name='ball_sx[]']:checked").each(function() {
			checked.push($(this).val());
		});
		var sx_1 = checked[0].split(",");
		var sx_2 = checked[1].split(",");
		for(i=0;i<sx_1.length;i++){
			for (a=0;a<sx_2.length;a++){
				qw++;
			}
		}
		txt = txt + checked[0] + ' X ' + checked[1];
	} else if(typein == '3') {
		if ($("input[name='ball_ws[]']:checked").length < 2) {
            lay_msg('请至少选择 2 组尾数！', null);
            return false;
		}
		if ($("input[name='ball_ws[]']:checked").length > 2) {
            lay_msg('您最多可以选 2 组尾数！', null);
            return false;
		}
		var checked = [];
		$("input[name='ball_ws[]']:checked").each(function() {
			checked.push($(this).val());
		});
		var ws_1 = checked[0].split(",");
		var ws_2 = checked[1].split(",");
		for(i=0;i<ws_1.length;i++){
			for (a=0;a<ws_2.length;a++){
				qw++;
			}
		}
		txt = txt + checked[0] + ' X ' + checked[1];
	} else if(typein == '4') {
		if ($("input[name='ball_sx']:checked").length < 1) {
            lay_msg('请至少选择 1 组生肖！', null);
            return false;
		}
		if ($("input[name='ball_ws']:checked").length < 1) {
            lay_msg('请至少选择 1 组尾数！', null);
            return false;
		}
		var sx = $("input[name='ball_sx']:checked").val();
		var ws = $("input[name='ball_ws']:checked").val();
		var sx_1 = sx;
		var ws_1 = ws;
		ws = arrdel(sx,ws);
		sx = sx.split(",");
		if (hm == 4) {
			for(i=0;i<sx.length;i++){
				for (a=0;a<ws.length-2;a++){
					for (b=a+1;b<ws.length-1;b++){
						for (c=b+1;c<ws.length;c++){
							qw++;
						}
					}
				}
			}
		}
		if (hm == 3) {
			for(i=0;i<sx.length;i++){
				for (a=0;a<ws.length-1;a++){
					for (b=a+1;b<ws.length;b++){
						qw++;
					}
				}
			}
		}
		if (hm == 2) {
			for(i=0;i<sx.length;i++){
				for (a=0;a<ws.length;a++){
					qw++;
				}
			}
		}
		txt = txt + sx_1 + ' X ' + ws_1;
	} else if(typein == '5') {
		var cf;
		var dmarr = [];
		var tmarr = [];
		if ($("input[name='ball_dm[]']:checked").length < 1) {
            lay_msg('请至少选择 1 个胆码！', null);
            return false;
		}
		if (hm > 2) {
			if ($("input[name='ball_dm[]']:checked").length + $("input[name='ball_tm[]']:checked").length < hm) {
                lay_msg('胆码 + 拖码至少选择 ' + hm + ' 个号码！', null);
                return false;
			}
		} else {
			if ($("input[name='ball_tm[]']:checked").length < 1) {
                lay_msg('请至少选择 1 个拖码！', null);
                return false;
			}
		}
		if (hm == 4) {
			if ($("input[name='ball_dm[]']:checked").length > 3) {
                lay_msg('您最多可以选 3 个胆码！', null);
                return false;
			}
			$("input[name='ball_dm[]']:checked").each(function() {
				dmarr.push($(this).val());
			});
			$("input[name='ball_tm[]']:checked").each(function() {
				tmarr.push($(this).val());
			});
			cf = arrdb(dmarr, tmarr);
			if (cf == false) {
				lay_msg('拖码不能与胆码重复！', null);
				return false;
			}
			if ($("input[name='ball_dm[]']:checked").length + $("input[name='ball_tm[]']:checked").length >= hm) {
				tmarr = arrdels(dmarr, tmarr);
				if (dmarr.length == 3) {
					for(i=0;i<tmarr.length;i++){
						for (a=0;a<dmarr.length-2;a++){
							for (b=a+1;b<dmarr.length-1;b++){
								for (c=b+1;c<dmarr.length;c++){
									qw++;
								}
							}
						}
					}
				}
				if (dmarr.length == 2) {
					for (a=0;a<tmarr.length-1;a++){
						for (b=a+1;b<tmarr.length;b++){
							qw++;
						}
					}
				}
				if (dmarr.length == 1) {
					for (a=0;a<tmarr.length-2;a++){
						for (b=a+1;b<tmarr.length-1;b++){
							for (c=b+1;c<tmarr.length;c++){
								qw++;
							}
						}
					}
				}
			}
		}
		if (hm == 3) {
			if ($("input[name='ball_dm[]']:checked").length > 2) {
                lay_msg('您最多可以选 2 个胆码！', null);
                return false;
			}
			$("input[name='ball_dm[]']:checked").each(function() {
				dmarr.push($(this).val());
			});
			$("input[name='ball_tm[]']:checked").each(function() {
				tmarr.push($(this).val());
			});
			cf = arrdb(dmarr, tmarr);
			if (cf == false) {
				lay_msg('拖码不能与胆码重复！', null);
				return false;
			}
			if ($("input[name='ball_dm[]']:checked").length + $("input[name='ball_tm[]']:checked").length >= hm) {
				tmarr = arrdels(dmarr, tmarr);
				if (dmarr.length == 2) {
					for(i=0;i<tmarr.length;i++){
						for (a=0;a<dmarr.length-1;a++){
							for (b=a+1;b<dmarr.length;b++){
								qw++;
							}
						}
					}
				}
				if (dmarr.length == 1) {
					for (a=0;a<tmarr.length-1;a++){
						for (b=a+1;b<tmarr.length;b++){
							qw++;
						}
					}
				}
			}
		}
		if (hm == 2) {
			if ($("input[name='ball_dm[]']:checked").length > 3) {
                lay_msg('您最多可以选 3 个胆码！', null);
                return false;
			}
			$("input[name='ball_dm[]']:checked").each(function() {
				dmarr.push($(this).val());
			});
			$("input[name='ball_tm[]']:checked").each(function() {
				tmarr.push($(this).val());
			});
			cf = arrdb(dmarr, tmarr);
			if (cf == false) {
				lay_msg('拖码不能与胆码重复！', null);
				return false;
			}
			if ($("input[name='ball_dm[]']:checked").length + $("input[name='ball_tm[]']:checked").length >= hm) {
				tmarr = arrdels(dmarr, tmarr);
				for (a=0;a<dmarr.length;a++){
					for (b=0;b<tmarr.length;b++){
						qw++;
					}
				}
			}
		}
		if (qw > 286) {
            lay_msg('最多选择 286 组！', null);
            return false;
		}
		var dm = [];
		var tm = [];
		var dms = tms = '';
		$("input[name='ball_dm[]']:checked").each(function() {
			dm.push($(this).val());
		});
		$("input[name='ball_tm[]']:checked").each(function() {
			tm.push($(this).val());
		});
		for ( i = 0 ; i < dm.length ; i++ ){  
			dms = dms + dm[i] + ',';  
		}
		for ( i = 0 ; i < tm.length ; i++ ){  
			tms = tms + tm[i] + ',';  
		}
		dms = dms.substring(0,dms.lastIndexOf(','));
		tms = tms.substring(0,tms.lastIndexOf(','));
		txt = txt + dms + ' X ' + tms; 
	}
	var bid = parseInt($('input:radio[name="ball_11"]:checked').val());
	balls = wan(bid);
    var t = '<p>' + balls + '，下注明细如下：</p>';
    var e = '<p style="margin: 10px 0 0; padding: 0 3px; background-color: #000; color: #fff">单组注金：' + m + '元，组合共' + qw + '组，总注金' + m * qw + '元</p>';
    txt = t + txt + e;
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

function buling(num) {
	if(parseInt(num) < 10) {
		return 0 + num;
	} else {
		return num;
	}
}

function hnum(type) {
	var r = '';
	switch (type) {
		case 1 : r = 4; break;
		case 2 : r = 3; break;
		case 3 : r = 3; break;
		case 4 : r = 2; break;
		case 5 : r = 2; break;
		case 6 : r = 2; break;
	}
	return r;
}

function nums(type) {
	var r = '';
	switch (type) {
		case 1 : r = 10; break;
		case 2 : r = 10; break;
		case 3 : r = 10; break;
		case 4 : r = 10; break;
		case 5 : r = 10; break;
		case 6 : r = 10; break;
	}
	return r;
}

function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '四全中'; break;
		case 2 : r = '三全中'; break;
		case 3 : r = '三中二'; break;
		case 4 : r = '二全中'; break;
		case 5 : r = '二中特'; break;
		case 6 : r = '特串'; break;
	}
	return r;
}

function type(type) {
	var r = '';
	switch (type) {
		case 2 : r = '请选择 2组 生肖'; break;
		case 3 : r = '请选择 2组 尾数'; break;
		case 4 : r = '请选择 主肖 与 拖尾'; break;
		case 5 : r = '请选择 胆码 与 拖码'; break;
	}
	return r;
}

function arrdel (sx,ws) {
	var arr1=sx.split(",");
	var arr2=ws.split(",");
	var cccc='';
	var arr3=[];
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc=arr1[s];
			}
		}
	}
	for(var t in arr2){
		if(cccc!=arr2[t]){
			arr3.push(arr2[t]);
		}
	}
	return arr3;
}

function arrdels (arr1,arr2){
	var cccc='';
	var arr3=[];
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc=arr1[s];
			}
		}
	}
	for(var t in arr2){
		if(cccc!=arr2[t]){
			arr3.push(arr2[t]);
		}
	}
	return arr3;
}

function arrdb (arr1,arr2){
	var cccc = true ;
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc = false;
			}
		}
	}
	return cccc;
}