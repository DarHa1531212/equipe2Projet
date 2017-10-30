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

    function SelectEntrees($bdd, $idStagiaire){
        $limit = "";
        $div = "";
        
        if(isset($_REQUEST['nbEntree']))
            $limit = "LIMIT ".$_REQUEST['nbEntree'];
        
        $query = $bdd->prepare("SELECT Entree, Date_Format (Dates, '%d/%m/%Y') AS Dates, Dates AS DateComplete, Documents AS Fichier FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY datecomplete desc $limit;");
        $query->execute(array());
        
        $entrees = $query->fetchAll();
        
        foreach($entrees as $entree){
            $texte = $entree["Entree"];
            $dates = $entree["Dates"];
            $dateComplete = $entree["DateComplete"];
            $document = $entree['Fichier'];
            $texte = $texte;

            $div = $div.'<div class="entree"><h2>'.$dates.'</h2><p>' .$texte. '</p><p>' . PieceJointe($document) . '</p></div>';
        }
        
        if(isset($_REQUEST['nbEntree']))
            $div = $div.'<input class="bouton" type="button" value="Voir toutes les entrées" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\')"/>';

        return $div;
    }

    function NouvelleEntree($bdd, $idStagiaire){
        $date = date('Y-m-d h:i:s', time());
        
        if(isset($_REQUEST['contenu'])){
            include 'UploadFile.php';
            $entree = array(htmlspecialchars($_REQUEST['contenu']));

            if($verif)
            {
                if ($entree[0] != "" && isset($_FILES['fichier']) && $_FILES['fichier']['name'] != "")
                {
                    $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates, Documents) VALUES (:text, :id,'$date', :file);");
                    $query->bindValue( 'text', $entree[0], PDO::PARAM_STR );
                    $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
                    $query->bindValue( 'file', $fichier, PDO::PARAM_STR);
                    $query->execute();
                }
                else
                {
                    if($entree[0] != "")
                    {
                        $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates) VALUES (:text, :id,'$date');");
                        $query->bindValue( 'text', $entree[0], PDO::PARAM_STR );
                        $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
                        $query->execute();
                    }
                }
            }
            else
            {
                //$_SESSION['textJournal'] = $text;
                ?><script>alert("Test concluant");</script><?php
            }
        }
    }

    function PieceJointe($doc)
    {
        if($doc != null && $doc != "")
        {
            $method = "AfficherImage('". $doc . "','" . pathinfo($doc)['extension'] ."')";
            return '<p><span id="divBouton" onclick="' . $method . '">Pièce jointe</span></p>'; //faire ici l'affichage en absolute
        }
        else
        {
            $vide = "";
            return $vide;
        }
    }
    
    if(isset($_REQUEST['contenu'])){
        NouvelleEntree($bdd, $idStagiaire);
    }
    else{
        $content=
        '
        <article class="stagiaire">
            <div class="infoStagiaire">
                <h2>Journal de bord</h2>
                <h3>Dernière entrée il y a : '.DerniereEntree($bdd, $idStagiaire).' jour(s)</h3>
            </div>
            <p id="imageJointe"></p>

            <div class="separateur">
                <h3>Nouvelle Entrée</h3>
            </div>
            <form action="#" method="POST">
                <textarea id="contenu" rows="5" cols="100" maxlength="500" name="contenu" wrap="hard"></textarea>
                <input type="hidden" name="maxFileSize" value="2000000">
                <input class="inputFile" id="fichier" type="file" value="Envoyer" name="fichier"/>

                <br/>                                                                             
                <input style="width: 120px;" class="bouton" type="submit" value="Envoyer" onclick="Execute(2, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\', \'&contenu=\', contenu.value); Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Journal\', \'&nbEntree=\', 5)"/>
                <label class="bouton labelFile" for="file">Pièce Jointe</label>
            </form>
            <div class="separateur">
                <h3>Toutes les entrées</h3>
            </div>

            '.SelectEntrees($bdd, $idStagiaire).'

            <br/><br/>

            <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>
        </article>';

        return $content;
    }
?>