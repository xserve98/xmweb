<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");

$uid		=	$_GET["uid"];
$stime		=	$_GET["s_time"];
$etime		=	$_GET["e_time"];
$type		=	$_GET["type"];
$username	=	$_GET["username"];
$wtype		=	$_GET["wtype"];
$wtarr		=	wtype($wtype);
$wstr		=	"";
for($i=0; $i<count($wtarr); $i++){
	$wstr.="'".$wtarr[$i]."',";
}
$wstr		=	substr($wstr,0,-1);
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式报表</TITLE>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{
	color:#F37605;
	text-decoration: none;
}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE3 {
	color: #FF0000;
	font-weight: bold;
}
.STYLE4 {
	color: #0000FF;
	font-weight: bold;
}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：查看所有注单情况（所有时间以美国东部标准为准）</span></font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" colspan="2" align="center" bgcolor="#FFFFEE"><span class="STYLE4">未结算</span></td>
    <td width="26%" colspan="2" align="center" bgcolor="#FFF0F1"><span class="STYLE3">已结算</span></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#E1FFE1"><a href="list_look_ck.php?ys=ck&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">存款</a></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#E1DFFF"><a href="list_look_hk.php?ys=hk&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">汇款</a></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#FFE1E1"><a href="list_look_qk.php?ys=qk&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">取款</a></td>
  </tr>
  <tr>
    <td width="13%" height="15" align="center" bgcolor="#E6FFEB"><a href="list_look_ds.php?ys=ds&s_time=<?=$stime?>&e_time=<?=$etime?>&type=N&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">单式</a></td>
    <td width="13%" align="center" bgcolor="#E1E2FF"><a href="list_look_cg.php?ys=cg&s_time=<?=$stime?>&e_time=<?=$etime?>&type=N&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">串关</a></td>
    <td height="14" align="center" bgcolor="#E6FFEB"><a href="list_look_ds.php?ys=ds&s_time=<?=$stime?>&e_time=<?=$etime?>&type=Y&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">单式</a></td>
    <td align="center" bgcolor="#E1E2FF"><a href="list_look_cg.php?ys=cg&s_time=<?=$stime?>&e_time=<?=$etime?>&type=Y&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">串关</a></td>
  </tr>
</table>
   <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" colspan="2" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="50"><strong>编号</strong></td>
        <td width="153"><strong>联赛名</strong></td>
        <td width="200"><strong>编号/主客队</strong></td>
        <td width="296"><strong>投注详细信息</strong></td>
        <td width="86"><strong>下注</strong></td>
        <td width="86"><strong><? if($type == "Y") echo "结果"; else echo "可赢";?></strong></td>
        <td width="126"><strong>投注/开赛时间</strong></td>
        <td width="106"><strong>投注账号</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sql	=	"select bid from k_bet where lose_ok=1";
if(isset($_GET["uid"])) $sql	.=	" and uid=".$_GET["uid"];

if($wtype=="RE"){
	$sql	.=	" and match_type=2 ";
}elseif(($wtype=="ROU" || $wtype=="HRE" || $wtype=="HROU")){
	$sql	.=	" and match_type=2 and point_column in (".$wstr.") ";
}elseif($wtype!="P" && $wtype!=""){
	$sql	.=	" and point_column in (".$wstr.") ";
}elseif($wtype=="P"){
	$sql	.=	" and match_type=20 ";
}
if(isset($_GET["s_time"])) $sql	.=	" and match_coverdate>='".$_GET["s_time"]."'";

if($type == "Y") $sql	.=	" and status>0";
else $sql	.=	" and status=0";

if(isset($_GET["e_time"])) $sql	.=	" and match_coverdate<='".$_GET["e_time"]."'";

$sql	.=	" order by  bid  desc";

$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,30);

$bid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$bid .=	$row['bid'].',';
  }
  if($i > $end) break;
  $i++;
}
$bet_money	=	$win	=	0;
if($bid){
	$bid	=	rtrim($bid,',');
	$sql	=	"select * from k_bet where bid in ($bid) order by bid desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$bet_money	+=	$rows["bet_money"];
		
		$color	 = "#FFFFFF";
		$over	 = "#EBEBEB";
		$out	 = "#ffffff";
		
		if(($rows["balance"]*1)<0 || round($rows["assets"]-$rows["bet_money"],2) != round($rows["balance"],2)){ //投注后用户余额不能为负数，投注后金额要=投注前金额-投注金额
			$over = $out = $color = "#FBA09B";
		}elseif($rows["match_type"]==1 && strtotime($rows["bet_time"])>=strtotime($rows["match_endtime"])){ //不是滚球，抽注时间不能>=开赛时间
			$over = $out = $color = "#FBA09B";
		}elseif(double_format($rows["bet_money"]*($rows["ben_add"]+$rows["bet_point"])) !== double_format($rows["bet_win"])){
			$over = $out = $color = "#FBA09B";
		}
?> 
            <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
  <td  align="center" ><?=$rows["bid"]?></td>
              <td><?=$rows["match_name"]?><br /><span style="color:#999999"><?=$rows["www"]?></span>
			  <?php
			  if($rows["status"]==3 || $rows["status"]==8 || $rows["status"]==6 || $rows["status"]==7){
			  	echo '<br/><span style="color:#999999;">'.$rows["sys_about"].'</span>';
			  }
			  ?></td>
              <td><a href="../zdgl/check_zd.php?action=1&id=<?=$rows["number"]?>" target="_blank"><?=$rows["number"]?></a>
			  <br/>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td><font color="<? if ($rows["ball_sort"]=="足球滚球"){echo "#0066FF";}else{echo "#336600";}?>"><b><?=$rows["ball_sort"]?></b></font><br/><?=$rows["match_time"]?>
			 <font style="color:#FF0033">
			  <?=str_replace("-","<br/>",$rows["bet_info"])?>
			  </font>
			  <? if($rows["status"]!=0 && $rows["status"]!=3 && $rows["status"]!=8 && $rows["status"]!=6 && $rows["status"]!=7)
			if($rows["MB_Inball"]!=''){?>
			[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
			<? } ?>			 </td>
              <td><?=$rows["bet_money"]?></td>
	          <td><?php
	  $jine = 0; 
	  if($type == "Y"){
	  	$jine=$rows["win"]+$rows["fs"];
	  }else{
		$jine=$rows["bet_win"];
	  }
	  $win+=$jine;
	  echo $jine;
	?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?><br/><?=date("m-d H:i:s",strtotime($rows["match_endtime"]))?></td>
              <td><?=$username?></td>
        </tr>        	
<?php
	}
}
?>
  </table>  </tr>
    <tr>
      <td width="35%" >
    该页统计：总注金：<span style="color:#FF0000"><?=$bet_money?></span>，<?php if($type == "Y") echo "已赢金额：".$win."，盈亏：".($bet_money-$win>0 ? '<span style="color:#FF0000;">'.($bet_money-$win).'</span>' : '<span style="color:#000000;">'.($bet_money-$win).'</span>'); else echo "最高可赢：$win"?>  	  </td>
      <td width="65%" align="right" ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td>
    </tr>
</table>
</body>
</html>