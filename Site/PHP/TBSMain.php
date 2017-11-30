<?php
        
    function definirCouleur($bdd, $idEval)//permet de definir la couleur des statut d'un evaluation
    {
        $result = $bdd->Request("SELECT Statut FROM vEvaluation WHERE Id = :id",array('id'=>$idEval),'stdClass');//la requete

        switch($result[0]->Statut)//return la couleur qui sera ajouter en CSS
        {
            case 'C':       return 'rgba(72, 229, 88, 1)'; //Green
            break;
            case 'N':       return 'rgba(237, 7, 7, 1)'; //Red
            break;
        }
    }

    $content = 
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$profils[0]->Prenom.' '.$profils[0]->Nom.'</h2>
            <input class="bouton" type="button" value="Afficher le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profils[0]->Id.'&nomMenu=Profil.php\')"/>
            <br /><br /><br /><br /><br /><br />
        </div>

        <div class="blocInfo itemHover">
            <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdEnseignant.'&nomMenu=Profil.php\')">
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
            <a class="linkFill" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdSuperviseur.'&nomMenu=Profil.php\')">
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
                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Rapport 1</td>
                    <td><span class="statutColor" style="background-color:' . definirCouleur($bdd,2) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Non complétée</td>
                    <td>2017-02-15</td>
                    <td></td>
                </tr>

                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Rapport 2</td>
                    <td><span class="statutColor" style="background-color:' . definirCouleur($bdd,1) . ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> complétée</td>
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
                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profils[0]->Id.'&nomMenu=JournalBord.php\', \'&nbEntree=\', 5) ">
                    <td>Journal de bord</td>
                </tr>

                <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profils[0]->Id.'&nomMenu=AVenir.php\')">
                    <td>Auto-Évaluation</td>
                </tr>
            </tbody>
        </table>
    </article>';

    return $content;
?>