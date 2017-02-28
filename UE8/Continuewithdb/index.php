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

$res = $db->query("SELECT pname,pdescription,created,Pid FROM projects");
$tmp = $res ->fetchAll(PDO::FETCH_ASSOC); // staticZufriff in PHP mit :: 
var_dump($tmp);
?>
<div class="container">

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
  foreach ($tmp as $item) {    
    echo 
    "<tr>
    <td>$item[pname]</td>
    <td>$item[pdescription]</td>
    <td>$item[created]</td>
    
    <td>
      <a href=\"dbaccess.php?delete=$item[Pid]\"><span class=\"glyphicon glyphicon-trash\"></span></a>
      <a href=\"dbaccess.php?change=$item[Pid]\"><span class=\"glyphicon glyphicon-cog\"></span></a>
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