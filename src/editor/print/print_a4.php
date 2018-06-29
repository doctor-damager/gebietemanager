

<style>

ul li:first-of-type {
    list-style: none;
    margin-left: -1em;
    /*some other header styles*/
}
body {
    background: rgb(204,204,204); 
 
  }
  page {
    background: white;
    display: block;
    margin-bottom: 2.5cm!important;
    margin: 0 auto;
    box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  }
  page[size="A4"] {  
    height: 209mm;
    width: 296.685mm; 
  }

.col-md-6 {
    
 /*   background-color: yellow;
    border: 2px solid black; */
    }




  
  @page {
    size: A4 landscape;
    margin: 0;
  }
  @media print {
    body, page {
      margin: 0!important;
      box-shadow: 0!important;
    }
    .br_top{
        display:none;
    }
  }

</style>

<?php 
if(isset($_GET["id"])){
$stmt = $dbh->prepare("SELECT * FROM `Gebiet` WHERE GebieteID = :id");
$id = $_GET["id"];
$stmt->bindparam(':id', $id);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $name = $row["GebName"]; 
  $anmerkung = $row['Anmerkung'];  
  $strassen = $row['strassen']; 
  $wohneinheiten = $row['wohneinheiten']; 
  $stadtteil = $row['stadteil']; 
  $nichtbesuchen = $row['nichtbesuchen']; 
  $rueckbesuche = $row['rueckbesuche']; 
}

} else{
    echo "Fehler!";
}



?>
<div class="container-fluid d-lg-none  d-print-none">
    <div class="row"><h5>Korrekte Darstellung zum Drucken nur auf Google Chromeid am PC in der Desktopversion! <small>Hintergrundgrafiken ativieren!</small></h5></div>
</div>
<button type="button" class="btn btn-dark btn-circle d-print-none" onclick="window.print();"><i class="fas fa-print"></i></button>

<page size='A4'>
<div class="container-fluid" style="height:100%">
<div class="row" style="height:43%">
    <div class="col-md-6" style="border-right:1px groove;">




        
        <div class="row" style="height:100%">
     <div class=" col-md-9 ">
        
    <ul class="mt-4 " style="list-style-type:none;" >
  <li><h6><i class="fas fa-sync-alt"></i><b> RÜCKBESUCHE:</b></h6></li>
  <?php
  $rueckbesuch = explode("+", $rueckbesuche);
  foreach ($rueckbesuch as $item) {
    if ($item ==""){continue;} 
    echo "<li ><i class='fas fa-user-plus'></i> ".$item."</li>";
  }?>
  </ul>
  
  </div>
  <div class=" col-md-3 mt-4">
      
      <i class="fas fa-lightbulb"></i><small class="text-muted"> Bitte trag deine Rückbesuche in die Liste ein. Sie wird bei der nächsten Rückabe aktualisiert!</small>
      
  </div>
  </div>

    


    </div>
    <div class="col-md-6">
        
    <div class="row" style="height:100%">
     <div class=" col-md-8 ">
        
    <ul class="mt-4" style="list-style-type:none;" >
  <li><h6><i class="fas fa-ban"></i><b> NICHT BESUCHEN:</b></h6></li>
  <?php
  $nichtbesuch = explode("+", $nichtbesuchen);
  foreach ($nichtbesuch as $item) {
    if ($item ==""){continue;} 
    echo "<li><i class='fas fa-user-minus'></i> ".$item."</li>";
  }?>
  </ul>
  
  </div>
  <div class=" col-md-4 mt-4">
      
      <i class="fas fa-lightbulb"></i><small class="text-muted"> Bitte trag neue "nicht besuchen" Adressen in die Liste ein. Sie wird bei der nächsten Rückabe aktualisiert!</small>
      
  </div>
  </div>
    </div>
</div>
<hr>
    <div class="row justify-content-center clearfix" style="height:43%">
        <div class="col-md-6 clearfix" style="border-right:1px groove;"><div class="row justify-content-center"><h5><i class="fas fa-map"></i> Gebiet Nr.: <b><?php  echo $name; ?> </b></h5>
        </div>
        <div class="row justify-content-center clearfix" ><img id="card_img" src="./assets/img/gebiete/<?php  echo $name; ?>_1.png" class="fitimg" alt="" ></div>
        
        </div>

        <div class="col-md-6">

        <div class="row justify-content-between"><h5 class="ml-4"><b><i class="fas fa-map-signs"></i> <?php  echo $stadtteil; ?></b></h5> <h5 class="mr-4"><i class="fas fa-users"></i> <?php  echo  $wohneinheiten; ?></h5></div>
        
        <div class="row" style="height:100%">
     <div class=" col-md-8 streets">
        
    <ul style="list-style-type:none;">
  <li><h6><i class="fas fa-location-arrow " ></i><b>STRAßEN:</b></h6></li>
  <?php
  $strasse = explode("+", $strassen);
  foreach ($strasse as $item) {
    if ($item ==""){continue;} 
    echo "<li ><i class='fas fa-building'></i>".$item."</li>";
  }?>
  </ul>
  
  </div>
  <div class=" col-md-4 streets">
      <div class="row">
      <div class="col-md-12" style="height: 8.5rem;"><i class="fas fa-lightbulb"></i><small class="text-muted"> Sollten neue Gebäude im Gebiet gebaut werden, dann trag diese bitte in die Liste ein und informiere den Gebietsdiener.</small></div>
      <div class="col-md-12" ><br><img id="QR_card" src="./assets/img/gebiete/<?php  echo $name; ?>_2.png"  alt="" ></div>
  </div></div>
  </div>
        </div>
    </div>
    <div class="row" id="scissors">
        <?php for($i=0; $i<=17; $i++){echo "&emsp;<i class='fas fa-cut'></i>&emsp;&emsp;";}?>
        <br>
        <span>&emsp;&emsp;</span> <i class="fas fa-hand-point-left fa-3x"></i>  &emsp; <h6 class="text-muted"> Zum bedrucken der Rückseite in angezeigter Richtung ins Papierfach legen.</h6>
    
</div>
</div>




</page>
<!-- page 2-->

<page size='A4'>
    <div class="container-fluid"  style="height:100%">
  
    <div class="row" id="scissors2" style="height:8%"> 
        <div class="mt-5"><?php for($i=0; $i<=17; $i++){echo "&emsp;<i class='fas fa-cut'></i>&emsp;&emsp;";}?></div>
       
    
</div>
        <div class="row"  style="height:92%">
            <div class="col-md-6">
<div class="row" style="height:50%"></div>
<div class="row justify-content-center" style="height:50%">
<div class="container-fluid">  
<div class="row justify-content-center" >
<h6 class="mt-4"><i class="far fa-edit"></i><b> ANMERKUNGEN:</b></h6></div>
<div class="row justify-content-center" >
<i class="fas fa-tasks"> </i> &nbsp;<small>  Bitte teile dem Gebietsdiener jede Bearbeitung des Gebietes mit.</small></div>
<div class="row justify-content-center" >
<i class="fas fa-lightbulb"></i><small class="text-muted"> Hier können besodere Vermerke notiert werden.</small></div>

<div class="row  m-3" ><?php echo $anmerkung;?></div>

</div>  
</div>


            </div>
            <div class="col-md-6"><img id="card_big_img" src="./assets/img/gebiete/<?php  echo $name; ?>_big.png"  alt="" class="bigImg" ></div>
        </div>


    </div>


</page>



<script>
   function imgSize(){
        var myImg = document.querySelector("#card_img");
        var realWidth = myImg.naturalWidth;
        var realHeight = myImg.naturalHeight;

        if(realHeight > realWidth){ 
           
            myImg.className = "fitimgportrait";

        }
       
    }
    function imgBigSize(){
        var myImg = document.querySelector("#card_big_img");
        var realWidth = myImg.naturalWidth;
        var realHeight = myImg.naturalHeight;

        if(realHeight < realWidth){ 
           
            myImg.className = "bigImgportrait";

        }
       
    }
imgSize();
imgBigSize();
</script>