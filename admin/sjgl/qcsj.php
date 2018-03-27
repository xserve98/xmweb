<?php
include_once("../common/login_check.php");
check_quanxian("sjgl");

$msg	=	"&nbsp;";
$action	=	$_POST['hf_action'];
if($action == "ss"){
	include_once("../../include/mysqlis.php");
	$time	=	strtotime(date("Y-m-d"));
	$time	=	strftime("%Y-%m-%d",$time-6*24*3600).' 00:00:00';

    
    /* 删除其他彩种数据 */
	include_once("../../include/mysqli.php");
    //删除公告
    $sql	=	"Delete From `k_notice` Where end_time<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"公告：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"公告：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除重庆时时彩
    $sql	=	"Delete From `c_auto_2` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"重庆时时彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"重庆时时彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	  //删除重庆时时彩
    $sql	=	"Delete From `c_auto_7` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"天津时时彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"天津时时彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	  //删除重庆时时彩
    $sql	=	"Delete From `c_auto_14` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"新疆时时彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"新疆时时彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	   //删除极速分分彩
    $sql	=	"Delete From `c_auto_21` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"极速分分彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"极速分分彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
		   //删除幸运2分彩
    $sql	=	"Delete From `c_auto_20` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"幸运2分彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"幸运2分彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
			   //删除极速六合彩
    $sql	=	"Delete From `c_auto_22` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"极速六合彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"极速六合彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
				   //删除极速PC蛋蛋
    $sql	=	"Delete From `c_auto_26` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"极速PC蛋蛋：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"极速PC蛋蛋：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";

    //删除广东快乐十分
    $sql	=	"Delete From `c_auto_3` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"广东快乐十分：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"广东快乐十分：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	    //删除广东快乐十分
    $sql	=	"Delete From `c_auto_11` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"重庆幸运农场：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"重庆幸运农场：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除北京赛车(PK10)
    $sql	=	"Delete From `c_auto_4` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"北京赛车(PK10)：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"北京赛车(PK10)：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	  //删除极速赛车(PK10)
    $sql	=	"Delete From `c_auto_24` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"极速赛车(PK10)：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"极速赛车(PK10)：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	   //删除幸运飞艇
    $sql	=	"Delete From `c_auto_5` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"幸运飞艇：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"幸运飞艇：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	   //删除极速幸运飞艇
    $sql	=	"Delete From `c_auto_17` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"极速幸运飞艇：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"极速幸运飞艇：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除北京快乐8
    $sql	=	"Delete From `c_auto_1` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"北京快乐8：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"北京快乐8：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	    //删除PC蛋蛋
    $sql	=	"Delete From `c_auto_12` Where datetime<'$time'";
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"PC蛋蛋：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"PC蛋蛋：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
		    //删除加拿大28
    $sql	=	"Delete From `c_auto_13`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"加拿大28：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"加拿大28：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
		    //删除新加坡快乐8
    $sql	=	"Delete From `c_auto_18`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"新加坡快乐8：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"新加坡快乐8：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除新加坡28
    $sql	=	"Delete From `c_auto_23`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"新加坡28：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"新加坡28：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除澳洲快乐十分
    $sql	=	"Delete From `c_auto_19`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"澳洲快乐十分：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"澳洲快乐十分：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除澳洲幸运5
    $sql	=	"Delete From `c_auto_27`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"澳洲幸运5：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"澳洲幸运5：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除澳洲幸运8
    $sql	=	"Delete From `c_auto_28`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"澳洲幸运8：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"澳洲幸运8：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除澳洲幸运10
    $sql	=	"Delete From `c_auto_29`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"澳洲幸运10：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"澳洲幸运10：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  		    //删除澳洲幸运20
    $sql	=	"Delete From `c_auto_30`Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"澳洲幸运20：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"澳洲幸运20：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
  
	//删除站内消息
	$sql	=	"Delete From `k_user_msg` Where msg_time<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"站内消息：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"站内消息：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //3D和排列三数据较少，没有删除
    
    /* 删除db3 */
	include_once("../../include/mysqlio.php");
    //删除管理员登陆日志
    $sql	=	"Delete From `admin_login` Where login_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"管理员登陆日志：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"管理员登陆日志：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除会员历史登陆记录
    $sql	=	"Delete From `history_login` Where login_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"会员历史登陆记录：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"会员历史登陆记录：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除系统日志
    $sql	=	"Delete From `sys_log` Where log_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"系统日志：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"系统日志：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
}

/*删除注单*/
if ($action == "del")
{
	include_once("../../include/mysqli.php");
    
	$time = strtotime(date("Y-m-d"));
	$time = strftime("%Y-%m-%d",$time-30*24*3600).' 00:00:00';
	$cz = array();
	$cw = array();
    $cz = @$_POST["cz"];
    $cw = @$_POST["cw"];
	$meg = "";
	
    if ($cz)
    {
      
        
        if (in_array("cqssc", $cz))
        {
            $sql = "delete from c_bet where  type = '重庆时时彩' js= 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "重庆时时彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "重庆时时彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		 
        if (in_array("tjssc", $cz))
        {
            $sql = "delete from c_bet where  type = '天津时时彩' js= 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "天津时时彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "天津时时彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		     if (in_array("xjssc", $cz))
        {
            $sql = "delete from c_bet where  type = '新疆时时彩' js= 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "新疆时时彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "新疆时时彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        if (in_array("ffc", $cz))
        {
            $sql = "delete from c_bet where  type = '极速分分彩' js= 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "极速分分彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "极速分分彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		 
        if (in_array("lfc", $cz))
        {
            $sql = "delete from c_bet where  type = '幸运2分彩' js= 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "幸运2分彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "幸运2分彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("gdklsf", $cz))
        {
            $sql = "delete from c_bet where type = '广东快乐十分' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "广东快乐十分：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "广东快乐十分：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		       
      
		    if (in_array("xyft", $cz))
        {
            $sql = "delete from c_bet where type = '幸运飞艇' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "幸运飞艇：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "幸运飞艇：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		    if (in_array("jsxyft", $cz))
        {
            $sql = "delete from c_bet where type = '极速幸运飞艇' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "极速幸运飞艇：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "极速幸运飞艇：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		    if (in_array("xync", $cz))
        {
            $sql = "delete from c_bet where type = '重庆幸运农场' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "重庆幸运农场：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "重庆幸运农场：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
		 if (in_array("xy28", $cz))
        {
            $sql = "delete from c_bet where type = 'PC蛋蛋' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "PC蛋蛋：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "PC蛋蛋：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
			 if (in_array("jspcdd", $cz))
        {
            $sql = "delete from c_bet where type = '极速PC蛋蛋' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "极速PC蛋蛋：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "极速PC蛋蛋：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("bjsc", $cz))
        {
            $sql = "delete from c_bet where type = '北京赛车(PK10)' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "北京赛车(PK10)：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "北京赛车(PK10)：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
	        if (in_array("jnd28", $cz))
        {
            $sql = "delete from c_bet where type = '加拿大28' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "加拿大28：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "加拿大28：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
            if (in_array("jssc", $cz))
        {
            $sql = "delete from c_bet where type = '极速赛车(PK10)' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "极速赛车(PK10)：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "极速赛车(PK10)：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        if (in_array("kl8", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'kl8' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '北京快乐8 and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "北京快乐8：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "北京快乐8：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        

        if (in_array("3d", $cz))
        {
            ///$sql = "delete from lottery_data where atype = '3d' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '福彩3D' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "福彩3D：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "福彩3D：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("pl3", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '体彩排列三' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "排列三：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "排列三：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		       if (in_array("six", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '香港六合彩' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "香港六合彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "香港六合彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
				       if (in_array("xjp8", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '新加坡快乐8' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "新加坡快乐8：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "新加坡快乐8：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }		       if (in_array("xip28", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '新加坡28' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "新加坡28：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "新加坡28：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
				       if (in_array("azsf", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '澳洲快乐十分' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "澳洲快乐十分：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "澳洲快乐十分：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
				       if (in_array("azxy5", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '澳洲幸运5' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "澳洲幸运5：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "澳洲幸运5：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
					       if (in_array("azxy8", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '澳洲幸运8' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "澳洲幸运8：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "澳洲幸运8：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
					       if (in_array("azxy10", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '澳洲幸运10' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "澳洲幸运10：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "澳洲幸运10：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
					       if (in_array("azxy20", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '澳洲幸运20' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "澳洲幸运20：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "澳洲幸运20：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		
		if (in_array("cqsix", $cz))
        {
           // $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
			 $sql = "delete from c_bet where type = '极速六合彩' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "极速六合彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "极速六合彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		if (in_array("live", $cz))
        {
            $sql = "delete from agbetdetail where betTime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "真人下注记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "真人下注记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
    }
	
	if ($cw)
	{
		if (in_array("cqk", $cw))
        {
            $sql = "delete from huikuan where status <> 0 and adddate <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            $sql = "delete from k_money where status <> 2 and m_make_time <= '$time'";
            $mysqli->query($sql);
            $count += $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "资金记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "资金记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("lishi", $cw))
        {
            $sql = "delete from lb3_db.save_user where addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "会员历史余额：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "会员历史余额：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("live", $cw))
        {
            $sql = "delete from agaccounttransfer where creationTime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "真人额度记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "真人额度记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("fs", $cw))
        {
            $sql = "delete from fs_account where fs_uptime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "返水记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "返水记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清除数据</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
<script language="JavaScript" src="../../js/jquery.js"></script>
<script language="JavaScript" src="../../js/calendar.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="qcsj.php" onsubmit="return(confirm('您确定要清除一周前数据'))">
  <div align="center">
    <input type="submit" name="Submit" value="一键自动清除一周前数据" />
    <input name="hf_action" type="hidden" id="hf_action" value="ss" />
  </div>
</form>
<p align="center">一键自动清除数据，只会清除7天之前的所有采集来的数据和系统日志！</p>
<p align="center"><?=$msg?></p>
<br /><br />
<form id="form3" name="form3" method="post" action="qcsj.php" onsubmit="return checkdel();">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="10%">删除时间：</td>
            <td width="90%">删除30天之前的数据</td>
        </tr>
        <tr>
            <td align="right">删除彩种：</td>
            <td>
                
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="lhc" />香港六合彩
               
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="cqssc" />重庆时时彩
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="tjssc" />天津时时彩
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xjssc" />新疆时时彩
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="lfc" />幸运2分彩
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="ffc" />极速分分彩
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="gdklsf" />广东快乐十分
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="bjsc" />北京赛车(PK10)
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="kl8" />北京快乐8
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xy28" />PC蛋蛋
                
 
                 <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="jspcdd" />极速PC蛋蛋
                 <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="jssc" />极速赛车(PK10)      
                   <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="cqsix" />极速六合彩
                   <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="six" />香港六合彩
             
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="3d" />福彩3D
               <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="pl3" />体彩排列三
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="jnd28" />加拿大28
                
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xyft" />幸运飞艇
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xync" />重庆幸运农场
				
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xjp28" />新加坡28
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="xjp8" />新加坡快乐8
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="azsf" />澳洲快乐十分
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="azxy5" />澳洲幸运5
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="azxy8" />澳洲幸运8
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="azxy10" />澳洲幸运10
				<input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="azxy20" />澳洲幸运20
            </td>
        </tr>
        <tr>
            <td align="right">删除财务：</td>
            <td>
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="cqk" />存取款记录
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="lishi" />会员历史余额
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="fs" />返水记录
            </td>
        </tr>
        <tr>
            <td align="right"></td>
            <td>
                <input name="hf_action" type="hidden" id="hf_action" value="del" />
                <input name="Submit3" type="submit" id="Submit3" value="一键删除" />
            </td>
        </tr>
    </table>
</form>
<p align="center"><?=$meg?></p>
</body>
</html>