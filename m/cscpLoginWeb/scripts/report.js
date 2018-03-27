function dateGetTotalReportCP(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailCP();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailCP();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailCP();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailCP();
	});
	
}

function returnTo(parm){
	$("#returnBg").html("");
	var bDate = $("#BeginDate").val();
	var eDate = $("#EndDate").val();
	if(parm=='totail'){
		$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['BACK'] + "</a>");
	}else if(parm=='reportDay'){
		$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['BACK'] + "</a>");
	}
	
}

function getTotailRepotTotailCP(){
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
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
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
							
							var totBetCount = 0;
							var totStakeAmount = 0;
							var totValidStake = 0;
							var totWinLoss = 0;
							var totMemberCommAmount = 0;
							var totTotal = 0;
							

							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTO'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lottoMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lottoMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lotteryMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['DSLOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.dsLotteryReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.dsLotteryReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
								
							totBetCount =  data.lotteryMemberReportTotal.betCount + data.lottoMemberReportTotal.betCount + data.dsLotteryReportTotal.betCount;
							
							totStakeAmount = data.lotteryMemberReportTotal.stake + data.lottoMemberReportTotal.stake + data.dsLotteryReportTotal.stake;
							
							totValidStake = data.lotteryMemberReportTotal.validStake + data.lottoMemberReportTotal.validStake + data.dsLotteryReportTotal.validStake;
							
							totWinLoss = data.lotteryMemberReportTotal.winLoss + data.lottoMemberReportTotal.winLoss + data.dsLotteryReportTotal.winLoss;
							
							totMemberCommAmount =data.lotteryMemberReportTotal.memberCommAmount + data.lottoMemberReportTotal.memberCommAmount + data.dsLotteryReportTotal.memberCommAmount;
							
							totTotal = data.lotteryMemberReportTotal.total + data.lottoMemberReportTotal.total + data.dsLotteryReportTotal.total;
							
							trHtml = "<tr>"
								+ "<td class='F_bold' style='padding:5px !important;'>" + l_report['TOTTOTAL'] + "</td>"
								+ "<td class='F_bold'>"+totBetCount+"</td>"
								+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totTotal,2) + "</td>" */
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
				
						$("#progressBar").hide();
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage(l_report['ERROR']);
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage(l_report['ERROR']);
				},
				complete : function() {
				}
			});

}


function dateGetTotalReportCPAndLiveAndSports(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailCPAndLiveAndSports();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailCPAndLiveAndSports();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailCPAndLiveAndSports();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailCPAndLiveAndSports();
	});
	
}

function getTotailRepotTotailCPAndLiveAndSports(){
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
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
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
							
							var totBetCount = 0;
							var totStakeAmount = 0;
							var totValidStake = 0;
							var totWinLoss = 0;
							var totMemberCommAmount = 0;
							var totTotal = 0;

							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEZJ'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveZJMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveZJMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveZJMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveZJMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVELMG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveLMGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveLMGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEDS'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveDSMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveDSMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEIG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEAG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveAGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveAGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveAGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveAGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEBBIN'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveBBINMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveBBINMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveBBINMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveBBINMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEOG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveOGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveOGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveOGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveOGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							/*trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEALLBET'] + "</a></td>"
								+ "<td class='F_bold'>"+data.liveAllBetMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.liveAllBetMemberReportTotal.stakeAmount, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.liveAllBetMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.liveAllBetMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);*/
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTO'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lottoMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lottoMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lotteryMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['DSLOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.dsLotteryReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.dsLotteryReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							/*trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICBBIN'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsBBINReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsBBINReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsBBINReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsBBINReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);*/

									
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['SPORTM8'] + "</a></td>"
								+ "<td class='F_bold'>"+data.m8SportReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.m8SportReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
								
							totBetCount = data.liveMemberReportTotal.betCount + data.liveDSMemberReportTotal.betCount + data.liveLMGMemberReportTotal.betCount
							 			+ data.liveAGMemberReportTotal.betCount + data.agSlotsReportTotal.betCount + data.agBywReportTotal.betCount
										+ data.lotteryMemberReportTotal.betCount + data.lottoMemberReportTotal.betCount + data.dsLotteryReportTotal.betCount 
										+ data.m8SportReportTotal.betCount + data.liveOGMemberReportTotal.betCount + data.liveBBINMemberReportTotal.betCount 
										+ data.slotsBBINReportTotal.betCount + data.slotsYYReportTotal.betCount + data.slotsPTReportTotal.betCount 
										+ data.slotsGGReportTotal.betCount + data.liveZJMemberReportTotal.betCount + data.slotsSGReportTotal.betCount
										+ data.liveAllBetMemberReportTotal.betCount;
							
							totStakeAmount = data.liveMemberReportTotal.stakeAmount + data.liveDSMemberReportTotal.stakeAmount + data.liveLMGMemberReportTotal.stakeAmount
				 						+ data.liveAGMemberReportTotal.stakeAmount + data.agSlotsReportTotal.stakeAmount + data.agBywReportTotal.stakeAmount 
										+ data.lotteryMemberReportTotal.stake + data.lottoMemberReportTotal.stake + data.dsLotteryReportTotal.stake 
										+ data.m8SportReportTotal.stake + data.liveOGMemberReportTotal.stakeAmount + data.liveBBINMemberReportTotal.stakeAmount
										+ data.slotsBBINReportTotal.stakeAmount + data.slotsYYReportTotal.stakeAmount + data.slotsPTReportTotal.stakeAmount
										+ data.slotsGGReportTotal.stakeAmount + data.liveZJMemberReportTotal.stakeAmount + data.slotsSGReportTotal.stakeAmount
										+ data.liveAllBetMemberReportTotal.stakeAmount;
							
							totValidStake = data.liveMemberReportTotal.validStake + data.liveDSMemberReportTotal.validStake + data.liveLMGMemberReportTotal.validStake
				 						+ data.liveAGMemberReportTotal.validStake + data.agSlotsReportTotal.validStake + data.agBywReportTotal.validStake
										+ data.lotteryMemberReportTotal.validStake + data.lottoMemberReportTotal.validStake + data.dsLotteryReportTotal.validStake 
										+ data.m8SportReportTotal.validStake + data.liveOGMemberReportTotal.validStake + data.liveBBINMemberReportTotal.validStake
										+ data.slotsBBINReportTotal.validStake + data.slotsYYReportTotal.validStake + data.slotsPTReportTotal.validStake 
										+ data.slotsGGReportTotal.validStake + data.liveZJMemberReportTotal.validStake + data.slotsSGReportTotal.validStake
										+ data.liveAllBetMemberReportTotal.validStake ;
							
							totWinLoss = data.liveMemberReportTotal.winLoss +  data.liveDSMemberReportTotal.winLoss + data.liveLMGMemberReportTotal.winLoss
										+ data.liveAGMemberReportTotal.winLoss + data.agSlotsReportTotal.winLoss + data.agBywReportTotal.winLoss
										+ data.lotteryMemberReportTotal.winLoss + data.lottoMemberReportTotal.winLoss + data.dsLotteryReportTotal.winLoss 
										+ data.m8SportReportTotal.winLoss + data.liveOGMemberReportTotal.winLoss + data.liveBBINMemberReportTotal.winLoss 
										+ data.slotsBBINReportTotal.winLoss + data.slotsYYReportTotal.winLoss + data.slotsPTReportTotal.winLoss 
										+ data.slotsGGReportTotal.winLoss + data.liveZJMemberReportTotal.winLoss + data.slotsSGReportTotal.winLoss
										+ data.liveAllBetMemberReportTotal.winLoss ;
							
							totMemberCommAmount = data.liveMemberReportTotal.memberCommAmount + data.liveDSMemberReportTotal.memberCommAmount + data.liveLMGMemberReportTotal.memberCommAmount
										+ data.liveAGMemberReportTotal.memberCommAmount + data.agSlotsReportTotal.memberCommAmount + data.agBywReportTotal.memberCommAmount
										+ data.lotteryMemberReportTotal.memberCommAmount + data.lottoMemberReportTotal.memberCommAmount + data.dsLotteryReportTotal.memberCommAmount 
										+ data.m8SportReportTotal.memberCommAmount + data.liveOGMemberReportTotal.memberCommAmount + data.liveBBINMemberReportTotal.memberCommAmount 
										+ data.slotsBBINReportTotal.memberCommAmount + data.slotsYYReportTotal.memberCommAmount + data.slotsPTReportTotal.memberCommAmount 
										+ data.slotsGGReportTotal.memberCommAmount + data.liveZJMemberReportTotal.memberCommAmount + data.slotsSGReportTotal.memberCommAmount
										+ data.liveAllBetMemberReportTotal.memberCommAmount ;
							
							totTotal = data.liveMemberReportTotal.total + data.liveDSMemberReportTotal.total +data.liveLMGMemberReportTotal.total
				 						+ data.liveAGMemberReportTotal.total + data.agSlotsReportTotal.total + data.agBywReportTotal.total
				 						+ data.lotteryMemberReportTotal.total + data.lottoMemberReportTotal.total + data.dsLotteryReportTotal.total 
										+ data.m8SportReportTotal.total + data.liveOGMemberReportTotal.total + data.liveBBINMemberReportTotal.total
										+ data.slotsBBINReportTotal.total + data.slotsYYReportTotal.total + data.slotsPTReportTotal.total 
										+ data.slotsGGReportTotal.total + data.liveZJMemberReportTotal.total + data.slotsSGReportTotal.total
										+ data.liveAllBetMemberReportTotal.total ;
							
							trHtml = "<tr>"
								+ "<td class='F_bold' style='padding:5px !important;'>" + l_report['TOTTOTAL'] + "</td>"
								+ "<td class='F_bold'>"+totBetCount+"</td>"
								+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totTotal,2) + "</td>" */
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
				
						$("#progressBar").hide();
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage(l_report['ERROR']);
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage(l_report['ERROR']);
				},
				complete : function() {
				}
			});

}



function dateGetTotalReport(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotail();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotail();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotail();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotail();
	});
	
}

function getTotailRepotTotail(){
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
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
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
							
							var totBetCount = 0;
							var totStakeAmount = 0;
							var totValidStake = 0;
							var totWinLoss = 0;
							var totMemberCommAmount = 0;
							var totTotal = 0;

							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEZJ'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveZJMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveZJMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveZJMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveZJMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVELMG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveLMGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveLMGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEDS'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveDSMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveDSMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEIG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEAG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveAGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveAGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveAGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveAGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEBBIN'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveBBINMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveBBINMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveBBINMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveBBINMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEOG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveOGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveOGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveOGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveOGMemberReportTotal.winLoss,2)+ "</td>"
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							/*trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LIVEALLBET'] + "</a></td>"
								+ "<td class='F_bold'>"+data.liveAllBetMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.liveAllBetMemberReportTotal.stakeAmount, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.liveAllBetMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.liveAllBetMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);*/
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTO'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lottoMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lottoMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lotteryMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['DSLOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.dsLotteryReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.dsLotteryReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							/*trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICBBIN'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsBBINReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsBBINReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsBBINReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsBBINReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);*/
								
							/*trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICIG'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsIGReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsIGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsIGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsIGReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);*/
										
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICAG'] + "</a></td>"
								+ "<td class='F_bold'>"+data.agSlotsReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.agSlotsReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.agSlotsReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.agSlotsReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['AGBYW'] + "</a></td>"
								+ "<td class='F_bold'>"+data.agBywReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.agBywReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.agBywReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.agBywReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICYY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsYYReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsYYReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsYYReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsYYReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICPT'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsPTReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsPTReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsPTReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsPTReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['ELECTRONICSG'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsSGReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsSGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsSGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsSGReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['GGBYW'] + "</a></td>"
								+ "<td class='F_bold'>"+data.slotsGGReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsGGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.slotsGGReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.slotsGGReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
									
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['SPORTM8'] + "</a></td>"
								+ "<td class='F_bold'>"+data.m8SportReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.m8SportReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
								
							totBetCount = data.liveMemberReportTotal.betCount + data.liveDSMemberReportTotal.betCount + data.liveLMGMemberReportTotal.betCount
							 			+ data.liveAGMemberReportTotal.betCount + data.agSlotsReportTotal.betCount + data.agBywReportTotal.betCount
										+ data.lotteryMemberReportTotal.betCount + data.lottoMemberReportTotal.betCount + data.dsLotteryReportTotal.betCount 
										+ data.m8SportReportTotal.betCount + data.liveOGMemberReportTotal.betCount + data.liveBBINMemberReportTotal.betCount 
										+ data.slotsBBINReportTotal.betCount + data.slotsYYReportTotal.betCount + data.slotsPTReportTotal.betCount 
										+ data.slotsGGReportTotal.betCount + data.liveZJMemberReportTotal.betCount + data.slotsSGReportTotal.betCount
										+ data.liveAllBetMemberReportTotal.betCount + data.slotsIGReportTotal.betCount;
							
							totStakeAmount = data.liveMemberReportTotal.stakeAmount + data.liveDSMemberReportTotal.stakeAmount + data.liveLMGMemberReportTotal.stakeAmount
				 						+ data.liveAGMemberReportTotal.stakeAmount + data.agSlotsReportTotal.stakeAmount + data.agBywReportTotal.stakeAmount 
										+ data.lotteryMemberReportTotal.stake + data.lottoMemberReportTotal.stake + data.dsLotteryReportTotal.stake 
										+ data.m8SportReportTotal.stake + data.liveOGMemberReportTotal.stakeAmount + data.liveBBINMemberReportTotal.stakeAmount
										+ data.slotsBBINReportTotal.stakeAmount + data.slotsYYReportTotal.stakeAmount + data.slotsPTReportTotal.stakeAmount
										+ data.slotsGGReportTotal.stakeAmount + data.liveZJMemberReportTotal.stakeAmount + data.slotsSGReportTotal.stakeAmount
										+ data.liveAllBetMemberReportTotal.stakeAmount + data.slotsIGReportTotal.stakeAmount;
							
							totValidStake = data.liveMemberReportTotal.validStake + data.liveDSMemberReportTotal.validStake + data.liveLMGMemberReportTotal.validStake
				 						+ data.liveAGMemberReportTotal.validStake + data.agSlotsReportTotal.validStake + data.agBywReportTotal.validStake
										+ data.lotteryMemberReportTotal.validStake + data.lottoMemberReportTotal.validStake + data.dsLotteryReportTotal.validStake 
										+ data.m8SportReportTotal.validStake + data.liveOGMemberReportTotal.validStake + data.liveBBINMemberReportTotal.validStake
										+ data.slotsBBINReportTotal.validStake + data.slotsYYReportTotal.validStake + data.slotsPTReportTotal.validStake 
										+ data.slotsGGReportTotal.validStake + data.liveZJMemberReportTotal.validStake + data.slotsSGReportTotal.validStake
										+ data.liveAllBetMemberReportTotal.validStake + data.slotsIGReportTotal.validStake;
							
							totWinLoss = data.liveMemberReportTotal.winLoss +  data.liveDSMemberReportTotal.winLoss + data.liveLMGMemberReportTotal.winLoss
										+ data.liveAGMemberReportTotal.winLoss + data.agSlotsReportTotal.winLoss + data.agBywReportTotal.winLoss
										+ data.lotteryMemberReportTotal.winLoss + data.lottoMemberReportTotal.winLoss + data.dsLotteryReportTotal.winLoss 
										+ data.m8SportReportTotal.winLoss + data.liveOGMemberReportTotal.winLoss + data.liveBBINMemberReportTotal.winLoss 
										+ data.slotsBBINReportTotal.winLoss + data.slotsYYReportTotal.winLoss + data.slotsPTReportTotal.winLoss 
										+ data.slotsGGReportTotal.winLoss + data.liveZJMemberReportTotal.winLoss + data.slotsSGReportTotal.winLoss
										+ data.liveAllBetMemberReportTotal.winLoss + data.slotsIGReportTotal.winLoss;
							
							totMemberCommAmount = data.liveMemberReportTotal.memberCommAmount + data.liveDSMemberReportTotal.memberCommAmount + data.liveLMGMemberReportTotal.memberCommAmount
										+ data.liveAGMemberReportTotal.memberCommAmount + data.agSlotsReportTotal.memberCommAmount + data.agBywReportTotal.memberCommAmount
										+ data.lotteryMemberReportTotal.memberCommAmount + data.lottoMemberReportTotal.memberCommAmount + data.dsLotteryReportTotal.memberCommAmount 
										+ data.m8SportReportTotal.memberCommAmount + data.liveOGMemberReportTotal.memberCommAmount + data.liveBBINMemberReportTotal.memberCommAmount 
										+ data.slotsBBINReportTotal.memberCommAmount + data.slotsYYReportTotal.memberCommAmount + data.slotsPTReportTotal.memberCommAmount 
										+ data.slotsGGReportTotal.memberCommAmount + data.liveZJMemberReportTotal.memberCommAmount + data.slotsSGReportTotal.memberCommAmount
										+ data.liveAllBetMemberReportTotal.memberCommAmount + data.slotsIGReportTotal.memberCommAmount;
							
							totTotal = data.liveMemberReportTotal.total + data.liveDSMemberReportTotal.total +data.liveLMGMemberReportTotal.total
				 						+ data.liveAGMemberReportTotal.total + data.agSlotsReportTotal.total + data.agBywReportTotal.total
				 						+ data.lotteryMemberReportTotal.total + data.lottoMemberReportTotal.total + data.dsLotteryReportTotal.total 
										+ data.m8SportReportTotal.total + data.liveOGMemberReportTotal.total + data.liveBBINMemberReportTotal.total
										+ data.slotsBBINReportTotal.total + data.slotsYYReportTotal.total + data.slotsPTReportTotal.total 
										+ data.slotsGGReportTotal.total + data.liveZJMemberReportTotal.total + data.slotsSGReportTotal.total
										+ data.liveAllBetMemberReportTotal.total + data.slotsIGReportTotal.total;
							
							trHtml = "<tr>"
								+ "<td class='F_bold' style='padding:5px !important;'>" + l_report['TOTTOTAL'] + "</td>"
								+ "<td class='F_bold'>"+totBetCount+"</td>"
								+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totTotal,2) + "</td>" */
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
				
						$("#progressBar").hide();
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage(l_report['ERROR']);
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage(l_report['ERROR']);
				},
				complete : function() {
				}
			});

}

function dateGetTotalReportTg(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailTg();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailTg();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailTg();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailTg();
	});
	
}
function getTotailRepotTotailTg(){
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
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
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
							
							var totBetCount = 0;
							var totStakeAmount = 0;
							var totValidStake = 0;
							var totWinLoss = 0;
							var totMemberCommAmount = 0;
							var totTotal = 0;
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['LIVEIG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotal.winLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotal.memberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotal.total,2) + "</td>" */
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['LIVEDS'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveDSMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveDSMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveDSMemberReportTotal.winLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveDSMemberReportTotal.memberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveDSMemberReportTotal.total,2) + "</td>" */
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['LIVELMG'] + "</a></td>"
								+ "<td class='F_bold'>"+ data.liveLMGMemberReportTotal.betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.stakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.liveLMGMemberReportTotal.validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveLMGMemberReportTotal.winLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveLMGMemberReportTotal.memberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveLMGMemberReportTotal.total,2) + "</td>" */
								+ "</tr>";
									
								trHtml = "<tr>"
									+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='#'>" + l_report['ELECTRONICAG'] + "</a></td>"
									+ "<td class='F_bold'>0</td>"
									+ "<td class='F_bold '>0.00</td>"
									+ "<td class='F_bold '>0.00</td>"
									+ "<td class='F_bold '>0.00</td>"
									/*+ "<td class='F_bold '>0.00</td>"
									+ "<td class='F_bold '>0.00</td>" */
									+ "</tr>";
									$("#total_table tbody").append(trHtml);
									
								trHtml = "<tr>"
									+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp'>" + l_report['SPORTM8'] + "</a></td>"
									+ "<td class='F_bold'>"+data.m8SportReportTotal.betCount+"</td>"
									+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.stake, 2)+"</td>"
									+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.validStake, 2)+"</td>"
									+ "<td class='F_bold '>"+formatNumberWinLoss(data.m8SportReportTotal.winLoss, 2)+"</td>"
									/*+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.memberCommAmount, 2)+"</td>"
									+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.total, 2)+"</td>"*/
									+ "</tr>";
									$("#total_table tbody").append(trHtml);
								
								
								totBetCount = data.liveMemberReportTotal.betCount + data.liveDSMemberReportTotal.betCount + data.liveLMGMemberReportTotal.betCount
											+ data.m8SportReportTotal.betCount;
								totStakeAmount = data.liveMemberReportTotal.stakeAmount + data.liveDSMemberReportTotal.stakeAmount + data.liveLMGMemberReportTotal.stakeAmount + 
											+ data.m8SportReportTotal.stake;
								totValidStake = data.liveMemberReportTotal.validStake + data.liveDSMemberReportTotal.validStake + data.liveLMGMemberReportTotal.validStake
											+ data.m8SportReportTotal.validStake;
								totWinLoss = data.liveMemberReportTotal.winLoss +  data.liveDSMemberReportTotal.winLoss + data.liveLMGMemberReportTotal.winLoss +
											+ data.m8SportReportTotal.winLoss;
								totMemberCommAmount = data.liveMemberReportTotal.memberCommAmount + data.liveDSMemberReportTotal.memberCommAmount + data.liveLMGMemberReportTotal.memberCommAmount
											+ data.m8SportReportTotal.memberCommAmount;
								totTotal = data.liveMemberReportTotal.total + data.liveDSMemberReportTotal.total +data.liveLMGMemberReportTotal.total
											+ data.m8SportReportTotal.total;
								
								trHtml = "<tr>"
									+ "<td class='F_bold' style='padding:5px !important;'>" + l_report['TOTTOTAL'] + "</td>"
									+ "<td class='F_bold'>"+totBetCount+"</td>"
									+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
									/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(totTotal,2) + "</td>" */
									+ "</tr>";
									$("#total_table tbody").append(trHtml);
				
						$("#progressBar").hide();
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage(l_report['ERROR']);
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage(l_report['ERROR']);
				},
				complete : function() {
				}
			});

}
function dateGetTotalReportCPTY(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailCPTY();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailCPTY();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailCPTY();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailCPTY();
	});
	
}
function getTotailRepotTotailCPTY(){
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
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotail?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
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
							
							var totBetCount = 0;
							var totStakeAmount = 0;
							var totValidStake = 0;
							var totWinLoss = 0;
							var totMemberCommAmount = 0;
							var totTotal = 0;
							

							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTO'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lottoMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lottoMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lottoMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
						
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['LOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.lotteryMemberReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.lotteryMemberReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.lotteryMemberReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['DSLOTTERY'] + "</a></td>"
								+ "<td class='F_bold'>"+data.dsLotteryReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.dsLotteryReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.dsLotteryReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
								
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a class='f_color' href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>" + l_report['SPORTM8'] + "</a></td>"
								+ "<td class='F_bold'>"+data.m8SportReportTotal.betCount+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.stake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumber(data.m8SportReportTotal.validStake, 2)+"</td>"
								+ "<td class='F_bold '>"+formatNumberWinLoss(data.m8SportReportTotal.winLoss, 2)+"</td>"
								+ "</tr>";
								$("#total_table tbody").append(trHtml);	
								
							totBetCount =  data.lotteryMemberReportTotal.betCount + data.lottoMemberReportTotal.betCount + data.dsLotteryReportTotal.betCount
											+ data.m8SportReportTotal.betCount;
							
							totStakeAmount = data.lotteryMemberReportTotal.stake + data.lottoMemberReportTotal.stake + data.dsLotteryReportTotal.stake
											+ data.m8SportReportTotal.stake;
							
							totValidStake = data.lotteryMemberReportTotal.validStake + data.lottoMemberReportTotal.validStake + data.dsLotteryReportTotal.validStake
											+ data.m8SportReportTotal.validStake;
							
							totWinLoss = data.lotteryMemberReportTotal.winLoss + data.lottoMemberReportTotal.winLoss + data.dsLotteryReportTotal.winLoss
											+ data.m8SportReportTotal.winLoss;
							
							totMemberCommAmount =data.lotteryMemberReportTotal.memberCommAmount + data.lottoMemberReportTotal.memberCommAmount + data.dsLotteryReportTotal.memberCommAmount
											+ data.m8SportReportTotal.memberCommAmount;
							
							totTotal = data.lotteryMemberReportTotal.total + data.lottoMemberReportTotal.total + data.dsLotteryReportTotal.total
											+ data.m8SportReportTotal.total;
							
							trHtml = "<tr>"
								+ "<td class='F_bold' style='padding:5px !important;'>" + l_report['TOTTOTAL'] + "</td>"
								+ "<td class='F_bold'>"+totBetCount+"</td>"
								+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(totTotal,2) + "</td>" */
								+ "</tr>";
								$("#total_table tbody").append(trHtml);
				
						$("#progressBar").hide();
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage(l_report['ERROR']);
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage(l_report['ERROR']);
				},
				complete : function() {
				}
			});

}