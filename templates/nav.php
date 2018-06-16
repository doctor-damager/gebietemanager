<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/geb"><i class="far fa-map"></i> GebieteManager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 <? $current_file_name2 = basename($_SERVER['REQUEST_URI'], ".php");
 $current_file_name3 = basename($_SERVER['REQUEST_URI'], ".php");
 $current_file_name4 = basename($_SERVER['REQUEST_URI'], ".php"); ?>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?=echoActiveClassIfRequestMatches('geb')?> ">
        <a class="nav-link" href="/geb">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item  <?=echoActiveClassIfRequestMatches('editor')?>">
        <a class="nav-link" href="/geb/editor">Editor</a>
      </li>
      <li class="nav-item  <?=echoActiveClassIfRequestMatches('karten')?>">
        <a class="nav-link" href="/geb/karten">Zuteilungskarten</a>
      </li>
   
    </ul>
   
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="input" style="min-width: 250px;" data-toggle="tooltip"  title="Konsole zum schnellen eingeben von Bearbeitungen. -> Format: Gebietsnummer, Nachname Name,Ausgabe(MMJJ),R&uuml;ckgabe(MMJJ),f(falls danach frei) <- Trennung durch Komma  / Minus falls Datum leer z.B: 320,Pan Peter,0716,-,-" placeholder="z.B: 210,Pan Peter,0716,0917,f">
      <button class="btn btn-outline-secondary my-2 my-sm-0" >Bearbeitung hinzufügen</button>
    </form>
  </div>
</nav>

