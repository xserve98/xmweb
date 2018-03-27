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

$money = 0;
$ky = 0;
$jine = 0;
$sub = 2;

 $sql_user	 =	"select * from k_user where uid=$uid limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 $xtjs = $rs['fdjishu'];
 /////日期选择////
 function getlastmonth($date){
	$firstday 	= 	date('Y-m-d', strtotime("$date -1 month +1 day"));
	$lastday 	= 	date('Y-m-d', strtotime("$firstday +1 month - 1 day "));
	return array($firstday,$lastday);
}
$lastmonth	=	getlastmonth(date("Y-m-d",time()));
 $cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?$lastmonth[0]:$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?$lastmonth[1]:$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$cn_begin_time	=	date("Y-m-d H:i:s",strtotime($begin_time));
$cn_end_time	=	date("Y-m-d H:i:s",strtotime($end_time));
 ///////////////////////

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>交易记录彩票</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
     <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>

</head>
<body>
<div class="wrap">
 <?php include_once("agentmenu.php"); ?>
    <?php include_once("recordmenu.php"); ?>
    	    
    <div class="content">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr class="tic">
               <td width="15%">会员</td>
                  <td width="15%">会员级别</td>
                <td width="15%">彩种/投注时间</td>
                <td width="15%">注单号/模式</td>
                <td width="20%">投注详细信息</td>
                <td width="15%">下注金额</td>
                <td>结果</td>
                <td>可赢</td>
            </tr>
            <?php
			
            $sql1 = "select id from s_bet where concat(',',parents,',') like '%,$uid,%'  ";
			if($_GET['sql']){
		        $sql1 = urldecode(base64_decode($_GET['sql']));
			   ///$query	=	$mysqli->query($sql1);
			}
			$para=$_GET;
			
					if($para['utype']){
				if($para['utype']==3){
			      $sql1 = "select id from s_bet where concat(',',parents,',') like '%,$uid,%'  ";
				     
				}
				
		else if($para['utype']==2) {
			     $sql1 = "select id from s_bet where top_uid=$uid ";
				  
				}
				
				
				}
			
			if($para['type']){
				if($para['type']=="所有彩种"){
					$sql1.="";

					}else{
						
							$sql1.=" and type ='{$para['type']}'";
						}
				
				
				}
				
			if($para['username']){
				if($para['username']==""){
					$sql1.="";

					}else{
						
				$sql1.=" and username ='{$para['username']}'";
						}
				
				
				}
				
				$js = intval($para['state']);
			if($para['state']){
				if($para['state']==2){
			       $sql1.="";
				     
				}
				
		else if($para['state']==1) {
			   
				      $sql1.=" and js =1	";
				}
				else if($para['state']==3) {
					
					   $sql1.=" and js =0	";
					
					}
				
				
				}
$cn_begin = date($para['cn_begin']);$cn_end=date($para['cn_end']);
$cn_begin_time	=	date("Y-m-d H:i:s",strtotime($para['cn_begin']));

	if($para['cn_begin'] && $para['cn_end']){
		$sql1.= " and addtime>='$begin_time' and addtime<='$end_time'";
	}elseif($para['cn_begin']){
		$sql1.= " and addtime>='$begin_time'";
	}elseif($para['cn_end']){
		$sql1.= " and addtime<='$end_time'";
	}	
			
				
				
				
			 $urlsql=base64_encode(urlencode($sql1));
			$url = "agent_record_ss.php?sql={$urlsql}&";
			echo $sql1.'----'.$urlsql;
            $query	=	$mysqli->query($sql1);
            $sum	=	$mysqli->affected_rows; //总页数
            $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
				
				
            }
            $page		=	new newPage();
            $perpage	= 	10;
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
                <tr align="center">
                    <td colspan="6">暂无记录！</td>
                </tr>
                <?php
            } else {
                $id = rtrim($id,',');
                $sql = "select * from s_bet where id in($id) order by id desc";
                $query	=	$mysqli->query($sql);
                while($rows = $query->fetch_array()){
                    $money += $rows["money"];
                    $ky += $rows["win"] + $rows["fs"];
                    ?>
                       <?php 
					 $parents = $rows["parents"];
					 $parr=explode(',', $parents);
					///$wz = array_keys($parr,$uid,true) ;
					$jishu=count($parr)-1;
					 if($jishu<=$xtjs){ 
						 ?>
                   
                    
                    <tr class="list">
                       <td><?= $rows['username'] ?></td>
                       <td><?= $jishu ?>级下线</td>
                        <td><?= $rows['type'] ?><br/><?php echo date('m-d H:i:s', strtotime($rows["addtime"])); ?></td>
                        <td><?= $rows["id"] ?><br/>第 <?= $rows["qishu"] ?> 期</td>
                        <td>
                            <? if ($rows['type'] == '香港六合彩') { ?>
                                <?= $rows["mingxi_1"] ?><?= $rows["sm"] ? '(' . $rows["sm"] . ')' : '' ?><br><span class="c_red"><?= $rows["mingxi_2"] ?></span> @ <span class="c_red"><?= $rows["odds"] ?></span>
                            <? } else { ?>
                                <?= $rows["mingxi_1"] ?>【<span class="c_red"><?= $rows["mingxi_2"] ?></span>】 @ <span class="c_red"><?= $rows["odds"] ?></span>
                            <? } ?>
                        </td>
                        <td><?= $rows["money"] ?></td>
                        <td><?= $rows["jieguo"] ? $rows["jieguo"] : '未知' ?></td>
                        <td>
                            <?php
                            $jine = 0;
                            $jine = $rows["win"] + $rows["fs"];
                            echo double_format($jine);
                            ?>
                        </td>
                    </tr>
                      <?php } ?>
                    
                <?php
                }
            } ?>
        </table>
        <table cellspacing="0" cellpadding="0" border="0" class="page">
            <tr>
                <td align="left">本页总投注金额：<span class="c_red"><?= $money ?></span> RMB，最高可赢金额：<span class="c_red"><?= double_format($ky) ?></span> RMB</td>
                <td align="right"><?=$page->get_htmlPage($url);?></td>
            </tr>
        </table>
    </div>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>