<?php
header("Content-type: text/html; charset=utf-8"); 
//重庆时时彩开奖函数

//牛牛点数

function dianshu($ball){
	if($ball==0||$ball==1||$ball==2||$ball==3){
	$dianshu=1;
	}
	if($ball==4||$ball==5||$ball==6||$ball==7){
	$dianshu=2;
	}
	if($ball==8||$ball==9||$ball==10||$ball==11){
	$dianshu=3;
	}
	if($ball==12||$ball==13||$ball==14||$ball==15){
	$dianshu=4;
	}
	if($ball==16||$ball==17||$ball==18||$ball==19){
	$dianshu=5;
	}
	if($ball==20||$ball==21||$ball==22||$ball==23){
	$dianshu=6;
	}
	if($ball==24||$ball==25||$ball==26||$ball==27){
	$dianshu=7;
	}
	if($ball==28||$ball==29||$ball==30||$ball==31){
	$dianshu=8;
	}
	if($ball==32||$ball==33||$ball==34||$ball==35){
	$dianshu=9;
	}
	if($ball==36||$ball==37||$ball==38||$ball==39){
	$dianshu=10;
	}
	if($ball==40||$ball==41||$ball==42||$ball==43){
	$dianshu=11;
	}
	if($ball==44||$ball==45||$ball==46||$ball==47){
	$dianshu=12;
	}
	if($ball==48||$ball==49||$ball==50||$ball==51){
	$dianshu=13;
	}
   return $dianshu; 
	}
 function niuniu1($n1){
	return intval($n1);
	
	}	

 function niuniu2($n1,$n2){
if(intval(($n1+$n2)%10)==0){
	    	return 10;	
		}
		else{
		return intval(($n1+$n2)%10);
			
			}
	
	}	
	

 function niuniu3($n1,$n2,$n3){
	
	 	if(intval(($n1+$n2+$n3)%10)==0){
	    	return 10;	
		}
		
		else if(intval(($n1+$n2)%10)==0){	
			return $n3;	
			}
		else if(intval(($n1+$n3)%10)==0){	
			return $n2;	
			}
		else if(intval(($n2+$n3)%10)==0){	
			return $n1;	
			}	
		else{
		return 0 ;	
			
			}
	
	}	
	

	
 function niuniu4($n1,$n2,$n3,$n4){
	 	if(intval(($n1+$n2+$n3)%10)==0){
	    	return intval($n4);	
			exit;
		}
		
		if(intval(($n1+$n2+$n4)%10)==0){
			
			return intval($n3);	
			exit;
			
		}
		if(intval(($n1+$n3+$n4)%10)==0){
			
			return intval($n2);	
			exit;
			
		}
		if(intval(($n2+$n3+$n4)%10)==0){
			
			return intval($n1);	
			exit;	
		}
		if(intval(($n1+$n2)%10)==0){
			if(intval(($n3+$n4)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n3+$n4)%10);
				exit;
					}
			
			}
		if(intval(($n1+$n3)%10)==0){
			if(intval(($n2+$n4)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n2+$n4)%10);
				exit;
					}
			
			}
				if(intval(($n1+$n4)%10)==0){
			if(intval(($n3+$n2)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n3+$n2)%10);
				exit;
					}
			
			}
		
				if(intval(($n3+$n2)%10)==0){
			if(intval(($n1+$n4)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n1+$n4)%10);
				exit;
					}
			
			}
				if(intval(($n4+$n2)%10)==0){
			if(intval(($n3+$n1)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n3+$n1)%10);
				exit;
					}
			
			}
			
			if(intval(($n3+$n4)%10)==0){
			if(intval(($n1+$n2)%10)==0){
				return 10;	
			    exit;	
				}else{	
				return 	intval(($n1+$n2)%10);
				exit;
					}
			
			}else{
		return 0;	
			
			}
	
	}

function niuniu5($n1,$n2,$n3,$n4,$n5){			//斗牛
		if(intval(($n1+$n2+$n3)%10)==0){
			if(intval($n4+$n5)==0 || intval($n4+$n5)==10){
				return 10;	
			}else{
				return (intval($n4+$n5)%10);
			}
		}
		
		elseif(intval(($n1+$n2+$n4)%10)==0){
			if(intval($n3+$n5)==0 || intval($n3+$n5)==10){
				return 10;	
			}else{
				return (intval($n3+$n5)%10);
			}
		}
		
		elseif(intval(($n1+$n2+$n5)%10)==0){
			if(intval($n3+$n4)==0 || intval($n3+$n4)==10){
				return 10;	
			}else{
				return (intval($n3+$n4)%10);
			}
		}elseif(intval(($n1+$n3+$n4)%10)==0){
			if(intval($n2+$n5)==0 || intval($n2+$n5)==10){
				return 10;	
			}else{
				return (intval($n2+$n5)%10);
			}
		}elseif(intval(($n1+$n3+$n5)%10)==0){
			if(intval($n2+$n4)==0 || intval($n2+$n4)==10){
				return 10;	
			}else{
				return (intval($n2+$n4)%10);
			}
		}elseif(intval(($n1+$n4+$n5)%10)==0){
			if(intval($n2+$n3)==0 || intval($n2+$n3)==10){
				return 10;	
			}else{
				return (intval($n2+$n3)%10);
			}
		}elseif(intval(($n2+$n3+$n4)%10)==0){
			if(intval($n1+$n5)==0 || intval($n1+$n5)==10){
				return 10;	
			}else{
				return (intval($n1+$n5)%10);
			}
		}elseif(intval(($n2+$n3+$n5)%10)==0){
			if(intval($n1+$n4)==0 || intval($n1+$n4)==10){
				return 10;	
			}else{
				return (intval($n1+$n4)%10);
			}
		}elseif(intval(($n2+$n4+$n5)%10)==0){
			if(intval($n1+$n3)==0 || intval($n1+$n3)==10){
				return 10;	
			}else{
				return (intval($n1+$n3)%10);
			}
		}elseif(intval(($n3+$n4+$n5)%10)==0){
			if(intval($n1+$n2)==0 || intval($n1+$n2)==10){
				return 10;	
			}else{
				return (intval($n1+$n2)%10);
			}
		}else{
			return 0;
		}
}
function zhadan($n1,$n2,$n3,$n4,$n5){
	if($n1==$n2&&$n2==$n3&&$n3==$n4){
		return 1;	
		}
    else  if($n5==$n2&&$n2==$n3&&$n3==$n4 )	{
		return 1;	
		
		}	
	 else  if($n5==$n2&&$n2==$n1&&$n1==$n4 )	{
		return 1;	
		
		}	
		 else  if($n5==$n2&&$n2==$n1&&$n1==$n3 )	{
		return 1;	
		
		}	
		else  if($n5==$n4&&$n4==$n1&&$n1==$n3 )	{
		return 1;	
		
		}	
		else{
			return 0;	
		
		}
		
	}
	
 function niu($n1,$n2,$n3,$n4,$n5){
	$arr=array($n1,$n2,$n3,$n4,$n5);
	$arrniu=array(); $k=0;
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]<10){
            $arrniu[$k]=$arr[$i];
			$k++;
			}
		
		}
   return $arrniu;
		}


function FetchRepeatMemberInArray($array) { 
// 获取去掉重复数据的数组 
$unique_arr = array_unique ( $array ); 
// 获取重复数据的数组 
$repeat_arr = array_diff_assoc ( $array, $unique_arr ); 
return $repeat_arr; 
    } 








function niuniu($ball){
	///////五小牛(13)>炸弹（12）>金牛(11)>牛牛(10)>牛九(9)>牛八（8）>有牛>无牛（0）////
    $arr = explode(",",$ball);
	
	$arrniu= niu(dianshu($arr[0]),dianshu($arr[1]),dianshu($arr[2]),dianshu($arr[3]),dianshu($arr[4]));
	
	$sum= dianshu($arr[0])+dianshu($arr[1])+dianshu($arr[2])+dianshu($arr[3])+dianshu($arr[4]);

	////判断五小牛
	if(dianshu($arr[0])<10&&dianshu($arr[1])<10&&dianshu($arr[2])<10&&dianshu($arr[3])<10&&dianshu($arr[4])<10&&$sum<10){
		
			return '13'.'-'.max($arr);
            exit;
		} 
	
	  /////////////////判断炸弹////
	$rearr1 = array(dianshu($arr[0]),dianshu($arr[1]),dianshu($arr[2]),dianshu($arr[3]),dianshu($arr[4]));
    $rearr=FetchRepeatMemberInArray($rearr1);
		 if(zhadan(dianshu($arr[0]),dianshu($arr[1]),dianshu($arr[2]),dianshu($arr[3]),dianshu($arr[4]))==1){  
		  return '12'.'-'.$rearr['1'];  
		   exit;                                                    
		    }
	
			  //////////判断金牛/////////
			 if(dianshu($arr[0])>10&&dianshu($arr[1])>10&&dianshu($arr[2])>10&&dianshu($arr[3])>10&&dianshu($arr[4])>10 ){
		      return '11'.'-'.max($arr);  
			  exit;
		      }
		
		
              if(count($arrniu)==5){
			return niuniu5($arrniu[0],$arrniu[1],$arrniu[2],$arrniu[3],$arrniu[4]).'-'.max($arr); 	
				exit;
				}
			
			if(count($arrniu)==4){
			return niuniu4($arrniu[0],$arrniu[1],$arrniu[2],$arrniu[3]).'-'.max($arr); 	
				exit;
				}
				if(count($arrniu)==3){
					
			return niuniu3($arrniu[0],$arrniu[1],$arrniu[2]).'-'.max($arr); 
				exit;
				}
				if(count($arrniu)==2){
			   return niuniu2($arrniu[0],$arrniu[1]).'-'.max($arr); 
				exit;
				}
				
				if(count($arrniu)==1){
			
			   return niuniu1($arrniu[0]).'-'.max($arr); 
			   
					exit;
				}

	}
	///echo niuniu('19,29,30,36,45');

function peilv($num){
	if($num==13){	
		$peilv=7;
		}
	else if($num==12){
     $peilv=6;
    	}
	else if($num==11){
     $peilv=5;
    	}
	else if($num==10){
     $peilv=4;
    	}
	 else if($num==9){
     $peilv=3;
    	}
	 else if($num==8){
     $peilv=2;
    	}
		else{
			     $peilv=1;
			
			}
	return $peilv;
	}

function getzjpeilv($num){
 global $mysqli;
$sql		= "select * from c_odds_25 where type='ball_3' order by id asc";
$query		= $mysqli->query($sql);
$rows = $query->fetch_array();
	if($num==13){	
		$peilv=$rows['h14'];
		}
	else if($num==12){
    $peilv=$rows['h13'];
    	}
	else if($num==11){
     $peilv=$rows['h12'];
    	}
	else if($num==10){
   $peilv=$rows['h11'];
    	}
	 else if($num==9){
  $peilv=$rows['h10'];
    	}
	 else if($num==8){
    $peilv=$rows['h9'];
    	}
		else{
			 $peilv=$rows['h8'];
			
			}
	return $peilv;

}

function getxjpeilv($num){
 global $mysqli;
$sql		= "select * from c_odds_25 where type='ball_2' order by id asc";
$query		= $mysqli->query($sql);
$rows = $query->fetch_array();
	if($num==13){	
		$peilv=$rows['h14'];
		}
	else if($num==12){
    $peilv=$rows['h13'];
    	}
	else if($num==11){
     $peilv=$rows['h12'];
    	}
	else if($num==10){
   $peilv=$rows['h11'];
    	}
	 else if($num==9){
  $peilv=$rows['h10'];
    	}
	 else if($num==8){
    $peilv=$rows['h9'];
    	}
		else{
			 $peilv=$rows['h8'];
			
			}
	return $peilv;

}



function mingcheng($num){
	if($num==13){
		$mingcheng='五小牛';
		}
		if($num==12){
		$mingcheng='炸弹';
		}
		if($num==11){
		$mingcheng='金牛';
		}
		if($num==10){
		$mingcheng='牛牛';
		}
		if($num==9){
		$mingcheng='牛九';
		}
		if($num==8){
		$mingcheng='牛八';
		}
		if($num==7){
		$mingcheng='牛七';
		}
		if($num==6){
		$mingcheng='牛六';
		}
		if($num==5){
		$mingcheng='牛五';
		}
		if($num==4){
		$mingcheng='牛四';
		}
		if($num==3){
		$mingcheng='牛三';
		}
		if($num==2){
		$mingcheng='牛二';
		}
		if($num==1){
		$mingcheng='牛一';
		}
	    if($num==0){
		$mingcheng='无牛';
		}
	return $mingcheng;
	}






?>