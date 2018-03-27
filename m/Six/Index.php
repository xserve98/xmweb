<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$type	=	$_REQUEST['type'];
$msg	=	"";
$sql	=	"select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 0,5";
$query	=	$mysqli->query($sql); 
while($rs = $query->fetch_array()){
	$msg	.=	$rs['msg']."&nbsp;&nbsp;&nbsp;&nbsp;";
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="madvertis zh-cn isLoginN ">
<head>
<meta charset="utf-8"/>
<title>澳洲博娱乐城</title>
<style>
body {
	font-family: Arial, Helvetica, sans-serif,'新細明體';
	font-size: 12px;
	background: #1c0602;
}
#mainBody {
	width:100%;
	height: 100%; 
}
</style>
<script src="/cl/js/jquery-1.7.2.min.js"></script>
<script src="/cl/js/common.js"></script>
<script src="/cl/js/tools/upup.js"></script>
<script src="/cl/js/tools/float.js"></script>
<script src="/cl/js/pluging/swfobject.js"></script>
<script src="/cl/js/pluging/jquery.cookie.js"></script>
<script src="/cl/tpl/cashbox/ver2/js/cashbox.js"></script>
<link href="/cl/tpl/cashbox/ver2/css/cashbox.css" rel="stylesheet" />
<link href="/cl/tpl/commonFile/css/standard.css" rel="stylesheet" />
<script language="javascript" src="/js/home.js"></script>
<script type="text/javascript" src="../box/jquery.jBox-2.3.min.js"></script>
<script type="text/javascript" src="../box/jquery.jBox-zh-CN.js"></script>
<link type="text/css" rel="stylesheet" href="../box/GrayCool/jbox.css"/>
<link type="text/css" rel="stylesheet" href="css/6hc.css"/>
<script src="layer/layer.min.js" type="text/javascript"></script>
<!--[if IE 6]>
<style>
    html { overflow-x: hidden;}
    body { padding-right: 0em; }
</style>
<script src="/cl/js/pluging/DD_belatedPNG_0.0.9a-min.js"></script>
<script>
    $(function(){
        DD_belatedPNG.fix('#gameIconArea img,#ShadowLine,#loginArea,#loginArea a,#loginBtn input,#headerTitle div,#main-Menual ul li a');
    });
    //修正ie6 bug
    try {
        document.execCommand("BackgroundImageCache", false, true);
    } catch(err) {}

</script>
<![endif]-->
</head>
<body>
        <div id="mainBody">
                    <style>/* logo*/
.header-logo{
    float:left; 
    width: 325px;
    height: 98px;
}
#logo-wrap,
#logo-img{
    background: url('/cl/tpl/cashbox/ver2/image/logo.jpg') 100% 100% no-repeat;
    display: block;
    cursor: pointer;
    width: 325px;
    height: 98px;
}
#logo-img{
    background-position: 0 0;
}
/* logo_END*/
#firstNews{
    width: 585px;
    height: 42px;
    padding: 0 10px 0 80px;
    color: #98937a;
    float: left;
    line-height: 42px;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h8.jpg) left top no-repeat;
}
#btn_1{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n1.png) }
#btn_2{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n2.png) }
#btn_3{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n3.png) }
#btn_4{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n4.png) }
#btn_5{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n5.png) }
#btn_6{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n6.png) }
#btn_7{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n7.png) }
#btn_11{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n11.gif) }
#btn_9{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n8.png) }
#btn_10{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n9.png) }
#btn_8{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/n10.png) }
#loginArea{
    float: left;
    width: 221px;
    height: 155px;
    color: #EBBE92;
    padding: 90px 10px 0 10px;
    _display: inline;
    overflow: hidden;
        background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h9.png) left top no-repeat;
    }
#loginArea td{
    padding: 0px 0px 11px 0px;
}
#loginArea .loginTD{
	  
    width:45px;
    padding: 0px 0px 11px 10px;
    }
#loginBtn input{
    border: 0;
    outline: 0;
    background: none;
    height: 27px;
    width: 59px;
    line-height: 27px \9;
    cursor: pointer;
    float: left;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h10.png) left top no-repeat;
    _position: relative;
    _z-index: 2;
}
#firstJoin{
    width: 241px;
    height: 77px;
    float: left;
    clear: both;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h9_2.png) left bottom no-repeat;
}
#firstJoin a{
    width: 241px;
    height: 77px;
    display: block;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h9_2.png) left top no-repeat;
}
#firstWelcome{
    width: 241px;
    height: 77px;
    clear: both;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h9_2_welcome.png) left top no-repeat;
}
#firstService a{
    height: 105px;
    width: 241px;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h9_3.png) left top no-repeat;
    display: block;
}
#page-footer {
    width:100%;
    height:120px;
    clear:both;
    background:url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h3.jpg) center top no-repeat;
}
#footerBg{
    width: 1000px;
    height: 120px;
    position: relative;
    margin: 0 auto;
    background:url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h3.jpg) center top no-repeat;
}
#headerTitleBG{
    width: 100%;
    height: 256px;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h12.jpg) center top no-repeat;
}
#headerTitle{
    width: 1000px;
    height: 175px;
    margin: 0 auto;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h12.jpg) center top no-repeat;
}
#headerMiddle{
    margin: 0 auto;
    width: 1000px;
    background: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/h12.jpg) center top no-repeat;
}
/* GameIcon */
.GameIcon-First {
    background-image:url(/cl/tpl/commonFile/images/GameIcon/First_zh-cn.png);
}
.liveTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro2.png);}
.livetopTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro12.png);}
.multibetTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro13.png);}
.robotliveTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro14.png);}
.robotmultibetTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro15.png);}
.gameTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro.png);}
.lotteryTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro4.png);}
.promotionTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro6.png);}
.aboutTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro5.png);}
/*.contactTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/contactTitle.png);}*/
.agentTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro10.png);}
/*.qaTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/qaTitle.png);}*/
/*.betTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/betTitle.png);}*/
.inTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro8.png);}
.outTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro9.png);}
.joinUsTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro16.png);}
.joinAgentTitle{background-image: url(/cl/tpl/cashbox/ver2/image/lang/zh-cn/pro17.png);}</style>
<div id="page-header">
    <? include "../header.php" ?> 
                <div id="headerTitleBG">
        <div id="headerMiddle">
        <div id="headerTitle">
                        <div class="lotteryTitle"></div>
                    </div>
        <? include "../userinfo.php" ?> 
    </div>
    </div>
            <div class="clear"></div>
</div>
<style type="text/css">
#page-container {
    margin: 0 auto;
        background: url(/cl/tpl/cashbox/ver2/image/h13.jpg) center top repeat-y;
            width: 100%;
    }
#otherLoginArea{
    color: #b38e5a;
        margin: 15px auto 0 auto;
    height: 32px;
            width: 1000px;
    }
</style>        <div id="page-container">
    <div id="page-body" style="width:960px; margin:0 auto">
<div style="float:left; width:140px;"><IFRAME id="leftFrame" name="leftFrame" border=0 marginWidth=0 frameSpacing=0 src="left.php" frameBorder=0 noResize width="100%" scrolling="auto" height=600 vspale="0" allowtransparency="true" style="background-color=transparent"></IFRAME></div>
<div style="float:right; width:810px;"><iframe id="mainFrame" name="mainFrame" border=0 marginWidth=0 frameSpacing=0 src="Six_7_1.php" frameBorder=0 noResize width="100%" scrolling="no" height=600 vspale="0" allowtransparency="true" style="background-color=transparent"></IFRAME></div>
                    <div class="clear" style="height:10px;"></div>
    </div>
    <div class="clear"></div>
</div>
                <? include "../footer.php" ?>    </div>
<? include "../server.php" ?>  
<script type="text/javascript"> 
$(function(){   
    $("#mainFrame").load(function(){          
        var height = $(this).contents().find(".content").height() + 40;  
		$(this).height( height < 400 ? 400 : height );  
    });    
}); 
</script> 
</body>
</html>
<!--[if IE 6]>
<div id="ie6-infoBar">
    <span></span>
    <a id="ie6-boxclose" href="###">關閉</a>
            系统侦测到您使用旧版的浏览器,为维持最佳的浏览品质建议立即前往<a href="javascript:downloadvwin();">下载区</a>升级你的浏览器,建议使用较新版本的IE8,IE9,IE10,BB浏览器
        <iframe class="ie6-zindexHack"></iframe>
</div>
<script type="text/javascript">
window.downloadvwin || (window.downloadvwin = function(){
    window.open('http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home','download','top=0,left=0,width=1000,height=600,location=yes,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no');
})
    $(function(){
        var ie6InfoDiv = $("#ie6-infoBar");
        ie6InfoDiv.width($(window).width());
        $("#ie6-boxclose").click(function(e){
            e.preventDefault();
        	ie6InfoDiv.slideUp();
        });
        setTimeout(function(){
         	ie6InfoDiv.slideToggle(800);
        },20000);

        ie6InfoDiv.slideToggle(800);
    });
</script>
<style type="text/css">
    * html{ text-overflow:ellipsis; }
    #ie6-boxclose{
        float: right;
        padding-right: 20px;
        height: 25px;
    }
    #ie6-infoBar{
        display:none;
        font-size: 12px;
        width: 100%;
        position: absolute;
        top:expression(eval(document.documentElement.scrollTop));
        bottom:auto;
        left:0px;
        color: #000;
        z-index: 9999;
        font-weight:600;
        text-align:left;
        overflow: hidden;
        background: #DDD;
                height: 30px;
        line-height: 30px;
            }
    .ie6-zindexHack{
        position: absolute;
        width: 100%;
        height: 100%;
        z-index:-1; /*讓iframe在div下方*/
        filter:alpha(opacity=0); /*一定要使背景透明*/
    }
    #ie6-infoBar span{
        background: url(/cl/tpl/commonFile/images/warning.png) 0 0 no-repeat;
        width: 15px;
        height: 15px;
        margin: 6px 5px 0 5px;
        float: left;
    }
    #ie6-infoBar a{color: #F57900;}
    #ie6-infoBar a:hover{color: #FF9A37;}
</style>
<![endif]-->