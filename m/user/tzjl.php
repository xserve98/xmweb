<?php
session_start();
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../include/config.php");
include_once("../common/function.php");
//ini_set('display_errors','yes');
$bet_money	=	0;
$i			=	0;
$ky			=	0;
$jine		=	0;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>万丰国际</title>
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
<?php
$uid	=	$_SESSION["uid"];
$sql	=	"select *, $beijingTime from k_bet where status=0  and uid=$uid order by bet_time desc";
$query	=	$mysqli->query($sql);
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
//echo $start."---$end";
while($row = $query->fetch_array()){
	if($i >= $start && $i <= $end){
		$id .=	$row['bid'].',';
		
	}
	if($i > $end) break;
	$i++;
}
?>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">未结注单 <span class="pull-right" ><a href="xm.php">历史报表</a></span></h3>
			  </div>
			  <div class="panel-body">
			    <div role="tabpanel">
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs nav-tile" role="tablist">
				    <li class="active"><a href="tzjl.php?ac=ty">体育单式</a></li>
				    <li><a href="tzjl_cg.php">体育串关</a></li>
				    <li <?php if(isset($_GET['ac']) && $_GET['ac']=='ssc'){ ?>class="active"<?php } ?>><a href="tzjl_cp.php">彩票游戏</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active">
				    	<div class="table-responsive">
						  <table class="table table-bordered">
						    <tr class="success">
							  <td class="zd_item_header">时间/单号</td>
							  <td class="zd_item_header">投注详细信息</td>
							  <td class="zd_item_header">金额</td>
							</tr>
							<?php
							if(!$id){
							?>	
							<tr align="center" bgcolor="#FFFFFF">
						    <td colspan="5" valign="middle" bgcolor="#FFFFFF"><p class="bg-danger">暂无记录</p></td>
						    </tr>
							<?php
							}else{
								$id		=	rtrim($id,',');
								$sql	=	"select * from k_bet where bid in($id) order by bid desc";
								//echo $sql;
								$query	=	$mysqli->query($sql);
								$i		=	1;
								while($rows = $query->fetch_array()){
									$bet_money+=$rows["bet_money"];
									$ky+=$rows["bet_win"];
									if(($i%2)==0) $bgcolor="#FFFFFF";
									else $bgcolor="#F5F5F5";
									$i++;
							?>
						    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" style="height:60px;" >
							  <td><span style="color:#46AF98"><?=$rows["bj_time"]?></span><br><span style="color:#0DC4FF"><?=$rows["ball_sort"]?>			
						        <?php
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
						      ?></span><br><span style="color:#F90">HG_<?=$rows["number"]?></span></td>
							  <td>
							  <span style="color:#628E3B"><b><?=$rows["match_name"]?></b></span>

						       <?php
								//正则匹配
						        $m_count=count($m);
								preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
							   	if($rows["ball_sort"]=='重庆时时彩' || $rows["ball_sort"]=='福彩3D' || $rows["ball_sort"]=='体彩排列三' || $rows["ball_sort"]=='上海时时乐' || $rows["ball_sort"]=='广东快乐十分' || $rows["ball_sort"]=='北京PK10'){
									
									echo "第".$rows["match_id"]."期";
								}else{
							   		
								if(strpos($rows["master_guest"],'VS.')) $team=explode('VS.',$rows["master_guest"]);
								else $team=explode('VS',$rows["master_guest"]);
								}
								?>
						        
								<?php if($rows["match_type"]==2){
								echo $rows['match_time'];
								if($rows['match_nowscore']=="" && strpos($rows["ball_sort"],"滚球")==false) echo '(0:0)';
								else if(strtolower($rows["match_showtype"])=="h" && strpos($rows["ball_sort"],"滚球")==false) echo "(".$rows['match_nowscore'].")"; else if(strpos($rows["ball_sort"],"滚球")==false) echo "(".strrev($rows['match_nowscore']).")";}?>
								<br />
						        <?php if(mb_strpos($m[1],"让")>0) { //让球?>
						        <?php if(strtolower($rows["match_showtype"])=="c") { //客让?>
						        <font style="color:#000000"><?=$team[1]?></font>
						        <?=str_replace(array("主让","客让"),array("",""),$m[1])?>
						        <font style="color:#890209"><?=$team[0]?></font>(主)
						        <?php }else{ //主让?>
						        <font style="color:#000000"><?=$team[0]?></font> <?=str_replace(array("主让","客让"),array("",""),$m[1])?>
						        <font style="color:#890209"><?=$team[1]?></font>
						        <?php }?>
						        <?php
								$m[1]="";
								}else{ ?>
						        <font style="color:#000000"><?=$team[0]?></font> <?php if(isset($score)) { ?> <?=$score?>
						        <?php }else{?> <?php if($team[1]!=""){ ?>VS.<?php } }?><font style="color:#890209"><?=$team[1]?></font>
						        <?php } ?>
						        
						        <br />
								<font style="color:#000000">
								<?php
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
								<?php
								if(($rows["status"]!=0)&&($rows["status"]!=3)&&($rows["status"]!=7)&&($rows["status"]!=6))
								if((strtolower($rows["match_showtype"])=="c")&&(strpos('&match_ao,match_ho,match_bho,match_bao&',$rows["point_column"])>0)){
								?>
								[<?=$rows["TG_Inball"]?>:<?=$rows["MB_Inball"]?>]	
								<?php  }elseif($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融"){	
											$sql	=	"select x_result from t_guanjun where match_id=".$rows["match_id"];
											$query	=	$db->query($sql);
											if($rs	=	mysql_fetch_array($query)){
												$rs['x_result']=str_replace("<br>","&nbsp;",$rs['x_result']);
												echo '['.$rs['x_result'].']';
											}
									  }else{	?>
								[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
								<?php }?>	
								<?php if($rows["lose_ok"]==0 && $rows["ball_sort"] == "足球滚球"){ ?>
								[确认中]
								<?php }else if($rows["status"]==0 && $rows["ball_sort"] == "足球滚球"){?>
								[已确认]
						      	<?php } ?>
						      
						      </td>
							  <td ><span style="color:#46AF98">下注:</span><br><?=$rows["bet_money"]?><br><span style="color:#0DC4FF">可赢:</span><br><?php
	  if($rows["status"]==0){
		  if(strtotime($rows["bet_time"])+60<time()) echo $rows["bet_win"];
			else echo '<font color="red">审核中</font>';
	  }else{
		  echo $rows["bet_win"]+$rows["fs"];
	  }
	?></td>
						      </tr>
						    <?php
								unset($score);
								}
							}
							?>
						  </table>
                          <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">总投注金额：<span style="color:#FF0000"><?=@$bet_money?></span>，最高可赢金额：<span style="color:#FF0000"><?=double_format(@$ky)?></span></a></li></ul>
  </div>
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