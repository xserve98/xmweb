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


//江苏快三开奖函数
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

//广东快乐十分开奖函数
function Klsf_Auto($num , $type){
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
//广东快乐十分单双
function Klsf_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广东快乐十分大小
function Klsf_Dx($ball){
	if($ball>=11){
		return '大';
	}else{
		return '小';
	}
}
//广东快乐十分尾大小
function Klsf_Wdx($ball){
	if($ball%10>=5){
		return '尾大';
	}else{
		return '尾小';
	}
}
//广东快乐十分合单双
function Klsf_Hdx($ball){
	if(($ball%10+floor($ball/10))%2==0){
		return '合双';
	}else{
		return '合单';
	}
}
//广东快乐十分中发白
function Klsf_Zfb($ball){
	if($ball<=7){
		return '中';
	}else if($ball>=8 && $ball<=14){
		return '发';
	}else{
        return '白';
    }
}
//广东快乐十分东南西北
function Klsf_Dnxb($ball){
	if($ball%4==1){
		return '东';
    }else if($ball%4==2){
        return '南';
    }else if($ball%4==3){
        return '西';
	}else{
		return '北';
	}
}

//北京赛车(PK10)开奖函数
function Bjsc_Auto($num , $type){
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

//PC蛋蛋开奖函数
function xy28_Auto($num , $type){
	$dx_num=13;
	$zh = $num[3];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>$dx_num){
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
		if($zh>$dx_num){
			if($zh%2==0){
				return '大双';
			}else{
				return '大单';
			}
		}else{
			if($zh%2==0){
				return '小双';
			}else{
				return '小单';
			}
		}
	}
	if($type==5){
		if($zh==0 || $zh==1 || $zh==2 || $zh==3 || $zh==4){
			return '极小';
		}elseif($zh==23 || $zh==24 || $zh==25 || $zh==26 || $zh==27){
			return '极大';
		}else{
			return '非极值';
		}
	}
	if($type==6){
		if($zh==0 || $zh==13 || $zh==14 || $zh==27){
			return '白';
		}elseif($zh==1 || $zh==4 || $zh==7 || $zh==10 || $zh==16|| $zh==19|| $zh==22|| $zh==25){
			return '绿';
		}elseif($zh==2 || $zh==5 || $zh==8 || $zh==11 || $zh==17|| $zh==20|| $zh==23|| $zh==26){
			return '蓝';
		}else{
			return '红';
		}
	}
	if($type==7){
		if($num[0]==$num[1] && $num[1]==$num[2]){
			return '豹子';
		}else{
			return '非豹子';
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