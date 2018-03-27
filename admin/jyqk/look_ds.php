<?php
include_once("../common/login_check.php");
check_quanxian("jyqk");
 ?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式注单审核</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
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
        <td width="30"><strong>编号</strong></td>
        <td><strong>联赛名</strong></td>
        <td><strong>编号/主客队</strong></td>
        <td><strong>投注详细信息</strong></td>
        <td><strong>下注</strong></td>
        <td><strong>结果</strong></td>
        <td><strong>可赢</strong></td>
        <td><strong>投注/开赛时间</strong></td>
        <td><strong>投注账号</strong></td>
        </tr>
<?php
      include_once("../../include/mysqli.php");
 
      $sql="select k_bet.*,k_user.username from k_bet left join k_user on k_bet.uid=k_user.uid where k_bet.lose_ok=1 ";
	  if($type) $sql.=" and k_bet.ball_sort like('$type%')";
	  if(isset($_GET["uid"])) $sql.=" and k_bet.uid=".$_GET["uid"];
	  if(isset($_GET["match_id"])) $sql.=" and k_bet.match_id=".$_GET["match_id"];
	  if(isset($_GET["match_name"])) $sql.=" and k_bet.match_name='".urldecode($_GET["match_name"])."'";
	  if(isset($_GET["ball_sort"])) $sql.=" and k_bet.ball_sort='".urldecode($_GET["ball_sort"])."'";
	  if(isset($_GET["point_column"])) $sql.=" and k_bet.point_column='".strtolower($_GET["point_column"])."'";
	  if(isset($_GET["column_like"])) $sql.=" and k_bet.point_column like'%".strtolower($_GET["column_like"])."%'";
	  if(isset($_GET["match_type"])) $sql.=" and k_bet.match_type=".intval($_GET["match_type"]);
	  if(isset($_GET["s_time"])) $sql.=" and k_bet.bet_time>='".$_GET["s_time"]."'";
	  if(isset($_GET["e_time"])) $sql.=" and k_bet.bet_time<='".$_GET["e_time"]."'";
      if(isset($_GET["status"])){
		  if($_GET["status"]==3) $sql.=" and k_bet.status=3";
		  else if($_GET["status"]>0) $sql.=" and k_bet.status>0";
		  else if($_GET["status"]==0) $sql.=" and k_bet.status=0";
	  }
	  if($_GET['tf_id']) $sql.=" and k_bet.number='".$_GET['tf_id']."'";
	 
	  $sql.=" order by  k_bet.bid  desc ";

      $query	=	$mysqli->query($sql);
	  $bet_money=	$win=0;
	  while ($rows = $query->fetch_array()) {
	      $bet_money+=$rows["bet_money"];
	      $win+=$rows["win"];
		  
		  $color = "#FFFFFF";
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
			  if($rows["status"] == 3){
			  	echo '<br/><span style="color:#999999;">'.$rows["sys_about"].'</span>';
			  }
			  ?></td>
              <td>
               <a href="../zdgl/check_zd.php?action=1&id=<?=$rows["number"]?>"><?=$rows["number"]?></a><br/><?=$rows["match_id"]?><br/>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td><font color="<? if ($rows["ball_sort"]=="足球滚球"){echo "#0066FF";}else{echo "#336600";}?>"><b><?=$rows["ball_sort"]?></b></font><br/><?=$rows["match_time"]?>
			 <font style="color:#FF0033">
			  <?php if($rows["point_column"]==="match_jr" || $rows["point_column"]==="match_gj") echo $rows["bet_info"];
			  		else echo str_replace("-","<br>",$rows["bet_info"]);?>
			  </font>
			  <? if($rows["status"]!=0&&$rows["status"]!=3)
			if($rows["MB_Inball"]!=''){?>
			[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
			<? } ?>			 </td>
              <td><?=$rows["bet_money"]?></td>
	          <td><?=$rows["win"]?></td>
              <td><?=$rows["bet_win"]?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?><br/><?=date("m-d H:i:s",strtotime($rows["match_endtime"]))?></td>
              <td><span style="color:#999999;"><?=$rows["assets"]?></span><br /><?=$rows["username"]?><br /><span style="color:#999999;"><?=$rows["balance"]?></span></td>
        </tr>	
      	<?
      }
      ?>
    </table>
    </td>
  </tr>
    <tr>
      <td >
    该页统计:总注金:<?=$bet_money?>，结果:<?=$win?>
  </td>
    </tr>
</table>
</body>
</html>