<?php

$profil = new ProfilStagiaire($_REQUEST["idStagiaire"], $bdd);

function ModifierStagiaire($bdd){
    include 'hash.php';
    
    $champs = json_decode($_POST["tabChamp"]);
    $stagiaire = array();
    
    foreach($champs as $champ){
        $stagiaire[$champ->nom] = $champ->value;
    }
    
    $query = $bdd->prepare('UPDATE tblStagiaire SET NumTel = :numTel, NumTelEntreprise = :numTelEntreprise, Poste = :poste, CourrielEntreprise = :courrielEntreprise, CourrielPersonnel = :courrielPerso WHERE Id = :id'); 
    
    SetPassword($stagiaire["nouveauPasse"], $bdd);
    
    $query->execute(array(
        "numTel"=>$stagiaire["numTel"],
        "numTelEntreprise"=>$stagiaire["numEntreprise"],
        "poste"=>$stagiaire["poste"],
        "courrielEntreprise"=>$stagiaire["courrielEntreprise"],
        "courrielPerso"=>$stagiaire["courrielPersonnel"],
        "id"=>$_SESSION["idConnecte"]
    ));
}

if(isset($_REQUEST["post"]))
    ModifierStagiaire($bdd);

$content =
'
<article class="stagiaire">
<div class="infoStagiaire">
                    <h2>Votre Profil</h2>
                </div>
                
                <div class="separateur">
                    <h3>Informations Personnelles</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Prenom :</p>
                            <input type="text" value="'.$profil->getPrenom().'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">Nom :</p>
                            <input type="text" value="'.$profil->getNom().'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">No. Téléphone :</p>
                            <input type="text" value="'.$profil->getNumTelPerso().'" id="numTel" name="numTel" class="value" onexit="RegexProfilStagiaire()"/>
                            <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                        </div>
                    
                        <div class="champ">
                            <p class="label labelForInput">Courriel :</p>
                            <input type="email" value="'.$profil->getCourrielPerso().'" id="courrielPersonnel" name="courrielPersonnel" class="value" onexit="RegexProfilStagiaire()"/>
                        </div>
                </div>
                
                <div class="separateur">
                    <h3>Informations Professionnelles</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Entreprise :</p>
                            <input type="text" value="'.$profil->getEntreprise().'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">Courriel :</p>
                            <input type="email" value="'.$profil->getCourriel().'" id="courrielEntreprise" name="courrielEntreprise" class="value" onexit="RegexProfilStagiaire()"/>
                            
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">No. Téléphone :</p>
                            <input type="text" value="'.$profil->getNumTel().'" id="numEntreprise" name="numEntreprise" class="value" onexit="RegexProfilStagiaire()"/>
                            <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                        </div>
                    
                        <div class="champ">
                            <p class="label labelForInput">Poste :</p>
                            <input type="text" value="'.$profil->getPoste().'" name="poste" id="poste" class="value" onexit="RegexProfilStagiaire()"/>
                        </div>
                </div>
                
                <div class="separateur">
                    <h3>Sécurité</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Nouveau mot de passe :</p>
                            <input type="password" id="newPwd" class="value" name="nouveauPasse" onexit="RegexProfilStagiaire()"/>
                            <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                        </div>

                        <div class="champ">
                            <p class="label labelForInput">Confirmer le mot de passe :</p>
                            <input type="password" id="confirmationNewPwd" class="value" onexit="RegexProfilStagiaire()"/>
                        </div>
                </div>
                
                <br/><br/>
                
                <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>
                <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Execute(5, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=ModifProfil.php&post\'); Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>
</article>';

return $content;

?>