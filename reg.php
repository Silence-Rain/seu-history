<?php
  //注册学号、一卡通号验证及写入命令
  require_once('linktodb.php');
  header("Content-Type: application/json; charset = utf8");
  $db = linkToDB();

  if(!@preg_match("/^(\d\d)[0-9A-Z]1(4|5)\d(\d\d)$/", $_POST['stuNum'])){
    die("学号格式错误");
  }else if(!@preg_match("/^2131(4|5)\d\d\d\d$/", $_POST['ID'])){
    die("一卡通号格式错误");
  }

  $stuNum = $_POST['stuNum'];
  $ID = $_POST['ID'];
  $name = $_POST['name'];

  $p = "SELECT * FROM student WHERE stuNum = '".$stuNum."'";
  $result = mysqli_query($db, $p);
  $rownum = mysqli_num_rows($result);
  if($rownum){
    echo '{
        "res" : false,
        "reason" : "该学号对应考生已存在！"
    }';
  }else{
    $q = "INSERT INTO student(stuNum, ID, name) values ('$stuNum', '$ID', '$name')";
    if(mysqli_query($db, $q)){
      echo '{
          "res" : true,
          "reason" : "注册成功！"
      }';
    }else{
      echo '{
          "res" : false,
          "reason" : "未知错误, 注册失败！"
      }';
    }
  }

  mysqli_free_result($result);
  mysqli_close($db);
  unset($_COOKIE);
?>
