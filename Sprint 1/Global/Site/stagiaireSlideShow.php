<?php
    try
	{
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_tests"); //Connexion a la bd au serveur.
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

    $query = "SELECT * FROM vTableauBord";

    $result = $bdd->query($query);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
            $idStagiaire = $row["Id"];
			$prenomStagiaire = $row["Prenom"];
            $nomStagiaire = $row["Nom"];
            $telPerso = $row["NumTelPersonnel"];
            
            $idSup = $row["Id Superviseur"];
            $nomSup = $row["Nom Superviseur"];
            $prenomSup = $row["Prenom Superviseur"];
            $cellSup = $row["Cell Superviseur"];
            
            $idProf = $row["Id Enseignant"];
            $prenomProf = $row["Prenom Enseignant"];
            $nomProf = $row["Nom Enseignant"];
            $telProf = $row["Tel Enseignant"];
            
            NouvelleZoneStagiaire($idStagiaire, $prenomStagiaire, $nomStagiaire, $telPerso, $idSup, $prenomSup, $nomSup, $cellSup, $idProf, $prenomProf, $nomProf, $telProf);
		}
	}


    function NouvelleZoneStagiaire($idStagiaire, $prenomStag, $nomStag, $numTelStag, $idSup, $prenomSup, $nomSup, $numSup, $idProf, $prenomProf, $nomProf, $telProf){
        echo    '<div class="infoStagiaire slide">
                                <div class="zoneProfil">
                                        <div class="element">
                                            <div class="entete">
                                                <h2>Stagiaire</h2>
                                            </div>

                                            <form action="PHP/ProfilStagiaire.php" method="post">
                                                <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                    <input type="hidden" value="'.$idStagiaire.'" name="idStagiaire"/>
                                                    <p>'.$prenomStag." ".$nomStag.'</p>
                                                    <p>'.$numTelStag.'</p>
                                                </a>
                                            </form>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Superviseur</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="PHP/ProfilSuperviseur.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$idSup.'" name="idSuperviseur"/>
                                                        <p>'.$prenomSup." ".$nomSup.'</p>
                                                        <p>'.$numSup.'</p>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Enseignant</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <form action="PHP/ProfilEnseignant.php" method="post">
                                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                        <input type="hidden" value="'.$idProf.'" name="idEnseignant"/>
                                                        <p>'.$prenomProf." ".$nomProf.'</p>
                                                        <p>'.$telProf.'</p>
                                                    </a>
                                                </form>
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