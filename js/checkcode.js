var code ; //在全局定义验证码
//产生验证码
window.onload = function(){
  createCode();
}

function validate(){
  var inputCode = document.getElementById('code').value;
  var result = document.getElementById("result");
  if(inputCode.length <=0){
    result.innerHTML = "验证码不能为空!";
    return false;
  }
  else if(inputCode != code){
    result.innerHTML = "验证码输入错误!";
    createCode();//刷新验证码
    return false;
  }else{
    return true;
  }
}

function createCode(){
  code = "";
  var codeLength = 4;//验证码的长度
  var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R',
  'S','T','U','V','W','X','Y','Z');//随机数
  for(var i = 0; i < codeLength; i++) {//循环操作
     var index = Math.floor(Math.random()*36);//取得随机数的索引（0~35）
     code += random[index];//根据索引取得随机数加到code上
 }
 document.getElementById("codeimg").value = code;//把code值赋给验证码
}
