var listStagiaire = document.getElementsByClassName("stagiaire");
var listQuestion = document.getElementsByClassName("categories");
var liste;
var itemActu = 0;

//Chache toutes les divs sauf la premiere.
function CacherDiv(){
    if(listStagiaire.length > 1){
        liste = listStagiaire;
    }
    else if(listQuestion.length > 1){
        liste = listQuestion;
        ChangerLettre(0);
    }
    
    for(var i = 1; i < liste.length; i++){
        $(liste[i]).hide();
    }
    itemActu = 0;
}

//Change pour l'élément suivant ou précédent.
function ChangerItem(element){
    if((element.id == "gauche") && ((itemActu - 1) >= 0)){
        $(liste[itemActu]).hide();
        itemActu--;
    }
    else if((element.id == "droite") && ((itemActu + 1) < liste.length)){
        $(liste[itemActu]).hide();
        itemActu++;
    } 
    
    ActualiseBtnEval(element);
    
    $(liste[itemActu]).show();  
}

//Va a la categorie selectionee.
function JumpTo(position){
    ChangerLettre(position);
    $(liste[itemActu]).hide();
    itemActu = position;
    $(liste[itemActu]).show();
    
    ActualiseBtnEval(document.getElementById("droite"));
}

//Modifie les propriétées des lettres de catégorie.
function ChangerLettre(position){
    var lettres = document.getElementsByClassName("lettreNav");
    for(var i = 0; i < lettres.length; i++){
        $(lettres[i]).css("background-color", "white");
        $(lettres[i]).css("color", "#0a3a7c");
    }
    $(lettres[position]).css("background-color", "#0a3a7c");
    $(lettres[position]).css("color", "white");
}

//Change la couleur des lettres et affiche le bouton "confirmer" si arriver a la derniere categorie.
function ActualiseBtnEval(element){
    if(element.parentElement.className == "navigateurEval"){
        ChangerLettre(itemActu);
        
        if(itemActu == liste.length - 1){
            $("#droite").hide();
            $("#confirmer").show();
        }
        else if($("#confirmer").is(":visible")){
            $("#droite").show();
            $("#confirmer").hide();
        }
    }
}