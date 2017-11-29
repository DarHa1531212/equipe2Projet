<?php
     //récupère les stages dans la BD et les affiche dans le tableau

    $content = 
    '
    <table class="stage">

            <input class="bouton left" type="button" value="Créer un Utilisateur" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur\')"/>

            <thead>
                <th>Nom </th>
                <th>Courriel</th>
                <th>Numero de téléphone</th>
                <th>Entreprise</th>
            </thead>
 
            <tbody>
                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>
                               <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>                <tr class="itemHover">
                    <td>Martin Luther</td>
                    <td>marthin.luther@email.com</td>
                    <td>(123) 123-1234</td>
                    <td>CGI</td>
                </tr>
            </tbody>
        </table>
    </article>';

                   
    return $content;
    
?>