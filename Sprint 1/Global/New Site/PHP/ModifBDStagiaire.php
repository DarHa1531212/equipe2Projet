<?php

$Id = $_REQUEST['idStagiaire'];
$NumTel = $_REQUEST['NumTel'];
//$NumTelEntreprise = $_REQUEST['NumTelEntreprise'];
//$Poste = $_REQUEST['Poste'];
//$CourrielEntreprise = $_REQUEST['CourrielEntreprise'];
//$CourrielPersonnel = $_REQUEST['CourrielPersonnel'];



function Execute($bdd, $NumTel){
    $query = $bdd->prepare("UPDATE tblStagiaire SET NumTel = '$NumTel' WHERE Id = 1");

    return $query->execute();
}

$content = Execute($bdd, $NumTel);
return $content.' '.$NumTel.'';

?> 