//////////////////////////////////////////////////////////////////////////////////////////////////
//Script pour un SlideView dans le tableau de bord de l'entreprise pour afficher les stagiaires.//
//////////////////////////////////////////////////////////////////////////////////////////////////

function SlideMove(bouton){
    var slide = document.getElementById("slideContainer");
    var width = slide.clientWidth;
    
    if(bouton.id == "btnSuivant"){
        slide.scrollLeft += width;
    }
    else
        slide.scrollLeft -= width;
}