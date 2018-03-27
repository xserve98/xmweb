<?php
include_once("../common/login_check.php"); 
///check_quanxian("bbgl");
include_once("../../cache/hlhy.php");
include_once("../../include/mysqli.php");
include_once("../../include/newPage.php");
	  
$date_start		=	$_GET["start"];
$date_end		=	$_GET["end"];
$type			=	$_GET["type"];
$wtype			=	$_GET["wtype"];
$wtarr			=	wtype($wtype);
$date_start1	=	date("Y-m-d H:i:s",strtotime($date_start)); //取中国时间-43200
$date_end1		=	date("Y-m-d H:i:s",strtotime($date_end)); //取中国时间-43200
$username		=	'';
$lstime			=	date('Y-m-d',strtotime("$date_start -1 day"));
$lsjl			=	array();
if(isset($_GET['username'])){
	$arr_un		=	explode(',',$_GET['username']);
	foreach($arr_un as $k=>$v){
		$username .= "'".$v."',";
	}
	$username	=	rtrim($username,",");
} 

function get_m_value($uid){ //获取总存款/取款/汇款
	global $k_money_arr;
	global $hk_money_arr;
	$ck = 0;
	$qk = 0;
	$zs = 0;
	if(isset($k_money_arr[$uid])){
		$arr_money = $k_money_arr[$uid];
		$x = count($arr_money);
		for($i=0; $i<$x; $i++){
			if($arr_money[$i]["m_value"]>0){
				if($arr_money[$i]["about"]=='The order system is successful' || $arr_money[$i]["about"]=='该订单手工操作成功' || $arr_money[$i]["about"]==''){ //会员存款
					$ck+=$arr_money[$i]["m_value"];
					$zs+=$arr_money[$i]["sxf"]; //要减去YB 1%手续费 算成是退水
				}else{ //系统赠送的钱，算在退水中
					$zs+=$arr_money[$i]["m_value"];
				}
			}else{
				$qk+=$arr_money[$i]["m_value"];
				$zs+=$arr_money[$i]["sxf"]; //取款手续费
			}
		}
	}
	if(isset($hk_money_arr[$uid])){
		$arr_money = $hk_money_arr[$uid];
		$x = count($arr_money);
		for($i=0; $i<$x; $i++){
			$ck+=$arr_money[$i]["m_value"];
			$zs+=$arr_money[$i]["zsjr"];
		}
	}
	
	if($ck == ""){
		$ck = 0;
	}
	
	if($qk == ""){
		$qk = 0;
	}else{
		$qk = substr($qk,1);
	}
	
	$arr[0] = double_format($qk);
	$arr[1] = double_format($ck);
	$arr[2] = $zs;
	return $arr;
}

//获取下注的信息
function get_bet_num($uid){
	global $k_bet_arr; 
	global $k_bet_cg_group_arr;
	global $bet_point_array;
 
	$jine	=	0;
	$tsje	=	0;
	$win	=	0;

	if(isset($k_bet_arr[$uid])){
		$bet_count		=	count($k_bet_arr[$uid]);
		$betarr			=	$k_bet_arr[$uid];
		for($i=0; $i<$bet_count; $i++){
			$b_money	+=	$betarr[$i]["bet_money"];      ///获取单式下注总金额 
			$tsje 		+=	$betarr[$i]["fs"];
			if($betarr[$i]["status"] == 1 || $betarr[$i]["status"] == 2 || $betarr[$i]["status"] == 4 || $betarr[$i]["status"] == 5){     //////判断状态来计算有效金额
				$jine	+=	$betarr[$i]["bet_money"];
			}
			$win		+=	$betarr[$i]["win"]-$betarr[$i]["bet_money"]; ////计算输赢，ben_add为1时减本金，否则不减
		}
	}
 
	if(isset($k_bet_cg_group_arr[$uid])){
		$g_count		=	count($k_bet_cg_group_arr[$uid]);
		$garr			=	$k_bet_cg_group_arr[$uid];
		for($i=0; $i<$g_count; $i++){
			$g_money	+=	$garr[$i]["bet_money"];      ///获取串关下注总金额
			$tsje 		+=	$garr[$i]["fs"];
			if($garr[$i]["status"] == 1){     //////判断状态来计算有效金额
				$jine	+=	$garr[$i]["bet_money"];
			}
			$win		+=	$garr[$i]["win"]-$garr[$i]["bet_money"];
		}
	}

	$bm		=	$b_money + $g_money;
	$bnum	=	$bet_count + $g_count;

	$arr["win"]			=	0-$win;
	$arr["yx"]			=	$jine;
	$arr["bet_money"]	=	$bm;
	$arr["num"]			=	$bnum;
	$arr["ts"]			=	$tsje;
	
	return $arr;
}   

//取出符合条件的uid
$arr_uid	=	array();
if($username == ''){
	if($type == "Y"){ //查询所有过存款/取款/交易的会员
		$sql	=	"select uid from k_bet where match_coverdate>='$date_start' and match_coverdate<='$date_end' and lose_ok=1 and `status`>0 and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
		
		$sql	=	"select uid from k_bet_cg_group where `status` in(1,3) and match_coverdate>='$date_start' and match_coverdate<='$date_end' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
	
		$sql	=	"select uid from k_money where `status`=1 and type=1 and m_make_time>='$date_start1' and m_make_time<='$date_end1' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
		
		$sql	=	"select uid from huikuan where `status`=1 and adddate>='$date_start1' and adddate<='$date_end1' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
	}else{
		$sql	=	"select uid FROM k_bet WHERE match_coverdate>='$date_start' AND match_coverdate<='$date_end' and lose_ok=1 AND `STATUS`=0 and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
		
		$sql	=	"select uid from k_bet_cg_group where `status` in(0,2) and match_coverdate>='$date_start' and match_coverdate<='$date_end' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
	
		$sql	=	"select uid from k_money where `status`=1 and `type`=1 and m_make_time>='$date_start1' and m_make_time<='$date_end1' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
	
		$sql	=	"select uid from huikuan where `status`=1 and adddate>='$date_start1' and adddate<='$date_end1' and guest=0";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$arr_uid[$rows['uid']]	=	$rows['uid'];
		}
	}
}else{
	$sql 		=	"select uid from k_user where username in ($username) and guest=0";
	$query		=	$mysqli->query($sql);
	while($rows =	$query->fetch_array()){
		$arr_uid[$rows['uid']]	=	$rows['uid'];
	}
}
$arr_uid	=	array_unique($arr_uid); //去重复值
asort($arr_uid); //从小到大排序

//分页操作
$sum		=	count($arr_uid); //总个数
$thisPage	=	1;
if($_GET['page']){
  $thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,50);

$uid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
foreach($arr_uid as $k=>$v){
  if($i >= $start && $i <= $end){
	$uid .=	$v.',';
  }
  if($i > $end) break;
  $i++;
}
if($uid == '') exit;
else{
	$uid	=	rtrim($uid,',');
	if($type == "Y"){ //查询所有过存款/取款/交易的会员
		$sqlb	=	"select b.uid,b.point_column,b.match_type,b.bet_money,b.status,b.win,b.ben_add,b.fs from k_bet b where b.match_coverdate>='$date_start' and lose_ok=1 and b.status>0 and b.match_coverdate<='$date_end' and b.uid in ($uid)";

		$sqlg	=	"select x.uid,x.gid,x.win,x.bet_money,x.status,x.fs from k_bet_cg_group x where x.status in(1,3) and x.match_coverdate>='$date_start' and x.match_coverdate<='$date_end' and x.uid in ($uid)";

		$sqlm	=	"select m.uid,m.m_value,m.about,sxf from k_money m where m.status=1 and m.type=1 and m.m_make_time>='$date_start1' and m.m_make_time<='$date_end1' and m.uid in ($uid)";
		
		$sqlh	=	"select h.uid,h.money as m_value,h.zsjr from huikuan h where h.status=1 and h.adddate>='$date_start1' and h.adddate<='$date_end1'  and h.uid in ($uid)";
	}else{
		$sqlb	=	"select b.uid,b.point_column,b.match_type,b.bet_money,b.status FROM k_bet b WHERE match_coverdate>='$date_start' AND match_coverdate<='$date_end' and lose_ok=1 AND b.`STATUS`=0 and b.uid in ($uid)";

		$sqlg	=	"select x.uid,x.gid,x.bet_money,x.status from k_bet_cg_group x where x.status in(0,2) and x.match_coverdate>='$date_start' and x.match_coverdate<='$date_end' and x.uid in ($uid)";

		$sqlm	=	"select m.uid,m.m_value,m.about,sxf from k_money m where m.status=1 and m.type=1 and m.m_make_time>='$date_start1' and m.m_make_time<='$date_end1' and m.uid in ($uid)";

		$sqlh	=	"select h.uid,h.money as m_value,h.zsjr from huikuan h where h.status=1 and h.adddate>='$date_start1' and h.adddate<='$date_end1'  and h.uid in ($uid)";
	}
	
	$info1				=	$mysqli->query($sqlm);
	$info2				=	$mysqli->query($sqlb);
	$info3				=	$mysqli->query($sqlg);
	$info4				=	$mysqli->query($sqlh);
	$arr1				=	array();
	$arr2				=	array();
	$arr3				=	array();
	$arr4				=	array();
	$k_money_arr		=	array();
	$hk_money_arr		=	array();
	$k_bet_arr			=	array();
	$k_bet_cg_group_arr	=	array();
	$k_bet_cg_arr		=	array();
	
	while($info = $info4->fetch_array()){
		if(!in_array($info['uid'],$arr4)){
			$arr4[] = $info['uid'];
		}
		$hk_money_arr[$info['uid']][] = $info;
	}
	
	while($info = $info1->fetch_array()){
		if(!in_array($info['uid'],$arr4)){
			$arr1[] = $info['uid'];
		}
		$k_money_arr[$info['uid']][] = $info;
	}
	
	if($wtype != "P"){
		while($info = $info2->fetch_array()){
			if(!in_array($info['uid'],$arr2)){
				$arr2[] = $info['uid'];
			}
			if($wtype=="RE" && $info["match_type"]==2){
				$k_bet_arr[$info["uid"]][] = $info;
			}elseif(($wtype=="ROU" || $wtype=="HRE" || $wtype=="HROU") && $info["match_type"]==2 && in_array($info["point_column"],$wtarr)){
				$k_bet_arr[$info["uid"]][] = $info;
			}elseif(($wtype!="ROU" && $wtype!="HRE" && $wtype!="HROU" && $wtype!="RE") && (in_array($info["point_column"],$wtarr) || $wtype=="")){
				$k_bet_arr[$info['uid']][] = $info;
			}
		}
	}
	if($wtype == "P" || $wtype == ""){
		while($info = $info3->fetch_array()){
			if(!in_array($info['uid'],$arr3)){
				$arr3[] = $info['uid'];
			}
			$k_bet_cg_group_arr[$info['uid']][]	=	$info;
			$k_cg_group_gid[$info['uid']][]		=	$info['gid'];
		}
	}
	
	if($type == "Y"){
		$sql	=	"select uid,money from save_user where addtime like('$lstime%') and uid in($uid)";
		$query	=	$mysqlio->query($sql);
		while($rows	=	$query->fetch_array()){
			$lsjl[$rows['uid']]	=	$rows['money'];
		}
	}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户列表</TITLE>
<link rel="stylesheet" href="../Images/CssAdmin.css">
 
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" colspan="2" nowrap bgcolor="#FFFFFF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       
	  <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="12%"  height="20"><strong>用户名</strong></td>
        <td width="9%" ><strong>存款</strong></td>
        <td width="9%" ><strong>提款</strong></td>
        <td width="9%" ><strong><?=substr($lstime,5,8)?>余额</strong></td>
        <td width="9%" ><strong>当前余额</strong></td>
        <td width="5%" ><strong>交易数</strong></td>
        <td width="9%"><strong>交易金额</strong></td>
        <td width="9%" ><strong>有效金额</strong></td>
        <td width="9%" ><strong>盈亏</strong></td>
        <td width="5%" ><strong>退水</strong></td>
        <td width="5%" ><strong>其它</strong></td>
        <td width="10%" ><strong>实际盈亏</strong></td>
      </tr>
<?php
		$sql	=	"select uid,money,username from k_user where uid in ($uid) order by uid asc";
		$query	=	$mysqli->query($sql);
		while($rows = $query->fetch_array()){
			$zck	= get_m_value($rows['uid']);
			$xzbs	= get_bet_num($rows['uid']);
?>
	  <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	    <td height="26"><a href="list_look_ds.php?uid=<?=$rows['uid']?>&s_time=<?=$date_start?>&e_time=<?=$date_end?>&type=<?=$type?>&username=<?=$rows['username']?>&wtype=<?=$wtype?>" target="_blank"><?=$rows['username']?></a></td>
        <td><?=$zck[1]?></td>
	    <td><?=$zck[0]?></td>
	    <td><?=$type=="Y" ? double_format($lsjl[$rows['uid']]) : "/"?></td>
	    <td><?=double_format($rows['money'])?></td>
	    <td><?= !isset($xzbs["num"])? '0' : $xzbs["num"]?></td>
	    <td ><?= !isset($xzbs["bet_money"])? double_format(0) : double_format($xzbs["bet_money"])?></td>
        <td><?=$type=="Y" ? double_format($xzbs["yx"]) : "/";?></td>
	    <td><?=$type=="Y" ? $xzbs["win"]>0 ? '<span style="color:#FF0000;">'.double_format($xzbs["win"]).'</span>' : '<span style="color:#000000;">'.double_format($xzbs["win"]).'</span>' : "/";?></td>
        <td><?=$type=="Y" ? double_format($xzbs["ts"]) : "/";?></td>
	    <td><?=$type=="Y" ? double_format($zck[2]) : "/";?></td>
	    <td><?=$type=="Y" ? $xzbs["win"]-($xzbs["ts"]+$zck[2])>0 ? '<span style="color:#FF0000;">'.double_format($xzbs["win"]-($xzbs["ts"]+$zck[2])).'</span>' : '<span style="color:#000000;">'.double_format($xzbs["win"]-($xzbs["ts"]+$zck[2])).'</span>' : "/";?></td>
     </tr>
<?php
		}
?>
    </table>    </td>
  </tr>
  <tr><td colspan="2" align="left" style="padding-right:30px;"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td>
  </tr>
<form name="form1" method="get" action="chage_xxuser.php" onSubmit="return check();">
  <tr>
    <td width="15%" align="right" bgcolor="#FFFFFF" style="padding-right:30px;">会员名称：</td>
    <td width="85%" align="left" bgcolor="#FFFFFF" style="padding-right:30px;"><textarea name="username" cols="90" rows="3" id="username"><?=$_GET['username']?></textarea> 多个会员名称用 , 隔开
        <input name="start" type="hidden" id="start" value="<?=$_GET['start']?>">
        <input name="end" type="hidden" id="end" value="<?=$_GET['end']?>">
        <input name="type" type="hidden" id="type" value="<?=$_GET['type']?>">
        <input name="wtype" type="hidden" id="wtype" value="<?=$_GET['wtype']?>">
        <input name="page" type="hidden" id="page" value="<?=$_GET['page']?>"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" style="padding-right:30px;">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-right:30px;"><label>
      <input type="submit" name="Submit" value="查找">
    </label></td>
  </tr>
</form>
</table>
</body>
<script>
function check(){
	var username = document.getElementById("username").value;
	if(username.length < 5){
		alert("请您输入正确的会员名称");
		return false;
	}
	return true;
}
</script>
</html>
<?php
}
?>