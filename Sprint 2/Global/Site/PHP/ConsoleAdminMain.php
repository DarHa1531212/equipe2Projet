<?php
    $content = 
    '
    <article class="stagiaire">
        <div class="blocInfo itemHover onglet" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Stage\')">
            <a class="linkFill">
                <h1>Stages</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Session\')">
            <a class="linkFill">
                <h1>Sessions</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Entreprise\')">
            <a class="linkFill">
                <h1>Entreprises</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet">
            <a class="linkFill">
                <h1>Utilisateurs</h1>
            </a>
        </div>
    </article>
    ';   

    return $content;
?>