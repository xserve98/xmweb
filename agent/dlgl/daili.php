<?php
include_once("../common/login_check.php");
///check_quanxian("dlgl"); 
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>代理申请列表</TITLE>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
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
.t-title{height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理审核：审核所有代理申请</span></font></td>
  </tr>
   <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="823">
          <form name="form1" method="get" action="daili.php">
      <tr>
        <td width="124" align="center"><a href="daili.php?1=1" style="color:#0000FF;">全部申请</a></td>
        <td width="124" align="center"><a href="daili.php?status=1" style="color:#009900;">已成功申请</a></td>
        <td width="124" align="center"><a href="daili.php?status=2" style="color:#FF0000;">已失败申请</a></td>
        <td width="124" align="center"><a href="daili.php?status=0">未处理申请</a></td>
        
        <td width="245">用户名：
          <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="20" maxlength="20">
          <label></label>          </td>
        <td width="54" align="center"><input type="submit" name="Submit" value="查找"></td>
      </tr>
          </form>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="12%"  height="20"><strong>用户名/时间</strong></td>
        <td width="18%" ><strong> 真实姓名/电话</strong></td>
        <td width="18%" ><strong>email/msn_qq</strong></td>
        <td width="30%" ><strong>申请理由</strong></td>
        <td width="16%" ><strong>操作</strong></td>
        <td width="6%" ><strong>删除</strong></td>
      </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除 ********************/
$did	=	0;
if($_GET['did'] > 0){
	$did	=	$_GET['did'];
}
if ($_GET["action"] == "del" && $did > 0) {
    $sql		=	"delete from k_user_daili where d_id=$did";
	$mysqli->query($sql);
}
/******************** 删除 ********************/

$sql		=	"select d_id from k_user_daili left join k_user on k_user_daili.uid=k_user.uid where k_user_daili.d_id>0 ";
if(isset($_GET["status"])){
	$sql	.=	" and k_user_daili.`status`=".$_GET["status"];
}
if(isset($_GET['username'])){
	$sql	.=	" and k_user.username like ('%".$_GET['username']."%')";
}

$sql	.=	" order by k_user_daili.d_id desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$did		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$did .=	$row['d_id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($did){
	$did	=	rtrim($did,',');
	$sql	=	"select k_user_daili.*,k_user.username from k_user_daili left join k_user on k_user_daili.uid=k_user.uid where d_id in ($did) order by d_id desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br/><?=date("m-d H:i:s",strtotime($rows["add_time"]))?></td>
              <td><?=@htmlspecialchars($rows["r_name"])?><br/><?=@htmlspecialchars($rows["mobile"])?></td>
	          <td><?=@htmlspecialchars($rows["email"])?><br/><?=@htmlspecialchars($rows["msn_qq"])?></td>
	        
	          <td><?=@htmlspecialchars($rows["about"])?></td>
	          <td> 
              <?
              if($rows["status"]==0){
			  ?>
			  <div><div style="float:left">
              <a onClick="return confirm('确认同意该用户成为代理的请求？');" href="daili_cmd.php?uid=<?=$rows["uid"]?>&did=<?=$rows["d_id"]?>&status=1">同意</a></div>
           <div style="float:right"><a onClick="return confirm('不同意该用户成为代理的请求？');" href="daili_cmd.php?uid=<?=$rows["uid"]?>&did=<?=$rows["d_id"]?>&status=2">不同意</a></div>
		   </div>
              <? }else if($rows["status"]==1){?>
              <span style="color:#009900;">同意</span>
              <? }else if($rows["status"]==2){?>
              <span style="color:#FF0000;">不同意</span>
			  <? }else{ if($rows["status"]==3)?>
              <span style="color:#0000FF;">操作无效</span>
              <? }?>
              </td>
              <td><a onClick="return confirm('您确定要删除这条代理申请吗？');" href="daili.php?did=<?=$rows["d_id"]?>&action=del">删除</a></td>
          </tr>   	
<?php
	}
}
?>
    </table>
    </td>
  </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table>
</body>
</html>