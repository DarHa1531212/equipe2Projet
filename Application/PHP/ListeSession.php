<?php

    $recherche = "%%";

    if(isset($_REQUEST["recherche"])){
        $champs = json_decode($_POST["tabChamp"]);
        $stringRecherche = array();
        
        foreach($champs as $champ){
            $stringRecherche[$champ->nom] = $champ->value;
        }
        
        $recherche = '%'.$stringRecherche["recherche"].'%';

        return SelectSession($bdd, $recherche);
    }

    function SelectSession($bdd, $recherche){
        $sessions = $bdd->Request(" SELECT * FROM vSession                                     
                                    WHERE CONCAT(Annee, Periode) LIKE '$recherche'
                                    ORDER BY Id DESC",
                                    array("recherche"=>$recherche), "Session");
        
        return $sessions;
    }
    
    $sessions = SelectSession($bdd, $recherche);

    function AfficherSession($sessions){
        $content = "";
        
        foreach($sessions as $session){
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoSession.php&id='.$session->getId().'\')">                
                <td>'.$session->getPeriode().'</td>
                <td>'.$session->getAnnee().'</td
            </tr>
            ';
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
        <input class="value recherche" type="text" name="recherche" placeholder="Recherche" onkeyup="Post(PopulateSession, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php&recherche\')"/>
        
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