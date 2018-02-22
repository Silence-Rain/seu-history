<?php
  header("Content-Type: application/json; charset = utf8");

  require_once('linktodb.php');
  $db = linkToDB();

  $NforChoose = 20;
  $NforJudge = 10;
  $arrC = Array();
  $arrJ = Array();
  $idC = Array();//最后的选择题数组
  $idJ = Array();//最后的判断题数组

  for($a = 1; $a <= $NforChoose; $a++){$arrC[$a] = $a;}
  for($b = 1; $b <= $NforChoose; $b++){$arrJ[$b] = $b;}

  for($i = 0; $i < 500; $i++){//500套题的循环
    $ID = $i + 1;
    //打乱数组顺序，组成id号
    shuffle($arrC);
    shuffle($arrJ);
    for($a = 0; $a < 20; $a++){$idC[$a] = $arrC[$a];}
    for($b = 0; $b < 10; $b++){$idJ[$b] = $arrJ[$b];}
    //通过id数组组成套题的json字符串
    $content = '[';
    $answer = '[';
    for($c = 0; $c < 20; $c++){
      $qChoose = "SELECT * FROM choose WHERE ID = '".$idC[$c]."'";
      $resultC = mysqli_query($db, $qChoose);
      $rowC = mysqli_fetch_assoc($resultC);
      $content .='["'.$rowC["content"].'",
        "'.$rowC["optionA"].'",
        "'.$rowC["optionB"].'",
        "'.$rowC["optionC"].'",
        "'.$rowC["optionD"].'"],';
      $answer .=''.$rowC["answer"].',';
      mysqli_free_result($resultC);
    }
    for($j = 0; $j < 10; $j++){
      $qJudge = "SELECT * FROM judge WHERE ID = '".$idJ[$j]."'";
      $resultJ = mysqli_query($db, $qJudge);
      $rowJ = mysqli_fetch_assoc($resultJ);
      $content .= ($j == 9?'["'.$rowJ["content"].'"]':'["'.$rowJ["content"].'"],');
      $j == 9?$answer .=''.$rowJ["answer"]:$answer .=''.$rowJ["answer"].',';
      mysqli_free_result($resultJ);
    }
    $content.=']';
    $answer.=']';
    $insert = "INSERT INTO question(ID, content, answer) values ('$ID', '$content', '$answer')";
    mysqli_query($db, $insert);
  }
  echo "创建成功！";
  mysqli_close($db);
 ?>
