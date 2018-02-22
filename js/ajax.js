function ajax(){
  if(window.ActiveXObject){
    var request = new ActiveXObject("Microsoft.XMLHttp");
  }else if(window.XMLHttpRequest){
    var request = new XMLHttpRequest();
  }else{
    alert("浏览器不支持Ajax!");
  }
    return request;
  }
