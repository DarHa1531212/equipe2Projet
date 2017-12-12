<?php

    $sessions = $bdd->Request("SELECT * FROM vSession ORDER BY Id DESC", null, "stdClass");

    function AfficherSession($sessions){
        $content = "";
        $id = 0;
        
        foreach($sessions as $session){
            $content = $content.
            '
            <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=InfoSession.php&id=\', '.$id.')">
                <td>'.$session->Periode.'</td>
                <td>'.$session->Annee.'</td
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
        
        <input class="bouton left" type="button" value="Créer une Session" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=CreationSession.php\')"/>
        
        <table class="stage">
            <thead>
                <th>Période</th>
                <th>Année</th>
            </thead>

            <tbody>'
                .AfficherSession($sessions).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>