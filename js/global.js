var isIE = (document.all) ? true : false;
var isLessIE6 = isIE && parseInt((navigator.appVersion.split(';'))[1].replace(/[ ]/g,'').match(/\d(\.)?/g).join(""))<=6;