<?php

//CREATE--------------------------------------------------

if (isset($_POST['newPublisher'])) {
//neuen verkuendiger in die db eintragen
$stmt = $dbh->prepare("INSERT INTO Verkuendiger (Name) VALUES (:name)");
$stmt->bindParam(':name', $name);

// ausführen
$name = $_POST['newPublisher'];
$stmt->execute();
$url = "editor-pub?newPub=$name";

echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';

} else  {

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
  // header("Location: editor-pub?delPub=$vId");
   $url = "editor-pub?delPub=$vId";
   echo '<script type="text/javascript">';
   echo 'window.location.href="'.$url.'";';
   echo '</script>';
   echo '<noscript>';
   echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
   echo '</noscript>';
   
    }
    catch (PDOException $e) { 
       // header("Location: editor-pub?delPubERR=yes");
        $url = "editor-pub?delPubERR=yes";

echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';
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
  // header("Location: editor-pub?updatedPub=$neuerName");
   $url = "editor-pub?updatedPub=$neuerName";

   echo '<script type="text/javascript">';
   echo 'window.location.href="'.$url.'";';
   echo '</script>';
   echo '<noscript>';
   echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
   echo '</noscript>';
   

   //error handling
  //  echo "\nPDO::errorInfo():\n"; 
   // print_r($dbh->errorInfo()); 
    //print_r($stmt->errorInfo()); 
    //print $dbh->errorCode();
//print $stmt->errorCode(); 
    }
    catch (PDOException $e) { 
       // header("Location: editor-pub?updateERR=yes");
        $url = "editor-pub?updateERR=yes";

        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
   } 

 
  
    }
    else  {

        echo "Es ist ein Fehler unterlaufen!";
   
   }








?>