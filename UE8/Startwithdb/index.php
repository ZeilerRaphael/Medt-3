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

$res = $db->query(" SELECT name,description,createDate FROM project");
$tmp = $res ->fetchAll(PDO::FETCH_OBJ); // staticZufriff in PHP mit :: 
?>
<div class="container">

<table class="table">
  <thead>
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Create Date</th>
  </tr>
  </thead>
  <tbody>
  <?php
  foreach ($tmp as $item) {
    echo 
    "<tr> 
    <td>".$item->name."</td>
    <td>".$item->description."</td>
    <td>".$item->createDate."</td>
    </tr>";
  }
  
  ?>
  </tbody>
</table>


</div>


  </body>
</html>