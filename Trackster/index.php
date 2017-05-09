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

  <!-- Jquery -->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">      
    </script>
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

    <p id="msgBox" class="box" style="height:50px; font-size:200%;"></p>
<?php

    if(isset($_POST['projectToDelete']))
    {
        $delete = $database->prepare("Delete FROM projects where Pid=:Pid;");
        $delete ->bindParam(':Pid', $value );
        $value = $_POST['projectToDelete'];
        $delete -> execute();

        $count = $delete -> rowCount();

    }
    else {
        $sql = "SELECT * FROM projects";
        $resolution = $database->query($sql);
        $visualize = $resolution->fetchAll();
    }
  //Tabelle für SELECT

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
      <tr  id="<?php echo $item['Pid']?>">
        <td><?php echo $item['pname']?></td>
        <td><?php echo $item['pdescription']?></td>
        <td><?php echo $item['created']?></td>

          <!-- Mit HTML 5 eigene Attribute möglich: data-xyz BSP: data-name -->
        <td>
          <span  class="glyphicon glyphicon-remove delete" ></span>
          <span class="glyphicon glyphicon-cog adjust"></span>
        </td>
       </tr> 
   <?php    
    }
   ?>
</div>

<script>
    $(document).ready(function() {
            $("#msgBox").hide();
            $('.adjust').click(Adjust);
            $('.delete').click(Delete);
        }
    );

    function Delete() {
        var currentPID = $(this).parent().parent().attr('id');
        if (confirm("Wollen sie es wirklich Löschen?")) {
            console.log("yes " + currentPID);
            //Ajax-Call konfigurieren
            var myAjaxConfigObj = {
                url: "http://localhost/medt/ue9/Trackster/", // current Page
                type: "post",
                data: "projectToDelete=" + currentPID,
                success: function (dataFromServer) {
                    console.log("Server response: " + dataFromServer);
                    if (dataFromServer) {
                        //Löschen erfolgreich:
                        //Zeile (mit der Projekt ID) aus der HTML-Tabelle entfernen ( .remove())
                        //MsgBox (CSS nicht vergessen
                        $("#"+currentPID).remove();
                        $("#msgBox").addClass("bg-success").text("Passt scho!"+currentPID).show(500).delay(1000).hide(500);

                    }
                    else {
                        $("#msgBox").addClass("bg-danger").text("Passt so Nd !"+currentPID).show(500).delay(1000).hide(500);
                    }

                },
                error: function (jqXHR, msg) {
                    console.log("Server response: " + msg);
                    $("#msgBox").addClass("bg-danger").text("Server nicht verfügbar!").show(500).delay(1000).hide(500);
                }

            };
            $.ajax(myAjaxConfigObj);
        }
        else
            console.log("Nicht gelöscht" + currentPID);
    }
    function Adjust() {
        console.log("Bearbeiten");
    }
</script>
  </body>
</html>
