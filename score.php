<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>查分界面</title>
    <link href="css/score.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  	<div class="logo">
  		<img src="images/adminLogo.png" height="130">
	</div>
    <div class="box">
    <div class="inner">
      <p id="welname"></p><br/><hr/><br/>
      <p>答题已结束</p><br/>
    <?php
      //查分
      session_start();
      if(!$_SESSION['stuNum'] || $_SESSION['stuNum'] != $_COOKIE['stuNum']){
        die('请求错误！');
      }
      if($_SESSION['rand'] != $_COOKIE['rand']){
        die('请求错误！');
      }
      $stuNum = $_SESSION['stuNum'];

      require_once('linktodb.php');
			$db = linkToDB();
			$q = "SELECT * FROM student WHERE stuNum = '".$stuNum."'";
		  $result = mysqli_query($db, $q);
		  $row = mysqli_fetch_assoc($result);
      echo "校史竞赛得分：".$row['score'];

      mysqli_free_result($result);
      mysqli_close($db);
      unset($_SESSION);
      session_destroy();
     ?>
     <p id="res_score"></p>
     <div style="margin-top:50px;">
    	<p style="font-size:10px;display:inline;">距离自动注销还有：</p>
     	<p id="time" style="font-size:10px;display:inline;"></p>
     </div>
     <input type="button" id="logout" value="注 销"/>
	 </div>
     </div>
     <script type="text/javascript" src="js/cookie.js"></script>
     <script type="text/javascript" src="js/score.js"></script>
  </body>
</html>
