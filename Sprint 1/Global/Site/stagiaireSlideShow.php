<?php
    try
	{
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_tests"); //Connexion a la bd au serveur.
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

    $query =    "SELECT Stagiaire.Id, Stagiaire.Nom, Stagiaire.Prenom, Stagiaire.NumTelPersonnel, Emp.Nom AS 'Nom Superviseur', Emp.Prenom AS 'Prenom Superviseur', Emp.NumTelCell AS 'Cell Superviseur'
                FROM vStagiaire AS Stagiaire
                JOIN vStage AS Stage
                ON Stage.IdStagiaire = Stagiaire.Id
                JOIN vSuperviseur AS Sup
                ON Sup.Id = Stage.IdSuperviseur
                JOIN vEmployeEntreprise AS Emp
                ON Emp.Id = Sup.IdEmployeEntreprise
                WHERE Sup.Id > 20";

    $result = $bdd->query($query);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$prenomStagiaire = $row["Prenom"];
            $nomStagiaire = $row["Nom"];
            $telPerso = $row["NumTelPersonnel"];
            $nomSup = $row["Nom Superviseur"];
            $prenomSup = $row["Prenom Superviseur"];
            $cellSup = $row["Cell Superviseur"];
            
            NouvelleZoneStagiaire($prenomStagiaire, $nomStagiaire, $telPerso, $prenomSup, $nomSup, $cellSup);
		}
	}


    function NouvelleZoneStagiaire($prenomStag, $nomStag, $numTelStag, $prenomSup, $nomSup, $numSup){
        echo    '<div class="infoStagiaire slide">
                                <div class="zoneProfil">
                                        <div class="element">
                                            <div class="entete">
                                                <h2>Stagiaire</h2>
                                            </div>

                                            <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                <p>'.$prenomStag." ".$nomStag.'</p>
                                                <p>'.$numTelStag.'</p>
                                            </a>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Superviseur</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                    <p>'.$prenomSup." ".$nomSup.'</p>
                                                    <p>'.$numSup.'</p>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Enseignant</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                    <p>Martin Mystère</p>
                                                    <p>(418) 666-7777</p>
                                                </a>
                                            </div>
                                        </div>
                                </div>

                                <div class="evaluation">
                                    <table class="table" class="tableauEvaluation">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Évaluation
                                                </th>
                                                <th>
                                                    Statut
                                                </th>
                                                <th>
                                                    Date début
                                                </th>
                                                <th>
                                                    Date limite
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Évaluation 1
                                                </td>
                                                <td>
                                                    Complétée
                                                </td>
                                                <td>
                                                    2017-09-07
                                                </td>
                                                <td>
                                                    2017-12-07
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Évaluation 2
                                                </td>
                                                <td>
                                                    Non complétée
                                                </td>
                                                <td>
                                                    2018-01-15
                                                </td>
                                                <td>
                                                    2018-03-15
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="commentaireContainer">
                                    <input class="bouton" id="boutonCommentaire" value="Écrire un commentaire" type="button"/>
                                </div>
                </div>';
    }
?>