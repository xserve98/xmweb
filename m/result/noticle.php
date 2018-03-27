<?php
session_start();
include_once("../include/config.php");
include_once("../include/mysqli.php");

$sql	=	"select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,40";
$query	=	$mysqli->query($sql);
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>系统公告</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
* {
    margin: 0;
    padding: 0;
}
body{font-size:12px; margin:0px; background: #ffffff;}
.td_2 {
    border-bottom: 1px solid #7CBDDC;
    border-right: 1px solid #B6DAEB;
    border-left: 1px solid #B6DAEB;
}
.td_3 {
    border-bottom: 1px solid #7CBDDC;
    border-right: 1px solid #B6DAEB;
    overflow: auto; 
    line-height:20px;
}
.td_1 {
    border-right: 1px solid #fff;
}
.se_1 {
    height: 30px;
    background: url(../images/gg_2.jpg) no-repeat;
}
.se_2 {
    background: url(../images/gg_3.jpg) repeat-x;
    text-align: right;
}
</style>
</head> 
<body> 
<table border="0" align="center" cellpadding="0" cellspacing="0" class="memberdiv">
    <tr class="se_2">
        <td class="se_1" width="91"></td>
        <td><img src="../images/gg_4.jpg" ></td>
   </tr>
   <tr>
        <td valign="middle" height="20" bgcolor="#B6DAEB" align="center" class="td_1">时 间</td>
        <td valign="middle" bgcolor="#B6DAEB" align="center" class="font-blackmid">公告内容</td>
</tr>

<?php
$i=0;
while($row = $query->fetch_array()){
?>
    <tr>
        <td class="td_2" valign="middle" height="20" align="center"><?=date("m-d",strtotime($row["add_time"]))?></td>
        <td class="td_3" valign="middle" height="20" align="left" width="507"><?=$row["msg"]?></td>
    </tr>
<?php
}
?>
 
   </table>
</body> 
</html>