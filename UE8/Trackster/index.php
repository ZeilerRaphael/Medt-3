<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vorlage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

<?php 
$host = 'localhost';
$dbname = 'medt3';
$user = 'htluser';
$pwd = 'htluser';

//Erstellen einer Datenbank
try 
{
  $database = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
}
catch(PDOException $error)
{
  echo 'Connection failed: '. $e-> getMessage();
}
?>

<div class="container">
<h1>Projektübersicht</h1>
<?php
  
  // Button INSERT
  if(!isset($_GET['insert']))
  {
    
    ?>
      <a class="btn btn-default" href= "index.php?insert=true">Neues Projekt</a>
    <?php
  }
  // Formular für INSERT
  else
  {
    echo "<h2>Neues Projekt</h2>";

    ?>
    <form class="form-inline" method ="POST">
    <div class="form-group">
      <input type="text" class="form-control" name ="newname">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name ="newdesc">
    </div>
    <div class="form-group">
      <input type="date" class="form-control" name ="newdate"">
    </div>
      <input type="submit" class="btn btn-default" name = "newsubmit">
    </form>
    <?php
  }

  // INSERT Statement
  if (isset($_POST['newsubmit']))
  {   
    $sql = "INSERT INTO projects (pname, pdescription, created) VALUES (:newname,:newdesc,:newdate)";    
    $stmt = $database -> prepare($sql);

    $stmt->bindParam(':newname', $newname);
    $stmt->bindParam(':newdesc', $newdesc);
    $stmt->bindParam(':newdate', $newdate);

    $newname = $_POST['newname'];
    $newdesc = $_POST['newdesc'];
    $newdate = $_POST['newdate'];

    $stmt -> execute();

    //QUick and Dirty
    ?>
    <!-- <script type="text/javascript"> window.location = "http://localhost/medt/ue8/Trackster"; </script> -->
    <?php
  }

  // Löschen
  if(isset($_GET['delete'])) // Trigger für löschen von Eintrag
  {    
    echo "<h2>Löschen</h2>";

    $delete = $database->prepare("Delete FROM projects where Pid=:Pid;");
    $delete ->bindParam(':Pid', $_GET['delete'] );
    $delete -> execute();
    
    $count = $delete -> rowCount();

    if( $count > 0) // Löschen erfolgreich --> PDO:: ROW COUNT
    {
      ?>
      <p class="bg-success"> Erfolg beim Löschen</p>
      <?php
    }
    else  // Fehlgeschlagen
    {
      ?>
      <p class="bg-danger"> Fehler beim Löschen</p>
      <?php
    }
  }

  //Formular für UPDATE
   if(isset($_GET['change'])&& !isset($_POST['submit']))
   {
   	echo "<h2>Änderungen</h2>";

   	$sql = "SELECT * FROM projects where Pid = :Pid";
    $toChange = $database -> prepare($sql);
    $toChange -> bindParam(':Pid',$Pid);
    $Pid = $_GET['change'];
    $toChange -> execute();
    $visualize = $toChange -> fetch();
    ?>

    <form class="form-inline" method ="POST">
    <div class="form-group">
    	<input type="text" class="form-control" name ="pname" value= "<?php echo $visualize['pname'] ?>">
    </div>
    <div class="form-group">
    	<input type="text" class="form-control" name ="pdesc" value="<?php echo $visualize['pdescription'] ?>">
    </div>
    <div class="form-group">
    	<input type="date" class="form-control" name ="created" value= "<?php echo $visualize['created'] ?>"">
    </div>
    	<input type="hidden" name ="update" value="<?php echo $visualize['Pid'] ?>"">
        
    	<input type="submit" class="btn btn-default" name = "submit">
    </form>
  <?php
   } 

   //UPDATE
   if(isset($_POST['submit']))
   {
	   	echo "<h1>Änderungen</h1>";

	   	$sql = "UPDATE projects SET pname = :pname,pdescription =:pdescription, created=:created WHERE Pid =:Pid";
	   	$update = $database -> prepare($sql);

	   	$update -> bindParam(':pname',$_POST['pname'],PDO::PARAM_STR);
	    $update -> bindParam(':pdescription',$_POST['pdesc'],PDO::PARAM_STR);
	    $update -> bindParam(':created',$_POST['created'],PDO::PARAM_STR);
	    $update -> bindParam(':Pid',$_POST['update'],PDO::PARAM_INT);

	    $update -> execute();

	    if($update -> rowCount() >0)
	    {
	    ?> 
	    	<p class="bg-success"> Update Zeile</p>
	    <?php
		}
	    else
	    {
	    ?>
	    	<p class="bg-danger"> Fehler beim Updaten</p>
	    <?php
	    }
   }
   

  //Tabelle für SELECT
  $sql = "SELECT * FROM projects";
  $resolution = $database ->query($sql);
  $visualize = $resolution -> fetchAll();
?>

  <table class="table table-striped">
    <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Create Date</th>
      <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($visualize as $item) 
    {
      ?>
      <tr>
        <td><?php echo $item['pname']?></td>
        <td><?php echo $item['pdescription']?></td>
        <td><?php echo $item['created']?></td>
        <td>
          <a href="index.php?delete=<?php echo $item['Pid'] ?>"<span class="glyphicon glyphicon-trash"></span></a>
          <a href="index.php?change=<?php echo $item['Pid'] ?>"<span class="glyphicon glyphicon-cog"></span></a>
        </td>
       </tr> 
   <?php    
    }
   ?>
</div>
  </body>
</html>