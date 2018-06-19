

<div class="card-header">
    <b>VERK&Uuml;NDIGER</b>
  </div>


  <div class="container editor-nav " >
    <div class="row">
    <div class="col-md-7">
    <input type="text" id="myFilter"  class="form-control float-left" name="myFilter" placeholder="Filter..."> </div>
    <div class="col-md-5">
   <form name="newPubForm" class=" ml-auto "  method="post" action="/geb/publisher"> 

   
   <div class="form-group row">

   <div class="col-md-6">
    <input type="text" class="form-control  " id="newPublisher" name="newPublisher" placeholder="Nachname Vorname" required = "required">  </div>

 <div class="col-md-6">   <button type="submit" class="btn btn-dark btn-block " > hinzuf&uuml;gen</button> </div>
</div>
</form> </div>
</div>

  </div>
  <?php 
  //verkündiger eingetragen
if(isset($_GET['newPub'])) {echo '<div class="alert alert-success" role="alert">
Neuer Verk&uuml;ndiger wurde eingetragen: '.$_GET["newPub"].'
</div>';} 
 // verkündiger gelöscht
if(isset($_GET['delPub'])) {echo '<div class="alert alert-success" role="alert">
Verk&uuml;ndiger mit ID: '.$_GET["delPub"].' wurde gel&ouml;scht!
</div>';} 
//löschen fehlgeschagen
if(isset($_GET['delPubERR'])) {echo '<div class="alert alert-danger" role="alert">
L&ouml;schen nicht m&ouml;glich aufgrund verkn&uuml;pfter Eintr&auml;ge!
</div>';}

 // verkündiger upgedated
 if(isset($_GET['updatedPub'])) {echo '<div class="alert alert-success" role="alert">
  Verk&uuml;ndiger erfolgreich umbenannt: '.$_GET["updatedPub"].'
  </div>';} 
  //Update fehlgeschagen
  if(isset($_GET['updateERR'])) {echo '<div class="alert alert-danger" role="alert">
  Umbenennen nicht m&ouml;glich! Name bereits vorhanden?
  </div>';}


?>
<div class="row">
<div class="col-md-4">
<ul class="list-group list-group-flush " id="myList" name=myList>
<?php
// READ---------------------------------------------------------
$query = 'SELECT VerkuendigerID, Name FROM Verkuendiger ORDER BY Name';

foreach ($dbh -> query($query) as $row) {

   $publisher= $row['Name'];
   $publisherID= $row['VerkuendigerID'];
   if ($publisherID == "3") {continue;}
  echo '<li class="list-group-item  list-group-item-action " style="text-align: left" id="'.$publisherID.'" >
  <span class="float-left">'.$publisher.'</span> <span class="badge badge-light badge-pill float-right">
  <i class="fas fa-pencil-alt fa-2x" onclick="update(\'publisher?updId='.$publisherID.'&newName=\',\''.$publisher.'\')" role="button"></i></span> <span class="badge badge-light badge-pill float-right">
  <a href="publisher?deleteID='.$publisherID.'"  role="button" onclick="return checkDelete()">
  <i class="fas fa-trash-alt fa-2x"></i></a></span></li>';
}
?>
</ul>
</div>
<div class="col-md-8"><h3>info/statistik (in bearbeitung)</h3></div>
</div>




<script>
filterme("#myList li");
activateListItem();


</script>