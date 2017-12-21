<?php

require 'InfoSession.php';

if(isset($_REQUEST["edit"])){
   return $session->Update($bdd, json_decode($_POST["tabChamp"]));
}

function Selected($PeriodeSelect,$PeriodeBD){
    if($PeriodeSelect == $PeriodeBD)
        return "selected";
}
    

$content =
'
<script>
    function Submit(){
        if(CheckAll()){
            alert("La session a bien été modifiée.");
            Post(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$_REQUEST["id"].'&nomMenu=ModifSession.php&edit\');
            Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php\');
        }
    }
</script>

    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Création d\'une Session</h2>
        </div>
        
        <div class="separateur">
            <h3>Information de la session</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Année</p>
                <input class="value" type="text" name="annee" value="'.$session->getAnnee().'">
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Entreprise</p>
                <input class="value" type="file">
            </div>
            <div class="champ">
                <p class="label labelForInput">Période</p>
                <select  class="value" name="periode">
                    <option name="periode" '.Selected("Été",$session->getPeriode()).'>Été</option>
                    <option name="periode" '.Selected("Automne",$session->getPeriode()).'>Automne</option>
                    <option name="periode"'.Selected("Hiver",$session->getPeriode()).'>Hiver</option>
                    <option name="periode"'.Selected("Printemps",$session->getPeriode()).'>Printemps</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Stagiaire</p>
                <input class="value" type="file">
            </div>
        </div>
        
        <div class="moitier">
            <div class="separateur enteteMoitier">
                <h3>Évalutions</h3>
            </div>

            <div class="blocInfo infoProfil">
                <h4>Évaluation Mi-Stage</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="mistagedebut" value="'.$session->getMiStageDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name ="mistagelimite" value="'.$session->getMiStageLimite().'">
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="finaledebut" value="'.$session->getFinaleDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="finalelimite" value="'.$session->getFinaleLimite().'">
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="formationdebut" value="'.$session->getFormationDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="formationlimite" value="'.$session->getFormationLimite().'">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <div class="moitier">
            <div class="separateur enteteMoitier">
                <h3>Rapports</h3>
            </div>

            <div class="blocInfo infoProfil">
                <h4>Rapport Janvier</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="janvierdebut" value="'.$session->getJanvierDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="janvierlimite" value="'.$session->getJanvierLimite().'">
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="fevrierdebut" value="'.$session->getFormationLimite().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="fevrierlimite" value="'.$session->getFevrierLimite().'">
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="marsdebut" value="'.$session->getMarsDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="marslimite" value="'.$session->getMarsLimite().'">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <br/><br/>
        

    <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php\')"/>
    <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Submit()"/>
</article>';

return $content;

?>