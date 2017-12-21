<?php
    
    $recherche = "%%";

    if(isset($_REQUEST["recherche"])){
        $champs = json_decode($_POST["tabChamp"]);
        $stringRecherche = array();
        
        foreach($champs as $champ){
            $stringRecherche[$champ->nom] = $champ->value;
        }
        
        $recherche = '%'.$stringRecherche["recherche"].'%';

        return SelectEntreprise($bdd, $recherche);
    }

    function SelectEntreprise($bdd, $recherche){
        
        $entreprises = $bdd->Request("  SELECT * FROM vEntreprise 
                                        WHERE CONCAT(Nom, NumTel, CourrielEntreprise, Ville) LIKE '$recherche'
                                        ORDER BY Id DESC", 
                                        array("recherche"=>$recherche), 
                                        "Entreprise");
        
        return $entreprises;
    }
    
    $entreprises = SelectEntreprise($bdd, $recherche);

    
 
    function AfficherEntreprise($entreprises){
        $content = "";
        
        foreach($entreprises as $entreprise){
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoEntreprise.php&id='.$entreprise->getId().'\')">
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
        
        <input class="bouton left" type="button" value="Créer une Entreprise" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationEntreprise.php\')"/>
        <input class="value recherche" type="text" name="recherche" placeholder="Recherche" onkeyup="Post(PopulateEntreprise, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php&recherche\')"/>
        
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