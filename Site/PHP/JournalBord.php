<?php
    

    if(isset($_REQUEST['id']))
        $idStagiaire = $_REQUEST["id"];

    if(isset($_REQUEST['create']))
        NouvelleEntree($bdd, $idStagiaire);

    if(isset($_REQUEST['delete']))
        DeleteEntree($bdd, $_REQUEST['idEntree']);
    
    function DateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }

    function DerniereEntree($bdd, $idStagiaire){

        $result = $bdd->Request("   SELECT Dates AS DateComplete FROM vJournalDeBord 
                                WHERE IdStagiaire = :idStagiaire ORDER BY datecomplete DESC LIMIT 1;",
                                array("idStagiaire"=>$idStagiaire), "stdClass");

        if(array_key_exists(0, $result))
            return DateDifference(date('Y-m-d h:i:s'), $result[0]->DateComplete);
        else
            return '0';
    }

    function LineBreak($texte){
        $split = explode("\\n", $texte);
        $texte = "";
        
        for($i = 0; $i < count($split); $i++){
            $texte = $texte.$split[$i] . "\n";
        }
        
        return $texte;
    }

    function SelectEntrees($bdd, $idStagiaire){
        $limit = "";
        $div = "";
        if(isset($_REQUEST['nbEntree']))
            $limit = "LIMIT ".$_REQUEST['nbEntree'];
        
        $entrees = $bdd->Request("  SELECT Id, Entree, Date_Format (Dates, '%d/%m/%Y') AS Dates, Dates AS DateComplete, Documents AS Fichier 
                                    FROM vJournalDeBord WHERE IdStagiaire LIKE :idStagiaire ORDER BY datecomplete desc $limit;",
                                    array("idStagiaire"=>$idStagiaire), "stdClass");
        
        foreach($entrees as $entree){
            $texte = $entree->Entree;
            $dates = $entree->Dates;
            $dateComplete = $entree->DateComplete;
            $document = $entree->Fichier;
            $id = $entree->Id;

            $div = $div.
            '<div class="entree"><h2 class="dateEntree">'.$dates.'</h2><div class="crdJournal"><span class="crdJournalM" onclick="Edit('.$id.')">Modifier</span><span>&nbsp;|&nbsp;</span><span class="crdJournalD" onclick="Delete('.$id.')">Supprimer</span></div><p>' .LineBreak($texte). '</p><p>' . PieceJointe($document) . '</p></div>';
        }
        
        if(isset($_REQUEST['nbEntree']))
            $div = $div.'<input class="bouton" type="button" value="Voir toutes les entrées" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$idStagiaire.'&nomMenu=JournalBord.php\')"/>';

        return $div;
    }

    function NouvelleEntree($bdd, $idStagiaire){
        $champs = json_decode($_POST["tabChamp"]);
        $entree = array();
        
        foreach($champs as $champ){
            $entree[$champ->nom] = $champ->value;
        }
        
        $date = date('Y-m-d h:i:s', time());
        
        include 'UploadFile.php';
        
        

        if ($entree["contenu"] != "" && isset($_FILES['file']) && $_FILES['file']['name'] != "")
        {
            $bdd->Request(" INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates, Documents) 
                            VALUES (:text, :id, :date, :file);",
                            array("text"=>$entree["contenu"], "id"=>$idStagiaire, "date"=>$date, "file"=>$fichier),
                            "stdClass");
        }
        else
        {
            $bdd->Request(" INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates) 
                            VALUES (:text, :id, :date);",
                            array("text"=>$entree["contenu"], "id"=>$idStagiaire, "date"=>$date),
                            "stdClass");
        }
    }

    function PieceJointe($doc)
    {
        if($doc != null && $doc != "")
        {
            $ext = strtolower(pathinfo($doc)['extension']);
            $method = "AfficherImage('". $doc . "','" . $ext ."')";
            return '<a class="lienJointe"><span id="divBouton" style="cursor:pointer" onclick="' . $method . '">Pièce jointe ' . ' -  ' . $ext . '</span></a>'; //faire ici l'affichage en absolute
        }
        else
        {
            $vide = "";
            return $vide;
        }
    }

    function DeleteEntree($bdd, $idEntree)
    {
        $bdd->Request(" DELETE FROM tblJournalDeBord WHERE Id = :id",
                        array("id"=>$idEntree), "stdClass");
    }

    function UpdateEntree($bdd, $idEntree, $Entree)
    {
        $entree = array(htmlspecialchars($Entree));
        $bdd->Request(" UPDATE tblJournalDeBord SET Entree = :text WHERE Id = :id",
                        array("text"=>$entree[0], "Id"=>$idEntree), "stdClass");
    }

    function SelectEntreeModif($bdd, $idEntree)
    {
        $entrees = $bdd->Request("  SELECT Entree FROM vJournalDeBord WHERE Id = :id",
                                    array("id"=>$idEntree), "stdClass");

        foreach($entrees as $entree)
        {
            return $entree->Entree;
        }
    }
    
    $content=
    '
    <script>
        function Submit(){
            if(CheckAll()){
                Post(AfficherPage, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=JournalBord.php&nbEntree=5&create\');
            }
        }
        
        function Delete(id){
            if(confirm("Voulez-vous vraiment supprimer l\'entrée sélectionnée?")){
                Requete(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=JournalBord.php&idEntree=\' + id + \'&delete\');
                Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=JournalBord.php&nbEntree=5\');
            }
        }
        
        function Edit(id){
            Post
        }
    </script>
    
    <article class="stagiaire">
        
        <div class="infoStagiaire">
            <h2>Journal de bord</h2>
            <h3>Dernière entrée il y a : '.DerniereEntree($bdd, $idStagiaire).' jour(s)</h3>
        </div>
        
        <div id="imageJointe"></div>

        </div> 
    
        <div style="clear: both;"></div>

            <textarea class="value textarea" id="contenu" rows="5" cols="100" maxlength="500" name="contenu" wrap="hard" onkeyup="Required(this)" required></textarea>
            <input type="hidden" name="maxFileSize" value="2000000">
            <input class="inputFile" id="file" type="file" value="Envoyer" name="fichier" onchange="AfficherNom(this)"/>

            <br/>                           

            <input style="width: 120px;" class="bouton" id="Save" type="button" value="Envoyer" onclick="Submit()"/>

            <label class="bouton labelFile" for="file">Pièce Jointe</label>
            <p id="nomPieceJointe"></p>

            <div class="separateur">
                <h3>Toutes les entrées</h3>
            </div>

            '.SelectEntrees($bdd, $idStagiaire).'

            <br/><br/>

            <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$id.'&nomMenu=Main\')"/>
    </article>';

    return $content;
?>