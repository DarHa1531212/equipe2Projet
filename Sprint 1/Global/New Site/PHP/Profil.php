<?php 
session_start();

function AfficherProfil($NomMenu){
    
    include 'vProfil.php';
    $menu = "";
    
    if($NomMenu == "Profil"){
        $menu = 
        '<div class="infoStagiaire">
            <h2>Votre profil</h2>
            <input class="bouton" type="button" value="Modifier le profil"/>
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

        <input class="bouton" type="button" value="   Retour   ", onclick="AfficherProfil('.$id.', \'Stagiaire\', \'Main\')"/>';
    }//Interface de la consultation des profils
    else if($NomMenu == "Main"){
        include 'vTableauBord.php';
        $menu = 
        '<div class="infoStagiaire">
                    <h2>'.$prenomStagiaire.' '.$nomStagiaire.'</h2>
                    <input type="hidden" value="'.$idStagiaire.'" name="idStagiaire" id="idStagiaire"/>
                    <input class="bouton" type="button" value="Afficher le profil" onclick="AfficherProfil(idStagiaire.value, \'Stagiaire\', \'Profil\')"/>
                    <h3>'.$telPerso.'</h3>
                </div>

                <div class="blocInfo itemHover">
                    <a class="linkFill" onclick="AfficherProfil(idProf.value, \'Employe\', \'Profil\')">
                        <input type="hidden" value="'.$idProf.'" name="idEmploye" id="idProf"/>

                        <div class="entete">
                            <h2>Enseignant</h2>
                        </div>

                        <div>
                            <p>'.$prenomProf.' '.$nomProf.'</p>
                            <p>'.$telProf.'</p>
                        </div>
                    </a>
                </div>

                <div class="blocInfo itemHover">
                    <a class="linkFill" onclick="AfficherProfil(idSup.value, \'Employe\', \'Profil\')">
                        <input type="hidden" value="'.$idSup.'" name="idEmploye" id="idSup"/>

                        <div class="entete">
                            <h2>Superviseur</h2>
                        </div>

                        <div>
                            <p>'.$prenomSup.' '.$nomSup.'</p>
                            <p>'.$cellSup.'</p>
                        </div>
                    </a>
                </div>

                <br/><br/><br/><br/>

                <table>
                    <thead>
                        <th>Rapport</th>
                        <th>Statut</th>
                        <th>Date limite</th>
                        <th>Date complétée</th>
                    </thead>

                    <tbody>
                        <tr class="itemHover" onclick="window.document.location=\'\'\;">
                            <td>Rapport 1</td>
                            <td>Non complétée</td>
                            <td>2017-02-15</td>
                            <td></td>
                        </tr>

                        <tr class="itemHover" onclick="window.document.location=\'\'\;">
                            <td>Rapport 2</td>
                            <td>Complétée</td>
                            <td>2017-03-30</td>
                            <td>2017-03-25</td>
                        </tr>
                    </tbody>
                </table>

                <br/><br/>

                <table>
                    <thead>
                        <th>Autre</th>
                    </thead>

                    <tbody>
                        <tr class="itemHover" onclick="window.document.location=\'\'\;">
                            <td>Journal de bord</td>
                        </tr>

                        <tr class="itemHover" onclick="window.document.location=\'\'\;">
                            <td>Auto-Évaluation</td>
                        </tr>
                    </tbody>
                </table>';    
    }//Interface du menu principal (Tableau de bord du stagiaire)
    

    echo json_encode($menu);
}

AfficherProfil($_REQUEST["nomMenu"]);

?>