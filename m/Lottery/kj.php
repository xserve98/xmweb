<?php include_once('ls.php') ?>
<div class="control n_anniu">
<div class="buttons">　　　　　　　　　　　
<label class="checkdefault">
<input type="checkbox" class="checkbox">
<span>预设</span></label>&nbsp;&nbsp;
<label class="quickAmount"><span class="color_lv bold">金额</span> 
<input id="kj_money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" /></label>
<input type="button" class="button" onclick="kjNum('s');"  value="确定">
<input type="button" class="button" onclick="kjNum('d');"  value="重置">
<input id="showResultList" class="button2" value="结果走势" onclick="showResultList();" style="float:right;" type="button">
</div>
</div>