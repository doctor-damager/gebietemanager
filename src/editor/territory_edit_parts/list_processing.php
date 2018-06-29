
<?php 
$i= "'i'";
$a= "'a'";
$r= "'r'";
$bearb_id2 = "'".$bearb_id."'";

?>
    <tr >
    <?php    // echo $bearb_id.$geb_nr.$geb_inhaber.$ausgabe.$rueckgabe."<br>";  ?>
      <td <?php if($verk != "3"){ echo 'onclick="editTD('.$bearb_id2.','.$i.')"';}?> ><?php     echo $geb_inhaber;  ?></td>
      <td <?php if($verk != "3"){ echo 'onclick="editTD('.$bearb_id2.','.$a.')"'; }?>><?php     echo $ausgabe;  ?></td>
      <td <?php if($verk != "3"){ if($rueckgabe != null){ if($rueckgabe != ""){if($rueckgabe != " "){echo 'onclick="editTD('.$bearb_id2.','.$r.')"'; }}}}?>><?php     echo $rueckgabe;  ?></td>  
      <td onclick="deleteP('<?php echo $bearb_id."','".$verk."','".$gebieteid."','".$publLast."','".$BearbIdLast;  ?>')" id="<?php echo $i++; ?>"> <?php if($verk != "3"){ echo ' <i class="fas fa-trash-alt"></i>';}?></td> 
    </tr>

