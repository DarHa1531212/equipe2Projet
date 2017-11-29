<?php
    
    require 'ListeEntreprise.php';
    /*if(isset($_REQUEST["post"]))
        CreateEntreprise($bdd);
        
    function CreateEntreprise($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $entreprise = array();
        
        foreach($champs as $champ){
            $entreprise[$champ->nom] = $champ->value;
        }
        
        $query = $bdd->prepare("INSERT INTO tblEntreprise (CourrielEntreprise, Nom, NumTel, NumCivique, Rue, Ville, Province, CodePostal, Logo) 
                                VALUES (:courriel, :nom, :numTel, :numCivique, :rue, :ville, :province, :codePostal, :logo)");
        
        $query->execute(array(
            "courriel"=>$entreprise["courriel"],
            "nom"=>$entreprise["nom"],
            "numTel"=>$entreprise["numTel"],
            "numCivique"=>$entreprise["numCivique"],
            "rue"=>$entreprise["rue"],
            "ville"=>$entreprise["ville"],
            "province"=>$entreprise["province"],
            "codePostal"=>$entreprise["codePostal"],
            "logo"=>$entreprise["logo"]));
    }*/

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Consultation de l\'Entreprise</h2>
            <input class="bouton" type="button" value="Modifier"/>
        </div>

        <div class="separateur">
            <h3>Information de l\'entreprise</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Nom</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->Nom.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Courriel</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->CourrielEntreprise.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Téléphone</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->NumTel.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Ville</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->Ville.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Civique</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->NumCivique.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rue</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->Rue.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Province</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->Province.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Code Postal</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->CodePostal.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Logo</p>
                <p class="value">'.$entreprises[$_REQUEST["id"]]->Logo.'</p>
            </div>
            
            <br/><br/>
        </div>
        
        <br/><br/>
        
        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeEntreprise.php\')"/>
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Supprimer"/>
            
    </article>
    ';
    
    return $content;

?>




