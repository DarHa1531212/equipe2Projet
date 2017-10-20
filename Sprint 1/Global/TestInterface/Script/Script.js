var listStagiaire = document.getElementsByClassName("stagiaire");
var stagiaireActu = 0;

function CacherDiv(){
    for(var i = 1; i < listStagiaire.length; i++){
        $(listStagiaire[i]).hide();
    }
}

function ChangerStagiaire(direction){
    if((direction.className == "fleche flecheGauche") && ((stagiaireActu - 1) >= 0)){
        $(listStagiaire[stagiaireActu]).fadeOut(200);
        stagiaireActu--;
    }
    else if((direction.className == "fleche flecheDroite") && ((stagiaireActu + 1) < listStagiaire.length)){
        $(listStagiaire[stagiaireActu]).fadeOut(200);
        stagiaireActu++;
    } 

    $(listStagiaire[stagiaireActu]).delay(200).fadeIn(200);  
}