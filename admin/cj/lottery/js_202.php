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
$hm[]		= $rs['ball_5'];
//根据期数读取未结算的单
for($i=0;$i<count($rows);$i++){
	$kuisun +=$rows[$i]['summoney'];
		
	//开始结算第一球
	if($rows[$i]['mingxi_1']=='第一球'){
		$ds = Ssc_Ds($rs['ball_1']);
		$dx = Ssc_Dx($rs['ball_1']);
		if($rows[$i]['mingxi_2']==$rs['ball_1'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			$yingli += $rows[$i]['sumwin'];
		
		}
	}
	
	
	//开始结算第二球
	if($rows[$i]['mingxi_1']=='第二球'){
		$ds = Ssc_Ds($rs['ball_2']);
		$dx = Ssc_Dx($rs['ball_2']);
		if($rows[$i]['mingxi_2']==$rs['ball_2'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算第三球
	if($rows[$i]['mingxi_1']=='第三球'){
		$ds = Ssc_Ds($rs['ball_3']);
		$dx = Ssc_Dx($rs['ball_3']);
		if($rows[$i]['mingxi_2']==$rs['ball_3'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			$yingli += $rows[$i]['sumwin'];
	
		}
	}
	//开始结算第四球
	if($rows[$i]['mingxi_1']=='第四球'){
		$ds = Ssc_Ds($rs['ball_4']);
		$dx = Ssc_Dx($rs['ball_4']);
		if($rows[$i]['mingxi_2']==$rs['ball_4'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算第五球
	if($rows[$i]['mingxi_1']=='第五球'){
		$ds = Ssc_Ds($rs['ball_5']);
		$dx = Ssc_Dx($rs['ball_5']);
	if($rows[$i]['mingxi_2']==$rs['ball_5'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算总和大小
	if($rows[$i]['mingxi_2']=='总和大' || $rows[$i]['mingxi_2']=='总和小'){
		$zonghe = Ssc_Auto($hm,2);
		if($rows[$i]['mingxi_2']==$zonghe){
			$yingli += $rows[$i]['sumwin'];
		}
		
	}
	//开始结算总和单双
	if($rows[$i]['mingxi_2']=='总和单' || $rows[$i]['mingxi_2']=='总和双'){
		$zonghe = Ssc_Auto($hm,3);
		if($rows[$i]['mingxi_2']==$zonghe){
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算龙虎和
	if($rows[$i]['mingxi_2']=='龙' || $rows[$i]['mingxi_2']=='虎' || $rows[$i]['mingxi_2']=='和'){
		$longhu = Ssc_Auto($hm,4);
		if($rows[$i]['mingxi_2']==$longhu){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算前三
	if($rows[$i]['mingxi_1']=='前三'){
		if($rows[$i]['mingxi_2']=='豹子' || $rows[$i]['mingxi_2']=='顺子' || $rows[$i]['mingxi_2']=='对子' || $rows[$i]['mingxi_2']=='半顺' || $rows[$i]['mingxi_2']=='杂六'){
			$qiansan = Ssc_Auto($hm,5);
		}elseif($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小'){
			$qiansan = Ssc_Auto($hm,51);
		}else{
			$qiansan = Ssc_Auto($hm,52);
		}
		if($rows[$i]['mingxi_2']==$qiansan){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算中三
	if($rows[$i]['mingxi_1']=='中三'){
		if($rows[$i]['mingxi_2']=='豹子' || $rows[$i]['mingxi_2']=='顺子' || $rows[$i]['mingxi_2']=='对子' || $rows[$i]['mingxi_2']=='半顺' ||       $rows[$i]['mingxi_2']=='杂六'){
			$zhongsan = Ssc_Auto($hm,6);
		}elseif($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小'){
			$zhongsan = Ssc_Auto($hm,61);
		}else{
			$zhongsan = Ssc_Auto($hm,62);
		}
		if($rows[$i]['mingxi_2']==$zhongsan){
			
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算后三
	if($rows[$i]['mingxi_1']=='后三'){	
		if($rows[$i]['mingxi_2']=='豹子' || $rows[$i]['mingxi_2']=='顺子' || $rows[$i]['mingxi_2']=='对子' || $rows[$i]['mingxi_2']=='半顺' || $rows[$i]['mingxi_2']=='杂六'){
			$housan = Ssc_Auto($hm,7);
		}elseif($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小'){
			$housan = Ssc_Auto($hm,71);
		}else{
			$housan = Ssc_Auto($hm,72);
		}
		if($rows[$i]['mingxi_2']==$housan){
		$yingli += $rows[$i]['sumwin'];
		}
	}

} 
	
 
   
   $yk=array($yingli,$kuisun);
return $yk;
}

?>