<?php
include_once("../common/login_check.php");
check_quanxian("jyqk");
include_once("../../include/mysqli.php");
include_once("../../include/mysqlis.php");
include_once("common.php");

$date		=	date("m-d");
if($_GET['date']){
	$date	=	$_GET['date'];
}
$page_date	=	$date;
$sql		=	"SELECT Match_ID,  Match_Date, Match_Time, Match_Master, Match_Guest, Match_RGG, Match_Name, Match_IsLose, Match_DxDpl, Match_DxXpl, Match_DxGG, Match_Ho, Match_Ao, Match_MasterID, Match_GuestID, Match_ShowType, Match_Type, Match_DsDpl, Match_DsSpl from lq_match  ";

isset($_GET['match_type'])?$match_type=intval($_GET["match_type"]):$match_type=1;

if($match_type==1){   //单式
	$sqlwhere		=	" WHERE Match_Type=1 AND Match_Date='".$date."' ";
}else if($match_type==0){ //早餐
	$sqlwhere		=	" WHERE Match_Type=1 AND Match_CoverDate>now() AND Match_Date<>'".$date."' ";
	if(isset($_GET["date"])){
		$sqlwhere	=	" WHERE Match_Type=1 AND Match_Date='$page_date' ";
	}
}
$sql		.=	$sqlwhere;
$match_name	=	getmatch_name('lq_match',$sqlwhere);
if(isset($_GET["match_name"])) $sql.="  and match_name='".urldecode($_GET["match_name"])."'";
$sql		.=	" order by Match_CoverDate,ipage,isn";

$arr		=	array();
$arr_m		=	array();
$mid		=	'';
$query		=	$mysqlis->query($sql);
while($rows = $query->fetch_array()){
	$arr[$rows["Match_ID"]]["Match_ID"]			=	$rows["Match_ID"]; //赛事id
	$arr[$rows["Match_ID"]]["Match_Date"]		=	$rows["Match_Date"];
	$arr[$rows["Match_ID"]]["Match_Time"]		=	$rows["Match_Time"];
	$arr[$rows["Match_ID"]]["Match_Master"]		=	$rows["Match_Master"];
	$arr[$rows["Match_ID"]]["Match_Guest"]		=	$rows["Match_Guest"];
	$arr[$rows["Match_ID"]]["Match_RGG"]		=	$rows["Match_RGG"];
	$arr[$rows["Match_ID"]]["Match_Name"]		=	$rows["Match_Name"];
	$arr[$rows["Match_ID"]]["Match_IsLose"]		=	$rows["Match_IsLose"];
	$arr[$rows["Match_ID"]]["Match_BzM"]		=	$rows["Match_BzM"];
	$arr[$rows["Match_ID"]]["Match_BzG"]		=	$rows["Match_BzG"];
	$arr[$rows["Match_ID"]]["Match_BzH"]		=	$rows["Match_BzH"];
	$arr[$rows["Match_ID"]]["Match_DxDpl"]		=	$rows["Match_DxDpl"];
	$arr[$rows["Match_ID"]]["Match_DxXpl"]		=	$rows["Match_DxXpl"];
	$arr[$rows["Match_ID"]]["Match_DxGG"]		=	$rows["Match_DxGG"];
	$arr[$rows["Match_ID"]]["Match_Ho"]			=	$rows["Match_Ho"];
	$arr[$rows["Match_ID"]]["Match_Ao"]			=	$rows["Match_Ao"];
	$arr[$rows["Match_ID"]]["Match_MasterID"]	=	$rows["Match_MasterID"];
	$arr[$rows["Match_ID"]]["Match_GuestID"]	=	$rows["Match_GuestID"];
	$arr[$rows["Match_ID"]]["Match_ShowType"]	=	$rows["Match_ShowType"];
	$arr[$rows["Match_ID"]]["Match_DsDpl"]		=	$rows["Match_DsDpl"];
	$arr[$rows["Match_ID"]]["Match_DsSpl"]		=	$rows["Match_DsSpl"];
	$arr_m[$rows["Match_ID"]]					=	0;
	$mid.=$rows["Match_ID"].',';
}

if($mid){
	$mid	=	rtrim($mid,",");
	$sql	=	"select match_id,point_column,bet_money from `k_bet` where match_type=1 and match_id in($mid) and `status`!=3";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$arr[$rows["match_id"]][$rows["point_column"]]['num']	=	$arr[$rows["match_id"]][$rows["point_column"]]['num']+1;
		$arr[$rows["match_id"]][$rows["point_column"]]['money']	=	$arr[$rows["match_id"]][$rows["point_column"]]['money']+$rows["bet_money"];
		$arr_m[$rows["match_id"]]								+=	$rows["bet_money"];
	}
}

arsort($arr_m);
?>
<html>
<head>
<title>注单审核</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<script language="javascript">
function gopage(url){
	location.href=url;
}
function re_load(){
	location.reload();
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF" >
  <table width="900" height="0" cellpadding="0" cellspacing="0">
	<tr style="width:150px;">
 
	  <td width="119">类型：
	    <select id="select" name="table" onChange="gopage(this.value);" class="za_select">
        <option value="ft_danshi.php?match_type=<?=$match_type?>" >足球</option>
        <option value="bk_danshi.php?match_type=<?=$match_type?>" selected>篮球</option>
		<option value="tennis_danshi.php?match_type=<?=$match_type?>">网球</option>
		<option value="volleyball_danshi.php?match_type=<?=$match_type?>">排球</option>
		<option value="baseball_danshi.php?match_type=<?=$match_type?>">棒球</option>
		<option value="guanjun.php?match_type=<?=$match_type?>" >冠軍</option>
		<option value="jinrong.php?match_type=<?=$match_type?>" >金融</option>
		<option value="chuanguan.php?date=<?=date("m-d")?>" >串关</option>
      </select></td>
		<td width="230">美东时间：<?php if($match_type==1){?>
	      <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1">
	    <option value="<?=$_SERVER['PHP_SELF']?>?match_type=1">==选择时间==</option>
      <? for ($i=0;$i<=6;$i++){
	   $s=strtotime("-$i day");
	   $date=date("m-d",$s);
	    ?>
        <option value="<?=$_SERVER['PHP_SELF']?>?match_type=1&date=<?=$date?>" <?=@$page_date==$date ? "selected" : "" ?>><?=$date?></option>
  <?}?>
      </select><?php }else if($match_type==0){?>
	
	     <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1">
	    <option value="<?=$_SERVER['PHP_SELF']?>?match_type=0">==选择时间==</option>
      <? for ($i=1;$i<=7;$i++){
	   $s=strtotime("+$i day");
	   $date=date("m-d",$s);
	    ?>
        <option value="<?=$_SERVER['PHP_SELF']?>?match_type=0&date=<?=$date?>" <?=@$page_date==$date ? "selected" : "" ?>><?=$date?></option>
  <?}?>
      </select>
	<?}?>&nbsp;&nbsp;<a href="javascript:re_load();">刷新</a></td>
		<td width="370" align="left">&nbsp;&nbsp;选择联盟&nbsp;
     <select id="set_account" name="match_name" onChange="gopage(this.value);" class="za_select">
     <option value="<?=$_SERVER['PHP_SELF']?>?match_type=<?=$match_type?>&amp;date=<?=$page_date?>">==选择联盟==</option>
	 <?php
	 foreach ($match_name as $k=>$v){?>
  	    <option <? if(urldecode($_GET["match_name"])==$v){?> selected="selected" <? }?> value="<?=$_SERVER['PHP_SELF']?>?match_name=<?=urlencode($v)?>&amp;match_type=<?=$match_type?>&amp;date=<?=$page_date?>"><?=$v?></option>
  	   <?}?>
     </select>	</td>
		<td width="179"><A href="bk_danshi.php?match_type=<?=$match_type?>">單式</A> <?if($match_type==1){?> <A href="bk_gunqiu.php">滾球</A> <?}?> <a href="bk_danjie.php?match_type=<?=$match_type?>">单节</a></td>
	</tr>
</table>
 
  <table width="878" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft">
    <td width="60" height="24"><strong>時間</strong></td>
        <td nowrap="nowrap" width="160"><strong>聯盟</strong></td>
        <td width="60"><strong>場次</strong></td>
        <td width="160"><strong>隊伍</strong></td>
        <td width="160"><strong>讓球 / 注單</strong></td>
        <td width="160"><strong>大小盤 / 注單</strong></td>
        <td width="110"><strong>單雙</strong></td>
    </tr>
<?php
foreach($arr_m as $k=>$v){
	$rows	=	$arr[$k];
	$color	=	getColor($v);
?>
    <tr bgcolor="<?=$color?>" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='<?=$color?>'">
        <td align="center"><?=$rows["Match_Date"]?><br />
					     <?=$rows["Match_Time"]?><br />
				      <? if($rows["Match_IsLose"]==1){?>  <span style="color:#FF0000">滾球</span><? } ?></td>
        <td><?=$rows["Match_ID"]?><br /><?=$rows["Match_Name"]?></td>
        <td><?=$rows["Match_MasterID"]?><br /><?=$rows["Match_GuestID"]?></td>
        <td align="left"><?=$rows["Match_Master"]?>
          <br />
      <?=$rows["Match_Guest"]?></td>
        <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tbody>
            <tr align="right">
              <td width="50%"><? if($rows["Match_ShowType"]=="H"){?>  <font color="#0033FF"><?=$rows["Match_RGG"]?> </font> <?}?>
               <? if($rows["Match_Ho"]>0) echo double_format($rows["Match_Ho"]);?></font>              </td>
              <td width="50%"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_Ho" <?=getAC($arr[$rows["Match_ID"]]["match_ho"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_ho"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_ho"]['money'])?></a></td>
            </tr>
            <tr align="right">
              <td><? if($rows["Match_ShowType"]=="C"){?>  <font color="#0033FF"><?=$rows["Match_RGG"]?> </font> <?}?>
              <? if($rows["Match_Ao"]>0) echo double_format($rows["Match_Ao"]);?>             </td>
              <td><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=match_ao" <?=getAC($arr[$rows["Match_ID"]]["match_ao"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_ao"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_ao"]['money'])?></a></td>
            </tr>
          </tbody>
        </table></td>
        <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tbody>
            <tr align="right">
              <td width="50%"><? if ($rows["Match_DxGG"]>0){?>   <font color="#0033FF"><?="O".$rows["Match_DxGG"]?> </font><?}?>
              <? if($rows["Match_DxDpl"]>0) echo double_format($rows["Match_DxDpl"]);?>              </td>
              <td width="50%"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_DxDpl" <?=getAC($arr[$rows["Match_ID"]]["match_dxdpl"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_dxdpl"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_dxdpl"]['money'])?></a> </td>
            </tr>
            <tr align="right">
              <td>  <? if ($rows["Match_DxGG"]>0){?>   <font color="#0033FF"><?="U".$rows["Match_DxGG"]?> </font><?}?>  <? if($rows["Match_DxXpl"]>0) echo double_format($rows["Match_DxXpl"]);?>     <br />              </td>
              <td><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_DxXpl" <?=getAC($arr[$rows["Match_ID"]]["match_dxxpl"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_dxxpl"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_dxxpl"]['money'])?></a> </td>
            </tr>
          </tbody>
        </table></td>
        <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tbody>
            <tr align="right">
              <td width="26%"><font color="#0033FF">單</font></td>
              <td width="74%"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_DsDpl" <?=getAC($arr[$rows["Match_ID"]]["match_dsdpl"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_dsdpl"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_dsdpl"]['money'])?></a> </td>
            </tr>
            <tr align="right">
              <td>  <font color="#0033FF">雙</font></td>
              <td><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_DsSpl" <?=getAC($arr[$rows["Match_ID"]]["match_dsspl"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_dsspl"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_dsspl"]['money'])?></a> </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
<? }?>
</table>
</body>
</html>