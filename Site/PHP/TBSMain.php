<?php

     $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');

    function gestionStatutEtatAvancement($etatAvancement, $dateDebut, $dateLimite, $bdd)
    {
       // $query3 = $bdd->prepare("update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;");

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
        else if( date("Y-m-d") < $dateDebut)
        {
            //affichage de l'évaluation : le statut est supposé etre a pas accéssible
        }
        else //intervalle de l'évaluation
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

        //gestion du statut ici

        if($etatAvancements[0]->Statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=AVenir.php&idStage='.$etatAvancements[0]->IdStage.'&idEtatAvancement='.$etatAvancements[0]->IdEtatAvancement.'\');">';
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
        //$di1v = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idStage=\', '.$tblEvaluation[2]->idStage.', \'&idEvaluation=\', '.$tblEvaluation[2]->id.', \'&typeEval=3\')">';
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
        //echo count($profils);        
        
            //$query2->execute(array('IdStage'=> $profil["IdStage"]));

            //$autoEvaluation = $query2->fetchAll();
            $autoEvaluation = $bdd->Request('select *
                                        from vinfoevalglobale
                                        where IdStage = :IdStage and IdTypeEvaluation = 4;',
                                            array('IdStage'=>$profil->IdStage),
                                            "stdClass");

            $etatAvancements = $bdd->Request('select * from vInfoEtatAvancement
                                                where IdStage = 1;',
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
                    <th>Autre</th>
                </thead>

                <tbody>
                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=JournalBord.php\', \'&nbEntree=\', 5) ">
                        <td>Journal de bord</td>
                    </tr>

                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$profil->IdStage.'&idEvaluation='.$autoEvaluation[0]->IdEvaluation.'&typeEval=4\')">
                        <td>Auto-Évaluation</td>
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
        
   /*$content = 
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$profils[0]->Prenom.' '.$profils[0]->Nom.'</h2>
            <input class="bouton" type="button" value="Afficher le profil" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->Id.'&nomMenu=Profil.php\')"/>
            <br /><br /><br /><br /><br /><br />
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->IdEnseignant.'&nomMenu=Profil.php\')">
                <div class="entete">
                    <h2>Enseignant</h2>
                </div>

                <div>
                    <p>'.$profils[0]->PrenomEnseignant.' '.$profils[0]->NomEnseignant.'</p>
                    <p>'.$profils[0]->TelEnseignant.'</p>
                </div>
            </a>
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->IdSuperviseur.'&nomMenu=Profil.php\')">
                <div class="entete">
                    <h2>Superviseur</h2>
                </div>

                <div>
                    <p>'.$profils[0]->PrenomSuperviseur.' '.$profils[0]->NomSuperviseur.'</p>
                    <p>'.$profils[0]->TelSuperviseur.'</p>
                </div>
            </a>
        </div>

        <br/><br/><br/><br/>

        <table>
            <thead>
                <th>Rapport</th>
                <th>Statut</th>
                <th>Date limite</th>
                <th>Date complétée</th>
            </thead>

            <tbody>
                <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Rapport 1</td>
                    <td>Non complétée <span class="statutColor">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                    <td>2017-02-15</td>
                    <td></td>
                </tr>

                <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Rapport 2</td>
                    <td>complétée <span class="statutColor">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                    <td>2017-03-30</td>
                    <td>2017-03-25</td>
                </tr>
            </tbody>
        </table>

        <br/><br/>

        <table>
            <thead>
                <th>Autre</th>
            </thead>

            <tbody>
                <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->Id.'&nomMenu=JournalBord.php\', \'&nbEntree=\', 5) ">
                    <td>Journal de bord</td>
                </tr>

                <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Auto-Évaluation</td>
                </tr>
            </tbody>
        </table>
    </article>';

    return $content;*/
?>