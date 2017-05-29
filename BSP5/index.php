<?php
	$failed = false;	
	session_start();

	if (isset($_GET['logout']) && $_GET['logout'] == true) {
		session_unset();
		session_destroy();
	}
	if (isset($_SESSION["login"])){
		header('Location: http://localhost/medt/BSP5/securedPage.php/');
		exit;
	}
	if(isset($_POST['submitBtn'])) {
		if ($_POST['user'] == "Raphael" && $_POST['password'] == "secured") {
			$_SESSION["login"] = true;
			$_SESSION["user"] = $_POST['user'];
			header('Location: http://localhost/medt/BSP5/securedPage.php/');
			exit;
		}
		else {
			$failed = true;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>LOGIN</title>
	</head>
	<body>
		<div class="container">
			<h1>LOGIN</h1>

			<?php
			if (isset($_GET['logout']) && $_GET['logout'] == true)
			{?>
				<div class="alert alert-success">
					<p>Sie sind nun abgemeldet.</p>
				</div>
			<?php } ?>

			<?php  
			if ($failed)
			{
			?>
				<div class="alert alert-danger">
					<p>Die Kombination aus Benutzername und Passwort ist falsch!</p>
				</div>
			<?php 
			} 
			?>

			<form method="post" action="index.php">
				<div class="form-group">
					<label>Username: <input type="text" name="user" class="form-control"></label>
				</div>
				<div class="form-group">
					<label>Password: <input type="password" name="password" class="form-control"></label>
				</div>
				<div class="form-group">
					<input type="submit" name="submitBtn" class="btn btn-default">
				</div>
			</form>
		</div>
	</body>
</html>