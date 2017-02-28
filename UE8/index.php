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
	echo'i suck';
}

