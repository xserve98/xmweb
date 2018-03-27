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
function loadinfo() {

    $.post("class/odds_12.php", function(data) {
        if(data.opentime > 0) {
            $("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            loadodds(data.oddslist);
            endtime(data.opentime);
            auto();
        } else {
			 auto();
          ///  history();
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
    for(var i = 1; i < 5; i++) {
        if(i == 1) {
            for(var s = 1; s <= 28; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
        } else if(i == 2) {
            for(var s = 1; s <= 10; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
        } else if(i == 3) {
            for(var s = 1; s <= 3; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
        } else {
            odds = oddslist.ball[i][1];
            $("#ball_"+i+"_h1").html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
            if(!ref) {
                loadinput(i, 1);
            }
        }
    }
}

//更新投注框
function loadinput(ball, s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
    if(ball > 0 && ball < 5) {
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
        $(".bian_td_odds").html("--");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo();
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
            $.post("class/odds_12.php", function(data) {
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
function auto() {
    var win_parent = $(window.parent.document);
    var kj_qishu =  win_parent.find("#result_info");
	var openqishu =( parseInt($('#open_qihao').html())-2).toString();
    $.post("class/auto_12.php", function(data) {
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
            ls_kj += '<td>期号</td><td>开奖号码</td>';
            ls_kj += '</tr>';
		///	/////console.log(data.kj_list[0]);/////console.log(data.kj_list[1]);
			var b1=parseInt(data.kj_list[0]['ball_1']);
			var b2=parseInt(data.kj_list[0]['ball_2']);
			var b3=parseInt(data.kj_list[0]['ball_3']);
  var hz =parseInt(b1)+parseInt(b2)+parseInt(b3);
  var hzstr ='<span><b class="bg b_'+hz+'">'+hz+'</b></span>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="xy28">';
                var hm = '';
                for(var j in data.kj_list[i]) {
                    if(i == 0) {
                        if(j == 'qishu') {
                            new_qh = data.kj_list[i][j];
                        } else {
                            if(j == 'ball_1') {
                                new_hm += '<em class="n_' + data.kj_list[i][j] + '"></em>';
                            } else if(j == 'ball_4') {
                                new_hm += ' <i class="v_m">=</i> <em class="n_' + data.kj_list[i][j] + '"></em>';
                            } else {
                                new_hm += ' <i class="v_m">+</i> <em class="n_' + data.kj_list[i][j] + '"></em>';
                            
			    }
			    	 new_hm2 += '<span><b class="bg b_'+data.kj_list[i][j]+'">'+data.kj_list[i][j]+'</b>|';
                        }
                    }
                    if(j == 'qishu') {
                        ls_kj += '<td><i>' + data.kj_list[i][j] + '</i></td>';
                    } else {
                       if(j == 'ball_1') {
							
                            hm +=    '<em class="n_' + data.kj_list[i][j] + '"></em>';
                        } else if(j == 'ball_4') {
                            hm += ' = <em class="n_' + data.kj_list[i][j] + '"></em>';
                        } else {
                            hm += ' + <em class="n_' + data.kj_list[i][j] + '"></em>'
                        }
                    }
                }
                ls_kj += '<td>' + hm + '</td>';
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
			var strarr =new_hm2.split("|");
			var str =strarr[0]+'<i style="margin:-25px 0px 0px 40px">+</i></span>'+strarr[1]+'</b><i style="margin:-25px 0px 0px 40px">+</i></span>'+strarr[2]+'<i style="margin:-25px 0px 0px 40px">=</i></span>'+hzstr+'<div class="result_stat clearfix"></div><div class="result_stat clearfix ml4"></div>';
			
			var kjqh ='<div>PC蛋蛋</div><div>'+new_qh+'期开奖</div></div>';
			var win_parent = $(window.parent.document);
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","-5px");
		  $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_PCEGG L_PCEGG");
			
			
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("PC蛋蛋");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();////setTimeout("auto()", 10000);
        } else {
            $("#play_sound").html('');////
			setTimeout("auto()", 10000);
        }
    }, "json");
}

/*//////获取历史开奖
function history() {
    $.post("class/auto_12.php", function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr>';
            ls_kj += '<td>期号</td><td>开奖号码</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="xy28">';
                var hm = '';
                for(var j in data.kj_list[i]) {
                    if(j == 'qishu') {
                        ls_kj += '<td><i>' + data.kj_list[i][j] + '</i></td>';
                    } else {
                        if(j == 'ball_1') {
                            hm += '<i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i>';
                        } else if(j == 'ball_4') {
                            hm += ' = <i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i>';
                        } else {
                            hm += ' + <i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i>';
                        }
                    }
                }
                ls_kj += '<td>' + hm + '</td>';
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("PC蛋蛋");
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

    var cou =  0, txt = '', ball = '';
    var mix = 5;
    var m = 0;
    var c = true;
   var  txt = [];
   var k=0;
    for(var i = 1; i < 5; i++) {
        if(i == 1) {
            for(var s = 1; s <= 28; s++) {
                ball = $("#ball_" + i + "_" + s);
                if(ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    /*if(parseInt(ball.val()) < mix) {
                    c = false;
                }*/
                    m = m + parseInt(ball.val());
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan(s);
                 
		//    txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                 //txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
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
            for(var s = 1; s <= 10; s++) {
                ball = $("#ball_" + i + "_" + s);
                if(ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    /*if(parseInt(ball.val()) < mix) {
                    c = false;
                }*/
                    m = m + parseInt(ball.val());
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan2(s);
                    //txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
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
        } else if(i == 3) {
            for(var s = 1; s <= 3; s++) {
                ball = $("#ball_" + i + "_" + s);
                if(ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    /*if(parseInt(ball.val()) < mix) {
                    c = false;
                }*/
                    m = m + parseInt(ball.val());
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan3(s);
                   // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
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
		
		else if(i == 4) {
            for(var s = 1; s <= 1; s++) {
                ball = $("#ball_" + i + "_" + s);
                if(ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    /*if(parseInt(ball.val()) < mix) {
                    c = false;
                }*/
                    m = m + parseInt(ball.val());
                    //获取投注项，赔率
                    var odds = $("#ball_" + i + "_h" + s).children("a").html();
                    var q = did(i);
                    var w = wan3(s);
                   // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
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
		
		
		
		
		else {
            ball = $("#ball_" + i + "_1");
            if(ball.val() != "" && ball.val() != null) {
                //判断最小下注金额
                /*if(parseInt(ball.val()) < mix) {
                    c = false;
                }*/
                m = m + parseInt(ball.val());
                //获取投注项，赔率
                var odds = $("#ball_" + i + "_h1").children("a").html();
                var q = did(i);
                var w = wan4(1);
                //txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
               
	        txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":m,
							"ball": "ball_" + i + "_1"
					   }
					   k++;
	       
	        cou++;
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
	
	
	
	var data={
			 lottery: $("#orders").attr("action"),
             drawNumber: $("#open_qihao").text(),
             bets: txt
			}
		parent.showBets(data);
		formReset();
//	/////console.log($("#open_qihao").text());
   // $("#orders").ajaxSubmit(opt);
}

//读取第几球
function did(type) {
    var r = '';
    switch(type) {
        case 1:
            r = '特码';
            break;
        case 2:
            r = '混合';
            break;
        case 3:
            r = '波色';
            break;
        case 4:
            r = '豹子';
            break;
    }
    return r;
}

//读取玩法
function wan(type) {
    var r = '';
    switch(type) {
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
        case 11 : r = '10'; break;
        case 12 : r = '11'; break;
        case 13 : r = '12'; break;
        case 14 : r = '13'; break;
        case 15 : r = '14'; break;
        case 16 : r = '15'; break;
        case 17 : r = '16'; break;
        case 18 : r = '17'; break;
        case 19 : r = '18'; break;
        case 20 : r = '19'; break;
        case 21 : r = '20'; break;
        case 22 : r = '21'; break;
        case 23 : r = '22'; break;
        case 24 : r = '23'; break;
        case 25 : r = '24'; break;
        case 26 : r = '25'; break;
        case 27 : r = '26'; break;
        case 28 : r = '27'; break;
    }
    return r;
}

//读取玩法
function wan2(type) {
    var r = '';
    switch(type) {
        case 1 : r = '大'; break;
        case 2 : r = '小'; break;
        case 3 : r = '单'; break;
        case 4 : r = '双'; break;
        case 5 : r = '大双'; break;
        case 6 : r = '大单'; break;
        case 7 : r = '小双'; break;
        case 8 : r = '小单'; break;
        case 9 : r = '极大'; break;
        case 10 : r = '极小'; break;
    }
    return r;
}

//读取玩法
function wan3(type) {
    var r = '';
    switch(type) {
        case 1 : r = '红波'; break;
        case 2 : r = '绿波'; break;
        case 3 : r = '蓝波'; break;
    }
    return r;
}

//读取玩法
function wan4(type) {
    var r = '';
    switch(type) {
        case 1 : r = '豹子'; break;
    }
    return r;
}