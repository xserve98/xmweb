<?php
include_once("../common/login_check.php");
check_quanxian("jyqk");
include_once("../../include/mysqli.php");
include_once("common.php");

$date			=	date("m-d");
if($_GET['date']){
	$date		=	$_GET['date'];
}
$page_date		=	$date;
isset($_GET['match_type'])?$match_type=intval($_GET["match_type"]):$match_type=1;

if(isset($_GET["date"])){
	$sqlwhere	=	" where bet_time like('%$page_date%')";
}
$arr			=	array();
$sql			=	"select bet_money from `k_bet_cg_group` ".$sqlwhere;
$query			=	$mysqli->query($sql);
while($rows		=	$query->fetch_array()){
	$arr['num']		=	$arr['num']+1;
	$arr['money']	=	$arr['money']+$rows["bet_money"];
}
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
<table width="371" height="0" cellpadding="0" cellspacing="0">
  <tr style="width:150px;">
    <td width="119">类型：
      <select id="select" name="table" onChange="gopage(this.value);" class="za_select">
          <option value="ft_danshi.php?match_type=<?=$match_type?>" >足球</option>
          <option value="bk_danshi.php?match_type=<?=$match_type?>">篮球</option>
          <option value="tennis_danshi.php?match_type=<?=$match_type?>">网球</option>
          <option value="volleyball_danshi.php?match_type=<?=$match_type?>">排球</option>
          <option value="baseball_danshi.php?match_type=<?=$match_type?>" >棒球</option>
          <option value="guanjun.php?match_type=<?=$match_type?>">冠軍</option>
          <option value="jinrong.php?match_type=<?=$match_type?>" >金融</option>
          <option value="chuanguan.php?date=<?=date("m-d")?>"  selected>串关</option>
    </select></td>
    <td width="250">美东时间：
        <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1">
          <option value="<?=$_SERVER['PHP_SELF']?>?match_type=1">查看所有串关</option>
          <? for ($i=0;$i<=6;$i++){
	   $s=strtotime("-$i day");
	   $date=date("m-d",$s);
	    ?>
          <option value="<?=$_SERVER['PHP_SELF']?>?match_type=1&date=<?=$date?>" <?=@$page_date==$date ? "selected" : "" ?>>
            <?=$date?>
          </option>
          <?}?>
    </select>&nbsp;&nbsp;<a href="javascript:re_load();">刷新</a></td>
  </tr>
</table>
<table width="302" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft">
    <td width="300" height="24"><strong>結果</strong></td>
    </tr>
<?php
	$color	=	getColor($arr['money']);
?>
    <tr bgcolor="<?=$color?>" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='<?=$color?>'">
        <td height="24" align="center"><a href="look_cg.php?date=<?=$page_date?>" <?=getAC($arr['num'])?> ><?=getString($arr['num'])?>/<?=getString($arr['money'])?>
        </a></td>
    </tr>
</table>
</body>
</html>