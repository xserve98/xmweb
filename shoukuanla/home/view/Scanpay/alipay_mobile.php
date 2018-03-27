<?php 
/*
功能：实现支付宝扫码自动充值
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/
//error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);//显示除去E_WARNING E_NOTICE 之外的所有错误信息
//require_once(dirname(__FILE__).'/function/function.php');

//$post=skl_I($_POST,array('trim','strip_tags'));
if(empty($post['titleShort'])){  exit; }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0">
<title>支付宝款操作流程</title>
<meta name="keywords" content="支付宝付款操作流程"/>
<meta name="description" content="支付宝付款操作流程"/>

<script type="text/javascript" src="<?php echo SKL_WEBROOT_PATH; ?>js/jquery-1.11.3.min.js"></script>

<style type="text/css">
.contens{
  background-color: #FFF;
  width:86%;
	max-width: 640px;
	box-shadow: 0px 3px 10px #0070A6;
	margin-right: auto;
	margin-left: auto;
	margin-top: 5px;
	height: auto;
	border-radius: 6px;
	font-family: "微软雅黑";
	margin-bottom: 50px;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
}
p{font-size: 12px; color: #0B48FF; 	margin-top: 6px;	margin-bottom: 6px;}
.inputsty{ font-size: 16px; width: 230px; height: 28px; }
.sweep{  background-repeat: no-repeat; text-align: center; 
}
.copy{
	background-image: url(<?php echo SKL_WEBROOT_PATH; ?>images/alicopy.jpg);
	background-repeat: no-repeat;
	height: 436px;
	width: 300px;
	margin-right: auto;
	margin-left: auto;
	text-align: left;
}
.buttonStyle{
	margin-right: auto;
	margin-left: auto;	
	width: 100%;
}

.buttonStyle a{
	text-decoration: none;
	font-size: 18px;
	background-color: #0080C0;
	border-radius: 6px;
	color: #FFF;
	padding-top: 6px;
	padding-bottom: 6px;
	display: block;
}
.buttonStyle a:hover{
	border-radius: 6px;
	background-color: #2377F5;
}

.top{
	height: 30px;
	text-align: center;
	width: 100%;
	padding-top: 5px;
}

.top a{
  width: 45%;
	float: left;
	text-decoration:none;
	font-size: 16px;
	background-color: #0080C0;
	border-radius: 6px;
	color: #FFF;
	margin-left: 5px;
	margin-right: 5px;
	padding-top: 5px;
	padding-bottom: 5px;
	cursor: pointer;

}
.top a:hover{
	border-radius: 6px;
	background-color: #2377F5;
}
.topButton{ background-color: #AAF; 	
}
.inputEmail { width: 30px; padding-left: 36px; padding-top: 160px; }
.tableRight { text-align: right; width:40%;}
.tableFeft { text-align: left; width:60%;}
</style>


</head>
<body>
<div class="contens">
<div class="top">
<a style="margin-left: 8px;" id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',2,1);">扫码支付
</a>

<a id="tab_setting_2" onclick="SwapTab('setting','on','',2,2);">手动转账</a>
</div>

<h1 style="text-align: center;font-size: 18px;"><font color="red" id="alertinfo">请按照以下步骤操作完成付款</font></h1>

<div class="sweep">
<div id="div_setting_1">


<p>
<b>第一步：手指长按二维码不放再点击识别二维码</b>
</p>


<?php 
if($post['isWriteNote'] == '1'){
   echo '
   <p><b>第二步：输入指定的付款金额然后开始付款</b></p>
   
   <p><b>指定金额：<a style="color: #F00;font-size: 22px;">'.$post['titleShort'].'</a></b></p>
   	 
	 
   <p><img id="Qrcode" src="'.SKL_WEBROOT_PATH.'images/aliqrcode.jpg" width="60%" /></p>
   ';	
}else{
  	      
   echo '<p><img id="Qrcode" src="'.SKL_WEBROOT_PATH.'images/aliqrcode/'.$post['money'].'/'.$post['fileName'].'" width="60%" /></p>   
   ';	

}

if(!empty($post['urlCfg'])){
 echo '<p><div class="buttonStyle"><a target="_blank" id="urlPay" href="'.$post['urlCfg'].'">识别二维码支付</a></div></p>';	 
}
?>



</div>

<div id="div_setting_2" style="display: none;">
<div>
<span>
<p><b>第一步：登录您的手机支付宝进入转账页面</b></p>
<p><b>第二步：将下边的收款账号金额信息复制粘贴到支付宝转账页面输入框中，然后点击确认转账进行付款</b></p>
<p>
<table width="100%">
  <tr>
    <td class="tableRight">收款账号：</td>
    <td class="tableFeft"><?php echo $post['email']; ?></td>
  </tr>
  <tr>
    <td class="tableRight">转账金额：</td>
    <td class="tableFeft"><?php echo $post['titleShort']; ?></td>
  </tr>

</table>

</p>
<p>演示图</p>
<div class="copy">
<form name="form">
 <div class="inputEmail"> <input onClick="Myselect_Email()" name="Email" class="inputsty" name="input" type="text" value="<?php echo $post['email']; ?>" readonly> </div>

 <div class="inputEmail" style="padding-top:60px;"> <input style="font-weight:bold;" onClick="Myselect_money()" class="inputsty" name="money" type="text" value="<?php echo $post['titleShort']; ?>" readonly> </div>
 
 <!--<div class="inputEmail" style="padding-top:13px;"> <input onClick="Myselect_text()" style="width: 230px;" class="inputsty" name="text" type="text" value="" readonly> </div>-->
</div>
</p>


</span>
</form>


</div>


</div>




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
h1 {
    font-family:"微软雅黑";
    font-size:30px;
    border-bottom:solid 1px #ccc;
    padding-bottom:10px;
    letter-spacing:2px;
}
h2 {
    font-family:"微软雅黑";
    font-size:20px;
    letter-spacing:2px;
}
.time-item strong {
    background:#C71C60;
    color:#fff;
    line-height:49px;
    font-size:24px;
    font-family:Arial;
    padding:0 10px;
    margin-right:10px;
    border-radius:5px;
	margin-top:10px;
	margin-bottom:10px;
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
.item-title .unit {
    background:none;
    line-height:49px;
    font-size:24px;
    padding:0 10px;
    float:left;
}
</style>


<h2 style="margin-top:10px;margin-bottom:1px">距离该订单过期还有</h2>
<div class="time-item">
    <!--<span id="day_show">0天</span>
    <strong id="hour_show">0时</strong>-->
    <strong id="minute_show">0分</strong>
    <strong id="second_show">0秒</strong>
</div>




<p style="color:#F2230B;margin-top: 5px;">温馨提示：付款成功后1-20秒到账请耐心等候，如果超时未到账请联系网站客服处理。</a></p>
</div>

</div>




<script type="text/javascript">
function Myselect_Email(){
if (document.form.Email.focus){ 
	document.form.Email.select();
 
 }
}


function Myselect_money(){
if (document.form.money.focus){ 
	document.form.money.select();
 }
}

function Myselect_text(){
if (document.form.text.focus){ 
	document.form.text.select();
 }
}
  
   
   
function SwapTab(name,cls_show,cls_hide,cnt,cur){
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show(800);
			 $('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			 $('#div_'+name+'_'+i).hide(800);
			 $('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}   


<?php 
if($post['isWriteNote'] == '1'){
   echo 'setTimeout("alert(\'重要提示：扫码付款时必须输入指定金额('.$post['titleShort'].')，否则会充值失败哦\')",2000);';
}
?>



//查询订单状态
function querystatus(order){
 $.get("<?php echo $this->cfg_findOrderUrl; ?>", { order: order,timestamp:new Date().getTime() },
  function(data){   
  
     if(data.<?php echo $this->cfg_stateField; ?> == '<?php echo $this->cfg_stateValue; ?>'){	
			$("#Qrcode").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png"); 
			$("#alertinfo").html("恭喜您付款成功，3秒后自动返回网站");
			window.setTimeout("jump()",3000);

	  }else if(data.isEmpty == '1'){
		//订单不存在提示失效 
		$("#alertinfo").html("该订单已失效如果您正在付款请停止操作"); 
	   $("#Qrcode").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png"); 
	   $("#urlPay").attr("href","<?php echo $this->cfg_returnUrl; ?>");
	  }
  },'json');

}

//跳转
function jump(){
  window.location.href='<?php echo $this->cfg_returnUrl; ?>';
}

function alertOverdue(){
	
 $("#Qrcode").attr("src","<?php echo SKL_WEBROOT_PATH; ?>images/failure.png");
 $("#urlPay").attr("href","<?php echo $this->cfg_returnUrl; ?>");
 $("#alertinfo").html("该订单已过期，3秒后自动返回网站");	

 window.setTimeout("jump()",1000*3);	
	
}

window.setInterval("querystatus('<?php echo $post['titleLong']; ?>')",3000);
window.setTimeout("alertOverdue()",1000*<?php echo $post['cfg_geTime']; ?>);

</script>

</body>

</html>