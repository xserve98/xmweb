<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");
$page_date	=	date("m-d");
$page_date2	=	date("Y-m-d");

if(isset($_GET["select_ball"])){
	$select_ball	=	$_GET["select_ball"];
}else{
	$select_ball	=	"FT";
}

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
		if(action=="2") document.form1.action="ft_list.php";
		if(action=="1") document.form1.action="re_jiesuan.php";
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
 
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="m_tline" width="770">&nbsp;线上数据 - <font color="#CC0000">比分审核&nbsp;</font>&nbsp;&nbsp;&nbsp;日期: 
        <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1">
	   
      <? for ($i=0;$i<=10;$i++){
	   $s=strtotime("-$i day");
	   $date=date("m-d",$s);
	    ?>
        <option value="<?=$_SERVER['PHP_SELF']?>?select_ball=<?=$select_ball?>&amp;date=<?=$date?>" <?if ($page_date==$date)echo  "selected";?>>
		<?=$date?>
         </option>
  <?}?>
      </select>
        赛事: 
        <select class="za_select" name="select_ball" onChange="javascript:location.href=this.value;">
          　<option value="score_yjs.php?select_ball=FT&date=<?=$page_date?>" <?if($select_ball=="FT") echo "selected";?>>足球</option>
			<option value="score_yjs.php?select_ball=BK&date=<?=$page_date?>" <?if($select_ball=="BK") echo "selected";?>>篮球</option>
        </select>
      -- 管理模式:WEB页面 -- <a href="javascript:history.go( -1 );">回上一页</a></td>                
      <td width="30"> </td> 
    </tr> 
  </table> 
  <table width="774" border="0" cellspacing="0" cellpadding="0"> 
    <tr>  
      <td width="774" height="4"></td> 
    </tr> 
    <tr> 
      <td ></td> 
    </tr> 
  </table>
<form id="form1" name="form1" method="post" action="re_jiesuan.php" onSubmit="return check();">
  <? if($select_ball=="FT"){?>
  <div style="width:900px; padding-bottom:5px;"><div style="float:left;"><span class="STYLE3">足球</span> -- <a href="score.php?select_ball=FT&date=<?=$page_date?>">&lt;&lt;返回未结算</a></div><div style="float:right;"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">重新结算</option>
        <option value="2">查看未结算注单</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></div></div>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" class="m_tab" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="199" height="18" align="middle"> 
       <?=$page_date?> </td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="200">主场队伍</td>
      <td align="middle" width="80">全场比分</td>
      <td align="middle" width="200">客场队伍</td>
      <td align="middle" width="80">上半场</td>
      <td width="50" align="middle">比分</td> 
      <td width="32" align="middle"><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
    </tr>
    <?php
   $sql			=	"SELECT Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID, Match_GuestID,Match_Name,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR,match_js FROM Bet_Match where match_js=1 and (match_Date='$page_date' or match_date='$page_date2') order by  Match_CoverDate,iPage,match_name,Match_Master,iSn desc";
    $query		=	$mysqlis->query($sql);
	while($rows	=	$query->fetch_array()){
    ?>
    <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
      <td width="199"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="50"><?=$rows["Match_Time"]?></td>
      <td width="200"><div align="right"><?=$rows["Match_Master"]?></div></td>
     <td width="80"> 
       <?if($rows["MB_Inball"]<0){ echo "比赛无效"; }else {?> <?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>
       <?}?>      </td>
      <td width="200"><div align="left"><?=$rows["Match_Guest"]?></div></td>
      <td width="80"> 
        <?if($rows["MB_Inball_HR"]<0){ echo "比赛无效"; }else {?>
        <?=$rows["MB_Inball_HR"]?>:<?=$rows["TG_Inball_HR"] ?>
        <?}?>      </td>
      <td><a href="set_bet_score.php?mid=<?=$rows["Match_ID"]?>">录入</a></td>
      <td><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td>
    </tr>
    <?}?>
</table>
	<?}?>
	  <? if($select_ball=="BK"){?>
<div style="width:900px; padding-bottom:5px;"><div style="float:left;"><span class="STYLE3">篮球</span> -- <a href="score.php?select_ball=BK&date=<?=$page_date?>">&lt;&lt;返回未结算</a></div><div style="float:right;"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">重新结算</option>
        <option value="2">查看未结算注单</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></div></div>
  <table width="900"   height="41" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft"> 
      <td width="155" height="18" align="middle"><?=$page_date?></td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="140">主场队伍</td>
      <td align="middle" width="40">全场分</td>
      <td align="middle" width="140">客场队伍</td>
      <td align="middle" width="40">第一节</td>
      <td align="middle" width="40">第二节</td>
      <td align="middle" width="40">第三节</td>
      <td align="middle" width="40">第四节</td>
      <td align="middle" width="40">上半场</td>
      <td align="middle" width="40">下半场</td>
      <td align="middle" width="40">加时</td>
      <td align="middle" width="40">结算分</td>
      <td width="40" align="center"><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
    </tr>
	<?php
	$sql		=	"select Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID,Match_GuestID,Match_Name,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,	TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add ,MB_Inball_OK,TG_Inball_OK,match_js from  lq_match where match_js=1 and (match_Date='$page_date' or match_date='$page_date2') order by  Match_CoverDate,iPage,match_name,Match_Master,iSn desc";
	$query		=	$mysqlis->query($sql);
	while($rows	=	$query->fetch_array()){
	?>
	    <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
      <td width="155" height="18" align="middle"><?=$rows["Match_ID"]?>
        <br/>
        <?=$rows["Match_Name"]?></td>
      <td align="middle" width="50"><?=$rows["Match_Time"]?></td>
      <td align="left" width="140"><?=$rows["Match_Master"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball"]>=0 ? $rows["MB_Inball"] : '<span style="color:#FF0000;">无效</span>'?>
        <br />
        <?=$rows["TG_Inball"]>=0 ? $rows["TG_Inball"] : '<span style="color:#FF0000;">无效</span>'?></td>
      <td align="left" width="140"><?=$rows["Match_Guest"]?></td>
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
      <td align="middle" width="40"><?=$rows["MB_Inball_OK"]?>
        <br />
        <?=$rows["TG_Inball_OK"]?></td>
      <td align="middle"><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td>
    </tr>
	<?}?>
</table>
  <?}?>
</form>
  <br>
</body>
</html>