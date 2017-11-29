<?php
     //récupère les stages dans la BD et les affiche dans le tableau
     function showInternships($bdd)
        {
           $returnData = "";
           $query = $bdd->prepare("Select concat (vStagiaire.Prenom, ' ' , vStagiaire.Nom ) as 'Stagiaire',  vEntreprise.Nom, vStage.Id from vStage
        join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire
        join vSuperviseur on vSuperviseur.IdUtilisateur = vStage.IdSuperviseur
        join vEntreprise on vEntreprise.id = vSuperviseur.IdEntreprise;");
     
     
          $query->execute(array());     
          $entrees = $query->fetchAll();
          //
          foreach($entrees as $entree){
              $nomStagiaire = $entree["Stagiaire"];
              $entreprise = $entree["Nom"];
              $idStage = $entree["Id"];
              $returnData = $returnData .  


              '<tr  id="'. $idStage . '" class="itemHover" onclick="Execute(1,\'../PHP/TBNavigation.php?nomMenu=ReadStage\',\'&idStage=\',this.id)">
                      <td >' . $nomStagiaire . '</td>

                      <td' . $entreprise . '</td>

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