<?php
    
    $content = 
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$prenomStagiaire.' '.$nomStagiaire.'</h2>
            <input class="bouton" type="button" value="Afficher le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Profil\')"/>
            <h3>'.$telPerso.'</h3>
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$idProf.'&nomMenu=Profil\')">
                <div class="entete">
                    <h2>Enseignant</h2>
                </div>

                <div>
                    <p>'.$prenomProf.' '.$nomProf.'</p>
                    <p>'.$telProf.'</p>
                </div>
            </a>
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$idSup.'&nomMenu=Profil\')">
                <div class="entete">
                    <h2>Superviseur</h2>
                </div>

                <div>
                    <p>'.$prenomSup.' '.$nomSup.'</p>
                    <p>'.$cellSup.'</p>
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
                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Avenir\')">
                    <td>Rapport 1</td>
                    <td>Non complétée</td>
                    <td>2017-02-15</td>
                    <td></td>
                </tr>

                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Avenir\')">
                    <td>Rapport 2</td>
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
                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\', \'&nbEntree=\', 5) ">
                    <td>Journal de bord</td>
                </tr>

                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Avenir\')">
                    <td>Auto-Évaluation</td>
                </tr>
            </tbody>
        </table>
    </article>';

    return $content;
?>