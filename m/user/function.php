<?php
//字符串，要保留前几位
function cutTitle($title,$length=3){
	$tmpstr = '';
	mb_internal_encoding("UTF-8");
    if($length >= mb_strlen($title)) return $title;
	else{
		$tmpstr = mb_substr($title,0,$length);
		while($length <= mb_strlen($title)){
			$tmpstr .= '*';
			$length++;
		}
		return $tmpstr;
	}
}

//字符串，要保留前几位和后几位
function cutNum($title,$s=4,$e=4){
	mb_internal_encoding("UTF-8");
	$tmpstr = mb_substr($title,0,$s);
	for($i=0;$i<mb_strlen($title)-$s-$e;$i++){
		$tmpstr .= '*';
	}
	return $tmpstr.mb_substr($title,mb_strlen($title)-$e);
}

//显示其他加/减款类型
function mtypeName($m_type){
	$mtypename="";
	switch($m_type){
		case 3:
			$mtypename="人工汇款";
			break;
		case 4:
			$mtypename="彩金派送";
			break;
		case 5:
			$mtypename="反水派送";
			break;
		case 6:
			$mtypename="其他情况";
			break;
		default:
			$mtypename="";
			break;
	}
	return $mtypename;
}

//显示真人转账类型
function zzTypeName($zz_type){
	$zz_typename="";
	switch($zz_type){
		case "d":
			$zz_typename="体育/彩票 → 真人账户";
			break;
		case "vd":
			$zz_typename="体育/彩票 → 真人VIP厅";
			break;
		case "w":
			$zz_typename="真人账户 → 体育/彩票";
			break;
		case "vw":
			$zz_typename="真人VIP厅 → 体育/彩票";
			break;
		default:
			$zz_typename="";
			break;
	}
	return $zz_typename;
}
?>