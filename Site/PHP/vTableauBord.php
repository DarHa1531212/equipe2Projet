<?php

    $id = $_SESSION["idConnecte"];
    $where = "";
    
    switch($_SESSION["IdRole"]){
        case 2: $where = "IdResponsable";
            break;
        case 4: $where = "IdSuperviseur";
            break;
        case 5: $where = "Id";
            break;
    }

	$profils = $bdd->Request("SELECT * FROM vTableauBord WHERE $where = :id", array("id"=>$id), "stdClass");
?>