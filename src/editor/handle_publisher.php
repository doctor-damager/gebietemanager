<?php


if (isset($_POST['newPublisher'])) {
//neuen verkuendiger in die db eintragen
$stmt = $dbh->prepare("INSERT INTO Verkuendiger (Name) VALUES (:name)");
$stmt->bindParam(':name', $name);

// ausführen
$name = $_POST['newPublisher'];
$stmt->execute();
header("Location: editor-pub?newPub=$name");

}
else { echo "Es ist ein Fehler unterlaufen!";}


?>