<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");
$page_date	=	date("m-d");
$page_date2	=	date("Y-m-d");

if(isset($_GET["date"])){
	$page_date	=	$_GET["date"];
	$page_date2	=	date("Y-").$_GET["date"];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>已结算注单</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
<script language="javascript">
function $(_sId){
	return document.getElementById(_sId);
}

function gopage(url)
{
location.href=url;
}
function re_load()
{
location.reload();
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='mid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}
		if(action=="2") document.form1.action="ft_list.php?type=lq_match&php=lqbf_yjs";
		if(action=="3") document.form1.action="set_lq_score.php";
		if(action=="1") document.form1.action="re_jiesuan.php?type=lq_match&php=lqbf_yjs";
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}

</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<form id="form1" name="form1" method="post" action="re_jiesuan.php" onSubmit="return check();">
<table width="1000" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200" height="24">选择日期：
          <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1"><?php
for ($i=0;$i<=10;$i++){
	$s		=	strtotime("-$i day");
	$date	=	date("m-d",$s);
?>
        <option value="<?=$_SERVER['PHP_SELF']?>?date=<?=$date?>" <?=$page_date==$date ? 'selected' : ''?>><?=$date?></option>
<?php
}
?>
      </select></td>
        <td width="200"><a href="lqbf.php?date=<?=$page_date?>" style="font-size:13px;">&lt;&lt;返回未结算</a>
          <input type="button" name="Submit" value="刷新篮球" onClick="window.location.reload();"></td>
        <td width="200" align="center"><label>
			【<a href="?date=<?=$page_date?>&type=1" style="font-size:13px;">只看下注</a>】&nbsp;&nbsp;
          【<a href="?date=<?=$page_date?>&type=0" style="font-size:13px;">查看所有</a>】
        </label></td>
        <td width="300" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="3">录入比分</option>
        <option value="1">重新结算</option>
        <option value="2">查看未结算注单</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
  </table>
  <table width="1000"   height="41" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" id="glist_table">
    <tr class="m_title_ft"> 
      <td width="160" height="24" align="middle"><?=$page_date?></td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="160">主场队伍</td>
      <td align="middle" width="45">全场分</td>
      <td align="middle" width="160">客场队伍</td>
      <td align="middle" width="40">第一节</td>
      <td align="middle" width="40">第二节</td>
      <td align="middle" width="40">第三节</td>
      <td align="middle" width="40">第四节</td>
      <td align="middle" width="40">上半场</td>
      <td align="middle" width="40">下半场</td>
      <td align="middle" width="40">加时</td>
      <td align="middle" width="100">结算分</td>
      <td width="30" align="center"><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
    </tr>
	<?php
	if($_GET["type"]!="0")
	{
		$sqlwhere="";
		$begin_time=$page_date2." 00:00:00";
		$end_time=$page_date2." 23:59:59";
		$sqlwhere.=" AND ((Match_ID in (select match_id from lb1_db.k_bet where match_coverdate>='$begin_time' and match_coverdate<='$end_time'))";
		$sqlwhere.=" OR (Match_ID in (select match_id from lb1_db.k_bet_cg where match_endtime>='$begin_time')))";
	}
	$sql		=	"select Match_ID,Match_Time,Match_Master, Match_Guest,Match_Name,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,	TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add ,MB_Inball_OK,TG_Inball_OK from lq_match where match_js=1 and (match_Date='$page_date' or match_date='$page_date2') ".$sqlwhere." order by  Match_CoverDate,iPage,match_name,Match_Master,iSn desc";
	$query		=	$mysqlis->query($sql);
	while($rows	=	$query->fetch_array()){
	?>
	    <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
      <td width="160" height="18" align="middle"><?=$rows["Match_ID"]?>
        <br/>
        <?=$rows["Match_Name"]?></td>
      <td align="middle" width="50"><?=$rows["Match_Time"]?></td>
      <td align="left" width="160"><?=$rows["Match_Master"]?></td>
      <td align="middle" width="45"><?=$rows["MB_Inball"]>=0 ? $rows["MB_Inball"] : '<span style="color:#FF0000;">无效</span>'?>
        <br />
        <?=$rows["TG_Inball"]>=0 ? $rows["TG_Inball"] : '<span style="color:#FF0000;">无效</span>'?></td>
      <td align="left" width="160"><?=$rows["Match_Guest"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_1st"]?>
        <br />
        <?=$rows["TG_Inball_1st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_2st"]?>
        <br />
        <?=$rows["TG_Inball_2st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_3st"]?>
        <br />
        <?=$rows["TG_Inball_3st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_4st"]?>
        <br />
        <?=$rows["TG_Inball_4st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_HR"]?>
        <br />
        <?=$rows["TG_Inball_HR"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_ER"]?>
        <br />
        <?=$rows["TG_Inball_ER"]?></td>
      <td align="middle" width="40"><? if ($rows["MB_Inball_Add"]>0) echo $rows["MB_Inball_Add"]; ?>
        <br />
        <? if ($rows["TG_Inball_Add"]>0) echo $rows["TG_Inball_Add"];?></td>
      <td align="middle" width="100"><?=$rows["MB_Inball_OK"]?>：<?=$rows["TG_Inball_OK"]?></td>
      <td align="middle"><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td>
    </tr>
	<?}?>
</table>
</form>
</body>
</html>