//Comme le select change dépendament du type de profil (stagiaire ou employe) dans le php vProfil,
//j'ai mis un paramètre titre dans la fonction avec lequel je fusionne avec id.
//Ex: id + titre = idEmploye ou idStagiaire.
//Cela me permet d'effectuer un if et afficher les bonnes informations.


function Requete(url, callBack){
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            callBack(this);
        };
    };

    xhttp.open("POST", url);
    xhttp.send();
}

function AfficherPage(xhttp){
    var menu = JSON.parse(xhttp.responseText);
    $(".stagiaire").empty();
    $(".stagiaire").append(menu);
}

function Execute(url, choix){
    switch(choix){
        case 1: Requete(url, AfficherPage)
            break;
        case 2:
            break;
    }
}