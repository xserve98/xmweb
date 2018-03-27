<?php
header("Content-type: text/html; charset=utf-8");
include_once("../common/login_check.php");
check_quanxian("lottery");
if ($_REQUEST['s_time']!=''){
	$s_time	= $_REQUEST['s_time'];
}else{
	$s_time	= date('Y-m-d',time());
}
if ($_REQUEST['e_time']!=''){
	$e_time	= $_REQUEST['e_time'];
}else{
	$e_time	= date('Y-m-d',time());
}
$type=$_GET['type'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tools.js"></script>
<script type="text/javascript" src="../js/base.js"></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body class="list">
	<div class="bar">
		高频彩注单查看
	</div>

<div class="body">
<form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>" onSubmit="return check();">
<div class="listBar">
<select name="type" id="type">
            <option value="重庆时时彩" style="color:#FF9900;" <?=$_GET['type']=='重庆时时彩' ? 'selected' : ''?>>重庆时时彩</option>
            <option value="重庆快乐十分" style="color:#FF9900;" <?=$_GET['type']=='重庆快乐十分' ? 'selected' : ''?>>重庆快乐十分</option>
            <option value="广东快乐十分" style="color:#FF9900;" <?=$_GET['type']=='广东快乐十分' ? 'selected' : ''?>>广东快乐十分</option>
            <option value="北京PK拾" style="color:#FF9900;" <?=$_GET['type']=='北京PK拾' ? 'selected' : ''?>>北京PK拾</option>
            <option value="广西快乐十分" style="color:#FF9900;" <?=$_GET['type']=='广西快乐十分' ? 'selected' : ''?>>广西快乐十分</option>
            <option value="江苏快三" style="color:#FF9900;" <?=$_GET['type']=='江苏快三' ? 'selected' : ''?>>江苏快三</option>
            <option value="" <?=$_GET['type']=='' ? 'selected' : ''?>>全部彩种</option>
      </select>&nbsp;&nbsp;
      <select name="js" id="js">
            <option value="0" style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
            <option value="" <?=$_GET['js']=='' ? 'selected' : ''?>>全部注单</option>
      </select>
  &nbsp;&nbsp;
          会员账号：
          <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
            &nbsp;&nbsp;日期范围：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />&nbsp;&nbsp;注单号：
            <input name="tf_id" type="text" id="tf_id" value="<?=@$_GET['tf_id']?>" size="22">
            &nbsp;&nbsp;<input name="find" type="submit" id="find" value="查看报表" class="formButton"/></td>

	</div>
</form>
<ul id="tab" class="tab">
                <li><input type="button" value="高频彩注单" hidefocus class="current"/></li>
			</ul>
<table id="listTables" class="listTables">

				<tr>

					<th>所属彩种</th>

					<th>注单号码</th>
					<th>投注期号</th>
					<th>投注玩法</th>
					<th>投注内容</th>
					<th>投注金额</th>
					<th>赔率</th>

					<th>输赢结果</th>

					<th>投注时间</th>
					<th>投注账号</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
<?php
      include_once("../../include/mysqli.php");
      include_once("../include/pager.class.php");
	  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
 
      $sql	=	"select id from c_bet where money>0 ";
	  if($type) $sql.=" and type='".$type."'";
	  if($_GET["uid"]) $uid = $_GET["uid"];
	  if($uid != '') $sql.=" and uid=".$uid;
	  if($_GET["s_time"]!='') $sql.=" and addtime>='".$_GET["s_time"]." 00:00:00'";
	  if($_GET["e_time"]!='') $sql.=" and addtime<='".$_GET["e_time"]." 23:59:59'";
	  if($_GET["js"]!='')  $sql.=" and `js` in (".$_GET["js"].")";
	  if($_GET['tf_id']) $sql.=" and id=".$_GET['tf_id']."";
	  $sql.=" order by id desc ";
	  
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页数
	  $thisPage	=	1;
	  $pagenum	=	50;
	  if($_GET['page']){
	  	  $thisPage	=	$_GET['page'];
	  }
      $CurrentPage=isset($_GET['page'])?$_GET['page']:1;
	  $myPage=new pager($sum,intval($CurrentPage),$pagenum);
	  $pageStr= $myPage->GetPagerContent();
	  
	  $bid		=	'';
	  $i		=	1; //记录 bid 数
	  $start	=	($thisPage-1)*$pagenum+1;
	  $end		=	$thisPage*$pagenum;
	  while($row = $query->fetch_array()){
	  	  if($i >= $start && $i <= $end){
	  	  	$bid .=	$row['id'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select * from c_bet where id in($bid) order by id desc";
	  	$query	=	$mysqli->query($sql);
      	while ($rows = $query->fetch_array()) {	  
?>
      <tr>
        <td height="30" align="center" valign="middle"><?=$rows['type']?></td>
        <td align="center" valign="middle"><?=$rows['id']?></td>
        <td align="center" valign="middle">第 <?=$rows['qishu']?> 期</td>
        <td align="center" valign="middle" onclick="order_edit_layer(this,'<?=$rows['id']?>','<?=$rows['type']?>','<?=$rows['mingxi_1']?>','<?=$rows['mingxi_2']?>')"><?=$rows['mingxi_1']?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_2']?></td>
        <td align="center" valign="middle"><?=$rows['money']?></td>
        <td align="center" valign="middle"><?=$rows['odds']?></td>
        <td align="center" valign="middle"><?php if($rows['js']==0){?><font color="#0000FF">未结算</font><?php }else{?><?=round($rows['win'],2)?><?php }?></td>
        <td align="center" valign="middle"><?=$rows['addtime']?></td>
        <td align="center" valign="middle"><?=$rows['username']?></td>
        <td align="center" valign="middle"><?php if($rows['js']==0){?>
          <a href="<?=l_name($rows['type'])?>_Auto.php?qishu=<?=$rows['qishu']?>&k=0"><font color="#0000FF">点击开奖</font></a>
          <?php }?>
          <?php if($rows['js']==1){?>
          <font color="#FF0000">已结算</font>
        <?php }?>
        <?php if($rows['js']==2){?>
          <font color="#0000FF">已取消</font>
        <?php }?></td>
        <td align="center" valign="middle"><? if($rows['js']==0){?><a href="QuXiao.php?id=<?=$rows['id']?>" target="_blank">取消</a><? }else{echo '已结算';}?></td>
      </tr>
<?php
	}
}
?>
  </table>
  <div class="pagerBar"><?php echo $pageStr;?></div>
  </div>
  <style>
    #order_edit_layer{position:fixed; width:0px; height:0px; left:0; top:0; overflow:hidden; z-index:999; font-size: 12px;}
    #order_edit_layer .centerdot{position:absolute; left:50%; top:50%; width:0; height:0;}
    #order_edit_layer .centerdot #p-layer{position:absolute; width:280px; height:180px; padding:10px; background:#999; left:-150px; top:-100px; border-radius:3px;}
    #order_edit_layer .centerdot #s-layer{width:280px; height:180px; background:#fff;}
    #order_edit_layer .centerdot #s-layer .opt_{height: 30px; padding: 5px; line-height: 30px;}
    #order_edit_layer .centerdot #s-layer select{border:1px solid #ccc; width: 180px;}
  </style>
  <div id="order_edit_layer">
    <div class="centerdot">
    <div id="p-layer">
    <div id="s-layer">
        <div class="opt_" id="oel_type"></div>
      <div class="opt_">投注玩法<select onchange="oel_wanfa_cg()" name="oel_wanfa"></select></div>
    <div class="opt_">投注内容<select name="oel_neirong"></select></div>
        <div class="opt_"><input type="button" onclick="submit_oel()" value="确定修改">&nbsp;&nbsp;&nbsp;<input type="button" onclick="cancel_oel()" value="取消修改"></div>
    </div>
    </div>
    </div>
  </div>
  <script>
    var oel = {obj:null,id:0,type:0,mingxi1:'',mingxi2:''};
      function order_edit_layer(obj,id,type,mingxi1,mingxi2){
          
          var width = $(window).width();
          var height = $(window).height();
          type = getoeltypeid(type);
          oel.obj = obj;
          oel.id = id;
          oel.type = type;
          oel.mingxi1 = mingxi1;
          oel.mingxi2 = mingxi2;

          var oeltype = getoeltype(type);
          $("#oel_type").html(oeltype);

          var mx1list = getmingxi(oel.type);

          $("select[name=oel_wanfa]").html("");
          $(mx1list).each(function(k,item){

              var selected = '';
              if(item == mingxi1)  selected = ' selected ';
              var opt = '<option value="'+item+'"'+selected+'>'+item+'</option>';
              $("select[name=oel_wanfa]").append(opt);

          });

          var mx2list = getmingxi2(oel.type,mingxi1);
          $("select[name=oel_neirong]").html("");
          $(mx2list).each(function(k,item){

              var selected = '';
              if(item == mingxi2)  selected = ' selected ';
              var opt = '<option value="'+item+'"'+selected+'>'+item+'</option>';
              $("select[name=oel_neirong]").append(opt);

          });

          $("#order_edit_layer").css({width:width,height:height});
      
        }

        function oel_wanfa_cg(){

          var mingxi1 = $("select[name=oel_wanfa]").val();
          oel.mingxi1 = mingxi1;
          var mx2list = getmingxi2(oel.type,mingxi1);
          $("select[name=oel_neirong]").html("");
          $(mx2list).each(function(k,item){

              var selected = '';
              if(item == oel.mingxi2)  selected = ' selected ';
              var opt = '<option value="'+item+'"'+selected+'>'+item+'</option>';
              $("select[name=oel_neirong]").append(opt);

          });


        }

       function submit_oel(){

          var id = oel.id;
          var type = oel.type;
          var mingxi1 = $("select[name=oel_wanfa]").val();
          var mingxi2 = $("select[name=oel_neirong]").val();

          $.post("order_edit.php", {id:id,type:type,mingxi1:mingxi1,mingxi2:mingxi2}, function(data)
          {
              if($.trim(data) == "修改成功"){
                $(oel.obj).html(mingxi1);
                $(oel.obj).next("td").html(mingxi2);
              }
              
              alert($.trim(data));
              
                cancel_oel();

          });
      }

        function cancel_oel(){
          $("select[name=oel_wanfa]").html("");
          $("select[name=oel_neirong]").html("");
          $("#order_edit_layer").css({width:0,height:0});
        }

        
        function getoeltypeid($type){

          if($type=="广东快乐十分"){
            return 1;
          }

          if($type=='重庆时时彩'){

            return 2;
          }

          if($type=='北京PK拾'){

            return 3;
          }

          if($type=='重庆快乐十分'){

            return 4;
          }

          if($type=='广西快乐十分'){

            return 5;
          }

          if($type=='江苏快三'){

            return 6;
          }

        }
      
        function getoeltype(type){

          if(type==1){
            return '广东快乐十分注单修改';
          }

          if(type==2){

            return '重庆时时彩注单修改';
          }

          if(type==3){

            return '北京PK拾注单修改';
          }

          if(type==4){

            return '重庆快乐十分注单修改';
          }

          if(type==5){

            return '广西快乐十分注单修改';
          }

          if(type==6){

            return '江苏快三注单修改';
          }

        }

        function getmingxi($type){
          if($type==1){
            return ['第一球','第二球','第三球','第四球','第五球','第六球','第七球','第八球','总和、龙虎'];
          }

          if($type==2){

            return ['第一球','第二球','第三球','第四球','第五球','总和、龙虎和','前三','中三','后三'];
          }

          if($type==3){

            return ['冠军','亚军','第三名','第四名','第五名','第六名','第七名','第八名','第九名','第十名','冠亚军和'];
          }

          if($type==4){

            return ['第一球','第二球','第三球','第四球','第五球','第六球','第七球','第八球','总和、龙虎'];
          }

          if($type==5){

            return ['第一球','第二球','第三球','第四球','第五球','总和、龙虎和','前三','中三','后三'];
          }

          if($type==6){

            return ['点数','双面','三军','围骰','长牌','短牌'];
          }
 
        }

        function getmingxi2($type,$mingxi1){
            if($type == 1){
              if($mingxi1 == "第一球" || $mingxi1 == "第二球" || $mingxi1 == "第三球" || $mingxi1 == "第四球" || $mingxi1 == "第五球" || $mingxi1 == "第六球" || $mingxi1 == "第七球" || $mingxi1 == "第八球"){
                return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,'大','小','单','双','尾大','尾小','合数单','合数双','东','西','南','北','中','发','白'];
              }else if($mingxi1 == "总和、龙虎"){
                return ['总和大','总和小','总和单','总和双','总和尾大','总和尾小','龙','虎'];
              }
            }

            if($type == 2){
              if($mingxi1 == "第一球" || $mingxi1 == "第二球" || $mingxi1 == "第三球" || $mingxi1 == "第四球" || $mingxi1 == "第五球"){
                return [0,1,2,3,4,5,6,7,8,9,'大','小','单','双'];
              }else if($mingxi1 == "总和、龙虎和"){
                return ['总和大','总和小','总和单','总和双','龙','虎','和'];
              }else if($mingxi1 == "前三" || $mingxi1 == "中三" || $mingxi1 == "后三"){
                return ['豹子','顺子','对子','半顺','杂六'];
              }

            }


            if($type == 3){
              if($mingxi1 == "冠军" || $mingxi1 == "亚军" || $mingxi1 == "第三名" || $mingxi1 == "第四名" || $mingxi1 == "第五名"){
                return [1,2,3,4,5,6,7,8,9,10,'大','小','单','双','龙','虎'];
              }else if($mingxi1 == "第六名" || $mingxi1 == "第七名" || $mingxi1 == "第八名" || $mingxi1 == "第九名" || $mingxi1 == "第十名"){
                return [1,2,3,4,5,6,7,8,9,10,'大','小','单','双'];
              }else if($mingxi1 == "冠亚军和"){
                return  [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,'冠亚大','冠亚小','冠亚单','冠亚双'];
              }

            }

            if($type == 4){
              if($mingxi1 == "第一球" || $mingxi1 == "第二球" || $mingxi1 == "第三球" || $mingxi1 == "第四球" || $mingxi1 == "第五球" || $mingxi1 == "第六球" || $mingxi1 == "第七球" || $mingxi1 == "第八球"){
                return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,'大','小','单','双','尾大','尾小','合数单','合数双','东','西','南','北','中','发','白'];
              }else if($mingxi1 == "总和、龙虎"){
                return ['总和大','总和小','总和单','总和双','总和尾大','总和尾小','龙','虎'];
              }
            }
            
            if($type == 5){
              if($mingxi1 == "第一球" || $mingxi1 == "第二球" || $mingxi1 == "第三球" || $mingxi1 == "第四球" || $mingxi1 == "第五球"){
                return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,'大','小','单','双'];
              }else if($mingxi1 == "总和、龙虎和"){
                return ['总和大','总和小','总和单','总和双','龙','虎','和'];
              }else if($mingxi1 == "前三" || $mingxi1 == "中三" || $mingxi1 == "后三"){
                return ['顺子','半顺','杂六'];
              }

            }
            
            if($type == 6){
              if($mingxi1 == "点数"){
                return [4,5,6,7,8,9,10,11,12,13,14,15,16,17];
              }else if($mingxi1 == "双面"){
                return ['点数大','点数小','点数单','点数双'];
              }else if($mingxi1 == "三军"){
                return ['01','02','03','04','05','06'];
              }else if($mingxi1 == "围骰"){
                return ['010101','020202','030303','040404','050505','060606'];
              }else if($mingxi1 == "长牌"){
                return ['0102','0103','0104','0105','0106','0203','0204','0205','0206','0304','0305','0306','0405','0406','0506'];
              }else if($mingxi1 == "短牌"){
                return ['0101','0202','0303','0404','0505','0606'];
              }

            }

        }
  </script>
</body>
</html>