<?php
class lq_match{
	static function getmatch_name($sqlwhere){
	
		global $mysqlis;
		$arr	=	array();	
  		$sql	=	"select match_name from lq_match ".$sqlwhere." group by match_name";
		$query	=	$mysqlis->query($sql);
		while($rs = $query->fetch_array()){
			$arr[]	=	$rs['match_name'];
		}
		return $arr;
  	}
	
  	static function getmatch_info($match_id,$point_column="Match_Name",$ball_sort=""){
		
		global $mysqlis;
		/*判断字段是否存在 开始*/
		$sql_col	=	"show columns from lq_match";
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
		if($ball_sort != "篮球滚球"){
			$sql	=	"select match_name,match_master,match_time,match_date,Match_CoverDate,match_guest,Match_NowScore,match_showtype,match_type,match_rgg,match_dxgg,Match_DFzDX,Match_DFkDX,$point_column from lq_match where match_id=$match_id limit 1";
			$query	=	$mysqlis->query($sql);  		
			$rs		=	$query->fetch_array();
			
			return $rs;
        }else{
			include_once("../cache/lqgq.php");
			for($i=0;$i<count($lqgq);$i++){
				if($match_id == $lqgq[$i]['Match_ID']) break;
			}
			$rs						=	array();
			$rs['match_name']		=	$lqgq[$i]['Match_Name'];
			$rs['match_master']		=	$lqgq[$i]['Match_Master'];
			$rs['match_time']		=	$lqgq[$i]['Match_Time'];
			$rs['match_guest']		=	$lqgq[$i]['Match_Guest'];
			$rs['Match_NowScore']	=	$lqgq[$i]['Match_NowScore'];
			$rs['match_showtype']	=	$lqgq[$i]['Match_ShowType'];
			$rs['match_type']		=	$lqgq[$i]['Match_Type'];
			$rs['match_rgg']		=	$lqgq[$i]['Match_RGG'];
			$rs['match_dxgg']		=	$lqgq[$i]['Match_DxGG'];
			$rs['Match_DFzDX']		=	$lqgq[$i]['Match_DFzDX1'];
			$rs['Match_DFzDpl']		=	$lqgq[$i]['Match_DFzDpl'];
			$rs['Match_DFzXpl']		=	$lqgq[$i]['Match_DFzXpl'];
			$rs['Match_DFkDX']		=	$lqgq[$i]['Match_DFkDX1'];
			$rs['Match_DFkDpl']		=	$lqgq[$i]['Match_DFkDpl'];
			$rs['Match_DFkXpl']		=	$lqgq[$i]['Match_DFkXpl'];
			$rs[$point_column]		=	round($lqgq[$i][$point_column],2);
			
			$sql	=	"select Match_CoverDate from lq_match where match_id=$match_id limit 1"; //取开赛时间
			$query	=	$mysqlis->query($sql);
			if($row =	$query->fetch_array()){
				$rs['Match_CoverDate']	=	$row['Match_CoverDate'];
			}
			
			return $rs;
		}
  	}	
}
?>