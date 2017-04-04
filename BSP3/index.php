<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title></title>
	</head>
	<body>
		<div class="container">
			<?php 
					$host = 'localhost';
					$dbname = 'classicmodels';
					$user = 'htluser';
					$pwd = 'htluser';

					try {
						$db = new PDO ( "mysql:host=$host;dbname=$dbname", $user, $pwd);
					}
					catch (PDOException $e) {						
						
						?>
						<p class="text-danger">Datenbankanbindung fehlgeschlagen</p>
						<?php
						echo $e->getMessage();
						$db = false;
						exit();
					}

					$count = 20;
					$query = $db->query("SELECT count(customerNumber) from customers");
					$amount = $query->fetch();				
					$maxpage = ceil(intval($amount[0]) / $count);

					if (isset($_GET['page']) && $_GET['page'] > 0)
					{
						if($_GET['page'] > $maxpage)
						{
							$page = $maxpage;
						}
						else
						{
							$page = $_GET['page'];
						}						
					}
					else
					{
						$page = 1;
					}
									
					$lowlimit = $count * ($page - 1);
										
					$query = $db->query("SELECT customerName,contactLastName,contactFirstName,postalCode,City FROM customers LIMIT $lowlimit,$count");
				?>
			<h1> Kundenübersicht </h1>
			<h2> Seite <?php echo $page ?></h2>
			<table class="table table-striped table-hover">
				<tr>
					<th>Firma</th>
					<th>Nachname</th>
					<th>Vorname</th>
					<th>PLZ</th>
					<th>Ort</th>
				</tr>
				<?php
				foreach ($query->fetchAll(PDO::FETCH_OBJ) as $item) {
				?>
				<tr>
					<td><?php echo $item->customerName; ?></td>
					<td><?php echo $item->contactLastName; ?></td>
					<td><?php echo $item->contactFirstName; ?></td>
					<td><?php echo $item->postalCode; ?></td>
					<td><?php echo $item->City; ?></td>
				</tr>
				<?php
					}
				?>
			</table>

			<p style="text-align:center;font-size:150%">
			<?php
			if($page != 1)
			{ ?>	
			<a href="index.php?page=1"> << </a>
			<a href="index.php?page=<?php echo $page-1; ?>"> < </a>
			<?php }

			 for ($i= $page-2; $i < $page + 3; $i++) { 
				if($i > 0 && $i < $maxpage +1)
				{
				?> <a href="index.php?page=<?php echo $i ?>"> <?php echo $i; ?></a> <?php
				}	
			}
			
			if($page != $maxpage)
			{ ?>							
			<a href="index.php?page=<?php echo $page+1; ?>"> > </a>			
			<a href="index.php?page=<?php echo $maxpage;?>"> >> </a>
			<?php } ?>
			</p>
		</div>
	</body>
</html>