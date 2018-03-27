<?php 
/*
功能：实现微信扫码自动充值
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
<title>微信付款操作流程</title>
<meta name="keywords" content="微信付款操作流程"/>
<meta name="description" content="微信付款操作流程"/>

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
<a style="margin-left: 8px;" id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',2,1);">识别二维码支付
</a>

<a id="tab_setting_2" onclick="SwapTab('setting','on','',2,2);">微信扫码支付</a>
</div>

<h1 style="text-align: center;font-size: 18px;"><font color="red" id="alertinfo">请按照以下步骤操作完成付款</font></h1>

<div class="sweep">
<div id="div_setting_1">

<div>
<span>
<p><b>第一步：登录您的手机微信，点击右上角的搜索按钮输入自己的微信号</b></p>
<p><b>第二步：将付款链接复制发送到自己的微信号然后点击链接进入付款页面</b></p>



<p><b>付款链接：<input style="width: 78%;height: 20px;" onClick="document.getElementById('payUrl').select()" class="inputsty" id="payUrl" type="text" value="<?php
$serverPort=$_SERVER["SERVER_PORT"];
if($serverPort == 80){
   $payUrlStr='http://'.$_SERVER['SERVER_NAME'];
}else{
   $payUrlStr='http://'.$_SERVER['SERVER_NAME'].':'.$serverPort;
}

echo $payUrlStr.SKL_WEBROOT_PATH.'index.php?c=Identify&rechargeType='.$post['rechargeType'].'&titleShort='.$post['titleShort'].'&isWriteNote='.$post['isWriteNote'].'&money='.$post['money'].'&cfg_stateField='.$this->cfg_stateField.'&cfg_stateValue='.$this->cfg_stateValue.'&fileName='.$post['fileName'].'&cfg_findOrderUrl='.urlencode($this->cfg_findOrderUrl).'&titleLong='.$post['titleLong'].'&cfg_returnUrl='.urlencode($this->cfg_returnUrl); ?>" readonly></b></p>

<p>演示图</p>
<p><img src="<?php echo SKL_WEBROOT_PATH; ?>images/wxsearch.jpg" /><br>
<img src="<?php echo SKL_WEBROOT_PATH; ?>images/clickurl.jpg" />
</p>


</span>
</form>


</div>




</div>

<div id="div_setting_2" style="display: none;">

<p>
<b>第一步：登陆您的手机微信扫描下边的二维码</b>
</p>


<?php 
if($post['isWriteNote'] == '1'){
	 $wxqrcodePath=SKL_WEBROOT_PATH.'images/wxqrcode.png';
   $zhidingMoney='<p><b>指定金额：<a style="color: #F00;font-size: 30px;">'.$post['titleShort'].'</a></b></p>';

   echo '
   <p><b>第二步：输入指定的付款金额然后开始付款</b></p>  ';	

}else{
 	   
	 $wxqrcodePath=SKL_WEBROOT_PATH.'images/wxqrcode/'.$post['money'].'/'.$post['fileName'];			
   $zhidingMoney='';

}

echo '
  <p><b>温馨提示：小数点后边的金额也会充值到账</b></p>'.$zhidingMoney.'
  <p><img id="Qrcode" src="'.$wxqrcodePath.'" width="60%" /></p>
';
?>


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