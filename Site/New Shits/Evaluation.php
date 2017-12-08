<?php

    function zoneCommentaire($eval)
    {
        if( ( $eval->getStatut() == 3 ) || ( $eval->getStatut() == 4) )
        {
            $zoneSaisieCommentaire = '<textarea id="commentaireEvaluation" rows="5" cols="100" maxlength="500" name="commentaireEvaluation" wrap="hard" readonly>'.$eval->getCommentaire().'</textarea>';
        }
        else
        {

            $zoneSaisieCommentaire = '<textarea id="commentaireEvaluation" rows="5" cols="100" maxlength="500" name="commentaireEvaluation" wrap="hard"></textarea>';
        }

        return $zoneSaisieCommentaire;
    }

    if(isset($_REQUEST["post"]))
    {
        $eval->Submit($bdd);
    }
        
    function radioButtonValide()
    {
        if(isset($_REQUEST["erreurRadioButton"]))
        {  
            $message = '<div class="messageErreurRadioButton">
                        Confirmation impossible. Veuillez choisir une reponse pour toutes les questions.
                        </div>';
        }
        else
        {
            $message = '';
        }

        return $message;
    }

    if(( $eval->getStatut() == 3 ) || ( $eval->getStatut() == 4))
    {
        $boutonsNavigation = 
        '<input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItemConsultationEvaluation(this)"/>
            '.LettreNav($bdd, $eval).'
        <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItemConsultationEvaluation(this)"/>';

    }
    else
    {
        $boutonsNavigation = 

        '<input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItem(this)"/>
            '.LettreNav($bdd, $eval).'
        <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItem(this)"/>

        <input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); " hidden/>';
    }

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