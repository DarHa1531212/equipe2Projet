<?php

    $id = "";
    $query = "";
    if(verifyTimeout())
    {
        if(isset($_POST["idEmploye"]) || isset($_POST['idStagiaire']) || $_SESSION['IdRole'])
        {
            if(isset($_POST["idProf"]))
            {
                $id = $_POST['idProf'];
                $query = getEmploye($bdd);
            }
            else
            {
                if(isset($_POST['PStag']))
                {
                    $id = $_POST['idStagiaire'];
                    $query = getStagiaire($bdd);
                }
                else
                {
                    if(isset($_POST["idEmploye"]) || $_SESSION['IdRole'] == 2 || $_SESSION['IdRole'] == 4) //TableauBordStagiaire.php pour les profils.
                    {
                        if(isset($_POST["idEmploye"]))
                        {
                            $id = $_POST["idEmploye"];
                        }
                        else
                        {
                            $id = $_SESSION['idEmploye'];
                        }
                        $query = getEmploye($bdd);
                    }
                    else if(isset($_POST["idStagiaire"]) || $_SESSION['IdRole'] == 5)
                    {
                        $id = $_SESSION['idConnecte'];
                        $query = getStagiaire($bdd);
                    }
                }
            }
        }

        $query->execute(array('id'=>$id)); //Lorsqu'on éxecute le query ont peut préciser la valeur des paramètres à l'aide d'un tableau associatif. idStagiaire = à la valeur de la variable $id.
        $profils = $query->fetchAll(); //la fonction fetchAll() met les valeurs du query dans une liste d'objets. J'ai donc fait une liste $stagiaires.
        
        foreach($profils as $profil)
        { //Puisque $employe est une liste je peux faire une boucle foreach pour récupérer les données.
            $id = $profil['Id'];
            $courrielEntreprise = $profil['CourrielEntreprise'];
            $nom = $profil['Nom'];
            $prenom = $profil['Prenom'];
            $numTel = $profil['NumTel'];
            $courrielPerso = $profil['CourrielPersonnel'];
            $numTelEntreprise = $profil['NumTelEntreprise'];
            $poste = $profil['Poste'];
            $entreprise = $profil['Nom Entreprise'];
            $codePermanent = $profil['CodePermanent'];    
        }
    }
    

    function getStagiaire($bdd)
    {
        $query = $bdd->prepare("SELECT Stagiaire.Id, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielPersonnel, Stagiaire.CodePermanent,
                                Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'Nom Entreprise'
                                FROM vStage AS Stage
                                JOIN vStagiaire AS Stagiaire
                                ON Stage.Id = Stagiaire.Id
                                JOIN vEmploye AS Emp
                                ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise 
                                WHERE Stagiaire.Id = :id");
        return $query;
    }

    function getEmploye($bdd)
    {
        $query = $bdd->prepare("SELECT Emp.Id, Emp.CourrielEntreprise, Prenom, Emp.Nom, Emp.NumTel, CourrielPersonnel, 
                                Ent.Nom AS 'Nom Entreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                FROM vEmploye AS Emp
                                JOIN vEntreprise AS Ent
                                ON Ent.Id = Emp.IdEntreprise 
                                WHERE Emp.Id = :id"); //Les ':' servent à mettre un paramètre dans ce cas le paramètre c'est id.
        return $query;
    }

?>