function checkDelete(){
    return confirm('Bist du dir sicher?');
}

function update(redirecturl) {
    var getUpdate = prompt("Neuer Name:");
    if (getUpdate != null) {
    window.location.replace(redirecturl+getUpdate);
    }
}