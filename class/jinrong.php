<?php
class jinrong{
	static function getmatch_name($sqlwhere){
	
		global $mysqlis;
		$arr	=	array();	
		$sql	=	"select x_title as match_name from t_guanjun ".$sqlwhere." group by x_title";
		$query	=	$mysqlis->query($sql);
		while($rs = $query->fetch_array()){
			$arr[]	=	$rs['match_name'];
		}
		return $arr;
	}
	
	static function getmatch_info($tid){
		
		global $mysqlis;
		$sql	=	"select tt.team_name,tg.Match_CoverDate,tg.match_date,tg.x_title,tt.point,tg.match_name from t_guanjun_team tt,t_guanjun tg where tt.xid=tg.x_id and tt.tid=$tid limit 1";
		$query	=	$mysqlis->query($sql);
		$rs		=	$query->fetch_array();
		return $rs;
	}
}
?>