<?php
include_once("../common/login_check.php");
check_quanxian("jyqk");

$bet_money	=	"";
$jgky		=	"";
$m			=	"";
$win		=	"";
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式注单审核</TITLE>
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
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="84"><strong>编号</strong></td>
        <td width="148"><strong>模式</strong></td>
        <td width="506"><strong>投注详细信息</strong></td>
        <td width="116"><strong>下注</strong></td>
        <td width="116"><strong>可赢</strong></td>
        <td width="133"><strong>投注时间</strong></td>
        <td width="124"><strong>投注账号</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sql	=	"select gid from k_bet_cg_group";
if(@$_GET["date"]) $sql.=" where bet_time like('%".$_GET["date"]."%')";
$sql	.=	" order by gid asc";

$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,5,40);

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
	
	$sql	=	"select g.gid,g.bet_time,g.cg_count,g.bet_money,g.win,g.bet_win,ku.username,g.www,g.fs from k_bet_cg_group g,k_user ku where g.uid=ku.uid and g.gid in($gid)";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$bet_money	+=	$rows["bet_money"];
		$jgky		+=	$rows["bet_win"];
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td  align="center" > <a href="../config/check_zd.php?action=1&id=<?=$rows["gid"]?>"><?=$rows["gid"]?></a></td>
              <td><?=$rows["cg_count"]?>串一<br /><span style="color:#999999"><?=$rows["www"]?></span></td>
              <td><?
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
							if(strpos($myrows["master_guest"],'VS.')) $team=explode('VS.',$myrows["master_guest"]);
							else $team=explode('VS',$myrows["master_guest"]);
						 ?>
                         <? if(count($matches)>0) echo @$myrows['match_time'].$matches[0]."<br/>";?>
						
                         <? if(mb_strpos($m[1],"让")>0) { //让球?>
                         <? if(mb_strpos($m[1],"主")===false) { //客让?>
                <?=$team[1]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <?=$team[0]?>(主)     <? }else{ //主让?>
                 <?=$team[0]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <?=$team[1]?>
                          <? }?>
                         <?
						 $m[1]="";
						  }else{ ?>
            <?=$team[0]?> <? if(isset($score)) { ?> <?=$score?> <? }else{?>VS. <? }?><?=$team[1]?>
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
		  if($stanum){
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
              <td><?=date("m-d H:i:s",strtotime($info["bet_time"]))?></td>
              <td><?=$rows["username"]?></td>
        </tr>
          
               	
<?
	}
}else{
?>
	<tr>
    	<td colspan="9" align="center" style="color:#F00">无串关记录</td>
    </tr>
<?
}
?>
    </table>
    </td>
  </tr>
    <tr>
      <td >
    该页统计:总注金:<?=$bet_money?>，<?="本页已赢金额:".$win;?>
  </td>
    </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table>
</body>
</html>