<?php
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
$lm = 3;

$cn_begin = $_GET["cn_begin"];
$s_begin_h = $_GET["s_begin_h"];
$s_begin_i = $_GET["s_begin_i"];
$cn_begin = $cn_begin == "" ? date("Y-m-d", time()) : $cn_begin;
$cn_end = $_GET["cn_end"];
$cn_end = $cn_end == "" ? date("Y-m-d", time()) : $cn_end;

$begin_time = $cn_begin . " 00:00:00";
$end_time = $cn_end . " " . "23:59:59";
$where="and `addtime`>='$begin_time' and `addtime`<='$end_time'  ";
if($_GET["type"]){
if($_GET["type"]=='所有彩种'){
	$where .=$where;	
	}else{
		$type =$_GET["type"];
		$where .= "and type='$type'";
		}}
	
$money = 0;
$ky = 0;
$yk = 0;
$jine = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="images/member.js"></script>
 <script type="text/javascript" src="../js/laydate.js"></script>
</head>
<body class="skin_blue">
<div class="main report">
<div class="search">
<form name="form1" method="GET" action="cha_cp.php" >
  		<select name="type" >
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

    <span>开始日期</span>
                        <input name="cn_begin" type="text" id="cn_begin" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />至 <span style="margin-left: 15px">结束日期</span>
                        <input name="cn_end" type="text" id="cn_end" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
         
    
         <input type="submit" value="查 询"/>
  </form> 
</div> 
<table class="list table" style="font-size: 12px;">
<thead><tr><th>注单号</th><th>时间</th><th>类型</th><th>玩法</th><th>下注金额</th><th>结果</th><th>开奖结果</th></tr></thead>
<tbody>
<?php

     
		
		 
		  
		  $urlarr=$_GET;
		  $arrurl=array_keys($urlarr);
	 for($i=0;$i<count($arrurl);$i++){	  
		$str .= $arrurl[$i].'='.$urlarr[$arrurl[$i]].'&';	  
		  }  
		    $url ='cha_cp.php?'.$str;

            $sql = "select id from c_bet where uid=$uid and js=1 ".$where."  order by addtime desc";
			
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
            $i		=	1;
            $start	=	($thisPage-1)*$perpage+1;
            $end	=	$thisPage*$perpage;
            while($row = $query->fetch_array()){
                if($i >= $start && $i <= $end){
                    $id .=	$row['id'].',';
                }
                if($i > $end) break;
                $i++;
            }
            if(!$id) {
                ?>
               <tr><td class="nodata" colspan="8">暂无数据!</td></tr> 
                  <?php
            } else {
                $id = rtrim($id,',');
                $sql = "select * from c_bet where id in($id) order by id desc";
                $query	=	$mysqli->query($sql);
                while($rows = $query->fetch_array()){
                    $money += $rows["money"];
					if($rows["win"]>0){
                    $ky += $rows["win"];
					$yk += ($rows["win"]-$rows['money']);
					}else{
						$yk += $rows['win'];
						
						}
					
                    ?>


<tr class="">
<td><?= $rows["id"] ?></td>
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
<tr><td></td><td></td><th>投注合计：</th><td class="result color"><?= $money ?></td><th>中奖合计：</th><td class="result color"><?= double_format($ky) ?></td><td class="result color">盈亏：<?= $yk ?></td></tr>
</tfoot>
</table>
<div style="font-size: 16px;text-align: center;margin-top: 12px;">
<?=$page->get_htmlPage($url);?>
	</div>
<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>