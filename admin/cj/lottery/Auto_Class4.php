<?php
header("Content-type: text/html; charset=utf-8");
//北京赛车(PK10)开奖函数
function Bjsc_Auto($num , $type){
	$zh = $num[0]+$num[1];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>11){
			return '冠亚大';
		}else{
			return '冠亚小';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '冠亚双';
		}else{
			return '冠亚单';
		}
	}
	if($type==4){
		if($num[0]>$num[9]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==5){
		if($num[1]>$num[8]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==6){
		if($num[2]>$num[7]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==7){
		if($num[3]>$num[6]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==8){
		if($num[4]>$num[5]){
			return '龙';
		}else{
			return '虎';
		}
	}
}

function getbzhm($ball){
	if(intval($ball)){
		$arr=array(1,2,3,4,5,6,7,8,9,10);
	    $key = array_search(intval($ball), $arr);
			 array_splice($arr, $key, 1);
		return array_rand($arr,1);
		
		}else{
		$arr=array('大','小','单','双');
	    $key = array_search($ball, $arr);
		 array_splice($arr, $key, 1);
		$num =rand(0,(count($arr)-1));	
		return $arr[$num];
			}

		///return $arr;
	}
function getbzhm2($ball){
	
		$arr=array('冠亚大','冠亚小','冠亚单','冠亚双');
	    $key = array_search($ball, $arr);
		 array_splice($arr, $key, 1);
		$num =rand(0,(count($arr)-1));	
		return $arr[$num];
			

		///return $arr;
	}
function getbzhm3($ball){
	if(intval($ball)){
		$arr=array(3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19);
	    $key = array_search(intval($ball), $arr);
			 array_splice($arr, $key, 1);
		//return array_rand($arr,1);
		$num =rand(0,(count($arr)-1));	
		return $arr[$num];	
			}else{
         $arr=array('冠亚大','冠亚小','冠亚单','冠亚双');
	    $key = array_search($ball, $arr);
		 array_splice($arr, $key, 1);
		$num =rand(0,(count($arr)-1));	
		return $arr[$num];
			}

		///return $arr;
	}
	
		function getbzlh($ball){
	if($ball=='龙'){
		return '虎';
		}else{
		return '龙';	
			}
		
		}
	
	
	
	function bizhong($ball){
		if($ball=='大'||$ball=='小'){
			return '大小';
			}
		else if($ball=='单'||$ball=='双'){
			return '单双';
			}
			else{
				
				return '数字';
				}
		
		}
			function bizhong2($ball){
		if($ball=='冠亚大'||$ball=='冠亚小'){
			return '大小';
			}
		else if($ball=='冠亚单'||$ball=='冠亚双'){
			return '单双';
			}
			else{
				
				return '数字';
				}
		
		}
	
 // echo getbzhm3('冠亚大');
 /// echo   json_encode( getbzhm3('5'));

//北京赛车(PK10)单双
function Bjsc_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}

//北京赛车(PK10)大小
function Bjsc_Dx($ball){
	if($ball>=6){
		return '大';
	}else{
		return '小';
	}
}
?>