<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
include_once("db.php");
include_once("set.php");
include_once("pub_library.php");
include_once("http.class.php");
include_once("function.php");
include_once("../../cache/gp_db.php");
include_once("mysqlis.php");

$langx='zh-tw';

$data=theif_data($webdb["datesite"],$webdb["cookie"],'BK','re_all',$langx,0);
if(sizeof(explode("gamount",$data))>1){
    $k=0;
   preg_match_all("/g\((.+?)\);/is",$data,$matches);
    $cou=sizeof($matches[0]);
    $meg    = "本次无数据采集";
    $cache    = "<?php\r\nunset(\$lqgq,\$count,\$lasttime);\r\n";
    $cache .= "\$lqgq        =    array();\r\n";
    $cache .= "\$lasttime    =    ".(time()+7).";\r\n";
    $str    = "";
    $time    = date("Y-m-d H:i:s");
    $xb        = 0;
    for($i=0;$i<$cou;$i++){
        $messages		=	$matches[0][$i];
		$messages		=	str_replace("g(","",$messages);
		$messages		=	str_replace(");","",$messages);
		$messages		=	str_replace("cha(9)","",$messages);
		$messages		=	str_replace("'","\"",$messages);
		
		//echo $messages."<br>";
		$datainfo= json_decode($messages,true);
        
        if(in_array($datainfo[0],$gp_db)){
        //有关盘的联赛则不开盘
        }else{
            $datainfo[5]    =    ereg_replace("<[^>]*>","",$datainfo[5]);
            $datainfo[6]    =    ereg_replace("<[^>]*>","",$datainfo[6]);
            $datainfo[8]    =    str_replace(' ','',$datainfo[8]);
            $datainfo[11]    =    str_replace(' ','',$datainfo[11]);
            $datainfo[11]    =    substr($datainfo[11],1,strlen($datainfo[11])-1);
			
			$datainfo[35]    =    str_replace(' ','',$datainfo[35]);
            $datainfo[35]    =    substr($datainfo[35],1,strlen($datainfo[35])-1);
			$datainfo[36]    =    str_replace(' ','',$datainfo[36]);
            $datainfo[36]    =    substr($datainfo[36],1,strlen($datainfo[36])-1);
			
			$datainfo[39]    =    str_replace(' ','',$datainfo[39]);
            $datainfo[39]    =    substr($datainfo[39],1,strlen($datainfo[39])-1);
			$datainfo[40]    =    str_replace(' ','',$datainfo[40]);
            $datainfo[40]    =    substr($datainfo[40],1,strlen($datainfo[40])-1);
			
            $datainfo[32]    =    substr($datainfo[32],0,5);
            
            if($datainfo[9]==0.01 || $datainfo[10]==0.01 || $datainfo[8] == '2.5'){ //皇冠测试水位0.01，不显示 2.5测试盘口也不显示
                $datainfo[8]    =    '';
                $datainfo[9]    =    0;
                $datainfo[10]    =    0;
            }
            if($datainfo[13]==0.01 || $datainfo[14]==0.01){ //皇冠测试水位，不显示
                $datainfo[11]    =    '';
                $datainfo[13]    =    0;
                $datainfo[14]    =    0;
            }
            
            $str    .= "\$lqgq[$xb]['Match_ID']            =    '$datainfo[0]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Master']        =    '$datainfo[5]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Guest']            =    '$datainfo[6]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Name']            =    '$datainfo[2]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Time']            =    '$datainfo[1]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Ho']            =    '".sprintf("%.2f",$datainfo[9])."';\r\n";
            $str    .= "\$lqgq[$xb]['Match_DxDpl']            =    '".sprintf("%.2f",$datainfo[14])."';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Ao']            =    '".sprintf("%.2f",$datainfo[10])."';\r\n";
            $str    .= "\$lqgq[$xb]['Match_DxXpl']            =    '".sprintf("%.2f",$datainfo[13])."';\r\n";
            $str    .= "\$lqgq[$xb]['Match_RGG']            =    '$datainfo[8]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_ShowType']        =    '$datainfo[7]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_DxGG']            =    '$datainfo[11]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_CoverDate']        =    '$time';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Date']            =    '$datainfo[32]';\r\n";
            $str    .= "\$lqgq[$xb]['Match_Type']            =    '2';\r\n";
			
			$str    .= "\$lqgq[$xb]['Match_DsDpl']            =    '$datainfo[33]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DsSpl']            =    '$datainfo[34]';\r\n";
			
			$str    .= "\$lqgq[$xb]['Match_BzM']            =    '$datainfo[29]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_BzG']            =    '$datainfo[30]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFzDX1']            =    '$datainfo[35]';\r\n";	
			$str    .= "\$lqgq[$xb]['Match_DFzDpl']            =    '$datainfo[37]';\r\n";			
			$str    .= "\$lqgq[$xb]['Match_DFzDX2']            =    '$datainfo[36]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFzXpl']            =    '$datainfo[38]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFkDX1']            =    '$datainfo[39]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFkDpl']            =    '$datainfo[41]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFkDX2']            =    '$datainfo[40]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_DFkXpl']            =    '$datainfo[42]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_NowScore']            =    '".$datainfo[53].":".$datainfo[54]."';\r\n";
			$str    .= "\$lqgq[$xb]['Match_lqNowScore']            =    '".$datainfo[53].":".$datainfo[54]."';\r\n";
			$str    .= "\$lqgq[$xb]['Match_IsMaster']            =    '$datainfo[51]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_NowSession']            =    '$datainfo[52]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_ScoreH']            =    '$datainfo[53]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_ScoreC']            =    '$datainfo[54]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_LastGoal']            =    '$datainfo[55]';\r\n";
			$str    .= "\$lqgq[$xb]['Match_LastTime']            =    '$datainfo[56]';\r\n";
			
            $xb++;
        }
    }
    
    if($str == ""){
        include_once("../../cache/lqgq.php");
        
        if($count){
            $cache       .=    "\$count        =    0;\r\n";
            /*$cache        =    iconv("big5","UTF-8",$cache);*/
            
            /* 滚球入库 begin */
            $gunqiu_str=addslashes(htmlspecialchars(trim($cache,'<?php')));
            $sql="update gunqiu set mid_str='$gunqiu_str',lasttime=DATE_ADD(now(),INTERVAL 15 SECOND) WHERE id=2";
            $mysqlis->query($sql);
            /* 滚球入库 end */
            write_cache($cache);
        }
    }else{
        $cache       .=    "\$count        =    $xb;\r\n";
        $cache       .=    $str;
        /*$cache        =    iconv("big5","UTF-8",$cache);*/
        
        /* 滚球入库 begin */
        $gunqiu_str=addslashes(htmlspecialchars(trim($cache,'<?php')));
        $sql="update gunqiu set mid_str='$gunqiu_str',lasttime=DATE_ADD(now(),INTERVAL 15 SECOND) WHERE id=2";
        $mysqlis->query($sql);
        /* 滚球入库 end */
        write_cache($cache);
		$meg    =    "$i 条走地数据！";
    }
    unset($cache);
}else{
    $bool    =    true;
    if($webdb["cookie"]){
        include('../../cache/lqgq.php');
        $ltime    =    $lasttime;
        include('../../cache/zqgq.php');
        if($lasttime > $ltime) $ltime    =    $lasttime; 
        if(time()-$ltime < 200){ //4分钟后可以再登陆一次
            $bool    =    false;
        }    
    }
    if($bool){
        theif_uid($langx);
        
        $cache    = "<?php\r\nunset(\$lqgq,\$count,\$lasttime);\r\n";
        $cache .= "\$lqgq        =    array();\r\n";
        $cache .= "\$lasttime    =    ".(time()+7).";\r\n";
        
        /* 滚球入库 begin */
        $gunqiu_str=addslashes(htmlspecialchars(trim($cache,'<?php')));
        $sql="update gunqiu set mid_str='$gunqiu_str',lasttime=DATE_ADD(now(),INTERVAL 15 SECOND) WHERE id=2";
        $mysqlis->query($sql);
        /* 滚球入库 end */
        write_cache($cache);
    }
}

function write_cache($cache){
	global $site2_dom;
 if(!write_file("../../cache/lqgq.php",$cache.'?>')){ //写入缓存失败
	  echo   "缓存文件写入失败！请先设/cache/lqgq.php文件权限为：0777<br>";
  }
  if($site2_dom){
	  if(!write_file($site2_dom."cache/lqgq.php",$cache.'?>')){ //写入缓存失败
		  echo   "缓存文件写入失败DB2！请先设/cache/lqgq.php文件权限为：0777<br>";
	  }
  }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
 <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>

<body>
<script> 
<!-- 
var limit="5";
if (document.images){ 
    var parselimit=limit;
} 

function beginrefresh(){ 
if (!document.images) 
    return 
if (parselimit==1) 
    window.location.href="lqgq2.php";
else{ 
    parselimit-=1 
    curmin=Math.floor(parselimit) 
    if (curmin!=0) 
        curtime=curmin+"秒后获取数据！" 
    else 
        curtime=cursec+"秒后获取数据！" 
        timeinfo.innerText=curtime 
        setTimeout("beginrefresh()",1000) 
    } 
}

window.parent.lqgq = 1;
window.onload=beginrefresh 
 
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.reload()"> 
    篮球:<?=$meg?>
        <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>