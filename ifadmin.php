<?php
  //管理员账号密码验证
  require_once('linktodb.php');
  header("Content-Type: application/json; charset = utf8");

  if(!@preg_match("/^(\d\d)[0-9A-Z]1(4|5)000$/", $_POST['num'])){
    die('账号格式错误！');
  }

  $num = $_POST['num'];
  $password = $_POST['password'];
  $rand = mt_rand();
  $db = linkToDB();

  $q = "SELECT * FROM admin WHERE num = '".$num."'";
  $result = mysqli_query($db, $q);
  $row = mysqli_fetch_assoc($result);
  if(!$result || $password != $row['password']){
    echo '{
      "res" : false,
      "reason" : "账号或密码错误！"
    }';
  }else{
    session_start();
    $_SESSION['num'] = $num;
    $_SESSION['rand'] = $rand;
    echo '{
      "res" : true,
      "msg" : '.$rand.'
    }';
  }

  mysqli_free_result($result);
  mysqli_close($db);
 ?>
