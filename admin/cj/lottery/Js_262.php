<?php
//echo json_encode($hl);
 function get_total_millisecond()  
    {  
             list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
    }  
      

function getyk($arr,$rows){
		global $mysqli;
		global $hl;
		$yingli=0;
$kuisun=0;
$rs=$arr;
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
$hm[]		= $rs['ball_4'];

for($i=0;$i<count($rows);$i++){
	//开始结算冠军
	
			$kuisun +=$rows[$i]['summoney'];
	
	if($rows[$i]['mingxi_1']=='特码'){
		if($rows[$i]['mingxi_2']==$rs['ball_4']){
	    $yingli += $rows[$i]['sumwin'];

		}
	}
	//开始结算第二球
	if($rows[$i]['mingxi_1']=='混合玩法'){
		$win=0;
		if(($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小') && Ssc_Auto($hm,2)==$rows[$i]['mingxi_2']){$win=1;}
		if(($rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双') && Ssc_Auto($hm,3)==$rows[$i]['mingxi_2']){$win=1;}
		if(($rows[$i]['mingxi_2']=='大双' || $rows[$i]['mingxi_2']=='大单' || $rows[$i]['mingxi_2']=='小双' || $rows[$i]['mingxi_2']=='小单') && Ssc_Auto($hm,4)==$rows[$i]['mingxi_2']){$win=1;}
		if(($rows[$i]['mingxi_2']=='极大' || $rows[$i]['mingxi_2']=='极小') && Ssc_Auto($hm,5)==$rows[$i]['mingxi_2']){$win=1;}
		
		if(($rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单') && ($rs['ball_4']==13)){
			$sql2		= "select SUM(money) as num from c_bet where type='极速PC蛋蛋' and mingxi_2='".$rows[$i]['mingxi_2']."' and qishu=".$qi." and uid=".$rows[$i]['uid'];
			$query2		= $mysqli->query($sql2);
			$rs2 = $query2->fetch_array();
			if($rs2['num']>1000) $win=2;
		}			
		if(($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='双') && ($rs['ball_4']==14)){
			$sql2		= "select SUM(money) as num from c_bet where type='极速PC蛋蛋' and mingxi_2='".$rows[$i]['mingxi_2']."' and qishu=".$qi." and uid=".$rows[$i]['uid'];
			$query2		= $mysqli->query($sql2);
			$rs2 = $query2->fetch_array();
			if($rs2['num']>1000) $win=2;
		}
		if(($rows[$i]['mingxi_2']=='大双') && ($rs['ball_4']==14)){
			$win=2;
		}
		if(($rows[$i]['mingxi_2']=='小单') && ($rs['ball_4']==13)){
			$win=2;
		}
		if($win==1){
  $yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算第三球
	if($rows[$i]['mingxi_1']=='波色'){
		if(Ssc_Auto($hm,6)==$rows[$i]['mingxi_2']){
		  $yingli += $rows[$i]['sumwin'];		
		}
	}
	//开始结算第四球
	if($rows[$i]['mingxi_1']=='豹子'){
		if(Ssc_Auto($hm,7)==$rows[$i]['mingxi_2']){
		     $yingli += $rows[$i]['sumwin'];	
			
		}
	}
	//开始结算总和大小
	if($rows[$i]['mingxi_1']=='特码三压一'){
		if(strpos($rows[$i]['mingxi_2'],$rs['ball_4'].",")!==false){
			  $yingli += $rows[$i]['sumwin'];		}
	}
     

}

 $yk=array($yingli,$kuisun);
return $yk;
}

?>