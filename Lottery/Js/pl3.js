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

function gm_close() {
	var str = '<img class="gm_fp" src="/newindex/dy/fp.png" ondragstart="return false;"/>';
	$("body").html(str);
}

//盘口信息
function loadinfo(type) {
auto(0);
    g_type = type;
	$.post("class/odds_10.php", function(data) {
		if(data.opentime > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
			ball_odds = data.oddslist;
			loadodds(data.oddslist);
			endtime(data.opentime);
            auto(type);
		} else {
			 auto(type);
            ///history(type);
            gm_close();
            return false;
		}
	}, "json");
}

//更新赔率
function loadodds(oddslist) {
    var ref = arguments[1] ? arguments[1] : false;
    var odds = '';

	if (oddslist == null || oddslist == "") {
        $(".bian_td_odds").html("--");
        $(".bian_td_inp").html("封盘");
		return false;
	}
	for(var i = 1; i < 10; i++) {
		if(i == 4) {
			for(var s = 1; s < 8; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i == 5) {
			for(var s = 1; s < 6; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i == 6) {
			for(var s = 1; s < 11; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if((i >= 1 && i <= 3) || i == 7) {
			for(var s = 1; s < 15; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		}
	}
}

//更新投注框
function loadinput(ball, s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
    if(ball >= 1 && ball <= 7) {
        $("#ball_" + ball + "_t" + s).html(n);
    }
}

function getIS(s) {
	var h = Math.floor(s / (60*60));
    var i = Math.floor((s-h*60*60)/60);
    if(i < 10) i = '0' + i;
	if(h < 10) h = '0' + h;
    var ss = s % 60;
    if(ss < 10) ss = '0' + ss;
    return h+":"+i + ":" + ss;
}

//封盘时间
function endtime(iTime) {
    if(iTime <= 1800) {
        $(".bian_td_odds").html("--");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo(g_type);
    } else {
        iTime--;
        var t = iTime - 1800;
        if(t > 0) {
            $("#fp_time").html(getIS(t));
        } else {
            $("#fp_time").html("00:00");
        }
        if(iTime > 0) {
            $("#kj_time").html(getIS(iTime));
        } else {
            $("#kj_time").html("00:00");
        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}

//刷新时间
function rf_time(time) {
    var rf = $("#rf_time");
    var fp = $("#fp_time");
    if(time < 0) {
        clearTimeout(c_rf);
        if(fp.html() != "00:00") {
            rf.html("载入中...");
            $.post("class/odds_10.php", function(data) {
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
        rf.html(time + "秒");
        time--;
        c_rf = setTimeout("rf_time(" + time + ")", 1000);
    }
}

//更新开奖号码
function auto(ball) {
    var win_parent = $(window.parent.document);
    var kj_qishu =  win_parent.find("#result_info");
	var openqishu =( parseInt($('#open_qihao').html())-2).toString();
	$.post("class/auto_10.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
       var qihao = kj_qishu.html().replace(/[^0-9]/ig,"").toString();
        if(data.kj_list.length > 0 && qihao != data.kj_list[0]['qishu']) {
		if(qihao== openqishu){
		  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音
		  window.parent.document.getElementById('hk_mp3').innerHTML= "<embed src='/date/kaijiang.mp3' width='0' height='0'></embed>";
		}
            var new_qh = '';
            var new_hm = '';
			var new_hm2='';
            var ls_kj = '<tr>';
            ls_kj += '<td>期号</td><td>一</td><td>二</td><td>三</td><td>总和</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="ssc">';
                var sum = 0;
                for(var j in data.kj_list[i]) {
                    if(i == 0) {
                        if(j == 'qishu') {
                            new_qh = data.kj_list[i][j];
                        } else {
                            new_hm += '<em class="n_' + data.kj_list[i][j] + '"></em>';
		 new_hm2 += '<span><b class="b'+data.kj_list[i][j]+'">'+data.kj_list[i][j]+'</b>|';
                        }
                    }
                    if(j == 'qishu') {
                        ls_kj += '<td>' + data.kj_list[i][j].substr(-3) + '</td>';
                    } else {
                        sum += Number(data.kj_list[i][j]);
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"  class="ssc"><em class="n_'+data.kj_list[i][j]+'"></em></td>';
						
					
                        if(j == 'ball_3') {
                            ls_kj += '<td sum="1" num="' + sum + '" set="true" class="sum"><i class="n_' + sum + '">' + sum + '</i></td>';
                        }
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
			var strarr =new_hm2.split("|");
			var str =strarr[0]+'<i>佰</i></span>'+strarr[1]+'<i>拾</i></span>'+strarr[2]+'<i>个</i></span>'+'<div class="result_stat clearfix"></div><div class="result_stat clearfix ml4"></div>';
			
			var kjqh ='<div>体彩排列三</div><div>'+new_qh+'期开奖</div></div>';
			var win_parent = $(window.parent.document);
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","5px");
		  $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_3D L_F3D");
            win_parent.find("#gm_name").html("体彩排列三");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
			///setTimeout("auto(" + g_type + ")", 10000);
        } else {
            $("#play_sound").html('');setTimeout("auto(" + g_type + ")", 10000);
        }
	}, "json");
}

/*//////获取历史开奖
function history(ball) {
    $.post("class/auto_10.php", {ball: ball}, function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr>';
            ls_kj += '<td>期号</td><td>一</td><td>二</td><td>三</td><td>总和</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="ssc">';
                var sum = 0;
                for(var j in data.kj_list[i]) {
                    if(j == 'qishu') {
                        ls_kj += '<td>' + data.kj_list[i][j].substr(-3) + '</td>';
                    } else {
                        sum += Number(data.kj_list[i][j]);
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"><i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i></td>';
                        if(j == 'ball_3') {
                            ls_kj += '<td sum="1" num="' + sum + '" set="true" class="sum"><i class="n_' + sum + '">' + sum + '</i></td>';
                        }
                    }
                }
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("排列三");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
        }
    }, "json");
}

*///投注提交
function order() {
    if(!islg) {
        layer.msg("您尚未登录或登录已超时，请重新登录！");
        return false;
    }

    var cou =  0, txt = '';
    var mix = 5;
    var m = 0;
    var c = true;
    var  txt = [];
    var k=0;
	for (var i = 1; i < 10; i++) {
		if(i == 4) {
			for(var s = 1; s < 8; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wan6(s);
                   /// txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
				   
				      txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
					   }
					   k++;
					cou++;
				}
			}
		} else if(i == 5) {
			for(var s = 1; s < 6; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wan789(s);
                   /// txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
                      txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
					   }
					   k++;
					cou++;
				}
			}
		} else if(i == 6) {
			for(var s = 1; s < 11; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wanK(s);
                   // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
                      txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
					   }
					   k++;
				    cou++;
				}
			}
		} else {
			for(var s = 1; s < 15; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
                    var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wan(s);
                   // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
                    txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
					   }
					   k++;
					cou++;
				}
			}
		}
	}
	if (!c) {layer.msg("最低下注金额：" + mix + "元！");return false;}
	if (cou <= 0) {layer.msg("请输入下注金额！！！");return false;}
	var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
  ///  txt = t + txt;
	
    var opt = {
        dataType: 'json',
        beforeSubmit: function() {
            var ok = confirm(txt);
            if(!ok) {
                return false;
            }
        },
        success: function(data) {
            if(data.code == 0) {
                var html = getOrdersHtml(data);
                $(window.parent.document).find("#info").hide();
                $(window.parent.document).find("#user_order").html(html).show();
                formReset();
            } else if(data.code == 1) {
                layer.msg(data.info);
            } else if(data.code == 2) {
                layer.msg(data.info);
                location.replace(location.href);
            } else {
                window.top.location = "/";
            }
        }
    };
    ///$("#orders").ajaxSubmit(opt);
	var data={
			 lottery: $("#orders").attr("action"),
             drawNumber: $("#open_qihao").text(),
             bets: txt
			}
		parent.showBets(data);
		formReset();
}

//读取第几球
function did(type) {
	var r = '';
	switch (type) {
		case 1 : r = '第一球'; break;
		case 2 : r = '第二球'; break;
		case 3 : r = '第三球'; break;
		case 4 : r = '总和、龙虎和'; break;
		case 5 : r = '三连'; break;
		case 6 : r = '跨度'; break;
		case 7 : r = '独胆'; break;
	}
	return r;
}

//读取玩法
function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '0'; break;
		case 2 : r = '1'; break;
		case 3 : r = '2'; break;
		case 4 : r = '3'; break;
		case 5 : r = '4'; break;
		case 6 : r = '5'; break;
		case 7 : r = '6'; break;
		case 8 : r = '7'; break;
		case 9 : r = '8'; break;
		case 10 : r = '9'; break;
		case 11 : r = '大'; break;
		case 12 : r = '小'; break;
		case 13 : r = '单'; break;
		case 14 : r = '双'; break;
	}
	return r;
}

//读取玩法
function wan6(type) {
	var r = '';
	switch (type) {
		case 1 : r = '总和大'; break;
		case 2 : r = '总和小'; break;
		case 3 : r = '总和单'; break;
		case 4 : r = '总和双'; break;
		case 5 : r = '龙'; break;
		case 6 : r = '虎'; break;
		case 7 : r = '和'; break;
	}
	return r;
}

//读取玩法
function wan789(type) {
	var r = '';
	switch (type) {
		case 1 : r = '豹子'; break;
		case 2 : r = '顺子'; break;
		case 3 : r = '对子'; break;

		case 4 : r = '半顺'; break;
		case 5 : r = '杂六'; break;
	}
	return r;
}

//读取跨度
function wanK(type) {
	var r = '';
	switch (type) {
		case 1 : r = '0'; break;
		case 2 : r = '1'; break;
		case 3 : r = '2'; break;
		case 4 : r = '3'; break;
		case 5 : r = '4'; break;
		case 6 : r = '5'; break;
		case 7 : r = '6'; break;
		case 8 : r = '7'; break;
		case 9 : r = '8'; break;
		case 10 : r = '9'; break;
	}
	return r;
}