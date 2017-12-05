<?php
    
    require 'ListeEntreprise.php';
    
    if(isset($_REQUEST["id"]))
        $entreprise = $entreprises[$_REQUEST["id"]];
    

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Consultation de l\'Entreprise</h2>
            <input class="bouton" type="button" value="Modifier" onclick="Execute(1, \'../PHP/TBNavigation.php?&nomMenu=ModifEntreprise.php&id='.$_REQUEST["id"].'\')"/>
        </div>

        <div class="separateur">
            <h3>Information de l\'entreprise</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Nom</p>
                <p class="value">'.$entreprise->getNom().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Courriel</p>
                <p class="value">'.$entreprise->getCourriel().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Téléphone</p>
                <p class="value">'.$entreprise->getNumTel().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Ville</p>
                <p class="value">'.$entreprise->getVille().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">No. Civique</p>
                <p class="value">'.$entreprise->getNumCivique().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rue</p>
                <p class="value">'.$entreprise->getRue().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Province</p>
                <p class="value">'.$entreprise->getProvince().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Code Postal</p>
                <p class="value">'.$entreprise->getCodePostal().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Logo</p>
                <p class="value">'.$entreprise->getLogo().'</p>
            </div>
            
            <br/><br/>
        </div>
        
        <br/><br/>
        
        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php\')"/>
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Supprimer"/>
            
    </article>
    ';
    
    return $content;

?>




