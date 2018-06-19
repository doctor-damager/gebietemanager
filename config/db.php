<?php 
$user = "root";
$pass = "bobo";

$dbh = new PDO('mysql:host=localhost;dbname=gebman', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>