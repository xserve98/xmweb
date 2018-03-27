<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include("../../include/mysqli.php");
include ("../../Lottery/include/order_info.php");
if(is_numeric($_REQUEST['gameId'])){
	$gameId=intval($_REQUEST['gameId']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=4;
$gameName=get_gameName($gameId);
$type = $_REQUEST['type'];
$save = $_REQUEST['save'];
if($type==''){$type=1;}
$type=='1' ? $se1 = '#FF0' : $se1 = '#FFF';
$type=='2' ? $se2 = '#FF0' : $se2 = '#FFF';
$type=='3' ? $se3 = '#FF0' : $se3 = '#FFF';
$type=='4' ? $se4 = '#FF0' : $se4 = '#FFF';
$type=='5' ? $se5 = '#FF0' : $se5 = '#FFF';
$type=='6' ? $se6 = '#FF0' : $se6 = '#FFF';
$type=='7' ? $se7 = '#FF0' : $se7 = '#FFF';
$type=='8' ? $se8 = '#FF0' : $se8 = '#FFF';
$type=='9' ? $se9 = '#FF0' : $se9 = '#FFF';
$type=='10' ? $se10 = '#FF0' : $se10 = '#FFF';
$type=='11' ? $se11 = '#FF0' : $se11 = '#FFF';
$type=='12' ? $se12 = '#FF0' : $se12 = '#FFF';
$type=='13' ? $se13 = '#FF0' : $se13 = '#FFF';
$type=='14' ? $se14 = '#FF0' : $se14 = '#FFF';
$type=='15' ? $se15 = '#FF0' : $se15 = '#FFF';
$type=='16' ? $se16 = '#FF0' : $se16 = '#FFF';
$type=='17' ? $se17 = '#FF0' : $se17 = '#FFF';
if($save=='ok'){
	if($type==1){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",h21=".$_REQUEST['Num_21']." where type='ball_".$type."'";
        $mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5'].",h6=".$_REQUEST['CNum_6'].",h7=".$_REQUEST['CNum_7'].",h8=".$_REQUEST['CNum_8'].",h9=".$_REQUEST['CNum_9'].",h10=".$_REQUEST['CNum_10'].",h11=".$_REQUEST['CNum_11'].",h12=".$_REQUEST['CNum_12'].",h13=".$_REQUEST['CNum_13'].",h14=".$_REQUEST['CNum_14'].",h15=".$_REQUEST['CNum_15'].",h16=".$_REQUEST['CNum_16'].",h17=".$_REQUEST['CNum_17'].",h18=".$_REQUEST['CNum_18'].",h19=".$_REQUEST['CNum_19'].",h20=".$_REQUEST['CNum_20'].",h21=".$_REQUEST['CNum_21']." where type='ball_".$type."'";
        $mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_b set  h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5'].",h6=".$_REQUEST['BNum_6'].",h7=".$_REQUEST['BNum_7'].",h8=".$_REQUEST['BNum_8'].",h9=".$_REQUEST['BNum_9'].",h10=".$_REQUEST['BNum_10'].",h11=".$_REQUEST['BNum_11'].",h12=".$_REQUEST['BNum_12'].",h13=".$_REQUEST['BNum_13'].",h14=".$_REQUEST['BNum_14'].",h15=".$_REQUEST['BNum_15'].",h16=".$_REQUEST['BNum_16'].",h17=".$_REQUEST['BNum_17'].",h18=".$_REQUEST['BNum_18'].",h19=".$_REQUEST['BNum_19'].",h20=".$_REQUEST['BNum_20'].",h21=".$_REQUEST['BNum_21']." where type='ball_".$type."'";
        $mysqli->query($sql);
        echo "<script>alert(\"赔率修改完毕！\");window.open('odds4.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>";
		exit;
	}
	else if($type<12){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14']." where type='ball_".$type."'";
        $mysqli->query($sql);
		
	$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5'].",h6=".$_REQUEST['BNum_6'].",h7=".$_REQUEST['BNum_7'].",h8=".$_REQUEST['BNum_8'].",h9=".$_REQUEST['BNum_9'].",h10=".$_REQUEST['BNum_10'].",h11=".$_REQUEST['BNum_11'].",h12=".$_REQUEST['BNum_12'].",h13=".$_REQUEST['BNum_13'].",h14=".$_REQUEST['BNum_14']." where type='ball_".$type."'";
        $mysqli->query($sql);
		
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5'].",h6=".$_REQUEST['CNum_6'].",h7=".$_REQUEST['CNum_7'].",h8=".$_REQUEST['CNum_8'].",h9=".$_REQUEST['CNum_9'].",h10=".$_REQUEST['CNum_10'].",h11=".$_REQUEST['CNum_11'].",h12=".$_REQUEST['CNum_12'].",h13=".$_REQUEST['CNum_13'].",h14=".$_REQUEST['CNum_14']." where type='ball_".$type."'";
        $mysqli->query($sql);
        echo "<script>alert(\"赔率修改完毕！\");window.open('odds4.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}
	else if($type>=12 && $type<17){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2']." where type='ball_".$type."'";
		$mysqli->query($sql);
			
			echo "<script>alert(\"赔率修改完毕！\");window.open('odds4.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}else if($type==17){
	     $sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26']." where type='ball_".$type."'";
     
	  $mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5'].",h6=".$_REQUEST['BNum_6'].",h7=".$_REQUEST['BNum_7'].",h8=".$_REQUEST['BNum_8'].",h9=".$_REQUEST['BNum_9'].",h10=".$_REQUEST['BNum_10'].",h11=".$_REQUEST['BNum_11'].",h12=".$_REQUEST['BNum_12'].",h13=".$_REQUEST['BNum_13'].",h14=".$_REQUEST['BNum_14'].",h15=".$_REQUEST['BNum_15'].",h16=".$_REQUEST['BNum_16'].",h17=".$_REQUEST['BNum_17'].",h18=".$_REQUEST['BNum_18'].",h19=".$_REQUEST['BNum_19'].",h20=".$_REQUEST['BNum_20'].",h21=".$_REQUEST['BNum_21'].",h22=".$_REQUEST['BNum_22'].",h23=".$_REQUEST['BNum_23'].",h24=".$_REQUEST['BNum_24'].",h25=".$_REQUEST['BNum_25'].",h26=".$_REQUEST['BNum_26']." where type='ball_".$type."'";
    
	 
	 $mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5'].",h6=".$_REQUEST['CNum_6'].",h7=".$_REQUEST['CNum_7'].",h8=".$_REQUEST['CNum_8'].",h9=".$_REQUEST['CNum_9'].",h10=".$_REQUEST['CNum_10'].",h11=".$_REQUEST['CNum_11'].",h12=".$_REQUEST['CNum_12'].",h13=".$_REQUEST['CNum_13'].",h14=".$_REQUEST['CNum_14'].",h15=".$_REQUEST['CNum_15'].",h16=".$_REQUEST['CNum_16'].",h17=".$_REQUEST['CNum_17'].",h18=".$_REQUEST['CNum_18'].",h19=".$_REQUEST['CNum_19'].",h20=".$_REQUEST['CNum_20'].",h21=".$_REQUEST['CNum_21'].",h22=".$_REQUEST['CNum_22'].",h23=".$_REQUEST['CNum_23'].",h24=".$_REQUEST['CNum_24'].",h25=".$_REQUEST['CNum_25'].",h26=".$_REQUEST['CNum_26']." where type='ball_".$type."'";
      $mysqli->query($sql);
	
			echo "<script>alert(\"赔率修改完毕！\");window.open('odds4.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}

}
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script type="text/javascript">
//读取当前期数盘口赔率与投注总额
function loadinfo(){
	$.post("get_odds_<?=$gameId?>.php", {type : <?=$type?>}, function(data)
		{
			for(var key in data.oddslist){
			odds = data.oddslist[key];
			$("#Num_"+key).val(odds);
			}
		
		for(var key in data.oddslistb){
			odds = data.oddslistb[key];
			$("#BNum_"+key).val(odds);
			}
		
		for(var key in data.oddslistc){
			odds = data.oddslistc[key];
			$("#CNum_"+key).val(odds);
			}
		}, "json");
}
function UpdateRate(num ,i){
	$.post("updaterate_<?=$gameId?>.php", {type : <?=$type?> ,num : num ,i : i}, function(data)
		{
			odds = data.oddslist[num];
			xodds = $("#Num_"+num).val();
			if(odds != xodds){
				$("#Num_"+num).css("color","red");
			}
			$("#Num_"+num).val(odds);
		}, "json");
}
</script>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <?php include_once("Menu_Odds.php"); ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <tr>
        <td align="center" bgcolor="#3C4D82" style="color:#FFF">
        <a href="?type=1&gameId=<?=$gameId?>" style="color:<?=$se1?>; font-weight:bold;">冠、亚军和</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=17&gameId=<?=$gameId?>" style="color:<?=$se17?>; font-weight:bold;">冠亚季军和</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=2&gameId=<?=$gameId?>" style="color:<?=$se2?>; font-weight:bold;">冠军</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=3&gameId=<?=$gameId?>" style="color:<?=$se3?>; font-weight:bold;">亚军</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=4&gameId=<?=$gameId?>" style="color:<?=$se4?>; font-weight:bold;">第三名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=5&gameId=<?=$gameId?>" style="color:<?=$se5?>; font-weight:bold;">第四名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=6&gameId=<?=$gameId?>" style="color:<?=$se6?>; font-weight:bold;">第五名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=7&gameId=<?=$gameId?>" style="color:<?=$se7?>; font-weight:bold;">第六名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=8&gameId=<?=$gameId?>" style="color:<?=$se8?>; font-weight:bold;">第七名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=9&gameId=<?=$gameId?>" style="color:<?=$se9?>; font-weight:bold;">第八名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=10&gameId=<?=$gameId?>" style="color:<?=$se10?>; font-weight:bold;">第九名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=11&gameId=<?=$gameId?>" style="color:<?=$se11?>; font-weight:bold;">第十名</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=12&gameId=<?=$gameId?>" style="color:<?=$se12?>; font-weight:bold;">1V10</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=13&gameId=<?=$gameId?>" style="color:<?=$se13?>; font-weight:bold;">2V9</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=14&gameId=<?=$gameId?>" style="color:<?=$se14?>; font-weight:bold;">3V8</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=15&gameId=<?=$gameId?>" style="color:<?=$se15?>; font-weight:bold;">4V7</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=16&gameId=<?=$gameId?>" style="color:<?=$se16?>; font-weight:bold;">5V6</a></td>
        </tr>   
    </table>
        <?php if($type==1){?>
        <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
            <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                <tr style="background-color:#3C4D82; color:#FFF">
                  <td width="50" height="22" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">3</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">4</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">5</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">6</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">7</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">8</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">9</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">10</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">11</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_9" id="BNum_9" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_9" id="CNum_9" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">12</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_10" id="BNum_10" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_10" id="CNum_10" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">13</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_11" id="BNum_11" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_11" id="CNum_11" /></td>                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">14</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_12" id="BNum_12" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_12" id="CNum_12" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">15</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_13" id="BNum_13" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_13" id="CNum_13" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">16</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_14" id="BNum_14" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_14" id="CNum_14" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">17</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_15" id="BNum_15" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_15" id="CNum_15" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">18</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_16" id="BNum_16" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_16" id="CNum_16" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">19</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_17" id="BNum_17" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_17" id="CNum_17" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td align="center"bgcolor="#FFFFFF">冠亚大</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_18" id="BNum_18" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_18" id="CNum_18" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚小</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_19" id="BNum_19" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_19" id="CNum_19" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚单</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_20" id="BNum_20" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_20" id="CNum_20" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚双</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_21" id="BNum_21" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_21" id="CNum_21" /></td>                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                </tr></form>
        </table>
        <?php } else if($type<12){?>
                    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/1.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/2.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/3.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/4.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/5.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/6.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/7.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/8.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/9.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_9" id="BNum_9" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_9" id="CNum_9" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/10.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_10" id="BNum_10" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_10" id="CNum_10" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_11" id="BNum_11" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_11" id="CNum_11" /></td>                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_12" id="BNum_12" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_12" id="CNum_12" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_13" id="BNum_13" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_13" id="CNum_13" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_14" id="BNum_14" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_14" id="CNum_14" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"></td>
                          <td align="center"bgcolor="#FFFFFF"></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type>=12 && $type<17){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>选项</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center">选项</td>
                          <td align="center">当前赔率</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="4" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
                <?php }else if($type==17){?>
				<table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
            <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                <tr style="background-color:#3C4D82; color:#FFF">
                  <td width="50" height="22" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                  <td width="50" align="center"><strong>选项</strong></td>
                  <td align="center"><strong>当前赔率</strong></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">6</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">7</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">8</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">9</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">10</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">11</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">12</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">13</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">14</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_9" id="BNum_9" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_9" id="CNum_9" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">15</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_10" id="BNum_10" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_10" id="CNum_10" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">16</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_11" id="BNum_11" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_11" id="CNum_11" /></td>                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">17</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_12" id="BNum_12" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_12" id="CNum_12" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">18</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_13" id="BNum_13" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_13" id="CNum_13" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">19</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_14" id="BNum_14" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_14" id="CNum_14" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">20</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_15" id="BNum_15" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_15" id="CNum_15" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">21</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_16" id="Num_16" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_16" id="BNum_16" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_16" id="CNum_16" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">22</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_17" id="Num_17" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_17" id="BNum_17" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_17" id="CNum_17" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">23</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_18" id="Num_18" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_18" id="BNum_18" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_18" id="CNum_18" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">24</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_19" id="Num_19" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_19" id="BNum_19" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_19" id="CNum_19" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">25</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_20" id="Num_20" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_20" id="BNum_20" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_20" id="CNum_20" /></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="28" align="center"bgcolor="#FFFFFF">26</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_21" id="Num_21" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_21" id="BNum_21" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_21" id="CNum_21" /></td>                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">27</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_22" id="Num_22" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_22" id="BNum_22" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_22" id="CNum_22" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"bgcolor="#FFFFFF">冠亚季大</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_23" id="Num_23" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_23" id="BNum_23" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_23" id="CNum_23" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚季小</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_24" id="Num_24" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_24" id="BNum_24" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_24" id="CNum_24" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚季单</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_25" id="Num_25" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_25" id="BNum_25" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_25" id="CNum_25" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF">冠亚季双</td>
                  <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      
                       <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_26" id="Num_26" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_26" id="BNum_26" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_26" id="CNum_26" /></td>
                      
                    </tr>
                  </table></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                  <td align="center"bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                </tr></form>
        </table>
				<?php }?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">loadinfo();</script> 
</body>
</html>