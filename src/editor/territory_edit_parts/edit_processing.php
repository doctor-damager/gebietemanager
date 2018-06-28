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

if (isset($_POST["the_selected"])) {

    $theId = $_POST["bearbId"];
    $theValue = $_POST["the_selected"];
    $theType = $_POST["type"];
    $message = "Es ist ein Fehler unterlaufen!";

if($theValue == "" || $theValue == null){
    echo "Feher! keine Eingabe";
    exit;
} 

if($theType == "i"){
    $stmt = $dbh->prepare("UPDATE `Bearbeitung` SET Verkuendiger = :myValue WHERE Bearbeitungsid = :id");
    $stmt->bindparam(":id", $theId);
    $stmt->bindparam(":myValue", $theValue);
    $stmt->execute();
    $message = "Name wurde geändert!";
}
if($theType == "a"){
    $stmt = $dbh->prepare("UPDATE `Bearbeitung` SET ausgabe = :myValue WHERE Bearbeitungsid = :id");
    $stmt->bindparam(":id", $theId);
    $stmt->bindparam(":myValue", $theValue);
    $stmt->execute();
    $message = "Ausgabe wurde geändert!";
}
if($theType == "r"){
    $stmt = $dbh->prepare("UPDATE `Bearbeitung` SET rueckgabe = :myValue WHERE Bearbeitungsid = :id");
    $stmt->bindparam(":id", $theId);
    $stmt->bindparam(":myValue", $theValue);
    $stmt->execute();
    $message = "Rueckgabe wurde geändert!";
}

echo $message;






    
}

//DELETE Territory---------------------------------------

if (isset($_POST["deleteTerId"])) {
    
    try { 
   
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("DELETE FROM `Gebiet` WHERE GebieteID = :gId");
    $gId = $_POST["deleteTerId"];
    $stmt->bindParam(':gId', $gId, PDO::PARAM_INT);
    $stmt->execute();
  echo "Gebiet erfolgreich gelöscht";
  
   
    }
    catch (PDOException $e) { 
        echo "Es ist ein Fehler unterlaufen!";
    } 

 
  
    }

    //UPDATE Territory---------------------------------------

if (isset($_POST["iframe"])) {
    
    try { 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("UPDATE `Gebiet` SET GebName = :gn, iframe = :ifr, Anmerkung = :an, strassen = :stra, wohneinheiten = :we, stadteil = :stata, nichtbesuchen = :nb, rueckbesuche = :rb WHERE GebieteID = :gebid");
    $gebid = $_POST["gebid"];
    $oldName = $_POST["oldName"];
    $gn = $_POST["neuername"];
    $stra = $_POST["strassen"];
    $we = $_POST["wohneinheiten"];
    $stata = $_POST["stadtteil"];
    $ifr = $_POST["iframe"];
    $an = $_POST["anmerkung"];
    $nb = $_POST["nichtbesuchen"];
    $rb = $_POST["rueckbesuche"];
    $stmt->bindParam(':gebid', $gebid);
    $stmt->bindParam(':gn', $gn);
    $stmt->bindParam(':ifr', $ifr);
    $stmt->bindParam(':an', $an);
    $stmt->bindParam(':stra', $stra);
    $stmt->bindParam(':we', $we);
    $stmt->bindParam(':stata', $stata);
    $stmt->bindParam(':nb', $nb);
    $stmt->bindParam(':rb', $rb);
    $stmt->execute();
if($oldName != $gn){
    if (file_exists("./../../../assets/img/gebiete/".$oldName."_1.png"))
    { rename ("./../../../assets/img/gebiete/".$oldName."_1.png", "./../../../assets/img/gebiete/".$gn."_1.png");}
    
    if (file_exists("./../../../assets/img/gebiete/".$oldName."_2.png"))
    { rename ("./../../../assets/img/gebiete/".$oldName."_2.png", "./../../../assets/img/gebiete/".$gn."_2.png");}


}
  echo "Gebiet erfolgreich Upgedatet!";
  
   
    }
    catch (PDOException $e) { 
        echo $gn;
        echo "Es ist ein Fehler unterlaufen!";
        print_r($dbh->errorInfo()); 
print_r($stmt->errorInfo()); 
print $dbh->errorCode();
print $stmt->errorCode(); 
echo "Error!: " . $e->getMessage() . "<br/>";
    } 

 
  
    }


?>