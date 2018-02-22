<?php
  //连接数据库&设定utf8格式函数
  function linkToDB(){
    $db = mysqli_connect('localhost', 'root', '123', 'seuhistory');
    mysqli_query($db, "SET NAMES utf8");
    return $db;
  }
 ?>
