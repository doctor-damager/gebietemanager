<div class="container-fluid">
  <div class="row text-center">
  <div class=" col-sm-12 col-md-2">
  <div class="card-header">
    <b>EDITOR</b>
  </div>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link <?php if($path =="geb/editor") {echo "active";} ?>" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Gebiet</a>
      <a class="nav-link <?php if($path =="geb/editor-pub") {echo "active";} ?>" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Verk&uuml;ndiger</a>
      <a class="nav-link <?php if($path =="geb/editor-set") {echo " active";} ?>" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Einstellungen</a>
    </div>
  </div>
  <div class=" col-sm-12 col-md-10">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade <?php if($path =="geb/editor") {echo "show active";} ?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><?php include("gebiet_edit.php")?></div>
      <div class="tab-pane fade <?php if($path =="geb/editor-pub") {echo "show active";} ?>" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><?php include("publisher_edit.php")?></div>
      <div class="tab-pane fade <?php if($path =="geb/editor-set") {echo "show active";} ?>" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><?php include("setting_edit.php")?></div>
    </div>
  </div>
</div>
</div>


