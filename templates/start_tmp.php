<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" />
    
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" /> 
    <link rel="icon" type="image/png" href="favicon.png" />
    
    

  <script   src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
 <script  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="  crossorigin="anonymous"></script>
 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<?php if(isset($_SESSION['userid'])) {?><script src="./assets/js/script.js"></script> <?php } ?>
<script src="./assets/js/bootpopup.min.js"></script>

    <title><?php if ($current_file_name == "geb") {echo "Home";} else {echo ucfirst($current_file_name);} ?> - Gebietemanager</title>
  </head>
  <body>


  
  <?php
  
  
if(isset($_POST['email'])) {
  $email = $_POST['email'];
  $passwort = $_POST['password'];
  
  $statement = $dbh->prepare("SELECT * FROM users WHERE email = :email");
  $result = $statement->execute(array('email' => $email));
  $user = $statement->fetch();
      
  //Überprüfung des Passworts
  if ($user !== false && password_verify($passwort, $user['passwort'])) {
      $_SESSION['userid'] = $user['id'];

  } else {
      $errorMessage = "E-Mail oder Passwort war ungültig<br>";
  }
  
}


if(!isset($_SESSION['userid'])) {
if(isset($errorMessage)) {
  echo $errorMessage;
}
include("datenschutz_modal.html");
include("impressum_modal.html");
echo '

<div class="container-fluid">
<div class="row justify-content-center">

<h1><i class="far fa-map"></i> <small><b>G</b>ebiete<b>M</b>anager </small></h1></div>

<div class="row justify-content-center mb-4"><small id="smalltext" class="form-text text-muted">JW Gebietebearbeitungsprogramm</small> </div>
<div class="row justify-content-center">
<form action="/geb/home" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email addresse</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Bitte Email eingeben!">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Passwort</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Passwort">
  </div>
  <button type="submit" class="btn btn-dark">einloggen</button>
</form>
</body>
</html>
</div>
</div>

</div>

'

;

  die('<h4 class="alert-light d-flex justify-content-center mt-5">Bitte zuerst&nbsp;<a href="login"> einloggen!</a></h4><br>
  <div class="card text-center fixed-bottom">
  
  <div class="card-footer text-muted">
<a data-toggle="modal" href="#impressum" href=""> Impressum </a>/ <a data-toggle="modal" href="#datenschutz" href="">Datenschutzerklärung</a>
  </div>
</div>');
}
if(!isset($_SESSION['userid'])) {
  die('<h4 class="alert-light d-flex justify-content-center mt-5">Bitte zuerst&nbsp;<a href="login"> einloggen!</a></h4><br>
  <div class="card text-center fixed-bottom">
  
  <div class="card-footer text-muted">
<a href=""> Impressum / Datenschutzerklärung</a>
  </div>
</div>');
}
$userid = $_SESSION['userid'];




  
  
  require_once(dirname(__FILE__).'/nav.php');
  include("changePubModal.php");
  
  
  
  
  
  ?>