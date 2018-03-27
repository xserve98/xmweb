// JavaScript Document
$(window).load(function() {
	action();
});

function action(){
    $.getJSON("systopDao.php?callback=?",function(json){
			var sum = json.sum;
			if(sum > 0){
				var html = "您有：";
				
				if(json.tknum > 0){
					html += "<span class=\"num\">"+json.tknum+"</span> 条<strong>提款</strong> ";
					$("hk_mp3").html(""); //先清空，再添加提示声音
					document.getElementById('hk_mp3').innerHTML= "<embed src='/date/tk.mp3' width='0' height='0'></embed>";
				}
				if(json.hknum > 0){
					html += "<span class=\"num\">"+json.hknum+"</span> 条<strong>汇款</strong> ";
					$("#hk_mp3").html(""); //先清空，再添加提示声音
					//$("#hk_mp3").html("<bgsound src='/date/hk.mp3' loop='1'>"); //汇款提示声音
					document.getElementById('hk_mp3').innerHTML= "<embed src='/date/hk.mp3' width='0' height='0'></embed>";//汇款提示声音
				}
				if(json.ssnum > 0){
					html += "<span class=\"num\">"+json.ssnum+"</span> 条<strong>申诉</strong> ";
				}
				if(json.dlsqnum > 0){
					html += "<span class=\"num\">"+json.dlsqnum+"</span> 条<strong>代理申请</strong> ";
				}
				if(json.tsjynum > 0){
					html += "<span class=\"num\">"+json.tsjynum+"</span> 条<strong>投诉建议</strong> ";
				}
				if(json.ychynum > 0){
					html += "<span class=\"num\">"+json.ychynum+"</span> 个<strong>异常会员</strong> ";
				}
				if(json.cgnum > 0){
					html += "<a href=\"zdgl/cg_kjs.php\" target=\"mainFrame\"><span class=\"num\">"+json.cgnum+"</span> 条<strong>串关可结算</strong></a> ";
				}
				if(json.ycaglive > 0){
					html += "[AG真人可能已掉线,请检查] ";
					$("#hk_mp3").html(""); //先清空，再添加提示声音
					document.getElementById('hk_mp3').innerHTML= "<embed src='/date/zr.wav' width='0' height='0'></embed>";//汇款提示声音
				}
							
				html += "信息未处理！";
				$("#m_xx").html(html);
				$("#tisi").css("display","block");
			}else{
				$("#m_xx").html("");
				$("#tisi").css("display","none");
			}
		}
	);
	
	setTimeout("action()",30000); //30秒检测一次
}

