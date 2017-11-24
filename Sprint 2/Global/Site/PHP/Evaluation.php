<?php

    $eval = new Evaluation($bdd, $_REQUEST["idEvaluation"]);

    if($eval->getIdTypeEval() == 1)
        $eval = new EvaluationGrille($bdd, $_REQUEST["idEvaluation"]);
    else if($eval->getIdTypeEval() == 2)
        $eval = new EvaluationChoixReponse($bdd, $_REQUEST["idEvaluation"]);

    function Identification($bdd)
    {
        $query = $bdd->prepare( 'SELECT * FROM vIdentification
                            WHERE IdStagiaire = :idStagiaire');

        $query->execute(array('idStagiaire'=>$_REQUEST["idStagiaire"]));

        $identification = $query->fetchAll();
        
        return 
        '
        <table class="identification">
            <tbody>
                <tr>
                    <td>Organisation</td>
                    <td>'.$identification[0]["NomEnt"].'</td>
                </tr>

                <tr>
                    <td>Responsable technique</td>
                    <td>'.$_SESSION['PrenomConnecte'].' '.$_SESSION['NomConnecte'].'</td>
                </tr>

                <tr>
                    <td>Responsable pédagogique</td>
                    <td>'.$identification[0]["PrenomEns"].' '.$identification[0]["NomEns"].'</td>
                </tr>

                <tr>
                    <td>Élève stagiaire</td>
                    <td>'.$identification[0]["PrenomSta"].' '.$identification[0]["NomSta"].'</td>
                </tr>
            </tbody>
        </table>
        ';
    }

    /*function radioButtonValide($bdd)
    {
        if(isset($_REQUEST["post"])) 
        {
            $reponses = json_decode($_POST["tabReponse"], true);

            if(count($eval->getQuestions()) == count($reponses))
            {
                //toutes les questions ont ete cochées
                $eval->Submit($bdd);

                $message = 'O';

            }
            else
            {
                $message = '<div class = "messageErreurRadioButton" > Soumission impossible. Vous n\'avez pas repondu a toutes les questions </div>';
            }
        }
        else
        {
            $message = 'N';
        }   

        return $message;
    }*/

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


    function LettreNav($bdd, $eval)
    {
        $i = 0;
        $content = "";
        
        foreach($eval->getCategories() as $categorie)
        {
            $content = $content.
            '<input id="Cat'.$i++.'" type="button" value="'.$categorie->getLettre().'" class="lettreNav bouton" onclick="JumpTo('.($i-1).')"/>';
        }
        
        return $content;
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
        $boutonValider = '';
    }
    else
    {
        $boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); " hidden/>';
        //$boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')" hidden/>';
    }

    //$boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].') " hidden/>'; 
    
    //$boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); " hidden/>';

    $content =
    '<article class="stagiaire">

        <div class="infoStagiaire">
            <h2>'.$eval->getTitre().'</h2>
        </div>

        <div class="blocInfo infoProfil">
            <p>
                La première évaluation servira à noter de façon générale l’élève stagiaire en vue
                d\'un réajustement possible. Il serait grandement souhaitable que cette évaluation
                se fasse conjointement avec l’élève stagiaire et que la démarche s\'effectue de
                façon formative. Une fois complété, le formulaire devra être remis à votre
                stagiaire qui se chargera de nous l\'expédier.
            </p>
        </div>

        <div class="separateur">
            <h3>Identification</h3>
        </div>

        '.Identification($bdd).'
        '.$eval->DrawEvaluation($bdd).'';
        
        $content = $content .
        '<div class="navigateurEval">
            <input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItem(this)"/>
            '.LettreNav($bdd, $eval).'
            <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItem(this)"/>'

            .$boutonValider.

        '</div>'.radioButtonValide().'

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