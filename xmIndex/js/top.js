﻿function urlparent(url){
	window.open(url,"newFrame");
}

function game_ok(){
	if($(document).find("#username").length){ //没有登录
		alert("登录后才能进行此操作");
		return ;
	}else{
		alert("本游戏需联系客服");
	}
}

function lottery_ok(url){
	//if($(window.parent.document).find("#username").length){ //没有登录
		//alert("登录后才能进行此操作");
		//return ;
	//}else{
		window.location.href=url+'.php';
	//}
}

function url_bb(url){
	window.open(url,"iframepage"); 
}

function t_url(url){
    window.open(url,"iframepage"); 
}

document.write("<script language='javascript' src='../../box/artDialog.js?skin=default'></script>");
document.write("<script language='javascript' src='../../box/plugins/iframeTools.js'></script>");
function memberUrl(url) {
    art.dialog.open(url,{width:960,height:500,title:'会员中心'});
}

function menu_url(i){
    var index = top.document.getElementById("index");
    
    switch (i) {
        case 1:
            index.src = "myhome.php";
            break;
        case 2:
            index.src = "sports.php";
            break;
        case 3:
            index.src = "ssc.php?t=11"; //六合彩
			//index.src = "lotto/index.php?action=k_tm";
            break;
        case 4:
            index.src = "ssc.php?t=1"; //重庆时时彩
            break;
        case 18:
            index.src = "ssc.php?t=2"; //天津时时彩
            break;
        case 19:
            index.src = "ssc.php?t=3"; //北京赛车PK拾
            break;
        case 6:
            index.src = "ssc.php?t=8"; //北京快乐8
            break;
        case 8:
            index.src = "ssc.php?t=5"; //幸运飞艇
            break;
        case 5:
            index.src = "ssc.php?t=6"; //重庆幸运农场
            break;
        case 7:
            index.src = "ssc.php?t=10"; //排列三
            break;
		 case 75:
            index.src = "ssc.php?t=9"; //福彩3D
            break;
		case 76:
            index.src = "ssc.php?t=7"; //新疆时时彩
            break;
		case 77:
            index.src = "ssc.php?t=4"; //广东快乐十分
            break;
		case 766:
            index.src = "xy28.php?t=1"; //幸运28
            break;
		case 777:
            index.src = "xy28.php?t=2"; //加拿大28
            break;			
			
        case 17:
            index.src = "logout.php";
            break;
        case 9:
			memberUrl("member/sys_msg.php");
            break;
        case 10:
			memberUrl("member/password.php");
            break;
        case 11:
			memberUrl("member/set_money.php");
            break;
		case 111:
			memberUrl("member/hk_money.php");
            break;
        case 12:
			memberUrl("member/get_money.php");
            break;
        case 13:
			memberUrl("member/record_ty.php");
            break;
        case 14:
			memberUrl("member/report.php");
            break;
        case 15:
			memberUrl("member/agent.php");
            break;
        case 16:
			memberUrl("member/agent_reg.php");
            break;
        case 20:
			memberUrl("member/zr_money.php");
            break;
        case 21:
			memberUrl("member/zr_data_money.php");
            break;
		case 22:
			memberUrl("member/userinfo.php");
            break;
		case 51:
			memberUrl("member/set_jifen.php");
            break;
        case 61: //关于我们
            index.src = "myabout.php?code=gywm";
            break;
        case 62: //联系我们
            //index.src = "myabout.php?code=lxwm";
            window.open("tencent://message/?uin=78528260&Site=BY&Menu=yes", "_blank");
            break;
			 case 162: //联系我们
            //index.src = "myabout.php?code=lxwm";
            window.open("tencent://message/?uin=78528260&Site=BY&Menu=yes", "_blank");
            break;
        case 63: //合作伙伴
            index.src = "myjoin.php";
            break;
        case 64: //存款帮助
            index.src = "myck.php";
            break;
        case 65: //取款帮助
            index.src = "myqk.php";
            break;
        case 66: //常见问题
            index.src = "myproblem.php";
            break;
        case 67: //优惠活动
            index.src = "myhot.php";
            break;
        case 68: //彩票游戏
            index.src = "mylottery.php";
            break;
        case 69: //玩法介绍
            index.src = "myabout.php?code=wfjs";
            break;
        case 70: //会员注册
            index.src = "myreg.php";
            break;
        case 71: //手机投注
            //index.src = "mywap.php";
			index.src = "http://jnm.444nb.com";
            break;
        case 72: //负责任博彩
            index.src = "myabout.php";
            break;
        case 73: //真人娱乐
            index.src = "mylive.php";
            break;
        case 74: //底部联系我们
            index.src = "myconter.php";
            break;
        case 78:
            index.src = "games.php";
            break;
        case 41: //游戏规则
            //index.src = "clause.html";
			index.src = "myhome.php";
            break;
        case 411: //游戏规则
            //index.src = "clause.html";
			index.src = "/route.php";
            break;			
        default:
            index.src = "myhome.php";
    }
}
var deng={};
deng.gourl=function(a,b){
	var l='/';
	if(a!='') l+=a+'/';
	l+=b+'.'+'php';
	window.open(l,"index");
	}
function lottery_ok(url){
	//if($(window.parent.document).find("#username").length){ //娌℃湁鐧诲綍
		//alert("鐧诲綍鍚庢墠鑳借繘琛屾　鎿嶄綔");
		//return ;
	//}else{
		window.location.href=url+'.php';
	//}
}

function showNewWin(url, dwidth, dheigh) {
    if(dwidth == "" || dwidth == null) {
        dwidth = 800;
    }
    if(dheigh == "" || dheigh == null) {
        dheigh = 600;
    }
    var iTop = (window.screen.availHeight - 30 - dheigh) / 2;       //获得窗口的垂直位置;
    var iLeft = (window.screen.availWidth - 10 - dwidth) / 2;           //获得窗口的水平位置;
    window.open(url, "", 'height=' + dheigh + ',innerHeight=' + dheigh + ',width=' + dwidth + ',innerWidth=' + dwidth + ',top=' + iTop + ',left=' + iLeft + ',toolbar=no,menubar=no,scrollbars=yes,resizeable=yes,location=no,status=no');
}

function aLeftForm1Sub(obj){
    var un	=	$("#username").val();
    var pw	=	$("#passwd").val();
    var vc	=	$("#rmNum").val();
    var dd	=	$("#rmNumm").val();	//新加登录
    var opt = {
        beforeSubmit: function() {
            if(un == "" || un == "用户名"){
                $("#username").focus();
                alert("用户名请务必输入！");
                return false;
            }
            if(pw == "" || pw == "******"){
                $("#passwd").focus();
                alert("密码请务必输入！");
                return false;
            }
            if(vc == "" || vc == "验证码" || vc.length<4){
                $("#rmNum").focus();
                alert("验证码请务必输入！");
                return false;
            }
            if(pw == "" || dd == "会员登录"){    //新加登录
                $("#rmNumm").focus();
                alert("用户名请务必输入！");
                return false;
            }		
            $("#formsub").attr("disabled",true); //按钮失效
        },
        url: "logincheck.php",
        data: {r:Math.random(),action:"login",vlcodes:vc,username:un,password:pw},
        success: function(login_jg) {
            if(login_jg.indexOf("1")>=0){ //验证码错误
                alert("验证码错误，请重新输入");
                $("#rmNum").val("").focus();
                document.getElementById("vPic").src = "yzm.php?"+Math.random();
                $("#formsub").attr("disabled",false); //按钮有效
            }else if(login_jg.indexOf("2")>=0){ //用户名称或密码
                alert("用户名或密码错误，请重新输入");
                $("#rmNum").val(""); //清空验证码
                $("#passwd").val(""); //清空验证码
                $("#username").val("").focus();
                document.getElementById("vPic").src = "yzm.php?"+Math.random();
                $("#formsub").attr("disabled",false); //按钮有效
            }else if(login_jg.indexOf("3")>=0){ //停用，或被删除，或其它信息
                alert("账户异常无法登陆，如有疑问请联系在线客服");
                $("#formsub").attr("disabled",false); //按钮有效
            }else if(login_jg.indexOf("4")>=0){ //登陆成功
                top.location.href = "/route.php";
            }
        }
    };
    obj.ajaxSubmit(opt);
}