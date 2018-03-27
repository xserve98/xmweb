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

//根据期数读取未结算的单
for($i=0;$i<count($rows);$i++){

	$kuisun +=$rows[$i]['summoney'];	
	//开始结算特码
	if($rows[$i]['mingxi_1']=='特码'){
		$dx		= Six_DaXiao($rs['ball_7']);
		$ds		= Six_DanShuang($rs['ball_7']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_7']);
		$hsds	= Six_HeShuDanShuang($rs['ball_7']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_7']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_7']);
		$bs		= Six_Bose($rs['ball_7']);
		$sx		= Get_ShengXiao($rs['ball_7']);	
		if($rs['ball_7']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
				$yingli += $rows[$i]['money'];
			}else if($rows[$i]['mingxi_2']==$rs['ball_7']|| $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			$yingli += $rows[$i]['sumwin'];
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_7'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
		$yingli += $rows[$i]['sumwin'];
		
		}
	}
	//开始结算正一
	if($rows[$i]['mingxi_1']=='正一'){
		$dx		= Six_DaXiao($rs['ball_1']);
		$ds		= Six_DanShuang($rs['ball_1']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_1']);
		$hsds	= Six_HeShuDanShuang($rs['ball_1']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_1']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_1']);
		$bs		= Six_Bose($rs['ball_1']);
		$sx		= Get_ShengXiao($rs['ball_1']);	
		if($rs['ball_1']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
				$yingli += $rows[$i]['money'];
				
			}else if($rows[$i]['mingxi_2']==$rs['ball_1']){
			$yingli += $rows[$i]['sumwin'];
			
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_1'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正二
	if($rows[$i]['mingxi_1']=='正二'){
		$dx		= Six_DaXiao($rs['ball_2']);
		$ds		= Six_DanShuang($rs['ball_2']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_2']);
		$hsds	= Six_HeShuDanShuang($rs['ball_2']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_2']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_2']);
		$bs		= Six_Bose($rs['ball_2']);
		$sx		= Get_ShengXiao($rs['ball_2']);	
		if($rs['ball_2']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
				$yingli += $rows[$i]['money'];
				
			}else if($rows[$i]['mingxi_2']==$rs['ball_2']){
				$yingli += $rows[$i]['sumwin'];
			
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_2'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正三
	if($rows[$i]['mingxi_1']=='正三'){
		$dx		= Six_DaXiao($rs['ball_3']);
		$ds		= Six_DanShuang($rs['ball_3']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_3']);
		$hsds	= Six_HeShuDanShuang($rs['ball_3']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_3']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_3']);
		$bs		= Six_Bose($rs['ball_3']);
		$sx		= Get_ShengXiao($rs['ball_3']);	
		if($rs['ball_3']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
			$yingli += $rows[$i]['money'];
			}else if($rows[$i]['mingxi_2']==$rs['ball_3']){
			$yingli += $rows[$i]['sumwin'];
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_3'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
	     $yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正四
	if($rows[$i]['mingxi_1']=='正四'){
		$dx		= Six_DaXiao($rs['ball_4']);
		$ds		= Six_DanShuang($rs['ball_4']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_4']);
		$hsds	= Six_HeShuDanShuang($rs['ball_4']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_4']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_4']);
		$bs		= Six_Bose($rs['ball_4']);
		$sx		= Get_ShengXiao($rs['ball_4']);	
		if($rs['ball_4']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
			$yingli += $rows[$i]['money'];
				
			}else if($rows[$i]['mingxi_2']==$rs['ball_4']){
				$yingli += $rows[$i]['sumwin'];
			
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_4'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正五
	if($rows[$i]['mingxi_1']=='正五'){
		$dx		= Six_DaXiao($rs['ball_5']);
		$ds		= Six_DanShuang($rs['ball_5']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_5']);
		$hsds	= Six_HeShuDanShuang($rs['ball_5']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_5']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_5']);
		$bs		= Six_Bose($rs['ball_5']);
		$sx		= Get_ShengXiao($rs['ball_5']);	
		if($rs['ball_5']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
			$yingli += $rows[$i]['money'];
				
			}else if($rows[$i]['mingxi_2']==$rs['ball_5']){
				$yingli += $rows[$i]['sumwin'];
			
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_5'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正六
	if($rows[$i]['mingxi_1']=='正六'){
		$dx		= Six_DaXiao($rs['ball_6']);
		$ds		= Six_DanShuang($rs['ball_6']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_6']);
		$hsds	= Six_HeShuDanShuang($rs['ball_6']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_6']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_6']);
		$bs		= Six_Bose($rs['ball_6']);
		$sx		= Get_ShengXiao($rs['ball_6']);	
		if($rs['ball_6']==49){
			if($rows[$i]['mingxi_2']=='大' || $rows[$i]['mingxi_2']=='小' || $rows[$i]['mingxi_2']=='单' || $rows[$i]['mingxi_2']=='双' || $rows[$i]['mingxi_2']=='尾大' || $rows[$i]['mingxi_2']=='尾小' || $rows[$i]['mingxi_2']=='尾单' || $rows[$i]['mingxi_2']=='尾双' || $rows[$i]['mingxi_2']=='合大' || $rows[$i]['mingxi_2']=='合小' || $rows[$i]['mingxi_2']=='合单' || $rows[$i]['mingxi_2']=='合双'){
				$yingli += $rows[$i]['money'];
				
			}else if($rows[$i]['mingxi_2']==$rs['ball_6']){
				$yingli += $rows[$i]['sumwin'];
			}
		}else if($rows[$i]['mingxi_2']==$rs['ball_6'] || $rows[$i]['mingxi_2']==$dx || $rows[$i]['mingxi_2']==$ds || $rows[$i]['mingxi_2']==$hsdx || $rows[$i]['mingxi_2']==$hsds || $rows[$i]['mingxi_2']==$wsdx || $rows[$i]['mingxi_2']==$wsds || $rows[$i]['mingxi_2']==$bs || $rows[$i]['mingxi_2']==$sx){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正码
	if($rows[$i]['mingxi_1']=='正码'){
		$sx1		= Get_ShengXiao($rs['ball_1']);	
		$sx2		= Get_ShengXiao($rs['ball_2']);	
		$sx3		= Get_ShengXiao($rs['ball_3']);	
		$sx4		= Get_ShengXiao($rs['ball_4']);	
		$sx5		= Get_ShengXiao($rs['ball_5']);	
		$sx6		= Get_ShengXiao($rs['ball_6']);	
		if($rows[$i]['mingxi_2']==$rs['ball_1'] || $rows[$i]['mingxi_2']==$rs['ball_2'] || $rows[$i]['mingxi_2']==$rs['ball_3'] || $rows[$i]['mingxi_2']==$rs['ball_4'] || $rows[$i]['mingxi_2']==$rs['ball_5'] || $rows[$i]['mingxi_2']==$rs['ball_6'] || $rows[$i]['mingxi_2']==$sx1 || $rows[$i]['mingxi_2']==$sx2 || $rows[$i]['mingxi_2']==$sx3 || $rows[$i]['mingxi_2']==$sx4 || $rows[$i]['mingxi_2']==$sx5 || $rows[$i]['mingxi_2']==$sx6){
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算正码过关
	if($rows[$i]['mingxi_1']=='正码过关'){
		$mignxi_2_arr=explode("<hr />",$rows[$i]['mingxi_2']);
		$arr_num=count($mignxi_2_arr)-1;
		$win=0;
		for($i=0;$i<$arr_num;$i++){
			$mingxi2_arr=explode("|",$mignxi_2_arr[$i]);
			if(!Six_ZhengMaGuoGuang($rs['ball_'.Six_ZhengMaToNum($mingxi2_arr[0])],$mingxi2_arr[1])){$win=0;break;}
			else{$win=1;}
		}
		if($win){
			$msql="update c_bet set js=1 where id='".$rows[$i]['id']."'";
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算总和
	if($rows[$i]['mingxi_1']=='总和'){
		$zhdx = Six_ZongHeDaXiao($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		$zhds = Six_ZongHeDanShuang($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		if($rows[$i]['mingxi_2']==$zhdx || $rows[$i]['mingxi_2']==$zhds){
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算一肖
	if($rows[$i]['mingxi_1']=='一肖'){
		if($rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_1']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_2']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_3']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_4']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_5']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_6']) || $rows[$i]['mingxi_2']==Get_ShengXiao($rs['ball_7'])){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算尾数
	if($rows[$i]['mingxi_1']=='尾数'){
		if($rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_1']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_2']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_3']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_4']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_5']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_6']) || $rows[$i]['mingxi_2']==Six_WeiShu($rs['ball_7'])){
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算全中
	if($rows[$i]['mingxi_1']=='四全中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=4){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='三全中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=3){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='三中二'){
		$zall=100;
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win==2){			
			$yingli += $rows[$i]['sumwin'];
		}elseif($win>2){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='二全中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=2){			
		$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='二中特'){
		$zall=51;
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=$win2=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
			if(intval($val)==intval($rs['ball_7'])){$win2++;}
		}
		if($win>=2){
			$yingli += $rows[$i]['sumwin'];					
		}elseif($win1>=1){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='特串'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_7'])){$win++;}
		}
		if($win>=2){			
		$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='合肖'){
		if($rs['ball_7']==49){
			$yingli += $rows[$i]['sumwin'];
		}else{
			$sx		= Get_ShengXiao($rs['ball_7']);	
			if(strpos($rows[$i]['mingxi_2'],$sx)!==false){
				$yingli += $rows[$i]['sumwin'];
			}else{
			$yingli += $rows[$i]['sumwin'];
			}
		}
	}
	//开始结算生肖连
	if($rows[$i]['mingxi_1']=='二肖连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='三肖连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		//echo "<p>======</p>";
		if($win>=3){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='四肖连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='五肖连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
		$yingli += $rows[$i]['sumwin'];
		}
	}
	//开始结算尾数连
	if($rows[$i]['mingxi_1']=='二尾连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='三尾连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=3){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='四尾连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='五尾连中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
			$yingli += $rows[$i]['sumwin'];
		}
	}
	if($rows[$i]['mingxi_1']=='五不中' || $rows[$i]['mingxi_1']=='六不中' || $rows[$i]['mingxi_1']=='七不中' || $rows[$i]['mingxi_1']=='八不中' || $rows[$i]['mingxi_1']=='九不中' || $rows[$i]['mingxi_1']=='十不中' || $rows[$i]['mingxi_1']=='十一不中' || $rows[$i]['mingxi_1']=='十二不中'){
		$mingxi2_arr=explode(",",$rows[$i]['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;break;}
			if(intval($val)==intval($rs['ball_2'])){$win++;break;}
			if(intval($val)==intval($rs['ball_3'])){$win++;break;}
			if(intval($val)==intval($rs['ball_4'])){$win++;break;}
			if(intval($val)==intval($rs['ball_5'])){$win++;break;}
			if(intval($val)==intval($rs['ball_6'])){$win++;break;}
			if(intval($val)==intval($rs['ball_7'])){$win++;break;}
		}
		if($win==0){
			$yingli += $rows[$i]['sumwin'];
		}
	}
	
}
 $yk=array($yingli,$kuisun);
return $yk;
}
?>

