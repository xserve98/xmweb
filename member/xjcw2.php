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
include_once("../include/newpage.php");
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");	
	
if($_GET["bdate"]){
$bdate	=	$_GET["bdate"];

}
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
if($_GET["edate"]){
	$edate	=	$_GET["edate"];
	
	}
$edate	=	$edate==""?date("Y-m-d",time()):$edate;




$topuid=	$_GET["topuid"];
$topname=	$_GET["topuid"];
$xjname=	$_GET["username"];

$type	=	$_GET["type"];

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
<div class="main report" style="width: 960px !important;">
<div class="search">

<form name="form1" method="GET" action="xjcw2.php" >
      
		
		  &nbsp;开始日期
          <input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
	
		&nbsp;结束日期
          <input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
	
		<select name="type" id="type">
            <option value="" <?=$type==''?'selected':''?>>全部</option>
            <option value="1" <?=$type=='1'?'selected':''?>>存款</option>
            <option value="7" <?=$type=='7'?'selected':''?>>汇款</option>
            <option value="2" <?=$type=='2'?'selected':''?>>取款</option>
			<option value="3" <?=$type=="3"?"selected":""?>>人工汇款</option>
			<option value="4" <?=$type=="4"?"selected":""?>>彩金派送</option>
            <option value="100" <?=$type=="100"?"selected":""?>>投注扣款</option>
			<option value="200" <?=$type=="200"?"selected":""?>>投注返点</option>
			<option value="300" <?=$type=="300"?"selected":""?>>开奖派奖</option>
            <option value="400" <?=$type=="400"?"selected":""?>>注册送金</option>
			<option value="6" <?=$type=="6"?"selected":""?>>其他情况</option>
          </select>
		
        &nbsp;<input name="find" type="submit" id="find" value="查找"/></td>

	</form>
</div> 

<?php

$arr		=	array();
$arr_m		=	array();
$arr_m[1]	=	0; //存款
$arr_m[2]	=	0; //取款
$arr_m[3]	=	0; //汇款
$arr_m[4]	=	0; //人工汇款
$arr_m[5]	=	0; //彩金派送
$arr_m[6]	=	0; //反水派送
$arr_m[7]	=	0; //其他情况
$arr_m[8]	=	0; //彩金派送
$arr_m[9]	=	0; //反水派送
$arr_m[10]	=	0; //其他情况



$sqlwhere	=	"";

if($type!=""){
	$sqlwhere	.=	" and type=$type";
}

	$q_btime	=	$bdate." "."00:00:00";
	$q_etime	=	$edate." "."23:59:59";


			$sqlwhere .=	" and uid= '$uid'";
			

//所有该会员的存款取款记录以及加减款
$sql		=	"SELECT  m_id,uid,parents, fxdltype FROM  `k_money2` WHERE  `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' ".$sqlwhere." order by m_id desc";
$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
while($row = $query->fetch_array()){

	  $m_id .=	$row['m_id'].',';  
}


if($m_id){
//所有该会员的存款取款记录以及加减款
   $m_id		=	rtrim($m_id,',');
   $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id) order by m_id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数

 while($row = $query->fetch_array()){

	$arr_key	=	strtotime($row['m_make_time']);
	while(array_key_exists($arr_key,$arr)){
		$arr_key++;
	}
	$arr[$arr_key]['username']	=	$row['username'];
	if($row['type'] == 1){ //存款
		$arr[$arr_key]['type']		=	'<span style="color:#006600;">存款</span>';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[1]				+=	$row['m_value'];
	}else if($row['type'] == 2){ //取款
		$arr[$arr_key]['type']		=	'<span style="color:#FF0000;">取款</span>';
		$arr[$arr_key]['money']	=	abs($row['m_value']);
		$arr_m[2]				+=	abs($row['m_value']);
	}else if($row['type']==3){ //人工汇款
		$arr[$arr_key]['type']		=	'人工汇款';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[4]				+=	$row['m_value'];
	}else if($row['type']==4){ //彩金派送
		$arr[$arr_key]['type']		=	'彩金派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[5]				+=	$row['m_value'];
	}else if($row['type']==5){ //反水派送
		$arr[$arr_key]['type']		=	'反水派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[6]				+=	$row['m_value'];
	}else if($row['type']==6){ //其他情况
		$arr[$arr_key]['type']		=	'其他情况';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[7]				+=	$row['m_value'];
	}
	else if($row['type']==100){ //其他情况
		$arr[$arr_key]['type']		=	'投注扣款';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[8]				+=	$row['m_value'];
	}
	else if($row['type']==200){ //其他情况
		$arr[$arr_key]['type']		=	'投注返点';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[9]				+=	$row['m_value'];
	}
	else if($row['type']==300){ //其他情况
		$arr[$arr_key]['type']		=	'开奖派奖';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[10]				+=	$row['m_value'];
	}
	else if($row['type']==400){ //其他情况
		$arr[$arr_key]['type']		=	'注册送金';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[11]				+=	$row['m_value'];
	}
		else if($row['type']==500){ //其他情况
		$arr[$arr_key]['type']		=	'牛牛扣担保金';
		$arr_m[12]				+=	$row['m_value'];
	}
	else if($row['type']==600){ //其他情况
		$arr[$arr_key]['type']		=	'牛牛退担保金';
	
		$arr_m[13]				+=	$row['m_value'];
	}
	
	
	
	$arr[$arr_key]['time'] 	    =	$row["m_make_time"];
	$arr[$arr_key]['lsh'] 		=	$row['m_order'];
	$arr[$arr_key]['uid'] 		=	$row['uid'];
	$arr[$arr_key]['about'] 	=	$row['about'];
	$arr[$arr_key]['assets'] 	=	$row['assets'];
	$arr[$arr_key]['m_value'] 	=	$row['m_value'];
	$arr[$arr_key]['balance'] 	=	$row['balance'];
	$arr[$arr_key]['url'] 		=	'../cwgl/tixian_show.php?id='.$row['m_id'];


}




}

?><table class="list table">
<thead><tr>
        <th width="9%"  ><strong>变动统计</strong></th> 
        <th width="9%"  ><strong>投注扣款</strong></th>
        <th width="9%" ><strong>投注返点</strong></th>
        <th width="9%" ><strong>开奖派奖</strong></th>
        <th width="9%" ><strong>存款</strong></th> 
        <th width="9%"><strong>取款</strong></th>
        <th width="9%" ><strong>汇款</strong></th>
         <th width="9%" ><strong>人工汇款</strong></td>      
            <td width="9%" ><strong>彩金派送</strong></th>
         <th width="9%" ><strong>注册送金</strong></th>
         <th width="9%" ><strong>其他情况</strong></th>
    </tr></thead>
        <tbody>
           <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td align="center" >全部合计</td>
        <td><?=sprintf("%.2f",$arr_m[8])?></td>
        <td><?=sprintf("%.2f",$arr_m[9])?></td>
        <td><?=sprintf("%.2f",$arr_m[10])?></td>
        <td><?=sprintf("%.2f",$arr_m[1])?></td>
           <td><?=sprintf("%.2f",$arr_m[2])?></td>
              <td><?=sprintf("%.2f",$arr_m[3])?></td>
                 <td><?=sprintf("%.2f",$arr_m[4])?></td>
                  <td><?=sprintf("%.2f",$arr_m[5])?></td>
                   <td><?=sprintf("%.2f",$arr_m[11])?></td>
                  <td><?=sprintf("%.2f",$arr_m[6])?></td>

        </tr>
  
  </tbody>

</table>





<table class="list table" style="font-size: 12px !important;">
<thead><tr>
  <tr bgcolor="efe" class="t-title" align="center">
        <th  ><strong>编号</strong></th>
        <th  ><strong>用户名</strong></th>
        <th width="12%" ><strong>类型</strong></th>
        <th width="20%" ><strong>系统订单号</strong></th>
      
        <th width="10%"><strong>变动前</strong></th>
         <th width="10%"><strong>变动金额</strong></th>
          <th width="10%"><strong>余额</strong></th>
        <th width="20%" ><strong>提交时间</strong></th>
        </tr>

</tr>
</thead>
<tbody>



<?php


$sqlwhere	=	"";
$sqlwhere .=	" and uid= '$uid'";
			
if($type!=""){
	
	
 $sqlwhere	.=	" and type=$type";
}
$q_btime	=	$bdate." "."00:00:00";
$q_etime	=	$edate." "."23:59:59";
//所有该会员的存款取款记录以及加减款
$sql		=	"SELECT * FROM  `k_money2` WHERE  `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' ".$sqlwhere." order by m_id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数

while($row = $query->fetch_array()){
	  
	 
 if($topuid){
        $parentarr=explode(',',$row['parents']);
		$wz1=array_search($row['uid'],$parentarr);
		$wz2=array_search($topuid,$parentarr);
		$wz=$wz1-$wz2;
		
if($topdltype==0&&$row['fxdltype']==0&&$dltype==0){
	    if($wz<=$topjs){
	           $m_id22 .=	$row['m_id'].',';      
	                   }
   } else{
	 
      $m_id22 .=	$row['m_id'].',';  
		                      }
}else{
	  $m_id22 .=	$row['m_id'].',';  
	
	}
	
}


if($m_id22){
	
	      $m_id22		=	rtrim($m_id22,',');
		  $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id22) order by m_id desc";
          $query	=	$mysqli->query($sql);
          $sum	=	$mysqli->affected_rows; //总页
	
	
	
	  $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
            }
            $page		=	new newPage();
            $perpage	= 	20;
            $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
            $id		=	'';
            $i		=	1;
            $start	=	($thisPage-1)*$perpage+1;
            $end	=	$thisPage*$perpage;


	 



while($row = $query->fetch_array()){
  ///echo $i.'---'.$start.'---'.$end.'|';
	
if($i >= $start && $i <= $end){
	$m_id2 .=	$row['m_id'].',';
}
if($i > $end) break;
	$i++;	
	}
}



	  if($m_id2) {  
	   
	       $m_id2		=	rtrim($m_id2,',');
		  $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id2) order by m_id desc";
	
$query	=	$mysqli->query($sql);
$sum	=	$mysqli->affected_rows; //总页数
while($row = $query->fetch_array()){

	$arr_key2	=	0;
	while(array_key_exists($arr_key2,$arr2)){
		$arr_key2++;
	}
	if($row['type'] == 1){ //存款
		$arr2[$arr_key2]['type']		=	'<span style="color:#006600;">存款</span>';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[1]				+=	$row['m_value'];
	}else if($row['type'] == 2){ //取款
		$arr2[$arr_key2]['type']		=	'<span style="color:#FF0000;">取款</span>';
		$arr2[$arr_key2]['money']	=	abs($row['m_value']);
		$arr_m[2]				+=	abs($row['m_value']);
	}else if($row['type']==3){ //人工汇款
		$arr2[$arr_key2]['type']		=	'人工汇款';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[4]				+=	$row['m_value'];
	}else if($row['type']==4){ //彩金派送
		$arr2[$arr_key2]['type']		=	'彩金派送';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[5]				+=	$row['m_value'];
	}else if($row['type']==5){ //反水派送
		$arr2[$arr_key2]['type']		=	'反水派送';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[6]				+=	$row['m_value'];
	}else if($row['type']==6){ //其他情况
		$arr[$arr_key2]['type']		=	'其他情况';
		$arr[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[7]				+=	$row['m_value'];
	}
	else if($row['type']==100){ //其他情况
		$arr2[$arr_key2]['type']		=	'投注扣款';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[8]				+=	$row['m_value'];
	}
	else if($row['type']==200){ //其他情况
		$arr2[$arr_key2]['type']		=	'投注返点';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[9]				+=	$row['m_value'];
	}
	else if($row['type']==300){ //其他情况
		$arr2[$arr_key2]['type']		=	'开奖派奖';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[10]				+=	$row['m_value'];
	}
	else if($row['type']==400){ //其他情况
		$arr2[$arr_key2]['type']		=	'注册送金';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[11]				+=	$row['m_value'];
	}
		else if($row['type']==500){ //其他情况
		$arr2[$arr_key2]['type']		=	'牛牛扣担保金';
		$arr_m[12]				+=	$row['m_value'];
	}
	else if($row['type']==600){ //其他情况
		$arr2[$arr_key2]['type']		=	'牛牛退担保金';
		$arr_m[13]				+=	$row['m_value'];
	}
	
	
	
	$arr2[$arr_key2]['username']	=	$row['username'];
	$arr2[$arr_key2]['time'] 	=	$row["m_make_time"];
	$arr2[$arr_key2]['lsh'] 		=	$row['m_order'];
	$arr2[$arr_key2]['uid'] 		=	$row['uid'];
	$arr2[$arr_key2]['about'] 	=	$row['about'];
	$arr2[$arr_key2]['assets'] 	=	$row['assets'];
	$arr2[$arr_key2]['m_value'] 	=	$row['m_value'];
	$arr2[$arr_key2]['balance'] 	=	$row['balance'];
	$arr2[$arr_key2]['url'] 		=	'../cwgl/tixian_show.php?id='.$row['m_id'];
    }
}
  		  $urlarr=$_GET;
		  $arrurl=array_keys($urlarr);
	 for($i=0;$i<count($arrurl);$i++){	  
		$str .= $arrurl[$i].'='.$urlarr[$arrurl[$i]].'&';	  
		  }  
		    $url ='xjcw2.php?'.$str;

$n	=	($thisPage-1)*20+1;
//echo json_encode($arr);

foreach($arr2 as $k=>$v){
	
?>



 <tr  >
        <td ><?=$n++?></td>
        <td class="time"><?=$v["username"]?></td>
        <td><?=$v["type"]?></td>
      
       <td class="period"><span class="lottery"><?=$v["about"]?></span></td> 
     
         
              <td  style="color:#999999;"><?=$v["assets"]?></td>
              <td align="center" style="color:#225d9c;"><?=$v["m_value"]?></td>
              <td align="right" style="color:#F90A0A;"><?=$v["balance"]?></td>
               
        <td><?=$v["time"]?></td>
        </tr>
      <?
	}
      ?>
      

</tbody>

</table>
<?=$page->get_htmlPage($url);?>
<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>