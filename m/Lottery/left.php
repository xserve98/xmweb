<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$type = intval($_GET['t']);
if (!$type) $type = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>时时彩</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<style type="text/css">
		/* CSS样式表 */
		 body{
			margin:0px;
			padding:0px;
			font-family: "宋体", Arial;
			color:#783218;  /* 菜单字体颜色 */
			/*background:#FFF;*/ /* 菜单背景颜色 */
			position: relative;
			font-size:12px;
			overflow-x: hidden;
		}
		html {
			overflow-x: hidden;
		}
		h1,h2,h3,h4,h5{
			padding:0;
			margin:0;
			font-size:25px;
			color:#900;
		}
		/*设立常用标签的外边距，内边距，边框为0，防止在排版时再重复定义和出现怪问题*/
		div,form,ul,ol,li,dl,dt,dd,p,span,img
		 {
			margin: 0;
			padding: 0;
			border:0;
		}
		/*设立列表样式为无，这样列表前面不带点*/
		li,dl{
			list-style-type:none;
		}
		/*(设立默认全局样式超链接样式)*/
		a{text-decoration:none;color:#900;}
		a:hover{ text-decoration:underline;color:#900;}
		/*所有样式*/
		.clear {clear: both;}
		.line10{height:10px;}
		.line5{height:5px;overflow:hidden;}
		.main{margin:0 auto; padding:0px; width:231px; background-color:#FFF;}
		.menulink_0{height:8px;margin:0px auto 0 auto; line-height:8px; background-image:url(../skin/ssc/ssc_left_01.gif);}
		.left_2,.menulink_1{height:31px;margin:0px auto 0 auto; line-height:31px; padding:0px 23px 0px 23px; background-image:url(../skin/ssc/ssc_left_07.gif);color:#ffffff;cursor: pointer; font-weight:bold;}
		.menulink_2{height:31px;margin:0px auto 0 auto; line-height:31px; padding:0px 23px 0px 23px; background-image:url(../skin/ssc/ssc_left_08.gif);cursor: pointer; color:#a90404; font-weight:bold;}
		.betlink_1{height:25px;margin:0 auto; background-image:url(../skin/ssc/ssc_left_03.gif);line-height:25px; padding:0px 23px 0px 23px;border-bottom:0px #e2d1c1 solid;cursor: pointer;}
		.betlink_2{height:25px;margin:0 auto; background-image:url(../skin/ssc/ssc_left_04.gif);line-height:25px; padding:0px 23px 0px 23px;border-bottom:0px #e2d1c1 solid;cursor: pointer;}
		
		.menulink_3{height:49px;margin:0px auto 0 auto; line-height:49px; background-image:url(../skin/ssc/ssc_left_10.gif);}
		.menulink_4{height:49px;margin:0px auto 0 auto; line-height:49px; background-image:url(../skin/ssc/ssc_left_11.gif);}
		.menulink_5{height:48px;margin:0px auto 0 auto; line-height:48px; background-image:url(../skin/ssc/ssc_left_12.gif);}
		.menulink_6{height:8px;margin:0px auto 0 auto; line-height:8px; background-image:url(../skin/ssc/ssc_left_09.gif);}		
		.f_right{ float:right;color:#fff;font-weight:normal}
		.f_right2{color:#F00} .f_right3{color:#FF0}
	</style>
	<script language="JavaScript">
		window.onerror=function(){return true;}
		if(self==top){
			top.location='/';
		}

		function urlOnclick(url){
			parent.open(url,"mainFrame");
		}
		
		function urlblank(url){
			window.open(url,"_blank");
		}
	</script>
	<script type="text/javascript" src="../skin/js2/jquery.js"></script>
	<script type="text/javascript" src="../skin/js2/global.js"></script>
	<script type="text/javascript" src="../skin/js2/DD_belatedPNG.js"></script> 
	<script type="text/javascript">if(isLessIE6)DD_belatedPNG.fix('*'); </script>
	<script>
	$(function(){
		$(".menulink_1").live('click',function(){
			$(".menulink_2").removeClass('menulink_2').addClass('menulink_1');
			$(this).addClass('menulink_2');
		});
	});
		function changeMove(obj,type,k)
		{
			if(type)
			{
				$(obj).addClass(k+"_1");
			}
			else
			{
				if ($("#"+k+"_01_bet").css("display")=="none")
					$(obj).removeClass(k+"_1");
			}
		}
	</script>
	<script type="text/javascript" language="javascript" src="js/left.js"></script>
	<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
	<script language="javascript">
		function ResumeError() {
			return true;
		}
		window.onerror = ResumeError; 
	</script>
</head>
<body>
<div class="main">
	<div id="ds_01_bet">
    <div class="menulink_0" ></div>
		<div class="menulink_<?=$type==1 ? 2 : 1?>" onclick="urlOnclick('Cqssc.php');" ><span class="f_right" id="cqssc_t">--</span>重庆时时彩</div>
        
        <div class="menulink_<?=$type==2 ? 2 : 1?>" onclick="urlOnclick('Jxssc.php');"><span class="f_right" id="jxssc_t">--</span>江西时时彩</div>
        <div class="menulink_<?=$type==14 ? 2 : 1?>" onclick="urlOnclick('Xjssc.php');"><span class="f_right" id="xjssc_t">--</span>新疆时时彩</div>
        
		<div class="menulink_<?=$type==3 ? 2 : 1?>" onclick="urlOnclick('Pk10.php');"><span class="f_right" id="pk10_t">--</span>北京赛车(PK10)</div>
        
        <div class="menulink_<?=$type==4 ? 2 : 1?>" onclick="urlOnclick('Xyft.php');" ><span class="f_right" id="xyft_t">--</span>幸运飞艇</div>
        
		<div class="menulink_<?=$type==5 ? 2 : 1?>" onclick="urlOnclick('Cqsf.php');" ><span class="f_right" id="xync_t">--</span>重庆幸运农场</div>
        
      <div class="menulink_<?=$type==6 ? 2 : 1?>" onclick="urlOnclick('gdsf.php');" ><span class="f_right" id="gdklsf_t">--</span>广东快乐十分</div>
        
	  <div class="menulink_<?=$type==7 ? 2 : 1?>" onclick="urlOnclick('kl8.php');"><span class="f_right" id="kl8_t">--</span>北京快乐8</div>
            
	  <div class="menulink_<?=$type==8 ? 2 : 1?>" onclick="urlOnclick('3D.php');"><span class="f_right" id="3d_t">--</span>福彩3D</div>
        
	  <div class="menulink_<?=$type==9 ? 2 : 1?>" onclick="urlOnclick('pl3.php');"><span class="f_right" id="pl3_t">--</span>排列三</div>
        
        <div class="menulink_<?=$type==10 ? 2 : 1?>" onclick="urlOnclick('/Six/Six_7_3.php');"><span class="f_right" id="six_t">--</span>香港六合彩</div>
        
        <div class="menulink_1" onclick="urlOnclick('gdsf.php');" style="display:none">不显示</div>
        
        <div class="menulink_3" ></div> 
        <div class="menulink_4" ></div>
        <div class="menulink_5" ></div>
      <div class="menulink_6" ></div>
	</div>
</div>
</body>
</html>