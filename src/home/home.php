<?php include('new_terr_modal.php'); ?>
<div class="container-fluid editor-nav " >
    <div class="row">
    <div class="col-md-6">
        
    <input type="text" id="myFilter" data-toggle="tooltip"  title="-- eingeben für freie Gebiete" class="form-control float-left mb-1" name="myFilter" placeholder="Filter..."> </div> 


    


    <div class="col-md-5">
        <div class="row justify-content-center">
        <i class="fas fa-clock fa-2x" style="color:#fce731"></i>
 <label class="switch"> 
  <input type="checkbox" id="nine-months" onclick="yellowOnes()">
  <span class="slider round"></span>
</label>
<i class="fas fa-clock fa-2x" style="color:#ff8484"></i>
<label class="switch"> 
  <input type="checkbox" id="eleven-months" onclick="redOnes()">
  <span class="slider round"></span>
</label>



</div>

</div>
<div class="col-md-1">   <div class="row justify-content-center"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#neuesGebietModal"><i class="fas fa-1x  fa-plus-square"> neues Gebiet</i></button> </div></div>
    
    </div>
    </div>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <?php 
  //Gebiet eingetragen
if(isset($_GET['NewTerCreated'])) {echo '<div class="alert alert-success r" role="alert">
Neues Gebiet wurde erstellt: '.$_GET["NewTerCreated"].'
</div>';} 
 // verkündiger gelöscht
if(isset($_GET['delPub'])) {echo '<div class="alert alert-success" role="alert">
Verk&uuml;ndiger mit ID: '.$_GET["delPub"].' wurde gel&ouml;scht!
</div>';} 
//einfügen fehlgeschagen
if(isset($_GET['duplicateError'])) {echo '<div class="alert alert-danger" role="alert">
Erstellen nicht möglich da bereits vorhanden!
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
 </div>
 </div>
<?php

try {
    $statement = $dbh->prepare("SELECT * FROM `Gebiet`");
    $statement->execute();
echo '<div class="container-fluid"> <div class="row align-items-center justify-content-center" id="filterdiv" name="filterdiv">';
   while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
  
 
    $gebieteid = $row['GebieteID'];
    $gebietename = $row['GebName'];
  
    $imgpath  = "./assets/img/gebiete/".$gebietename."_1.png"; 
    $placeholder = "http://via.placeholder.com/250x150";

  
                       
    $statement_second = $dbh->prepare("SELECT * FROM (SELECT * FROM `Bearbeitung`  
    LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
    LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid'  ORDER BY BearbeitungsID DESC LIMIT 1)sub ORDER BY BearbeitungsID ASC");
    $statement_second->execute();
   
    while ($row2 = $statement_second->fetch(PDO::FETCH_ASSOC)){

        $bearb_id = $row2['BearbeitungsID'];  
        $geb_nr = $row2['GebName'];
        $geb_inhaber = $row2['Name'];
        $ausgabe = $row2['ausgabe'];
        $rueckgabe = $row2['rueckgabe'];
        if ( $rueckgabe == NULL) {
            try {
              $statement3 = $dbh->prepare("SELECT rueckgabe FROM `Bearbeitung` WHERE Gebietlink = '$gebieteid' AND rueckgabe IS NOT NULL  ORDER BY BearbeitungsID DESC LIMIT 1 ");
              $statement3->execute();
         
             while ($row3 = $statement3->fetch(PDO::FETCH_ASSOC)){
              $rueckgabe = $row3['rueckgabe'];
            }
          }
      
      
            catch (PDOException $e) {
               echo "Error!: " . $e->getMessage() . "<br/>";
               die();
            }
          }

        include('card.php');
    }




   }
   $dbh = null;
   echo '</div></div>';
}


catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
?>

