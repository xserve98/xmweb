<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("auto_class24.php");
include_once("../../../cache/hlhy.php");
$hl=implode(',',array_keys($hlhy));
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");	
include ("js_251.php");
sleep(2);
//获取开奖号码
if($_REQUEST['ac']=='re'){
	$qi 		= is_numeric($_REQUEST['qi']) ? $_REQUEST['qi'] : 0;
	$sql		= "select * from c_auto_25 where qishu=".$qi." order by id desc limit 1";
}else{
	$sql		= "select * from c_auto_25 where ok=0";
}

$sql1		= "select * from c_bet where type='百人牛牛' and js=0 and  and uid not in ($hl) order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;

$time1=get_total_millisecond();
if( $web_site['niuniu']==1&&$sum>0){

$query		= $mysqli->query($sql1);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
$hm[]		= $rs['ball_4'];
$hm[]		= $rs['ball_5'];
$k=0;
$time1 =get_total_millisecond();
	$arr=array();
	$sz=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51);
while(true){
 shuffle($sz);
	 $ball_1=$sz[0].','.$sz[1].','.$sz[2].','.$sz[3].','.$sz[4];
	 $ball_2=$sz[5].','.$sz[6].','.$sz[7].','.$sz[8].','.$sz[9];
	 $ball_3=$sz[10].','.$sz[11].','.$sz[12].','.$sz[13].','.$sz[14];
	 $ball_4=$sz[15].','.$sz[16].','.$sz[17].','.$sz[18].','.$sz[19];
	 $ball_5=$sz[20].','.$sz[21].','.$sz[22].','.$sz[23].','.$sz[24];
$zhm	= niuniu($ball_1);
$thm	= niuniu($ball_2);
$dhm	= niuniu($ball_3);
$xhm	= niuniu($ball_4);
$hhm	= niuniu($ball_5);
$zarr=explode('-',$zhm);
$tarr=explode('-',$thm);
$darr=explode('-',$dhm);
$xarr=explode('-',$xhm);
$harr=explode('-',$hhm);
   $jsarr=getyk($qi,$zarr,$tarr,$darr,$xarr,$harr);
   
	$num=intval($jsarr[0])-intval($jsarr[1]);
	
    $time2 =get_total_millisecond();
	$timec=$time2-$time1;
$arr=array($zarr,$tarr,$darr,$xarr,$harr);
$arr2=array( $ball_1, $ball_2, $ball_3, $ball_4, $ball_5);




	if($num<0){
		
		 break;
		}
		
	
	if($timec>10000){
		 break;
		}


	$k++;

	}
	
		$sql2 =	"update c_auto_25 set ball_1 = '$ball_1',ball_2 = '$ball_2',ball_3 = '$ball_3',ball_4 = '$ball_4',ball_5 = '$ball_5' where qishu=".$qi."";
	$mysqli->query($sql2) or die ($sql2);
	
	
}

}








$query		= $mysqli->query($sql);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm 		= array();
$zhm	= niuniu($rs['ball_1']);
$thm	= niuniu($rs['ball_2']);
$dhm	= niuniu($rs['ball_3']);
$xhm	= niuniu($rs['ball_4']);
$hhm	= niuniu($rs['ball_5']);
$zarr=explode('-',$zhm);
$tarr=explode('-',$thm);
$darr=explode('-',$dhm);
$xarr=explode('-',$xhm);
$harr=explode('-',$hhm);

//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='百人牛牛' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	

if($rows['mingxi_2']=='天'){
		if(intval($tarr[0])>intval($zarr[0])||intval($tarr[0])==intval($zarr[0])&&intval($tarr[0])<13&&intval($tarr[1])>intval($zarr[1])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("01注单修失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			$money =getzjpeilv(intval($tarr[0]))*$rows['money'];
			$money2 =getzjpeilv(intval($tarr[0]))*$rows['money']+$rows['dbje'];
		
			if($q1==1){
				
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖赢'.$money;
	$about2   = '担保金解冻'.$rows['dbje'];

	$order = $rows['did'];
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']+$money;
	$assets3	 =	$assets2+$rows['dbje'];
	$money_type =300;
	$money_type2 =600;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	
$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$rows['dbje'].",1,'$order','$about','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	
	/////
            $msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
			
			$msql="update c_bet set win=".$money.",js=1 where id=".$rows['id']."";
			
			$mysqli->query($msql);
			}
			

			
			
		}
			
 else{
           $money =(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	       $money2 =$rows['dbje']-(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];   
		   $money3 =getxjpeilv(intval($zarr[0]))*$rows['money'];		
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖输'.(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	$about2   = '百人牛牛开担保金解冻剩余'.$rows['dbje'].'合计:'.$money2;

	$order = $rows['did'];
	
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']-$money;
	$assets3	 =	$assets2+$money2;
	$money_type =300;
	$money_type2 =600;
	if($money>0){
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".(0-$money).",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	}
	
	$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".($money2).",1,'$order','$about2','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	/////
		   
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-".$money3.",js=1 where id=".$rows['id']."";
			$mysqli->query($msql);
			$msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
		}
	$tmingcheng=mingcheng(intval($tarr[0]));$zmingcheng=mingcheng(intval($zarr[0]));
	$jieguo ='庄：'.$zmingcheng.'--'.'天：'.$tmingcheng;
	
		  //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$jieguo."' where id=".$rows['id']."";
	
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
	}
	////////////////////

	
	
if($rows['mingxi_2']=='地'){
	
		if(intval($darr[0])>intval($zarr[0])||intval($darr[0])==intval($zarr[0])&&intval($darr[0])<13&&intval($darr[1])>intval($zarr[1])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("01注单修失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			$money =getzjpeilv(intval($darr[0]))*$rows['money'];
			$money2 =getzjpeilv(intval($darr[0]))*$rows['money']+$rows['dbje'];
		
			if($q1==1){
				
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖赢'.$money;
	$about2   = '担保金解冻'.$rows['dbje'];

	$order = $rows['did'];
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']+$money;
	$assets3	 =	$assets2+$rows['dbje'];
	$money_type =300;
	$money_type2 =600;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	
$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$rows['dbje'].",1,'$order','$about','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	
	/////
            $msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
			$msql="update c_bet set win=".$money.",js=1 where id=".$rows['id']."";
					
			$mysqli->query($msql);
			}
			

			
			
		}
			
 else{
           $money =(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	       $money2 =$rows['dbje']-(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];   
		   $money3 =getxjpeilv(intval($zarr[0]))*$rows['money'];		
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖输'.(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	$about2   = '百人牛牛开担保金解冻剩余'.$rows['dbje'].'合计:'.$money2;

	$order = $rows['did'];
	
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']-$money;
	$assets3	 =	$assets2+$money2;
	$money_type =300;
	$money_type2 =600;
	if($money>0){
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".(0-$money).",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	}
	
	$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".($money2).",1,'$order','$about2','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	/////
		   
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-".$money3.",js=1 where id=".$rows['id']."";
			$mysqli->query($msql);
			$msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
		}
	$tmingcheng=mingcheng(intval($darr[0]));$zmingcheng=mingcheng(intval($zarr[0]));
	$jieguo ='庄：'.$zmingcheng.'--'.'地：'.$tmingcheng;
	
		  //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$jieguo."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
	}
	////////////////////

	
if($rows['mingxi_2']=='玄'){
	
		if(intval($xarr[0])>intval($zarr[0])||intval($xarr[0])==intval($zarr[0])&&intval($xarr[0])<13&&intval($xarr[1])>intval($zarr[1])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("01注单修失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			$money =getzjpeilv(intval($xarr[0]))*$rows['money'];
			$money2 =getzjpeilv(intval($xarr[0]))*$rows['money']+$rows['dbje'];
		
			if($q1==1){
				
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖赢'.$money;
	$about2   = '担保金解冻'.$rows['dbje'];

	$order = $rows['did'];
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']+$money;
	$assets3	 =	$assets2+$rows['dbje'];
	$money_type =300;
	$money_type2 =600;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	
$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$rows['dbje'].",1,'$order','$about','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	
	/////
            $msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
			$msql="update c_bet set win=".$money.",js=1 where id=".$rows['id']."";
					
			$mysqli->query($msql);
			}
			

			
			
		}
			
 else{
           $money =(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	       $money2 =$rows['dbje']-(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];   
		   $money3 =getxjpeilv(intval($zarr[0]))*$rows['money'];		
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖输'.(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	$about2   = '百人牛牛开担保金解冻剩余'.$rows['dbje'].'合计:'.$money2;

	$order = $rows['did'];
	
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']-$money;
	$assets3	 =	$assets2+$money2;
	$money_type =300;
	$money_type2 =600;
	if($money>0){
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".(0-$money).",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	}
	
	$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".($money2).",1,'$order','$about2','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	/////
		   
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-".$money3.",js=1 where id=".$rows['id']."";
			$mysqli->query($msql);
			$msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
		}
	$tmingcheng=mingcheng(intval($xarr[0]));$zmingcheng=mingcheng(intval($zarr[0]));
	$jieguo ='庄：'.$zmingcheng.'--'.'玄：'.$tmingcheng;
	
		  //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$jieguo."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
	}
	////////////////////

	
if($rows['mingxi_2']=='黄'){
	
		if(intval($harr[0])>intval($zarr[0])||intval($harr[0])==intval($zarr[0])&&intval($harr[0])<13&&intval($harr[1])>intval($zarr[1])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("01注单修失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			$money =getzjpeilv(intval($harr[0]))*$rows['money'];
			$money2 =getzjpeilv(intval($harr[0]))*$rows['money']+$rows['dbje'];
		
			if($q1==1){
				
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖赢'.$money;
	$about2   = '担保金解冻'.$rows['dbje'];

	$order = $rows['did'];
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']+$money;
	$assets3	 =	$assets2+$rows['dbje'];
	$money_type =300;
	$money_type2 =600;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	
$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$rows['dbje'].",1,'$order','$about','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	
	/////
            $msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
			$msql="update c_bet set win=".$money.",js=1 where id=".$rows['id']."";
					
			$mysqli->query($msql);
			}
			

			
			
		}
			
 else{
           $money =(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	       $money2 =$rows['dbje']-(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];   
		   $money3 =getxjpeilv(intval($zarr[0]))*$rows['money'];		
							////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$assets	 =	$row1['money'];
	///$assets=$assets+$allmoney-
	$about   = '百人牛牛开奖输'.(getxjpeilv(intval($zarr[0]))-1)*$rows['money'];
	$about2   = '百人牛牛开担保金解冻剩余'.$rows['dbje'].'合计:'.$money2;

	$order = $rows['did'];
	
	$assets	 =	$row1['money'];
	$assets2	 =	$row1['money']-$money;
	$assets3	 =	$assets2+$money2;
	$money_type =300;
	$money_type2 =600;
	if($money>0){
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".(0-$money).",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	}
	
	$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".($money2).",1,'$order','$about2','$assets2','$assets3',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2);
	/////
		   
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-".$money3.",js=1 where id=".$rows['id']."";
			$mysqli->query($msql);
			$msql="update k_user set money=money+".$money2.",dbje= dbje-".$rows['dbje']."  where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("02会员修改失败!!!".$money);
		}
	$tmingcheng=mingcheng(intval($harr[0]));$zmingcheng=mingcheng(intval($zarr[0]));
	$jieguo ='庄：'.$zmingcheng.'--'.'黄：'.$tmingcheng;
	
		  //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$jieguo."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
	}
	////////////////////

	
	
	
	


	//开始结算梭哈



}
$msql="update c_auto_25 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");

}

if ($_GET['t']==1)    {
	echo "<script>window.location.href='../../Lottery/auto_252.php';</script>";
}
if($_REQUEST['ac']=='re'){
	echo "OK";
	echo "<script>window.location.href='../../Lottery/Order.php?js=0';</script>";
}
?>