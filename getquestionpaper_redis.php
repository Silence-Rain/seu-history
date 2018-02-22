<?php

  if(!($_POST['ID'] > 0 && $_POST['ID'] <= 500)){
    die('请求错误！');
  }

  require_once('linktoredis.php');
  $r = linkToRedis();
  session_start();
  $ID = $_POST['ID'];
  if($r->get("$ID")){
    echo $r->get("$ID")[0];
    $_SESSION['ID'] = $ID;
    $_SESSION['cor_answer'] = $r->get("$ID")[1];
  }else{
    require_once('linktodb.php');
    $db = linkToDB();
    $q = "SELECT * FROM question WHERE ID = '".$ID."'";
    $result = mysqli_query($db, $q);
    $row = mysqli_fetch_assoc($result);
    $data = Array($row['content'], $row['answer']);
    $r->set($ID, $data, 0);
    echo $r->get("$ID")[0];
    $_SESSION['ID'] = $ID;
    $_SESSION['cor_answer'] = $r->get("$ID")[1];
  }
 ?>
