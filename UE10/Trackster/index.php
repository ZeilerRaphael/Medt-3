<?php
require "/DB/db.php";
require "modal.php";
?>

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
        <td class="tdname"><?php echo $item['pname']?></td>
        <td class="tddesc"><?php echo $item['pdescription']?></td>
        <td class="tddate"><?php echo $item['created']?></td>

          <!-- Mit HTML 5 eigene Attribute möglich: data-xyz BSP: data-name -->
        <td>
          <span  class="glyphicon glyphicon-remove delete"></span>
            <span  class="glyphicon glyphicon-cog adjust"></span>
        </td>
       </tr> 
   <?php    
    }
   ?>
</div>


<script>
    var currentPID;
    var currentRow;
    $(document).ready(function() {
            $("#msgBox").hide();
            $('.adjust').click(Adjust);
            $('.delete').click(Delete);

            $('.remove').click(Remove);
            $('.save').click(Save);
        }
    );
    function Delete() {
        $('#ModalDelete').modal('show');
        currentPID = $(this).closest("tr").attr('id');
    }
    function Remove()
    {
        //Ajax-Call konfigurieren
        var myAjaxConfigObj = {
            url: "http://localhost/medt/ue10/Trackster/API/delete.php",
            type: "post",
            dataType: "json",
            data: {'projectToDelete' : currentPID},
            success: function (data) {
                if (data.delete == 'success') {
                    $("#"+currentPID).remove();
                    $("#msgBox").removeClass("bg-danger").addClass("bg-success").text(" Löschen Passt scho!").show(500).delay(1000).hide(500);
                }
                else {
                    $("#msgBox").removeClass("bg-success").addClass("bg-danger").text(" Halt Stop!").show(500).delay(1000).hide(500);
                }
            },
            error: function (jqXHR, msg) {
                console.log("Server response: " + msg);
                $("#msgBox").removeClass("bg-success").addClass("bg-danger").text("Server nicht verfügbar!").show(500).delay(1000).hide(500);
            }
        };
        $.ajax(myAjaxConfigObj);
        $('#ModalDelete').modal('hide');
    }

    function Adjust() {
        currentRow = $(this).closest("tr");
        currentPID = currentRow.attr('id');
        $("#pname").val(currentRow.children('.tdname').html());
        $("#pdesc").val(currentRow.children('.tddesc').html());
        $("#created").val(currentRow.children('.tddate').html());
        $(ModalAdjust).modal('show');
    }
    function Save(){
        var  myAjaxConfigObj = {
            url: "http://localhost/medt/ue10/Trackster/API/adjust.php",
            type: "post",
            dataType: "json",
            data: {'projectToAdjust':currentPID, 'pname' : $("#pname").val(),'pdesc' : $("#pdesc").val(),'created' : $("#created").val()},
            success: function(data){
                if (data.edit) {
                    currentRow.children('.tdname').html($("#pname").val());
                    currentRow.children('.tddesc').html($("#pdesc").val());
                    currentRow.children('.tddate').html($("#created").val());
                    $("#msgBox").removeClass("bg-danger").addClass("bg-success").text("Änderung Passt so!").show(500).delay(1000).hide(500);
                }
                else {
                    $("#msgBox").removeClass("bg-success").addClass("bg-danger").text("Alles bleibt so wie es ist!").show(500).delay(1000).hide(500);
                }
            },
            error: function() { //Ziel wenn die HTTP Response nicht vom Status Code 200 ist
                $("#msgBox").removeClass("bg-success").addClass("bg-danger").text("Server nicht verfügbar!").show(500).delay(1000).hide(500);
            }
        }
        $.ajax(myAjaxConfigObj);
        $(ModalAdjust).modal('hide');
    }
</script>

  </body>
</html>
