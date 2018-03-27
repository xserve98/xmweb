function dateGetTotalReportDayBBIN(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailDayBBIN();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailDayBBIN();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailDayBBIN();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailDayBBIN();
	});
	
}

function getTotailRepotTotailDayBBIN(){
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
								var joinWhatPage = "";
								if(platform == "BBINLIVE") {
									joinWhatPage = "liveBBINWinLoss";
								} else if(platform == "BBINSLOTS") {
									joinWhatPage = "slotsBBINWinLoss";
								}
								for(var i= 0;i < data.liveMemberReportTotalDaysList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/app/" + joinWhatPage + "?fTe="+data.liveMemberReportTotalDaysList[i].reportDate+"' data-ajax='false'>"+data.liveMemberReportTotalDaysList[i].reportDate+"</a></td>"
										+ "<td class='F_bold'>"+ data.liveMemberReportTotalDaysList[i].betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].winLoss,2)+ "</td>"
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
									+ "</tr>";
									$("#total_table_day tbody").append(trHtml);
								
							}else{
								trHtml = "<tr id='noRecord' align='center'>"
									+ "<td colspan='5'>您当前没有讯息</td>"
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

function addliveAgCainoType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addliveAgCainoType?" + Math.random()*10000,
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
						$("#LiveType").append( "<option value='" + data.liveCasinoTypes[i] + "'>" + l_LiveAgCainoType[data.liveCasinoTypes[i]] + "</option>");
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

function dateGetLiveBetDetailBBIN(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLiveBetDetailBBIN('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLiveBetDetailBBIN('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLiveBetDetailBBIN('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLiveBetDetailBBIN('1');
	});
	
}

function getLiveBetDetailBBIN(pageNumber){
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
				url : $("#path").val() + "/app/getLiveBetDetailBBIN?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					var joinWhatPage = "";
					if(platform == "BBINLIVE") {
						joinWhatPage = "liveBBINWinLossDay";
					} else if(platform == "BBINSLOTS") {
						joinWhatPage = "slotsBBINWinLossDay";
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

									if(platform == "BBINLIVE") {
										trHtml = "<tr>";
										var result = "";
										var betType = data.resultList[i].wagerDetail;
										var betTypeArr = data.resultList[i].wagerDetail.split("*");
										var resultStr = data.resultList[i].result;
										var resultArr = data.resultList[i].result.split(",");
										var gameType = data.resultList[i].gameType;
										
										if (gameType == 3001) {  //百家乐
											result = "庄" +resultArr[0] + ",闲" +resultArr[1];
										} else if (gameType == 3002) {//二八槓
											resultStrArr = resultStr.split(",");
											result = "庄门(" +resultStrArr[0] +")上门(" +resultStrArr[1] +")中门(" +resultStrArr[2] +")下门(" +resultStrArr[3] +")";
										} else if (gameType == 3003) {//龍虎鬥
											result = "龙" +resultArr[0] + ",虎" +resultArr[1];
										} else if (gameType == 3005) {//三公
											if(data.resultList[i].result == null || data.resultList[i].result == ""){
												result = "-";
											}else{
												result = "庄(" +resultArr[0] + "),闲1(" +resultArr[1]
											 	+ "),闲2(" +resultArr[2] + "),闲3(" +resultArr[3] + ")";
											}
										} else if (gameType == 3006) {//溫州牌九
											result = resultStr.replaceAll("P1", "顺门").replaceAll("P2", "出门").replaceAll("P3", "到门")
												.replaceAll("W", "赢").replaceAll("L", "输");
										} else if (gameType == 3007) {//輪盤
											result = "<img src='../images/all/report/roulette/r_- + resultStr + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/roulette/r_" + resultStr + ".png*//>";
										} else if (gameType == 3008) {//骰寶
											for (var j = 0; j < resultArr.length; j++) {
												result += "<img src='../images/all/report/sicbo/so_- + resultArr[j] + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + resultArr[j] + ".png*//>";
											}
										} else if (gameType == 3010) {//德州撲克
											result =  "牌面详细<a onclick='openBbinLiveDzpkDetail(\""+ resultStr +"\",\""+ data.resultList[i].bankerResult +"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>";
										} else if (gameType == 3011) {//色碟
											result = resultStr.replace("White", "白").replace("Red", "红");
										} else if (gameType == 3012) {//牛牛
											resultStrArr = resultStr.split(",");
											result ="庄(" +resultStrArr[0].replace("No Bull", "无牛").replace("Bull", "牛") 
												+")闲1(" +resultStrArr[1].replace("No Bull", "无牛").replace("Bull", "牛")  
												+")闲2(" +resultStrArr[2].replace("No Bull", "无牛").replace("Bull", "牛")  
												+")闲3(" +resultStrArr[3].replace("No Bull", "无牛").replace("Bull", "牛") +")";
										} else if (gameType == 3014) {//無限 21 點
											result = "庄" +resultArr[0] + ",闲" +resultArr[1];
										} else if (gameType == 3015) {//番攤
											result = resultStr;
										} else if (gameType == 3016) {//魚蝦蟹	
											for (var j = 0; j < resultArr.length; j++) {
												result += "<img src='../images/all/report/yuXiaXie/yxx_- + resultArr[j] + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/yuXiaXie/yxx_" + resultArr[j] + ".png*//>";
											}
										} 
										
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>"+"BBIN娱乐城"+"</td>"
											+ "<td>"+ l_bbinLiveGameType[gameType] +"</td>"
											+ "<td>"+ data.resultList[i].tableCode+ " / "+ data.resultList[i].serialId+ " <br/> "+ data.resultList[i].wagersId + "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].commStakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right font_r'>"+ result + "</td>"
											+ "<td class='F_bold f_right'>" 
												+ formatNumberWinLoss(data.resultList[i].winLossAmount,2) 
												+ "<a onclick='openBbbinLiveDetail(\""+ gameType +"\",\""+ betType +"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se' data-ajax='false'>&nbsp;&nbsp;&nbsp;</span></a>"
											+"</td>"
											+ "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
											+ "</tr>";

										$("#result_table tbody").append(trHtml);
										
										betCount = betCount + 1;
										stake = stake+ data.resultList[i].stakeAmount;
										validStake = validStake+ data.resultList[i].commStakeAmount;
										winLoss = winLoss+ data.resultList[i].winLossAmount;
										memberCommAmount = memberCommAmount+ data.resultList[i].memberCommAmount;
										
										var pageNum = data.pageNumber;
										var pageAllNumber = data.pageAllNumber;

										$("#allPageNum").html(pageAllNumber);
										if (pageNum == 1) {
											if (pageAllNumber != 1) {
												$("#pageNext").click(function() {
													getLiveBetDetailBBIN(pageNum + 1);
												});
											}
										} else if (pageNum == pageAllNumber) {
											$("#pagePrev").click(function() {
												getLiveBetDetailBBIN(pageNum - 1);
											});
										} else {
											$("#pageNext").click(function() {
												getLiveBetDetailBBIN(pageNum + 1);
											});
											$("#pagePrev").click(function() {
												getLiveBetDetailBBIN(pageNum - 1);
											});
										}
									} else if(platform == "BBINSLOTS") {
										trHtml = "<tr>";
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>" + l_bbinSlotsGameType[data.resultList[i].gameType] + "</td>" 
											+ "<td>" + data.resultList[i].wagersId + "</td>" 
											+ "<td>" + data.resultList[i].betTime + "</td>"
											+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].stakeAmount,2) + "</td>" 
											+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].commStakeAmount,2) + "</td>"  
											+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLossAmount,2) + "</td>" 
											+ "<td class='F_bold f_right'>" + "已派彩" + "</td>" 
											+ "</tr>";
										$("#result_table tbody").append(trHtml);
										
										betCount = betCount + 1;
										stake = stake+ data.resultList[i].stakeAmount;
										validStake = validStake+ data.resultList[i].commStakeAmount;
										winLoss = winLoss+ data.resultList[i].winLossAmount;
										memberCommAmount = memberCommAmount+ data.resultList[i].memberCommAmount;
										
										var pageNum = data.pageNumber;
										var pageAllNumber = data.pageAllNumber;

										$("#allPageNum").html(pageAllNumber);
										if (pageNum == 1) {
											if (pageAllNumber != 1) {
												$("#pageNext").click(function() {
													getLiveBetDetailBBIN(pageNum + 1);
												});
											}
										} else if (pageNum == pageAllNumber) {
											$("#pagePrev").click(function() {
												getLiveBetDetailBBIN(pageNum - 1);
											});
										} else {
											$("#pageNext").click(function() {
												getLiveBetDetailBBIN(pageNum + 1);
											});
											$("#pagePrev").click(function() {
												getLiveBetDetailBBIN(pageNum - 1);
											});
										}
									}
								}

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
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>全部页</td>"
										+ "<td class='F_bold'>"+ data.pokerMemberReportTotal.betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.pokerMemberReportTotal.winLoss,2)+ "</td>"
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								$("#total_table").show();
								$("#noRecord").hide();
								$("#pageMember").show();
								$("#currMemberNum").html(data.MemberListTotal);

								
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
										pageNumHtml += "<a onclick=\"getLiveBetDetailBBIN("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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
								
								if(platform == "BBINLIVE") {
									noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								} else if(platform == "BBINSLOTS") {
									noRecordString = "<td colspan='8'>您当前没有讯息</td>";
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
							$("#dialog_2").dialog({
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

function addliveBbinCainoType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addliveBbingCainoType?" + Math.random()*10000,
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
						$("#LiveType").append( "<option value='" + data.liveCasinoTypes[i] + "'>" + l_bbinLiveGameType[data.liveCasinoTypes[i]] + "</option>");
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

function addSlotsBbinType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addSlotsBbinType?" + Math.random()*10000,
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
						$("#LiveType").append( "<option value='" + data.liveCasinoTypes[i] + "'>" + l_bbinSlotsGameType[data.liveCasinoTypes[i]] + "</option>");
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

function openBbbinLiveDetail(gameType,betType) {
	$("#dialog").dialog("option", "title", "详细");
	$("#dialog").dialog("open");
	var trHtml = "";
	var betTypeArr = betType.split("*");
    var betType = "";
    var adds = "";
    var betAmount = "";
    var winLoss = "";
	for (var i = 0; i < betTypeArr.length; i++) {
		var betTypeDetailArr = betTypeArr[i].split(",");
		adds = betTypeDetailArr[1];
		betAmount = betTypeDetailArr[2];
		winLoss = betTypeDetailArr[3];
		if (gameType == 3001) {  //百家乐
			betType = l_bbinLivePlayGameBJL[betTypeDetailArr[0]];
		} else if (gameType == 3002) {//二八槓
			betType = l_bbinLivePlayGameEBG[betTypeDetailArr[0]];
		} else if (gameType == 3003) {//龍虎鬥
			betType = l_bbinLivePlayGameLHD[betTypeDetailArr[0]];
		} else if (gameType == 3005) {//三公
			betType = l_bbinLivePlayGameSG[betTypeDetailArr[0]];
		} else if (gameType == 3006) {//溫州牌九
			betType = l_bbinLivePlayGameWZPJ[betTypeDetailArr[0]];
		} else if (gameType == 3007) {//輪盤
			betType = l_bbinLivePlayGameLP[betTypeDetailArr[0]];
		} else if (gameType == 3008) {//骰寶
			betType = l_bbinLivePlayGameSB[betTypeDetailArr[0]];
		} else if (gameType == 3010) {//德州撲克
			betType = l_bbinLivePlayGameDZPK[betTypeDetailArr[0]];
		} else if (gameType == 3011) {//色碟
			betType = l_bbinLivePlayGameSD[betTypeDetailArr[0]];
		} else if (gameType == 3012) {//牛牛
//			if (betTypeDetailArr[0] == 3 || betTypeDetailArr[0] == 6 || betTypeDetailArr[0] == 9) {
//				betType += "(" + betTypeDetailArr[2] + ")";
//			} else {
				betType = l_bbinLivePlayGameNN[betTypeDetailArr[0]];
//			}
		} else if (gameType == 3014) {//無限 21 點
			betType = l_bbinLivePlayGameWX21D[betTypeDetailArr[0]];
		} else if (gameType == 3015) {//番攤
			betType = l_bbinLivePlayGameFT[betTypeDetailArr[0]];
		} else if (gameType == 3016) {//魚蝦蟹
			betType = l_bbinLivePlayGameYXX[betTypeDetailArr[0]];
		} 
		trHtml += "<tr>"
			+ "<td class='f_left'>"+ betType + "</td>"
			+ "<td class='f_left'>"+ adds + "</td>"
			+ "<td class='F_bold f_right'>" + formatNumber(betAmount,2)+ "</td>"
			+ "<td class='F_bold f_right'>" + formatNumberWinLoss(winLoss,2) + "</td>"
			+ "</tr>";
	}
	$("#dialog tbody").html(trHtml);
	
}

function openBbinLiveDzpkDetail(result,bankerResult) {
	$("#dialog_2").dialog("option", "title", "详细");
	$("#dialog_2").dialog("open");
	var trHtml = "";
	//所有牌(bankerResultArr[0]庄家牌+bankerResultArr[1]闲家牌+bankerResultArr[2]公牌)
	var bankerResultArr = bankerResult.split("*");
    var resultArr = result.split("("); //最大牌面resultArr[0]
    var resultBig = resultArr[1].split(")")[0];//牌型
    
	trHtml += "<tr>"
		+ "<td class='f_left'>"+ "庄家牌" + "</td>"
		+ "<td class='F_bold f_right'>"  
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[0].split(-,-)[0].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[0].split(",")[0].replace(".", "") + ".png*//>"
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[0].split(-,-)[1].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[0].split(",")[1].replace(".", "") + ".png*//>"
		+ "</td>"
		+ "</tr>";
	trHtml += "<tr>"
		+ "<td class='f_left'>"+ "闲家牌" + "</td>"
		+ "<td class='F_bold f_right'>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[1].split(-,-)[0].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[1].split(",")[0].replace(".", "") + ".png*//>"
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[1].split(-,-)[1].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[1].split(",")[1].replace(".", "") + ".png*//>"
		+ "</td>"
		+ "</tr>";
	trHtml += "<tr>"
		+ "<td class='f_left'>"+ "公牌" + "</td>"
		+ "<td class='F_bold f_right'>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[2].split(-,-)[0].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[2].split(",")[0].replace(".", "") + ".png*//>"
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[2].split(-,-)[1].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[2].split(",")[1].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[2].split(-,-)[2].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[2].split(",")[2].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[2].split(-,-)[3].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[2].split(",")[3].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + bankerResultArr[2].split(-,-)[4].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + bankerResultArr[2].split(",")[4].replace(".", "") + ".png*//>" 
		+ "</td>"
		+ "</tr>";
	trHtml += "<tr>"
		+ "<td class='f_left'>"+ "最大牌面" + "</td>"
		+ "<td class='F_bold f_right'>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + resultArr[0].split(-,-)[0].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + resultArr[0].split(",")[0].replace(".", "") + ".png*//>"
		+ "<img src='../images/CN/xtx/pc/card_samll/- + resultArr[0].split(-,-)[1].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + resultArr[0].split(",")[1].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + resultArr[0].split(-,-)[2].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + resultArr[0].split(",")[2].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + resultArr[0].split(-,-)[3].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + resultArr[0].split(",")[3].replace(".", "") + ".png*//>" 
		+ "<img src='../images/CN/xtx/pc/card_samll/- + resultArr[0].split(-,-)[4].replace(-.-, --) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/CN/xtx/pc/card_samll/" + resultArr[0].split(",")[4].replace(".", "") + ".png*//>" 
		+ "</td>"
		+ "</tr>";
	trHtml += "<tr>"
		+ "<td class='f_left'>"+ "牌型" + "</td>"
		+ "<td class='F_bold f_right'>" + resultBig + "</td>"
		+ "</tr>";
		
	$("#dialog_2 tbody").html(trHtml);
	
}