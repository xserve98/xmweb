!function($){


    // 登陆
    myAjax.get('login',{
        url: '/Index/login',
    }).bind(function(data){
        if(data.status=='ok'){
            $topbar.fadeOut('fast',function(){
                $(this).empty().html('<div class="nav_container" id="topbar-user" style="text-align:right;"> <span class="top_username">您好! '+data.username+'</span> <span class="top_leftmoney"><span style="display:none;"><span class="top_moneytext">余额 : '+data.leftmoney+'元</span> <a href="#" class="leftmoney_show">隐藏</a></span><span>余额已隐藏 <a href="#">显示</a></span></span> <span class="top_btnplug"> 我的账户 > <div class="top_plugbox"> <a href="/Service/personal">个人中心</a> <a href="/User/histplay">投注记录</a> <a href="/User/record">账户明细</a> <a href="/User/mysafe">安全中心</a> </div> </span> <span class="top_btnlink"> <a href="/User/fund" class="actlink">充值</a> | <a href="/User/withdraw" class="actlink">提现</a> | <a href="/Index/logout" class="actlink">退出</a> </span> </div>').fadeIn('fast');
                window.userId=data.username;
                bindevent();
                layer.alert('欢迎回来:'+data.username,{icon:1});
            });
        }else{
            layer.alert(data.msg,{icon:2},function(_id){
                layer.close(_id);
                myAjax.get('loginbox').fire(data.needcheck?'check':'show');
            });
        }
    });



    myAjax.get('ready').bind(bindevent);

    var login_action=function(_lid){
        var user=$('#login-user').val();
        var pass=$('#login-pass').val();
        var check=$('#login-check').val();
        if(user.length<4){
            layer.tips('请输入用户名', '#login-user');
            return;
        }
        if(pass.length<4){
            layer.tips('请输入密码', '#login-pass');
            return;
        }
        if($('#login-check').length&&check.length<4){
            layer.tips('请输入验证码', '#login-check');
            return;
        }
        if(!check)check='';
        myAjax.get('login').load({data:{username:user,password:pass,checkcode:check}});
        layer.close(_lid);
    };
    //登陆框
    myAjax.get('loginbox').bind(function(data){
        var htmls='<div class="login-form" style="overflow:hidden"><div class="login-item"><span>用户名:</span><input id="login-user" type="text" value="" /></div>';
        htmls+='<div class="login-item"><span >密码:</span><input id="login-pass" type="password" value="" /></div>';
        if(data=='check'){
            htmls+='<div class="login-item"><span>验证码:</span><input id="login-check" type="text" value="" style="width:64px;" /><img src="/Verify" style="cursor:pointer;" onclick="this.src=\'/Verify?_t=\' + Math.random();"></div>';
        }
        htmls+='<div class="login-item clearfix"><a href="/Index/regist" class="betlink">没有账号?</a><a href="/Index/regist" class="betlink link-forget">忘记密码?</a></div></div>';
        layer.open({type:1,area:['320px'],content:htmls,title:'请登陆',move:false,btn:['马上登陆','返回'],yes:login_action});
    });
}(jQuery);

$(document).ready(function(){
    $.myAjax.get('ready').fire(1);
    $.myAjax.get('money').load();
});