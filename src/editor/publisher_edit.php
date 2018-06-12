

<div class="card-header">
    <b>VERK&Uuml;NDIGER</b>
  </div>


  <div class="container editor-nav " >
    <div class="row">
    <div class="col-md-7">
    <input type="text" id="myInput"  class="form-control float-left" name="myInput" placeholder="Filter..."> </div>
    <div class="col-md-5">
   <form name="newPubForm" class=" ml-auto "  method="post" action="/geb/publisher"> 

   
   <div class="form-group row">

   <div class="col-md-6">
    <input type="text" class="form-control  " id="newPublisher" name="newPublisher" placeholder="Nachname Vorname">  </div>

 <div class="col-md-6">   <button type="submit" class="btn btn-dark btn-block " > hinzuf&uuml;gen</button> </div>
</div>
</form> </div>
</div>

  </div>
  <?php if(isset($_GET['newPub'])) {echo '<div class="alert alert-success" role="alert">
Neuer Verk&uuml;ndiger wurde eingetragen: '.$_GET["newPub"].'
</div>';} ?>


<ul class="list-group list-group-flush " id="myList" name=myList>
<?php
$query = 'SELECT VerkuendigerID, Name FROM Verkuendiger ORDER BY Name';
foreach ($dbh -> query($query) as $row) {
   $publisher= $row['Name'];
   $publisherID= $row['VerkuendigerID'];

  echo '<li class="list-group-item  list-group-item-action " style="text-align: left" ><span class="float-left">'.$publisher.'</span> <span class="badge badge-primary badge-pill float-right">'.$publisherID.'</span></li>';
}
?>
</ul>




<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
