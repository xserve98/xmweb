$(document).ready(function() {
    $(".records tr:even").addClass("trcolor")
});
var updateUers = "/member/usersave.php";


function bandName() {
    var c = $("#userName").val();
    var a = $("#birthDay").val();
    var b = $("#sex option:selected").val();
    if (c == "") {
        dialog.error("消息", "姓名不能为空！");
        $("#birthDay").focus();
        return
    }
    if (a == "") {
        dialog.error("消息", "出生年月不能为空！");
        $("#birthDay").focus();
        return
    }
    if (!confirm("是否确定进行该操作？")) {
        return
    }
    $.ajax({
        url: updateUers,
        type: "POST",
        loading: true,
        data: {
            userName: c,
            birthDay: a,
            sex: b
        },
        success: function(d) {
			var json = eval('(' + d + ')'); 
			///console.log(json);
			///console.log(json.success);///console.log(json['success']);
            if (json.success=='True') {
                dialog.alert("消息", "保存成功！", null, "/member/userinfo.php")
            } else {
                dialog.error("消息", "绑定失败！")
            }
        }
    })
}


function saveAddress() {
    if (!confirm("是否确定进行该操作？")) {
        return
    }
    var d = $("#txtCity").val();
    var e = $("#txtStreet").val();
    var b = $("#txtConsignee").val();
    var c = $("#txtMobil").val();
    var a = d + "|" + e + "|" + b + "|" + c;
    $.ajax({
        url: updateUers,
        type: "POST",
        loading: true,
        data: {
            address: a
        },
        success: function(f) {
            if (f.success) {
                dialog.alert("消息", "恭喜，保存成功！", null, "/member/center/index")
            } else {
                dialog.error("消息", "保存失败！")
            }
        }
    })
}
function check(d, c, b) {
    for (var e = 0,
    a = c.length - b; e <= a; e++) {
        if (d.indexOf(c.substr(e, b)) != -1) {
            return false
        }
    }
    return true
}
function testPassword(a) {
    if (!check(a, "123456789", 4)) {
        return true
    }
    if (!check(a, "987654321", 4)) {
        return true
    }
    if (/^[a-z]+$/.test(a) || /^[0-9]+$/.test(a)) {
        return true
    }
    return false
}
function showMsg(a) {
    if (parent && parent != window && parent.showMsg) {
        dialog.error("消息提示", a)
    } else {
        alert(a)
    }
}
function changePassword() {
    var a = $("#oldPassword").val();
    var c = $(".popupinternal input[name=password]").val();
    var b = $("#ckPassword").val();
    if (a.length == 0) {
        showMsg("请输入原始密码！");
        $("#oldPassword").focus();
        return
    }
    if (c != b) {
        showMsg("新设密码 和 新设密码确认 不一样！(确认大小写是否相同)");
        $("#ckPassword").focus();
        return
    }
    if (!confirm("是否确定要修改密码？")) {
        return
    }
    $.post("/member/changePassword", {
        oldPassword: a,
        password: c
    },
    function(d) {
        if (d) {
            dialog.alert("消息", "密码修改成功！", null, centerIndex)
        } else {
            showMsg("原密码输入错误，请重新输入");
            $("#oldPassword").focus()
        }
    })
}
function queryTran() {
    var a = "transfer?";
    a += "begin=" + $("#begin").val() + "&end=" + $("#end").val();
    a += "&transtype=" + $("#transtype").val() + "&accept=" + $("#accept").val();
    a += "&keyword=" + $("#keyword").val();
    location.href = a
};