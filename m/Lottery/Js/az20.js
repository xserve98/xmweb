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
	var str = '<img class="gm_fp" src="/newindex/dy/fp.png" />';
	$("body").html(str);
}

//盘口信息
function loadinfo(type) {

    g_type = type;
	$.post("class/odds_30.php", function(data) {
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
    var n_p = $("#note_p");

	if (oddslist == null || oddslist == "") {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
		return false;
	}
	for(var i = 1; i < 9; i++) {
		if(i >= 1 && i <= 5) {
			for(var s = 1; s < 81; s++) {
				odds = oddslist.ball[i][1];
                if(g_type == 1) {
                    odds = '<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>';
                }
                $("#ball_"+i+"_h"+s).html(odds);
                if(!ref) {
                    loadinput(i, s);
                }
			}
            if(g_type == 1) {
                n_p.html("选一赔率为：<span style='color: red'><b>" + oddslist.ball[g_type][1] + "</b></span>");
            } else if(g_type == 2) {
                n_p.html("选二赔率为：<span style='color: red'><b>" + oddslist.ball[g_type][1] + "</b></span>");
            } else if(g_type == 3) {
                n_p.html("选三赔率为：<span style='color: red'><b>" + oddslist.ball[g_type][1] + "</b></span>");
            } else if(g_type == 4) {
                n_p.html("选四赔率为：<span style='color: red'><b>" + oddslist.ball[g_type][1] + "</b></span>");
            } else if(g_type == 5) {
                n_p.html("选五赔率为：<span style='color: red'><b>" + oddslist.ball[g_type][1] + "</b></span>");
            }
		} else if(i == 6) {
			for(var s = 1; s < 6; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i == 7 || i == 8) {
			for(var s = 1; s < 4; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
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
    var n2 = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" type=\"checkbox\" />";
	if(ball > 1 && ball < 6) {
		$("#ball_" + ball + "_t" + s).html(n2);
	} else {
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

function loadSet(item) {
    item.className = "inp1m";
}

//封盘时间
function endtime(iTime) {
    if(iTime <= 60) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo(g_type);
    } else {
        iTime--;
        var t = iTime - 60;
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
            $.post("class/odds_30.php", function(data) {
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
/////console.log('ball'+ball);
    var win_parent = $(window.parent.document);
    var kj_qishu =  win_parent.find("#result_info");
	var openqishu =( parseInt($('#open_qihao').html())-2).toString();
	$.post("class/auto_30.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
       var qihao = kj_qishu.html().replace(/[^0-9]/ig,"").toString().substring(1,15);
      ///console.log(qihao);console.log(data.kj_list[0]['qishu']);console.log(openqishu);
        if(data.kj_list.length > 0 && qihao != data.kj_list[0]['qishu']) {
		if(qihao== openqishu){
		  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音
		  window.parent.document.getElementById('hk_mp3').innerHTML= "<embed src='/date/kaijiang.mp3' width='0' height='0'></embed>";
		}
            var new_qh = '';
            var new_hm = '';
		var new_hm2='';
            var ls_kj = '<tr>';
            ls_kj += '<td>期号</td><td>开奖号码</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="kl8">';
                var hm = '';
                for(var j in data.kj_list[i]) {
                    if(i == 0) {
                        if(j == 'qishu') {
                            new_qh = data.kj_list[i][j];
                        } else {
                            new_hm += '<em class="n_' + data.kj_list[i][j] + '"></em>';
		 new_hm2 += '<span><b class="b'+data.kj_list[i][j]+'">'+data.kj_list[i][j]+'</b></span>';
                        }
                    }
                    if(j == 'qishu') {
                        ls_kj += '<td><i>' + data.kj_list[i][j] + '</i></td>';
                    } else {
                        hm += '<i' + (Number(data.kj_list[i][j]) > 40 ? ' class="c_r"' : ' class="c_b"') + '>' + prefix(data.kj_list[i][j], 2) + '</i>' + (j != 'ball_10' && j != 'ball_20' ? ' ' : '');
                        if(j == 'ball_10') {
                            hm += '<br>';
                        }
                    }
                }
                ls_kj += '<td>' + hm + '</td>';
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
			var strarr =new_hm2.split("|");
			var str =new_hm2+'<div class="result_stat clearfix"></div><div class="result_stat clearfix ml4"></div>';
			
			var kjqh ='<div>澳洲幸运20</div><div>'+new_qh+'期开奖</div>';
			var win_parent = $(window.parent.document);
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","5px");
		  $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_KL8 L_BJKL8");
            win_parent.find("#gm_name").html("澳洲幸运20");
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
    $.post("class/auto_30.php", {ball: ball}, function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr>';
            ls_kj += '<td>期号</td><td>开奖号码</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="kl8">';
                var hm = '';
                for(var j in data.kj_list[i]) {
                    if(j == 'qishu') {
                        ls_kj += '<td><i>' + data.kj_list[i][j] + '</i></td>';
                    } else {
                        hm += '<i' + (Number(data.kj_list[i][j]) > 40 ? ' class="c_r"' : ' class="c_b"') + '>' + prefix(data.kj_list[i][j], 2) + '</i>' + (j != 'ball_10' && j != 'ball_20' ? ' ' : '');
                        if(j == 'ball_10') {
                            hm += '<br>';
                        }
                    }
                }
                ls_kj += '<td>' + hm + '</td>';
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("北京快乐8");
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
	var ball='';
    var k=0;
    for (var i = 1; i < 9; i++) {
        if(i == 1) {
            for(var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    //判断最小下注金额
                  /*  if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
                        c = false;
                    }*/
                    m = m + parseInt($("#ball_" + i + "_" + s).val());
                    //获取投注项，赔率
                    var odds = $("#ball_"+i+"_h" + s).children("a").html();
                    var q = did(i);
                    var w = s;
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
        } else if(i == 2) {
            var ck = 0;
            var xNum = "";
			
            for(var s = 1; s < 81; s++) {
			///	//console.log("ball_" + i + "_" + s);
					/////console.log($("#ball_" + i + "_" + s).attr("checked"));

				     if ($("#ball_" + i + "_" + s).prop("checked")  == true) {
                    xNum = xNum + s + ",";
					ball += "ball_" + i + "_" + s+',';
					//alert(xNum);
                    ck++;
                }
            }

            if(ck == 0 && g_type == i) {
                layer.msg("[选二]请选择" + i + "个号码!");
                return false;
            }

            if(ck != 0) {

                if(ck != i) {
                    layer.msg("[选二]请选择" + i + "个号码!");
                    return false;
                }

                m = $("#kj_money").val();

                if (m != "" && m != null) {

                    //判断最小下注金额
                 /*   if (parseInt(m) < mix) {
                        c = false;
                    }*/
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h1").html();
                    var q = did(i);
                    var w = s;
					//console.log(xNum);
					ball = ball.substring(0,ball.lastIndexOf(','));
                   /// txt = txt + q + ' [' + xNum +'] @ ' + odds + ' x ￥' + parseInt(m) + '\n';
				      txt[0] = {
							"contents":q + ' [' + xNum +']',
							"odds":odds,
							"amount":m,
							"ball": ball,
							"ball_xx":m,
					   }
					  ////console.log(txt);
				   
                    cou++;
                } else {
                    layer.msg("请填写下注金额!");
                    return false;
                }
            }
        } else if(i == 3) {
            var ck = 0;
            var xNum = "";
            for(var s = 1; s < 81; s++) {

				     if ($("#ball_" + i + "_" + s).prop("checked")  == true) {
                    xNum = xNum + s+",";
				ball += "ball_" + i + "_" + s+',';
                    ck++;
                }
            }

            if(ck == 0 && g_type == i) {
                layer.msg("[选三]请选择" + i + "个号码!");
                return false;
            }

            if(ck != 0) {
                if(ck != i) {
                    layer.msg("[选三]请选择" + i + "个号码!");
                    return false;
                }

                m = $("#kj_money").val();

                if (m != "" && m != null) {

                    //判断最小下注金额
                  /*  if (parseInt(m) < mix) {
                        c = false;
                    }*/
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h1").html();
                    var q = did(i);
                    var w = s;
						ball = ball.substring(0,ball.lastIndexOf(','));
                    ///txt = txt + q + ' [' + xNum +'] @ ' + odds + ' x ￥' + parseInt(m) + '\n';
				 txt[0] = {
							"contents":q + ' [' + xNum +']',
							"odds":odds,
							"amount":m,
							"ball": ball,
							"ball_xx":m,
					   }
					
					
                    cou++;
                } else {
                    layer.msg("请填写下注金额!");
                    return false;
                }
            }
        } else if(i == 4) {
            var ck = 0;
            var xNum = "";
            for(var s = 1; s < 81; s++) {
				if ($("#ball_" + i + "_" + s).prop("checked")  == true) {
                  	ball += "ball_" + i + "_" + s+',';
				    xNum = xNum + s + ",";
                    ck++;
                }
            }

            if(ck == 0 && g_type == i) {
                layer.msg("[选四]请选择" + i + "个号码!");
                return false;
            }

            if(ck != 0) {
                if(ck != i) {
                    layer.msg("[选四]请选择" + i + "个号码!");
                    return false;
                }

                m = $("#kj_money").val();

                if (m != "" && m != null) {

                    //判断最小下注金额
                 /*   if (parseInt(m) < mix) {
                        c = false;
                    }*/
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h1").html();
                    var q = did(i);
                    var w = s;
						ball = ball.substring(0,ball.lastIndexOf(','));
                   // txt = txt + q + ' [' + xNum +'] @ ' + odds + ' x ￥' + parseInt(m) + '\n';
                   txt[0] = {
							"contents":q + ' [' + xNum +']',
							"odds":odds,
							"amount":m,
							"ball": ball,
							"ball_xx":m,
					   }
				    cou++;
                } else {
                    layer.msg("请填写下注金额!");
                    return false;
                }
            }
        } else if(i == 5) {
            var ck = 0;
            var xNum = "";
            for(var s = 1; s < 81; s++) {
			
                if ($("#ball_" + i + "_" + s).prop("checked")  == true) {
                   	ball += "ball_" + i + "_" + s+',';
				    xNum = xNum + s + ",";
                    ck++;
                }
            }

            if(ck == 0 && g_type == i) {
                layer.msg("[选五]请选择" + i + "个号码!");
                return false;
            }

            if(ck != 0) {
                if(ck != i) {
                    layer.msg("[选五]请选择" + i + "个号码!");
                    return false;
                }

                m = $("#kj_money").val();

                if (m != "" && m != null) {

                    //判断最小下注金额
                  /*  if (parseInt(m) < mix) {
                        c = false;
                    }*/
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h1").html();
                    var q = did(i);
                    var w = s;
						ball = ball.substring(0,ball.lastIndexOf(','));
                   /// txt = txt + q + ' [' + xNum +'] @ ' + odds + ' x ￥' + parseInt(m) + '\n';
                    txt[0] = {
							"contents":q + ' [' + xNum +']',
							"odds":odds,
							"amount":m,
							"ball": ball,
							"ball_xx":m,
					   }
				   
				    cou++;
                } else {
                    layer.msg("请填写下注金额!");
                    return false;
                }
            }
        } else if(i == 6) {
            for(var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    //判断最小下注金额
                   /* if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
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
        } else if(i == 7) {
            for(var s = 1; s < 4; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    //判断最小下注金额
                  /* if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
                        c = false;
                    }*/
                    m = m + parseInt($("#ball_" + i + "_" + s).val());
                    //获取投注项，赔率
                    var odds = $("#ball_"+i+"_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan7(s);
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
        } else if(i == 8) {
            for(var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    //判断最小下注金额
                   /* if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
                        c = false;
                    }*/
                    m = m + parseInt($("#ball_" + i + "_" + s).val());
                    //获取投注项，赔率
                    var odds = $("#ball_"+i+"_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan8(s);
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
		case 1 : r = '选一'; break;
		case 2 : r = '选二'; break;
		case 3 : r = '选三'; break;
		case 4 : r = '选四'; break;
		case 5 : r = '选五'; break;
		case 6 : r = '和值'; break;
		case 7 : r = '上中下'; break;
		case 8 : r = '奇和偶'; break;
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
		case 5 : r = '总和810'; break;
	}
	return r;
}

//读取玩法
function wan7(type) {
	var r = '';
	switch (type) {
		case 1 : r = '上盘'; break;
		case 2 : r = '中盘'; break;
		case 3 : r = '下盘'; break;
	}
	return r;
}

//读取玩法
function wan8(type) {
	var r = '';
	switch (type) {
		case 1 : r = '奇盘'; break;
		case 2 : r = '和盘'; break;
		case 3 : r = '偶盘'; break;
	}
	return r;
}