$(document).ready(function(){

	$(window).resize(function(){
        chaneSliderWidth();
    })
    chaneSliderWidth();

    function chaneSliderWidth(){
        var window_width=$(window).width();
        if(window_width>=1100){
            var jian_height=-(1920-window_width)/2;
            $(".login_img,.yun_img").css("margin-left",jian_height);
            $(".login_img,.yun_img").css("margin-right",jian_height);
            $(".login,.yun").addClass("overflow");
            $(".login_back,.yun_back").removeClass("overflow");
            $(".login_back,.yun_back").css("width",window_width);
        }else{
            var jian_height=-(1920-1100)/2;
            $(".login_img,.yun_img").css("margin-left",jian_height);
            $(".login_img,.yun_img").css("margin-right",jian_height);
            $(".login,.yun").removeClass("overflow");
            $(".login_back,.yun_back").addClass("overflow");
            $(".login_back,.yun_back").css("width","1100px");
        }
    };

	$(document).keyup(function(event){  
		if(event.keyCode ==13){  
			$(".button").trigger("click");  
		}
	});  

	$(".button").on("click",function(){
		var name=$(".name").val();
		var pwd=$(".pwd").val();
		if(name=="" || name==null || name==undefined){
			alert("登录名不能为空");
		}else if(name.length<6 || name.length>15){
			alert("请输入6-15位的登录名");
		}else if(pwd=="" || pwd==null || pwd==undefined){
			alert("密码不能为空");
		}else if(pwd.length<6 || pwd.length>20){
			alert("请输入6-20位的密码");
		}else{
			alert("登录成功");
		}
	});

});