<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");
$hl=implode(',',array_keys($hlhy));
session_start();
$suid=$_SESSION["suid"];
$susername=$_SESSION["susername"];

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


       $top_uid	=	'';$uid	=	array();

if($_GET["is_daili"]==='0'||$_GET["is_daili"]==1){
		$where	=	" and is_daili='".$_GET['is_daili']."' and concat(',',parents,',') like '%,".$suid.",%'";
	
		}else{
	
		$where	=	" and concat(',',parents,',') like '%,".$suid.",%'";
	
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
		  
		  $sql		=	"select uid from k_user where top_uid='$suid' and guest=0 ".$where." order by dltype ASC";

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
      	<input name="username" type="hidden" id="username" value="<?=$susername?>" size="10" maxlength="10"/>
		<input name="find" type="submit" id="find" value="<?=$susername?>"/>
				
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

				
			$listrow=array();		   
	////////////////资金变动统计///////

	$sql1="SELECT uid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,Sum(m_value) AS money2,type FROM k_money2  ".$where."  GROUP BY uid,type ";			
	$sql2 =	"SELECT uid,top_uid,parents,
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
FROM(".$sql1.") as moneyb1 GROUP BY uid";

////////////////资金变动统计结束////
	////投注统计


	$sql3 =	"select uid as uuid ,sum(if(js='1',summoney,0 )) AS jiesuan,
sum(if(js='0',summoney,0 )) AS wjiesuan,
sum(if(js='1',sumwin,0 )) AS shuyin,
sum(if(js='1',sumshu,0 )) AS shuyin2,
sum(if(js='0',sumwin,0 )) AS keyin,
sum(if(js='1',count,0 )) AS jscount,
sum(if(js='0',count,0 )) AS wjscount

from (SELECT *,
ifnull(sum(money),0) as  summoney,
ifnull(sum(if(win>0,win,0 )),0) AS sumwin,
ifnull(sum(if(win>0,win-money,win )),0) AS sumshu,
count(id) as count
FROM
c_bet2 ".$where2." GROUP BY uid,js) as tempa GROUP BY uid";
	$sql4 ="select * FROM(".$sql2.") as biao2 left join( ".$sql3.") as biao1 on biao1.uuid=biao2.uid";
	$sql5 ="select * FROM(".$sql4.") as biao3 left join (select uid as uuuid,dltype,username,money,zhancheng,is_daili from k_user ) as biao4 on biao3.uid=biao4.uuuid";
	
//echo $sql5;

	
$query	=	$mysqli->query($sql5);	
while($row = $query->fetch_array()){
 $listrow[]=	$row;  
}
	
	
	


	


	
	?>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="    font-size: 16px;margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="23"><?=$btime?> 至 <?=$etime?> 财务报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">会员账号</td>
			<td rowspan="2">账户类型</td>
			<td rowspan="2">用户余额</td>
			<td rowspan="2">下级数量</td>
			<td rowspan="2">风控余额</td>
		
			<td colspan="4">红利派送</td>
			
			<td colspan="4">彩票投注(客户)</td>
           	<td colspan="4">下级占成</td>
            <td rowspan="2">平台盈利（开奖）</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			
			<td>注册送金</td>
			<td>彩金派送</td>
			<td>会员返点</td>
			<td>返点总计</td>
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
		$list=array();
			$j=0;
				$userarr=array();
for($k=0;$k<count($uid);$k++){

	
				$usernum  =  0;
				$zhuce    =  0;
				$paisong  =  0;
				$xjfandian = 0;
				$touzhu  	=	0;
				$jiesuan  	=	0;
				$paijiang	=	0;
			    $yinkui   	=	0;
				$maoli   	=	0;
				$jingli   	=	0;
	          

	
		for($h=0;$h<count($row);$h++){
         $arr=explode(',',$row[$h]["parents"]);
		  if(in_array($uid[$k], $arr)){
			  
			 $userarr[]=$uid[$k];
			  }
		  
		}
		
}

$userarr=array_unique($userarr);
		$userstr=implode(',',$userarr);
		$userstr		=	rtrim($userstr,',');
		$userarr=explode(',',$userstr);
		$uerrow=array();$fdarr=array();
$sql="select uid,username,money,is_daili,dltype,zhancheng from k_user where uid in ($userstr) order by dltype ASC ";
$query	=	$mysqli->query($sql);
	
while($rows = $query->fetch_array()){
 $userrow[]=	$rows;  
}

	$sqla= "select tzname,sum(m_value) as fd from k_money3    ".$where."  and concat(',',parents,',') like '%,".$suid.",%'  group by tzname";
	$sqlb = "select * FROM(".$sqla.") as biaoa left join (select uid,parents,username from k_user ) as biaob on biaoa.tzname=biaob.username";
	//$sqlc ="select sum(fd)  as fandian,parents FROM(".$sqlb.") as biaoc where concat(',',biaoc.parents,',') like '%,".$list[$l]["uid"].",%' ";

	$query	=	$mysqli->query($sqlb);	
while($fdrows = $query->fetch_array()){
 $fdarr[]=	$fdrows;  
}		
				
		for($k=0;$k<count($userrow);$k++){
			    $list[$j]['uid']  = $userrow[$k]['uid'];
				$list[$j]['money'] = $userrow[$k]["money"];
				$list[$j]['zhancheng'] = $userrow[$k]["zhancheng"];
				$list[$j]['username'] = $userrow[$k]["username"];
				$list[$j]['dltype']  =  $userrow[$k]["dltype"];
				$list[$j]['is_daili']  =  $userrow[$k]["is_daili"];
			for($h=0;$h<count($row);$h++){
         $arr=explode(',',$row[$h]["parents"]);
		  if(in_array($userrow[$k]['uid'], $arr)){
             if($row[$h]["is_daili"]=1){
			    $list[$j]['dlmoney'] += $row[$h]["money"];
			  	}		
				$list[$j]['usernum']  +=  1;
				$list[$j]['zhuce']    +=  $row[$h]["zhuce"];
				$list[$j]['paisong']  +=  $row[$h]["paisong"];
				$list[$j]['xjfandian'] += $row[$h]["xjfandian"];
				$list[$j]['touzhu']  	+=	$row[$h]["touzhu"];
				$list[$j]['jiesuan']  	+=	$row[$h]["jiesuan"];
				$list[$j]['paijiang']	+=	$row[$h]["shuyin"];
			    $list[$j]['yinkui']   	+=	$row[$h]["shuyin2"];
				$list[$j]['maoli']   	+=	0-$row[$h]["shuyin2"];
			
		  
			}
			}
			///////////////
			for($a=0;$a<count($fdarr);$a++){
				$parr=explode(',',$fdarr[$a]["parents"]);
				  if(in_array($userrow[$k]['uid'], $parr)){
						$list[$j]['fdzj'] +=  $fdarr[$a]['fd'];	  
				  }
				
				
				
			}
			
				$list[$j]['jingli']   	=	$list[$j]['maoli']-$list[$j]['fdzj']; 
				$list[$j]['zhanchengje']  =	$list[$j]['jingli']* $userrow[$k]["zhancheng"]/100;
		        $list[$j]['ptyinkui']   =   $list[$j]['jingli']*(1- $userrow[$k]["zhancheng"]/100);
			
			/////////////////
			$j++;
			





}


		 $sumfandianzj=0;
for($l=0;$l<count($list);$l++){

	
	?>
    <?php if($list[$l]["is_daili"]==1){
			$sql= "select sum(money) as dlmoney ,count(*) as usernum from k_user where concat(',',parents,',') like '%,".$list[$l]["uid"].",%'  and is_daili=1";
		
			$query	=	$mysqli->query($sql);	
			while($row = $query->fetch_array()){
                  $dlmoney =	$row['dlmoney']; 
                  $usernum = 	$row['usernum']; 			  
                    }
			}
			?>

	<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><a href="?dlusername=<?=$list[$l]["username"]?>"><?=$list[$l]["username"]?></a></td>
			<td>
            
            
            
            
            
			<?php
		if($list[$l]["dltype"]==0){
			$lx='会员';
		}else if($list[$l]["dltype"]==1){
			$lx='大股东';
		}else if($list[$l]["dltype"]==2){
			$lx='股东';
		}
		else if($list[$l]["dltype"]==3){
			$lx='总代理';
		}else if($list[$l]["dltype"]==4){
			$lx='代理';
		}
			echo $lx;
				?>
			</td>
			<td><?=sprintf("%.2f",$list[$l]["money"])?></td>
			
			
			<td><?=$usernum?></td>
			<td><?=sprintf("%.2f",$dlmoney)?></td>
			
			<td><?=sprintf("%.2f",$list[$l]["zhuce"])?></td>
			<td><?=sprintf("%.2f",$list[$l]["paisong"])?></td>
			<td><?=sprintf("%.2f",$list[$l]["xjfandian"])?></td>
		    <td><?=sprintf("%.2f",$list[$l]["fdzj"])?></td>
			<td><?=sprintf("%.2f",$list[$l]["touzhu"])?></td>
            <td><?=sprintf("%.2f",$list[$l]["jiesuan"])?></td>
			<td><?=sprintf("%.2f",$list[$l]["paijiang"])?></td>
             <td style="color:<?php if($list[$l]["yinkui"]>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$list[$l]["yinkui"])?></td>
            <td style="color:<?php if($list[$l]['maoli']  >=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$list[$l]['maoli'])?></td>
            <td style="color:<?php if($list[$l]['jingli']>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$list[$l]['jingli'])?></td>
			<td ><?=sprintf("%.2f",$list[$l]["zhancheng"])?></td>
            <td style="color:<?php if($list[$l]["zhanchengje"]>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$list[$l]["zhanchengje"])?></td>
            <td style="color:<?php if($list[$l]['ptyinkui']>=0){echo 'blue';}else{echo 'red';}?>"><?=sprintf("%.2f",$list[$l]['ptyinkui'])?></td>
        </tr>
		



<?php 
       $sum_t3_value	+=	$list[$l]["t3_value"];
		$sum_money	     +=	$list[$l]["money"];
     	$sum_dlmoney	    +=	$dlmoney;
		$sum_usernum	    +=	$usernum;
		$sum_cunkuan	+=	$list[$l]["cunkuan"];
		$sum_huikuan	+=	$list[$l]["huikuan"];
		$sum_qukuan     +=	$list[$l]["qukuan"];
		$sum_rghuikuan	+=	$list[$l]["rghuikuan"];
		$sum_zhuce		+=	$list[$l]["zhuce"];
		$sum_paisong	+=	$list[$l]["paisong"];
		$sum_xjfandian	+=	$list[$l]["xjfandian"];
	    $sum_fdzj	   +=	$list[$l]["fdzj"];
		$sum_qita		+=	$$list[$l]["qita"];
		$sum_touzhu  	+=	$list[$l]["touzhu"];
		$sum_jiesuan  	+=	$list[$l]["jiesuan"];
		$sum_paijiang	+=	$list[$l]["paijiang"];
		$sum_yinkui   	+=	$list[$l]["yinkui"];
		$sum_maoli   	+=	$list[$l]["maoli"];
		$sum_jingli   	+=	$list[$l]["jingli"];
		$sum_zhancheng   	+=	$list[$l]["zhanchengje"];
		$sum_ptyinkui   	+=  $list[$l]["ptyinkui"];
	
}

?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
   		<td></td>
   		<td><?=sprintf("%.2f",$sum_money)?></td>
    		<td><?=$sum_usernum?></td>
    			<td><?=sprintf("%.2f",$sum_dlmoney)?></td>
	
			<td><?=sprintf("%.2f",$sum_zhuce)?></td>
			<td><?=sprintf("%.2f",$sum_paisong)?></td>
			<td><?=sprintf("%.2f",$sum_xjfandian)?></td>
			<td><?=sprintf("%.2f", $sum_fdzj)?></td>
			
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