<?php
header("Content-type: text/html; charset=utf-8");
include ("../../six/include/order_info.php");
include_once("../common/login_check.php");
ini_set('display_errors','yes');
include_once("../../include/mysqli.php");
$type = $_REQUEST['type'];
$qishu1 = lottery_qishu2('0');
if($_REQUEST['qi']){
	$qishu = $_REQUEST['qi'];	
}else{
	
	$qishu = $qishu1;
	
}
$qi=$qishu;
include_once("Get_Odds_02.php");
$save = $_REQUEST['save'];
if($type==''){$type=1;}
$type=='7' ? $se1 = 'int_1' : $se1 = 'int_2';
$type=='1' ? $se2 = 'int_1' : $se2 = 'int_2';
$type=='2' ? $se3 = 'int_1' : $se3 = 'int_2';
$type=='3' ? $se4 = 'int_1' : $se4 = 'int_2';
$type=='4' ? $se5 = 'int_1' : $se5 = 'int_2';
$type=='5' ? $se6 = 'int_1' : $se6 = 'int_2';
$type=='6' ? $se7 = 'int_1' : $se7 = 'int_2';
$type=='8' ? $se8 = 'int_1' : $se8 = 'int_2';
$type=='9' ? $se9 = 'int_1' : $se9 = 'int_2';
$type=='10' ? $se10 = 'int_1' : $se10 = 'int_2';
$type=='11' ? $se11 = 'int_1' : $se11 = 'int_2';
$type=='12' ? $se12 = 'int_1' : $se12 = 'int_2';
$type=='13' ? $se13 = 'int_1' : $se13 = 'int_2';
$type=='14' ? $se14 = 'int_1' : $se14 = 'int_2';
$type=='15' ? $se15 = 'int_1' : $se15 = 'int_2';
$type=='16' ? $se16 = 'int_1' : $se16 = 'int_2';
$type=='17' ? $se17 = 'int_1' : $se17 = 'int_2';


//echo $json_string; exit;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tools.js"></script>
<script type="text/javascript" src="../js/base.js"></script>
<script type="text/javascript">
//读取当前期数盘口赔率与投注总额
function loadinfo(){
	$.get("get_odds_01.php?qi=<?=$qishu?>&t=<?=time()?>", {type : <?=$type?>}, function(data)
		{
			for(var key in data.oddslist){
			odds = data.oddslist[key];
			$("#Num_"+key).val(odds);
			}
			
			<? if($type==16 || $type==17){?>
			$("#fs").val(data.fs);<? }?>
			var tzdata = data.tzlist;
			for(var i=0;i<tzdata.length;i++){
				
				
				
			}
			
			var tzlist=data.tzlist;
			
			for(var i=0;i<data.tzlist.length;i++){
				$("#tzNum_"+tzlist[i].h).val(tzlist[i].summony);
				$("#ylNum_"+tzlist[i].h).val(tzlist[i].sumwin);
			}
			
		
			
			
		}, "json");
}
		  
		  
	 function gradeChange(){
        var objS = document.getElementById("qishu");
        var qishu = $('#qishu').children('option:selected').val();
		window.location.href='?type=7&qi='+qishu;
	}
		  
</script>
</head>
<body class="list">
	<div class="bar">
		六合彩注单统计
	</div>

<div class="body">
<ul class="tab">
	<select name="qishu" id="qishu" onchange="gradeChange()" >
	
	<? for($i=$qishu1;$i>$qishu1-15;$i--){ ?>
	   <option value="<?=$i?>"  <?=$i==$_REQUEST['qi'] ? 'selected' : ''?>><?=$i?>期</option>
		
		<?}?>
	</select>
	</ul>	
<table id="listTables" class="listTables" style="margin-bottom:5px;">
	
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                         
                          <td height="40" align="center"bgcolor="#F2F4F6">
                          <input type="button"  class="<?=$se16?>" value="特码A" onClick="window.location.href='?type=16&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se1?>" value="特码B/波色/生肖" onClick="window.location.href='?type=7&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se2?>" value="正一特" onClick="window.location.href='?type=1&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se3?>" value="正二特" onClick="window.location.href='?type=2&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se4?>" value="正三特" onClick="window.location.href='?type=3&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se5?>" value="正四特" onClick="window.location.href='?type=4&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se6?>" value="正五特" onClick="window.location.href='?type=5&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se7?>" value="正六特" onClick="window.location.href='?type=6&qi=<?=$qishu?>'"/>
                         
                          <input type="button"  class="<?=$se8?>" value="正码B" onClick="window.location.href='?type=8&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se9?>" value="总和" onClick="window.location.href='?type=9&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se10?>" value="一肖/尾数" onClick="window.location.href='?type=10&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se11?>" value="连码" onClick="window.location.href='?type=11&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se12?>" value="合肖" onClick="window.location.href='?type=12&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se13?>" value="生肖连" onClick="window.location.href='?type=13&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se14?>" value="尾数连" onClick="window.location.href='?type=14&qi=<?=$qishu?>'"/>
                          <input type="button"  class="<?=$se15?>" value="全不中" onClick="window.location.href='?type=15&qi=<?=$qishu?>'"/>
                          </td>
                        </tr>
                                <tr>
                         
                          <td height="40" align="center" bgcolor="#F2F4F6">
						  <input type="button"  class="<?=$se16?>" value="<?=$listarr['特码A']?>" />
                          <input type="button"  class="<?=$se1?>" value="<?=$listarr['特码B']?>" />
                          <input type="button"  class="<?=$se2?>" value="<?=$listarr['正一']?>" />
                          <input type="button"  class="<?=$se3?>" value="<?=$listarr['正二']?>" />
                          <input type="button"  class="<?=$se4?>" value="<?=$listarr['正三']?>" />
                          <input type="button"  class="<?=$se5?>" value="<?=$listarr['正四']?>" />
                          <input type="button"  class="<?=$se6?>" value="<?=$listarr['正五']?>"/>
                          <input type="button"  class="<?=$se7?>" value="<?=$listarr['正六']?>" />
                          <input type="button"  class="<?=$se8?>" value="<?=$listarr['正码']?>" />
                          <input type="button"  class="<?=$se9?>" value="<?=$listarr['总和']?>" />
                          <input type="button"  class="<?=$se10?>" value="<?=$listarr['一肖/尾数']?>" />
                          <input type="button"  class="<?=$se11?>" value="<?=$listarr['连码']?>" />
                          <input type="button"  class="<?=$se12?>" value="<?=$listarr['合肖']?>" />
                          <input type="button"  class="<?=$se13?>" value="<?=$listarr['连肖']?>" />
                          <input type="button"  class="<?=$se14?>" value="<?=$listarr['连尾']?>" />
                          <input type="button"  class="<?=$se15?>" value="<?=$listarr['自选不中']?>" />
                          </td>
                        </tr>
                    <tr>
                         <td height="40" colspan="10" align="center" bgcolor="#F2F4F6">投注总额：<input type="text" value="<?=$money?>" class="formButton" />中奖总额：<input type="text" value="<?=$win?>" class="formButton" />盈利总额：<input type="text" value="<?=$money-$win?>" class="formButton" /></td>
    </tr>
                        
                        </form>
              </table>
<?php if($type<8){?>
                    <table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_11" id="tzNum_11" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_11" id="ylNum_11" /></td>
                          
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_21" id="tzNum_21" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_21" id="ylNum_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_31" id="tzNum_31" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_31" id="ylNum_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_41" id="Num_41" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_41" id="tzNum_41" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_41" id="ylNum_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_12" id="tzNum_12" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_12" id="ylNum_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_22" id="tzNum_22" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_22" id="ylNum_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_32" id="tzNum_32" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_32" id="ylNum_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_42" id="Num_42" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_42" id="tzNum_42" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_42" id="ylNum_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_13" id="tzNum_13" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_13" id="ylNum_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_23" id="tzNum_23" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_23" id="ylNum_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_33" id="tzNum_33" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_33" id="ylNum_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_43" id="Num_43" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_43" id="tzNum_43" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_43" id="ylNum_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_14" id="tzNum_14" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_14" id="ylNum_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_24" id="tzNum_24" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_24" id="ylNum_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_34" id="tzNum_34" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_34" id="ylNum_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_44" id="Num_44" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_44" id="tzNum_44" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_44" id="ylNum_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_15" id="tzNum_15" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_15" id="ylNum_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_25" id="tzNum_25" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_25" id="ylNum_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_35" id="tzNum_35" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_35" id="ylNum_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_45" id="Num_45" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_45" id="tzNum_45" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_45" id="ylNum_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_16" id="tzNum_16" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_16" id="ylNum_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_26" id="tzNum_26" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_26" id="ylNum_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_36" id="tzNum_36" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_36" id="ylNum_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_46" id="Num_46" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_46" id="tzNum_46" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_46" id="ylNum_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_17" id="tzNum_17" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_17" id="ylNum_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_27" id="tzNum_27" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_27" id="ylNum_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_37" id="tzNum_37" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_37" id="ylNum_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_47" id="Num_47" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_47" id="tzNum_47" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_47" id="ylNum_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_28" id="tzNum_28" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_28" id="ylNum_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_38" id="tzNum_38" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_38" id="ylNum_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_48" id="Num_48" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_48" id="tzNum_48" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_48" id="ylNum_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_9" id="tzNum_9" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_9" id="ylNum_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_19" id="tzNum_19" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_19" id="ylNum_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_29" id="tzNum_29" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_29" id="ylNum_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_39" id="tzNum_39" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_39" id="ylNum_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_49" id="Num_49" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_49" id="tzNum_49" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_49" id="ylNum_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_10" id="tzNum_10" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_10" id="ylNum_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_50" id="Num_50" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_50" id="tzNum_50" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_50" id="ylNum_50" /></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_51" id="Num_51" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_51" id="tzNum_51" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_51" id="ylNum_51" /></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_52" id="Num_52" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_52" id="tzNum_52" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_52" id="ylNum_52" /></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_53" id="Num_53" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_53" id="tzNum_53" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_53" id="ylNum_53" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">合大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_54" id="Num_54" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_54" id="tzNum_54" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_54" id="ylNum_54" /></td>
                          <td align="center"bgcolor="#FFFFFF">合小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_55" id="Num_55" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_55" id="tzNum_55" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_55" id="ylNum_55" /></td>
                          <td align="center"bgcolor="#FFFFFF">合单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_56" id="Num_56" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_56" id="tzNum_56" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_56" id="ylNum_56" /></td>
                          <td align="center"bgcolor="#FFFFFF">合双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_57" id="Num_57" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_57" id="tzNum_57" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_57" id="ylNum_57" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">尾大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_58" id="Num_58" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_58" id="tzNum_58" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_58" id="ylNum_58" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_59" id="Num_59" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_59" id="tzNum_59" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_59" id="ylNum_59" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_60" id="Num_60" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_60" id="tzNum_60" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_60" id="ylNum_60" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_61" id="Num_61" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_61" id="tzNum_61" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_61" id="ylNum_61" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">红波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_62" id="Num_62" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_62" id="tzNum_62" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_62" id="ylNum_62" /></td>
                          <td align="center"bgcolor="#FFFFFF">蓝波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_63" id="Num_63" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_63" id="tzNum_63" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_63" id="ylNum_63" /></td>
                          <td align="center"bgcolor="#FFFFFF">绿波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_64" id="Num_64" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_64" id="tzNum_64" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_64" id="ylNum_64" /></td>
                          <td colspan="4" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_65" id="Num_65" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_65" id="tzNum_65" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_65" id="ylNum_65" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_66" id="Num_66" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_66" id="tzNum_66" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_66" id="ylNum_66" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_67" id="Num_67" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_67" id="tzNum_67" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_67" id="ylNum_67" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_68" id="Num_68" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_68" id="tzNum_68" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_68" id="ylNum_68" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_69" id="Num_69" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_69" id="tzNum_69" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_69" id="ylNum_69" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_70" id="Num_70" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_70" id="tzNum_70" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_70" id="ylNum_70" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_71" id="Num_71" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_71" id="tzNum_71" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_71" id="ylNum_71" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_72" id="Num_72" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_72" id="tzNum_72" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_72" id="ylNum_72" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_73" id="Num_73" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_73" id="tzNum_73" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_73" id="ylNum_73" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_74" id="Num_74" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_74" id="tzNum_74" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_74" id="ylNum_74" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_75" id="Num_75" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_75" id="tzNum_75" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_75" id="ylNum_75" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_76" id="Num_76" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_76" id="tzNum_76" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_76" id="ylNum_76" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        </form>
</table><?php }else if($type==8){?><table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_11" id="tzNum_11" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_11" id="ylNum_11" /></td>
                          
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_21" id="tzNum_21" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_21" id="ylNum_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_31" id="tzNum_31" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_31" id="ylNum_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_41" id="Num_41" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_41" id="tzNum_41" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_41" id="ylNum_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_12" id="tzNum_12" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_12" id="ylNum_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_22" id="tzNum_22" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_22" id="ylNum_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_32" id="tzNum_32" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_32" id="ylNum_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_42" id="Num_42" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_42" id="tzNum_42" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_42" id="ylNum_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_13" id="tzNum_13" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_13" id="ylNum_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_23" id="tzNum_23" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_23" id="ylNum_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_33" id="tzNum_33" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_33" id="ylNum_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_43" id="Num_43" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_43" id="tzNum_43" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_43" id="ylNum_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_14" id="tzNum_14" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_14" id="ylNum_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_24" id="tzNum_24" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_24" id="ylNum_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_34" id="tzNum_34" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_34" id="ylNum_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_44" id="Num_44" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_44" id="tzNum_44" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_44" id="ylNum_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_15" id="tzNum_15" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_15" id="ylNum_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_25" id="tzNum_25" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_25" id="ylNum_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_35" id="tzNum_35" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_35" id="ylNum_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_45" id="Num_45" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_45" id="tzNum_45" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_45" id="ylNum_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_16" id="tzNum_16" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_16" id="ylNum_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_26" id="tzNum_26" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_26" id="ylNum_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_36" id="tzNum_36" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_36" id="ylNum_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_46" id="Num_46" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_46" id="tzNum_46" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_46" id="ylNum_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_17" id="tzNum_17" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_17" id="ylNum_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_27" id="tzNum_27" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_27" id="ylNum_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_37" id="tzNum_37" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_37" id="ylNum_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_47" id="Num_47" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_47" id="tzNum_47" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_47" id="ylNum_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_28" id="tzNum_28" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_28" id="ylNum_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_38" id="tzNum_38" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_38" id="ylNum_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_48" id="Num_48" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_48" id="tzNum_48" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_48" id="ylNum_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_9" id="tzNum_9" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_9" id="ylNum_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_19" id="tzNum_19" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_19" id="ylNum_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_29" id="tzNum_29" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_29" id="ylNum_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_39" id="tzNum_39" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_39" id="ylNum_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_49" id="Num_49" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_49" id="tzNum_49" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_49" id="ylNum_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_10" id="tzNum_10" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_10" id="ylNum_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                  
                      
                   
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_65" id="Num_65" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_65" id="tzNum_65" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_65" id="ylNum_65" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_66" id="Num_66" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_66" id="tzNum_66" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_66" id="ylNum_66" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_67" id="Num_67" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_67" id="tzNum_67" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_67" id="ylNum_67" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_68" id="Num_68" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_68" id="tzNum_68" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_68" id="ylNum_68" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_69" id="Num_69" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_69" id="tzNum_69" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_69" id="ylNum_69" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_70" id="Num_70" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_70" id="tzNum_70" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_70" id="ylNum_70" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_71" id="Num_71" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_71" id="tzNum_71" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_71" id="ylNum_71" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_72" id="Num_72" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_72" id="tzNum_72" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_72" id="ylNum_72" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_73" id="Num_73" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_73" id="tzNum_73" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_73" id="ylNum_73" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_74" id="Num_74" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_74" id="tzNum_74" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_74" id="ylNum_74" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_75" id="Num_75" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_75" id="tzNum_75" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_75" id="ylNum_75" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_76" id="Num_76" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_76" id="tzNum_76" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_76" id="ylNum_76" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr></form>
</table>
<?php }else if($type==17){?><table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                      <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_11" id="tzNum_11" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_11" id="ylNum_11" /></td>
                          
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_21" id="tzNum_21" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_21" id="ylNum_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_31" id="tzNum_31" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_31" id="ylNum_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_41" id="Num_41" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_41" id="tzNum_41" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_41" id="ylNum_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_12" id="tzNum_12" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_12" id="ylNum_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_22" id="tzNum_22" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_22" id="ylNum_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_32" id="tzNum_32" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_32" id="ylNum_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_42" id="Num_42" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_42" id="tzNum_42" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_42" id="ylNum_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_13" id="tzNum_13" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_13" id="ylNum_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_23" id="tzNum_23" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_23" id="ylNum_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_33" id="tzNum_33" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_33" id="ylNum_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_43" id="Num_43" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_43" id="tzNum_43" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_43" id="ylNum_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_14" id="tzNum_14" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_14" id="ylNum_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_24" id="tzNum_24" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_24" id="ylNum_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_34" id="tzNum_34" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_34" id="ylNum_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_44" id="Num_44" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_44" id="tzNum_44" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_44" id="ylNum_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_15" id="tzNum_15" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_15" id="ylNum_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_25" id="tzNum_25" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_25" id="ylNum_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_35" id="tzNum_35" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_35" id="ylNum_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_45" id="Num_45" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_45" id="tzNum_45" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_45" id="ylNum_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_16" id="tzNum_16" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_16" id="ylNum_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_26" id="tzNum_26" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_26" id="ylNum_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_36" id="tzNum_36" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_36" id="ylNum_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_46" id="Num_46" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_46" id="tzNum_46" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_46" id="ylNum_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_17" id="tzNum_17" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_17" id="ylNum_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_27" id="tzNum_27" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_27" id="ylNum_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_37" id="tzNum_37" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_37" id="ylNum_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_47" id="Num_47" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_47" id="tzNum_47" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_47" id="ylNum_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_28" id="tzNum_28" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_28" id="ylNum_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_38" id="tzNum_38" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_38" id="ylNum_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_48" id="Num_48" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_48" id="tzNum_48" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_48" id="ylNum_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_9" id="tzNum_9" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_9" id="ylNum_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_19" id="tzNum_19" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_19" id="ylNum_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_29" id="tzNum_29" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_29" id="ylNum_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_39" id="tzNum_39" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_39" id="ylNum_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_49" id="Num_49" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_49" id="tzNum_49" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_49" id="ylNum_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_10" id="tzNum_10" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_10" id="ylNum_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr></form>
</table>
<?php }else if($type==16){?><table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                      
                       <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_11" id="tzNum_11" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_11" id="ylNum_11" /></td>
                          
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_21" id="tzNum_21" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_21" id="ylNum_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_31" id="tzNum_31" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_31" id="ylNum_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_41" id="Num_41" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_41" id="tzNum_41" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_41" id="ylNum_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_12" id="tzNum_12" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_12" id="ylNum_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_22" id="tzNum_22" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_22" id="ylNum_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_32" id="tzNum_32" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_32" id="ylNum_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_42" id="Num_42" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_42" id="tzNum_42" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_42" id="ylNum_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_13" id="tzNum_13" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_13" id="ylNum_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_23" id="tzNum_23" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_23" id="ylNum_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_33" id="tzNum_33" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_33" id="ylNum_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_43" id="Num_43" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_43" id="tzNum_43" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_43" id="ylNum_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_14" id="tzNum_14" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_14" id="ylNum_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_24" id="tzNum_24" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_24" id="ylNum_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_34" id="tzNum_34" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_34" id="ylNum_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_44" id="Num_44" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_44" id="tzNum_44" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_44" id="ylNum_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_15" id="tzNum_15" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_15" id="ylNum_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_25" id="tzNum_25" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_25" id="ylNum_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_35" id="tzNum_35" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_35" id="ylNum_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_45" id="Num_45" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_45" id="tzNum_45" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_45" id="ylNum_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_16" id="tzNum_16" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_16" id="ylNum_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_26" id="tzNum_26" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_26" id="ylNum_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_36" id="tzNum_36" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_36" id="ylNum_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_46" id="Num_46" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_46" id="tzNum_46" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_46" id="ylNum_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_17" id="tzNum_17" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_17" id="ylNum_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_27" id="tzNum_27" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_27" id="ylNum_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_37" id="tzNum_37" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_37" id="ylNum_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_47" id="Num_47" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_47" id="tzNum_47" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_47" id="ylNum_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_28" id="tzNum_28" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_28" id="ylNum_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_38" id="tzNum_38" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_38" id="ylNum_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_48" id="Num_48" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_48" id="tzNum_48" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_48" id="ylNum_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_9" id="tzNum_9" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_9" id="ylNum_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_19" id="tzNum_19" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_19" id="ylNum_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_29" id="tzNum_29" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_29" id="ylNum_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_39" id="tzNum_39" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_39" id="ylNum_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_49" id="Num_49" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_49" id="tzNum_49" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_49" id="ylNum_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_10" id="tzNum_10" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_10" id="ylNum_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_50" id="Num_50" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_50" id="tzNum_50" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_50" id="ylNum_50" /></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_51" id="Num_51" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_51" id="tzNum_51" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_51" id="ylNum_51" /></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_52" id="Num_52" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_52" id="tzNum_52" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_52" id="ylNum_52" /></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_53" id="Num_53" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_53" id="tzNum_53" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_53" id="ylNum_53" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">合大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_54" id="Num_54" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_54" id="tzNum_54" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_54" id="ylNum_54" /></td>
                          <td align="center"bgcolor="#FFFFFF">合小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_55" id="Num_55" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_55" id="tzNum_55" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_55" id="ylNum_55" /></td>
                          <td align="center"bgcolor="#FFFFFF">合单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_56" id="Num_56" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_56" id="tzNum_56" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_56" id="ylNum_56" /></td>
                          <td align="center"bgcolor="#FFFFFF">合双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_57" id="Num_57" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_57" id="tzNum_57" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_57" id="ylNum_57" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">尾大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_58" id="Num_58" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_58" id="tzNum_58" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_58" id="ylNum_58" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_59" id="Num_59" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_59" id="tzNum_59" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_59" id="ylNum_59" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_60" id="Num_60" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_60" id="tzNum_60" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_60" id="ylNum_60" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_61" id="Num_61" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_61" id="tzNum_61" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_61" id="ylNum_61" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr></form>
</table>
<?php }else if($type==9){?>
  <table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                 <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">总和大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                      </tr>
                     </form>
                </table>
<?php }else if($type==10){?>
  <table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                  <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                                <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
	
	                       <td height="28" align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>

                      </tr>
                        <tr>
                            <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
		
	                       <td height="28" align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_8" id="tzNum_8" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_8" id="ylNum_8" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_9" id="tzNum_9" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_9" id="ylNum_9" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_10" id="tzNum_10" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_10" id="ylNum_10" /></td>
						  

                      </tr>
                        <tr>
                         <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_11" id="tzNum_11" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_11" id="ylNum_11" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_12" id="tzNum_12" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_12" id="ylNum_12" /></td>
						  

                        </tr>
                        <tr>
                        <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_13" id="tzNum_13" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_13" id="ylNum_13" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_14" id="tzNum_14" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_14" id="ylNum_14" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_15" id="tzNum_15" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_15" id="ylNum_15" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_16" id="tzNum_16" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_16" id="ylNum_16" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_17" id="tzNum_17" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_17" id="ylNum_17" /></td>

                      </tr>
                        <tr>
                         <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_18" id="tzNum_18" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_18" id="ylNum_18" /></td>
                      <td height="28" align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_19" id="tzNum_19" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_19" id="ylNum_19" /></td>	
	                       <td height="28" align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_20" id="tzNum_20" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_20" id="ylNum_20" /></td>
                          <td height="28" align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_21" id="tzNum_21" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_21" id="ylNum_21" /></td>
           <td height="28" align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_22" id="tzNum_22" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_22" id="ylNum_22" /></td>
                      </tr></form>
                </table>
<?php }else if($type==11){?>
					<table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                      <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">四全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">三全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">三中二-中二</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">三中二-中三</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">二全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">二中特-中特</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">二中特-中二</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">特串</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /><input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_8" id="tzNum_8" />
                             <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_8" id="ylNum_8" /></td>
                          <td align="center"bgcolor="#FFFFFF" colspan="4">&nbsp;</td>
                      </tr></form>
                </table>     
<?php }else if($type==12){?>
					<table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                            <td height="28" align="center"bgcolor="#FFFFFF">2肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
						
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">3肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" />
						 </td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">4肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" />
						 </td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">5肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" />
						 </td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">6肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /></td>
						
                      </tr>
                        <tr>
                              <td height="28" align="center"bgcolor="#FFFFFF">7肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">8肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /></td>
	                       <td height="28" align="center"bgcolor="#FFFFFF">9肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /></td>
                           <td height="28" align="center"bgcolor="#FFFFFF">10肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /></td>

	                       <td height="28" align="center"bgcolor="#FFFFFF">11肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /></td>
						 
					
                           </tr>
                               <tr>
                              <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                          </td>
	                       <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td> 
                          
                          </td>
	                      
						 
					
                           </tr></form>
  </table>   
<?php }else if($type==13){?>
  <table id="listTables" class="listTables">
                 <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                    	<tr><td colspan="10" align="center" style="background:#101010;color:#fff;">二肖连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /></td>
                                                 <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                        </tr>
                        
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">三肖连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /></td>
                                                    <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                        </tr>
                        
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">四肖连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /></td>
                                           <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                        </tr>
                        
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">五肖连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_41" id="Num_41" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_42" id="Num_42" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_43" id="Num_43" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_44" id="Num_44" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_45" id="Num_45" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_46" id="Num_46" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_47" id="Num_47" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_48" id="Num_48" /></td>
                         
                          
                          <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                         
                        </tr></form>
                </table>
<?php }else if($type==14){?>
  <table id="listTables" class="listTables">
                     <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                    	<tr><td colspan="10" align="center" style="background:#101010;color:#fff;">二尾连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_10" id="Num_10" /></td>
                      </tr>
                          <tr>
                           <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
                      </tr>
                        
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">三尾连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>

                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_15" id="Num_15" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_20" id="Num_20" /></td>
                      </tr>
                               <tr>
                           <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
                      </tr>
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">四尾连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_25" id="Num_25" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_30" id="Num_30" /></td>
                      </tr>
                               <tr>
                           <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
                      </tr>
                        <tr>
                          <td colspan="10" align="center" style="background:#101010;color:#fff;">五尾连中</td></tr>
                        <tr>
                          <td width="50" height="22" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                          <td width="50" align="center">号码</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_35" id="Num_35" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_40" id="Num_40" /></td>
                      </tr>
                               <tr>
                           <td align="center" bgcolor="#FFFFFF" style="color:red">投注</td>
                          <td align="center"bgcolor="#FFFFFF">
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" /></td>
                          <td align="center" bgcolor="#FFFFFF" style="color:red">中奖</td>
                          <td align="center"bgcolor="#FFFFFF">    
                           <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
                      </tr></form>
  </table>
<?php }else if($type==15){?>
					<table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                   <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                              <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                          <th width="50" align="center">号码</th>
                                  <th align="center">当前赔率/下注金额/中奖金额</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_1" id="Num_1" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_1" id="tzNum_1" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_1" id="ylNum_1" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">6不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_2" id="Num_2" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_2" id="tzNum_2" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_2" id="ylNum_2" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">7不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_3" id="Num_3" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_3" id="tzNum_3" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_3" id="ylNum_3" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">8不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_4" id="Num_4" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_4" id="tzNum_4" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_4" id="ylNum_4" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">9不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_5" id="Num_5" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_5" id="tzNum_5" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_5" id="ylNum_5" /></td>
						  

                      </tr>
                        <tr>
                                 <td height="28" align="center"bgcolor="#FFFFFF">10不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_6" id="Num_6" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_6" id="tzNum_6" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_6" id="ylNum_6" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">11不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_7" id="Num_7" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_7" id="tzNum_7" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_7" id="ylNum_7" /></td>
						  

	
	                       <td height="28" align="center"bgcolor="#FFFFFF">12不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4"  value="0" readonly="readonly"  name="Num_8" id="Num_8" />
						  <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="tzNum_8" id="tzNum_8" />
                          <input class="formOdds captcha" maxlength="6" size="4" readonly="readonly" value="0" name="ylNum_8" id="ylNum_8" /></td>

                      </tr>
                       </form>
  </table>  
<?php }?>
  </div>
<script type="text/javascript">loadinfo();</script>
</body>
</html>