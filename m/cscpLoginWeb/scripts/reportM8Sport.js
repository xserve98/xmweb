function dateM8SportReportDay(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getM8SportReportDay();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getM8SportReportDay();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getM8SportReportDay();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getM8SportReportDay();
	});
}

var sportGameTypeArrayValue = {
		  "2":"Soccer",
		  "4":"TD_Specials",
		  "7":"Basketball",
		  "9":"Badminton",
		  "10":"Soccer_Outright",
		  "11":"Basketball_Outright",
		  "13":"US_Football",
		  "14":"Tennis",
		  "15":"Motor_Sports_Head_to_Head",
		  "16":"Baseball",
		  "17":"Golf",
		  "19":"Financials",
		  "20":"Rugby",
		  "22":"Volleyball_Outright",
		  "23":"Tennis_Outright",
		  "24":"Golf_Outright",
		  "27":"Motor_Sports_Outright",
		  "28":"Olympic",
		  "29":"Snooker",
		  "32":"Handball",
		  "34":"Huay_Tai",
		  "37":"Badminton_Outright",
		  "42":"Snooker_Outright",
		  "43":"Volleyball",
		  "44":"Rugby_Outright",
		  "45":"Ice_Hockey",
		  "46":"Ice_Hockey_Outright",
		  "48":"Baseball_Outright",
		  "49":"Handball_Outright",
		  "50":"US_Football_Outright",
		  "88":"Olympic_Outright",
		  "101":"Soccer_Other_bet"
		}

function getM8SportReportDay(){
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
		url : $("#path").val() + "/app/getM8SportReportDay?" + Math.random()*10000,
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
					
					if(data.m8SportMemberReportTotalList.length > 0){
						
						var totBetCount = 0;
						var totStakeAmount = 0;
						var totValidStake = 0;
						var totWinLoss = 0;
						var totMemberCommAmount = 0;
						var tt=0;
						
						for(var i= 0;i < data.m8SportMemberReportTotalList.length;i++){
							trHtml = "";
							trHtml = "<tr>"
								+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/index.jsp' data-ajax='false'>"+data.m8SportMemberReportTotalList[i].reportDate+"</a></td>"
								+ "<td class='F_bold'>"+ data.m8SportMemberReportTotalList[i].betCount+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.m8SportMemberReportTotalList[i].stake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumber(data.m8SportMemberReportTotalList[i].validStake,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.m8SportMemberReportTotalList[i].winLoss,2)+ "</td>"
								/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.m8SportMemberReportTotalList[i].memberCommAmount,2)+ "</td>"
								+ "<td class='F_bold '>"+ formatNumberWinLoss(data.m8SportMemberReportTotalList[i].total,2) + "</td>" */
								+ "</tr>";
							$("#total_table tbody").append(trHtml);
							totBetCount = totBetCount + data.m8SportMemberReportTotalList[i].betCount;
							totStakeAmount = totStakeAmount + data.m8SportMemberReportTotalList[i].stake;
							totValidStake = totValidStake + data.m8SportMemberReportTotalList[i].validStake;
							totWinLoss = totWinLoss + data.m8SportMemberReportTotalList[i].winLoss;
							totMemberCommAmount =totMemberCommAmount + data.m8SportMemberReportTotalList[i].memberCommAmount;
							tt = tt + data.m8SportMemberReportTotalList[i].total;
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

function addM8SportGameType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addM8SportGameType?" + Math.random()*10000,
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
					for ( var i = 0; i < data.m8SportGameTypeList.length; i++) {
						$("#t_LT").append( "<option value='" + data.m8SportGameTypeList[i] + "'>" + l_SportGameTypeArray[data.m8SportGameTypeList[i]] + "</option>");
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
//function addSportHallType(){
//	var o = {
//	};
//	var jsonuserinfo = $.toJSON(o);
//	$.ajax({
//		type : "post",
//		url : $("#path").val() + "/app/addSportHallType?" + Math.random()*10000,
//		data : jsonuserinfo,
//		contentType : 'application/json',
//		dataType : "json",
//		async:false, 
//		timeout : 50000,
//		beforeSend : function(xmlhttprequest) {
//		},
//		success : function(data) {
//			if(data){
//				if(data.success){
//					for ( var i = 0; i < data.sportHallType.length; i++) {
//						$("#SportHallType").append( "<option value='" + data.sportHallType[i] + "'>" + l_SportHallType[data.sportHallType[i]] + "</option>");
//					}
//				}
//			}
//		},
//		error : function(xmlhttprequest, error) {
//		},
//		complete : function() {
//		}
//	});
//}

function dateGetM8SportBetDetail(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getM8SportBetDetail('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getM8SportBetDetail('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getM8SportBetDetail('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getM8SportBetDetail('1');
	});
}

function getM8SportBetDetail(pageNumber){
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
			hallType : $("#SportHallType").val(),
			pageNumber : pageNumber + "",
			RecordsPage : 10 + ""
	};
	var jsonuserinfo = $.toJSON(o);
	
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/getM8SportBetDetail?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async : true,
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
						
						for ( var i = 0; i < data.resultList.length; i++) {
							
							var bet_detail = "";
							var lianMa_detail = "";
							var fill_type = "";
							var apiSide = "";
							var result = "";
							var project = "";
							var grounder = ""; //滚球
							var time = formartTime(data.resultList[i].betTime,4);
							time = time.substring(1,time.length-2);
							var memberWinLoss = data.resultList[i].winLoss + data.resultList[i].memberCommAmount;
							if (data.resultList[i].betType == "HDP") { //让球盘
								if (data.resultList[i].apiHalf == "0") { //区分上半场和全场
									if (data.resultList[i].apiSide == "1") {
										apiSide = data.recordIdMap[data.resultList[i].apiRecordId].homeNameCn + "(全)&nbsp&nbsp&nbsp" + (data.resultList[i].apiSportInfo-0); 
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = data.recordIdMap[data.resultList[i].apiRecordId].awawyNameCn + "(全)&nbsp&nbsp&nbsp" + (0-data.resultList[i].apiSportInfo); 
									}
								} else if (data.resultList[i].apiHalf == "1") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = data.recordIdMap[data.resultList[i].apiRecordId].homeNameCn + "(上)&nbsp&nbsp&nbsp" + (data.resultList[i].apiSportInfo-0); 
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = data.recordIdMap[data.resultList[i].apiRecordId].awawyNameCn + "(上)&nbsp&nbsp&nbsp" + (0-data.resultList[i].apiSportInfo); 
									}
								}
							} else if (data.resultList[i].betType == "OE") {//单/双
								if (data.resultList[i].apiHalf == "0") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "单(全)";
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "双(全)";
									}
								} else if (data.resultList[i].apiHalf == "1") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "单(上)";
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "双(上)";
									}
								}
							} else if (data.resultList[i].betType == "CSR") {//波胆
								if (data.resultList[i].apiHalf == "0") {
									apiSide = "(全)" + data.resultList[i].apiSportInfo; 
								} else if (data.resultList[i].apiHalf == "1") {
									apiSide = "(上)" + data.resultList[i].apiSportInfo; 
								}
							} else if (data.resultList[i].betType == "TG") {//总入球
								apiSide = data.resultList[i].apiSportInfo ;
							} else if (data.resultList[i].betType == "FLG") {//最先/最后得分
								if (data.resultList[i].apiSportInfo == "HFG") {
									apiSide = data.recordIdMap[data.resultList[i].apiRecordId].homeNameCn + "先进球"; 
								} else if (data.resultList[i].apiSportInfo == "HLG") {
									apiSide = data.recordIdMap[data.resultList[i].apiRecordId].homeNameCn + "后进球"; 
								} else if (data.resultList[i].apiSportInfo == "AFG") {
									apiSide = data.recordIdMap[data.resultList[i].apiRecordId].awawyNameCn + "先进球"; 
								} else if (data.resultList[i].apiSportInfo == "ALG") {
									apiSide = data.recordIdMap[data.resultList[i].apiRecordId].awawyNameCn + "后进球"; 
								} else if (data.resultList[i].apiSportInfo == "NG") {
									apiSide = "无进球"; 
								}  
							} else if (data.resultList[i].betType == "HFT") {//上半场 /全场
								apiSide = data.resultList[i].apiSportInfo; 
							} else if (data.resultList[i].betType == "PAR") {//过关
							} else if (data.resultList[i].betType == "ORT") {//优胜冠军
								apiSide = data.resultList[i].apiSide; 
							} else if (data.resultList[i].betType == "OU") {//大/小
								if (data.resultList[i].apiHalf == "0") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "(全)大于" + data.resultList[i].apiSportInfo;
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "(全)小于" + data.resultList[i].apiSportInfo;
									}
								} else if (data.resultList[i].apiHalf == "1") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "(上)大于" + data.resultList[i].apiSportInfo;
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "(上)小于" + data.resultList[i].apiSportInfo;
									}
								}
							} else if (data.resultList[i].betType == "1X2") {//1X2
								if (data.resultList[i].apiHalf == "0") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "(全)主场";
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "(全)客场";
									} else {
										apiSide = "(全)和";
									}
								} else if (data.resultList[i].apiHalf == "1") {
									if (data.resultList[i].apiSide == "1") {
										apiSide = "(上)主场";
									} else if (data.resultList[i].apiSide == "2") {
										apiSide = "(上)客场";
									} else {
										apiSide = "(上)和";
									}
								}
							} else if (data.resultList[i].betType == "DC") {//双重机会
								if (data.resultList[i].apiHalf == "0") {
									if (data.resultList[i].apiSportInfo == "12") {
										apiSide = "主客(全)";
									} else if (data.resultList[i].apiSportInfo == "1X") {
										apiSide = "主和(全)";
									} else if (data.resultList[i].apiSportInfo == "X2") {
										apiSide = "客和(全)";
									}
								} else if (data.resultList[i].apiHalf == "1") {
									if (data.resultList[i].apiSportInfo == "12") {
										apiSide = "主客(上)";
									} else if (data.resultList[i].apiSportInfo == "1X") {
										apiSide = "主和(上)";
									} else if (data.resultList[i].apiSportInfo == "X2") {
										apiSide = "客和(上)";
									}
								}
								
								
							}
							
							if (data.resultList[i].apiHalf == "0") {//全场
								result = "全场(" + data.resultList[i].apiScore + ")" ;
							} else if (data.resultList[i].apiHalf == "1") {//上半场
								result = "上半场(" + data.resultList[i].apiScore + ")";
							}
							
							if (data.resultList[i].apiRunScore == "") { //非滚球
								grounder = "";
							} else if (data.resultList[i].apiRunScore != "") { //滚球
								grounder = "(" + data.resultList[i].apiRunScore + ")";
							}
							
							if (data.resultList[i].betType == "PAR") {
								project = "<td>" + "过关详细"
								+ "<a onclick='openSportDetail(\""+ data.resultList[i].apiRecordId +"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
								+ "</td>" ;
							} else {
								project = "<td>"+ data.recordIdMap[data.resultList[i].apiRecordId].leagueNameCn 
									+ "<br/><span class='font_r F_bold'>"
									+ data.recordIdMap[data.resultList[i].apiRecordId].homeNameCn
									+ "<span style='color:#2836f4;'>-vs-</span>" 
									+ data.recordIdMap[data.resultList[i].apiRecordId].awawyNameCn + grounder + "</span><br/>"
									+ "结果：" + result +
									"</td>" 
							}
								
							trHtml = "<tr>"+
							"<td>"+ (i + 1)+ "</td>"
							+ project+ 
							"<td class=''>"+data.resultList[i].apiRecordId+fill_type+"<br/>"+time + "</td>"+ //注单号码、时间
							"<td>"+ l_SportGameTypeArray[sportGameTypeArrayValue[data.resultList[i].apiSportType]] + "</td>"+//下注类型
								
							"<td class=''><span class='Font_B'>"  //下注明细
								+ l_SportBetType[data.resultList[i].betType]
								+ "</span><br/> "
								+ "<span class='font_r F_bold'>" //(赌主/客场/和)  (让球)         (赔率)     (盘口)
									+ apiSide
//								+ "&nbsp&nbsp&nbsp" + data.resultList[i].apiSportInfo
								+ "&nbsp@&nbsp&nbsp" + data.resultList[i].odds + "&nbsp&nbsp" + data.resultList[i].apiOddsType
								+ "</span></td>" +
								
							"<td class='td_right F_bold'>"+ data.resultList[i].stakeAmount+"</td>"+ //投注额
							"<td class='td_right F_bold'>"+ data.resultList[i].validStake+"</td>"+ //有效投注额
							"<td class='td_right F_bold'>"+ formatNumberWinLoss(data.resultList[i].winLoss,4)+"</td>"; //输赢
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
									getM8SportBetDetail(pageNum + 1);
								});
							}
						} else if (pageNum == pageAllNumber) {
							$("#pagePrev").click(function() {
								getM8SportBetDetail(pageNum - 1);
							});
						} else {
							$("#pageNext").click(function() {
								getM8SportBetDetail(pageNum + 1);
							});
							$("#pagePrev").click(function() {
								getM8SportBetDetail(pageNum - 1);
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
								pageNumHtml += "<a onclick=\"getM8SportBetDetail("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
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

function openSportDetail(apiRecord) {
	$("#dialogM8").dialog({
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
	$("#dialogM8").dialog("option", "title", apiRecord);
	$("#dialogM8").dialog("open");

	var o = {
		apiRecord : apiRecord
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
				type : "post",
				url : $("#path").val() + "/app/getSportBetDetailTable?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				// async:false,
				// timeout : 20000,
				beforeSend : function() {
//					$("#detailTableM8 tbody").html(" <tr><td colspan='7'><img src='../images/loadingAnimation.gif'/*tpa=http://juyou1989.com/cscpLoginWeb/images/loadingAnimation.gif*//></td></tr>");
				},
				success : function(data) {
					if (data) {
						if (data.success == false) {
							alert(l_basic['TryAgain']);
						} else {
							$("#detailTableM8 tbody").html("<tr><td></td></tr>");
							for ( var i = 0; i < data.resultList.length; i++)  {
								var trHtml = "";
								var apiSide = "";
								var result = "";
								var grounder = "";
								if (data.resultList[i].apiTicketGame == "HDP") { //让球盘
									if (data.resultList[i].apiTicketHalf == "0") {
										if (data.resultList[i].apiTicketSide == "1") {
											apiSide = data.resultList[i].homeName + "(全)&nbsp&nbsp&nbsp" + (data.resultList[i].apiTicketInfo-0); 
										} else if (data.resultList[i].apiTicketSide == "2") {
											apiSide = data.resultList[i].awawyName + "(全)&nbsp&nbsp&nbsp" + (0-data.resultList[i].apiTicketInfo); 
										}
									} else if (data.resultList[i].apiTicketHalf == "1") {
										if (data.resultList[i].apiTicketSide == "1") {
											apiSide = data.resultList[i].homeName + "(上)&nbsp&nbsp&nbsp" + (data.resultList[i].apiTicketInfo-0); 
										} else if (data.resultList[i].apiTicketSide == "2") {
											apiSide = data.resultList[i].awawyName + "(上)&nbsp&nbsp&nbsp" + (0-data.resultList[i].apiTicketInfo); 
										}
									}
								}/*else if (data.resultList[i].apiTicketGame == "OE") {//单/双
									if (data.resultList[i].apiTicketSide == "1") {
										apiSide = "单";
									} else if (data.resultList[i].apiTicketSide == "2") {
										apiSide = "双";
									}
								} else if (data.resultList[i].apiTicketGame == "CSR") {//波胆
									apiSide = data.resultList[i].apiTicketInfo; 
								} else if (data.resultList[i].apiTicketGame == "TG") {//总入球
									apiSide = data.resultList[i].apiTicketInfo ;
								} else if (data.resultList[i].apiTicketGame == "FLG") {//最先/最后得分
									if (data.resultList[i].apiTicketSide == "HFG") {
										apiSide = data.resultList[i].homeName; 
									} else if (data.resultList[i].apiTicketSide == "HLG") {
										apiSide = data.resultList[i].homeName; 
									} else if (data.resultList[i].apiTicketSide == "AFG") {
										apiSide = data.resultList[i].awawyName; 
									} else if (data.resultList[i].apiTicketSide == "ALG") {
										apiSide = data.resultList[i].awawyName; 
									} else if (data.resultList[i].apiTicketSide == "LG") {
										apiSide = "无进球"; 
									}  
								} else if (data.resultList[i].apiTicketGame == "HFT") {//上半场 /全场
									apiSide = data.resultList[i].apiTicketInfo; 
								} else if (data.resultList[i].apiTicketGame == "ORT") {//优胜冠军
									apiSide = data.resultList[i].apiTicketSide; 
								} */else if (data.resultList[i].apiTicketGame == "OU") {//大/小
									if (data.resultList[i].apiTicketSide == "1") {
										apiSide = "大于" + data.resultList[i].apiTicketInfo;
									} else if (data.resultList[i].apiTicketSide == "2") {
										apiSide = "小于" + data.resultList[i].apiTicketInfo;
									}
								} else if (data.resultList[i].apiTicketGame == "1X2") {//1X2
									if (data.resultList[i].apiTicketSide == "1") {
										apiSide = "主场";
									} else if (data.resultList[i].apiTicketSide == "2") {
										apiSide = "客场";
									} else {
										apiSide = "和";
									}
								}/* else if (data.resultList[i].apiTicketGame == "DC") {//双重机会
									if (data.resultList[i].apiTicketInfo == "12") {
										apiSide = "主客";
									} else if (data.resultList[i].apiTicketInfo == "1X") {
										apiSide = "主和";
									} else if (data.resultList[i].apiTicketInfo == "X2") {
										apiSide = "客和";
									}
								}*/
								if (data.resultList[i].apiTicketHalf == "0") {//全场
									result = "全场(" + data.resultList[i].apiTicketScore + ")";
								} else if (data.resultList[i].apiTicketHalf == "1") {//上半场
									result = "上半场(" + data.resultList[i].apiTicketScore + ")";
								}
								
								if (data.resultList[i].apiRunScore == "") { //非滚球
									grounder = "";
								} else if (data.resultList[i].apiRunScore != "") { //滚球
									grounder = "(" + data.resultList[i].apiRunScore + ")";
								}
								
								trHtml += "<tr>" +
									"<td>"+ (i + 1)+ "</td>"
									+ "<td>"+ data.resultList[i].leagueName  
										+ "<br/><span class='font_r F_bold'>"
										+ data.resultList[i].homeName
										+ "<span style='color:#2836f4;'>-vs-</span>" 
										+ data.resultList[i].awawyName + grounder + "</span><br/>"
										+ "结果：" + result
										
										+ "<br/><span class='Font_B'>"  //下注明细
										+ l_SportBetType[data.resultList[i].apiTicketGame]
										+ "</span><br/> "
										+ "<span class='font_r F_bold'>" //(赌主/客场/和)  (让球)         (赔率)     (盘口)
											+ apiSide
//										+ "&nbsp&nbsp&nbsp" + data.resultList[i].apiSportInfo
										+ "&nbsp@&nbsp&nbsp" + data.resultList[i].apiTicketOdds/* + "&nbsp&nbsp" + data.resultList[i].apiOddsType*/
										+ "</span>"
									+ "</td>" 
									+ "</tr>";
								$("#detailTableM8 tbody").append(trHtml);
							}
						}
					} else {
						$("#detailTableM8 tbody").html(
								" <tr><td colspan='7'>服务器繁忙, 请稍后再试!</td></tr>");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#detailTableM8 tbody").html(
							" <tr><td colspan='7'>网络繁忙, 请稍后再试!</td></tr>");
				},
				complete : function() {
				}
			});
}
