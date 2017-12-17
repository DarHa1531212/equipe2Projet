<?php

require 'InfoSession.php';

if(isset($_REQUEST["post"])){
    $session->Update($bdd, json_decode($_POST["tabChamp"]));
    return;
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
            Post(ExecuteQuery, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ModifSession.php&post\');
            Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeSession.php\');
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
                <input class="value" type="text" name="annee" value="'.$sessions[$_REQUEST["id"]]->getAnnee().'">
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Entreprise</p>
                <input class="value" type="file">
            </div>
            <div class="champ">
                <p class="label labelForInput">Période</p>
                <select  class="value" name="periode">
                    <option name="periode" '.Selected("Été",$sessions[$_REQUEST["id"]]->getPeriode()).'>Été</option>
                    <option name="periode" '.Selected("Automne",$sessions[$_REQUEST["id"]]->getPeriode()).'>Automne</option>
                    <option name="periode"'.Selected("Hiver",$sessions[$_REQUEST["id"]]->getPeriode()).'>Hiver</option>
                    <option name="periode"'.Selected("Printemps",$sessions[$_REQUEST["id"]]->getPeriode()).'>Printemps</option>
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
                    <input class="value" type="date" name="mistagedebut" value="'.$sessions[$_REQUEST["id"]]->getMiStageDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name ="mistagelimite" value="'.$sessions[$_REQUEST["id"]]->getMiStageLimite().'">
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="finaledebut" value="'.$sessions[$_REQUEST["id"]]->getFinaleDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="finalelimite" value="'.$sessions[$_REQUEST["id"]]->getFinaleLimite().'">
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="formationdebut" value="'.$sessions[$_REQUEST["id"]]->getFormationDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="formationlimite" value="'.$sessions[$_REQUEST["id"]]->getFormationLimite().'">
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
                    <input class="value" type="date" name="janvierdebut" value="'.$sessions[$_REQUEST["id"]]->getJanvierDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="janvierlimite" value="'.$sessions[$_REQUEST["id"]]->getJanvierLimite().'">
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="fevrierdebut" value="'.$sessions[$_REQUEST["id"]]->getFormationLimite().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="fevrierlimite" value="'.$sessions[$_REQUEST["id"]]->getFevrierLimite().'">
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="marsdebut" value="'.$sessions[$_REQUEST["id"]]->getMarsDebut().'">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="marslimite" value="'.$sessions[$_REQUEST["id"]]->getMarsLimite().'">
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