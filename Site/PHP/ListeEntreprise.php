<?php
 
    $entreprises = $bdd->Request("SELECT * FROM vEntreprise ORDER BY Id DESC", null, "Entreprise");
 
    function AfficherEntreprise($entreprises){
        $content = "";
        $id = 0;
        
        foreach($entreprises as $entreprise){
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoEntreprise.php&id='.$id.'\')">
                <td>'.$entreprise->getNom().'</td>
                <td>'.$entreprise->getNumTel().'</td>
                <td>'.$entreprise->getCourriel().'</td>
                <td>'.$entreprise->getVille().'</td>
            </tr>
            ';
            
            $id = $id + 1;
        }
        
        return $content;
    }
 
    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Entreprises</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer une Entreprise" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationEntreprise.php\')"/>
        
        <table class="stage">
            <thead>
                <th>Nom</th>
                <th>No. Telephone</th>
                <th>Courriel</th>
                <th>Ville</th>
            </thead>
 
            <tbody>'
                .AfficherEntreprise($entreprises).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>