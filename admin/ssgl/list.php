<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("../../include/mysqlis.php");
include_once("../../include/newpage.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>冠军列表</TITLE>
<script language="javascript">
function go(value){
	location.href=value;
}
</script>
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
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">冠军管理：管理冠军栏目情况</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%">
          <form name="form1" method="get" action="list.php">
      <tr align="center">
        <td width="124">
          <select name="type" id="type">
            <option value="2" <?=$_GET['type']==2 ? 'selected' : ''?>>金融项目</option>
            <option value="1" <?=$_GET['type']==1 ? 'selected' : ''?>>冠军项目</option>
            <option value="3" <?=$_GET['type']==3 ? 'selected' : ''?>>全部项目</option>
          </select></td>
          <td width="154">日期：
            <input name="date" type="text" id="date" value="<?=@$_GET['date']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" /></td>
            <td width="246">联赛名：
              <input name="x_title" type="text" id="x_title" size="20" value="<?=@$_GET["x_title"]?>">
              <label></label></td>
            <td width="110"><input type="submit" name="Submit" value="搜索"></td>
            <td width="463" align="right"><a href="add.php">添加项目</a>&nbsp;&nbsp;</td>
      </tr>
          </form>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
      <tr  class="t-title" align="center" >
        <td width="36" ><strong>编号</strong></td>
        <td width="359"><strong>赛事项目名称</strong></td>
        <td width="36" ><strong>数量</strong></td>
        <td width="156" ><strong>封盘时间</strong></td>
        <td width="306" ><strong>比赛结果</strong></td>
        <td width="156" ><strong>添加时间</strong></td>
        <td width="56" ><strong>操作</strong></td>
        </tr>

<?php
$sql	=	"select x_id from t_guanjun where x_id>0";

$sqlwhere		=	'';
if(isset($_GET["type"])){
	if($_GET["type"] < 3) $sqlwhere	.= " and match_type=".$_GET["type"];
}
if(@$_GET["x_title"]){
	$sqlwhere	.=	" and x_title='".$_GET["x_title"]."'";
}
if(@$_GET['date']){
	$sqlwhere	.=	" and match_coverdate like('".$_GET['date']."%')";
}

$sql		.=	$sqlwhere;
$sql		.=	" order by match_coverdate desc,x_id desc";

$query		=	$mysqlis->query($sql);
$sum		=	$mysqlis->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
  $thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$xid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$xid .=	$row['x_id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($xid){
	$xid	=	rtrim($xid,',');
	$sql	=	"select * from t_guanjun left join (select count(*) as num,xid from t_guanjun_team group by xid) as t on t_guanjun.x_id=t.xid where x_id in($xid) order by match_coverdate desc,x_id desc";
    $query	=	$mysqlis->query($sql);
	while($rows = $query->fetch_array()){
      	?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" style="background-color:#FFFFFF;">
	          <td height="40" ><?=$rows["x_id"]?></td>
              <td><strong><?=$rows["match_name"]?></strong>
			  <br/>
			  <a href="x_show.php?id=<?=$rows["x_id"]?>"><?=$rows["x_title"]?></a></td>
              <td><?=intval($rows["num"])?></td>
              <td><?=$rows["match_coverdate"]?></td>
              <td><? if($rows["x_result"]=="") echo "暂无结果"; else {?>
			  <font style="color:#FF0000"><?=$rows["x_result"]?></font>
			  <?}?>
			  </td>
              <td><?=$rows["add_time"]?></td>
              <td><a href="edit.php?id=<?=$rows["x_id"]?>">编辑</a></td>
        </tr>  	
<?php
	}
}
?>
    </table></td>
  </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table>
</body>
</html>