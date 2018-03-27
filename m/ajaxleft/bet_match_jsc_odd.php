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
//小计可赢
$ky=0;

//小计投注额
$tze=0;
//小计投注赔率
$xj=0;

?>
<div class="match_msg">
  <input type="hidden" name="issue" value="<?=$number ?>" />
  <input type="hidden" name="ball_sort" value="<?=$ball_sort ?>" />
  <table class="waikuang table table-bordered">
    <tr class="sekuai_01">
      <td width="100">选项</td>
      <td width="100">交易</td>
      <td width="50">赔率</td>
      <td width="100">可赢</td>
      <td width="50">操作</td>
    </tr>
     <?
	 foreach ($_REQUEST['jsc_1'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第一球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第一球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第一球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_1" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第一球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第一球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第一球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第一球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第一球'][$key];
		 }
	 }
	 ?>
     <?
	 foreach ($_REQUEST['jsc_1_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第一球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第一球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第一球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_1_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第一球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第一球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第一球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第一球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第一球'][$key];
		 }
	 }
	 ?>
     
     <?
	 foreach ($_REQUEST['jsc_2'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第二球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第二球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第二球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_2" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第二球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第二球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第二球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第二球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第二球'][$key];
		 }
	 }
	 ?>
     <?
	 foreach ($_REQUEST['jsc_2_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第二球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第二球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第二球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_2_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第二球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第二球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第二球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第二球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第二球'][$key];
		 }
	 }
	 ?>   
     
     <?
	 foreach ($_REQUEST['jsc_3'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第三球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第三球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第三球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_3" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第三球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第三球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第三球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第三球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第三球'][$key];
		 }
	 }
	 ?>
     <?
	 foreach ($_REQUEST['jsc_3_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第三球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第三球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第三球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_3_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第三球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第三球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第三球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第三球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第三球'][$key];
		 }
	 }
	 ?>
     
     
     <?
	 foreach ($_REQUEST['jsc_4'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第四球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第四球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第四球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_4" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第四球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第四球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第四球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第四球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第四球'][$key];
		 }
	 }
	 ?>
     <?
	 foreach ($_REQUEST['jsc_4_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第四球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第四球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第四球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_4_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第四球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第四球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第四球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第四球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第四球'][$key];
		 }
	 }
	 ?>
     
     <?
	 foreach ($_REQUEST['jsc_5'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第五球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第五球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第五球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_5" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第五球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第五球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第五球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第五球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第五球'][$key];
		 }
	 }
	 ?>
     <?
	 foreach ($_REQUEST['jsc_5_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">第五球 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['第五球'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['第五球'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_5_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['第五球'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="第五球" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['第五球'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['第五球'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['第五球'][$key];
		 }
	 }
	 ?>   
     
     <?
	 foreach ($_REQUEST['jsc_lm'] as $key => $value) {
		 if($key==0){
			 $key="大";
		 }elseif($key==1){
			 $key="小";
		 }elseif($key==2){
			 $key="单";
		 }else{
			$key="双";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">总和 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['总和'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['总和'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_lm" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['总和'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="总和" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['总和'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['总和'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['总和'][$key];
		 }
	 }
	 ?>     
     
     <?
	 foreach ($_REQUEST['jsc_lh'] as $key => $value) {
		 if($key==0){
			 $key="龙";
		 }else{
			$key="虎";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">龙虎和 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['龙虎和'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['龙虎和'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_lh" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['龙虎和'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="龙虎和" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['龙虎和'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['龙虎和'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['龙虎和'][$key];
		 }
	 }
	 ?>
     
     <?
	 foreach ($_REQUEST['jsc_h'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">龙虎和 「 和 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['龙虎和']['和'] ?></font></td>
        <td><b style="color:red;"><?=$rate['龙虎和']['和']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_h" />
        <input type="hidden" name="numbers[]" value="和" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['龙虎和']['和'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="龙虎和" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['龙虎和']['和']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['龙虎和']['和']*$value;
			$tze+=$value;
			$xj+=$rate['龙虎和']['和'];
		 }
	 }
	 ?>       
                        
     
     <?
	 foreach ($_REQUEST['jsc_bz'] as $key => $value) {
		 if($key==0){
			 if($ball_sort=='重庆时时彩'){
				 $key="前三";
			 }else{
				$key="三连"; 
			 }
		 }elseif($key==1){
			 $key="中三";
		 }else{
			$key="后三";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153"><?= $key ?> 「 豹子 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate[$key]['豹子'] ?></font></td>
        <td><b style="color:red;"><?=$rate[$key]['豹子']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_bz" />
        <input type="hidden" name="numbers[]" value="豹子" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate[$key]['豹子'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="<?= $key ?>" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate[$key]['豹子']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate[$key]['豹子']*$value;
			$tze+=$value;
			$xj+=$rate[$key]['豹子'];
		 }
	 }
	 ?> 
     
     <?
	 foreach ($_REQUEST['jsc_sz'] as $key => $value) {
		 if($key==0){
			 if($ball_sort=='重庆时时彩'){
				 $key="前三";
			 }else{
				$key="三连"; 
			 }
		 }elseif($key==1){
			 $key="中三";
		 }else{
			$key="后三";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153"><?= $key ?> 「 顺子 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate[$key]['顺子'] ?></font></td>
        <td><b style="color:red;"><?=$rate[$key]['顺子']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_sz" />
        <input type="hidden" name="numbers[]" value="顺子" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate[$key]['顺子'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="<?= $key ?>" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate[$key]['顺子']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate[$key]['顺子']*$value;
			$tze+=$value;
			$xj+=$rate[$key]['顺子'];
		 }
	 }
	 ?> 
     
     <?
	 foreach ($_REQUEST['jsc_dz'] as $key => $value) {
		 if($key==0){
			 if($ball_sort=='重庆时时彩'){
				 $key="前三";
			 }else{
				$key="三连"; 
			 }
		 }elseif($key==1){
			 $key="中三";
		 }else{
			$key="后三";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153"><?= $key ?> 「 对子 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate[$key]['对子'] ?></font></td>
        <td><b style="color:red;"><?=$rate[$key]['对子']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_dz" />
        <input type="hidden" name="numbers[]" value="对子" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate[$key]['对子'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="<?= $key ?>" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate[$key]['对子']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate[$key]['对子']*$value;
			$tze+=$value;
			$xj+=$rate[$key]['对子'];
		 }
	 }
	 ?> 
     
     <?
	 foreach ($_REQUEST['jsc_bs'] as $key => $value) {
		 if($key==0){
			 if($ball_sort=='重庆时时彩'){
				 $key="前三";
			 }else{
				$key="三连"; 
			 }
		 }elseif($key==1){
			 $key="中三";
		 }else{
			$key="后三";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153"><?= $key ?> 「 半顺 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate[$key]['半顺'] ?></font></td>
        <td><b style="color:red;"><?=$rate[$key]['半顺']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_bs" />
        <input type="hidden" name="numbers[]" value="半顺" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate[$key]['半顺'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="<?= $key ?>" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate[$key]['半顺']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate[$key]['半顺']*$value;
			$tze+=$value;
			$xj+=$rate[$key]['半顺'];
		 }
	 }
	 ?> 
     
     <?
	 foreach ($_REQUEST['jsc_z6'] as $key => $value) {
		 if($key==0){
			 if($ball_sort=='重庆时时彩'){
				 $key="前三";
			 }else{
				$key="三连"; 
			 }
		 }elseif($key==1){
			 $key="中三";
		 }else{
			$key="后三";		 
		 }
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153"><?= $key ?> 「 杂六 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate[$key]['杂六'] ?></font></td>
        <td><b style="color:red;"><?=$rate[$key]['杂六']*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_z6" />
        <input type="hidden" name="numbers[]" value="杂六" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate[$key]['杂六'] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="<?= $key ?>" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate[$key]['杂六']*$value ?>" /></tr>    
     <?
	 		$ky+=$rate[$key]['杂六']*$value;
			$tze+=$value;
			$xj+=$rate[$key]['杂六'];
		 }
	 }
	 ?>   
     
 	<?
	 foreach ($_REQUEST['jsc_kd'] as $key => $value) {
		 if(intval($value)>0){
	 ?>
	 <tr align="center" bgcolor="#F5F5F5" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'" style="height:25px;">
     	<td><font color="#007153">跨度 「 <?= $key ?> 」</font></td>
        <td><font color="#000000"><?=$value ?></font></td>
        <td><font color="#000000"><?=$rate['跨度'][$key] ?></font></td>
        <td><b style="color:red;"><?=$rate['跨度'][$key]*$value ?><b></td>
        <td><img src="/images/xx.gif" style="cursor:pointer" title="删除此注"></td>
        <input type="hidden" name="point_column[]" value="jsc_kd" />
        <input type="hidden" name="numbers[]" value="<?=$key ?>" />
        <input type="hidden" name="bet_point[]" class="bet_point" value="<?=$rate['跨度'][$key] ?>" />
        <input type="hidden" name="bet_money[]" class="bet_money" value="<?=$value ?>" />
        <input type="hidden" name="touzhuxiang[]" value="跨度" />
        <input type="hidden" name="bet_win[]" class="bet_win" value="<?=$rate['跨度'][$key]*$value ?>" /></tr>    
     <?
	 		$ky+=$rate['跨度'][$key]*$value;
			$tze+=$value;
			$xj+=$rate['跨度'][$key];
		 }
	 }
	 ?>                           
     
     <tr bgcolor="#FFC1C6" align="center" >
      <td height="30" align="right" style="color:#000"><b>小计：</b></td>
      <td><span class="z_bet_money" style="color:#000000"><b><?=$tze ?></b></span> <input type="hidden" id="z_bet_money" name="z_bet_money" value="<?=$tze ?>" /></td>
      <td class="z_bet_point" style="color:#000"><b><?= $xj?></b></td>
      <td><b style="color:red;" class="z_bet_win"><?=$ky ?></b> <input type="hidden" id="z_bet_win" name="z_bet_win" value="<?=$ky ?>" /></td>
      <td></td>
    </tr>
  </table>
</div>