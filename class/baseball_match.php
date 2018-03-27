<?php
class baseball_match{
	static function getmatch_name($sqlwhere){
	
		global $mysqlis;
		$arr	=	array();
		$sql	=	"select match_name from baseball_match ".$sqlwhere." group by match_name";
		$query	=	$mysqlis->query($sql);
		while($rs = $query->fetch_array()){
			$arr[]	=	$rs['match_name'];
		}
		return $arr;
	}
	
	static function getmatch_info($match_id,$point_column="match_name"){
		
		global $mysqlis;
		/*判断字段是否存在 开始*/
		$sql_col	=	"show columns from baseball_match";
		$query_col	=	$mysqlis->query($sql_col);
		$ok_col = false;
		while($rs_col = $query_col->fetch_array()){
			if(strtolower($rs_col["Field"])==strtolower($point_column)){
				$ok_col = true;
				break;
			}
		}
		if(!$ok_col){
			exit("point_column error");
		}
		/*判断字段是否存在 结束*/
		$sql	=	"select match_name,match_master,match_time,match_date,match_showtype,Match_CoverDate,match_guest,match_type,match_rgg,match_dxgg,$point_column from baseball_match where match_id=$match_id limit 1";
		$query	=	$mysqlis->query($sql);
		$rs		=	$query->fetch_array();
		return $rs;
	}
}
?>