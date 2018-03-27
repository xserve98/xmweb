<?php
header('Content-Type:text/html; charset=utf-8');

$listarr=array();
for($i=1;$i<17;$i++){
$tp=$i;
	if($tp==1){
		$mingxi='正一';
	}else if($tp==2){
		$mingxi='正二';
	}if($tp==3){
		$mingxi='正三';
	}if($tp==4){
		$mingxi='正四';
	}if($tp==5){
		$mingxi='正五';
	}if($tp==6){
		$mingxi='正六';
	}if($tp==8){
		$mingxi='正码';
	}if($tp==9){
		$mingxi='总和';
	}

/////////////
if($tp==7){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and guest=0  and qishu = '$qi'  and sm ='特码B'";

$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
		$listarr['特码B'] = $row['summony'];
	    $win += $row['sumwin'];
	    $money += $row['summony'];
}	
}
	
if($tp==16){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and guest=0  and qishu = '$qi'  and sm ='特码A'";
$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
		$listarr['特码A'] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}	
}

if($tp<7||$tp==8){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩'   and guest=0  and qishu = '$qi'  and mingxi_1='$mingxi'  and guest=0 ";
		$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
		$listarr[$mingxi] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}
	
}
if($tp==9){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩'   and guest=0  and qishu = '$qi'  and mingxi_1='总和'  ";
		$query		= $mysqli->query($sql);	
while ($row = $query->fetch_array()) {
		$listarr[$mingxi] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}


}
if($tp==10){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩'   and guest=0  and qishu = '$qi'  and mingxi_1 in('一肖','尾数')";
		$query		= $mysqli->query($sql);

while ($row = $query->fetch_array()) {
		$listarr['一肖/尾数'] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}	
}

if($tp==11){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and guest=0   and qishu = '$qi'  and mingxi_1 in('四全中','三全中','三中二','二全中','二中特','特串') ";
///echo $sql;
$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
		$listarr['连码'] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}
	

	
}
if($tp==12){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩'   and guest=0   and qishu = '$qi'  and mingxi_1='合肖'";
///echo $sql;
$query		= $mysqli->query($sql);	
while ($row = $query->fetch_array()) {
		$listarr['合肖'] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}

}
if($tp==13){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩'  and guest=0   and qishu = '$qi'  and mingxi_1 in('二肖连中','三肖连中','四肖连中','五肖连中')";
$query		= $mysqli->query($sql);	
while ($row = $query->fetch_array()) {
		$listarr['连肖'] = $row['summony'];
	    $win += $row['sumwin'];
	 $money += $row['summony'];
}	
	
}

if($tp==14){
	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where    guest=0 and type='香港六合彩' and qishu = '$qi'  and mingxi_1 in('二尾连中','三尾连中','四尾连中','五尾连中') ";
///echo $sql;

		$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
	$listarr['连尾'] = $row['summony'];
    $win += $row['sumwin'];
	 $money += $row['summony'];
}	

}

if($tp==15){

	$sql="select mingxi_1,mingxi_2,ifnull(sum(money),0) as summony,ifnull(sum(if(win>0,win,0 )),0) AS sumwin,ifnull(count(*),0) as count from  c_bet2 where type='香港六合彩' and guest=0    and qishu = '$qi'  and mingxi_1 in('五不中','六不中','七不中','八不中','九不中','十不中','十一不中','十二不中') ";
$query		= $mysqli->query($sql);
while ($row = $query->fetch_array()) {
	$listarr['自选不中'] = $row['summony'];
    $win += $row['sumwin'];
	 $money += $row['summony'];
}	
	
	
}
/////////////////////
}



?> 