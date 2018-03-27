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
//重庆快乐十分开奖函数
function C10_Auto($num , $type){
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



//广西快乐十分开奖函数  开始
function Gxsf_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4];
	
	
	//总和
	if($type==1){
		return $zh;
	}
	
	//总和大小
	if($type==2){
		if($zh>=55){
			return '总和大';
		}
		if($zh<=54){
			return '总和小';
		}
	}
	
	//总和单双
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	
	//龙虎和
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
	
	//前三
	if($type==5){
		
		$hm 		= array();
		$hm[]		= $num[0];
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	
	//中三
	if($type==6){
		$hm 		= array();
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	
	//后三
	if($type==7){
		$hm 		= array();
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		$hm[]		= $num[4];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
}

//广西快乐十分单双
function Gxsf_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广西快乐十分大小
function Gxsf_Dx($ball){
	if($ball>10){
		return '大';
	}else{
		return '小';
	}
}

//三顺，二顺判断
function shunzi($a, $type){
	
	sort($a);
	
	if($type == 2){
		
		if($a[0]+1 == $a[1] || $a[1]+1 == $a[2]){
			return true;
		}else{
			return false;
		}
		
		
	}else if($type == 3){
		
		if($a[0]+1 == $a[1] && $a[1]+1 == $a[2]){
			return true;
		}else{
			return false;
		}
		
	}
	
}


//广西快乐十分开奖函数  结束

//江苏快三开奖函数 开始
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

//江苏快三开奖函数 结束






//公历转农历函数	
class Lunar
{
	private  $_SMDay = array(1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);//定义公历月分天数
	private  $_LStart = 1950 ;//农历从1950年开始
	private  $_LMDay = array(
	//差：该年的农历正月初一到该年公历1月1日的天数；1~12：农历月份天数；闰：如有闰月，记录该月平月天数
	//    差  1  2  3  4  5  6  7  8  9 10 11 12 闰
	array(47,29,30,30,29,30,30,29,29,30,29,30,29),
	array(36,30,29,30,30,29,30,29,30,29,30,29,30),
    array(6,29,30,29,30,59,29,30,30,29,30,29,30,29),    //五月29 闰五月30
   	array(44,29,30,29,29,30,30,29,30,30,29,30,29),
    array(33,30,29,30,29,29,30,29,30,30,29,30,30),
    array(23,29,30,59,29,29,30,29,30,29,30,30,30,29),    //三月29 闰三月30
    array(42,29,30,29,30,29,29,30,29,30,29,30,30),
    array(30,30,29,30,29,30,29,29,59,30,29,30,29,30),    //八月30 闰八月29
    array(48,30,30,30,29,30,29,29,30,29,30,29,30),
    array(38,29,30,30,29,30,29,30,29,30,29,30,29),
    array(27,30,29,30,29,30,59,30,29,30,29,30,29,30),    //六月30 闰六月29
    array(45,30,29,30,29,30,29,30,30,29,30,29,30),
    array(35,29,30,29,29,30,29,30,30,29,30,30,29),
    array(24,30,29,30,58,30,29,30,29,30,30,30,29,29),    //四月29 闰四月29
    array(43,30,29,30,29,29,30,29,30,29,30,30,30),
    array(32,29,30,29,30,29,29,30,29,29,30,30,29),
    array(20,30,30,59,30,29,29,30,29,29,30,30,29,30),    //三月30 闰三月29
    array(39,30,30,29,30,30,29,29,30,29,30,29,30),
    array(29,29,30,29,30,30,29,59,30,29,30,29,30,30),    //七月30 闰七月29
    array(47,29,30,29,30,29,30,30,29,30,29,30,29),
    array(36,30,29,29,30,29,30,30,29,30,30,29,30),
    array(26,29,30,29,29,59,30,29,30,30,30,29,30,30),    //五月30 闰五月29
    array(45,29,30,29,29,30,29,30,29,30,30,29,30),
    array(33,30,29,30,29,29,30,29,29,30,30,29,30),
    array(22,30,30,29,59,29,30,29,29,30,30,29,30,30),    //四月30 闰四月29
    array(41,30,30,29,30,29,29,30,29,29,30,29,30),
    array(30,30,30,29,30,29,30,29,59,29,30,29,30,30),    //八月30 闰八月29
    array(48,30,29,30,30,29,30,29,30,29,30,29,29),
    array(37,30,29,30,30,29,30,30,29,30,29,30,29),
    array(27,30,29,29,30,29,60,29,30,30,29,30,29,30),    //六月30 闰六月30
    array(46,30,29,29,30,29,30,29,30,30,29,30,30),
    array(35,29,30,29,29,30,29,29,30,30,29,30,30),
    array(24,30,29,30,58,30,29,29,30,29,30,30,30,29),    //四月29 闰四月29
    array(43,30,29,30,29,29,30,29,29,30,29,30,30),
    array(32,30,29,30,30,29,29,30,29,29,59,30,30,30),    //十月30 闰十月29
    array(50,29,30,30,29,30,29,30,29,29,30,29,30),
    array(39,29,30,30,29,30,30,29,30,29,30,29,29),
    array(28,30,29,30,29,30,59,30,30,29,30,29,29,30),    //六月30 闰六月29
    array(47,30,29,30,29,30,29,30,30,29,30,30,29),
    array(36,30,29,29,30,29,30,29,30,29,30,30,30),
    array(26,29,30,29,29,59,29,30,29,30,30,30,30,30),    //五月30 闰五月29
    array(45,29,30,29,29,30,29,29,30,29,30,30,30),
    array(34,29,30,30,29,29,30,29,29,30,29,30,30),
    array(22,29,30,59,30,29,30,29,29,30,29,30,29,30),    //三月30 闰三月29
    array(40,30,30,30,29,30,29,30,29,29,30,29,30),
    array(30,29,30,30,29,30,29,30,59,29,30,29,30,30),    //八月30 闰八月29
    array(49,29,30,29,30,30,29,30,29,30,30,29,29),
    array(37,30,29,30,29,30,29,30,30,29,30,30,29),
    array(27,30,29,29,30,58,30,30,29,30,30,29,30,29),    //五月29 闰五月29
    array(46,30,29,29,30,29,29,30,29,30,30,30,29),
    array(35,30,30,29,29,30,29,29,30,29,30,30,29),
    array(23,30,30,29,59,30,29,29,30,29,30,29,30,30),    //四月30 闰四月29
    array(42,30,30,29,30,29,30,29,29,30,29,30,29),
    array(31,30,30,29,30,30,29,30,29,29,30,29,30),
    array(21,29,59,30,30,29,30,29,30,29,30,29,30,30),    //二月30 闰二月29
    array(39,29,30,29,30,29,30,30,29,30,29,30,29),
    array(28,30,29,30,29,30,29,59,30,30,29,30,30,30),    //七月30 闰七月29
    array(48,29,29,30,29,29,30,29,30,30,30,29,30),
    array(37,30,29,29,30,29,29,30,29,30,30,29,30),
    array(25,30,30,29,29,59,29,30,29,30,29,30,30,30),    //五月30 闰五月29
    array(44,30,29,30,29,30,29,29,30,29,30,29,30),
    array(33,30,29,30,30,29,30,29,29,30,29,30,29),
    array(22,30,29,30,59,30,29,30,29,30,29,30,29,30),    //四月30 闰四月29
    array(40,30,29,30,29,30,30,29,30,29,30,29,30),
    array(30,29,30,29,30,29,30,29,30,59,30,29,30,30),    //九月30 闰九月29
    array(49,29,30,29,29,30,29,30,30,30,29,30,29),
    array(38,30,29,30,29,29,30,29,30,30,29,30,30),
    array(27,29,30,29,30,29,59,29,30,29,30,30,30,29),    //六月29 闰六月30
    array(46,29,30,29,30,29,29,30,29,30,29,30,30),
    array(35,30,29,30,29,30,29,29,30,29,29,30,30),
    array(24,29,30,30,59,30,29,29,30,29,30,29,30,30),    //四月30 闰四月29
    array(42,29,30,30,29,30,29,30,29,30,29,30,29),
    array(31,30,29,30,29,30,30,29,30,29,30,29,30),
    array(21,29,59,29,30,30,29,30,30,29,30,29,30,30),    //二月30 闰二月29
    array(40,29,30,29,29,30,29,30,30,29,30,30,29),
    array(28,30,29,30,29,29,59,30,29,30,30,30,29,30),    //六月30 闰六月29
    array(47,30,29,30,29,29,30,29,29,30,30,30,29),
    array(36,30,30,29,30,29,29,30,29,29,30,30,29),
    array(25,30,30,30,29,59,29,30,29,29,30,30,29,30),    //五月30 闰五月29
    array(43,30,30,29,30,29,30,29,30,29,29,30,30),
    array(33,29,30,29,30,30,29,30,29,30,29,30,29),
    array(22,29,30,59,30,29,30,30,29,30,29,30,29,30),    //三月30 闰三月29
    array(41,30,29,29,30,29,30,30,29,30,30,29,30),
    array(30,29,30,29,29,30,29,30,29,30,30,59,30,30),    //十一月30 闰十一月29
    array(49,29,30,29,29,30,29,30,29,30,30,29,30),
    array(38,30,29,30,29,29,30,29,29,30,30,29,30),
    array(27,30,30,29,30,29,59,29,29,30,29,30,30,29),    //六月29 闰六月30
    array(45,30,30,29,30,29,29,30,29,29,30,29,30),
    array(34,30,30,29,30,29,30,29,30,29,29,30,29),
    array(23,30,30,29,30,59,30,29,30,29,30,29,29,30),    //五月30 闰五月29
    array(42,30,29,30,30,29,30,29,30,30,29,30,29),
    array(31,29,30,29,30,29,30,30,29,30,30,29,30),
    array(21,29,59,29,30,29,30,29,30,30,29,30,30,30),    //二月30 闰二月29
    array(40,29,30,29,29,30,29,29,30,30,29,30,30),
    array(29,30,29,30,29,29,30,58,30,29,30,30,30,29),    //七月29 闰七月29
    array(47,30,29,30,29,29,30,29,29,30,29,30,30),
    array(36,30,29,30,29,30,29,30,29,29,30,29,30),
    array(25,30,29,30,30,59,29,30,29,29,30,29,30,29),    //五月29 闰五月30
    array(44,29,30,30,29,30,30,29,30,29,29,30,29),
    array(32,30,29,30,29,30,30,29,30,30,29,30,29),
    array(22,29,30,59,29,30,29,30,30,29,30,30,29,29),    //三月29 闰三月30		
	);
	//是否闰年
	private function IsLeapYear($AYear){
        return ($AYear % 4 == 0) && (($AYear % 100 != 0) || ($AYear % 400 == 0));
	}
	//公历该月的天数(year：年份； month：月份)
	private function GetSMon($year,$month)
	{
		if($this->IsLeapYear($year) && $month == 2)
			return 29;
		else
			return $this->_SMDay[$month];
	}
	//农历名称转换
	private function LYearName($year)
	{
		$Name = array("零","一","二","三","四","五","六","七","八","九");
		for($i=0;$i<4;$i++)
			for($k=0;$k<10;$k++)
				if($year[$i]==$k)
					$tmp.=$Name[$k];
		return $tmp;
	}
	
	private function LMonName($month)
	{
		if($month >=1 && $month <=12 )
		{
			$Name = array( 1=>"正","二","三","四","五","六","七","八","九","十","十一","十二");
			return $Name[$month];
		}
		return $month;
	}
	
	private function LDayName($day)
	{
		if($day >=1 && $day <=30 )
		{
			$Name = array( 1 =>
			"初一","初二","初三","初四","初五","初六","初七","初八","初九","初十",
			"十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",
			"廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十"
			);
			return $Name[$day];
		} 
		return $day;
	}
	
	//公历转农历(Sdate：公历日期)
	public function S2L($date)
	{
		list($year, $month, $day) = explode("-", $date);
		if($year <= 1951 || $month <= 0 || $day <= 0 || $year >= 2051 )	return false;
		//获取查询日期到当年1月1日的天数
		$date1 = strtotime($year."-01-01");//当年1月1日
		$date2 = strtotime($year."-".$month."-".$day);
		$days=round(($date2-$date1)/3600/24);
		$days += 1;
		//获取相应年度农历数据，化成数组Larray
		$Larray = $this->_LMDay[$year - $this->_LStart];
		if($days <= $Larray[0])
		{
			$Lyear = $year - 1;
			$days = $Larray[0] - $days;
			$Larray = $this->_LMDay[$Lyear - $this->_LStart];
			if($days < $Larray[12])
			{
				$Lmonth = 12;
				$Lday = $Larray[12] - $days;
			}
			else
			{
				$Lmonth = 11;
				$days = $days - $Larray[12];
				$Lday = $Larray[11] - $days;
			}			
		}
		else
		{
			$Lyear = $year;
			$days = $days - $Larray[0];
			for($i = 1;$i <= 12;$i++)
			{
				if($days > $Larray[$i]) $days = $days - $Larray[$i];
				else 
				{
					if ($days > 30){
						$days = $days - $Larray[13];
						$Ltype = 1;
					}
				
					$Lmonth = $i;
					$Lday = $days;
					break;
				}
			}
		}
		return mktime(0, 0, 0, $Lmonth, $Lday, $Lyear);
		//$Ldate = $Lyear."-".$Lmonth."-".$Lday;
		//$Ldate = $this->LYearName($Lyear)."年".$this->LMonName($Lmonth)."月".$this->LDayName($Lday);
		//if($Ltype) $Ldate.="(闰)";
		//return $Ldate;
	}
	//农历转公历(date：农历日期； type：是否闰月)
	public function L2S($date,$type = 0)
	{
		list($year, $month, $day) = split("-",$date);
		if($year <= 1951 || $month <= 0 || $day <= 0 || $year >= 2051 )	return false;
		$Larray = $this->_LMDay[$year - $this->_LStart];
		if($type == 1 && count($Larray)<=12 ) return false;//要求查询闰，但查无闰月
		//如果查询的农历是闰月并该年度农历数组存在闰月数据就获取
		if($Larray[$month]>30 && $type == 1 && count($Larray) >=13)	$day = $Larray[13] + $day;
		//获取该年农历日期到公历1月1日的天数
		$days = $day;
		for($i=0;$i<=$month-1;$i++)
			$days += $Larray[$i];
		//当查询农历日期距离公历1月1日超过一年时
		if($days > 366 || ($this->GetSMon($month,2)!=29 && $days>365 ))
		{
			$Syear = $year +1;
			if($this->GetSMon($month,2)!=29) 
				$days-=366;
			else
				$days-=365;
			if($days > $this->_SMDay[1]) 
			{
				$Smonth = 2;
				$Sday = $days - $this->_SMDay[1];
			}
			else
			{
				$Smonth = 1;
				$Sday = $days;
			}		
		}
		else
		{
			$Syear =$year;
			for($i=1;$i<=12;$i++)
			{
				if($days > $this->GetSMon($Syear,$i))
					$days-=$this->GetSMon($Syear,$i);
				else
				{
					$Smonth = $i;
					$Sday = $days;
					break;
				}
			}
		}
		return mktime(0, 0, 0, $Smonth, $Sday, $Syear);
		//$Sdate = $Syear."-".$Smonth."-".$Sday;
		//return $Sdate;
	}
}
//获取当前年份的生肖
function Get_DqShengXiao($year)
{
 $arr = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
 if( preg_match("/^\d{4}$/",$year))
 {
  $m = $year % 12;
  //echo $m;
  $x = $arr[$m];
 }
 return $x;
}
//根据农历新年以及开奖号码整出12计算出该号码的生肖属性
function Get_ShengXiao($year,$hm)
{
	//$year="2015";
 $arr = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');

 if( preg_match("/^\d{4}$/",$year))
 {
  $m = $year % 12;
  //echo $m;
  $x = $arr[$m];
 }
 //echo $x;exit;
	switch ($x)
	{
		case '猪':
		  $sx = array('猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠');
		  break;
		case '狗':
		  $sx = array('狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪');
		  break;
		case '鸡':
		  $sx = array('鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗');
		  break;
		case '猴':
		  $sx = array('猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡');
		  break;
		case '羊':
		  $sx = array('羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴');
		  break;
		case '马':
		  $sx = array('马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊');
		  break;
		case '蛇':
		  $sx = array('蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马');
		  break;
		case '龙':
		  $sx = array('龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇');
		  break;
		case '兔':
		  $sx = array('兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙');
		  break;
		case '虎':
		  $sx = array('虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔');
		  break;
		case '牛':
		  $sx = array('牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎');
		  break;
		case '鼠':
		  $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
		  break;
		default:
		  $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
	}
	if($hm==0){
		return $sx[11];
	}else{
		return $sx[$hm-1];
	}
}
?>