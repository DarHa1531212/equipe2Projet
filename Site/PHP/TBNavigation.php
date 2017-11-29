<?php 
    include 'Session.php';

    function AfficherPage($NomMenu){
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
            default:    $menu = include $NomMenu;
        }
        
        echo json_encode($menu);
    }

    AfficherPage($_REQUEST["nomMenu"]);

?>