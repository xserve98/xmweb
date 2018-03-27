var time = 0;
var odds = '', closeTime = '';
var openqihao;
var g_type = 0;
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

function getIS(s) {
    var i = Math.floor(s / 60);
    if(i < 10) i = '0' + i;
    var ss = s % 60;
    if(ss < 10) ss = '0' + ss;
    return i + ":" + ss;
}

function endFun() {
    layer.msg('极速六合彩已经封盘，请留意本公司开盘公告！', {
        shade: [0.5, '#fff'],
        time: 0
    });
}

function loadInfo(i) {
	auto(0);
	$.post("class/time_0.php", function(data) {
	/////////////console.log(data);
	if(data.opentime > 0) {
	    $("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
           

             endtime(data.opentime,i);
            oddsInfo(i);
         
		} else {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
			endFun();
         ///   history(data.kj_list);
			return false;
		}
	}, "json");
}

function oddsInfo(i) {
//////////////console.log('oddsInfo(i)'+i);
	$.post("odds/6hc.php?" + Date.parse(new Date()), function(data) {
		var oddslist = data.oddslist;
		///////////console.log(oddslist)
		if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
         $(".bian_td_inp").html("封盘");
		    return false;
		}
		if(i < 8) {
			for(var s = 1; s < 87; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			///	///////////console.log(i+"----"+s);
			}
		}
		if(i == 16) {
			for(var s = 1; s < 62; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 17) {
			for(var s = 1; s < 50; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 8) {
			for(var s = 1; s < 50; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 9) {
			for(var s = 1; s < 5; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 10) {
			for(var s = 1; s < 23; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 'sm') {
			for(var s = 1; s < 7; s++) {
				for(var s1 = 50; s1 < 65; s1++) {
					var odds = oddslist.ball[s][s1];
					$("#ball_"+s+"_o"+s1).html(odds);
					loadInput(s , s1);
				}
			}
		}
	}, "json");
	
	//odds = setTimeout("oddsInfo(" + i + ")", 10000);
}

function loadInput(i , s) {

	var b = "ball_" + i + "_" + s;
	var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
         ///////////console.log($("#ball_" + i + "_m" + s).html());
	if($("#ball_" + i + "_m" + s).html() == '&nbsp;'||$("#ball_" + i + "_m" + s).html() == undefined||$("#ball_" + i + "_m" + s).html() == '封盘') {
		$("#ball_" + i + "_m" + s).html(n);
	}
}


//封盘时间
function endtime(iTime,i) {
  // ///////////console.log('endtime(iTime,i)'+i+iTime);
    if(iTime <= 10) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadInfo(i);
    } else {
        iTime--;
        var t = iTime - 10;
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
	
        fp = setTimeout("endtime(" + iTime + ","+i+")", 1000);
    }
}




function sx(hm){
	
			var shu=[10,22,34,46];	
		var niu =[9,21,33,45];	
		var hu =[8,20,32,44];
		var tu =[7,19,31,43];
		var long =[6,18,30,42];
		var she =[5,17,29,41];
		var ma =[4,16,28,40];
		var yang =[3,15,27,39];
		var hou =[2,14,26,38];
		var ji =[1,13,25,37,49];
		var gou =[12,24,36,48];
		var zhu =[11,23,35,47];
	
	
		var sx='';
		if(shu.indexOf(hm)!=-1){
			sx='鼠';
			
		} 
			if(niu.indexOf(hm)!=-1){
			sx='牛';
			
		} 
		
			if(hu.indexOf(hm)!=-1){
			sx='虎';
			
		} 
			if(tu.indexOf(hm)!=-1){
			sx='兔';
			
		} 
		
			if(long.indexOf(hm)!=-1){
			sx='龙';
			
		} 
			if(she.indexOf(hm)!=-1){
			sx='蛇';
			
		} 
			if(ma.indexOf(hm)!=-1){
			sx='马';
			
		} 
			if(yang.indexOf(hm)!=-1){
			sx='羊';
			
		} 
			if(hou.indexOf(hm)!=-1){
			sx='猴';
			
		} 
			if(ji.indexOf(hm)!=-1){
			sx='鸡';
			
		} 
			if(gou.indexOf(hm)!=-1){
			sx='狗';
			
		} 
			
			if(zhu.indexOf(hm)!=-1){
			sx='猪';
			
		} 
		
		
		
		return sx ;
	
	
}

//刷新时间
function rf_time(time,i) {
    var rf = $("#rf_time");
    var fp = $("#fp_time");
    if(time < 0) {
        clearTimeout(c_rf);
        if(fp.html() != "00:00") {
            rf.html("载入中...");
            $.post("class/time_0.php", function(data) {
                var qihao = $("#open_qihao").html();
                if(qihao == data.number) {
                 ///oddsInfo(" + i + ");
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

function auto(ball) {
    var win_parent = $(window.parent.document);
    var kj_qishu =  win_parent.find("#result_info");
	var openqishu =( parseInt($('#open_qihao').html())-2).toString();
	$.post("Class/Auto.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
       var qihao = kj_qishu.html().replace(/[^0-9]/ig,"").toString();
	  var name =kj_qishu.html().replace(/<\/?.+?>/g,"").substring(0,5);
if(name === '重庆时时彩'  && qihao == data.kj_list[0]['qishu'] ){
	qihao=1;
	}
//console.log('qihao'+qihao);console.log('qishu'+data.kj_list[0]['qishu']);console.log(openqishu);

        if(data.kj_list.length > 0 && qihao !== data.kj_list[0]['qishu'] ) {
		if(qihao== openqishu){
		  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音
		  window.parent.document.getElementById('hk_mp3').innerHTML= "<embed src='/date/kaijiang.mp3' width='0' height='0'></embed>";
		}
            var new_qh = '';
            var new_hm = '';
			var new_hm2='';
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="8">';
        
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'six\', 0, this);">号码</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 1, this);">生肖</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 2, this);">五行</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 3, this);">单双</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="25%">期号</td><td width="12%">一</td><td width="12%">二</td><td width="12%">三</td><td width="12%">四</td><td width="12%">五</td><td width="12%">六</td><td width="15%">特码</td>';
            ls_kj += '</tr>';
			///////////////开奖结果类型//////////////////
			//////console.log(data.kj_list[0]);///console.log(data.kj_list[1]);
			var b1=parseInt(data.kj_list[0]['ball_1']);
			var b2=parseInt(data.kj_list[0]['ball_2']);
			var b3=parseInt(data.kj_list[0]['ball_3']);
			var b4=parseInt(data.kj_list[0]['ball_4']);
			var b5=parseInt(data.kj_list[0]['ball_5']);
			var b6=parseInt(data.kj_list[0]['ball_6']);
			var b7=parseInt(data.kj_list[0]['ball_7']);
			
			
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
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"  class="six"><em class="n_'+data.kj_list[i][j]+'"></em></td>';
                     
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
			var strarr =new_hm2.split("|");
			var str =strarr[0]+'<i>'+sx(b1)+'</i></span>'+strarr[1]+'<i>'+sx(b2)+'</i></span>'+strarr[2]+'<i>'+sx(b3)+'</i></span>'+strarr[3]+'<i>'+sx(b4)+'</i></span>'+strarr[4]+'<i>'+sx(b5)+'</i></span>'+strarr[5]+'<i>'+sx(b6)+'</i></span>'+'<span class="plus">+</span>'+strarr[6]+'<i>'+sx(b7)+'</i></span>'+'<div class="result_stat clearfix"></div><div class="result_stat clearfix ml4"></div>';
			
			var win_parent = $(window.parent.document);
			var kjqh ='<div>极速六合彩</div><div>'+new_qh+'期开奖</div>'
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","5px");
		   $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_HK6 L_HK6");
       
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("极速六合彩");
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
            win_parent.find("#kj_list").html(ls_kj);
////////setTimeout("auto(22)", 10000);
        } else {
            $("#play_sound").html('');setTimeout("auto(22)", 10000);
         
        }
	}, "json");
}



function history(list) {
    if(list.length > 0) {
        var ls_kj = '<tr height="30">';
        ls_kj += '<td class="sub" colspan="8">';
        ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'six\', 0, this);">号码</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 1, this);">生肖</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 2, this);">五行</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 3, this);">单双</a>';
        ls_kj += '</td></tr>';
        ls_kj += '<tr>';
        ls_kj += '<td width="16%">期号</td><td width="12%">一</td><td width="12%">二</td><td width="12%">三</td><td width="12%">四</td><td width="12%">五</td><td width="12%">六</td><td width="12%">特</td>';
        ls_kj += '</tr>';
        for(var i in list) {
            ls_kj += '<tr class="six">';
            for(var j in list[i]) {
                if(j == 'qishu') {
                    ls_kj += '<td>' + list[i][j].substr(-3) + '</td>';
                } else {
                    ls_kj += '<td num="' + list[i][j] + '" set="true" class="six"><em class="n_' + list[i][j]  + '"></em></td>';
                }
            }
            ls_kj += '</tr>';
        }
        var win_parent = $(window.parent.document);
        win_parent.find("#gm_name").html("极速六合彩");
        win_parent.find("#kj_list").html(ls_kj);
        win_parent.find("#user_order").html('').hide();
        win_parent.find("#info").show();
    }
}

//投注提交
function order() {
    var cou =  0, txt = '';
    var m = 0;

   var  txt = [];
   var k=0;
	for (var i = 1; i < 18; i++) {
		if(i == 9) {
			for(var s = 1; s < 5; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_o" + s).children("a").html();
					var q = did(i);
					var w = wan9(s);
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
		} else if(i == 10) {
			for(var s = 1; s < 23; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_o" + s).children("a").html();
					var q = did(i);
					var w = wan(s+64);
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
		} else {
			for(var s = 1; s < 87; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_" + i + "_o" + s).children("a").html();
					var q = did(i);
					var w = wan(s);
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
	}
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
//	///console.log($("#open_qihao").text());
   // $("#orders").ajaxSubmit(opt);
}

//读取第几球
function did(type) {
	var r = '';
	switch (type) {
		case 1 : r = '正一'; break;
		case 2 : r = '正二'; break;
		case 3 : r = '正三'; break;
		case 4 : r = '正四'; break;
		case 5 : r = '正五'; break;
		case 6 : r = '正六'; break;
		case 7 : r = '特码B'; break;
		case 16 : r = '特码A'; break;
		case 8 : r = '正码B'; break;
		case 17 : r = '正码A'; break;
		case 9 : r = '总和'; break;
		case 10 : r = '一肖、尾数'; break;
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
		case 21 : r = '21'; break;
		case 22 : r = '22'; break;
		case 23 : r = '23'; break;
		case 24 : r = '24'; break;
		case 25 : r = '25'; break;
		case 26 : r = '26'; break;
		case 27 : r = '27'; break;
		case 28 : r = '28'; break;
		case 29 : r = '29'; break;
		case 30 : r = '30'; break;
		case 31 : r = '31'; break;
		case 32 : r = '32'; break;
		case 33 : r = '33'; break;
		case 34 : r = '34'; break;
		case 35 : r = '35'; break;
		case 36 : r = '36'; break;
		case 37 : r = '37'; break;
		case 38 : r = '38'; break;
		case 39 : r = '39'; break;
		case 40 : r = '40'; break;
		case 41 : r = '41'; break;
		case 42 : r = '42'; break;
		case 43 : r = '43'; break;
		case 44 : r = '44'; break;
		case 45 : r = '45'; break;
		case 46 : r = '46'; break;
		case 47 : r = '47'; break;
		case 48 : r = '48'; break;
		case 49 : r = '49'; break;
		case 50 : r = '大'; break;
		case 51 : r = '小'; break;
		case 52 : r = '单'; break;
		case 53 : r = '双'; break;
		case 54 : r = '合大'; break;
		case 55 : r = '合小'; break;
		case 56 : r = '合单'; break;
		case 57 : r = '合双'; break;
		case 58 : r = '尾大'; break;
		case 59 : r = '尾小'; break;
		case 60 : r = '尾单'; break;
		case 61 : r = '尾双'; break;
		case 62 : r = '红波'; break;
		case 63 : r = '蓝波'; break;
		case 64 : r = '绿波'; break;
		case 65 : r = '鼠'; break;
		case 66 : r = '牛'; break;
		case 67 : r = '虎'; break;
		case 68 : r = '兔'; break;
		case 69 : r = '龙'; break;
		case 70 : r = '蛇'; break;
		case 71 : r = '马'; break;
		case 72 : r = '羊'; break;
		case 73 : r = '猴'; break;
		case 74 : r = '鸡'; break;
		case 75 : r = '狗'; break;
		case 76 : r = '猪'; break;
		case 77 : r = '0尾'; break;
		case 78 : r = '1尾'; break;
		case 79 : r = '2尾'; break;
		case 80 : r = '3尾'; break;
		case 81 : r = '4尾'; break;
		case 82 : r = '5尾'; break;
		case 83 : r = '6尾'; break;
		case 84 : r = '7尾'; break;
		case 85 : r = '8尾'; break;
		case 86 : r = '9尾'; break;
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
	}
	return r;
}