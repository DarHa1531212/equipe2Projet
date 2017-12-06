<?php
    $content = "";

    //Vérifie si les évaluations précédentes sont complétées pour pouvoir appuyer sur la suivante.
    function VerifEvaluation($tblEvaluation, $profil){
        $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');
        $div = "";
        $eval1 = "";
        $eval2 = "";
        
        if($tblEvaluation[0]->Statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil->Id.'&nomMenu=Evaluation.php\', \'&idStage=\', '.$tblEvaluation[0]->IdStage.', \'&idEvaluation=\', '.$tblEvaluation[0]->IdEvaluation.', \'&typeEval=1\');">';
        }
        else
        {
            $div = '<tr>';
        }

        $eval1 = $div.
            '<td>'.$tblEvaluation[0]->TitreTypeEvaluation.'</td>
            <td>'.$listeStatut[$tblEvaluation[0]->Statut].'</td>
            <td>'.$tblEvaluation[0]->DateDébut.'</td>
            <td>'.$tblEvaluation[0]->DateFin.'</td>
            <td>'.$tblEvaluation[0]->DateComplétée.'</td>
        </tr>';
        
        if(($tblEvaluation[1]->Statut != '0')&&(($tblEvaluation[0]->Statut == '3')||($tblEvaluation[0]->Statut == '4')))
        {
            $div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil->Id.'&nomMenu=Evaluation.php\', \'&idStage=\', '.$tblEvaluation[1]->IdStage.', \'&idEvaluation=\', '.$tblEvaluation[1]->IdEvaluation.', \'&typeEval=2\')">';
        }
        else
        {
            $div = '<tr>';
        }
        
        $eval2 = $div.
            '<td>'.$tblEvaluation[1]->TitreTypeEvaluation.'</td>
            <td>'.$listeStatut[$tblEvaluation[1]->Statut].'</td>
            <td>'.$tblEvaluation[1]->DateDébut.'</td>
            <td>'.$tblEvaluation[1]->DateFin.'</td>
            <td>'.$tblEvaluation[1]->DateComplétée.'</td>
        </tr>';
        
        $div = $eval1.$eval2;
        
        return $div;
    }

    foreach($profils as $profil){
        $evals = $bdd->Request("SELECT * FROM vInfoEvalGlobale
                                WHERE IdStagiaire = :idStagiaire;",
                                array('idStagiaire'=> $profil->Id),
                                "stdClass");
        
        $content = $content.
        '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$profil->Prenom.' '.$profil->Nom.'</h2>
            <input class="bouton" type="button" value="Afficher le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil->Id.'&nomMenu=Profil.php\')"/>
            <h3>'.$profil->NumTel.'</h3>
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil->IdEnseignant.'&nomMenu=Profil.php\')">
                <div class="entete">
                    <h2>Enseignant</h2>
                </div>

                <div>
                    <p>'.$profil->PrenomEnseignant.' '.$profil->NomEnseignant.'</p>
                    <p>'.$profil->TelEnseignant.'</p>
                </div>
            </a>
        </div>';

        if($_SESSION['IdRole'] != 4){//Si l'utilisateur n'est pas superviseur, affiche les infos du superviseur.
            $content = $content.
            '
            <div class="blocInfo itemHover">
                <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil->IdSuperviseur.'&nomMenu=Profil.php\')">
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
                '.VerifEvaluation($evals, $profil).'
            </tbody>
        </table>

        <br/><br/><br/>';
        
        if(count($profils) > 1){//Si il y a plus qu'un stagiaire, affiche les flèches.
            $content = $content.
            '<input class="bouton" type="button" value="Écrire un commentaire" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil->IdSuperviseur.'&nomMenu=AVenir.php\')"/>

            <div class="navigateur">
                <div id="gauche" class="fleche flecheGauche" onclick="ChangerItem(this)"></div>
                <div id="droite" class="fleche flecheDroite" onclick="ChangerItem(this)"></div>
            </div>';
        }
        
        $content = $content.
        '</article>';
    }

    return $content;

?>