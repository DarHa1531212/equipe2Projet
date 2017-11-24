<?php 
    function AfficherPage($NomMenu){
        include 'Session.php';
        include 'vProfil.php';
        include 'vTableauBord.php';
        include 'Model.php';
        $menu = "";
        
        switch($NomMenu){
            case "Profil":      $menu = include 'Profil.php';
                break;
            case "Main":    
                if($_SESSION['IdRole'] == 5)
                                        $menu = include 'TBSMain.php';
                else if(($_SESSION['IdRole'] == 4) || ($_SESSION['IdRole'] == 3) || ($_SESSION['IdRole'] == 2))
                                        $menu = include 'TBEMain.php';
                else if($_SESSION['IdRole'] == 1)
                                        $menu = include 'ConsoleAdminMain.php';
                break;
            case "Modif":               $menu = include 'ModifProfil.php';
                break;  
            case "Journal":             $menu = include 'JournalBord.php';
                break;
            case "Avenir":              $menu = include 'AVenir.php';
                break;
            case "Eval":                $menu = include 'Evaluation.php';
                break;
            case "Stage":               $menu = include 'Stage.php';
                break;
            case "CreationStage":       $menu = include 'CreationStage.php';
                break;
            case "Session":             $menu = include 'CreationSession.php';
                break;
            case "Entreprise":          $menu = include 'CreationEntreprise.php';
        }
        
        echo json_encode($menu);
    }

    AfficherPage($_REQUEST["nomMenu"]);

?>