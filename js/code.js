window.onload = function(){
  changeCode();
}

function changeCode(){
  document.getElementById('codeimg').src="createcode.php?r="+Math.random();
}
