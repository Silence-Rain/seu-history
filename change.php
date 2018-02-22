<?php
  session_start();

  if($_SESSION['rand'] != $_COOKIE['rand']){
    die('请求错误！');
  }

  $name = $_POST['name'];
  $stuNum = $_POST['stuNum'];
  $ID = $_POST['ID'];

  require_once('linktodb.php');
  $db = linkToDB();
  //修改如不修改某一项，输入原值
  //这里提交将会修改两个值
  $q1 = "UPDATE student SET stuNum = '".$stuNum."' WHERE name = '".$name."'";
  $q2 = "UPDATE student SET ID = '".$ID."' WHERE name = '".$name."'";

  $rand = mt_rand();

  if(mysqli_query($db, $q1) && mysqli_query($db, $q2)){
    echo '{
      "res" : true,
      "reason" : "修改成功！",
      "msg" : '.$rand.'
    }';
  }else{
    echo '{
      "res" : false.
      "reason" : "修改失败！"
    }';
  }

  mysqli_close($db);
  unset($_COOKIE);
  $_SESSION['rand'] = $rand;
 ?>
