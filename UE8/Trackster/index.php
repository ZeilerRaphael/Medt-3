<!DOCTYPE html>
<html lang="en">
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
try{
  $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
}
catch (PDOException $e)
{
  echo 'Connection failed: '.$e->getMessage();
}

?>
<div class="container">
<?php 

  //Löschen
  if(isset($_GET['delete'])) // Trigger für löschen von Eintrag
  {    
    $delete = $db->prepare("Delete FROM projects where Pid=".$_GET['delete'].";");
    $delete -> execute();

    $count = $delete -> rowCount();
    print($count);

    if( $count > 0) // Löschen erfolgreich --> PDO:: ROW COUNT
    echo "<p class=\"bg-success\">Erfolg beim Löschen von Zeile: ".$_GET['delete']."</p>";
    else  // Fehlgeschlagen
    echo "<p class=\"bg-danger\">Fehler beim Löschen von Zeile: ".$_GET['delete']."</p>";
  }

  //Formular für Updaten
  if(isset($_GET['change'])&& !isset($_POST['submit'])) // Trigger für bearbeiten des Eintrages
  {
    echo "<h1>Änderungen</h1>";

    $change = $db -> query("SELECT pname, pdescription, created, Pid FROM projects where Pid = ".$_GET['change'].";");
    $toChange = $change -> fetch(PDO::FETCH_ASSOC);
    
    echo "<form method=\"POST\">";
    echo "<input type=\"text\" name=\"pname\" value=\"".$toChange['pname']."\">";
    echo "<input type=\"text\" name=\"pdesc\" value=\"".$toChange['pdescription']."\">";
    echo "<input type=\"date\" name=\"pdate\" value=\"".$toChange['created']."\">";
    echo "<input type=\"hidden\" name=\"update\" value=\"".$toChange['Pid']."\">";
    echo "<input type=\"submit\" name=\"submit\">";
    echo "</form>";
  }

  //Updaten
  if(isset($_POST['submit']))
  {
    $sql = "UPDATE projects SET pname = '".$_POST['pname']."',pdescription ='".$_POST['pdesc']."', created='".$_POST['pdate']."' WHERE Pid =".$_POST['update'].";";
    $update = $db->prepare($sql);

    $update->execute();
    $check = $update -> rowCount();

    print($check);  
    if( $check > 0) // Update erfolgreich --> PDO:: ROW COUNT
    echo "<p class=\"bg-success\">Update Zeile: ".$_POST['update']."</p>";
    else  // Fehlgeschlagen
    echo "<p class=\"bg-danger\">Fehler bei Zeile: ".$_POST['update']."</p>";
  }


  //Select für Tabelle
  $res = $db->query("SELECT pname,pdescription,created,Pid FROM projects");
  $tmp = $res ->fetchAll(PDO::FETCH_ASSOC); // staticZufriff in PHP mit :: 
?>

  <table class="table">
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
    foreach ($tmp as $item) 
    {    
      echo 
      "<tr>
      <td>$item[pname]</td>
      <td>$item[pdescription]</td>
      <td>$item[created]</td>
      
      <td>
        <a href=\"index.php?delete=$item[Pid]\"><span class=\"glyphicon glyphicon-trash\"></span></a>
        <a href=\"index.php?change=$item[Pid]\"><span class=\"glyphicon glyphicon-cog\"></span></a>
      </td>
      </tr>
      ";
    }  
    ?>
    </tbody>
  </table>
</div>


  </body>
</html>