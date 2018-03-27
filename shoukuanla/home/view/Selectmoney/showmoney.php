<?php 
/*
功能：选择金额
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/
?>

<script type="text/javascript">
if(typeof jQuery == 'undefined'){
	document.write("<script src='<?php echo SKL_WEBROOT_PATH; ?>js/jquery-1.11.3.min.js'><\/script>");
}
</script>

<style type="text/css">

.skl_moneyBox{
	height: auto;
	float: left;
	width: auto;
	padding-top: 5px;
	padding-bottom: 5px;
}
.skl_moneyBox a{
  list-style:none; 
	font-family: "微软雅黑";
	font-size: 14px;
	float: left;
	height: auto;
	width: 70px;
	margin-right: 10px;
	border: 1px double #C4DEFF;
	border-radius: 5px;
	text-align: center;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
	margin-top: 3px;
	margin-bottom: 3px;
	cursor: pointer;
	color: #333;
}

.skl_moneyBox a:hover{ text-decoration:none;}

.skl_selectli{
	background-image: url(<?php echo SKL_WEBROOT_PATH; ?>images/select.png);
	background-repeat: no-repeat;
	background-position: right bottom;
	background-color: #E1F5FF;
}

.skl_gediv{
    height:20px;width: 820px;float: left;
}

</style>


<div class="skl_moneyBox">

<?php 
//遍历输出金额组
foreach($dirName as $dirValue){	
  echo '<a money-type="0" data-value="'.$dirValue.'">￥'.$dirValue.'元</a>';	
}
?>

<?php 
if($this->cfg_isOtherMoney == '1'){
echo '
<a money-type="1"><input style="width:65px;color: #666;" name="skl_custom_money" type="text" value="其他金额" /></a>
';
}
?>


<input type="hidden" id="skl_money" name="<?php echo $skl_moneyName; ?>" value="1" />
<input type="hidden" name="skl_money_type" value="" />

</div>

<!--<div class="skl_gediv"></div>-->

<script type="text/javascript">
$(function($){

 //选择金额
 var skl_moneyBoxLi=$(".skl_moneyBox a");
 var skl_money=$("input[id='skl_money']");
 var skl_custom_money=$("input[name='skl_custom_money']");
 var skl_otherMoney="其他金额";
 
 skl_moneyBoxLi.click(function(){	 
	  
	//先移除样式
	skl_moneyBoxLi.removeClass("skl_selectli");
	
	var thisLi=$(this);
	thisLi.addClass("skl_selectli");
	
	skl_money.val(thisLi.attr("data-value"));
	$("input[name='skl_money_type']").val(thisLi.attr("money-type"));
		 
});

	
	//获得焦点
	skl_custom_money.focus(function(){
    if(skl_custom_money.val() == skl_otherMoney){
		  skl_money.val(skl_custom_money.val(""));
		}
		
	});

	//焦点离开
	skl_custom_money.focusout(function(){
		skl_money.val(skl_custom_money.val());
	});		

  //显示默认金额
  skl_moneyBoxLi.first().click();
   
//alert(addds);
 });
</script>
