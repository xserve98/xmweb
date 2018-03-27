<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");

include ("../../include/mysqli.php");
$type 		= $_REQUEST['type'];
$qi		= $_REQUEST['qi'];
$suid=$_SESSION["suid"];     
//开始读取赔率
$sql		= "select * from c_odds_0 where type='ball_".$type."' order by id asc";

$query		= $mysqli->query($sql);
$list 		= array();
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<77; $i++){
			$list[$i] = $odds['h'.$i];
		}
}
$arr = array(   
	'oddslist' => $list,    
);

	if($type==1){
		$mingxi='正一';
	}else if($type==2){
		$mingxi='正二';
	}if($type==3){
		$mingxi='正三';
	}if($type==4){
		$mingxi='正四';
	}if($type==5){
		$mingxi='正五';
	}if($type==6){
		$mingxi='正六';
	}if($type==8){
		$mingxi='正码';
	}if($type==9){
		$mingxi='总和';
	}

/////////////
if($type==7){
     $arra=array();
	for($j = 1; $j<50; $j++){
		$arra[$j]=$j;
	}
	$arrb=array("大","小","单","双","合大","合小","合单","合双","尾大","尾小","尾单","尾双","红","蓝","绿","鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and sm ='特码B' and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1,mingxi_2";

	
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_2'];

}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_2'],$arrodds)+1;	
	}
		
}
/////////////
if($type==16){
     $arra=array();
	for($j = 1; $j<50; $j++){
		$arra[$j]=$j;
	}
	$arrb=array("大","小","单","双","合大","合小","合单","合双","尾大","尾小","尾单","尾双","红","蓝","绿","鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and sm ='特码A' and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1,mingxi_2";
	
	
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_2'];

}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_2'],$arrodds)+1;	
	}
		
}



if($type<7||$type==8){
	
	
	  $arra=array();
	for($j = 1; $j<50; $j++){
		$arra[$j]=$j;
	}
	$arrb=array("大","小","单","双","合大","合小","合单","合双","尾大","尾小","尾单","尾双","红","蓝","绿","鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1='$mingxi' and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1,mingxi_2";
	
	
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_2'];

}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_2'],$arrodds)+1;	
	}
	
	
	
}





if($type==9){
	  $arra=array();
	
	$arrb=array("总和大","总和小","总和单","总和双");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1='总和' and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1,mingxi_2";
	
	
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_2'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_2'],$arrodds)+1;	
	}
	
	
	
}
if($type==10){
	$arra=array();
	$arrb=array("鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪","0尾","1尾","2尾","3尾","4尾","5尾","6尾","7尾","8尾","9尾");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('一肖','尾数') and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1,mingxi_2";
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_2'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_2'],$arrodds)+1;	
	}
	
	
	
}

if($type==11){
	$arra=array();
	$arrb=array("四全中","三全中","三中二","三中二中三","二全中","二中特","二中特中特","特串");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('四全中','三全中','三中二','二全中','二中特','特串') and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1";
///echo $sql;
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_1'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_1'],$arrodds)+1;	
	}
	
	
	
}
if($type==12){
	$arra=array();
	$arrb=array("合肖");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1='合肖' and concat(',',parents,',') like '%,".intval($suid).",%'  group by mingxi_1";
///echo $sql;
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_1'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_1'],$arrodds)+1;	
	}
	
	
	
}
if($type==13){
	$arra=array();
	$arrb=array("二肖连中","三肖连中","四肖连中","五肖连中");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('二肖连中','三肖连中','四肖连中','五肖连中') and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1";
///echo $sql;
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_1'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_1'],$arrodds)+1;	
	}
	
	
	
}


if($type==14){
	$arra=array();
	$arrb=array("二尾连中","三尾连中","四尾连中","五尾连中");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('二尾连中','三尾连中','四尾连中','五尾连中') and concat(',',parents,',') like '%,".intval($suid).",%' group by mingxi_1";
///echo $sql;
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_1'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_1'],$arrodds)+1;	
	}
	
	
	
}

if($type==15){
	$arra=array();
	$arrb=array("五不中","六不中","七不中","八不中","九不中","十不中","十一不中","十二不中");
	$arrodds=array_merge($arra, $arrb);
//for($k = 1; $k<77; $k++){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('五不中','六不中','七不中','八不中','九不中','十不中','十一不中','十二不中') and concat(',',parents,',') like '%,".intval($suid).",%'  group by mingxi_1";
///echo $sql;
		$query		= $mysqli->query($sql);
		$listarr 		= array();
        $listarr2 		= array();
	
while ($row = $query->fetch_array()) {
		$listarr[] = $row;
		$listarr2[] = $row['mingxi_1'];
}
	for($h=0;$h<count($listarr);$h++){
		$listarr[$h]['h']=array_search($listarr[$h]['mingxi_1'],$arrodds)+1;	
	}
	
	
	
}
//////////////////////
$arr['tzlist'] = $listarr;  





if($type==16){
	$sql		= "select * from c_odds_0 where type='ball_18'";
	$query		= $mysqli->query($sql);
	$fs = $query->fetch_array();
	$arr['fs']=$fs['h1'];
}
if($type==17){
	$sql		= "select * from c_odds_0 where type='ball_18'";
	$query		= $mysqli->query($sql);
	$fs = $query->fetch_array();
	$arr['fs']=$fs['h2'];
}
$json_string = json_encode($arr);   
echo $json_string; 
?> 