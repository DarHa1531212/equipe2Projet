<?php
    
    if(isset($_REQUEST["post"]))
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
    }

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Création d\'une Entreprise</h2>
        </div>

        <div class="separateur">
            <h3>Information de l\'entreprise</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Nom</p>
                <input type="text" name="nom" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Courriel</p>
                <input type="email" name="courriel" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Téléphone</p>
                <input type="text" name="numTel" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Ville</p>
                <input type="text" name="ville" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Civique</p>
                <input type="text" name="numCivique" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rue</p>
                <input type="text" name="rue" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Province</p>
                <input type="text" name="province" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Code Postal</p>
                <input type="text" name="codePostal" class="value"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Logo</p>
                <input type="text" name="logo" class="value"/>
            </div>
            

            <br/><br/>

            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Créer" onclick="Execute(5, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=CreationEntreprise.php&post\');Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>

            <br/><br/>
        </div>
    </article>
    ';
    
    return $content;

?>




