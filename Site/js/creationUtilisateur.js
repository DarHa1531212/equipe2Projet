 function changeUserType(userType){
/* onclick= "Execute(12, \'../PHP/TBNavigation.php?&nomMenu=InsertStage\'
2 = responsable
3 = enseignant
4 = superviseur
5 = stagiaire */
    alert (userType.value);

    switch(userType.value)
    {
        case "2":  
            alert ("responsable choisi");
            afficherChampsResponsable();
            break;
        case "3": afficherChampsEnseignant();
            break;
        case "4": afficherChampsSuperviseur();
            break;
        case "5": afficherChampsStagiaire();
            break;
    }

  }

    function afficherChampsResponsable()
    {

        alert("vous avez choisis un responsable");
    }

    function afficherChampsEnseignant()
    {
        alert("vous avez choisi un enseignant");
    }

    function afficherChampsSuperviseur()
    {
        alert ("vous avec choisi un superviseur");
    }
    function afficherChampsStagiaire()
    {
        alert ("vous avec choisi un stagiaire");
         $(".champ").hide();
         $("#Prenom").show();
         $("#Nom").show();
         $("#courriel").show();
    }
