<?php require "/DB/db.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vorlage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Jquery -->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">      
    </script>
    <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
  </head>

  
  <body>
<div class="container">
<h1>Projektübersicht</h1>

    <p id="msgBox" class="box" style="height:50px; font-size:200%;"></p>
<?php   
        $sql = "SELECT * FROM projects";
        $resolution = $database->query($sql);
        $visualize = $resolution->fetchAll();
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
      <tr id="<?php echo $item['Pid']?>">
        <td><?php echo $item['pname']?></td>
        <td><?php echo $item['pdescription']?></td>
        <td><?php echo $item['created']?></td>

          <!-- Mit HTML 5 eigene Attribute möglich: data-xyz BSP: data-name -->
        <td>
          <span  class="glyphicon glyphicon-remove delete"></span>
          <span class="glyphicon glyphicon-cog adjust"></span>
        </td>
       </tr> 
   <?php    
    }
   ?>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Löschen</h4>
            </div>
            <div class="modal-body">
                Wollen sie die Zeile wirklich löschen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary remove">Löschen</button>
            </div>
        </div>
    </div>
</div>
<script>
    var currentPID;
    $(document).ready(function() {
            $("#msgBox").hide();
            $('.adjust').click(Adjust);
            $('.delete').click(Delete);
            $('.remove').click(Remove);
        }
    );
    function Remove()
    {
            //Ajax-Call konfigurieren
            var myAjaxConfigObj = {
                url: "http://localhost/medt/ue10/Trackster/API/delete.php",
                type: "post",
                dataType: "json",
                data: "projectToDelete=" + currentPID,
                success: function (data) {
                    if (data.delete == 'success') {
                        $("#"+currentPID).remove();
                        $("#msgBox").addClass("bg-success").text("Passt scho!").show(500).delay(1000).hide(500);
                    }
                    else {
                        $("#msgBox").addClass("bg-danger").text("Passt so Nd!").show(500).delay(1000).hide(500);
                    }

                },
                error: function (jqXHR, msg) {
                    console.log("Server response: " + msg);
                    $("#msgBox").addClass("bg-danger").text("Server nicht verfügbar!").show(500).delay(1000).hide(500);
                }
            };
            $.ajax(myAjaxConfigObj);
        $('#myModal').modal('hide');
    }
    function Delete() {
        $('#myModal').modal('show');
        currentPID = $(this).closest("tr").attr('id');
    }
    function Adjust() {
        console.log("Bearbeiten");
    }
</script>

  </body>
</html>
