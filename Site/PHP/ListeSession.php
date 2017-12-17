<?php

    $sessions = $bdd->Request("SELECT * FROM vSession ORDER BY Id DESC", null, "Session");

    function AfficherSession($sessions){
        $content = "";
        $id = 0;
        
        foreach($sessions as $session){
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoSession.php&id='.$id.'\')">                
                <td>'.$session->getPeriode().'</td>
                <td>'.$session->getAnnee().'</td
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
            <h2>Liste des Sessions</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer une session" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationSession.php\')"/>
        
        <table class="stage">
            <thead>
                <th>Période</th>
                <th>Année</th>
            </thead>

            <tbody>'
                .AfficherSession($sessions).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>    </article>
    ';
        
    return $content;
    
?>