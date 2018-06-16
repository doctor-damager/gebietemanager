<?php 
    
    if ( $rueckgabe == NULL) {
      try {
        $statement = $dbh->prepare("SELECT rueckgabe FROM `Bearbeitung` WHERE Gebietlink = '$gebieteid' AND rueckgabe IS NOT NULL  ORDER BY BearbeitungsID DESC LIMIT 1 ");
        $statement->execute();
   
       while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $rueckgabe = $row['rueckgabe'];
      }
    }


      catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
         die();
      }
    }
    ?>
    
<div class="scan-this<?php echo $gebietename;?> cards <?php echo agoBgColor($rueckgabe); ?>" id="cards"  style="    max-width: 270px;">
<a href="editor?gebietename=<?php echo $gebietename;?>&gebId=<?php echo $gebieteid;?>" class="btn btn-light" role="button"  id="<?php echo $gebietename;?>"style="margin-bottom:1rem;"><div class="card" style="width: 20rem; display:unset;  border:none;">
  <img class="card-img-top img-fluid"  style="max-height:150px; width:auto;" src="<?php if(file_exists($imgpath)) {echo $imgpath;} else {echo $placeholder;} ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title" style="  font-size: 1rem;"><?php echo "<b><span class='float-left'><i class='fas fa-map'></i> ".$gebietename."</span><span class='float-right'><i class='fas fa-user-tie'></i> ".$geb_inhaber."</span></b>"; ?></h5>
    <br/>
    <p>Letzte Bearbeitung: <?php 
    echo date("m.Y", strtotime($rueckgabe)); ?> </p>
    <?php if ($geb_inhaber == "frei") { echo'<span style="color:white;" hidden>--</span>' ;} ?>
   
  </div>
  <div class="card-footer  text-center text-muted"  id="card-footer">
  <i class="fas fa-clock"></i> <?php 
 // $final = date("Y-m-d", strtotime("-1 month", strtotime($rueckgabe))); 
 //für ein monat mehr final ausklammern und unten einsetzen

  echo time_elapsed_string($rueckgabe); 
 ?>
  </div>
</div> </a>
</div>
<script>
filterCards(<?php echo "'".$gebietename."'";?>);
</script>