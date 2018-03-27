function dateDsLotteryReportDay(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getDsLotteryReportDay();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getDsLotteryReportDay();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getDsLotteryReportDay();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getDsLotteryReportDay();
	});
}

function getDsLotteryReportDay(){
	$("#returnBg").html("");
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), 
			$("#from_hour").val() + ":" + $("#from_minute").val() + ":" + $("#from_second").val(),
			$("#to_hour").val() + ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
			fromDate : fromDateObj.val(),
			toDate : toDateObj.val(),
			fromHour : $("#from_hour").val(),
			fromMinute : $("#from_minute").val(),
			fromSecond : $("#from_second").val(),
			toHour : $("#to_hour").val(),
			toMinute : $("#to_minute").val(),
			toSecond : $("#to_second").val()
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getDsLotteryReportDay?" + Math.random()*10000,
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
					
					if(data.dsLotteryMemberReportTotalList.length > 0){
						
						var totBetCount = 0;
						var totStakeAmount = 0;
						var totValidStake = 0;
						var totWinLoss = 0;
						var totMemberCommAmount = 0;
						var tt=0;
						
						for(var i= 0;i < data.dsLotteryMemberReportTotalList.length;i++){
							trHtml = "";
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>"+data.dsLotteryMemberReportTotalList[i].reportDate+"</a></td>"
								+ "<td class='F_bold'>"+ data.dsLotteryMemberReportTotalList[i].betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.dsLotteryMemberReportTotalList[i].stake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.dsLotteryMemberReportTotalList[i].validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.dsLotteryMemberReportTotalList[i].winLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.dsLotteryMemberReportTotalList[i].memberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.dsLotteryMemberReportTotalList[i].total,2) + "</td>" */
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							totBetCount = totBetCount + data.dsLotteryMemberReportTotalList[i].betCount;
							totStakeAmount = totStakeAmount + data.dsLotteryMemberReportTotalList[i].stake;
							totValidStake = totValidStake + data.dsLotteryMemberReportTotalList[i].validStake;
							totWinLoss = totWinLoss + data.dsLotteryMemberReportTotalList[i].winLoss;
							totMemberCommAmount =totMemberCommAmount + data.dsLotteryMemberReportTotalList[i].memberCommAmount;
							tt = tt + data.dsLotteryMemberReportTotalList[i].total;
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


function dateGetDsLotteryBetDetail(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getDsLotteryBetDetail('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getDsLotteryBetDetail('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getDsLotteryBetDetail('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getDsLotteryBetDetail('1');
	});
	
}
function getDsLotteryBetDetail(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), $("#from_hour").val()
			+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), $(
			"#to_hour").val()
			+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
			fromDate : fromDateObj.val(),
			toDate : toDateObj.val(),
			fromHour : $("#from_hour").val(),
			fromMinute : $("#from_minute").val(),
			fromSecond : $("#from_second").val(),
			toHour : $("#to_hour").val(),
			toMinute : $("#to_minute").val(),
			toSecond : $("#to_second").val(),
			gameType : $("#t_LT").val(),
//		gameNo : $("#t_GameNo").val(),
			betType : $("#BetType").val(),
			pageNumber : pageNumber + "",
			RecordsPage : 10 + ""
	};
	var jsonuserinfo = $.toJSON(o);
	
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getDsLotteryBetDetail?" + Math.random()*10000,
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
							
							var bet_detail = "";
							var lianMa_detail = "";
							var fill_type = "";
							if(data.resultList[i].gameInfoId == 1 || data.resultList[i].gameInfoId == 5 || data.resultList[i].gameInfoId == 11 || data.resultList[i].gameInfoId == 13) {
								if(data.resultList[i].betOn == 'SERIAL'){
									bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] + l_KLC_BetTypeArray[data.resultList[i].betType];
									var betDetailArray = eval(data.resultList[i].betDetails);
									var detailLength = betDetailArray.length;
									if(detailLength > 2){
										lianMa_detail ="<br/>复式 『 "+ (detailLength - 1) + " 组 』 <br/>"+betDetailArray[0].toString();
									} else {
										lianMa_detail ="<br/>"+betDetailArray[1].toString();
									}
									lianMa_detail = lianMa_detail.replace(new RegExp(",","g"), "、");
									
								} else if(data.resultList[i].betOn == 'SERIAL' || data.resultList[i].betOn == 'D_T_T') {
									bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] + l_KLC_BetTypeArray[data.resultList[i].betType];
								} else {
									bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_KLC_BetTypeArray[data.resultList[i].betType] + " 』 ";
								}
							} else if(data.resultList[i].gameInfoId == 2 || data.resultList[i].gameInfoId == 6 || data.resultList[i].gameInfoId == 7 || data.resultList[i].gameInfoId == 8 || data.resultList[i].gameInfoId == 9) {
								if(data.resultList[i].betOn == 'TOTAL' || data.resultList[i].betOn == 'D_T_T') {
									bet_detail = l_SSC_BetOnArray[data.resultList[i].betOn] + l_DS_SSC_BetTypeArray[data.resultList[i].betType];
								} else {
									bet_detail = l_SSC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_DS_SSC_BetTypeArray[data.resultList[i].betType] + " 』 ";
								}
							} else if(data.resultList[i].gameInfoId == 3) {
								if(data.resultList[i].betOn == 'GOLD_SILVER'){
									if(data.resultList[i].betType == 'BIG' || data.resultList[i].betType == 'SMALL' || data.resultList[i].betType == 'ODD' || data.resultList[i].betType == 'EVEN') {
										bet_detail = l_BJC_BetOnArray[data.resultList[i].betOn] + l_BJC_BetTypeArray[data.resultList[i].betType];
									} else {
										bet_detail = l_BJC_BetOnArray[data.resultList[i].betOn] +"军和 『 "+ l_BJC_BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								} else if(data.resultList[i].betOn == 'SERIAL' || data.resultList[i].betOn == 'D_T_T') {
									bet_detail = l_BJC_BetOnArray[data.resultList[i].betOn] + l_BJC_BetTypeArray[data.resultList[i].betType];
								} else {
									bet_detail = l_BJC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_BJC_BetTypeArray[data.resultList[i].betType] + " 』 ";
								}
							} else if(data.resultList[i].gameInfoId == 4 || data.resultList[i].gameInfoId == 14 || data.resultList[i].gameInfoId == 15 ||data.resultList[i].gameInfoId == 16) {
								var step = l_JSC_BetTypeArray[data.resultList[i].betType];
								if(data.resultList[i].betOn == 'TOTAL'){
									if(data.resultList[i].betType == 'BIG' || data.resultList[i].betType == 'SMALL') {
										bet_detail = l_JSC_BetTypeArray[data.resultList[i].betType];
									} else {
										bet_detail = l_JSC_BetTypeArray[data.resultList[i].betType] + "点";
									}
								} else if(data.resultList[i].betOn == 'TRIPLE') {
									bet_detail = l_JSC_BetOnArray[data.resultList[i].betOn] +"("+ step + ""+ step + ""+ step + ")";
								} else if(data.resultList[i].betOn == 'PAIR') {
									bet_detail = l_JSC_BetOnArray[data.resultList[i].betOn] +"("+ step + ""+ step + ")";
								} else {
									bet_detail = l_JSC_BetOnArray[data.resultList[i].betOn] +"("+ l_JSC_BetTypeArray[data.resultList[i].betType] + ")";
								}
							}else if(data.resultList[i].gameInfoId == 12){
								if(data.resultList[i].betOn == 'D_T_T') {
									bet_detail = l_GXKC_BetOnArray[data.resultList[i].betOn] + l_GXKC_BetTypeArray[data.resultList[i].betType];
								} else {
									bet_detail = l_GXKC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_GXKC_BetTypeArray[data.resultList[i].betType] + " 』 ";
								}
							}else if(data.resultList[i].gameInfoId == 10){
								if(data.resultList[i].betOn == 'TOTAL' || data.resultList[i].betOn == 'D_T_T') {
									bet_detail = l_SHSC_BetOnArray[data.resultList[i].betOn] + l_SHSC_BetTypeArray[data.resultList[i].betType];
								} else {
									bet_detail = l_SHSC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_SHSC_BetTypeArray[data.resultList[i].betType] + " 』 ";
								}
							}
							var memberWinLoss = data.resultList[i].winLoss + data.resultList[i].memberCommAmount;
//								var agentComm = data.resultList[i].agentComm;
//								var masterComm = data.resultList[i].masterComm;
//								var seniorComm = data.resultList[i].seniorComm;
							/* if(data.resultList[i].type != 1) {
									 fill_type = "<font class='F_bold'>向上走飞</font>&nbsp;";
									 if(data.resultList[i].partnerId == data.resultList[i].memberId) {
										 memberWinLoss =  data.resultList[i].partnerWinLoss;
									 } else  if(data.resultList[i].seniorId == data.resultList[i].memberId) {
										 memberWinLoss =  data.resultList[i].seniorWinLoss;
									 } else  if(data.resultList[i].masterId == data.resultList[i].memberId) {
										 memberWinLoss =  data.resultList[i].masterWinLoss;
									 } else  if(data.resultList[i].agentId == data.resultList[i].memberId) {
										 memberWinLoss =   data.resultList[i].agentWinLoss;
									 }
								 } else {
									 if(data.resultList[i].seniorComm == 100) {
											agentComm = data.resultList[i].partnerComm;
											masterComm = agentComm;
											seniorComm = agentComm;
										} else if(data.resultList[i].masterComm == 100) {
											agentComm = data.resultList[i].seniorComm;
											masterComm = agentComm;
										} else if(data.resultList[i].agentComm == 100) {
											agentComm = data.resultList[i].masterComm;
										}
								 }*/
//								var lotteryTypeArray = new Array("ALL","KLC","SSC","BJC","JSC","XYC");
							trHtml = "<tr>"+
							"<td>"+ (i + 1)+ "</td>"+
							"<td class=''>"+data.resultList[i].betId/*.substring(0,8)+"#&nbsp;"*/+fill_type+"<br/>"+formartTime(data.resultList[i].betTime,4) + "</td>"+
//							"<td class=''>&nbsp;"+ l_gameTypeArray[lotteryTypeArray[data.resultList[i].gameInfoId]]+"&nbsp;<br/><span class='jeu_OpenLottery'>"+data.resultList[i].gameNo+"期</span></td>"+
							"<td class=''>"+ g_dsLotteryTypeByGroup[data.resultList[i].gameInfoId]+"<br/><span class='jeu_OpenLottery'>"+data.resultList[i].gameNo+"期</span></td>"+
							/*"<td class=''>&nbsp;"+data.resultList[i].tray+"盘</td>"+*/
							"<td class=''><span class='Font_B'>详细&nbsp;&nbsp;"+"<a onclick='openLotteryDetail("+ data.resultList[i].id+ ","+data.resultList[i].gameInfoId+")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"+"</span> " +
									/*" @ <span class='font_r F_bold'>" + data.resultList[i].odds + "</span>"+lianMa_detail+*/"</td>"+
							"<td class='td_right F_bold'>"+ data.resultList[i].stakeAmount+"</td>"+
							"<td class='td_right F_bold'>"+ data.resultList[i].validStake+"</td>"+
							"<td class='td_right F_bold'>"+ formatNumberWinLoss(data.resultList[i].winLoss,1)+"</td>"/*+
							"<td class='td_right F_bold'>"+ formatNumberWinLoss(data.resultList[i].memberCommAmount,1)+"&nbsp;</td>"+
							"<td class='td_right F_bold'>"+ formatNumberWinLoss(memberWinLoss,1)+"&nbsp;</td>"*/;
//								            "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].agentShare*100,0)+"%</span><br/>"+ data.resultList[i].memberComm+"</td>"; 
//								if(memberParentType == 'COMPANY'){
//									 trHtml += "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].masterShare*100,0)+"%</span><br/>"+ agentComm+"</td>"+
//											   "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].seniorShare*100,0)+"%</span><br/>"+ masterComm+"</td>"+
//											   "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].partnerShare*100,0)+"%</span><br/>"+ seniorComm+"</td>"+
//									            "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].companyShare*100,0)+"%</span><br/>"+ data.resultList[i].partnerComm+"</td>"+
//							 					"<td class='td_right'> "+ formatNumberWinLoss(data.resultList[i].companyWinLoss,1)+"&nbsp;</td>";
//								 } else if(memberParentType == 'PARTNER'){
//									 trHtml += "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].masterShare*100,0)+"%</span><br/>"+ agentComm+"</td>"+
//							            "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].seniorShare*100,0)+"%</span><br/>"+ masterComm+"</td>"+
//							            "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].partnerShare*100,0)+"%</span><br/>"+ seniorComm+"</td>"+
//							            "<td class='td_right'> "+ formatNumberWinLoss(data.resultList[i].partnerWinLoss,1)+"&nbsp;</td>";
//								 } else if(memberParentType == 'SENIOR'){
//									 trHtml += "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].masterShare*100,0)+"%</span><br/>"+ agentComm+"</td>"+
//							            "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].seniorShare*100,0)+"%</span><br/>"+ masterComm+"</td>"+
//							            "<td class='td_right'> "+ formatNumberWinLoss(data.resultList[i].seniorWinLoss,1)+"&nbsp;</td>";
//								 } else if(memberParentType == 'MASTER'){
//									 trHtml += "<td class=''><span class='F_bold'>"+ formatNumber(data.resultList[i].masterShare*100,0)+"%</span><br/>"+ agentComm+"</td>"+
//									 "<td class='td_right'> "+ formatNumberWinLoss(data.resultList[i].masterWinLoss,1)+"&nbsp;</td>";
//								 } else {
//									 trHtml += "<td class='td_right'> "+ formatNumberWinLoss(data.resultList[i].agentWinLoss,1)+"&nbsp;</td>";
//								 }
//								 trHtml += "<td>"+ data.resultList[i].ip + "</td>" ;
							trHtml +="</tr>";
							
							$("#result_table tbody").append(trHtml);
							
							betCount = betCount + 1;
//							betCount = betCount;
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
						
						$("#allPageNum").html(pageAllNumber);
						if (pageNum == 1) {
							if (pageAllNumber != 1) {
								$("#pageNext").click(function() {
									getDsLotteryBetDetail(pageNum + 1);
								});
							}
						} else if (pageNum == pageAllNumber) {
							$("#pagePrev").click(function() {
								getDsLotteryBetDetail(pageNum - 1);
							});
						} else {
							$("#pageNext").click(function() {
								getDsLotteryBetDetail(pageNum + 1);
							});
							$("#pagePrev").click(function() {
								getDsLotteryBetDetail(pageNum - 1);
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
								pageNumHtml += "<a onclick=\"getDsLotteryBetDetail("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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
						noRecordString = "<td colspan='7'>您当前没有讯息</td>";
						trHtml = "<tr id='noRecord' align='center'>"
							+ noRecordString
						+ "</tr>";
							
						$("#result_table tbody").append(trHtml);
					}
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

function openLotteryDetail(id, gameInfoId) {
	$("#dialogDs").dialog({
		height: 330, 
		width: 600, 
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
	$("#dialogDs").dialog("option", "title", g_dsLotteryTypeByGroup[gameInfoId]);
	$("#dialogDs").dialog("open");
	var o = {
			  id : id + "",
			 };
			 var jsonuserinfo = $.toJSON(o);
			 $.ajax({
			    type : "post",
			    url : $("#path").val() + "/app/getDsLotteryBetDetailTable?" + Math.random()*10000,
			    data : jsonuserinfo,
			    contentType : 'application/json',
			    dataType : "json",
			    // async:false,
			    // timeout : 20000,
			    beforeSend : function() {
			     /*$("#detailTableDs tbody").html(" <tr><td colspan='7'><img src='../images/loadingAnimation.gif'/*tpa=http://juyou1989.com/cscpLoginWeb/images/loadingAnimation.gif*//></td></tr>");*/
			    },
			    success : function(data) {
			     if (data) {
			      if (data.success == false) {
			       alert(l_basic['TryAgain']);
			      } else {
			        for ( var i = 0; i < data.resultList.length; i++) {
			         var trHtml = "";
			         var bet_detail = "";
			         var betTypes = data.resultList[i].betType.split("#");
			         var betDetails = data.resultList[i].betDetails.split("#");
			         var playNums = data.resultList[i].playSum.split("#");
			         var playAmounts = data.resultList[i].playAmount.split("#");
			         var mode = "";
			         if(data.resultList[i].playMode == "http://juyou1989.com/cscpLoginWeb/scripts/0.01"){
			          mode = "分模式";
			         }else if(data.resultList[i].playMode == "0.1"){
			          mode = "角模式";
			         }else if(data.resultList[i].playMode == "1"){
			          mode = "元模式";
			         }
			         
			         for ( var k = 0; k < betTypes.length; k++) {
			          if(data.resultList[i].gameInfoId == '52002' || data.resultList[i].gameInfoId == '52014' 
			           || data.resultList[i].gameInfoId == '52012' || data.resultList[i].gameInfoId == '52007' ){
			           bet_detail =  l_DS_SSC_BetTypeArray[betTypes[k]] ;
//			           bet_count = betDetails[k].replaceAll("small","小").replaceAll("even","双").replaceAll("odd","单").replaceAll("big","大");
			           bet_count = betDetails[k].replace(/small/g,"小").replace(/even/g,"双").replace(/odd/g,"单").replace(/big/g,"大");
			          }else if(data.resultList[i].gameInfoId == '52016' || data.resultList[i].gameInfoId == '52008'){
			            bet_detail =  l_K3_BetTypeArray[betTypes[k]] ;
				        bet_count = betDetails[k];
			          }else if(data.resultList[i].gameInfoId == '52006' || data.resultList[i].gameInfoId == '52001' 
			           || data.resultList[i].gameInfoId == '52004' || data.resultList[i].gameInfoId == '52005'){
			            bet_detail = l_11Y5_BetTypeArray[betTypes[k]] ;
				        bet_count = betDetails[k];
			          }else if(data.resultList[i].gameInfoId == '52015'){
			            bet_detail =  l_PK10_BetTypeArray[betTypes[k]];
				        bet_count = betDetails[k];
			          }else if(data.resultList[i].gameInfoId == '52013'){
			            bet_detail =  l_DS_BetTypeArray[betTypes[k]] ;
				        bet_count = betDetails[k];
			          }else if(data.resultList[i].gameInfoId == '52009'){
			            bet_detail =  l_TD_BetTypeArray[betTypes[k]] ;
				        bet_count = betDetails[k];
			          }else if(data.resultList[i].gameInfoId == '52010'){
			            bet_detail =  l_P3P5_BetTypeArray[betTypes[k]] ;
				        bet_count = betDetails[k];
			          }
			          
			          trHtml += "<tr>"
			           + "<td >"+ bet_detail + "</td>"
			           + "<td >"+ bet_count + "</td>"
			           + "<td >"+ playNums[k] + "</td>"
			           + "<td >"+ playAmounts[k] + "</td>"
			           + "<td >"+ mode + "</td>"
			           + "<td >"+ data.resultList[i].playMultiple + "</td>"
			           + "<td>"+ formartTime(data.resultList[i].betTime,1) + "</td>"  
			           + "</tr>";
			         
			         }
			        }
			       
			        $("#detailTableDs tbody").html(trHtml);
			      }
			     } else {
			      $("#detailTableDs tbody").html(" <tr><td colspan='7'>服务器繁忙, 请稍后再试!</td></tr>");
			     }
			    },
			    error : function(xmlhttprequest, error) {
			     $("#detailTableDs tbody").html(
			       " <tr><td colspan='7'>网络繁忙, 请稍后再试!</td></tr>");
			    },
			    complete : function() {
			    }
			   });
}

function addDsLotteryGameType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addDsLotteryGameType?" + Math.random()*10000,
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
					for ( var i = 0; i < data.dsLotteryGameTypeList.length; i++) {
						$("#BetType").append( "<option value='" + data.dsLotteryGameTypeList[i] + "'>" + g_dsLotteryTypeByGroup[data.dsLotteryGameTypeList[i]] + "</option>");
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
