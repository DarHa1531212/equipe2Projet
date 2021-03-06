<?php
    $content = "";

    function definirCouleur($Statut)//permet de definir la couleur des statut d'un evaluation
    {
        switch($Statut)//return la couleur qui sera ajouter en CSS
        {
            case 4:       return 'rgba(72, 229, 88, 1)'; //Green - Valide
            break;
            case 2:       return 'rgba(237, 7, 7, 1)'; //red - En retard
            break;
            case 0:       return 'rgba(248, 181, 99, 1)'; //Orange - Non Disponible
            break;
            case 3:       return 'rgba(255, 253, 112, 1)'; //Jaune - Soumis
            break;
            case 1:       return 'rgba(51, 43, 218, 1)'; //Bleu - Pas débuté
            break;
        }
    }


    //met a jour les statut des evaluations en fonction des dates
    function gestionStatutEvaluation($evaluation, $dateDebut, $dateLimite, $bdd)
    {  
        if(date("Y-m-d") > $dateLimite) 
        {
            if(($evaluation->Statut != 3) && ($evaluation->Statut != 4))
            {
                 $bdd->Request("update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;",
                                array('IdEvaluation'=> $evaluation->IdEvaluation, 'Statut'=>2),
                                "stdClass");

                $evaluation->Statut = 2;
            }
        }
        else if((date("Y-m-d") > $dateDebut)&&( date("Y-m-d") < $dateLimite))//intervalle de l'évaluation
        { 
            if( ($evaluation->Statut != 3) && ($evaluation->Statut != 4))
            {
                //l'evaluation n'est ni soumise, ni validée
                //update du statut de l'evaluation : il passe a pas débuté
                $bdd->Request(" update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;",
                                array('Statut'=>1, 'IdEvaluation'=> $evaluation->IdEvaluation), "stdClass");
                $evaluation->Statut = 1;   
            }
        }
        
    }

    //Vérifie si les évaluations précédentes sont complétées pour pouvoir appuyer sur la suivante.
    function VerifEvaluation($tblEvaluation, $profil, $bdd)
    {
        $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');
        $div = "";
        $eval1 = "";
        $eval2 = "";
        $eval3 = "";

        foreach ($tblEvaluation as $evaluation) 
        {
            
            if($evaluation->IdTypeEvaluation == 1)//evaluation mi-stage
            {
                gestionStatutEvaluation($evaluation,$profil->MiStageDebut,$profil->MiStageLimite, $bdd);
            }
            else if($evaluation->IdTypeEvaluation == 2)//evaluation-finale
            {
                gestionStatutEvaluation($evaluation, $profil->FinaleDebut, $profil->FinaleLimite, $bdd);
            }
            else if($evaluation->IdTypeEvaluation == 3)//evaluation de la formation
            {
                gestionStatutEvaluation($evaluation, $profil->FormationDebut, $profil->FormationLimite, $bdd);
            }
        }
        
        if($tblEvaluation[0]->Statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$tblEvaluation[0]->IdStage.'&idEvaluation='.$tblEvaluation[0]->IdEvaluation.'&typeEval=1\');">';
            
        }
        else
        {
            $div = '<tr>';
        }

        $eval1 = $div.
            '<td>'.$tblEvaluation[0]->TitreTypeEvaluation.'</td>
            <td> <span class="statutColor" style="background-color:' . definirCouleur($tblEvaluation[0]->Statut) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$listeStatut[$tblEvaluation[0]->Statut].'</td>
            <td>'.$profil->MiStageDebut.'</td>
            <td>'.$profil->MiStageLimite.'</td>
            <td>'.$tblEvaluation[0]->DateComplétée.'</td>
        </tr>';
        
        if(($tblEvaluation[1]->Statut != '0')&&(($tblEvaluation[0]->Statut == '3')||($tblEvaluation[0]->Statut == '4')))//statut different de pas accéssible et est soumis ou valide
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$tblEvaluation[1]->IdStage.'&idEvaluation='.$tblEvaluation[1]->IdEvaluation.'&typeEval=2\')">';
        }
        else
        {
            $div = '<tr>';
        }
        
        $eval2 = $div.
            '<td>'.$tblEvaluation[1]->TitreTypeEvaluation.'</td>
            <td> <span class="statutColor" style="background-color:' . definirCouleur($tblEvaluation[1]->Statut) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$listeStatut[$tblEvaluation[1]->Statut].'</td>
            <td>'.$profil->FinaleDebut.'</td>
            <td>'.$profil->FinaleLimite.'</td>
            <td>'.$tblEvaluation[1]->DateComplétée.'</td>
        </tr>';

        if(($tblEvaluation[2]->Statut != '0')&&(($tblEvaluation[0]->Statut == '3')||($tblEvaluation[0]->Statut == '4'))&&(($tblEvaluation[1]->Statut == '3')||($tblEvaluation[1]->Statut == '4')))//statut different de pas accéssible et est soumis ou valide
        {
             $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$tblEvaluation[2]->IdStage.'&idEvaluation='.$tblEvaluation[2]->IdEvaluation.'&typeEval=3\')">';
        }
        else
        {
            $div = '<tr>';
        }

        $eval3 = $div.
            '<td>'.$tblEvaluation[2]->TitreTypeEvaluation.'</td>
            <td> <span class="statutColor" style="background-color:' . definirCouleur($tblEvaluation[2]->Statut) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$listeStatut[$tblEvaluation[2]->Statut].'</td>
            <td>'.$profil->FormationDebut.'</td>
            <td>'.$profil->FormationLimite.'</td>
            <td>'.$tblEvaluation[2]->DateComplétée.'</td>
        </tr>';

        $div = $eval1.$eval2.$eval3;
        
        return $div;
    }

    foreach($profils as $profil)
    {
        $evals = $bdd->Request("SELECT * FROM vInfoEvalGlobale
                                WHERE IdStage = :IdStage;",
                                array('IdStage'=> $profil->IdStage),
                                "stdClass");
        
        $content = $content.
        '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$profil->Prenom.' '.$profil->Nom.'</h2>
            <input class="bouton" type="button" value="Afficher le profil" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Profil.php\')"/>
            <h3>'.$profil->NumTelPerso.'</h3>
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->IdEnseignant.'&nomMenu=Profil.php\')">
                <div class="entete">
                    <h2>Enseignant</h2>
                </div>

                <div>
                    <p>'.$profil->PrenomEnseignant.' '.$profil->NomEnseignant.'</p>
                    <p>'.$profil->TelEnseignant.'</p>
                </div>
            </a>
        </div>';

        if($_SESSION['IdRole'] != 4)
        {   

            //Si l'utilisateur n'est pas superviseur, affiche les infos du superviseur.
            $content = $content.
            '
            <div class="blocInfo itemHover">
                <a class="linkFill" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->IdSuperviseur.'&nomMenu=Profil.php\')">
                    <div class="entete">
                        <h2>Superviseur</h2>
                    </div>

                    <div>
                        <p>'.$profil->PrenomSuperviseur.' '.$profil->NomSuperviseur.'</p>
                        <p>'.$profil->TelSuperviseur.'</p>
                    </div>
                </a>
            </div>';
        }
        
        $content = $content.
        '<br/><br/><br/><br/>

        <table>
            <thead>
                <th>Évaluation</th>
                <th>Statut</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Date Complétée</th>
            </thead>

            <tbody>
                '.VerifEvaluation($evals, $profil, $bdd).'
            </tbody>
        </table>

        <br/><br/><br/>';
        
        if(count($profils) > 1)
        {//Si il y a plus qu'un stagiaire, affiche les flèches.
            $content = $content.
            '<div class="navigateur">
                <div id="gauche" class="fleche flecheGauche" onclick="ChangerItem(this)"></div>
                <div id="droite" class="fleche flecheDroite" onclick="ChangerItem(this)"></div>
            </div>';
        }
        
        $content = $content.
        '</article>';
    }

    return $content;

?>