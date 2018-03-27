<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");

include_once("../../include/mysqlis.php");
?>
<html>
<head>
<title>reports</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.m_title_re {  background-color: #577176; text-align: right; color: #FFFFFF}
.m_bc { background-color: #C9DBDF; padding-left: 7px }
-->
</style>
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<SCRIPT>
<!--
 function onSubmit()
 {
  kind_obj = document.getElementById("report_kind");
  form_obj = document.getElementById("myFORM");
  if(kind_obj.value == "A")
   form_obj.action = "report_all.php";
  else
   form_obj.action = "report_class.php";
  return true;
 }
-->
</SCRIPT>
<script language="JavaScript">

function chg_date(range,num1,num2){ 

//alert(num1+'-'+num2);
if(range=='t' || range=='w' || range=='r'){
 FrmData.date_start.value ='<?=date("Y-m-d")?>';
 FrmData.date_end.value =FrmData.date_start.value;}

if(range!='t'){
 if(FrmData.date_start.value!=FrmData.date_end.value){ FrmData.date_start.value ='<?=date("Y-m-d")?>'; FrmData.date_end.value =FrmData.date_start.value;}
 var aStartDate = FrmData.date_start.value.split('-');  
 var newStartDate = new Date(parseInt(aStartDate[0], 10),parseInt(aStartDate[1], 10) - 1,parseInt(aStartDate[2], 10) + num1);   
 FrmData.date_start.value = newStartDate.getFullYear()+ '-' + (newStartDate.getMonth() + 1)+ '-' + newStartDate.getDate();   
 var aEndDate = FrmData.date_end.value.split('-');  
 var newEndDate = new Date(parseInt(aEndDate[0], 10),parseInt(aEndDate[1], 10) - 1,parseInt(aEndDate[2], 10) + num2);   
 FrmData.date_end.value = newEndDate.getFullYear()+ '-' + (newEndDate.getMonth() + 1)+ '-' + newEndDate.getDate();   
}
 
}
</script>

<style type="text/css">
<!--
.m_title_ce {background-color: #669999; text-align: center; color: #FFFFFF}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<script language="JavaScript" src="../../js/calendar.js"></script>
<form  action="report_user.php" method="post"  name="FrmData" id="FrmData">
  <table width="850" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td colspan="2" height="4"></td>
</tr>
</table>
  <table width="650" border="0" cellspacing="1" cellpadding="0" class="m_tab_ed">
  <tr class="m_bc">
    <td colspan="4" align="left"><table width="650" border="0" cellspacing="1" cellpadding="0" class="m_tab_ed">
      <tr class="m_bc">
        <td width="100" class="m_title_re"> 日期区间: </td>
        <td colspan="5"><table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><input name="date_start" type="text" id="date_start" value="<?=date("Y-m-d")?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" /> </td>
            <td width="20" align="center">&nbsp;~&nbsp;</td>
            <td><input name="date_end" type="text" id="date_end" value="<?=date("Y-m-d")?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" /></td>
            <td>&nbsp;</td>
            <td><input name="Submit" type="Button" class="za_button" onClick="chg_date('t',0,0)" value="今日">&nbsp;&nbsp;
              <input name="Submit" type="Button" class="za_button" onClick="chg_date('l',-1,-1)" value="昨日">&nbsp;&nbsp;
              <input name="Submit" type="Button" class="za_button" onClick="chg_date('n',1,1)" value="明日">&nbsp;&nbsp;
              <input name="Submit" type="Button" class="za_button" onClick="FrmData.date_start.value='<?=date("Y-m-d",strtotime("last Monday"))?>';FrmData.date_end.value='<?=date("Y-m-d")?>'" value="本星期">&nbsp;&nbsp;
              <input name="Submit" type="Button" class="za_button" onClick="FrmData.date_start.value='<?=date("Y-m-d",strtotime("last Monday")-604800)?>';FrmData.date_end.value='<?=date("Y-m-d",strtotime("last Monday")-86400)?>'" value="上星期">&nbsp;&nbsp;
              <input name="Submit" type="Button" class="za_button" onClick="FrmData.date_start.value='<?=date("Y-m").'-01'?>';FrmData.date_end.value='<?=date("Y-m-d")?>'" value="本期"></td>
          </tr>
        </table></td>
      </tr>
      <tr class="m_bc">
        <td class="m_title_re"> 投注種類: </td>
        <td colspan="4" align="left"><select name="wtype" class="za_select">
          <option value="" selected>全部</option>
          <option value="R">讓球(分)</option>
          <option value="RE">滾球</option>
          <option value="P">標準過關</option>
          <option value="OU">大小</option>
          <option value="ROU">滾球大小</option>
          <option value="PD">波膽</option>
          <option value="T">入球</option>
          <option value="M">獨贏</option>
          <option value="F">半全場</option>
          <option value="HR">上半場讓球(分)</option>
          <option value="HOU">上半場大小</option>
          <option value="HM">上半場獨贏</option>
          <option value="HRE">上半滾球讓球(分)</option>
          <option value="HROU">上半滾球大小</option>
          <option value="HPD">上半波膽</option>
        </select></td>
      </tr>
      <tr class="m_bc">
        <td class="m_title_re">日期</td>
        <td colspan="2" class="m_title_ce"><?=date("Y-m-d")?></td>
        <td colspan="2" class="m_title_ce"><?=date("Y-m-d",strtotime("+1 days"))?></td>
      </tr>
      <tr class="m_bc">
        <td class="m_title_re">目前状态</td>
        <td style="color:#FF0000">有结果</td>
        <td style="color:#FF0000">无结果</td>
        <td>有结果</td>
        <td>无结果</td>
      </tr>
<?php
$sql	=	"select count(*) as num,match_js from bet_match where match_date='".date('m-d')."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
$t1		=	$t2=$t3=$t4=0;
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t1 = $rows["num"];
	else $t2 = $rows["num"];
}

$sql	=	"select count(*) as num,match_js from bet_match where match_date='".date('m-d',strtotime('+1 days'))."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t3 = $rows["num"];
	else $t4 = $rows["num"];
}
?>
      <tr class="m_bc">
        <td class="m_title_re">足球</td>
        <td style="color:#FF0000"><?=intval($t1)?></td>
        <td style="color:#FF0000"><?=intval($t2)?></td>
        <td><?=intval($t3)?></td>
        <td><?=intval($t4)?></td>
      </tr>
<?php
$t1		=	$t1=$t3=$t4=0;
$sql	=	"select count(*) as num,match_js from lq_match where match_date='".date('m-d')."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t1 = $rows["num"];
	else $t2 = $rows["num"];
}
$sql	=	"select count(*) as num,match_js from lq_match where match_date='".date('m-d',strtotime('+1 days'))."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t3 = $rows["num"];
	else $t4 = $rows["num"];
}
?>
      <tr class="m_bc">
        <td class="m_title_re">篮球</td>
        <td style="color:#FF0000"><?=intval($t1)?></td>
        <td style="color:#FF0000"><?=intval($t2)?></td>
        <td><?=intval($t3)?></td>
        <td><?=intval($t4)?></td>
      </tr>
<?
$t1		=	$t1=$t3=$t4=0;
$sql	=	"select count(*) as num,match_js from tennis_match where match_date='".date('m-d')."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t1=$rows["num"];
	else $t2=$rows["num"];
}
 
$sql	=	"select count(*) as num,match_js from tennis_match where match_date='".date('m-d',strtotime('+1 days'))."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
if($rows["match_js"]>0)
	$t3=$rows["num"];
else 
	$t4=$rows["num"];
}
?>
      <tr class="m_bc">
        <td class="m_title_re">网球</td>
        <td style="color:#FF0000"><?=intval($t1)?></td>
        <td style="color:#FF0000"><?=intval($t2)?></td>
        <td><?=intval($t3)?></td>
        <td><?=intval($t4)?></td>
      </tr>
      <?
$t1		=	$t1=$t3=$t4=0;
$sql	=	"select count(*) as num,match_js from volleyball_match where match_date='".date('m-d')."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t1=$rows["num"];
	else $t2=$rows["num"];
}

$sql	=	"select count(*) as num,match_js from volleyball_match where match_date='".date('m-d',strtotime('+1 days'))."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t3=$rows["num"];
	else $t4=$rows["num"];
}
?>
      <tr class="m_bc">
        <td class="m_title_re">排球</td>
        <td style="color:#FF0000"><?=intval($t1)?></td>
        <td style="color:#FF0000"><?=intval($t2)?></td>
        <td><?=intval($t3)?></td>
        <td><?=intval($t4)?></td>
      </tr>
<?php
$t1		=	$t1=$t3=$t4=0;
$sql	=	"select count(*) as num,match_js from baseball_match where match_date='".date('m-d')."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t1=$rows["num"];
	else $t2=$rows["num"];
}

$sql	=	"select count(*) as num,match_js from baseball_match where match_date='".date('m-d',strtotime('+1 days'))."' group by match_js order by match_js";
$result	=	$mysqlis->query($sql);
while($rows = $result->fetch_array()){
	if($rows["match_js"]>0) $t3=$rows["num"];
	else $t4=$rows["num"];
}
    ?>
      <tr class="m_bc">
        <td class="m_title_re">棒球</td>
        <td style="color:#FF0000"><?=intval($t1)?></td>
        <td style="color:#FF0000"><?=intval($t2)?></td>
        <td><?=intval($t3)?></td>
        <td><?=intval($t4)?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="30" colspan="5" ><table>
          <tr>
            <td align="right" width="60"> 注单状态: </td>
            <td width="230"><select name="result_type" class="za_select">
              <option value="Y">有结果</option>
              <option value="N">未有结果</option>
            </select></td>
            <td><input type=SUBMIT name="SUBMIT" value="查询" class="za_button">
              &nbsp;&nbsp;&nbsp;
              <input type=BUTTON name="CANCEL" value="取消" onClick="javascript:history.go(-1)" class="za_button"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  </table>
</form>
</body>
</html>