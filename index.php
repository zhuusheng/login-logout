<?php 
	header("Content-Type: text/html; charset = utf-8");
	require_once("connect.inc.php");
	session_start();
	
	if(!isset($_SESSION["loginname"]) || ($_SESSION["loginname"]==""))
	{
		if(isset($_POST["username"]) && isset($_POST["passwd"]))
		{
			$query_rec="SELECT cname,cusername,cpassword FROM test where cusername =?";
			$stmt = $db_link-> prepare($query_rec);
			$stmt -> bind_param("s",$_POST["username"]);
			$stmt -> execute();
			$stmt -> bind_result($name,$username,$password);
			$stmt -> fetch();
			$stmt -> close();
			
			//比對帳密
				if($_POST["username"]!="" && $_POST["passwd"] !="" && 
					$username == $_POST["username"] && $password == $_POST["passwd"])
				{
					$_SESSION["loginname"]=$username;
					$_SESSION["name"] = $name;
					//echo $_SESSION["loginname"].$_SESSION["name"];
					header("Location: re.php"); //導向re.php
				}
				else
				{				
					header("Location: index.php?errMsg=1"); //產生錯誤訊息?errMsg=1
				}
				
		}
	}
	if(isset($_GET["logout"]) && ($_GET["logout"]=="true"))
	{
		unset($_SESSION["loginname"]);
		unset($_SESSION["name"]);
		header("Location: index.php");
	}		
	?>
	<html>
	<head>
	
	<title>test123</title>
	</head>
	<body>
		<td width="200">
		<div class= "boxt1"></div>
		<div class= "boxtr"></div>
		<div class ="regbox">

		<?php
			if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1"))
			{
			?>	
			<div class="errDiv">
			<script>
			alert("帳號或密碼錯誤!")
			</script></div>
			<?php
			}
			?>
			
			<p align="center" class="heading">登入會員</p>
			<form name = "form1" method="post" action="">
			<p align="center">帳號:<br>
			<input name="username" type="text"  id="username">
			</p>
			
			<p align="center">密碼:<br>
			<input name="passwd" type="password"  id="passwd">
			</p>
			

			<p align="center">
			<input type="submit" name="button" id="button" value="登入">
			
			</p>

			</form>
			</div>
			
	</body>
	</html>
	<?php
		$db_link -> close();
	?>