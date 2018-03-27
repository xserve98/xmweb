


$(document).ready(function() {
	


	$("#bindmobile").click(function() {
		$('#popup-verifymobile').dialog({
			title : '绑定手机号码',
			width : 620
		});
	});

	$("#editmobile").click(function() {
		$('#popup-verifyeditmobile').dialog({
			title : '修改手机号码',
			width : 620
		});
	});

});





function editMobile() {
	var code = $.trim($('#txtMobileCode1').val());
	if (code == "") {
		dialog.error('消息', '验证码不能为空！');
		return false;
	}
	$("#btnEditMobile").attr("disabled", "disabled");
	$("#btnEditMobile").val("提交中，请等待...");
	$.get(editMailorMobile, {
		type : 0,
		usermobile : "",
		code : code
	}, function(res) {
		if (res.success) {
			if (typeof window.IS_MOBILE !== 'undefined') {
				dialog.alert('消息','验证成功， 请修改手机号码');
				window.location.href = "#/center/index/3/?";
				return;
			}
			$('#popup-verifyeditmobile').dialog('close');
			$('#popup-verifymobile').dialog({
				title : '绑定手机号码',
				width : 620
			});
		} else {
			dialog.error('消息', res.message);
			$("#btnEditMobile").removeAttr("disabled");
			$("#btnEditMobile").val("下一步");
		}
	});
}
