function autofitframe(fid){
	var hb=$('body').height();
	$(fid,parent.document).height(hb);
}
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}

$(document).ready(function($) {	
	// var tztype = getUrlParam('touzhutype');
	// if(tztype==1){
	// 	tztype = 1;
	// }else{
	// 	tztype = 0;
	// }
	// top.mem_index.s_betiframe.touzhutype=tztype;
	// $('#touzhutype',parent.document).val(tztype);
	$('#datashow').scroll(function() {
	    var sleft = $(this).scrollLeft();
	    $('.liansai a',this).css('marginLeft', sleft);
	});
	autofitframe('#J_SportsIFrame');
	setInterval(function(){
		autofitframe('#J_SportsIFrame');
	},1000);
	$(parent.document).scrollTop(0);	
});