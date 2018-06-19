<?php require_once("./../../config/db.php");

$gebiet = $_POST["gebiet"];
$verk = $_POST["verk"];
$ausgabe = $_POST["ausgabeForDb"];
$rueckgabe = $_POST["rueckgabeForDb"];
if ( !isset($_POST['frei'])){ $frei = "false";} else{
$frei = $_POST["frei"];}

$condition = "false";
$message = "Fehlerhafte Eingabe";

if($ausgabe == "false" && $ausgabe != "" && strlen($ausgabe) <= 5 && $rueckgabe == "false" && $verk != "frei" ) {$ausgabe = date("Y-m-d"); $rueckgabe = null; $condition = "sofort"; $message = "Gebiet ".$gebiet." wurde heute an ".$verk." ausgegeben.";} //(sofoftige Ausgabe) Bedingung 
else{
    if($ausgabe != "false" && $ausgabe != "" && $rueckgabe != "false" && $rueckgabe != "" && $frei != "false" && $frei != "") {$condition = "einmalig_bearbeitet"; $message = "Gebiet ".$gebiet." wurde von ".$verk." einmalig bearbeitet und zurückgegeben.";} //(einmalige Bearbeitung) ausgegeben, bearbeitet und wieder zurückgegeben Bedingung
    if($ausgabe == "false" && $rueckgabe != "false" && $rueckgabe != "" && $frei == "false") {$condition = "bearbeitet"; $message = "Gebiet ".$gebiet." wurde am ".date('m.Y', strtotime($rueckgabe))." bearbeitet und sofort wieder an ".$verk." ausgegeben.";} //(nur Bearbeitung) nur bearbeitet und weiterbehalten Bedingung
    if($ausgabe != "false" && $ausgabe != "" && $rueckgabe != "false" && $rueckgabe != ""  && ($frei == "false" or  $frei == "")) {$condition = "bereits_ausgegeben"; $message = "Gebiet ".$gebiet." ist bereits ausgegeben. Nur Bearbeitung oder Rückgabe möglich! Falls Einmalige Bearbeitung -> ,frei <- hinzufügen.";} //(bereits ausgegeben) nur bearbeitet und weiterbehalten Bedingung
    if($ausgabe != "false" && $rueckgabe == "false" && $frei == "false" && strlen($ausgabe) > 5) {$condition = "ausgabe"; $message = "Gebiet ".$gebiet." wurde zum ".date('m.Y', strtotime($ausgabe))." an ".$verk." ausgegeben.";} //(nur Ausgabe) ausgegeben zum bestimten Datum Bedingung
    if($ausgabe == "false" && $rueckgabe != "false" && $rueckgabe != "" && $frei != "false" && $frei != "") {$condition = "rueckgabe"; $message = "Gebiet ".$gebiet." wurde zum ".date('m.Y', strtotime($rueckgabe))." von ".$verk." bearbeitet und wurde dann abgegeben.";} //(nach Bearbeitung frei) bearbeitet und zurückgegeben Bedingung
    if($verk == "frei") {$condition = "unbearbeitet"; $message = "Gebiet ".$gebiet." ubearbeitet zurückgegeben.";} //(unbearbeitet zurück) nicht bearbeitet und zurückgegeben Bedingung
}
//verkündiger ID
 $stmt = $dbh->prepare("SELECT VerkuendigerID FROM Verkuendiger WHERE Name = :verk");
 $stmt->bindparam(':verk', $verk);
 $stmt->execute();
 $verkId = $stmt->fetchColumn();

 //gebiete ID

 $stmt = $dbh->prepare("SELECT GebieteID FROM Gebiet WHERE GebName = :gebiet");
 $stmt->bindparam(':gebiet', $gebiet);
 $stmt->execute();
 $gebietId = $stmt->fetchColumn();

 //echo $gebiet." / ".$verk." / ".$ausgabe." / ".$rueckgabe." / ".$frei." / ".$verkId." / ".$gebietId." / ".$condition." / ".$message;
 


function msgDiv($class,$msg){
    if ($class == 1){
    echo "<div class='row alert-success justify-content-center'>".$msg." <a href='/geb'><i class='fas fa-sync ml-2'></i></a></div> <script>$('input[name=console').val('');</script>";}
    if ($class == 0){
        echo "<div class='row alert-danger justify-content-center'>".$msg."</div>";}
}

//  EINTRÄGE 
//sofortige Ausgabe

if ($condition == "sofort") { include("./console_conditions/sofort.php"); }


// einmalige bearbeitung
if ($condition == "einmalig_bearbeitet") { include("./console_conditions/einmalig.php"); }

// nur bearbeitung

if ($condition == "bearbeitet") { include("./console_conditions/bearbeitet.php"); }

// nur ausgabe

if ($condition == "ausgabe") { include("./console_conditions/ausgabe.php"); }

//rueckgabe

if ($condition == "rueckgabe") { include("./console_conditions/rueckgabe.php"); }

// unbearbitet zurück

if ($condition == "unbearbeitet") { include("./console_conditions/unbearbeitet.php"); }
if ($condition == "bereits_ausgegeben") { msgDiv(0,"Fehlende oder überflüssige Eingaben! Bitte Format beachten!"); }
if ($condition == "false") { msgDiv(0,"Fehlerhafte Eingabe"); }


?>
