function dateGetTotalReportDay(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailDay();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailDay();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailDay();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailDay();
	});
	
}

function getTotailRepotTotailDay(){
	$("#returnBg").html("");
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	var platform = $("#platform").val();
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), $("#from_hour").val()
			+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), $(
			"#to_hour").val()
			+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
		platform : $("#platform").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotailDay?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/index.jsp'>"+l_report['BACK']+"</a>");
				},
				success : function(data) {
					if (data) {
						if(data.success == false){
							$("#progressBar").hide();
							if(data.message == 'MemberReport_or_MemberLevelTypeId_errors') {
								JqueryShowMessageReload(l_basic['member_LevelTypeId_errors']);
							} else if(data.message == 'SESSION_EXPIRED') {
								JqueryShowMessageHome(l_basic['sessionExpired']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['TryAgain']);
							}else {
								JqueryShowMessage(l_basic['Parameters_error']);
							}
						}else{
							$("#total_table tbody").html("");
							$("#total_table_day tbody").html("");
							$("#noRecord").hide();
							
							if(data.liveMemberReportTotalDaysList.length > 0){
								var totBetCount = 0;
								var totStakeAmount = 0;
								var totValidStake = 0;
								var totWinLoss = 0;
								var totMemberCommAmount = 0;
								var tt=0;
								var joinWhatPage = "";
								if (platform == null || platform == "") {
									joinWhatPage = "liveWinLoss";
								} else if (platform == "DS") {
									joinWhatPage = "liveDSWinLoss";
								} else if(platform == "LMG") {
									joinWhatPage = "liveLMGWinLoss";
								} else if(platform == "ZJ") {
									joinWhatPage = "liveZJWinLoss";
//								} else if(platform == "OGLIVE") {
//									joinWhatPage = "liveOGWinLoss";
								}
								for(var i= 0;i < data.liveMemberReportTotalDaysList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/app/" + joinWhatPage + "?fTe="+data.liveMemberReportTotalDaysList[i].reportDate+"' data-ajax='false'>"+data.liveMemberReportTotalDaysList[i].reportDate+"</a></td>"
										+ "<td class='F_bold'>"+ data.liveMemberReportTotalDaysList[i].betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].winLoss,2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].total,2) + "</td>" */
										+ "</tr>";
										$("#total_table tbody").append(trHtml);
										
										 totBetCount = totBetCount + data.liveMemberReportTotalDaysList[i].betCount;
										 totStakeAmount = totStakeAmount + data.liveMemberReportTotalDaysList[i].stakeAmount;
										 totValidStake = totValidStake + data.liveMemberReportTotalDaysList[i].validStake;
										 totWinLoss = totWinLoss + data.liveMemberReportTotalDaysList[i].winLoss;
										 totMemberCommAmount =totMemberCommAmount + data.liveMemberReportTotalDaysList[i].memberCommAmount;
										 tt = tt + data.liveMemberReportTotalDaysList[i].total;
								}
								
								trHtml = "<tr>"
									+ "<td class='F_bold'>"+ totBetCount+ "</td>"
									+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
									/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(tt,2) + "</td>" */
									+ "</tr>";
									$("#total_table_day tbody").append(trHtml);
								
							}else{
								var noRecordString = "";
								noRecordString = "<td colspan='5'>您当前没有讯息</td>";
								trHtml = "<tr id='noRecord' align='center'>"
									+ noRecordString
								+ "</tr>";
									
								$("#total_table tbody").append(trHtml);
							}
						$("#progressBar").hide();
						}
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
					} else {
						$("#progressBar").hide();
						JqueryShowMessage("服务器繁忙, 请稍后再试!");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage("网络繁忙, 请稍后再试!");
				},
				complete : function() {
				}
			});
}

function addliveCainoType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addliveCainoType?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:true, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
		},
		success : function(data) {
			if(data){
				if(data.success){
					for ( var i = 0; i < data.liveCasinoTypes.length; i++) {
						$("#LiveType").append( "<option value='" + data.liveCasinoTypes[i] + "'>" + l_LiveCasinoType[data.liveCasinoTypes[i]] + "</option>");
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



function dateGetLiveBetDetail(){
//	$("#Yesterday").unbind();
//	$("#Today").unbind();
//	$("#ThisWeek").unbind();
//	$("#LastWeek").unbind();
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLiveBetDetail('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLiveBetDetail('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLiveBetDetail('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLiveBetDetail('1');
	});
	
}

function getLiveBetDetail(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	var platform = $("#platform").val();
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), $("#from_hour").val()
			+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), $(
			"#to_hour").val()
			+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
		// queryStr : queryStrObj.val(),
//		parentId : "" + id,
		platform : $("#platform").val(),
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
		tableId : "0",
		shoeId : "",
		gameId : "",
		liveType : $("#LiveType").val(),
//		hall:$("#Hall").val(),
		pageNumber : pageNumber + "", 
		RecordsPage : 10 + ""
		
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getLiveBetDetail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					var joinWhatPage = "";
					if (platform == null || platform == "") {
						joinWhatPage = "liveWinLossDay";
					} else if (platform == "DS") {
						joinWhatPage = "liveDSWinLossDay";
					} else if(platform == "LMG") {
						joinWhatPage = "liveLMGWinLossDay";
					} else if(platform == "ZJ") { 
						joinWhatPage = "liveZJWinLossDay";
//					} else if(platform == "AG") {
//						joinWhatPage = "liveAGWinLossDay";
					}
					$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/app/" + joinWhatPage + "?fTe="+fromDateObj.val()+"&tTe="+toDateObj.val()+"'>"+l_report['BACK']+"</a>");
				},
				success : function(data) {
					if (data) {
						if (data.success == false) {
							$("#progressBar").hide();
								if(data.message == 'MemberReport_or_MemberLevelTypeId_errors') {
									JqueryShowMessageReload(l_basic['member_LevelTypeId_errors']);
								} else if(data.message == 'SESSION_EXPIRED') {
									JqueryShowMessageHome(l_basic['sessionExpired']);
								} else if(data.message == 'TRY_AGAIN') {
									JqueryShowMessage(l_basic['TryAgain']);
								}else {
									JqueryShowMessage(l_basic['Parameters_error']);
								}
						} else {
							$("#result_table tbody").html("");
							$("#total_table tbody").html("");
//							$("#cruuency_span").hide();
//							$("#reportId").val(id);
//							$("#reportType").val('MEMBER');
//							$(".logReturn").show();
//							$("#Cancel").click(function() {
//								$("#reportId").val(data.parentId);
//								$("#reportType").val('PARTNER');
////								if ($("#returnType").val() == '1') {
////									playWinLoss();
////								} else {
////									playMemberReport();
////								}
//
//							});
						
//							$("#report_div").html(htm_liveBetDetail);
//							$("#report_title_td").html("<span class='font_b'>"+ data.userName+ "</span> 下注明细 &nbsp;&nbsp;&nbsp;&nbsp;" +
//													"<span class= 'F_normal'>( "+ fromDateObj.val() + " "+ $("#from_hour").val()+ ":"+ $("#from_minute").val()+ ":"+ $("#from_second").val()+ " - " + toDateObj.val()
//													+ " " + $("#to_hour").val()+ ":"+ $("#to_minute").val()+ ":"+ $("#to_second").val()+ " )</span>");
							if (data.resultList.length > 0) {
								var cardIcons = {
									CLUB : '\u2663',
									DIAMOND : '\u2666',
									SPADE : '\u2660',
									HEART : '\u2665'
								};
								var playerCards = "";
								var bestCards = "";
								var communityCards = "";

								var trHtml = "";
								var betCount = 0;
								var stake = 0;
								var validStake = 0;
								var winLoss = 0;
								var memberCommAmount = 0;

								for ( var i = 0; i < data.resultList.length; i++) {
									trHtml = "<tr>";

//									playerCards = data.resultList[i].playerCards;
//									bestCards = data.resultList[i].bestCards;
//									communityCards = data.resultList[i].communityCards;
//
//									if (playerCards == null|| playerCards == "null"|| playerCards == "") {
//										playerCards = "-";
//									} else {
//										playerCards = playerCards.replace(/T/g,"10");
//										playerCards = playerCards.replace(/c /g,"<span style='font-size:20px;'>"+ cardIcons['CLUB']+ "</span>&nbsp;&nbsp;");
//										playerCards = playerCards.replace(/d /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['DIAMOND']+ "</span>&nbsp;&nbsp;");
//										playerCards = playerCards.replace(/s /g,"<span style='font-size:20px;'>"+ cardIcons['SPADE']+ "</span>&nbsp;&nbsp;");
//										playerCards = playerCards.replace(/h /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['HEART']+ "</span>&nbsp;&nbsp;");
//									}
//									if (bestCards == null|| bestCards == "null"|| bestCards == "") {
//										bestCards = "-";
//									} else {
//										bestCards = bestCards.replace(/T/g,"10");
//										bestCards = bestCards.replace(/c /g,"<span style='font-size:20px;'>"+ cardIcons['CLUB']+ "</span>&nbsp;&nbsp;");
//										bestCards = bestCards.replace(/d /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['DIAMOND']+ "</span>&nbsp;&nbsp;");
//										bestCards = bestCards.replace(/s /g,"<span style='font-size:20px;'>"+ cardIcons['SPADE']+ "</span>&nbsp;&nbsp;");
//										bestCards = bestCards.replace(/h /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['HEART']+ "</span>&nbsp;&nbsp;");
//									}
//
//									if (communityCards == null|| communityCards == "null"|| communityCards == "") {
//										communityCards = "-";
//									} else {
//										communityCards = communityCards.replace(/T/g, "10");
//										communityCards = communityCards.replace(/c /g,"<span style='font-size:20px;'>"+ cardIcons['CLUB']+ "</span>&nbsp;");
//										communityCards = communityCards.replace(/d /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['DIAMOND']+ "</span>&nbsp;");
//										communityCards = communityCards.replace(/s /g,"<span style='font-size:20px;'>"+ cardIcons['SPADE']+ "</span>&nbsp;");
//										communityCards = communityCards.replace(/h /g,"<span style='font-size:20px; color:#f00;'>"+ cardIcons['HEART']+ "</span>&nbsp;");
//									}
									if (platform == null || platform == "") {
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>IG" + l_igLiveHallName[data.resultList[i].hall] + "</td>"
											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
										trHtml += "<td class='F_bold f_left'>";
									} else if (platform == "DS") {
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>卡卡湾娱乐城</td>"
											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
										trHtml += "<td class='F_bold f_left'>";
									} else if(platform == "LMG") {
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>LMG娱乐城</td>"
											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
										trHtml += "<td class='F_bold f_left'>";
									} else if(platform == "ZJ") {
											trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>CG娱乐城</td>"
											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
										trHtml += "<td class='F_bold f_left'>";
//									} else if(platform == "AG") {
//										trHtml += "<td>"+ (i + 1)+ "</td>"
//											+ "<td>AG娱乐城</td>"
//											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
//											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
//											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
//											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
//										trHtml += "<td class='F_bold f_left'>";
									}
									/*trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>"+l_LiveHallType[data.resultList[i].hall]+"</td>"
											+ "<td>"+l_LiveCasinoType[data.resultList[i].gameType]+"</td>"
											+ "<td>"+ data.resultList[i].tableName+ " / "+ data.resultList[i].shoeInfoId+ " / "+ data.resultList[i].gameInfoId+ "</td>" 
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>";
									trHtml += "<td class='F_bold f_left'>";*/
									
									
									if(data.resultList[i].gameType == 'BACCARAT') {
										var xx =  data.resultList[i].resultList[0];
										if(xx == 1) {
											trHtml +="<span class='Font_Y'>庄</span>";
										} else if(xx == 2) {
											trHtml += "<span class='Font_B'>闲</span>";
										} else if(xx == 3) {
											trHtml += "<span class='Font_G'>和</span>";
										}
										xx =  data.resultList[i].resultList[2];
										if(xx == 1) {
											trHtml +=",<span class='Font_B'>小</span>";
										} else if(xx == 2) {
											trHtml += ",<span class='Font_Y'>大</span>";
										}
										xx =  data.resultList[i].resultList[1];
										if(xx == 1) {
											trHtml +=",<span class='Font_Y'>庄对</span>";
										} else if(xx == 2) {
											trHtml += ",<span class='Font_B'>闲对</span>";
										} else if(xx == 3) {
											trHtml +=",<span class='Font_Y'>庄对</span>";
											trHtml += ",<span class='Font_B'>闲对</span>";
										}
									} else if(data.resultList[i].gameType == 'BACCARAT_INSURANCE') {
										var xx =  data.resultList[i].resultList[0];
										if(xx == 1) {
											trHtml +="<span class='Font_Y'>庄</span>";
										} else if(xx == 2) {
											trHtml += "<span class='Font_B'>闲</span>";
										} else if(xx == 3) {
											trHtml += "<span class='Font_G'>和</span>";
										}
										xx =  data.resultList[i].resultList[2];
										if(xx == 1) {
											trHtml +=",<span class='Font_B'>小</span>";
										} else if(xx == 2) {
											trHtml += ",<span class='Font_Y'>大</span>";
										}
										xx =  data.resultList[i].resultList[1];
										if(xx == 1) {
											trHtml +=",<span class='Font_Y'>庄对</span>";
										} else if(xx == 2) {
											trHtml += ",<span class='Font_B'>闲对</span>";
										} else if(xx == 3) {
											trHtml +=",<span class='Font_Y'>庄对</span>";
											trHtml += ",<span class='Font_B'>闲对</span>";
										}
									} else if(data.resultList[i].gameType == 'DRAGON_TIGER'){
										var xx =  data.resultList[i].resultList[0];
										if(xx == 1) {
											trHtml +="<span class='Font_B'>虎</span>";
										} else if(xx == 2) {
											trHtml += "<span class='Font_Y'>龙</span>";
										} else if(xx == 3) {
											trHtml += "<span class='Font_G'>和</span>";
										}
									} else if(data.resultList[i].gameType == 'SICBO') {
										for(var j = 0; j < data.resultList[i].resultList.length; j++) {
											trHtml += "<img src='../images/all/report/sicbo/so_- + data.resultList[i].resultList[j] + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + data.resultList[i].resultList[j] + ".png*//>";
										}
									} else if(data.resultList[i].gameType == 'ROULETTE'){
											trHtml += "<img src='../images/all/report/roulette/r_- + data.resultList[i].bankerResult.substring(1,data.resultList[i].bankerResult.length-1) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/roulette/r_" + data.resultList[i].bankerResult.substring(1,data.resultList[i].bankerResult.length-1) + ".png*//>";
									} else if(data.resultList[i].gameType == 'BULL_BULL'){
										var xx =  data.resultList[i].resultList[0];
										if(xx==1||xx==2||xx==3||xx==4||xx==5
											||xx==6||xx==7||xx==8||xx==9){
											   trHtml +="<span class='Font_Y'>庄(牛"+xx+")</span>&nbsp;";
										}else if(xx==0){
											   trHtml +="<span class='Font_Y'>庄(无牛)</span>&nbsp;";
										}else if(xx==10){
											   trHtml +="<span class='Font_Y'>庄(牛牛)</span>&nbsp;";
										}else if(xx==11){
											   trHtml +="<span class='Font_Y'>庄(五公)</span>&nbsp;";
										}
										xx =  data.resultList[i].resultList[2];
										if(xx==1||xx==2||xx==3||xx==4||xx==5
												||xx==6||xx==7||xx==8||xx==9){
											     trHtml +="<span class='Font_Y'>闲1(牛"+xx+")</span>&nbsp;";
											}else if(xx==0){
											     trHtml +="<span class='Font_Y'>闲1(无牛)</span>&nbsp;";
											}else if(xx==10){
											     trHtml +="<span class='Font_Y'>闲1(牛牛)</span>&nbsp;";
											}else if(xx==11){
											     trHtml +="<span class='Font_Y'>闲1(五公)</span>&nbsp;";
											}
										xx =  data.resultList[i].resultList[5];
										if(xx==1||xx==2||xx==3||xx==4||xx==5
												||xx==6||xx==7||xx==8||xx==9){
											     trHtml +="<span class='Font_Y'>闲2(牛"+xx+")</span>&nbsp;";
											}else if(xx==0){
											     trHtml +="<span class='Font_Y'>闲2(无牛)</span>&nbsp;";
											}else if(xx==10){
											     trHtml +="<span class='Font_Y'>闲2(牛牛)</span>&nbsp;";
											}else if(xx==11){
											     trHtml +="<span class='Font_Y'>闲2(五公)</span>&nbsp;";
											}
										xx =  data.resultList[i].resultList[8];
										if(xx==1||xx==2||xx==3||xx==4||xx==5
												||xx==6||xx==7||xx==8||xx==9){
											    trHtml +="<span class='Font_Y'>闲3(牛"+xx+")</span>&nbsp;";
											}else if(xx==0){
											    trHtml +="<span class='Font_Y'>闲3(无牛)</span>&nbsp;";
											}else if(xx==10){
											    trHtml +="<span class='Font_Y'>闲3(牛牛)</span>&nbsp;";
											}else if(xx==11){
											    trHtml +="<span class='Font_Y'>闲3(五公)</span>&nbsp;";
											}
									} 
									if(platform != "AG"){
										var imgUrlAll = data.imgUrl;
										var imgUrlSH = imgUrlAll.split(",")[1];
										var imgUrlOther = imgUrlAll.split(",")[0];
										if(data.resultList[i].hall == "SH"){
											trHtml += "<a onclick='openResultImgSH(\"" + data.resultList[i].gameType + "\",\""+ imgUrlSH +"\",\"" + data.resultList[i].resultImgName + "\",\""+ data.resultList[i].tableName+ "/"+ data.resultList[i].shoeInfoId+ "/"+ data.resultList[i].gameInfoId+ "\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
											+"</td>";
										} else {
											trHtml += "<a onclick='openResultImg(\""+ imgUrlOther +"?" + data.resultList[i].resultImgName + "\",\""+ data.resultList[i].tableName+ "/"+ data.resultList[i].shoeInfoId+ "/"+ data.resultList[i].gameInfoId+ "\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
											+"</td>";
										}
									}
									trHtml += "<td class='F_bold f_right'>"
											+ formatNumberWinLoss(data.resultList[i].winLoss,2)
											+ "<a onclick='openDetail("+ data.resultList[i].id+ ",\""+ data.resultList[i].tableName+ "/"+ data.resultList[i].shoeInfoId+ "/"+ data.resultList[i].gameInfoId+ "\",\""+data.resultList[i].gameType+"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
											+ "</td>"
											/*+ "<td class='F_bold f_right'>"+ formatNumberWinLoss(data.resultList[i].comm,2)+ "</td>"*/
											+ "<td>"+ formartTime(data.resultList[i].endTime,1) + "</td>"  
											/*+ "<td>"+ data.resultList[i].ip + "</td>" */
											+"</tr>";
									$("#result_table tbody").append(trHtml);
									
									betCount = betCount + 1;
									stake = stake+ data.resultList[i].stakeAmount;
									validStake = validStake+ data.resultList[i].validStake;
									winLoss = winLoss+ data.resultList[i].winLoss;
									memberCommAmount = memberCommAmount+ data.resultList[i].comm;

								}

								total = winLoss + memberCommAmount;

								$("#result_table tr").addClass("tr_background");

								$("#result_table tr").mousemove(function() {
									tr_move(this);
								});
								$("#result_table tr").mouseout(function() {
									tr_out(this);
								});

								trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>当前页</td>"
										+ "<td class='F_bold'>"+ betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(stake, 2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(validStake, 2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(winLoss, 2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(total, 2)+ "</td>" */ 
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>全部页</td>"
										+ "<td class='F_bold'>"+ data.pokerMemberReportTotal.betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.pokerMemberReportTotal.winLoss,2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.pokerMemberReportTotal.memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.pokerMemberReportTotal.total,2) + "</td>"*/ 
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								$("#total_table").show();
								$('.auto').autoNumeric('init');
								$("#noRecord").hide();
								$("#pageMember").show();
								$("#currMemberNum").html(data.MemberListTotal);

								var pageNum = data.pageNumber;
								var pageAllNumber = data.pageAllNumber;

								$("#allPageNum").html(pageNum);
								if (pageNum == 1) {
									if (pageAllNumber != 1) {
										$("#pageNext").click(function() {
											getLiveBetDetail(pageNum + 1);
										});
									}
								} else if (pageNum == pageAllNumber) {
									$("#pagePrev").click(function() {
										getLiveBetDetail(pageNum - 1);
									});
								} else {
									$("#pageNext").click(function() {
										getLiveBetDetail(pageNum + 1);
									});
									$("#pagePrev").click(function() {
										getLiveBetDetail(pageNum - 1);
									});
								}
								var pageNumHtml = "";
								var forEnd;
								var forBegin;
								if (pageAllNumber > 10) {
									if (pageNum > 5) {
										if (pageAllNumber - pageNum > 5) {
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
									if (j != pageNum) {
										pageNumHtml += "<a onclick=\"getLiveBetDetail("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
									} else {
										pageNumHtml += "<font class='F_bold currPageNumber'>"+ j + "</font>&nbsp;";
									}
								}
								$("#currPageNum").html(pageNumHtml);
								$("#progressBar").hide();
							} else {
								$("#progressBar").hide();
								$("#pageMember").hide();
								var noRecordString = "";
								if (platform == null || platform == "") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								} else if (platform == "DS") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								} else if(platform == "LMG") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								} else if(platform == "ZJ") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								} else if(platform == "OGLIVE") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								}
								trHtml = "<tr id='noRecord' align='center'>"
									+ noRecordString
								+ "</tr>";
									
								$("#result_table tbody").append(trHtml);
							}
							$("#dialog").dialog({
								width : 550,
								height : 320,
								autoOpen : false,
								modal : true,
								show : {
									effect : "clip",
									duration : 200
								},
								hide : {
									effect : "clip",
									duration : 200
								}
							});
							$("#dialog_img").dialog({
								width : 490,
								height : 360,
								autoOpen : false,
								modal : true,
								show : {
									effect : "clip",
									duration : 200
								},
								hide : {
									effect : "clip",
									duration : 200
								}
							});
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage("服务器繁忙, 请稍后再试!");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage("网络繁忙, 请稍后再试!");
				},
				complete : function() {
				}
			});
}

function openResultImg(url, table) {
	$("#detailTable tbody").html("");
	$("#dialog_img").dialog("option", "title", table);
	$("#dialog_img").dialog("open");
	$("#detailTable tbody").html( " <tr><td colspan='7' style='border:0 !important;'><iframe frameborder='no' scrolling='yes' src='"+url+"' allowtransparency='true' style='width:466px; height:302px; border:0; overflow-x:hidden; overflow-y:hidden; background:none;'></iframe></td></tr>");
}
function openResultImgSH(gameType, src, url, table) {
	$("#detailTable tbody").html("");
	$("#dialog_img").dialog( "option", "title", table);
	$("#dialog_img").dialog( "open" );
	while(url.indexOf("&") != -1 || url.indexOf("=") != -1){
		url = url.replace("&","%26");
		url = url.replace("=","%3D");
	}
	var imgStr = "<img src='-+$(-#path").val()+"/app/getResultImgSH?gameType="+gameType+"&imgUrl="+src+"&imgSrc="+url+"'/*tpa=http://juyou1989.com/cscpLoginWeb/scripts/"+$("#path").val()+"/app/getResultImgSH?gameType="+gameType+"&imgUrl="+src+"&imgSrc="+url+"*//>";
	$("#detailTable tbody").html(imgStr);
}

function openDetail(id, table, type) {
	$("#dialog").dialog("option", "title", table);
	$("#dialog").dialog("open");
	var platform = $("#platform").val();
	var o = {
			id : id + "",
			platform : $("#platform").val(),
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
				type : "post",
				url : $("#path").val() + "/app/getLiveBetDetailTable?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				// async:false,
				// timeout : 20000,
				beforeSend : function() {
					$("#detailTable tbody").html(" <tr><td colspan='7'><img src='../images/CN/yzc/pc/loadingAnimation.gif'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/yzc/pc/loadingAnimation.gif*//></td></tr>");
				},
				success : function(data) {
					if (data) {
						if (data.success == false) {
							JqueryShowMessage(l_basic['TryAgain']);
						} else {
							if (data.resultList.length > 0) {
								var trHtml = "";
								if(type == 'SICBO') {
								    for ( var i = 0; i < data.resultList.length; i++) {
								    	var betType = '';
								    	var l = data.resultList[i].betType.length;
								    	if(data.resultList[i].betType.indexOf('SB_PAIR') != -1) {
								    		betType = l_LiveBetType['SB_PAIR'] + " " + data.resultList[i].betType.substring(8,l);
								    	} else if(data.resultList[i].betType.indexOf('SB_TWO') != -1) {
								    		betType = l_LiveBetType['SB_TWO'] + " " + data.resultList[i].betType.substring(7,l);
								    	} else if(data.resultList[i].betType.indexOf('SB_ANYONE') != -1) {
								    		betType = l_LiveBetType['SB_ANYONE'] + " " + data.resultList[i].betType.substring(10,l);
								    	} else if(data.resultList[i].betType.indexOf('SB_TRIPLE') != -1) {
								    		betType = l_LiveBetType['SB_TRIPLE'] + " " + data.resultList[i].betType.substring(10,l);
								    	} else if(data.resultList[i].betType.indexOf('SB_SUM') != -1) {
								    		betType = l_LiveBetType['SB_SUM'] + " " + data.resultList[i].betType.substring(7,l);
								    	} else {
								    		betType = l_LiveBetType[data.resultList[i].betType];
								    	}
								    	
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ betType + "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
		
									}
								} else if(type == 'BACCARAT') {
									for ( var i = 0; i < data.resultList.length; i++) {
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ l_LiveBetType[data.resultList[i].betType]+ "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								}  else if(type == 'BACCARAT_INSURANCE') {
									for ( var i = 0; i < data.resultList.length; i++) {
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ l_LiveBetType[data.resultList[i].betType]+ "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								} else if(type == 'DRAGON_TIGER') {
									for ( var i = 0; i < data.resultList.length; i++) {
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ l_LiveBetType[data.resultList[i].betType]+ "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								} else if(type == 'BULL_BULL') {
									for ( var i = 0; i < data.resultList.length; i++) {
										var betType = '';
										if(data.resultList[i].betType.indexOf('BB_PALYER1_EQUAL') != -1) {
											betType = l_LiveBetType['BB_PALYER1_EQUAL'];
										} else if(data.resultList[i].betType.indexOf('BB_PALYER1_DOUBLE') != -1) {
											betType = l_LiveBetType['BB_PALYER1_DOUBLE'];
										} else if(data.resultList[i].betType.indexOf('BB_PALYER2_EQUAL') != -1) {
											betType = l_LiveBetType['BB_PALYER2_EQUAL'];
										} else if(data.resultList[i].betType.indexOf('BB_PALYER2_DOUBLE') != -1) {
											betType = l_LiveBetType['BB_PALYER2_DOUBLE'];
										} else if(data.resultList[i].betType.indexOf('BB_PALYER3_EQUAL') != -1) {
											betType = l_LiveBetType['BB_PALYER3_EQUAL'];
										} else if(data.resultList[i].betType.indexOf('BB_PALYER3_DOUBLE') != -1) {
											betType = l_LiveBetType['BB_PALYER3_DOUBLE'];
										}
										
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ betType + "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								} else if(type == 'ROULETTE') {
									for ( var i = 0; i < data.resultList.length; i++) {
										var betType = '';
								    	var l = data.resultList[i].betType.length;
								    	if(data.resultList[i].betType.indexOf('RL_SMALL') != -1) {
								    		betType = l_LiveBetType['RL_SMALL'];
								    	} else if(data.resultList[i].betType.indexOf('RL_EVEN') != -1) {
								    		betType = l_LiveBetType['RL_EVEN'];
								    	} else if(data.resultList[i].betType.indexOf('RL_RED') != -1) {
								    		betType = l_LiveBetType['RL_RED'];
								    	} else if(data.resultList[i].betType.indexOf('RL_BLACK') != -1) {
								    		betType = l_LiveBetType['RL_BLACK'];
								    	} else if(data.resultList[i].betType.indexOf('RL_ODD') != -1) {
								    		betType = l_LiveBetType['RL_ODD'];
								    	} else if(data.resultList[i].betType.indexOf('RL_BIG') != -1) {
								    		betType = l_LiveBetType['RL_BIG'];
								    	} else if(data.resultList[i].betType.indexOf('RL_ROW') != -1) {
								    		betType = l_LiveBetType['RL_ROW'] + " " + data.resultList[i].betType.substring(7,l);
								    	} else if(data.resultList[i].betType.indexOf('RL_COL') != -1) {
								    		betType = l_LiveBetType['RL_COL'] + " " + data.resultList[i].betType.substring(7,l);
								    	} else {
								    		var betType = data.resultList[i].betType;
								    		betType = betType.substr(3,(l-2));
								    	}
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ betType + "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								} else if(type == 'XOC_DIA') {
									for ( var i = 0; i < data.resultList.length; i++) {
										trHtml += "<tr>"
												+ "<td class='f_left'>"+ l_LiveBetType[data.resultList[i].betType]+ "</td>"
												+ "<td class='f_left'>"+ data.resultList[i].betCode.substring(0,6) + "</td>"
												+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
												+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLoss,2) + "</td>"//formatNumberWinLoss(data.resultList[i].winLoss - data.resultList[i].stakeAmount,2)
												+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
												+ "</tr>";
	
									}
								}
								$("#detailTable tbody").html(trHtml);
							}
						}
					} else {
						$("#detailTable tbody").html(" <tr><td colspan='7'>服务器繁忙, 请稍后再试!</td></tr>");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#detailTable tbody").html(
							" <tr><td colspan='7'>网络繁忙, 请稍后再试!</td></tr>");
				},
				complete : function() {
				}
			});
}

