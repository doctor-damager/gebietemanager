


    <tr >
    <?php    // echo $bearb_id.$geb_nr.$geb_inhaber.$ausgabe.$rueckgabe."<br>";  ?>
      <td onclick="editTD('<?php echo $bearb_id;  ?>')"><?php     echo $geb_inhaber;  ?></td>
      <td onclick="editTD('<?php echo $bearb_id;  ?>')"><?php     echo $ausgabe;  ?></td>
      <td onclick="editTD('<?php echo $bearb_id;  ?>')"><?php     echo $rueckgabe;  ?></td>  
      <td onclick="deleteP('<?php echo $bearb_id."','".$verk."','".$gebieteid."','".$publLast;  ?>')" id="<?php echo $i++; ?>"> <i class="fas fa-trash-alt"></i></td> 
    </tr>


