<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");
if(intval($_GET["action"])!=1)
{
	if (!isset($_GET["s_time"]) || $_GET["s_time"]=="") $_GET["s_time"]=date('Y-m-d',time());
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="JavaScript" src="/js/calendar.js"></script>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <form name="form1" method="get" action="allorder.php" onSubmit="return check();">
      <tr>
        <td align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
            <select name="caizhong" id="caizhong">
            <option value="">全部</option>
            <option value="北京赛车(PK10)" <?=$_GET['caizhong']=='北京赛车(PK10)' ? 'selected' : ''?>>北京赛车(PK10)</option> 
            <option value="极速赛车(PK10)" <?=$_GET['caizhong']=='极速赛车(PK10)' ? 'selected' : ''?>>极速赛车(PK10)</option>
            <option value="重庆时时彩" <?=$_GET['caizhong']=='重庆时时彩' ? 'selected' : ''?>>重庆时时彩</option>
            <option value="天津时时彩" <?=$_GET['caizhong']=='天津时时彩' ? 'selected' : ''?>>天津时时彩</option>
            <option value="新疆时时彩" <?=$_GET['caizhong']=='新疆时时彩' ? 'selected' : ''?>>新疆时时彩</option>
			<option value="上海时时乐" <?=$_GET['caizhong']=='上海时时乐' ? 'selected' : ''?>>上海时时乐</option>
			<option value="澳洲五分彩" <?=$_GET['caizhong']=='澳洲五分彩' ? 'selected' : ''?>>澳洲五分彩</option>
            <option value="澳洲两分彩" <?=$_GET['caizhong']=='澳洲两分彩' ? 'selected' : ''?>>澳洲两分彩</option>
            <option value="澳洲分分彩" <?=$_GET['caizhong']=='澳洲分分彩' ? 'selected' : ''?>>澳洲分分彩</option>
			<option value="香港六合彩" <?=$_GET['caizhong']=='香港六合彩' ? 'selected' : ''?>>香港六合彩</option>
			<option value="澳洲六合彩" <?=$_GET['caizhong']=='澳洲六合彩' ? 'selected' : ''?>>澳洲六合彩</option>
            <option value="幸运飞艇" <?=$_GET['caizhong']=='幸运飞艇' ? 'selected' : ''?>>幸运飞艇</option>
			<option value="北京快乐8" <?=$_GET['caizhong']=='北京快乐8' ? 'selected' : ''?>>北京快乐8</option>
			<option value="广东11选5" <?=$_GET['caizhong']=='广东11选5' ? 'selected' : ''?>>广东11选5</option>
			<option value="澳洲快乐十分" <?=$_GET['caizhong']=='澳洲快乐十分' ? 'selected' : ''?>>澳洲快乐十分</option>
			<option value="广东快乐十分" <?=$_GET['caizhong']=='广东快乐十分' ? 'selected' : ''?>>广东快乐十分</option>
            <option value="重庆幸运农场" <?=$_GET['caizhong']=='重庆幸运农场' ? 'selected' : ''?>>重庆幸运农场</option>
            <option value="福彩3D" <?=$_GET['caizhong']=='福彩3D' ? 'selected' : ''?>>福彩3D</option>
            <option value="体彩排列三" <?=$_GET['caizhong']=='体彩排列三' ? 'selected' : ''?>>体彩排列三</option>
            <option value="加拿大28" <?=$_GET['caizhong']=='加拿大28' ? 'selected' : ''?>>加拿大28</option>
			<option value="新加坡28" <?=$_GET['caizhong']=='新加坡28' ? 'selected' : ''?>>新加坡28</option>
			<option value="PC蛋蛋" <?=$_GET['caizhong']=='PC蛋蛋'?'selected' : ''?>>PC蛋蛋</option>
			<option value="极速PC蛋蛋" <?=$_GET['caizhong']=='极速PC蛋蛋' ? 'selected' : ''?>>极速PC蛋蛋</option>
			<option value="新加坡快乐8" <?=$_GET['caizhong']=='新加坡快乐8' ? 'selected' : ''?>>新加坡快乐8</option>
			<option value="百人牛牛" <?=$_GET['caizhong']=='百人牛牛' ? 'selected' : ''?>>百人牛牛</option>
			<option value="澳洲幸运5" <?=$_GET['caizhong']=='澳洲幸运5' ? 'selected' : ''?>>澳洲幸运5</option>
			<option value="澳洲幸运8" <?=$_GET['caizhong']=='澳洲幸运8' ? 'selected' : ''?>>澳洲幸运8</option>
			<option value="澳洲幸运10" <?=$_GET['caizhong']=='澳洲幸运10' ? 'selected' : ''?>>澳洲幸运10</option>
			<option value="澳洲幸运20" <?=$_GET['caizhong']=='澳洲幸运20' ? 'selected' : ''?>>澳洲幸运20</option>
          </select>
          &nbsp;&nbsp;会员：<input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2016,2030).show(this);" size="10" maxlength="10" readonly />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2016,2030).show(this);" size="10" maxlength="10" readonly />&nbsp;&nbsp;
            <input name="action" id="action" type="hidden" value="1">
			<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center" rowspan="2"><strong>账号</strong></td>
              <td align="center" rowspan="2"><strong>彩种</strong></td>
              <td align="center" colspan="4"><strong>已结算</strong></td>
              <td height="25" align="center" colspan="3"><strong>未结算</strong></td>
              <td align="center" colspan="2"><strong>合计(已结算+未结算)</strong></td>
        </tr>
        <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
              <td align="center"><strong>结果</strong></td>
              <td align="center"><strong>站主盈亏</strong></td>
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
              <td height="25" align="center"><strong>可赢</strong></td>
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
        </tr>
      <?php
      include_once("../../include/mysqli.php");
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $_GET["e_time"]=$_GET["e_time"]." 23:59:59";
   
        ?>
		<?php
      $sql = "select ";
      $sql .= "    b.username, ";
      $sql .= "    b.caizhong, ";
      $sql .= "    b.detailurl, ";
      $sql .= "    sum(if(b.status='ok',b.cou,0)) as ok_cou, ";
      $sql .= "    sum(if(b.status='ok',b.bet_money,0)) as ok_bet_money, ";
      $sql .= "    sum(if(b.status='ok',b.win,0)) as ok_win, ";
      $sql .= "    sum(if(b.status='ok',b.bet_win,0)) as ok_bet_win, ";
      $sql .= "    sum(if(b.status='no',b.cou,0)) as no_cou, ";
      $sql .= "    sum(if(b.status='no',b.bet_money,0)) as no_bet_money, ";
      $sql .= "    sum(if(b.status='no',b.win,0)) as no_win, ";
      $sql .= "    sum(if(b.status='no',b.bet_win,0)) as no_bet_win ";
      $sql .= "from ( ";
      $sql .= "    select ";
      $sql .= "        a.username, ";
      $sql .= "        '体育单式' as caizhong, ";
      $sql .= "        '../zdgl/list.php?status=0' as detailurl, ";
      $sql .= "        'ok' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.bet_money) as bet_money, ";
      $sql .= "        sum(b.win+b.fs) as win, ";
      $sql .= "        sum(b.bet_win+b.fs) as bet_win ";
      $sql .= "    from k_bet b, k_user a ";
      $sql .= "    where b.uid=a.uid ";
      $sql .= "    and b.lose_ok=1 ";
      $sql .= "    and b.status in (1,2,3,4,5,6,7,8) ";

      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and a.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.uid ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        a.username, ";
      $sql .= "        '体育单式' as caizhong, ";
      $sql .= "        '../zdgl/list.php?status=0' as detailurl, ";
      $sql .= "        'no' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.bet_money) as bet_money, ";
      $sql .= "        sum(b.win+b.fs) as win, ";
      $sql .= "        sum(b.bet_win+b.fs) as bet_win ";
      $sql .= "    from k_bet b, k_user a ";
      $sql .= "    where b.uid=a.uid ";
      $sql .= "    and b.lose_ok=1 ";
      $sql .= "    and b.status=0 ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and a.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.uid ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        a.username, ";
      $sql .= "        '体育串关' as caizhong, ";
      $sql .= "        '../zdgl/cg_result.php?status=0' as detailurl, ";
      $sql .= "        'ok' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.bet_money) as bet_money, ";
      $sql .= "        sum(b.win+b.fs) as win, ";
      $sql .= "        sum(b.bet_win+b.fs) as bet_win ";
      $sql .= "    from k_bet_cg_group b, k_user a ";
      $sql .= "    where b.uid=a.uid ";
      $sql .= "    and b.gid>0 ";
      $sql .= "    and b.status in (1,3,4) ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and a.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.uid ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        a.username, ";
      $sql .= "        '体育串关' as caizhong, ";
      $sql .= "        '../zdgl/cg_result.php?status=0' as detailurl, ";
      $sql .= "        'no' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.bet_money) as bet_money, ";
      $sql .= "        sum(b.win+b.fs) as win, ";
      $sql .= "        sum(b.bet_win+b.fs) as bet_win ";
      $sql .= "    from k_bet_cg_group b, k_user a ";
      $sql .= "    where b.uid=a.uid ";
      $sql .= "    and b.gid>0 ";
      $sql .= "    and b.status in(0,2) ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and a.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.uid ";
      $sql .= "    union all ";
	/**
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.atype as caizhong, ";
      $sql .= "        '../cpgl/jszd.php' as detailurl, ";
      $sql .= "        'ok' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      //$sql .= "        sum(if(b.win<0,0,b.win)) as win, ";
	  $sql .= "        sum(b.win+b.money) as win, ";//加上本金 2014.03.14
      $sql .= "        sum(b.money*b.odds) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=1 ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.atype ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.atype as caizhong, ";
      $sql .= "        '../cpgl/jszd.php' as detailurl, ";
      $sql .= "        'no' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      $sql .= "        0 as win, ";
      $sql .= "        sum(b.win) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=0 ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_time>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_time<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.atype ";
      $sql .= "    union all ";
	  **/
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.type as caizhong, ";
      $sql .= "        '../Lottery/Order.php?js=0' as detailurl, ";
      $sql .= "        'ok' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      //$sql .= "        sum(if(b.win<0,0,b.win)) as win, ";
	  $sql .= "        sum(case when b.win<0 then 0 when b.win=0 then b.money else b.win end) as win, ";//修正和退本金 2013.11.24
      $sql .= "        sum(b.money*b.odds) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=1 ";
      $sql .= "    and b.money>0 ";
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_date>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_date<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.type ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.type as caizhong, ";
      $sql .= "        '../Lottery/Order.php?js=0' as detailurl, ";
      $sql .= "        'no' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      $sql .= "        0 as win, ";
      $sql .= "        sum(b.win) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=0 ";
      $sql .= "    and b.money>0 ";
	  /* //修改笔数和金额重复计算一次
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_date>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_date<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.type ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.type as caizhong, ";
      $sql .= "        '../Lottery/Order3.php?js=0' as detailurl, ";
      $sql .= "        'ok' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      //$sql .= "        sum(if(b.win<0,0,b.win)) as win, ";
	  $sql .= "        sum(case when b.win<0 then 0 when b.win=0 then b.money else b.win end) as win, ";//修正和退本金 2013.11.24
      $sql .= "        sum(b.money*b.odds) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=1 ";
      $sql .= "    and b.money>0 ";
	  
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_date>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_date<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.type ";
      $sql .= "    union all ";
      $sql .= "    select ";
      $sql .= "        b.username, ";
      $sql .= "        b.type as caizhong, ";
      $sql .= "        '../Lottery/Order3.php?js=0' as detailurl, ";
      $sql .= "        'no' as status, ";
      $sql .= "        count(1) as cou, ";
      $sql .= "        sum(b.money) as bet_money, ";
      $sql .= "        0 as win, ";
      $sql .= "        sum(b.win) as bet_win ";
      $sql .= "    from c_bet b ";
      $sql .= "    where b.js=0 ";
      $sql .= "    and b.money>0 ";
	  */
	  
      if (isset($_GET["username"]) and $_GET["username"] != "") $sql .= " and b.username='".$_GET["username"]."' ";
      if (isset($_GET["s_time"]) and $_GET["s_time"] != "") $sql .= " and b.bet_date>='".$_GET["s_time"]."' ";
      if (isset($_GET["e_time"]) and $_GET["e_time"] != "") $sql .= " and b.bet_date<='".$_GET["e_time"]."' ";
      $sql .= "    group by b.username,b.type ";

      $sql .= "    ) as b ";
      $sql .= "    where 1=1 ";
      if (isset($_GET["caizhong"]) and $_GET["caizhong"] != "") $sql .= " and b.caizhong='".$_GET["caizhong"]."' ";
      $sql .= "group by b.username,b.caizhong order by b.username,b.caizhong ";
	  $query	=	$mysqli->query($sql);
      
      $all_ok_sum_cou = 0;
      $all_no_sum_cou = 0;
      $all_ok_sum_bet_money = 0;
      $all_no_sum_bet_money = 0;
      $all_ok_sum_win = 0;
      $all_ok_sum_bet_win = 0;
      $all_no_sum_bet_win = 0;
      
      $ok_sum_cou = 0;
      $no_sum_cou = 0;
      $ok_sum_bet_money = 0;
      $no_sum_bet_money = 0;
      $ok_sum_win = 0;
      $ok_sum_bet_win = 0;
      $no_sum_bet_win = 0;
      $username = "";
      while ($rows = $query->fetch_array()) {	  
        $color = "#FFFFFF";
        $over	 = "#EBEBEB";
        $out	 = "#ffffff";
        
        $all_ok_sum_cou += $rows['ok_cou'];
        $all_no_sum_cou += $rows['no_cou'];
        $all_ok_sum_bet_money += $rows['ok_bet_money'];
        $all_no_sum_bet_money += $rows['no_bet_money'];
        $all_ok_sum_win += $rows['ok_win'];
        $all_ok_sum_bet_win += $rows['ok_bet_win'];
        $all_no_sum_bet_win += $rows['no_bet_win'];
        
        switch ($rows['caizhong'])
        {
        case '3d':
          $caizhong='福彩3D';
          break;
        case 'pl3':
          $caizhong='排列三';
          break;
        case 'ssl':
          $caizhong='上海时时乐';
          break;
        case 'kl8':
          $caizhong='北京快乐8';
          break;
        default:
          $caizhong=$rows['caizhong'];
        }
      ?>

      <?php
        if ($username != $rows['username']) {
            if ($username != "") {
      ?>
      <tr align="center" style="background-color:#D9E7F4; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$username?></td>
        <td align="center" valign="middle">合计</td>
        <td align="center" valign="middle"><?=$ok_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_win)?></td>
        <td align="center" valign="middle"><span style="color:<?=($ok_sum_bet_money)-($ok_sum_win)>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",($ok_sum_bet_money)-($ok_sum_win))?></span></td>
        <td align="center" valign="middle"><?=$no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$no_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$no_sum_bet_win)?></td>
        <td align="center" valign="middle"><?=$ok_sum_cou+$no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_bet_money+$no_sum_bet_money)?></td>
        </tr>
      <?php     
            }
            $username = $rows['username'];
            $ok_sum_cou = $rows['ok_cou'];
            $no_sum_cou = $rows['no_cou'];
            $ok_sum_bet_money = $rows['ok_bet_money'];
            $no_sum_bet_money = $rows['no_bet_money'];
            $ok_sum_win = $rows['ok_win'];
            $ok_sum_bet_win = $rows['ok_bet_win'];
            $no_sum_bet_win = $rows['no_bet_win'];
        } else {
            $ok_sum_cou += $rows['ok_cou'];
            $no_sum_cou += $rows['no_cou'];
            $ok_sum_bet_money += $rows['ok_bet_money'];
            $no_sum_bet_money += $rows['no_bet_money'];
            $ok_sum_win += $rows['ok_win'];
            $ok_sum_bet_win += $rows['ok_bet_win'];
            $no_sum_bet_win += $rows['no_bet_win'];
        }
      ?>

      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$rows['username']?></td>
        <td align="center" valign="middle"><?=$caizhong?></td>
        <td align="center" valign="middle"><?=$rows['ok_cou']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['ok_bet_money'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['ok_win'])?></td>
        <td align="center" valign="middle"><span style="color:<?=$rows['ok_bet_money']-$rows['ok_win']>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",$rows['ok_bet_money']-$rows['ok_win'])?></span></td>
        <td align="center" valign="middle"><?=$rows['no_cou']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['no_bet_money'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['no_bet_win'])?></td>
        <td align="center" valign="middle"><?=$rows['ok_cou']+$rows['no_cou']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['ok_bet_money']+$rows['no_bet_money'])?></td>
        </tr>
        <?php } ?>
      <tr align="center" style="background-color:#D9E7F4; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$username?></td>
        <td align="center" valign="middle">合计</td>
        <td align="center" valign="middle"><?=$ok_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_win)?></td>
        <td align="center" valign="middle"><span style="color:<?=($ok_sum_bet_money)-($ok_sum_win)>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",($ok_sum_bet_money)-($ok_sum_win))?></span></td>
        <td align="center" valign="middle"><?=$no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$no_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$no_sum_bet_win)?></td>
        <td align="center" valign="middle"><?=$ok_sum_cou+$no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$ok_sum_bet_money+$no_sum_bet_money)?></td>
        </tr>
      <tr align="center" style="background-color:#ffffff; line-height:20px; font-weight: bold;">
        <td height="25" align="center" valign="middle" colspan="2">总合计</td>
        <td align="center" valign="middle"><?=$all_ok_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$all_ok_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$all_ok_sum_win)?></td>
        <td align="center" valign="middle"><span style="color:<?=($all_ok_sum_bet_money)-($all_ok_sum_win)>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",($all_ok_sum_bet_money)-($all_ok_sum_win))?></span></td>
        <td align="center" valign="middle"><?=$all_no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$all_no_sum_bet_money)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$all_no_sum_bet_win)?></td>
        <td align="center" valign="middle"><?=$all_ok_sum_cou+$all_no_sum_cou?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$all_ok_sum_bet_money+$all_no_sum_bet_money)?></td>
        </tr>
    </table></td>
    </tr>
  </table>

</div>
</body>
</html>