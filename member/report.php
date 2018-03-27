<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     	= 	$_SESSION['uid'];
$loginid 	= 	$_SESSION['user_login_id'];
$username	=	$_SESSION["username"];
renovate($uid,$loginid);

$arr_ds	=	array(); //单式
$arr_fc	=	array(); //单式
$arr_cg	=	array(); //串关
$arr_ck	=	array(); //存款
$arr_hk	=	array(); //汇款
$arr_qk	=	array(); //取款
$arr_zrzr	=	array(); //真人转入
$arr_zrzc	=	array(); //真人转出
$total  =   0;
$tytz=$cgtz=$cptz=0;
$tyyl=$cgyl=$cpyl=$zyl=0;
$zrzr=$zrzc=0;
$ck=$hk=$qk=0;

//默认显示1周
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date('Y-m-d',strtotime("-1 week")):$bdate;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$b_time	=   $bdate." 00:00:00";
$e_time	=	$edate." 23:59:59";
$szbdate =date('Y-m-d',strtotime("-2 week"));
$szedate =date('Y-m-d',strtotime("-1 week"));
$bybdate =date('Y-m-d',strtotime("-1 month"));
$byedate =date('Y-m-d',time());



function get_week($date){
    //强制转换日期格式
    $date_str=date('Y-m-d',strtotime($date));
    //封装成数组
    $arr=explode("-", $date_str);
    //参数赋值
    //年
    $year=$arr[0];
    //月，输出2位整型，不够2位右对齐
    $month=sprintf('%02d',$arr[1]);
    //日，输出2位整型，不够2位右对齐
    $day=sprintf('%02d',$arr[2]);
    //时分秒默认赋值为0；
    $hour = $minute = $second = 0;
    //转换成时间戳
    $strap = mktime($hour,$minute,$second,$month,$day,$year);
    //获取数字型星期几
    $number_wk=date("w",$strap);
    //自定义星期数组
    $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
    //获取数字对应的星期
    return $weekArr[$number_wk];
  }



?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome</title>
<link href="/js/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="/newdsn/js/report.js"></script>
<script type="text/javascript" src="/newdsn/js/history.js"></script>
<script type="text/javascript" src="../js/laydate.js"></script>
<script type="text/javascript">
var TODAY=(new Date()).valueOf();
</script>
</head>
<body class="skin_blue">
<?php include_once("agentmenu.php"); ?>
<div class="main history">
<div class="search">

<form id="form1" name="form1" action="?query=true" method="get" style="float: left;">
 <span id="date"> 日期范围: 
<input name="bdate" type="text" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$bdate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
 —   <input name="edate" type="text" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$edate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />

<button type="submit" name="query" class="btn today" style="margin-left: 15px">查询</button>
</span>
</form>

<form id="form1" name="form1" action="?query=true" method="get" style="float: left;">

<input name="bdate" type="hidden" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$szbdate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
 <input name="edate" type="hidden" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$szedate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />

<button type="submit" name="query" class="btn today" style="margin-left: 15px">上星期</button>

</form>
<form id="form1" name="form1" action="?query=true" method="get" style="float: left;">

<input name="bdate" type="hidden" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$bybdate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
  <input name="edate" type="hidden" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$byedate?>" onClick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />

<button type="submit" name="query" class="btn today" style="margin-left: 15px">本月</button>

</form>
</div> <br>
<table class="list table" style="font-size: 12px;">
<thead><tr>
<th width="16%" class="date">日期</th>
<th  width="14%" class="count">总注数</th>
<th width="14%" class="amount">总金额</th>
<th width="14%"class="cm">已结算注数</th>
<th width="14%" class="amount">已结算金额</th>
<th width="14%" class="amount">中奖金额</th>
<th width="14%" class="amount">盈亏</th>
</tr></thead>
<tbody style="font-size: 12px;">
<?php


  $where="where `addtime`>='$b_time' and `addtime`<='$e_time' and uid='$uid' ";
  $sql ="select *,sum(if(js='1',summoney,0 )) AS jiesuan,
sum(if(js='0',summoney,0 )) AS wjiesuan,
sum(if(js='1',sumwin,0 )) AS shuyin,
sum(if(js='1',sumshu,0 )) AS shuyin2,
sum(if(js='0',sumwin,0 )) AS keyin,
sum(if(js='1',count,0 )) AS jscount,
sum(if(js='0',count,0 )) AS wjscount

from (SELECT *,
sum(money) as  summoney,
sum(if(win>0,win,0 )) AS sumwin,
sum(if(win>0,win-money,win )) AS sumshu,
count(id) as count
FROM
c_bet ".$where."
GROUP BY js,bet_date ) as tempa  GROUP BY bet_date ORDER BY `bet_date` DESC ";
 $query	=	$mysqli->query($sql);
///echo $sql;
$sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
	// echo $sql;
	$sum_touzhu=0;
	$sum_count=0;
	$sum_jiesun=0;
	$sum_wjiesuan=0;
	$sum_jscount=0;
	$sum_shuyin=0;
	$sum_yk=0;
  while($row = $query->fetch_array()){
	  
	   $sum_jiesun += $row['jiesuan'];
	   $sum_wjiesun += $row['wjiesuan'];
	   $sum_jscount   += $row['jscount'];
	   $sum_count   += $row['jscount']+$row['wjscount'];
	   $sum_shuyin +=  $row['shuyin'];
	   $sum_yk    += $row['shuyin2'];
       $sum_touzhu += $row['jiesuan']+$sum_wjiesun;

?>

<tr class="">
<td width="16%" clss="date"><a href="/member/cha_cp.php?date=<?=$row["bet_date"]?>"><?=$row["bet_date"]?><BR><?=get_week(DATE($row["bet_date"]))?></a></td>
<td width="14%"><?=$row["jscount"]+$row["wjscount"]?></td>
<td class="money"><?=sprintf("%.2f",$row["jiesuan"]+$row["wjiesuan"])?></td>
<td width="14%"><?=sprintf("%.2f",$row["jscount"])?></td>
<td  width="14%" class="money"><?=sprintf("%.2f",$row["jiesuan"])?></td>
<td width="14%" class="money"><?=sprintf("%.2f",$row["shuyin"])?></td>
<td width="14%" class="result"><?=sprintf("%.2f",$row["shuyin2"])?></td>
</tr>

<?php } ?>
</tbody>
<tfoot>
<tr>
<th width="16%">合计</th>
<td width="14%"><?=$sum_count?></td>
<td width="14%" class="money"><?=sprintf("%.2f",$sum_touzhu)?></td>
<td width="14%" class="money"><?=$sum_jscount?></td>
<td width="14%" class="result color minus"><?=sprintf("%.2f",$sum_jiesuan)?></td>
<td width="14%" class="result color minus"><?=sprintf("%.2f",$sum_shuyin)?></td>
<td width="14%" class="result color minus"><?=sprintf("%.2f",$sum_yk)?></td></tr>
</tfoot>
</table>
</div>

<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>