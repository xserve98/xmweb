<?php 
@session_start();
include_once("cache/website.php");$m_file."cache/website.php"
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <title><?=$web_site['web_title']?></title>
  <link rel="stylesheet" href="/css/bootstrap_s.min.css">
  <link rel="stylesheet" href="/css/font-awesome_s.min.css">
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap_s.min.js"></script>
  <style type="text/css">
  .bgt{width: 100%; height: 30px;}
  .bgt i{color: #fff; float: right;}
  .panel{position: relative;z-index: 99999;}
  .darrow{ width: 100%; height: 5px;position: relative;z-index: 9999;background-color: #00925f;}
  .darrow a{display: inline-block;width: 50px; height: 50px; background-color: #00925f;border-radius: 25px;position: absolute; top: -20px; left: 50%; margin-left: -25px;z-index: 9999; text-align: center; line-height: 70px;}
  .darrow a i{font-size: 30px; color: #fff;}
  </style>
  </head>
  <body>
<div id="xp" class="panel panel-danger">
  <div class="panel-heading">
  <h3>投注信息 
  <button id="idclose" type="button" class="btn btn-danger pull-right"><i class="fa fa-lg fa-close"></i>关闭</button>
  </h3>
  </div>
  <div class="panel-body">
    <div class="well1">
      <div class="touzhu_3">会员帐号：<?=$_SESSION["username"] ?></div>
        <div class="touzhu_3">可用额度：<span class="red" id="user_money">0</span></div>
        <div class="touzhu_3">使用币种：人民币</div>
         <div id="ds_msg" class="bg-success row">
            <p class="bg-primary">以下为您要投注的赛事</p>
            <form action="/bet.php" class="form-horizontal" name="form1" id="form1" method="post" onsubmit="if($('#cg_msg').css('display')!='none') {if (parseInt($('#cg_num').html(),10)>=2) {return check_bet();}else{alert('投注失败，请至少选择三场比赛后再进行投注！');return false;}}else{return check_bet();}">
            <input type="hidden" name="touzhutype" id="touzhutype" value="0" />
            <div class="touzhu_4 text-center" id="cg_msg" style="display:none;">已选择 <span id="cg_num" style="color:#FF0000;"></span> 场赛事</div>
            <div id="touzhudiv" style="text-align:center;" ></div>
            <div class="clearfix"></div>
            <div class="bg-info" style="padding:0px 10px;">
            <div class="form-group">
              <div class="col-xs-6">交易金额：</div>
              <div class="col-xs-6"><input type="text" class="form-control" name="bet_money" id="bet_money" autocomplete="off" maxlength="5" onkeypress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false"  onkeydown="if(event.keyCode==13)return check_bet();" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" size="8"/></div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">可赢金额：</div>
            <div class="col-xs-6"><span id="win_span" class="tou_red">0.00</span><input type="hidden" value="0" name="bet_win" id="bet_win"  /></div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">最低限额：</div>
            <div class="col-xs-6">1</div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">单注限额：</div>
            <div class="col-xs-6"><span id="max_ds_point_span">0</span></div>
            </div>
            <div class="form-group">
            <div class="col-xs-6">单场最高：</div>
            <div class="col-xs-6"><span id="max_cg_point_span">0</span></div>
            </div>
              <div id="istz" class="form-group text-center" style="display:none;padding:0px 10px;">
                <p class="bg-warning text-danger">可赢金额：<span id="win_span1">0.00</span><br>是否确定交易？</p>
              </div> 
            </div>
            <div class="touzhu_8">     
            <div class="col-xs-6"><input class="btn btn-danger btn-block btn-lg" name="" type="button" onclick="quxiao_bet()" value="取消"/></div>
            <div class="col-xs-6"><input class="btn btn-success btn-block btn-lg"  id="submit_from" name=""  type="submit" value="确认"/></div>
            <div class="clear"></div>
            </div>
            </form>
        </div>
    </div>
  </div>
</div>
<div class="darrow">
  <a href="#"><i class="fa fa-chevron-down"></i></a>
</div>
<script type="text/javascript" language="javascript" src="/js/touzhu.js?v=5"></script>
<script type="text/javascript">
function autofitframe(){
  var hb=$('body').height();
  hb=$(parent.window).height();
  //$('#s_betiframe',parent.document).height(hb);
} 
$(document).ready(function() {
  <?php
  if(isset($_GET['touzhutype']) && $_GET['touzhutype']==1){
    echo 'touzhutype="1";';
  }?>
  // autofitframe();
  // var l = $('#loads',parent.document);  
  // l.html('');
  // setInterval(function(){
  //   autofitframe();
  //   l.html('');
  // },1);
  $(document).delegate('.panel-heading h3 .btn,.panel-heading','click',function(event){
    event.preventDefault();
    $('.panel').slideUp();
    $('#s_betiframe',parent.document).animate({height:30}, 300);
    $('.darrow .fa').addClass('fa-chevron-down').removeClass('fa-chevron-up');
  });
  $(document).delegate('.darrow','click',function(event){
    event.preventDefault();
    if($('.darrow .fa').hasClass('fa-chevron-down')){
      $('.panel').show();//.slideDown();
      $('.darrow .fa').addClass('fa-chevron-up').removeClass('fa-chevron-down');
      //var hb=$(top.window).height()-50;
      var hb=$('body').height()+25;
      $('#s_betiframe',parent.document).animate({height:hb}, 300);   
      $('#idclose').focus();
      //$(this).css('bottom', '20px');
    }else{      
      $('.panel').hide();//.slideUp();      
      $('.darrow .fa').addClass('fa-chevron-down').removeClass('fa-chevron-up');
      $('#s_betiframe',parent.document).animate({height:30}, 300);
      //$(this).removeAttr('bottom');
    }
  });
  //$(parent.document).scrollTop(0);
});
</script>
</body>
<html>