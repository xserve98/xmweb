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
    layer.msg('香港六合彩已经封盘，请留意本公司开盘公告！', {
        shade: [0.5, '#fff'],
        time: 0
    });
}

function loadInfo() {

	$.post("class/time_0.php?" + Date.parse(new Date()), function(data) {
		if(data.close > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            $("#kj_time").html(data.kj_time);
			timer(data.close);
			oddsInfo();
            history(data.kj_list);
		} else {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			endFun();
            history(data.kj_list);
			return false;
		}
	}, "json");
}

function oddsInfo() {
	$.post("odds/6hc.php?" + Date.parse(new Date()), function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
		    $(".bian_td_odds").html("-");
		    return false;
		}
		for(var s = 1; s < 9; s++) {
			var odds = oddslist.ball[11][s];
			$("#ball_11_o"+s).html(odds);
		}
		loadInput();
	}, "json");
}

function loadInput() {
	var b = "money";
	var n = "下注金额：<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"6\"/>";
	if($("#moneys").html() == '&nbsp;') {
		$("#moneys").html(n);
	}
}

function timer(intDiff) {
    var hour = 0, minute = 0, second = 0; //时间默认值
    if(intDiff > 0) {
        hour = Math.floor(intDiff / 3600);
        minute = Math.floor(intDiff / 60) - (hour * 60);
        second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
    } else {
        clearTimeout(odds);
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        clearTimeout(closeTime);
        endFun();
    }
    if (hour <= 9) hour = '0' + hour;
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
	var timestr= hour+':'+minute+':'+second;
    $('#fp_time').html(timestr);
    $('#minute_show').html(minute+' 分');
    $('#second_show').html(second+' 秒');
    intDiff--;
    closeTime = setTimeout("timer("+intDiff+")",1000);
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
                    ls_kj += '<td num="' + list[i][j] + '" set="true"><i class="n_' + list[i][j] + '">' + list[i][j] + '</i></td>';
                }
            }
            ls_kj += '</tr>';
        }
        var win_parent = $(window.parent.document);
        win_parent.find("#gm_name").html("香港六合彩");
        win_parent.find("#kj_list").html(ls_kj);
        win_parent.find("#user_order").html('').hide();
        win_parent.find("#info").show();
    }
}

$('input:radio[name="ball_11"]').click(function() {

	$("input[name='ball[]']").attr("checked", false);
	$("input[name='ball_sx']").attr("checked", false);
	$("input[name='ball_ws']").attr("checked", false);
	$("input[name='ball_sx[]']").attr("checked", false);
	$("input[name='ball_ws[]']").attr("checked", false);
	$("input[name='ball_dm[]']").attr("checked", false);
	$("input[name='ball_tm[]']").attr("checked", false);
	$("#money").val('');
	$("input[name='type']:first").prop("checked", true);
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
    $("#tab_mon").show();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	$("#zuhe").html('尚未选满 '+ hm +' 个球号');
});

$('input:radio[name="type"]').click(function() {
	if($('input:radio[name="ball_11"]:checked').val() == null) {
		layer.msg('请先选择分类，在选择玩法！');
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
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein == 1) {$("#zuhe").html('尚未选满 '+ hm +' 个球号');}
	if(typein > 1) {$("#zuhe").html(type(typein));}
	var sid = $('input:radio[name="type"]:checked').val();
	for(var i = 1; i < 6; i++) {
		$("#ball_"+i).hide();
	}
	$("#ball_"+sid).show();
});

$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_11"]:checked').val() == null) {
		layer.msg('请先选择分类，在选择号码！');
        return false;
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein == '1') {
		$("input[name='ball[]']").attr('disabled', true);
		if ($("input[name='ball[]']:checked").length > num) {
			$("input[name='ball[]']:checked").attr('disabled', false);
			layer.msg('您最多可以选择'+ num +'个号码！');
            return false;
		} else {
			$("input[name='ball[]']").attr('disabled', false);
			if ($("input[name='ball[]']:checked").length >= hm){
				$("input[name='ball[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = '', v = ''; qw = 0;
				if(hm == 4) {
					for (a=0;a<checked.length-3;a++){
						for (b=a+1;b<checked.length-2;b++){
							for (c=b+1;c<checked.length-1;c++){
								for (d=c+1;d<checked.length;d++){
									qw++;
									zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+'<br>';
								}
							}
						}
					}
				}
				if(hm==3){
					for (a=0;a<checked.length-2;a++){
						for (b=a+1;b<checked.length-1;b++){
							for (c=b+1;c<checked.length;c++){
								qw++;
								zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+'<br>';
							}
						}
					}
				}
				if(hm==2){
					for (a=0;a<checked.length-1;a++){
						for (b=a+1;b<checked.length;b++){
							qw++;
							zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+'<br>';
						}
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);
			}
		}
	}
	if(typein=='2'){
		if ($("input[name='ball_sx[]']:checked").length > 2) {
			$("input[name='ball_sx[]']:checked").attr('disabled', false);
			layer.msg('您最多可以选2组生肖！');
            return false;
		} else {
			if ($("input[name='ball_sx[]']:checked").length == 2){
				$("input[name='ball_sx[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = '', v = ''; qw = 0;
				var sx_1=checked[0].split(",");
				var sx_2=checked[1].split(",");
				for(i=0;i<sx_1.length;i++){
					for (a=0;a<sx_2.length;a++){
						qw++;
						zh += '<span>组合'+qw+'：</span>'+buling(sx_1[i])+', '+buling(sx_2[a])+'<br>';
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);
			}
		}
	}
	if(typein=='3'){
		if ($("input[name='ball_ws[]']:checked").length > 2) {
			$("input[name='ball_ws[]']:checked").attr('disabled', false);
			layer.msg('您最多可以选2组尾数！');
            return false;
		} else {
			if ($("input[name='ball_ws[]']:checked").length == 2){
				$("input[name='ball_ws[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = '', v = ''; qw = 0;
				var ws_1=checked[0].split(",");
				var ws_2=checked[1].split(",");
				for(i=0;i<ws_1.length;i++){
					for (a=0;a<ws_2.length;a++){
						qw++;
						zh += '<span>组合'+qw+'：</span>'+buling(ws_1[i])+', '+buling(ws_2[a])+'<br>';
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);
			}
		}
	}
	if(typein=='5'){
		var zh = v = ''; qw = 0;
		var cf;
		var dmarr = [];
		var tmarr = [];
		if(hm==4){
			if ($("input[name='ball_dm[]']:checked").length > 3) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				layer.msg('您最多可以选3个胆码！');
                return false;
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					layer.msg('拖码不能与胆码重复！');
                    return false;
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					if(dmarr.length==3){
						for(i=0;i<tmarr.length;i++){
							for (a=0;a<dmarr.length-2;a++){
								for (b=a+1;b<dmarr.length-1;b++){
									for (c=b+1;c<dmarr.length;c++){
										qw++;
										zh += '<span>组合'+qw+'：</span>'+buling(tmarr[i])+', '+buling(dmarr[a])+', '+buling(dmarr[b])+', '+buling(dmarr[c])+'<br>';
									}
								}
							}
						}
					}
					if(dmarr.length==2){
						for (a=0;a<tmarr.length-1;a++){
							for (b=a+1;b<tmarr.length;b++){
								qw++;
								zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(dmarr[0])+', '+buling(dmarr[1])+'<br>';
							}
						}
					}
					if(dmarr.length==1){
						for (a=0;a<tmarr.length-2;a++){
							for (b=a+1;b<tmarr.length-1;b++){
								for (c=b+1;c<tmarr.length;c++){
									qw++;
									zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(tmarr[c])+', '+buling(dmarr[0])+'<br>';
								}
							}
						}
					}
				}
			}
		}
		if(hm==3){
			if ($("input[name='ball_dm[]']:checked").length > 2) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				layer.msg('您最多可以选2个胆码！');
                return false;
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					layer.msg('拖码不能与胆码重复！');
                    return false;
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					if(dmarr.length==2){
						for(i=0;i<tmarr.length;i++){
							for (a=0;a<dmarr.length-1;a++){
								for (b=a+1;b<dmarr.length;b++){
									qw++;
									zh += '<span>组合'+qw+'：</span>'+buling(tmarr[i])+', '+buling(dmarr[a])+', '+buling(dmarr[b])+'<br>';
								}
							}
						}
					}
					if(dmarr.length==1){
						for (a=0;a<tmarr.length-1;a++){
							for (b=a+1;b<tmarr.length;b++){
								qw++;
								zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(dmarr[0])+'<br>';
							}
						}
					}
				}
			}
		}
		if(hm==2){
			if ($("input[name='ball_dm[]']:checked").length > 3) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				layer.msg('您最多可以选3个胆码！');
                return false;
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					layer.msg('拖码不能与胆码重复！');
                    return false;
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					for (a=0;a<dmarr.length;a++){
						for (b=0;b<tmarr.length;b++){
							qw++;
							zh += '<span>组合'+qw+'：</span>'+buling(tmarr[b])+', '+buling(dmarr[a])+'<br>';
						}
					}
				}
			}
		}
		if(qw>286){
			layer.msg('最多选择286组！');
            return false;
		}
		v = '组合共 <strong>'+ qw +'</strong> 组<br>';
		$("#zuhe").html(v+zh);
	}
});

$('input[type=radio]').click(function() {
	if($('input:radio[name="ball_11"]:checked').val()==null){
		layer.msg('请先选择分类，在选择号码！');
        return false;
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	var sx = ws = '';
	if($('input:radio[name="ball_sx"]:checked').val()!=null){
		sx = $('input:radio[name="ball_sx"]:checked').val();
	}
	if($('input:radio[name="ball_ws"]:checked').val()!=null){
		ws = $('input:radio[name="ball_ws"]:checked').val();
	}
	if(sx!='' && ws!=''){
		if(typein=='4'){
			var zh = v = ''; qw = 0;
			var ws = arrdel(sx,ws);
			sx=sx.split(",");
			if(hm==4){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length-2;a++){
						for (b=a+1;b<ws.length-1;b++){
							for (c=b+1;c<ws.length;c++){
								qw++;
								zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(ws[b])+', '+buling(ws[c])+', '+buling(sx[i])+'<br>';
							}
						}
					}
				}
			}
			if(hm==3){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length-1;a++){
						for (b=a+1;b<ws.length;b++){
							qw++;
							zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(ws[b])+', '+buling(sx[i])+'<br>';
						}
					}
				}
			}
			if(hm==2){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length;a++){
						qw++;
						zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(sx[i])+'<br>';
					}
				}
			}
			v = '组合共 <strong>'+ qw +'</strong> 组<br>';
			$("#zuhe").html(v+zh);
		}
	}
});

//投注提交
function order() {
	var cou = 0, m = 0, txt = '', balls = '', arr = new Array(), c=true;
    var tz_money = $("#kj_money");

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        layer.msg("请输入下注金额！！！");
        return false;
    }
	if($('input:radio[name="ball_11"]:checked').val() == null) {
		layer.msg('请先选择分类，在选择号码！');
        return false;
	}
	if($('input:radio[name="type"]:checked').val() == null) {
		layer.msg('请先选择玩法，在选择号码！');
        return false;
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein == '1') {
		if ($("input[name='ball[]']:checked").length < hm) {
            layer.msg('请至少选择 '+ hm +' 个号码！');
            return false;
		}
		var checked = [];
		$("input[name='ball[]']:checked").each(function() {
			checked.push($(this).val());
		});
		for (var i = 0 ; i < checked.length ; i++) {
			txt = txt + checked[i] + ',';
		}
		txt = txt.substring(0,txt.lastIndexOf(','));
	}


	var bid = parseInt($('input:radio[name="ball_11"]:checked').val());
	balls = wan(bid);
var obidnum=obid(bid);
	var t = balls + " 确定下注吗？\n\n下注明细如下：\n\n";
	var e = "\n\n单组注金 ￥"+m+"，组合共 "+ qw +" 组，总注金 ￥"+m*qw;
	///txt = t + txt + e;
	
	var txtarr=[];

	 txtarr[0] = {
		 	"contents":balls+':'+txt,
			"odds":$('#ball_11_o'+obidnum).text(),
			"amount":m,
			"ball": txt,
			"zushu":qw,
			"ball_11":bid
					   }
	
//	///console.log(txtarr);
	
	
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
			 lottery: '/Six/order/order.php?type=0&class=11',
             drawNumber: $("#open_qihao").text(),
             bets: txtarr
			}
			///console.log(data);
		parent.showlhcBets(data);
		formReset();
//	///console.log($("#open_qihao").text());
   // $("#orders").ajaxSubmit(opt);
	
	
	
    //$("#orders").ajaxSubmit(opt);
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
function obid(type) {
	var r = '';
	switch (type) {
		case 1 : r = 1; break;
		case 2 : r = 2; break;
		case 3 : r = 3; break;
		case 4 : r = 5; break;
		case 5 : r = 6; break;
		case 6 : r = 8; break;
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