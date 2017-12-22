<?php

     $listeStatut = array('Pas Accessible','Pas Débuté','En Retard','Soumis ','Valide ');

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

    function gestionStatutAutoEvaluation($autoEvaluation, $dateDebut, $dateLimite, $bdd)
    {  
        if(date("Y-m-d") > $dateLimite) 
        {
            if(($autoEvaluation->Statut != 3) && ($autoEvaluation->Statut != 4))
            {
                 $bdd->Request("update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;",
                                array('IdEvaluation'=> $autoEvaluation->IdEvaluation, 'Statut'=>2),
                                "stdClass");

                $autoEvaluation->Statut = 2;
            }
        }
        else if((date("Y-m-d") > $dateDebut)&&( date("Y-m-d") < $dateLimite))//intervalle de l'évaluation
        { 
            if( ($autoEvaluation->Statut != 3) && ($autoEvaluation->Statut != 4))
            {
                //l'evaluation n'est ni soumise, ni validée
                //update du statut de l'evaluation : il passe a pas débuté
                $bdd->Request(" update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;",
                                array('Statut'=>1, 'IdEvaluation'=> $autoEvaluation->IdEvaluation), "stdClass");
                $autoEvaluation->Statut = 1;   
            }
        }
        
    }

    function gestionStatutEtatAvancement($etatAvancement, $dateDebut, $dateLimite, $bdd)
    {

        if(date("Y-m-d") > $dateLimite) 
        {
            if(($etatAvancement->Statut != 3) && ($etatAvancement->Statut != 4))
            {
                 $bdd->Request("update tblEtatAvancement set Statut=:Statut where Id=:IdEtatAvancement;",
                                array('IdEtatAvancement'=> $etatAvancement->IdEtatAvancement, 'Statut'=>2),
                                "stdClass");

                $etatAvancement->Statut = 2;
            }
        }
        else if((date("Y-m-d") > $dateDebut)&&( date("Y-m-d") < $dateLimite))//intervalle de l'évaluation
        {
            if( ($etatAvancement->Statut != 3) && ($etatAvancement->Statut != 4))
            {
                //l'evaluation n'est ni soumise, ni validée
                //update du statut de l'evaluation : il passe a pas débuté
                $bdd->Request("update tblEtatAvancement set Statut=:Statut where Id=:IdEtatAvancement;",
                                array('IdEtatAvancement'=> $etatAvancement->IdEtatAvancement, 'Statut'=>1),
                                "stdClass");

                $etatAvancement->Statut = 1;
            }
        }

    }

    function VerifAutoEvaluation($autoEvaluation, $profil, $bdd)
    {
        $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');
        $div = "";
        $eval1 = "";

        //pour l'instant les dates pour l'auto-evaluations sont celles de l'évaluation de la formation
        gestionStatutAutoEvaluation($autoEvaluation,$profil->FormationDebut,$profil->FormationLimite, $bdd);
        
        if($autoEvaluation->Statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$profil->IdStage.'&idEvaluation='.$autoEvaluation->IdEvaluation.'&typeEval=4\')">';
        }
        else
        {
            $div = '<tr>';
        }

        $eval1 = $div.
            '<td>'.$autoEvaluation->TitreTypeEvaluation.'</td>
            <td> <span class="statutColor" style="background-color:' . definirCouleur($autoEvaluation->Statut) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$listeStatut[$autoEvaluation->Statut].'</td>
            <td>'.$profil->FormationDebut.'</td>
            <td>'.$profil->FormationLimite.'</td>
            <td>'.$autoEvaluation->DateComplétée.'</td>
        </tr>';
        
        
        $div = $eval1;
        
        return $div;
    }

    function VerifEtatAvancement($etatAvancements, $profil, $bdd)
    {
        $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');
        $div = "";
        $etat1 = "";
        $etat2 = "";
        $etat3 = "";


        foreach ($etatAvancements as $etatAvancement) 
        {
            
            if($etatAvancement->IdTypeEtatAvancement == 1)//evaluation mi-stage
            {
                gestionStatutEtatAvancement($etatAvancement,$profil->JanvierDebut,$profil->JanvierLimite, $bdd);
            }
            else if($etatAvancement->IdTypeEtatAvancement == 2)//evaluation-finale
            {
                gestionStatutEtatAvancement($etatAvancement, $profil->FevrierDebut, $profil->FevrierLimite, $bdd);
            }
            else if($etatAvancement->IdTypeEtatAvancement == 3)//evaluation de la formation
            {
                gestionStatutEtatAvancement($etatAvancement, $profil->MarsDebut, $profil->MarsLimite, $bdd);
            }
        }

        if($etatAvancements[0]->Statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=etatAvancement.php&idStage='.$etatAvancements[0]->IdStage.'&idEtatAvancement='.$etatAvancements[0]->IdEtatAvancement.'\');">';
        }
        else
        {
            $div = '<tr>';
        }

         $etat1 = $div.
            '<td>'.$etatAvancements[0]->TitreTypeEtat.'</td>
            <td>'.$listeStatut[$etatAvancements[0]->Statut].'</td>
            <td>'.$profil->JanvierDebut.'</td>
            <td>'.$profil->JanvierLimite.'</td>
            <td>'.$etatAvancements[0]->DateComplétée.'</td>
        </tr>';

        if(($etatAvancements[1]->Statut != '0')&&(($etatAvancements[0]->Statut == '3')||($etatAvancements[0]->Statut == '4')))
        {
             $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=AVenir.php&idStage='.$etatAvancements[1]->IdStage.'&idEtatAvancement='.$etatAvancements[1]->IdEtatAvancement.'\');">';
        }
        else
        {
            $div = '<tr>';
        }
        
        $etat2 = $div.
            '<td>'.$etatAvancements[1]->TitreTypeEtat.'</td>
            <td>'.$listeStatut[$etatAvancements[1]->Statut].'</td>
            <td>'.$profil->FevrierDebut.'</td>
            <td>'.$profil->FevrierLimite.'</td>
            <td>'.$etatAvancements[1]->DateComplétée.'</td>
        </tr>';

         if(($etatAvancements[2]->Statut != '0')&&(($etatAvancements[0]->Statut == '3')||($etatAvancements[0]->Statut == '4'))&&(($etatAvancements[1]->Statut == '3')||($etatAvancements[1]->Statut == '4')))//statut different de pas accéssible et est soumis ou valide
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=AVenir.php&idStage='.$etatAvancements[2]->IdStage.'&idEtatAvancement='.$etatAvancements[2]->IdEtatAvancement.'\');">';
        }
        else
        {
            $div = '<tr>';
        }

        $etat3 = $div.
            '<td>'.$etatAvancements[2]->TitreTypeEtat.'</td>
            <td>'.$listeStatut[$etatAvancements[2]->Statut].'</td>
            <td>'.$profil->MarsDebut.'</td>
            <td>'.$profil->MarsLimite.'</td>
            <td>'.$etatAvancements[2]->DateComplétée.'</td>
        </tr>';

        
        $div = $etat1.$etat2.$etat3;

         return $div;
    }

    $content='';

    foreach($profils as $profil)/*pour chaque stages au quel le stagiaire a participe*/
    {
            //<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
            $autoEvaluation = $bdd->Request('SELECT *
                                            FROM    vInfoEvalGlobale
                                            WHERE IdStage = :IdStage AND IdTypeEvaluation = 4;',
                                            array('IdStage'=>$profil->IdStage),
                                            "stdClass");

            $etatAvancements = $bdd->Request('SELECT * FROM vInfoEtatAvancement
                                                WHERE IdStage = :IdStage;',
                                                array('IdStage'=>$profil->IdStage),
                                                "stdClass");

             $content = $content.
                '<article class="stagiaire">
                
            <div class="infoStagiaire">
                <h2>'.$profil->Prenom.' '.$profil->Nom.'</h2>
                <input class="bouton" type="button" value="Afficher le profil" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Profil.php\')"/>
                <br /><br /><br /><br /><br /><br />
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
            </div>

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
            </div>

            <br/><br/><br/><br/>

            <table>
                <thead>
                    <th>Rapport</th>
                    <th>Statut</th>
                    <th>Date début</th>
                    <th>Date limite</th>
                    <th>Date complétée</th>
                </thead>

                <tbody>
                    '.VerifEtatAvancement($etatAvancements, $profil, $bdd).'
                </tbody>
            </table>

            <br/><br/>

            <table>
                <thead>
                    <th>Auto-Évaluation</th>
                    <th>Statut</th>
                    <th>Date début</th>
                    <th>Date limite</th>
                    <th>Date complétée</th>
                </thead>

                <tbody>'
                    .VerifAutoEvaluation($autoEvaluation[0], $profil, $bdd).'
                </tbody>
            </table>


            <table>
                <thead>
                    <th>Autre</th>
                </thead>

                <tbody>
                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=JournalBord.php\', \'&nbEntree=\', 5); addArea2() ">
                        <td>Journal de bord</td>
                    </tr>
                </tbody>
            </table>

            <br/><br/><br/>';
                    
            if(count($profils) > 1)
            {
                //Si il y a plus qu'un stagiaire, affiche les flèches.
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