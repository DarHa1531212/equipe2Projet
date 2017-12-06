<?php
    include 'ListeUtilisateur.php';
    $content = "";
    $role = "";

    if(isset($_REQUEST["id"])){
        $role = $bdd->Request(" SELECT IdUtilisateur, Titre, IdRole
                                FROM vUtilisateurRole AS UR
                                JOIN vRole AS R
                                ON R.Id = UR.IdRole
                                WHERE IdUtilisateur = :id", array("id"=>$_REQUEST["id"]), "stdClass")[0];
        
        if($role->IdRole != 5){
            $profil = $bdd->Request("   SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, CourrielPersonnel, IdRole,
                                        Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                        FROM vEmploye AS Emp
                                        JOIN vEntreprise AS Ent
                                        ON Ent.Id = Emp.IdEntreprise
                                        JOIN vUtilisateurRole AS UR
                                        ON UR.IdUtilisateur = Emp.IdUtilisateur
                                        WHERE Emp.IdUtilisateur = :id",
                                        array("id"=>$_REQUEST["id"]),
                                        "ProfilEmploye")[0];
        }
        else{
            $profil = $bdd->Request("   SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielPersonnel, Stagiaire.CodePermanent,
                                        Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'NomEntreprise', IdRole
                                        FROM vStage AS Stage
                                        JOIN vStagiaire AS Stagiaire
                                        ON Stage.Id = Stagiaire.Id
                                        JOIN vEmploye AS Emp
                                        ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                        JOIN vEntreprise AS Ent
                                        ON Ent.Id = Emp.IdEntreprise
                                        JOIN vUtilisateurRole AS UR
                                        ON UR.IdUtilisateur = Stagiaire.IdUtilisateur
                                        WHERE Stagiaire.IdUtilisateur = :id",
                                        array("id"=>$_REQUEST["id"]),
                                        "ProfilStagiaire")[0];
        } 
        
        $role = '('.$role->Titre.')';
    }

    $content = $content.
    '<article class="stagiaire">
        <div class="infoStagiaire">';

        if($profil->getId() == $_SESSION['idConnecte']){
            $content = $content.
            '<h2>Votre Profil</h2>';
            
            if($_SESSION['IdRole'] == 5){
                $content = $content.
                '<input class="bouton" type="button" value="Modifier le profil" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->getId().'&nomMenu=ModifProfil.php\')"/>';
            }
        }
        else{
            $content = $content.
            '<h2>Profil de '.$profil->getPrenom().' '.$profil->getNom().' '.$role.'</h2>';
        }

        if($_SESSION['IdRole'] == 1){
            $content = $content.
            '<input class="bouton" type="button" value="Modifier le profil" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->getId().'&nomMenu=ModifProfil.php\')"/>';
        }

        $content = $content.
        '</div>';

        $content = $content.
        $profil->AfficherProfil().
        '<br/><br/>

        <input class="bouton" type="button" value="   Retour   ", onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?id='.$profil->getId().'&nomMenu=Main\');"/>
    </article>';
    
    return $content;

    ?>