<?php

    $query2 = $bdd->prepare("SELECT * FROM vInfoEvalGlobale
                            WHERE IdTypeEvaluation = 4 AND IdStage = :IdStage;");

    $listeStatut = array('Pas Accéssible','Pas Débuté','En Retard','Soumis ','Valide ');

    

    $content='';

    foreach($profils as $profil)/*pour chaque stages au quel le stagiaire a participe*/
    {
        //echo count($profils);

        
        
        $query2->execute(array('IdStage'=> $profil["IdStage"]));

        $autoEvaluation = $query2->fetchAll();

         $content = $content.
            '<article class="stagiaire">

                <div class="infoStagiaire">
                    <h2>'.$profil["Prenom"].' '.$profil["Nom"].'</h2>
                    <input class="bouton" type="button" value="Afficher le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Profil\')"/>
                    <h3>'.$profil["NumTel"].'</h3>
                </div>

                <div class="blocInfo itemHover">
                    <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$idProf.'&nomMenu=Profil\')">
                        <div class="entete">
                            <h2>Enseignant</h2>
                        </div>

                        <div>
                            <p>'.$profil["PrenomEnseignant"].' '.$profil["NomEnseignant"].'</p>
                            <p>'.$profil["TelEnseignant"].'</p>
                        </div>
                    </a>
                </div>

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
                        <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Avenir\')">
                            <td>Etat d\'avancement janvier</td>
                            <td>Non complétée</td>
                            <td>2017-02-15</td>
                            <td>2017-03-25</td>
                        </tr>

                        <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Avenir\')">
                            <td>Etat d\'avancement février</td>
                            <td>Complétée</td>
                            <td>2017-03-30</td>
                            <td>2017-03-25</td>
                        </tr>

                         <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Avenir\')">
                            <td>Etat d\'avancement Mars</td>
                            <td>Complétée</td>
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

                        <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Journal\', \'&nbEntree=\', 5)">
                            <td>Journal de bord</td>
                        </tr>

                        <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil["Id"].'&nomMenu=Eval\', \'&idEvaluation=\','.$autoEvaluation[0]["IdEvaluation"].')">
                            <td>Auto-Évaluation'.$autoEvaluation[0]['IdEvaluation'].'</td>
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