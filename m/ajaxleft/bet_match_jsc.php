<?php
@session_start();
header("Content-type: text/html; charset=utf-8");
include_once("../include/mysqli.php");
include_once("../include/mysqlis.php");
include_once("../include/mysqlio.php");
include_once("../common/function.php");
include_once("../common/logintu.php");
//这里要进行时间判断
$uid = $_SESSION["uid"];
sessionBet($uid);
islogin_match($uid); //未登陆，退出登陆状态

$ball_sort=$_POST['ball_sort'];
if($ball_sort!='重庆时时彩' && $ball_sort!='上海时时乐' && $ball_sort!='福彩3D' && $ball_sort!='体彩排列三'){
$ball_sort='重庆时时彩';
}


if($ball_sort=='重庆时时彩'){
	$number=substr($_POST['issue'],0,8)."-".substr($_POST['issue'],-3);
	$ttable='jsc_rate';	
}elseif($ball_sort=='上海时时乐'){
	$number=substr($_POST['issue'],0,8)."-".substr($_POST['issue'],-2);
	$ttable='jsc_rate_sh';	
}elseif($ball_sort=='体彩排列三'){
	$number=substr($_POST['issue'],0,5);
	$ttable='jsc_rate_pl3';
}else{
	$number=substr($_POST['issue'],0,7);
	$ttable='jsc_rate_3d';		
}

//echo $number;exit;
$sql="select jscauto from sys_admin";
$query=$mysqlio->query($sql);
$jrow=$query->fetch_array();

$sql="select sum(bet_money) as b from k_bet where match_id like '".date("Ymd",time()+(12*3600))."%'";
$query=$mysqli->query($sql);
$drow=$query->fetch_array();



$jscauto=$jrow['jscauto']*intval(($drow['b']/5000));



$sql="select id,class1,class2,(rate-".$jscauto.") as rate from $ttable";
$query=$mysqlis->query($sql);
while($row=$query->fetch_array()){
	$rate[$row['class1']][$row['class2']]=$row['rate'];
}
?>
<div class="match_msg">
  <input type="hidden" name="issue[]" value="<?= $number ?>" />
  <input type="hidden" name="ball_sort[]" value="<?= $_POST['ball_sort'] ?>" />
  <input type="hidden" name="point_column[]" value="<?= $_POST['point_column'] ?>" />
  <input type="hidden" name="numbers[]" value="<?= $_POST['numbers'] ?>" />
  <input type="hidden" name="bet_point[]" value="<?= $_POST['bet_point'] ?>" />
  <input type="hidden" name="touzhuxiang[]" value="<?= $_POST['touzhuxiang'] ?>" />
  <input type="hidden" name="ben_add[]" value="0" />
  <div class="match_sort"><?=$ball_sort ?></div>
  <div class="match_name">第 <?= $_POST['issue'] ?> 期</div>
  <div class="match_info">
    选项：<span class="match_master"><?= $_POST['touzhuxiang'] ?> 「 <?= $_POST['numbers'] ?> 」</span><br>
    水位：<span style="color:#FF0000;"><?= $_POST['bet_point'] ?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;<img src="/images/x.gif" alt="取消赛事" width="8" height="8" border="0" onclick="javascript:del_bet(this,'zq')" style="cursor:pointer;" />
  </div>
</div> 
<script>
$("#max_ds_point_span").html('1000');
$("#max_cg_point_span").html('30000');
$("#submit_from").attr("disabled",false); //按钮有效
window.clearTimeout(time_id);
waite_jsc();
</script>