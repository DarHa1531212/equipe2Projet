<?php

     $eval = new Evaluation($bdd, $_REQUEST["idEvaluation"]);

    if($eval->getIdTypeEval() == 1)
        $eval = new EvaluationGrilleMiStage($bdd, $_REQUEST["idEvaluation"]);
    else if($eval->getIdTypeEval() == 2)
        $eval = new EvaluationChoixReponse($bdd, $_REQUEST["idEvaluation"]);
    else if($eval->getIdTypeEval() == 3)
        $eval = new EvaluationGrilleFormation($bdd, $_REQUEST["idEvaluation"]);
    else if($eval->getIdTypeEval() == 4)//auto-evaluation
        $eval = new EvaluationGrilleMiStage($bdd, $_REQUEST["idEvaluation"]);

    function Identification($bdd){
        $identifications = $bdd->Request("SELECT * FROM vIdentification
                                            WHERE IdStage = :IdStage",
                                            array('IdStage'=>$_REQUEST["idStage"]),
                                            "stdClass");
        
        
        foreach ($identifications as $identification) 
        {
            
            return 
            '
            <table class="identification">
                <tbody>
                    <tr>
                        <td>Organisation</td>
                        <td>'.$identification->NomEnt.'</td>
                    </tr>

                    <tr>
                        <td>Responsable technique</td>
                        <td>'.$identification->PrenomResp.' '.$identification->NomResp.'</td>
                    </tr>

                    <tr>
                        <td>Responsable pédagogique</td>
                        <td>'.$identification->PrenomEns.' '.$identification->NomEns.'</td>
                    </tr>

                    <tr>
                        <td>Élève stagiaire</td>
                        <td>'.$identification->PrenomSta.' '.$identification->NomSta.'</td>
                    </tr>
                </tbody>
            </table>
            ';
        }
       
    }

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

            if(( $eval->getStatut() == 3 ) || ( $eval->getStatut() == 4))
            {
                $content = $content.
                    '<input id="Cat'.$i++.'" type="button" value="'.$categorie->getLettre().'" class="lettreNav bouton" onclick="JumpToConsultationEvaluation('.($i-1).')"/>';
            }
            else
            {
                $content = $content.
                    '<input id="Cat'.$i++.'" type="button" value="'.$categorie->getLettre().'" class="lettreNav bouton" onclick="JumpTo('.($i-1).')"/>';
            }
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

        <input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="submitEvaluation()" hidden/>';
        //<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil->IdSuperviseur.'&nomMenu=Eval\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); " hidden/>
    }

    //$boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].') " hidden/>'; 
    
    //$boutonValider = '<input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); " hidden/>';

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

        <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdSuperviseur.'&nomMenu=Main\')"/>

        <input type="hidden" name="IdSuperviseur" value="'.$profils[0]->IdSuperviseur.'" />

        <input type="hidden" name="IdEvaluation" value="'. $_REQUEST["idEvaluation"] .'" />

        <input type="hidden" name="IdStagiaire" value="'. $_REQUEST["id"] .'" />
    
    </article>';

    return $content;


?>