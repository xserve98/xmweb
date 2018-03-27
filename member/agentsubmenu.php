<?php
include_once("zr_conf.php"); 
?>
<div class="nav">
	<ul>
    	<li <?=$lm=='ag1'?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>agent_reg.php');return false">申请代理</a></li>
        <li <?=$lm=='ag2'?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>agent_fa.php');return false">联盟方案</a></li>
        <li <?=$lm=='ag3'?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>agent_wt.php');return false">常见问题</a></li>
	</ul>
</div>