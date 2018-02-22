<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>管理员界面</title>
        <link href="css/adminscore.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    	<div id="logo">
  			<img src="images/adminLogo.png" height="130">
    	</div>
        <div id="box">
		<?php
			session_start();
			if(!$_SESSION['num']){
				die('请求错误！');
			}
			if($_SESSION['rand'] != $_COOKIE['rand']){
		    die('请求错误！');
		  }
			$num = $_SESSION['num'];
			//连接数据库
			require_once('linktodb.php');
			$db = linkToDB();
			//欢迎语
			$q = "SELECT * FROM admin WHERE num = '".$num."'";
		  $result = mysqli_query($db, $q);
		  $row = mysqli_fetch_assoc($result);
		?>
			<p id="welcome">欢迎 <?=$row['name'];?> 辅导员（<?=$row['college'];?>）</p>
            <p><?=$row['college'];?> 的学生测试成绩为：</p>
			<table id="result" border="1">
		<tr style="background-color:#f5fafe;"><th>学号</th><th>一卡通号</th><th>姓名</th><th>成绩</th></tr><br/>
		<?php
			//表格
			$q2 = "SELECT * FROM student WHERE stuNum LIKE '".$row['ID']."%'";
			$result2 = mysqli_query($db, $q2);
			$rownum = mysqli_num_rows($result2);
			for($i = 0; $i < $rownum; $i++){
				$row2 = mysqli_fetch_assoc($result2);
				if($i%2==0){
					echo "<tr><td>{$row2['stuNum']}</td><td>{$row2['ID']}</td><td>{$row2['name']}</td>";
				}else{
					echo "<tr style=\"background-color:#f5fafe;\" ><td>{$row2['stuNum']}</td><td>{$row2['ID']}</td><td>{$row2['name']}</td>";
				}
				if($row2['score']===null){
					echo "<td>未答题</td></tr>";
				}else{
					echo "<td>{$row2['score']}</td></tr>";
				}
				echo "<br/>";
			}
		?>
			</table>
		<?php
			mysqli_free_result($result);
			mysqli_free_result($result2);
			mysqli_close($db);

		 ?>
		 <!--下载Excel的按钮-->
		 	<input class="button" type="button" value="下载EXCEL版" id="download"/>
			<input class="button" type="button" value="修改学生信息" id="change"/><br/>
			<input class="button" type="button" value="注销" id="logout"/>
        </div>

			<script type="text/javascript" src="js/cookie.js"></script>
			<script>
				document.getElementById('download').onclick = function(){
					window.open('transtoxls.php?ID=' + "<?php $ID?>");
				}
				document.getElementById('change').onclick = function(){
					window.open('change.html');
				}
				document.getElementById('logout').onclick = function(){
					cleanCookie();
					window.location.href="admin.html";
				}
			</script>
	</body>
</html>
