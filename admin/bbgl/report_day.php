<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");
check_quanxian("bbgl");
$hl=implode(',',array_keys($hlhy));

$today=date('Y-m-d',time());
$current_date = date('Y-m-d',time());    
//根据当前时间加一周后   
$hao=getdate();
$week = date('Y-m-d',time()-86400*(date("w")+7)); 
$weekend=date('Y-m-d',time()-86400*(date("w")+1));
$month = date('Y-m-d',strtotime("$current_date - 1 month")-86400*($hao['mday']-1));   
$monthend=date('Y-m-d',time()-86400*($hao['mday'])); 
$benweek=date('Y-m-d',time()-86400*date("w"));

$benyue=date('Y-m-d',time()-86400*($hao['mday']-1));
$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
$username=	$_GET["username"];
$dlusername=	$_GET["dlusername"];
if($_GET["dlusername"]) {
 $name=$_GET["dlusername"];
 $sql_user	 =	"select * from k_user where username='$name' limit 1"; //取汇款前会员余额

 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 
 $topjs = $rs['fdjishu'];
 $topdltype=$rs['fxdltype'];
 $dltype=$rs['dltype'];
 $topusername = $rs['username'];
 $topuid=$rs['uid'];

}

       $top_uid	=	'';$uid	=	array();

if($_GET["is_daili"]==='0'||$_GET["is_daili"]==1){
		$where	=	" and is_daili='".$_GET['is_daili']."'";
	
		}else{
	
		$where	=	" ";
	
}


	  if($_GET['dlusername']){
	      $sql		=	"select uid from k_user where username='".$_GET['dlusername']."'  limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  	$top_uid=	$rows['uid'];
		  }
		  $sql		=	"select uid from k_user where top_uid='$top_uid' and guest=0 ".$where." order by dltype ASC ";
		  $query	=	$mysqli->query($sql);
  while($row = $query->fetch_array()){
	$uid[] =	$row['uid'];  
}

	
		  
	  }

else  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' ".$where." limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  	$uid[] =	$rows['uid'];
		  }
	  
	  }

else{
		  
		  $sql		=	"select uid from k_user where top_uid='0' and guest=0 ".$where." order by dltype ASC";
		  $query	=	$mysqli->query($sql); 
		    while($row = $query->fetch_array()){
	    $uid[] =	$row['uid'];  
}

	  }




  

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
	<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body>
<div id="pageMain">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="    font-size: 16px;border:1px solid #798EB9;">
		<form name="form1" method="get" action="">
		<tr bgcolor="#FFFFFF">
			<td align="left">
			
				&nbsp;开始日期
				<input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="bhour" id="bhour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="bsecond" id="bsecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
				&nbsp;结束日期
				<input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="ehour" id="ehour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="esecond" id="esecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
			</td>
			<td align="left">
	
			
			</td>
			<td align="left">
				&nbsp;会员名称：
				<input name="username" type="text" id="username" value="<?=$username?>" size="10" maxlength="10"/>
				
			</td> <td align="left">
				&nbsp;代理名称：
				<input name="dlusername" type="text" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
				&nbsp;<input name="find" type="submit" id="find" value="查找"/>
				</form>
		<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$bdate?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$edate?>" size="10" maxlength="10" readonly />
       <input name="is_daili"  type="hidden" id="is_daili" value="0" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="会员"/>
				
			</form>
			
		<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$bdate?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$edate?>" size="10" maxlength="10" readonly />
       <input name="is_daili"  type="hidden" id="is_daili" value="1" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="代理"/>
				
			</form>
			<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$benweek?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$tody?>" size="10" maxlength="10" readonly />
       <input name="username"  type="hidden" id="username" value="<?=$username?>" size="10" maxlength="10"/>
       <input name="dlusername"  type="hidden" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="本周"/>
				
			</form>
			<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$benyue?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$tody?>" size="10" maxlength="10" readonly />
       <input name="username"  type="hidden" id="username" value="<?=$username?>" size="10" maxlength="10"/>
       <input name="dlusername"  type="hidden" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="本月"/>
				
			</form>
		<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$week?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$weekend?>" size="10" maxlength="10" readonly />
       <input name="username"  type="hidden" id="username" value="<?=$username?>" size="10" maxlength="10"/>
       <input name="dlusername"  type="hidden" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="上周"/>
				
			</form>
				
		<form name="form1" method="get" action="">
        <input name="bdate" type="hidden" id="bdate" value="<?=$month?>"  size="10" maxlength="10" readonly />
       <input name="edate"  type="hidden" id="edate" value="<?=$monthend?>" size="10" maxlength="10" readonly />
       <input name="username"  type="hidden"id="username" value="<?=$username?>" size="10" maxlength="10"/>
       <input name="dlusername"  type="hidden" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="上月"/>
				
			</form>
		
		
			</td>
		</tr>
		
		
			
				
		
	</table>
	<?php
	$color 	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";

	 $cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime)+0);
	 $cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime)+0);
	 $where="where `m_make_time`>='$cn_q_btime' and `m_make_time`<='$cn_q_etime'";
	 $where2="where `addtime`>='$cn_q_btime' and `addtime`<='$cn_q_etime'";
	if($_GET["username"]){
		$where	.=	" and username='$username'";
		$where2	.=	" and username='$username'";
		}
	if($_GET["dlusername"]){
			$where	.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
			$where2	.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
			}
				
			$listrow=array();		   
foreach ($uid as $value){ 
	////////////////资金变动统计///////
	$sql = "select uid from k_money2  WHERE concat(',',parents,',') like '%,".intval($value).",%' limit 1";
	$query	  =	$mysqli->query($sql);
	$sum	=	$mysqli->affected_rows; //总页	

	if($sum>0){
	$sql1="SELECT '$value' as dluid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,Sum(m_value) AS money2,type FROM k_money2  ".$where." and concat(',',parents,',') like '%,".intval($value).",%'  GROUP BY type ";			
	}else{
			$sql1="SELECT '$value' as dluid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,ifnull(Sum(m_value),0) AS money2,type FROM k_money2  ".$where." and  concat(',',parents,',') like '%,".intval($value).",%'";		
	 }
			

	$sql2 =	"SELECT dluid,
sum(if(type='1',money2,0 )) AS cunkuan,
sum(if(type='7',money2,0 )) AS huikuan,
sum(if(type='2',money2,0 )) AS qukuan,
sum(if(type='3',money2,0 )) AS rghuikuan,
sum(if(type='4',money2,0 )) AS paisong,
sum(if(type='6',money2,0 )) AS qita,
sum(if(type='400',money2,0 )) AS zhuce,
sum(if(type='100',money2,0 )) AS touzhu,
sum(if(type='300',money2,0 )) AS paijiang,
sum(if(type='200',money2,0 )) AS xjfandian
FROM(".$sql1.") as moneyb1";

////////////////资金变动统计结束////
	////投注统计
	$sql = "select uid from c_bet2  WHERE concat(',',parents,',') like '%,".intval($value).",%' limit 1";
	$query	  =	$mysqli->query($sql);
	$sum	=	$mysqli->affected_rows; //总页	
	if($sum>0){
	
	
	$sql3 =	"select dluid1,sum(if(js='1',summoney,0 )) AS jiesuan,
sum(if(js='0',summoney,0 )) AS wjiesuan,
sum(if(js='1',sumwin,0 )) AS shuyin,
sum(if(js='1',sumshu,0 )) AS shuyin2,
sum(if(js='0',sumwin,0 )) AS keyin,
sum(if(js='1',count,0 )) AS jscount,
sum(if(js='0',count,0 )) AS wjscount

from (SELECT *,
ifnull(sum(money),0) as  summoney,'$value' as dluid1,
ifnull(sum(if(win>0,win,0 )),0) AS sumwin,
ifnull(sum(if(win>0,win-money,win )),0) AS sumshu,
count(id) as count
FROM
c_bet2 ".$where2." and concat(',',parents,',') like '%,".intval($value).",%'
GROUP BY js ) as tempa ";
	}else{		
	$sql3 =	"select dluid1,sum(if(js='1',summoney,0 )) AS jiesuan,
sum(if(js='0',summoney,0 )) AS wjiesuan,
sum(if(js='1',sumwin,0 )) AS shuyin,
sum(if(js='1',sumshu,0 )) AS shuyin2,
sum(if(js='0',sumwin,0 )) AS keyin,
sum(if(js='1',count,0 )) AS jscount,
sum(if(js='0',count,0 )) AS wjscount
from (SELECT *,
ifnull(sum(money),0) as  summoney,'$value' as dluid1,
ifnull(sum(if(win>0,win,0 )),0) AS sumwin,
ifnull(sum(if(win>0,win-money,win )),0) AS sumshu,
count(id) as count
FROM
c_bet2 ".$where2." and  concat(',',parents,',') like '%,".intval($value).",%' ) as tempa ";
		
	}

	
	$sql5 = "select '$value' as dluid2,sum(money) as dlmoney ,count(*) as usernum from k_user where concat(',',parents,',') like '%,".intval($value).",%'  and is_daili=1";	
	$sql4 = "select * FROM(".$sql2.") as biao2 join( ".$sql3.")  as biao1  on biao1.dluid1=biao2.dluid  join( ".$sql5.") as biao3 on biao3.dluid2=biao2.dluid";	
	$sql6 ="select uid,dltype,username,money,zhancheng from k_user where uid='$value'";
	$sql7 ="select * from (".$sql6.") as biao4  join( ".$sql4.")  as biao5 on biao4.uid=biao5.dluid1  ";
	
	//echo $sql6;
	//exit;
$query	=	$mysqli->query($sql7);	
while($row = $query->fetch_array()){
 $listrow[]=	$row;  
}
	

	
	
}

	
	?>
	
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="    font-size: 16px;margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="23"><?=$btime?> 至 <?=$etime?> 财务报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">会员账号</td>
            <td rowspan="2">uid</td>
			<td rowspan="2">账户类型</td>
			<td rowspan="2">用户余额</td>
			<td rowspan="2">下级数量</td>
			<td rowspan="2">风控余额</td>
		
			<td colspan="3">红利派送</td>
			
			<td colspan="4">彩票投注(客户)</td>
           	<td colspan="4">下级占成</td>
            <td rowspan="2">平台盈利（开奖）</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			
			<td>注册送金</td>
			<td>彩金派送</td>
			<td>下级返点</td>
			<td>总投注</td>
            <td>已开奖</td>
			<td>中奖</td>
            <td>输赢</td> 	
			<td>毛利润</td>
            <td>净利润</td>
			<td>占成比例(%)</td>
            <td>占成金额</td>
            
		</tr>
        	<?php
		

	
		$sum_money	=	0;
		$sum_cunkuan	=	0;
		$sum_huikuan	=	0;
		$sum_qukuan	=	0;
		$sum_rghuikuan	=	0;
		$sum_zhuce		=	0;
		$sum_paisong		=	0;
		$sum_xjfandian	=	0;
		$sum_qita		=	0;
		$sum_touzhu	=	0;
		$sum_paijiang	=	0;
		$sum_yinkui	=	0;
        $sum_ptyinkui	=	0;
		$row=$listrow;		
		for($i=0;$i<count($row);$i++){
			/// echo $row["username"];
	      ///   echo $row["money"];
        $sum_t3_value	+=	$row[$i]["t3_value"];
		$sum_money	    +=	$row[$i]["money"];
		$sum_dlmoney	    +=	$row[$i]["dlmoney"];
		$sum_usernum	    +=	$row[$i]["usernum"];
		$sum_cunkuan	+=	$row[$i]["cunkuan"];
		$sum_huikuan	+=	$row[$i]["huikuan"];
		$sum_qukuan     +=	$row[$i]["qukuan"];
		$sum_rghuikuan	+=	$row[$i]["rghuikuan"];
		$sum_zhuce		+=	$row[$i]["zhuce"];
		$sum_paisong	+=	$row[$i]["paisong"];
		$sum_xjfandian	+=	$row[$i]["xjfandian"];
		$sum_qita		+=	$row[$i]["qita"];
		$sum_touzhu  	+=	$row[$i]["touzhu"];
		$sum_jiesuan  	+=	$row[$i]["jiesuan"];
		$sum_paijiang	+=	$row[$i]["shuyin"];
		$sum_yinkui   	+=	$row[$i]["shuyin2"];
		$sum_maoli   	+=	0-$row[$i]["shuyin2"];
		$sum_jingli   	+=	0-$row[$i]["shuyin2"]-$row[$i]["xjfandian"];
		$sum_zhancheng   	+=	(0-$row[$i]["shuyin2"]-$row[$i]["xjfandian"])*$row[$i]["zhancheng"]/100;
		$sum_ptyinkui   	+=   (0-$row[$i]["shuyin2"]-$row[$i]["xjfandian"])*(1-$row[$i]["zhancheng"]/100);
		$maoli   	=	0-$row[$i]["shuyin2"];
		$jingli=sprintf("%.2f",0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]));
		$zhancheng=sprintf("%.2f",(0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]))*(1-$row[$i]["zhancheng"]/100));
		$ptyk =sprintf("%.2f",(0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]))*(1-$row[$i]["zhancheng"]/100));
	
	?>

		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><a href="?dlusername=<?=$row[$i]["username"]?>"><?=$row[$i]["username"]?></a></td>
            	<td><a href="?dlusername=<?=$row[$i]["username"]?>"><?=$row[$i]["uid"]?></a></td>
			<td>
			<?php
		if($row[$i]["dltype"]==0){
			$lx='会员';
		}else if($row[$i]["dltype"]==1){
			$lx='大股东';
		}else if($row[$i]["dltype"]==2){
			$lx='股东';
		}
		else if($row[$i]["dltype"]==3){
			$lx='总代理';
		}else if($row[$i]["dltype"]==4){
			$lx='代理';
		}
			echo $lx;
				?>
			</td>
			<td><?=sprintf("%.2f",$row[$i]["money"])?></td>
			<td><?=$row[$i]["usernum"]?></td>
			<td><?=sprintf("%.2f",$row[$i]["dlmoney"])?></td>
			
			<td><?=sprintf("%.2f",$row[$i]["zhuce"])?></td>
			<td><?=sprintf("%.2f",$row[$i]["paisong"])?></td>
			<td><?=sprintf("%.2f",$row[$i]["xjfandian"])?></td>
	
			<td><?=sprintf("%.2f",$row[$i]["touzhu"])?></td>
            <td><?=sprintf("%.2f",$row[$i]["jiesuan"])?></td>
			<td><?=sprintf("%.2f",$row[$i]["shuyin"])?></td>
             <td style="color:<?php if($row[$i]["shuyin2"]>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$row[$i]["shuyin2"])?></td>
            <td style="color:<?php if($maoli>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",0-$row[$i]["shuyin2"])?></td>
            <td style="color:<?php if($jingli>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]))?></td>
			<td ><?=sprintf("%.2f",$row[$i]["zhancheng"])?></td>
            <td style="color:<?php if($zhancheng>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",(0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]))*$row[$i]["zhancheng"]/100)?></td>
            <td style="color:<?php if($ptyk>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",(0-$row[$i]["shuyin2"] - abs($row[$i]["xjfandian"]))*(1-$row[$i]["zhancheng"]/100))?></td>
        </tr>
		
        <?php } ?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
   		<td></td>
   		<td><?=sprintf("%.2f",$sum_money)?></td>
    		<td><?=$sum_usernum?></td>
    			<td><?=sprintf("%.2f",$sum_dlmoney)?></td>
	
			<td><?=sprintf("%.2f",$sum_zhuce)?></td>
			<td><?=sprintf("%.2f",$sum_paisong)?></td>
			<td><?=sprintf("%.2f",$sum_xjfandian)?></td>
			
			<td><?=sprintf("%.2f",$sum_touzhu)?></td>
            <td><?=sprintf("%.2f",$sum_jiesuan)?></td>
			<td><?=sprintf("%.2f",$sum_paijiang)?></td>
            <td><?=sprintf("%.2f",$sum_yinkui)?></td>
            <td><?=sprintf("%.2f",$sum_maoli)?></td>
            <td><?=sprintf("%.2f",$sum_jingli)?></td>
            <td>-</td>
             <td><?=sprintf("%.2f",$sum_zhancheng)?></td> 
            <td><?=sprintf("%.2f",$sum_ptyinkui)?></td>
        </tr>
	</table>

</div>
</div>
</body>
</html>
