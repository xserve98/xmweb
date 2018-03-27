<?php

//echo json_encode($hl);
 function get_total_millisecond()  
    {  
             list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
    }  
      


function getyk($zarr,$tarr,$darr,$xarr,$harr,$rows){

		$yingli=0;
$kuisun=0;
	
for($i=0;$i<count($rows);$i++){

	if($rows[$i]['mingxi_2']=='天'){
		if(intval($tarr[0])>intval($zarr[0])||intval($tarr[0])==intval($zarr[0])&&intval($tarr[0])<13&&intval($tarr[1])>intval($zarr[1])){
			$money =getzjpeilv(intval($tarr[0]))*$rows[$i]['summoney'];
            $yingli += $money;
			$kuisun +=$rows[$i]['summoney'];
	
		} else{
           $money =getxjpeilv(intval($zarr[0]))*$rows[$i]['summoney'];
		   $kuisun +=$money;
	      }
	}
	////////////////////
	
	
	if($rows[$i]['mingxi_2']=='地'){
	
		if(intval($darr[0])>intval($zarr[0])||intval($darr[0])==intval($zarr[0])&&intval($darr[0])<13&&intval($darr[1])>intval($zarr[1])){
			$money =getzjpeilv(intval($darr[0]))*$rows[$i]['summoney'];
            $yingli += $money;
			$kuisun +=$rows[$i]['summoney'];
	
		} else{
           $money =getxjpeilv(intval($zarr[0]))*$rows[$i]['summoney'];
		   $kuisun +=$money;
	      }
	}
	
	/////////////////////
	
	if($rows[$i]['mingxi_2']=='玄'){
	
		if(intval($xarr[0])>intval($zarr[0])||intval($xarr[0])==intval($zarr[0])&&intval($xarr[0])<13&&intval($xarr[1])>intval($zarr[1])){
			$money =getzjpeilv(intval($xarr[0]))*$rows[$i]['summoney'];
            $yingli += $money;
			$kuisun +=$rows[$i]['summoney'];
	
		} else{
           $money =getxjpeilv(intval($zarr[0]))*$rows[$i]['summoney'];
		   $kuisun +=$money;
	      }
	}
	

	/////////////
	
	if($rows[$i]['mingxi_2']=='黄'){
	
		if(intval($harr[0])>intval($zarr[0])||intval($harr[0])==intval($zarr[0])&&intval($harr[0])<13&&intval($harr[1])>intval($zarr[1])){
			$money =getzjpeilv(intval($harr[0]))*$rows[$i]['summoney'];
            $yingli += $money;
		
	
		} else{
           $money =getxjpeilv(intval($zarr[0]))*$rows[$i]['summoney'];
		   $kuisun +=$money;
	      }
       }
}
/////////////////

       $yk=array($yingli,$kuisun);
return $yk;
}

?>