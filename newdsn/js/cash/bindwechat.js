
$(document).ready(function() {
	$("#bindwechat").click(function() {
		$("#popup-verifywechat").dialog({
			title: "绑定微信号",
			width: 620
		})
	});
	$("#editwechat").click(function() {
		$("#popup-verifywechat").dialog({
			title: "修改微信号",
			width: 620
		})
	})
});

function bindWechat() {
	$.get(bindMailorMobile, {
		type: 0,
		userwechat: $.trim($("#txtWechat").val())
	},
	function(a) {
		if (a.success) {
			if (typeof window.IS_MOBILE !== "undefined") {
				dialog.alert("消息", "验证成功， 绑定微信号成功！");
				return
			}
			dialog.alert("消息", "绑定微信号成功！", null, "/member/center/index")
		} else {
			dialog.error("消息", a.message)
		}
	})
};