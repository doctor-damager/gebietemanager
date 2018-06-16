<div class="modal fade" id="neuesGebietModal" tabindex="-1" role="dialog" aria-labelledby="neuesGebietModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="neuesGebietModalLabel">Erstellen eines neuen Gebietes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      
      <form name="newTerForm" id="newTerForm" method="post" action="/geb/territory" enctype="multipart/form-data">
  <div class="form-group">
    <label for="GebieteName">Gebietsnummer:</label>
    <input type="input" class="form-control" maxlength="6" id="newTerName" name="newTerName" required="required" placeholder="z.B. 345">
  </div>
  <div class="form-group">
    <label for="Verkuendiger">Verk&uuml;ndiger</label>
    <select class="form-control" id="newTerPubNameId" name="newTerPubNameId">
      <option id="frei" name="frei" value="1">Freies Gebiet</option>
      <?php 
    
      try {
        $statement = $dbh->prepare("SELECT * FROM `Verkuendiger` ORDER BY Name ASC ");
        $statement->execute();
   
       while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $pubName = $row['Name'];
        $pubNameId = $row['VerkuendigerID'];

        if ($pubNameId == "1") {continue;}
       echo' <option id="pub-'.$pubNameId.'" name="pub-'.$pubNameId.'" value='.$pubNameId.'>'.$pubName.'</option>';
      }
    }


      catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
       
         die();
      }

    ?>
   
    </select>
  </div>
  <div class="form-group">
    <label for="Ausgabe">Ausgabe</label>
    <input id="newTerAusgabe" name="newTerAusgabe" id="newTerAusgabe" type="month">
  </div>

  <div class="form-group">
    <label for="BildHochaden">Karte und QR-Code hochladen (.png max 1Mb)</label>
    <input type="file" name="files[]" multiple="multiple" />
  </div>
  <div class="form-group">
    <label for="Iframe">iframe:</label>
    <textarea maxlength="800" class="form-control" id="theIframe" name="theIframe" rows="2"></textarea>
  </div>
  <div class="form-group">
    <label for="Anmerkung">Anmerkung</label>
    <textarea maxlength="250" class="form-control" id="TerAnmerkung" name="TerAnmerkung" rows="3"></textarea>
  </div>
</form>













      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" form="newTerForm" name="btnSubmit" >Gebiet erstellen</button>
      </div>
    </div>
  </div>
</div>