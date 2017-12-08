<?php
    
    if(isset($_REQUEST["post"]))
        CreateEntreprise($bdd);
        
    function CreateEntreprise($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $entreprise = array();
        
        foreach($champs as $champ){
            $entreprise[$champ->nom] = $champ->value;
        }
        
        $bdd->Request(" INSERT INTO tblEntreprise (CourrielEntreprise, Nom, NumTel, NumCivique, Rue, Ville, Province, CodePostal, Logo) 
                        VALUES (:courriel, :nom, :numTel, :numCivique, :rue, :ville, :province, :codePostal, :logo)",
                        array(
                        'courriel'=>$entreprise["courriel"],
                        'nom'=>$entreprise["nom"],
                        'numTel'=>$entreprise["numTel"],
                        'numCivique'=>$entreprise["numCivique"],
                        'rue'=>$entreprise["rue"],
                        'ville'=>$entreprise["ville"],
                        'province'=>$entreprise["province"],
                        'codePostal'=>$entreprise["codePostal"],
                        'logo'=>$entreprise["logo"]),
                        'stdClass');
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
                <input type="text" name="nom" class="value" maxlength="100" id="name" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Courriel</p>
                <input type="email" name="courriel" class="value" maxlength="320" id="email" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Téléphone</p>
                <input type="text" name="numTel" class="value" maxlength ="14" id="numTel" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Ville</p>
                <input type="text" name="ville" class="value" maxlength="100" id="town" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Civique</p>
                <input type="text" name="numCivique" class="value" maxlength="5" id="numCivique" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rue</p>
                <input type="text" name="rue" class="value" maxlength="100" id="Street" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Province</p>
                <input type="text" name="province" class="value" maxlength="25" id="province" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Code Postal</p>
                <input type="text" name="codePostal" class="value" maxlength="7" id="codePostal" onchange="regexCreationEntreprise();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Logo</p>
                <input type="text" name="logo" class="value"/>
            </div>
        
            <br/><br/>

            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeEntreprise.php\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Créer" onclick="Post(ExecuteQuery, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=CreationEntreprise.php&post\');Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeEntreprise.php\')"/>

            <br/><br/>
        </div>
    </article>
    ';
    
    return $content;

?>




