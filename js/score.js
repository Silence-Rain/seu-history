var stuNum = getCookie('stuNum');
var name = getCookie('name');

window.onload = function(){
  document.getElementById('welname').innerHTML = "您好，" + name + "同学";
  showTime();
}
// 倒计时
var starttime = new Date().getTime();
var endtime = starttime + 30000;
function showTime(){
  var lefttime = parseInt((endtime - new Date().getTime())/1000);
  var h = parseInt(lefttime/(60*60)%24);
  var m = parseInt(lefttime/60%60);
  var s = parseInt(lefttime%60);
  document.getElementById('time').innerHTML = h + "时" + m + "分" + s + "秒";
  setTimeout(showTime, 500);
  if(lefttime == 0){
    cleanCookie();
    window.location.href="logout.php";
  }
}

document.getElementById('logout').onclick = function(){
  cleanCookie();
  window.location.href="logout.php";
}
