<?php

    $recherche = "%%";
    $content = "";

    if(isset($_REQUEST["recherche"])){
        $champs = json_decode($_POST["tabChamp"]);
        $stringRecherche = array();
        
        foreach($champs as $champ){
            $stringRecherche[$champ->nom] = $champ->value;
        }
        
        $recherche = '%'.$stringRecherche["recherche"].'%';
        
        return SelectUtilisateur($bdd, $recherche);
    }

    $utilisateurs = SelectUtilisateur($bdd, $recherche);
        
    function SelectUtilisateur($bdd, $recherche){
        $utilisateurs = array();
        
        $stagiairesAvecStage = $bdd->Request(" SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPerso, Stagiaire.CourrielPersonnel, Stagiaire.CourrielScolaire, 
                                                Stagiaire.CodePermanent, Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'NomEntreprise', 5 AS 'IdRole'
                                                FROM vStage AS Stage
                                                JOIN vStagiaire AS Stagiaire
                                                ON Stage.IdStagiaire = Stagiaire.IdUtilisateur
                                                JOIN vEmploye AS Emp
                                                ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                                JOIN vEntreprise AS Ent
                                                ON Ent.Id = Emp.IdEntreprise
                                                WHERE CONCAT(Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.CourrielPersonnel, Stagiaire.NumTelPerso, Ent.Nom) LIKE '$recherche'",
                                                array("recherche"=>$recherche), "ProfilStagiaire");
    

        $stagiairesSansStage = $bdd->Request("SELECT DISTINCT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPerso, Stagiaire.CourrielPersonnel, Stagiaire.CourrielScolaire, 
                                            Stagiaire.CodePermanent, Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste,'Aucun' AS 'NomEntreprise', IdRole
                                            FROM vStagiaire AS Stagiaire
                                            JOIN vUtilisateurRole AS UR
                                            ON UR.IdUtilisateur = Stagiaire.IdUtilisateur
                                            WHERE Stagiaire.IdUtilisateur NOT IN 
                                            (
                                                SELECT IdStagiaire
                                                FROM vStage
                                            )
                                            HAVING CONCAT(Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.CourrielPersonnel, Stagiaire.NumTelPerso, 'Aucun') LIKE '$recherche'; ",
                                            array("recherche"=>$recherche), "ProfilStagiaire");


        $employes = $bdd->Request(" SELECT DISTINCT Emp.IdUtilisateur, Prenom, Emp.Nom, IdRole,
                                    Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste
                                    FROM vEmploye AS Emp
                                    JOIN vEntreprise AS Ent
                                    ON Ent.Id = Emp.IdEntreprise
                                    JOIN vUtilisateurRole AS UR
                                    ON UR.IdUtilisateur = Emp.IdUtilisateur
                                    WHERE CONCAT(Prenom, Emp.Nom, Emp.CourrielEntreprise, Emp.NumTelEntreprise, Ent.Nom) LIKE '$recherche'", 
                                    array("recherche"=>$recherche), "ProfilEmploye");
        
        $utilisateurs = array_merge($stagiairesAvecStage, $stagiairesSansStage, $employes);
        return $utilisateurs;
    }

    //$utilisateurs = SelectUtilisateur($bdd, $recherche);

    function AfficherUtilisateur($utilisateurs){
        $courriel;
        $numTel;
        $typeId;
        $entreprise;
        $content = "";
        $role = "";
        $nomRole = array("1"=>"Gestionnaire", "2"=>"Responsable", "3"=>"Enseignant", "4"=>"Superviseur", "5"=>"Stagiaire");
        
        foreach($utilisateurs as $utilisateur){
            if(get_class($utilisateur) == "ProfilStagiaire"){
                //si l'utilisateur est un stagiaire
                //récupérer le nom entreprise et l'ID stagiaire
                //boucler la liste d'utilisateur
                //trouver l'id correspondant
                //ajouter la propriété entreprise
                $courriel = $utilisateur->getCourrielScolaire();
                $numTel = $utilisateur->getNumTelPerso();
            }
            else if(get_class($utilisateur) == "ProfilEmploye"){
                $courriel = $utilisateur->getCourrielEntreprise();
                $numTel = $utilisateur->getNumTelEntreprise();
            }
            
            $content = $content.
            '
            <tr class="itemHover" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Profil.php&idProfil='.$utilisateur->getId().'\')">
                <td>'.$utilisateur->getPrenom().'</td>
                <td>'.$utilisateur->getNom().'</td>
                <td>'.$courriel.'</td>
                <td>'.$numTel.'</td>
                <td>'.$utilisateur->getEntreprise().'</td>
                <td>'.$nomRole[$utilisateur->getIdRole()].'</td>
            </tr>
            ';
        }
        
        return $content;
    }

    $content = $content.
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Liste des Utilisateurs</h2>
        </div>
        
        <input class="bouton left" type="button" value="Créer un Utilisateur" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php\' );afficherChampsEmployeEntreprise() "/>
        <input class="value recherche" type="text" name="recherche" placeholder="Recherche" onkeyup="Post(PopulateUser, \'../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php&recherche\')"/>
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
                .AfficherUtilisateur($utilisateurs).
            '</tbody>
        </table>
        
        <input class="bouton" type="button" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Main\')"/>
    </article>
    ';
        
    return $content;
    
?>