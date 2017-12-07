<?php
    $content = 
    '
    <article class="stagiaire">
        <div class="blocInfo itemHover onglet" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')">
            <a class="linkFill">
                <h1>Stages</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationSession.php\')">
            <a class="linkFill">
                <h1>Sessions</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php\')">
            <a class="linkFill">
                <h1>Entreprises</h1>
            </a>
        </div>

        <div class="blocInfo itemHover onglet" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php\')">
            <a class="linkFill">
                <h1>Utilisateurs</h1>
            </a>
        </div>
    </article>
    ';   

    return $content;
?>