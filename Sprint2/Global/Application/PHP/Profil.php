<?php
    
    $content = "";
    $role = "";

    if(isset($_REQUEST["idEmploye"])){
        $profil = new ProfilEmploye($_REQUEST["idEmploye"], $bdd);
        
        if($profil->getIdRole() == 4)
            $role = "(Superviseur)";
        else if($profil->getIdRole() == 3)
            $role = "(Enseignant)";
    }   
    else
        $profil = new ProfilStagiaire($_REQUEST["idStagiaire"], $bdd);

    $content = $content.
    '<article class="stagiaire">
        <div class="infoStagiaire">';

        if($profil->getId() == $_SESSION['idConnecte']){
            $content = $content.
            '<h2>Votre Profil</h2>';
            
            if($_SESSION['IdRole'] == 5){
                $content = $content.
                '<input class="bouton" type="button" value="Modifier le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil->getId().'&nomMenu=Modif\')"/>';
            }
        }
        else{
            $content = $content.
            '<h2>Profil de '.$profil->getPrenom().' '.$profil->getNom().' '.$role.'</h2>';
        }

        $content = $content.
        '</div>';

        $content = $content.
        $profil->AfficherProfil().
        '<br/><br/>

        <input class="bouton" type="button" value="   Retour   ", onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil->getId().'&nomMenu=Main\');"/>
    </article>';
    
    return $content;

    ?>