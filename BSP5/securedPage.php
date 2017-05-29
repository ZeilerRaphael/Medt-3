<?php
	require "isLoggedIn.php";
?>
<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Secured Page</title>
		<style>.glyphicon {margin-right:20px;}</style>
	</head>
	<body>
<h1>This is a secured page!</h1>
<a href="http://localhost/medt/BSP5/index.php?logout=true" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-user"></span> Logout <?php echo $_SESSION['user']?></a>
</body>