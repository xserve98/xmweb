<?php
session_start();

if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])){
	echo "<script type=\"text/javascript\" language=\"javascript\">window.location.href='/left.php';</script>";
	exit();
}

include_once("include/config.php");
include_once("include/mysqli.php");
include_once("include/mysqlis.php");
include_once("common/logintu.php");
include_once("common/function.php");
//这里要进行时间判断
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
//checkuserlogin($uid);
renovate($uid,$loginid,false); 		//验证是否登陆
//ini_set('display_errors','yes');
if($_SESSION["check_action"] !== 'true'){ //用户用软件打水
	//踢线，停用账户，记录本次非法操作记录！
	/*$sql = "update k_user_login set `is_login`=0 where uid='$uid'"; //踢线
	$mysqli->query($sql);
	$why = "会员ID：".$_SESSION["uid"]."，账户名：".$_SESSION["username"]."在 ".date("Y-m-d H:i:s")." 非法访问注单下注页（bet.php）。投注信息：".$_POST["ball_sort"][0]." ".$_POST['touzhuxiang'][0]."，投注金额：".$_POST["bet_money"][0];
	$sql = "UPDATE k_user set is_stop=1,why=concat_ws('，',why,'$why') where uid='$uid'"; //停用账户
	$mysqli->query($sql);
	unset($_SESSION["uid"],$_SESSION["gid"],$_SESSION["username"]);
	session_destroy();
	go("非法操作，您的账户已被冻结！<br/>如有疑问，请联系在线客服！");*/
}

function str_leng($str){ //取字符串长度
	mb_internal_encoding("UTF-8");
	return mb_strlen($str)*12;
}

function check_point($ballsort,$column,$match_id,$point,$rgg,$dxgg,$tid=0,$index=0){ 

	$pk = array("Match_Ho","Match_Ao","Match_DxDpl","Match_DxXpl","Match_BHo","Match_BAo","Match_Bdpl","Match_Bxpl"); //让球大小盘口
	$t  = array(array("cn"=>"足球波胆","db_table"=>"bet_match"),
	array("cn"=>"足球单式","db_table"=>"bet_match"),
	array("cn"=>"足球上半场","db_table"=>"bet_match"),
	array("cn"=>"足球早餐","db_table"=>"bet_match"),
	array("cn"=>"足球滚球","db_table"=>"zqgq_match"),
	array("cn"=>"篮球单式","db_table"=>"lq_match"),
	array("cn"=>"篮球单节","db_table"=>"lq_match"),
	array("cn"=>"篮球滚球","db_table"=>"lqgq_match"),
	array("cn"=>"篮球早餐","db_table"=>"lq_match"),
	array("cn"=>"排球单式","db_table"=>"volleyball_match"),
	array("cn"=>"网球单式","db_table"=>"tennis_match"),
	array("cn"=>"棒球单式","db_table"=>"baseball_match"),
	array("cn"=>"冠军","db_table"=>"t_guanjun_team"),
	array("cn"=>"金融","db_table"=>"t_guanjun_team"));
	foreach ($t as $m){
   		if($m['cn']==$ballsort){    
   	  		$db_table=$m['db_table'];
   		}
    }
	//把水位和让球与大小盘口设为字符串形式，以便下面绝对判断
	$rgg		=	"".$rgg;
	$dxgg		=	"".$dxgg;
	$point		=	"".$point;
   	if($db_table=="zqgq_match" || $db_table=="lqgq_match"){ //足球滚球、篮球滚球不验证数据库，直接验证缓存文件
		if($db_table == "zqgq_match"){
			include_once("include/function_cj1.php");
			if(zqgq_cj()){ //不管怎样，重新采集一次
				include("cache/zqgq.php"); //重新载入
			}else{
				go("网络异常,交易失败");
			}
			for($i=0; $i<count($zqgq);$i++){
				if(@$zqgq[$i]['Match_ID'] == $match_id) break;
			}
			if($zqgq[$i][$column] < 0.01){
				go("盘口已关闭,交易失败");
			}
			if($zqgq[$i][$column] === $point){
				if(in_array($column,$pk)){ //盘口
					if(($column=="Match_Ho" || $column=="Match_Ao") && $zqgq[$i]["Match_RGG"] !== $rgg){ //全场让球盘口改已变
						if($zqgq[$i]["Match_RGG"] == ''){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$zqgq[$i]["Match_RGG"],$point,$zqgq[$i]["Match_RGG"],$zqgq[$i]["Match_DxGG"]);
						}
					}elseif(($column=="Match_BHo" || $column=="Match_BAo") && $zqgq[$i]["Match_BRpk"] !== $rgg){ //上半场让球盘口改已变
						if($zqgq[$i]["Match_BRpk"] == ''){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$zqgq[$i]["Match_BRpk"],$point,$zqgq[$i]["Match_BRpk"],$zqgq[$i]["Match_Bdxpk"]);
						}
					}elseif(($column=="Match_DxDpl" || $column=="Match_DxXpl") && $zqgq[$i]["Match_DxGG"] !== $dxgg){ //全场大小盘口改已变
						if($zqgq[$i]["Match_DxGG"] == ''){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$zqgq[$i]["Match_DxGG"],$point,$zqgq[$i]["Match_RGG"],$zqgq[$i]["Match_DxGG"]);
						}
					}elseif(($column=="Match_Bdpl" || $column=="Match_Bxpl") && $zqgq[$i]["Match_Bdxpk"] !== $dxgg){ //上半场大小盘口改已变
						if($zqgq[$i]["Match_Bdxpk"] == ''){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$zqgq[$i]["Match_Bdxpk"],$point,$zqgq[$i]["Match_BRpk"],$zqgq[$i]["Match_Bdxpk"]);
						}
					}
				}
				return  true;
			}else{//水位变动
				confirm('水位',$zqgq[$i][$column],$zqgq[$i][$column],$rgg,$dxgg);
			}
		}else{
			include_once("include/function_cj1.php");
			if(lqgq_cj()){ //重新采集一次，保证是最新的
				include("cache/lqgq.php"); //重新载入
			}else{
				go("网络异常,交易失败");
			}
			for($i=0; $i<count($lqgq);$i++){
				if(@$lqgq[$i]['Match_ID'] == $match_id) break;
			}
			if($lqgq[$i][$column] < 0.01){
				go("盘口已关闭,交易失败");
			}
			if($lqgq[$i][$column] === $point){
				if(in_array($column,$pk)){ //盘口
					if(($column=="Match_Ho" || $column=="Match_Ao") && $lqgq[$i]["Match_RGG"] !== $rgg){ //全场让球盘口改已变
						if($lqgq[$i]["Match_RGG"] == '' || $lqgq[$i]["Match_RGG"] == 0){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$lqgq[$i]["Match_RGG"],$point,$lqgq[$i]["Match_RGG"],$lqgq[$i]["Match_DxGG"]);
						}
					}elseif(($column=="Match_DxDpl" || $column=="Match_DxXpl") && $lqgq[$i]["Match_DxGG"] !== $dxgg){ //全场大小盘口改已变
						if($lqgq[$i]["Match_DxGG"] == '' || $lqgq[$i]["Match_DxGG"] == 0){
							go("盘口已关闭,交易失败");
						}else{
							confirm('盘口',$lqgq[$i]["Match_DxGG"],$point,$lqgq[$i]["Match_RGG"],$lqgq[$i]["Match_DxGG"]);
						}
					}
				}
				return  true;
			}else{//水位变动
				confirm('水位',$lqgq[$i][$column],$lqgq[$i][$column],$rgg,$dxgg);
			}
		}
	}else{
		global $mysqlis;
		if($db_table	==	"t_guanjun_team"){
			if($tid){
				$sql		=	"select t.point from t_guanjun_team t,t_guanjun g where t.tid=$tid and t.xid=g.x_id and g.Match_CoverDate>now() limit 1"; //赛事未结束
				$query		=	$mysqlis->query($sql);
				$rs			=	$query->fetch_array();
				$newpoint	=	"".sprintf("%.2f",$rs["point"]);
				if($newpoint===$point){
					return  true;
				}else{   //水位变动
					if($newpoint == 0){
						go("盘口已关闭,交易失败");
					}else{
						confirm('水位',$newpoint,$newpoint);
					}
				}
			}
		}else{
			global	$touzhutype;
			$other		=	"";
			if($db_table == "bet_match") $other = ",Match_BRpk,Match_Bdxpk";
			$sql		=	"select Match_RGG,Match_DxGG,$column $other from $db_table where match_id=$match_id and Match_CoverDate>now() limit 1"; //赛事未结束
			$query		=	$mysqlis->query($sql);
			$rs			=	$query->fetch_array();
			$newpoint	=	"".sprintf("%.2f",$rs["$column"]);
			if($newpoint===$point){
				if(in_array($column,$pk)){ //盘口
					if(($column=="Match_Ho" || $column=="Match_Ao") && $rs["Match_RGG"] !== $rgg){ //全场让球盘口改已变
						if($touzhutype == 1){ //串关
							confirm_cg('盘口',$rs["Match_RGG"],$point,$rs["Match_RGG"],$rs["Match_DxGG"],$index);
						}else{ //单式
							confirm('盘口',$rs["Match_RGG"],$point,$rs["Match_RGG"],$rs["Match_DxGG"]);
						}
					}elseif(($column=="Match_DxDpl" || $column=="Match_DxXpl") && $rs["Match_DxGG"] !== $dxgg){ //全场大小盘口改已变
						if($touzhutype == 1){ //串关
							confirm_cg('盘口',$rs["Match_DxGG"],$point,$rs["Match_RGG"],$rs["Match_DxGG"],$index);
						}else{ //单式
							confirm('盘口',$rs["Match_DxGG"],$point,$rs["Match_RGG"],$rs["Match_DxGG"]);
						}
					}elseif(($column=="Match_BHo" || $column=="Match_BAo") && $rs["Match_BRpk"] !== $rgg){ //上半场让球盘口改已变
						if($touzhutype == 1){ //串关
							confirm_cg('盘口',$rs["Match_BRpk"],$point,$rs["Match_BRpk"],$rs["Match_Bdxpk"],$index);
						}else{ //单式
							confirm('盘口',$rs["Match_BRpk"],$point,$rs["Match_BRpk"],$rs["Match_Bdxpk"]);
						}
					}elseif(($column=="Match_Bdpl" || $column=="Match_Bxpl") && $rs["Match_Bdxpk"] !== $dxgg){ //上半场大小盘口改已变
						if($touzhutype == 1){ //串关
							confirm_cg('盘口',$rs["Match_Bdxpk"],$point,$rs["Match_BRpk"],$rs["Match_Bdxpk"],$index);
						}else{ //单式
							confirm('盘口',$rs["Match_Bdxpk"],$point,$rs["Match_BRpk"],$rs["Match_Bdxpk"]);
						}
					}
				}
				
				return  true;
			}else{   //水位变动
				if($newpoint == 0){
					go("盘口已关闭,交易失败");
				}else{
					if($touzhutype == 1){ //串关
						confirm_cg('水位',$newpoint,$newpoint,$rgg,$dxgg,$index);
					}else{ //单式
						confirm('水位',$newpoint,$newpoint,$rgg,$dxgg);
					}
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>万丰国际</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  </head>
<body>
<?php
$uid			=	$_SESSION["uid"];
$touzhutype		=	trim($_POST["touzhutype"]);
$bet_point		=	$_POST["bet_point"][0]*1;
$bet_money		=	trim($_POST["bet_money"]);
$point_column	=	$_POST["point_column"][0];
$arr_add		=	array('Match_Ho','Match_Ao','Match_DxDpl','Match_DxXpl','Match_BHo','Match_BAo','Match_Bdpl','Match_Bxpl','Match_DFzDpl','Match_DFzXpl','Match_DFkDpl','Match_DFkXpl');
$bet_win		=	$bet_money*$bet_point; //可赢金额=交易金额*当前水位
if(in_array($point_column,$arr_add)){ //让球，大小，半场让球，半场大小，可赢金额要加上本金
	$bet_win	+=	$bet_money;
}

echo '<font style="display:none">'.investSZ($uid).'</font>';

if(is_numeric($bet_money) && is_int($bet_money*1)){
	include_once("cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
	$bet_money	=	$bet_money*1;
	//会员余额
	$balance	=	0;
	$assets		=	0;
	$sql		= 	"SELECT money FROM k_user where uid=$uid limit 1";
	$query 		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	if($rs['money']){
		$assets	=	round($rs['money'],2);
		$balance=	$assets-$bet_money;
	}
	
	if($balance<0){ //投注后，用户余额不能小于0
		go("账户余额不足<br>交易失败");
	}
	if($bet_money<1){
		go("交易金额不能少于 1 RMB!");
	}
	/*
	if(investSZ($uid)>=1){
		go("操作频繁<br>交易失败");
	}*/

	if($touzhutype		==	0){ //单式
		$ball_sort		=	$_POST["ball_sort"][0];
		$column			=	$_POST["point_column"][0];
		$match_name		=	$_POST["match_name"][0];
		$master_guest	=	$_POST["master_guest"][0];
		$match_id		=	$_POST["match_id"][0];
		$tid			=	$_POST["tid"][0];
		$bet_info		=	$_POST["bet_info"][0];
		$touzhuxiang	=	$_POST['touzhuxiang'][0];
		$match_showtype	=	$_POST["match_showtype"][0];
		$match_rgg		=	$_POST["match_rgg"][0];
		$match_dxgg		=	$_POST["match_dxgg"][0];
		$match_nowscore	=	$_POST["match_nowscore"][0];
		$bet_point		=	$_POST["bet_point"][0];
		$match_type		=	$_POST["match_type"][0];
		$ben_add		=	$_POST["ben_add"][0];
		$match_time		=	$_POST["match_time"][0];
		$match_endtime	=	$_POST["match_endtime"][0];
		$Match_HRedCard	=	$Match_GRedCard	=	0;
		
		//限额判断
		if($ball_sort == "冠军" || $ball_sort == "金融"){
			$dz=@$dz_db["$ball_sort"];
			$dc=@$dc_db["$ball_sort"];
		}else{
			$dz=@$dz_db["$ball_sort"]["$touzhuxiang"];
			$dc=@$dc_db["$ball_sort"]["$touzhuxiang"];
		}
		if(!$dz || $dz=="") $dz=$dz_db['未定义'];
		if(!$dc || $dc=="") $dc=$dc_db['未定义'];
		
		if($bet_money>$dz){ //判断单场限额，判断原因：用软件来投注，才会有此问题
			go("交易金额多于系统限额");
		}
		//判断当天限额，判断原因：用软件来投注，才会有此问题
		$s_t	=	strftime("%Y-%m-%d",time())." 00:00:00";
		$e_t	=	strftime("%Y-%m-%d",time())." 23:59:59";
		$sql	=	"select sum(bet_money) as s from `k_bet` where match_id=$match_id and uid=$uid and bet_time>='$s_t' and bet_time<='$e_t' and `status` not in(3,8) limit 1"; //无效跟平手不当成投注
		$query 	=	$mysqli->query($sql);
		$rs		=	$query->fetch_array(); //取出单场总下注金额
		if(!$rs['s'] || $rs['s']=="null") $rs['s']=0;
		if(($rs['s']+$bet_money)>$dc){
			go("交易金额多于系统限额");
		}
		
		if(time()>strtotime($match_endtime) && !strpos($ball_sort,"滚球")){ //不是滚球，赛事已结束，无法投注
			go("赛事已结束<br>交易失败");
		}elseif(strpos($master_guest,'先開球') && time()+300>strtotime($match_endtime)){ //先開球提前 5 分钟关盘
			go("盘口已关闭<br>交易失败");
		}
		
		check_point($ball_sort,$column,$match_id,$bet_point,$match_rgg,$match_dxgg,$tid); //验证水位是否变动
		$ksTime = $_POST["match_endtime"][0]; //赛事开赛时间
		if($_POST["is_lose"]==1){ //走地需要确认
			$lose_ok=0; 
			if($ball_sort == "足球滚球"){ //足球滚球要记录红牌（赛事自动审核需要）
				$Match_HRedCard = $_POST["Match_HRedCard"][0];
				$Match_GRedCard = $_POST["Match_GRedCard"][0];
			}
		}else{ //不是滚球不需要确认
			$lose_ok=1; 
		}  
		if(!$match_type || $match_type=="") $match_type='1'; //为空统一为单式;(1：单式、2：滚球)
		
		$bet_info	=	write_bet_info($ball_sort,$column,$master_guest,$bet_point,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$tid);
		include_once("class/bet_ds.php");
		if(bet_ds::dx_add($uid,$ball_sort,strtolower($column),$match_name,$master_guest,$match_id,$bet_info,$bet_money,$bet_point,$ben_add,$bet_win,$match_time,$match_endtime,$lose_ok,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$match_type,$balance,$assets,$Match_HRedCard,$Match_GRedCard,$ksTime)){
			if($_POST["is_lose"]==1){
				go("交易确认中");
			}else{
				go("交易成功");
			}	 
		}else{
			go("交易失败1");
		}
	}else{
		//限额判断
		$dz		=	$dz_db["串关"];
		$dc		=	$dc_db["串关"];
		if(!$dz || $dz=="") $dz	=	$dz_db['未定义'];
		if(!$dc || $dc=="") $dc	=	$dc_db['未定义'];
		if($bet_money>$dz){ //目前只判断单场限额，判断原因：用软件来投注，才会有此问题
			go("交易金额多于系统限额");
		}
		//判断当天限额，判断原因：用软件来投注，才会有此问题
		$s_t	=	strftime("%Y-%m-%d",time())." 00:00:00";
		$e_t	=	strftime("%Y-%m-%d",time())." 23:59:59";
		$sql	=	"select sum(bet_money) as s from `k_bet_cg_group` where uid=".$_SESSION["uid"]." and bet_time>='$s_t' and bet_time<='$e_t' and `status`!=3"; //无效跟平手不当成投注
		$query 	=	$mysqli->query($sql);
		$rs		=	$query->fetch_array(); //取出串关当天总下注金额
		if(!$rs['s'] || $rs['s']=="null") $rs['s'] = 0;
		if(($rs['s']+$bet_money)>$dc){
			go("交易金额多于系统限额");
		}
		$width		=	0; //宽
		$name1		=	''; //保存联赛名称
		$guest1		=	''; //保存队伍名称
		$info1		=	''; //保存交易信息
		$bet_win	=	0; //可赢金额默认为0
		$point		=	1; //水位默认为1
		$ksTime		=	$_POST["match_endtime"][0]; //赛事开赛时间,默认取第一个的日期时间
		for($i=0;$i<count($_POST["match_id"]);$i++){
			check_point($_POST["ball_sort"][$i],$_POST["point_column"][$i],$_POST["match_id"][$i],$_POST["bet_point"][$i],$_POST["match_rgg"][$i],$_POST["match_dxgg"][$i],0,$i);
			$bet_point		=	$_POST["bet_point"][$i]*1;
			$point_column	=	$_POST["point_column"][$i];
			if(in_array($point_column,$arr_add)){ //让球，大小，半场让球，半场大小，可赢金额要加上本金
				$bet_point+=1;
			}
			if(str_leng($name1) < str_leng($_POST["match_name"][$i])) $name1		=	$_POST["match_name"][$i];
			if(str_leng($guest1) < str_leng($_POST["master_guest"][$i])) $guest1	=	$_POST["master_guest"][$i];
			if(str_leng($info1) < str_leng($_POST["bet_info"][$i])) $info1			=	$_POST["bet_info"][$i];
			if(strtotime($_POST["match_endtime"][$i]) > strtotime($ksTime)) $ksTime =	$_POST["match_endtime"][$i];
			$point *= $bet_point; //串关水位为相乘
		}
		$width		=	str_leng('====='.$name1.'='.$guest1.'='.$info1.$bet_money); //宽
		$height		=	20*$i; //高
		$im			=	imagecreate($width,$height);
		$bkg		=	imagecolorallocate($im,255,255,255); //背景色
		$font		=	imagecolorallocate($im,150,182,151); //边框色
		$sort_c		=	imagecolorallocate($im,0,0,0); //字体色 
		$name_c		=	imagecolorallocate($im,243,118,5); //字体色 
		$guest_c	=	imagecolorallocate($im,34,93,156); //字体色 
		$info_c		=	imagecolorallocate($im,51,102,0); //字体色
		$money_c	=	imagecolorallocate($im,255,0,0); //字体色 
		$fnt		=	"ttf/simhei.ttf";
			
		$cg_count	=	count($_POST["match_name"]); //串关条数
		$bet_win	=	$point*$bet_money; //可赢金额=交易金额*水位
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			include("cache/conf.php");
			$sql	=	"insert into k_bet_cg_group(uid,cg_count,bet_money,bet_win,balance,assets,www,match_coverdate) values('$uid','$cg_count','$bet_money','$bet_win',$balance,$assets,'$conf_www','$ksTime')"; //添加投注
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			$gid 	=	$mysqli->insert_id;
			$sql	=	"insert into k_bet_cg(uid,gid,ball_sort,point_column,match_name,master_guest,match_id,bet_info,bet_money,bet_point,ben_add,match_endtime,match_showtype,match_rgg,match_dxgg,match_nowscore) values";
			for($i=0;$i<$cg_count;$i++){
				$ball_sort		=	$_POST["ball_sort"][$i];
				$column			=	$_POST["point_column"][$i];
				$match_name		=	$_POST["match_name"][$i];
				$master_guest	=	$_POST["master_guest"][$i];
				$match_id		=	$_POST["match_id"][$i];
				$bet_info		=	$_POST["bet_info"][$i];
				$bet_money		=	$_POST["bet_money"];
				$bet_point		=	$_POST["bet_point"][$i];
				$ben_add		=	$_POST["ben_add"][$i];
				$match_showtype	=	$_POST["match_showtype"][$i];
				$match_rgg		=	$_POST["match_rgg"][$i];
				$match_dxgg		=	$_POST["match_dxgg"][$i];
				$match_nowscore	=	$_POST["match_nowscore"][$i];
				$match_endtime	=	$_POST["match_endtime"][$i];
				
				$bet_info		=	write_bet_info($ball_sort,$column,$master_guest,$bet_point,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$tid);
				$sql		   .=	"('$uid','$gid','$ball_sort','".strtolower($column)."','$match_name','$master_guest','$match_id','$bet_info','$bet_money','$bet_point','$ben_add','$match_endtime','$match_showtype','$match_rgg','$match_dxgg','$match_nowscore'),";
				
				imagettftext($im,10,0,7,18*($i+1),$sort_c,$fnt,$ball_sort); //赛事类型
				imagettftext($im,10,0,str_leng('======'),18*($i+1),$name_c,$fnt,$match_name); //联赛名称
				imagettftext($im,10,0,str_leng('======='.$name1),18*($i+1),$guest_c,$fnt,$master_guest); //队伍名称
				imagettftext($im,10,0,str_leng('========'.$name1.$guest1),18*($i+1),$info_c,$fnt,$bet_info); //交易明细
				imagettftext($im,10,0,str_leng('======='.$name1.$guest1.$info1),18*($i+1),$money_c,$fnt,$bet_money); //交易金额
			}
			$sql				=	rtrim($sql,",");
			$mysqli->query($sql);
			$q2					=	$mysqli->affected_rows;
			$sql				=	"update k_user set money=money-$bet_money where uid=$uid and money>=$bet_money and $balance>=0"; //扣钱
			$mysqli->query($sql);
			$q3					=	$mysqli->affected_rows;
			
			imagerectangle($im,0,0,$width-1,$height-1,$font); //画边框
			$datereg	=	date('Ymd');
			if(!is_dir("other/$datereg")) mkdir("other/$datereg");
			$q4 = imagejpeg($im,"other/$datereg/$gid.jpg"); //生成图片
			imagedestroy($im);
			if($q1==1 && $q2==$i && $q3==1 && $q4){
				$mysqli->commit(); //事务提交
				go("交易成功");
			}else{
				$mysqli->rollback(); //数据回滚
				go("交易失败");
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			go("交易失败");
		}
	}
}else{
	go("交易金额有误<br>交易失败");
}

function go($msg){
	$_SESSION["check_action"]=''; //检测用户是否用软件打水标识
?>
<div class="well text-center bg-success">
	<h3 class="text-danger"><?=$msg?></h3>
	2秒后自动关闭交易页 <i class="fa fa-close"></i>
</div>
<script language="javascript">
<!--
if(self==top){
	top.location='/index.php';
}
$('#s_betiframe',parent.document).height($('body').height());
function gobetiframe(){
	$('#s_betiframe',parent.document).height(0);
	window.location.href="/betiframe.php";
}
$(document).ready(function() {
	$('.well').focus();
	$('#s_betiframe',parent.window).focus();
	setTimeout(function(){$('.well').fadeOut();gobetiframe();},2000);
});
-->
</script>
</body>
</html>
<?php
exit();
}

function confirm($msg,$type,$pl,$rgg=0,$dxgg=0){
?>
<form id="form1" name="form1" method="post" action="bet.php" style="margin:0 0 0 0;" onsubmit="javascript:document.getElementById('submit').disabled=true;">
<div class="panel panel-danger">
	<div class="panel-heading">
	  <h3 class="panel-title">当前<?=$msg?>已改变</h3>
	</div>
	<div class="panel-body">
		<h3>最新<?=$msg?>：<span style="color:#FF0000;"><?=$type?></span></h3>
		<p class="bg-danger">是否继续交易？</p>
		<input type="hidden" name="bet_money" value="<?=$_POST["bet_money"]?>" />
		<input type="hidden" name="touzhutype" value="0" />
		<input type="hidden" name="ball_sort[]" value="<?=$_POST["ball_sort"][0]?>" />
		<input type="hidden" name="point_column[]" value="<?=$_POST["point_column"][0]?>" />
		<input type="hidden" name="match_id[]" value="<?=$_POST["match_id"][0]?>" />
		<input type="hidden" name="match_name[]" value="<?=$_POST["match_name"][0]?>"  />
		<input type="hidden" name="match_showtype[]" value="<?=$_POST["match_showtype"][0]?>"  />
		<input type="hidden" name="match_rgg[]" value="<?=$rgg?>" />
		<input type="hidden" name="match_dxgg[]" value="<?=$dxgg?>" />
		<input type="hidden" name="match_nowscore[]"  value="<?=$_POST["match_nowscore"][0]?>"  />
		<input type="hidden" name="match_type[]"  value="<?=$_POST["match_type"][0]?>"  />
		<input type="hidden" name="touzhuxiang[]" value="<?=$_POST["touzhuxiang"][0]?>" />
		<input type="hidden" name="master_guest[]"  value="<?=$_POST["master_guest"][0]?>"/>
		<input type="hidden" name="bet_info[]" value="<?=$_POST["bet_info"][0]?>"/> 
		<input type="hidden" name="bet_point[]" value="<?=$pl?>"/>
		<input type="hidden" name="match_time[]"  value="<?=$_POST["match_time"][0]?>"/>
		<input type="hidden" name="ben_add[]" value="<?=$_POST["ben_add"][0]?>"/>
		<input type="hidden" name="match_endtime[]"  value="<?=$_POST["match_endtime"][0]?>"/>
		<input type="hidden" name="Match_HRedCard[]"  value="<?=$_POST["Match_HRedCard"][0]?>"/>
		<input type="hidden" name="Match_GRedCard[]"  value="<?=$_POST["Match_GRedCard"][0]?>"/>
		<input type="hidden" name="is_lose"  value="<?=$_POST["is_lose"][0]?>"/>
		<input type="hidden" name="tid"  value="<?=$_POST["tid"][0]?>"/>
	</div>
	<div class="panel-footer">
		<div class="col-xs-6"><input type="button" name="Submit2" class="btn btn-warning btn-block" value="取消交易" onclick="gobetiframe();" /></div>
		<div class="col-xs-6"><input type="submit" name="submit" id="submit" class="btn btn-success btn-block" value="继续交易" /></div>
	</div>
</div>
</form>
<script language="javascript">
<!--
if(self==top){
	top.location='/index.php';
}
$('#s_betiframe',parent.document).height($('body').height());
function gobetiframe(){
	$('#s_betiframe',parent.document).height(0);
	window.location.href="/betiframe.php";
}
$(document).ready(function() {
	$('.btn-warning').focus();
	setTimeout(function(){
		gobetiframe();
	},5000);
});

//window.setInterval("goleft()",5000); //5秒未点击，自动退到left.php页面
-->
</script>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
	</html>
<?php
	exit();
}

function confirm_cg($msg,$type,$pl,$rgg=0,$dxgg=0,$index){
	$g_arr	=	explode('VS.',$_POST["master_guest"][$index]);
?>
<form id="form1" name="form1" method="post" action="bet.php" onsubmit="javascript:document.getElementById('submit').disabled=true;">
<div class="panel panel-danger">
	<div class="panel-heading">
	  <h3 class="panel-title"><?=$_POST["match_name"][$index]?></h3>
	</div>
	<div class="panel-body">
		<p><?=$g_arr[0]?> <span style="color:#FF0000;">VS.</span> <span style="color:#890209;"><?=$g_arr[1]?></span></p>
	  	<h3>当前<?=$msg?>已改变</h3>
	  	<p>最新<?=$msg?>：<span style="color:#FF0000;"><?=$type?></span></p>
	  	<p class="bg-danger">是否继续交易？</p>
	  	<input type="hidden" name="bet_money" value="<?=$_POST["bet_money"]?>" />
		<input type="hidden" name="touzhutype" value="1" />
<?php
$sum	=	count($_POST["match_id"]);
for($i=0;$i<$sum;$i++){
	if($i == $index){
		$_POST["match_rgg"][$i]		=	$rgg;
		$_POST["match_dxgg"][$i]	=	$dxgg;
		$_POST["bet_point"][$i]		=	$pl;
	}
?>
		<input type="hidden" name="ball_sort[]" value="<?=$_POST["ball_sort"][$i]?>" />
		<input type="hidden" name="point_column[]" value="<?=$_POST["point_column"][$i]?>" />
		<input type="hidden" name="match_id[]" value="<?=$_POST["match_id"][$i]?>" />
		<input type="hidden" name="match_name[]" value="<?=$_POST["match_name"][$i]?>"  />
		<input type="hidden" name="match_showtype[]" value="<?=$_POST["match_showtype"][$i]?>"  />
		<input type="hidden" name="match_rgg[]" value="<?=$_POST["match_rgg"][$i]?>" />
		<input type="hidden" name="match_dxgg[]" value="<?=$_POST["match_dxgg"][$i]?>" />
		<input type="hidden" name="match_nowscore[]"  value="<?=$_POST["match_nowscore"][$i]?>"  />
		<input type="hidden" name="match_type[]"  value="<?=$_POST["match_type"][$i]?>"  />
		<input type="hidden" name="master_guest[]"  value="<?=$_POST["master_guest"][$i]?>"/>
		<input type="hidden" name="bet_info[]" value="<?=$_POST["bet_info"][$i]?>"/> 
		<input type="hidden" name="bet_point[]" value="<?=$_POST["bet_point"][$i]?>"/>
		<input type="hidden" name="match_time[]"  value="<?=$_POST["match_time"][$i]?>"/>
		<input type="hidden" name="ben_add[]" value="<?=$_POST["ben_add"][$i]?>"/>
		<input type="hidden" name="match_endtime[]"  value="<?=$_POST["match_endtime"][$i]?>"/>
		<input type="hidden" name="is_lose"  value="<?=$_POST["is_lose"][$i]?>"/>
<?php
}
?>
	</div>
	<div class="panel-footer">
		<div class="col-xs-6">
			<input type="button" name="Submit2" class="btn btn-warning btn-block" value="取消交易" onclick="gobetiframe();" />
		</div>
		<div class="col-xs-6">
			<input type="submit" name="submit" id="submit" class="btn btn-success btn-block" value="继续交易" />
		</div>
	</div>
</div>
</form>
<script language="javascript">
<!--
if(self==top){
	top.location='/index.php';
}
$('#s_betiframe',parent.document).height($('body').height());
function gobetiframe(){
	$('#s_betiframe',parent.document).height(0);
	window.location.href="/betiframe.php";
}
$(document).ready(function() {
	$('.btn-warning').focus();
	setTimeout(function(){
		gobetiframe();
	},5000);
});
-->
</script>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
	</html>
<?php
	exit();
}
?>