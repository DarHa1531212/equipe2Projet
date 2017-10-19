//Comme le select change dépendament du type de profil (stagiaire ou employe) dans le php vProfil,
//j'ai mis un paramètre titre dans la fonction avec lequel je fusionne avec id.
//Ex: id + titre = idEmploye ou idStagiaire.
//Cela me permet d'effectuer un if et afficher les bonnes informations.
function AfficherProfil(Id, titre, nomMenu){
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var profil = JSON.parse(this.responseText);
            $(".stagiaire").empty();
            $(".stagiaire").append(profil);
        };
    };

    xhttp.open("POST", "../PHP/Profil.php?id" + titre + "=" + Id + "&nomMenu=" + nomMenu);
    xhttp.send();
}

function Retour(){
    
}