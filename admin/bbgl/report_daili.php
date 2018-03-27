<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");
check_quanxian("bbgl");
$hl=implode(',',array_keys($hlhy));

$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date('Y-m-d',strtotime("-1 month")):$bdate;
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

       $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
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
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="border:1px solid #798EB9;">
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
				&nbsp;代理名称：
				<input name="username" type="text" id="username" value="<?=$username?>" size="10" maxlength="10"/>
				
			</td> <td align="left">
			
				&nbsp;<input name="find" type="submit" id="find" value="查找"/>
			</td>
		</tr>
		</form>
	</table>
	<?php
	$color 	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";
	
	 $where ='';
	if($_GET["username"]){
		$wh.=	" and username='$username'";
		}
	
       $sql=" SELECT * FROM k_user WHERE  dltype=0 and fxdltype = 1 ".$wh." ";
	   echo $sql;
       $query	=	$mysqli->query($sql);
	   $sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
	// echo $sql;
	$uidstr='';
       while($rs = $query->fetch_array()){
	     $userstr .=$rs['uid'].',';
	   }
	 
	
	$userarr=array_unique(explode(',',$userstr));
		$userstr=implode(',',$userarr);
		$userstr		=	rtrim($userstr,',');
		$userarr=explode(',',$userstr);
	
			 // echo  json_encode( $userarr);
	
	?>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="15"><?=$btime?> 至 <?=$etime?> 分享代理下级财务汇总</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">会员账号</td>
			<td rowspan="2">当前余额</td>
			<td colspan="4">常规存取款</td>
			<td colspan="3">红利派送</td>
			<td rowspan="2">其他情况</td>
			<td colspan="2">彩票投注</td>
            <td colspan="2">反水结算</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td>存款</td>
			<td>汇款</td>
			<td>人工汇款</td>
			<td>提款</td>
			<td>注册送金</td>
			<td>彩金派送</td>
			<td>下级返点</td>
			<td>投注</td>
			<td>派奖</td>
            <td>计算</td>
			<td>结算</td>
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
		$sum_fandian  =0 ;	
			
			
			    foreach ($userarr as $uid){ 
				
                $sql_user	 =	"select * from k_user where uid='$uid' limit 1"; //取汇款前会员余额
                  $query	 =	$mysqli->query($sql_user);
                     $rs	 =	$query->fetch_array();
                         $username = $rs['username'];
						 $topfandian = $rs['fandian'];

	 $cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime)+0);
	 $cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime)+0);
	 $where="where `m_make_time`>='$cn_q_btime' and `m_make_time`<='$cn_q_etime'  ";
    	$where	.=	" and concat(',',parents,',') like '%,".intval($uid).",%'";
      
	  $sql	=	"SELECT  m_id,uid,parents, fxdltype FROM  `k_money2` ".$where." and guest=0 order by m_id desc";
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
	///echo $sql."|";
   $m_id=0;
    

  while($row = $query->fetch_array()){
	  $parentarr=explode(',',$row['parents']);
	  $wz=array_search($row['uid'],$parentarr);
	//	echo $uid;	
	if($row['fxdltype']==0){
	    if($wz>0){
	       $m_id .=	$row['m_id'].',';      
	                   }
                              } 
  }
  
	//////////////代理查询//////////i
			if($m_id){
			  $m_id		=	rtrim($m_id,',');
			$sql1="SELECT uid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,Sum(m_value) AS money2,type FROM k_money2  WHERE  `m_id` IN ($m_id)  GROUP BY uid,type ";	
 $sql2 =	"SELECT uid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,
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
FROM(".$sql1.") as moneyb1 ";
	//echo $sql1.'|' ;
	//echo $sql2;
    $query	=	$mysqli->query($sql2);
    $sum		=	$mysqli->affected_rows; //总页数
	$row = $query->fetch_array();


			/// echo $row["username"];
	      ///   echo $row["money"];
        $sum_t3_value	+=	$row["t3_value"];
		$sum_money	    +=	$row["money"];
		$sum_cunkuan	+=	$row["cunkuan"];
		$sum_huikuan	+=	$row["huikuan"];
		$sum_qukuan     +=	$row["qukuan"];
		$sum_rghuikuan	+=	$row["rghuikuan"];
		$sum_zhuce		+=	$row["zhuce"];
		$sum_paisong	+=	$row["paisong"];
		$sum_xjfandian	+=	$row["xjfandian"];
		$sum_qita		+=	$row["qita"];
		$sum_touzhu  	+=	$row["touzhu"];
		$sum_paijiang	+=	$row["paijiang"];
		$sum_fandian    +=  abs($row["touzhu"]*$topfandian)/100-$row["xjfandian"];
	
	
		
?>
	<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$username?></td>
			<td><?=sprintf("%.2f",$row["money"])?></td>
			<td><?=sprintf("%.2f",$row["cunkuan"])?></td>
			<td><?=sprintf("%.2f",$row["huikuan"])?></td>
			<td><?=sprintf("%.2f",$row["rghuikuan"])?></td>
			<td><?=sprintf("%.2f",abs($row["qukuan"]))?></td>
			<td><?=sprintf("%.2f",$row["zhuce"])?></td>
			<td><?=sprintf("%.2f",$row["paisong"])?></td>
			<td><?=sprintf("%.2f",$row["xjfandian"])?></td>
			<td><?=sprintf("%.2f",$row["qita"])?></td>
			<td><?=sprintf("%.2f",$row["touzhu"])?></td>
			<td><?=sprintf("%.2f",$row["paijiang"])?></td>
            <td><?=sprintf("%.2f",abs($row["touzhu"]*$topfandian)/100-$row["xjfandian"])?></td>
			<td><a href="../cwgl/set_money.php?uid=<?=$uid?>&type=add">结算</a></td>
        </tr>
	
<?php
       } 
        
       // echo  $m_id.'|';
	
				}
				
				
				
		?>
        <tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
    		<td><?=sprintf("%.2f",$sum_money)?></td>
			<td><?=sprintf("%.2f",$sum_cunkuan)?></td>
			<td><?=sprintf("%.2f",$sum_huikuan)?></td>
			<td><?=sprintf("%.2f",$sum_rghuikuan)?></td>
			<td><?=sprintf("%.2f",$sum_qukuan)?></td>
			<td><?=sprintf("%.2f",$sum_zhuce)?></td>
			<td><?=sprintf("%.2f",$sum_paisong)?></td>
			<td><?=sprintf("%.2f",$sum_xjfandian)?></td>
			<td><?=sprintf("%.2f",$sum_qita)?></td>
			<td><?=sprintf("%.2f",$sum_touzhu)?></td>
			<td><?=sprintf("%.2f",$sum_paijiang)?></td>
            <td><?=sprintf("%.2f",$sum_fandian)?></td>
             <td></td>
        </tr>
        
	</table>
	
</div>
</div>
</body>
</html>