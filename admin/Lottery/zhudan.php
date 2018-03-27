<?php 
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");

$sql_bak="select * from c_bet_bak order by dotime desc limit 100";// OR c_bet.id=c_bet_bak.id AND c_bet.win<>c_bet_bak.win";
$result_bak=$mysqli->query($sql_bak);

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>


</head>
<body onselectstart="return false">
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table width="100%" border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/images/tb.gif" width="16" height="16" /></td>
                <td><font style="font-weight:bold" color="#344B50">&nbsp;注單校驗</font></td>
                
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            
 
            <table width="100%" border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <td width="10%">彩種</td>
                <td width="10%">期數</td>
                <td width="10%">用戶</td>
			  
                <td width="5%">注單號</td>
                <td width="10%">下注时间</td>
				<td width="10%">操作时间</td>
                <td width="5%">下注類型</td>
                <td width="5%">下注明細</td>
				<td width="5%">赔率</td>
                <td width="5%">下注金额</td>
                <td width="5%">输赢</td>
                <td width="10%">操作类型</td>
				
              </tr>
              <?php while($rows=$result_bak->fetch_array()){?>
              <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td><?php echo $rows['type']?></td>
                <td><?php echo $rows['qishu']?></td>
                <td><?php echo $rows['username']?></td>
			  
                <td><?php echo $rows['id']?></td>
                <td><?php echo $rows['addtime']?></td>
				<td><?php echo $rows['dotime']?></td>
                <td><?php echo $rows['mingxi_1']?></td>
                <td><?php echo $rows['mingxi_2']?></td>
				<td><?php echo $rows['odds']?></td>
                <td><?php echo $rows['money']?></td>
                <td><?php echo $rows['win']?></td>
		
                <td style="color:red;"><?php echo $rows['dowhat']?></td>
              </tr>
             
 			<?php }?>
            </table>
            
            <!-- end --></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12">&nbsp;</td>
          <td class="f" align="center"><span class="odds">（注意：以上注單為異常注單）</span>
            <!-- <input type="text" value="0" id="day" class="texta" <?php echo $disabled?> />
            <input type="submit" class="inputs" onclick="delNumber(1, 3)" value="加載盤口" <?php echo $disabled?> /> --></td>
          <td width="16">&nbsp;</td>
        </tr>
      </table>
    <td width="5" bgcolor="#4F4F4F"></td>
      </td>
  </tr>
  <tr>
    <td height="5" bgcolor="#4F4F4F"></td>
    <td bgcolor="#4F4F4F"></td>
    <td height="5" bgcolor="#4F4F4F"></td>
  </tr>
</table>
</body>
</html>