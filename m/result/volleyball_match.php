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
  <link href="../css/jquery_dialog.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>排球结果 >></h3>
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
    <div class="table-responsive">
      <table class="table table-bordered table-hover"><tr class="success">
    <th width="100">开赛时间</th>
    <th>主场/客场</th>
    <th width="80">完赛（局）</th>
    <th width="80">完赛（盘）</th>
  </tr>
<?php
$sql  = "select Match_Date,Match_Time, match_name,match_master,match_guest,MB_Inball,TG_Inball from volleyball_match where MB_Inball is not null and  match_Date='".date('m-d',strtotime($date))."' and match_js=1";
$query  = $mysqlis->query($sql);      
$rows = $query->fetch_array();
if(!$rows){
  echo "<tr><td height='100' colspan='4' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
}else{
  do{
    if($temp_match_name!=$rows["match_name"]){
      $temp_match_name=$rows["match_name"]; 
?>
 <tr>
    <td colspan='4' align="center" class='liansai'><strong><?=$rows["match_name"]?></strong></td>
  </tr>
<?php
    }
?>  
 
  <tr>
    <td class='zhong line'><?=$rows["Match_Date"]?><br /><?=$rows["Match_Time"]?></td>
    <td class='line'><?=$rows["match_master"]?><br /><font color="#990000"><?=$rows["match_guest"]?></font></td>
    <td class='zhong line red'><? if($rows["MB_Inball"]<0) { ?>
        无效<br />无效
       <?php }else{?>
    <?=$rows["MB_Inball"] ?><br /><?=$rows["TG_Inball"]?>
      <?php } ?></td>
    <td class='zhong line red'><? if($rows["MB_Inball"]<0) { ?>
        无效<br />无效
       <?php }else{?>
    <?=$rows["MB_Inball"] ?><br /><?=$rows["TG_Inball"]?>
      <?php } ?></td>
    
  </tr>

<?php
  }while($rows = $query->fetch_array());
}
?>
</table>
    </div>
  </div>
</div>
<script language="javascript" src="/js/mouse.js"></script>
<script language="javascript" src="/js/ifsports.js"></script>
</body>
</html>