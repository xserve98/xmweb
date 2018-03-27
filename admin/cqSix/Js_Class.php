<?php
//香港六合彩开奖函数
function Six_Auto($num , $type){
	if($type==1){
		if($num==0){
			return '<span class="blacks">未开奖</span>';
			exit;
		}
		$today = date("Y-m-d",time());
		$lunar = new Lunar();
		$nl = date("Y",$lunar->S2L($today));
		return '<span class="'.Six_Bose($num,2).'" title="'.Six_DanShuang($num).' / '.Six_DaXiao($num).' / '.Six_WeiShuDanShuang($num).' / '.Six_WeiShuDaXiao($num).' / '.Six_HeShuDanShuang($num).' / '.Six_HeShuDaXiao($num).' / '.Get_ShengXiao($nl,$num%12).'">'.BuLing($num).'</span>';
	}
	if($type==2){
		$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6];
		if($zh==0){
			return '<span class="blacks">未开奖</span>';
			exit;
		}
		return '<span class="blacks">'.$zh.' / '.Six_ZongHeDanShuang($zh).' / '.Six_ZongHeDaXiao($zh).'</span>';
	}
}
//六合彩波色函数
function Six_BoSe($num , $type){
	if($type==1){
		if($num==1 || $num==2 || $num==7 || $num==8 || $num==12 || $num==13 || $num==18 || $num==19 || $num==23 || $num==24 || $num==29 || $num==30 || $num==34 || $num==35 || $num==40 || $num==45 || $num==46){
			return '红';
		}
		if($num==3 || $num==4 || $num==9 || $num==10 || $num==14 || $num==15 || $num==20 || $num==25 || $num==26 || $num==31 || $num==36 || $num==37 || $num==41 || $num==42 || $num==47 || $num==48){
			return '蓝';
		}
		if($num==5 || $num==6 || $num==11 || $num==16 || $num==17 || $num==21 || $num==22 || $num==27 || $num==28 || $num==32 || $num==33 || $num==38 || $num==39 || $num==43 || $num==44 || $num==49){
			return '绿';
		}
	}
	if($type==2){
		if($num==1 || $num==2 || $num==7 || $num==8 || $num==12 || $num==13 || $num==18 || $num==19 || $num==23 || $num==24 || $num==29 || $num==30 || $num==34 || $num==35 || $num==40 || $num==45 || $num==46){
			return 'reds';
		}
		if($num==3 || $num==4 || $num==9 || $num==10 || $num==14 || $num==15 || $num==20 || $num==25 || $num==26 || $num==31 || $num==36 || $num==37 || $num==41 || $num==42 || $num==47 || $num==48){
			return 'blues';
		}
		if($num==5 || $num==6 || $num==11 || $num==16 || $num==17 || $num==21 || $num==22 || $num==27 || $num==28 || $num==32 || $num==33 || $num==38 || $num==39 || $num==43 || $num==44 || $num==49){
			return 'greens';
		}
	}
}
//六合彩单双函数
function Six_DanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	if($num%2==0){
		return '双';
	}else{
		return '单';
	}
}
//六合彩大小函数
function Six_DaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	if($num>24){
		return '大';
	}else{
		return '小';
	}
}
//六合彩尾数大小函数
function Six_WeiShuDaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	$zhws = substr($num,strlen($num)-1);
	if($zhws>=5){
		return '尾大';
	}else{
		return '尾小';
	}
}
//六合彩尾数大小函数
function Six_WeiShuDanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	$zhws = substr($num,strlen($num)-1);
	if($num%2==0){
		return '尾双';
	}else{
		return '尾单';
	}
}
//六合彩合数大小函数
function Six_HeShuDaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	$num1=substr($num,0,1);
	$num2=substr($num,1,1);
	$num3=$num1+$num2;
	if($num3>6){
		return '合大';
	}else{
		return '合小';
	}
}
//六合彩合数单双函数
function Six_HeShuDanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	$num1=substr($num,0,1);
	$num2=substr($num,1,1);
	$num3=$num1+$num2;
	if($num3%2==0){
		return '合双';
	}else{
		return '合单';
	}
}
//六合彩总和单双函数
function Six_ZongHeDanShuang($num){
	if($num%2==0){
		return '双';
	}else{
		return '单';
	}
}
//六合彩总和大小函数
function Six_ZongHeDaXiao($num){
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
		echo $zh;
	}
	if($type==2){
		if($zh>=85 && $zh<=132){
			return '总和大';
		}
		if($zh>=36 && $zh<=83){
			return '总和小';
		}
		if($zh==84){
			return '和';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	if($type==4){
		$zhws = substr($zh,strlen($zh)-1);
		if($zhws>=5){
			return '总和尾大';
		}else{
			return '总和尾小';
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
//广东快乐十分单双
function G10_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广东快乐十分大小
function G10_Dx($ball){
	if($ball>10){
		return '大';
	}else{
		return '小';
	}
}
//广东快乐十分尾数大小
function G10_WsDx($ball){
	$wsdx = substr($ball, -1);
	if($wsdx>4){
		return '尾大';
	}else{
		return '尾小';
	}
}
//广东快乐十分合数单双
function G10_HsDs($ball){
	$ball = BuLing($ball);
	$a = substr($ball, 0,1);
	$b = substr($ball, -1);
	$c = $a+$b;
	if($c%2==0){
		return '合数双';
	}else{
		return '合数单';
	}
}
//广东快乐十分号码方位
function G10_Fw($ball){
	if(BuLing($ball) == '01' || BuLing($ball) == '05' || BuLing($ball) == '09' || BuLing($ball) == '13' || BuLing($ball) == '17'){
		$fw = '东';
	}else if(BuLing($ball) == '02' || BuLing($ball) == '06' || BuLing($ball) == '10' || BuLing($ball) == '14' || BuLing($ball) == '18'){
		$fw = '南';
	}else if(BuLing($ball) == '04' || BuLing($ball) == '07' || BuLing($ball) == '11' || BuLing($ball) == '15' || BuLing($ball) == '19'){
		$fw = '西';
	}else{
		$fw = '北';
	}
	return $fw;
}
//广东快乐十分号码中发白
function G10_Zfb($ball){
	if(BuLing($ball) == '01' || BuLing($ball) == '02' || BuLing($ball) == '03' || BuLing($ball) == '04' || BuLing($ball) == '05' || BuLing($ball) == '06' || BuLing($ball) == '07'){
		$zfb = '中';
	}else if(BuLing($ball) == '08' || BuLing($ball) == '09' || BuLing($ball) == '10' || BuLing($ball) == '11' || BuLing($ball) == '12' || BuLing($ball) == '13' || BuLing($ball) == '14'){
		$zfb = '发';
	}else{
		$zfb = '白';
	}
	return $zfb;
}
//重庆时时彩开奖函数
function Ssc_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=23){
			return '总和大';
		}
		if($zh<=23){
			return '总和小';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
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
//重庆时时彩单双
function Ssc_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//重庆时时彩大小
function Ssc_Dx($ball){
	if($ball>4){
		return '大';
	}else{
		return '小';
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
	$zh = $num[0]+$num[9];
	if($type==1){
		echo $zh;
	}
	if($type==2){
		if($zh>11){
			echo '<font color="#FF0000">大</font>';
		}else{
			echo '小';
		}
	}
	if($type==3){
		if($zh%2==0){
			echo '<font color="#FF0000">双</font>';
		}else{
			echo '单';
		}
	}
	if($type==4){
		if($num[0]>$num[9]){
			echo '<font color="#FF0000">龙</font>';
		}else{
			echo '虎';
		}
	}
	if($type==5){
		if($num[1]>$num[2]){
			echo '<font color="#FF0000">龙</font>';
		}else{
			echo '虎';
		}
	}
	if($type==6){
		if($num[2]>$num[7]){
			echo '<font color="#FF0000">龙</font>';
		}else{
			echo '虎';
		}
	}
	if($type==7){
		if($num[3]>$num[6]){
			echo '<font color="#FF0000">龙</font>';
		}else{
			echo '虎';
		}
	}
	if($type==8){
		if($num[4]>$num[5]){
			echo '<font color="#FF0000">龙</font>';
		}else{
			echo '虎';
		}
	}
}
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
?>