<?php

   //je trouve tous les stages de ce responsable
    include 'ConnexionBD.php';
    include 'Session.php'; 

    $requeteStagesResponsable = $bdd->prepare("select distinct(Id) 
                                                from vStage
                                                where IdResponsable = :IdResponsable;");

     $requeteSuperviseurStage = $bdd->prepare("select Id,Nom, Prenom, NumTel
                                                from vEmploye
                                                where IdUtilisateur = (

                                                select IdSuperviseur
                                                from vStage
                                                where Id = :IdStage

                                                );");

     $requeteEnseignantStage = $bdd->prepare("select Id, Nom, Prenom, NumTel
                                                from vEmploye
                                                where IdUtilisateur = (

                                                select IdEnseignant
                                                from vStage
                                                where Id = :IdStage

                                                );");

     $requeteStagiaireStage = $bdd->prepare("select Id, Nom, Prenom, NumTel
                                                from vStagiaire
                                                where IdUtilisateur = (

                                                select IdStagiaire
                                                from vStage
                                                where Id = :IdStage

                                                );");

    $requeteEvaluationsStage = $bdd->prepare("SELECT St.Id as 'IdStage', Eva.Id as 'IdEvaluation',Eva.DateComplétée as 'DateComplétée',Eva.Statut as 'Statut',Eva.DateDébut as 'DateDébut',Eva.DateFin as 'DateFin',TE.Id as 'IdTypeEvaluation', TE.Titre as 'TitreTypeEvaluation'
                                                FROM vEvaluation as Eva
                                                join vTypeEvaluation as TE
                                                on TE.Id = Eva.IdTypeEvaluation
                                                JOIN vEvaluationStage as ES
                                                on Eva.Id = ES.IdEvaluation
                                                join vStage as St
                                                on St.Id = ES.IdStage
                                                where IdStage = :IdStage;");


    $requeteStagesResponsable->execute(array('IdResponsable'=> $_SESSION['idConnecte']));


    $listeStatut = array('pas accéssible','pas débuté','en retard','soumis ','valide ');



    $stagesResponsable = $requeteStagesResponsable->fetchAll();

    if(count($stagesResponsable) != 0)
    {
        foreach ($stagesResponsable as $stage) 
        {
            $requeteSuperviseurStage->execute(array('IdStage'=> $stage['Id']));

            $superviseurStage = $requeteSuperviseurStage->fetchAll();

            $requeteEnseignantStage->execute(array('IdStage'=> $stage['Id']));

            $enseignantStage = $requeteEnseignantStage->fetchAll();

            $requeteStagiaireStage->execute(array('IdStage'=> $stage['Id']));

            $stagiaireStage = $requeteStagiaireStage->fetchAll();

            $requeteEvaluationsStage->execute(array('IdStage'=> $stage['Id']));

            $evaluationsStage = $requeteEvaluationsStage->fetchAll();

            echo    '<div class="infoStagiaire slide">
                                <div class="zoneProfil">
                                        <div class="element">
                                            <div class="entete">
                                                <h2>Stagiaire</h2>
                                            </div>

                                            <form action="Profil.php" method="post">
                                                <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                    <input type="hidden" value="'.$stagiaireStage[0]['Id'].'" name="idStagiaire"/>
                                                    <input type="hidden" value="Stag" name="PStag"/>
                                                    <p>'.$stagiaireStage[0]['Prenom']." ".$stagiaireStage[0]['Nom'].'</p>
                                                    <p>'.$stagiaireStage[0]['NumTel'].'</p>
                                                </a>
                                            </form>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Superviseur</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="Profil.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$superviseurStage[0]['Id'].'" name="idSuperviseur"/>
                                                        <input type="hidden" value="Sup" name="PSup"/>
                                                        <p>'.$superviseurStage[0]['Prenom']." ".$superviseurStage[0]['Nom'].'</p>
                                                        <p>'.$superviseurStage[0]['NumTel'].'</p>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Enseignant</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="Profil.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$enseignantStage[0]['Id'].'" name="idProf"/>
                                                        <input type="hidden" value="Prof" name="PProf"/>
                                                        <p>'.$enseignantStage[0]['Prenom']." ".$enseignantStage[0]['Nom'].'</p>
                                                        <p>'.$enseignantStage[0]['NumTel'].'</p>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <div class="evaluation">
                                    <table class="table" class="tableauEvaluation">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Évaluation
                                                </th>
                                                <th>
                                                    Statut
                                                </th>
                                                <th>
                                                    Date début
                                                </th>
                                                <th>
                                                    Date limite
                                                </th>
                                                <th>
                                                    Date complétée
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        if($evaluationsStage[0]['Statut'] != '0')//le statut est different de pas accéssible
                                        {
                                            //accéssible
                                             echo '<tr>
                                                                <td>'.EvaluationCliquable($evaluationsStage[0]['TitreTypeEvaluation'], $evaluationsStage[0],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($listeStatut[$evaluationsStage[0]['Statut']], $evaluationsStage[0],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[0]['DateDébut'], $evaluationsStage[0],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[0]['DateFin'], $evaluationsStage[0],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[0]['DateComplétée'], $evaluationsStage[0],$stage['Id']).'</td>

                                                    </tr>'; 
                                        }
                                        else
                                        {
                                            echo '<tr>
                                                                <td>'.EvaluationNonCliquable($evaluationsStage[0]['TitreTypeEvaluation']).'</td>

                                                                <td>'.EvaluationNonCliquable($listeStatut[$evaluationsStage[0]['Statut']]).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[0]['DateDébut']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[0]['DateFin']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[0]['DateComplétée']).'</td>

                                                    </tr>'; 
                                        }

                                        if(($evaluationsStage[1]['Statut'] != '0')&&(($evaluationsStage[0]['Statut'] == '3')||($evaluationsStage[0]['Statut'] == '4')))
                                        {
                                            //accéssible
                                             echo '<tr>
                                                                <td>'.EvaluationCliquable($evaluationsStage[1]['TitreTypeEvaluation'], $evaluationsStage[1],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($listeStatut[$evaluationsStage[1]['Statut']], $evaluationsStage[1],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[1]['DateDébut'], $evaluationsStage[1],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[1]['DateFin'], $evaluationsStage[1],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[1]['DateComplétée'],$evaluationsStage[1],$stage['Id']).'</td>

                                                    </tr>'; 
                                        }
                                        else
                                        {
                                                 echo '<tr>
                                                                <td>'.EvaluationNonCliquable($evaluationsStage[1]['TitreTypeEvaluation']).'</td>

                                                                <td>'.EvaluationNonCliquable($listeStatut[$evaluationsStage[1]['Statut']]).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[1]['DateDébut']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[1]['DateFin']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[1]['DateComplétée']).'</td>

                                                    </tr>'; 
                                        }


                                        if(($evaluationsStage[2]['Statut'] != '0')&&(($evaluationsStage[0]['Statut'] == '3')||($evaluationsStage[0]['Statut'] == '4'))&&(($evaluationsStage[1]['Statut'] == '3')||($evaluationsStage[1]['Statut'] == '4')))
                                        {
                                            //accéssible
                                             echo '<tr>
                                                                <td>'.EvaluationCliquable($evaluationsStage[2]['TitreTypeEvaluation'], $evaluationsStage[2],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($listeStatut[$evaluationsStage[2]['Statut']], $evaluationsStage[2],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[2]['DateDébut'], $evaluationsStage[2],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[2]['DateFin'], $evaluationsStage[2],$stage['Id']).'</td>

                                                                <td>'.EvaluationCliquable($evaluationsStage[2]['DateComplétée'], $evaluationsStage[2],$stage['Id']).'</td>

                                                    </tr>'; 
                                        }
                                        else
                                        {
                                                 echo '<tr>
                                                                <td>'.EvaluationNonCliquable($evaluationsStage[2]['TitreTypeEvaluation']).'</td>

                                                                <td>'.EvaluationNonCliquable($listeStatut[$evaluationsStage[2]['Statut']]).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[2]['DateDébut']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[2]['DateFin']).'</td>

                                                                <td>'.EvaluationNonCliquable($evaluationsStage[2]['DateComplétée']).'</td>

                                                    </tr>'; 
                                        }
                                      
                                           
                                echo '</tbody>
                                    </table>
                                </div>

                                    <div class="commentaireContainer">
                                        <input class="bouton" id="boutonCommentaire" value="Écrire un commentaire" type="button"/>
                                    </div>
                                </div>';

        }
    }
    else
    {
            //aucun stage n'est associé a ce responsable
    }

    function EvaluationCliquable($info, $evaluation,$IdStage)
    {
        if($evaluation['IdTypeEvaluation'] == 1)//evaluation mi-stage
        {
             $string =  '<form action="EvaluationMiStage.php" method="POST">
                        <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                            <input type="hidden" value="' . $evaluation['IdEvaluation'] . '" name="IdEvaluation"/>
                            <input type="hidden" value="' . $IdStage . '" name="IdStage"/>
                            ' . $info . '
                        </a>
                    </form>';
        }
        else if ($evaluation['IdTypeEvaluation'] == 2)//evaluation finale
        {
                 $string =  '<form action="EvaluationFinale.php" method="POST">
                        <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                            <input type="hidden" value="' . $evaluation['IdEvaluation'] . '" name="IdEvaluation"/>
                            <input type="hidden" value="' . $IdStage . '" name="IdStage"/>
                            ' . $info . '
                        </a>
                    </form>';
        }
        else if ($evaluation['IdTypeEvaluation'] == 3)//evaluation formation
        {
                 $string =  $info;
        }


       

        return $string;
    }

    function EvaluationNonCliquable($info)
    {
         $string =  '<a class="zoneCliquable" href="javascript:;" onclick="messageEvaluation()">' 

                    . $info . '</a>';

        return $string;
    }


?>