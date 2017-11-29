<?php //recherche de connexion dans la bd

    include 'Session.php';
    if (Login($username, $MDP, $bdd))
    {
        switch ($_SESSION['IdRole'])
        {
            case 1: //case 1 is an administrator
                GetPrenomNom($bdd, $_SESSION['IdRole']);
                include 'ConsoleAdmin.php';
                break;

            case 2: //case 2 is a Responsible
                GetPrenomNom($bdd, $_SESSION['IdRole']);
                include 'TBEntreprise.php';
                break;

            case 3: //case 3 is a Teacher
                GetPrenomNom($bdd, $_SESSION['IdRole']);
                include "AVenir.php";
                break;

            case 4:
                GetPrenomNom($bdd, $_SESSION['IdRole']);
                include "TBEntreprise.php";
                break;

            case 5: //case 5 is an intern
                GetPrenomNom($bdd, $_SESSION['IdRole']);
                include "TableauBordStagiaire.php";
                break;

            default: echo "error unknown IdRole";
        }
    }
    else
    {
        header("Location: ../index.php");     
    }

  	function GetPrenomNom($bdd, $idRole){
        $query = "SELECT * FROM vEmploye WHERE IdUtilisateur = :id";
        
        if($idRole == 5)
            $query = "SELECT * FROM vStagiaire WHERE IdUtilisateur = :id";

        $connecte = $bdd->Request($query, array("id"=>$_SESSION['idConnecte']), "stdClass");

        foreach($connecte as $user)
        {
            $_SESSION['PrenomConnecte'] = $user->Prenom;
            $_SESSION['NomConnecte'] = $user->Nom;
        }
    }
?>