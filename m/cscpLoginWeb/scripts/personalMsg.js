$(function(){
	//全选、不全选
	$("#reverse").bind('click',function(){
	//	alert($("#reverse").get(0).checked);
	//	alert($("#reverse").attr("checked"));
	//	alert($('#reverse').is(':checked'));
		if($("#reverse").get(0).checked){ 
			$(".selsysmsg").each(function(){
					$(this).prop('checked','checked');
			});
		}else{ //第二次点击取消选中
			$(".selsysmsg").each(function(){
				$(this).attr('checked',false);
		});
		}
	});
	//已读系统消息
	$("#readmsg").bind('click',function(){
		if($("#readmsg").is(':checked')){ //第一次点击选中
			$(".selsysmsg").each(function(){
				if($(this).attr("isReaded") == 1){
					$(this).prop('checked','checked');
				}
			});
		}else{//第二次点击取消选中
			$(".selsysmsg").each(function(){
				if($(this).attr("isReaded") > 0){
					$(this).attr('checked',false);
				}
			});
		}
	});
	//未读系统消息
	$("#noread").bind('click',function(){
		if($("#noread").is(':checked')){//第一次点击选中
			$(".selsysmsg").each(function(){
				if($(this).attr("isReaded") == 0){
					$(this).prop('checked','checked');
				}
			});
		}else{//第二次点击取消选中
			$(".selsysmsg").each(function(){
				if($(this).attr("isReaded") == 0){
					$(this).attr('checked',false);
				}
			});
		}
	});
});
function deleteMoreMsg(){
	if(confirm("您确定要删除选中的消息吗？")){
		var deleteMoreMsg = "";
		var deleteMsgCount = 0;
		
		$(".selsysmsg").each(function(){
			if($(this).get(0).checked){
				deleteMoreMsg += $(this).val()+",";
				deleteMsgCount += 1;
			}
		});
		var o = {
				delMoreMsg: deleteMoreMsg
				/*delMsgCount: deleteMsgCount*/
		};
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/deleteMoreMsg?" + Math.random()*10000,
			data : jsonuserinfo,
			contentType : 'application/json',
			dataType : "json",
			async :true,
			timeout: 200000,
			beforeSend : function(){
				$("#progressBar").show();
			},
			success :function(data){
		    	if(data){
		    		if(data.success == true && data.returnResult != 0){
		    			$("#progressBar").hide();
		    			location.href="personalMsg";
		    		}else{
		    			$("#progressBar").hide();
		    		    if(data.returnResult == 0){
		    		    	JqueryShowMessage(l_perMsg['UPDATE_FAIL']);
		    		    }else if(data.message == 'SESSION_EXPIRED'){
		    				JqueryShowMessageHome(l_basic['sessionExpired']);
		    			}else if(data.message == 'TRY_AGAIN'){
		    				JqueryShowMessage(l_basic['TryAgain']);
		    			}else {
		    				JqueryShowMessage(l_basic['Parameters_error']);
		    			}
		    			
		    		}
		    	}
			},
			error : function(xmlhttprequest, error) {
				$("#progressBar").hide();
			},
			complete : function() {
			}
			
		});
		
	}
}
function deletePersonalMsg(obj){
	if(confirm("您确定要删除该条消息吗？")){
		var deId=obj;
		var o = {
			deleteId: deId
		};
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/deletePerMsg?" + Math.random()*10000,
			data : jsonuserinfo,
			contentType : 'application/json',
			dataType : "json",
			async :true,
			timeout: 200000,
			beforeSend : function(){
			},
		    success :function(data){
		    	if(data){
		    		if(data.success == true && data.returnResultMsg == 1){
//		    			$("#progressBar").hide();
		    			location.href="personalMsg";
		    		}else{
//		    			$("#progressBar").hide();
		    		    if(data.returnResultMsg == 0){
		    		    	JqueryShowMessage(l_perMsg['UPDATE_FAIL']);
		    		    }else if(data.message == 'SESSION_EXPIRED'){
		    				JqueryShowMessageHome(l_basic['sessionExpired']);
		    			}else if(data.message == 'TRY_AGAIN'){
		    				JqueryShowMessage(l_basic['TryAgain']);
		    			}else {
		    				JqueryShowMessage(l_basic['Parameters_error']);
		    			}
		    		}
		    	}
		    },
		    error : function(xmlhttprequest, error) {
				$("#progressBar").hide();
			},
			complete : function() {
			}
		});
		
	}
	
}

function openMessageContent(Content,title,msgId){
	var perMsgId = msgId;
	var o = {
		personalMsgId: perMsgId
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/modifyMsgReadType?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async :true,
		timeout: 200000,
		beforeSend : function(){
			
		},
		success :function(data){
			if(data){
				if(data.success == true && data.returnResult == 1){
					$("#"+msgId).html(l_perMsg['1']);
					$(".selsysmsg").each(function(){
						if($(this).val() == msgId){
//							alert($(this).val()+"====="+msgId);
							$(this).attr('isreaded','1');
						}
					});
						
//                  弹出详细信息的内容框
					$("#dialog").dialog({
						height: 330, 
						width: 390, 
						modal: true, 
						draggable: false, 
						resizable:false ,
						show : {
							effect : "clip",
							duration : 200
						},
						hide : {
							effect : "clip",
							duration : 200
					}});
					$("#dialog").dialog("option", "title", title);
					$("#dialog").dialog("open");
					$("#p_dialog").html(Content);
				}else{
					JqueryShowMessage("未读信息更改失败");
				}
			}
		},
		error : function(xmlhttprequest, error) {
			$("#progressBar").hide();
		},
		complete : function() {
		}
		
	});
}
String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) {
	if (!RegExp.prototype.isPrototypeOf(reallyDo)) {  
		return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith);  
	} else { 
		return this.replace(reallyDo, replaceWith);  
	}  
};
function bbb(string){
	var str = ""; 
	str =string.replaceAll(' ','&nbsp;');
	str = str.replaceAll('\n','<br/>');
	return str;
}
function getPersonalMsg(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();

	var o = {
		pageNumber:pageNumber+"",
		RecordsPage:"10"
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getPersonalMsg?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			$("#progressBar").show();
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					$("#table_personalMsg tbody").html("");
					if(data.resultList.length > 0) {
						
						
						var trHtml = "";
						for ( var i = 0; i < data.resultList.length; i++) {
							trHtml = "<tr>";
							trHtml += 
								  "<td>&nbsp;&nbsp;&nbsp;<input class='selsysmsg' type='checkbox' isreaded=\""+data.resultList[i].readType+"\" whichtable='1' value = \""+data.resultList[i].id+"\" >&nbsp;"+ formartTime(data.resultList[i].receiveTime,1) + "</a></td>"+
							      "<td><a onclick='openMessageContent(\""+bbb(data.resultList[i].content)+"\",\""+l_message['msg5']+"\",\""+data.resultList[i].id+"\")' class='r_t_td_a'>"+data.resultList[i].content.substring(0,20)+"</a></td>"+
								  
//								  "<td >"+ l_perMsg[data.resultList[i].type] + "</a></td>"+
								  "<td id = \""+data.resultList[i].id+"\" isreaded = \""+data.resultList[i].readType+"\">"+ l_perMsg[data.resultList[i].readType] + "</a></td>"+
								  "<td ><input id='delchoice' type='button' onclick='deletePersonalMsg(\""+data.resultList[i].id+"\")' value=\""+l_deleteText['msg1']+"\"></td>"+
								  
								     /* "<td>&nbsp;&nbsp;&nbsp;<input class='selsysmsg' type='checkbox' isreaded=\""+data.resultList[i].readType+"\" whichtable='1' value = \""+data.resultList[i].id+"\" >&nbsp;<a onclick='openMessageContent(\""+data.resultList[i].content+"\",\""+l_message['msg5']+"\",\""+data.resultList[i].id+"\")' class='r_t_td_a'>"+data.resultList[i].content.substring(0,20)+"...</a></td>"+
									  "<td >"+ formartTime(data.resultList[i].receiveTime,1) + "</a></td>"+
//									  "<td >"+ l_perMsg[data.resultList[i].type] + "</a></td>"+
									  "<td id = \""+data.resultList[i].id+"\" isreaded = \""+data.resultList[i].readType+"\">"+ l_perMsg[data.resultList[i].readType] + "</a></td>"+
									  "<td ><input id='delchoice' type='button' onclick='deletePersonalMsg(\""+data.resultList[i].id+"\")' value='删除'></td>"+
									  */
									  "</tr>";
							$("#table_personalMsg tbody").append(trHtml);
							
						}
						$('.auto').autoNumeric('init');
						
						$("#table_personalMsg tr" ).mousemove(function(){
							tr_move(this);
						});
						$("#table_personalMsg tr" ).mouseout(function(){
							tr_out(this);
						});
						
					
						$("#noRecord").hide();
						$("#pageMember").show();
						$("#currMemberNum").html(data.personalMsgCount.countMsg);
						
						var pageNum = data.pageNumber;
						var pageAllNumber = data.pageAllNumber;
						
						$("#allPageNum").html(pageNum);
						if(pageNum == 1) {
							if(pageAllNumber != 1) {
								$("#pageNext").click(function(){
									getPersonalMsg((pageNum + 1));
								});
							}
						} else if(pageNum == pageAllNumber) {
							$("#pagePrev").click(function(){
								getPersonalMsg((pageNum - 1));
							});
						} else {
							$("#pageNext").click(function(){
								getPersonalMsg((pageNum + 1));
							});
							$("#pagePrev").click(function(){
								getPersonalMsg((pageNum - 1));
							});
						}
						
						var pageNumHtml = "";
						var forEnd;
						var forBegin;
						if(pageAllNumber > 10) {
							if(pageNum > 5) {
								if(pageAllNumber - pageNum > 5) {
									forEnd = pageNum + 5;
									forBegin = pageNum - 4;
								} else {
									forEnd = pageAllNumber;
									forBegin = pageAllNumber - 9;
								}
							} else {
								forEnd = 10;
								forBegin = 1;
							}
						} else {
							forEnd = pageAllNumber;
							forBegin = 1;
						}
						for ( var j = forBegin; j <= forEnd; j++) {
							if(j != pageNum) {
								pageNumHtml += "<a onclick=\"getPersonalMsg("+j+");\" style='cursor: pointer;'>"+ j + "</a>&nbsp;";
							} else {
								pageNumHtml += "<font class='F_bold ' style='color:#f00; font-weight: bold;'>"+ j + "</font>&nbsp;";
							}
						}
						$("#currPageNum").html(pageNumHtml);
					} else {
						$("#pageMember").hide();
						$("#noRecord").show();
					} 
					$("#progressBar").hide();
				} else {
					$("#progressBar").hide();
					JqueryShowMessage(l_basic['tryAgain']);
				}
			}
		},
		error : function(xmlhttprequest, error) {
			$("#progressBar").hide();
		},
		complete : function() {
		}
	});
}
function getPersonalMsgForMobile(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();
	
	var o = {
			pageNumber:pageNumber+"",
			RecordsPage:"10"
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getPersonalMsg?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			$("#progressBar").show();
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					$("#table_personalMsg tbody").html("");
					if(data.resultList.length > 0) {
						
						
						var trHtml = "";
						for ( var i = 0; i < data.resultList.length; i++) {
							var trHtml = "";
							/*trHtml = "<tr>";
							trHtml += 
								"<td>&nbsp;&nbsp;&nbsp;<input class='selsysmsg' type='checkbox' isreaded=\""+data.resultList[i].readType+"\" whichtable='1' value = \""+data.resultList[i].id+"\" >&nbsp;"+ formartTime(data.resultList[i].receiveTime,1) + "</a></td>"+
								"<td><a onclick='openMessageContent(\""+bbb(data.resultList[i].content)+"\",\""+l_message['msg5']+"\",\""+data.resultList[i].id+"\")' class='r_t_td_a'>"+data.resultList[i].content.substring(0,20)+"</a></td>"+
								"<td id = \""+data.resultList[i].id+"\" isreaded = \""+data.resultList[i].readType+"\">"+ l_perMsg[data.resultList[i].readType] + "</a></td>"+
								"<td ><input id='delchoice' type='button' onclick='deletePersonalMsg(\""+data.resultList[i].id+"\")' value='删除'></td>"+
								"</tr>";*/
							
							trHtml += 
								"<div class='mes_tit'>"+
									"<p>"+
										"<span id='receiveTime'>"+ formartTime(data.resultList[i].receiveTime,1) + "</span> <span id='readType'>（"+ l_perMsg[data.resultList[i].readType] + "）</span>"+
									"</p>"+
									"<a class='close' href='javascript:void(0);'  onclick='deletePersonalMsg(\""+data.resultList[i].id+"\")' data-ajax='false'>"+
									"<img src='../images/all/icon_close2.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/icon_close2.png*//></a>"+
								"</div>"+
									"<div class='mes_con bb' onclick=''>"+
									"<span id='content' onclick='openMessageContentForMobile(\""+bbb(data.resultList[i].content)+"\",\""+l_message['msg5']+"\",\""+data.resultList[i].id+"\")'>"+data.resultList[i].content.substring(0,20)+"</span>"+
								"</div>";
							
							$("#personalMsg").append(trHtml);
							
						}
						
						$("#table_personalMsg tr" ).mousemove(function(){
							tr_move(this);
						});
						$("#table_personalMsg tr" ).mouseout(function(){
							tr_out(this);
						});
						
						
						$("#noRecord").hide();
						$("#pageMember").show();
						$("#currMemberNum").html(data.personalMsgCount.countMsg);
						
						var pageNum = data.pageNumber;
						var pageAllNumber = data.pageAllNumber;
						
						$("#allPageNum").html(pageNum);
						if(pageNum == 1) {
							if(pageAllNumber != 1) {
								$("#pageNext").click(function(){
									getPersonalMsg((pageNum + 1));
								});
							}
						} else if(pageNum == pageAllNumber) {
							$("#pagePrev").click(function(){
								getPersonalMsg((pageNum - 1));
							});
						} else {
							$("#pageNext").click(function(){
								getPersonalMsg((pageNum + 1));
							});
							$("#pagePrev").click(function(){
								getPersonalMsg((pageNum - 1));
							});
						}
						
						var pageNumHtml = "";
						var forEnd;
						var forBegin;
						if(pageAllNumber > 10) {
							if(pageNum > 5) {
								if(pageAllNumber - pageNum > 5) {
									forEnd = pageNum + 5;
									forBegin = pageNum - 4;
								} else {
									forEnd = pageAllNumber;
									forBegin = pageAllNumber - 9;
								}
							} else {
								forEnd = 10;
								forBegin = 1;
							}
						} else {
							forEnd = pageAllNumber;
							forBegin = 1;
						}
						for ( var j = forBegin; j <= forEnd; j++) {
							if(j != pageNum) {
								pageNumHtml += "<a onclick=\"getPersonalMsg("+j+");\" style='cursor: pointer;'>"+ j + "</a>&nbsp;";
							} else {
								pageNumHtml += "<font class='F_bold ' style='color:#f00; font-weight: bold;'>"+ j + "</font>&nbsp;";
							}
						}
						$("#currPageNum").html(pageNumHtml);
					} else {
						$("#pageMember").hide();
						$("#noRecord").show();
					} 
					$("#progressBar").hide();
				} else {
					$("#progressBar").hide();
					JqueryShowMessage(l_basic['tryAgain']);
				}
			}
		},
		error : function(xmlhttprequest, error) {
			$("#progressBar").hide();
		},
		complete : function() {
		}
	});
}

function openMessageContentForMobile(Content,title,msgId){
	var perMsgId = msgId;
	var o = {
		personalMsgId: perMsgId
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/modifyMsgReadType?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async :true,
		timeout: 200000,
		beforeSend : function(){
			
		},
		success :function(data){
			if(data){
				if(data.success == true && data.returnResult == 1){
					alert(Content);
//					$("#"+msgId).html(l_perMsg['1']);
//					$(".selsysmsg").each(function(){
//						if($(this).val() == msgId){
////							alert($(this).val()+"====="+msgId);
//							$(this).attr('isreaded','1');
//						}
//					});
						
/*//                  弹出详细信息的内容框
					$("#dialog").dialog({
						height: 330, 
						width: 390, 
						modal: true, 
						draggable: false, 
						resizable:false ,
						show : {
							effect : "clip",
							duration : 200
						},
						hide : {
							effect : "clip",
							duration : 200
					}});
					$("#dialog").dialog("option", "title", title);
					$("#dialog").dialog("open");
					$("#p_dialog").html(Content);*/
//					var personalMsgAll = document.getElementById("personalMsgAll");
//					var message_tit = document.getElementById("message_tit");
//					var personalMsg = document.getElementById("personalMsg");
////					var bb = document.getElementById("bb");
//					personalMsgAll.removeChild(message_tit);
//					personalMsgAll.removeChild(personalMsg);
////					personalMsgAll.removeChild(bb);
//					var trHtmlContent = "";
//					trHtmlContent += 
//			            "<div class='mes_tit'>"+
//			                "<p>"+
//			                    "<span>2016-09-27 02:29:16</span>"+
//			                    "<span>（ <font color='red'>已读</font>）</span>"+
//			                "</p>"+
//			                "<a class='close' href='javascript:void(0);' onclick='deletePersonalMsg(\""+msgId+"\")' data-ajax='false'><img src='../images/all/icon_close2.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/icon_close2.png*/></a>"+
//			            "</div>"+
//			            "<div class='mes_con bb'>"+
//			              "<span>"+Content+"</span>"+
//			            "</div>"+
//			            "<div class='mes_sign bb'>"+
//			              "<p></p>"+
//			              "<span></span>"+
//			            "</div>"+
//			            "<div class='mes_back'><a href='javascript:void(0);' onclick='location.reload();' data-ajax='false'>返回</a></div>";
//					
//					$("#personalMsgAll").append(trHtmlContent);
					
					}else{
						JqueryShowMessage("未读信息更改失败");
				}
			}
		},
		error : function(xmlhttprequest, error) {
			$("#progressBar").hide();
		},
		complete : function() {
		}
		
	});
}

function getMsgCountUnread(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getMsgCountUnread?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async : true, 
		timeout : 20000,
		beforeSend : function(xmlhttprequest) {
			$("#unreadMsg").html("--");
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					var twoOther = $("#twoOhter").val();
					if (twoOther == "idTwo") {
						$(".unreadMsg").html(data.msgCountUnread);
					} else {
						$("#unreadMsg").html(data.msgCountUnread);
					}
//						$("#live_blce").html("<span class='cridtConversion_msg'>"+b_msg['live']+"</span>");
				} else {
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageHome(l_basic['sessionExpired']);
					} else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessage(l_basic['tryAgain']);
					}
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
}



