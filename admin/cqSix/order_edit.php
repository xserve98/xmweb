<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include ("../../include/mysqli.php");
$id 		= $_REQUEST['id'];
$type 		= $_REQUEST['type'];
$mingxi1 		= $_REQUEST['mingxi1'];
$mingxi2 		= $_REQUEST['mingxi2'];

$type = getoeltype($type);

//权限判断 

//开始修改
$sql		= "update c_bet set `mingxi_1` = '".$mingxi1."', `mingxi_2`='".$mingxi2."' where `id`='".$id."' and `type` = '".$type."'";

$mysqli->query($sql) or die("修改失败");

echo "修改成功";
 
function getoeltype($type){

          if($type==1){
            return '广东快乐十分';
          }

          if($type==2){

            return '重庆时时彩';
          }

          if($type==3){

            return '北京PK拾';
          }

          if($type==4){

            return '重庆快乐十分';
          }

          if($type==5){

            return '广西快乐十分';
          }

          if($type==6){

            return '江苏快三';
          }

        }

?> 