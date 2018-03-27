<?php
session_start();
//ini_set("display_errors","yes");
include_once("../common/login_check.php");
include_once("../include/config.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../common/function.php");

$bet_money	=	0;
$i			=	0;
$ky			=	0;
$jine		=	0;
$month = $_GET['month'];
$uid		=	$_GET['uid'];
$login_uid = @$_SESSION["uid"];

$t=$_REQUEST['t'];
if ($t=='y')
	$fsql=' and status in (1,4)';
if ($t=='k')
	$fsql=' and status in (2,5)';

if ($t=='p')
	$fsql=' and status not in (1,2,4,5)';


if($_GET['ac']!='fc' || strlen($_GET['ac'])==0){
$sql		=	"select bid from k_bet where `status`>0 and uid=$uid and match_coverdate like('".$month."%') and (ball_sort!='重庆时时彩' AND ball_sort!='广东快乐十分' AND ball_sort!='北京PK10' AND ball_sort!='福彩3D' AND ball_sort!='体彩排列三' AND ball_sort!='上海时时乐') ".$fsql." order by bid desc";
}else
{
	$sql		=	"select bid from k_bet where `status`>0 and uid=$uid and match_coverdate like('".$month."%') and (ball_sort='重庆时时彩' or ball_sort='广东快乐十分' or ball_sort='北京PK10' or ball_sort='福彩3D' or ball_sort='体彩排列三' or ball_sort='上海时时乐') ".$fsql." order by bid desc";
}
//echo $sql;
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page_records = 30;
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,$page_records,10);

$bid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*$page_records+1;
$end		=	$thisPage*$page_records;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$bid .=	$row['bid'].',';
  }
  if($i > $end) break;
  $i++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>万丰国际</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE1 {color: #000000}
-->
</style>
</head>
<script language="javascript">
if(self==top){
	//top.location='/index.php';
}
</script>
<body>
<div id="top_lishi">
  <div class="waikuang00">
  <div style="text-align:center; line-height:24px;">
      <a href="cha_touzhu_zongdai.php?month=<?=$month?>&uid=<?=$uid?>">体育</a> | <a href="cha_touzhu_zongdai_cg.php?month=<?=$month?>&uid=<?=$uid?>">串关</a> | <a href="cha_touzhu_zongdai.php?month=<?=$month?>&uid=<?=$uid?>&ac=fc">福彩</a> | <a href="/lotto/index.php?action=list_xj&month=<?=$month?>&uid=<?=$uid?>">乐透</a>
  </div>
  <table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
    <tr class="sekuai_01">
	  <td width="150">投注时间</td>
	  <td width="139">注单号/模式</td>
	  <td width="321">投注详细信息</td>
	  <td width="81">下注</td>
	  <td width="81">结果</td>
	</tr>	
<?php
if(!$bid){
?>	
	<tr align="center" bgcolor="#FFFFFF">
    <td height="30" colspan="5" valign="middle"><span class="STYLE1">暂无记录</span></td>
    </tr>
	<?php
}else{
	$bid	=	rtrim($bid,',');
	$sql	=	"select *,$beijingTime from k_bet where bid in ($bid) order by bid desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$bet_money+=$rows["bet_money"];
		$ky+=$rows["bet_win"];
		if(($i%2)==0) $bgcolor="#FFFFFF";
		else $bgcolor="#F5F5F5";
		$i++;
?>
    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" style="height:60px;" >
	  <td><?=$rows["bj_time"]?></td>
	  <td><font color="#000000">HG_<?=$rows["number"]?></font><br/>
		<?=$rows["ball_sort"]?>			
        <?
        $m=explode('-',$rows["bet_info"]);
		if($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融");
		else echo $tz_type=$m[0];
		
		if(count($m)>3){
		$m[2]=preg_replace('[\[(.*)\]]','',$m[2].$m[3]);
		unset($m[3]);
		}
		//如果是波胆
		if(mb_strpos($m[0],"胆")){
		$bodan_score=explode("@",$m[1],2);
		$score=$bodan_score[0];
		$m[1]="波胆@".$bodan_score[1];
		}
      ?></td>
	  <td>
	  <span style="color:#005481"><b><?=$rows["match_name"]?></b></span>
       <?
		//正则匹配
        $m_count=count($m);
		preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
		$m_count=count($m);
		preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
	   	if($rows["ball_sort"]=='重庆时时彩' || $rows["ball_sort"]=='福彩3D' || $rows["ball_sort"]=='体彩排列三' || $rows["ball_sort"]=='上海时时乐' || $rows["ball_sort"]=='广东快乐十分' || $rows["ball_sort"]=='北京PK10'){
			
			echo "第".$rows["match_id"]."期";
		}else{
	   		
		if(strpos($rows["master_guest"],'VS.')) $team=explode('VS.',$rows["master_guest"]);
		else $team=explode('VS',$rows["master_guest"]);
		}
		?>
        
		<? if($rows["match_type"]==2){
		echo $rows['match_time'];
		if($rows['match_nowscore']=="" && strpos($rows["ball_sort"],"滚球")==false) echo '(0:0)';
		else if(strtolower($rows["match_showtype"])=="h" && strpos($rows["ball_sort"],"滚球")==false) echo "(".$rows['match_nowscore'].")"; else if(strpos($rows["ball_sort"],"滚球")==false) echo "(".strrev($rows['match_nowscore']).")";}?>

		<br />
        <? if(mb_strpos($m[1],"让")>0) { //让球?>
        <? if(strtolower($rows["match_showtype"])=="c") { //客让?>
        <font style="color:#000000"><?=$team[1]?></font>
        <?=str_replace(array("主让","客让"),array("",""),$m[1])?>
        <font style="color:#890209"><?=$team[0]?></font>(主)
        <? }else{ //主让?>
        <font style="color:#000000"><?=$team[0]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?>
        <font style="color:#890209"><?=$team[1]?></font>
        <? }?>
        <?
		$m[1]="";
		}else{ ?>
        <font style="color:#000000"><?=$team[0]?></font> <? if(isset($score)) { ?> <?=$score?>
        <? }else{?> <? if($team[1]!=""){ ?>VS.<?} }?><font style="color:#890209"><?=$team[1]?></font>
        <? } ?>
        <br />
		<font style="color:#000000">
		<?
      //  if($m_count==3) print_r($m);
        //半全场替换显示
		$arraynew=array($team[0],$team[1],"和局"," / ","局");
        $arrayold=array("主","客","和","/","局局");
		?>
        <?php
		if($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融"){
			$ss	=	explode("@",$rows["bet_info"]);
			echo $ss[0]." @ <font color=\"red\">".$ss[1]."</font>";
		}else{
			$ss = str_replace($arrayold,$arraynew,preg_replace('[\((.*)\)]', '',$m[$m_count-1]));
			$ss = explode("@",$ss);
			if($ss[0]=="独赢") echo $m[1]."&nbsp;";
			elseif(strpos($ss[0],"独赢")) echo $m[1]."-";
			echo str_replace(" ",'',$ss[0]);
			if($rows['match_nowscore']=="");
			else if(strtolower($rows["match_showtype"])=="h" || (!strrpos($tz_type,"球"))) echo "(".$rows['match_nowscore'].")";
			else echo "(".strrev($rows['match_nowscore']).")";
			echo " @ <font color=\"red\">".$ss[1]."</font>";
		}
		?>
        </font>
		<? 
		if(($rows["status"]!=8)&&($rows["status"]!=3)&&($rows["status"]!=7)&&($rows["status"]!=6))
		if((strtolower($rows["match_showtype"])=="c")&&(strpos('&match_ao,match_ho,match_bho,match_bao&',$rows["point_column"])>0)){
		?>
		[<?=$rows["TG_Inball"]?>:<?=$rows["MB_Inball"]?>]	
		<?php  }elseif($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融"){	
			include_once("../include/mysqlis.php");
					$sql	=	"select x_result from t_guanjun where match_id=".$rows["match_id"];
					$oquery		=	$mysqlis->query($sql);
					if($rs	=	$oquery->fetch_array()){
						$rs['x_result']=str_replace("<br>","&nbsp;",$rs['x_result']);
						echo '['.$rs['x_result'].']';
					}
			  }else{	?>
		[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
		<? }?>	
		<? if($rows["lose_ok"]==0 && $rows["ball_sort"] == "足球滚球"){ ?>
		[确认中]
		<? }else if($rows["status"]==0 && $rows["ball_sort"] == "足球滚球"){?>
		[已确认]
      	<? } ?>
      
      </td>
	  <td><?= @double_format($rows["bet_money"]);?></td>
	  <td><?php
	  	$jine = 0; 
		switch ($rows["status"]){
			case "1":
				$jine=$rows["win"]+$rows["fs"];
				echo '<span style="color:#FF0000;">+</span><span style="color:#FF0000;">'.double_format($jine).'</span>';
				break;
			case "2":
				$jine=$rows["win"]+$rows["fs"];
				echo '<span style="color:#FF0000;">+</span><span style="color:#000000;">'.double_format($jine).'</span>';
				break;
			case "4":
				$jine=$rows["win"]+$rows["fs"];
				echo '<span style="color:#000000;">-</span><span style="color:#FF0000;">'.double_format($jine).'</span>';
				break;
			case "5":
				$jine=$rows["win"]+$rows["fs"];
				echo '<span style="color:#000000;">-</span><span style="color:#000000;">'.double_format($jine).'</span>';
				break;
			case "3":
			case "6":
			case "7":
			case "8":
				$jine=$rows["win"];
				echo '<span style="color:#0000FF;">'.double_format($jine).'</span>';
				break;
		}
	  	@$win+=$jine;
?></td>
      </tr>
<?
	unset($score);
	}
}
?>
    </table>
	<!---->
	<div class="sekuai_03"><div class="fanye"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div>
	本页总投注金额：<span style="color:#FFFFFF"><?=double_format(@$bet_money)?></span> RMB，本页已赢金额：<span style="color:#FFFFFF"><?=double_format(@$win)?></span> RMB，本页盈亏：<span style="color:#FFFFFF"><?=double_format($win-$bet_money)?></span> RMB
  </div>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>