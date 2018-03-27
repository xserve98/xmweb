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
if(!$gameId) $gameId=12;
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
if($save=='ok'){
	if($type==1){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15'].",h16=".$_REQUEST['Num_16'].",h17=".$_REQUEST['Num_17'].",h18=".$_REQUEST['Num_18'].",h19=".$_REQUEST['Num_19'].",h20=".$_REQUEST['Num_20'].",h21=".$_REQUEST['Num_21'].",h22=".$_REQUEST['Num_22'].",h23=".$_REQUEST['Num_23'].",h24=".$_REQUEST['Num_24'].",h25=".$_REQUEST['Num_25'].",h26=".$_REQUEST['Num_26'].",h27=".$_REQUEST['Num_27'].",h28=".$_REQUEST['Num_28']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5'].",h6=".$_REQUEST['BNum_6'].",h7=".$_REQUEST['BNum_7'].",h8=".$_REQUEST['BNum_8'].",h9=".$_REQUEST['BNum_9'].",h10=".$_REQUEST['BNum_10'].",h11=".$_REQUEST['BNum_11'].",h12=".$_REQUEST['BNum_12'].",h13=".$_REQUEST['BNum_13'].",h14=".$_REQUEST['BNum_14'].",h15=".$_REQUEST['BNum_15'].",h16=".$_REQUEST['BNum_16'].",h17=".$_REQUEST['BNum_17'].",h18=".$_REQUEST['BNum_18'].",h19=".$_REQUEST['BNum_19'].",h20=".$_REQUEST['BNum_20'].",h21=".$_REQUEST['BNum_21'].",h22=".$_REQUEST['BNum_22'].",h23=".$_REQUEST['BNum_23'].",h24=".$_REQUEST['BNum_24'].",h25=".$_REQUEST['BNum_25'].",h26=".$_REQUEST['BNum_26'].",h27=".$_REQUEST['BNum_27'].",h28=".$_REQUEST['BNum_28']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5'].",h6=".$_REQUEST['CNum_6'].",h7=".$_REQUEST['CNum_7'].",h8=".$_REQUEST['CNum_8'].",h9=".$_REQUEST['CNum_9'].",h10=".$_REQUEST['CNum_10'].",h11=".$_REQUEST['CNum_11'].",h12=".$_REQUEST['CNum_12'].",h13=".$_REQUEST['CNum_13'].",h14=".$_REQUEST['CNum_14'].",h15=".$_REQUEST['CNum_15'].",h16=".$_REQUEST['CNum_16'].",h17=".$_REQUEST['CNum_17'].",h18=".$_REQUEST['CNum_18'].",h19=".$_REQUEST['CNum_19'].",h20=".$_REQUEST['CNum_20'].",h21=".$_REQUEST['CNum_21'].",h22=".$_REQUEST['CNum_22'].",h23=".$_REQUEST['CNum_23'].",h24=".$_REQUEST['CNum_24'].",h25=".$_REQUEST['CNum_25'].",h26=".$_REQUEST['CNum_26'].",h27=".$_REQUEST['CNum_27'].",h28=".$_REQUEST['CNum_28']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
         echo "<script>alert(\"赔率修改完毕！\");window.open('odds12.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>";
		exit;
	}
	if($type==2){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10']." where type='ball_".$type."'";
		$mysqli->query($sql);
$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5'].",h6=".$_REQUEST['BNum_6'].",h7=".$_REQUEST['BNum_7'].",h8=".$_REQUEST['BNum_8'].",h9=".$_REQUEST['BNum_9'].",h10=".$_REQUEST['BNum_10']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5'].",h6=".$_REQUEST['CNum_6'].",h7=".$_REQUEST['CNum_7'].",h8=".$_REQUEST['CNum_8'].",h9=".$_REQUEST['CNum_9'].",h10=".$_REQUEST['CNum_10']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
	
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
        echo "<script>alert(\"赔率修改完毕！\");window.open('odds12.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}
	if($type==3){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3']." where type='ball_".$type."'";
		$mysqli->query($sql);
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
         echo "<script>alert(\"赔率修改完毕！\");window.open('odds12.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}
	if($type==4 || $type==5){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
		$sql	=	"update c_odds_".$gameId."_b set h1=".$_REQUEST['BNum_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_".$gameId."_c set h1=".$_REQUEST['CNum_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
		
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
         echo "<script>alert(\"赔率修改完毕！\");window.open('odds12.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
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
	$.post("get_odds_<?=$gameId?>.php", {type : <?=$type?>,gameId : <?=$gameId?>}, function(data)
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
	$.post("updaterate_<?=$gameId?>.php", {type : <?=$type?>,gameId : <?=$gameId?> ,num : num ,i : i}, function(data)
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
      <?php include_once("Menu_odds.php"); ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <tr>
        <td align="center" bgcolor="#3C4D82" style="color:#FFF">
        <a href="?type=1&gameId=<?=$gameId?>" style="color:<?=$se1?>; font-weight:bold;">特码</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=2&gameId=<?=$gameId?>" style="color:<?=$se2?>; font-weight:bold;">混合玩法</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=3&gameId=<?=$gameId?>" style="color:<?=$se3?>; font-weight:bold;">波色</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=4&gameId=<?=$gameId?>" style="color:<?=$se4?>; font-weight:bold;">豹子</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=5&gameId=<?=$gameId?>" style="color:<?=$se5?>; font-weight:bold;">特码三压一</a>&nbsp;&nbsp;
        </tr>   
    </table>
        <?php if($type==1){?>
                    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                        <?
                        for($i=1;$i<=28;$i++){
						?>
                          <td height="28" align="center"bgcolor="#FFFFFF"><?=$i-1?></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_<?=$i?>" id="Num_<?=$i?>" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_<?=$i?>" id="BNum_<?=$i?>" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_<?=$i?>" id="CNum_<?=$i?>" /></td>
                              
                            </tr>
                          </table></td>
                        <?
							if($i%5==0) echo "</tr><tr>";
						}
						?>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type==2){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">大单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">极大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_9" id="BNum_9" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_9" id="CNum_9" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">极小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                           
                          
                            <tr>
                               
                           <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_10" id="BNum_10" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_10" id="CNum_10" /></td>
                             
                              
                            </tr>
                          </table></td>
                          <td colspan="4"bgcolor="#FFFFFF"></td>
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type==3){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">红波</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">绿波</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">蓝波</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type==4){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">豹子</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type==5){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">特码包三</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">loadinfo();</script> 
</body>
</html>