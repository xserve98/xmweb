<?php
include_once("../common/login_check.php");
check_quanxian("dlgl"); 
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>账号列表</TITLE>
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
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">账号列表</span></font></td>
  </tr>
   <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
         <table >
          <form name="form1" method="get" action="dailist.php">
      <tr>
         <td width="80" align="center"><a href="dailist.php?dltype=1" style="color:#0000FF;">大股东</a></td>
           <td width="80" align="center"><a href="dailist.php?dltype=2" style="color:#0000FF;">股东</a></td>
            <td width="80" align="center"><a href="dailist.php?dltype=3" style="color:#0000FF;">总代理</a></td> 
            <td width="80" align="center"><a href="dailist.php?dltype=4" style="color:#0000FF;">代理</a></td>
           
        <td width="80" align="center"><a href="dailist.php?all=1" style="color:#0000FF;">全部账号</a></td>
        <td width="80" align="center"><a href="dailist.php?top_uid2=0" style="color:#0000FF;">平台直属</a></td>
        
        <td width="80" align="center"><a href="dailist.php?stop=0" style="color:#009900;">已启用账号</a></td>
        <td width="80" align="center"><a href="dailist.php?stop=1" style="color:#FF0000;">已停用账号</a></td>
        <td width="80" align="center"><a href="daili_add.php" style="color:#00F;">新增账号</a></td>
        
        <td width="245">用户名：
          <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="20" maxlength="20">
          <label></label>          </td>
        <td width="54" align="center"><input type="submit" name="Submit" value="查找"></td>
      </tr>
          </form>
    </table></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="5%" ><strong>代理商ID</strong></td>
        <td width="5%" ><strong>用户名/姓名</strong></td>
         <td width="5%" ><strong>账号级别</strong></td>
         <td width="5%" ><strong>上级名称</strong></td>
          <td width="5%" ><strong>下级账号</strong></td>
           <td width="5%" ><strong>直属会员</strong></td>
            <td width="5%" ><strong>下级总计</strong></td>
        <td width="5%" ><strong>手机/微信</strong></td>
        <td width="5%" ><strong>代理余额</strong></td>
        <td width="5%" ><strong>余额修改</strong></td>
        <td width="5%" ><strong>占成/设置</strong></td>
         <td width="5%" ><strong>回水设置</strong></td>
		<td width="5%" ><strong>分红比例</strong></td>
        <td width="5%" ><strong>登录次数</strong></td>
        <td width="10%" ><strong>新增日期</strong></td>
        <td width="10%" ><strong>账号状态</strong></td>
        <td width="15%" ><strong>操作</strong></td>
      </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除 ********************/
$did	=	0;
if($_GET['did'] > 0){
	$did	=	$_GET['did'];
}
				 
	$dltype=1;			 
 if($_GET['dltype'] > 1){
	$dltype	=	$_GET['dltype'];
}
				
if ($_GET["action"] == "del" && $did > 0) {
    $sql		=	"delete from k_user where uid=$did";

	$mysqli->query($sql);
}
/******************** 启用/停用 ********************/
if ($_GET["action"] == "stop" && $did > 0) {
    $sql		=	"update k_user set is_stop='{$_GET['isstop']}' where uid=$did";
	$mysqli->query($sql);
}
/******************** 删除 ********************/

$sql		=	"select * from k_user where is_daili=1 and dltype='$dltype' ";
if(isset($_GET["stop"])){
	
	$sql	.=	" and `is_stop`=".$_GET["stop"];
}
 if(isset($_GET["top_uid2"])){
	 $sql		=	"select * from k_user where is_daili=1 ";
	 $sql	.=	" and `top_uid`=".$_GET["top_uid2"];
}
  if(isset($_GET["all"])){
	 $sql		=	"select * from k_user where is_daili=1 ";

}
if(isset($_GET['username'])){
 $sql		=	"select * from k_user where is_daili=1 ";
	$sql	.=	" and username like ('%".$_GET['username']."%')";
}
if(isset($_GET['top_uid'])){
	     $sql		=	"select * from k_user where is_daili=1 ";
	//$sql	.=	" and concat(',',parents,',') like '%,".intval($_GET['top_uid']).",%' ";
		$sql	.=	" and `top_uid`=".$_GET["top_uid"];
}
		 
$sql	.=	" order by dltype ASC";		
			
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
	$did .=	$row['uid'].',';
  }
  if($i > $end) break;
  $i++;
}
if($did){
	$did	=	rtrim($did,',');
	$sql	=	"select * from k_user where uid in ($did) order by dltype asc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
            <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["uid"]?></a></td>
	          <td><a title="单击查看改代理的所有会员" href="../hygl/list.php?top_uid=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br/><?=$rows["pay_name"]?></td>
	           <td>
	           <?php if($rows['dltype']==1){echo '大股东';}
				     else if($rows['dltype']==2){echo '股东';}
				     else if($rows['dltype']==3){echo '总代理';}
					 else if($rows['dltype']==4){echo '代理';}
				   ?>
		</td>
              <?php
		            $sqlsj="select username ,uid from k_user where uid=".intval($rows['top_uid'])." ";
		             $querysj	=	$mysqli->query($sqlsj);
			  		 $sjrow  =   $querysj->fetch_array();
		
              		$sqlnum   =   "select count(*) as nums from k_user where top_uid='{$rows['uid']}' and is_daili=0";
			
			  		$querynum	=	$mysqli->query($sqlnum);
			  		$rowsnum  =   $querynum->fetch_array();
	
			  $sqlnum1   =   "select count(*) as nums from k_user where top_uid=".intval($rows['uid'])." and is_daili=1 and uid !='{$rows['uid']}' ";
	                
			  		$querynum1	=	$mysqli->query($sqlnum1);
			  		$rowsnum1  =   $querynum1->fetch_array();	

					$sqlnum2   =   "select count(*) as nums from k_user where concat(',',parents,',') like '%,".intval($rows['uid']).",%' and uid !='{$rows['uid']}' ";
					$querynum2	=	$mysqli->query($sqlnum2);
			  		$rowsnum2  =   $querynum2->fetch_array();					 
										 
			  ?>
               <td><a title="单击查看该代理的下级代理" href="dailist.php?top_uid=<?=$sjrow["uid"]?>"><?=$sjrow['username']?></a></td>
              <td><a title="单击查看该代理的下级代理" href="dailist.php?top_uid=<?=$rows["uid"]?>"><?=$rowsnum1['nums']?></a></td>
              <td><a title="单击查看该代理的所有会员" href="../hygl/list.php?top_uid=<?=$rows["uid"]?>"><?=$rowsnum['nums']?></a></td>
	          <td><a title="单击查看该代理的所有会员" href="../hygl/list.php?dluid=<?=$rows["uid"]?>"><?=$rowsnum2['nums']?></a></td>
              <td><?=@htmlspecialchars($rows["mobile"])?><br/><?=@htmlspecialchars($rows["email"])?></td>
              <td><?=$rows['money']?></td>
				<td><a href="../cwgl/set_money.php?uid=<?=$rows["uid"]?>&type=add">余额修改</a></td>
              <td><a href="edit_daili.php?uid=<?=$rows["uid"]?>&username=<?=$rows["username"]?>"><?=$rows['zhancheng']?>% 设置</a><br /></td>
               <td><a href="../hygl/send_back.php?uid=<?=$rows["uid"]?>&username=<?=$rows["username"]?>">回水设置</a><br /></td>
			      <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["fandian"]?>%</a></td>
              <td><?=@htmlspecialchars($rows["lognum"])?></td>
	          <td><?=@htmlspecialchars($rows["reg_date"])?></td>
              <td>
              <?php
			  	if ($rows['is_stop']==0){
					echo "启用";
					}
					else{
						echo "<font color=red>停用</font>";
						}
              ?>
              </td>
              <td> 
              <?
              if($rows["is_stop"]==0){
			  ?>
			  <div>
              	<div style="float:left">
              		<a onClick="return confirm('确认停用该代理？');" href="dailist.php?did=<?=$rows["uid"]?>&action=stop&isstop=1">停用</a></div>
              <?php
			  }
			  else{
			  ?>
           		<div style="float:left">
                	<a onClick="return confirm('确认启用该代理？');" href="dailist.php?did=<?=$rows["uid"]?>&action=stop&isstop=0">启用</a></div>
		   		</div>
              <? }?>
			  	<div style="float:left">
                	&nbsp;/&nbsp;
                </div>
                <div style="float:left">
              		<a href="../hygl/user_show.php?id=<?=$rows["uid"]?>">修改</a>
              	</div>
                <div style="float:left">
                	&nbsp;/&nbsp;
                </div>
                <div style="float:left">
              		<a onClick="return confirm('确定要删除该代理？');" href="dailist.php?did=<?=$rows["uid"]?>&action=del">删除</a>
              	</div>
              </div></td>
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