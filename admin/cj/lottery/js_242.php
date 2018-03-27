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
$hm[]		= $rs['ball_6'];
$hm[]		= $rs['ball_7'];
$hm[]		= $rs['ball_8'];
$hm[]		= $rs['ball_9'];
$hm[]		= $rs['ball_10'];
for($i=0;$i<count($rows);$i++){
	//开始结算冠军
	
			$kuisun +=$rows[$i]['summoney'];
	
	if($rows[$i]['mingxi_1']=='冠军'){
		$ds = Bjsc_Ds($rs['ball_1']);
		$dx = Bjsc_Dx($rs['ball_1']);
		if($rows[$i]['mingxi_2']==$rs['ball_1'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){

		    $yingli += $rows[$i]['sumwin'];
			
		}
		
	  
	}
	//开始结算亚军
	if($rows[$i]['mingxi_1']=='亚军'){
		$ds = Bjsc_Ds($rs['ball_2']);
		$dx = Bjsc_Dx($rs['ball_2']);
		
		if($rows[$i]['mingxi_2']==$rs['ball_2'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
		
		    $yingli += $rows[$i]['sumwin'];
			
		
		}
	}


//开始结算第3名
	if($rows[$i]['mingxi_1']=='第三名'){
		$ds = Bjsc_Ds($rs['ball_3']);
		$dx = Bjsc_Dx($rs['ball_3']);
		if($rows[$i]['mingxi_2']==$rs['ball_3'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			   $yingli += $rows[$i]['sumwin'];
			
		}
	}
	
	
//开始结算第3名
	if($rows[$i]['mingxi_1']=='第四名'){
		$ds = Bjsc_Ds($rs['ball_4']);
		$dx = Bjsc_Dx($rs['ball_4']);
		if($rows[$i]['mingxi_2']==$rs['ball_4'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
		   $yingli += $rows[$i]['sumwin'];
			
		}
		}

	
	//开始结算第五名
	if($rows[$i]['mingxi_1']=='第五名'){
		$ds = Bjsc_Ds($rs['ball_5']);
		$dx = Bjsc_Dx($rs['ball_5']);
		if($rows[$i]['mingxi_2']==$rs['ball_5'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			//如果投注内容等于第五名开奖号码，则视为中奖
		   $yingli += $rows[$i]['sumwin'];
			
		}
	}
    //开始结算第六名
	if($rows[$i]['mingxi_1']=='第六名'){
		$ds = Bjsc_Ds($rs['ball_6']);
		$dx = Bjsc_Dx($rs['ball_6']);

		
		if($rows[$i]['mingxi_2']==$rs['ball_6'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			//如果投注内容等于第六名开奖号码，则视为中奖
			   $yingli += $rows[$i]['sumwin'];
			
	
		}
	}
    //开始结算第七名
	if($rows[$i]['mingxi_1']=='第七名'){
		$ds = Bjsc_Ds($rs['ball_7']);
		$dx = Bjsc_Dx($rs['ball_7']);

		
		if($rows[$i]['mingxi_2']==$rs['ball_7'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			//如果投注内容等于第七名开奖号码，则视为中奖
		   $yingli += $rows[$i]['sumwin'];
			
	
		}
	}
    //开始结算第八名
	if($rows[$i]['mingxi_1']=='第八名'){
		$ds = Bjsc_Ds($rs['ball_8']);
		$dx = Bjsc_Dx($rs['ball_8']);

		
		if($rows[$i]['mingxi_2']==$rs['ball_8'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
		   $yingli += $rows[$i]['sumwin'];
			
	
		}
	}
    //开始结算第九名
	if($rows[$i]['mingxi_1']=='第九名'){
		$ds = Bjsc_Ds($rs['ball_9']);
		$dx = Bjsc_Dx($rs['ball_9']);

		
		if($rows[$i]['mingxi_2']==$rs['ball_9'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
		   $yingli += $rows[$i]['sumwin'];
				
		}
	}
    //开始结算第十名
	if($rows[$i]['mingxi_1']=='第十名'){
		$ds = Bjsc_Ds($rs['ball_10']);
		$dx = Bjsc_Dx($rs['ball_10']);

		
		if($rows[$i]['mingxi_2']==$rs['ball_10'] || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$dx){
			//如果投注内容等于第十名开奖号码，则视为中奖
			$yingli += $rows[$i]['sumwin'];
			
		
		}
	}
	
	
	//开始结算冠、亚军和
	if($rows[$i]['mingxi_1']=='冠、亚军和' && $rows[$i]['mingxi_2']>=3 && $rows[$i]['mingxi_2']<=19){
		$zonghe = Bjsc_Auto($hm,1);
		
 
		
		if($rows[$i]['mingxi_2']==$zonghe){
			
		    $yingli += $rows[$i]['sumwin'];
			
		}
	}
	//开始结算冠、亚军和大小
	if($rows[$i]['mingxi_2']=='冠亚大' || $rows[$i]['mingxi_2']=='冠亚小'){
		$zonghe = Bjsc_Auto($hm,2);
	
		
		if($rows[$i]['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
	         $yingli += $rows[$i]['sumwin'];
		
	
		}
	}
	//开始结算冠、亚军和单双
	if($rows[$i]['mingxi_2']=='冠亚双' || $rows[$i]['mingxi_2']=='冠亚单'){
		$zonghe = Bjsc_Auto($hm,3);
		

		
		if($rows[$i]['mingxi_2']==$zonghe){
		    $yingli += $rows[$i]['sumwin'];
		
			
		}
	}
	
	//开始结算1V10 龙虎
	if($rows[$i]['mingxi_1']=='1V10 龙虎'){
		$longhu = Bjsc_Auto($hm,4);
		

		
		if($rows[$i]['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
		   $yingli += $rows[$i]['sumwin'];
			
			
		}
	}
	//开始结算2V9 龙虎
	if($rows[$i]['mingxi_1']=='2V9 龙虎'){
		$longhu = Bjsc_Auto($hm,5);
		

		
		if($rows[$i]['mingxi_2']==$longhu){
            $yingli += $rows[$i]['sumwin'];
			
			
		}
	}
	//开始结算3V8 龙虎
	if($rows[$i]['mingxi_1']=='3V8 龙虎'){
		$longhu = Bjsc_Auto($hm,6);
	
		if($rows[$i]['mingxi_2']==$longhu){
		   $yingli += $rows[$i]['sumwin'];
		
	
		}
	}
	//开始结算4V7 龙虎
	if($rows[$i]['mingxi_1']=='4V7 龙虎'){
		$longhu = Bjsc_Auto($hm,7);

		
		
		if($rows[$i]['mingxi_2']==$longhu){
			 $yingli += $rows[$i]['sumwin'];
			
		}
	}
	//开始结算5V6 龙虎
	if($rows[$i]['mingxi_1']=='5V6 龙虎'){
		$longhu = Bjsc_Auto($hm,8);
if($rows[$i]['mingxi_2']==$longhu){
			 $yingli += $rows[$i]['sumwin'];
			
		}
    
 

}


}
 $yk=array($yingli,$kuisun);
return $yk;

}

?>