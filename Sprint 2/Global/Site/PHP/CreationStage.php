<?php

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Stages</h2>
        </div>

        <div class="separateur">
            <h3>Création d\'un Stage</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Entreprise</p>
                <select class="value">
                    <option>test</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rémunéré</p>
                <div>
                    <label for="oui">Oui</label>
                    <input id="oui" type="radio" name="remunere" value="1" checked onclick="DisableSalaire(this)"/>
                    <label for="non">Non</label>
                    <input id="non" type="radio" name="remunere" value="0" onclick="DisableSalaire(this)"/>
                </div>
            </div>
            <div class="champ">
                <p class="label labelForInput">Salaire Horaire</p>
                <input class="value" type="text" id="salaire"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Début</p>
                <input class="value" type="date"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Fin</p>
                <input class="value" type="date"/>
            </div>

            <br/>

            <div class="champArea">
                <p class="label labelForInput labelArea">Description du stage</p>
                <textarea class="valueArea"></textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="valueArea"></textarea>
            </div>

            <br/><br/>

            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder"/>

            <br/><br/>
        </div>

        <div class="separateur">
            <h3>Liste des stages</h3>
        </div>

        <div class="blocInfo infoProfil">
            <table class="stage">
                <thead>
                    <th>Entreprise </th>
                    <th>Stagiaire</th>
                    <th>Lettre d\'entente</th>
                    <th>Offre de Stage</th>
                    <th></th>
                </thead>

                <tbody>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                    <tr class="itemHover">
                        <td>CGI</td>
                        <td>Martin Luther</td>
                        <td>Lettre d\'entente.docx</td>
                        <td>Offre de Stage.docx</td>
                        <td>Mettre à jour la lettre d\'entente</td>
                    </tr>
                </tbody>
            </table>

        </div>      
    </article>
    ';
    
    return $content;

?>




