<?php
error_reporting(0);
if($username){

$sql	=	"select * from k_user where username='".$username."'";
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$uid =	$rows['uid'];
}

if($uid == null) {
    echo "用户不存在";
	exit;
}

$month		=	$thisMonth	=	date('Y-m',time()); //默认为当前月
if(isset($_GET['month'])) $month = $_GET['month'];
$upMonth	=	date('Y-m',strtotime("$thisMonth -1 month")); //上个月
$is_zongdaili = false;
$is_daili = false;
$view_daili = false;
$daili_uid = null;

$sql	=	"select * from k_user where uid=".$uid;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$is_zongdaili		=	($rows['is_zongdaili'] == 1);
	$daili_mode = $rows['daili_mode'];
	$is_daili =	($rows['is_daili'] == 1);
	$has_yx_fs = $rows['has_yx_fs'];
	$daili_description = ($is_zongdaili?"总代理":"代理").$rows['username'];
	$mode_description = ($rows['daili_mode']==0?"占成模式":"返水模式");
}

if (!$is_zongdaili && !$is_daili) {
    echo "权限不足";
	exit;
}

$query_string = "";

if(isset($_GET['type']) && $_GET['type'] == "daili") {
    $view_daili = true;
	$query_string = "&type=daili";
}

if(isset($_GET['daili_uid']) && $_GET['daili_uid'] != null) {
    $daili_uid = $_GET['daili_uid'];
	$query_string = $query_string . "&daili_uid=" . $daili_uid;
	
	$sql	=	"select * from k_user where is_daili=1 and uid=".$daili_uid." and zongdaili_uid=".$uid;
    $query	=	$mysqli->query($sql);
	$valid_daili_uid = null;
    while($rows	=	$query->fetch_array()){
	    $valid_daili_uid =	$rows['uid'];
		$sub_daili_mode = $rows['daili_mode'];
		$sub_has_yx_fs = $rows['has_yx_fs'];
		$daili_description = "下级代理".$rows['username'];
		$mode_description = ($rows['daili_mode']==0?"占成模式":"返水模式");
	}
	
	if ($valid_daili_uid == null) {
        echo "权限不足";
	    exit;
    }
	
	$view_daili=false;
}

$query_string = $query_string."&username=".$username;

$condition = "";
if($is_zongdaili) {
    if($view_daili){
		$condition = "is_daili=1 and zongdaili_uid=".$uid;
	} else {
		if($daili_uid == null) {
			$condition = "top_uid=".$uid." and is_daili=0 and is_zongdaili=0";
		} else {
			$condition = "top_uid=".$daili_uid." and is_daili=0 and is_zongdaili=0";;
		}
	}
} else {
    $condition = "top_uid=".$uid." and is_daili=0 and is_zongdaili=0";;
}

$users = array();
$sql	=	"select * from k_user where ".$condition;
//echo $sql;exit;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	    $users[$rows['uid']]['uid'] =	$rows['uid'];
		$users[$rows['uid']]['username'] =	$rows['username'];
		$users[$rows['uid']]['daili_mode'] =	$rows['daili_mode'];
		$users[$rows['uid']]['has_yx_fs'] =	$rows['has_yx_fs'];
}

if($is_zongdaili) {
	$zongdaili_ratio = getDailiRatio($uid);
}
if($scenario == 0) {
//print_r($zongdaili_ratio);
}
$daili_zc = false;
//print_r($users);
foreach ($users as $user) {
    $gainsAndLosses = calculateGainsAndLosses($user['uid'], $user['username'], $month, $view_daili);
    $users[$user['uid']]['sy'] = $gainsAndLosses;
	//print_r($users);exit;
	$users[$user['uid']]['sy']['ty_sy'] = $users[$user['uid']]['sy']['ty_s'] - $users[$user['uid']]['sy']['ty_y'];
	
	
	$users['xiaojie']['sy']['ty_yx'] += $users[$user['uid']]['sy']['ty_yx'];
	
	$users[$user['uid']]['sy']['fc_sy'] = $users[$user['uid']]['sy']['fc_s'] - $users[$user['uid']]['sy']['fc_y'];
	$users[$user['uid']]['sy']['lotto'] = 0 - $users[$user['uid']]['sy']['lotto'];
	$users['xiaojie']['sy']['sxf'] += $users[$user['uid']]['sy']['sxf'];
	$users['xiaojie']['sy']['cj'] += $users[$user['uid']]['sy']['cj'];

	if($view_daili) {
		$daili_ratio = getDailiRatio($user['uid']);
		$users[$user['uid']]['sy']['daili_mode'] = ($users[$user['uid']]['daili_mode'] == 0?"占成":"返水");
		
		if($users[$user['uid']]["daili_mode"]==0) {
			$daili_ty_ratio = getLevelRatio($users[$user['uid']]['sy']['ty_sy'], $daili_ratio["zc_dl_ty_ratio"]);
			$users[$user['uid']]['sy']['ty_bl'] = floatval($daili_ty_ratio)."/".floatval($zongdaili_ratio["zc_zd_ty_ratio"]-$daili_ty_ratio);
			$users[$user['uid']]['sy']['fc_bl'] = floatval($daili_ratio["zc_fc_ratio"])."/".floatval($zongdaili_ratio["zc_fc_ratio"]-$daili_ratio["zc_fc_ratio"]);
			$users[$user['uid']]['sy']['lt_bl'] = floatval($daili_ratio["zc_lt_ratio"])."/".floatval($zongdaili_ratio["zc_lt_ratio"]-$daili_ratio["zc_lt_ratio"]);
			if($scenario == 0) {
				//echo $zongdaili_ratio["zc_zd_ty_ratio"].":".$daili_ty_ratio."<br>";
				//echo $zongdaili_ratio["zc_fc_ratio"].":".$daili_ratio["zc_fc_ratio"]."<br>";
				//echo $zongdaili_ratio["zc_lt_ratio"].":".$daili_ratio["zc_lt_ratio"]."<br>";
			}
			$users['xiaojie']['sy']['ty_sy'] += $users[$user['uid']]['sy']['ty_sy'];
			$users['xiaojie']['sy']['fc_sy'] += $users[$user['uid']]['sy']['fc_sy'];
			$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
			
			$users[$user['uid']]['sy']['yk'] = (($users[$user['uid']]['sy']['ty_sy']+$users[$user['uid']]['sy']['sxf']+$users[$user['uid']]['sy']['cj'])*($zongdaili_ratio["zc_zd_ty_ratio"] - $daili_ty_ratio) )+
											($users[$user['uid']]['sy']['fc_sy']*($zongdaili_ratio["zc_fc_ratio"] - $daili_ratio["zc_fc_ratio"]))+
											($users[$user['uid']]['sy']['lotto']*($zongdaili_ratio["zc_lt_ratio"] - $daili_ratio["zc_lt_ratio"]));
		} else {
			$users[$user['uid']]['sy']['ty_bl'] = $users[$user['uid']]['sy']['ty_bl'] = floatval($daili_ratio["cs_ratio"])."/".floatval($zongdaili_ratio["cs_ratio"]-$daili_ratio["cs_ratio"]);
			//$users[$user['uid']]['sy']['fc_bl'] = "-";
			//$users[$user['uid']]['sy']['lt_bl'] = "-";
			$users[$user['uid']]['sy']['fc_bl'] = floatval($daili_ratio["cs_fc_ratio"])."/".floatval($zongdaili_ratio["cs_fc_ratio"]-$daili_ratio["cs_fc_ratio"]);
			$users[$user['uid']]['sy']['lt_bl'] = floatval($daili_ratio["cs_lt_ratio"])."/".floatval($zongdaili_ratio["cs_lt_ratio"]-$daili_ratio["cs_lt_ratio"]);
			
			$users[$user['uid']]['sy']['yk'] = ($users[$user['uid']]['sy']['ty_yx'] * ($zongdaili_ratio["cs_ratio"]-$daili_ratio["cs_ratio"]));//+$users[$user['uid']]['sy']['sxf']+$users[$user['uid']]['sy']['cj'];
			
			$users[$user['uid']]['sy']['ty_sy'] = 0;
			//$users[$user['uid']]['sy']['fc_sy'] = 0;
			//$users[$user['uid']]['sy']['lotto'] = 0;
		}
		$users['xiaojie']['sy']['yk'] += $users[$user['uid']]['sy']['yk'];
	} else {
		if($is_zongdaili && $daili_uid==null) {
			if($daili_mode==0) {
				$users[$user['uid']]['sy']['ty_bl'] = floatval($zongdaili_ratio["zc_zd_ty_ratio"]);
				$users[$user['uid']]['sy']['fc_bl'] = floatval($zongdaili_ratio["zc_fc_ratio"]);
				$users[$user['uid']]['sy']['lt_bl'] = floatval($zongdaili_ratio["zc_lt_ratio"]);
				
				$users['xiaojie']['sy']['ty_sy'] += $users[$user['uid']]['sy']['ty_sy'];
				$users['xiaojie']['sy']['fc_sy'] += $users[$user['uid']]['sy']['fc_sy'];
				$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
				
				$users['xiaojie']['sy']['ty_yx_fs'] += $users[$user['uid']]['sy']['ty_yx']*$zongdaili_ratio["zc_yx_ratio"];
				
				$users[$user['uid']]['sy']['yk'] = (($users[$user['uid']]['sy']['ty_sy']+$users[$user['uid']]['sy']['sxf']+$users[$user['uid']]['sy']['cj'])*$zongdaili_ratio["zc_zd_ty_ratio"] )+
											($users[$user['uid']]['sy']['fc_sy']*($zongdaili_ratio["zc_fc_ratio"]))+
											($users[$user['uid']]['sy']['lotto']*($zongdaili_ratio["zc_lt_ratio"]));
			} else {
				$users[$user['uid']]['sy']['ty_bl'] = $users[$user['uid']]['sy']['ty_bl'] = floatval($zongdaili_ratio["cs_ratio"]);
				$users[$user['uid']]['sy']['fc_bl'] = floatval($zongdaili_ratio["cs_fc_ratio"]);
				$users[$user['uid']]['sy']['lt_bl'] = floatval($zongdaili_ratio["cs_lt_ratio"]);
				$users[$user['uid']]['sy']['yk'] = ($users[$user['uid']]['sy']['ty_yx'] * ($zongdaili_ratio["cs_ratio"]));//+$users[$user['uid']]['sy']['sxf']+$users[$user['uid']]['sy']['cj'];
				$users['xiaojie']['sy']['ty_yx_fs'] += $users[$user['uid']]['sy']['yk'];
				
				$users[$user['uid']]['sy']['ty_sy'] = 0;
				//$users[$user['uid']]['sy']['fc_sy'] = 0;
				//$users[$user['uid']]['sy']['lotto'] = 0;
				$users['xiaojie']['sy']['fc_sy'] += $users[$user['uid']]['sy']['fc_sy'];
				$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
			}
			
			$users['xiaojie']['sy']['yk'] += $users[$user['uid']]['sy']['yk'];
		} else {
			$ratio_uid = $daili_uid==null?$uid:$daili_uid;
			if($daili_ratio ==null) {
				$daili_ratio = getDailiRatio($ratio_uid);
			}
			
			if($daili_ratio["daili_mode"]==0) {
				$users[$user['uid']]['sy']['ty_bl'] = "-";
				$users[$user['uid']]['sy']['fc_bl'] = floatval($daili_ratio["zc_fc_ratio"]);
				$users[$user['uid']]['sy']['lt_bl'] = floatval($daili_ratio["zc_lt_ratio"]);
				$users["xiaojie"]['sy']['fc_bl'] = floatval($daili_ratio["zc_fc_ratio"]);
				$users["xiaojie"]['sy']['lt_bl'] = floatval($daili_ratio["zc_lt_ratio"]);
				
				$users['xiaojie']['sy']['ty_sy'] += $users[$user['uid']]['sy']['ty_sy'];
				$users['xiaojie']['sy']['fc_sy'] += $users[$user['uid']]['sy']['fc_sy'];
				$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
				
				$users['xiaojie']['sy']['ty_yx_fs'] += $users[$user['uid']]['sy']['ty_yx']*$daili_ratio["zc_yx_ratio"];
				
				$users[$user['uid']]['sy']['yk'] = "-";
				$daili_zc = true;
			} else {
				$users[$user['uid']]['sy']['ty_bl'] = floatval($daili_ratio["cs_ratio"]);
				$users[$user['uid']]['sy']['fc_bl'] = "-";
				$users[$user['uid']]['sy']['lt_bl'] = "-";
				
				$users[$user['uid']]['sy']['ty_sy'] = 0;
				//$users[$user['uid']]['sy']['fc_sy'] = 0;
				//$users[$user['uid']]['sy']['lotto'] = 0;
				$users['xiaojie']['sy']['fc_sy'] += $users[$user['uid']]['sy']['fc_sy'];
				$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
				
				$users[$user['uid']]['sy']['yk'] = ($users[$user['uid']]['sy']['ty_yx'] * $daili_ratio["cs_ratio"]);//+$users[$user['uid']]['sy']['sxf']+$users[$user['uid']]['sy']['cj'];
				$users['xiaojie']['sy']['yk'] +=$users[$user['uid']]['sy']['yk'] ;
				$users['xiaojie']['sy']['ty_yx_fs'] = $users['xiaojie']['sy']['yk'];							
			}
		}
	}
}

if($daili_zc) {
	$users['xiaojie']['sy']['ty_bl'] =  getLevelRatio($users['xiaojie']['sy']['ty_sy'], $daili_ratio["zc_dl_ty_ratio"]);
	$users['xiaojie']['sy']['yk'] =(($users['xiaojie']['sy']['ty_sy']+$users['xiaojie']['sy']['sxf']+$users['xiaojie']['sy']['cj'])*$users['xiaojie']['sy']['ty_bl'])+ 
										($users['xiaojie']['sy']['fc_sy']*$users['xiaojie']['sy']['fc_bl'])+
										($users['xiaojie']['sy']['lotto']*$users['xiaojie']['sy']['lt_bl']);
}

if(!$view_daili) {
	$nagative_uid = $daili_uid==null?$uid:$daili_uid;
	
	$daili_has_yx_fs = $daili_uid==null?$has_yx_fs:$sub_has_yx_fs;
	$display_daili_mode = $daili_uid==null?$daili_mode:$sub_daili_mode;
	
	$sql	=	"select sum(amount) as amount from k_daili_nagative_month where uid=".$nagative_uid;
	$query	=	$mysqli->query($sql);
	$rows	=	$query->fetch_array();
	if($rows) {
		$nagative_amount = $rows["amount"];
	}
	
	$sql	=	"select sum(amount) as amount from k_daili_yx_fs where uid=".$nagative_uid." and month='".$month."'";
	$query	=	$mysqli->query($sql);
	$rows	=	$query->fetch_array();
	if($rows) {
		$yx_fs_amount = $rows["amount"];
	}
}

//print_r($users);//exit;

?>
<script language="javascript">
if(self==top){
	//top.location='/index.php';
}

function url(u){
	window.location.href=u;
}

var query = '<?=$query_string?>';


function goUrl(month){
	window.location.href = '?month='+month+query;
}
</script>
<div id="top_lishi" >
  <!--chaxun-->
 <?php if ($is_zongdaili) {?>
 <p class="text-center">
 <a class="btn btn-success" href="?month=<?=$month?>&username=<?=$username?>">线下会员</a> | <a class="btn btn-success" href="?month=<?=$month?>&username=<?=$username?>&type=daili">线下代理</a>
</p>
<?php if ($scenario==1) {?>
线下代理注册链接:
<?php
    $link='http://'.$_SERVER["HTTP_HOST"]."/?f=".$uid.htmlspecialchars("&")."t=daili";
	echo "<a target='_blank' href='".$link."'>".$link."</a><br/>";
?>
<?php } ?>
<?php } ?>
<?php if ($scenario==1) {?>
 线下会员注册链接:
<?php
    $link='http://'.$_SERVER["HTTP_HOST"]."/?f=".$uid;
	echo "<a target='_blank' href='".$link."'>".$link."</a>";
?>
<br/><br/>
<?php } ?>
 
<?php
    $user_type = $is_zongdaili?2:1;
?>
<div class="form-inline">
<select class="form-control" name="month" id="month" onchange="goUrl(this.value);">
    <option value="<?=$upMonth?>" <?=$upMonth==$month ? 'selected' : ''?>><?=$upMonth?></option>
    <option value="<?=$thisMonth?>" <?=$thisMonth==$month ? 'selected' : ''?>><?=$thisMonth?></option>
  </select><?php if(!$view_daili){ ?><?=$daili_description?>,<?=$mode_description?>, <?php }?>共有下级<?php echo $view_daili?"代理":"会员"?>：<span style="color:#0000FF;"><?=count($users)-1>0?count($users)-1:0?></span> 个
  <?php if($nagative_amount!=null){echo ",负额度共".double_format($nagative_amount);} ?>
  <?php if(isset($users['xiaojie']['sy']['ty_yx_fs']) && $users['xiaojie']['sy']['ty_yx_fs']!=null && ($display_daili_mode==1 || $daili_has_yx_fs==1)){?>
  ,有效返水共<?=double_format($users['xiaojie']['sy']['ty_yx_fs'])?>
  <?php if($yx_fs_amount) {echo ",本月已领取".double_format($yx_fs_amount);} ?>
  <?php if($scenario==1 && $daili_uid==null) {echo "<a href='get_yx_fs.php?month=".$month."'>领取</a>";} ?>
  <?php }?>
</div>
<div class="table-responsive">
<table class="table table-bordered">
<tr class="success">
  <th>用户</th>
  <th colspan="3" >体育详情</th>
  <th colspan="2" >福彩详情</th>
  <th colspan="2">乐透</th>
  <th width="7%" >彩金/手续费</th>
  <th width="7%" >代理收益</th>
</tr>
<tr class="success">
  <th></th>
  <th >盈亏</th>
  <th >有效投注金额</th>
  <th >比例</th>
  <th >盈亏</th>
  <th >比例</th>
  <th>盈亏</th>
  <th>比例</th>
 <th></th>
 <th></th>
</tr>
<?php
//print_r($users);

if($scenario==0) {
	$url = "../zdgl/list.php?status=8%2C0%2C1%2C2%2C3%2C4%2C5%2C6%2C7&amp;order=bid&amp;bet_time=&amp;tf_id=&amp;Submit=%E6%90%9C%E7%B4%A2&amp;username=";
} else {
	$url = "cha_touzhu_zongdai.php?month=".$month."&uid=";
}
if($view_daili) {
	if($daili_uid==null) {
	    $url = "?month=".$month."&username=".$username."&daili_uid=";
	}
}


$i=0;
foreach ($users as $user) {
    if($user['uid']==null){continue;}
	if(($i%2)==0) $bgcolor="#FFFFFF";
	else $bgcolor="#F5F5F5";
	$i++;
?>
<tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFF9CD'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" style="color:#000000;" >
  <td height="30"><a href="<?=$url.($view_daili?($user['uid']):($scenario==0?$user['username']:$user['uid']))?>"><?=$user['username']?></a>
  <?php if($users[$user['uid']]['sy']['daili_mode']!=null){?>
  <br>(<?=$users[$user['uid']]['sy']['daili_mode']?><?=$scenario==1?("|<a href='xiaji_daili_mode.php?uid=".$user['uid']."'>修改</a>"):("") ?>)
  <?php }?></td>
  <td width="7%"><? if($user['sy']['ty_sy']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($user['sy']['ty_sy'])?></td>
  <td width="7%"><?=double_format($user['sy']['ty_yx'])?></td>
  <td width="7%"><?=$user['sy']['ty_bl']?></td>

  <td width="7%"><? if($user['sy']['fc_sy']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($user['sy']['fc_sy'])?></td>
  <td width="7%"><?=$user['sy']['fc_bl']?></td>

  <td width="7%"><? if($user['sy']['lotto']>0){?><? }?><?=double_format($user['sy']['lotto'])?><? if($user['sy']['lotto']>0){?><? }?></td>
  <td width="7%"><?=$user['sy']['lt_bl']?></td>
  <td width="7%"><?=double_format(($user['sy']['cj'])+$user['sy']['sxf'])?></td>
  <td><span style="color:<? if($user['sy']['yk']>0){echo '#FF0000';}elseif($user['sy']['yk']<0){echo '#000000';}else{echo '#0000FF';}?>;"><?=double_format($user['sy']['yk'])?></span></td>
  </tr>
<?php
}
?>
<tr height="30" align="center" bgcolor="#FFF9CD" style="color:#000000;" >
  <td>小结</td>
  <td><?php if(isset($users['xiaojie']['sy']['ty_sy']) && $users['xiaojie']['sy']['ty_sy']>0){?><span style="color:#FF0000;">+</span><?php }?><?=double_format($users['xiaojie']['sy']['ty_sy'])?></td>
  <td><?=double_format($users['xiaojie']['sy']['ty_yx'])?></td>
  <td><?=$users['xiaojie']['sy']['ty_bl']?></td>

  <td><?php if($users['xiaojie']['sy']['fc_sy']>0){?><span style="color:#FF0000;">+</span><?php }?><?=double_format($users['xiaojie']['sy']['fc_sy'])?></td>
  <td><?=$users['xiaojie']['sy']['fc_bl']?></td>

  <td><?=double_format($users['xiaojie']['sy']['lotto'])?></td>
  <td><?=$users['xiaojie']['sy']['lt_bl']?></td>
  <td><?=double_format($users['xiaojie']['sy']['cj']+$users['xiaojie']['sy']['sxf'])?></td>
  <td><span style="color:<?php if($users['xiaojie']['sy']['yk']>0){echo '#FF0000';}elseif($users['xiaojie']['sy']['yk']<0){echo '#000000';}else{echo '#0000FF';}?>;"><?=double_format($users['xiaojie']['sy']['yk'])?></span></td>
</tr>
</table>
<?php

?>
  </div>
</div>
<?php
}
?>