<?php

     $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');

     
    

    $content='';

    foreach($profils as $profil)/*pour chaque stages au quel le stagiaire a participe*/
    {
        //echo count($profils);        
        
            //$query2->execute(array('IdStage'=> $profil["IdStage"]));

            //$autoEvaluation = $query2->fetchAll();
            $autoEvaluation = $bdd->Request('  select *
                                        from vinfoevalglobale
                                        where IdStage = :IdStage and IdTypeEvaluation = 4;',
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
                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=etatAvancement.php\')">
                        <td>Etat avancement janvier</td>
                        <td>Non complétée <span class="statutColor">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                        <td>2017-02-15</td>
                        <td></td>
                    </tr>

                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=etatAvancement.php\')">
                        <td>Etat avancement fevrier</td>
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
                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=JournalBord.php\', \'&nbEntree=\', 5) ">
                        <td>Journal de bord</td>
                    </tr>

                    <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->Id.'&nomMenu=Evaluation.php&idStage='.$profil->IdStage.'&idEvaluation='.$autoEvaluation[0]->IdEvaluation.'&typeEval=4\')">
                        <td>Auto-Évaluation'. $autoEvaluation[0]->IdEvaluation.'</td>
                    </tr>
                </tbody>
            </table>

        </article>';

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