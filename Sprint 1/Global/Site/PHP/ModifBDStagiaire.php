<?php

$Id = $_SESSION['idConnecte'];
$NumTel = $_REQUEST['NumTel'];
$NumTelEntreprise = $_REQUEST['NumTelEntreprise'];
$Poste = $_REQUEST['Poste'];
$CourrielEntreprise = $_REQUEST['CourrielEntreprise'];
$CourrielPersonnel = $_REQUEST['CourrielPersonnel'];

function Execute($bdd, $NumTel, $NumTelEntreprise, $Poste, $CourrielEntreprise, $CourrielPersonnel, $Id){
    $query = $bdd->prepare("UPDATE tblStagiaire SET NumTel = '$NumTel', NumTelEntreprise = '$NumTelEntreprise', Poste = '$Poste', CourrielEntreprise = '$CourrielEntreprise', CourrielPersonnel = '$CourrielPersonnel' WHERE Id = '$Id'");

    $query->execute();
}

Execute($bdd, $NumTel, $NumTelEntreprise, $Poste, $CourrielEntreprise, $CourrielPersonnel, $Id);

?> 