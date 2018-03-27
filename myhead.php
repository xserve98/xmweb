<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");

$_SESSION["uid"] = intval($_SESSION["uid"]);

$uid = $_SESSION["uid"];

$name='guest_'.rand(100000,999999);

?>

<?php
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);
			
while ($rs = $query->fetch_array()) {
    $msg = $rs['msg'];
	$msg2 = '<span class="listpart"><a href="javascript:void(0);" class="ShowNewsMore" article_id="">'.$rs['msg'].'</a></span><span class="time">'.$rs["add_time"].'</span>　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　';
}
?>

<?php
$sql = "select title from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);		
while ($rs = $query->fetch_array()) {
	$title = $rs['title'];
	$title1 = '<li id="notice_infoa_30"><span class="listpart"><a href="javascript:void(0);" class="ShowNews" notice_id="30">'.$rs['title'].'</a></span><span class="time"><font color="red"></font></span>';
}
?>

<?php
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc";
$query = $mysqli->query($sql);
			
while ($rs = $query->fetch_array()) {
    $msg = $rs['msg'];
	$msg22 = '<p>'.$rs['msg'].'</p>';
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=”renderer” content=”webkit” />
<title><?=$web_site['web_title']?></title>
<meta name="keywords" content="<?=$web_site['web_name']?>" />
<meta name="description" content="<?=$web_site['web_name']?>致力于打造彩票第一品牌，与您共同打造高品质的游戏平台，彩票游戏，我们更专业！" />
<link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="/xmIndex/css/mymain.css"/>
<link rel="stylesheet" href="/xmIndex/css/pulic.css"/>
<link media="all" href="/newdsn/css/kefu.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="/js/jquery-ui/styles/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/fonts/stylesheet.css">
<link rel="stylesheet" href="/newdsn/css/cash/main.css">
<link rel="stylesheet" href="/newdsn/css/cash/style.css">
<link rel="stylesheet" href="/newdsn/css/cash/index.css">
<link rel="stylesheet" href="/newdsn/css/cash/jquery.bxslider.css"/>
<link rel="stylesheet" href="/newdsn/css/notice_popup.css"/>
<script src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="https://imgcdn.hazdmj.com/xy00001/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="https://imgcdn.hazdmj.com/xy00001/js/layer-v2.4/layer.js"></script>
<script>
var stat1 = 25;
var statprogress1 = 25;  // 25%, percentage
var stat2 = 120;
var statprogress2 = 65;  // 65%, e
var stat3 = 34;
var affType = 0;
</script>
<script>
   /*---------返回顶部----------*/
   $(function() {
	    $(".btn_top").hide();
		$(".btn_top").live("click",function(){
			$('html, body').animate({scrollTop: 0},300);return false;
		})
		$(window).bind('scroll resize',function(){
			if($(window).scrollTop()<=300){
				$(".btn_top").hide();
			}else{
				$(".btn_top").show();
			}
		})
   })
	
   /*---------返回顶部 end----------*/
</script>
</head>
<body id="bodyid" marginwidth="0" marginheight="0">
<div class="big-box">
    <!--头部开始-->
    <div class="header-box">
        <div class="header-ts">
            <div class="ts-play">
                <img src="/xmindex/img/laba.png" alt="shibai">

                <div class="NewSlides">
                <div id="NewSl">
                    <ul id="NewSl_begin">
                     <li>
					 <?=$msg2;?>
                                    </li>
                                            </ul>
                    <ul id="NewSl_end"></ul>
                </div>
            </div>

            </div>
        </div>
    <!--头部结束-->
<div class="top">
        <div class="g_w1">
            <div class="time_box">
               <span class="date showTime"></span> 营业时间：白天07:30 - 凌晨04:00 / 全年无休</div>
            <div class="oper_box">
			<?php
			if(!$uid){
				?>
                <div class="login">
			    <form class="login-form" id="loginForm" name="form1" action="/login.php" method="post" onsubmit="check_login();">
                <a href="/register"><button type="button" id="btn-register" class="btn btn-red" title="注册">注册</button></a>
				<div class="userid form-control">
                <input id="username" type="text" name="username" value=""  placeholder="用户名">
				</div>
				<div class="password form-control">
                <input id="password" type="password" name="passwd" value=""  placeholder="******">
	            <a onclick="alert(&quot;如忘记密码请问联系在线客服！&quot;); return false;" class="btn btn-sm btn-white">忘记?</a>
				</div>
				<input type="hidden" name="act" value="login">
	         <input type="submit"id="loginBtn" title="登录" name="rmNumm" value="登录" onClick="loginBtn" class="btn btn-red">

          <button type="button" onclick="javaScript:alert('游客盘口只供试玩，与正式会员盘口无关!');top.location.href='/guest.php';" class="btn btn-blue">试玩登录</button>
	  <a target="_blank" href="<?=$web_site["web_kf"]?>"><div" class="btn btn-yellow">
	  <div style="margin-top:5px; "><img src="/xmindex/img/mic.png"></div><div style="margin-left:4px; margin-top: 0px;" title="点击即可联系在线客服">在线客服</div></div"></a>
	  </form>  
			</div>				
            </div>
			<?php
			} else {
				?>
			 <div class="header-links">
				<ul>
					<li><span class="username">
					<?php if(strpos($_SESSION["username"],'guest_')===false) {?>
用户名：<?=$_SESSION['username']?>
 <? }else{ ?>
欢迎试玩
 <? } ?>
 <?
$sql = "select money as s from k_user where uid=$uid limit 1"; //余额
$query = $mysqli->query($sql);
$rs = $query->fetch_array();
$user_money = sprintf("%.2f", $rs['s']);
?>
					<li><span class="tesing">额度：<?=$user_money?><span></li>
					<li class="header-center" style="display: none;"><a href="/member/index?page=center/index">个人中心</a></li>
					<li class="header-payment" style="display: none;"><a href="/member/index?page=payment/deposit">资金管理</a></li>
					<li><a href="/member/index">进入游戏</a></li>
					<li><a href="/member/logout">退出</a></li>
				</ul>
				<a target="_blank" href="<?=$web_site["web_kf"]?>"><div" class="btn btn-yellow floatright"><div style="margin-top:2px; "><img src="/newdsn/images/cash/mic.png"></div> <div style="margin-left:4px; margin-top: 0;">在线客服</div></div"></a>
			</div></div>
			<?php
               }
                ?>
            <div class="g_glear"></div>
        </div>
        <div class="g_glear"></div>
    </div>
<div class="topmenu">
	<div class="g_w1" style="width: 1050px;">
		<div class="logo">
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="320" height="70">
<param name="movie" value="/newdsn/images/small_logo.jpg" >
<param name="quality" value="high">
<embed src="/newdsn/images/small_logo.jpg" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="350" height="95" style="position:absolute;top:-8px;"></object>
		</div>
		<div class="menulinks clearfix">
			<a href="/main" class="sublinks">网站首页</a>
			<a href="/register" class="sublinks" >开户注册</a>
			<a href="/promo" class="sublinks">优惠活动
				  <img src="/xmIndex/img/hot.gif" ondragstart="return false;" style="position:absolute;top:10px;">
			</a>
			<?php
			if(!$uid){
				?>
			<a onclick="alert(&quot;您尚未登录，请先登录后在进行存款取款！&quot;); return false;" class="trade sublinks">存款取款</a>
			<?php
			} else {
				?>
			<a href="/member/index" class="trade sublinks">存款取款</a>
			<?php
               }
                ?>
			<a href="/deposit" class="sublinks">常见问题</a>
			<a href="/mobile" class="sublinks">手机投注</a>
			<a href="/agency" target="_blank" class="sublinks">代理加盟</a>
		</div>
	</div>
	</div>

    <!-- 最新公告弹出层 -->
        <div class="layer_containerMore" id="layer_containerMore"  style="display:none">
        <!-- 右侧内容部分 -->
            <div class="MoreNewsCont">
<div class="popNewsLayer" id="notice_info_30">
<h2><?php echo $title;?></h2><?php echo $msg22;?>
<h2></h2>
</div></div>
    <!-- 左侧信息列表 -->
            <div class="MainListUl_More">
                <ul><?php echo $title1;?></ul>
            </div>
        </div>
<script>
$(function () {

    function showNotice(notice_id) {
        $(".popNewsLayer").hide();
        $("#notice_info_" + notice_id).show();
        $("#notice_infoa_"+notice_id).css({'border-right': '2px solid red'});
        var i = layer.open({
            type: 1,
            title: '最新公告',
            skin: 'layui-layer-rim newsbg',
            shade: [0.3, '#000'],
            style:'background-color',
            offset: ['50px', ''],
            area: ['490px', '400px'],
            content: $('#layer_containerMore'),       //.html(),
            success: function(dom,index) {
                 $(".ShowNews").click(function() {
                    $(".popNewsLayer").hide();
                    $(".MainListUl_More >ul >li").css({'border-right': '2px solid white'});
                    var notice_id = $(this).attr('notice_id');

                    $("#notice_info_"+notice_id).show();
                    $("#notice_infoa_"+notice_id).css({'border-right': '2px solid red'});
                });
                 $(".MainListUl_More a").eq(0).click();
            }

        });
    }

        var flag;
        setInterval(function () {
        if (flag) {
        $('.hot').css({'display': 'block'});
        $('.hot1').css({'display': 'block'})
        } else {
        $('.hot1').css({'display': 'block'});
        $('.hot').css({'display': 'block'})
        }
        flag = !flag;
        }, 100);


        /****************公告滚动begin***************/
        function ScrollImgLeft(){
        var speed=30;
        var MyMar = null;
        var scroll_begin = document.getElementById("NewSl_begin");
        var scroll_end = document.getElementById("NewSl_end");
        var scroll_div = document.getElementById("NewSl");
        scroll_end.innerHTML=scroll_begin.innerHTML;
        function Marquee(){
            if(scroll_end.offsetWidth-scroll_div.scrollLeft<=0)
                scroll_div.scrollLeft-=scroll_begin.offsetWidth;
            else
                scroll_div.scrollLeft++;
        }
        MyMar=setInterval(Marquee,speed);
        scroll_div.onmouseover = function(){
            clearInterval(MyMar);
        }
        scroll_div.onmouseout = function(){
            MyMar = setInterval(Marquee,speed);
        }
    }
    ScrollImgLeft();

              /****************公告滚动end***************/

              //最新公告弹出层
              $(".ShowNewsMore").live("click",function() {
              var notice_id = $(this).attr('notice_id');
              showNotice(notice_id);
              });
              });
</script>
	<script type="text/javascript">
		function check_login() {
			var frm = $("#loginForm");
			var opt = {
				beforeSubmit: function() {
					if($("#username").val() == "") {
						layer.alert('请输入您的账号！', function(i) {
							$("#username").focus();
							layer.close(i);
						});
						return false;
					}
					if($("#passwd").val() == "") {
						layer.alert('请输入您的密码！', function(i) {
							$("#passwd").focus();
							layer.close(i);
						});
						return false;
					}
					$("#loginBtn").attr("disabled", true);
				},
				success: function(data) {
					if(data.indexOf("3") >= 0) {
						layer.alert('帐号异常无法登陆，如有疑问请联系在线客服！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("2") >= 0) {
						layer.alert('账号或密码错误，请重新输入！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("1") >= 0) {
						top.location.href = "/member/agreement";
					}
				}
			};
			frm.ajaxSubmit(opt);
			return false;
		}
	</script>