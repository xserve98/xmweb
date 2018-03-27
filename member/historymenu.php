<div class="nav">
	<ul>
		<li <?=$lm==1?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('cha_ty.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y');return false">体育历史</a></li>
        <li <?=$lm==2?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('cha_gg.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y');return false">过关历史</a></li>
		<li <?=$lm==3?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('cha_cp.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y');return false">彩票历史</a></li>
        <li style="width:350px;float:right">查询时间：<?=$begin_time?> - <?=$end_time?></li>
	</ul>
</div>