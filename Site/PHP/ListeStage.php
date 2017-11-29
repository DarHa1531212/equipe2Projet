<?php
     //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {
       $returnData = "";
       $stagiaires = $bdd->Request("SELECT CONCAT (vStagiaire.Prenom, ' ' , vStagiaire.Nom ) AS 'NomStagiaire',  vEntreprise.Nom AS 'Entreprise', vStage.Id AS IdStage FROM vStage
                                    JOIN vStagiaire ON vStagiaire.IdUtilisateur = vStage.IdStagiaire
                                    JOIN vSuperviseur ON vSuperviseur.IdUtilisateur = vStage.IdSuperviseur
                                    JOIN vEntreprise ON vEntreprise.id = vSuperviseur.IdEntreprise;",
                                    null, "stdClass");

      foreach($stagiaires as $stagiaire){
          $returnData = $returnData .  

          '<tr  id="'. $stagiaire->IdStage . '" class="itemHover" onclick="Execute(1,\'../PHP/TBNavigation.php?nomMenu=InfoStage.php\',\'&idStage=\',this.id)">
                  <td >' . $stagiaire->NomStagiaire . '</td>

                  <td' . $stagiaire->Entreprise . '</td>

                  <td>Lettre dentente</td>
                  <td>Offre de stage</td>
            </tr>';
      }      
        return $returnData;
    }

    $internships = showInternships($bdd);

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Stages</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer un Stage" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=CreationStage\')"/>
        
        <table class="stage">
            <thead>
                <th>Entreprise </th>
                <th>Stagiaire</th>
                <th>Lettre d\'entente</th>
            </thead>

             <tbody>
                ' . $internships . '
            </tbody>
        </table>
    </article>';

                    
    return $content;
    
?>