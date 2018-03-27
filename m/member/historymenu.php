<div class="nav" style="padding-bottom: 5px">
    <select id="gm_type">
        <option value="cha_ty.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y"<?= $lm == 1 ? " selected='selected'" : "" ?>>体育历史</option>
        <option value="cha_gg.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y"<?= $lm == 2 ? " selected='selected'" : "" ?>>过关历史</option>
        <option value="cha_cp.php?rad=ygsds&cn_begin=<?=$cn_begin?>&cn_end=<?=$cn_end?>&t=y"<?= $lm == 3 ? " selected='selected'" : "" ?>>彩票历史</option>
    </select>
    <div style="padding-top: 5px">查询时间：<?=date('m-d H:i', strtotime($begin_time))?> - <?=date('m-d H:i', strtotime($end_time))?></div>
</div>