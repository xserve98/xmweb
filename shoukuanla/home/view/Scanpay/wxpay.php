<?php 
/*
功能：实现微信扫码自动充值
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/

if(empty($post['titleShort'])){  exit; }
?>

<!DOCTYPE HTML>
<html>
<head>
<title>微信 - 网上支付 安全快速！</title>
<meta charset="utf-8" />
<meta name="keywords" content="微信扫码付款" />
<meta name="description" content="微信扫码付款" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link charset="utf-8" rel="stylesheet" href="<?php echo SKL_WEBROOT_PATH; ?>css/sklcss.css" media="all" />
<script charset="utf-8" src="<?php echo SKL_WEBROOT_PATH; ?>js/jquery-1.11.3.min.js"></script>

<style>
.copy{
	background-image: url(<?php echo SKL_WEBROOT_PATH; ?>images/copy.jpg);
	background-repeat: no-repeat;
	height: 350px;
	width: auto;
	margin-right: auto;
	margin-left: auto;
	text-align: left;
}
.inputEmail { width: 30px; padding-left: 163px; padding-top: 108px; }
.inputsty{ font-size: 16px; width: 230px; height: 28px; }



    #header {
        height: 60px;
        background-color: #fff;
        border-bottom: 1px solid #d9d9d9;
        margin-top: 0px;
    }
    #header .header-title {
        width: 250px;
        height: 60px;
        float: left;
    }
    #header .logo {
        float: left;
        height: 31px;
        width: 95px;
        margin-top: 14px;
        text-indent: -9999px;
        background: none; !important
    }
    #header .logo-title {
        font-size: 16px;
        font-weight: normal;
        font-family: "Microsoft YaHei",微软雅黑,"宋体";
        border-left: 1px solid #676d70;
        color: #676d70;
        height: 20px;
        float: left;
        margin-top: 15px;
        margin-left: 10px;
        padding-top: 10px;
        padding-left: 10px;
    }
    .header-container {
        width: 950px;
        margin: 0 auto;
    }

    body,
    #footer{
        background-color: #eff0f1;
    }

    #footer #ServerNum {
        color: #eff0f1;
    }
    .login-switchable-container {
        background-color: #fff;
    }

    #order.order-bow .orderDetail-base,
    #order.order-bow .ui-detail {
        border-bottom: 3px solid #bbb;
        background: #eff0f1;
        color: #000;
    }

    .order-ext-trigger {
        position: absolute;
        right: 20px;
        bottom: 0;
        height: 22px;
        padding: 2px 8px 1px;
        font-weight: 700;
        border-top: 0;
        background: #b3b3b3;
        z-index: 100;
        color: #fff;
    }

    #partner {
        margin-top: 0;
        padding-top: 0;
        background-color: #eff0f1;
    }

    #order.order-bow .orderDetail-base, #order.order-bow .ui-detail {
        border-bottom: 3px solid #b3b3b3;
    }

    .payAmount-area {
        bottom: 36px;
    }

    .alipay-logo {
        display: block;
        width: 114px;
        position: relative;
        left: 0;
        top: 10px;
        float: left;
        height: 40px;
        background-position: 0 0;
        background-repeat: no-repeat;
        background-image: url(<?php echo SKL_WEBROOT_PATH; ?>images/wxlogo.png);
    }
</style>
 
<div class="topbar">
    <div class="topbar-wrap fn-clear">

        		<span class="topbar-link-first">你好，欢迎使用微信付款！</span>
		    </div>
</div>

<div id="header">
    <div class="header-container fn-clear">
        <div class="header-title">
            <div class="alipay-logo"></div>
            <span class="logo-title">我的收银台</span>
        </div>
    </div>
</div>
<div id="container">



<style>

.ui-securitycore .ui-label, .mi-label {
    text-align: left;
    height: auto;
    line-height: 18px;
    padding: 0;
    display: block;
    padding-bottom: 8px;
    margin: 0;
    width: auto;
    float: none;
    font:14px/1.5 tahoma,arial,\5b8b\4f53;
}

.ui-securitycore .ui-form-item {
    position: relative;
    padding: 0 0 10px 0;
    width: 350px;

}

.ui-securitycore .ui-form-explain {
    height: 18px;
    /*display: block;*/
    font-family:tahoma,arial,\5b8b\4f53;
}

.ui-securitycore .edit-link {
    position: absolute;
    top: -3px;
    right: 0;
}

.ui-securitycore .ui-input {
    height: 28px;
    font-size: 14px;
}

.ui-securitycore .standardPwdContainer .ui-input {
    width: 340px;
}

.ui-securitycore .mobile-section.checkcode-section {
    margin-top: 10px;
}

/*安全服务化必将覆盖的样式*/
.mobile-form .ui-securitycore .ui-form-item-mobile {
    display: none;
}

.mobile-form .ui-securitycore .ui-form-item-mobile .ui-label {

}

.mobile-form .ui-securitycore .ui-form-item-mobile .ui-form-text {
    display: none;
}

.mobile-form .ui-securitycore .ui-form-item-counter {
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 20px;
    position: relative;
    height: 87px;
}

.mobile-form .ui-securitycore .ui-form-item-counter .ui-label {
    display: block;
    float: none;
    margin-left: 0;
    text-align: left;
    line-height: 18px !important;
    padding: 0 0 8px 0;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field {
    /*display: block;*/
    zoom: 1;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-input {
    height: 24px;
    line-height: 24px;
    width: 148px;
    border: 1px solid #ccc;
    padding: 7px 10px;
    float: left;
    display: block;
    font-size: 14px;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-input:focus {
    color: #4d4d4d;
    border-color: #07f;
    outline: 1px solid #8cddff;
}
.mobile-form .ui-securitycore .ui-form-item-counter .eSend-btn {
    float: left;
    color: #08c;
}

#mobileSend {
    position: absolute;
    right: 0;
    top: 26px;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-messagecode-btn {
    float: left;
    width: 178px;
    height: 40px;
    _height: 38px;
    line-height: 38px;
    _line-height: 35px;
    color: #676d70;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 1px;
    background: #f3f3f3;
    margin-left: 2px;
    padding-left: 0;
    padding-right: 0;

}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-messagecode-disabled-btn {
    background: #cacccd;
    border: 1px solid #cacccd;
    color: #aeb1b3;
    font-weight: normal;
    cursor: default;
}

.mobile-form .ui-securitycore .ui-form-item-counter .reSend-btn {
    float: left;
    margin-top: 10px;
    color: #08c;
}

.ui-checkcode-messagecode-disabled-btn {

}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field {
    display: block;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field .fn-hide,
.mobile-form .ui-securitycore .ui-form-item-counter .fn-hide .reSend-btn {
    display: none;
}

/*安全服务化必将覆盖的样式*/


.alieditContainer object {
    width: 348px;
    height:38px;
}

#container .alieditContainer {
    width: 348px;
    height: 38px;
}

#container .alieditContainer a.aliedit-install {
    line-height: 38px;
}

/* 安全服务化去控件升级 特木 temu.psc@alipay.com */
#container .alieditContainer .ui-input {
    width:324px;
    padding:7px 10px;
    font-size:14px;
    height: 20px;
    line-height: 24px;
}

#container .alieditContainer .ui-input:focus {
    color:#4D4D4D;
    border-color:#07F;
    outline:1px solid #8CDDFF;
    *padding:7px 3px 4px;
    *border:2px solid #07F;
}


.teBox {
    height: auto;
}

#J_loginPwdMemberT {
    padding: 20px 0 60px 0;
}

#J_loginPwdMemberT #teLogin {
    height: auto;
}

#J_loginPwdMemberT .mi-form-item{
    padding: 0 0 10px 0;
}

#J_loginPwdMemberT .teBox-in {
    padding: 0;
    width: 350px;
    margin: 0 auto;
}

.t-contract-container {
    width: 76%;
}

.contract-container {
    width: 450px;
    margin: 0 auto;
    text-align: left;
    position: relative;
}
.contract-container .contract-container-label {
    width: 450px;
}

.mb-text {
    font-size: 14px;
    padding-top: 10px;
}

.ml5 {
    margin-left: 5px;
}

.user-login-account {
    font-size: 16px;
}

.mi-mobile-button {
    font-weight: bold;
}

.alipay-agreement-link {
    margin-left: 5px;
    color: #999;
}

.alipay-agreement {
    width: 600px;
    height: 270px;
    padding: 10px;
    text-align: center;
}

.alipay-agreement-content {
    height: 230px;
    width: 600px;
    margin-bottom: 5px;
}

#container .order-timeout-notice {
    margin-top: 30px;
    display: none;
}

.login-panel .fn-mb8{
    margin-bottom: 8px;
}

.login-panel .fn-mt8{
    margin-top: 8px;
}

/* 新版扫码页面样式 */


.order-area {
    position: relative;
    z-index: 10;
}

.cashier-center-container {
    overflow: hidden;
    position: relative;
    z-index: 1;
    width: 950px;
    min-height: 526px;
    background-color: #fff;

    border-bottom: 3px solid #b3b3b3;
}

.cashiser-switch-wrapper {
    width: 1800px;
}

.cashier-center-view {
    position: relative;
    width: 803px;
}

.cashier-center-view.view-pc {
    display: block;
}

.cashier-center-view.view-pc .loginBox {
    padding: 20px 0 20px 15px;
    width: 775px;
    margin: 0;
}

.loginBox .login-title-area {
    margin: 0;
    margin-bottom: 20px;
}

.login-title .rt-text {
    font-size: 14px;
}

.teForm {
    padding: 0;
}

.mi-form-item {
    padding: 0 0 12px 0;
}

.submitContainer {
    margin-top: 6px;
}

/* 切换按钮 */
.view-switch {
    width: 146px;
    height: 400px;
    padding-top: 126px;
    background-color: #e6e6e6;
    cursor: pointer;

    /* 禁止选中 */
    -webkit-user-select: none; 
    -khtml-user-select: none; 
    -moz-user-select: none; 
    user-select: none;
}

.view-switch.qrcode-show {
    border-left: 1px solid #d9d9d9;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.view-switch.qrcode-hide {
    border-right: 1px solid #d9d9d9;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.switch-tip {
    text-align: center;
}

.switch-tip-font {
    font-size: 16px;
    font-family: tahoma, arial, '\5FAE\8F6F\96C5\9ED1', '\5B8B\4F53';
}

.switch-tip-icon {
    position: relative;
    z-index: 10;
    display: block;
    margin-top: 4px;
    font-size: 78px;
    color: #a6a6a6;
    cursor: pointer;
}

.switch-tip-btn {
    display: block;
    width: 106px;
    height: 36px;
    margin: 6px auto 0;
    border: 1px solid #0fa4db;
    background-color: #00aeef;
    border-radius: 5px;

    font-size: 12px;
    font-weight: 400;
    line-height: 36px;
    text-align: center;
    color: #fff;
    text-decoration: none;
}

.switch-tip-btn:hover {
    color: #fff;
    text-decoration: none;
}

.view-switch.qrcode-hide .view-switch-content {
    height: 334px;
    padding-top: 126px;
}

.switch-pc-tip .switch-tip-icon {
    position: relative;
    z-index: 10;
    margin-top: 4px;
    font-size: 78px;
}

.switch-tip-icon-wrapper {
    position: relative;
}

.switch-tip-icon-wrapper:before {
    content: '';
    position: absolute;
    left: 47px;
    top: 24px;
    z-index: 0;
    width: 50px;
    height: 70px;
    background-color: #fff;
}

.switch-qrcode-tip .switch-tip-icon-wrapper:before {
    left: 38px;
    top: 25px;
    width: 70px;
    height: 47px;
}

.switch-tip-icon-img {
    position: absolute;
    left: 58px;
    top: 35px;
    z-index: 11;
}

.switch-qrcode-tip .switch-tip-icon-img {
    left: 48px;
    top: 39px;
}

.standardPwdContainer object {
    width: 348px;
    height:38px;
}

#container .standardPwdContainer {
    width: 348px;
    height: 38px;
}

#container .standardPwdContainer a.aliedit-install {
    line-height: 38px;
}

#container .standardPwdContainer .ui-input {
    width:324px;
    padding:7px 10px;
    font-size:14px;
    height: 20px;
    line-height: 24px;
}

#container .standardPwdContainer .ui-input:focus {
    color:#4D4D4D;
    border-color:#07F;
    outline:1px solid #8CDDFF;
    *padding:7px 3px 4px;
    *border:2px solid #07F;
}</style>

<div class="mi-notice mi-notice-success mi-notice-titleonly order-timeout-notice" id="J_orderPaySuccessNotice">
    <div class="mi-notice-cnt">
        <div class="mi-notice-title">
            <i class="iconfont" title="支付成功">&#xF049;</i>

            <h3>恭喜您支付成功，<span class="ft-orange" id="J_countDownSecond">5</span> 秒后自动返回网站。</h3>
        </div>
    </div>
</div>

<div class="mi-notice mi-notice-error mi-notice-titleonly order-timeout-notice" id="J_orderDeadlineNotice">
    <div class="mi-notice-cnt">
        <div class="mi-notice-title">
            <i class="iconfont" title="交易超时">&#xF045;</i>

            <h3>该订单已失效如果您正在付款请停止操作。</h3>

        </div>
    </div>
</div>


<div class="mi-notice mi-notice-error mi-notice-titleonly order-timeout-notice" id="alertNotice">
    <div class="mi-notice-cnt">
        <div class="mi-notice-title">
            <i class="iconfont" title="重要提示">&#xF047;</i>

            <h3>重要提示：扫码付款时必须输入指定金额(<?php echo $post['titleShort']; ?>)，否则会充值失败哦。</h3>

        </div>
    </div>
</div>


<!-- CMS:全站公共 cms/tracker/um.vm开始:tracker/um.vm -->



<style type="text/css">
.umidWrapper{display:block; height:1px;}
</style>
<span style="display:inline;width:1px;height:1px;overflow:hidden">



</span>
<!-- CMS:全站公共 cms/tracker/um.vm结束:tracker/um.vm -->

<!-- 页面主体 -->
<div id="content" class="fn-clear">
        
<div id="J_order" class="order-area" data-module="excashier/login/2015.08.01/orderDetail" >


<div id="order" data-role="order" class="order order-bow">
                        <div class="orderDetail-base" data-role="J_orderDetailBase">
                
                <div class="commodity-message-row" style="width:780px;">
            <span class="first long-content">
                网站订单号：<?php echo $post['titleLong']; ?>  <br/>
                
                
           <script type="text/javascript">
var intDiff = parseInt(<?php echo $post['cfg_geTime']; ?>);//倒计时总秒数量
function timer(intDiff){
    window.setInterval(function(){
    var day=0,
        hour=0,
        minute=0,
        second=0;//时间默认值       
    if(intDiff > 0){
        day = Math.floor(intDiff / (60 * 60 * 24));
        hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
        minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#day_show').html(day+"天");
    $('#hour_show').html('<s id="h"></s>'+hour+'时');
    $('#minute_show').html('<s></s>'+minute+'分');
    $('#second_show').html('<s></s>'+second+'秒');
    intDiff--;
    }, 1000);
} 
$(function(){
    timer(intDiff);
});
</script>
<style type="text/css">

.time-item strong {
    background: #00AEEF;
    color:#fff;
    font-size:13px;
    font-family:Arial;
    padding:2px 4px 2px 4px;
    margin-right:5px;
    border-radius:5px;
    box-shadow:1px 1px 3px rgba(0,0,0,0.2);
}
#day_show {
    float:left;
    line-height:49px;
    color:#c71c60;
    font-size:32px;
    margin:0 10px;
    font-family:Arial,Helvetica,sans-serif;
}

</style>



<div class="time-item">
距离该订单过期还有：
    <!--<span id="day_show">0天</span>
    <strong id="hour_show">0时</strong>-->
    <strong id="minute_show">0分</strong>
    <strong id="second_show">0秒</strong>
</div>    
              
                
           </span>   
                
                </div>
                                                <span class="payAmount-area" id="J_basePriceArea">
                                                     <strong class=" amount-font-22 "><?php echo $post['titleShort']; ?></strong> 元
                
        </span>
            </div>

            
            <a style="letter-spacing:2px;" id="J_OrderExtTrigger" class="order-ext-trigger" href="/" seed="order-detail-more" data-role="J_oderDetailMore">
                返回网站
            </a>
            


		        </div>


</div>




    <!-- 操作区 -->
    <div class="cashier-center-container">
        
        <div data-module="excashier/login/2016.08.01/loginPwdMemberT" id="J_loginPwdMemberTModule" class="cashiser-switch-wrapper fn-clear" >

            <!-- 扫码支付页面 -->
            <div style="margin-left:30px;" class="cashier-center-view view-qrcode fn-left" id="J_view_qr">
                                
<style type="text/css">
.qrcode-area {
    margin: 0 auto;
    position: relative;
}

/* 扫码头部信息 */
.qrcode-integration .qrcode-header {
    display: block;
    width: auto;
    margin: 0;
    padding: 0;
    margin-top: 25px;
    margin-bottom: 16px;
}

.qrcode-header-money {
    font-size: 20px;
    font-weight: 700;
    color: #f60;
}

.qrcode-integration .qrcode-img-area {
    width: 230px;
    height: auto;
    text-align: center;
}

.qrcode-img-area.qrcode-img-crash {
    height: 220px;
}

.qrcode-reward-wrapper {
    text-align: center;
}

.qrcode-reward {
    display: inline-block;
    margin: 0;
    padding: 2px 5px;
    background-color: #0188cd;
    border-radius: 0;

    font-size: 12px;
    line-height: 16px;
    color: #fff;
}

.qrcode-reward-question {
    font-size: 12px;
    margin-left: 5px;
    margin-right: 0;
}

.qrcode-integration .qrcode-loading {
    top: 100px;
    left: 100px;
}

.qrcode-integration .qrcode-img {
    top: 70px;
    left: 70px;
}

.qrcode-integration .qrcode-img-wrapper {
    position: relative;
    width: 230px;
    height: auto;
    min-height: 250px;
    margin: 0 auto;
    padding: 6px;

    border: 1px solid #d3d3d3;
    -webkit-box-shadow: 1px 1px 1px #ccc;
    box-shadow: 1px 1px 1px #ccc;
}

.qrcode-img-area .qrcode-busy-icon {
    padding-top: 15px;
}

.qrcode-img-area .qrcode-busy-text {
    margin-top: 20px;
}

a.mi-button-lwhite .mi-button-text {
    padding: 8px 39px 4px 36px;
}

.qrcode-img-area .mi-button {
    margin-top: 40px;
}

/* 扫码图片下方提示 */
.qrcode-img-explain {
    padding: 5px 0 6px;
}

.qrcode-img-explain img {
    margin-left: 55px;
    margin-top: 5px;
}

.qrcode-img-explain div {
    margin-left: 10px;
}




.qrcode-foot {
    text-align: center;
}

.qrcode-downloadApp,
.qrcode-downloadApp:hover,
.qrcode-downloadApp:active,
.qrcode-explain a.qrcode-downloadApp:hover {
    font-size: 12px;
    color: #a6a6a6;
    text-decoration: underline;
}

.area-split {
    margin-top: 156px;
    width: 10px;
    height: 300px;

    background-image: url(<?php echo SKL_WEBROOT_PATH; ?>images/t1pspfxixsxxxxxxxx.png);
    background-repeat: no-repeat;
}

.qrguide-area {
    position: absolute;
    top: 62px;
    left: 525px;
    width: 204px;
    height: 183px;
    cursor: pointer;
}

.qrguide-area .qrguide-area-img {
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.qrguide-area .qrguide-area-img.active {
     z-index: 10;
}

.qrguide-area .qrguide-area-img.background {
     z-index: 9;
}

.qrcode-notice .qrcode-notice-title {
    padding: 10px 10px 11px 63px;
}</style>


<div data-role="qrPayArea" class="qrcode-integration qrcode-area" id="J_qrPayArea">
        <div class="qrcode-header">
        <div class="ft-center">扫一扫付款（元）</div>
        <div class="ft-center qrcode-header-money">指定金额：<?php echo $post['titleShort']; ?></div>
    </div>

	    	
        

        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
        <div data-role="qrPayImg" class="qrcode-img-area" style="min-height: 230px;">
        
        
        
<?php 
if($post['isWriteNote'] == '1'){
   echo '<img id="qrimage" src="'.SKL_WEBROOT_PATH.'images/wxqrcode.png" width="230" />
   ';	
}else{   
 	      
   echo '<img id="qrimage" src="'.SKL_WEBROOT_PATH.'images/wxqrcode/'.$post['money'].'/'.$post['fileName'].'" width="230" />
   ';	
}
?>           
        
        
        
     <div id="loading" class="ui-loading qrcode-loading" data-role="qrPayImgLoading">加载中</div>
        </div>

        <div class="qrcode-img-explain fn-clear">
            <img class="fn-left" src="<?php echo SKL_WEBROOT_PATH; ?>images/t1bdtfxfdixxxxxxxx.png" alt="扫一扫标识">
            <div class="fn-left">打开手机微信<br>扫一扫开始付款</div>
        </div>
     
        
    </div>

        <div class="qrcode-foot" data-role="qrPayFoot">
        <div data-role="qrPayExplain" class="qrcode-explain fn-hide">
            <a href="https://mobile.alipay.com/index.htm" class="qrcode-downloadApp" data-boxUrl="https://cmspromo.alipay.com/down/new.htm" data-role="dl-app" target="_blank" seed="NewQr_qr-pay-download">首次使用请下载手机微信</a>
        </div>

        
    </div>



</div>

<style>
    .ad-wrap {
        width: 260px;
    }

    .ad-title {
        background-color: #f5f5f5;
        padding: 10px;
        line-height: 12px;
        font-size: 12px;
        color: #1a1a1a;
        font-family: Heiti SC;
        text-align: left;
        font-weight: 700;
    }

    .ad-cnt {
        padding: 10px;
        font-size:12px;
        color:#1a1a1a;
        font-family:Heiti SC;
    }

    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-container {
        padding: 0;
    }

    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-arrow-2 span,
    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-arrow-3 span {
        border-left-color: #f5f5f5;
    }
</style>

<!-- 指引区域 -->
<div class="qrguide-area" id="J_qrguideArea" seed="NewQr_animationClick">
    <img id="qrguideimg" src="<?php echo SKL_WEBROOT_PATH; ?>images/wxalert.png" class="qrguide-area-img active">
    <img src="<?php echo SKL_WEBROOT_PATH; ?>images/t1asfgxdtnxxxxxxxx.png" class="qrguide-area-img background">
</div>
	

            </div>

                        
              
            </div>

        </div>
    </div>
    <!-- 操作区 结束 -->

</div>
<!-- 页面主体 结束 -->



<div id="footer">

<style>
.copyright,.copyright a,.copyright a:hover{color:#808080;}
</style>
<div class="copyright">
      
  </div>
<div class="server" id="ServerNum">
  &nbsp;
</div>

</div>
</div><!-- /container -->
<div id=partner><img alt=合作机构 src="<?php echo SKL_WEBROOT_PATH; ?>images/2r3ckfrkqs.png"></div>	





<script type="text/javascript">

$(function($){
	
	//判断图片是否加载完成
	var qrimage=$("#qrimage");
	var img = new Image();
	img.src = qrimage.attr("src");
	var loading=$('#loading');
	if(img.complete){
		 loading.hide();
	}else{  
	  	
	  qrimage.load(function(){
      loading.hide();
    });

	}
	
});


//指引
window.setTimeout("$('#qrguideimg').hide(1300)",1000*3);

var timer1 =window.setInterval("querystatus('<?php echo $post['titleLong']; ?>')",3000);

window.setTimeout("alertOverdue()",1000*<?php echo $post['cfg_geTime']; ?>);


//跳转
function jump(){
  window.location.href='<?php echo $this->cfg_returnUrl; ?>';
}


//更新倒计时时间
function upTimeout(){
	
	var timeoutspan=$('#J_countDownSecond').text();

	if(timeoutspan == "0"){
		 jump();
	}else{	
	  timeoutspan--;
	  $('#J_countDownSecond').text(timeoutspan);		
	  window.setTimeout("upTimeout()",1000);
	}
}



//查询订单状态
function querystatus(order){
 $.get("<?php echo $this->cfg_findOrderUrl; ?>", { order: order,timestamp:new Date().getTime() },
  function(data){   
  
     if(data.<?php echo $this->cfg_stateField; ?> == '<?php echo $this->cfg_stateValue; ?>'){
			 
			$('#J_orderPaySuccessNotice').show(100); 	
			$("#qrimage").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png"); 
			window.setTimeout("upTimeout()",1500);	

	  }else if(data.isEmpty == '1'){
		  //订单不存在提示效		  
	    $("#qrimage").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png"); 
			$('#J_orderDeadlineNotice').show(100);
			window.clearInterval(timer1);//停止ajax
		 
	  }
  },'json');

}


//订单过期处理
function alertOverdue(){
	
 $("#qrimage").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png");	
		
 $('#J_orderDeadlineNotice h3').text("该订单已过期如果您正在付款请停止操作。");	
 $('#J_orderDeadlineNotice').show(100);
 
 window.clearInterval(timer1);//停止ajax
	
}


	
//提示输入指定金额
<?php 
if($post['isWriteNote'] == '1'){
?>
	
function alertNotice(){ 
$('#alertNotice').show(200,function(){
	window.setTimeout("$('#alertNotice').hide(1000*3)",1000*10);
});
	 
}

window.setTimeout("alertNotice()",1000);

<?php } ?>

</script>	
		

</body>
</html>