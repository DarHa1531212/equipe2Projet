<?php
    
    include 'ConnexionBD.php';

    function DateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }

    function DerniereEntree($bdd, $idStagiaire){
        $derniereEntree = "";
        
        $query = $bdd->prepare("SELECT Dates AS DateComplete FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY datecomplete DESC LIMIT 1;");
        $query->execute(array());
        
        $results = $query->fetchall();
        
        foreach($results as $result){
            $dateComplete = $result["DateComplete"];
            $derniereEntree = DateDifference(date('Y-m-d h:i:s'), $dateComplete);
        }
        
        return $derniereEntree;
    }

    function SelectEntrees($bdd, $idStagiaire, $nbEntree){
        $limit = "";
        $div = "";
        
        if($nbEntree != null)
            $limit = "LIMIT ".$nbEntree;
        
        $query = $bdd->prepare("SELECT Entree, Date_Format (Dates, '%d/%m/%Y') AS Dates, Dates AS DateComplete FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY datecomplete desc $limit;");
        $query->execute(array());
        
        $entrees = $query->fetchAll();
        
        foreach($entrees as $entree){
            $texte = $entree["Entree"];
            $dates = $entree["Dates"];
            $dateComplete = $entree["DateComplete"];

            $div = $div.'<div class="entree"><h2>'.$dates.'</h2><p>' . nl2br($texte) . '</p></div>';
        }
        
        return nl2br($div);
    }

    function NouvelleEntree($bdd, $idStagiaire){
        $date = date('Y-m-d h:i:s', time());
        
        if(isset($_REQUEST['contenu'])){
            $entree = array();
            $entree = array(htmlspecialchars($_REQUEST['contenu']));
        
            $text = $entree[0];

            if ($text != "")
            {
                $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates) VALUES (:text, :id,'$date');");
                $query->bindValue( 'text', $text, PDO::PARAM_STR );
                $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
                $query->execute();
            }
        }
    }
    
    if(isset($_REQUEST['contenu'])){
        NouvelleEntree($bdd, $idStagiaire);
    }
    else{
        $content=
        '<div class="infoStagiaire">
            <h2>Journal de bord</h2>
            <h3>Dernière entrée il y a : '.DerniereEntree($bdd, $idStagiaire).' jour(s)</h3>
        </div>

        <div class="separateur">
            <h3>Nouvelle Entrée</h3>
        </div>

        <textarea id="contenu" rows="5" cols="100" maxlength="500" name="contenu" wrap="hard"></textarea>
        <input class="inputFile" id="file" type="file" value="Envoyer"/>

        <br/>                                                                             
        <input style="width: 120px;" class="bouton" type="button" value="Envoyer" onclick="Execute(2, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\', \'&contenu=\', contenu.value); Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\')"/>
        <label class="bouton labelFile" for="file">Pièce Jointe</label>

        <div class="separateur">
            <h3>Toutes les entrées</h3>
        </div>

        '.SelectEntrees($bdd, $idStagiaire, 5).'

        <input class="bouton" type="button" value="Voir toutes les entrées"/>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>';

        return $content;
    }
?>