<?php

    $content = 
    '<div class="infoStagiaire">
        <h2>Votre profil</h2>
        <input class="bouton" type="button" value="Modifier le profil" onclick="Execute(\'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Modif\', 1)"/>
    </div>

    <div class="separateur">
        <h3>Informations Personnelles</h3>
    </div>

    <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label">Prenom :</p>
                <p class="value">'.$prenom.'</p>
            </div>

            <div class="champ">
                <p class="label">Nom :</p>
                <p class="value">'.$nom.'</p>
            </div>

            <div class="champ">
                <p class="label">No. Téléphone :</p>
                <p class="value">'.$numTel.'</p>
            </div>

            <div class="champ">
                <p class="label">Courriel :</p>
                <p class="value">'.$courrielPerso.'</p>
            </div>
    </div>

    <div class="separateur">
        <h3>Informations Professionnelles</h3>
    </div>

    <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label">Entreprise :</p>
                <p class="value">'.$entreprise.'</p>
            </div>

            <div class="champ">
                <p class="label">Courriel :</p>
                <p class="value">'.$courrielEntreprise.'</p>
            </div>

            <div class="champ">
                <p class="label">No. Téléphone :</p>
                <p class="value">'.$numTelEntreprise.'</p>
            </div>

            <div class="champ">
                <p class="label">Poste :</p>
                <p class="value">'.$poste.'</p>
            </div>
    </div>

    <br/><br/>

    <input class="bouton" type="button" value="   Retour   ", onclick="Execute(\'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\', 1)"/>';
    
    return $content;

    ?>