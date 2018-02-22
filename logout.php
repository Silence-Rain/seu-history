<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>注销</title>
  </head>
  <body>
    <?php
      //页面跳转 没有实际意义
      setcookie('PHPSESSID',"",time()-1);
      header("refresh:3; url=login.html");
      echo "注销...<br/>正在返回登录界面...";
     ?>
  </body>
</html>
