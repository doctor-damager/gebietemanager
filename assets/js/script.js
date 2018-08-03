function checkDelete(){
    return confirm('Bist du dir sicher?');
}

function update(redirecturl,alterName) {
    var getUpdate = prompt("Neuer Name:",alterName);
    if (getUpdate != null) {
    window.location.replace(redirecturl+getUpdate);
    }
}
function filterme(theClass) {
$(document).ready(function(){
    $("#myFilter").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(theClass).filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
}

function filterCards(id) {
    $("#myFilter").on("keyup", function() {
        var text = $('.scan-this'+id).text().toLowerCase();;
        var value = $(this).val().toLowerCase();
        var scan = text.search(value);

      var element = document.getElementById("card_"+id);

      if (scan =="-1") {  element.classList.add("d-none");   }
      else {element.classList.remove("d-none"); 
      //console.log(text);
       }
   
  
    })
}
function showInfo(inside){

    
    $('#infoModal').modal('show')
    $('#theInfo').html(inside);
    
    
    }


function editTD(bearbId,type) {
  
      if (type == "i") {
        $('#changePubModal').modal('show');

        $('#selN').change(function(){
        var the_selected = $( '#selN' ).val();
        var the_selectedName = $( '#'+the_selected ).text();
            if ( confirm("Auf "+the_selectedName+" ändern?") ) 
            {
                
                $.ajax({ 
                    url:'./src/editor/territory_edit_parts/edit_processing.php',
                    method:'POST',
                    datType:'html',
                    data:{
                        bearbId:bearbId,
                        the_selected:the_selected,
                        type:type
                    
                    },
                success:function(data){
                    $('#cn').html(data);
                }
                });

            }
    
    
    });

      }
       
  
      if (type == "a") {
        $('#changeAusModal').modal('show');

        $('#newAus').change(function(){
        var the_date = $( '#newAus' ).val();
     
        if ( confirm("Ausgabe auf "+the_date+" ändern?") ) 
        {
       var the_selected = the_date+"-28";
      $.ajax({ 
        url:'./src/editor/territory_edit_parts/edit_processing.php',
        method:'POST',
        datType:'html',
        data:{
            bearbId:bearbId,
            the_selected:the_selected,
            type:type
         
        },
       success:function(data){
        $('#cn1').html(data);
       }
    });
}
    
    });

      }
      if (type == "r") {
        $('#changeRueckModal').modal('show');

        $('#newRueck').change(function(){
        var the_date = $( '#newRueck' ).val();
     
        if ( confirm("Rueckgabe auf "+the_date+" ändern?") ) 
        {
       var the_selected = the_date+"-28";
      $.ajax({ 
        url:'./src/editor/territory_edit_parts/edit_processing.php',
        method:'POST',
        datType:'html',
        data:{
            bearbId:bearbId,
            the_selected:the_selected,
            type:type
         
        },
       success:function(data){
        $('#cn2').html(data);
       }
    });
}
    
    });

      }
    
 

}





function deleteP(bearbId,freeCheck,gebieteId,lastPub,bearbLast) {
    if (freeCheck == "3"){alert("Frei kann nicht gelöscht werden ! Neu ausgeben!"); return;}
    if( confirm('Bist du dir sicher?')) { 
        
      

     var deleteMe = true;

        $.ajax({ 
            url:'./src/editor/territory_edit_parts/edit_processing.php',
            method:'POST',
            datType:'html',
            data:{
                bearbId:bearbId,
                deleteMe:deleteMe,
                freeCheck:freeCheck,
                gebieteId:gebieteId,
                lastPub:lastPub,
                bearbLast:bearbLast
            },
           success:function(data){
            $('#infoModal').modal('show')
               $('#theInfo').html(data);
           }
        });

    
    
    
    };
}

function deleteTer(deleteTerId,nameTer){
   
    if( confirm('Bist du dir sicher?')) { 
        
      

        var deleteMe = true;
   
           $.ajax({ 
               url:'./src/editor/territory_edit_parts/edit_processing.php',
               method:'POST',
               datType:'html',
               data:{
                   deleteTerId:deleteTerId,
                   nameTer:nameTer
               },
              success:function(data){
              showInfo(data);
              }
           });
   
       
       
       
       };


}

function updateTer() {
    if(confirm("Möchtest du die Änderungen Übernehmen?")){
    var iframe = $('#changeTerIframe').val();
    var anmerkung = $('#changeTerAn').val();
    var strassen = $('#changeTerStrassen').val();
    var stadtteil = $('#changeTerStadtteil').val();
    var wohneinheiten = $('#changeTerWohneinheiten').val();
    var neuername = $('#changeTerName').val();
    var oldName = $('#oldName').val();
    var gebid = $('#gebid').val();
    var rueckbesuche = $('#rueckbesuche').val();
    var nichtbesuchen = $('#nichtbesuchen').val();
    
          $.ajax({ 
            url:'./src/editor/territory_edit_parts/edit_processing.php',
                   method:'POST',
                   datType:'html',
                   data:{
                    gebid:gebid, 
                    oldName:oldName,
                    iframe:iframe,
                    anmerkung:anmerkung,
                    strassen:strassen,
                    stadtteil:stadtteil,
                    wohneinheiten:wohneinheiten,
                    neuername:neuername,
                    nichtbesuchen:nichtbesuchen,
                    rueckbesuche:rueckbesuche
                   },
                  success:function(data){
                  showInfo(data);
                  }
               });
    
    
    }
    
    }


function yellowOnes(){
    var list = document.getElementsByClassName('nine');
    var elements = document.getElementsByClassName("cards");
    if (document.getElementById('nine-months').checked) 
    {
        document.getElementById("eleven-months").checked = false;
        for (var i = 0; i < elements.length; i++) {         
          elements[i].classList.add("d-none");          
        }

        for (var i = 0; i < list.length; i++) {         
            list[i].classList.remove("d-none");          
          }


    } else {
        for (var i = 0; i < elements.length; i++) {         
            elements[i].classList.remove("d-none");          
          }
    }
}

function redOnes(){
    var list = document.getElementsByClassName('eleven');
    var elements = document.getElementsByClassName("cards");
    if (document.getElementById('eleven-months').checked) 
    {
        document.getElementById("nine-months").checked = false;
       
        for (var i = 0; i < elements.length; i++) {         
          elements[i].classList.add("d-none");          
        }

        for (var i = 0; i < list.length; i++) {         
            list[i].classList.remove("d-none");          
          }


    } else {
        for (var i = 0; i < elements.length; i++) {         
            elements[i].classList.remove("d-none");          
          }
    }
}





function nineMoths(id) {
    $("#myFilter").on("keyup", function() {
      var element = document.getElementById(id);
    var color = element.style.backgroundColor;
    console.log(color);

   //   if (scan =="-1") {  element.classList.add("d-none");   }
     // else {element.classList.remove("d-none"); console.log(text);   }
   
  
    })
}

        
     //  
//function addActive(pubId) {
  //  var element = document.getElementById(pubId);
    //element.classList.add("active");
//}
function activateListItem() {
$('.list-group').on('click', 'li', function() {
    $('.list-group li.active').removeClass('active');
    $(this).addClass('active');
}); }

function resetErrorMsg() {
    $("#errorMsg")[0].className="d-none"; 
    $("#errorMsg1")[0].className="d-none";
    $("#errorMsg2")[0].className="d-none";
    $("#errorMsg3")[0].className="d-none";
    $("#errorMsg4")[0].className="d-none";

}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
