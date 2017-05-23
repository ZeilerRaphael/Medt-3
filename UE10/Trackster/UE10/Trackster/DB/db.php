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