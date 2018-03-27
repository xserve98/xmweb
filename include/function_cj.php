<?php
function zqgq_cj(){
	include_once("pub_library.php");
	include_once("mysqlis.php");
	$gq_sql="select mid_str,lasttime from gunqiu where id=1";
    $gq_query=$mysqlis->query($gq_sql);
    if($gq_row=$gq_query->fetch_array()){
        if(!write_file("../cache/zqgq.php",'<?php'.stripcslashes($gq_row['mid_str']).'?>')){
            return false;
        }else{
            if(time()-strtotime($gq_row['lasttime'])<3){
                return false;
            }else{
                return true;
            }
        }
    }else{
        return false;
    }
}

function lqgq_cj(){
	include_once("pub_library.php");
	include_once("mysqlis.php");
	$gq_sql="select mid_str,lasttime from gunqiu where id=2";
    $gq_query=$mysqlis->query($gq_sql);
    if($gq_row=$gq_query->fetch_array()){
        if(!write_file("../cache/lqgq.php",'<?php'.stripcslashes($gq_row['mid_str']).'?>')){
            return false;
        }else{
            if(time()-strtotime($gq_row['lasttime'])<3){
                return false;
            }else{
                return true;
            }
        }
    }else{
        return false;
    }
}
?>