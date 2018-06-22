<?php if (isset($_GET['gebietename'])) {$gebieteid = $_GET['gebId'];   $nameOfTer = $_GET['gebietename'];
try{
$stmt = $dbh->prepare("SELECT * FROM `Gebiet` WHERE GebieteID = $gebieteid");
$stmt->execute();
while ($rowTer = $stmt->fetch(PDO::FETCH_ASSOC)){

  $gebName = $rowTer['GebName'];  
  $iframe = $rowTer['iframe'];  
  $anmerkung = $rowTer['Anmerkung'];  

} 
?> 



<div class="card-header">
    <b>GEBIET: <?php if (isset($_GET['gebietename'])) { echo $nameOfTer;} else {echo "bitte auswählen";} ?> </b>
  </div>
  <div class="container-fluid">
   <div class="row">
            
   </div>
   <br/>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6"> <?php include('territory_edit_parts/frame_img_qr.php'); ?> </div>
        <div class="col-md-6">
        <div class="container-fluid">
<div class="row">
<table class="table table-striped small">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Verk&uuml;ndiger</th>
      <th scope="col">Ausgabe</th>
      <th scope="col">R&uuml;ckgabe</th>
      <th scope="col"><i class="fas  fa-trash-alt"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php


$stmt = $dbh->prepare("SELECT * FROM (SELECT * FROM `Bearbeitung`  
LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid'  ORDER BY BearbeitungsID DESC LIMIT 1)sub ORDER BY BearbeitungsID ASC");
$stmt->execute();

while ($row_last = $stmt->fetch(PDO::FETCH_ASSOC)){

    $rueckgabeLast = $row_last['rueckgabe'];
    $ausgabeLast = $row_last['ausgabe'];
    $publLast = $row_last['Verkuendiger'];
    $BearbIdLast = $row_last['BearbeitungsID'];}

  $stmt = $dbh->prepare("SELECT * FROM `Bearbeitung`  
  LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
  LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid'  ORDER BY BearbeitungsID DESC LIMIT 25");
  $stmt->execute();
  $i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $bearb_id = $row['BearbeitungsID'];  
    $geb_nr = $row['GebName'];
    $verk = $row['Verkuendiger'];
    $geb_inhaber = $row['Name'];
    $ausgabe = $row['ausgabe'];
    $rueckgabe = $row['rueckgabe'];
    $the_real_ausgabe = $row['ausgabe'];
    $the_real_rueckgabe = $row['rueckgabe'];

    $rueckgabe2 = date("m.Y", strtotime($rueckgabe));;
    $ausgabe2 = date("m.Y", strtotime($ausgabe));;
    if ($rueckgabe === "1993-09-30") { $rueckgabe=" ";} else {
      if ($rueckgabe == NULL) { $rueckgabe=" ";} else {
      $rueckgabe = $rueckgabe2;} }
      if ($ausgabe === "1993-09-30") { $ausgabe=" ";} else {
          if ($ausgabe == NULL) { $ausgabe=" ";} else {
          $ausgabe = $ausgabe2;} }            
?>
        <?php include('territory_edit_parts/list_processing.php');   //End while
}?>
        </tbody>
</table>
</div>
</div> 
        
        </div>
    </div>
  </div>






 <?php 

             

} catch (PDOException $e){
   //error handling
//  echo "\nPDO::errorInfo():\n"; 
print_r($dbh->errorInfo()); 
print_r($stmt->errorInfo()); 
print $dbh->errorCode();
print $stmt->errorCode(); 
echo "Error!: " . $e->getMessage() . "<br/>";
die();             } }?>

<script>

$('iframe').width('100%');
$('#<?php echo $i-1;?>').html(" ");
$('#<?php echo $i-1;?>').prop('onclick',null).off('click');


</script>