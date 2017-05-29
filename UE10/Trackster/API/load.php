<?php
    $sql = "SELECT * FROM projects where Pid = :Pid";
    $toChange = $database -> prepare($sql);
    $toChange -> bindParam(':Pid',$Pid);
    $Pid = $_GET['change'];
    $toChange -> execute();
    $visualize = $toChange -> fetch();
?>