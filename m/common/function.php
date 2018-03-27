<?php
function double_format($double_num){
	return $double_num>0 ? sprintf("%.2f",$double_num) : $double_num<0 ? sprintf("%.2f",$double_num) : 0;
}

function cutString($title,$length=38,$bool=0){ //截取字符串
	$tmpstr = '';
    if($length >= strlen($title)) return $title;
	else{
	    for ($i= 0; $i < $length; $i++){
            if (ord(substr($title, $i, 1)) > 0xa0){
                $tmpstr .= substr($title, $i, 2);
                $i++;
            } else {
                $tmpstr .= substr($title, $i, 1);
            }
        }
	    if($bool) return $tmpstr.'..';
	    else return $tmpstr;
	}
}

/**
* 过滤html代码
**/
function htmlEncode($string) { 
	$string = trim(strip_tags($string)); 
	/*
	$string=str_replace("\'","'",$string); 
	$string=str_replace("&amp;","&",$string); 
	$string=str_replace("&quot;","\"",$string); 
	$string=str_replace("&lt;","<",$string); 
	$string=str_replace("&gt;",">",$string); 
	$string=str_replace("&nbsp;"," ",$string); 
	$string=nl2br($string); 
	*/
	//$string=mysql_real_escape_string($string);
	return $string;
}
	         
/**
* js 页面提示信息，后重定向页面
*/
function message($value,$url=""){ //默认返回上一页
	header("Content-type: text/html; charset=utf-8");
	$js  ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>message</title>
</head>

<body>';
	$js  .= "<script type=\"text/javascript\" language=\"javascript\">\r\n";
	$js .= "alert(\"".$value."\");\r\n";
	if($url) $js .= "window.location.href=\"$url\";\r\n";
	else $js .= "window.history.go(-1);\r\n";
	$js .= "</script>\r\n";
$js.="</body></html>";
	echo $js;
	exit;
}

function write_bet_info($ball_sort,$column,$master_guest,$bet_point,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$tid=0){
	$dm			=	explode("VS.",$master_guest); //队名
	$qcrq		=	array("Match_Ho","Match_Ao"); //全场让球盘口
	$qcdx		=	array("Match_DxDpl","Match_DxXpl"); //全场大小盘口
	$ds			=	array("Match_DsDpl","Match_DsSpl"); //单双
	$info		=	"";
	if(strrpos($ball_sort,"足球") === 0){
		$bcrq	=	array("Match_BHo","Match_BAo"); //半场让球盘口
		$bcdx	=	array("Match_Bdpl","Match_Bxpl"); //半场大小盘口
		$qcdy	=	array("Match_BzM","Match_BzG","Match_BzH"); //全场独赢
		$bcdy	=	array("Match_Bmdy","Match_Bgdy","Match_Bhdy"); //半场独赢
		$sbbdz	=	array("Match_Hr_Bd10","Match_Hr_Bd20","Match_Hr_Bd21","Match_Hr_Bd30","Match_Hr_Bd31","Match_Hr_Bd32","Match_Hr_Bd40","Match_Hr_Bd41","Match_Hr_Bd42","Match_Hr_Bd43"); //上半波胆主
		$sbbdk	=	array("Match_Hr_Bdg10","Match_Hr_Bdg20","Match_Hr_Bdg21","Match_Hr_Bdg30","Match_Hr_Bdg31","Match_Hr_Bdg32","Match_Hr_Bdg40","Match_Hr_Bdg41","Match_Hr_Bdg42","Match_Hr_Bdg43"); //上半波胆客
		$sbbdp	=	array("Match_Hr_Bd00","Match_Hr_Bd11","Match_Hr_Bd22","Match_Hr_Bd33","Match_Hr_Bd44","Match_Hr_Bdup5"); //上半波胆平
		$bdz	=	array("Match_Bd10","Match_Bd20","Match_Bd21","Match_Bd30","Match_Bd31","Match_Bd32","Match_Bd40","Match_Bd41","Match_Bd42","Match_Bd43"); //波胆主
		$bdk	=	array("Match_Bdg10","Match_Bdg20","Match_Bdg21","Match_Bdg30","Match_Bdg31","Match_Bdg32","Match_Bdg40","Match_Bdg41","Match_Bdg42","Match_Bdg43"); //波胆客
		$bdp	=	array("Match_Bd00","Match_Bd11","Match_Bd22","Match_Bd33","Match_Bd44","Match_Bdup5"); //波胆平
		$rqs	=	array("Match_Total01Pl","Match_Total23Pl","Match_Total46Pl","Match_Total7upPl"); //入球数
		$bqc	=	array("Match_BqMM","Match_BqMH","Match_BqMG","Match_BqHM","Match_BqHH","Match_BqHG","Match_BqGM","Match_BqGH","Match_BqGG"); //半全场
		
		if(in_array($column,$qcrq) || in_array($column,$bcrq)){ //让球
			if(in_array($column,$qcrq))		$info	.=	"让球-";
			else	$info	.=	"上半场让球-";
			
			if($match_showtype ==	"H")	$info	.=	"主让$match_rgg-";
			else	$info	.=	"客让$match_rgg-";
			
			if($column == "Match_Ho" || $column == "Match_BHo") $info .= $dm[0];
			else	$info	.=	$dm[1];
			
		}elseif(in_array($column,$qcdx) || in_array($column,$bcdx)){ //大小
			if(in_array($column,$qcdx)){
				$info		.=	"大小-";
				if($column	==	"Match_DxDpl")	$info	.=	"大";
				else $info	.=	"小";
			}else{
				$info		.=	"上半场大小-";
				if($column	==	"Match_Bdpl")	$info	.=	"大";
				else $info	.=	"小";
			}
			$info			.=	$match_dxgg;
		}elseif(in_array($column,$qcdy) || in_array($column,$bcdy)){ //独赢
			if(in_array($column,$qcdy))			$info	.=	"标准盘-";
			else	$info	.=	"上半场标准盘-";
			
			if(		$column == "Match_BzM" || $column == "Match_Bmdy") $info	.=	$dm[0]."-独赢";
			elseif(	$column == "Match_BzG" || $column == "Match_Bgdy") $info	.=	$dm[1]."-独赢";
			else	$info	.=	"和局";
		}elseif(in_array($column,$ds)){ //单双
			$info			.=	"单双-";
			if($column 		== "Match_DsDpl")	$info .= "单";
			else	$info	.=	"双";
		}elseif(in_array($column,$sbbdz) || in_array($column,$sbbdk) || in_array($column,$sbbdp) || in_array($column,$bdz) || in_array($column,$bdk) || in_array($column,$bdp)){ //波胆
			if(in_array($column,$sbbdz) || in_array($column,$sbbdk) || in_array($column,$sbbdp)) $info	.=	"上半波胆-";
			else	$info	.=	"波胆-";
			
			if(strrpos($column,"up5")){
				$info		.=	"UP5";
			}else{
				$z			 =	substr($column,-2,1);
				$k			 =	substr($column,-1,1);
				if(in_array($column,$sbbdz) || in_array($column,$bdz))	$info	.=	$z.":".$k;
				else $info	.=	$k.":".$z;
			}
		}elseif(in_array($column,$rqs)){ //入球数
			$info			.=	"入球数-";
			if(strrpos($column,"7up")){
				$info		.=	"7UP";
			}else{
				$info		.=	substr($column,-4,1)."~".substr($column,-3,1);
			}
		}elseif(in_array($column,$bqc)){ //半全场
			$info			.=	"半全场-";
			$n1				 = "".substr($column,-2,1);
			$n2				 = "".substr($column,-1,1);
			$n1				 = ($n1 === "H" ? "和" : ($n1 === "M" ? "主" : "客"));
			$n2				 = ($n2 === "H" ? "和" : ($n2 === "M" ? "主" : "客"));
			$info			.=	$n1."/".$n2;
		}
		if($ball_sort		==	"足球滚球"){
			$info		  	.=	"(".$match_nowscore.")";
		}
		$info				.=	"@".$bet_point;
	
	}elseif(strrpos($ball_sort,"篮球") === 0){
		$qcdy	=	array("Match_BzM","Match_BzG","Match_BzH"); //全场独赢
		$bcdy	=	array("Match_Bmdy","Match_Bgdy","Match_Bhdy"); //半场独赢
		$zddx	=	array("Match_DFzDpl","Match_DFzXpl"); //主队大小
		$kddx	=	array("Match_DFkDpl","Match_DFkXpl"); //主队大小
		if(in_array($column,$qcrq)){
			$info			.=	"让分-";
			if($match_showtype ==	"H") $info	.=	"主让$match_rgg-";
			else	$info	.=	"客让$match_rgg-";
			
			if($column 		== "Match_Ho")$info .= $dm[0];
			else	$info	.=	$dm[1];
			
		}elseif(in_array($column,$qcdx)){
			$info			.=	"大小-";
			if($column		==	"Match_DxDpl")$info	.=	"大$match_dxgg";
			else $info		.=	"小$match_dxgg";
		}elseif(in_array($column,$qcdy) || in_array($column,$bcdy)){ //独赢
			if(in_array($column,$qcdy))			$info	.=	"标准盘-";
			else	$info	.=	"上半场标准盘-";
			
			if($column == "Match_BzM" || $column == "Match_Bmdy") $info	.=	$dm[0]."-独赢";
			elseif(	$column == "Match_BzG" || $column == "Match_Bgdy") $info	.=	$dm[1]."-独赢";
			else	$info	.=	"和局";
		}elseif(in_array($column,$zddx)){ //主队大小
			$info			.=	"主队大小-";
			if($column		==	"Match_DFzDpl")$info	.=	"大$match_dxgg";
			else $info		.=	"小$match_dxgg";
		}elseif(in_array($column,$kddx)){ //客队大小
			$info			.=	"客队大小-";
			if($column		==	"Match_DFkDpl")$info	.=	"大$match_dxgg";
			else $info		.=	"小$match_dxgg";
		}elseif(in_array($column,$ds)){ //单双
			$info			.=	"单双-";
			if($column 		== "Match_DsDpl")	$info .= "单";
			else	$info	.=	"双";
		}
		$info			  	.=	"@".$bet_point;
	}elseif(strrpos($ball_sort,"棒球") === 0 || strrpos($ball_sort,"网球") === 0 || strrpos($ball_sort,"排球") === 0){
		$qcdy	=	array("Match_BzM","Match_BzG","Match_BzH"); //全场独赢
		if(in_array($column,$qcrq)){
			$info			.=	"让球-";
			if($match_showtype ==	"H") $info	.=	"主让$match_rgg-";
			else	$info	.=	"客让$match_rgg-";
			
			if($column 		== "Match_Ho")$info .= $dm[0];
			else	$info	.=	$dm[1];
			
		}elseif(in_array($column,$qcdx)){
			$info			.=	"大小-";
			if($column		==	"Match_DxDpl")$info	.=	"大$match_dxgg";
			else $info		.=	"小$match_dxgg";
			
		}elseif(in_array($column,$ds)){ //单双
			$info			.=	"单双-";
			if($column 		== "Match_DsDpl")	$info .= "单";
			else	$info	.=	"双";
		}elseif(in_array($column,$qcdy)){ //独赢
			$info			.=	"标准盘-";
			
			if(		$column == "Match_BzM") $info	.=	$dm[0]."-独赢";
			elseif(	$column == "Match_BzG") $info	.=	$dm[1]."-独赢";
		}
		$info			  	.=	"@".$bet_point;
	}elseif(strrpos($ball_sort,"金融") === 0 || strrpos($ball_sort,"冠军") === 0){
		global $mysqlis;
		$query	=	$mysqlis->query("SELECT team_name FROM t_guanjun_team where tid=$tid limit 1");
		$row	=	$query->fetch_array();
		if(strrpos($ball_sort,"金融") === 0) $row['team_name']=strtolower(str_replace(" ",'',$row['team_name']));
		$info	=	$row['team_name'].'@'.$bet_point;
	}
	
	return $info;
}

function replace_mysql_input($value){
	/*自定义攻击拦截*/
	require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
	filter_check_mysql("sp-list",$value);
	return $value;
}

function getbet_msg($zt){
	$msg='未知';
	switch ($zt){
	  case "1": $msg='<font color="#FF0000">全赢</font>';break;
	  case "2": $msg='<font color="#009900">全输</font>';break;
	  case "3": $msg='<font color="#FF9900">取消</font>';break;
	  case "4": $msg='<font color="#FF0000">赢一半</font>';break;
	  case "5": $msg='<font color="#009900">输一半</font>';break;	  
	  case "6": $msg='<font color="#FF6600">进球无效</font>';break;
	  case "7":
	  case "8":$msg='<font color="#FF6600">和局</font>';break;
  }
  return $msg;
}

function getbet_win($zt,$win,$money,$fs=0){
	$b=1;
	switch ($zt){
	  case "1": $b=$win-$money+$fs;break;
	  case "2": $b=0-$money+$fs;break;
	  case "3": $b=0;break;
	  case "4": $b=$win-$money+$fs;break;
	  case "5": $b=0-($money/2)+$fs;break;	  
	  case "6": $b=0;break;
	  case "7":
	  case "8":$b=$fs;break;
  }
  return $b;
}


function getcolor($num){
	if($num>0) return '<font color="#FF0000">'.$num.'</font>';
	elseif($num<0) return '<font color="#009900">'.$num.'</font>';
	else  return '<font color="#000000">'.$num.'</font>';
}

function ch_num($num) {
    $ch = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
    return $ch[$num];
}

$dateRange = "date_add(now(), interval 13 hour)";
$beijingTime = "date_add(bet_time, interval 25 hour) as bj_time";
?>