<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("auto_class5.php");
sleep(2);
//获取开奖号码
//获取开奖号码
if($_REQUEST['ac']=='re'){
	$qi 		= is_numeric($_REQUEST['qi']) ? $_REQUEST['qi'] : 0;
	$sql		= "select * from c_auto_23 where qishu=".$qi." order by id desc limit 1";
}else{
	$sql		= "select * from c_auto_23 where ok=0";
}
$query		= $mysqli->query($sql);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
$hm[]		= $rs['ball_4'];
$hm[]		= $rs['ball_5'];
//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='新加坡28' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	//开始结算第一球
	if($rows['mingxi_1']=='特码'){
		if($rows['mingxi_2']==$rs['ball_4']){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖'.$rows['win'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['win'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第二球
	if($rows['mingxi_1']=='混合玩法'){
		$win=0;
		if(($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小') && Ssc_Auto($hm,2)==$rows['mingxi_2']){$win=1;}
		if(($rows['mingxi_2']=='单' || $rows['mingxi_2']=='双') && Ssc_Auto($hm,3)==$rows['mingxi_2']){$win=1;}
		if(($rows['mingxi_2']=='大双' || $rows['mingxi_2']=='大单' || $rows['mingxi_2']=='小双' || $rows['mingxi_2']=='小单') && Ssc_Auto($hm,4)==$rows['mingxi_2']){$win=1;}
		if(($rows['mingxi_2']=='极大' || $rows['mingxi_2']=='极小') && Ssc_Auto($hm,5)==$rows['mingxi_2']){$win=1;}
		
		if(($rows['mingxi_2']=='小' || $rows['mingxi_2']=='单') && ($rs['ball_4']==13)){
			$sql2		= "select SUM(money) as num from c_bet where type='新加坡28' and mingxi_2='".$rows['mingxi_2']."' and qishu=".$qi." and uid=".$rows['uid'];
			$query2		= $mysqli->query($sql2);
			$rs2 = $query2->fetch_array();
			if($rs2['num']>1000) $win=2;
		}			
		if(($rows['mingxi_2']=='大' || $rows['mingxi_2']=='双') && ($rs['ball_4']==14)){
			$sql2		= "select SUM(money) as num from c_bet where type='新加坡28' and mingxi_2='".$rows['mingxi_2']."' and qishu=".$qi." and uid=".$rows['uid'];
			$query2		= $mysqli->query($sql2);
			$rs2 = $query2->fetch_array();
			if($rs2['num']>1000) $win=2;
		}
		if(($rows['mingxi_2']=='大双') && ($rs['ball_4']==14)){
			$win=2;
		}
		if(($rows['mingxi_2']=='小单') && ($rs['ball_4']==13)){
			$win=2;
		}
		if($win==1){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖'.$rows['win'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['win'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}elseif($win==2){//返还本金
			$msql="update c_bet set win=money,js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['money'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖返回本金'.$rows['money'];
	$order = $rows['did'];
    $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['money'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第三球
	if($rows['mingxi_1']=='波色'){
		if(Ssc_Auto($hm,6)==$rows['mingxi_2']){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖'.$rows['win'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['win'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第四球
	if($rows['mingxi_1']=='豹子'){
		if(Ssc_Auto($hm,7)==$rows['mingxi_2']){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖'.$rows['win'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['win'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算总和大小
	if($rows['mingxi_1']=='特码三压一'){
		if(strpos($rows['mingxi_2'],$rs['ball_4'].",")!==false){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
					
				////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '新加坡28开奖派奖'.$rows['win'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['win'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
        //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$rs['ball_4']."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);

}
$msql="update c_auto_23 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
//防漏单处理
$sql_l = "select qishu from c_bet where type='新加坡28'  and js=0 and qishu=".$qi."";
$query_l = $mysqli->query($sql_l);
$sum_l = $mysqli->affected_rows;
if($sum_l > 0) {
    while($rows = $query_l->fetch_assoc()) {
        $msql = "update c_auto_23 set ok=0 where qishu=".$qi."";
        $mysqli->query($msql) or die ("防漏单处理失败!!!");
    }
}


}
if ($_GET['t']==1)    {
echo "<script>window.location.href='../../Lottery/auto_12.php';</script>";
}
if($_REQUEST['ac']=='re'){
	echo "OK";
	echo "<script>window.location.href='../../Lottery/Order.php?js=0';</script>";
}
?>