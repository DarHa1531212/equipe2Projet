var timeout;

function ReponseChoisie(item){
    $(".evaluation2 > tbody > tr").css("background-color", "rgba(0, 0, 0, 0.2)");
    $(".evaluation2 > tbody > tr:hover").css("background-color", "rgba(0, 0, 0, 0.9)");
    
    $(item).css("background-color", "#43ee2d");
}

function DisableSalaire(rad){
    var salaire = document.getElementById("salaire");
    
    if(rad.id == "oui")
        salaire.disabled = false;
    else
        salaire.disabled = true;
}

function SetTimeout(){
    timeout = setTimeout(SessionTimeout, 300000);
}

function SessionTimeout(){
    window.location = "../PHP/logout.php";
}

window.addEventListener("click", function(){
    clearTimeout(timeout);
    timeout = setTimeout(SessionTimeout, 300000);
})

