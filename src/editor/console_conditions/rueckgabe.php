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
        $message = "Gebiet ist noch nicht ausgegeben! Error 1";
        msgDiv(0,$message);
        exit;
       }

       if ( $publLast != $verkId ) {
        $message = "Gebiet ist bereits ausgegeben! Error 2";
        msgDiv(0,$message);
        exit;
       }

/*  überflüssig?  if ( $rueckgabeLast == NULL ) {
        $message = "Das Gebiet ist bereits ausgegeben! Error 3";
       msgDiv(0,$message);
       exit;
      } */
      if (strtotime($ausgabe) != false) {

      if (strtotime($rueckgabeLast) > strtotime($ausgabe) ) {
         
        $message = "Ausgabedatum ".$ausgabe." muss älter sein als Letzes Rückgabedatum ".$rueckgabeLast ;
        msgDiv(0,$message);
        exit;
       }
       if (strtotime($rueckgabe) < strtotime($ausgabe) ) {
        $message = "Rueckgabe kann nicht jünger sein als Ausgabedatum!";
        msgDiv(0,$message);
        exit;
       }
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


/////fehler ....insert muss update sein

try {
$stmt = $dbh->prepare("SELECT Name FROM Verkuendiger WHERE VerkuendigerID = :vId");
$stmt->bindParam(':vId', $publLast, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $theLastName = $row['Name'];
   
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
if ($publLast === "3") {

$stmt = $dbh->prepare("UPDATE `Bearbeitung` SET  Gebietlink = :gebietlink, Verkuendiger = :verkundiger, ausgabe = :ausgabe, rueckgabe = :rueckgabe WHERE BearbeitungsID = :bearbeitungsid"); 
$stmt->bindparam(':gebietlink', $gebietId);
$stmt->bindparam(':ausgabe', $ausgabe);
}

else{

if($rueckgabeLast == "1993-09-30" && $theLastName != $verk) {msgDiv(0,"Das Gebiet ist Bereits ausgegeben! Name überprüfen! Ausgabe muss '-' sein!"); exit;}

$stmt = $dbh->prepare("UPDATE `Bearbeitung` SET Verkuendiger = :verkundiger, rueckgabe = :rueckgabe WHERE BearbeitungsID = :bearbeitungsid");}
$stmt->bindparam(':bearbeitungsid', $BearbIdLast);
$stmt->bindparam(':verkundiger', $verkId);
$stmt->bindparam(':rueckgabe', $rueckgabe);
$stmt->execute();

//wieder auf frei setzen 
$stmt = $dbh->prepare("INSERT INTO `Bearbeitung` ( Gebietlink, Verkuendiger, ausgabe, rueckgabe) VALUES (:gebietlink, :verkundiger, :ausgabe, :rueckgabe)");

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
