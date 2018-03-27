<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("../include/newpage.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs	 =	$query->fetch_array();
if($_GET["title"]){
$title= strip_tags($_GET["title"]);
$msg		=	strip_tags($_GET["textarea"]);
$addtime		=	date('Y-m-d h:i:s',time());
if($msg==''||$title==''){
	 message('提交失败！');	
	 exit;
	}else{
   
	$sql		=	"insert into message(uid,title,msg,addtime) values ('$uid','$title','$msg','$addtime')";
	//echo $sql;
	$mysqli->query($sql);
    message('提交成功！', "message.php");
		
	}
}


?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript">
	$(function() {
		$(".tabnavi2").click(function() {
			$(".tabnavi2").removeClass("tabnaviactive2");
			$(this).addClass("tabnaviactive2");
			var indexnum = $(this).index();
			$(".tabbox2").css("display", "none");
			$(".tabbox2:eq(" + indexnum + ")").css("display", "block");
		});

	});

	
	
</script>
</head>
<body id="bodyid" class="skin_blue">
 <?php include_once("usermenu.php"); ?>
 
 
 
 <div class="rightpanel rw">
		<div class="contentcontainer">
			<div class="clearfix">
				<div class="tabnavi2 tabnaviactive2 clearfix">历史记录</div>
				<div class="tabnavi2 clearfix">创建反馈</div>
			</div>
			<div class="tabbox2" style="display: block">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bordergrey">

					<tbody>
						 	<?php
				   
					$sql		=	"select id from message where uid=".$_SESSION["uid"]." order by id desc";
					$query		=	$mysqli->query($sql);
					$sum		=	$mysqli->affected_rows; //总页数
					$thisPage	=	1;
					if(@$_GET['page']){
						$thisPage	=	$_GET['page'];
					}
					$page		=	new newPage();
					$perpage	= 10;
					$thisPage	=	$page->check_Page($thisPage,$sum,$perpage);

					$id		=	'';
					$i		=	1; //记录 uid 数
					$start	=	($thisPage-1)*$perpage+1;
					$end	=	$thisPage*$perpage;
					while($row = $query->fetch_array()){
						if($i >= $start && $i <= $end){
							$id .=	$row['id'].',';
						}
						if($i > $end) break;
						$i++;
					}
					if($id){
						$id		=	rtrim($id,',');
						$sql	=	"select * from message where id in($id) order by id desc";
						$query	=	$mysqli->query($sql);
						$i		=	1;
						while($rows = $query->fetch_array()){
							
					?>
						<tr class="borderbtmgrey readmail">
							<td width="71%" class="algleft"><?=$rows["title"]?>
                             <?php if($rows["is_jz"]==0){?>
                            （ <span class="red">等待回复</span> ）
							 <? }else{?>
                             （ <span class="blue">已回复</span> ）
                              <? }?>
							</td>
<td width="23%"><?=date("Y-m-d h:i:s",strtotime($rows["addtime"]))?> (<a onClick="dialog.url('<?=strlen(trim($rows["title"]))?$rows["title"]:'无标题信息'?>',620,400,'message_show.php?id=<?=$rows["id"]?>')" href="javascript:;">详情</a>)

						</tr>
					<?php
							$i++;
						}
					}
					?>
						<tr>
							<td colspan="3"><div class="page_info">
<span class="record">共 1 条记录</span>
<span class="page_control">
<a class="previous">前一页</a>
<span class="current">1</span>
<a class="next">后一页</a>
</span>
</div>
</td>
						</tr>

					</tbody>
				</table>

			</div>


			<div class="tabbox2">
				<table width="90%" border="0" cellspacing="0" cellpadding="0">

					<tbody>
                      <form name="form1" method="GET" action="message.php" >
						<tr>
							<td width="15%" valign="top" class="algleft">您的问题</td>
							<td width="85%" class="algleft"><select id="title"  name="title"  class="textbox2">
									<option value="请选择">请选择</option>
									<option value="技术问题">技术问题</option>
									<option value="意见建议">意见建议</option>
									<option value="财务问题">财务问题</option>
									<option value="其他问题">其他问题</option>
							</select></td>
						</tr>
						<tr>
							<td valign="top" class="algleft">问题具体描述</td>
							<td class="algleft"><textarea name="textarea" id="textarea" class="textbox4"></textarea></td>
						</tr>
						<tr>
							<td valign="top" class="algleft">&nbsp;</td>
							<td class="algright">
                            <input   class="btnsubmit" type="submit" value="创建"/>
                           </td>
                        
						</tr>
                            </form>
					</tbody>
				</table>

			</div>

		</div>
	</div>


</body></html>