<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式注单审核</TITLE>
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
-->
</style>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script type="text/javascript">
function check(){
    if(confirm('确定重新结算')){
	    $("#js").css({display:"none"});
		$("#login").css({display:""});
	    return true;
	}else{
	    return false;
	}
}
</script>
</HEAD>
<?php
include_once("../../include/mysqli.php");
$array	=	$_POST["mid"];
$mid	=	"";
for($i=0; $i<count($array); $i++){
	$mid .= $array[$i].",";
}
$mid	=	rtrim($mid,",");

if($_GET["action"]=="re"){
	include_once("../../class/bet.php");
	$mid	=	$_GET['mid'];
	//单式结算开始
    if(count($_GET['bid'])>0){
		foreach($_GET['bid'] as $i=>$bid){
			bet::qx_bet($bid,$_GET['status'][$i]);
		}
	}
	//串关结算开始
	if(count($_GET['bid_cg'])>0){
		foreach($_GET['bid_cg'] as $i=>$bid){
			bet::qx_cgbet($bid);
		}
	}
	//赛事重新结算
	include_once("../../include/mysqlis.php");
	$sql	=	"update bet_match set match_sbjs=0 where match_id in($mid)";
	$mysqlis->query($sql);
	
	message('本次重新结算上半场完成','zqbf.php');
} 
	  
$sql		=	"select k_bet.*,k_user.username from k_bet left join k_user on k_bet.uid=k_user.uid where k_bet.lose_ok=1 and k_bet.status!=0 and match_id in($mid) and (k_bet.point_column in ('match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl') or k_bet.point_column like 'match_hr_bd%' ) order by  k_bet.bid desc"; //单式
$result		=	$mysqli->query($sql);

$sql		=	"select k_bet_cg.*,k_user.username,k_bet_cg_group.win from k_bet_cg left join k_user on k_bet_cg.uid=k_user.uid left join k_bet_cg_group on k_bet_cg_group.gid=k_bet_cg.gid where match_id in($mid) and k_bet_cg.status!=0 and match_id in($mid) and(ball_sort like('%上半场%') or bet_info like('%上半场%')) order by k_bet_cg.bid desc";
$result_cg	=	$mysqli->query($sql); //串关
?>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif">&nbsp; 注单管理：重新结算 -- 上半场 </td>
  </tr>
</table>
<form action="ft_shangbanchang_list_re.php" method="GET" name="form1" onSubmit="return check();">
<input type="hidden" name="action" value="re" />
<input type="hidden" name="mid" value="<?=$mid?>" />
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft">
        <td width="150" height="24"><strong>联赛名</strong></td>
        <td width="160"><strong>编号/主客队</strong></td>
        <td width="282"><strong>投注详细信息</strong></td>
        <td width="50"><strong>下注</strong></td>
        <td width="50"><strong>结果</strong></td>
        <td width="100"><strong>投注/开赛时间</strong></td>
        <td width="100"><strong>投注账号</strong></td>
    </tr>
<?php
$ds_php	=	'list.php';
$cg_php	=	'bet_cg.php';
if(strpos($_SESSION["quanxian"],'sgjzd')){
	$ds_php	=	'sgjds.php';
	$cg_php	=	'sgjcg_zd.php';
}
while($rows = $result->fetch_array()){
	$bet_money	+=	$rows["bet_money"];
	$win		+=	$rows["win"];
      	?>     <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td  align="center" ><a href="../zdgl/<?=$ds_php?>?tf_id=<?=$rows["number"]?>" target="_blank"><?=$rows["number"]?> 
	          </a>
			    <br/>
			    <a href="../zdgl/<?=$ds_php?>?match_id=<?=$rows["match_id"]?>" target="_blank"><?=$rows["match_id"]?> </a>
			    <br/>
		      <?=$rows["match_name"]?> </td>
              <td>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td><?=$rows["ball_sort"]?> - 单式
                <input name="bid[]" type="hidden" id="bid[]" value="<?=$rows["bid"]?>">
				<input name="status[]" type="hidden" id="status[]" value="<?=$rows["status"]?>">
                <br/>
			   <?=$rows["match_time"]?>&nbsp;<font style="color:#FF0033">
			  <?=str_replace("-","<br/>",$rows["bet_info"])?>
			  </font>
			[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]</td>
              <td><?=$rows["bet_money"]?></td>
	          <td><?=$rows["win"]?></td>
              <td><?=substr($rows["bet_time"],5)?><br/><?=substr($rows["match_endtime"],5)?></td>
              <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>" target="_blank"><?=$rows["username"]?></a><br /><span style="color:#999999"><?=$rows["www"]?></span></td>
        </tr>
     <tr>
       <td height="35" colspan="7" align="left" valign="middle" bgcolor="#FFFFFF"><img src="http://<?=$rows["www"]?>/other/<?=substr($rows["number"],0,8)?>/<?=$rows["number"]?>.jpg" /></td>
     </tr>
      	<?
      } 
      ?>
<?php
while($rows = $result_cg->fetch_array()){
	$bet_money	+=	$rows["bet_money"];
	$win		+=	$rows["win"];
      	?>     <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td  align="center" ><a href="../zdgl/<?=$cg_php?>?gid=<?=$rows["gid"]?>" target="_blank"><?=$rows["gid"]?></a>
			   <br/>
		      <?=$rows["match_name"]?> </td>
              <td>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td><?=$rows["ball_sort"]?> - 串关<input name="bid_cg[]" type="hidden" id="bid_cg[]" value="<?=$rows["bid"]?>">
              <br/>
			  <font style="color:#FF0033">
			  <?=str_replace("-","<br/>",$rows["bet_info"])?>
			  </font>
			[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]</td>
              <td><?=$rows["bet_money"]?></td>
	          <td><?=$rows["win"]?></td>
              <td><?=substr($rows["bet_time"],5)?><br/><?=substr($rows["match_endtime"],5)?></td>
              <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>" target="_blank"><?=$rows["username"]?></a></td>
        </tr>
<?php
} 
?>
     <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td colspan="3"  align="right" >结果统计:</td>
              <td><font color="#FF0000"><?=$bet_money?></font></td>
	          <td><font color="#FF0000"><?=$win?></font></td>
              <td colspan="2"></td>
    </tr>
     <tr><td colspan="7" align="center"><div id="js"><input name="re" type="submit" id="re" value="重新结算"/>
     &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="button" onClick="javascript:location.href='<?=$_SERVER['HTTP_REFERER']?>';"  value="返回"/></div>
	   <div id="login" style="color:#FFFFFF; display:none;"><strong>系统重新结算中，请等待...</strong></div></td></tr>
  </table>
</form>
</body>
</html>