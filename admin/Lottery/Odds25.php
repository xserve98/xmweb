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
if(!$gameId) $gameId=25;
$gameName=get_gameName($gameId);

$type = $_REQUEST['type'];
$save = $_REQUEST['save'];
if($type==''){$type=2;}

$type=='2' ? $se2 = '#FF0' : $se2 = '#FFF';
$type=='3' ? $se3 = '#FF0' : $se3 = '#FFF';

if($save=='ok'){
	
	if($type==2||$type==3){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14']." where type='ball_".$type."'";
		//echo $sql;
		$mysqli->query($sql);
		//Alert("赔率修改完毕！","odds5.php?type=".$type."");
         echo "<script>alert(\"赔率修改完毕！\");window.open('odds25.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
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
        <a href="?type=2&gameId=<?=$gameId?>" style="color:<?=$se2?>; font-weight:bold;">玩家</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=3&gameId=<?=$gameId?>" style="color:<?=$se3?>; font-weight:bold;">庄家</a>&nbsp;&nbsp;-&nbsp;&nbsp;
    
        </tr>  
    </table>
    
    <?php  if($type==2){?>
    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
       
                    <form name="form1" method="post" action="?type=2&gameId=<?=$gameId?>&save=ok">
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
                          <td height="28" align="center"bgcolor="#FFFFFF">无牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛一</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛二</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛三</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">牛四</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛五</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛六</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛七</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                              
                            </tr>
                          </table></td>
                          
                        </tr>
                        <tr>
                         
                            <td align="center"bgcolor="#FFFFFF">牛八</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_9" id="Num_9" /></td>
                              
                            </tr>
                          </table></td>
                         
                          
                            <td align="center"bgcolor="#FFFFFF">牛九</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_10" id="Num_10" /></td>
                              
                            </tr>
                          </table></td>
                           
                            <td align="center"bgcolor="#FFFFFF">牛牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_11" id="Num_11" /></td>
                              
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">金牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_12" id="Num_12" /></td>
                              
                            </tr>
                          </table></td>
                           </tr>
                        <tr>
                           
                           <td align="center"bgcolor="#FFFFFF">炸弹</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_13" id="Num_13" /></td>
                              
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">五小牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_14" id="Num_14" /></td>
                              
                            </tr>
                          </table></td>
                          <td colspan="4"bgcolor="#FFFFFF"></td>
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
      </table>
      
      <?php }else if($type==3){?>
      
    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
       
                    <form name="form1" method="post" action="?type=3&gameId=<?=$gameId?>&save=ok">
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
                          <td height="28" align="center"bgcolor="#FFFFFF">无牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_1" id="BNum_1" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_1" id="CNum_1" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛一</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_2" id="BNum_2" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_2" id="CNum_2" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛二</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_3" id="BNum_3" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_3" id="CNum_3" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛三</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_4" id="BNum_4" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_4" id="CNum_4" /></td>
                              
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">牛四</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               
<td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_5" id="BNum_5" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_5" id="CNum_5" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛五</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_6" id="BNum_6" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_6" id="CNum_6" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛六</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_7" id="BNum_7" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_7" id="CNum_7" /></td>
                              
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛七</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                               <td align="center"><sapn class="pankou">A:</span><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /><sapn class="pankou">B:</span><input class="input1" maxlength="6" size="4" value="0" name="BNum_8" id="BNum_8" /><sapn class="pankou">C:</span><input class="input1" maxlength="6" size="4" value="0" name="CNum_8" id="CNum_8" /></td>
                              
                            </tr>
                          </table></td>
                          
                        </tr>
                        <tr>
                         
                            <td align="center"bgcolor="#FFFFFF">牛八</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_9" id="Num_9" /></td>
                              
                            </tr>
                          </table></td>
                         
                          
                            <td align="center"bgcolor="#FFFFFF">牛九</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_10" id="Num_10" /></td>
                              
                            </tr>
                          </table></td>
                           
                            <td align="center"bgcolor="#FFFFFF">牛牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_11" id="Num_11" /></td>
                              
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">金牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_12" id="Num_12" /></td>
                              
                            </tr>
                          </table></td>
                           </tr>
                        <tr>
                           
                           <td align="center"bgcolor="#FFFFFF">炸弹</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_13" id="Num_13" /></td>
                              
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">五小牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              
                              <td align="center"><input class="input1" maxlength="10" size="4" value="0" name="Num_14" id="Num_14" /></td>
                              
                            </tr>
                          </table></td>
                          <td colspan="4"bgcolor="#FFFFFF"></td>
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
      </table>
      
    <?php } ?>
    
       </td>

    </tr>
  </table>
</div>
<script type="text/javascript">loadinfo();</script> 
</body>
</html>