    <ul class="nav nav-tabs">
    <?php  
    $menuItems = array(array("Home","home.php"),array("About","about.php"),array("Portfolio","portfolio.php"),array("Contact","contact.php"),array("Login","login.php"));
	foreach($menuItems as $item)
	{
		echo "<li role=\"presentation\"><a href=".$item[1].">".$item[0]."</a></li>";
	}    	
   ?>
   </ul>