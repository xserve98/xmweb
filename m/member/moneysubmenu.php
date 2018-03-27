<?php
include_once("zr_conf.php"); 
?>
<div class="nav">
    <select id="gm_type">
        <option value="data_money.php"<?= $subsub == 1 ? " selected='selected'" : "" ?>>存款记录</option>
        <option value="data_h_money.php"<?= $subsub == 2 ? " selected='selected'" : "" ?>>汇款记录</option>
        <option value="data_t_money.php"<?= $subsub == 3 ? " selected='selected'" : "" ?>>取款记录</option>
        <!--option value="zr_data_money.php"<?= $subsub == 5 ? " selected='selected'" : "" ?>>娱乐场记录</option>
        <option value="data_jifen.php"<?= $subsub == 4 ? " selected='selected'" : "" ?>>积分记录</option-->
    </select>
</div>