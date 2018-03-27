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

function loadInfo() {
	
	$.post("class/time_0.php" , function(data) {
	if(data.opentime > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            $("#kj_time").html(data.kj_time);
             endtime(data.opentime);
			oddsInfo();
        ///
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
		for(var s = 1; s<9; s++){
			var odds = oddslist.ball[15][s];
			$("#ball_15_o"+s).html(odds);
		}
	}, "json");
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
                 oddsInfo();
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
        win_parent.find("#gm_name").html("极速六合彩");
        win_parent.find("#kj_list").html(ls_kj);
        win_parent.find("#user_order").html('').hide();
        win_parent.find("#info").show();
    }
}

$('input:radio[name="ball_15"]').click(function() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_15"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	$("#zuhe").html('尚未选满 '+ hm +' 个球号');
});

$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_15"]:checked').val()==null){
		layer.msg('请先选择分类，在选择号码！');
        return false;
	}
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
			var zh = v = ''; qw = 0;
			if(hm==5){
				for (a=0;a<checked.length-4;a++){
					for (b=a+1;b<checked.length-3;b++){
						for (c=b+1;c<checked.length-2;c++){
							for (d=c+1;d<checked.length-1;d++){
								for (e=d+1;e<checked.length;e++){
									qw++;
									zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+'<br>';
								}
							}
						}
					}
				}
			}
			if(hm==6){
				for (a=0;a<checked.length-5;a++){
					for (b=a+1;b<checked.length-4;b++){
						for (c=b+1;c<checked.length-3;c++){
							for (d=c+1;d<checked.length-2;d++){
								for (e=d+1;e<checked.length-1;e++){
									for (f=e+1;f<checked.length;f++){
										qw++;
										zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+'<br>';
									}
								}
							}
						}
					}
				}
			}
			if(hm==7){
				for (a=0;a<checked.length-6;a++){
					for (b=a+1;b<checked.length-5;b++){
						for (c=b+1;c<checked.length-4;c++){
							for (d=c+1;d<checked.length-3;d++){
								for (e=d+1;e<checked.length-2;e++){
									for (f=e+1;f<checked.length-1;f++){
										for (g=f+1;g<checked.length;g++){
											qw++;
											zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+'<br>';
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==8){
				for (a=0;a<checked.length-7;a++){
					for (b=a+1;b<checked.length-6;b++){
						for (c=b+1;c<checked.length-5;c++){
							for (d=c+1;d<checked.length-4;d++){
								for (e=d+1;e<checked.length-3;e++){
									for (f=e+1;f<checked.length-2;f++){
										for (g=f+1;g<checked.length-1;g++){
											for (h=g+1;h<checked.length;h++){
												qw++;
												zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+'<br>';
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==9){
				for (a=0;a<checked.length-8;a++){
					for (b=a+1;b<checked.length-7;b++){
						for (c=b+1;c<checked.length-6;c++){
							for (d=c+1;d<checked.length-5;d++){
								for (e=d+1;e<checked.length-4;e++){
									for (f=e+1;f<checked.length-3;f++){
										for (g=f+1;g<checked.length-2;g++){
											for (h=g+1;h<checked.length-1;h++){
												for (i=h+1;i<checked.length;i++){
													qw++;
													zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+'<br>';
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
			if(hm==10){
				for (a=0;a<checked.length-9;a++){
					for (b=a+1;b<checked.length-8;b++){
						for (c=b+1;c<checked.length-7;c++){
							for (d=c+1;d<checked.length-6;d++){
								for (e=d+1;e<checked.length-5;e++){
									for (f=e+1;f<checked.length-4;f++){
										for (g=f+1;g<checked.length-3;g++){
											for (h=g+1;h<checked.length-2;h++){
												for (i=h+1;i<checked.length-1;i++){
													for (j=i+1;j<checked.length;j++){
														qw++;
														zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+'<br>';
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
			if(hm==11){
				for (a=0;a<checked.length-10;a++){
					for (b=a+1;b<checked.length-9;b++){
						for (c=b+1;c<checked.length-8;c++){
							for (d=c+1;d<checked.length-7;d++){
								for (e=d+1;e<checked.length-6;e++){
									for (f=e+1;f<checked.length-5;f++){
										for (g=f+1;g<checked.length-4;g++){
											for (h=g+1;h<checked.length-3;h++){
												for (i=h+1;i<checked.length-2;i++){
													for (j=i+1;j<checked.length-1;j++){
														for (k=j+1;k<checked.length;k++){
															qw++;
															zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+', '+buling(checked[k])+'<br>';
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
			if(hm==12){
				for (a=0;a<checked.length-11;a++){
					for (b=a+1;b<checked.length-10;b++){
						for (c=b+1;c<checked.length-9;c++){
							for (d=c+1;d<checked.length-8;d++){
								for (e=d+1;e<checked.length-7;e++){
									for (f=e+1;f<checked.length-6;f++){
										for (g=f+1;g<checked.length-5;g++){
											for (h=g+1;h<checked.length-4;h++){
												for (i=h+1;i<checked.length-3;i++){
													for (j=i+1;j<checked.length-2;j++){
														for (k=j+1;k<checked.length-1;k++){
															for (l=k+1;l<checked.length;l++){
																qw++;
																zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+', '+buling(checked[k])+', '+buling(checked[l])+'<br>';
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
			v = '组合共 <strong>'+ qw +'</strong> 组<br>';
			$("#zuhe").html(v+zh);
		}
	}
});

//投注提交
function order(){
	var balls = '', arr = new Array(), c = true;
    var cou =  0, txt = '', m = 0;
    var tz_money = $("#kj_money");

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        layer.msg('请输入下注金额！');
        return false;
    }
	if($('input:radio[name="ball_15"]:checked').val()==null){
		layer.msg('请先选择分类，在选择号码！');
        return false;
	}
	if ($("input[name='ball[]']:checked").length < hm){
		layer.msg('请至少选择 '+ hm +' 个号码！');
        return false;
	}
	var checked = [];var value='';
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	for (var i = 0 ; i < checked.length ; i++ ){
		txt = txt + checked[i] + ',';  
			value =value+checked[i] + ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	value = value.substring(0,value.lastIndexOf(','));
	
	var bid = parseInt($('input:radio[name="ball_15"]:checked').val());
	balls = wan(bid);
	var t = balls + " 确定下注吗？\n\n下注明细如下：\n\n";
	var e = "\n\n单组注金 ￥"+m+"，组合共 "+ qw +" 组，总注金 ￥"+m*qw;
	///txt = t + txt + e;
		var txtarr=[];
	 txtarr[0] = {
		 	"contents":balls+':'+txt,
			"odds":$('#ball_15_o'+bid).text(),
			"amount":m,
			"ball": value,
			"zushu":qw,
			"ball_15":bid
					   }
	
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
			 lottery: '/Six/order/order.php?type=0&class=14',
             drawNumber: $("#open_qihao").text(),
             bets: txtarr
			}
			///console.log(data);
		parent.showlhcBets(data);
		formReset();
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