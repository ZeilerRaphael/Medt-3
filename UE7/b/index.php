
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <img src="https://mir-s3-cdn-cf.behance.net/projects/202/22333051.549fe2143e56c.png"  alt="Responsive image">
          <ul class="nav nav-tabs">

          <?php
    //$menuItems = array(array("Home","home"),array("About","about"),array("Portfolio","portfolio"),array("Contact","contact"),array("Login","login"));

    $action = "Home"; 
    $Items = array("Home","About","Portfolio","Contact","Login");

	foreach($Items as $item)
	{
		echo "<li role=\"presentation\"><a href=\"index.php?action={$item}\">".$item."</a></li>";
	}    
		echo "</ul>";

		
		if(isset($_GET['action']))
		{
			$tmp = $_GET['action'];
		if(in_array($tmp,$Items))
		{
			$action = "$tmp";
		}
		else{
			$action ="Home";
		}
			
		}
		include("{$action}.php");
			
   ?>
   


   
    <footer class="footer">
 	<p>@Raphael Zeiler</p>
	</footer>
	</div>
  </body>
</html>

