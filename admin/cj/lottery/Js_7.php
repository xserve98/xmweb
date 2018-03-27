<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("auto_class.php");
sleep(2);
//获取开奖号码
if($_REQUEST['ac']=='re'){
	$qi 		= is_numeric($_REQUEST['qi']) ? $_REQUEST['qi'] : 0;
	$sql		= "select * from c_auto_7 where qishu=".$qi." order by id desc limit 1";
}else{
	$sql		= "select * from c_auto_7 where ok=0";
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
$sql1		= "select * from c_bet where type='天津时时彩' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	
		
	//开始结算冠军
	if($rows['mingxi_1']=='第一球'){
		$ds = Ssc_Ds($rs['ball_1']);
		$dx = Ssc_Dx($rs['ball_1']);

	if($rows['jkzt']==1){///必中
	if(bizhong($rows['mingxi_2'])=='数字'){
		$ball=$rs['ball_1'];
		
		}
	 else if(bizhong($rows['mingxi_2'])=='单双'){
		 $ball=$ds;
		 }
    else{
		 $ball=$dx;
		}		 
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2){////必定不中
		if(bizhong($rows['mingxi_2'])=='数字'&&$rows['mingxi_2']==$rs['ball_1']){
			    $ball= getbzhm($rs['ball_1']);
				//$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			}
			if(bizhong($rows['mingxi_2'])=='大小'&&$rows['mingxi_2']==$dx){
			    $ball= getbzhm($dx);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			  if(bizhong($rows['mingxi_2'])=='单双'&&$rows['mingxi_2']==$ds){
			    $ball= getbzhm($ds);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			
			}////必不中结束/////
	}
	//开始结算亚军
	if($rows['mingxi_1']=='第二球'){
		$ds = Ssc_Ds($rs['ball_2']);
		$dx = Ssc_Dx($rs['ball_2']);
		
		if($rows['jkzt']==1){///必中
	if(bizhong($rows['mingxi_2'])=='数字'){
		$ball=$rs['ball_2'];
		
		}
	 else if(bizhong($rows['mingxi_2'])=='单双'){
		 $ball=$ds;
		 }
    else{
		 $ball=$dx;
		}		 
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2){////必定不中
		if(bizhong($rows['mingxi_2'])=='数字'&&$rows['mingxi_2']==$rs['ball_2']){
			    $ball= getbzhm($rs['ball_2']);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			}
			if(bizhong($rows['mingxi_2'])=='大小'&&$rows['mingxi_2']==$dx){
			    $ball= getbzhm($dx);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			  if(bizhong($rows['mingxi_2'])=='单双'&&$rows['mingxi_2']==$ds){
			    $ball= getbzhm($ds);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			
			}////必不中结束/////
	}
	if($rows['mingxi_1']=='第三球'){
		$ds = Ssc_Ds($rs['ball_3']);
		$dx = Ssc_Dx($rs['ball_3']);
		if($rows['jkzt']==1){///必中
	if(bizhong($rows['mingxi_2'])=='数字'){
		$ball=$rs['ball_3'];
		
		}
	 else if(bizhong($rows['mingxi_2'])=='单双'){
		 $ball=$ds;
		 }
    else{
		 $ball=$dx;
		}		 
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2){////必定不中
		if(bizhong($rows['mingxi_2'])=='数字'&&$rows['mingxi_2']==$rs['ball_3']){
			    $ball= getbzhm($rs['ball_3']);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			}
			if(bizhong($rows['mingxi_2'])=='大小'&&$rows['mingxi_2']==$dx){
			    $ball= getbzhm($dx);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			  if(bizhong($rows['mingxi_2'])=='单双'&&$rows['mingxi_2']==$ds){
			    $ball= getbzhm($ds);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			
			}////必不中结束/////
}

//开始结算第4名
	if($rows['mingxi_1']=='第四球'){
		$ds = Ssc_Ds($rs['ball_4']);
		$dx = Ssc_Dx($rs['ball_4']);
		if($rows['jkzt']==1){///必中
	if(bizhong($rows['mingxi_2'])=='数字'){
		$ball=$rs['ball_4'];
		
		}
	 else if(bizhong($rows['mingxi_2'])=='单双'){
		 $ball=$ds;
		 }
    else{
		 $ball=$dx;
		}		 
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2){////必定不中
		if(bizhong($rows['mingxi_2'])=='数字'&&$rows['mingxi_2']==$rs['ball_4']){
			    $ball= getbzhm($rs['ball_4']);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			}
			if(bizhong($rows['mingxi_2'])=='大小'&&$rows['mingxi_2']==$dx){
			    $ball= getbzhm($dx);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			  if(bizhong($rows['mingxi_2'])=='单双'&&$rows['mingxi_2']==$ds){
			    $ball= getbzhm($ds);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			
			}////必不中结束/////
		}
//开始结算第5名
	if($rows['mingxi_1']=='第五球'){
		$ds = Ssc_Ds($rs['ball_5']);
		$dx = Ssc_Dx($rs['ball_5']);
		if($rows['jkzt']==1){///必中
	if(bizhong($rows['mingxi_2'])=='数字'){
		$ball=$rs['ball_5'];
		
		}
	 else if(bizhong($rows['mingxi_2'])=='单双'){
		 $ball=$ds;
		 }
    else{
		 $ball=$dx;
		}		 
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2){////必定不中
		if(bizhong($rows['mingxi_2'])=='数字'&&$rows['mingxi_2']==$rs['ball_5']){
			    $ball= getbzhm($rs['ball_5']);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			}
			if(bizhong($rows['mingxi_2'])=='大小'&&$rows['mingxi_2']==$dx){
			    $ball= getbzhm($dx);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			  if(bizhong($rows['mingxi_2'])=='单双'&&$rows['mingxi_2']==$ds){
			    $ball= getbzhm($ds);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);
			  }
			
			}////必不中结束/////
}
	
	if($rows['mingxi_2']=='总和大' || $rows['mingxi_2']=='总和小'){
		$zonghe = Ssc_Auto($hm,2);
		
			if($rows['jkzt']==1){///必中
	    	 $ball=$zonghe;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$zonghe){////必定不中
			    $ball= getbzhm2($zonghe);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
		}
		if($rows['mingxi_2']=='总和单' || $rows['mingxi_2']=='总和双'){
		$zonghe = Ssc_Auto($hm,3);
			if($rows['jkzt']==1){///必中
	    	 $ball=$zonghe;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$zonghe){////必定不中
			    $ball= getbzhm2($zonghe);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
		}
		
	/*if($rows['mingxi_2']=='和'){
		$longhu = Ssc_Auto($hm,4);
		if($rows['jkzt']==1){///必中
	    	 $ball=$longhu;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$longhu){////必定不中
			    $ball= getbzlh($longhu);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
            }
			*/
				if($rows['mingxi_2']=='龙' || $rows['mingxi_2']=='虎'){
		$longhu = Ssc_Auto($hm,4);
		
		if($rows['jkzt']==1){///必中
	    	 $ball=$longhu;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$longhu){////必定不中
			    $ball= getbzlh($longhu);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
            }		
			
					
			if($rows['mingxi_1']=='前三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$qiansan = Ssc_Auto($hm,5);
		}
		
		if($rows['jkzt']==1){///必中
	    	$ball=$qiansan;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$longhu){////必定不中
			    $ball= getbzq3($qiansan);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
            }	
			
				if($rows['mingxi_1']=='中三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$zhongsan = Ssc_Auto($hm,6);
		}
					if($rows['jkzt']==1){///必中
	    	$ball=$zhongsan;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$longhu){////必定不中
			    $ball= getbzq3($zhongsan);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
            }	
	
					
				if($rows['mingxi_1']=='后三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$housan = Ssc_Auto($hm,6);
		}
					if($rows['jkzt']==1){///必中
	    	$ball=$housan;
			$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			$mysqli->query($msql) or die ($msql);
		
		}/////必中结束///
		
		if($rows['jkzt']==2&&$rows['mingxi_2']==$longhu){////必定不中
			    $ball= getbzq3($housan);
				$msql="update c_bet set mingxi_2='$ball' where id=".$rows['id']."";
			    $mysqli->query($msql) or die ($msql);			
			}////必不中结束/////
            }	
	
			
	
}

//根据期数读取未结算的单
$sql2		= "select * from c_bet where type='天津时时彩' and js=0 and qishu=".$qi." order by addtime asc";
$query2	= $mysqli->query($sql2);
$sum		= $mysqli->affected_rows;
while($rows = $query2->fetch_array()){
	
	//开始结算第一球
	if($rows['mingxi_1']=='第一球'){
		$ds = Ssc_Ds($rs['ball_1']);
		$dx = Ssc_Dx($rs['ball_1']);
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	if($rows['mingxi_1']=='第二球'){
		$ds = Ssc_Ds($rs['ball_2']);
		$dx = Ssc_Dx($rs['ball_2']);
		if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算第三球
	if($rows['mingxi_1']=='第三球'){
		$ds = Ssc_Ds($rs['ball_3']);
		$dx = Ssc_Dx($rs['ball_3']);
		if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	if($rows['mingxi_1']=='第四球'){
		$ds = Ssc_Ds($rs['ball_4']);
		$dx = Ssc_Dx($rs['ball_4']);
		if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算第五球
	if($rows['mingxi_1']=='第五球'){
		$ds = Ssc_Ds($rs['ball_5']);
		$dx = Ssc_Dx($rs['ball_5']);
		if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	if($rows['mingxi_2']=='总和大' || $rows['mingxi_2']=='总和小'){
		$zonghe = Ssc_Auto($hm,2);
		if($rows['mingxi_2']==$zonghe){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算总和单双
	if($rows['mingxi_2']=='总和单' || $rows['mingxi_2']=='总和双'){
		$zonghe = Ssc_Auto($hm,3);
		if($rows['mingxi_2']==$zonghe){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	
	
			//开始结算龙虎和
	if($rows['mingxi_2']=='龙' || $rows['mingxi_2']=='虎' || $rows['mingxi_2']=='和'){
		$longhu = Ssc_Auto($hm,4);
		if($longhu=='和'){
			if($rows['mingxi_2']==$longhu){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){															////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['win'];
	///$assets=$assets+$allmoney-
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
				//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1,win=money where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
																		////////////添加资金开奖记录////////
	$uid =$rows['uid'];	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$row1	 =	$query->fetch_array();
	$money2 =	$rows['money'];
	///$assets=$assets+$allmoney-
	$about   = '天津时时彩开奖打和'.$rows['money'];
	$order = $rows['did'];
        $assets  =	$row1['money'];
	$assets2  =	$row1['money']+$rows['money'];
        $money_type =300;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	/////
				
				$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}}
			
		}else{
		if($rows['mingxi_2']==$longhu){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
		
	}
	
	
	
	
	
	
	//开始结算前三
	if($rows['mingxi_1']=='前三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$qiansan = Ssc_Auto($hm,5);
		}elseif($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小'){
			$qiansan = Ssc_Auto($hm,51);
		}else{
			$qiansan = Ssc_Auto($hm,52);
		}
		if($rows['mingxi_2']==$qiansan){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算中三
	if($rows['mingxi_1']=='中三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$zhongsan = Ssc_Auto($hm,6);
		}elseif($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小'){
			$zhongsan = Ssc_Auto($hm,61);
		}else{
			$zhongsan = Ssc_Auto($hm,62);
		}
		if($rows['mingxi_2']==$zhongsan){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算后三
	if($rows['mingxi_1']=='后三'){
		if($rows['mingxi_2']=='豹子' || $rows['mingxi_2']=='顺子' || $rows['mingxi_2']=='对子' || $rows['mingxi_2']=='半顺' || $rows['mingxi_2']=='杂六'){
			$housan = Ssc_Auto($hm,7);
		}elseif($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小'){
			$housan = Ssc_Auto($hm,71);
		}else{
			$housan = Ssc_Auto($hm,72);
		}
		if($rows['mingxi_2']==$housan){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算斗牛
	if($rows['mingxi_1']=='斗牛'){
		$housan = Ssc_Auto($hm,8);
		if($rows['mingxi_2']=='牛大' || $rows['mingxi_2']=='牛小'){
			$housan=dndx($housan);
		}
		if($rows['mingxi_2']=='牛单' || $rows['mingxi_2']=='牛双'){
			$housan=dnds($housan);
		}
		if($rows['mingxi_2']==$housan){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
	//开始结算梭哈
	if($rows['mingxi_1']=='梭哈'){
		$housan = Ssc_Auto($hm,9);
		if($rows['mingxi_2']==$housan){
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
	$about   = '天津时时彩开奖派奖'.$rows['win'];
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
    
    //
        //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$rs['ball_1'].",".$rs['ball_2'].",".$rs['ball_3'].",".$rs['ball_4'].",".$rs['ball_5']."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);

}
$msql="update c_auto_7 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
//防漏单处理
$sql_l = "select qishu from c_bet where type='天津时时彩' and js=0 and qishu=".$qi."";
$query_l = $mysqli->query($sql_l);
$sum_l = $mysqli->affected_rows;
if($sum_l > 0) {
    while($rows = $query_l->fetch_assoc()) {
        $msql = "update c_auto_7 set ok=0 where qishu=".$qi."";
        $mysqli->query($msql) or die ("防漏单处理失败!!!");
    }
}

}
if ($_GET['t']==1)    {
	echo "<script>window.location.href='../../Lottery/auto_2.php?type=7';</script>";
}
if($_REQUEST['ac']=='re'){
	echo "OK";
	echo "<script>window.location.href='../../Lottery/Order.php?js=0';</script>";
}
?>