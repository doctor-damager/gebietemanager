<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}

require_once(dirname(__FILE__).'/../src/nav/router.php'); //starte router

require(dirname(__FILE__).'/../vendor/autoload.php'); //composer autoload von fremdpaketen


require_once(dirname(__FILE__).'/../config/db.php'); // Definiere Datenbank

function getDataAutocomplete($arraytype) {
   global $user,$pass, $dbh;
    $stmt = $dbh->prepare("SELECT GebName FROM Gebiet");
    $stmt->execute();
    /* Fetch all of the values in form of a numeric array */
    $ter = $stmt->fetchAll(PDO::FETCH_NUM);
   

    $stmt = $dbh->prepare("SELECT Name FROM Verkuendiger");
    $stmt->execute();
    /* Fetch all of the values in form of a numeric array */
    $publ = $stmt->fetchAll(PDO::FETCH_NUM);
    
$autompleteData = array_merge($ter,$publ);
$encoded = json_encode($autompleteData, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
$encodedTer = json_encode($ter, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
$encodedPub = json_encode($publ, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);


$replaceBrackets = array('[[',']','[',']');
$withoutBrackets = str_replace($replaceBrackets, "", $encoded);
$terWithoutBrackets = str_replace($replaceBrackets, "", $encodedTer);
$pubWithoutBrackets = str_replace($replaceBrackets, "", $encodedPub);

if ($arraytype == "combined") {echo $withoutBrackets;}
if ($arraytype == "ter") {echo $terWithoutBrackets;}
if ($arraytype == "pub") {echo $pubWithoutBrackets;}
}

// unbearbeitet seid
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'y' => 'Jahr',
        'm' => 'Monat',
        'w' => 'Woche',
        'd' => 'Tage',
        'h' => 'Stunden',
        'i' => 'Minuten',
        's' => 'Sekunden',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 2);
    return $string ? implode(' ', $string) . ' ' : '';
    
}

function agoBgColor($datetime){
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $days =($diff->m*30.4167)+($diff->d)+($diff->y*12*30.4167);
    $nineMonths = 273.75;
    $elevenMonths= 334.584;
    if($days >= $nineMonths && $days<$elevenMonths)  {
        return "nine";
}
else {
   
    if($days >= $elevenMonths)  {
        return "eleven";}
        else {
    return ""; 
}
}
}


require_once(dirname(__FILE__).'/../templates/start_tmp.php'); //starte htmlgerüst

?>