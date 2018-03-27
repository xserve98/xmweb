var bool = auto_new = false;
var sound_off = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var p_sound = false;
var g_type=0;
var win_parent = $(window.parent.document);
var kj_qishu =  win_parent.find("#result_info");
var qihao1,qihao2,qihao;
 qihao1= kj_qishu.html().replace(/[^0-9]/ig,"").toString();
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

	$.post("class/odds_8.php", function(data) {
	
		if(data.opentime > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
			ball_odds = data.oddslist;
			loadodds(data.oddslist);
			endtime(data.opentime);
			auto(1);
			//console.log('dddd')
		} else {
				auto(1);
           /// history(1);
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
    for(var i = 1; i<18; i++) {
        if(i == 1) {
            for(var s = 1; s < 22; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
        } else if(i >= 2 && i <= 11) {
            for(var s = 1; s < 15; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
        } else if(i >= 12 && i <= 16) {
            for(var s = 1; s < 3; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
            }
		} else if(i == 17) {
            for(var s = 1; s < 27; s++) {
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
function loadinput(ball , s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"loadSet(this)\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
    if(ball >= 1 && ball <= 17) {
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
    item.className="inp1m";
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
            $.post("class/odds_8.php", function(data) {
				/////console.log(data);
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
		
   
	var openqishu =( parseInt($('#open_qihao').html())-2).toString();
	var qihao2= kj_qishu.html().replace(/[^0-9]/ig,"").toString();
	if(qihao1==qihao2){
		
		qihao=1
		
	}else{
		
		 qihao = kj_qishu.html().replace(/[^0-9]/ig,"").toString();
	}
	
	$.post("class/auto_8.php", {ball: '8'}, function(data) {
        $("#user_sy").html(data.shuying);
    
	 
        if(data.kj_list.length > 0 && qihao != data.kj_list[0]['qishu']) {
		if(qihao== openqishu){
		  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音
		  window.parent.document.getElementById('hk_mp3').innerHTML= "<embed src='/date/kaijiang.mp3' width='0' height='0'></embed>";
		}
            var new_qh = '';
            var new_hm = '';
			var new_hm2='';
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="11">';
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'xyft\', 0, this);">号码</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'xyft\', 1, this);">大小</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'xyft\', 2, this);">单双</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="16%">期号</td><td width="8%">冠</td><td width="8%">亚</td><td width="8%">季</td><td width="8%">四</td><td width="8%">五</td><td width="8%">六</td><td width="8%">七</td><td width="8%">八</td><td width="8%">九</td><td width="8%">十</td>';
            ls_kj += '</tr>';
			///////////////开奖结果类型//////////////////
			/////console.log(data.kj_list[0]);/////console.log(data.kj_list[1]);
			var b1=parseInt(data.kj_list[0]['ball_1']);
			var b2=parseInt(data.kj_list[0]['ball_2']);
			var b3=parseInt(data.kj_list[0]['ball_3']);
			var b4=parseInt(data.kj_list[0]['ball_4']);
			var b5=parseInt(data.kj_list[0]['ball_5']);
			var b6=parseInt(data.kj_list[0]['ball_6']);
			var b7=parseInt(data.kj_list[0]['ball_7']);
			var b8=parseInt(data.kj_list[0]['ball_8']);
			var b9=parseInt(data.kj_list[0]['ball_9']);
			var b10=parseInt(data.kj_list[0]['ball_10']);
			
           var hz =parseInt(b1)+parseInt(b2);
		   var hzdx= '',hzds='';var b1lh,b2lh,b3lh,b4lh,b5lh;
		   if(hz>11){
			   hzdx='大';
			   }else{
		  hzdx='小';   				   
				   }
		    if(hz%2==0){
			   hzds='双';
			   }else{
				  hzds='单';   				   
				   }
				   
			if(b1>b10){
				b1lh='龙';
				}else{
		    	b1lh='虎';
					}
				   
		   		if(b2>b9){
				b2lh='龙';
				}else{
					b2lh='虎';
					}
	 	if(b3>b8){
				b3lh='龙';
				}else{
					b3lh='虎';
					}
					
				if(b4>b7){
				b4lh='龙';
				}else{
					b4lh='虎';
					}
					
			if(b5>b6){
				b5lh='龙';
				}else{
					b5lh='虎';
					}
							
           

			////////////////////////////////
		
	
		
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="pk10">';
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
                        ls_kj += '<td>' + data.kj_list[i][j].substr(-3) + '</td>';
                    } else {
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"><i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i></td>';
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
	
     	var str =new_hm2+'<div class="result_stat clearfix"><div class="statitm">'+hz+'</div><div class="statitm">'+hzdx+'</div><div class="statitm">'+hzds+'</div><div class="statitm">'+b1lh+'</div><div class="statitm">'+b2lh+'</div><div class="statitm">'+b3lh+'</div><div class="statitm">'+b4lh+'</div><div class="statitm">'+b5lh+'</div></div>'
			
	          var kjqh ='<div>幸运飞艇</div><div>'+new_qh+'期开奖</div></div>';
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","-5px");
		 $("#result_balls", parent.document).css("margin-left","0px");
		  $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_PK10 L_AULUCKY10");
	
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("幸运飞艇");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
            var luzhu = $("#luzhu");
            if(luzhu.length > 0) {
                var lz_str = '';
                for(var i in data.luzhu) {
					lz_str += '<tr' + (i == 0 ? ' class="on"' : '') + '>';
					for(var j in data.luzhu[i]) {
						lz_str += data.luzhu[i][j];
					}
					lz_str += '</tr>';
                }
                luzhu.html(lz_str);
				parent.reSetIframeHeight(document.body.scrollHeight);
            }
            $(".gm_lz th").removeClass("cur").eq(0).addClass("cur");
            var cl_str = '';
            for(var i in data.cl_list) {
                cl_str += '<tr><td class="cl_l">' + i + '</td>';
                cl_str += '<td class="cl_r">' + data.cl_list[i] + ' 期</td></tr>';
            }
            $("#changlong").html(cl_str);
            /*layer.tips(tips[getRandomNum(0, 4)], ".cl_list", {
                tips: [3, '#3595CC'],
                time: 500000
            });///*/////setTimeout("auto(1)", 10000);
        } else {
            $("#play_sound").html('');
			setTimeout("auto(" + g_type + ")", 10000);
        }
    }, "json");
}

/*//////获取历史开奖
function history(ball) {
    $.post("class/auto_8.php", {ball: ball}, function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="11">';
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'xyft\', 0, this);">号码</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'xyft\', 1, this);">大小</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'xyft\', 2, this);">单双</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="16%">期号</td><td width="8%">冠</td><td width="8%">亚</td><td width="8%">季</td><td width="8%">四</td><td width="8%">五</td><td width="8%">六</td><td width="8%">七</td><td width="8%">八</td><td width="8%">九</td><td width="8%">十</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="pk10">';
                for(var j in data.kj_list[i]) {
                    if(j == 'qishu') {
                        ls_kj += '<td>' + data.kj_list[i][j].substr(-3) + '</td>';
                    } else {
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"><i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i></td>';
                    }
                }
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("幸运飞艇");
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

	$.post("Include/Lottery_PK.php", function(data) {
        var cou =  0, txt = '';
        var mix = data.cp_zd;
        var max = data.cp_zg;
        var m = 0;
        var c = true;
        var d = true;
		var k=0;
		var txt=[];
		for (var i = 1; i < 18; i++) {
			if(i == 1) {
				for(var s = 1; s < 22; s++) {
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*//*
                        if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
                            d = false;
                            layer.msg("最高下注金额：" + max + "元！");
                            return false;
                        }*/
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
                        var odds = $("#ball_" + i + "_h" + s).children("a").html();
						var q = did(i);
						var w = wan(s);
                        txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
							      }
							///txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + "#ball_" + i + "_" + s+ '\n';   k
                        cou++;
						k++;
                    }
				}
			} else if(i >= 2 && i <= 11) {
				for(var s = 1; s < 15; s++) {
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*//*
                        if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
                            d = false;
                            layer.msg("最高下注金额：" + max + "元！");
                            return false;
                        }*/
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
                        var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var q = did(i);
                        var w = wan2(s);
						  txt[k] = {
							"contents":q + ' [' + w +']',
							"odds":odds,
							"amount":parseInt($("#ball_" + i + "_" + s).val()),
							"ball": "ball_" + i + "_" + s
							      }
								  k++;
                       // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + "#ball_" + i + "_" + s+ '\n';
                        cou++;
                    }
                }
            } else if(i == 17) {
                for(var s = 1; s < 27; s++) {
                    if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                        //判断最小下注金额
                        /*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*//*
                        if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
                            d = false;
                            layer.msg("最高下注金额：" + max + "元！");
                            return false;
                        }*/
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
                        var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var q = did(i);
                        var w = wan17(s);
                       // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + "#ball_" + i + "_" + s+ '\n';
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
                for(var s = 1; s < 3; s++) {
                    if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                        //判断最小下注金额
                        /*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*//*
                        if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
                            d = false;
                            layer.msg("最高下注金额：" + max + "元！");
                            return false;
                        }*/
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
                        var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var q = did(i);
						var w = wan12(s);
                       // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + "#ball_" + i + "_" + s+ '\n';
					   
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
		if (!d) {layer.msg("最高下注金额：" + max + "元！");return false;}
		if (cou <= 0) {layer.msg("请输入下注金额！！！");return false;}
		var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
       // txt = t + txt;
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
		///	/////console.log(data);
      ///  $("#orders").ajaxSubmit(opt);
	  	parent.showBets(data);
		formReset();
	}, "json");
}

//读取第几球
function did(type) {
    var r = '';
    switch (type)
    {
        case 1 : r = '冠、亚军和'; break;
        case 2 : r = '冠军'; break;
        case 3 : r = '亚军'; break;
        case 4 : r = '第三名'; break;
        case 5 : r = '第四名'; break;
        case 6 : r = '第五名'; break;
        case 7 : r = '第六名'; break;
        case 8 : r = '第七名'; break;
        case 9 : r = '第八名'; break;
        case 10 : r = '第九名'; break;
        case 11 : r = '第十名'; break;
        case 12 : r = '1V10 龙虎'; break;
        case 13 : r = '2V9 龙虎'; break;
        case 14 : r = '3V8 龙虎'; break;
        case 15 : r = '4V7 龙虎'; break;
        case 16 : r = '5V6 龙虎'; break;
		case 17 : r = '冠亚季军和'; break;
    }
    return r;
}

//读取玩法
function wan(type) {
    var r = '';
    switch (type)
    {
        case 1 : r = '3'; break;
        case 2 : r = '4'; break;
        case 3 : r = '5'; break;
        case 4 : r = '6'; break;
        case 5 : r = '7'; break;
        case 6 : r = '8'; break;
        case 7 : r = '9'; break;
        case 8 : r = '10'; break;
        case 9 : r = '11'; break;
        case 10 : r = '12'; break;
        case 11 : r = '13'; break;
        case 12 : r = '14'; break;
        case 13 : r = '15'; break;
        case 14 : r = '16'; break;
        case 15 : r = '17'; break;
        case 16 : r = '18'; break;
        case 17 : r = '19'; break;
        case 18 : r = '冠亚大'; break;
        case 19 : r = '冠亚小'; break;
        case 20 : r = '冠亚单'; break;
        case 21 : r = '冠亚双'; break;
    }
    return r;
}

//读取玩法
function wan2(type) {
    var r = '';
    switch (type)
    {
        case 1 : r = '1'; break;
        case 2 : r = '2'; break;
        case 3 : r = '3'; break;
        case 4 : r = '4'; break;
        case 5 : r = '5'; break;
        case 6 : r = '6'; break;
        case 7 : r = '7'; break;
        case 8 : r = '8'; break;
        case 9 : r = '9'; break;
        case 10 : r = '10'; break;
        case 11 : r = '大'; break;
        case 12 : r = '小'; break;
        case 13 : r = '单'; break;
        case 14 : r = '双'; break;
    }
    return r;
}

//读取玩法
function wan12(type) {
    var r = '';
    switch (type)
    {
        case 1 : r = '龙'; break;
        case 2 : r = '虎'; break;
    }
    return r;
}

//读取玩法
function wan17(type) {
	var r = '';
	switch (type)
	{
		case 1 : r = '6'; break;
		case 2 : r = '7'; break;
		case 3 : r = '8'; break;
		case 4 : r = '9'; break;
		case 5 : r = '10'; break;
		case 6 : r = '11'; break;
		case 7 : r = '12'; break;
		case 8 : r = '13'; break;
		case 9 : r = '14'; break;
		case 10 : r = '15'; break;
		case 11 : r = '16'; break;
		case 12 : r = '17'; break;
		case 13 : r = '18'; break;
		case 14 : r = '19'; break;
		case 15 : r = '20'; break;
		case 16 : r = '21'; break;
		case 17 : r = '22'; break;
		case 18 : r = '23'; break;
		case 19 : r = '24'; break;
		case 20 : r = '25'; break;
		case 21 : r = '26'; break;
		case 22 : r = '27'; break;
		case 23 : r = '冠亚季大'; break;
		case 24 : r = '冠亚季小'; break;
		case 25 : r = '冠亚季单'; break;
		case 26 : r = '冠亚季双'; break;
	}
	return r;
}