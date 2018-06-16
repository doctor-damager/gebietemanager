<?php 
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
require_once(dirname(__FILE__).'/../templates/start_tmp.php'); //starte htmlgerüst
require(dirname(__FILE__).'/../vendor/autoload.php'); //composer autoload von fremdpaketen

$user = "root";
$pass = "bobo";

$dbh = new PDO('mysql:host=localhost;dbname=gebman', $user, $pass);

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


?>