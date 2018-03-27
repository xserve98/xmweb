function setbet(typename_in,touzhuxiang_in,match_id_in,point_column_in,ben_add_in,is_lose_in,xx_in){
	if($(parent.topFrame.document).find("#username").length<=0){
		alert("登录后才能进行此操作");
		return ;
	}
	if(!arguments[5]) is_lose_in = 0;
	//$('#loads').html('<img src="/images/loading.gif" border="0" />');
	var touzhutype=parent.s_betiframe.touzhutype;
	$.post("/ajaxleft/bet_match.php",{ball_sort:typename_in,match_id:match_id_in,touzhuxiang:touzhuxiang_in,point_column:point_column_in,ben_add:ben_add_in,is_lose:is_lose_in,xx:xx_in,touzhutype:touzhutype,rand:Math.random()},function (data){parent.s_betiframe.bet(data);}); 
}