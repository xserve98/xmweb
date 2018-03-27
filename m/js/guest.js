var domainConfig={
	"gameUrl":'',
}
function guestLogin() {
    /*if (!domainConfig.gameUrl) {
        alert("无法登录游客系统，请联系管理员");
        return
    }*/
    $.ajax({
        type: "POST",
        url: domainConfig.gameUrl + "/api/guestLogin.do",
        data: {
            username: "!guest!",
            password: "!guest!"
        },
        dataType: "text",
        success: function(a) {
            if (a=='ok') {
                window.location.href = domainConfig.gameUrl + "/"
            } else {
                alert(a || "登录失败");
				return false;
            }
        },
        error: function(a) {
            alert("登录失败");
			return false;
        }
    })
}
