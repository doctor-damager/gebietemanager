<?php require_once("./../../../config/db.php");
if (isset($_POST["bearbId"]) && isset($_POST["deleteMe"])){

echo "Eintrag gelöscht!"; 
$stmt = $dbh->prepare("DELETE FROM `Bearbeitung` WHERE Bearbeitungsid = :id");
$stmt->bindparam(":id", $theId);
$theId = $_POST["bearbId"];
$stmt->execute();
}


?>