var time = hm = zw = 0;
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
            history(data.kj_list);
		} else {
			$(".bian_td_odds").html("-");
			$(".bian_td_gg").html("封盘");
			endFun();
            history(data.kj_list);
			return false;
		}
	}, "json");
}

function oddsInfo(i) {
	$.post("odds/6hc.php?" + Date.parse(new Date()), function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
            return false;
		}
		for(var s = 1; s<11; s++){
			var odds = oddslist.ball[14][s+i];
			$("#ball_14_o"+s).html(odds);
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
    $('#minute_show').html(minute+'&nbsp;分');
    $('#second_show').html(second+'&nbsp;秒');
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

$('input:radio[name="ball_14"]').click(function() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_14"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	odds = o(parseInt(oid));
	oddsInfo(odds);
	$("#zuhe").html('尚未选满 '+ hm +' 个尾数');
});

$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_14"]:checked').val()==null){
		layer.msg('请先选择分类，在选择尾数！');
        return false;
	}
	$("input[name='ball[]']").attr('disabled', true);
	if ($("input[name='ball[]']:checked").length > num) {
		$("input[name='ball[]']:checked").attr('disabled', false);
		layer.msg('您最多可以选择'+ num +'个尾数！');
        return false;
	} else {
		$("input[name='ball[]']").attr('disabled', false);
		if ($("input[name='ball[]']:checked").length >= hm){
			$("input[name='ball[]']:checked").each(function() {
				checked.push($(this).val());
			});
			var zh = v = ''; qw = 0;
			if(hm==2){
				for (a=0;a<checked.length-1;a++){
					for (b=a+1;b<checked.length;b++){
						qw++;
						zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+'<br>';
					}
				}
			}
			if(hm==3){
				for (a=0;a<checked.length-2;a++){
					for (b=a+1;b<checked.length-1;b++){
						for (c=b+1;c<checked.length;c++){
							qw++;
							zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+'<br>';
						}
					}
				}
			}
			if(hm==4){
				for (a=0;a<checked.length-3;a++){
					for (b=a+1;b<checked.length-2;b++){
						for (c=b+1;c<checked.length-1;c++){
							for (d=c+1;d<checked.length;d++){
								qw++;
								zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+', '+name(checked[d])+'<br>';
							}
						}
					}
				}
			}
			if(hm==5){
				for (a=0;a<checked.length-4;a++){
					for (b=a+1;b<checked.length-3;b++){
						for (c=b+1;c<checked.length-2;c++){
							for (d=c+1;d<checked.length-1;d++){
								for (e=d+1;e<checked.length;e++){
									qw++;
									zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+', '+name(checked[d])+', '+name(checked[e])+'<br>';
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
function order() {
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
	if($('input:radio[name="ball_14"]:checked').val()==null){
		layer.msg('请先选择分类，在选择尾数！');
        return false;
	}
	if ($("input[name='ball[]']:checked").length < hm){
		layer.msg('请至少选择 '+ hm +' 个尾数！');
        return false;
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	var value='';
	for (var i = 0 ; i < checked.length ; i++ ){
		txt = txt + name(checked[i]) + ',';
		value =value+checked[i] + ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	value = value.substring(0,value.lastIndexOf(','));
	
	
	
	var bid = parseInt($('input:radio[name="ball_14"]:checked').val());
	balls = wan(bid);
	var t = balls + " 确定下注吗？\n\n下注明细如下：\n\n";
	var e = "\n\n单组注金 ￥"+m+"，组合共 "+ qw +" 组，总注金 ￥"+m*qw;
	//txt = t + txt + e;
	
		var txtarr=[];
	 txtarr[0] = {
		 	"contents":balls+':'+txt,
			"odds":$('#ball_14_o'+bid).text(),
			"amount":m,
			"ball": value,
			"zushu":qw,
			"ball_14":bid
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

function hnum(type) {
	var r = '';
	switch (type) {
		case 1 : r = 2; break;
		case 2 : r = 3; break;
		case 3 : r = 4; break;
		case 4 : r = 5; break;
	}
	return r;
}

function nums(type) {
	var r = '';
	switch (type) {
		case 1 : r = 6; break;
		case 2 : r = 6; break;
		case 3 : r = 6; break;
		case 4 : r = 6; break;
	}
	return r;
}

function o(type) {
	var r = 0;
	switch (type) {
		case 1 : r = 0; break;
		case 2 : r = 10; break;
		case 3 : r = 20; break;
		case 4 : r = 30; break;
	}
	return r;
}

function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '二尾连中'; break;
		case 2 : r = '三尾连中'; break;
		case 3 : r = '四尾连中'; break;
		case 4 : r = '五尾连中'; break;
	}
	return r;
}

function name(type) {
	var r = '';
	switch (type)
	{
		case '1' : r = '0尾'; break;
		case '2' : r = '1尾'; break;
		case '3' : r = '2尾'; break;
		case '4' : r = '3尾'; break;
		case '5' : r = '4尾'; break;
		case '6' : r = '5尾'; break;
		case '7' : r = '6尾'; break;
		case '8' : r = '7尾'; break;
		case '9' : r = '8尾'; break;
		case '10' : r = '9尾'; break;
	}
	return r;
}