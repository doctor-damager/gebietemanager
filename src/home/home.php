
<?php
try {
    $statement = $dbh->prepare("SELECT * FROM `Gebiet`");
    $statement->execute();
echo '<div class="container-fluid"> <div class="row row align-items-center justify-content-center">';
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