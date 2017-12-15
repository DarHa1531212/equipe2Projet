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
    <script>
        function Submit(){
            if(CheckAll()){
                Post(ExecuteQuery, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=CreationEntreprise.php&post\');
                Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeEntreprise.php\');
            }
        }
    </script>
    
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Création d\'une Entreprise</h2>
        </div>

        <div class="separateur">
            <h3>Information de l\'entreprise</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Nom</p>
                <input type="text" name="nom" onblur="Required(this);" class="value" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Courriel</p>
                <input type="email" name="courriel" class="value" onblur="Required(this); VerifierRegex(this);" pattern="'.$regxEmail.'" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>No. Téléphone</p>
                <input type="text" maxlength="14" name="numTel" class="value" onblur="Required(this); VerifierRegex(this);" pattern="'.$regxNumTel.'" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Ville</p>
                <input type="text" name="ville" class="value" onblur="Required(this)" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>No. Civique</p>
                <input type="text" maxlength="10" name="numCivique" class="value" onblur="Required(this); VerifierRegex(this);" pattern="'.$regxNumCivique.'" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Rue</p>
                <input type="text" name="rue" class="value" onblur="Required(this)" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Province</p>
                <input type="text" name="province" class="value" onblur="Required(this)" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput"><span class="Obligatoire">*</span>Code Postal</p>
                <input type="text" maxlength="7" name="codePostal" class="value" onblur="Required(this); VerifierRegex(this);" pattern="'.$regxCodePostal.'" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Logo</p>
                <input type="text" name="logo" class="value"/>
            </div>
        
            <br/><br/>

            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeEntreprise.php\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Créer" onclick="Submit()"/>
            
            <br/><br/>
        </div>
    </article>
    ';

    return $content;

?>




