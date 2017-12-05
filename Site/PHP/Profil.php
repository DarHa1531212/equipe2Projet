<?php
/*$query = $bdd->prepare("");*/    


    $content = "";
    $role = "";

    if(isset($_REQUEST["idEmploye"])){
        $profil = $bdd->Request("   SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, CourrielPersonnel, IdRole,
                                    Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                    FROM vEmploye AS Emp
                                    JOIN vEntreprise AS Ent
                                    ON Ent.Id = Emp.IdEntreprise
                                    JOIN vUtilisateurRole AS UR
                                    ON UR.IdUtilisateur = Emp.IdUtilisateur
                                    WHERE Emp.IdUtilisateur = :id",
                                    array("id"=>$_REQUEST["idEmploye"]),
                                    "ProfilEmploye")[0];
        if($profil->getIdRole() == 4)
            $role = "(Superviseur)";
        else if($profil->getIdRole() == 3)
            $role = "(Enseignant)";
    }   
    else
        $profil = $bdd->Request("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielPersonnel, Stagiaire.CodePermanent,
                                    Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'Nom Entreprise'
                                    FROM vStage AS Stage
                                    JOIN vStagiaire AS Stagiaire
                                    ON Stage.Id = Stagiaire.Id
                                    JOIN vEmploye AS Emp
                                    ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                    JOIN vEntreprise AS Ent
                                    ON Ent.Id = Emp.IdEntreprise 
                                    WHERE Stagiaire.IdUtilisateur = :id",
                                    array("id"=>$_REQUEST["idStagiaire"]),
                                    "ProfilStagiaire")[0];

    $content = $content.
    '<article class="stagiaire">
        <div class="infoStagiaire">';

        if($profil->getId() == $_SESSION['idConnecte']){
            $content = $content.
            '<h2>Votre Profil</h2>';
            
            if($_SESSION['IdRole'] == 5){
                $content = $content.
                '<input class="bouton" type="button" value="Modifier le profil" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$profil->getId().'&nomMenu=ModifProfil.php\')"/>';
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