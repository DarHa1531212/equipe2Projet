<?php 
    include 'Session.php';
    require 'ConnexionBD.php';

    function AfficherPage($bdd, $NomMenu){
        include 'vTableauBord.php';
        include 'Model.php';
        
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