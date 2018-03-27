<?php
include_once("zr_conf.php"); 
?>
<div class="nav">
    <select id="gm_type">
        <option value="<?=$full_url?>hk_money.php"<?= $sub == 7 ? " selected='selected'" : "" ?>>会员存款</option>
        <option value="<?=$full_url?>set_money.php"<?= $sub == 1 ? " selected='selected'" : "" ?>>在线存款</option>
        <option value="<?=$full_url?>get_money.php"<?= $sub == 2 ? " selected='selected'" : "" ?>>提取现金</option>
        <?php if($zr_open == 1) { ?>
            <option value="<?=$full_url?>zr_money.php"<?= $sub == 4 ? " selected='selected'" : "" ?>>娱乐场转帐</option>
        <?php } ?>
        <option value="<?=$full_url?>set_jifen.php"<?= $sub == 6 ? " selected='selected'" : "" ?>>积分兑换</option>
        <option value="<?=$full_url?>data_money.php"<?= $sub == 3 ? " selected='selected'" : "" ?>>财务明细</option>
    </select>
</div>