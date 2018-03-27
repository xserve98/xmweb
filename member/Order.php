<?php
session_start();
include_once("../include/config.php"); 
///include_once("../common/login_check.php"); 
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

$type=$_GET['type'];
$type=='' ? $se1 = '#FF0' : $se1 = '#FFF';
$topname=$_GET["topuid"];
if($_GET["topuid"]) {
	$name =$_GET["topuid"];
	$sqla="select * from k_user where username = '$name'  limit 1";
	
	$query	 =	$mysqli->query($sqla);
    $rs	 =	$query->fetch_array();
if(strpos($rs['parents'],$uid)==-1){
		  message('$_GET["topuid"]'.'不是你的下级，你无权限查看');
		
		}
	}



if($_GET["topuid"]) {
	$name= $_GET["topuid"];
    $sql_user	 =	"select * from k_user where username='$name' limit 1"; //取汇款前会员余额
}else{

    $sql_user	 =	"select * from k_user where uid='$uid' limit 1"; //取汇款前会员余额
	}
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 
 $topjs = $rs['fdjishu'];
 $topdltype=$rs['fxdltype'];
 $dltype=$rs['dltype'];
 $topusername = $rs['username'];
 $topuid=$rs['uid'];



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

<form name="form1" method="GET" action="order.php" >
  		<select name="type" >
        	<option value="">所有彩种</option>
        	        	<option value="所有彩种">所有彩种</option>
        	<option value="重庆时时彩">重庆时时彩</option>
            <option value="江西时时彩">江西时时彩</option>
            	<option value="新疆时时彩">新疆时时彩</option>
            <option value="新疆时时彩">新疆时时彩</option>
            	<option value="幸运飞艇">幸运飞艇</option>
            <option value="重庆幸运农场">重庆幸运农场</option>
            	<option value="广东快乐十分">广东快乐十分</option>
            <option value="北京快乐8">北京快乐8</option>
            	<option value="PC蛋蛋">PC蛋蛋</option>
            <option value="加拿大28">加拿大28</option>
            <option value="福彩3D">福彩3D</option>
            <option value="体彩排列三">体彩排列三</option>
              <option value="极速分分彩">极速分分彩</option>
              <option value="幸运2分彩">幸运2分彩</option>
             <option value="极速六合彩">极速六合彩</option>
            <option value="极速PC蛋蛋">极速PC蛋蛋</option>
              <option value="北京赛车(PK10)">北京赛车(PK10)</option>
              <option value="极速赛车(PK10)">极速赛车(PK10)</option>
              <option value="香港六合彩">香港六合彩</option>
        </select>

    <select name="js" id="js">
	  <option value="0,1" <?=$_GET['js']=='0,1' ? 'selected' : ''?>>全部注单</option>
            <option value="0"  style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
          
          </select>&nbsp;&nbsp;
          会员：<input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="10">
         
          &nbsp;代理  <input name="topuid" type="text" id="topuid" value="<?=$topname?>" size="10" maxlength="10"/>
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
           
            &nbsp;&nbsp;
            <input type="submit" name="Submit" value="搜索">
       
  </form> 
</div> 
<table class="list table">
<thead><tr><th>注单号</th><th>会员名</th><th>时间</th><th>类型</th><th>玩法</th><th>下注金额</th><th>结果</th><th>开奖结果</th></tr></thead>
<tbody>
<?php
//////////代理查询功能
  
	
	   $js='0,1';
	  if(isset($_GET["js"])){
		  $js=$_GET["js"];
		  }  
	    $sql	=	"select * from c_bet2 " ;
	    $sql.=" where `js` in (".$js.")";
      if($type) $sql.=" and type='".$type."'";
	 if($_GET["uid"]) $uid = $_GET["uid"];
	
	
	  if($_GET["username"]){
		    $username=$_GET["username"];
		$sql	.=	" and username='$username'";
		}else{
			  $sql.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
			}
	  
	 if($_GET["s_time"]) $sql.=" and addtime>='".$_GET["s_time"]." 00:00:00'";
	 if($_GET["e_time"]) $sql.=" and addtime<='".$_GET["e_time"]." 23:59:59'";
	
	 if($_GET['tf_id']) $sql.=" and money>".$_GET['tf_id']."";
	  $order = 'id';
	 if($_GET['order']) $order = $_GET['order'];
	 $sql.=" order by $order desc "; 
///	echo $sql;
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
  while($row = $query->fetch_array()){
	
/*
        $parentarr=explode(',',$row['parents']);
		$wz1=array_search($row['uid'],$parentarr);
		$wz2=array_search($topuid,$parentarr);
		$wz=$wz1-$wz2;
		//echo json_encode( $parentarr);
		//echo 'topdltype:'.$topdltype."|---dltype:".$dltype."|--fxdltype".$row['fxdltype']."|";
  if($topdltype==0&&$row['fxdltype']==0&&$dltype==0){
	
	    if($wz<=$topjs){
	           $id .=	$row['id'].',';      
	                   }
                   } else{ 
      $id .=	$row['id'].',';  
		                      }
   }*/
   if($topuid){
        $parentarr=explode(',',$row['parents']);
		$wz1=array_search($row['uid'],$parentarr);
		$wz2=array_search($topuid,$parentarr);
		$wz=$wz1-$wz2;
		///echo 'topdltype:'.$topdltype."|---dltype:".$dltype."|--fxdltype".$row['fxdltype']."|";
	
if($topdltype==0&&$row['fxdltype']==0&&$dltype==0){
	    if($wz<=$topjs){
	       $id .=	$row['id'].',';      
	                   }
                              } 
else{
	 
   $id .=	$row['id'].',';  
		                      }
 }else{
  $id .=	$row['id'].',';  
	
	}
	
}
	
	
	



	  if($id){
		     $id		=	rtrim($id,',');
	     $sql	=	"select id from c_bet2  where `id` IN ($id) order by id desc " ;   
		   $query	=	$mysqli->query($sql);
	      $sum	=	$mysqli->affected_rows; //总页
	//  echo $sum;

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
	  	  if($i >= $start && $i <= $end){
	  	  	$bid .=	$row['id'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select * from c_bet where id in($bid) order by $order desc";
	  	$query	=	$mysqli->query($sql);
		
		$paicai	=	0;
		$sum_tz	=	0;
		$sum_pc	=	0;
		
      	while ($rows = $query->fetch_array()) {	  
		  $color = "#FFFFFF";
		  $over	 = "#EBEBEB";
		  $out	 = "#ffffff";
		  
		  if($rows['js']==0){
			$paicai	=	0;
		  }else{
			  
				if($rows["win"]>0){
                
					$yk += ($rows["win"]-$rows['money']);
					}else{
						$yk += $rows['win'];
						
						}
						  
			  
			if($rows['win']==0){
				$paicai	=	$rows['money'];
			}else if($rows['win']<0){
				$paicai	=	0;
			}else{
				$paicai	=	$rows['win'];
			}
			
			
		  }
		  
		  $sum_tz	+=	$rows['money'];
		  $sum_pc	+=	$paicai;
	  $urlarr=$_GET;
		  $arrurl=array_keys($urlarr);
	 for($i=0;$i<count($arrurl);$i++){	  
		$str .= $arrurl[$i].'='.$urlarr[$arrurl[$i]].'&';	  
		  }  
		    $url ='order.php?'.$str;
      	?>



<tr class="">
<td><?= $rows["id"] ?></td>
<td class="time"><?= $rows["username"] ?></td>
<td class="time"><?= $rows["addtime"] ?></td>
<td class="period"><span class="lottery"><?= $rows["type"] ?></span><br><span class="draw_number">第 <?= $rows["qishu"] ?> 期</span></td>
<td class="contents"><span class="text"><?= $rows["mingxi_1"] ?> <?= $rows["mingxi_2"] ?></span> @ <span class="odds"><?= $rows["odds"] ?></span></td>

<td class="amount"><?= $rows["money"] ?></td>

<td class="result color minus"><?= $rows["win"] ?></td>
<td class="result color minus"><?= $rows["jieguo"] ?></td>
</tr>
    <?php
                }
            } ?>

</tbody>
<tfoot>
<tr><td></td><td></td><td></td><th >总投注</th><td class="result color"><?= $sum_tz ?></td><td>中奖合计</td><td class="result color"><?= double_format($sum_pc) ?></td><td class="result color">盈亏：<?= $yk ?></td></tr>
</tfoot>
</table>
<?=$page->get_htmlPage($url);?>
<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>