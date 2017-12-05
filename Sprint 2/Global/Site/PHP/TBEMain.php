<?php
    
    $content = "";

    $query2 = $bdd->prepare("SELECT * FROM vInfoEvalGlobale
                            WHERE IdStagiaire = :idStagiaire;");

    //Vérifie si les évaluations précédentes sont complétées pour pouvoir appuyer sur la suivante.
    function VerifEvaluation($tblEvaluation, $profil, $bdd)
    {
        $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');
        $query3 = $bdd->prepare("update tblEvaluation set Statut=:Statut where Id=:IdEvaluation;");

        $div = "";
        $eval1 = "";
        $eval2 = "";

        foreach ($tblEvaluation as $evaluation) 
        {
            if(date("Y-m-d") > $evaluation->dateFin) 
            {
                if(($evaluation->statut != 3) && ($evaluation->statut != 4))
                {
                    //l'evaluation n'est ni soumise, ni validée
                    //update du statut de l'evaluation : il passe a en retard
                    $query3->execute(array('Statut'=>2, 'IdEvaluation'=> $evaluation->id));
                    $evaluation->statut = 2;
                }
            }
            else if( date("Y-m-d") < $evaluation->dateDebut)
            {
                //affichage de l'évaluation : le statut est supposé etre a pas accéssible
            }
            else //intervalle de l'évaluation
            {
                if( ($evaluation->statut != 3) && ($evaluation->statut != 4))
                {
                    //l'evaluation n'est ni soumise, ni validée
                    //update du statut de l'evaluation : il passe a pas débuté
                    $query3->execute(array('Statut'=>1, 'IdEvaluation'=> $evaluation->id));
                     $evaluation->statut = 1;   
                }
            }
        }

       
        if($tblEvaluation[0]->statut != '0')//le statut est different de pas accéssible
        {
            $div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idStage=\', '.$tblEvaluation[0]->idStage.', \'&idEvaluation=\', '.$tblEvaluation[0]->id.', \'&typeEval=1\');">';
        }
        else
        {
            $div = '<tr>';
        }

        $eval1 = $div.
            '<td>'.$tblEvaluation[0]->titre.'</td>
            <td>'.$listeStatut[$tblEvaluation[0]->statut].'</td>
            <td>'.$tblEvaluation[0]->dateDebut.'</td>
            <td>'.$tblEvaluation[0]->dateFin.'</td>
            <td>'.$tblEvaluation[0]->dateCompletee.'</td>
        </tr>';

        if(($tblEvaluation[1]->statut != '0')&&(($tblEvaluation[0]->statut == '3')||($tblEvaluation[0]->statut == '4')))//statut different de pas accéssible et est soumis ou valide
        {
            $div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idStage=\', '.$tblEvaluation[1]->idStage.', \'&idEvaluation=\', '.$tblEvaluation[1]->id.', \'&typeEval=2\')">';
        }
        else
        {
            $div = '<tr>';
        }
        
        $eval2 = $div.
            '<td>'.$tblEvaluation[1]->titre.'</td>
            <td>'.$listeStatut[$tblEvaluation[1]->statut].'</td>
            <td>'.$tblEvaluation[1]->dateDebut.'</td>
            <td>'.$tblEvaluation[1]->dateFin.'</td>
            <td>'.$tblEvaluation[1]->dateCompletee.'</td>
        </tr>';

        if(($tblEvaluation[2]->statut != '0')&&(($tblEvaluation[0]->statut == '3')||($tblEvaluation[0]->statut == '4'))&&(($tblEvaluation[1]->statut == '3')||($tblEvaluation[1]->statut == '4')))//statut different de pas accéssible et est soumis ou valide
        {
            $div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idStage=\', '.$tblEvaluation[2]->idStage.', \'&idEvaluation=\', '.$tblEvaluation[2]->id.', \'&typeEval=3\')">';
        }
        else
        {
            $div = '<tr>';
        }

        //$div = '<tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idStage=\', '.$tblEvaluation[2]->idStage.', \'&idEvaluation=\', '.$tblEvaluation[2]->id.', \'&typeEval=3\')">';
        
        $eval3 = $div.
            '<td>'.$tblEvaluation[2]->titre.'</td>
            <td>'.$listeStatut[$tblEvaluation[2]->statut].'</td>
            <td>'.$tblEvaluation[2]->dateDebut.'</td>
            <td>'.$tblEvaluation[2]->dateFin.'</td>
            <td>'.$tblEvaluation[2]->dateCompletee.'</td>
        </tr>';
        
        $div = $eval1.$eval2.$eval3;
        
        return $div;
    }

    foreach($profils as $profil)
    {
        $query2->execute(array('idStagiaire'=> $profil["Id"]));
        $evals = $query2->fetchAll();
        $tblEvaluation = array();
        
            foreach($evals as $eval)
            {
                $evaluation = (object)[];

                $evaluation->idStage = $eval["IdStage"];
                $evaluation->id = $eval["IdEvaluation"];
                $evaluation->statut = $eval["Statut"];
                $evaluation->titre = $eval["TitreTypeEvaluation"]; 
                $evaluation->dateDebut = $eval["DateDébut"];
                $evaluation->dateFin = $eval["DateFin"];
                $evaluation->dateCompletee = $eval["DateComplétée"];

                $tblEvaluation[] = $evaluation;
            }

            $content = $content.
            '<article class="stagiaire">
                <div class="infoStagiaire">
                    <h2>'.$profil["Prenom"].' '.$profil["Nom"].'</h2>
                    <input class="bouton" type="button" value="Afficher le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Profil\')"/>
                    <h3>'.$profil["NumTel"].'</h3>
                </div>

                <div class="blocInfo itemHover">
                    <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdEnseignant"].'&nomMenu=Profil\')">
                        <div class="entete">
                            <h2>Enseignant</h2>
                        </div>

                        <div>
                            <p>'.$profil["PrenomEnseignant"].' '.$profil["NomEnseignant"].'</p>
                            <p>'.$profil["TelEnseignant"].'</p>
                        </div>
                    </a>
                </div>';

            if($_SESSION['IdRole'] != 4){//Si l'utilisateur n'est pas superviseur, affiche les infos du superviseur.
                $content = $content.
                '
                <div class="blocInfo itemHover">
                    <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Profil\')">
                        <div class="entete">
                            <h2>Superviseur</h2>
                        </div>

                        <div>
                            <p>'.$profil["PrenomSuperviseur"].' '.$profil["NomSuperviseur"].'</p>
                            <p>'.$profil["TelSuperviseur"].'</p>
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
                    '.VerifEvaluation($tblEvaluation, $profil, $bdd).'
                </tbody>
            </table>

            <br/><br/><br/>';
            
            if(count($profils) > 1)
            {

                //Si il y a plus qu'un stagiaire, affiche les flèches.
                $content = $content.
                '<input class="bouton" type="button" value="Écrire un commentaire" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Avenir\')"/>

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