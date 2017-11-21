<?php 
    include 'Session.php';
    function AfficherPage($NomMenu){
        include 'vTableauBord.php';
        include 'Model.php';
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
            case "Avenir":  $menu = include 'AVenir.php';
                break;
            case "Eval":    $menu = include 'Evaluation.php';
                break;
            case "Stage":   $menu = include 'CreationStage.php';
        }

        echo json_encode($menu);
    }

    AfficherPage($_REQUEST["nomMenu"]);

?>