<div id="u_nav" style="display: none">
    <ul class="u_bar">
        <li><span>账号：<?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?><br>余额：<em id="money"><?=$userinfo['money']?> 元</em></span></li><br><br><br>
        <li><span><a href="/member/index">　网站主页　　　</a> <i class="icon-angle-right"></i></span></li>
        <?php if(strpos($_SESSION["username"],'guest_')===false) {?><br><br>
            <li><span><a href="/set_money">　在线充值　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
            <li><span><a href="/get_money">　在线提款　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
            <li><span><a href="/data_money">　存取记录　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="/member/userinfo">　会员资料　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="/password">　修改密码　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="/record_ss.">　未结明细　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="/cha_cp./?rad=ygsds&cn_begin=<?=$t_day?>&cn_end=<?=$t_day?>&t=y">　今日已结　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
            <li><span><a href="/member/report.php">　账户历史　　　</a> <i class="icon-angle-right"></i></span></li>
        <?php } ?><br><br>
        <li><span><a href="javascript:void(0);" onclick="gm_open(<?=$gm?>);">　历史开奖　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="javascript:void(0);" onclick="gm_rules(<?=$gm?>);">　游戏规则　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
		<li><span><a href="<?=$web_site["web_kf"]?>" target="_blank">　在线客服　　　</a> <i class="icon-angle-right"></i></span></li><br><br>
        <li><span><a href="/member/logout">　安全退出　　　</a> <i class="icon-angle-right"></i></span></li>
    </ul>
</div>