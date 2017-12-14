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
      // alert ("afficher champs employe");
        $(".champ").hide();
        $("#selectTypeUser").show();
        $("#Prenom").show();
        $("#Nom").show();
        $("#courriel").show();
        $("#dropDownEntreprise").show();
        $("#posteEntreprise").show();
        $("#noTelEntreprise").show();
        $("#posteTelEntreprise").show();
        $("#checkResponsable").show();
        $("#checkSuperviseur").show();

    }

    function afficherChampsEnseignant()
    {
         $(".champ").hide();
         $("#selectTypeUser").show();
         $("#Prenom").show();
         $("#Nom").show();
         $("#courriel").show();

    }
    function afficherChampsStagiaire()
    {
         $(".champ").hide();
         $("#selectTypeUser").show();
         $("#Prenom").show();
         $("#Nom").show();
         $("#courriel").show();
         $("#noTelPersonnel").show();
         $("#courrielPersonnel").show();
    }

   function testerRetour (data)
    {
        if (data ==  -11)
        {
            alert ("Un utilisateur avec ce courriel existe déjà, veuillez utiliser un courriel différent");
        }
        else if (data.substr(data.length - 1) == 1)
        {
            //Mettre tous les champs à vide.
            alert ("L'utilisateur à été ajouté");
            Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php');
        }
    }

    function checkResponsable(element)
    {
      if (element.checked)
        document.getElementById("chkResponsable").value="true";
      else 
        document.getElementById("chkResponsable").value="false";
    }

    function checkSuperviseur(element)
    {
      if (element.checked)
        document.getElementById("chkSuperviseur").value="true";
      else 
        document.getElementById("chkSuperviseur").value="false";

    }