<?php
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FAIRE UNE REQUETE DE ROLE COMME DANS LA PAGE PROFIL, ENLEVER LES ID DES URL POUR ENVOYER LOBJET DIRECTEMENT, METTRE LES ROLES DANS LA TABLE STAGIAIRE AUSSI.//
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $stagiaires = $bdd->Request("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielScolaire, Stagiaire.CodePermanent,
 Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, IdRole
                                FROM vStagiaire as Stagiaire
                                JOIN vUtilisateurRole AS UR
                                ON UR.IdUtilisateur = Stagiaire.IdUtilisateur", null, "ProfilStagiaire");
    $entreprises = $bdd->Request("SELECT Ent.Nom AS 'NomEntreprise', Stagiaire.IdUtilisateur
                                FROM vStagiaire as Stagiaire
                                JOIN vStage as Stage
                                ON Stage.Id = Stagiaire.Id
                                JOIN vEmploye AS Emp
                                ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise", null, "stdClass")

    $employes = $bdd->Request(" SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, CourrielPersonnel, IdRole,
                                Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                FROM vEmploye AS Emp
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise
                                JOIN vUtilisateurRole AS UR
                                ON UR.IdUtilisateur = Emp.IdUtilisateur", null, "ProfilEmploye");

    function AfficherUtilisateur($utilisateurs){


        $courriel;
        $entreprise;
        $numTel;
        $typeId;
        $content = "";
        $id = 0;
        $role = "";
        $nomRole = array("1"=>"Gestionnaire", "2"=>"Responsable", "3"=>"Enseignant", "4"=>"Superviseur", "5"=>"Stagiaire");
        
        foreach($utilisateurs as $utilisateur){
            if(get_class($utilisateur) == "ProfilStagiaire"){
                //si l'utilisateur est un stagiaire
                //récupérer le nom entreprise et l'ID stagiaire
                //boucler la liste d'utilisateur
                //trouver l'id correspondant
                //ajouter la propriété entreprise
                $courriel = $utilisateur->getCourrielPerso();
                $numTel = $utilisateur->getNumTelPerso();
            }
            else{
                $courriel = $utilisateur->getCourrielEntreprise();
                $numTel = $utilisateur->getNumTelEntreprise(); 
                $entreprise = $utilisateur->getEntreprise();  
            }
            
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Profil.php&id='.$utilisateur->getId().'\')">
                <td>'.$utilisateur->getPrenom().'</td>
                <td>'.$utilisateur->getNom().'</td>
                <td>'.$courriel.'</td>
                <td>'.$numTel.'</td>
                <td>'.$entreprise.'</td>
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
        
        <input class="bouton left" type="button" value="Créer un Utilisateur" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php\' );afficherChampsEmployeEntreprise() "/>
        
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
                 AfficherUtilisateur($employes).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>