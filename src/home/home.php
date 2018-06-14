<div class="container-fluid editor-nav " >
    <div class="row">
    <div class="col-md-6">
        
    <input type="text" id="myFilter"  class="form-control float-left " name="myFilter" placeholder="Filter..."> </div> 


    


    <div class="col-md-6">
        <div class="row justify-content-center">
        <i class="fas fa-clock fa-2x" style="color:#fce731"></i>
 <label class="switch"> 
  <input type="checkbox" id="nine-months">
  <span class="slider round"></span>
</label>
<i class="fas fa-clock fa-2x" style="color:#ff8484"></i>
<label class="switch"> 
  <input type="checkbox" id="eleven-months">
  <span class="slider round"></span>
</label>
<i class="fas fa-user-times fa-2x" ></i>
<label class="switch"> 

  <input type="checkbox" id="eleven-months">
  <span class="slider round"></span>
</label>
</div>
</div>
    
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
    $imgpath  = "./assets/img/gebiete/".$gebietename.".jpg"; 
    $placeholder = "http://via.placeholder.com/250x150";

  
                       
    $statement_second = $dbh->prepare("SELECT * FROM (SELECT * FROM `Bearbeitung`  
    LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
    LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid' ORDER BY BearbeitungsID DESC LIMIT 1)sub ORDER BY BearbeitungsID ASC");
    $statement_second->execute();
   
    while ($row2 = $statement_second->fetch(PDO::FETCH_ASSOC)){

        $bearb_id = $row2['BearbeitungsID'];  
        $geb_nr = $row2['GebName'];
        $geb_inhaber = $row2['Name'];
        $ausgabe = $row2['ausgabe'];
        $rueckgabe = $row2['rueckgabe'];

  
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
