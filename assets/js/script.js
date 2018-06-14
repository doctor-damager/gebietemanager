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

      var element = document.getElementById(id);

      if (scan =="-1") {  element.classList.add("d-none");   }
      else {element.classList.remove("d-none"); console.log(text);   }
   
  
    })
}

function nineMoths(id) {
    $("#myFilter").on("keyup", function() {
      var element = document.getElementById(id);
    var color = element.style.backgroundColor
    console.log(color)

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