<?php
    
    $content =
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Évaluation de mi-stage</h2>
        </div>

        <div class="blocInfo infoProfil">
            <p>
                La première évaluation servira à noter de façon générale l’élève stagiaire en vue
                d\'un réajustement possible. Il serait grandement souhaitable que cette évaluation
                se fasse conjointement avec l’élève stagiaire et que la démarche s\'effectue de
                façon formative. Une fois complété, le formulaire devra être remis à votre
                stagiaire qui se chargera de nous l\'expédier.

            </p>
        </div>

        <div class="separateur">
            <h3>Identification</h3>
        </div>

        <table class="identification">
            <tbody>
                <tr>
                    <td>Organisation</td>
                    <td>Cegep de jonquière</td>
                </tr>

                <tr>
                    <td>Responsable technique</td>
                    <td>Lucien Lachance</td>
                </tr>

                <tr>
                    <td>Responsable pédagogique</td>
                    <td>Martin Luther</td>
                </tr>

                <tr>
                    <td>Élève stagiaire</td>
                    <td>Martin Mystere</td>
                </tr>
            </tbody>
        </table>

        <div class="separateur">
            <h3>A. Motivation</h3>
            <p> 
                Capacité qui se manifeste par le désir d’apprendre, le désir de réussir, l’enthousiasme
                et la persévérance.
            </p>
        </div>

        <table class="evaluation">
            <thead>
                <th>Critères</th>
                <th>Généralement</th>
                <th>Souvent</th>
                <th>Parfois</th>
                <th>Rarement</th>
            </thead>
            <tbody>
                <tr>
                    <td>Faire preuve de curiosité.</td>
                    <td><input type="radio" name="Q1"/></td>
                    <td><input type="radio" name="Q1"/></td>
                    <td><input type="radio" name="Q1"/></td>
                    <td><input type="radio" name="Q1"/></td>
                </tr>

                <tr>
                    <td>
                        Concentrer ses efforts et investir l’énergie nécessaire pour faire
                        du bon travail, voir à se dépasser, et pour satisfaire aux normes
                        de qualité et de rendement en vigueur dans l’entreprise.
                    </td>
                    <td><input type="radio" name="Q2"/></td>
                    <td><input type="radio" name="Q2"/></td>
                    <td><input type="radio" name="Q2"/></td>
                    <td><input type="radio" name="Q2"/></td>
                </tr>

                <tr>
                    <td>
                        Porter un intérêt soutenu au travail. Faire preuve de
                        persévérance et de volonté.
                    </td>
                    <td><input type="radio" name="Q3"/></td>
                    <td><input type="radio" name="Q3"/></td>
                    <td><input type="radio" name="Q3"/></td>
                    <td><input type="radio" name="Q3"/></td>
                </tr>

                <tr>
                    <td>Être de bonne humeur. Éprouver du plaisir à travailler</td>
                    <td><input type="radio" name="Q4"/></td>
                    <td><input type="radio" name="Q4"/></td>
                    <td><input type="radio" name="Q4"/></td>
                    <td><input type="radio" name="Q4"/></td>
                </tr>
            </tbody>
        </table>

        <div class="navigateurEval">
            <input class="bouton" style="width : 150px; float: left;" type="button" value="Précédent"/>
            <input class="bouton" style="width : 150px; float: right" type="button" value="Suivant"/>
        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')"/>
    </article>';

    return $content;

?>