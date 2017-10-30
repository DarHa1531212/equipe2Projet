<?php
    
    $content = 
    '
    <article class="ressources">
        <div class="ressourceItem">
            <a class="linkFill" href="../PDF/Cahier%20stagiaire%202017.pdf">
                <div class="divImage imgPDF"></div>
                <p>Cahier Stagiaire</p>
            </a>
        </div>

        <div class="ressourceItem">
            <a class="linkFill" href="../PDF/Offre%20de%20stage%202017.docx">
                <div class="divImage imgDOC"></div>
                <p>Offre de stage</p>
            </a>
        </div>

        <div class="ressourceItem">
            <a class="linkFill" href="../PDF/Lettre%20d\'entente%202017.docx">
                <div class="divImage imgDOC"></div>
                <p>Lettre d\'entente</p>
            </a>
        </div>          
    </article>
    
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
            <tr class="itemHover" onclick="window.document.location=\'\'\;">
                <td>Rapport 1</td>
                <td>Non complétée</td>
                <td>2017-02-15</td>
                <td></td>
            </tr>

            <tr class="itemHover" onclick="window.document.location=\'\'\;">
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
            <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\', \'&nbEntree=\', 5)">
                <td>Journal de bord</td>
            </tr>

            <tr class="itemHover" onclick="window.document.location=\'\'\;">
                <td>Auto-Évaluation</td>
            </tr>
        </tbody>
    </table>';

    return $content;
?>