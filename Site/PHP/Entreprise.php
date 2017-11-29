<?php

    $query = $bdd->prepare("SELECT * FROM vEntreprise ORDER BY Id DESC");
    $query->execute();
    $entreprises = $query->fetchAll(PDO::FETCH_CLASS, 'Entreprise');

    function AfficherEntreprise($entreprises){
        $content = "";
        
        foreach($entreprises as $entreprise){
            $content = $content.
            '
            <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=test.php&id=\', '.$entreprise->getId().')">
                <td>'.$entreprise->getNom().'</td>
                <td>'.$entreprise->getNumTel().'</td>
                <td>'.$entreprise->getCourriel().'</td>
                <td>'.$entreprise->getVille().'</td>
            </tr>
            ';
        }
        
        return $content;
    }

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Entreprises</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer une Entreprise" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=CreationEntreprise.php\')"/>
        
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
        
        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>