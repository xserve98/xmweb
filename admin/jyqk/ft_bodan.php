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
$sql		=	"SELECT Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID, Match_GuestID,Match_Name FROM Bet_Match";

isset($_GET['match_type'])?$match_type=intval($_GET["match_type"]):$match_type=1;

if($match_type==1){   //单式
	$sqlwhere		=	" where match_date='".date("m-d")."' and Match_CoverDate>now() and Match_Bd21>0 ";
}else if($match_type==0){ //早餐
	$sqlwhere		=	" where match_date!='".date("m-d")."' and Match_CoverDate>now() and Match_Bd21>0 ";
	if(isset($_GET["date"])){
		$sqlwhere	=	" where match_date ='$page_date' and Match_Bd21>0 ";
	}
}
$sql		.=	$sqlwhere;
$match_name	=	getmatch_name('bet_match',$sqlwhere);
if(isset($_GET["match_name"])) $sql.=" and match_name='".urldecode($_GET["match_name"])."'";
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
	$arr[$rows["Match_ID"]]["Match_Name"]		=	$rows["Match_Name"];
	$arr[$rows["Match_ID"]]["Match_MasterID"]	=	$rows["Match_MasterID"];
	$arr[$rows["Match_ID"]]["Match_GuestID"]	=	$rows["Match_GuestID"];
	$arr_m[$rows["Match_ID"]]					=	0;
	$mid.=$rows["Match_ID"].',';
}
if($mid){
	$mid	=	rtrim($mid,",");
	$sql	=	"select match_id,bet_money,bet_info from `k_bet` where match_type<2 and match_id in($mid) and `status`!=3";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		if(strrpos($rows["bet_info"],"波胆") === 0){
			$arr[$rows["match_id"]]["match_bd"]['num']	=	$arr[$rows["match_id"]]["match_bd"]['num']+1;
			$arr[$rows["match_id"]]["match_bd"]['money']=	$arr[$rows["match_id"]]["match_bd"]['money']+$rows["bet_money"];
			$arr_m[$rows["match_id"]]					+=	$rows["bet_money"];
		}
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
  <table width="1048" height="0" cellpadding="0" cellspacing="0">
	<tr style="width:150px;">
	  <td width="119">类型：
	    <select id="select" name="table" onChange="gopage(this.value);" class="za_select">    <option value="ft_danshi.php?match_type=<?=$match_type?>"  >足球</option>
        <option value="bk_danshi.php?match_type=<?=$match_type?>">篮球</option>
		<option value="tennis_danshi.php">网球</option>
		<option value="volleyball_danshi.php">排球</option>
		<option value="baseball_danshi.php?match_type=<?=$match_type?>">棒球</option>
		<option value="guanjun.php" >冠軍</option>
		<option value="jinrong.php" >金融</option>
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
		<td width="262" align="left">&nbsp;&nbsp;选择联盟&nbsp;
     <select id="set_account" name="match_name" onChange="gopage(this.value);" class="za_select">
     <option value="<?=$_SERVER['PHP_SELF']?>?match_type=<?=$match_type?>&amp;date=<?=$page_date?>">==选择联盟==</option>
	 <?php
	 foreach ($match_name as $k=>$v){?>
  	    <option <? if(urldecode(@$_GET["match_name"])==$v){?> selected="selected" <? }?> value="<?=$_SERVER['PHP_SELF']?>?match_name=<?=urlencode(@$v)?>&amp;match_type=<?=$match_type?>&amp;date=<?=$page_date?>"><?=$v?></option>
  	   <?php }?>
     </select>	</td>
		<td width="435"><A  href="ft_danshi.php?match_type=<?=$match_type?>">單式</A>&nbsp;&nbsp;<?php if($match_type==1){?> <A href="ft_gunqiu.php">滾球</A><?}?>&nbsp;&nbsp;<a  href="ft_shangbanchang.php?match_type=<?=$match_type?>">上半場</a>&nbsp;&nbsp;<A href="ft_shangbanbodan.php?match_type=<?=$match_type?>">上半波膽</A>&nbsp;&nbsp;<span id="pg_txt"><a href="ft_bodan.php?match_type=<?=$match_type?>">波膽</a>&nbsp;&nbsp;<A href="ft_ruqiushu.php?match_type=<?=$match_type?>">入球数</A>&nbsp;&nbsp;<A  href="ft_banquanchang.php?match_type=<?=$match_type?>">半全場</A><? if($match_type==1){?>&nbsp;&nbsp;<A  href="ft_yks.php">已开赛</A><?}?></span></td>
	</tr>
  </table>
  <table width="526" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft">
    <td width="60" height="24"><strong>時間</strong></td>
        <td nowrap="nowrap" width="160"><strong>聯盟</strong></td>
        <td width="60"><strong>場次</strong></td>
        <td width="160"><strong>隊伍</strong></td>
        <td width="80"><strong>波膽</strong></td>
    </tr>
<?php
foreach($arr_m as $k=>$v){
	$rows	=	$arr[$k];
	$color	=	getColor($v);
?>
    <tr bgcolor="<?=$color?>" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='<?=$color?>'">
        <td align="center"><?=$rows["Match_Date"]?><br><?=$rows["Match_Time"]?><br /><? if(@$rows["Match_IsLose"]==1){?>  <span style="color:#FF0000">滾球</span><? } ?></td>
        <td><?=$rows["Match_ID"]?><br /><?=$rows["Match_Name"]?></td>
        <td><?=$rows["Match_MasterID"]?><br><?=$rows["Match_GuestID"]?></td>
        <td align="left"><?=$rows["Match_Master"]?><br><?=$rows["Match_Guest"]?></td>
        <td align="right"><a href="look_ds.php?match_id=<?=$rows["Match_ID"]?>&column_like=Match_Bd" <?=getAC($arr[$rows["Match_ID"]]["match_bd"]['num'])?> ><?=getString($arr[$rows["Match_ID"]]["match_bd"]['num'])?>/<?=getString($arr[$rows["Match_ID"]]["match_bd"]['money'])?></a></td>
    </tr>
<? }?>
</table>
</body>
</html>