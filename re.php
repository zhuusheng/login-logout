<?php
	session_start();
	if(!isset($_SESSION["loginname"]) || ($_SESSION["loginname"]==""))
	{
		header("Location: index.php");
	}
	
?>		
		<html>
		<head>
		<title>登入中</title>
		<body>
		<table>
		<p align = center>
			<?php
			header("Content-Type: text/html; charset = utf-8");
			
			echo "歡迎".$_SESSION["name"]."登入"."</br>";
		?></p>
		<p align = center><a href="index.php?logout=true">登出</a></p>
		</table>
		</body>
		</head>
		</html>
	