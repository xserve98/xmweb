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
$lm=3;

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
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="row">
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
						    <tr class="success">
							  <td class="zd_item_header">时间/单号</td>
							  <td class="zd_item_header">投注详细</td>
                              <td class="zd_item_header">结果</td>
							  <td class="zd_item_header">金额</td>
							</tr>
							<?php
							$sql	=	"select * from c_bet where js<>0 and uid=$uid and addtime>='$begin_time' and addtime<='$end_time' order by addtime desc";
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
	while($row = $query->fetch_array()){
		if($i >= $start && $i <= $end){
			$id .=	$row['id'].',';
		}
		if($i > $end) break;
		$i++;
	}
							if(!$id){
							?>	
							<tr align="center" bgcolor="#FFFFFF">
						    <td colspan="4" valign="middle" bgcolor="#FFFFFF"><p class="bg-danger">暂无记录</p></td>
						    </tr>
							<?php
							}else{
		$id		=	rtrim($id,',');
		$sql	=	"select * from c_bet where id in($id) order by id desc";

		$query	=	$mysqli->query($sql);
		$i		=	1;
		while($rows = $query->fetch_array()){
			$money+=$rows["money"];
			$ky+=$rows["win"]+$rows["fs"];
			if(($i%2)==0) $bgcolor="#FFFFFF";
			else $bgcolor="#F5F5F5";
			$i++;
							?>
						    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" style="height:60px;" >
							  <td>
							  <span style="color:#46AF98"><?=$rows["addtime"]?></span><br><span style="color:#0DC4FF"><?=$rows['type']?></span><br>第<span style="color:#F30"><?=$rows["qishu"]?></span>期<br><span style="color:#F90"><?=$rows["id"]?></span>
							  </td>
							  
							  
							  <td valign="middle"><? if($rows['type']=='香港六合彩'){?><?=$rows["mingxi_1"]?><br><font color="#FF0000"><?=$rows["mingxi_2"]?></font> <br> @ <font color="#FF0000"><?=$rows["odds"]?></font><? }else{?><?=$rows["mingxi_1"]?><br>【<font color="#FF0000"><?=$rows["mingxi_2"]?></font>】<? }?></td>
                              <td><?=$rows["win"]>0 ? '<font color="red">全赢</font>' : '<font color="#006600">全输</font>'?></td>
							  <td ><span style="color:#46AF98">下注:</span><br><?=$rows["money"]?><br><span style="color:#0DC4FF">返还:</span><br><?php
	  $jine = 0; 
	  $jine=$rows["win"]>0 ? $rows["win"]+$rows["fs"] : $rows["fs"];
	  @$win+=$jine;
	  if($rows["js"]==0){
	  	echo '<font color="red">等待结算</font>';
	  }else{
		  echo double_format($jine);
	  }
	  
	?></td>
						      </tr>
						    <?
		unset($score);
		}
	}
	?>
						  </table>
						  <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">总投注金额：<span style="color:#FF0000"><?=@$money?></span>，输赢：<span style="color:#FF0000"><?=double_format(@$ky)?></span></a></li></ul>
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