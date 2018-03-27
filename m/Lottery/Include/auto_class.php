<?php

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
	if($type==51){
		$ball = $num[0]+$num[1]+$num[2];
		if($ball>7){return '大';}
		else{return '小';}	
	}
	if($type==52){
		$ball = $num[0]+$num[1]+$num[2];
		if($ball%2==0){return '双';}
		else{return '单';}
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
	if($type==61){
		$ball = $num[1]+$num[2]+$num[2];
		if($ball>7){return '大';}
		else{return '小';}	
	}
	if($type==62){
		$ball = $num[1]+$num[2]+$num[2];
		if($ball%2==0){return '双';}
		else{return '单';}
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
	if($type==71){
		$ball = $num[2]+$num[3]+$num[4];
		if($ball>7){return '大';}
		else{return '小';}	
	}
	if($type==72){
		$ball = $num[2]+$num[3]+$num[4];
		if($ball%2==0){return '双';}
		else{return '单';}
	}
	if($type==8){
		return dounu($num[0],$num[1],$num[2],$num[3],$num[4]);
	}
	if($type==9){
		return sh(array($num[0],$num[1],$num[2],$num[3],$num[4]));
	}
}

function dounu($n1,$n2,$n3,$n4,$n5){			//斗牛
		if(intval(($n1+$n2+$n3)%10)==0){
			if(intval($n4+$n5)==0 || intval($n4+$n5)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n4+$n5)%10);
			}
		}elseif(intval(($n1+$n2+$n4)%10)==0){
			if(intval($n3+$n5)==0 || intval($n3+$n5)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n3+$n5)%10);
			}
		}elseif(intval(($n1+$n2+$n5)%10)==0){
			if(intval($n3+$n4)==0 || intval($n3+$n4)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n3+$n4)%10);
			}
		}elseif(intval(($n1+$n3+$n4)%10)==0){
			if(intval($n2+$n5)==0 || intval($n2+$n5)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n2+$n5)%10);
			}
		}elseif(intval(($n1+$n3+$n5)%10)==0){
			if(intval($n2+$n4)==0 || intval($n2+$n4)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n2+$n4)%10);
			}
		}elseif(intval(($n1+$n4+$n5)%10)==0){
			if(intval($n2+$n3)==0 || intval($n2+$n3)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n2+$n3)%10);
			}
		}elseif(intval(($n2+$n3+$n4)%10)==0){
			if(intval($n1+$n5)==0 || intval($n1+$n5)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n1+$n5)%10);
			}
		}elseif(intval(($n2+$n3+$n5)%10)==0){
			if(intval($n1+$n4)==0 || intval($n1+$n4)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n1+$n4)%10);
			}
		}elseif(intval(($n2+$n4+$n5)%10)==0){
			if(intval($n1+$n3)==0 || intval($n1+$n3)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n1+$n3)%10);
			}
		}elseif(intval(($n3+$n4+$n5)%10)==0){
			if(intval($n1+$n2)==0 || intval($n1+$n2)==10){
				return "牛牛";	
			}else{
				return "牛".(intval($n1+$n2)%10);
			}
		}else{
			return "没牛";
		}
}

function sh($arnum){
	/*
	$cz=0		五条
$cz=1		四条
$cz=2		三条
$cz=3		葫芦
$cz=4		顺子
$cz=5		两对
$cz=6		一对
$cz=9		散号
	*/
	$cz=9;
//	$arnum=array(1,3,2,5,4);
	$br=array_count_values ($arnum);
	foreach($br as $value) {
		if($value==5){
			$cz=0;
		}elseif($value==4){
			$cz=1;
		}elseif($value==3){
			if($cz==6){
				$cz=3;
			}else{
				$cz=2;
			}
		}elseif($value==2){
			if($cz==6){		//已经有一对了
				$cz=5;
			}elseif($cz==2){	//已经有三条了
				$cz=3;
			}else{
				$cz=6;
			}
		}
	}
	if($cz==9){
		if(in_array(0,$arnum) && in_array(9,$arnum)){
			foreach($arnum as $key=>$v){
				if($v==1 || $v==2 || $v==3 || $v==0){
					$arnum[$key]=$v+10;	
				}
			}
	
		}
		sort($arnum);
		//print_r($arnum);exit;
		if(abs($arnum[0]-$arnum[1])==1 && abs($arnum[1]-$arnum[2])==1 && abs($arnum[2]-$arnum[3])==1 && abs($arnum[3]-$arnum[4])==1){
			$cz=4;
		}

	}
	switch($cz){
		case 0:
			return "五条";
			break;
		case 1:
			return "四条";
			break;
		case 2:
			return "三条";
			break;
		case 3:
			return "葫芦";
			break;
		case 4:
			return "顺子";
			break;
		case 5:
			return "两对";
			break;
		case 6:
			return "一对";
			break;
		case 9:
			return "散号";
			break;	
		default:break;
	}
}

//重庆时时彩顺子，半顺判断函数
/*
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
*/


//江苏快3开奖函数
function Jsk3_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2];
	
	
	//点数
	if($type==1){
		return $zh;
	}
	
	//点数大小
	if($type==2){
		if($zh>=4 && $zh <= 10){
			return '点数小';
		}
		if($zh>=11 && $zh <= 17){
			return '点数大';
		}
		return '';
	}
	
	//点数单双
	if($type==3){
		if($zh%2==0){
			return '点数双';
		}else{
			return '点数单';
		}
	}
	
}

function FC3D_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2];
	if($type==0){
		return $zh;
	}
	
	if($type==1 || $type==2 || $type==3){//第一~三球大小
	
		if($type==1)$qnum = $num[0];
		if($type==2)$qnum = $num[1];
		if($type==3)$qnum = $num[2];
		
		if($qnum>=5){
			return '大';
		}else{
			return '小';
		}		
	}
	
	if($type==4 || $type==5 || $type==6){
		if($type==4)$qnum = $num[0];
		if($type==5)$qnum = $num[1];
		if($type==6)$qnum = $num[2];
		
		if($qnum%2==0){
			return '双';
		}else{
			return '单';
		}
	}
	
	if($type==7){//总和大小
		if($zh>=14){
			return '总和大';
		}else{
			return '总和小';
		}		
	}
	
	if($type==8){//总和双单
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	
	if($type==9){
		if($num[0]>$num[2]){
			return '龙';
		}
		if($num[0]<$num[2]){
			return '虎';
		}
		if($num[0]==$num[2]){
			return '和';
		}
	}
	
	if($type==10){
		$n1=$num[0];
		$n2=$num[1];
		$n3=$num[2];
		if(($n1==0 || $n2==0 || $n3==0) && ($n1==9 || $n2==9 || $n3==9)){
			if($n1==0){
				$n1=10;	
			}
			if($n2==0){
				$n2=10;	
			}
			if($n3==0){
				$n3=10;	
			}
		}
			
		if($n1==$n2 && $n2==$n3){	
			return "豹子";
		}elseif(($n1==$n2) || ($n1==$n3) || ($n2==$n3)){
			return "对子";	
		}elseif(($n1==10 || $n2==10 || $n3==10) && ($n1==9 || $n2==9 || $n3==9) && ($n1==1 || $n2==1 || $n3==1)){
			return "顺子";			
		}elseif( ( (abs($n1-$n2)==1) && (abs($n2-$n3)==1) ) || ((abs($n1-$n2)==2) && (abs($n1-$n3)==1) && (abs($n2-$n3)==1)) ||((abs($n1-$n2)==1) && (abs($n1-$n3)==1)) ){
			return "顺子";	
		}elseif((abs($n1-$n2)==1) || (abs($n1-$n3)==1) || (abs($n2-$n3)==1)){
			return "半顺";	
		}else{
			return "杂六";	
		}
	}
	
	if($type==11){
		return max(abs($num[0]-$num[1]),abs($num[0]-$num[2]),abs($num[1]-$num[2]));
	}
}


function PL3_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2];
	if($type==0){
		return $zh;
	}
	
	if($type==1 || $type==2 || $type==3){//第一~三球大小
	
		if($type==1)$qnum = $num[0];
		if($type==2)$qnum = $num[1];
		if($type==3)$qnum = $num[2];
		
		if($qnum>=5){
			return '大';
		}else{
			return '小';
		}		
	}
	
	if($type==4 || $type==5 || $type==6){
		if($type==4)$qnum = $num[0];
		if($type==5)$qnum = $num[1];
		if($type==6)$qnum = $num[2];
		
		if($qnum%2==0){
			return '双';
		}else{
			return '单';
		}
	}
	
	if($type==7){//总和大小
		if($zh>=14){
			return '总和大';
		}else{
			return '总和小';
		}		
	}
	
	if($type==8){//总和双单
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	
	if($type==9){
		if($num[0]>$num[2]){
			return '龙';
		}
		if($num[0]<$num[2]){
			return '虎';
		}
		if($num[0]==$num[2]){
			return '和';
		}
	}
	
	if($type==10){
		$n1=$num[0];
		$n2=$num[1];
		$n3=$num[2];
		if(($n1==0 || $n2==0 || $n3==0) && ($n1==9 || $n2==9 || $n3==9)){
			if($n1==0){
				$n1=10;	
			}
			if($n2==0){
				$n2=10;	
			}
			if($n3==0){
				$n3=10;	
			}
		}
			
		if($n1==$n2 && $n2==$n3){	
			return "豹子";
		}elseif(($n1==$n2) || ($n1==$n3) || ($n2==$n3)){
			return "对子";	
		}elseif(($n1==10 || $n2==10 || $n3==10) && ($n1==9 || $n2==9 || $n3==9) && ($n1==1 || $n2==1 || $n3==1)){
			return "顺子";			
		}elseif( ( (abs($n1-$n2)==1) && (abs($n2-$n3)==1) ) || ((abs($n1-$n2)==2) && (abs($n1-$n3)==1) && (abs($n2-$n3)==1)) ||((abs($n1-$n2)==1) && (abs($n1-$n3)==1)) ){
			return "顺子";	
		}elseif((abs($n1-$n2)==1) || (abs($n1-$n3)==1) || (abs($n2-$n3)==1)){
			return "半顺";	
		}else{
			return "杂六";	
		}
	}
	
	if($type==11){
		return max(abs($num[0]-$num[1]),abs($num[0]-$num[2]),abs($num[1]-$num[2]));
	}
	
	
}

//北京快乐8
function Kl8_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7]+$num[8]+$num[9]+$num[10]+$num[11]+$num[12]+$num[13]+$num[14]+$num[15]+$num[16]+$num[17]+$num[18]+$num[19];
	if($type==0){
		return $zh;
	}
	
	if($type==1){//总和大小
		if($zh>810){
			return '总和大';
		}elseif($zh<810){
			return '总和小';
		}elseif($zh==810){
			return '总和810';
		}		
	}
	
	if($type==2){//总和双单
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	
	if($type==3){//上中下盘
		$compare =($num[0]>=40?1:-1)+($num[1]>=40?1:-1)+($num[2]>=40?1:-1)+($num[3]>=40?1:-1)+($num[4]>=40?1:-1)+($num[5]>=40?1:-1)+($num[6]>=40?1:-1)+($num[7]>=40?1:-1)+($num[8]>=40?1:-1)+($num[9]>=40?1:-1)+($num[10]>=40?1:-1)+($num[11]>=40?1:-1)+($num[12]>=40?1:-1)+($num[13]>=40?1:-1)+($num[14]>=40?1:-1)+($num[15]>=40?1:-1)+($num[16]>=40?1:-1)+($num[17]>=40?1:-1)+($num[18]>=40?1:-1)+($num[19]>=40?1:-1);
		
		if($compare>0){
			return '上盘';
		}elseif($compare<0){
			return '下盘';
		}elseif($compare==0){
			return '中盘';
		}
	}
	
	if($type==4){//奇偶和盘
		$compare =($num[0]%2==0?1:-1)+($num[1]%2==0?1:-1)+($num[2]%2==0?1:-1)+($num[3]%2==0?1:-1)+($num[4]%2==0?1:-1)+($num[5]%2==0?1:-1)+($num[6]%2==0?1:-1)+($num[7]%2==0?1:-1)+($num[8]%2==0?1:-1)+($num[9]%2==0?1:-1)+($num[10]%2==0?1:-1)+($num[11]%2==0?1:-1)+($num[12]%2==0?1:-1)+($num[13]%2==0?1:-1)+($num[14]%2==0?1:-1)+($num[15]%2==0?1:-1)+($num[16]%2==0?1:-1)+($num[17]%2==0?1:-1)+($num[18]%2==0?1:-1)+($num[19]%2==0?1:-1);
		
		if($compare>0){
			return '偶盘';
		}elseif($compare<0){
			return '奇盘';
		}elseif($compare==0){
			return '和盘';
		}
	}
	

}

function sorts($a, $p)
{
	$i = 0;
	foreach ($a as $k=>$v)
	{
        if(in_array(($v+10-1)%10,$a) || in_array(($v+1)%10,$a))
	    {
	        $i++;
	    }
	}
	if ($i >= $p)
		$a = true;
	else 
		$a = false;
	return $a;
}
?>