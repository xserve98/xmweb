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
if(!$gameId) $gameId=1;
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
switch ($type){
	case 1:
	$lh = '1V10';
	break;
	case 2:
	$lh = '2V9';
	break;
	case 3:
	$lh = '3V8';
	break;
	case 4:
	$lh = '4V7';
	break;
	case 5:
	$lh = '5V6';
	break;
	default:
  	$lh = '';
} 
if($save=='ok'){
	if($type<6){
		$sql	=	"update c_odds_1 set h1=".$_REQUEST['Num_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
			$sql	=	"update c_odds_1_b set h1=".$_REQUEST['BNum_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
		$sql	=	"update c_odds_1_c set h1=".$_REQUEST['CNum_1']." where type='ball_".$type."'";
		$mysqli->query($sql);
		
		message("赔率修改完毕！","odds1.php?type=".$type."");
		exit;
	}
	if($type==6){
		$sql	=	"update c_odds_1 set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5']." where type='ball_".$type."'";
		///echo $sql;exit;
		
		$mysqli->query($sql);
		
		$sql	=	"update c_odds_1_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3'].",h4=".$_REQUEST['CNum_4'].",h5=".$_REQUEST['CNum_5']." where type='ball_".$type."'";
		///echo $sql;exit;
		$mysqli->query($sql);
		$sql	=	"update c_odds_1_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3'].",h4=".$_REQUEST['BNum_4'].",h5=".$_REQUEST['BNum_5']." where type='ball_".$type."'";
		///echo $sql;exit;
		$mysqli->query($sql);
		
		message("赔率修改完毕！$type","odds1.php?type=".$type."");
		exit;
	}
	if($type>6){
		$sql	=	"update c_odds_1 set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3']." where type='ball_".$type."'";
		//echo $sql;exit;
		$mysqli->query($sql);
			$sql	=	"update c_odds_1_c set h1=".$_REQUEST['CNum_1'].",h2=".$_REQUEST['CNum_2'].",h3=".$_REQUEST['CNum_3']." where type='ball_".$type."'";
		//echo $sql;exit;
		$mysqli->query($sql);
		
		$sql	=	"update c_odds_1_b set h1=".$_REQUEST['BNum_1'].",h2=".$_REQUEST['BNum_2'].",h3=".$_REQUEST['BNum_3']." where type='ball_".$type."'";
		//echo $sql;exit;
		$mysqli->query($sql);
		message("赔率修改完毕！$type","odds1.php?type=".$type."");
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
	$.get("get_odds_1.php", {type : <?=$type?>}, function(data)
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
	$.get("updaterate_1.php", {type : <?=$type?> ,num : num ,i : i}, function(data)
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
      <td valign="top"><?php include_once("Menu_Odds.php"); ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9" style="margin-top:5px;">
      <tr>
        <td align="center" bgcolor="#3C4D82" style="color:#FFF">
        <a href="?type=1" style="color:<?=$se1?>; font-weight:bold;">选一</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=2" style="color:<?=$se2?>; font-weight:bold;">选二</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=3" style="color:<?=$se3?>; font-weight:bold;">选三</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=4" style="color:<?=$se4?>; font-weight:bold;">选四</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=5" style="color:<?=$se5?>; font-weight:bold;">选五</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=6" style="color:<?=$se6?>; font-weight:bold;">和值</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=7" style="color:<?=$se7?>; font-weight:bold;">上中下</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=8" style="color:<?=$se8?>; font-weight:bold;">奇和偶</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        </tr>   
    </table>
        <?php if($type<6){?>
                    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td width="50" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td width="50" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td width="50" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">选<?php echo $type;?></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
</table>
<?php }else if($type==6) {?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="80" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">总和大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和810</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
				 <?php }else if($type==7) {?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="80" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td width="80" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">上盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">中盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">中盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
                    <?php }else if($type==8) {?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="80" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="80" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td width="80" align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">奇盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">和盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">偶盘</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
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