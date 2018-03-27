$(document).ready(function($) {
	var hb=$('body').height();
	$('#J_UserIFrame',parent.document).height(hb);
	var wb=$(parent.window).width();
	if(wb<720){
		$('.panel').width(wb-14);
	}	
});
function disableRightClick(e){
	if(!document.rightClickDisabled){ // initialize
		if(document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = disableRightClick;
		}else{
			document.oncontextmenu = disableRightClick;
		}
		return document.rightClickDisabled = true;
	}
	
	if(document.layers || (document.getElementById && !document.all)){
		if (e.which==2||e.which==3) return false;
	}else{
		return false;
	}
}
//disableRightClick();


//添加到收藏夹  
function AddToFavorite()  {   
	if (document.all){  
		window.external.addFavorite("http://ez114.com","万丰国际-欢迎您！");  
	}else if (window.sidebar){  
		window.sidebar.addPanel("万丰国际-欢迎您！", "http://ez114.com", "");  
	} 
}

//解决IE6不缓存背景图片问题
try{
	document.execCommand("BackgroundImageCache", false, true);
}catch(e){}