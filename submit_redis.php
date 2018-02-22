<?php
  header("Content-Type: application/json; charset = utf8");
  session_start();
  if($_POST['stuNum'] != $_SESSION['stuNum']){
    die('请求错误！');
  }
  if(!($_POST['ID'] > 0 && $_POST['ID'] <= 500)){
    die('请求错误！');
  }

  $stuNum = $_SESSION['stuNum'];
  $ID = $_POST['ID'];
  $answer = $_POST['answer'];
  $cor_answer = json_decode($_SESSION['answer']);
  $score = 0;

  for($c = 0; $c < 40; $c+=2){
    if($answer[$c] == $cor_answer[$c/2]){
      $score += 4;
    }
  }
  for($j = 40; $j < 60; $j+=2){
    if($answer[$j] == $cor_answer[$j/2]){
      $score += 2;
    }
  }

  require_once('linktodb.php');
  $q = "UPDATE student SET score = '".$score."' WHERE stuNum = '".$stuNum."'";
  if(!mysqli_query($db, $q)){
    echo '{
      "res" : false,
      "reason" : "提交失败！"
    }';
  }else{
    setcookie('stuNum', $stuNum, time()+3600);
    setcookie('score', $score, time()+3600);
    echo'{
      "res" : true
    }';
  }

 ?>
