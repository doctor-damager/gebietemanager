<?php

//CREATE--------------------------------------------------

if (isset($_POST['newTerName'])) {


    try {
//neues gebiet in die db eintragen
$stmt = $dbh->prepare("INSERT INTO Gebiet (GebName, iframe, Anmerkung) VALUES (:gebName, :iframe, :anmerkung)");
$stmt->bindParam(':gebName', $name);
$stmt->bindParam(':iframe', $iframe);
$stmt->bindParam(':anmerkung', $anmerkung);


// ausführen
$name = $_POST['newTerName'];
$iframe = $_POST['theIframe'];
$anmerkung = $_POST['TerAnmerkung'];
$stmt->execute();
    } catch (PDOException $e) {
        echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
    }
    
    try {
$stmt2 = $dbh->query("SELECT LAST_INSERT_ID()");
$lastId = $stmt2->fetchColumn(); } catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
}

try {

$stmt3 = $dbh->prepare("INSERT INTO Bearbeitung (Gebietlink, Verkuendiger, ausgabe, rueckgabe) VALUES (:gebietlink, :verk, :ausgabe, :rueckgabe)");   
$stmt3->bindParam(':gebietlink', $lastId);
$stmt3->bindParam(':verk', $verk);
$stmt3->bindParam(':ausgabe', $ausgabe);
$stmt3->bindParam(':rueckgabe', $rueckgabe);


$verk = $_POST['newTerPubNameId'];
if ($_POST['newTerAusgabe'] !== "") {
$ausgabe = $_POST['newTerAusgabe']."-28";} 
else{
    $ausgabe = date("Y-m-d"); ;
}
$rueckgabe = date("Y-m-d");

$stmt3->execute(); 
} catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
}
  
  if( $stmt->errorInfo()[1]  == 1062) {
    header("Location: return?duplicateError=yes");
  }
 
if(isset($_POST["btnSubmit"]))
{
    $errors = array();
    $uploadedFiles = array();
    $extension = array("png");
    $bytes = 1024;
    $KB = 1024;
    $totalBytes = $bytes * $KB;
    $UploadFolder = "./assets/img/gebiete/";
    
    $counter = 0;
    
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
        $temp = $_FILES["files"]["tmp_name"][$key];
        $name2 = $_FILES["files"]["name"][$key];
       
        
        if(empty($temp))
        {
            break;
        }
        
        $counter++;
        $UploadOk = true;
        $new_path = $UploadFolder.$name.'_'.$counter.'.'.$extension[0];
        if($_FILES["files"]["size"][$key] > $totalBytes)
        {
            $UploadOk = false;
            array_push($errors, $name2." file size is larger than the 1 MB.");
        }
        
        $ext = pathinfo($name2, PATHINFO_EXTENSION);
        if(in_array($ext, $extension) == false){
            $UploadOk = false;
            array_push($errors, $name2." is invalid file type.");
        }
        
        if(file_exists($new_path) == true){
            $UploadOk = false;
            array_push($errors, $new_path." file is already exist.");
        }
        
        if($UploadOk == true){
            move_uploaded_file($temp,$new_path);
            array_push($uploadedFiles, $name2);
        }
    }
    
    if($counter>0){
        if(count($errors)>0)
        {
            echo "<b>Errors:</b>";
            echo "<br/><ul>";
            foreach($errors as $error)
            {
                echo "<li>".$error."</li>";
            }
            echo "</ul><br/>";
        }
        
        if(count($uploadedFiles)>0){
            echo "<b>Uploaded Files:</b>";
            echo "<br/><ul>";
            foreach($uploadedFiles as $fileName)
            {
                echo "<li>".$fileName."</li>";
            }
            echo "</ul><br/>";
            
            echo count($uploadedFiles)." file(s) are successfully uploaded.";
        }								
    }

   
    else{
        echo "Please, Select file(s) to upload.";
    }
}

 // header("Location: return?NewTerCreated=$name"); */
}

 else  {

     echo "Es ist ein Fehler unterlaufen!";

} 



//DELETE-----------------------------------------------------

if (isset($_GET['deleteID'])) {
    
    try { 
    //neuen verkuendiger löschen
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("DELETE FROM Verkuendiger WHERE VerkuendigerID = :vId");
    $stmt->bindParam(':vId', $vId, PDO::PARAM_INT);
    
    // ausführen
    $vId = $_GET['deleteID'];
    $stmt->execute();
   header("Location: editor-pub?delPub=$vId");
  
   
    }
    catch (PDOException $e) { 
        header("Location: editor-pub?delPubERR=yes");
    } 

 
  
    }
    else  {

        echo "Es ist ein Fehler unterlaufen!";
   
   }

   //UPDATE------------------------------------------------------------

   if (isset($_GET['updId'])&& isset($_GET['newName'])&&!empty($_GET['updId']) &&!empty($_GET['newName'])) {
   
  try { 
    //namen ändern
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("UPDATE Verkuendiger SET Name = :neuerName Where VerkuendigerID = :vId");
    $stmt->bindParam(':neuerName', $neuerName, PDO::PARAM_STR);
    $stmt->bindParam(':vId', $vId, PDO::PARAM_INT);
    
    // ausführen
    $neuerName = $_GET['newName'];
    $vId = $_GET['updId'];
    $stmt->execute();
   header("Location: editor-pub?updatedPub=$neuerName");
  
   

   //error handling
  //  echo "\nPDO::errorInfo():\n"; 
   // print_r($dbh->errorInfo()); 
    //print_r($stmt->errorInfo()); 
    //print $dbh->errorCode();
//print $stmt->errorCode(); 
    }
    catch (PDOException $e) { 
        header("Location: editor-pub?updateERR=yes");
   } 

 
  
    }
    else  {

        echo "Es ist ein Fehler unterlaufen!";
   
   }








?>