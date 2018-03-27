
function showError() {
    dialog.error("\u6d88\u606f", "\u6682\u672a\u5f00\u901a\uff01");
    return ! 1
}
function getLastDay(a, b) {
    var c = (new Date((new Date(a, b, 1)).getTime() - 864E5)).getDate();
    return a + "-" + b + "-" + c
};