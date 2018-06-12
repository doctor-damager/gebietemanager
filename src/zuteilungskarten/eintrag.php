
    <!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/style_karten.css" >
    <title>Titel</title>


</head>
<body style="-webkit-print-color-adjust:exact;">

<?php
//error loging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Datenbankverbindung
$mysqli = mysqli_connect("localhost","root","bobo","gebman");
if (mysqli_connect_errno($mysqli)) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//query Gebiet
$res_gebiet = mysqli_query($mysqli, 
                                        "SELECT * FROM `Gebiet`");
 echo"<page size='A4'><div class='background'><div class='positioniert'><table border='0' ><tr valign='top'colspan='5'>";    
 $i=0;                                  
 while($row2 = mysqli_fetch_assoc($res_gebiet)){
$i++;

$gebieteid = $row2['GebieteID'];
$gebietename = $row2['GebName'];

echo "<td><center><b>".$gebietename."</b></center>";

//query Bearbeitung
$res_bearbeitung = mysqli_query($mysqli, 
                                        "SELECT * FROM (SELECT * FROM `Bearbeitung`  
                                        LEFT JOIN Gebiet ON Bearbeitung.Gebietlink = Gebiet.GebieteID
                                        LEFT JOIN Verkuendiger ON Bearbeitung.Verkuendiger = Verkuendiger.VerkuendigerID WHERE Bearbeitung.Gebietlink = '$gebieteid' ORDER BY BearbeitungsID DESC LIMIT 13)sub ORDER BY BearbeitungsID ASC");       
                                                            
     echo"<table border='0' style='width:140px; padding-top:2px;font-size:11.5px;text-align:center;' >";   
while($row = mysqli_fetch_assoc($res_bearbeitung)){
    $bearb_id = $row['BearbeitungsID'];  
    $geb_nr = $row['GebName'];
    $geb_inhaber = $row['Name'];
    $ausgabe = $row['ausgabe'];
    $rueckgabe = $row['rueckgabe'];
    
echo "<tr valign='top'height='16px'><td colspan='2'><b>".$geb_inhaber."</b></td></tr><tr valign='top' height='15px'><td> ".date("m.Y", strtotime($ausgabe))."</td><td> ".date("m.Y", strtotime($rueckgabe))."</td></tr>";

} 
echo "</table>";
echo "<br></td>";

if ($i % 5===0){ echo"</tr></table></div></div></page><page size='A4'><div class='background'><div class='positioniert'><table border='0' ><tr valign='top'colspan='5'>";}
}
echo "</tr></table></div></div></page>";
?>

</body>
</html>