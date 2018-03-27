<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("auto_class24.php");
sleep(2);
//获取开奖号码
if($_REQUEST['ac']=='re'){
	$qi 		= is_numeric($_REQUEST['qi']) ? $_REQUEST['qi'] : 0;
	$sql		= "select * from c_auto_25 where qishu=".$qi." order by id desc limit 1";
}else{
	$sql		= "select * from c_auto_25 where ok=0";
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
}
?>