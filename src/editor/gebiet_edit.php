<div class="card-header">
    <b>GEBIET: <?php if (isset($_GET['gebietename'])) { $nameOfTer = $_GET['gebietename']; echo $nameOfTer;} else {} ?> </b>
 

<select name="selT" style="max-width:20%;" id="selT"  class="custom-select">
      <option selected>Bitte wählen!</option>
<?php 
$stmt = $dbh->prepare("SELECT * FROM Gebiet");

$stmt->execute();
while ($rowp = $stmt->fetch(PDO::FETCH_ASSOC)){

    $id_P = $rowp['GebieteID'];
    $name_P = $rowp['GebName'];

    if ($id_P == "3") {continue;}
    
    echo '<option value="'.$id_P.'" id="'.$id_P.'">'.$name_P.'</option>';

}

    
    ?>
    </select>
    </div>


<?php if (isset($_GET['gebietename'])) {$gebieteid = $_GET['gebId'];
try{
$stmt = $dbh->prepare("SELECT * FROM `Gebiet` WHERE GebieteID = $gebieteid");
$stmt->execute();
while ($rowTer = $stmt->fetch(PDO::FETCH_ASSOC)){

  $gebName = $rowTer['GebName'];  
  $iframe = $rowTer['iframe'];  
  $anmerkung = $rowTer['Anmerkung'];  
  $strassen = $rowTer['strassen']; 
  $wohneinheiten = $rowTer['wohneinheiten']; 
  $stadtteil = $rowTer['stadteil']; 
  $nichtbesuchen = $rowTer['nichtbesuchen']; 
  $rueckbesuche = $rowTer['rueckbesuche']; 

} 
?> 




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
<div class="col-sm-12">

<a class="btn btn-dark " role="button" id="print_a4" name="print_a4" href="/geb/printcard?id=<?php echo $gebieteid; ?>"> <i class="fas fa-print"></i> Gebietskarte Drucken </a>

</div>
<div class="col-sm-12 mt-1">

<a class="btn btn-dark " role="button" href='whatsapp://send?text=GEBIET NR.: <?php echo $gebName ?>       STADTTEIL: <?php echo $stadtteil ?>          STRAẞEN: <?php echo $strassen ?>       RÜCKBESUCHE: <?php echo $rueckbesuche ?>       NICHT BESUCHEN: <?php echo $nichtbesuchen ?>          ANMERKUNG: <?php echo $anmerkung ?>               Bitte melde das Gebiet dem Gebietsdiener wenn du es bearbeitet hast! Viel Freude im Dienst :) '><i class="fab fa-whatsapp"></i> teilen</a>

</div>
<br/>
<br/>
</div>
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
<div class="row">
<div class="col-sm-12">
<div class="card">
  <div class="card-header bg-dark text-white" >
    STRASSEN:
  </div>
 
  <ul class="list-group">
  <?php
  $straße = explode("+", $strassen);
  foreach ($straße as $item) {
    if ($item ==""){continue;} 
    echo "<li class='list-group-item'>".$item."</li>";
  }?>
  </ul>
  
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card">
  <div class="card-header bg-dark text-white" >
    RÜCKBESUCHE:
  </div>
 
  <ul class="list-group">
  
  <?php
  $rueckbesuch = explode("+", $rueckbesuche);
  foreach ($rueckbesuch as $item) {
    if ($item ==""){continue;} 
    echo "<li class='list-group-item'>".$item."</li>";
  }?>
  </ul>
  
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card">
  <div class="card-header bg-dark text-white" >
    NICHT BESUCHEN:
  </div>
 
  <ul class="list-group">
  <?php
  $nichtbesuch = explode("+", $nichtbesuchen);
  foreach ($nichtbesuch as $item) {
    if ($item ==""){continue;} 
    echo "<li class='list-group-item'>".$item."</li>";
  }?>
  </ul>
  
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card">
  <div class="card-header bg-dark text-white" >
    ANMERKUNG:
  </div>

  <?php
    echo $anmerkung;?>
  </ul>
  
</div>
</div>
</div>
</div> 
        
        </div>
    </div>
  </div>








<script>
 $('#selT').change(function(){
        var the_selected = $( '#selT' ).val();
        var theName = $( '#selT' ).text();
        window.location.replace("editor?gebietename="+theName+"&gebId="+the_selected);
      
 });

$('iframe').width('100%');
$('#<?php echo $i-1;?>').html(" ");
$('#<?php echo $i-1;?>').prop('onclick',null).off('click');


</script>

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
 $('#selT').change(function(){
        var the_selected = $( '#selT' ).val();
        var theName = $( '#'+the_selected ).text();
        window.location.replace("editor?gebietename="+theName+"&gebId="+the_selected);
      
 });
 </script>