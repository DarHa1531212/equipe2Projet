<?php
    
    require 'ListeEntreprise.php';

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