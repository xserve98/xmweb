<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");

$uid		=	$_GET["uid"];
$stime		=	$_GET["s_time"];
$etime		=	$_GET["e_time"];
$type		=	$_GET["type"];
$wtype		=	$_GET["wtype"];
$username	=	$_GET["username"];
$bet_money	=	"";
$jgky		=	"";
$m			=	"";
$win		=	"";
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>串关报表</TITLE>
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
    <td height="24" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="66"><strong>编号</strong></td>
        <td width="136"><strong>模式</strong></td>
        <td width="519"><strong>投注详细信息</strong></td>
        <td width="86"><strong>下注</strong></td>
        <td width="86"><strong><? if($type == "Y") echo "结果"; else echo "可赢";?></strong></td>
        <td width="106"><strong>投注时间</strong></td>
        <td width="106"><strong>投注账号</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sql	=	"select gid from k_bet_cg_group where match_coverdate>'$stime' and match_coverdate<'$etime' and uid=$uid";
if($type == "N") $sql	.=	" and `status` in (0,2)";
else $sql	.=	" and `status` in (1,3)";
if($wtype!="P" && $wtype != "") $sql.=" and gid=0";
$sql	.=	" order by gid desc";

$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,5,30);

$gid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*5+1;
$end		=	$thisPage*5;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$gid .=	$row['gid'].',';
  }
  if($i > $end) break;
  $i++;
}
$bet_money	=	$win	=	$jgky	=	0;
if($gid){
	$gid	=	rtrim($gid,',');
	$info	=	array();
	$sql	=	"select match_name,master_guest,ball_sort,bet_time,match_endtime,gid,bid,status,MB_Inball,TG_Inball,bet_info from k_bet_cg where gid in ($gid)";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$info[$rows['gid']][$rows['bid']]['status']				=	$rows['status'];
		$info[$rows['gid']][$rows['bid']]['bet_info']			=	$rows['bet_info'];
		$info[$rows['gid']][$rows['bid']]['match_name']			=	$rows['match_name'];
		$info[$rows['gid']][$rows['bid']]['master_guest']		=	$rows['master_guest'];
		$info[$rows['gid']][$rows['bid']]['ball_sort']			=	$rows['ball_sort'];
		$info[$rows['gid']][$rows['bid']]['bet_time']			=	$rows['bet_time'];
		$info[$rows['gid']][$rows['bid']]['match_endtime']		=	$rows['match_endtime'];
	}
	
	$sql	=	"select gid,bet_time,cg_count,bet_money,win,bet_win,www,`status`,fs from k_bet_cg_group where gid in ($gid)";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$bet_money	+=	$rows["bet_money"];
		$jgky		+=	$rows["bet_win"];
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" style="background-color:#FFFFFF;">
	          <td  align="center" ><a href="../zdgl/check_zd.php?action=1&id=<?=$rows["gid"]?>"><?=$rows["gid"]?></a></td>
              <td><?=$rows["cg_count"]?>串一<br /><span style="color:#999999"><?=$rows["www"]?></span></td>
              <td><?php
			  $x	=	0;
			  foreach($info[$rows['gid']] as $k=>$myrows){
                            $m=explode('-',$myrows["bet_info"]);
						    echo $m[0];
							//print_r($m);
						   if(mb_strpos($myrows["bet_info"]," - ")){
						     //篮球上半之内的,这里换成正则表达替换
							  $m[2]=$m[2].preg_replace('[\[(.*)\]]', '',$m[3]);
							 //  $m[2]=$m[2].str_replace('[上半]','',$m[3]);
						   } 
						    $m[2]=@preg_replace('[\[(.*)\]]','',$m[2].$m[3]);
						    unset($m[3]);
							//如果是波胆
							if(mb_strpos($m[0],"胆")){
							 $bodan_score=explode("@",$m[1],2);
							 $score=$bodan_score[0];
							 $m[1]="波胆@".$bodan_score[1];
							}
							?>
						 <?=$myrows["match_name"]?><br />
                         <?
						    //正则匹配
                         	$m_count=count($m);
							preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
							if(strpos($rows["master_guest"],'VS.')) $team=explode('VS.',$myrows["master_guest"]);
							else $team=explode('VS',$myrows["master_guest"]);
						 ?>
                         <? if(count($matches)>0) echo @$myrows['match_time'].$matches[0]."<br/>";?>
						
                         <? if(mb_strpos($m[1],"让")>0) { //让球?>
                         <? if(mb_strpos($m[1],"主")===false) { //客让?>
                <?=$team[1]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?><?=$team[0]?>(主)     <? }else{ //主让?>
                 <?=$team[0]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?><?=$team[1]?>
                          <? }?>
                         <?
						 $m[1]="";
						  }else{ ?>
            <?=$team[0]?> <? if(isset($score)) { ?> <?=$score?> <? }else{?>VS.<? }?><?=$team[1]?>
                         <? } ?>
                         
                         <br />
						<font style="color:#FF0033">
					      <?
                             if($m_count==3)                             
						       echo  $m[1];
						  ?>
                          <?
                          	//半全场替换显示
							$arraynew=array($team[0]," / ",$team[1],"和局");
                            $arrayold=array("主","/","客","和");
						  
						  ?>
                  <?=str_replace($arrayold,$arraynew,preg_replace('[\((.*)\)]', '',$m[$m_count-1]))?><br/>
					    </font>
					    <? if($myrows["status"]==3){?>
					    [取消]
					    <? }else if($myrows["MB_Inball"] != "" && $myrows["MB_Inball"] != "null"){?>
					    [<?=$myrows["MB_Inball"]?>:<?=$myrows["TG_Inball"]?>]
						<? }
							if($x<$rows["cg_count"]-1){
						?>
                        <hr style="height:1px; color:#96B698" />
						<?
							}
						$x++;
						}
						?></td>
              <td><?=$rows["bet_money"]?></td>
	   <td><?php        
	  if($type=="N"){
		  $abc = $rows["bet_win"];
		  echo $abc;
	  }else{
		  if($rows["status"] == 1){
			  $abc =  $rows["fs"]+$rows["win"];
			  echo double_format($abc);
		  }elseif($rows["win"]>0){
			  $abc =  $rows["win"];
			  echo double_format($abc); 
		  }else{
			  $abc =  0;
			  echo double_format($abc);
		  }
	  }
	  $win+=$abc;
	  
	  ?></td>
              <td><?=$rows["bet_time"]?></td>
              <td><?=$username?></td>
        </tr>  	
<?php
	}
}
?>
    </table></td>
  </tr>
    <tr>
      <td width="35%" >该页统计：总注金：<span style="color:#FF0000"><?=$bet_money?></span>，<?php if($type == "Y") echo "已赢金额：".$win."，盈亏：".(($bet_money-$win)>0 ? '<span style="color:#FF0000">'.($bet_money-$win).'</span>' : '<span style="color:#000000">'.($bet_money-$win).'</span>'); else echo "最高可赢：".$jgky;?></td>
      <td width="65%" align="right" ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td>
 </table>
</body>
</html>