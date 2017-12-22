<?php

require 'Profil.php';
include 'hash.php';

function Entete($profil, $role){
    $content = "";
    
    if($profil->getId() == $_SESSION['idConnecte']){
        $content = $content.
        '<h2>Votre Profil</h2>';
    }
    else{
        $content = $content.
        '<h2>Profil de '.$profil->getPrenom().' '.$profil->getNom().' '.$role.'</h2>';
    }
    
    return $content;
}

if(isset($_REQUEST["edit"]))
    $profil->UpdateProfil($bdd, json_decode($_POST["tabChamp"]));

$content =
'
<article class="stagiaire">
    
    '.Entete($profil, $role).
     $profil->ModifierProfil().'
                
    <br/><br/>

    <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=Main\')"/>
    <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Post(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$profil->getId().'&nomMenu=ModifProfil.php&edit\'); Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=Main\')"/>
</article>';

return $content;

?>