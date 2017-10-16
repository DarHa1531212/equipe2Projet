<?php

    include 'PHP/ConnexionBD.php';
    
    $query = $bdd->prepare("SELECT * FROM vTableauBord");

    $query2 = $bdd->prepare("SELECT Prenom, Eval.Id, Titre, Statut, DateLimite, DateComplétée
                            FROM vSuperviseurEvaluationStagiaireStage AS SESS
                            JOIN vEvaluation AS Eval
                            ON SESS.IdEvaluation = Eval.Id
                            JOIN vStagiaire AS Stag
                            ON Stag.Id = SESS.IdStagiaire
                            JOIN vTypeEvaluation AS TypeEval
                            ON TypeEval.Id = Eval.IdTypeEvaluation
                            WHERE Stag.Id = :idStagiaire");

    $query->execute(array());
    $profils = $query->fetchAll();
    
    foreach($profils as $profil){
        $idStagiaire = $profil["Id"];
        $prenomStagiaire = $profil["Prenom"];
        $nomStagiaire = $profil["Nom"];
        $telPerso = $profil["NumTelPersonnel"];

        $idSup = $profil["Id Superviseur"];
        $nomSup = $profil["Nom Superviseur"];
        $prenomSup = $profil["Prenom Superviseur"];
        $cellSup = $profil["Cell Superviseur"];

        $idProf = $profil["Id Enseignant"];
        $prenomProf = $profil["Prenom Enseignant"];
        $nomProf = $profil["Nom Enseignant"];
        $telProf = $profil["Tel Enseignant"];
        
        $query2->execute(array('idStagiaire'=> $idStagiaire));
        $evals = $query2->fetchAll();
        $tblEvaluation = array();
        
        foreach($evals as $eval){
            $evaluation = (object)[];

            if($eval["Statut"] == "0"){
                $eval["Statut"] = "Non complétée";
            }
            else{
                $eval["Statut"] = "Complétée";   
            }

            $evaluation->statut = $eval["Statut"];
            $evaluation->titre = $eval["Titre"]; 
            $evaluation->dateLimite = $eval["DateLimite"];
            $evaluation->dateCompletee = $eval["DateComplétée"];

            $tblEvaluation[] = $evaluation;
        }
 
        NouvelleZoneStagiaire($idStagiaire, $prenomStagiaire, $nomStagiaire, $telPerso,
                              $idSup, $prenomSup, $nomSup, $cellSup, 
                              $idProf, $prenomProf, $nomProf, $telProf,
                              $tblEvaluation[0]->titre, $tblEvaluation[0]->statut, $tblEvaluation[0]->dateLimite, $tblEvaluation[0]->dateCompletee,
                              $tblEvaluation[1]->titre, $tblEvaluation[1]->statut, $tblEvaluation[1]->dateLimite, $tblEvaluation[1]->dateCompletee);
    }

    function NouvelleZoneStagiaire($idStagiaire, $prenomStag, $nomStag, $numTelStag,
                                   $idSup, $prenomSup, $nomSup, $numSup,
                                   $idProf, $prenomProf, $nomProf, $telProf,
                                   $titreEval1, $statutEval1, $dateLimiteEval1, $dateCompleteeEval1,
                                   $titreEval2, $statutEval2, $dateLimiteEval2, $dateCompleteeEval2){
        echo    '<div class="infoStagiaire slide">
                                <div class="zoneProfil">
                                        <div class="element">
                                            <div class="entete">
                                                <h2>Stagiaire</h2>
                                            </div>

                                            <form action="PHP/ProfilStagiaire.php" method="post">
                                                <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                    <input type="hidden" value="'.$idStagiaire.'" name="idStagiaire"/>
                                                    <p>'.$prenomStag." ".$nomStag.'</p>
                                                    <p>'.$numTelStag.'</p>
                                                </a>
                                            </form>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Superviseur</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="PHP/ProfilSuperviseur.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$idSup.'" name="idSuperviseur"/>
                                                        <p>'.$prenomSup." ".$nomSup.'</p>
                                                        <p>'.$numSup.'</p>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Enseignant</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="PHP/ProfilEnseignant.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$idProf.'" name="idProf"/>
                                                        <p>'.$prenomProf." ".$nomProf.'</p>
                                                        <p>'.$telProf.'</p>
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
                                                    Date limite
                                                </th>
                                                <th>
                                                    Date complétée
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    '.$titreEval1.'
                                                </td>
                                                <td>
                                                    '.$statutEval1.'
                                                </td>
                                                <td>
                                                    '.$dateLimiteEval1.'
                                                </td>
                                                <td>
                                                    '.$dateCompleteeEval1.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    '.$titreEval2.'
                                                </td>
                                                <td>
                                                    '.$statutEval2.'
                                                </td>
                                                <td>
                                                    '.$dateLimiteEval2.'
                                                </td>
                                                <td>
                                                    '.$dateCompleteeEval2.'
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="commentaireContainer">
                                    <input class="bouton" id="boutonCommentaire" value="Écrire un commentaire" type="button"/>
                                </div>
                </div>';
    }
?>