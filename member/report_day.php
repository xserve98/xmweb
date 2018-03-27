<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
/////

////
$hl=implode(',',array_keys($hlhy));


$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$btime	=	$bdate." "."00:00:00";
$etime	=	$edate." "."23:59:59";



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css" />
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="images/member.js"></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body class="skin_blue">
<?php include_once("agentmenu.php"); ?>
<div class="main report">
<div class="search">

	<form name="form1" method="get" action="">
		
			
				&nbsp;开始日期
				<input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				
				
				&nbsp;结束日期
				<input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
			
				&nbsp;<input name="find" type="submit" id="find" value="查找"/>
		
		
		</form>
       
</div> <br>
<table class="list table">
<thead>
<tr align="center" >
			<th rowspan="2">会员账号</th>
			<th rowspan="2">当前余额</th>
			<th colspan="4">常规存取款</th>
			<th colspan="3">红利派送</th>
			<th rowspan="2">其他情况</th>
			<th colspan="3">彩票投注</th>
		</tr>
		<tr align="center" >
			<th>存款</th>
			<th>汇款</th>
			<th>人工汇款</th>
			<th>提款</td>
			<th>注册送金</th>
			<th>彩金派送</th>
			<th>投注返点</th>
			<th>投注</th>
			<th>派奖</th>
            <th>投注盈亏</th>

		</tr>
</thead>
<tbody>
	<?php
	$color 	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";

	
	 $cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime)+0);
	 $cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime)+0);
	 $where="where `m_make_time`>='$cn_q_btime' and `m_make_time`<='$cn_q_etime'";
	 $where	.=	" and uid= '$uid'";
			
	  $sql	=	"SELECT  m_id,uid,parents, fxdltype FROM  `k_money2` ".$where." order by m_id desc";
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
	//echo $sql;

  while($row = $query->fetch_array()){

$m_id .=	$row['m_id'].',';  	
}


	?>
    <?php
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
FROM(".$sql1.") as moneyb1
GROUP BY uid";
	//echo $sql1 ;
///echo $sql2;
	
    $query	=	$mysqli->query($sql2);
    $sum		=	$mysqli->affected_rows; //总页数
	//$row = $query->fetch_array();
   
	
	
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
		
		
		while($row=$query->fetch_array()){
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
		
	
	?>


<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$row["username"]?></td>
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
            <td><?=sprintf("%.2f",($row["touzhu"]+$row["paijiang"]))?></td>
        </tr>
    <?php
                }
            } ?>

</tbody>
<tfoot>

</tfoot>
</table>

<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>