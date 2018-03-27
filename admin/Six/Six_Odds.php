<?php
header("Content-type: text/html; charset=utf-8");
include_once("../common/login_check.php");
check_quanxian("ssgl"); ini_set('display_errors','yes');
include_once("../../include/mysqli.php");
$type = $_REQUEST['type'];
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
if($save=='ok'){
	if($type<8){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28'].",h29=".$_REQUEST['Num_29'].",h30=".$_REQUEST['Num_30'].",";
		$sql.="h31=".$_REQUEST['Num_31'].",h32=".$_REQUEST['Num_32'].",h33=".$_REQUEST['Num_33'].",h34=".$_REQUEST['Num_34'].",h35=".$_REQUEST['Num_35'].",h36=".$_REQUEST['Num_36'].",h37=".$_REQUEST['Num_37'].",h38=".$_REQUEST['Num_38'].",h39=".$_REQUEST['Num_39'].",h40=".$_REQUEST['Num_40'].",";
		$sql.="h41=".$_REQUEST['Num_41'].",h42=".$_REQUEST['Num_42'].",h43=".$_REQUEST['Num_43'].",h44=".$_REQUEST['Num_44'].",h45=".$_REQUEST['Num_45'].",h46=".$_REQUEST['Num_46'].",h47=".$_REQUEST['Num_47'].",h48=".$_REQUEST['Num_48'].",h49=".$_REQUEST['Num_49'].",h50=".$_REQUEST['Num_50'].",";
		$sql.="h51=".$_REQUEST['Num_51'].",h52=".$_REQUEST['Num_52'].",h53=".$_REQUEST['Num_53'].",h54=".$_REQUEST['Num_54'].",h55=".$_REQUEST['Num_55'].",h56=".$_REQUEST['Num_56'].",h57=".$_REQUEST['Num_57'].",h58=".$_REQUEST['Num_58'].",h59=".$_REQUEST['Num_59'].",h60=".$_REQUEST['Num_60'].",";
		$sql.="h61=".$_REQUEST['Num_61'].",h62=".$_REQUEST['Num_62'].",h63=".$_REQUEST['Num_63'].",h64=".$_REQUEST['Num_64'].",h65=".$_REQUEST['Num_65'].",h66=".$_REQUEST['Num_66'].",h67=".$_REQUEST['Num_67'].",h68=".$_REQUEST['Num_68'].",h69=".$_REQUEST['Num_69'].",h70=".$_REQUEST['Num_70'].",";
		$sql.="h71=".$_REQUEST['Num_71'].",h72=".$_REQUEST['Num_72'].",h73=".$_REQUEST['Num_73'].",h74=".$_REQUEST['Num_74'].",h75=".$_REQUEST['Num_75'].",h76=".$_REQUEST['Num_76']."";
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==8){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28'].",h29=".$_REQUEST['Num_29'].",h30=".$_REQUEST['Num_30'].",";
		$sql.="h31=".$_REQUEST['Num_31'].",h32=".$_REQUEST['Num_32'].",h33=".$_REQUEST['Num_33'].",h34=".$_REQUEST['Num_34'].",h35=".$_REQUEST['Num_35'].",h36=".$_REQUEST['Num_36'].",h37=".$_REQUEST['Num_37'].",h38=".$_REQUEST['Num_38'].",h39=".$_REQUEST['Num_39'].",h40=".$_REQUEST['Num_40'].",";
		$sql.="h41=".$_REQUEST['Num_41'].",h42=".$_REQUEST['Num_42'].",h43=".$_REQUEST['Num_43'].",h44=".$_REQUEST['Num_44'].",h45=".$_REQUEST['Num_45'].",h46=".$_REQUEST['Num_46'].",h47=".$_REQUEST['Num_47'].",h48=".$_REQUEST['Num_48'].",h49=".$_REQUEST['Num_49'].",";
		$sql.="h65=".$_REQUEST['Num_65'].",h66=".$_REQUEST['Num_66'].",h67=".$_REQUEST['Num_67'].",h68=".$_REQUEST['Num_68'].",h69=".$_REQUEST['Num_69'].",h70=".$_REQUEST['Num_70'].",";
		$sql.="h71=".$_REQUEST['Num_71'].",h72=".$_REQUEST['Num_72'].",h73=".$_REQUEST['Num_73'].",h74=".$_REQUEST['Num_74'].",h75=".$_REQUEST['Num_75'].",h76=".$_REQUEST['Num_76']."";
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==9){
		$sql	=	"update c_odds_0 set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==10){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'];
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==11){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'];
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==12){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'];
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==13){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28'].",h29=".$_REQUEST['Num_29'].",h30=".$_REQUEST['Num_30'].",";
		$sql.="h31=".$_REQUEST['Num_31'].",h32=".$_REQUEST['Num_32'].",h33=".$_REQUEST['Num_33'].",h34=".$_REQUEST['Num_34'].",h35=".$_REQUEST['Num_35'].",h36=".$_REQUEST['Num_36'].",h37=".$_REQUEST['Num_37'].",h38=".$_REQUEST['Num_38'].",h39=".$_REQUEST['Num_39'].",h40=".$_REQUEST['Num_40'].",";
		$sql.="h41=".$_REQUEST['Num_41'].",h42=".$_REQUEST['Num_42'].",h43=".$_REQUEST['Num_43'].",h44=".$_REQUEST['Num_44'].",h45=".$_REQUEST['Num_45'].",h46=".$_REQUEST['Num_46'].",h47=".$_REQUEST['Num_47'].",h48=".$_REQUEST['Num_48'];
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
		
	}
	elseif($type==14){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28'].",h29=".$_REQUEST['Num_29'].",h30=".$_REQUEST['Num_30'].",";
		$sql.="h31=".$_REQUEST['Num_31'].",h32=".$_REQUEST['Num_32'].",h33=".$_REQUEST['Num_33'].",h34=".$_REQUEST['Num_34'].",h35=".$_REQUEST['Num_35'].",h36=".$_REQUEST['Num_36'].",h37=".$_REQUEST['Num_37'].",h38=".$_REQUEST['Num_38'].",h39=".$_REQUEST['Num_39'].",h40=".$_REQUEST['Num_40'];
		$sql.=" where type='ball_".$type."'";
		//echo $sql;exit;
		$mysqli->query($sql);
		
	}
	elseif($type==15){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'];
		$sql.=" where type='ball_".$type."'";
		$mysqli->query($sql);
	}elseif($type==16 || $type==17){
		$sql ="update c_odds_0 set ";
		$sql.="h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",";
		$sql.="h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",";
		$sql.="h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28'].",h29=".$_REQUEST['Num_29'].",h30=".$_REQUEST['Num_30'].",";
		$sql.="h31=".$_REQUEST['Num_31'].",h32=".$_REQUEST['Num_32'].",h33=".$_REQUEST['Num_33'].",h34=".$_REQUEST['Num_34'].",h35=".$_REQUEST['Num_35'].",h36=".$_REQUEST['Num_36'].",h37=".$_REQUEST['Num_37'].",h38=".$_REQUEST['Num_38'].",h39=".$_REQUEST['Num_39'].",h40=".$_REQUEST['Num_40'].",";
		$sql.="h41=".$_REQUEST['Num_41'].",h42=".$_REQUEST['Num_42'].",h43=".$_REQUEST['Num_43'].",h44=".$_REQUEST['Num_44'].",h45=".$_REQUEST['Num_45'].",h46=".$_REQUEST['Num_46'].",h47=".$_REQUEST['Num_47'].",h48=".$_REQUEST['Num_48'].",h49=".$_REQUEST['Num_49'].",h50=".$_REQUEST['Num_50'].",";
		$sql.="h51=".$_REQUEST['Num_51'].",h52=".$_REQUEST['Num_52'].",h53=".$_REQUEST['Num_53'].",h54=".$_REQUEST['Num_54'].",h55=".$_REQUEST['Num_55'].",h56=".$_REQUEST['Num_56'].",h57=".$_REQUEST['Num_57'].",h58=".$_REQUEST['Num_58'].",h59=".$_REQUEST['Num_59'].",h60=".$_REQUEST['Num_60'].",h61=".$_REQUEST['Num_61']."";
		$sql.=" where type='ball_".$type."';";
		//echo $sql;exit;
		$mysqli->query($sql);
		$type==17 ? $h=2 : $h=1;
		$sql="update c_odds_0 set h$h=".$_REQUEST['fs']." where type='ball_18'";
		$mysqli->query($sql);
	}
	/*
	//写入缓存
	$sql="SELECT * FROM `c_odds_0` order by id";
	$query		= $mysqli->query($sql);
	$list 		= array();
	$j=1;
	while ($odds = $query->fetch_array()) {
		for($i = 1; $i<77; $i++){
			$list['ball'][$j][$i] = $odds['h'.$i];
		}
		$j++;
	}
	$arr = array(   
		'oddslist' => $list,    
	);  
	$json_string = json_encode($arr);
	if(!write_file("../../Six/Odds/6hc.html",$json_string)){ //写入缓存失败
		message("缓存文件写入失败！请先设6hc.txt文件权限为：0777","?type=".$type."");exit;
	}
	*/
	message("赔率修改完毕！","?type=".$type."");
	exit;
}

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
	$.get("get_odds_0.php?t=<?=time()?>", {type : <?=$type?>}, function(data)
		{
			for(var key in data.oddslist){
			odds = data.oddslist[key];
			$("#Num_"+key).val(odds);
			}<? if($type==16 || $type==17){?>
			$("#fs").val(data.fs);<? }?>
		}, "json");
}
</script>
</head>
<body class="list">
	<div class="bar">
		六合彩赔率修改
	</div>

<div class="body">
<ul id="tab" class="tab">
                <li><input type="button" value="六合彩赔率" hidefocus class="current"/></li>
			</ul>
<table id="listTables" class="listTables" style="margin-bottom:5px;">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                          <td height="40" align="center"bgcolor="#F2F4F6">
                          <input type="button"  class="<?=$se16?>" value="特码A" onClick="window.location.href='?type=16'"/>
                          <input type="button"  class="<?=$se1?>" value="特码B/波色/生肖" onClick="window.location.href='?type=7'"/>
                          <input type="button"  class="<?=$se2?>" value="正一特" onClick="window.location.href='?type=1'"/>
                          <input type="button"  class="<?=$se3?>" value="正二特" onClick="window.location.href='?type=2'"/>
                          <input type="button"  class="<?=$se4?>" value="正三特" onClick="window.location.href='?type=3'"/>
                          <input type="button"  class="<?=$se5?>" value="正四特" onClick="window.location.href='?type=4'"/>
                          <input type="button"  class="<?=$se6?>" value="正五特" onClick="window.location.href='?type=5'"/>
                          <input type="button"  class="<?=$se7?>" value="正六特" onClick="window.location.href='?type=6'"/>
                          <!--input type="button"  class="<?=$se17?>" value="正码A" onClick="window.location.href='?type=17'"/-->
                          <input type="button"  class="<?=$se8?>" value="正码" onClick="window.location.href='?type=8'"/>
                          <input type="button"  class="<?=$se9?>" value="总和" onClick="window.location.href='?type=9'"/>
                          <input type="button"  class="<?=$se10?>" value="一肖/尾数" onClick="window.location.href='?type=10'"/>
                          <input type="button"  class="<?=$se11?>" value="连码" onClick="window.location.href='?type=11'"/>
                          <input type="button"  class="<?=$se12?>" value="合肖" onClick="window.location.href='?type=12'"/>
                          <input type="button"  class="<?=$se13?>" value="生肖连" onClick="window.location.href='?type=13'"/>
                          <input type="button"  class="<?=$se14?>" value="尾数连" onClick="window.location.href='?type=14'"/>
                          <input type="button"  class="<?=$se15?>" value="全不中" onClick="window.location.href='?type=15'"/>
                          </td>
                        </tr></form>
              </table>
<?php if($type<8){?>
                    <table id="listTables" class="listTables">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr>
                          <th width="50" height="22" align="center">号码</th>
                          <th align="center">当前赔率</th>
                          <th width="50" align="center">号码</th>
                          <th align="center">当前赔率</th>
                          <th width="50" align="center">号码</th>
                          <th align="center">当前赔率</th>
                          <th width="50" align="center">号码</th>
                          <th align="center">当前赔率</th>
                          <th width="50" align="center">号码</th>
                          <th align="center">当前赔率</th>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_41" id="Num_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_42" id="Num_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_43" id="Num_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_44" id="Num_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_45" id="Num_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_46" id="Num_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_47" id="Num_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_48" id="Num_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_49" id="Num_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_50" id="Num_50" /></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_51" id="Num_51" /></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_52" id="Num_52" /></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_53" id="Num_53" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">合大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_54" id="Num_54" /></td>
                          <td align="center"bgcolor="#FFFFFF">合小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_55" id="Num_55" /></td>
                          <td align="center"bgcolor="#FFFFFF">合单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_56" id="Num_56" /></td>
                          <td align="center"bgcolor="#FFFFFF">合双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_57" id="Num_57" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">尾大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_58" id="Num_58" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_59" id="Num_59" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_60" id="Num_60" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_61" id="Num_61" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">红波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_62" id="Num_62" /></td>
                          <td align="center"bgcolor="#FFFFFF">蓝波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_63" id="Num_63" /></td>
                          <td align="center"bgcolor="#FFFFFF">绿波</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_64" id="Num_64" /></td>
                          <td colspan="4" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_65" id="Num_65" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_66" id="Num_66" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_67" id="Num_67" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_68" id="Num_68" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_69" id="Num_69" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_70" id="Num_70" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_71" id="Num_71" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_72" id="Num_72" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_73" id="Num_73" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_74" id="Num_74" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_75" id="Num_75" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_76" id="Num_76" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="40" colspan="10" align="center"bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
                      </tr></form>
</table><?php }else if($type==8){?><table id="listTables" class="listTables">
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
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_41" id="Num_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_42" id="Num_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_43" id="Num_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_44" id="Num_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_45" id="Num_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_46" id="Num_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_47" id="Num_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_48" id="Num_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_49" id="Num_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_65" id="Num_65" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_66" id="Num_66" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_67" id="Num_67" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_68" id="Num_68" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_69" id="Num_69" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_70" id="Num_70" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_71" id="Num_71" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_72" id="Num_72" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_73" id="Num_73" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_74" id="Num_74" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_75" id="Num_75" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_76" id="Num_76" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
</table>
<?php }else if($type==17){?><table id="listTables" class="listTables">
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
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_41" id="Num_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_42" id="Num_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_43" id="Num_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_44" id="Num_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_45" id="Num_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_46" id="Num_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_47" id="Num_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_48" id="Num_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_49" id="Num_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">返水</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="fs" id="fs" />%</td>
                          <td colspan="8" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
</table>
<?php }else if($type==16){?><table id="listTables" class="listTables">
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
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/01.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/11.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/21.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/31.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/41.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_41" id="Num_41" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/02.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/12.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/22.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/32.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/42.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_42" id="Num_42" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/03.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/13.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/23.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/33.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/43.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_43" id="Num_43" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/04.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/14.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/24.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/34.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/44.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_44" id="Num_44" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/05.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/15.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/25.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/35.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/45.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_45" id="Num_45" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/06.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/16.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/26.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/36.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/46.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_46" id="Num_46" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/07.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/17.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/27.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/37.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/47.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_47" id="Num_47" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/08.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/18.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/28.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/38.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/48.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_48" id="Num_48" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/09.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/19.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/29.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/39.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/49.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_49" id="Num_49" /></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="images/ball_0/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/20.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/30.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="images/ball_0/40.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
<tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_50" id="Num_50" /></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_51" id="Num_51" /></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_52" id="Num_52" /></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_53" id="Num_53" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">合大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_54" id="Num_54" /></td>
                          <td align="center"bgcolor="#FFFFFF">合小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_55" id="Num_55" /></td>
                          <td align="center"bgcolor="#FFFFFF">合单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_56" id="Num_56" /></td>
                          <td align="center"bgcolor="#FFFFFF">合双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_57" id="Num_57" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">尾大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_58" id="Num_58" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_59" id="Num_59" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_60" id="Num_60" /></td>
                          <td align="center"bgcolor="#FFFFFF">尾双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_61" id="Num_61" /></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">返水</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="fs" id="fs" />%</td>
                          <td colspan="8" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
</table>
<?php }else if($type==9){?>
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
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">总和大</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和小</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和单</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">总和双</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                      </tr>
                        <tr>
                          <td height="40" colspan="8" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
                </table>
<?php }else if($type==10){?>
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
                          <td height="28" align="center"bgcolor="#FFFFFF">鼠</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">0尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                      </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
                </table>
<?php }else if($type==11){?>
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
                          <td height="28" align="center"bgcolor="#FFFFFF">四全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">三全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">三中二-中二</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">三中二-中三</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">二全中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">二中特-中特</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">二中特-中二</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">特串</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF" colspan="4">&nbsp;</td>
                      </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
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
                          <td height="28" align="center"bgcolor="#FFFFFF">二肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">三肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">四肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">五肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">六肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">七肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">八肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">九肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">十肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">十一肖</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                      </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF">牛</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF">兔</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                          <td align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_41" id="Num_41" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">蛇</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_42" id="Num_42" /></td>
                          <td align="center"bgcolor="#FFFFFF">马</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_43" id="Num_43" /></td>
                          <td align="center"bgcolor="#FFFFFF">羊</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_44" id="Num_44" /></td>
                          <td align="center"bgcolor="#FFFFFF">猴</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_45" id="Num_45" /></td>
                          <td align="center"bgcolor="#FFFFFF">鸡</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_46" id="Num_46" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">狗</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_47" id="Num_47" /></td>
                          <td align="center"bgcolor="#FFFFFF">猪</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_48" id="Num_48" /></td>
                          <td colspan="6" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /></td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_27" id="Num_27" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_28" id="Num_28" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_29" id="Num_29" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_30" id="Num_30" /></td>
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
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_31" id="Num_31" /></td>
                          <td align="center"bgcolor="#FFFFFF">1尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_32" id="Num_32" /></td>
                          <td align="center"bgcolor="#FFFFFF">2尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_33" id="Num_33" /></td>
                          <td align="center"bgcolor="#FFFFFF">3尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_34" id="Num_34" /></td>
                          <td align="center"bgcolor="#FFFFFF">4尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_35" id="Num_35" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">5尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_36" id="Num_36" /></td>
                          <td align="center"bgcolor="#FFFFFF">6尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_37" id="Num_37" /></td>
                          <td align="center"bgcolor="#FFFFFF">7尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_38" id="Num_38" /></td>
                          <td align="center"bgcolor="#FFFFFF">8尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_39" id="Num_39" /></td>
                          <td align="center"bgcolor="#FFFFFF">9尾</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_40" id="Num_40" /></td>
                      </tr>
                        
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
  </table>
<?php }else if($type==15){?>
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
                          <td height="28" align="center"bgcolor="#FFFFFF">五不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                          <td align="center"bgcolor="#FFFFFF">六不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                          <td align="center"bgcolor="#FFFFFF">七不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                          <td align="center"bgcolor="#FFFFFF">八不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                          <td align="center"bgcolor="#FFFFFF">九不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                      </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">十不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                          <td align="center"bgcolor="#FFFFFF">十一不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                          <td align="center"bgcolor="#FFFFFF">十二不中</td>
                          <td align="center"bgcolor="#FFFFFF"><input class="formOdds captcha" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                          <td align="center"bgcolor="#FFFFFF" colspan="4"></td>
                      </tr>
                        <tr>
                          <td height="40" colspan="10" align="center" bgcolor="#F2F4F6"><input type="submit"  class="formButton" name="Submit" value="确认修改" /></td>
    </tr></form>
  </table>  
<?php }?>
  </div>
<script type="text/javascript">loadinfo();</script>
</body>
</html>