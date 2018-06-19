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
        $message = "Gebiet ist noch nicht Ausgegeben!";
        msgDiv(0,$message);
        exit;
       }

       if ( $publLast != $verk ) {
        $message = "Gebiet ist bereits ausgegeben!";
        msgDiv(0,$message);
        exit;
       }

    if ( $rueckgabeLast == NULL ) {
        $message = "Das Gebiet ist bereits ausgegeben!";
       msgDiv(0,$message);
       exit;
      }


      if (strtotime($rueckgabeLast) > strtotime($ausgabe) ) {
        $message = "Ausgabedatum muss älter sein als Letzes Rückgabedatum";
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
$stmt->bindparam(':bearbeitungsid', $BearbIdLast);}
else{

if($rueckgabeLast == "1993-09-30" && $publLast != $verk) {msgDiv(0,"Das Gebiet ist Bereits ausgegeben! Name überprüfen! Ausgabe muss '-' sein!"); exit;}

$stmt = $dbh->prepare("INSERT INTO `Bearbeitung` ( Gebietlink, Verkuendiger, ausgabe, rueckgabe) VALUES (:gebietlink, :verkundiger, :ausgabe, :rueckgabe)");}

$stmt->bindparam(':gebietlink', $gebietId);
$stmt->bindparam(':verkundiger', $verkId);
$stmt->bindparam(':ausgabe', $ausgabe);
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