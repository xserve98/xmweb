<?php
//六合彩总和函数
function Six_ZongHe($num){
	return $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6];
}
//六合彩总和单双函数
function Six_ZongHeDanShuang($num){
	$num = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6];
	if($num%2==0){
		return '双';
	}else{
		return '单';
	}
}
//六合彩总和大小函数
function Six_ZongHeDaXiao($num){
	$num = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6];
	if($num>=175){
		return '大';
	}else{
		return '小';
	}
}
//广东快乐十分开奖函数
function G10_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=85 && $zh<=132){
			return '大';
		}
		if($zh>=36 && $zh<=83){
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
		$zhws = substr($zh,strlen($zh)-1);
		if($zhws>=5){
			return '尾大';
		}else{
			return '尾小';
		}
	}
	if($type==5){
		if($num[0]>$num[7]){
			return '龙';
		}else{
			return '虎';
		}
	}
}
//重庆时时彩开奖函数
function Ssc_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=23){
			return '大';
		}
		if($zh<=23){
			return '小';
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
		if($num[0]>$num[4]){
			return '龙';
		}
		if($num[0]<$num[4]){
			return '虎';
		}
		if($num[0]==$num[4]){
			return '和';
		}
	}
	if($type==5){
		$a = $num[0].$num[1].$num[2];
		$hm 		= array();
		$hm[]		= $num[0];
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		sort($hm);
		$match = '/.09|0.9/';
		if($num[0]==$num[1] && $num[0]==$num[2] && $num[1]==$num[2]){
			return '豹子';
		}else if($num[0]==$num[1] || $num[0]==$num[2] || $num[1]==$num[2]){
			return '对子';
		}else if($a == '019' || $a == '091'|| $a == '098'|| $a == '089'|| $a == '109' || $a == '190' || $a == '901'|| $a == '910'|| $a == '809' || $a == '890' || sorts($hm, 3)){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	if($type==6){
		$a = $num[1].$num[2].$num[3];
		$hm 		= array();
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		sort($hm);
		$match = '/.09|0.9/';
		if($num[1]==$num[2] && $num[1]==$num[3] && $num[2]==$num[3]){
			return '豹子';
		}else if($num[1]==$num[2] || $num[1]==$num[3] || $num[2]==$num[3]){
			return '对子';
		}else if($a == '019' || $a == '091'|| $a == '098'|| $a == '089'|| $a == '109' || $a == '190' || $a == '901'|| $a == '910'|| $a == '809' || $a == '890' || sorts($hm, 3)){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	if($type==7){
		$a = $num[2].$num[3].$num[4];
		$hm 		= array();
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		$hm[]		= $num[4];
		sort($hm);
		$match = '/.09|0.9/';
		if($num[2]==$num[3] && $num[2]==$num[4] && $num[3]==$num[4]){
			return '豹子';
		}else if($num[2]==$num[3] || $num[2]==$num[4] || $num[3]==$num[4]){
			return '对子';
		}else if($a == '019' || $a == '091'|| $a == '098'|| $a == '089'|| $a == '109' || $a == '190' || $a == '901'|| $a == '910'|| $a == '809' || $a == '890' || sorts($hm, 3)){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
}
//重庆时时彩顺子，半顺判断函数
function sorts($a, $p)
{
	$i = 0; $tmp=0; 
	foreach ($a as $k=>$v)
	{
	    if($v == @$a[$k-1]+1 || $v == @$a[$k+1]-1)
	    {
	        $tmp = $v;
	        if (isset($date[$i]) && end($date[$i])+1 == $tmp) 
	        {
	            $date[$i][] = $tmp;
	        } else {
	            $date[++$i][] = $tmp;
	        }
	    }
	}
	if (count(@$date[1]) == $p || count(@$date[2]) == $p)
		$a = true;
	else 
		$a = false;
	return $a;
}
//北京PK拾开奖函数
function Pk10_Auto($num , $type){
	$zh = $num[0]+$num[1];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>11){
			return '大';
		}else{
			return '小';
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
		if($num[0]>$num[9]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==5){
		if($num[1]>$num[2]){
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
?>