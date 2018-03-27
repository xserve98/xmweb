function loginFormSubmit(){
	var txtLoginUsername =  $("#txtLoginUsername");
	var txtLoginPassword = $("#txtLoginPassword");
	var txtLoginCaptcha = $("#txtLoginCode");
	if(txtLoginUsername.val().length < 1||txtLoginUsername.val()==l_basic["username"]) {
		JqueryShowMessage(l_login['msg1']);
		return false;
	} else if(txtLoginPassword.val().length < 1) {
		JqueryShowMessage(l_login['msg2']);
		return false;
	} else if(txtLoginCaptcha.val().length != 4) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	} else if(txtLoginUsername.val().length < 3 || !patrnName.exec(txtLoginUsername.val())) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(txtLoginPassword.val().length < 6) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(!patrnZhengInt.exec(txtLoginCaptcha.val())) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	}
	
	  var o = {
				txtLoginCaptcha:txtLoginCaptcha.val(),
				txtLoginUsername:txtLoginUsername.val(),
				txtLoginPassword:txtLoginPassword.val()
			};
			
			var jsonuserinfo = $.toJSON(o);
			$.ajax({
				type : "post",
				url : $("#path").val() + "/app/loginVerification?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async:false, 
				timeout : 50000,
				beforeSend : function(xmlhttprequest) {
					$("#btn_login").html("登录中..");
				},
				success : function(data) {
					if (data) {
						if(data.success == true) {
							for(var i = 0; i < data.annLoginList.length; i++) {
								alert(data.annLoginList[i]);
							}
							var page = $("#page").val();
							var joinPage ="";
							if(null!=$("#joinPage").val()){
							 joinPage= $("#joinPage").val();
							}
							
							if( (page == "home" || page == "registration") && joinPage == ""){
								location.href="http://juyou1989.com/cscpLoginWeb/scripts/home?l=0"; 
							} else if(joinPage){
								location.href=joinPage; 
							}else {
								location.reload();
							}
						} else {
							$("#btn_login").html("登录");
							if(data.message == 'CHECK_CODE') {
								JqueryShowMessage(l_login['msg4']);
							} else if(data.message == 'USERNAME_OR_PASSWORD') {
								JqueryShowMessage(l_login['msg3']);
							} else if(data.message == 'IP_ERROR') {
								JqueryShowMessage(l_login['msg8']);
							} else if(data.message == 'LOGIN_IP_BLOCK') {
								JqueryShowMessage(l_login['msg5']);
							} else if(data.message == 'USER_CLOSE') {
								JqueryShowMessage(l_login['msg6']);
							} else if(data.message == 'PASSWORD_LOCK') {
								JqueryShowMessage(l_login['msg7']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['tryAgain']);
							} else if(data.message == 'LOGIN_ERROR_COUNT') {
								JqueryShowMessage(l_basic['countError']);
							} else if(data.message == 'LOGIN_ERROR_COUNT_SIX') {
								JqueryShowMessage(l_basic['countErrorSix']);
							}
							changeLoginCode();
						}
					}
				},
				error : function(xmlhttprequest, error) {
					JqueryShowMessage(l_basic['tryAgain']);
					$("#btn_login").html("登录");
				},
				complete : function() {
				}
			});
	
}

function loginDemoFormSubmit(){
	/*var txtLoginUsername =  $("#txtLoginUsername");
	var txtLoginPassword = $("#txtLoginPassword");
	var txtLoginCaptcha = $("#txtLoginCode");
	if(txtLoginUsername.val().length < 1||txtLoginUsername.val()==l_basic["username"]) {
		JqueryShowMessage(l_login['msg1']);
		return false;
	} else if(txtLoginPassword.val().length < 1) {
		JqueryShowMessage(l_login['msg2']);
		return false;
	} else if(txtLoginCaptcha.val().length != 4) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	} else if(txtLoginUsername.val().length < 3 || !patrnName.exec(txtLoginUsername.val())) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(txtLoginPassword.val().length < 6) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(!patrnZhengInt.exec(txtLoginCaptcha.val())) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	}*/
	
	  var o = {
				/*txtLoginCaptcha:txtLoginCaptcha.val(),
				txtLoginUsername:txtLoginUsername.val(),
				txtLoginPassword:txtLoginPassword.val()*/
			};
			var jsonuserinfo = $.toJSON(o);
			$.ajax({
				type : "post",
				url : $("#path").val() + "/app/loginDemoVerification?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async:false, 
				timeout : 50000,
				beforeSend : function(xmlhttprequest) {
					/*$("#btn_loginDemo").html("登录中..");*/
				},
				success : function(data) {
					if (data) {
						if(data.success == true) {
							for(var i = 0; i < data.annLoginList.length; i++) {
								alert(data.annLoginList[i]);
							}
							var page = $("#page").val();
							if(page == "home" || page == "registration"){
								location.href="http://juyou1989.com/cscpLoginWeb/scripts/home?l=0"; 
							} else {
								location.reload();
							}
						} else {
							$("#btn_login").html("登录");
							if(data.message == 'IP_ERROR') {
								JqueryShowMessage(l_login['msg8']);
							} else if(data.message == 'LOGIN_IP_BLOCK') {
								JqueryShowMessage(l_login['msg5']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['tryAgain']);
							} else if(data.message == 'LOGIN_ERROR_COUNT') {
								JqueryShowMessage(l_basic['countError']);
							} else if(data.message == 'DEMO_MAX_MEMBER') {
								JqueryShowMessage(l_loginDemo['msg1']);
							} else if(data.message == 'DEMO_IP_LIMIT') {
								JqueryShowMessage(l_loginDemo['msg2']);
							} 
							changeLoginCode();
						}
					}
				},
				error : function(xmlhttprequest, error) {
					JqueryShowMessage(l_basic['tryAgain']);
					/*$("#btn_login").html("登录");*/
				},
				complete : function() {
				}
			});
	
}

function loginFormSubmitToXieyi(){
	var txtLoginUsername =  $("#txtLoginUsername");
	var txtLoginPassword = $("#txtLoginPassword");
	var txtLoginCaptcha = $("#txtLoginCode");
	if(txtLoginUsername.val().length < 1) {
		JqueryShowMessage(l_login['msg1']);
		return false;
	} else if(txtLoginPassword.val().length < 1) {
		JqueryShowMessage(l_login['msg2']);
		return false;
	} else if(txtLoginCaptcha.val().length != 4) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	} else if(txtLoginUsername.val().length < 3 || !patrnName.exec(txtLoginUsername.val())) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(txtLoginPassword.val().length < 6) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(!patrnZhengInt.exec(txtLoginCaptcha.val())) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	}
	
	  var o = {
				txtLoginCaptcha:txtLoginCaptcha.val(),
				txtLoginUsername:txtLoginUsername.val(),
				txtLoginPassword:txtLoginPassword.val()
			};
			
			var jsonuserinfo = $.toJSON(o);
			$.ajax({
				type : "post",
				url : $("#path").val() + "/app/loginVerification?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async:false, 
				timeout : 50000,
				beforeSend : function(xmlhttprequest) {
					$("#btn_login").html("登录中..");
				},
				success : function(data) {
					if (data) {
						if(data.success == true) {
//							var page = $("#page").val();
//							if(page == "home" || page == "registration"){
								location.href="platform"; 
//							} else {
//								location.reload();
//							}
						} else {
							$("#btn_login").html("登录");
							if(data.message == 'CHECK_CODE') {
								JqueryShowMessage(l_login['msg4']);
							} else if(data.message == 'USERNAME_OR_PASSWORD') {
								JqueryShowMessage(l_login['msg3']);
							} else if(data.message == 'IP_ERROR') {
								JqueryShowMessage(l_login['msg8']);
							} else if(data.message == 'LOGIN_IP_BLOCK') {
								JqueryShowMessage(l_login['msg5']);
							} else if(data.message == 'USER_CLOSE') {
								JqueryShowMessage(l_login['msg6']);
							} else if(data.message == 'PASSWORD_LOCK') {
								JqueryShowMessage(l_login['msg7']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['tryAgain']);
							} else if(data.message == 'LOGIN_ERROR_COUNT') {
								JqueryShowMessage(l_basic['countError']);
							} else if(data.message == 'LOGIN_ERROR_COUNT_SIX') {
								JqueryShowMessage(l_basic['countErrorSix']);
							}
							changeLoginCode();
						}
					}
				},
				error : function(xmlhttprequest, error) {
					JqueryShowMessage(l_basic['tryAgain']);
					$("#btn_login").html("登录");
				},
				complete : function() {
				}
			});
	
}

function loginFormSubmitToXieyi2(){
	var txtLoginUsername =  $("#txtLoginUsername2");
	var txtLoginPassword = $("#txtLoginPassword2");
	var txtLoginCaptcha = $("#txtLoginCode2");
	if(txtLoginUsername.val().length < 1) {
		JqueryShowMessage(l_login['msg1']);
		return false;
	} else if(txtLoginPassword.val().length < 1) {
		JqueryShowMessage(l_login['msg2']);
		return false;
	} else if(txtLoginCaptcha.val().length != 4) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	} else if(txtLoginUsername.val().length < 3 || !patrnName.exec(txtLoginUsername.val())) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(txtLoginPassword.val().length < 6) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(!patrnZhengInt.exec(txtLoginCaptcha.val())) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	}
	
	  var o = {
				txtLoginCaptcha:txtLoginCaptcha.val(),
				txtLoginUsername:txtLoginUsername.val(),
				txtLoginPassword:txtLoginPassword.val()
			};
			
			var jsonuserinfo = $.toJSON(o);
			$.ajax({
				type : "post",
				url : $("#path").val() + "/app/loginVerification?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async:false, 
				timeout : 50000,
				beforeSend : function(xmlhttprequest) {
					$("#btn_login").html("登录中..");
				},
				success : function(data) {
					if (data) {
						if(data.success == true) {
//							var page = $("#page").val();
//							if(page == "home" || page == "registration"){
								location.href="platform"; 
//							} else {
//								location.reload();
//							}
						} else {
							$("#btn_login").html("登录");
							if(data.message == 'CHECK_CODE') {
								JqueryShowMessage(l_login['msg4']);
							} else if(data.message == 'USERNAME_OR_PASSWORD') {
								JqueryShowMessage(l_login['msg3']);
							} else if(data.message == 'IP_ERROR') {
								JqueryShowMessage(l_login['msg8']);
							} else if(data.message == 'LOGIN_IP_BLOCK') {
								JqueryShowMessage(l_login['msg5']);
							} else if(data.message == 'USER_CLOSE') {
								JqueryShowMessage(l_login['msg6']);
							} else if(data.message == 'PASSWORD_LOCK') {
								JqueryShowMessage(l_login['msg7']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['tryAgain']);
							} else if(data.message == 'LOGIN_ERROR_COUNT') {
								JqueryShowMessage(l_basic['countError']);
							} else if(data.message == 'LOGIN_ERROR_COUNT_SIX') {
								JqueryShowMessage(l_basic['countErrorSix']);
							}
							changeLoginCode();
						}
					}
				},
				error : function(xmlhttprequest, error) {
					JqueryShowMessage(l_basic['tryAgain']);
					$("#btn_login").html("登录");
				},
				complete : function() {
				}
			});
	
}

function loginEnterToXieYi(keyNumber) {
	if(keyNumber==13) {
		loginFormSubmitToXieyi();
	}
}
function loginEnterToXieYi2(keyNumber) {
	if(keyNumber==13) {
		loginFormSubmitToXieyi2();
	}
}


function loginEnter(keyNumber) {
	if(keyNumber==13) {
		loginFormSubmit();
	}
}
function loginEnter2(keyNumber) {
	if(keyNumber==13) {
		loginFormSubmit2();
	}
}


function changeNull(thisObj,msg){
	 if(msg=='username'){
		 if (thisObj.value==l_basic['username']){
			 thisObj.value='';
			}
	 }else if(msg=='password'){
//		 if (thisObj.value==l_login['msg9']){
//			 $("#txtLoginPasswordText").hide();
//			 $("#txtLoginPassword").show();
//			}else if(thisObj.value==''){
//				$("#txtLoginPasswordText").show();
//				 $("#txtLoginPassword").hide();
//			}
	 } else if(msg=='code'){
		 if (thisObj.value==l_basic['code']){
			 thisObj.value='';
			}
	 }
}


function changePasswordText(){
	 $("#txtLoginPasswordText").hide();
	 $("#txtLoginPassword").show();
	 $('#txtLoginPassword').focus();
}


function changePassword(){
	 if($('#txtLoginPassword').val() == '') {
		 $("#txtLoginPasswordText").show();
		 $("#txtLoginPassword").hide();
		 $("#txtLoginPasswordText").val(l_basic['password']);
	 	}
	 
}


function changeMessage(thisObj,msg){
	if(msg=='username'){
		if (thisObj.value==''){
			thisObj.value=l_basic['username'];
		}
	}else if(msg=='password'){
//		 if (thisObj.value==''){
//			 thisObj.value=l_login['msg9'];
//			}
	} else if(msg=='code'){
		if (thisObj.value==''){
			thisObj.value=l_basic['code'];
		}
	}
	
}

function changeNull2(thisObj,msg){
	 if(msg=='username'){
		 if (thisObj.value==l_basic['username']){
			 thisObj.value='';
			}
	 } else if(msg=='code'){
		 if (thisObj.value==l_basic['code']){
			 thisObj.value='';
			}
	 }
}


function changePasswordText2(){
	 $("#txtLoginPasswordText2").hide();
	 $("#txtLoginPassword2").show();
	 $('#txtLoginPassword2').focus();
}


function changePassword2(){
	 if($('#txtLoginPassword2').val() == '') {
		 $("#txtLoginPasswordText2").show();
		 $("#txtLoginPassword2").hide();
		 $("#txtLoginPasswordText2").val(l_basic['password']);
	 	}
	 
}


function changeMessage2(thisObj,msg){
	 if(msg=='username'){
		 if (thisObj.value==''){
			 thisObj.value=l_basic['username'];
			}
	 } else if(msg=='code'){
		 if (thisObj.value==''){
			 thisObj.value=l_basic['code'];
			}
	 }
	 
}

function playGameYzc(product){
	
	var iHeight = screen.height-70;
	var iWidth = screen.width-10;
	
	var o = {
			product:product
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/playHoldem?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			if(product == 'LOTTO_IG'){
				$("#maskDiv").show();
				$("#lottoiframe").hide();
			}else if(product == 'LOTTERY_IG'){
				$("#maskDiv").show();
				$("#lotteryiframe").hide();
			}else if(product == 'LOTTERY_DS'){
				$("#maskDiv").show();
				$("#ffciframe").hide();
			}
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(product == 'LIVE_IG'){
						window.open(data.link,'livecashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}else if(product == 'LIVE_LMG'){
						window.open(data.link,'livecashLMGWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}else if(product == 'LIVE_DS'){
						window.open(data.link,'livecashDSWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}else if(product == 'LIVE_AG'){
						window.open(data.link,'livecashAGWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}else if(product == "LOTTERY_IG"){
						$("#maskDiv").show();
						$("#lotteryiframe").attr("src",data.link);
					}else if(product == "LOTTO_IG"){
						$("#maskDiv").show();
						$("#lottoiframe").attr("src",data.link);
					}else if(product == "LOTTERY_DS"){
						$("#maskDiv").show();
						$("#ffciframe").attr("src",data.link);
					}
				} else {
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageHome(l_playGame['msg4']);
					} else if(data.message == 'STATUS_NO_OPEN') {
						JqueryShowMessage(l_playGame['msg3']);
					}else if(data.message == 'USER_CLOSE') {
						JqueryShowMessage(l_playGame['msg2']);
					} else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessage(l_basic['tryAgain']);
					}else if(data.message == 'PRODUCT_NO_EXISTS') {
						JqueryShowMessageHome(l_playGame['msg6']);
					}else if(data.message == 'PRODUCT_MAINTENACE') {
						JqueryShowMessageHome(data.msg);
					}
					$("#maskDiv").hide();
				}
			}
		},
		error : function(xmlhttprequest, error) {
			JqueryShowMessage(l_basic['tryAgain']);
		},
		complete : function() {
		}
	});
}

function playGame(product,type){
	var ishttps = 'https:' == document.location.protocol ? true: false;
	var iHeight = screen.height-70;
	var iWidth = screen.width-10;
	
	var liveIG = null;
	var liveLMG = null;
	var liveDS = null;
	var liveAG = null;
	var liveBBIN = null;
	var electroicAG = null;
	var electroicBBIN = null;
	var electroicAGByw = null;
	var liveOG = null;
	var liveCG88 = null;
	var seven = null;
	var fishGG = null;
	var IGHall = null;
	var liveOPUS = null;
	var spoptOPUS = null;
	var liveAllBet = null;
	var lotteryDS = null;
	if(product == "LIVE_IG"){
		liveIG = window.open("",'liveIGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_LMG"){
		liveLMG = window.open("",'liveLMGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_DS"){
		liveDS = window.open("",'liveDScashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_CG88"){
		liveCG88 = window.open("",'liveCG88cashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_AG"){
		liveAG = window.open("",'liveAGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "SLOTS_AG"){
		electroicAG = window.open("",'electroicAGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "FISH_AG"){
		electroicAGByw = window.open("",'electroicBywAGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_OG"){
		liveOG = window.open("",'liveOGcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "LIVE_BBIN"){
		liveBBIN = window.open("",'liveBBINcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "SLOTS_BBIN"){
		electroicBBIN = window.open("",'electroicBBINcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "SLOTS_YY"){
		electroicYY = window.open("",'electroicyycashWindow'+Math.random(),"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	} else if(product == "FISH_GG"){
		fishGG = window.open("",'fishGgcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}else if(product == "IG_HALL"){
		IGHall = window.open("",'hallIgcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}else if(product == "LIVE_OPUS"){
		liveOPUS = window.open("",'liveopuscashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}else if(product == "SPORT_OPUS"){
		spoptOPUS = window.open("",'sportopuscashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}/* else if(product == "SEVEN_IG"){
		seven = window.open("",'sevenLotterycashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=yes,location=no, status=no"); 
	}*/else if(product == "LIVE_ALLBET"){
		liveAllBet = window.open("",'liveAllBetcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}else if(product == "LOTTERY_DS"){
		if(ishttps){
			lotteryDS = window.open("",'lotteryDScashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
		}
	} else if(product == "SLOTS_MG"){
		electroicMG = window.open("",'electroicmgcashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
	}
	
	var o = {
			product:product,
			type:type+""
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/playHoldem?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:true, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			if(product == 'LOTTO_IG'){
				$("#maskDiv").show();
				$("#lottoiframe").hide();
			}else if(product == 'LOTTERY_IG'){
				$("#maskDiv").show();
				$("#lotteryiframe").hide();
			}else if(product == 'LOTTERY_DS'){
				if(!ishttps){
					$("#maskDiv").show();
					$("#ffciframe").hide();
				}
			}else if(product == 'SPORT'){
				$("#maskDiv").show();
				$("#sportiframe").hide();
			}else if(product == 'SEVEN_IG'){
				$("#maskDiv").show();
				$("#seveniframe").hide();
			}
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(product == 'LIVE_IG'){
						liveIG.location=data.link;
//						window.open(data.link,'livecashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}else if(product == 'LIVE_LMG'){
						liveLMG.location=data.link;
					}else if(product == 'LIVE_DS'){
						liveDS.location=data.link;
					}else if(product == 'LIVE_CG88'){
						liveCG88.location=data.link;
					}else if(product == 'LIVE_AG'){
						liveAG.location=data.link;
					}else if(product == "LOTTERY_IG"){
						$("#maskDiv").show();
						$("#lotteryiframe").attr("src",data.link);
					}else if(product == "LOTTO_IG"){
						$("#maskDiv").show();
						$("#lottoiframe").attr("src",data.link);
					}else if(product == "SEVEN_IG"){
						$("#maskDiv").show();
						$("#seveniframe").attr("src",data.link);
					}else if(product == "LOTTERY_DS"){
						if(!ishttps){
					    	$("#maskDiv").show();
							$("#ffciframe").attr("src",data.link);
						} else {
//							if(data.link.indexOf("https:")!=-1){ //包含 
//								lotteryDS.location=data.link;
//								window.open(data.link,"_blank");
//						    }else{  
//						    	$("#maskDiv").show();
//								$("#ffciframe").attr("src",data.link);
//						    } 
							lotteryDS.location=data.link;
						}
					}else if(product == "SPORT"){
						$("#maskDiv").show();
						$("#sportiframe").attr("src",data.link);
					}else if(product == "FISH_AG"){
						electroicAGByw.location=data.link;
					}else if(product == "SLOTS_AG"){
						electroicAG.location=data.link;
					}else if(product == "LIVE_OG"){
						liveOG.location=data.link;
					}else if(product == 'LIVE_BBIN'){
						liveBBIN.location=data.link;
					}else if(product == "SLOTS_BBIN"){
						electroicBBIN.location=data.link;
					}else if(product == "SLOTS_YY"){
						electroicYY.location=data.link;
					}else if(product == "FISH_GG"){
						fishGG.location=data.link;
					}else if(product == "IG_HALL"){
						IGHall.location=data.link;
					}else if(product == "LIVE_OPUS"){
						liveOPUS.location=data.link;
					}else if(product == "SPORT_OPUS"){
						spoptOPUS.location=data.link;
					}else if(product == "LIVE_ALLBET"){
						liveAllBet.location=data.link;
					}else if(product == "SLOTS_MG"){
						electroicMG.location=data.link;
					}
				} else {
					if (product == 'LIVE_IG') {
						liveIG.close();
					} else if (product == 'LIVE_LMG') {
						liveLMG.close();
					} else if (product == 'LIVE_DS') {
						liveDS.close();
					} else if (product == 'LIVE_CG88') {
						liveCG88.close();
					} else if (product == 'LIVE_AG') {
						liveAG.close();
					} else if (product == 'FISH_AG') {
						electroicAGByw.close();
					} else if (product == 'SLOTS_AG') {
						electroicAG.close();
					} else if (product == 'LIVE_OG') {
						liveOG.close();
					}else if(product == 'LIVE_BBIN'){
						liveBBIN.close();
					}else if(product == "SLOTS_BBIN"){
						electroicBBIN.close();
					}else if(product == "SLOTS_YY"){
						electroicYY.close();
					}else if(product == "FISH_GG"){
						fishGG.close();
					}else if(product == "IG_HALL"){
						IGHall.close();
					}else if(product == "LIVE_OPUS"){
						liveOPUS.close();
					}else if(product == "SPORT_OPUS"){
						spoptOPUS.close();
					}else if(product == "LIVE_ALLBET"){
						liveAllBet.close();
					}else if(product == "LOTTERY_DS"){
						if(ishttps){
							lotteryDS.close();
						}
					}else if(product == "SLOTS_MG"){
						electroicMG.close();
					}
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageJustClose(l_playGame['msg4']);
					} else if(data.message == 'STATUS_NO_OPEN') {
						JqueryShowMessage(l_playGame['msg3']);
					} else if(data.message == 'USER_CLOSE') {
						JqueryShowMessage(l_playGame['msg2']);
					} else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessage(l_basic['tryAgain']);
					} else if(data.message == 'PRODUCT_NO_EXISTS') {
						JqueryShowMessageHome(l_playGame['msg6']);
					} else if(data.message == 'PRODUCT_MAINTENACE') {
						JqueryShowMessageHome(data.msg);
					} else if(data.message == 'GAME_MAINTENANCE') {
						JqueryShowMessageHome(l_playGame['msg8']);
					} else if(data.message == 'M8_WEI_HUI') {
						JqueryShowMessageHome(l_playGame['msg7']);
					} else if(data.message == 'M8_INVALID_USERNAME') {
						JqueryShowMessageHome(l_basic['tryAgain']);
					} else{
						JqueryShowMessageReload(data.message);
					}
					$("#maskDiv").hide();
				}
			}
		},
		error : function(xmlhttprequest, error) {
			if (product == 'LIVE_IG') {
				liveIG.close();
			} else if (product == 'LIVE_LMG') {
				liveLMG.close();
			} else if (product == 'LIVE_DS') {
				liveDS.close();
			} else if (product == 'LIVE_CG88') {
				liveCG88.close();
			} else if (product == 'LIVE_AG') {
				liveAG.close();
			} else if (product == 'FISH_AG') {
				electroicAGByw.close();
			} else if (product == 'SLOTS_AG') {
				electroicAG.close();
			} else if (product == 'LIVE_OG') {
				liveOG.close();
			} else if(product == 'LIVE_BBIN'){
			 	liveBBIN.close();
			} else if(product == "SLOTS_BBIN"){
				electroicBBIN.close();
			} else if(product == "SLOTS_YY"){
				electroicYY.close();
			} else if(product == "FISH_GG"){
				fishGG.close();
			}else if(product == "IG_HALL"){
				IGHall.close();
			}else if(product == "LIVE_OPUS"){
				liveOPUS.close();
			}else if(product == "SPORT_OPUS"){
				spoptOPUS.close();
			}else if(product == "LIVE_ALLBET"){
				liveAllBet.close();
			}else if(product == "LOTTERY_DS"){
				if(ishttps){
					lotteryDS.close();
				}
			} else if(product == "SLOTS_MG"){
				electroicMG.close();
			}
			JqueryShowMessage(l_basic['tryAgain']);
		},
		complete : function() {
		}
	});
}
function playGameSlots(product,slotsGameId){
	
	var iHeight = screen.height-70;
	var iWidth = screen.width-10;
	var newWindow = slotsGameId;
	
	var o = {
			product:product,
			slotsGameId:slotsGameId
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/playHoldem?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			/*if(product == 'SLOTS'){
				$("#maskDiv").show();
			}*/
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(product == 'SLOTS' || product == 'SLOTS_PT' || product == 'SLOTS_SPADE'){
						window.open(data.link,newWindow,"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no");
					}
				} else {
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageHome(l_playGame['msg4']);
					} else if(data.message == 'STATUS_NO_OPEN') {
						JqueryShowMessageJustClose(l_playGame['msg3']);
					}else if(data.message == 'USER_CLOSE') {
						JqueryShowMessageJustClose(l_playGame['msg2']);
					} else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessageJustClose(l_basic['tryAgain']);
					}else if(data.message == 'PRODUCT_NO_EXISTS') {
						JqueryShowMessageJustClose(l_playGame['msg6']);
					}else if(data.message == 'PRODUCT_MAINTENACE') {
						JqueryShowMessageJustClose(data.msg);
					}else if(data.message == 'GAME_MAINTENANCE') {
						JqueryShowMessageHome(l_playGame['msg8']);
					}
					$("#maskDiv").hide();
				}
			}
		},
		error : function(xmlhttprequest, error) {
			JqueryShowMessage(l_basic['tryAgain']);
		},
		complete : function() {
		}
	});
}

function playGameMobile(product,type,line){
//	var iHeight = screen.height-70;
//	var iWidth = screen.width-10;
	var iHeight = screen.height-70;
	var iWidth = screen.width-10;
//	var LOTTERY_DS = null;
//	if(product == "LOTTERY_DS"){
//		LOTTERY_DS = window.open("",'LotteryDScashWindow',"height="+iHeight+",width="+iWidth+",toolbar=no,resizable=yes,menubar=no,scrollbars=no,location=no, status=no"); 
//	}
	var o = {
		product:product,
		type:type+"",
		line:line+""
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/playHoldem?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
//				$("#maskDiv").show();
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(product == 'LIVE_IG'){
						window.open(data.link,"_blank");
					}else if(product == 'LOTTO_IG'){
						window.open(data.link,"_self");
					}else if(product == 'LOTTERY_IG'){
						window.open(data.link,"_self");
					}else if(product == 'SPORT'){
						window.open(data.link,"_blank");
					}else if(product == 'LOTTERY_DS'){
						window.open(data.link,"_blank");
					}else if(product == "FISH_GG"){
						$("#maskDiv").show();
						$("#fishGgiframe").attr("src",data.link);
					}else if(product == "SLOTS_YY"){
						$("#maskDiv").show();
						$("#fishYyiframe").attr("src",data.link);
					}
				} else {
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageHome(l_playGame['msg4']);
					} else if(data.message == 'PRODUCT_MAINTENACE') {
						JqueryShowMessageReloadandOK(data.msg);
					}else if(data.message == 'STATUS_NO_OPEN') {
						JqueryShowMessageReloadandOK(l_playGame['msg3']);
					}else if(data.message == 'USER_CLOSE') {
						JqueryShowMessageReloadandOK(l_playGame['msg2']);
					}else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessageReloadandOK(l_basic['tryAgain']);
					}else if(data.message == 'NO_CNY') {
						JqueryShowMessageReloadandOK(l_login['msg11']);
					}else if(data.message == 'PRODUCT_NO_EXISTS') {
						JqueryShowMessageHome(l_playGame['msg6']);
					}
				}
				$("#maskDiv").hide();
			}
		},
		error : function(xmlhttprequest, error) {
			JqueryShowMessageReloadandOK(l_basic['tryAgain']);
			$("#maskDiv").hide();
		},
		complete : function() {
		}
	});
}

function changeLoginCode() {
    $('#checkLoginCodeImage').hide().attr('src', $("#path").val()+'/app/checkCode/image?' + Math.floor(Math.random()*100) ).fadeIn();  
    event.cancelBubble=true;  
} 

function changeLoginCode2() {
    $('#checkLoginCodeImage2').hide().attr('src', $("#path").val()+'/app/checkCode/image?' + Math.floor(Math.random()*100) ).fadeIn();  
    event.cancelBubble=true;  
} 


function logoutSubmit(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/logout",
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
//					 location.reload();
					location.href="home";
				} else {
					if(data.message == 'SESSION_EXPIRED') {
//						JqueryShowMessageHome(l_basic['sessionExpired']);
//						location.reload();
						location.href="home";
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

/*function changeLanguage(language) {
	var o = {
			language:languageType
	};
	var jsonuserinfo = $.toJSON(o);
	var url = $("#path").val() + "/app/changeLanguage";
	$.ajax({
		type : "post",
		url : url,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:true, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
		},
		success : function(data) {
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
			location.reload();
		}
	});
}*/
function changeLanguage(languageType){
	var o = {
		language:languageType
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/changeLanguage?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:false,
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(data.isLogin){
						location.href = "http://juyou1989.com/cscpLoginWeb/scripts/home?l=0";
					}else{
						location.href = "home";
					}
				} else {
					JqueryShowMessage(l_language['msg1']);
					changeLoginCode();
				}
			}
		},
		error : function(xmlhttprequest, error) {
			JqueryShowMessage(l_basic['tryAgain']);
		},
		complete : function() {
		}
	});
}
function loginFormSubmit2(){
	var txtLoginUsername =  $("#txtLoginUsername2");
	var txtLoginPassword = $("#txtLoginPassword2");
	var txtLoginCaptcha = $("#txtLoginCode2");
	if(txtLoginUsername.val().length < 1 ||txtLoginUsername.val()==l_basic["username"]) {
		JqueryShowMessage(l_login['msg1']);
		return false;
	} else if(txtLoginPassword.val().length < 1) {
		JqueryShowMessage(l_login['msg2']);
		return false;
	} else if(txtLoginCaptcha.val().length != 4) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	} else if(txtLoginUsername.val().length < 3 || !patrnName.exec(txtLoginUsername.val())) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(txtLoginPassword.val().length < 6) {
		JqueryShowMessage(l_login['msg3']);
		return false;
	} else if(!patrnZhengInt.exec(txtLoginCaptcha.val())) {
		JqueryShowMessage(l_login['msg4']);
		return false;
	}
	
	  var o = {
				txtLoginCaptcha:txtLoginCaptcha.val(),
				txtLoginUsername:txtLoginUsername.val(),
				txtLoginPassword:txtLoginPassword.val()
			};
			
			var jsonuserinfo = $.toJSON(o);
			$.ajax({
				type : "post",
				url : $("#path").val() + "/app/loginVerification?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async:false, 
				timeout : 50000,
				beforeSend : function(xmlhttprequest) {
					$("#loginBtn2").val("登录中..");
				},
				success : function(data) {
					if (data) {
						if(data.success == true) {
							for(var i = 0; i < data.annLoginList.length; i++) {
								alert(data.annLoginList[i]);
							}
							var page = $("#page").val();
							var joinPage ="";
							if(null!=$("#joinPage").val()){
							 joinPage= $("#joinPage").val();
							}
							if( (page == "home" || page == "registration") && joinPage == ""){
								location.href="http://juyou1989.com/cscpLoginWeb/scripts/home?l=0"; 
							} else if(joinPage){
								location.href=joinPage; 
							}else {
								location.reload();
							}
						} else {
							$("#loginBtn2").val("登录");
							if(data.message == 'CHECK_CODE') {
								JqueryShowMessage(l_login['msg4']);
							} else if(data.message == 'USERNAME_OR_PASSWORD') {
								JqueryShowMessage(l_login['msg3']);
							} else if(data.message == 'IP_ERROR') {
								JqueryShowMessage(l_login['msg8']);
							} else if(data.message == 'LOGIN_IP_BLOCK') {
								JqueryShowMessage(l_login['msg5']);
							} else if(data.message == 'USER_CLOSE') {
								JqueryShowMessage(l_login['msg6']);
							} else if(data.message == 'PASSWORD_LOCK') {
								JqueryShowMessage(l_login['msg7']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['tryAgain']);
							} else if(data.message == 'LOGIN_ERROR_COUNT') {
								JqueryShowMessage(l_basic['countError']);
							} else if(data.message == 'LOGIN_ERROR_COUNT_SIX') {
								JqueryShowMessage(l_basic['countErrorSix']);
							}
//							changeLoginCode();
						}
					}
				},
				error : function(xmlhttprequest, error) {
					JqueryShowMessage(l_basic['tryAgain']);
					$("#loginBtn2").val("登录");
				},
				complete : function() {
				}
			});
	
}

function ShowMessage(){
	JqueryShowMessage(l_playGame['msg5']);
	
}

function c_loadingMak(pram){
	if(pram == 'lotto'){
		$("#lottoiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'lottery') {
		$("#lotteryiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'ffc') {
		$("#ffciframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'sport') {
		$("#sportiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'seven') {
		$("#seveniframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'livelmg') {
		$("#livelmgiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'liveds') {
		$("#livedsiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'livecg') {
		$("#livecgiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'liveag') {
		$("#liveagiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'livebbin') {
		$("#liveagiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'gameyy') {
		$("#gameyyiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'gamesg') {
		$("#gamesgiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'fishinggg') {
		$("#fishingggiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'fishinggg') {
		$("#fishingyyiframe").show();
		$("#maskDiv").hide();
	}else if (pram == 'ighall') {
		$("#ighalliframe").show();
		$("#maskDiv").hide();
	}
}


//function closeSession(){
//	var o = {
//	};
//	var jsonuserinfo = $.toJSON(o);
//	$.ajax({
//		type : "post",
//		url : $("#path").val() + "/app/closeSession",
//		data : jsonuserinfo,
//		contentType : 'application/json',
//		dataType : "json",
//		async:false, 
//		timeout : 50000,
//		beforeSend : function(xmlhttprequest) {
//		},
//		success : function(data) {
//			
//		},
//		error : function(xmlhttprequest, error) {
//		},
//		complete : function() {
//		}
//	});
//
//}

//
//var chioces = false;
//window.onbeforeunload = function() {
//
//	    if(event.clientX<=0 && event.clientY<0) {  
//	        alert("关闭");  
//	    }  
//	    else
//	    {  
//	        alert("刷新或离开");  
//	    }  
//
//}
//
//	window.onunloadok = function() {
//		//logoutSubmit();
//	//clearTimeout(_t);
//	//alert("取消了离开，就对页面做刷新");
//	};

//var coordinatesX,coordinatesY;
//function xy(e) {
//	var e = e || window.event ;
//	coordinatesX = e.screenX;
//	coordinatesY = e.screenY;
//	$("#ys").val(coordinatesY);
//	//alert(coordinatesY);
//	}

function changePasswordTextYd(){
	$("#txtLoginPasswordText").hide();
	$("#txtLoginPassword").show();
	$('#txtLoginPassword').focus();
	$("#txtLoginPassword").addClass("txtLoginPasswordhover");
}

function changePasswordYd(){
	if($('#txtLoginPassword').val() == '') {
		$("#txtLoginPasswordText").show();
		$("#txtLoginPassword").hide();
		$("#txtLoginPasswordText").val(l_basic['password']);
		$("#txtLoginPassword").removeClass("txtLoginPasswordhover");
	}
}

function changeCodeNullYd(value){
	if(value == "Captcha"){
		$("#txtLoginCode").val("");
	}
	$("#txtLoginCode").addClass("txtLoginCodehover");
}

function changeCodeYd(value){
	if(value == ""){
		$("#txtLoginCode").val("Captcha");
		$("#txtLoginCode").removeClass("txtLoginCodehover");
	}
}
function changeNullYd(thisObj,msg){
	 if(msg=='username'){
		 if (thisObj.value==l_basic['username']){
			 thisObj.value='';
			}
	 }else if(msg=='password'){
//		 if (thisObj.value==l_login['msg9']){
//			 $("#txtLoginPasswordText").hide();
//			 $("#txtLoginPassword").show();
//			}else if(thisObj.value==''){
//				$("#txtLoginPasswordText").show();
//				 $("#txtLoginPassword").hide();
//			}
	 } else if(msg=='code'){
		 if (thisObj.value==l_basic['code']){
			 thisObj.value='';
			}
	 }
	 $("#txtLoginUsername").addClass("txtLoginUsernamehover");
	 $("#txtLoginUsername").removeClass("txtLoginUsername");
}

function changeMessageYd(thisObj,msg){
	 if(msg=='username'){
		 if (thisObj.value==''){
			 thisObj.value=l_basic['username'];
			 $("#txtLoginUsername").removeClass("txtLoginUsernamehover");
			 $("#txtLoginUsername").addClass("txtLoginUsername");
			}
	 }else if(msg=='password'){
//		 if (thisObj.value==''){
//			 thisObj.value=l_login['msg9'];
//			}
	 } else if(msg=='code'){
		 if (thisObj.value==''){
			 thisObj.value=l_basic['code'];
			}
	 }
	 
}

function playGameLott(product,type,line){
	
	var iHeight = screen.height-70;
	var iWidth = screen.width-10;
	
	var o = {
			product:product,
			type:type+"",
			line:line+""
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/playHoldem?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:true, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
			if(product == 'LOTTO_IG'){
				$("#maskDiv").show();
				$("#lottoiframe").hide();
			}else if(product == 'LOTTERY_IG'){
				$("#maskDiv").show();
				$("#lotteryiframe").hide();
			}
		},
		success : function(data) {
			if (data) {
				if(data.success == true) {
					if(product == "LOTTERY_IG"){
						$("#maskDiv").show();
						$("#lotteryiframe").attr("src",data.link);
					}else if(product == "LOTTO_IG"){
						$("#maskDiv").show();
						$("#lottoiframe").attr("src",data.link);
					}
				} else {
					if(data.message == 'SESSION_EXPIRED') {
						JqueryShowMessageJustClose(l_playGame['msg4']);
					} else if(data.message == 'STATUS_NO_OPEN') {
						JqueryShowMessage(l_playGame['msg3']);
					} else if(data.message == 'USER_CLOSE') {
						JqueryShowMessage(l_playGame['msg2']);
					} else if(data.message == 'TRY_AGAIN') {
						JqueryShowMessage(l_basic['tryAgain']);
					} else if(data.message == 'PRODUCT_NO_EXISTS') {
						JqueryShowMessageHome(l_playGame['msg6']);
					} else if(data.message == 'PRODUCT_MAINTENACE') {
						JqueryShowMessageHome(data.msg);
					} else if(data.message == 'M8_WEI_HUI') {
						JqueryShowMessageHome(l_playGame['msg7']);
					} else if(data.message == 'M8_INVALID_USERNAME') {
						JqueryShowMessageHome(l_basic['tryAgain']);
					} else{
						JqueryShowMessageReload(data.message);
					}
					$("#maskDiv").hide();
				}
			}
		},
		error : function(xmlhttprequest, error) {
			JqueryShowMessage(l_basic['tryAgain']);
		},
		complete : function() {
		}
	});
}