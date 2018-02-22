<?php
  //考生账号密码验证
  header("Content-Type: application/json; charset = utf8");
  require_once('linktodb.php');

  if(!@preg_match("/^(\d\d)[0-9A-Z]1(4|5)\d(\d\d)$/", $_POST['stuNum']) || !@preg_match("/^2131(4|5)\d\d\d\d$/", $_POST['ID'])){
    die('学号或一卡通号格式错误！');
  }

  session_start();
  $stuNum = $_POST['stuNum'];
  $ID = $_POST['ID'];
  $input = $_POST['input'];
  $rand = mt_rand();

  $db = linkToDB();
  $q = "SELECT * FROM student WHERE stuNum = '".$stuNum."'";
  $result = mysqli_query($db, $q);
  $row = mysqli_fetch_assoc($result);
  if($stuNum == null){
    echo '{
        "res" : false,
        "reason" : "学号不能为空！"
    }';
  }else if($ID == null){
    echo '{
        "res" : false,
        "reason" : "密码不能为空！"
    }';
  }else if(!$result || $ID != $row['ID']){
    echo '{
        "res" : false,
        "reason" : "学号或密码错误！"
    }';
  }else if($_SESSION['authcode'] != $input){
    echo '{
        "res" : false,
        "reason" : "验证码错误！"
    }';
  }else{
    $_SESSION['stuNum'] = $stuNum;
    $_SESSION['rand'] = $rand;
    setcookie('stuNum', $stuNum, time()+3600);
    setcookie('name', $row['name'], time()+3600);
    setcookie('rand', $rand, time()+3600);
    if($row["score"] === null){
      echo '{
          "res" : true,
          "stuNum" : "'.$stuNum.'",
          "name" : "'.$row["name"].'",
          "score" : -1
      }';
    }else{
      setcookie('score', $row['score'], time()+3600);
      echo '{
          "res" : true,
          "stuNum" : "'.$stuNum.'",
          "name" : "'.$row["name"].'",
          "score" : '.$row["score"].'
      }';
    }
  }

  mysqli_free_result($result);
  mysqli_close($db);

 ?>
