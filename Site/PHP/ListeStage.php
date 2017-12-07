<?php 

    $stages = $bdd-> Request (" SELECT 
                                vStage.Id as 'IdStage',
                                vStage.DescriptionStage as 'DescriptionStage', 
                                vStage.CompetenceRecherche as 'CompetenceRecherche', 
                                vStage.HoraireTravail as 'HoraireTravail', 
                                vStage.SalaireHoraire as 'SalaireHoraire', 
                                vStage.NbHeureSemaine as 'NbHeureSemaine' , 
                                vEntreprise.Nom as 'NomEntreprise' ,
                                vEntreprise.Id as 'IdEntreprise' ,
                                concat(vStagiaire.Prenom, ' ' , vStagiaire.Nom)  as 'NomStagiaire' , 
                                concat (vSuperviseur.Prenom, ' ', vSuperviseur.Nom) as 'NomSuperviseur', 
                                concat (vResponsable.Prenom, ' ', vResponsable.Nom) as'NomResponsable', 
                                concat (vEnseignant.Prenom, ' ', vEnseignant.Nom) as 'NomEnseignant',
                                vStage.DateDebut as 'DateDebut',
                                vStage.DateFin as 'DateFin'
                                from vStage    
                                left join vSuperviseur on  vSuperviseur.IdUtilisateur = vStage.IdSuperviseur    
                                left join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise     
                                left join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire     
                                left join vResponsable on vResponsable.IdUtilisateur = vStage.IdResponsable     
                                left join vEnseignant on vEnseignant.IdUtilisateur = vStage.IdEnseignant
                                ORDER BY IdStage DESC", 
                                null, "Stage");

    //Affiche tous les stages.
    function AfficherStages($stages)
    {
        $content = "";
        $index = 0;
        foreach ($stages as $stage) {
            $content = $content . 
            '<tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php&index='.$index.'\')">
                <td>' . $stage->getNomEntreprise() . '</td>
                <td>' . $stage->getNomStagiaire() . '</td>
                <td>Lettre dentente</td>
            </tr>';
            $index = $index + 1;
        }

        return $content;
    }

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Stages</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer un Stage" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationStage.php\')"/>
        
        <table class="stage">
            <thead>
                <th>Entreprise </th>
                <th>Stagiaire</th>
                <th>Lettre d\'entente</th>
            </thead>
                
            <tbody>
           
            ' . AfficherStages($stages). '
           
            </tbody>
        </table>

        
        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ConsoleAdminMain.php\')"/>
    </article>';

    return $content;
    
?>