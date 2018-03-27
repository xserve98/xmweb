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
			$("#odds").html("-");
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
            $("#odds").html("-");
            return false;
		}
		var odds = oddslist.ball[12][i];
        $("#odds").html(odds);
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

$('input[type=checkbox]').click(function() {
	var checked = [];
	$("input[name='ball[]']").attr('disabled', true);
	if ($("input[name='ball[]']:checked").length > 11) {
		$("input[name='ball[]']:checked").attr('disabled', false);
		layer.msg('您最多可以选择11个生肖！');
        return false;
	} else {
		$("input[name='ball[]']").attr('disabled', false);
		if ($("input[name='ball[]']:checked").length >= 2){
			$("input[name='ball[]']:checked").each(function() {
				checked.push($(this).val());
			});
			var s1 = $("input[name='ball[]']:checked").length;
			oddsInfo(s1-1);
		}else{
			$(".h_inp").html('&nbsp;');
            $("#odds").html("-");
		}
	}
});

//投注提交
function order() {
	var balls = '', arr = new Array(), c = true;
    var cou =  0, txt = '', m = 0,value='';
    var tz_money = $("#kj_money");

	if (tz_money.val() != "" && tz_money.val() != null) {
		m = parseInt(tz_money.val());
	}
	if (m <= 0) {
        layer.msg('请输入下注金额！');
        return false;
    }
	if ($("input[name='ball[]']:checked").length < 2){
        layer.msg('请至少选择 2 个生肖！');
        return false;
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	for (var i = 0 ; i < checked.length ; i++) {
		txt = txt + name(checked[i]) + ',';
		value = value+checked[i]+ ',';
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	var t = "合肖 确定下注吗？\n\n下注明细如下：\n\n";
	var e = "\n\n注金 ￥"+m;
	//txt = t + txt + e;
	
	var txtarr=[];

	 txtarr[0] = {
		 	"contents":'合肖'+':'+txt,
			"odds":$('#odds').text(),
			"amount":m,
			"ball": value.substring(0,value.length-1),
					   }
	
  ///////console.log(txtarr);
	
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
   /// $("#orders").ajaxSubmit(opt);
   
   var data={
			 lottery:  '/Six/order/order.php?type=0&class=12',
             drawNumber: $("#open_qihao").text(),
             bets: txtarr
			}
			
	  ///console.log(data);
		parent.showBets(data);
		formReset();
   
}

function name(type) {
	var r = '';
	switch (type) {
		case '1' : r = '鼠'; break;
		case '2' : r = '牛'; break;
		case '3' : r = '虎'; break;
		case '4' : r = '兔'; break;
		case '5' : r = '龙'; break;
		case '6' : r = '蛇'; break;
		case '7' : r = '马'; break;
		case '8' : r = '羊'; break;
		case '9' : r = '猴'; break;
		case '10' : r = '鸡'; break;
		case '11' : r = '狗'; break;
		case '12' : r = '猪'; break;
	}
	return r;
}