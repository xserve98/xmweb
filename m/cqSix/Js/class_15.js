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
            $("input[type='radio'], input[type='checkbox']").attr("checked", false);
            return false;
		}
		for(var s = 1; s<9; s++){
			var odds = oddslist.ball[15][s];
			$("#ball_15_o"+s).html(odds);
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

function opt_click() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_15"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
}

$("div.opt").click(function() {
	$(this).children(":radio").attr("checked", true);
	opt_click();
});

$('input:radio[name="ball_15"]').click(function(e) {
	opt_click();
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

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        lay_msg('请输入下注金额！', null);
        return false;
    }
	if($('input:radio[name="ball_15"]:checked').val()==null){
        lay_msg('请先选择分类，在选择号码！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length < hm){
        lay_msg('请至少选择 '+ hm +' 个号码！', null);
        return false;
	}
	if ($("input[name='ball[]']:checked").length > num) {
        lay_msg('您最多可以选择 '+ num +' 个号码！', null);
        return false;
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	if (hm == 5) {
		for (var a=0;a<checked.length-4;a++){
			for (var b=a+1;b<checked.length-3;b++){
				for (var c=b+1;c<checked.length-2;c++){
					for (var d=c+1;d<checked.length-1;d++){
						for (var e=d+1;e<checked.length;e++){
							qw++;
						}
					}
				}
			}
		}
	}
	if (hm == 6) {
		for (var a=0;a<checked.length-5;a++){
			for (var b=a+1;b<checked.length-4;b++){
				for (var c=b+1;c<checked.length-3;c++){
					for (var d=c+1;d<checked.length-2;d++){
						for (var e=d+1;e<checked.length-1;e++){
							for (var f=e+1;f<checked.length;f++){
								qw++;
							}
						}
					}
				}
			}
		}
	}
	if (hm == 7) {
		for (var a=0;a<checked.length-6;a++){
			for (var b=a+1;b<checked.length-5;b++){
				for (var c=b+1;c<checked.length-4;c++){
					for (var d=c+1;d<checked.length-3;d++){
						for (var e=d+1;e<checked.length-2;e++){
							for (var f=e+1;f<checked.length-1;f++){
								for (var g=f+1;g<checked.length;g++){
									qw++;
								}
							}
						}
					}
				}
			}
		}
	}
	if (hm == 8) {
		for (var a=0;a<checked.length-7;a++){
			for (var b=a+1;b<checked.length-6;b++){
				for (var c=b+1;c<checked.length-5;c++){
					for (var d=c+1;d<checked.length-4;d++){
						for (var e=d+1;e<checked.length-3;e++){
							for (var f=e+1;f<checked.length-2;f++){
								for (var g=f+1;g<checked.length-1;g++){
									for (var h=g+1;h<checked.length;h++){
										qw++;
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (hm == 9) {
		for (var a=0;a<checked.length-8;a++){
			for (var b=a+1;b<checked.length-7;b++){
				for (var c=b+1;c<checked.length-6;c++){
					for (var d=c+1;d<checked.length-5;d++){
						for (var e=d+1;e<checked.length-4;e++){
							for (var f=e+1;f<checked.length-3;f++){
								for (var g=f+1;g<checked.length-2;g++){
									for (var h=g+1;h<checked.length-1;h++){
										for (var i=h+1;i<checked.length;i++){
											qw++;
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (hm == 10) {
		for (var a=0;a<checked.length-9;a++){
			for (var b=a+1;b<checked.length-8;b++){
				for (var c=b+1;c<checked.length-7;c++){
					for (var d=c+1;d<checked.length-6;d++){
						for (var e=d+1;e<checked.length-5;e++){
							for (var f=e+1;f<checked.length-4;f++){
								for (var g=f+1;g<checked.length-3;g++){
									for (var h=g+1;h<checked.length-2;h++){
										for (var i=h+1;i<checked.length-1;i++){
											for (var j=i+1;j<checked.length;j++){
												qw++;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (hm == 11) {
		for (var a=0;a<checked.length-10;a++){
			for (var b=a+1;b<checked.length-9;b++){
				for (var c=b+1;c<checked.length-8;c++){
					for (var d=c+1;d<checked.length-7;d++){
						for (var e=d+1;e<checked.length-6;e++){
							for (var f=e+1;f<checked.length-5;f++){
								for (var g=f+1;g<checked.length-4;g++){
									for (var h=g+1;h<checked.length-3;h++){
										for (var i=h+1;i<checked.length-2;i++){
											for (var j=i+1;j<checked.length-1;j++){
												for (var k=j+1;k<checked.length;k++){
													qw++;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (hm == 12) {
		for (var a=0;a<checked.length-11;a++){
			for (var b=a+1;b<checked.length-10;b++){
				for (var c=b+1;c<checked.length-9;c++){
					for (var d=c+1;d<checked.length-8;d++){
						for (var e=d+1;e<checked.length-7;e++){
							for (var f=e+1;f<checked.length-6;f++){
								for (var g=f+1;g<checked.length-5;g++){
									for (var h=g+1;h<checked.length-4;h++){
										for (var i=h+1;i<checked.length-3;i++){
											for (var j=i+1;j<checked.length-2;j++){
												for (var k=j+1;k<checked.length-1;k++){
													for (var l=k+1;l<checked.length;l++){
														qw++;
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	for (var i = 0 ; i < checked.length ; i++ ){
		txt = txt + checked[i] + ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	var bid = parseInt($('input:radio[name="ball_15"]:checked').val());
	balls = wan(bid);
    var t = '<p>' + balls + '，下注明细如下：</p>' + txt;
    var e = '<p style="margin: 10px 0 0; padding: 0 3px; background-color: #000; color: #fff">单组注金：' + m + '元，共' + qw + '组，总注金：' + m * qw + '元</p>';
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

function buling(num) {
	if(parseInt(num)<10){
		return 0+num;
	}else{
		return num;
	}
}

function hnum(type) {
	var r = '';
	switch (type) {
		case 1 : r = 5; break;
		case 2 : r = 6; break;
		case 3 : r = 7; break;
		case 4 : r = 8; break;
		case 5 : r = 9; break;
		case 6 : r = 10; break;
		case 7 : r = 11; break;
		case 8 : r = 12; break;
	}
	return r;
}

function nums(type) {
	var r = '';
	switch (type) {
		case 1 : r = 10; break;
		case 2 : r = 10; break;
		case 3 : r = 10; break;
		case 4 : r = 11; break;
		case 5 : r = 12; break;
		case 6 : r = 13; break;
		case 7 : r = 13; break;
		case 8 : r = 14; break;
	}
	return r;
}

function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '五不中'; break;
		case 2 : r = '六不中'; break;
		case 3 : r = '七不中'; break;
		case 4 : r = '八不中'; break;
		case 5 : r = '九不中'; break;
		case 6 : r = '十不中'; break;
		case 7 : r = '十一不中'; break;
		case 8 : r = '十二不中'; break;
	}
	return r;
}