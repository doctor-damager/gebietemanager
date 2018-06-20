<?php


try {
$stmt = $dbh->prepare("SELECT * FROM (SELECT * FROM `Bearbeitung`  
LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebietId'  ORDER BY BearbeitungsID DESC LIMIT 1)sub ORDER BY BearbeitungsID ASC");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $rueckgabeLast = $row['rueckgabe'];
    $ausgabeLast = $row['ausgabe'];
    $publLast = $row['Verkuendiger'];
    $BearbIdLast = $row['BearbeitungsID'];
    
    if ( $rueckgabeLast == NULL && $publLast === "3") {
       $message = "Das Gebiet ist bereits frei, Eintrag nicht möglich!";
       msgDiv(0,$message);
       exit;
      }
      
}
}

catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
     //error handling
    echo "\nPDO::errorInfo():\n"; 
     print_r($dbh->errorInfo()); 
     print_r($stmt->errorInfo()); 
     print $dbh->errorCode();
 print $stmt->errorCode(); 
    die();
 }





try {


$stmt = $dbh->prepare("UPDATE `Bearbeitung` SET  Gebietlink = :gebietlink, Verkuendiger = :verkundiger, ausgabe = :ausgabe, rueckgabe = :rueckgabe WHERE BearbeitungsID = :bearbeitungsid"); 
$stmt->bindparam(':bearbeitungsid', $BearbIdLast);
$stmt->bindparam(':gebietlink', $gebietId);
$stmt->bindparam(':verkundiger', $verkId);
$stmt->bindparam(':ausgabe', $ausgabe);
$stmt->bindparam(':rueckgabe', $rueckgabe);
$verkId ="3";
$ausgabe = null;
$rueckgabe ="1993-09-30";
$stmt->execute();



msgDiv(1,$message);

//echo $gebiet." / ".$verk." / ".$ausgabe." / ".$rueckgabe." / ".$frei." / ".$verkId." / ".$gebietId." / ".$condition." / ".$message .$publLast;


}
  
  
catch (PDOException $e) {
echo "Error!: " . $e->getMessage() . "<br/>";
  //error handling
  echo "\nPDO::errorInfo():\n"; 
  print_r($dbh->errorInfo()); 
  print_r($stmt->errorInfo()); 
  print $dbh->errorCode();
print $stmt->errorCode(); 
 die();
}

?>