<?php 
    include 'Session.php';
    require 'ConnexionBD.php';

    function AfficherPage($bdd, $NomMenu){
        include 'vTableauBord.php';
        include 'Model.php';
        $regxEmail = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$";
        $regxPoste = "^[0-9]{0,7}$";
        $regxPassword = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$";
        $regxNumTel = "^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$";
        $regxCodePostal = "^[A-Z][0-9][A-Z]\s[0-9][A-Z][0-9]$";
        $regxNumCivique = "^[0-9]{1,5}$";
        $regxNom = "^[a-zA-Z\É\é\È\è\Ê\ê\Ë\ë\Ç\ç\Ï\ï\Ô\ô]+(([',. -][a-zA-Z\É\é\È\è\Ê\ê\Ë\ë\Ç\ç\Ï\ï\Ô\ô])?[a-zA-Z\É\é\È\è\Ê\ê\Ë\ë\Ç\ç\Ï\ï\Ô\ô]*)*$";
        $regxSalaire = "^[0-9]{1,},[0-9][0-9]$";
        $regxHeure = "^[0-4][0-9],?[0-5]?[0]?$";
        $regxAnnee = "^[2][0][0-9]{2}$";
        
        switch($NomMenu){
            case "Main":    

                if($_SESSION['IdRole'] == 5)
                        $menu = include 'TBSMain.php';
                else if(($_SESSION['IdRole'] == 4) || ($_SESSION['IdRole'] == 3) || ($_SESSION['IdRole'] == 2))
                        $menu = include 'TBEMain.php';
                else if($_SESSION['IdRole'] == 1)
                        $menu = include 'ConsoleAdminMain.php';
                break;

            case "Eval":    

                    $menu = include 'Evaluation.php';
                    
                break;

            default:    $menu = include $NomMenu;
        }
        
        echo json_encode($menu);
    }

    AfficherPage($bdd, $_REQUEST["nomMenu"]);

?>