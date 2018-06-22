<?php 

$img1= "./assets/img/gebiete/".$nameOfTer."_1.png";
$img2= "./assets/img/gebiete/".$nameOfTer."_2.png";
if(file_exists($img1) && file_exists($img1) ) { if (filesize($img1) > filesize($img2))  {$mapImg=$img1; $qr=$img2;} else{ $mapImg=$img2; $qr=$img1;}}
if(!file_exists($img1)) { $mapImg = "http://via.placeholder.com/250x150";}
if(!file_exists($img2)) { $qr = "http://via.placeholder.com/250x150";}



?>
<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
<li class="nav-item">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-2x fa-image"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-2x fa-map-marker-alt"></i></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-2x fa-qrcode"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#pills-setting" role="tab" aria-controls="pills-setting" aria-selected="false"><i class="fas fa-2x fa-cog"></i></a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><img class="img-fluid" src="<?php echo $mapImg ?>" alt="Gebietskarte"></div>

  <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><?php if (isset($iframe)){echo $iframe."<br/>";} else {echo "<img src='http://via.placeholder.com/250x150' alt='nicht vorhanden'>";}?></div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><img class="img-thumbnail" src="<?php echo $qr ?>" alt="qr-code"></div>
  <div class="tab-pane fade" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
  IFRAME:
  <textarea id ="changeTerIframe" rows="6" style="min-width: 100%">
 <?php echo htmlspecialchars("$iframe"); ?>
 </textarea>
 <br/>
 ANMERKUNG:
 <textarea  id ="changeTerAn" rows="4" style="min-width: 100%">
 <?php echo htmlspecialchars("$anmerkung"); ?>
</textarea>

 <br/>

 <br/>
 NAME ÄNDERN:
 <br/>
<input type="text" id ="changeTerName" maxlength="6" style="width:100%;" value="<?php echo htmlspecialchars($nameOfTer); ?>">
<input type="text" id ="oldName"  value="<?php echo htmlspecialchars($nameOfTer); ?>" hidden>
<input type="text" id ="gebid"  value="<?php echo htmlspecialchars($gebieteid); ?>" hidden>

  <br/>
  <br/>
  <button type="submit" class="btn btn-dark btn-block" id="changeTerSet" id="name" onclick="updateTer()">UPDATE</button>
  <br/>
  <br/>
  <form name="updatePics" id="updatePics" method="post" action="/geb/territory" enctype="multipart/form-data">
  <div class="form-group">
    <label for="BildHochaden">Karte und QR-Code hochladen (.png max 1Mb)</label>
    <input type="file" name="files[]" multiple="multiple"  required = 'required'/>
    <input type="text" id ="theOldName" name="theOldName"  value="<?php echo htmlspecialchars($nameOfTer); ?>" hidden>
  </div>
  </form>
  <br/>
  <button type="submit" class="btn btn-dark btn-block" form="updatePics" id="PicSubmit" name="PicSubmit" >Gebiet erstellen</button>
  <br/>
  <br/>


  GEBIET LÖSCHEN:
  <br/>

<i class="fas fa-4x fa-trash" style="color:red;" onclick="deleteTer('<?php echo $gebieteid; ?>')"></i>
<br/>

  
  </div>
</div>
<br/>
