<?php
session_start();
header('Content-type: text/json; charset=utf-8');
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../cache/jkhy.php");
$callback	=	$_GET['callback'];
$ds			=	rtrim($_GET['ds'],",");
$cg			=	rtrim($_GET['cg'],",");
$json		=	array();

//取会员在线信息
$zxhy		=	array();
$zxuid		=	'';
$sql		=	"SELECT uid FROM k_user_login where uid in ($jk_uid) and `is_login`>0 order by uid asc";
$query		=	$mysqli->query($sql);
$i			=	0;
while($rows	=	$query->fetch_array()){
	$zxhy[$i]['uid']		=	$rows['uid'];
	$zxhy[$i]['username']	=	$jkhy[$rows['uid']];
	$zxhy[$i]['zx']			=	1;
	$i++;
	unset($jkhy[$rows['uid']]);
	$zxuid	.=	$rows['uid'].',';
}
foreach($jkhy as $k=>$v){
	$zxhy[$i]['uid']		=	$k;
	$zxhy[$i]['zx']			=	0;
	$zxhy[$i]['username']	=	$v;
	$i++;
}
$json['hy']	=	$zxhy ? $zxhy : 'none';
$json['ds']	=	'none';
$json['cg']	=	'none';

if($zxuid){ //有会员在线
	include("../../cache/jkhy.php");
	$zxuid		=	rtrim($zxuid,',');
	
	//取会员在这一分钟内的单式交易信息
	if($ds)	$ds	=	" and bid not in($ds)";
	$ds_arr		=	array();
	$sql		=	"select bid,uid,match_name,www,number,match_id,master_guest,ball_sort,match_time,bet_money,bet_win,bet_time,match_endtime,assets,balance,bet_info from k_bet where bet_time>=DATE_SUB(now(),INTERVAL 300 SECOND) and uid in ($zxuid) $ds order by bid asc";
	$query		=	$mysqli->query($sql);
	$i			=	0;
	while($rows	=	$query->fetch_array()){
		$ds_arr[$i]['bid']				=	$rows['bid'];
		$ds_arr[$i]['uid']				=	$rows['uid'];
		$ds_arr[$i]['username']			=	$jkhy[$rows['uid']];
		$ds_arr[$i]['match_name']		=	$rows['match_name'];
		$ds_arr[$i]['www']				=	'<br /><span style="color:#999999">'.$rows["www"].'</span>';
		$ds_arr[$i]['number']			=	$rows['number'];
		$ds_arr[$i]['match_id']			=	$rows['match_id'];
		$ds_arr[$i]['ball_sort']		=	$rows['ball_sort'];
		$ds_arr[$i]['match_time']		=	$rows['match_time'];
		$ds_arr[$i]['bet_money']		=	$rows['bet_money'];
		$ds_arr[$i]['bet_win']			=	$rows['bet_win'];
		$ds_arr[$i]['bet_time']			=	date("m-d H:i:s",strtotime($rows['bet_time']))."<br>".date("m-d H:i:s",strtotime($rows['match_endtime']));
		$ds_arr[$i]['assets']			=	$rows['assets'];
		$ds_arr[$i]['balance']			=	$rows['balance'];
		if(strpos($rows["master_guest"],'VS.')) $ds_arr[$i]["master_guest"] = str_replace("VS.","<br/>",$rows["master_guest"]);
		else $ds_arr[$i]["master_guest"]		=	str_replace("VS","<br/>",$rows["master_guest"]);
		if($rows["point_column"]==="match_jr" || $rows["point_column"]==="match_gj") $ds_arr[$i]['bet_info'] = $rows["bet_info"];
		else $ds_arr[$i]['bet_info']	=	str_replace("-","<br>",$rows["bet_info"]);

		$i++;
	}
	$json['ds']	=	$ds_arr ? $ds_arr : 'none';
	
	//取会员在这一分钟内的串关交易信息
	$gid		=	'';
	if($cg)	$cg	=	" and gid not in($cg)";
	$cg_arr		=	array();
	$sql		=	"SELECT gid,cg_count,uid,bet_money,bet_win,bet_time,balance,assets,www FROM k_bet_cg_group where bet_time>=DATE_SUB(now(),INTERVAL 300 SECOND) and uid in ($zxuid) $cg order by gid asc";
	$query		=	$mysqli->query($sql);
	$i			=	0;
	while($rows	=	$query->fetch_array()){
		$cg_arr[$i]['gid']				=	$rows['gid'];
		$cg_arr[$i]['uid']				=	$rows['uid'];
		$cg_arr[$i]['username']			=	$jkhy[$rows['uid']];
		$cg_arr[$i]['cg_count']			=	$rows['cg_count'].'串一<br /><span style="color:#999999">'.$rows["www"].'</span>';
		$cg_arr[$i]['bet_money']		=	$rows['bet_money'];
		$cg_arr[$i]['bet_win']			=	$rows['bet_win'];
		$cg_arr[$i]['bet_time']			=	date("m-d H:i:s",strtotime($rows['bet_time']));
		$cg_arr[$i]['balance']			=	$rows['balance'];
		$cg_arr[$i]['assets']			=	$rows['assets'];
		$gid .= $rows['gid'].',';
		$i++;
	}
	if($gid){
		$cg_zx		=	array();
		$gid		=	rtrim($gid,',');
		$sql		=	"select match_name,bet_info,master_guest,gid,bid from k_bet_cg where gid in ($gid) order by gid asc";
		$query		=	$mysqli->query($sql);
		while($rows	=	$query->fetch_array()){
			$cg_zx[$rows['gid']][$rows['bid']]['match_name']	=	$rows['match_name'];
			$cg_zx[$rows['gid']][$rows['bid']]['bet_info']		=	$rows['bet_info'];
			$cg_zx[$rows['gid']][$rows['bid']]['master_guest']	=	$rows['master_guest'];
			$cg_zx[$rows['gid']][$rows['bid']]['match_time']	=	$rows['match_time'];
		}
		$arr_z		=	array();
		foreach($cg_arr as $k=>$arr){
			$arr_z	=	$cg_zx[$arr['gid']];
			$str	=	'';
			$num	=	0;
			foreach($arr_z as $bid=>$rows){
				$m		=	explode('-',$rows["bet_info"]);
				$str	.=	$m[0];
				if(mb_strpos($rows["bet_info"]," - ")){
					$m[2]=	$m[2].preg_replace('[\[(.*)\]]', '',$m[3]);
				} 
				$m[2]	=	@preg_replace('[\[(.*)\]]','',$m[2].$m[3]);
				unset($m[3]);
				//如果是波胆
				if(mb_strpos($m[0],"胆")){
					$bodan_score	=	explode("@",$m[1],2);
					$score			=	$bodan_score[0];
					$m[1]			=	"波胆@".$bodan_score[1];
				}
				$str				.=	"&nbsp;".$rows["match_name"]."<br />";
				//正则匹配
				$m_count			=	count($m);
				preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
				if(strpos($rows["master_guest"],'VS.')) $team=explode('VS.',$rows["master_guest"]);
				else $team			=	explode('VS',$rows["master_guest"]);
				if(count($matches)>0) $str	.=	@$rows['match_time'].$matches[0]."<br/>";
				if(mb_strpos($m[1],"让")>0) { //让球
					if(mb_strpos($m[1],"主")===false) { //客让
						$str		.=	$team[1].str_replace(array("主让","客让"),array("",""),$m[1]).$team[0].'(主)';
					}else{ //主让
						$str		.=	$team[0].str_replace(array("主让","客让"),array("",""),$m[1]).$team[1];
					}
					$m[1]			=	"";
				}else{
					$str			.=	$team[0];
					if(isset($score)){
						$str		.=	$score;
					}else{
						$str		.=	'VS.';
					}
					$str			.=	$team[1];
				}
				$str				.=	"<br /><font style=\"color:#FF0033\">";
				if($m_count==3) $str.=	$m[1];
				//半全场替换显示
				$arraynew			=	array($team[0]," / ",$team[1],"和局");
				$arrayold			=	array("主","/","客","和");
				$str				.=	str_replace($arrayold,$arraynew,preg_replace('[\((.*)\)]', '',$m[$m_count-1]))."<br/></font>";
				if($num < count($cg_zx[$arr['gid']])-1){
					$str			.=	 '<hr style="height:1px; color:#96B698" />';
				}
				$num++;
			}
			$cg_arr[$k]['zx']		=	$str;
		}
	}
	$json['cg']	=	$cg_arr ? $cg_arr : 'none';
}

echo $callback."(".json_encode($json).");";
exit;
?>