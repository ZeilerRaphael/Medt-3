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

if(isset($_GET['delete']))
	{
		echo "Lösche Zeile: ".$_GET['delete'];
		$delete = $db->query("Delete FROM projects where Pid=".$_GET['delete']);
		$delete -> execute();
	}
	if(isset($_GET['change']))
	{
		echo "Ändere Zeile: ".$_GET['change'];
	}
?>