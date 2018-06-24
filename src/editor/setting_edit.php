<div class="card-header">
    <b>EINSTELLUNGEN</b>
  </div>
 <div class="container-fluid"> 
 <div class="row justify-content-center"> <h4><b>Neuen Benutzer anlegen</b></h4></div
 <div class="row justify-content-center">


<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email2'];
    $passwort = $_POST['1passwort'];
    $passwort2 = $_POST['1passwort2'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $dbh->prepare("INSERT INTO users (email, passwort, vorname, nachname) VALUES (:email, :passwort, :vorname, :nachname)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => 'aendern', 'nachname' => 'aendern'));
        
        if($result) {        
            echo 'Benutzer wurde hinzugefügt!';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
 
<form action="/geb/editor-set?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email2"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="1passwort"><br>
 
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="1passwort2"><br><br>
 
<input type="submit" id="newUsr" name="newUsr" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
</div></div>