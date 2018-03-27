var base;
var index=0;
var imgsize;
$(function(){
	base = $("#base").val();
	lunbo();
	setInterval("lunboB()", 5000);
})

//ÂÖ²¥
function lunbo(){
	
	$.ajax({
		url:base+"/xmIndex/js/getLunBo.do",
		type:"GET",
		dataType:"json",
		success:function(j){
			var col='';
			var obj = '<ul>';
			imgsize=j.length;
			for(var i=0;i<imgsize;i++){
				col+='<li style="float: left; width: 700px;" class="no'+i+'" data-index="'+i+'"><img src="'+j[i].titleImg+'" ondragstart="return false;"></li>';
				obj+='<li class="" id="cur'+i+'" onclick="lunboqiehuan('+i+')" ></li>';
				
//				obj+='<div class="no'+i+'" data-index="'+i+'" style="height: 250px;background:url('+j[i].titleImg+')"><a target="_blank" href="'+j[i].titleUrl+'"></a></div>';
//				col+='<li id="cur'+i+'" class="KMSPrefix_kinMaxShow_focus" onclick="lunboqiehuan('+i+')"></li>'
			}
			obj+='</ul>'
			$("#lbtupian").html(col);
			$(".hd").html(obj);
			lunboB();
		  }
		});
}


//ÂÖ²¥
function lunboB(){
	if(index>=imgsize){
		index=0;
	}
	var dindex=$(".no"+index).attr("data-index");
	for(var i=0;i<imgsize;i++){
		if(i==dindex){
			$(".no"+i).css("display","block");
			$("#cur"+i).addClass("on")
		}else{
			$(".no"+i).css("display","none");
			$("#cur"+i).removeClass("on")
		}
	}
	index+=1;
}

//ÂÖ²¥
function lunboqiehuan(id){
	for(var i=0;i<imgsize;i++){
		if(i==id){
			$(".no"+i).css("display","block");
			$("#cur"+i).addClass("on")
			index = id;
		}else{
			$(".no"+i).css("display","none");
			$("#cur"+i).removeClass("on")
		}
	}
}

//ÏÂÒ»Í¼
function nextClick(){
	if(index>=imgsize){
		index=0;
	}
	var dindex=$("#no"+index).attr("data-index");
	for(var i=0;i<imgsize;i++){
		if(i!=dindex){
			$("#no"+i).css("opacity","0");
		}else{
			$("#no"+i).css("opacity","1");
		}
	}
	index+=1;
}


//ÉÏÒ»Í¼
function prevClick(){
	index = index-2;
	if(index == -1){
		index = imgsize - 1;
	}
	var dindex=$("#no"+index).attr("data-index");
	for(var i=0;i<imgsize;i++){
		if(i!=dindex){
			$("#no"+i).css("opacity","0");
		}else{
			$("#no"+i).css("opacity","1");
		}
	}
	index+=1;
}
