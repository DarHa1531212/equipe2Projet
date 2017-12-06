 function changeUserType(userType){

    switch(userType.value)
    {
        case "2":  
            afficherChampsEmployeEntreprise();
            break;
        case "3": afficherChampsEnseignant();
            break;
        case "5": afficherChampsStagiaire();
            break;
    }

  }

    function afficherChampsEmployeEntreprise()
    {
        $(".champ").hide();
        $("#Prenom").show();
        $("#Nom").show();
        $("#courriel").show();
        $("#dropDownEntreprise").show();
        $("#posteEntreprise").show();
        $("#noTelEntreprise").show();
        $("#posteTelEntreprise").show();

    }

    function afficherChampsEnseignant()
    {
         $(".champ").hide();
         $("#Prenom").show();
         $("#Nom").show();
         $("#courriel").show();

    }
    function afficherChampsStagiaire()
    {
         $(".champ").hide();
         $("#Prenom").show();
         $("#Nom").show();
         $("#courriel").show();
    }