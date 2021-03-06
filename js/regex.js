function VerifierRegex(champ){
    var regex = new RegExp(champ.pattern);
    
    if(regex.test(champ.value)){
        Erreur(true, champ);
        return true;
    }
    else{
        Erreur(false, champ);
        return false;
    }
}

function DoubleVerif(champ1, champ2){

    if(champ1.value == champ2.value){
        Erreur(true, champ2);
        return true;
    }
    else{
        Erreur(false, champ2);
        return false;
    }
}

function Required(champ){
    if(champ.hasAttribute("required") && champ.value == ""){//pas correct
        Erreur(false, champ);
        return false;
    }
    else{//et correct
        Erreur(true, champ);
        return true;
    }       
}


function CheckAll(){
    var champs = $(".value:visible");
    var nbCorrect = 0;
    
    for(var i = 0; i < champs.length; i++){
        if( ((Required(champs[i])) && VerifierRegex(champs[i])) || ( !(champs[i].hasAttribute("required")) && (champs[i].value == "") ) || ( !(champs[i].hasAttribute("required")) && (!VerifierRegex(champs[i])) ) )
        {
            nbCorrect++;
        }
    }

    

    if(nbCorrect == champs.length){//tous les champs contienent quelque chose et sont conforme au regex
        return true;
    }
    else{
        alert("Veuillez vérifier que tous les champs sont bien entrés correctement.");
        return false;
    }
}

function Erreur(etat, champ){
    var bouton = document.getElementById('Save');
    
    if(etat){
        $(champ).css("background-color", "white");
        bouton.disabled = false;
    }
    else{
        $(champ).css("background-color", "#ff8080");   
        bouton.disabled = true;
    }

}