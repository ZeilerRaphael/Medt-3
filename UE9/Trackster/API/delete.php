
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
            echo 1;          
        }
        else{
            echo 0;
        }
        exit();
        
    } 
?>