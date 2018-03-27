function _getYear(d){
	var yr=d.getYear();
	if(yr<1000) yr+=1900;
	return yr;
}

function tick(){
	function initArray(){
		for(i=0;i<initArray.arguments.length;i++) this[i]=initArray.arguments[i];
	}
	var isnDays=new initArray("星期日","星期一","星期二","星期三","星期四","星期五","星期六","星期日");
	var today=new Date();
	var hrs=today.getHours();
	var _min=today.getMinutes();
	var sec=today.getSeconds();
	var clckh=""+((hrs>12)?hrs-12:hrs);
	var clckm=((_min<10)?"0":"")+_min;clcks=((sec<10)?"0":"")+sec;
	var clck=(hrs>=12)?"下午":"上午";
	
	//document.getElementById("t_2_1").innerHTML = _getYear(today)+"/"+(today.getMonth()+1)+"/"+today.getDate()+"&nbsp;"+clckh+":"+clckm+":"+clcks+"&nbsp;"+clck+"&nbsp;"+isnDays[today.getDay()];
	document.getElementById("t_2_1").innerHTML = _getYear(today)+"/"+(today.getMonth()+1)+"/"+today.getDate()+"&nbsp;"+clckh+":"+clckm+":"+clcks;
	
	window.setTimeout("tick()", 100); 
}

var disnum=0;
function urlOnclick(url,i){
	window.open(url,"mainFrame");  
	if(i >= 0){
		disnum = i;
		var as = document.getElementById("menu").getElementsByTagName("a");
		for(var s=0; s<as.length; s++){
			if(s == i){
				as[s].className = "homemenu";
			}else{
				as[s].className = "alink";
			}
		}
	}
}


function turl(i){
	if(i==0){		//体育
		window.open("/show/ft_danshi.html","mainFrame");  
		window.open("/left.php","leftFrame");  	
	}else{			//乐透
		window.open("/lotto/index.php?action=k_tm","mainFrame");  
		window.open("/lotto/left.php","leftFrame");  
	}
	
}

function urlparent(url){
	window.open(url,"newFrame");
}

function topMouseEvent(mi,ty,i){
	if(ty == "o" && i != disnum){
		mi.className = "homemenua";
	}else if(ty == "t" && i != disnum){
		mi.className = "alink";
	}
}

$(document).ready(function(){
	$("#vlcodes").focus(function(){
		document.getElementById("checkNum_img").src = 'yzm.php?'+Math.random(); //更换验证码
	});
});


function aLeftForm1Sub(){
	var un	=	$("#username").val();
	if(un == "" || un == "帐户"){
		$("#username").focus();
		return false;
	}
	var pw	=	$("#password").val();
	if(pw == "" || pw == "******"){
		$("#password").focus();
		return false;
	}
	var vc	=	$("#vlcodes").val();
	if(vc == "" || vc == "验证码" || vc.length<4){
		$("#vlcodes").focus();
		return false;
	}
	
	$("#formsub").attr("disabled",true); //按钮失效
	
	$.post("logincheck.php",{r:Math.random(),action:"login",vlcodes:vc,username:un,password:pw},function(login_jg){
		if(login_jg.indexOf("1")>=0){ //验证码错误
			alert("验证码错误，请重新输入");
			$("#vlcodes").select();
		}else if(login_jg.indexOf("2")>=0){ //用户名称或密码
			alert("用户名或密码错误，请重新输入");
			$("#vlcodes").val(''); //清空验证码
			$("#password").val(''); //清空验证码
			$("#username").select();
		}else if(login_jg.indexOf("3")>=0){ //停用，或被删除，或其它信息
			alert("账户异常无法登陆，如有疑问请联系在线客服");
		}else if(login_jg.indexOf("4")>=0){ //登陆成功
			window.location.href='top.php';
			//parent.mainFrame.location.href='show/shouye.php';
			parent.leftFrame.window.location.reload();
		}	
		//alert(login_jg);											 
		$("#formsub").attr("disabled",false); //按钮有效
	});
}

function get_dled(){
	$.getJSON("getDLED.php?callback=?",function(json){
		$("#dled").html("("+json.dled+")");
	});
}