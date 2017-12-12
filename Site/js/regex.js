function VerifierRegex(champ){
    var regex = new RegExp(champ.pattern);
    
    if(regex.test(champ.value))
        Erreur(true, champ);
    else
        Erreur(false, champ);
}

function DoubleVerif(champ1, champ2){
    if(champ1.value == champ2.value)
        Erreur(true, champ2);
    else
        Erreur(false, champ2);
}

function Required(champ){
    if(champ.value == "")
        Erreur(true, champ);
    else
        Erreur(false, champ);
}

function Erreur(etat, champ){
    var bouton = document.getElementById('Save');
    
    if(etat){
        $(champ).css("background-color", "white");
        bouton.disabled = false;
    }
    else{
        $(champ).css("background-color", "red");   
        bouton.disabled = true;
    } 
}