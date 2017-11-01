<?php
    
    $content = "";

    foreach($profils as $profil){
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

        if($_SESSION['IdRole'] != 4){
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
                <th>Date limite</th>
                <th>Date complétée</th>
            </thead>

            <tbody>
                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\')">
                    <td>Évaluation mi-stage</td>
                    <td>Non complétée</td>
                    <td>2017-02-15</td>
                    <td></td>
                </tr>

                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\')">
                    <td>Évaluation finale</td>
                    <td>Complétée</td>
                    <td>2017-03-30</td>
                    <td>2017-03-25</td>
                </tr>
            </tbody>
        </table>

        <br/><br/><br/>';
        
        if(count($profils) > 1){
            $content = $content.
            '<input class="bouton" type="button" value="Écrire un commentaire" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Avenir\')"/>

            <div class="navigateur">
                <div class="fleche flecheGauche" onclick="ChangerStagiaire(this)"></div>
                <div class="fleche flecheDroite" onclick="ChangerStagiaire(this)"></div>
            </div>';
        }
        
    $content = $content.
    '</article>';
    }

    return $content;

?>