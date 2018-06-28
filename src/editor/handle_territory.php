<?php

//CREATE--------------------------------------------------

if (isset($_POST['newTerName'])) {


    try {
//neues gebiet in die db eintragen
$stmt = $dbh->prepare("INSERT INTO Gebiet (GebName, iframe, Anmerkung, stadteil, wohneinheiten, strassen) VALUES (:gebName, :iframe, :anmerkung, :stadteil, :wohneinheiten, :strassen)");
$stmt->bindParam(':gebName', $name);
$stmt->bindParam(':iframe', $iframe);
$stmt->bindParam(':anmerkung', $anmerkung);
$stmt->bindParam(':stadteil', $stadteil);
$stmt->bindParam(':wohneinheiten', $wohneinheiten);
$stmt->bindParam(':strassen', $strassen);


// ausführen
$name = $_POST['newTerName'];
$iframe = $_POST['theIframe'];
$anmerkung = $_POST['TerAnmerkung'];
$stadteil = $_POST['newStadtteil'];
$wohneinheiten = $_POST['newWohneinheiten'];
$strassen = $_POST['TerStrassen'];




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
    $ausgabe = NULL; ;
}
$rueckgabe = "1993-09.30";

$stmt3->execute(); 
} catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
}
  
  if( $stmt->errorInfo()[1]  == 1062) {
      $url = "return?duplicateError=yes";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$url.'";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
    echo '</noscript>';
   // header("Location: return?duplicateError=yes");
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
    

    $input= $_FILES["files"];


  

    if(isset($input["size"][1])){
     $first = $input["size"][0];
     $second = $input["size"][1];
 if($first<$second){
     
      $type=array_reverse($input['type']);
      $tmp_name=array_reverse($input['tmp_name']);
      $error=array_reverse($input['error']);
      $size=array_reverse($input['size']);
      $input = array_reverse($input['name']);
    $input = array_merge_recursive(array('name'=>$input),array('type'=>$type),array('tmp_name'=>$tmp_name),array('error'=>$error),array('size'=>$size));
 }
 echo "sortiert";
    }



    $counter = 0;
    
    foreach($input["tmp_name"] as $key=>$tmp_name){
        $temp = $input["tmp_name"][$key];
        $name2 = $input["name"][$key];
       
        
        if(empty($temp))
        {
            break;
        }
        
        $counter++;
        $UploadOk = true;
        $new_path = $UploadFolder.$name.'_'.$counter.'.'.$extension[0];
        if($input["size"][$key] > $totalBytes)
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

$url = "return?NewTerCreated=".$name;
echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';

}


if (isset($_POST['PicSubmit'])) {
echo '<div class="container fluid">
<div class="row">';
    $name = $_POST['theOldName'];
    $errors = array();
    $uploadedFiles = array();
    $extension = array("png");
    $bytes = 1024;
    $KB = 1024;
    $totalBytes = $bytes * $KB;
    $UploadFolder = "./assets/img/gebiete/";
    $DeleteInFolder = dirname(__FILE__)."/../../assets/img/gebiete/";
    $old_file1 = $DeleteInFolder.$name.'_1.png';
    if(file_exists($DeleteInFolder.$name.'_2.png')){     $old_file2 = $DeleteInFolder.$name.'_2.png';} else {$old_file2 = "notfound.png";}

   if(file_exists($old_file1)){ unlink($old_file1);}
 
   $input= $_FILES["files"];


  

   if(isset($input["size"][1])){
    if(file_exists($old_file2)){ unlink($old_file2);}
    $first = $input["size"][0];
    $second = $input["size"][1];
if($first<$second){
    
     $type=array_reverse($input['type']);
     $tmp_name=array_reverse($input['tmp_name']);
     $error=array_reverse($input['error']);
     $size=array_reverse($input['size']);
     $input = array_reverse($input['name']);
   $input = array_merge_recursive(array('name'=>$input),array('type'=>$type),array('tmp_name'=>$tmp_name),array('error'=>$error),array('size'=>$size));
}
echo "sortiert";
   }



$counter = 0;
    
    foreach($input["tmp_name"] as $key=>$tmp_name){
        $temp = $input["tmp_name"][$key];
        $name2 = $input["name"][$key];
       
        
        if(empty($temp))
        {
            break;
        }
        
        
        $counter++;
        $UploadOk = true;
        $new_path = $UploadFolder.$name.'_'.$counter.'.'.$extension[0];
        if($input["size"][$key] > $totalBytes)
        {
            $UploadOk = false;
            array_push($errors, $name2." darf nicht größer als 1MB sein.");
        }
        
        $ext = pathinfo($name2, PATHINFO_EXTENSION);
        if(in_array($ext, $extension) == false){
            $UploadOk = false;
            array_push($errors, $name2." Falscher Dateityp.");
        }
        
        if(file_exists($new_path) == true){
            $UploadOk = false;
            array_push($errors, $new_path." exestiert bereits.");
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
            echo "<b>Hochgeladen:</b>";
            echo "<br/><ul>";
            foreach($uploadedFiles as $fileName)
            {
                echo "<li>".$fileName."</li>";
            }
            echo "</ul><br/>";
            
            echo count($uploadedFiles)." wurden erfolgreich hochgeladen.";

$url = "return";
echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';
        }								
    }

   
    else{
        echo "Bitte wählen Sie Dateien aus.";
    }
 
echo '</div>
</div>';
}



if (isset($_POST['updateBigPicSubmit'])) {
    echo '<div class="container fluid">
    <div class="row">';
        $name = $_POST['theOldName'];
        $errors = array();
        $uploadedFiles = array();
        $extension = array("png");
        $bytes = 1024;
        $KB = 1024;
        $totalBytes = $bytes * $KB;
        $UploadFolder = "./assets/img/gebiete/";
        $DeleteInFolder = dirname(__FILE__)."/../../assets/img/gebiete/";
        $old_file1 = $DeleteInFolder.$name.'_big.png';
    
       if(file_exists($old_file1)){ unlink($old_file1);}
     
       $input= $_FILES["file"];
        

            $temp = $input["tmp_name"];
            $name2 = $input["name"];
           
            
            if(empty($temp))
            {
                exit;
            }
            
            
         
            $UploadOk = true;
            $new_path = $UploadFolder.$name.'_big.'.$extension[0];
            if($input["size"] > $totalBytes)
            {
                $UploadOk = false;
                array_push($errors, $name2." darf nicht größer als 1MB sein.");
            }
            
            $ext = pathinfo($name2, PATHINFO_EXTENSION);
            if(in_array($ext, $extension) == false){
                $UploadOk = false;
                array_push($errors, $name2." Falscher Dateityp.");
            }
            
            if(file_exists($new_path) == true){
                $UploadOk = false;
                array_push($errors, $new_path." exestiert bereits.");
            }
            
            if($UploadOk == true){
                move_uploaded_file($temp,$new_path);
                array_push($uploadedFiles, $name2);
            }
        
        
       
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
                echo "<b>Hochgeladen:</b>";
                echo "<br/><ul>";
                foreach($uploadedFiles as $fileName)
                {
                    echo "<li>".$fileName."</li>";
                }
                echo "</ul><br/>";
                
                echo count($uploadedFiles)." wurden erfolgreich hochgeladen.";
    
    $url = "return";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$url.'";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
    echo '</noscript>';
            }								
     
    
       
        else{
            echo "Bitte wählen Sie Dateien aus.";
        }
     
    echo '</div>
    </div>';
    }

?>