<?php
    include 'ListeUtilisateur.php';
    $content = "";
    $role = "";
    
    if(isset($_REQUEST["id"])){
        $idProfil = $_REQUEST["id"];
        
        $role = $bdd->Request(" SELECT IdUtilisateur, Titre, IdRole
                                FROM vUtilisateurRole AS UR
                                JOIN vRole AS R
                                ON R.Id = UR.IdRole
                                WHERE IdUtilisateur = :id", array("id"=>$idProfil), "stdClass")[0];
        
        if($role->IdRole != 5)
        {
            $profil = $bdd->Request("   SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, IdRole,
                                        Ent.Nom AS 'NomEntreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste
                                        FROM vEmploye AS Emp
                                        JOIN vEntreprise AS Ent
                                        ON Ent.Id = Emp.IdEntreprise
                                        JOIN vUtilisateurRole AS UR
                                        ON UR.IdUtilisateur = Emp.IdUtilisateur
                                        WHERE Emp.IdUtilisateur = :id",
                                        array("id"=>$idProfil),
                                        "ProfilEmploye")[0];
        }
        else{//stagiaire
            

            $stagiaire = $bdd->Request("  select *
                                            from vstage as stage
                                            where stage.IdStagiaire = :IdStagiaire",
                                        array("IdStagiaire"=>$idProfil),
                                        "stdClass");
            if(count($stagiaire)==0)//le stagiaire n'a pas de stage
            {
                 $profil = $bdd->Request("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPerso, Stagiaire.CourrielPersonnel, Stagiaire.CourrielScolaire, 
                                        Stagiaire.CodePermanent, Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste,'Aucun' AS 'NomEntreprise', IdRole
                                        FROM vStagiaire AS Stagiaire
                                        JOIN vUtilisateurRole AS UR
                                        ON UR.IdUtilisateur = Stagiaire.IdUtilisateur
                                        WHERE Stagiaire.IdUtilisateur = :id", 
                                       array("id"=>$idProfil),
                                        "ProfilStagiaire")[0];
            }
            else//le stagiaire a un stage
            {
                $profil = $bdd->Request("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPerso, Stagiaire.CourrielPersonnel, Stagiaire.CourrielScolaire, 
                                        Stagiaire.CodePermanent, Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'NomEntreprise', 5 AS 'IdRole'
                                        FROM vStage AS Stage
                                        JOIN vStagiaire AS Stagiaire
                                        ON Stage.IdStagiaire = Stagiaire.IdUtilisateur
                                        JOIN vEmploye AS Emp
                                        ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                        JOIN vEntreprise AS Ent
                                        ON Ent.Id = Emp.IdEntreprise
                                        WHERE Stagiaire.IdUtilisateur = :id",
                                        array("id"=>$idProfil),
                                        "ProfilStagiaire")[0];
            }
        } 
        
        $role = '('.$role->Titre.')';
    }

    if(isset($_REQUEST["idProfil"])){
        $idProfil = $_REQUEST["idProfil"];

        foreach($utilisateurs as $utilisateur){
            if($utilisateur->getId() == $idProfil){
                $profil = $utilisateur;
                break;
            }  
        }
    }

    if(isset($_REQUEST["delete"]))
    {
        DeleteUser($bdd, $idProfil);
    }
    else{
        $content = $content.
        '
        <script>
            function Delete(){
                if(confirm("Êtes-vous certains de vouloir supprimer cet utilisateur?")){
                    Requete(testerRetourSupressionUtilisateur, \'../PHP/TBNavigation.php?nomMenu=profil.php&delete=true&id=' . $idProfil. '\');
                    Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php\');
                }
            }
        </script>
        
        <article class="stagiaire">
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
                
                if($_SESSION["idConnecte"] != $profil->getId()){
                    $content = $content.
                    '<input class="bouton" type="button" style="width: 100px;" value="Supprimer" onclick= "Delete()"/>';
                }   
            }

            $content = $content.
            '</div>';

            $content = $content.
            $profil->AfficherProfil();
        
            if($_SESSION['IdRole'] == 1){
                $content = $content.
                '<br/><br/>

                <input class="bouton" type="button" value="   Retour   ", onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php\');"/>';
            }
            else{
                $content = $content.
                '<br/><br/>

                <input class="bouton" type="button" value="   Retour   ", onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=Main\');"/>';
            }
            
        $content = $content.
        '</article>';

        return $content;
    }

    function DeleteUser($bdd, $idProfil)
    {
        $nbStagesLies = 0;

        //vérifier si l'utilisateur est lié a un stage ou plus en tant que stagiaire, superviseur, responsable ou enseignant
        $result = $bdd->Request(" SELECT count(*) as 'nbResponsables' from vStage where IdResponsable =  :idUtilisateur", array ('idUtilisateur'=>$idProfil), 'stdClass');

        foreach($result as $resultat)
        {
            $nbStagesLies = $nbStagesLies + $resultat->nbResponsables;   
        }

        $result = $bdd->Request(" SELECT count(*) as 'nbSuperviseurs' from vStage where IdSuperviseur = :idUtilisateur", array ('idUtilisateur'=>$idProfil), 'stdClass');

        foreach($result as $resultat)
        {
            $nbStagesLies = $nbStagesLies + $resultat->nbSuperviseurs;   
        }

        $result = $bdd->Request(" SELECT count(*) as 'nbStagiaire' from vStage where IdStagiaire = :idUtilisateur", array ('idUtilisateur'=>$idProfil), 'stdClass');

        foreach($result as $resultat)
        {
            $nbStagesLies = $nbStagesLies + $resultat->nbStagiaire;   
        }

        $result = $bdd->Request("SELECT count(*) as 'nbEnseignant' from vStage where IdEnseignant = :idUtilisateur", array ('idUtilisateur'=>$idProfil), 'stdClass');

        foreach($result as $resultat)
        {
            $nbStagesLies = $nbStagesLies + $resultat->nbEnseignant;   
        }

        if ($nbStagesLies == 0)
        {
            $stage = array();

            $result = $bdd->Request("DELETE FROM tblUtilisateur WHERE Id = :id;",
                array('id'=>$idProfil),'stdClass');

            $result = $bdd->Request("DELETE FROM tblEmploye WHERE IdUtilisateur = :id;",
                array('id'=>$idProfil),'stdClass');

            $result = $bdd->Request("DELETE FROM tblStagiaire WHERE IdUtilisateur = :id;",
                array('id'=>$idProfil),'stdClass');

            $result = $bdd->Request("DELETE FROM tblUtilisateurRole WHERE IdUtilisateur = :id;",
                array('id'=>$idProfil),'stdClass');

            echo -2 ;
        }
        
        else {
            echo -1;
        }
    }


    ?>