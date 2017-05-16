
<?php
require "db.php";
if(isset($_POST['projectToDelete']))
    {
        $delete = $database->prepare("Delete FROM projects where Pid=:Pid;");
        $delete ->bindParam(':Pid', $value );
        $value = $_POST['projectToDelete'];
        $delete -> execute();

        $count = $delete -> rowCount();

        if($count == 1)
        {
            $response = array('delete' => 'success');
        }
        else{
            $response = array('delete' => 'error');
        }
        echo json_encode($response);
        exit();
    } 
?>