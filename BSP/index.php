<html>
  <head>
  	<meta charset="UTF-8">
	<title>Beispiel 1</title>
	<style>
	li{
		list-style-type: none;
		border-bottom: solid 1px;

	}
	.buttons{
		padding: 10px;
	}
	</style>
  </head>
  <body>
	<h1> Beispiel 1 </h1>
	<form method="post" action="//localhost/medt/bsp/index.php">
			<label>Ihre Eingabe: <input type="text" name="eingabe"></label>
		<div class="buttons">
			<input type="submit" name="resetBtn" value="RESET">
			<input type="submit" name="explodeBtn" value="EXPLODE">
		</div>
	</form>
	<h2>Ihre Eingabe als Liste</h2>
	<?php
		if(isset($_POST['explodeBtn']))
		{ 
			$text =  $_POST['eingabe'];
			$array = explode(" ",$text);
			echo "<ul>";
			foreach($array as $item)
			{
				echo "<li>$item</li>";
			}
			echo "</ul>";
		 }
	 ?>
  </body>
</html>