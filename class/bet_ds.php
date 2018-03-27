<?php
class bet_ds{
  	static function dx_add($uid,$ball_sort,$point_column,$match_name,$master_guest,$match_id,$bet_info,$bet_money,$bet_point,$ben_add,$bet_win,$match_time,$match_endtime,$lose_ok,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$match_type,$balance,$assets,$Match_HRedCard,$Match_GRedCard,$ksTime){
	
		global $mysqli,$web_site;
  		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			include("cache/conf.php");
			$sql	=	"insert into k_bet(uid,ball_sort,point_column,match_name,master_guest,match_id,bet_info,bet_money,bet_point,ben_add,bet_win,match_time,bet_time,match_endtime,lose_ok,match_showtype,match_rgg,match_dxgg,match_nowscore,match_type,balance,assets,Match_HRedCard,Match_GRedCard,www,match_coverdate) values ('$uid','$ball_sort','$point_column','$match_name','$master_guest','$match_id','$bet_info','$bet_money','$bet_point','$ben_add','$bet_win','$match_time',now(),'$match_endtime','$lose_ok','$match_showtype','$match_rgg','$match_dxgg','$match_nowscore','$match_type',$balance,$assets,$Match_HRedCard,$Match_GRedCard,'$conf_www','$ksTime')"; //新增一个投注项
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			$id 	=	$mysqli->insert_id;
			$datereg=	date("YmdHis").$id;
			$sql	=	"update `k_bet` set `number`='$datereg' where bid=$id"; //更新信息
			$mysqli->query($sql);
			$q2		=	$mysqli->affected_rows;
			$sql	=	"update k_user set money=money-$bet_money where money>=$bet_money and uid=$uid and $balance>=0"; //扣钱
			$mysqli->query($sql);
			$q3		=	$mysqli->affected_rows;
			
			$width	=	str_leng($ball_sort.'='.$match_name.'='.$master_guest.'='.$bet_info.$bet_money); //宽
			$height	=	26; //高
			$im		=	imagecreate($width,$height);
			$bkg	=	imagecolorallocate($im,255,255,255); //背景色
			$font	=	imagecolorallocate($im,150,182,151); //边框色
			$sort_c	=	imagecolorallocate($im,0,0,0); //字体色 
			$name_c	=	imagecolorallocate($im,243,118,5); //字体色 
			$guest_c=	imagecolorallocate($im,34,93,156); //字体色 
			$info_c	=	imagecolorallocate($im,51,102,0); //字体色 
			$money_c=	imagecolorallocate($im,255,0,0); //字体色 
			$fnt	=	"ttf/simhei.ttf";
			imagettftext($im,10,0,7,18,$sort_c,$fnt,$ball_sort); //赛事类型
			imagettftext($im,10,0,str_leng($ball_sort.'=='),18,$name_c,$fnt,$match_name); //联赛名称
			imagettftext($im,10,0,str_leng($ball_sort.$match_name.'==='),18,$guest_c,$fnt,$master_guest); //队伍名称
			imagettftext($im,10,0,str_leng($ball_sort.$match_name.$master_guest.'===='),18,$info_c,$fnt,$bet_info); //交易明细
			imagettftext($im,10,0,str_leng($ball_sort.$match_name.$master_guest.$bet_info.'==='),18,$money_c,$fnt,$bet_money); //交易金额
			imagerectangle($im,0,0,$width-1,$height-1,$font); //画边框
			
			if(!is_dir("other/".substr($datereg,0,8))) mkdir("other/".substr($datereg,0,8));
			$q4 = imagejpeg($im,"other/".substr($datereg,0,8)."/$datereg.jpg"); //生成图片
			imagedestroy($im);
			if($q1==1 && $q2==1 && $q3==1 && $q4){
				$mysqli->commit(); //事务提交
				include_once("class/user.php");
				$jifen=$web_site['jf_tzjf']*$bet_money;
				$about=$bet_info."<br>下注:$bet_money 元";
				$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_sort);
				return true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
  	}
}
?>