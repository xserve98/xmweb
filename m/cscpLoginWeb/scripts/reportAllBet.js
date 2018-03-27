function dateGetTotalReportDayAllBet(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailDayAllBet();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailDayAllBet();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailDayAllBet();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailDayAllBet();
	});
	
}

function getTotailRepotTotailDayAllBet(){
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
								var joinWhatPage = "";
								joinWhatPage = "liveAllBetWinLoss";
								for(var i= 0;i < data.liveMemberReportTotalDaysList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/app/liveAllBetWinLoss" + "?fTe="+data.liveMemberReportTotalDaysList[i].reportDate+"' data-ajax='false'>"+data.liveMemberReportTotalDaysList[i].reportDate+"</a></td>"
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


function dateGetLiveBetDetailAllBet(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLiveBetDetailAllBet('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLiveBetDetailAllBet('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLiveBetDetailAllBet('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLiveBetDetailAllBet('1');
	});
	
}

function getLiveBetDetailAllBet(pageNumber){
	
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
				url : $("#path").val() + "/app/getLiveBetDetailAllBet?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					var joinWhatPage = "";
					if(platform == "ALLBETLIVE") {
						joinWhatPage = "liveAllBetWinLossDay";
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
//									var gameResult = "";
//									var sbGameResult = "";
//									var gameBettingContent = data.resultList[i].gameBettingContent.substring(0,data.resultList[i].gameBettingContent.length-1);
//									var gameType = data.resultList[i].gameNameId;
//									if (gameType == "11") { //百家乐
//										gameResult = l_ogLiveBaccaratGR[data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult];
//									} else if (gameType == "12") { //龙虎
//										gameResult = l_ogLiveDTGR[data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult];
//									} else if (gameType == "13") { //轮盘
//										gameResult = "<img src='../images/all/report/roulette/r_- + data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/roulette/r_" + data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult + ".png*//>";
//									} else if (gameType == "14") { //骰宝
//										sbGameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
//										gameResult = "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(0,1) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(0,1) + ".png*//>"
//											+ "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(1,2) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(1,2) + ".png*//>"
//											+ "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(2) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(2) + ".png*//>";
//									} else if (gameType == "15") { //德州扑克
//										gameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
//									} else if (gameType == "16") { //番摊
//										gameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
//									}
									trHtml = "<tr>";
									if(platform == "ALLBETLIVE") {
										trHtml += "<td>"+ (i + 1)+ "</td>"
//											+ "<td>"+"AllBet娱乐城"+"</td>"
//											+ "<td>"+l_ogLiveGameType[gameType]+"</td>"
//											+ "<td>"+ data.resultList[i].orderNumber + "<br/>" +
//											data.resultList[i].tableId+ " / "+ data.resultList[i].stage+ " / "+ data.resultList[i].inning+ "</td>"
//											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].bettingAmount,2)+ "</td>"
//											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validAmount,2)+ "</td>"
//											+ "<td class='F_bold f_right font_r'>"+ gameResult + "</td>"
//											+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLossAmount,2)
//											+ "<a onclick='openOgDetail(\""+gameBettingContent+"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
//											+"</td>"
//											+ "<td>"+ formartTime(data.resultList[i].addTime,1) + "</td>"  
//											+ "</tr>";
											+ "<td>" + data.resultList[i].username + "</td>" 
											+ "<td>" +formartTime(data.resultList[i].betTime,1) + "</td>" 
											+ "<td>" + data.resultList[i].betNum + "</td>" 
											+ "<td>" + l_LiveAllBetGameType[data.resultList[i].gameType] + "</td>" 
											+ "<td>" + data.resultList[i].tableName + "</td>" 
										trHtml += "<td class='F_bold f_left'>";
										var result = "";
										var bankerResult = "";
										var playerResult = "";
										
										var dragonColour = "";
										var dragonResult = "";
										var dragonHtm = "";
										
										var tigerColour = "";
										var tigerResult = "";
										var tigerHtm = "";
										
										if(data.resultList[i].gameType == 101  			// 普通百家乐
												|| data.resultList[i].gameType == 102 	// VIP百家乐
												|| data.resultList[i].gameType == 103	// 急速百家乐
												|| data.resultList[i].gameType == 104	// 竞咪百家乐
												|| data.resultList[i].gameType == 501) {   //欧洲厅百家乐
											result = data.resultList[i].gameResult.replace(/{/g,"").replace(/}/g,"").split(",");
											for(var k = 0; k < 3; k++){
												var bankerColour1 = "";
												var bankerResult1 = "";
												
												if(result[k] != "-1"){
													if(result[k].substring(0,1) == "1"){	
														bankerColour1 = "黑桃";
													}else if(result[k].substring(0,1) == "2"){
														bankerColour1 = "红桃";
													}else if(result[k].substring(0,1) == "3"){
														bankerColour1 = "梅花";
													}else if(result[k].substring(0,1) == "4"){
														bankerColour1 = "方块";
													}
													var banker = result[k].substring(1);
													if(banker.substring(0,1) == "0"){
														bankerResult1 = banker.substring(1);
													}else if(banker == "10"){
														bankerResult1 = "10";
													}else if(banker == "11"){
														bankerResult1 = "J";
													}else if(banker == "12"){
														bankerResult1 = "Q";
													}else if(banker == "13"){
														bankerResult1 = "K";
													}
												}
												bankerResult += ","+bankerColour1 + bankerResult1;
											}
											for(var h = 3; h < 6; h++){
												var playerColour1 = "";
												var playerResult1 = "";
												if(result[h] != "-1"){
													if(result[h].substring(0,1) == "1"){
														playerColour1 = "黑桃";
													}else if(result[h].substring(0,1) == "2"){
														playerColour1 = "红桃";
													}else if(result[h].substring(0,1) == "3"){
														playerColour1 = "梅花";
													}else if(result[h].substring(0,1) == "4"){
														playerColour1 = "方块";
													}
													var player = result[h].substring(1);
													if(player.substring(0,1) == "0"){
														playerResult1 = player.substring(1);
													}else if(player == "10"){
														playerResult1 = "10";
													}else if(player == "11"){
														playerResult1 = "J";
													}else if(player == "12"){
														playerResult1 = "Q";
													}else if(player == "13"){
														playerResult1 = "K";
													}
												}
												playerResult += ","+playerColour1 + playerResult1;
											}
//											+ "<td>" + data.resultList[i].gameResult + "</td>" 
											trHtml +="<span class='Font_Y'>" + l_LiveBetType['BC_BANKER'] + "(" + bankerResult.substring(1) + ")</span>";
											trHtml +="&nbsp;<span class='Font_B'>" + l_LiveBetType['BC_PLAYER'] + "(" + playerResult.substring(1) + ")</span>";
										}else if(data.resultList[i].gameType == 301){    // 龙虎
											result = data.resultList[i].gameResult.replace(/{/g,"").replace(/}/g,"").split(",");
											if(result[0].substring(0,1) == "1"){
												dragonColour  = "黑桃";
											}else if(result[0].substring(0,1) == "2"){
												dragonColour  = "红桃";
											}else if(result[0].substring(0,1) == "3"){
												dragonColour  = "梅花";
											}else if(result[0].substring(0,1) == "4"){
												dragonColour  = "方块";
											}
											var dragon = result[0].substring(1);
											if(dragon.substring(0,1) == "0"){
												dragonResult  = dragon.substring(1);
											}else if(dragon == "10"){
												dragonResult  = "10";
											}else if(dragon == "11"){
												dragonResult = "J";
											}else if(dragon == "12"){
												dragonResult = "Q";
											}else if(dragon == "13"){
												dragonResult = "K";
											}
											dragonHtm = dragonColour + dragonResult;
											if(result[1].substring(0,1) == "1"){
												tigerColour  = "黑桃";
											}else if(result[1].substring(0,1) == "2"){
												tigerColour  = "红桃";
											}else if(result[1].substring(0,1) == "3"){
												tigerColour  = "梅花";
											}else if(result[1].substring(0,1) == "4"){
												tigerColour  = "方块";
											}
											var tiger = result[1].substring(1);
											if(tiger.substring(0,1) == "0"){
												tigerResult  = tiger.substring(1);
											}else if(tiger == "10"){
												tigerResult  = "10";
											}else if(tiger == "11"){
												tigerResult  = "J";
											}else if(tiger == "12"){
												tigerResult  = "Q";
											}else if(tiger == "13"){
												tigerResult  = "K";
											}
											tigerHtm = tigerColour + tigerResult;
											trHtml +="<span class='Font_Y'>" + l_LiveBetType['DT_DRAGON'] + "(" + dragonHtm + ")</span>";
											trHtml +="&nbsp;<span class='Font_B'>" + l_LiveBetType['DT_TIGER'] + "(" + tigerHtm + ")</span>";
										}else if(data.resultList[i].gameType == 401){    // 轮盘
											trHtml +="<span class='Font_Y'>" + data.resultList[i].gameResult.replace(/{/g,"").replace(/}/g,"") + "</span>";
										}else if(data.resultList[i].gameType == 201){    // 骰宝
											result = data.resultList[i].gameResult.replace(/{/g,"").replace(/}/g,"").split(",");
											for (var j=0; j < result.length; j++) {
												trHtml += "<img src='../images/all/report/sicbo/so_- + result[j] + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + result[j] + ".png*//>&nbsp;";
											}
										}
										
										+"</td>";
									 /*trHtml += "<td>" + data.resultList[i].betType + "</td>" */
									 trHtml += "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].betAmount,2) + "</td>" 
											+ "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].validAmount,2) + "</td>" 
									 trHtml += "<td class='F_bold f_right'>" + formatNumber(data.resultList[i].winLossAmount,2)
									 		+ "<a onclick='openAllbetDetail("+ data.resultList[i].id+ "," + data.resultList[i].gameType + ","+data.resultList[i].betType +",\"" +data.resultList[i].betAmount+"\",\"" + data.resultList[i].winLossAmount+"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a></td>"
									 		"</td>" 
									 trHtml += "<td class='F_bold f_right'>" + l_LiveAllBetGameStateType[data.resultList[i].state] + "</td>" 
											+ "</tr>";
										$("#result_table tbody").append(trHtml);
										
										betCount = betCount + 1;
										stake = stake+ data.resultList[i].betAmount;
										validStake = validStake+ data.resultList[i].validAmount;
										winLoss = winLoss+ data.resultList[i].winLossAmount;
										memberCommAmount = memberCommAmount+ data.resultList[i].comm;
										
										var pageNum = data.pageNumber;
										var pageAllNumber = data.pageAllNumber;

										$("#allPageNum").html(pageNum);
										
									}
								}
								if (pageNum == 1) {
									if (pageAllNumber != 1) {
										$("#pageNext").click(function() {
											getLiveBetDetailAllBet(pageNum + 1);
										});
									}
								} else if (pageNum == pageAllNumber) {
									$("#pagePrev").click(function() {
										getLiveBetDetailAllBet(pageNum - 1);
									});
								} else {
									$("#pageNext").click(function() {
										getLiveBetDetailAllBet(pageNum + 1);
									});
									$("#pagePrev").click(function() {
										getLiveBetDetailAllBet(pageNum - 1);
									});
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
										pageNumHtml += "<a onclick=\"getLiveBetDetailAllBet("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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
								noRecordString = "<td colspan='12'>您当前没有讯息</td>";
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
function openAllbetDetail(id, gameType, betType, validAmount, winLossAmount) {
	$("#dialog").dialog("option", "title", "下注记录");
	$("#dialog").dialog("open");
	var betTypeHtm = "";
	var trHtml = "";
		if(gameType == 101 || gameType == 102 || gameType == 103 || gameType == 104 || gameType == 501){//普通百家乐，VIP百家乐，极速百家乐，竞咪百家乐，欧洲厅百家乐
			betTypeHtm = l_allbetLivePlayGameBJL[betType];
		}else if(gameType == 201){  //骰宝
			betTypeHtm = l_allbetLivePlayGameSB[betType];
		}else if(gameType == 301){  //龙虎
			betTypeHtm = l_allbetLivePlayGameDT[betType];
		}else if(gameType == 401 || gameType == 601){  //轮盘
			betTypeHtm = l_allbetLivePlayGameROU[betType];
		}else if(gameType == 701){  //欧洲厅21点
			betTypeHtm = l_allbetLivePlayGameEUR21D[betType];
		}
		
		trHtml += "<tr>"
			+ "<td class='t_center'>"+ betTypeHtm +"</td>"
			+ "<td class='t_center'>"+ formatNumber(validAmount, 2) +"</td>"
			+ "<td class='t_center'>"+ formatNumberWinLoss(winLossAmount,2) +"</td>"
			+ "</tr>";
	$("#detailTable tbody").html(trHtml);
}

function addAllBetLiveType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addAllBetLiveType?" + Math.random()*10000,
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
					for ( var i = 0; i < data.liveAllBetTypes.length; i++) {
						$("#LiveType").append( "<option value='" + data.liveAllBetTypes[i] + "'>" + l_LiveAllBetGameType[data.liveAllBetTypes[i]] + "</option>");
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