<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../include/config.php");
include_once("../common/function.php");
include_once("../include/function_dled.php");
include_once("../include/function_jiesuan.php");
?>
<?php
$uid		=	$_SESSION["uid"];
$month		=	$thisMonth	=	date('Y-m',time()); //默认为当前月
if(isset($_GET['month'])) $month = $_GET['month'];
$upMonth	=	date('Y-m',strtotime("-1 month")); //上个月

$is_zongdaili = false;
$is_daili = false;
$view_daili = false;
$daili_uid = null;

$sql	=	"select * from k_user where uid=".$uid;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$is_zongdaili		=	($rows['is_zongdaili'] == 1);
	$is_daili =	($rows['is_daili'] == 1);
}

if (!$is_zongdaili && !$is_daili) {
    echo "权限不足";
	exit;
}

$query_string = "";

if($_GET['type'] == "daili") {
    $view_daili = true;
	$query_string = "&type=daili";
}

if($_GET['daili_uid'] != null) {
    $daili_uid = $_GET['daili_uid'];
	$query_string = $query_string . "&daili_uid=" . $daili_uid;
	
	$sql	=	"select uid from k_user where is_daili=1 and uid=".$daili_uid." and zongdaili_uid=".$uid;
    $query	=	$mysqli->query($sql);
	$valid_daili_uid = null;
    while($rows	=	$query->fetch_array()){
	    $valid_daili_uid =	$rows['uid'];
	}
	
	if ($valid_daili_uid == null) {
        echo "权限不足";
	    exit;
    }
	
	$view_daili=false;
}

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
$sql	=	"select uid,username from k_user where ".$condition;
//echo $sql;exit;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	    $users[$rows['uid']]['uid'] =	$rows['uid'];
		$users[$rows['uid']]['username'] =	$rows['username'];
}

//print_r($users);
foreach ($users as $user) {
    $gainsAndLosses = calculateGainsAndLosses($user['uid'], $user['username'], $month, $view_daili);
    $users[$user['uid']]['sy'] = $gainsAndLosses;
	//print_r($users);exit;
	$users['xiaojie']['sy']['ty_y'] += $users[$user['uid']]['sy']['ty_y'];
	$users['xiaojie']['sy']['ty_s'] += $users[$user['uid']]['sy']['ty_s'];
	$users['xiaojie']['sy']['ty_yx'] += $users[$user['uid']]['sy']['ty_yx'];
	$users['xiaojie']['sy']['fc_y'] += $users[$user['uid']]['sy']['fc_y'];
	$users['xiaojie']['sy']['fc_s'] += $users[$user['uid']]['sy']['fc_s'];
	$users['xiaojie']['sy']['lotto'] += $users[$user['uid']]['sy']['lotto'];
	$users['xiaojie']['sy']['sxf'] += $users[$user['uid']]['sy']['sxf'];
	$users['xiaojie']['sy']['cj'] += $users[$user['uid']]['sy']['cj'];
	$users['xiaojie']['sy']['yk'] += $users[$user['uid']]['sy']['yk'];
}

//print_r($users);exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>万丰国际</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<script language="javascript">
if(self==top){
	top.location='/index.php';
}

function url(u){
	window.location.href=u;
}

var query = '<?=$query_string?>';


function goUrl(month){
	window.location.href = 'cha_xiaji_zongdai.php?month='+month+query;
}
</script>
</head>
<body>
<div id="top_lishi" >
  <!--chaxun-->
 <?php if ($is_zongdaili) {?>
 <div style="height:24px; background:#e1f0f7"><div style="text-align:center; line-height:24px;">
 <a href="cha_xiaji_zongdai.php">查看会员</a> | <a href="cha_xiaji_zongdai.php?type=daili">查看代理</a>
 </div>
 </div>
 下级代理注册链接:
<?php
    $link='http://'.$_SERVER["HTTP_HOST"]."/?f=".$uid.htmlspecialchars("&")."t=daili";
	echo "<a target='_blank' href='".$link."'>".$link."</a><br/>";
?>
 <?php } ?>
 下级会员注册链接:
<?php
    $link='http://'.$_SERVER["HTTP_HOST"]."/?f=".$uid;
	echo "<a target='_blank' href='".$link."'>".$link."</a>";
?>
<br/><br/>
<?php
    $user_type = $is_zongdaili?2:1;
	$ty_yk = 0 - ($users['xiaojie']['sy']['ty_y'] - $users['xiaojie']['sy']['ty_s'] - $users['xiaojie']['sy']['sxf'] - $users['xiaojie']['sy']['cj']);
	$ty_bl = get_point($ty_yk, 1, $user_type);
	$ty_yk_daili = $ty_yk * $ty_bl;
	$fc_yk = 0 - ($users['xiaojie']['sy']['fc_y'] - $users['xiaojie']['sy']['fc_s'] + $users['xiaojie']['sy']['lotto'] );
	$fc_bl = get_point($fc_yk, 2, $user_type);
	$fc_yk_daili = $fc_yk * $fc_bl;
	$zong_yk_daili = $ty_yk_daili + $fc_yk_daili ;
?>
 <div style="height:24px; background:#e1f0f7"><div style="float:left; line-height:24px;">
<select name="month" id="month" style="width:80px; z-index:999px;" onchange="goUrl(this.value);">
    <option value="<?=$upMonth?>" <?=$upMonth==$month ? 'selected' : ''?>><?=$upMonth?></option>
    <option value="<?=$thisMonth?>" <?=$thisMonth==$month ? 'selected' : ''?>><?=$thisMonth?></option>
  </select> 下级<?php echo $view_daili?"代理":"会员"?>：<span style="color:#0000FF;"><?=count($users)-1>0?count($users)-1:0?></span> 个，
体育盈亏：<?=double_format($ty_yk) ?>，比例：<?=$ty_bl;?>，彩票盈亏：<?=double_format($fc_yk) ?>，比例：<?=$fc_bl;?>，代理总盈亏：<span style='color:<?=$color?>;'><?=double_format($zong_yk_daili) ?></span>
</div><div style="float:right; line-height:24px;">
  </div>
</div>
  <div class="waikuang00">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
<tr class="sekuai_01">
  <td width="8%" >用户</td>
  <td colspan="3" >体育详情</td>
  <td colspan="2" >福彩详情</td>
  <td width="7%" >乐透</td>
  <td width="7%" >彩金/手续费</td>
  <td width="7%" >代理盈亏</td>
</tr>
<tr class="sekuai_01">
  <td></td>
  <td >盈</td>
  <td >亏</td>
  <td >有效投注金额</td>
  <td >盈</td>
  <td >亏</td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<?php
//print_r($users);

$url = "cha_touzhu_zongdai.php?month=".$month."&uid=";
if($view_daili) {
	if($daili_uid==null) {
	    $url = "cha_xiaji_zongdai.php?month=".$month."&daili_uid=";
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
  <td height="30"><a href="<?=$url.$user['uid']?>"><?=$user['username']?><a></td>
  <td width="7%"><? if($user['sy']['ty_y']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($user['sy']['ty_y'])?></td>
  <td width="7%"><? if($user['sy']['ty_s']>0){?><span style="color:#000000;">-</span><? }?><?=double_format($user['sy']['ty_s'])?></td>
  <td width="7%"><?=double_format($user['sy']['ty_yx'])?></td>

  <td width="7%"><? if($user['sy']['fc_y']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($user['sy']['fc_y'])?></td>
  <td width="7%"><? if($user['sy']['fc_s']>0){?><span style="color:#000000;">-</span><? }?><?=double_format($user['sy']['fc_s'])?></td>

  <td><? if($user['sy']['lotto']>0){?><? }?><?=double_format($user['sy']['lotto'])?><? if($user['sy']['lotto']>0){?><? }?></td>
  <td><?=double_format(($user['sy']['cj'])+$user['sy']['sxf'])?></td>
  <td><span style="color:<? if($user['sy']['yk']>0){echo '#FF0000';}elseif($user['sy']['yk']<0){echo '#000000';}else{echo '#0000FF';}?>;"><?=double_format($user['sy']['yk'])?></span></td>
  </tr>
<?php
}
?>
<tr height="30" align="center" bgcolor="#FFF9CD" style="color:#000000;" >
  <td>小结</td>
  <td><? if($users['xiaojie']['sy']['ty_y']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($users['xiaojie']['sy']['ty_y'])?></td>
  <td><? if($users['xiaojie']['sy']['ty_s']>0){?><span style="color:#000000;">-</span><? }?><?=double_format($users['xiaojie']['sy']['ty_s'])?></td>
  <td><?=double_format($users['xiaojie']['sy']['ty_yx'])?></td>

  <td><? if($users['xiaojie']['sy']['fc_y']>0){?><span style="color:#FF0000;">+</span><? }?><?=double_format($users['xiaojie']['sy']['fc_y'])?></td>
  <td><? if($users['xiaojie']['sy']['fc_s']>0){?><span style="color:#000000;">-</span><? }?><?=double_format($users['xiaojie']['sy']['fc_s'])?></td>

  <td><?=double_format($users['xiaojie']['sy']['lotto'])?></td>
  <td><?=double_format($users['xiaojie']['sy']['cj']+$users['xiaojie']['sy']['sxf'])?></td>
  <td><span style="color:<? if($users['xiaojie']['sy']['yk']>0){echo '#FF0000';}elseif($users['xiaojie']['sy']['yk']<0){echo '#000000';}else{echo '#0000FF';}?>;"><?=double_format($users['xiaojie']['sy']['yk'])?></span></td>
</tr>
</table>
<?php

?>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
</body>
</html>