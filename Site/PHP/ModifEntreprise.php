<?php

require 'InfoEntreprise.php';

if(isset($_REQUEST["post"])){
    $entreprise->Update($bdd, json_decode($_POST["tabChamp"]));
    return;
}
    

$content =
'
<article class="stagiaire">
    <div class="infoStagiaire">
        <h2>Modification de l\'Entreprise</h2>
    </div>
    
    <div class="separateur">
        <h3>Informations Générales</h3>
    </div>
    
    <div class="blocInfo infoProfil">
        <div class="champ">
            <p class="label labelForInput">Nom :</p>
            <input type="text" value="'.$entreprise->getNom().'" name="nom" class="value"/>
        </div>

        <div class="champ">
            <p class="label labelForInput">Courriel :</p>
            <input type="email" value="'.$entreprise->getCourriel().'" name="courrielEntreprise" class="value" onblur="VerifierRegex(this);" pattern="'.$regxEmail.'"/>

        </div>

        <div class="champ">
            <p class="label labelForInput">No. Téléphone :</p>
            <input type="text" value="'.$entreprise->getNumTel().'" name="numEntreprise" class="value" onblur="VerifierRegex(this);" pattern="'.$regxNumTel.'"/>
            <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
        </div>

        <div class="champ">
            <p class="label labelForInput">Logo :</p>
            <input type="text" value="'.$entreprise->getLogo().'" name="logo" class="value" onexit="RegexProfilStagiaire()"/>
        </div>
    </div>

    <div class="separateur">
        <h3>Adresse</h3>
    </div>

    <div class="blocInfo infoProfil">
        <div class="champ">
            <p class="label labelForInput">Province :</p>
            <input type="text" value="'.$entreprise->getProvince().'" name="province" class="value"/>
        </div>
        <div class="champ">
            <p class="label labelForInput">Ville :</p>
            <input type="text" value="'.$entreprise->getVille().'" name="ville" class="value"/>
        </div>
        <div class="champ">
            <p class="label labelForInput">Code Postal :</p>
            <input type="text" value="'.$entreprise->getCodePostal().'" name="codePostal" class="value"
            onblur="VerifierRegex(this);" pattern="'.$regxCodePostal.'"/>
        </div>
        <div class="champ">
            <p class="label labelForInput">No. Civique :</p>
            <input type="text" value="'.$entreprise->getNumCivique().'" name="noCivique" class="value"
            onblur="VerifierRegex(this);" pattern="'.$regxNumCivique.'"/>
        </div>
        <div class="champ">
            <p class="label labelForInput">Rue :</p>
            <input type="text" value="'.$entreprise->getRue().'" name="rue" class="value"/>
        </div>
    </div>
                
    <br/><br/>

    <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php\')"/>
    <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Post(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$_REQUEST["id"].'&nomMenu=ModifEntreprise.php&post\'); Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ListeEntreprise.php\')"/>
</article>';

return $content;

?>