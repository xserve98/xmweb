<?php
include_once("zr_conf.php"); 
?>
<div class="nav">
	<ul>
<li <?=$subsub==1?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('data_money.php');return false">存款记录</a></li>
<li <?=$subsub==2?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('data_h_money.php');return false">汇款记录</a></li>
<li <?=$subsub==3?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('data_t_money.php');return false">取款记录</a></li>
<li <?=$subsub==5?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('zr_data_money.php');return false">娱乐场记录</a></li>
<li <?=$subsub==4?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('data_jifen.php');return false">积分记录</a></li>
	</ul>
</div>