<?php
session_start();
include_once("../include/mysqlis.php");
include_once("../include/config.php");

$date	=	date('Y-m-d',time());
if($_GET['ymd']) $date	=	$_GET['ymd'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>腾飛娱乐城彩票</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/footable.core.min.css">
  <link href="../css/jquery_dialog.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/footable.min.js"></script>
  <style type="text/css">
  .panel-body{padding: 5px;}
</style>
</head>
<body>
<input type="button" value="<<返回" class="btn btn-warning pull-right" onclick="$('#J_SportsIFrame',parent.document).attr('src','left.php');"><div class="h10"></div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>足球结果 >></h3>
  </div>
  <div class="panel-body">
    <ul class="pagination"><?php
for($i=0;$i<7;$i++){
  $d  = date('Y-m-d',time()-$i*86400);
  $dd = date('m-d',time()-$i*86400);
  if($d==$date ){
?>
    <li class="active"><a href="#"><?=$dd?></a></li>
        <? }else{ ?>
        <li><a href="?ymd=<?=$d?>"><?=$dd?></a></li>
     
        <? } ?>
<?php
}
?></ul>
        <table class="table table-bordered table-hover">
  <thead><tr class="success">
  <th data-toggle="true">赛程<br>点击每行展开</th>
    <th>开赛时间<br>主场/客场</th>
    <th data-hide="phone,tablet">上半比分</th>
    <th data-hide="phone,tablet">全场比分</th>
  </tr></thead><tbody>
<?php
$sql  = "select Match_MatchTime, Match_Type,match_name,match_master,match_guest,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR from bet_match where match_Date='".date('m-d',strtotime($date))."' and (MB_Inball is not null or MB_Inball_HR is not NULL) and (match_js=1 or match_sbjs=1) order by Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master ";
$query  = $mysqlis->query($sql);      
$rows = $query->fetch_array();
if(!$rows){
  echo "<tr><td height='100' colspan='4' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
}else{
  do{    
?>
 <tr>
    <td><strong><?=$rows["match_name"]?></strong></td>
    <td class='zhong line'><span class="red"><?=$rows["Match_MatchTime"]?></span><br><span class="zhu"><?=$rows["match_master"]?></span>-<span class="ke"><?=$rows["match_guest"]?></span></td>
    <td class='zhong line'><? if($rows["MB_Inball_HR"]<0) { ?>
        <span class="zhu">赛事无效</span>-<span class="ke">赛事无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_HR"] ?></span>-<span class="ke"><?=$rows["TG_Inball_HR"]?></span>
      <?php } ?></td>
    <td class='zhong line'><? if($rows["MB_Inball"]<0) {?>
      <span class="zhu">赛事无效</span>-<span class="ke">赛事无效</span>
      <?php }else{ ?>
    <span class="zhu"><?=$rows["MB_Inball"]?></span>-<span class="ke"><?=$rows["TG_Inball"]?></span>
      <?php } ?></td>
  </tr>

<?php
  }while($rows = $query->fetch_array());
}
?></tbody>
</table>
  </div>
</div>
<script language="javascript" src="/js/mouse.js"></script>
<script language="javascript" src="/js/ifsports.js"></script>
<script type="text/javascript">
  $(function () {
    $('.table').footable();
  });
</script>
</body>
</html>