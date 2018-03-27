function dateLotteryReportDay(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLotteryReportDay();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLotteryReportDay();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLotteryReportDay();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLotteryReportDay();
	});
}

function getLotteryReportDay(){
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
				url : $("#path").val() + "/app/getLotteryReportDay?" + Math.random()*10000,
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
							
							if(data.lotteryMemberReportTotalList.length > 0){
								
								var totBetCount = 0;
								var totStakeAmount = 0;
								var totValidStake = 0;
								var totWinLoss = 0;
								var totMemberCommAmount = 0;
								var tt=0;
								
								for(var i= 0;i < data.lotteryMemberReportTotalList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>"+data.lotteryMemberReportTotalList[i].reportDate+"</a></td>"
										+ "<td class='F_bold'>"+ data.lotteryMemberReportTotalList[i].betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.lotteryMemberReportTotalList[i].stake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.lotteryMemberReportTotalList[i].validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lotteryMemberReportTotalList[i].winLoss,2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lotteryMemberReportTotalList[i].memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.lotteryMemberReportTotalList[i].total,2) + "</td>" */
										+ "</tr>";
										$("#total_table tbody").append(trHtml);
										 totBetCount = totBetCount + data.lotteryMemberReportTotalList[i].betCount;
										 totStakeAmount = totStakeAmount + data.lotteryMemberReportTotalList[i].stake;
										 totValidStake = totValidStake + data.lotteryMemberReportTotalList[i].validStake;
										 totWinLoss = totWinLoss + data.lotteryMemberReportTotalList[i].winLoss;
										 totMemberCommAmount =totMemberCommAmount + data.lotteryMemberReportTotalList[i].memberCommAmount;
										 tt = tt + data.lotteryMemberReportTotalList[i].total;
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

function dateGetLotteryBetDetail(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLotteryBetDetail('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLotteryBetDetail('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLotteryBetDetail('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLotteryBetDetail('1');
	});
	
}

function getLotteryBetDetail(pageNumber){
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
		RecordsPage : 20 + ""
	};
	var jsonuserinfo = $.toJSON(o);
	
	$.ajax({
			type : "post",
			url : $("#path").val() + "/app/getLotteryBetDetail?" + Math.random()*10000,
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
								alert(data.message);
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
							var typeArray = data.lotteryTypes;
							for ( var i = 0; i < data.resultList.length; i++) {

								var bet_detail = "";
								var lianMa_detail = "";
								var fill_type = "";
								if(data.resultList[i].gameInfoId == 1 || data.resultList[i].gameInfoId == 5 || data.resultList[i].gameInfoId == 11 || data.resultList[i].gameInfoId == 13
										|| data.resultList[i].gameInfoId == 38) {
									if(data.resultList[i].betOn == 'SERIAL'){
										var betDetailArray = eval(data.resultList[i].betDetails);
										var detailLength = betDetailArray.length;
										if(detailLength > 2){
											lianMa_detail ="<br/>复式 『 "+ (detailLength - 1) + " 组 』 <br/>"+betDetailArray[0].toString();
										} else {
											lianMa_detail ="<br/>"+betDetailArray[1].toString();
										}
										lianMa_detail = lianMa_detail.replace(new RegExp(",","g"), "、");
							 			bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] + l_KLC_BetTypeArray[data.resultList[i].betType];
							 			 
							 		} else if(data.resultList[i].betOn == 'SERIAL' || data.resultList[i].betOn == 'D_T_T') {
										 bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] + l_KLC_BetTypeArray[data.resultList[i].betType];
									} else {
										 bet_detail = l_KLC_BetOnArray[data.resultList[i].betOn] +" 『 "+ l_KLC_BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								} else if(data.resultList[i].gameInfoId == 2 || data.resultList[i].gameInfoId == 6 || data.resultList[i].gameInfoId == 7 || data.resultList[i].gameInfoId == 8 || data.resultList[i].gameInfoId == 9 || data.resultList[i].gameInfoId == 49 || data.resultList[i].gameInfoId == 51) {
									if(data.resultList[i].betOn == 'TOTAL' || data.resultList[i].betOn == 'D_T_T') {
										bet_detail = l_SSC_BetOnArray[data.resultList[i].betOn] + l_SSC_BetTypeArray[data.resultList[i].betType];
									}else if(data.resultList[i].betOn == 'SERIAL'){
										var betDetailArray = eval(data.resultList[i].betDetails);
										lianMa_detail="<br/>["+betDetailArray[0].toString().replace(new RegExp(",", "g"), "、")+"]"
										bet_detail =l_SSC_BetTypeArray[data.resultList[i].betType];
									}else {
										bet_detail = l_SSC_BetOnArray[data.resultList[i].betOn] + " 『 " + l_SSC_BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								} else if(data.resultList[i].gameInfoId == 3 || data.resultList[i].gameInfoId == 17 || data.resultList[i].gameInfoId == 48 || data.resultList[i].gameInfoId == 50) {
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
									if(data.resultList[i].betOn == 'D_T_T') {
										bet_detail = l_SHSC_BetOnArray[data.resultList[i].betOn] + l_SHSC_BetTypeArray[data.resultList[i].betType];
									}else if(data.resultList[i].betOn == 'SERIAL'){
										var betDetailArray = eval(data.resultList[i].betDetails);
										lianMa_detail="<br/>["+betDetailArray[0].toString().replace(new RegExp(",", "g"), "、")+"]"
										bet_detail =l_SHSC_BetTypeArray[data.resultList[i].betType];
									}else {
										bet_detail = l_SHSC_BetOnArray[data.resultList[i].betOn] + " 『 " + l_SHSC_BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								}else if(data.resultList[i].gameInfoId == 18 || data.resultList[i].gameInfoId == 19
										|| data.resultList[i].gameInfoId == 20 || data.resultList[i].gameInfoId == 21
										|| data.resultList[i].gameInfoId == 22 || data.resultList[i].gameInfoId == 23
										|| data.resultList[i].gameInfoId == 24 || data.resultList[i].gameInfoId == 25 || data.resultList[i].gameInfoId == 26){
//										 bet_detail = l_some11Choose5BetOnArray[data.resultList[i].betOn] + l_some11Choose5Be/tTypeArray[data.resultList[i].betType];
									if(data.resultList[i].betOn == 'SERIAL'){
										bet_detail = l_GD115_BetOnArray[data.resultList[i].betOn] + l_GD115_BetTypeArray[data.resultList[i].betType];
										var betDetailArray = eval(data.resultList[i].betDetails);
										var detailLength = betDetailArray.length;
										if(data.resultList[i].betType == "OPTIONAL_2_GROUP_STR") {
											if(detailLength > 3) {
												lianMa_detail = "<br/>复式 『 " + (detailLength - 2) + " 组 』 <br/>" + "[" + betDetailArray[0].toString() + "][" + betDetailArray[1].toString() + "]";
											} else {
												lianMa_detail = "<br/>" + betDetailArray[2].toString();
											}
										} else if(data.resultList[i].betType == "OPTIONAL_FIRST3_STR") {
											if(detailLength > 4) {
												lianMa_detail = "<br/>复式 『 " + (detailLength - 3) + " 组 』 <br/>" + "[" + betDetailArray[0].toString() + "][" + betDetailArray[1].toString() + "][" + betDetailArray[2].toString() + "]";
											} else {
												lianMa_detail = "<br/>" + betDetailArray[3].toString();
											}
										} else {
											if(detailLength > 2) {
												lianMa_detail = "<br/>复式 『 " + (detailLength - 1) + " 组 』 <br/>" + betDetailArray[0].toString();
											} else {
												lianMa_detail = "<br/>" + betDetailArray[1].toString();
											}
										}
										
						 				lianMa_detail = lianMa_detail.replace(new RegExp(",","g"), "、");
									}else if(data.resultList[i].betOn == 'SERIAL' || data.resultList[i].betOn == 'D_T_T') {
										 bet_detail = l_some11Choose5BetOnArray[data.resultList[i].betOn] + l_some11Choose5BetTypeArray[data.resultList[i].betType];
									} else {
										 bet_detail = l_some11Choose5BetOnArray[data.resultList[i].betOn] +" 『 "+ l_some11Choose5BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								}else if(data.resultList[i].gameInfoId == 27 || data.resultList[i].gameInfoId == 28
										|| data.resultList[i].gameInfoId == 29 || data.resultList[i].gameInfoId == 30
										|| data.resultList[i].gameInfoId == 31 || data.resultList[i].gameInfoId == 32
										|| data.resultList[i].gameInfoId == 33 || data.resultList[i].gameInfoId == 34 || data.resultList[i].gameInfoId == 35){
									if(data.resultList[i].betOn == 'SERIAL' || data.resultList[i].betOn == 'D_T_T') {
										bet_detail = l_someHappy8BetOn[data.resultList[i].betOn] + l_someHappy8BetType[data.resultList[i].betType];
									} else {
										bet_detail = l_someHappy8BetOn[data.resultList[i].betOn] +" 『 "+ l_someHappy8BetType[data.resultList[i].betType] + " 』 ";
									}
								}else if(data.resultList[i].gameInfoId == 36 || data.resultList[i].gameInfoId == 37){
									if(data.resultList[i].betOn == 'D_T_T') {
										bet_detail = l_3DBetOn[data.resultList[i].betOn] + l_3DBetType[data.resultList[i].betType];
									}else if(data.resultList[i].betOn == 'SERIAL'){
										bet_detail = l_3DBetOn[data.resultList[i].betOn] + l_3DBetType[data.resultList[i].betType];
										var betDetailArray = eval(data.resultList[i].betDetails);
										if(data.resultList[i].betType=='COMBIN_COMPLEX'){
											lianMa_detail =" <br/>[" +betDetailArray[0].toString().replace(new RegExp(",", "g"), "、") + "]"
											+" <br/>[" +betDetailArray[1].toString().replace(new RegExp(",", "g"), "、") + "]"
											+" <br/>[" +betDetailArray[2].toString().replace(new RegExp(",", "g"), "、") + "] ";
										}else{
											lianMa_detail=" <br/>[" +betDetailArray[0].toString().replace(new RegExp(",", "g"), "、") + "]";
										}
									} else {
										bet_detail = l_3DBetOn[data.resultList[i].betOn] + " 『 " + l_3DBetType[data.resultList[i].betType] + " 』 ";
									}
								}else if(data.resultList[i].gameInfoId == 39 || data.resultList[i].gameInfoId == 40
										|| data.resultList[i].gameInfoId == 41 || data.resultList[i].gameInfoId == 42
										|| data.resultList[i].gameInfoId == 43 || data.resultList[i].gameInfoId == 44
										|| data.resultList[i].gameInfoId == 45 || data.resultList[i].gameInfoId == 46
										|| data.resultList[i].gameInfoId == 47 ){
									var bet_detail="";
									var lianMa_detail="";
									if(data.resultList[i].betOn == 'SERIAL'){
										var betDetailArray = eval(data.resultList[i].betDetails);
										lianMa_detail="<br/>["+betDetailArray[0].toString().replace(new RegExp(",", "g"), "、")+"]";
										bet_detail =l_PCEGG_BetTypeArray[data.resultList[i].betType];
									}else {
										bet_detail = l_PCEGG_BetOnArray[data.resultList[i].betOn] + " 『 " + l_PCEGG_BetTypeArray[data.resultList[i].betType] + " 』 ";
									}
								}
								var memberWinLoss = data.resultList[i].winLoss + data.resultList[i].memberCommAmount;
								 trHtml = "<tr>"+
								 		     "<td>"+ (i + 1)+ "</td>"+
								            "<td class=''>&nbsp;"+data.resultList[i].betId.substring(0,8)+"#&nbsp;"+fill_type+"&nbsp;<br/>"+formartTime(data.resultList[i].betTime,4) + "</td>"+
								            "<td class=''>&nbsp;"+ l_gameTypeArray[typeArray[data.resultList[i].gameInfoId - 1]]+"&nbsp;<br/><span class='jeu_OpenLottery'>"+data.resultList[i].gameNo+"期</span></td>"+
								            "<td class=''>&nbsp;"+data.resultList[i].tray+"盘</td>"+
								            "<td class=''><span class='Font_B'>"+bet_detail+"</span> @ <span class='font_r F_bold'>" + data.resultList[i].odds + "</span>"+lianMa_detail+"</td>"+
								            "<td class='td_right F_bold'>"+ data.resultList[i].stakeAmount+"&nbsp;</td>"+
								            "<td class='td_right F_bold'>"+ data.resultList[i].validStake+"&nbsp;</td>"+
								            "<td class='td_right F_bold'>"+ formatNumberWinLoss(data.resultList[i].winLoss,1)+"&nbsp;</td>"
								 trHtml +="</tr>";
								
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
								+ "<td class='F_bold '>"+ formatNumberWinLoss(total, 2)+ "</td>"*/  
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
										getLotteryBetDetail(pageNum + 1);
									});
								}
							} else if (pageNum == pageAllNumber) {
								$("#pagePrev").click(function() {
									getLotteryBetDetail(pageNum - 1);
								});
							} else {
								$("#pageNext").click(function() {
									getLotteryBetDetail(pageNum + 1);
								});
								$("#pagePrev").click(function() {
									getLotteryBetDetail(pageNum - 1);
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
									pageNumHtml += "<a onclick=\"getLotteryBetDetail("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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

function changeLotteryGameNo() {
	var type = $("#t_LT").val();
	var typeOptionHtml = "<option value='0'>全部</option>";
	var noOptionHtml = typeOptionHtml;
	if(type != '0') {
		var begin = 1;
		var end = 29;
		if(g_lotteryTypeByGroup[type] == 'KLC') {
		}else if(g_lotteryTypeByGroup[type] == 'SSC') {
			begin = 29; end = 42;
		}else if(g_lotteryTypeByGroup[type] == 'BJC') {
			begin = 42; end = 58;
		}else if(g_lotteryTypeByGroup[type] == 'JSC') {
			begin = 58; end = 65;
		}/*else if(g_lotteryTypeByGroup[type] == 'XYC') {
			begin = 65; end = 93;
		}*/else if(g_lotteryTypeByGroup[type] == 'GXKC'){
			begin = 65; end = 82;
		}else if(g_lotteryTypeByGroup[type] == 'SHSC'){
			begin = 82; end = 89;
		}
		for(var i = begin; i < end; i++) {
			typeOptionHtml += "<option value='"+i+"'>" + l_betTypeAllArray[i].substring(l_betTypeAllArray[i].indexOf("-") + 2) + "</option>";
		}
		
	}
	$("#BetType").html(typeOptionHtml);
	
}

function addLotteryGameType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addLotteryGameType?" + Math.random()*10000,
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
					for ( var i = 0; i < lotteryTypeArray.length; i++) {
						$("#t_LT").append( "<option value='" + lotteryTypeArray[i] + "'>" + l_gameTypeArray[lotteryTypeArray[i]] + "</option>");
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