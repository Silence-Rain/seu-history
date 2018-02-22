<?php
  if(!($_POST['ID'] > 0 && $_POST['ID'] <= 500)){
    die('请求错误！');
  }

  $ID = $_POST['ID'];
  require_once('linktodb.php');
  $db = linkToDB();
  $q = "SELECT * FROM question WHERE ID = '".$ID."'";
  $result = mysqli_query($db, $q);
  $row = mysqli_fetch_assoc($result);
  echo $row['content'];
 ?>
