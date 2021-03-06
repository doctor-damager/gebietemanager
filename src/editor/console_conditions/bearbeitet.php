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
    
    if ( $publLast == "3" ) {
       $message = "Das Gebiet ist nicht ausgegeben!";
       msgDiv(0,$message);
       exit;
      }
      if ( $publLast != $verkId ) {
        $message = "Feheler! Das Gebiet ist an einen anderen Verkuendiger ausgegeben!";
        msgDiv(0,$message);
        exit;
       }


      if (strtotime($ausgabeLast) > strtotime($rueckgabe) ) {
        $message = "Rueckgabedatum muss älter sein als Letzes Ausgabedatum";
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

$stmt = $dbh->prepare("UPDATE `Bearbeitung` SET  rueckgabe = :rueckgabe WHERE BearbeitungsID = :bearbeitungsid"); 
$stmt->bindparam(':bearbeitungsid', $BearbIdLast);
$stmt->bindparam(':rueckgabe', $rueckgabe);

$stmt->execute();

//wieder neu ausgeben
$stmt = $dbh->prepare("INSERT INTO `Bearbeitung` ( Gebietlink, Verkuendiger, ausgabe, rueckgabe) VALUES (:gebietlink, :verkundiger, :ausgabe, :rueckgabe)");

$stmt->bindparam(':gebietlink', $gebietId);
$stmt->bindparam(':verkundiger', $verkId);
$stmt->bindparam(':ausgabe', $rueckgabe);
$stmt->bindparam(':rueckgabe', $rueckgabe_new);
$rueckgabe_new = null;
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