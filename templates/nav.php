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
      <li class="nav-item <?php echoActiveClassIfRequestMatches('geb');?> ">
        <a class="nav-link" href="/geb">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item  <?php echoActiveClassIfRequestMatches('editor');?>">
        <a class="nav-link" href="/geb/editor">Editor</a>
      </li>
      <li class="nav-item  <?php echoActiveClassIfRequestMatches('karten');?>">
        <a class="nav-link" href="/geb/karten">Zuteilungskarten</a>
      </li>
      <li class="nav-item  <?php echoActiveClassIfRequestMatches('logout');?>">
        <a class="nav-link" href="/geb/logout"><i class="fas fa-sign-out-alt"></i>ausloggen</a>
      </li>
   
    </ul>
 
    <div class="form-inline my-2 my-lg-0">
    <div class="d-block d-sm-none  "> <div class="row">
      <div class="col-4">
       <i class="fas fa-2x fa-info-circle my-2 my-sm-3" style="color:white;margin-right:5px;" data-toggle="tooltip"  data-placement="bottom"  data-html="true"  title="<small><b>Bearbeitung schnell eingeben</b><br/>  Format: Gebietsnummer,Name,Ausgabe(MM.JJ),R&uuml;ckgabe(MM.JJ),frei(falls danach frei) <- Trennung durch Komma  / Minus falls Datum leer</small>"></i>
      <i class="fas fa-2x fa-question-circle my-2 my-sm-3" style="color:white;margin-right:5px;" data-toggle="tooltip"  data-placement="bottom" data-html="true" title="Beispiele: <br><small>sofortige Ausgabe:</small><br><span class='badge badge-pill badge-light'>210,Pan Peter</span><br><small>einmalige Bearbeitung:</small><br><span class='badge badge-pill badge-light'>210,Pan Peter,09.17,08.18,frei</span> <br><small>nur Bearbeitung:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,-,09.17</span><br><small>nur Ausgabe:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,09.17</span><br><small>nach Bearbeitung frei:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,-,07.18,frei</span><br><small>unbearbeitet zurück:<br></small><span class='badge badge-pill badge-light'>210,frei</span>"></i></div> <div class="col-8">  <button class="btn btn-outline-secondary my-2 my-sm-3" onclick="bearbeitung()">Bearbeitung hinzufügen</button> </div>  

    </div></div>
      <input class="form-control mr-sm-2" name="console" id="console" type="input" style="min-width: 270px;"  placeholder="z.B: 210,Pan Peter,0716,0917,frei">
     <div class="	d-none d-sm-block ml-3"> <div class="row">
       <i class="fas fa-2x fa-info-circle " style="color:white;margin-right:5px;" data-toggle="tooltip"  data-placement="bottom"  data-html="true"  title="<small><b>Bearbeitung schnell eingeben</b><br/>  Format: Gebietsnummer,Name,Ausgabe(MM.JJ),R&uuml;ckgabe(MM.JJ),frei(falls danach frei) <- Trennung durch Komma  / Minus falls Datum leer</small>"></i>
      <i class="fas fa-2x fa-question-circle " style="color:white;margin-right:5px;" data-toggle="tooltip"  data-placement="bottom" data-html="true" title="Beispiele: <br><small>sofortige Ausgabe:</small><br><span class='badge badge-pill badge-light'>210,Pan Peter</span><br><small>einmalige Bearbeitung:</small><br><span class='badge badge-pill badge-light'>210,Pan Peter,09.17,08.18,frei</span> <br><small>nur Bearbeitung:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,-,09.17</span><br><small>nur Ausgabe:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,09.17</span><br><small>nach Bearbeitung frei:<br></small><span class='badge badge-pill badge-light'>210,Pan Peter,-,07.18,frei</span><br><small>unbearbeitet zurück:<br></small><span class='badge badge-pill badge-light'>210,frei</span>"></i> <button class="btn btn-outline-secondary my-2 my-sm-0" onclick="bearbeitung()">Bearbeitung hinzufügen</button> 
</div></div>
    </div>
  </div>
</nav>
<div class="container-fluid" id="errorsucc"></div>


<!-- MODAL für Fehlermeldungen-->
<div class="modal" id="exampleModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><h3>EINGABEFEHLER</h3></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="OK" onclick="resetErrorMsg()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body error">
       <p id="errorMsg" class="d-none"></p>
       <p id="errorMsg1" class="d-none"></p>
       <p id="errorMsg2" class="d-none"></p>
       <p id="errorMsg3" class="d-none"></p>
       <p id="errorMsg4" class="d-none"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetErrorMsg()">Schließen</button>
      </div>
    </div>
  </div>
</div>
<!-- Ende MODAL für Fehlermeldungen-->


<script>
function bearbeitung(){
  $('#errorsucc').html("");
    var getConsole = document.getElementById("console").value;
   
    var consoleArray = getConsole.split(',');
    var gebiet = consoleArray[0] 
    var verk = consoleArray[1]
    var ausgabe = consoleArray[2]
    var rueckgabe = consoleArray[3]
    var frei = consoleArray[4]

    var verkArr = [<?php getDataAutocomplete("pub");?>];
    var terArr = [<?php getDataAutocomplete("ter");?>];
    var rueckgabeForDb ="empty";
    var ausgabeForDb ="empty";

    if (typeof rueckgabe !== "undefined") {
     
      if (rueckgabe === "-" || rueckgabe ==="" || rueckgabe ==="undefined")  {rueckgabeForDb ="false";} else {
    var rueckgabeSplited = rueckgabe.split(".");
    var rueckgabeToDate = new Date("20"+rueckgabeSplited[1]+"-"+rueckgabeSplited[0]+"-28");
    var d = new Date();
    var n = d.getFullYear();
   
          if (rueckgabeToDate instanceof Date && !isNaN(rueckgabeToDate.valueOf()) && Object.prototype.toString.call(rueckgabeToDate) === "[object Date]" && rueckgabeToDate.getUTCFullYear() >= 2000 && rueckgabeToDate.getUTCFullYear() <= n){
            var month = rueckgabeToDate.getUTCMonth() + 1; //months from 1-12
            var day = rueckgabeToDate.getUTCDate();
            var year = rueckgabeToDate.getUTCFullYear();

             var rueckgabeForDb = year + "-" + month + "-" + day;


              } else {
              $("#errorMsg2")[0].className="consoleErrorRueck";
              $("#exampleModal").modal();
              return;
            }

  }
  } 
  else {
      rueckgabeForDb = "false";
    }

 if (typeof ausgabe !== "undefined") {
  
     
     if (ausgabe === "-" || ausgabe === "" || ausgabe === "undefined" || ausgabe === "," || ausgabe === " ")  {ausgabeForDb = "false";} else {
   var ausgabeSplited = ausgabe.split(".");
   var ausgabeToDate = new Date("20"+ausgabeSplited[1]+"-"+ausgabeSplited[0]+"-28");
   var d = new Date();
   var n = d.getFullYear();
  
         if (ausgabeToDate instanceof Date && !isNaN(ausgabeToDate.valueOf()) && Object.prototype.toString.call(ausgabeToDate) === "[object Date]" && ausgabeToDate.getUTCFullYear() >= 2000 && ausgabeToDate.getUTCFullYear() <= n){
           var month = ausgabeToDate.getUTCMonth() + 1; //months from 1-12
           var day = ausgabeToDate.getUTCDate();
           var year = ausgabeToDate.getUTCFullYear();

            var ausgabeForDb = year + "-" + month + "-" + day;


             } else {
             $("#errorMsg3")[0].className="consoleErrorAusg";
             $("#exampleModal").modal();
             return;
           }

 }
} 
  else {
    ausgabeForDb = "false";
    }
 


   
    if (gebiet == "undefined" || terArr.includes(gebiet) == false ) {
      $("#errorMsg")[0].className="consoleErrorTer";
      $("#exampleModal").modal();
      return;
    }
    if (verk == "undefined" || verkArr.includes(verk) == false ) {
      $("#errorMsg1")[0].className="consoleErrorVerk";
      $("#exampleModal").modal();
      return;
    }
   // console.log(gebiet,verk,ausgabeForDb,rueckgabeForDb,frei);


   //insert into database with ajax and php

     $.ajax({
                    url:'./src/editor/handle_processing.php',
                    method:'POST',
                    datType:'html',
                    data:{
                      gebiet:gebiet,
                      verk:verk,
                      ausgabeForDb:ausgabeForDb,
                      rueckgabeForDb:rueckgabeForDb,
                      frei:frei
                    },
                   success:function(data){
                       $('#errorsucc').html(data);
                   }
                });
    
    //window.location.replace("processing?gebiet="+gebiet+"&publ="+verk+"&ausgabe="+ausgabeForDb+"&rueckgabe="+rueckgabeForDb+"&frei="+frei);
}



$(function() {
    var items = [<?php getDataAutocomplete("combined");?>];
       
        
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#console" )
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          response( $.ui.autocomplete.filter(
            items, extractLast( request.term ) ) );
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( "," );
          return false;
        }
      });
    
  });</script>