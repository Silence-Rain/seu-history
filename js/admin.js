document.getElementById("num").onblur = function(){
  var re = /^(\d\d)[0-9A-Z]1(4|5)000$/;
  document.getElementById('result').innerHTML = re.test(document.getElementById('num').value)?"":"账号格式错误！";
}

document.getElementById('adminlogin').onclick = function(){
  var request = ajax();
  request.open("POST", "ifadmin.php");
  var data = "num=" + document.getElementById("num").value + "&password=" + document.getElementById("password").value;
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(data);
  request.onreadystatechange = function(){
    if(request.readyState === 4){
      if(request.status === 200){
        var response = JSON.parse(request.responseText);
        if(response.res == true){
          setCookie('rand', response.msg, new Date().getTime()+3600);
          window.location.href='admin.php';
        }else{
          document.getElementById("result").innerHTML = response.reason;
        }
      }else{
        alert("发生错误：" + request.status);
      }
    }
  }
}
