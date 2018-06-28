<?php require_once('./config/config.php'); ?>
<br class="br_top">



<?php
if (array_key_exists($path, $routes) ) {
    require $routes[$path];
  }else {
   echo "Error 404 Die Seite wurde nicht gefunden. Zurück zu<a href='/geb'> Home </a>";
  } ?>

    
<?php require_once('./templates/end_tmp.php'); ?>
