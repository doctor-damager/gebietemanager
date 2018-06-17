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

function resetErrorMsg() {
    $("#errorMsg")[0].className="d-none"; 
    $("#errorMsg1")[0].className="d-none";
    $("#errorMsg2")[0].className="d-none";
    $("#errorMsg3")[0].className="d-none";
    $("#errorMsg4")[0].className="d-none";

}

