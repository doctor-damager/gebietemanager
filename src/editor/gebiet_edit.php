<?php if (isset($_GET['gebietename'])) {$gebieteid = $_GET['gebId'];  
try{
$stmt = $dbh->prepare("SELECT * FROM `Gebiet` WHERE GebieteID = $gebieteid");
$stmt->execute();
while ($rowTer = $stmt->fetch(PDO::FETCH_ASSOC)){

  $gebName = $rowTer['GebName'];  
  $iframe = $rowTer['iframe'];  
  $anmerkung = $rowTer['Anmerkung'];  

} 
$stmt = $dbh->prepare("SELECT * FROM (SELECT * FROM `Bearbeitung`  
LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid'  ORDER BY BearbeitungsID DESC )sub ORDER BY BearbeitungsID ASC");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $bearb_id = $row['BearbeitungsID'];  
    $geb_nr = $row['GebName'];
    $geb_inhaber = $row['Name'];
    $ausgabe = $row['ausgabe'];
    $rueckgabe = $row['rueckgabe'];
                 
?>



<div class="card-header">
    <b>GEBIET: <?php if (isset($_GET['gebietename'])) { echo $_GET['gebietename'];} else {echo "bitte auswählen";} ?> </b>
  </div>
  <div class="container-fluid">
   <div class="row">
            
   </div>
   
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6"> <?php echo $iframe;       ?> </div>
        <div class="col-md-6"><?php include('territory_edit_parts/list_processing.php'); ?></div>
    </div>
  </div>






 <?php 
 //End while
}
             

} catch (PDOException $e){
   //error handling
//  echo "\nPDO::errorInfo():\n"; 
print_r($dbh->errorInfo()); 
print_r($stmt->errorInfo()); 
print $dbh->errorCode();
print $stmt->errorCode(); 
echo "Error!: " . $e->getMessage() . "<br/>";
die();             } }?>

<script>$('iframe').width('100%');</script>