<?php
include_once("../common/login_check.php");
check_quanxian("sjgl");
$msg="&nbsp;";
if(@$_GET["ok"] && @$_POST["table1"]){
	include_once("../../include/mysqli.php");
	$table	=	$_POST["table1"];
    $msg	.=	"<font color='#ff0000'>数据库①</font><br />";
	foreach($table as $v){
		$mysqli->query("REPAIR TABLE $v");
		$mysqli->query("optimize table $v");
		$msg	.=	"优化了数据库表:$v <br />";
	}
}

if(@$_GET["ok"] && @$_POST["table3"]){
	include_once("../../include/mysqlio.php");
	$table	=	$_POST["table3"];
    $msg	.=	"<font color='#ff0000'>数据库③</font><br />";
	foreach($table as $v){
		$mysqli->query("REPAIR TABLE $v");
		$mysqlio->query("optimize table $v");
		$msg	.=	"优化了数据库表:$v <br />";
	}
}
if(@$_GET["ok"] && @$_POST["table4"]){
	include_once("../../include/mysqlis.php");
	$table	=	$_POST["table4"];
    $msg	.=	"<font color='#ff0000'>数据库④</font><br />";
	foreach($table as $v){
		$mysqli->query("REPAIR TABLE $v");
		$mysqlis->query("optimize table $v");
		$msg	.=	"优化了数据库表:$v <br />";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据优化</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
<style>
    .input { width: 150px; float: left; }
    .clear { clear: both; }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="?ok=1">
<div align="left">
    <p>数据库①</p>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="ban_ip" />ban_ip</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_auto_2" />c_auto_2</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_auto_3" />c_auto_3</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_bet" />c_bet</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_bet" />c_bet</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_2" />c_odds_2</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_2_m" />c_odds_2_m</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_3" />c_odds_3</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_3_m" />c_odds_3_m</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_opentime_2" />c_opentime_2</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_opentime_3" />c_opentime_3</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="history_bank" />history_bank</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="huikuan" />huikuan</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_bet" />k_bet</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_bet_cg" />k_bet_cg</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_bet_cg_group" />k_bet_cg_group</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_group" />k_group</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_hyfl" />k_hyfl</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_money" />k_money</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_notice" />k_notice</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_um" />k_um</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_user" />k_user</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_user_daili" />k_user_daili</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_user_daili_result" />k_user_daili_result</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_user_login" />k_user_login</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="k_user_msg" />k_user_msg</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_data" />lottery_data</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_k_3d" />lottery_k_3d</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_k_kl8" />lottery_k_kl8</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_k_pl3" />lottery_k_pl3</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_k_ssl" />lottery_k_ssl</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_odds" />lottery_odds</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_t_kl8" />lottery_t_kl8</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="lottery_t_ssl" />lottery_t_ssl</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="message" />message</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="web_config" />web_config</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="webinfo" />webinfo</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_auto_4" />c_auto_4</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_4" />c_odds_4</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_odds_4_m" />c_odds_4_m</div>
    <div class="input"><input name="table1[]" type="checkbox" checked="checked" id="table1[]" value="c_opentime_4" />c_opentime_4</div>
    <div class="clear"></div>
</div>
<br />
<div align="left">
    <p>数据库②</p>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="adad" />adad</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="config" />config</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ha_kithe" />ha_kithe</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ha_num" />ha_num</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ha_tan" />ha_tan</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_admin" />ka_admin</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_bl" />ka_bl</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_color" />ka_color</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_drop" />ka_drop</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_guan" />ka_guan</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_guands" />ka_guands</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_kithe" />ka_kithe</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_mem" />ka_mem</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_quota" />ka_quota</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_sxnumber" />ka_sxnumber</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_tan" />ka_tan</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_tong" />ka_tong</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ka_zi" />ka_zi</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="m_color" />m_color</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="tj" />tj</div>
    <div class="input"><input name="table2[]" type="checkbox" checked="checked" id="table2[]" value="ya_kithe" />ya_kithe</div>
    <div class="clear"></div>
</div>
<br />
<div align="left">
    <p>数据库③</p>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="admin_login" />admin_login</div>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="history_login" />history_login</div>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="ip_la" />ip_la</div>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="save_user" />save_user</div>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="sys_admin" />sys_admin</div>
    <div class="input"><input name="table3[]" type="checkbox" checked="checked" id="table3[]" value="sys_log" />sys_log</div>
    <div class="clear"></div>
</div>
<br />
<div align="left">
    <p>数据库④</p>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="baseball_match" />baseball_match</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="bet_match" />bet_match</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="lq_match" />lq_match</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="t_guanjun" />t_guanjun</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="t_guanjun_team" />t_guanjun_team</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="tennis_match" />tennis_match</div>
    <div class="input"><input name="table4[]" type="checkbox" checked="checked" id="table4[]" value="volleyball_match" />volleyball_match</div>
    <div class="clear"></div>
</div>
<div align="center">
    <p>
        <input type="submit" name="Submit" value="优化选中数据库表" />
    </p>
</div>
</form>
<p align="center"><strong><?=$msg?></strong></p>
<br />
<p>一键自动优化数据库用于回收闲置的数据库空间，当表上的数据行被删除时，所占据的磁盘空间并没有立即被回收。</p>
<p>执行了一键自动优化数据库后这些空间将被回收，并且对磁盘上的数据行进行重排（注意：是磁盘上，而非数据库）。</p>
<p>多数时间并不需要运行一键自动优化数据库，只需在批量删除数据行之后，或定期（每周一次或每月一次）进行操作即可 。</p>
</body>
</html>