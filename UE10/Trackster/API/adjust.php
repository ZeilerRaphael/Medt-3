<?php
require"../DB/db.php";
if (isset($_POST['projectToAdjust']))
{
$query = $database->prepare("UPDATE projects SET pname=:pname,pdescription=:pdesc,created=:created WHERE Pid= :Pid");
$query->bindParam(':pname', $_POST['pname'], PDO::PARAM_STR);
$query->bindParam(':pdesc', $_POST['pdesc'], PDO::PARAM_STR);
$query->bindParam(':created', $_POST['created']);
$query->bindParam(':Pid', $_POST['projectToAdjust'], PDO::PARAM_INT);
$query->execute();

if ($query != false && $query->rowCount() == 1)
{
echo json_encode(array("edit"=>1));
exit();
}
else
{
echo json_encode(array("edit"=>0));
exit();
}
}
?>