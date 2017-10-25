<?php 

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function AfficherProfil($NomMenu){
        include 'vProfil.php';
        include 'vTableauBord.php';
        $menu = "";
        
        switch($NomMenu){
            case "Profil":  $menu = include 'Profil.php';
                break;
            case "Main":    $menu = include 'TBSMain.php';
                break;
            case "Modif":   $menu = include 'ModifProfil.php';
                break;
            case "ModifBD": $menu = include 'ModifBDStagiaire.php';
                break;
                            
        }

        echo json_encode($menu);
    }

    AfficherProfil($_REQUEST["nomMenu"]);

?>