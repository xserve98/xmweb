<?php

//广东快乐10分开奖函数
function Ssc_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=85){
			return '大';
		}
		if($zh<=83){
			return '小';
		}
		if($zh==84){
			return '和';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '双';
		}else{
			return '单';
		}
	}
    if($type==4){
		if($zh%10>=5){
			return '尾大';
		}else{
			return '尾小';
		}
	}
	if($type==5){
		if($num[0]>$num[7]){
			return '龙';
		}
		if($num[0]<$num[7]){
			return '虎';
		}
	}
}
?>