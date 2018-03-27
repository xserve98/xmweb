//香港彩每期报表
function dateLottoReportDay(){

	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLottoReportDay();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLottoReportDay();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLottoReportDay();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLottoReportDay();
	});
}

//香港彩每日报表
function getLottoReportDay(){
	$("#returnBg").html("");
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), 
		$("#from_hour").val()+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), 
		$("#to_hour").val()+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
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
		toSecond : $("#to_second").val()
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getLottoReportDay?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					$("#returnBg").html("<a href='http://juyou1989.com/cscpLoginWeb/index.jsp' style='color: #000'>"+l_report['BACK']+"</a>");
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
							
							if(data.lottoMemberReportTotalDaysList.length > 0){
								
								var totBetCount = 0;
								var totStakeAmount = 0;
								var totValidStake = 0;
								var totWinLoss = 0;
								var totMemberCommAmount = 0;
								var tt=0;
								
								for(var i= 0;i < data.lottoMemberReportTotalDaysList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>"+data.lottoMemberReportTotalDaysList[i].gameNo+"</a></td>"
										+ "<td class='F_bold'>"+ data.lottoMemberReportTotalDaysList[i].betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.lottoMemberReportTotalDaysList[i].stake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.lottoMemberReportTotalDaysList[i].validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lottoMemberReportTotalDaysList[i].winLoss,2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lottoMemberReportTotalDaysList[i].memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lottoMemberReportTotalDaysList[i].total,2) + "</td>" */
										+ "</tr>";
										$("#total_table tbody").append(trHtml);
										
										
										 totBetCount = totBetCount + data.lottoMemberReportTotalDaysList[i].betCount;
										 totStakeAmount = totStakeAmount + data.lottoMemberReportTotalDaysList[i].stake;
										 totValidStake = totValidStake + data.lottoMemberReportTotalDaysList[i].validStake;
										 totWinLoss = totWinLoss + data.lottoMemberReportTotalDaysList[i].winLoss;
										 totMemberCommAmount =totMemberCommAmount + data.lottoMemberReportTotalDaysList[i].memberCommAmount;
										 tt = tt + data.lottoMemberReportTotalDaysList[i].total;
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

function dateGetLottoBetDetail(){
	$("#Yesterday").click(function() {
		$("#FromGameNo").val($("#YBeginDate").val());
		$("#ToGameNo").val($("#YEndDate").val());
		getLottoBetDetail('1');
	});
	$("#Today").click(function() {
		$("#FromGameNo").val($("#TBeginDate").val());
		$("#ToGameNo").val($("#TEndDate").val());
		getLottoBetDetail('1');
	});
	/*$("#ThisWeek").click(function() {
		$("#FromGameNo").val($("#TWBeginDate").val());
		$("#ToGameNo").val($("#TWEndDate").val());
		getLottoBetDetail('1');
	});
	$("#LastWeek").click(function() {
		$("#FromGameNo").val($("#LWBeginDate").val());
		$("#ToGameNo").val($("#LWEndDate").val());
		getLottoBetDetail('1');
	});*/
	
}

//香港彩详细报表
function getLottoBetDetail(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();
	var fromGameNoObj =  $("#FromGameNo");
	var toGameNoObj =  $("#ToGameNo");
	
	if(Number(fromGameNoObj.val()) > Number(toGameNoObj.val())) {
		JqueryShowMessage(l_basic['gameNo']);
		return;
	}
	var fTeTime = $("#"+"id"+fromGameNoObj.val()).val();
	var tTeTime = $("#"+"id"+toGameNoObj.val()).val();
	var o = {
		formGameNo: fromGameNoObj.val(),
		toGameNo: toGameNoObj.val(),
		betType : $("#BetType").val(),
//		reportType:$('input:radio[name="ReportTypeRadio"]:checked').val(),
		pageNumber : pageNumber + "",
		RecordsPage : 20 + ""
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getLottoBetDetail?" + Math.random()*10000,
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
								

								var trHtml = "";
								var betCount = 0;
								var stake = 0;
								var validStake = 0;
								var winLoss = 0;
								var memberCommAmount = 0;

								for ( var i = 0; i < data.resultList.length; i++) {
									
									var betDetail = "";
									if(data.resultList[i].betDetailList.length > 1) {
										for ( var d = 0; d < data.resultList[i].betDetailList.length; d++) {
											betDetail +=  "," + l_lotto_BetTypeArray[data.resultList[i].betDetailList[d]];
										}
										betDetail = betDetail.substring(1);
									} else {
										
										if(data.resultList[i].betOn == "WUXING" && data.resultList[i].betType == "TU") {
											betDetail = "土";
										} else {
											betDetail = l_lotto_BetTypeArray[data.resultList[i].betType];
										}
									}
									
									trHtml = "<tr>";
									trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>"+data.resultList[i].betId+"<br/>"+formartTime(data.resultList[i].betTime,3)+"</td>"
											+ "<td>"+data.resultList[i].tray+"盘</td>"
											+ "<td><span class='Font_G'>"+data.resultList[i].gameNo+"期</span><br/>"+ l_lotto_BetOnArray[data.resultList[i].betOn]+"</td>" 
											+ "<td><span class='Font_B'>『"+betDetail+"』</span><br/><span class='Font_R F_bold'>"+ data.resultList[i].odds+ " | "+data.resultList[i].oddsC+ "</span></td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].stakeAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validStake,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumberWinLoss(data.resultList[i].winLoss,2)+"</td>" 
											/*+ "<td class='f_right'>"+ formatNumber(data.resultList[i].memberComm*100,2)+ "%<br/>"+formatNumberWinLoss(data.resultList[i].memberCommAmount,2)+"</td>"
											+ "<td class='F_bold f_right'>"+ formatNumberWinLoss(data.resultList[i].winLoss + data.resultList[i].memberCommAmount,2)+"</td>"*/
											+"</tr>";
									$("#result_table tbody").append(trHtml);

									betCount = betCount + 1;
									stake = stake+ data.resultList[i].stakeAmount;
									validStake = validStake+ data.resultList[i].validStake;
									winLoss = winLoss+ data.resultList[i].winLoss;
									memberCommAmount = memberCommAmount+ data.resultList[i].memberCommAmount;

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
										+ "<td class='F_bold '>"+ formatNumberWinLoss(total, 2)+ "</td>"  */
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								
								
							   trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>全部页</td>"
										+ "<td class='F_bold'>"+ data.memberReportTotal.betCount+ "</td>"
										+ "<td class='F_bold'>"+ formatNumber(data.memberReportTotal.stakeAmount,2)+ "</td>"
										+ "<td class='F_bold'>"+ formatNumber(data.memberReportTotal.validStake,2)+ "</td>"
										+ "<td class='F_bold'>"+ formatNumberWinLoss(data.memberReportTotal.winLoss,2)+ "</td>"
										/*+ "<td class='F_bold'>"+ formatNumberWinLoss(data.memberReportTotal.memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold'>"+ formatNumberWinLoss(data.memberReportTotal.total,2) + "</td>" */
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
											getLottoBetDetail(pageNum + 1);
										});
									}
								} else if (pageNum == pageAllNumber) {
									$("#pagePrev").click(function() {
										getLottoBetDetail(pageNum - 1);
									});
								} else {
									$("#pageNext").click(function() {
										getLottoBetDetail(pageNum + 1);
									});
									$("#pagePrev").click(function() {
										getLottoBetDetail(pageNum - 1);
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
										pageNumHtml += "<a onclick=\"getLottoBetDetail("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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
								noRecordString = "<td colspan='8'>您当前没有讯息</td>";
							trHtml = "<tr id='noRecord' align='center'>"
								+ noRecordString
							+ "</tr>";
								
							$("#result_table tbody").append(trHtml);
							}
//							$("#dialog").dialog({
//								width : 480,
//								height : 320,
//								autoOpen : false,
//								modal : true,
//								show : {
//									effect : "clip",
//									duration : 200
//								},
//								hide : {
//									effect : "clip",
//									duration : 200
//								}
//							});
//							$("#dialog_img").dialog({
//								width : 490,
//								height : 360,
//								autoOpen : false,
//								modal : true,
//								show : {
//									effect : "clip",
//									duration : 200
//								},
//								hide : {
//									effect : "clip",
//									duration : 200
//								}
//							});
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