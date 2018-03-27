function changeRegCode() {
    $('#checkRegCodeImage').hide().attr('src', $("#path").val()+'/app/checkCode/image?' + Math.floor(Math.random()*100) ).fadeIn();  
} 

function callUserName(field, rules, i, options){
    if (field.val().length > 2 && patrnName.exec(field.val()) && !checkUserName()) {
    	return "* " + l_register['msg1'];
    } 
}
function callUserNameAgent(field, rules, i, options){
    if (field.val().length > 2 && patrnName.exec(field.val()) && !checkUserNameAgent()) {
    	return "* " + l_register['msg1'];
    } 
}
function callUserNameAgent2(field, rules, i, options){
	if (field.val().length > 2 && patrnName.exec(field.val()) && !checkUserNameAgent2()) {
		return "* " + l_register['msg1'];
	} 
}
function callUserNameAgent3(field, rules, i, options){
	if (field.val().length > 2 && patrnName.exec(field.val()) && !checkUserNameAgent3()) {
		return "* " + l_register['msg1'];
	} 
}
function callEmail(field, rules, i, options){
    if (field.val().length > 4 && patrnEmail.exec(field.val()) && !checkEmail()) {
    	return "* " + l_register['msg2'];
    } 
}
function callEmail2(field, rules, i, options){
    if (field.val().length > 4 && patrnEmail.exec(field.val()) && !checkEmail2()) {
    	return "* " + l_register['msg2'];
    } 
}

function callCode(field, rules, i, options){
    if (field.val() != $("#register_code").val()) {
    	return "* " + l_register['msg3'];
    } 
}

function fixedSize(field, rules, i, options){
	if($("#txtWithdrawPassword").val().length != 6){
		return "* 请输入固定6位数";
	}
}

function callQQ(field, rules, i, options){
    if (field.val().length > 2 && patrnName.exec(field.val()) && !checkQqNumber()) {
    	return "* " + l_register['msg18'];
    } 
}

//function callPassword(field, rules, i, options){
//    if (!Pwd_Safety($("#txtPassword").val())) {
//    	return l_register['msg5'];
//    } 
//}

////判斷密碼是是否合法（合法返回True）
//var Num1='123456789';
//var Num2='987654321';
//var rex1=/[0-9]+/g;
//var rex2=/[a-z]+/g;
//function Pwd_Safety(t_PWD) { 
//    var PWD_Legality=true;
//    var t_PWD_str=t_PWD.toLowerCase();
//    
//    var resx1=/^[0-9]+$/g;
//    if (resx1.test(t_PWD_str)) PWD_Legality=false;
//    resx1=/^[a-z]+$/g;
//    if (resx1.test(t_PWD_str)) PWD_Legality=false;
//
//    var strs1=t_PWD_str.match(rex1);
//    if(strs1!=null){
//    for(var i=0;i<strs1.length;i++){
//     if(strs1[i].length>3){
//       if(Num1.indexOf(strs1[i])!=-1)
//         PWD_Legality=false;//数字顺序
//       if(Num2.indexOf(strs1[i])!=-1)
//         PWD_Legality=false;//数字倒序
//    }}}
//    strs1=t_PWD_str.match(rex2);
//    if(strs1!=null){
//    if(strs1.length==1){
//      if(strs1[0].length==1)    
//         PWD_Legality=false;}//只有一个字母
//    }
//
//    for(var i=0;i<t_PWD_str.length-2;i++){
//    if(t_PWD_str.charAt(i)==t_PWD_str.charAt(i+1)){
//     if(t_PWD_str.charAt(i)==t_PWD_str.charAt(i+2)){
//        PWD_Legality=false;
//    }}}
//
//    if (t_PWD=="123abc") PWD_Legality=false;
//    if (t_PWD=="abc123") PWD_Legality=false;
//
//    //if (PWD_Legality==false) alert(l_register['msg5']);
//    return PWD_Legality; 
//}


function callAccount(field, rules, i, options){
	/* if (!checkAccount()) {
	    	return "* " + l_register['msg11'];
	    } */
}

function checkAccount(){
	var isReturn = false;
	var o = {txtWithdrawAccountNumbert:$("#txtWithdrawAccountNumbert").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/accountNumber",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
}


function checkUserName() {
	var isReturn = false;
	var o = {userName:$("#txtUserName").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/userName",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
} 

function checkUserNameAgent(){
	var isReturn = false;
	var o = {userName:$("#txtUserName").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/userName?l=0",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;

}

function checkUserNameAgent2(){
	var isReturn = false;
	var o = {userName:$("#txtUserNameAgent").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/userName?l=0",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
	
}

function checkUserNameAgent3(){
	var isReturn = false;
	var o = {userName:$("#txtUserName2").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/userName?l=0",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
	
}


function checkEmail() {
	var isReturn = false;
	var o = {email:$("#txtEmail").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/email",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
} 

function checkEmail2() {
	var isReturn = false;
	var o = {email:$("#txtEmail2").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/email",
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
					if(data.message == '0') {
						isReturn = true;
					} 
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
} 


function signUpFormSubmit(form,status){
	if(status) {
		var o = {};
		var a = $("#signUpForm").serializeArray();
	    $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	    });
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/register/add",
			data : jsonuserinfo,
			contentType : 'application/json',
			dataType : "json",
			async:false, 
			timeout : 50000,
			beforeSend : function(xmlhttprequest) {
				$("#btn_registration").html(l_register['msg19']);
			},
			success : function(data) {
				if (data) {
					if(data.success == true) {
						JqueryShowMessageWithRedirect(l_register['msg4'],"home?l=0");
					} else {
						$("#btn_registration").html("确认");
						if(data.message == 'CHECK_CODE') {
							JqueryShowMessage(l_register['msg3']);
							changeRegCode();
						} else if(data.message == 'USERNAME_EXISTS') {
							JqueryShowMessage(l_register['msg1']);
						} else if(data.message == 'EMAIL_EXISTS') {
							JqueryShowMessage(l_register['msg2']);
						} else if(data.message == 'TRY_AGAIN') {
							JqueryShowMessage(l_basic['tryAgain']);
						}else if(data.message == 'REFERRAL_CODE_NOT_EXISTS') {
							JqueryShowMessage(l_register['msg10']);
						}else if(data.message == 'REFERRAL_CODE_ERROR') {
							JqueryShowMessage(l_register['msg16']);
						}
					}
				}
			},
			error : function(xmlhttprequest, error) {
				$("#submitting").hide();
				JqueryShowMessage(l_basic['tryAgain']);
			},
			complete : function() {
			}
		});
	} 
}
function checkQqNumber() {
	var isReturn = false;
	var o = {qq:$("#qq").val()};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/register/checkQQ",
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
					if(data.message == '0') {
						isReturn = true;
					}
				}else {
					isReturn = false;
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
	return isReturn;
} 


function signUpAgentFormSubmit(form,status){
	if(status) {
		var o = {};
		var a = $("#signUpAgentForm").serializeArray();
	    $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	    });
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/register/addAgent",
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
//						if(data.message == 'REFERRAL_CODE_ERROR'){
//							JqueryShowMessageWithRedirect(l_register['msg10'],"playGame");
//						}else{
//							JqueryShowMessageWithRedirect(l_register['msg15'],"agentInfo");
//						}
						location.href="agentInfo";
					} else {
						if(data.message == 'CHECK_CODE') {
							JqueryShowMessage(l_register['msg3']);
							changeRegCode();
						} else if(data.message == 'USERNAME_EXISTS') {
							JqueryShowMessage(l_register['msg1']);
						} else if(data.message == 'EMAIL_EXISTS') {
							JqueryShowMessage(l_register['msg2']);
						} else if(data.message == 'TRY_AGAIN') {
							JqueryShowMessage(l_basic['tryAgain']);
						}else if(data.message == 'ACCOUNTNUMBER_EXISTS') {
							JqueryShowMessage(l_register['msg11']);
						}
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
}

function signUpFormSubmitToFaqPlatform(form,status){
	if(status) {
		var o = {};
		var a = $("#signUpForm").serializeArray();
	    $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	    });
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/register/add",
			data : jsonuserinfo,
			contentType : 'application/json',
			dataType : "json",
			async:false, 
			timeout : 50000,
			beforeSend : function(xmlhttprequest) {
				$("#btn_registration").html(l_register['msg19']);
			},
			success : function(data) {
				if (data) {
					if(data.success == true) {
							JqueryShowMessageWithRedirect(l_register['msg4'],"platform");
					} else {
						$("#btn_registration").html("确认");
						if(data.message == 'CHECK_CODE') {
							JqueryShowMessage(l_register['msg3']);
							changeRegCode();
						} else if(data.message == 'USERNAME_EXISTS') {
							JqueryShowMessage(l_register['msg1']);
						} else if(data.message == 'EMAIL_EXISTS') {
							JqueryShowMessage(l_register['msg2']);
						} else if(data.message == 'TRY_AGAIN') {
							JqueryShowMessage(l_basic['tryAgain']);
						}else if(data.message == 'REFERRAL_CODE_NOT_EXISTS') {
							JqueryShowMessage(l_register['msg10']);
						}else if(data.message == 'REFERRAL_CODE_ERROR') {
							JqueryShowMessage(l_register['msg16']);
						}
					}
				}
			},
			error : function(xmlhttprequest, error) {
				$("#submitting").hide();
				JqueryShowMessage(l_basic['tryAgain']);
			},
			complete : function() {
			}
		});
	} 
}

function signUpAddBankFormSubmit(form,status){
	if(status) {
		var o = {};
		var a = $("#signUpForm").serializeArray();
	    $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	    });
		var jsonuserinfo = $.toJSON(o);
		$.ajax({
			type : "post",
			url : $("#path").val() + "/app/register/addAndBank",
			data : jsonuserinfo,
			contentType : 'application/json',
			dataType : "json",
			async:false, 
			timeout : 50000,
			beforeSend : function(xmlhttprequest) {
				$("#btn_registration").html(l_register['msg19']);
			},
			success : function(data) {
				if (data) {
					if(data.success == true) {
						JqueryShowMessageWithRedirect(l_register['msg4'],"home?l=0");
					} else {
						$("#btn_registration").html("确认");
						if(data.message == 'CHECK_CODE') {
							JqueryShowMessage(l_register['msg3']);
							changeRegCode();
						} else if(data.message == 'USERNAME_EXISTS') {
							JqueryShowMessage(l_register['msg1']);
						} else if(data.message == 'EMAIL_EXISTS') {
							JqueryShowMessage(l_register['msg2']);
						} else if(data.message == 'TRY_AGAIN') {
							JqueryShowMessage(l_basic['tryAgain']);
						}else if(data.message == 'REFERRAL_CODE_NOT_EXISTS') {
							JqueryShowMessage(l_register['msg10']);
						}else if(data.message == 'REFERRAL_CODE_ERROR') {
							JqueryShowMessage(l_register['msg16']);
						}
					}
				}
			},
			error : function(xmlhttprequest, error) {
				$("#submitting").hide();
				JqueryShowMessage(l_basic['tryAgain']);
			},
			complete : function() {
			}
		});
	} 
}