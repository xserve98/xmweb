<?php $name=$_GET['name'] ?>


<script type="text/javascript">

$(document).ready(function(){
 var e = '<?=$name ?>';
 /// $("#lottery option").eq(e).attr("selected",'selected');
  $("#lottery option[value='"+e+"']").attr("selected", true);// alert(e);


	}); 
	 
function change(){
	
	var e=$('#lottery').val();
	//alert(e);
 ///   LIBS.cookie("defaultLT", e);
	if(e=='BJPK10'){

	 location.href = '/Lottery/list_Pk10.php?name='+e; 
	}
	else if(e=='AULUCKY10'){
	 location.href = '/Lottery/list_Pk10.php?type=8&name='+e;
	
	         	}
				else if(e=='JSSC'){
	 location.href = '/Lottery/list_Pk10.php?type=24&name='+e;
	
	         	}
			else if(e=='CQSSC'){
	 location.href = '/Lottery/ssc_list.php?name='+e; 

	         	}
		
		else if(e=='GDKLSF'){
	 location.href = '/Lottery/list_gdsf.php?name='+e; 

	         	}
			else if(e=='XYNC'){
	 location.href = '/Lottery/list_xync.php?type=11&name='+e; 

	         	}
			else if(e=='HK6'){
	 location.href = '/Six/Auto.php?name='+e; 

	         	}
				else if(e=='CQHK6'){
	 location.href = '/cqSix/Auto.php?name='+e; 

	         	}
		
			else if(e=='PCEGG'){
	 location.href = '/Lottery/list_xy28.php?name='+e; 

	         	}
		
			else if(e=='JND28'){
	 location.href = '/Lottery/list_xy28.php?type=13&name='+e;

	         	}
		
			else if(e=='XJSSC'){
	 location.href = '/Lottery/ssc_list.php?type=14&name='+e; 
	
	         	}
				else if(e=='TJSSC'){
	 location.href = '/Lottery/ssc_list.php?type=7&name='+e;
	
	         	}
				else if(e=='LFSSC'){
	 location.href = '/Lottery/ssc_list.php?type=20&name='+e; 
	
	         	}
				else if(e=='FFSSC'){
	 location.href = '/Lottery/ssc_list.php?type=21&name='+e; 
	
	         	}
			   else if(e=='WFSSC'){
	 location.href = '/Lottery/ssc_list.php?type=21&name='+e; 
	
	         	}
				
					else if(e=='F3D'){
	 location.href = '/Lottery/list_3D.php?name='+e; 
 
	         	}
					else if(e=='BJKL8'){
	 location.href = '/Lottery/list_kl8.php?name='+e; 

	         	}	else if(e=='PL3'){
	 location.href = '/Lottery/list_3D.php?type=10&name='+e;  
	
	         	}
					else if(e=='XJSSC'){
	 location.href = '/Lottery/ssc_list.php?type=21&name='+e; 

	         	}
		
		else if(e=='JSPCDD'){
	 location.href = '/Lottery/list_xy28.php?type=26&name='+e;


	         	}
		
		else if(e=='BRNN'){
	 location.href = '/Lottery/brnn_list.php?name='+e;  

	         	}

	
	//alert(lottery);

}
$(function(){$('#date').change(change).datepicker();})


</script>



<select id="lottery" onchange="change()">
<option value="BJPK10">北京赛车(PK10)</option>
<option value="JSSC">极速赛车(PK10)</option>
<option value="CQSSC">重庆时时彩</option>
<option value="XJSSC">新疆时时彩</option>
<option value="TJSSC">天津时时彩</option>
<option value="LFSSC">幸运2分彩</option>
<option value="FFSSC">极速时时彩</option>
<option value="HK6">香港六合彩</option>
<option value="CQHK6">极速六合彩</option>

<option value="XYNC">重庆幸运农场</option>
<option value="GDKLSF">广东快乐十分</option>
<option value="PCEGG">PC蛋蛋</option>
<option value="BJKL8">北京快乐8</option>
<option value="F3D">福彩3D</option>
<option value="PL3">体彩排列三</option>

<option value="JSPCDD">极速PC蛋蛋</option>
<option value="JND28">加拿大28</option>

</select>