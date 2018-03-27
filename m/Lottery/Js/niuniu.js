var bool = auto_new = false;
var sound_off = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var g_type = 0;
var p_sound = false;
//////////////////开奖号转换成牛牛/////////
function getStatusTxt(codes){
        var ret = getStatus(codes);
       
        if(ret>=700){
            return '五小牛';
        }
        if(ret>=600){
            return '炸弹 ';
        }
    if(ret>=500){
            return '金牛';
        }
  
        if(ret>=100){
            var names = ['牛','一','二','三','四','五','六','七','八','九'];
            return '牛'+names[ret%10];
        }
        return '无牛';
    }


    function codesort(arr,n,m){
        var i,r=0,_vn = arr[n],_vm = arr[m];
        _vn
        for(var i=0;i<5;++i){
            n!=i&&m!=i&&(arr[r++]=arr[i]);
        }
        arr[3] = _vn;
        arr[4] = _vm;
    }
  function getStatus($codes){
        var fn_sort = function compare(v1,v2){
            if((v1*1)>(v2*1)){
                return 1;
            }else if(v1 == v2){
                return 0;
            }
            return -1;
        } 
        $codes.sort(fn_sort);
        $codes[0] *= 1,$codes[1] *= 1,$codes[2] *= 1,$codes[3] *= 1,$codes[4] *= 1;
        var $a1 = [],$b1 = [],$isTH,$isSZ;
        for(var i in $codes){
            $a1.push(Math.floor($codes[i]/4)+1);
            $b1.push($codes[i]%4);
        }
       // $isTH = ( $b1[4]==$b1[3]&&$b1[3]==$b1[2]&&$b1[2]==$b1[1]&&$b1[1]==$b1[0]);
        //$isSZ = (($a1[4]-$a1[3])==1&&($a1[3]-$a1[2])==1&&($a1[2]-$a1[1])==1&&($a1[1]-$a1[0])==1);
        //同花顺
        if($isTH&&$isSZ)return 800+$codes[4];
        //小小牛 总点不超过10
        if(($a1[0]+$a1[1]+$a1[2]+$a1[3]+$a1[4])<10)return 700+$codes[4];
        //金牛 五张花牌
      
        var $testNum = {},$max = 0,$maxCode = 0,$v,n=0;
        for(i in $a1){
            $v = $a1[i];
            if(!$testNum[$v]){
                $testNum[$v] = 1;
                ++n;
            }else{
                ++$testNum[$v];
            }
            if($testNum[$v]>$max){
                $maxCode = $v;
                $max = $testNum[$v];
            }
        }
        //炸弹
        if($max==4)return 600+$maxCode;
	   if($a1[0]>10&&$a1[1]>10&&$a1[2]>10&&$a1[3]>10&&$a1[4]>10) return 500+$codes[4];
        //三带对
      
        if($isTH)return 300+$codes[4];
        //顺子
        if($isSZ)return 200+$codes[4];
        //牛
        for(i in $a1){
            $v = $a1[i];
            $a1[i]=$v>10?10:$v;
        }
        $ret = 0;
        if(($a1[0]+$a1[1]+$a1[2])%10==0){
            $ret = $a1[3]+$a1[4];
        }else if(($a1[0]+$a1[1]+$a1[3])%10==0){
            codesort($codes,2,4);
            $ret = $a1[2]+$a1[4];
        }else if(($a1[0]+$a1[2]+$a1[3])%10==0){
            codesort($codes,1,4);
            $ret = $a1[1]+$a1[4];
        }else if(($a1[1]+$a1[2]+$a1[3])%10==0){
            codesort($codes,0,4);
            $ret = $a1[0]+$a1[4];
        }else if(($a1[0]+$a1[1]+$a1[4])%10==0){
            codesort($codes,2,3);
            $ret = $a1[2]+$a1[3];
        }else if(($a1[0]+$a1[2]+$a1[4])%10==0){
            codesort($codes,1,3);
            $ret = $a1[1]+$a1[3];
        }else if(($a1[1]+$a1[2]+$a1[4])%10==0){
            codesort($codes,0,3);
            $ret = $a1[0]+$a1[3];
        }else if(($a1[0]+$a1[3]+$a1[4])%10==0){
            codesort($codes,1,2);
            $ret = $a1[1]+$a1[2];
        }else if(($a1[1]+$a1[3]+$a1[4])%10==0){
            codesort($codes,0,2);
            $ret = $a1[0]+$a1[2];
        }else if(($a1[2]+$a1[3]+$a1[4])%10==0){
            codesort($codes,0,1);
            $ret = $a1[0]+$a1[1];
        }
        if(!$ret){
            //无牛
            $ret = $codes[4];
        }else{
            //有牛
            $ret = $ret%10;
            //牛牛
            if($ret==0){$ret = 10;}
            $ret += 100;
        }
        return $ret;
    }





var arr=[28,29,31,36,39];

////////////////////

console.log(arr);
console.log(getStatus(arr));
console.log(getStatusTxt(arr));
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

    g_type = type;
	$.post("class/odds_252.php", function(data) {
		if(data.opentime > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
			ball_odds = data.oddslist;
		
			endtime(data.opentime);
			auto(type);
		} else {
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
	for(var i = 1; i < 12; i++) {
		if(i == 6) {
			for(var s = 1; s < 8; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i >= 7 && i <= 9) {
			for(var s = 1; s < 10; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i >= 1 && i <= 5) {
			for(var s = 1; s < 15; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i == 10) {
			for(var s = 1; s < 16; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i == 11) {
			for(var s = 1; s < 9; s++) {
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
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"loadSet(this)\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
	if(ball >= 1 && ball <= 11) {
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
    if(iTime <= 10) {
        $(".bian_td_odds").html("--");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo(g_type);
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
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}
rf_time(9);
//刷新时间
function rf_time(time) {
    var rf = $("#rf_time");
    var fp = $("#fp_time");
    if(time < 0) {
        clearTimeout(c_rf);
        if(fp.html() != "00:00") {
            rf.html("载入中...");
            $.post("class/odds_252.php", function(data) {
                var qihao = $("#open_qihao").html();
                if(qihao == data.number) {
                    loadodds(data.oddslist, true);
                }
                rf_time(9);
            }, "json");
        } else {
            rf_time(9);
        }
    } else {
        rf.html(time + "秒");
        time--;
        c_rf = setTimeout("rf_time(" + time + ")", 1000);
    }
}


//更新开奖号码
function auto(ball) {
////////console.log('ball'+ball);
    var win_parent = $(window.parent.document);
    var kj_qishu =  win_parent.find("#result_info");
	var openqishu =( parseInt($('#curissue').html())-2).toString();
    $.post("class/auto_252.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
       var qihao = kj_qishu.html().replace(/[^0-9]/ig,"").toString();
	//console.log(data.kj_list.length);//console.log(qihao);//console.log(data.kj_list[0]['qishu']); //console.log(openqishu);
        if(data.kj_list.length > 0 && qihao != data.kj_list[0]['qishu']) {
		if(qihao== openqishu){
		  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音
		  window.parent.document.getElementById('hk_mp3').innerHTML= "<embed src='/date/kaijiang.mp3' width='0' height='0'></embed>";
		}
            var new_qh = '';
            var new_hm = '';
			var new_hm2='';
            var ls_kj = '';
            ls_kj += '<tr>';
            ls_kj += '<td width="25%">期号</td><td width="15%">庄</td><td width="12%">天</td><td width="12%">地</td><td width="12%">玄</td><td width="12%">黄</td>';
            ls_kj += '</tr>';
			///////////////开奖结果类型//////////////////
			////////console.log(data.kj_list[0]);/////console.log(data.kj_list[1]);
			var b1=parseInt(data.kj_list[0]['ball_1']);
			var b2=parseInt(data.kj_list[0]['ball_2']);
			var b3=parseInt(data.kj_list[0]['ball_3']);
			var b4=parseInt(data.kj_list[0]['ball_4']);
			var b5=parseInt(data.kj_list[0]['ball_5']);
		
           var hz =parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
		   var hzdx= '',hzds='';var b1lh,b2lh,b3lh,b4lh,b5lh;
		   if(hz>22){
			   hzdx='大';
			   }else{
				  hzdx='小';   				   
				   }
		    if(hz%2==0){
			   hzds='双';
			   }else{
				  hzds='单';   				   
				   }
				   
			if(b1>b5){
				b1lh='龙';
				}else if(b1==b5){
					b1lh='和';
					}else{
						b1lh='虎';
					}
				   
		   

			////////////////////////////////
		
	
		
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="ssc">';
                var sum = 0;
                for(var j in data.kj_list[i]) {
					var k=0;
                    if(i == 0) {
                        if(j == 'qishu') {
                            new_qh = data.kj_list[i][j];
                        } else {
                            new_hm += '<em class="n_' + getStatusTxt(data.kj_list[i][j].split(',')) + '"></em>';
						    new_hm2 += '<span><b class="b'+j+'">'+getStatusTxt(data.kj_list[i][j].split(','))+'</b></span>';
							
							k++;
                        }
                    }
                    if(j == 'qishu') {
                        ls_kj += '<td>' + data.kj_list[i][j].substr(-3) + '</td>';
                    } else {
                        sum += Number(data.kj_list[i][j]);
						
                        ls_kj += '<td num="' + getStatusTxt(data.kj_list[i][j].split(',')) + '" set="true"><i class="n_' + getStatusTxt(data.kj_list[i][j].split(',')) + '">' + getStatusTxt(data.kj_list[i][j].split(',')) + '</i></td>';
                     
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
	
	var str =new_hm2+'<div class="result_stat clearfix"><div class="statitm">'+getStatusTxt(data.kj_list[0]['ball_1'].split(','))+'</div><div class="statitm">'+getStatusTxt(data.kj_list[0]['ball_2'].split(','))+'</div><div class="statitm">'+getStatusTxt(data.kj_list[0]['ball_3'].split(','))+'</div><div class="statitm">'+getStatusTxt(data.kj_list[0]['ball_4'].split(','))+'</div><div class="statitm">'+getStatusTxt(data.kj_list[0]['ball_5'].split(','))+'</div></div>'
			
			var kjqh ='<div>百人牛牛</div><div>'+new_qh+'期开奖</div></div>';
		 $("#result_info", parent.document).html(kjqh);
		 $("#result_balls", parent.document).html(str);
		 $("#result_balls", parent.document).css("margin-top","-5px");
		  $("#result_balls", parent.document).removeClass();
		 $("#result_balls", parent.document).addClass("T_niuniu L_CQSSC");
			
			
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("百人牛牛");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
            var tj = $("#tongji");
            if(tj.length > 0 && data.tongji != null) {
                var str = '<tr>';
                for(var i in data.tongji) {
                    str += '<td>' + data.tongji[i] + '</td>';
                }
                str += '</tr>';
                tj.html(str);
            }
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
                time: 5000
            });*///////setTimeout("auto(" + g_type + ")", 10000);
        } else {
            ///$("#play_sound").html('');
			  window.parent.document.getElementById('hk_mp3').innerHTML=""; //先清空，再添加提示声音   
			  setTimeout("auto(" + g_type + ")", 10000);
        }
    }, "json");
}

/*//////获取历史开奖
function history(ball) {
    $.post("class/auto_20.php", {ball: ball}, function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="7">';
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'cqssc\', 0, this);">号码</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'cqssc\', 1, this);">大小</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'cqssc\', 2, this);">单双</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="25%">期号</td><td width="12%">一</td><td width="12%">二</td><td width="12%">三</td><td width="12%">四</td><td width="12%">五</td><td width="15%">总和</td>';
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
                        if(j == 'ball_5') {
                            ls_kj += '<td sum="1" num="' + sum + '" set="true" class="sum"><i class="n_' + sum + '">' + sum + '</i></td>';
                        }
                    }
                }
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("niuniu");
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
//	/////console.log($("#open_qihao").text());
   // $("#orders").ajaxSubmit(opt);
}

//读取第几球
function did(type) {
	var r = '';
	switch (type) {
		case 1 : r = '第一球'; break;
		case 2 : r = '第二球'; break;
		case 3 : r = '第三球'; break;
		case 4 : r = '第四球'; break;
		case 5 : r = '第五球'; break;
		case 6 : r = '总和、龙虎和'; break;
		case 7 : r = '前三'; break;
		case 8 : r = '中三'; break;
		case 9 : r = '后三'; break;
		case 10 : r = '斗牛'; break;
		case 11 : r = '梭哈'; break;
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
		case 6 : r = '大'; break;
		case 7 : r = '小'; break;
		case 8 : r = '单'; break;
		case 9 : r = '双'; break;
	}
	return r;
}

//读取玩法
function wan10(type) {
	var r = '';
	switch (type) {
		case 1 : r = '没牛'; break;
		case 2 : r = '牛1'; break;
		case 3 : r = '牛2'; break;

		case 4 : r = '牛3'; break;
		case 5 : r = '牛4'; break;
		case 6 : r = '牛5'; break;
		
		case 7 : r = '牛6'; break;
		case 8 : r = '牛7'; break;
		case 9 : r = '牛8'; break;
		
		case 10 : r = '牛9'; break;
		case 11 : r = '牛牛'; break;
		case 12 : r = '牛大'; break;
		
		case 13 : r = '牛小'; break;
		case 14 : r = '牛单'; break;
		case 15 : r = '牛双'; break;
	}
	return r;
}

//读取玩法
function wan11(type) {
	var r = '';
	switch (type) {
		case 1 : r = '五条'; break;
		case 2 : r = '四条'; break;
		case 3 : r = '葫芦'; break;

		case 4 : r = '顺子'; break;
		case 5 : r = '三条'; break;
		case 6 : r = '两对'; break;
		
		case 7 : r = '一对'; break;
		case 8 : r = '散号'; break;
	}
	return r;
}