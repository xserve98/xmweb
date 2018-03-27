<?php 
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>澳门葡京娱乐场</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
<div id="xp_jsc" class="panel panel-danger" style="display:none;">
  <div class="panel-heading">
  <h3>投注信息</h3>
  </div>
  <div class="panel-body">
    <div id="left">
        <div class="touzhu_2" id="usersid">
        <div class="touzhu_3">会员帐号：<?=$_SESSION["username"] ?></div>
        <div class="touzhu_3">可用额度：<span class="red" id="user_money_jsc">0</span></div>
        <div class="touzhu_3">使用币种：人民币</div>
        </div>
        <form action="bet_jsc.php" name="form_jsc" id="form_jsc" method="post" onsubmit="return check_bet_jsc();" style="margin:0 0 0 0;">
        
          
        <div id="touzhudiv_jsc" style="text-align:center;" ></div>
        <div class="touzhu_6">
        <div class="touzhu_3">交易金额：<input type="text" class="tou_input" name="bet_money_jsc" id="bet_money_jsc" autocomplete="off" maxlength="5" onkeypress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false"  onkeydown="if(event.keyCode==13)return check_bet_jsc();" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" size="8"/></div>
        <div class="touzhu_3">可赢金额：<span id="win_span_jsc" class="tou_red2">0.00</span><input type="hidden" value="0" name="bet_win_jsc" id="bet_win_jsc"  /></div>
        <div class="touzhu_3">最低限额：1</div>
        <div class="touzhu_3">单注限额：<span id="max_jsc_point_span">10000</span></div>
        <div class="touzhu_3">单场最高：<span id="max_jsc_m_point_span">500000</span></div>
      <div id="istz_jsc" style="display:none; color:#FF0000; text-align:center;">
        可赢金额：<span id="win_span1_jsc">0.00</span><br>是否确定交易？
        </div>        
        </div>
        <div class="touzhu_7"><input class="toua_2" name="" type="button" onclick="quxiao_bet_jsc()" value=""/></div>
        <div class="touzhu_7"><input class="toua_1"  id="submit_from_jsc" name=""  type="submit" value=""/></div>
        </form>
    </div>
  </div>
</div>
<form action="bet_gdhappy.php" method="post" name="form1" id="form1">
  <div id="tals_uid" style=" display:none; width:180px; float:left; height:360px;">
  <div class="touzhu_2">
  
    <div class="touzhu_3">会员帐号：<?=$_SESSION["username"] ?></div>
    <div class="touzhu_3">可用额度：<span class="red" id="user_money">0</span><input type="hidden" id="nowmatchid" name="nowmatchid" value="" /></div>
    <div class="touzhu_3">使用币种：人民币</div>
  </div>
  
    <div id="bet_uid" style="text-align:center;"></div>  
    <div class="touzhu_6" id="no_bet">
        <div class="touzhu_3">单注金额：<input class="tou_input" style="width:50px; height:15px;"  type="text"  name="betgd_money" id="betgd_money" autocomplete="off" maxlength="5" onKeyPress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" /></div>
        <div class="touzhu_3">可赢金额：<span id="win_span" class="tou_red2">0.00</span></div>
        <div class="touzhu_3">最低限额：<span id="bet_small"></span></div>
        <div class="touzhu_3">单注限额：<span id="bet_big"></span></div>
        <div class="touzhu_3">单场限额：<span id="bet_chang"></span></div>
    </div>
  <input type="hidden" id="betinfo" name="betinfo[]" value="" />
  <input type='hidden' value='' id="moneyCount" name='moneyCount'>
<div style="clear:both"></div>
  <div class="touzhu_7"><input class="toua_2" name="" type="reset" value=""  onClick="set_bet();"/></div>
  <div class="touzhu_7"><input class="toua_1"  name="submit_gd_from" type="submit" value="" id="submit_gd_from"  onclick="return always_left_bet();" disabled="disabled"/></div>
</div>
</form>
<div style="clear:both"></div>
  <form action="bet_bjpkten.php" method="post" name="form1" id="form1">
  <div id="talsbj_uid" style=" display:none; width:180px; float:left; height:340px;">
  <div class="touzhu_2">
  
    <div class="touzhu_3">会员帐号：<?=$_SESSION["username"] ?></div>
    <div class="touzhu_3">可用额度：<span class="red" id="userbj_money"><?=$user_money ?>RMB</span><input type="hidden" id="nowmatchid" name="nowmatchid" value="" /></div>
    <div class="touzhu_3">使用币种：人民币</div>
  </div>
  
    <div id="betbj_uid" style="text-align:center;"></div>  
    <div class="touzhu_6" id="no_bet">
        <div class="touzhu_3">单注金额：<input class="tou_input" style="width:50px; height:15px;"  type="text"  name="betbj_money" id="betbj_money" autocomplete="off" maxlength="5" onKeyPress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" /></div>
        <div class="touzhu_3">可赢金额：<span id="win_span" class="tou_red2">0.00</span></div>
        <div class="touzhu_3">最低限额：<span id="betbj_small"></span></div>
        <div class="touzhu_3">单注限额：<span id="betbj_big"></span></div>
        <div class="touzhu_3">单场限额：<span id="betbj_chang"></span></div>
    </div>
  <input type="hidden" id="betbjinfo" name="betinfo[]" value="" />
  <input type='hidden' value='' id="moneybjCount" name='moneybjCount'>

  <div class="touzhu_7"><input class="toua_2" name="" type="reset" value=""  onClick="set_bet();"/></div>
  <div class="touzhu_7"><input class="toua_1"  name="submit_bj_from" type="submit" value="" id="submit_bj_from"  onclick="return always_left_bet();"/></div>
</div>
</form>
<script type="text/javascript" language="javascript" src="/js/left.js"></script>
<script type="text/javascript" language="javascript" src="/js/touzhu.js?v=1"></script>
<script type="text/javascript" language="javascript" src="/BJpkTen/js/bet.js"></script>
<script type="text/javascript" language="javascript" src="/GDHappyTen/js/bet.js"></script>
<script type="text/javascript">
function autofitframe(){
  var hb=$('body').height();
  $('#s_betiframe',parent.document).height(hb);
} 
$(document).ready(function($) {  
  autofitframe();
  setInterval(function(){
    autofitframe();
  },1000);
  $(parent.document).scrollTop(0);
});
</script>
</body>
<html>