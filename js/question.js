var counter = 1;
var id;
var questionPaper = Array();
var answer = Array();
var stuNum = getCookie('stuNum');
var name = getCookie('name');

// 倒计时
var starttime = new Date().getTime();
var endtime = starttime + 1800000;
function showTime(){
  var lefttime = parseInt((endtime - new Date().getTime())/1000);
  var h = parseInt(lefttime/(60*60)%24);
  var m = parseInt(lefttime/60%60);
  var s = parseInt(lefttime%60);
  document.getElementById('time').innerHTML = h + "时" + m + "分" + s + "秒";
  if(lefttime == 0){
    submit();
    alert('答题结束');
  }
  setTimeout(showTime, 500);
}

function getID(){
  id = Math.ceil(Math.random()*500);
}

function getChooseQuestion(){
  document.getElementById('question').innerHTML = counter + "." + questionPaper[counter-1][0];
  document.getElementById('A').innerHTML = "A." + questionPaper[counter-1][1];
  document.getElementById('B').innerHTML = "B." + questionPaper[counter-1][2];
  document.getElementById('C').innerHTML = "C." + questionPaper[counter-1][3];
  document.getElementById('D').innerHTML = "D." + questionPaper[counter-1][4];
}

function getJudgeQuestion(){
  document.getElementById('question').innerHTML = counter + "." + questionPaper[counter-1][0];
  document.getElementById('A').innerHTML = "正确";
  document.getElementById('B').innerHTML = "错误";
}

function record(){
  var opt = document.getElementsByName('option');
  for(var i = 0; i < 4; i++){
    if(opt[i].checked){
      answer[counter-1] = opt[i].value;
      if(counter <= 20){
        switch (opt[i].value) {
          case '1':document.getElementById(counter).innerHTML = 'A';break;
          case '2':document.getElementById(counter).innerHTML = 'B';break;
          case '3':document.getElementById(counter).innerHTML = 'C';break;
          case '4':document.getElementById(counter).innerHTML = 'D';break;
        }
      }else{
        switch (opt[i].value) {
          case '1':document.getElementById(counter).innerHTML = '正确';break;
          case '0':document.getElementById(counter).innerHTML = '错误';break;
        }
      }
      opt[i].checked = "";
    }
  }
}

function submit(){
  alert('答题结束！');
  var request = ajax();
  request.open("POST", "submit.php");
  var data = "stuNum=" + stuNum + "&ID=" + id + "&answer=" + answer;
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(data);
  request.onreadystatechange = function(){
    if(request.readyState === 4){
      if(request.status === 200){
        var response = JSON.parse(request.responseText);
        if(response.res == true){
          window.location.href = "score.php";
        }else{
          alert('response.reason');
        }
      }else{
        alert("发生错误：" + request.status);
      }
    }
  }
}

function getQuestionPaper(){
  var request = ajax();
  request.open("POST", "getQuestionPaper.php");
  var data = "ID=" + id;
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(data);
  request.onreadystatechange = function(){
    if(request.readyState === 4){
      if(request.status === 200){
        questionPaper = JSON.parse(request.responseText);
        getChooseQuestion();
      }else{
        alert("发生错误：" + request.status);
      }
    }
  }
}

document.getElementById('latter').onclick = function(){
  record();
  if(counter == 30){
    if(confirm('确定交卷吗？')){
      submit();
    }
  }else{
    counter++;
    if(counter == 21){
       document.getElementsByName('option')[1].value = "0";
       document.getElementById('optionC').style.display = "none";
       document.getElementById('optionD').style.display = "none";
       getJudgeQuestion();
    }else if(counter <= 20){
      getChooseQuestion();
    }else if(counter <= 30){
      getJudgeQuestion();
    }
  }
}

document.getElementById('former').onclick = function(){
  record();
  if(counter == 1){
    alert('已是第一题！');
  }else{
    counter--;
    if(counter == 20){
      document.getElementsByName('option')[1].value = "2";
      document.getElementById('optionC').style.display = "";
      document.getElementById('optionD').style.display = "";
      getChooseQuestion();
    }else if(counter < 20){
      getChooseQuestion();
    }else if(counter < 30){
      getJudgeQuestion();
    }
  }

}

window.onload = function(){
  document.getElementById('welname').innerHTML = "欢迎 " + name + " 同学";
  document.getElementById('welstuNum').innerHTML = "学号：" + stuNum;
  getID();
  getQuestionPaper();
  showTime();
}
