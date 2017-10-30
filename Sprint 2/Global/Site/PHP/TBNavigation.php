<?php 
    include 'Session.php';
    function AfficherPage($NomMenu){
        include 'vProfil.php';
        include 'vTableauBord.php';
        $menu = "";
        
        switch($NomMenu){
            case "Profil":  $menu = include 'Profil.php';
                break;
            case "Main":    
                if($_SESSION['IdRole'] == 5)
                    $menu = include 'TBSMain.php';
                else
                    $menu = include 'TBEMain.php';
                break;
            case "Modif":   $menu = include 'ModifProfil.php';
                break;
            case "ModifBD": $menu = include 'ModifBDStagiaire.php';
                break;    
            case "Journal": $menu = include 'JournalBord.php';
                break;
        }

        echo json_encode($menu);
    }

    AfficherPage($_REQUEST["nomMenu"]);

?>