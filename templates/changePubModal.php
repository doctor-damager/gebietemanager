<div class="modal"  name="changePubModal" id="changePubModal"tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Anderen Verkündiger Wählen:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cn">

      <select name="selN" id="selN"  class="custom-select">
      <option selected>Bitte wählen!</option>
<?php 
$stmt = $dbh->prepare("SELECT * FROM Verkuendiger");

$stmt->execute();
while ($rowp = $stmt->fetch(PDO::FETCH_ASSOC)){

    $id_P = $rowp['VerkuendigerID'];
    $name_P = $rowp['Name'];

    if ($id_P == "3") {continue;}
    
    echo '<option value="'.$id_P.'" id="'.$id_P.'">'.$name_P.'</option>';

}

    
    ?>
    </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Schließen</button>
      </div>
    </div>
  </div>
</div>

<div class="modal"  name="changeAusModal" id="changeAusModal"tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Neues Ausgabedatum:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cn1">

    <input type="month" class="form-control" name="newAus" id="newAus">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Schließen</button>
      </div>
    </div>
  </div>
</div>

<div class="modal"  name="changeRueckModal" id="changeRueckModal"tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Neues Rückgabedatum:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cn2">

    <input type="month" class="form-control" name="newRueck" id="newRueck">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Schließen</button>
      </div>
    </div>
  </div>
</div>


