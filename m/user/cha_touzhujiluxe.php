<?php
session_start();
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../include/config.php");

$bet_money	=	0;
$ky			=	0;
$i			=	0;
$s_time		=	$_GET["s_time"];
$e_time		=	$_GET["e_time"];
$stime		=	$_GET["s_time"]." 00:00:00";
$etime		=	$_GET["e_time"]." 23:59:59";
$uid		=	$_SESSION["uid"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>串关查询</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE1 {color: #000000}
-->
</style>
</head>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<body>
<div id="top_lishi">
  <div class="waikuang00">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
    <tr  class="sekuai_01">
	  <td width="150">投注时间</td>
	  <td width="69">注单号/模式</td>
	  <td width="366">投注详细信息</td>
	  <td width="80">下注</td>
	  <td width="80">结果</td>
	</tr>
<?php
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
	


$sql		=	"select gid from k_bet_cg_group where uid=$uid and match_coverdate>='$stime' and match_coverdate<'$etime' and `status` in(1,3) order by gid desc";
//$sql		=	"select gid from k_bet_cg_group where uid=$uid and match_coverdate>='$stime' and match_coverdate<'$etime' and `status`<>0 and `status`<>3 order by gid desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,10,10);

$gid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*10+1;
$end		=	$thisPage*10;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$gid .=	$row['gid'].',';
  }
  if($i > $end) break;
  $i++;
}
if($gid == ''){
?>	
	<tr>	
		<td height="30" colspan="5" align="center" bgcolor="#FFFFFF" ><span class="STYLE1">暂无记录</span></td>
	</tr>
<?php
}else{
	$gid	=	rtrim($gid,',');
	$arr	=	array();
	$sql	=	"select gid,bet_time,cg_count,bet_money,win,bet_win,`status`,fs from k_bet_cg_group where gid in ($gid) order by gid desc";
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$arr[$rows['gid']]['bet_time']	=	$rows['bet_time'];
		$arr[$rows['gid']]['cg_count']	=	$rows['cg_count'];
		$arr[$rows['gid']]['bet_money']	=	$rows['bet_money'];
		$arr[$rows['gid']]['win']		=	$rows['win'];
		$arr[$rows['gid']]['bet_win']	=	$rows['bet_win'];
		$arr[$rows['gid']]['status']	=	$rows['status'];
		$arr[$rows['gid']]['fs']		=	$rows['fs'];
	}
	
	$arr_cg	=	array();
	$sql	=	"select gid,bid,bet_info,match_name,master_guest,bet_time,MB_Inball,TG_Inball,status from k_bet_cg where gid in ($gid) order by bid desc";
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$arr_cg[$rows['gid']][$rows['bid']]['bet_info']		=	$rows['bet_info'];
		$arr_cg[$rows['gid']][$rows['bid']]['match_name']	=	$rows['match_name'];
		$arr_cg[$rows['gid']][$rows['bid']]['master_guest']	=	$rows['master_guest'];
		$arr_cg[$rows['gid']][$rows['bid']]['bet_time']		=	$rows['bet_time'];
		$arr_cg[$rows['gid']][$rows['bid']]['MB_Inball']	=	$rows['MB_Inball'];
		$arr_cg[$rows['gid']][$rows['bid']]['TG_Inball']	=	$rows['TG_Inball'];
		$arr_cg[$rows['gid']][$rows['bid']]['status']		=	$rows['status'];
	}
	foreach($arr as $gid=>$rows){
			$bet_money	+=	$rows["bet_money"];
			$ky			+=	$rows["bet_win"];
			if(($i%2)==0) $bgcolor="#FFFFFF";
			else $bgcolor="#F5F5F5";
			$i++;
	?>
    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" >
	  <td><?=$rows["bet_time"]?></td>
	  <td><font color="#000000">XB_<?=$gid?></font><br>
	    <?=$rows["cg_count"]?>串1</td>
	  <td>
      <?php
						$x		=	0;
						$nums	=	count($arr_cg[$gid]);
						foreach($arr_cg[$gid] as $k=>$myrows){
							echo "<div style=\"height:40px; width:99%; padding:10px;\">";
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
						 <span style="color:#005481"><b><?=$myrows["match_name"]?></b></span><br />
                         <?
						    //正则匹配
                         	$m_count=count($m);
							preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
							if(strpos($myrows["master_guest"],'VS.')) $team=explode('VS.',$myrows["master_guest"]);
							else $team=explode('VS',$myrows["master_guest"]);
						 ?>
                         <? if(count(@$matches)>0) echo @$myrows['match_time'].@$matches[0]."<br/>";?>
						
                         <? if(mb_strpos($m[1],"让")>0) { //让球?>
                         <? if(mb_strpos($m[1],"主")===false) { //客让?>
                <font style="color:#000000"><?=$team[1]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <font style="color:#890209"><?=$team[0]?></font>(主)     <? }else{ //主让?>
                 <font style="color:#000000"><?=$team[0]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <font style="color:#890209"><?=$team[1]?></font>
                          <? }?>
                         <?
						 $m[1]="";
						  }else{ ?>
            <font style="color:#000000"><?=$team[0]?></font> <? if(isset($score)) { ?> <?=$score?> <? }else{?>VS.<? }?><font style="color:#890209"><?=$team[1]?></font>
                         <? } ?>
                         <br />
						<font style="color:#000000"><? if($m_count==3){
							if(strpos($m[1],'@')){
								$ss = explode('@',$m[1]);
								echo $ss[0]." @ <font color=\"red\">".$ss[1]."</font>";
							}else{
								echo $m[1].' ';//半全场替换显示
								$arraynew=array($team[0]," / ",$team[1],"和局");
								$arrayold=array("主","/","客","和");
								$ss = str_replace($arrayold,$arraynew,preg_replace('[\((.*)\)]', '',$m[$m_count-1]));
								$ss = explode('@',$ss);
								echo $ss[0]." @ <font color=\"red\">".$ss[1]."</font>";
							}
						}
				  ?>
					    <? if($myrows["status"]==3 || $myrows["MB_Inball"]<0){?>
					    [取消]
					    <? }else if($myrows["status"]>0){?>
					    [<?=$myrows["MB_Inball"]?>:<?=$myrows["TG_Inball"]?>]
						<? }
							echo "</div>";
							if($x<$nums-1){
						?>
                        <hr style="height:1px; width:99%; color:#F60" />
						<?
							}
						$x++;
						}
						?>
      </td>
	  <td><?=double_format($rows["bet_money"])?></td>
	  <td>
      <?php
	  if($rows['status'] == 1){
		  $abc =  double_format($rows["fs"]+$rows["win"]);
		  if($rows["win"]){ //赢
		  	echo '<span style="color:#FF0000;">'.$abc.'</span>';
		  }else{ //输
		  	echo '<span style="color:#000000;">'.$abc.'</span>';
		  }
	  }elseif($rows["win"] > 0){
		  $abc = $rows["win"];
		  echo '<span style="color:#0000FF;">'.$abc.'</span>';
	  }else{
		  $abc = 0;
		  echo $abc;
	  }
	  @$win+=$abc;
	  ?>
      </td>
    </tr>
<?php
	}
}
?>
    </table>
	<div class="sekuai_03"><div class="fanye"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div>
	本页总投注金额：<span style="color:#FFFFFF"><?=double_format(@$bet_money)?></span> RMB，本页已赢金额：<span style="color:#FFFFFF"><?=double_format(@$win)?></span> RMB，本页盈亏：<span style="color:#FFFFFF"><?=double_format($win-$bet_money)?></span> RMB
    </div>
	</div>
  </div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>