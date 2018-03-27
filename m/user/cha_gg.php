<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$lm=2;

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()):$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?date("Y-m-d",time()):$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$atype=$_GET["atype"];
$atype=$atype==""?"1":$atype;
$bet_money	=	0;
$ky			=	0;
$win=0;
$i			=	0;
$uid		=	$_SESSION["uid"];
$arr		=	array();
$gid		=	'';

$sql		=	"select g.gid,g.bet_time,g.cg_count,g.bet_money,g.win,g.bet_win from k_bet_cg_group g where g.status<>0 and uid=$uid and bet_time>='$begin_time' and bet_time<='$end_time' order by g.bet_time desc";
$query		=	$mysqli->query($sql);
$sum	=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if(@$_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$perpage	= 	10;
$thisPage	=	$page->check_Page($thisPage,$sum,$perpage);


$id		=	'';
$i		=	1; //记录 uid 数
$start	=	($thisPage-1)*$perpage+1;
$end	=	$thisPage*$perpage;
while($rows = $query->fetch_array()){
	$arr[$rows['gid']]['bet_time']	=	$rows['bet_time'];
	$arr[$rows['gid']]['cg_count']	=	$rows['cg_count'];
	$arr[$rows['gid']]['bet_money']	=	$rows['bet_money'];
	$arr[$rows['gid']]['win']		=	$rows['win'];
	$arr[$rows['gid']]['bet_win']	=	$rows['bet_win'];
	$gid	.=	$rows['gid'].',';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>交易记录串关</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
  <!--chaxun-->
  <div class="container">
  	<div class="panel panel-default">
	  <div class="panel-heading">
			    <h3 class="panel-title">串关历史查询-<?=$cn_begin?><span class="pull-right" ><a href="xm.php">返回报表</a></span></h3>
			  </div>

	  <div class="panel-body">
	    <div role="tabpanel">
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active">
			    	<div class="table-responsive">
		    		  <table class="table table-bordered">
    <tr  class="success">
	  <td width="150" class="zd_item_header">投注时间</td>
	  <td width="366" class="zd_item_header">投注详细信息</td>
	  <td class="zd_item_header">结果</td>
	  <td width="80" class="zd_item_header">下注</td>
	</tr>
    <?php
    if($gid == ''){
	?>	
	<tr>	
		<td height="30" colspan="5" align="center" bgcolor="#FFFFFF" ><p class="bg-danger">暂无记录</p></td>
	</tr>
	<?php
	}else{
		$gid	=	rtrim($gid,',');
		$arr_cg	=	array();
		$sql	=	"select gid,bid,bet_info,match_name,master_guest,date_add(bet_time, interval 25 hour) as bet_time,MB_Inball,TG_Inball,status from k_bet_cg where gid in ($gid) order by bid desc";
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
	  <td><span style="color:#46AF98"><?=date('Y-m-d',strtotime($rows["bet_time"])).'<br>'.date('H:i:s',strtotime($rows["bet_time"]))?></span><br><span style="color:#0DC4FF"><?=$rows["cg_count"]?>串1
	  </span><br><span style="color:#F90">HG_<?=$gid?></span></td>
	  <td>
      <?php
						$x		=	0;
						$nums	=	count($arr_cg[$gid]);
						foreach($arr_cg[$gid] as $k=>$myrows){
							echo "<div style=\"width:99%; padding:10px;\">";
                            $m=explode('-',$myrows["bet_info"]);
						    echo $m[0];
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
						 <span style="color:#628E3B"><b><?=$myrows["match_name"]?></b></span><br />
                         <?php
						    //正则匹配
                         	$m_count=count($m);
							preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
							if(strpos($myrows["master_guest"],'VS.')) $team=explode('VS.',$myrows["master_guest"]);
							else $team=explode('VS',$myrows["master_guest"]);
						 ?>
                         <?php if(count(@$matches)>0) echo @$myrows['bet_time'].@$matches[0]."<br/>";?>
						
                         <?php if(mb_strpos($m[1],"让")>0) { //让球?>
                         <?php if(mb_strpos($m[1],"主")===false) { //客让?>
                <font style="color:#000000"><?=$team[1]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <font style="color:#890209"><?=$team[0]?></font>(主)     <?php }else{ //主让?>
                 <font style="color:#000000"><?=$team[0]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <font style="color:#890209"><?=$team[1]?></font>
                          <?php }?>
                         <?php
						 $m[1]="";
						  }else{ ?>
            <font style="color:#000000"><?=$team[0]?></font> <?php if(isset($score)) { ?> <?=$score?> <?php }else{?>VS.<?php }?><font style="color:#890209"><?=$team[1]?></font>
                         <?php } ?>
                         <br />
						<font style="color:#000000"><?php if($m_count==3){
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
					    </font>
					    <?php if($myrows["status"]==3 || $myrows["MB_Inball"]<0){?>
					    [取消]
					    <?php }else if($myrows["status"]>0){?>
					    [<?=$myrows["MB_Inball"]?>:<?=$myrows["TG_Inball"]?>]
						<?php }
							echo "</div>";
							if($x<$nums-1){
						?>
                        <div style="height:1px; width:99%; background:#ddd;margin:0;overflow:hidden" ></div>
						<?php
							}
						$x++;
						}
						?>
      </td>
      <td> <?php
			$x		=	0;
			$nums	=	count($arr_cg[$gid]);
			foreach($arr_cg[$gid] as $k=>$myrows){
				echo "<div style=\"height:45px;width:99%; padding:10px;\">";
				if($myrows["status"]==0){
					echo '未知';
				  }else{
					 if($myrows["status"]!=3 && $rows["status"]!=6  && $myrows["MB_Inball"]>0) echo $myrows["MB_Inball"].':'.$myrows["TG_Inball"].'<br>';
					  echo getbet_msg($myrows["status"]);
				  }
				echo "</div>";
				if($x<$nums-1){
			?>
			<hr style="height:1px; width:99%; color:#ccc" />
			<?
				}
			$x++;
			}
			?></td>
	  <td><span style="color:#46AF98">下注:</span><br><?=$rows["bet_money"]?><br>
	  <span style="color:#0DC4FF">返还:</span><br>
	 <?php
	  $abc = double_format($rows["win"]>0 ? $rows["win"]+$rows["fs"] : $rows["fs"]);
	  $win+=$abc;
	  echo $abc;
	  ?></td>
    </tr>
<?php
	}
}
?>
    </table>
	<div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">总投注金额：<span style="color:#FF0000"><?=@$bet_money?></span>，输赢：<span style="color:#FF0000"><?=double_format(@$ky)?></span></a></li></ul>
  </div>
			    	</div>
			    </div>
			   </div>

	    </div>
	  </div>
	</div>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>