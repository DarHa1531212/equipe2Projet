<?php
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FAIRE UNE REQUETE DE ROLE COMME DANS LA PAGE PROFIL, ENLEVER LES ID DES URL POUR ENVOYER LOBJET DIRECTEMENT, METTRE LES ROLES DANS LA TABLE STAGIAIRE AUSSI.//
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $stagiaires = $bdd->Request("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielPersonnel, Stagiaire.CodePermanent,
                                Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'NomEntreprise'
                                FROM vStage AS Stage
                                JOIN vStagiaire AS Stagiaire
                                ON Stage.Id = Stagiaire.Id
                                JOIN vEmploye AS Emp
                                ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise", null, "ProfilStagiaire");

    $employes = $bdd->Request(" SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, CourrielPersonnel, IdRole,
                                Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                FROM vEmploye AS Emp
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise
                                JOIN vUtilisateurRole AS UR
                                ON UR.IdUtilisateur = Emp.IdUtilisateur", null, "ProfilEmploye");

    function AfficherUtilisateur($utilisateurs){
        $courriel;
        $numTel;
        $typeId;
        $content = "";
        $id = 0;
        $role = "";
        $nomRole = array("1"=>"Gestionnaire", "2"=>"Responsable", "3"=>"Enseignant", "4"=>"Superviseur", "5"=>"Stagiaire");
        
        foreach($utilisateurs as $utilisateur){
            if(get_class($utilisateur) == "ProfilStagiaire"){
                $courriel = $utilisateur->getCourrielPerso();
                $numTel = $utilisateur->getNumTelPerso();
            }
            else{
                $courriel = $utilisateur->getCourrielEntreprise();
                $numTel = $utilisateur->getNumTelEntreprise();   
            }
            
            $content = $content.
            '
            <tr class="itemHover" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Profil.php&id=\', '.$utilisateur->getId().')">
                <td>'.$utilisateur->getPrenom().'</td>
                <td>'.$utilisateur->getNom().'</td>
                <td>'.$courriel.'</td>
                <td>'.$numTel.'</td>
                <td>'.$utilisateur->getEntreprise().'</td>
                <td>'.$nomRole[$utilisateur->getIdRole()].'</td>
            </tr>
            ';
            
            $id = $id + 1;
        }
        
        return $content;
    }

    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Utilisateurs</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer un Utilisateur" onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php\')"/>
        
        <table class="stage">
            <thead>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Courriel</th>
                <th>No. Téléphone</th>
                <th>Entreprise</th>
                <th>Role</th>
            </thead>

            <tbody>'
                .AfficherUtilisateur($stagiaires).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>