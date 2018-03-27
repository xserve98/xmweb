var bool = auto_new = false;
var sound_off = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var g_type = 0;
var p_sound = false;
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
	var str = '<img class="gm_fp" src="/newindex/dy/fp.png" />';
	$("body").html(str);
}

//盘口信息
function loadinfo(type) {

    g_type = type;
	$.post("class/odds_34.php", function(data) {
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
function loadodds(oddslist){
	if (oddslist == null || oddslist == "") {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			return false;
	}
	for(var i = 1; i<15; i++){
		if(i==1){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
		if(i==2){
			for(var s = 1; s<5; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
		
		if(i==3){
			for(var s = 1; s<7; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
		
		if(i==4){
			for(var s = 1; s<7; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
		if(i==5){
			for(var s = 1; s<16; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
		
		if(i==6){
			for(var s = 1; s<7; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此快捷选择下注">' + odds + '</a>');
				loadinput(i , s);
			}
		}
	} 
	
} 
//更新投注框
function loadinput(ball, s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"loadSet(this)\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
	if(ball >= 1 && ball <= 15) {
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
            $.post("class/odds_34.php", function(data) {
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
	$.post("class/auto_34.php", {ball: ball}, function(data) {
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
			
			var b1=parseInt(data.kj_list[0]['ball_1']);
			var b2=parseInt(data.kj_list[0]['ball_2']);
			var b3=parseInt(data.kj_list[0]['ball_3']);
		
           var hz =parseInt(b1)+parseInt(b2)+parseInt(b3);
		   var hzdx= '',hzds='';var b1lh,b2lh,b3lh;
		   if(hz>22){
			   hzdx='大';
			   }else{
				  hzdx='小';   				   
				   }
				   
			////////////////////////////////
		

            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="k3">';
                var sum = 0;
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
                        sum += Number(data.kj_list[i][j]);
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"  class="k3"><em class="n_'+data.kj_list[i][j]+'"></em></td>';
                        if(j == 'ball_3') {
                            ls_kj += '<td sum="1" num="' + sum + '" set="true" class="sum"><i class="n_' + sum + '">' + sum + '</i></td>';
                        }
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
	
			var str =new_hm2+'<div class="result_stat clearfix"><div class="statitm">'+hz+'</div><div class="statitm">'+hzdx+'</div></div>'

			
			var kjqh ='<div>上海快三</div><div>'+new_qh+'期开奖</div>';
			var win_parent = $(window.parent.document);
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","-5px");
		 $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_K3 L_K3");
            win_parent.find("#gm_name").html("上海快三");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
			///setTimeout("auto(" + g_type + ")", 10000);
        } else {
            $("#play_sound").html('');setTimeout("auto(" + g_type + ")", 10000);
        }
	}, "json");
}
//投注提交
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
	for (var i = 1; i < 12; i++) {
		if(i == 6) {
			for(var s = 1; s < 8; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_" + i + "_h" + s).children("a").html();
					var q = did(i);
					var w = wan6(s);
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
		} else if(i == 7 || i == 8 || i == 9) {
			for(var s = 1; s < 10; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_" + i + "_h" + s).children("a").html();
					var q = did(i);
					var w = wan789(s);
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
			for(var s = 1; s < 16; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_10_h" + s).children("a").html();
					var q = did(i);
					var w = wan10(s);
					//txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
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
		} else if(i == 11) {
			for(var s = 1; s < 9; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					/*if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_11_h" + s).children("a").html();
					var q = did(i);
					var w = wan11(s);
					//	txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
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
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}*/
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_" + i + "_h" + s).children("a").html();
					var q = did(i);
					var w = wan(s);
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
		}
	}

	if (!c) {layer.msg("最低下注金额：" + mix + "元！");return false;}
	if (cou <= 0) {layer.msg("请输入下注金额！！！");return false;}
	var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
	//txt = t + txt;
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
	/////console.log($("#open_qihao").text());
   // $("#orders").ajaxSubmit(opt);
}

//读取第几球
function did (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '点数'; break;
		case 2 : r = '双面'; break;
		case 3 : r = '三军'; break;
		case 4 : r = '围骰'; break;
		case 5 : r = '长牌'; break;
		case 6 : r = '短牌'; break;
	}
	return r;
}
//读取玩法
function wan1 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '4'; break;
		case 2 : r = '5'; break;
		case 3 : r = '6'; break;
		case 4 : r = '7'; break;
		case 5 : r = '8'; break;
		case 6 : r = '9'; break;
		case 7 : r = '10'; break;
		case 8 : r = '11'; break;
		case 9 : r = '12'; break;
		case 10 : r = '13'; break;
		case 11 : r = '14'; break;
		case 12 : r = '15'; break;
		case 13 : r = '16'; break;
		case 14 : r = '17'; break;
	}
	return r;
}
//读取玩法
function wan2 (type)
{
	var r = '';
	switch (type)
	{
	case 1 : r = '点数大'; break;
	case 2 : r = '点数小'; break;
	case 3 : r = '点数单'; break;
	case 4 : r = '点数双'; break;
	}
	return r;
}

 
//读取玩法
function wan3 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '01'; break;
		case 2 : r = '02'; break;
		case 3 : r = '03'; break;
		case 4 : r = '04'; break;
		case 5 : r = '05'; break;
		case 6 : r = '06'; break;
	}
	return r;
}

//读取玩法
function wan4 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '010101'; break;
		case 2 : r = '020202'; break;
		case 3 : r = '030303'; break;
		case 4 : r = '040404'; break;
		case 5 : r = '050505'; break;
		case 6 : r = '060606'; break;
	}
	return r;
}


//读取玩法
function wan5 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '0102'; break;
		case 2 : r = '0103'; break;
		case 3 : r = '0104'; break;
		case 4 : r = '0105'; break;
		case 5 : r = '0106'; break;
		case 6 : r = '0203'; break;
		case 7 : r = '0204'; break;
		case 8 : r = '0205'; break;
		case 9 : r = '0206'; break;
		case 10 : r = '0304'; break;
		case 11 : r = '0305'; break;
		case 12 : r = '0306'; break;
		case 13 : r = '0405'; break;
		case 14 : r = '0406'; break;
		case 15 : r = '0506'; break;
	}
	return r;
}


//读取玩法
function wan6 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '0101'; break;
		case 2 : r = '0202'; break;
		case 3 : r = '0303'; break;
		case 4 : r = '0404'; break;
		case 5 : r = '0505'; break;
		case 6 : r = '0606'; break;
	}
	return r;
}

function getSwfId(id) { //与as3交互 跨浏览器
    if (navigator.appName.indexOf("Microsoft") != -1) { 
        return window[id]; 
    } else { 
        return document[id]; 
    } 
} 
