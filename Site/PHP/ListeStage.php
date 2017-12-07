<?php 

    $recherche = "%%";

    if(isset($_REQUEST["recherche"])){
        $champs = json_decode($_POST["tabChamp"]);
        $stringRecherche = array();
        
        foreach($champs as $champ){
            $stringRecherche[$champ->nom] = $champ->value;
        }
        
        $recherche = '%'.$stringRecherche["recherche"].'%';

        return SelectStage($bdd, $recherche);
    }

    function SelectStage($bdd, $recherche){
        $stages = $bdd-> Request (" SELECT * FROM vListeStage WHERE Tag LIKE :recherche", 
                                    array("recherche"=>$recherche), "Stage");
        
        return $stages;
    }
    
    $stages = SelectStage($bdd, $recherche);

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
        <input class="value recherche" type="text" name="recherche" placeholder="Recherche" onkeyup="Post(PopulateTable, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php&recherche\')"/>
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