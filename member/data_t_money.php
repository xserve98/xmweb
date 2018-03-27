<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs2	 =	$query->fetch_array();
$sqlb="select sum(money) as sum_money from c_bet where uid = '$uid' and js=0 group by uid ";
$query	 =	$mysqli->query($sqlb);
$rs1	 =	$query->fetch_array();
$status = $_GET["accept"];
$begin = $_GET["begin"];
$begin = $begin == "" ? date("Y-m-d", time()) : $begin;
$begintime=$begin." "."00:00:00";
$end = $_GET["end"];
$end = $end == "" ? date("Y-m-d", time()) : $end;
$endtime=$end." "."23:59:59";
$subsub = 3;
?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script><link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css"><link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/home.js"></script>
</head>
<body id="bodyid" class="skin_blue">
 <?php include_once("moneymenu.php"); ?>
	<div class="rightpanel rw1">
		<div class="contentcontainer">

<form name="form1" method="GET" action="data_t_money.php" >
			<div class="row">
				<div class="col1 ">交易类型：</div>
				<div class="col2">
					<div class="textcontainer">
                       状态： <select name="accept" id="accept" class="province floatleft  select1">
							<option value="-1" selected="selected">全部</option>
							<option value="2">处理中</option>
							<option value="1">成功</option>
							<option value="0">失败</option>
						</select>
					</div>

					<div class="textcontainer">
						<div class="col1">起止日期：</div>
						<input id="begin"  name="begin" class="textbox2 laydate-icon" value="<?=$begin?>" style="width: 100px; height: 29px;" type="text" onClick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                         <input id="end"   name="end"  class="textbox2 laydate-icon"  value="<?=$end?>"   style="width: 100px; margin-left: 10px; height: 29px;" type="text" onClick="laydate({istime: true, format: 'YYYY-MM-DD'})">
					</div>
					<div class="rightfrm" style=" margin-right: 300px;">
						
						<div class="textcontainer">
						
							<div class="textboxicon">
							
                                	<input type="submit" class="frmbtn" value="搜索">
							</div>
						</div>
					</div>

				</div>
			</div>
            </form>
			<div class="mt4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borderblue">
					<thead>
						<tr class="borderbtmblue bluetbl">
							<td style="width: 15%">时间</td>
							<td style="width: 8%">交易类型</td>
							<td style="width: 8%">金额</td>
							<td style="width: 6%">手续费</td>
							<td style="width: 15%">订单号</td>
							<td style="width: 10%">交易描述</td>
							<td style="width: 6%">单据状态</td>
							
							
						</tr>
					</thead>
					<tbody>
						         <?php
      
$where='';
			if($_GET["accept"] == '0'||$_GET["accept"]=='1'){
			$where .= " and status=$status";
	
			}
			if($_GET["end"]){
			 $where .=" and `m_make_time`>='$begintime' and `m_make_time`<='$endtime'";
			}
			  $sql	=	"select m_id from k_money where uid=$uid  and type=2  ".$where."  order by m_id desc";
			//echo $sql;
        $query	=	$mysqli->query($sql);
		
        $sum	=	$mysqli->affected_rows; //总页数
        $thisPage	=	1;
        if(@$_GET['page']){
            $thisPage	=	$_GET['page'];
        }
        $page		=	new newPage();
        $perpage	= 	15;
        $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
        $id		=	'';
        $i		=	1; //记录 uid 数
        $start	=	($thisPage-1)*$perpage+1;
        $end	=	$thisPage*$perpage;
        while($row = $query->fetch_array()){
            if($i >= $start && $i <= $end){
                $id .=	$row['m_id'].',';
            }
            if($i > $end) break;
            $i++;
        }
        if($id) {
            $id		=	rtrim($id,',');
            $sql	=	"select * from k_money where m_id in($id) order by m_id desc";
            $query	=	$mysqli->query($sql);
            $sum_money	=	0;
            $sum_sxf	=	0;
            while($rows = $query->fetch_array()) {
                ?>
             
						<tr class="borderbtmgrey">
							<td class="algleft"><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
							<td>提款</td>
							<td><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
                            <td><?=sprintf("%.2f",abs($rows["sxf"]))?></td>
							<td ><?=$rows["m_order"]?></td>
							<td><?=$rows["about"]?></td>
							<td>   <?php
                        if($rows["status"] == 1) {
                            $sum_money += abs($rows["m_value"]);
                            $sum_sxf += $rows["sxf"];
                            echo '<span style="color:red">成功</span>';
                        } else if($rows["status"] == 0) {
                            echo '<span style="color:blue">失败</span>';
                        } else {
                            echo '<span>处理中</span>';
                        }
                        ?> </td>
							
							
						</tr>
						
			<?php } }?>
						 

						<tr>
							<td colspan="8"><div class="page_info">
<span class="record">共<?=$sum?>条记录</span>
<span class="page_control">

<?=$page->get_htmlPage("data_t_money.php?")?>

</span>
</div>
</td>
						</tr>

					</tbody>
				</table>

			</div>

		</div>


	</div>


</body></html>
