<div class="scan-this<?php echo $gebietename;?>">
<a href="editor?gebietename=<?php echo $gebietename;?>" class="btn btn-light" role="button"  id="<?php echo $gebietename;?>"style="margin-bottom:1rem;"><div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php if(file_exists($imgpath)) {echo $imgpath;} else {echo $placeholder;} ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo "<b><span class='float-left'><i class='fas fa-map'></i> ".$gebietename."</span><span class='float-right'><i class='fas fa-user-tie'></i> ".$geb_inhaber."</span></b>"; ?></h5>
    <br/>
    <p>Letzte Bearbeitung: <?php echo date("m.Y", strtotime($rueckgabe)); ?> </p>
 
   
  </div>
  <div class="card-footer  text-center text-muted" style="background-color:<?php echo agoBgColor($rueckgabe); ?>">
  <i class="fas fa-clock"></i> <?php 
 // $final = date("Y-m-d", strtotime("-1 month", strtotime($rueckgabe))); 
 //für ein monat mehr final ausklammern und unten einsetzen

  echo time_elapsed_string($rueckgabe); ?>
  </div>
</div> </a>
</div>
<script>
filterCards(<?php echo "'".$gebietename."'";?>);
</script>