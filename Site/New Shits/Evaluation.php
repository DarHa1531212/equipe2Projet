<?php
    $content =
    '<article class="stagiaire">

        <div class="infoStagiaire">
            <h2>'.$eval->getTitre().'&'.$eval->getId().'</h2>
        </div>

        <div class="blocInfo infoProfil">
            <p>
                '.$eval->getObjectifEval().'
            </p>
        </div>

        <div class="separateur">
            <h3>Identification</h3>
        </div>

        '.Identification($bdd).'
        '.$eval->DrawEvaluation($bdd).'';
        
        $content = $content .
        '<div class="navigateurEval">

            '.$boutonsNavigation.'

        </div>'.radioButtonValide().'

        <div class="commentaireEvalMiStage">

            <p>ÉVALUATION GLOBALE DE L’ÉLÈVE STAGIAIRE.</br> Donnez vos commentaires généraux.</p>
                
            '.zoneCommentaire($eval).'

        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')"/>

        <input type="hidden" name="IdSuperviseur" value="'. $profil["IdSuperviseur"] .'" />

        <input type="hidden" name="IdEvaluation" value="'. $_REQUEST["idEvaluation"] .'" />

        <input type="hidden" name="IdStagiaire" value="'. $_REQUEST["idStagiaire"] .'" />
    
    </article>';

    return $content;

?>