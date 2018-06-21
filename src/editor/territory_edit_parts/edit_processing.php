<?php require_once("./../../../config/db.php");
if (isset($_POST["bearbId"]) && isset($_POST["deleteMe"])){

echo "Eintrag gelöscht!"; 


$stmt = $dbh->prepare("DELETE FROM `Bearbeitung` WHERE Bearbeitungsid = :id");
$stmt->bindparam(":id", $theId);
$theId = $_POST["bearbId"];
$stmt->execute();

if ($_POST["lastPub"] != "3"){
//wieder auf frei setzen 
$stmt = $dbh->prepare("INSERT INTO `Bearbeitung` ( Gebietlink, Verkuendiger, ausgabe, rueckgabe) VALUES (:gebietlink, :verkundiger, :ausgabe, :rueckgabe)");

$stmt->bindparam(':gebietlink', $gebietId);
$stmt->bindparam(':verkundiger', $verkId);
$stmt->bindparam(':ausgabe', $ausgabe);
$stmt->bindparam(':rueckgabe', $rueckgabe);
$gebietId =$_POST['gebieteId'];
$verkId ="3";
$ausgabe = null;
$rueckgabe ="1993-09-30";
$stmt->execute();

}
}


?>