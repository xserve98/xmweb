<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid     = $_SESSION['uid'];
if($_GET['type']){
	$type=$_GET['type'];
}else{
	
	$type=4;
}

$sql ="select money,pankou from k_user where uid='$uid'";

$query	 =	$mysqli->query($sql);
$user	 =	$query->fetch_array();

?>





<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
</head>
<body class="skin_blue">
<div class="user_info_table">
<table class="table user_info">
<thead><tr><th colspan="2">会员资料</th></tr></thead>
<tbody>
<tr><th>会员账号：</th><td><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?></td></tr>
<tr><th>账户状态：</th><td>启用</td></tr>
<tr><th>账号额度：</th><td><?=$user['money']?>元</td></tr>
<tr><th>账号盘口：</th><td><?=$user['pankou']?>盘</td></tr>

</tbody>
</table>
</div>
<br>
<div class="info_body">
<div class="game_class">
<ul>
<li><span>高频彩</span>
	<a href="info.php?type=4" class="<?= $type==4 ? 'selected' : '' ?>">北京赛车(PK10)</a>
	<a href="info.php?type=24" class="<?= $type==24 ? 'selected' : '' ?>">极速赛车(PK10)</a>
	<a href="info.php?type=2" class="<?= $type==2 ? 'selected' : '' ?>">重庆时时彩</a>
	<a href="info.php?type=8" class="<?= $type==8 ? 'selected' : '' ?>">幸运飞艇</a>
	<a href="info.php?type=17" class="<?= $type==17 ? 'selected' : '' ?>">极速幸运飞艇</a>
	<a href="info.php?type=11" class="<?= $type==11 ? 'selected' : '' ?>">重庆幸运农场</a>
	<a href="info.php?type=20" class="<?= $type==20 ? 'selected' : '' ?>">极速分分彩</a>
	<a href="info.php?type=21" class="<?= $type==21 ? 'selected' : '' ?>">幸运2分彩</a>
	<a href="info.php?type=15" class="<?= $type==15 ? 'selected' : '' ?>">澳洲五分彩</a>
	<a href="info.php?type=14" class="<?= $type==14 ? 'selected' : '' ?>">新疆时时彩</a>
	<a href="info.php?type=7" class="<?= $type==7 ? 'selected' : '' ?>">天津时时彩</a>
	<a href="info.php?type=5" class="<?= $type==5 ? 'selected' : '' ?>">上海时时乐</a>
	<a href="info.php?type=35" class="<?= $type==35 ? 'selected' : '' ?>">广东11选5</a>
	<a href="info.php?type=19" class="<?= $type==19 ? 'selected' : '' ?>">澳洲快乐十分</a>
	<a href="info.php?type=3" class="<?= $type==3 ? 'selected' : '' ?>">广东快乐十分</a>
	<a href="info.php?type=26" class="<?= $type==26 ? 'selected' : '' ?>">PC蛋蛋</a>
	<a href="info.php?type=12" class="<?= $type==12 ? 'selected' : '' ?>">极速PC蛋蛋</a>
	<a href="info.php?type=13" class="<?= $type==13 ? 'selected' : '' ?>">加拿大28</a>
	<a href="info.php?type=23" class="<?= $type==23 ? 'selected' : '' ?>">新加坡28</a>
	<a href="info.php?type=18" class="<?= $type==18 ? 'selected' : '' ?>">新加坡快乐8</a>
	<a href="info.php?type=27" class="<?= $type==27 ? 'selected' : '' ?>">澳洲幸运5</a>
	<a href="info.php?type=28" class="<?= $type==28 ? 'selected' : '' ?>">澳洲幸运8</a>
	<a href="info.php?type=29" class="<?= $type==29 ? 'selected' : '' ?>">澳洲幸运10</a>
	<a href="info.php?type=30" class="<?= $type==30 ? 'selected' : '' ?>">澳洲幸运20</a>
	<a href="info.php?type=25" class="<?= $type==25 ? 'selected' : '' ?>">百人牛牛</a>
	
</li>
</ul><br>
<ul>
<li><span>低频彩</span>
<a href="info.php?type=10" class="<?= $type==10 ? 'selected' : '' ?>">福彩3D</a>
<a href="info.php?type=9" class="<?= $type==9 ? 'selected' : '' ?>">体彩排列三</a>
<a href="info.php?type=1" class="<?= $type==1 ? 'selected' : '' ?>">北京快乐8</a>
</li>
</ul><br>
<ul>
<li><span>六合彩</span>
<a href="info.php?type='0'" class="<?= $type=='0' ? 'selected' : '' ?>">香港六合彩</a>
<a href="info.php?type=22" class="<?= $type==22 ? 'selected' : '' ?>">极速六合彩</a>
</li>
</ul><br>
</div>
<table class="table data_table">
<thead><tr><th>玩法</th><th>单注最低</th><th>单注最高</th></tr></thead>
<tbody>
<?php 
	$sql="SELECT * FROM `k_send_back` where uid ='$uid' and k_type ='$type'";

	 $query	=	$mysqli->query($sql);
      while($rows = $query->fetch_array()){
	?>
<tr><th><?=$rows['k_typename']?></th><td><?=$rows['k_d_limit']?></td><td><?=$rows['k_e_limit']?></td></tr>
<?}?>
</tbody>
</table>
</div>



</body></html>