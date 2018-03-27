<?php
include_once("../common/login_check.php");
check_quanxian("jyqk");
include_once("../../include/mysqli.php");
include_once("../../include/mysqlis.php");
include_once("common.php");

$date			=	date("m-d");
if($_GET['date']){
	$date		=	$_GET['date'];
}
$page_date		=	$date;
$sql			=	"SELECT Match_ID,Match_Date, Match_Time, Match_Master, Match_Guest, Match_Name, Match_IsLose,Match_BzM, Match_BzG, Match_BzH , Match_MasterID, Match_GuestID FROM baseball_Match ";

isset($_GET['match_type'])?$match_type=intval($_GET["match_type"]):$match_type=1;
$sqlwhere		=	" WHERE Match_Type=1 and Match_Date='".date("m-d")."'";
if(isset($_GET["date"])){
	$sqlwhere	=	" WHERE Match_Type=1 AND Match_Date='$page_date' ";
}
$sql			.=	$sqlwhere;
$match_name		=	getmatch_name('baseball_Match',$sqlwhere);
if(isset($_GET["match_name"])) $sql.="  and match_name='".urldecode($_GET["match_name"])."'";
$sqlorder		=	" order by Match_CoverDate,match_name asc ";
$sql			.=	$sqlorder;

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
	$arr[$rows["Match_ID"]]["Match_MasterID"]	=	$rows["Match_MasterID"];
	$arr[$rows["Match_ID"]]["Match_GuestID"]	=	$rows["Match_GuestID"];
	$arr_m[$rows["Match_ID"]]					=	0;
	$mid.=$rows["Match_ID"].',';
}

if($mid){
	$mid	=	rtrim($mid,",");
	$sql	=	"select match_id,point_column,bet_money from `k_bet` where match_type=1 and match_id in($mid) and `status`!=3";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		if(strrpos($rows["point_column"],"match_total") === 0){
			$arr[$rows["match_id"]]['zdf']['num']					=	$arr[$rows["match_id"]]['zdf']['num']+1;
			$arr[$rows["match_id"]]['zdf']['money']					=	$arr[$rows["match_id"]]['zdf']['money']+$rows["bet_money"];
		}else{
			$arr[$rows["match_id"]][$rows["point_column"]]['num']	=	$arr[$rows["match_id"]][$rows["point_column"]]['num']+1;
			$arr[$rows["match_id"]][$rows["point_column"]]['money']	=	$arr[$rows["match_id"]][$rows["point_column"]]['money']+$rows["bet_money"];
		}
		$arr_m[$rows["match_id"]]									+=	$rows["bet_money"];
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
        <option value="bk_danshi.php?match_type=<?=$match_type?>">篮球</option>
		<option value="tennis_danshi.php?match_type=<?=$match_type?>">网球</option>
		<option value="volleyball_danshi.php?match_type=<?=$match_type?>">排球</option>
		<option value="baseball_danshi.php?match_type=<?=$match_type?>" selected>棒球</option>
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
		<td width="179"><A href="baseball_danshi.php?match_type=<?=$match_type?>">單式</A>&nbsp;&nbsp;<a href="baseball_zdf.php?match_type=<?=$match_type?>">总得分</a></td>
	</tr>
</table>
  <table width="785" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft">
    <td width="60" height="24">時間</td>
      <td nowrap="nowrap" width="160">聯盟</td>
      <td width="60">場次</td>
      <td width="300">隊伍</td>
      <td width="119"><span style="width:121px;">獨贏</span></td>
      <td width="79">总得分</td>
    </tr>
<?php
foreach($arr_m as $k=>$v){
	$rows	=	$arr[$k];
	$color	=	getColor($v);
?>
    <tr bgcolor="<?=$color?>" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='<?=$color?>'">
        <td align="center"><?=$rows["Match_Date"]?><br>
      <?=$rows["Match_Time"]?><br><? if($rows["Match_IsLose"]==1){?>  <span style="color:#FF0000">滾球</span><? } ?></td>
        <td><?=$rows["Match_ID"]?><br /><?=$rows["Match_Name"]?></td>
        <td><?=$rows["Match_MasterID"]?><br>
      <?=$rows["Match_GuestID"]?></td>
        <td align="left"><?=$rows["Match_Master"]?><br><?=$rows["Match_Guest"]?></td>
        <td valign="middle"><table cellspacing="0" cellpadding="0" width="100%" border="0">
            <tr align="right">
              <td align="right" width="32%"> 
                <? if($rows["Match_BzM"]>0) echo double_format($rows["Match_BzM"]);?>
             <br /></td>
              <td width="68%"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_BzM" <?=getAC($arr[$rows["Match_ID"]]["match_bzm"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_bzm"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_bzm"]['money'])?></a></td>
            </tr>
            <tr align="right">
              <td align="right"><? if($rows["Match_BzG"]>0) echo double_format($rows["Match_BzG"]);?><br /></td>
              <td><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&point_column=Match_BzG" <?=getAC($arr[$rows["Match_ID"]]["match_bzg"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_bzg"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_bzg"]['money'])?></a></td>
            </tr>
        </table></td>
        <td align="right"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&column_like=Match_Total" <?=getAC($arr[$rows["Match_ID"]]["zdf"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["zdf"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["zdf"]['money'])?></a></td>
    </tr>
<? }?>
</table>
</body>
</html>